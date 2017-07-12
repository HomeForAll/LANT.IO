<?php
use Respect\Validation\Validator as v;

class UserModel extends Model
{
    use Cleaner;

    // Коды ошибок
    const LOGIN_VALIDATION_ERROR = 1000;
    const LOGIN_OR_PASSWORD_INCORRECT_ERROR = 1001;
    const LOGIN_BANNED_ERROR = 1002;
    const REGISTRATION_OGRN_INCORRECT_ERROR = 2000;
    const REGISTRATION_INN_INCORRECT_ERROR = 2001;
    const REGISTRATION_USER_TYPE_INCORRECT_ERROR = 2002;
    const REGISTRATION_DOCUMENT_TYPE_INCORRECT_ERROR = 2003;
    const REGISTRATION_BRAND_INCORRECT_ERROR = 2004;
    const REGISTRATION_COMPANY_INCORRECT_ERROR = 2005;
    const REGISTRATION_FIRST_NAME_INCORRECT_ERROR = 2006;
    const REGISTRATION_PHONE_INCORRECT_ERROR = 2007;
    const REGISTRATION_SMS_CODE_INCORRECT_ERROR = 2008;
    const REGISTRATION_EMAIL_INCORRECT_ERROR = 2009;
    const REGISTRATION_LARGE_PASSWORD_ERROR = 2010;
    const REGISTRATION_LAST_NAME_INCORRECT_ERROR = 2011;
    const REGISTRATION_MID_NAME_INCORRECT_ERROR = 2012;
    const REGISTRATION_EMPTY_PARAMETER_ERROR = 2013;
    const REGISTRATION_EMAIL_IS_EXIST_ERROR = 2014;
    const REGISTRATION_PHONE_IS_EXIST_ERROR = 2015;

    private $socialNets;
    private $response = [];
    private $errors = [];

    public function __construct()
    {
        parent::__construct();
        $this->socialNets = new SocialNets('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }

    public function login($login, $password)
    {
        $login = trim($login);
        $login = str_replace(' ', '', $login);

        if (v::email()->validate($login)) {
            $query = $this->db->prepare("SELECT * FROM users WHERE email = :login");
        } elseif (v::phone()->validate($login)) {
            $query = $this->db->prepare("SELECT * FROM users WHERE phone_number = :login");
            $login = $this->extractPhoneNumber($login);
        } else {
            $this->errors[] = [
                'code'    => self::LOGIN_VALIDATION_ERROR,
                'message' => 'Неверный формат логина',
            ];

            return false;
        }

        $query->execute([':login' => $login]);
        $user = $query->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                if (!$user['banned']) {
                    $secret_key = Registry::get('config')['secret_key'];

                    $_SESSION['authorized'] = true;
                    $_SESSION['user'] = $user;

                    // TODO: Удалить в будущем
                    $_SESSION['userID'] = $user['id'];
                    $_SESSION['firstName'] = $user['first_name'];
                    $_SESSION['lastName'] = $user['last_name'];
                    $_SESSION['status'] = $user['status'];

                    $_SESSION['user_hash'] = hash('sha512', 'user_id=' . $user['id'] . 'secret_key=' . $secret_key);

                    // TODO: Реализовать функицю не используя чужого API
                    $this->activityWrite($user['id']);
                    $this->response = true;

                    return true;
                }

                $this->errors[] = [
                    'code'    => self::LOGIN_BANNED_ERROR,
                    'message' => 'Аккаунт заблокирован',
                ];

                return false;
            }
        }

        $this->errors[] = [
            'code'    => self::LOGIN_OR_PASSWORD_INCORRECT_ERROR,
            'message' => 'Пользователь не существует или была допущена ошибка при вводе логина и пароля',
        ];

        return false;
    }

    public function getOnline($period)
    {
        switch ($period) {
            case 'now':
                $query = $this->db->prepare("SELECT count(session_id) FROM visitors_statistic WHERE last_activity BETWEEN (now() - ('5 min')::interval)::time AND now()::time AND date = now()::date");
                $query->execute();
                $result = $query->fetch();

                if ($result) {
                    $this->response = [
                        'count' => (int)$result['count'],
                    ];
                }
                break;
            case 'day':
                $query = $this->db->prepare("SELECT DISTINCT ON (session_id) * FROM visitors_statistic WHERE t_stamp BETWEEN (now()-('1 day')::interval) AND now()");
                $query->execute();
                $result = $query->fetchAll();

                if ($result) {
                    $data = [];
                    $interval = 8640; // Секунд (2.4 часа)
                    $begin_time = mktime(date("H") - 23, date("i") - 59, date("s") - 59);

                    for ($i = 0; $i < 10; $i++) {
                        $end = $begin_time + $interval;
                        $count = 0;

                        foreach ($result as $item) {
                            $visit_time = strtotime($item['t_stamp']);

                            if ($visit_time >= $begin_time && $visit_time <= $end) {
                                $count++;
                            }
                        }

                        array_push($data, $count);

                        $begin_time = $end;
                    }

                    $this->response = [
                        'count' => count($result),
                        'data'  => $data,
                    ];
                }
                break;
            case 'week':
                $query = $this->db->prepare("SELECT DISTINCT ON (session_id) * FROM visitors_statistic WHERE t_stamp BETWEEN (now()-('1 week')::interval) AND now()");
                $query->execute();
                $result = $query->fetchAll();

                if ($result) {
                    $data = [];
                    $interval = 60480; // Секунд (16.8 часа, неделя / 10)
                    $begin_time = mktime(date("H"), date("i"), date("s"), date("n"), date("j") - 7);

                    for ($i = 0; $i < 10; $i++) {
                        $end = $begin_time + $interval;
                        $count = 0;

                        foreach ($result as $item) {
                            $visit_time = strtotime($item['t_stamp']);

                            if ($visit_time >= $begin_time && $visit_time <= $end) {
                                $count++;
                            }
                        }

                        array_push($data, $count);

                        $begin_time = $end;
                    }

                    $this->response = [
                        'count' => count($result),
                        'data'  => $data,
                    ];
                }
                break;
            case 'month':
                $query = $this->db->prepare("SELECT DISTINCT ON (session_id) * FROM visitors_statistic WHERE t_stamp BETWEEN (now()-('1 month')::interval) AND now()");
                $query->execute();
                $result = $query->fetchAll();

                $data = [];
                $interval = 259200; // Секунд (3 дня, месяц / 10)
                $begin_time = mktime(date("H"), date("i"), date("s"), date("n") - 1);

                for ($i = 0; $i < 10; $i++) {
                    $end = $begin_time + $interval;
                    $count = 0;

                    foreach ($result as $item) {
                        $visit_time = strtotime($item['t_stamp']);

                        if ($visit_time >= $begin_time && $visit_time <= $end) {
                            $count++;
                        }
                    }

                    array_push($data, $count);

                    $begin_time = $end;
                }

                if ($result) {
                    $this->response = [
                        'count' => count($result),
                        'data'  => $data,
                    ];
                }
                break;
        }
    }

    public function getRegistered($period)
    {
        switch ($period) {
            case 'now':
                $query = $this->db->prepare("SELECT COUNT(*) FROM users");
                $query->execute();
                $result = $query->fetch();

                if ($result) {
                    $this->response = [
                        'count' => (int)$result['count'],
                    ];
                }
                break;
            case 'day':
                $query = $this->db->prepare("SELECT DISTINCT ON (id) * FROM users WHERE registration_timestamp BETWEEN (now()-('1 day')::interval) AND now()");
                $query->execute();
                $result = $query->fetchAll();

                if ($result) {
                    $data = [];
                    $interval = 8640; // Секунд (2.4 часа)
                    $begin_time = mktime(date("H") - 23, date("i") - 59, date("s") - 59);

                    for ($i = 0; $i < 10; $i++) {
                        $end = $begin_time + $interval;
                        $count = 0;

                        foreach ($result as $item) {
                            $visit_time = strtotime($item['registration_timestamp']);

                            if ($visit_time >= $begin_time && $visit_time <= $end) {
                                $count++;
                            }
                        }

                        array_push($data, $count);

                        $begin_time = $end;
                    }

                    $this->response = [
                        'count' => count($result),
                        'data'  => $data,
                    ];
                }
                break;
            case 'week':
                $query = $this->db->prepare("SELECT DISTINCT ON (id) * FROM users WHERE registration_timestamp BETWEEN (now()-('1 week')::interval) AND now()");
                $query->execute();
                $result = $query->fetchAll();

                if ($result) {
                    $data = [];
                    $interval = 60480; // Секунд (16.8 часа, неделя / 10)
                    $begin_time = mktime(date("H"), date("i"), date("s"), date("n"), date("j") - 7);

                    for ($i = 0; $i < 10; $i++) {
                        $end = $begin_time + $interval;
                        $count = 0;

                        foreach ($result as $item) {
                            $visit_time = strtotime($item['registration_timestamp']);

                            if ($visit_time >= $begin_time && $visit_time <= $end) {
                                $count++;
                            }
                        }

                        array_push($data, $count);

                        $begin_time = $end;
                    }

                    $this->response = [
                        'count' => count($result),
                        'data'  => $data,
                    ];
                }
                break;
            case 'month':
                $query = $this->db->prepare("SELECT DISTINCT ON (id) * FROM users WHERE registration_timestamp BETWEEN (now()-('1 month')::interval) AND now()");
                $query->execute();
                $result = $query->fetchAll();

                $data = [];
                $interval = 259200; // Секунд (3 дня, месяц / 10)
                $begin_time = mktime(date("H"), date("i"), date("s"), date("n") - 1);

                for ($i = 0; $i < 10; $i++) {
                    $end = $begin_time + $interval;
                    $count = 0;

                    foreach ($result as $item) {
                        $visit_time = strtotime($item['registration_timestamp']);

                        if ($visit_time >= $begin_time && $visit_time <= $end) {
                            $count++;
                        }
                    }

                    array_push($data, $count);

                    $begin_time = $end;
                }

                if ($result) {
                    $this->response = [
                        'count' => count($result),
                        'data'  => $data,
                    ];
                }
                break;
        }
    }

    public function getAdsNumber($period)
    {
        if (isset($_GET['city'])) {
            switch ($period) {
                case 'all':
                    $query = $this->db->prepare("SELECT COUNT(*) FROM news_base WHERE city = :city");
                    $query->execute([':city' => $_GET['city']]);
                    $result = $query->fetch();

                    if ($result) {
                        $this->response = [
                            'count' => (int)$result['count'],
                        ];
                    }
                    break;
                case 'day':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 day')::interval) AND now() AND city = :city");
                    $query->execute([':city' => $_GET['city']]);
                    $result = $query->fetchAll();

                    if ($result) {
                        $data = [];
                        $interval = 8640; // Секунд (2.4 часа)
                        $begin_time = mktime(date("H") - 23, date("i") - 59, date("s") - 59);

                        for ($i = 0; $i < 10; $i++) {
                            $end = $begin_time + $interval;
                            $count = 0;

                            foreach ($result as $item) {
                                $visit_time = strtotime($item['date']);

                                if ($visit_time >= $begin_time && $visit_time <= $end) {
                                    $count++;
                                }
                            }

                            array_push($data, $count);

                            $begin_time = $end;
                        }

                        $this->response = [
                            'count' => count($result),
                            'data' => $data,
                        ];
                    }
                    break;
                case 'week':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 week')::interval) AND now() AND city = :city");
                    $query->execute([':city' => $_GET['city']]);
                    $result = $query->fetchAll();

                    if ($result) {
                        $data = [];
                        $interval = 60480; // Секунд (16.8 часа, неделя / 10)
                        $begin_time = mktime(date("H"), date("i"), date("s"), date("n"), date("j") - 7);

                        for ($i = 0; $i < 10; $i++) {
                            $end = $begin_time + $interval;
                            $count = 0;

                            foreach ($result as $item) {
                                $visit_time = strtotime($item['date']);

                                if ($visit_time >= $begin_time && $visit_time <= $end) {
                                    $count++;
                                }
                            }

                            array_push($data, $count);

                            $begin_time = $end;
                        }

                        $this->response = [
                            'count' => count($result),
                            'data' => $data,
                        ];
                    }
                    break;
                case 'month':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 month')::interval) AND now() AND city = :city");
                    $query->execute([':city' => $_GET['city']]);
                    $result = $query->fetchAll();

                    $data = [];
                    $interval = 259200; // Секунд (3 дня, месяц / 10)
                    $begin_time = mktime(date("H"), date("i"), date("s"), date("n") - 1);

                    for ($i = 0; $i < 10; $i++) {
                        $end = $begin_time + $interval;
                        $count = 0;

                        foreach ($result as $item) {
                            $visit_time = strtotime($item['date']);

                            if ($visit_time >= $begin_time && $visit_time <= $end) {
                                $count++;
                            }
                        }

                        array_push($data, $count);

                        $begin_time = $end;
                    }

                    if ($result) {
                        $this->response = [
                            'count' => count($result),
                            'data' => $data,
                        ];
                    }
                    break;
            }
        }
    }

    public function getAdsActiveNumber($period)
    {
        if (isset($_GET['city'])) {
            switch ($period) {
                case 'day':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 day')::interval) AND now() AND status > 0 AND city = :city");
                    $query->execute([':city' => $_GET['city']]);
                    $result = $query->fetchAll();

                    if ($result) {
                        $data = [];
                        $interval = 8640; // Секунд (2.4 часа)
                        $begin_time = mktime(date("H") - 23, date("i") - 59, date("s") - 59);

                        for ($i = 0; $i < 10; $i++) {
                            $end = $begin_time + $interval;
                            $count = 0;

                            foreach ($result as $item) {
                                $visit_time = strtotime($item['date']);

                                if ($visit_time >= $begin_time && $visit_time <= $end) {
                                    $count++;
                                }
                            }

                            array_push($data, $count);

                            $begin_time = $end;
                        }

                        $this->response = [
                            'count' => count($result),
                            'data'  => $data,
                        ];
                    }
                    break;
                case 'week':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 week')::interval) AND now() AND status > 0 AND city = :city");
                    $query->execute([':city' => $_GET['city']]);
                    $result = $query->fetchAll();

                    if ($result) {
                        $data = [];
                        $interval = 60480; // Секунд (16.8 часа, неделя / 10)
                        $begin_time = mktime(date("H"), date("i"), date("s"), date("n"), date("j") - 7);

                        for ($i = 0; $i < 10; $i++) {
                            $end = $begin_time + $interval;
                            $count = 0;

                            foreach ($result as $item) {
                                $visit_time = strtotime($item['date']);

                                if ($visit_time >= $begin_time && $visit_time <= $end) {
                                    $count++;
                                }
                            }

                            array_push($data, $count);

                            $begin_time = $end;
                        }

                        $this->response = [
                            'count' => count($result),
                            'data'  => $data,
                        ];
                    }
                    break;
                case 'month':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 month')::interval) AND now() AND status > 0 AND city = :city");
                    $query->execute([':city' => $_GET['city']]);
                    $result = $query->fetchAll();

                    $data = [];
                    $interval = 259200; // Секунд (3 дня, месяц / 10)
                    $begin_time = mktime(date("H"), date("i"), date("s"), date("n") - 1);

                    for ($i = 0; $i < 10; $i++) {
                        $end = $begin_time + $interval;
                        $count = 0;

                        foreach ($result as $item) {
                            $visit_time = strtotime($item['date']);

                            if ($visit_time >= $begin_time && $visit_time <= $end) {
                                $count++;
                            }
                        }

                        array_push($data, $count);

                        $begin_time = $end;
                    }

                    if ($result) {
                        $this->response = [
                            'count' => count($result),
                            'data'  => $data,
                        ];
                    }
                    break;
            }
        }
    }

    public function doRegistration()
    {
        $errors = $this->checkDataErrors();
        if (!$errors) {
            return $this->saveUserData();
        } else {
            return $errors;
        }
    }

    /**
     * @return array|bool
     */
    private function checkDataErrors()
    {
        $errors = [];

        if (!empty($_SESSION['OAuth_state'])) {
            $email = $_POST['email'];
            $phone = $this->extractPhoneNumber($_POST['phone']);
            $password = $_POST['password'];

            $email_errors = $this->checkEmail($email);
            $phone_errors = $this->checkPhone($phone);
            $password_errors = $this->checkPassword($password);

            if ($email_errors) {
                $errors['email'] = $email_errors;
            }

            if ($phone_errors) {
                $errors['phone'] = $phone_errors;
            }

            if ($password_errors) {
                $errors['password'] = $password_errors;
            }
        } else {
            $email = $_POST['email'];
            $first_name = $_POST['firstName'];
            $last_name = $_POST['lastName'];
            $patronymic = $_POST['patronymic'];
            $birthday = $_POST['birthday'];
            $phone = $this->extractPhoneNumber($_POST['phoneNumber']);
            $password = $_POST['password'];

            $errors['first_name'] = $this->checkFirstName($first_name);
            $errors['last_name'] = $this->checkLastName($last_name);
            $errors['patronymic'] = $this->checkPatronymic($patronymic);
            $errors['email'] = $this->checkEmail($email);
            $errors['birthday'] = $this->checkBirthday($birthday);
            $errors['phone'] = $this->checkPhone($phone);
            $errors['password'] = $this->checkPassword($password);
        }

        return $errors['first_name'] || $errors['last_name'] || $errors['patronymic'] || $errors['email'] || $errors['birthday'] || $errors['phone'] || $errors['password'] ? $errors : false;
    }

    private function checkFirstName($first_name)
    {
        $errors = [];

        if ($first_name == '') {
            $errors[] = 'Вы должны указать имя.';
        }

        return !empty($errors) ? $errors : false;
    }

    private function checkLastName($last_name)
    {
        $errors = [];

        if ($last_name == '') {
            $errors[] = 'Вы должны указать фамилию.';
        }

        return !empty($errors) ? $errors : false;
    }

    private function checkPatronymic($patronymic)
    {
        $errors = [];

        if ($patronymic == '') {
            $errors[] = 'Вы должны указать отчество.';
        }

        return !empty($errors) ? $errors : false;
    }

    private function checkBirthday($birthday)
    {
        $errors = [];

        if ($birthday == '') {
            $errors[] = 'Укажите дату рождения.';
        }

        return !empty($errors) ? $errors : false;
    }

    private function checkPhone($phone)
    {
        $errors = [];

        if ($phone == '') {
            $errors[] = 'Телефон не может быть пустым.';
        }

        return !empty($errors) ? $errors : false;
    }

    private function checkEmail($email)
    {
        $errors = [];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $result = $stmt->fetch();

            if ($result) {
                $errors[] = 'Такой E-mail уже зарегистрирован.';
            }
        } else {
            $errors[] = 'Укажите корректный E-mail.';
        }

        return !empty($errors) ? $errors : false;
    }

    private function checkPassword($password)
    {
        $errors = [];

        if ($password == '') {
            $errors[] = 'Вы не указали пароль.';
        }

        return !empty($errors) ? $errors : false;
    }

    public function activityWrite($userID)
    {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($user_agent, "Firefox") !== false) {
            $browser = "Firefox";
        } elseif (strpos($user_agent, "Opera") !== false) {
            $browser = "Opera";
        } elseif (strpos($user_agent, "Chrome") !== false) {
            $browser = "Chrome";
        } elseif (strpos($user_agent, "MSIE") !== false) {
            $browser = "Internet Explorer";
        } elseif (strpos($user_agent, "Safari") !== false) {
            $browser = "Safari";
        } else $browser = "Неизвестный";

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $stmt = $this->db->prepare("SELECT active_text FROM users WHERE id = {$userID}");
        $stmt->execute();
        $info = $stmt->fetchAll();

        $found_match = "Unknown";
        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, 'http://www.ip2location.com/demo?ip=' . $ip);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "ipaddress=$ip");
            $out = curl_exec($curl);
            $matches = [];
            preg_match_all("~td.*</td>~i", $out, $matches);
            $found_match = $matches[0][4];
            preg_match_all("~>.*<~i", $found_match, $matches);
            $found_match = $matches[0][0];
            $found_match = ltrim($found_match, ">");
            $found_match = rtrim($found_match, "<");
            preg_match("~flags/.*.png~", $found_match, $flag_country);
            $found_match = preg_replace("~\/images\/flags~", "http://www.ip2location.com/images/flags", $found_match);
            curl_close($curl);
        }

        $geo = $found_match;
        $str_for_active = $browser . "," . date('d F \в H:i:s e') . "," . $ip . "," . $geo . ";";
        $str_for_active = $str_for_active . $info[0]['active_text'];
        $str_for_active = trim($str_for_active, ';');
        $query = $this->db->prepare("UPDATE users SET active_text = :active WHERE id = :id");
        $query->execute(
            [
                ":active" => $str_for_active,
                ":id"     => $userID,
            ]
        );

        $device = new Detection\MobileDetect();
        $device_name = 'PC';

        if ($device->isiPhone()) {
            $device_name = 'Iphone';
        }
        if ($device->isBlackBerry()) {
            $device_name = 'BlackBerry';
        }
        if ($device->isHTC()) {
            $device_name = 'HTC';
        }
        if ($device->isNexus()) {
            $device_name = 'Nexus';
        }
        if ($device->isMotorola()) {
            $device_name = 'Motorola';
        }
        if ($device->isSamsung()) {
            $device_name = 'Samsung';
        }
        if ($device->isSony()) {
            $device_name = 'Sony';
        }
        if ($device->isAsus()) {
            $device_name = 'Asus';
        }
        if ($device->isPalm()) {
            $device_name = 'Palm';
        }
        if ($device->isGenericPhone()) {
            $device_name = 'GenericPhone';
        }
        if ($device->isBlackBerryTablet()) {
            $device_name = 'BlackBerryTablet';
        }
        if ($device->isiPad()) {
            $device_name = 'iPad';
        }
        if ($device->isKindle()) {
            $device_name = 'Kindle';
        }
        if ($device->isSamsungTablet()) {
            $device_name = 'SamsungTablet';
        }
        if ($device->isHTCtablet()) {
            $device_name = 'HTCtablet';
        }
        if ($device->isMotorolaTablet()) {
            $device_name = 'MotorolaTablet';
        }
        if ($device->isAsusTablet()) {
            $device_name = 'AsusTablet';
        }
        if ($device->isNookTablet()) {
            $device_name = 'NookTablet';
        }
        if ($device->isAcerTablet()) {
            $device_name = 'AcerTablet';
        }
        if ($device->isYarvikTablet()) {
            $device_name = 'YarvikTablet';
        }
        if ($device->isGenericTablet()) {
            $device_name = 'GenericTablet';
        }

        $stmt = $this->db->prepare("SELECT name_session FROM sessions WHERE id_user = {$userID}");
        $stmt->execute();

        $info = $stmt->fetchAll();

        if (!isset($info[0])) {
            $name_session = session_id();
            $stmt = $this->db->prepare("INSERT INTO sessions (name_session, id_user, device_name) VALUES (:name_session, :id_user, :device_name)");
            $stmt->bindParam(':name_session', $name_session);
            $stmt->bindParam(':id_user', $userID);
            $stmt->bindParam(':device_name', $device_name);
            $stmt->execute();
        } else {
            $i_max = 0;
            $massiv = [];
            foreach ($info as $value) {
                $i_max++;
            }
            for ($i = 0; $i < $i_max; $i++) {
                $massiv[$i] = $info[$i];
            }
            $flag_exist = 0;
            $name_session = session_id();

            foreach ($massiv as $value)
                if (session_id() == $value) {
                    $flag_exist = 1;
                }

            if ($flag_exist == 0) {
                $stmt = $this->db->prepare("INSERT INTO sessions (name_session, id_user, device_name) VALUES (:name_session, :id_user, :device_name)");
                $stmt->bindParam(':name_session', $name_session);
                $stmt->bindParam(':id_user', $userID);
                $stmt->bindParam(':device_name', $device_name);
                $stmt->execute();
            }
        }
    }

    public function saveUserData()
    {
        if (!empty($_SESSION['OAuth_state']) && $_SESSION['OAuth_state'] == 2) {
            $email = trim($_POST['email']);
            $first_name = trim($_SESSION['OAuth_first_name']);
            $last_name = trim($_SESSION['OAuth_last_name']);
            $avatar = $_SESSION['OAuth_avatar'];
            $phone_number = trim($_POST['phone']);
            $password = $_POST['password'];
            $service_id = $_SESSION['OAuth_user_id'];

            $name = $first_name . ' ' . $last_name;

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query = '';

            switch ($_SESSION['OAuth_service']) {
                case 'vk':
                    $query = $this->db->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password, vk_id, vk_name, vk_avatar) VALUES (:firstName, :lastName, :phoneNumber, :email, :password, :serviceID, :serviceName, :serviceAvatar)");
                    break;
                case 'ok':
                    $query = $this->db->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password, ok_id, ok_name, ok_avatar) VALUES (:firstName, :lastName, :phoneNumber, :email, :password, :serviceID, :serviceName, :serviceAvatar)");
                    break;
                case 'mail':
                    $query = $this->db->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password, mail_id, mail_name, mail_avatar) VALUES (:firstName, :lastName, :phoneNumber, :email, :password, :serviceID, :serviceName, :serviceAvatar)");
                    break;
                case 'ya':
                    $query = $this->db->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password, ya_id, ya_name, ya_avatar) VALUES (:firstName, :lastName, :phoneNumber, :email, :password, :serviceID, :serviceName, :serviceAvatar)");
                    break;
                case 'google':
                    $query = $this->db->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password, google_id, google_name, google_avatar) VALUES (:firstName, :lastName, :phoneNumber, :email, :password, :serviceID, :serviceName, :serviceAvatar)");
                    break;
                case 'fb':
                    $query = $this->db->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password, facebook_id, facebook_name, facebook_avatar) VALUES (:firstName, :lastName, :phoneNumber, :email, :password, :serviceID, :serviceName, :serviceAvatar)");
                    break;
                case 'steam':
                    $query = $this->db->prepare("INSERT INTO users (first_name, last_name, phone_number, email, password, steam_id, steam_name, steam_avatar) VALUES (:firstName, :lastName, :phoneNumber, :email, :password, :serviceID, :serviceName, :serviceAvatar)");
                    break;
            }

            $query->execute(
                [
                    ':firstName'     => $first_name,
                    ':lastName'      => $last_name,
                    ':phoneNumber'   => $phone_number,
                    ':email'         => $email,
                    ':password'      => $password_hash,
                    ':serviceID'     => $service_id,
                    ':serviceName'   => $name,
                    ':serviceAvatar' => $avatar,
                ]
            );

            if ($query->rowCount()) {
                $this->clearOAuth();

                return ['result' => true];
            }
        } else {
            $email = trim($_POST['email']);
            $first_name = trim($_POST['firstName']);
            $last_name = trim($_POST['lastName']);
            $patronymic = trim($_POST['patronymic']);
            $birthday = $_POST['birthday'];
            $phone_number = trim($_POST['phoneNumber']);
            $password = $_POST['password'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $query = $this->db->prepare("INSERT INTO users (first_name, last_name, patronymic, birthday, phone_number, email, password) VALUES (:firstName, :lastName, :patronymic, :birthday, :phoneNumber, :email, :password)");
            $query->execute(
                [
                    ':firstName'   => $first_name,
                    ':lastName'    => $last_name,
                    ':patronymic'  => $patronymic,
                    ':birthday'    => $birthday,
                    ':phoneNumber' => $phone_number,
                    ':email'       => $email,
                    ':password'    => $password_hash,
                ]
            );

            if ($query->rowCount()) {
                return ['result' => true];
            }
        }

        return false;
    }

    private function extractPhoneNumber($phone)
    {
        $phone = trim($phone);
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        $phone = str_replace('-', '', $phone);
        $phone = str_replace('+', '', $phone);

        return $phone;
    }

    public function getOAuthData($data)
    {
        $this->socialNets->setState(isset($_GET['state']) ? $_GET['state'] : $data[1]); // Если в GET запросе присутствует параметр "state", тогда используем его

        switch ($data[0]) {
            case 'vk':
                $this->socialNets->vk();
                break;
            case 'ok':
                $this->socialNets->ok();
                break;
            case 'mail':
                $this->socialNets->mail();
                break;
            case 'ya':
                $this->socialNets->ya();
                break;
            case 'google':
                $this->socialNets->google();
                break;
            case 'fb':
                $this->socialNets->fb();
                break;
            case 'steam':
                $this->socialNets->steam();
                break;
        }
    }

    public function OAuthLogin($service, $id)
    {
        $services = [
            'vk'     => 'vk_id',
            'ok'     => 'ok_id',
            'mail'   => 'mail_id',
            'ya'     => 'ya_id',
            'google' => 'google_id',
            'fb'     => 'facebook_id',
            'steam'  => 'steam_id',
        ];

        // TODO: Убрать после удаления методов из DataBase::class
        $user = $this->db->select('*')->from('users')->where($services[$service], '=', trim($id))->execute();

        $this->clearOAuth();

        if ($user) {
            $secret_key = Registry::get('config')['secret_key'];

            $_SESSION['authorized'] = true;
            $_SESSION['user'] = $user;

            // TODO: Удалить в будущем
            $_SESSION['userID'] = $user['id'];
            $_SESSION['firstName'] = $user['first_name'];
            $_SESSION['lastName'] = $user['last_name'];
            $_SESSION['status'] = $user['status'];

            //$_SESSION['user_hash'] = hash('sha512', 'user_id=' . $userID . 'secret_key=' . $secret_key);

            // TODO: Реализовать функицю не используя чужого API
            //$this->activityWrite($userID);

            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet');
            exit;
        }
    }

    public function getUserIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    //Новая регистрация
    public function setUserType($type)
    {
        if (empty($type)) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMPTY_PARAMETER_ERROR,
                'message' => 'Пустой параметр в запросе',
            ];

            return;
        }

        if ($type == 'boss' || $type == 'user') {
            $_SESSION['registration']['user_type'] = $type;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_USER_TYPE_INCORRECT_ERROR,
                'message' => 'Неправильный тип пользователя',
            ];
        }
    }

    public function setDocumentType($type)
    {
        if (empty($type)) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMPTY_PARAMETER_ERROR,
                'message' => 'Пустой параметр в запросе',
            ];

            return;
        }

        if ($type == 'inn' || $type == 'ogrn') {
            $_SESSION['registration']['document_type'] = $type;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_DOCUMENT_TYPE_INCORRECT_ERROR,
                'message' => 'Неправильный тип документа',
            ];
        }
    }

    public function setDocumentNumber($document)
    {
        if (empty($document)) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMPTY_PARAMETER_ERROR,
                'message' => 'Пустой параметр в запросе',
            ];

            return;
        }

        if ($_SESSION['registration']['document_type'] == 'inn') {
            if (v::numeric()->validate($document)) {
                $_SESSION['registration']['document_number'] = $document;
                $this->response = true;
            } else {
                $this->errors[] = [
                    'code'    => self::REGISTRATION_INN_INCORRECT_ERROR,
                    'message' => 'Неправильный формат ИНН',
                ];
            }
        } elseif ($_SESSION['registration']['document_type'] == 'ogrn') {
            if ($this->checkOGRN($document)) {
                $_SESSION['registration']['document_number'] = $document;
                $this->response = true;
            } else {
                $this->errors[] = [
                    'code'    => self::REGISTRATION_OGRN_INCORRECT_ERROR,
                    'message' => 'Неправильный формат ОГРН',
                ];
            }
        }
    }

    private function checkOGRN($ogrn)
    {
        if (!is_numeric($ogrn)) {
            return false;
        }

        $ogrn = $ogrn . '';

        if (strlen($ogrn) == 13 and $ogrn[12] != substr((substr($ogrn, 0, -1) % 11), -1)) {
            return false;
        } elseif (strlen($ogrn) == 15 and $ogrn[14] != substr(substr($ogrn, 0, -1) % 13, -1)) {
            return false;
        } elseif (strlen($ogrn) != 13 and strlen($ogrn) != 15) {
            return false;
        }

        return true;
    }

    public function setCompanyData($brandName, $companyName)
    {
        if (empty($brandName) || empty($companyName)) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMPTY_PARAMETER_ERROR,
                'message' => 'Пустой параметр в запросе',
            ];

            return;
        }

        if (v::regex('/^[а-яА-ЯёЁa-zA-Z0-9]+$/')->validate($brandName)) {
            $_SESSION['registration']['brand_name'] = $brandName;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_BRAND_INCORRECT_ERROR,
                'message' => 'Неправильный указано название бренда',
            ];
        }

        if (v::regex('/^[а-яА-ЯёЁa-zA-Z0-9]+$/')->validate($companyName)) {
            $_SESSION['registration']['company_name'] = $companyName;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_COMPANY_INCORRECT_ERROR,
                'message' => 'Неправильный указано название компании',
            ];
        }
    }

    public function setFirstName($firstName)
    {
        if (empty($firstName)) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMPTY_PARAMETER_ERROR,
                'message' => 'Пустой параметр в запросе',
            ];

            return;
        }

        if (v::regex('/^[а-яА-ЯёЁa-zA-Z]+$/')->validate($firstName)) {
            $_SESSION['registration']['first_name'] = ucfirst($firstName);
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_FIRST_NAME_INCORRECT_ERROR,
                'message' => 'Неправильный указано имя',
            ];
        }
    }

    public function setPhone($phone)
    {
        if (empty($phone)) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMPTY_PARAMETER_ERROR,
                'message' => 'Пустой параметр в запросе',
            ];

            return;
        }

        $stmt = $this->db->prepare("SELECT * FROM users WHERE phone_number = :phone");
        $stmt->execute([':phone' => $phone]);
        $exist = $stmt->fetch();

        if ($exist) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_PHONE_IS_EXIST_ERROR,
                'message' => 'Такой телефон уже зарегистрирован',
            ];

            return;
        }

        if (v::phone()->validate($phone)) {
            $_SESSION['registration']['phone'] = $phone;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_PHONE_INCORRECT_ERROR,
                'message' => 'Допущена ошибка при вооде телефона',
            ];
        }
    }

    public function verifySMSCode($code)
    {
        $_SESSION['registration']['code'] = $code;
        $this->response = true;
        //        $this->errors[] = [
        //            'code'    => self::REGISTRATION_SMS_CODE_INCORRECT_ERROR,
        //            'message' => 'Неправильный код из СМС',
        //        ];
    }

    public function setEmail($email)
    {
        if (empty($email)) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMPTY_PARAMETER_ERROR,
                'message' => 'Пустой параметр в запросе',
            ];

            return;
        }

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $exist = $stmt->fetch();

        if ($exist) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMAIL_IS_EXIST_ERROR,
                'message' => 'Такой Email уже зарегистрирован',
            ];

            return;
        }

        if (v::email()->validate($email)) {
            $_SESSION['registration']['email'] = $email;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMAIL_INCORRECT_ERROR,
                'message' => 'Неверный формат Email',
            ];
        }
    }

    public function setPassword($password)
    {
        if (empty($password)) {
            $this->errors[] = [
                'code'    => self::REGISTRATION_EMPTY_PARAMETER_ERROR,
                'message' => 'Пустой параметр в запросе',
            ];

            return;
        }

        if (strlen($password) <= 24) {
            $_SESSION['registration']['password'] = $password;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_LARGE_PASSWORD_ERROR,
                'message' => 'Длина пароля не должна привышать 24 символа',
            ];
        }
    }

    public function setLastName($lastName)
    {
        if (v::regex('/^[а-яА-ЯёЁa-zA-Z]+$/')->validate($lastName)) {
            $_SESSION['registration']['last_name'] = $lastName;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_LAST_NAME_INCORRECT_ERROR,
                'message' => 'Неправильный указана фамилия',
            ];
        }
    }

    public function setMidName($midName)
    {
        if (v::regex('/^[а-яА-ЯёЁa-zA-Z]+$/')->validate($midName)) {
            $_SESSION['registration']['mid_name'] = $midName;
            $this->response = true;
        } else {
            $this->errors[] = [
                'code'    => self::REGISTRATION_MID_NAME_INCORRECT_ERROR,
                'message' => 'Неправильный указано отчество',
            ];
        }
    }

    public function summaries()
    {
        if (isset($_SESSION['user'])) {
            $name = $_SESSION['user']['status'] == 0 ? $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] : $_SESSION['user']['brand_name'];
            $this->response = [
                'id'              => $_SESSION['user']['id'],
                'avatar_original' => $_SESSION['user']['avatar_original'],
                'avatar_50'       => $_SESSION['user']['avatar_50'],
                'avatar_100'      => $_SESSION['user']['avatar_100'],
                'name'            => $name,
                'email'           => $_SESSION['user']['email'],
                'status'          => $_SESSION['user']['status'],
                'hash'            => $_SESSION['user_hash'],
            ];
        }
    }

    public function setSummaries()
    {
        if (isset($_POST['name'])) {
            $query = $this->db->prepare('UPDATE users SET first_name = :first_name WHERE id = :user_id');
            $query->execute(
                [
                    ':first_name' => $_POST['name'],
                    ':user_id'    => $_SESSION['user']['id'],
                ]
            );
        }

        if (isset($_POST['surname'])) {
            $query = $this->db->prepare('UPDATE users SET last_name = :last_name WHERE id = :user_id');
            $query->execute(
                [
                    ':last_name' => $_POST['surname'],
                    ':user_id'   => $_SESSION['user']['id'],
                ]
            );
        }

        if (isset($_POST['midname'])) {
            $query = $this->db->prepare('UPDATE users SET patronymic = :midname WHERE id = :user_id');
            $query->execute(
                [
                    ':midname' => $_POST['midname'],
                    ':user_id' => $_SESSION['user']['id'],
                ]
            );
        }

        if (isset($_POST['brand'])) {
            $query = $this->db->prepare('UPDATE users SET brand_name = :brand_name WHERE id = :user_id');
            $query->execute(
                [
                    ':brand_name' => $_POST['brand'],
                    ':user_id'    => $_SESSION['user']['id'],
                ]
            );
        }

        if (isset($_POST['company'])) {
            $query = $this->db->prepare('UPDATE users SET company_name = :company_name WHERE id = :user_id');
            $query->execute(
                [
                    ':company_name' => $_POST['company'],
                    ':user_id'      => $_SESSION['user']['id'],
                ]
            );
        }
    }

    public function registration()
    {
        $sql = 'INSERT INTO users ({%columns%}) VALUES ({%values%}) RETURNING *';
        $datetime = date("Y-m-d H:i:s");
        $columns = "registration_timestamp";
        $values = "{$datetime}";

        $user_type = [
            'user' => 0,
            'boss' => 2,
        ];

        if (isset($_SESSION['registration']['user_type'])) {
            $type = $_SESSION['registration']['user_type'];
            $columns .= ",status";
            $values .= ",{$user_type[$type]}";
        }

        if (isset($_SESSION['registration']['document_type'])) {
            $columns .= ",document_type";
            $values .= ",'{$_SESSION['registration']['document_type']}'";
        }

        if (isset($_SESSION['registration']['document_number'])) {
            $columns .= ",document_number";
            $values .= ",'{$_SESSION['registration']['document_number']}'";
        }

        if (isset($_SESSION['registration']['brand_name'])) {
            $columns .= ",brand_name";
            $values .= ",'{$_SESSION['registration']['brand_name']}'";
        }

        if (isset($_SESSION['registration']['company_name'])) {
            $columns .= ",company_name";
            $values .= ",'{$_SESSION['registration']['company_name']}'";
        }

        if (isset($_SESSION['registration']['first_name'])) {
            $columns .= ",first_name";
            $values .= ",'{$_SESSION['registration']['first_name']}'";
        }

        if (isset($_SESSION['registration']['phone'])) {
            $columns .= ",phone_number";
            $phone = $this->extractPhoneNumber($_SESSION['registration']['phone']);
            $values .= ",{$phone}";
        }

        if (isset($_SESSION['registration']['email'])) {
            $columns .= ",email";
            $values .= ",'{$_SESSION['registration']['email']}'";
        }

        if (isset($_SESSION['registration']['password'])) {
            $columns .= ",password";
            $password_hash = password_hash($_SESSION['registration']['password'], PASSWORD_DEFAULT);
            $values .= ",'{$password_hash}'";
        }

        if (isset($_SESSION['registration']['last_name'])) {
            $columns .= ",last_name";
            $values .= ",'{$_SESSION['registration']['last_name']}'";
        }

        if (isset($_SESSION['registration']['mid_name'])) {
            $columns .= ",patronymic";
            $values .= ",'{$_SESSION['registration']['mid_name']}'";
        }

        if (isset($_SESSION['registration']['photo'])) {
            $columns .= ",profile_foto_id";
            $values .= ",'{$_SESSION['registration']['photo']}'";
        }

        pg_escape_string($values);

        $sql = str_replace('{%columns%}', $columns, $sql);
        $sql = str_replace('{%values%}', $values, $sql);

        $query = $this->db->query($sql);

        if ($this->db->errorCode() == '00000') {
            $user = $query->fetch();
            unset($user['password']);
            unset($_SESSION['registration']);

            $_SESSION['authorized'] = true;

            // TODO: Удалить в будущем
            $_SESSION['userID'] = $user['id'];
            $_SESSION['firstName'] = $user['first_name'];
            $_SESSION['lastName'] = $user['last_name'];
            $_SESSION['status'] = $user['status'];

            $name = $user['status'] == 0 ? $user['first_name'] . ' ' . $user['last_name'] : $user['brand_name'];

            $secret_key = Registry::get('config')['secret_key'];
            $_SESSION['user_hash'] = hash('sha512', 'user_id=' . $user['id'] . 'secret_key=' . $secret_key);
            $this->response = [
                'id'              => $user['id'],
                'avatar_original' => $user['avatar_original'],
                'avatar_50'       => $user['avatar_50'],
                'avatar_100'      => $user['avatar_100'],
                'name'            => $name,
                'email'           => $user['email'],
                'status'          => $user['status'],
                'hash'            => $_SESSION['user_hash'],
            ];
        }
        // TODO: Дописать обработку ошибки если пользователь не был записан в базу
    }

    public function getUserInfo()
    {
        if (isset($_SESSION['user'])) {
            // Необходимо переименовать поле в базе данных
            $_SESSION['user']['photo'] = $_SESSION['user']['profile_foto_id'];
            $this->response = [
                'id'     => $_SESSION['user']['id'],
                'photo'  => $_SESSION['user']['photo'],
                'name'   => $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'],
                'email'  => $_SESSION['user']['email'],
                'status' => $_SESSION['user']['status'],
                'hash'   => $_SESSION['user_hash'],
            ];
        } else {
            $this->response = [
                'id'     => session_id(),
                'status' => -1,
                'hash'   => hash('sha512', 'user_id=' . session_id() . 'secret_key=' . Registry::get('config')['secret_key']),
            ];
        }
    }

    public function logout()
    {
        unset($_SESSION['authorized']);
        unset($_SESSION['userID']);
        unset($_SESSION['status']);
        unset($_SESSION['user']);
        unset($_SESSION['firstName']);
        unset($_SESSION['lastName']);
        unset($_SESSION['user_hash']);

        $this->response = true;
    }

    public function getResponse()
    {
        if (empty($this->errors) && empty($this->response)) {
            return [
                'error' => [
                    [
                        'code'    => 0,
                        'message' => 'Неправильный запрос',
                    ],
                ],
            ];
        }

        if ($this->errors) {
            return [
                'error' => $this->errors,
            ];
        } else {
            return [
                'response' => $this->response,
            ];
        }
    }
}