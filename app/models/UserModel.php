<?php
use Respect\Validation\Validator as v;

class UserModel extends Model
{
    use Cleaner;

    private $socialNets;

    public function __construct()
    {
        parent::__construct();
        $this->socialNets = new SocialNets('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }

    public function login($login, $password)
    {
        $login = trim($login);
        $login = str_replace(' ', '', $login);
        $query = '';

        if (v::email()->validate($login)) {
            $query = $this->db->prepare("SELECT * FROM users WHERE email = :login");
        } elseif (v::phone()->validate($login)) {
            $query = $this->db->prepare("SELECT * FROM users WHERE phone_number = :login");
            $login = preg_replace('~[^\d]+~', '', $login);
        } else {
            $this->error(self::LOGIN_INCORRECT_ERROR);
        }

        $query->execute([':login' => $login]);

        if ($query->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
        }

        $user = $query->fetch();

        if ($user) {
            if ($user['banned']) {
                $this->error(self::USER_BANNED_ERROR);
            }

            if (password_verify($password, $user['password'])) {
                $secret_key = Registry::get('config')['secret_key'];

                $_SESSION['authorized'] = true;

                unset($user['password']);
                $_SESSION['user'] = $user;

                // TODO: Удалить в будущем
                $_SESSION['userID'] = $user['id'];
                $_SESSION['firstName'] = $user['first_name'];
                $_SESSION['lastName'] = $user['last_name'];
                $_SESSION['status'] = $user['status'];

                $_SESSION['user_hash'] = hash('sha512', 'user_id=' . $user['id'] . 'secret_key=' . $secret_key);

                // TODO: Реализовать функицю не используя чужого API
                $this->activityWrite($user['id']);

                $this->response(true);
            }

            $this->error(self::INCORRECT_AUTH_DATA_ERROR);
        }

        $this->error(self::USER_NOT_EXIST_ERROR);
    }

    public function getOnline($period)
    {
        switch ($period) {
            case 'now':
                $query = $this->db->prepare("SELECT count(session_id) FROM visitors_statistic WHERE last_activity BETWEEN (now() - ('5 min')::interval)::time AND now()::time AND date = now()::date");
                $query->execute();

                if ($query->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                }

                $result = $query->fetch();

                if ($result) {
                    $this->response(['count' => (int)$result['count']]);
                } else {
                    $this->response(['count' => 0]);
                }
                break;
            case 'day':
                $query = $this->db->prepare("SELECT DISTINCT ON (session_id) * FROM visitors_statistic WHERE t_stamp BETWEEN (now()-('1 day')::interval) AND now()");
                $query->execute();

                if ($query->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                }

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

                    $this->response([
                        'count' => count($result),
                        'data'  => $data,
                    ]);
                } else {
                    $this->response([
                        'count' => 0,
                        'data'  => [],
                    ]);
                }
                break;
            case 'week':
                $query = $this->db->prepare("SELECT DISTINCT ON (session_id) * FROM visitors_statistic WHERE t_stamp BETWEEN (now()-('1 week')::interval) AND now()");
                $query->execute();

                if ($query->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                }

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

                    $this->response([
                        'count' => count($result),
                        'data'  => $data,
                    ]);
                } else {
                    $this->response([
                        'count' => 0,
                        'data'  => [],
                    ]);
                }
                break;
            case 'month':
                $query = $this->db->prepare("SELECT DISTINCT ON (session_id) * FROM visitors_statistic WHERE t_stamp BETWEEN (now()-('1 month')::interval) AND now()");
                $query->execute();

                if ($query->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                }

                $result = $query->fetchAll();

                if ($result) {
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

                    $this->response([
                        'count' => count($result),
                        'data'  => $data,
                    ]);
                } else {
                    $this->response([
                        'count' => 0,
                        'data'  => [],
                    ]);
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

                if ($query->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                }

                $result = $query->fetch();

                if ($result) {
                    $this->response([
                        'count' => (int)$result['count'],
                    ]);
                } else {
                    $this->response([
                        'count' => 0,
                    ]);
                }
                break;
            case 'day':
                $query = $this->db->prepare("SELECT DISTINCT ON (id) * FROM users WHERE registration_timestamp BETWEEN (now()-('1 day')::interval) AND now()");
                $query->execute();

                if ($query->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                }

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

                    $this->response([
                        'count' => count($result),
                        'data'  => $data,
                    ]);
                } else {
                    $this->response([
                        'count' => 0,
                        'data'  => [],
                    ]);
                }
                break;
            case 'week':
                $query = $this->db->prepare("SELECT DISTINCT ON (id) * FROM users WHERE registration_timestamp BETWEEN (now()-('1 week')::interval) AND now()");
                $query->execute();

                if ($query->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                }

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

                    $this->response([
                        'count' => count($result),
                        'data'  => $data,
                    ]);
                } else {
                    $this->response([
                        'count' => 0,
                        'data'  => [],
                    ]);
                }
                break;
            case 'month':
                $query = $this->db->prepare("SELECT DISTINCT ON (id) * FROM users WHERE registration_timestamp BETWEEN (now()-('1 month')::interval) AND now()");
                $query->execute();

                if ($query->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                }

                $result = $query->fetchAll();

                if ($result) {
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

                    $this->response([
                        'count' => count($result),
                        'data'  => $data,
                    ]);
                } else {
                    $this->response([
                        'count' => 0,
                        'data'  => [],
                    ]);
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

                    if ($query->errorCode() != '00000') {
                        $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                    }

                    $result = $query->fetch();

                    if ($result) {
                        $this->response([
                            'count' => (int)$result['count'],
                        ]);
                    } else {
                        $this->response([
                            'count' => 0,
                        ]);
                    }
                    break;
                case 'day':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 day')::interval) AND now() AND city = :city");
                    $query->execute([':city' => $_GET['city']]);

                    if ($query->errorCode() != '00000') {
                        $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                    }

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

                        $this->response([
                            'count' => count($result),
                            'data'  => $data,
                        ]);
                    } else {
                        $this->response([
                            'count' => 0,
                            'data'  => [],
                        ]);
                    }
                    break;
                case 'week':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 week')::interval) AND now() AND city = :city");
                    $query->execute([':city' => $_GET['city']]);

                    if ($query->errorCode() != '00000') {
                        $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                    }

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

                        $this->response([
                            'count' => count($result),
                            'data'  => $data,
                        ]);
                    } else {
                        $this->response([
                            'count' => 0,
                            'data'  => [],
                        ]);
                    }
                    break;
                case 'month':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 month')::interval) AND now() AND city = :city");
                    $query->execute([':city' => $_GET['city']]);

                    if ($query->errorCode() != '00000') {
                        $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                    }

                    $result = $query->fetchAll();

                    if ($result) {
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

                        $this->response([
                            'count' => count($result),
                            'data'  => $data,
                        ]);
                    } else {
                        $this->response([
                            'count' => 0,
                            'data'  => [],
                        ]);
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

                    if ($query->errorCode() != '00000') {
                        $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                    }

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

                        $this->response([
                            'count' => count($result),
                            'data'  => $data,
                        ]);
                    } else {
                        $this->response([
                            'count' => 0,
                            'data'  => [],
                        ]);
                    }
                    break;
                case 'week':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 week')::interval) AND now() AND status > 0 AND city = :city");
                    $query->execute([':city' => $_GET['city']]);

                    if ($query->errorCode() != '00000') {
                        $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                    }

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

                        $this->response([
                            'count' => count($result),
                            'data'  => $data,
                        ]);
                    } else {
                        $this->response([
                            'count' => 0,
                            'data'  => [],
                        ]);
                    }
                    break;
                case 'month':
                    $query = $this->db->prepare("SELECT * FROM news_base WHERE date BETWEEN (now()-('1 month')::interval) AND now() AND status > 0 AND city = :city");
                    $query->execute([':city' => $_GET['city']]);

                    if ($query->errorCode() != '00000') {
                        $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                    }

                    $result = $query->fetchAll();

                    if ($result) {
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

                        $this->response([
                            'count' => count($result),
                            'data'  => $data,
                        ]);
                    } else {
                        $this->response([
                            'count' => 0,
                            'data'  => [],
                        ]);
                    }
                    break;
            }
        }
    }

    public function getTrans()
    {
        $this->response([
            'count' => 0,
            'data'  => [],
        ]);
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
        // if ($curl = curl_init()) {
        //     curl_setopt($curl, CURLOPT_URL, 'http://www.ip2location.com/demo?ip=' . $ip);
        //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($curl, CURLOPT_POST, true);
        //     curl_setopt($curl, CURLOPT_POSTFIELDS, "ipaddress=$ip");
        //     $out = curl_exec($curl);
        //     $matches = [];
        //     preg_match_all("~td.*</td>~i", $out, $matches);
        //     $found_match = $matches[0][4];
        //     preg_match_all("~>.*<~i", $found_match, $matches);
        //     $found_match = $matches[0][0];
        //     $found_match = ltrim($found_match, ">");
        //     $found_match = rtrim($found_match, "<");
        //     preg_match("~flags/.*.png~", $found_match, $flag_country);
        //     $found_match = preg_replace("~\/images\/flags~", "http://www.ip2location.com/images/flags", $found_match);
        //     curl_close($curl);
        // }

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

    // TODO: после дорабтки социальных сетей удалить
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
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if ($type !== 'boss' || $type !== 'user') {
            $this->error(self::USER_TYPE_INCORRECT_ERROR);
        }

        $_SESSION['registration']['user_type'] = $type;
        $this->response(true);
    }

    public function setDocumentType($type)
    {
        if (empty($type)) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if ($type !== 'inn' || $type !== 'ogrn') {
            $this->error(self::DOCUMENT_TYPE_INCORRECT_ERROR);
        }

        $_SESSION['registration']['document_type'] = $type;
        $this->response(true);
    }

    public function setDocumentNumber()
    {
        if (empty($_POST['document_inn']) && empty($_POST['document_ogrn'])) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!empty($_POST['document_inn'])) {
            if (!v::numeric()->validate($_POST['document_inn'])) {
                $this->error(self::INN_INCORRECT_ERROR);
            }

            $_SESSION['registration']['document_number'] = $_POST['document_inn'];
            $this->response(true);
        } elseif (!empty($_POST['document_ogrn'])) {
            if (!v::numeric()->validate($_POST['document_ogrn'])) {
                $this->error(self::OGRN_INCORRECT_ERROR);
            }

            $_SESSION['registration']['document_number'] = $_POST['document_ogrn'];
            $this->response(true);
        }
    }

    public function setCompanyData($brandName, $companyName)
    {
        if (empty($brandName) || empty($companyName)) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!mb_ereg_match("^[а-яА-ЯёЁa-zA-Z]+$", $brandName)) {
            $this->error(self::BRAND_INCORRECT_ERROR);
        }

        $_SESSION['registration']['brand_name'] = $brandName;

        if (!mb_ereg_match("^[а-яА-ЯёЁa-zA-Z]+$", $companyName)) {
            $this->error(self::COMPANY_INCORRECT_ERROR);
        }

        $_SESSION['registration']['company_name'] = $companyName;
        $this->response(true);
    }

    public function setFirstName($firstName)
    {
        if (empty($firstName)) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!mb_ereg_match("^[а-яА-ЯёЁa-zA-Z]+$", $firstName)) {
            $this->error(self::FIRST_NAME_INCORRECT_ERROR);
        }

        $_SESSION['registration']['first_name'] = ucfirst($firstName);
        $this->response(true);
    }

    public function setPhone($phone)
    {
        if (empty($phone)) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        $phone = preg_replace('/[^0-9]+/', '', $phone);

        $stmt = $this->db->prepare("SELECT * FROM users WHERE phone_number = :phone");
        $stmt->execute([':phone' => $phone]);

        if ($stmt->errorCode() !== '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }

        $exist = $stmt->fetch();

        if ($exist) {
            $this->error(self::PHONE_IS_EXIST_ERROR);
        }

        if (!v::phone()->validate($phone)) {
            $this->error(self::PHONE_INCORRECT_ERROR);
        }

        $_SESSION['registration']['phone'] = $phone;

        $code = mt_rand(1, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9);

        $ch = curl_init("https://sms.ru/sms/send");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            "api_id" => Registry::get('config')['sms_api_key'],
            "to"     => $phone, // До 100 штук до раз
            "msg"    => "Ваш код: {$code}",
            "json"   => 1 // Для получения более развернутого ответа от сервера
        ]));

        $body = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($body);

        if ($json) {
            if ($json->status == "OK") {
                foreach ($json->sms as $phone => $data) {
                    if ($data->status !== "OK") { // Сообщение отправлено
                        $this->error(self::SMS_NOT_SENT_ERROR, $data->status_text);
                    }
                }

                $_SESSION['registration']['code'] = $code;
            } else {
                $this->error(self::SMS_API_REQUEST_FAILED_ERROR, $json->status_text);
            }
        } else {
            $this->error(self::CURL_CONNECTION_LOST);
        }

        $this->response(true);
    }

    public function verifySMSCode($code)
    {
        if (!v::numeric()->validate($code) || $_SESSION['registration']['code'] != $code) {
            $this->error(self::SMS_CODE_INCORRECT_ERROR);
        }

        $this->response(true);
    }

    public function setEmail($email)
    {
        if (empty($email)) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);

        if ($stmt->errorCode() !== '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }

        $exist = $stmt->fetch();

        if ($exist) {
            $this->error(self::EMAIL_IS_EXIST_ERROR);
        }

        if (!v::email()->validate($email)) {
            $this->error(self::EMAIL_INCORRECT_ERROR);
        }

        $_SESSION['registration']['email'] = $email;
        $this->response(true);
    }

    public function setPassword($password)
    {
        if (empty($password)) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!(strlen($password) <= 24)) {
            $this->error(self::LARGE_PASSWORD_ERROR);
        }

        $_SESSION['registration']['password'] = $password;
        $this->response(true);
    }

    public function setLastName($lastName)
    {
        if (!v::regex('/^[а-яА-ЯёЁa-zA-Z]+$/')->validate($lastName)) {
            $this->error(self::LAST_NAME_INCORRECT_ERROR);
        }

        $_SESSION['registration']['last_name'] = $lastName;
        $this->response(true);
    }

    public function setMidName($midName)
    {
        if (!v::regex('/^[а-яА-ЯёЁa-zA-Z]+$/')->validate($midName)) {
            $this->error(self::MID_NAME_INCORRECT_ERROR);
        }

        $_SESSION['registration']['mid_name'] = $midName;
        $this->response(true);
    }

    public function summaries()
    {
        if (!isset($_SESSION['user'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        $_GET['extend'] = '0';
        $this->getUserInfo();
    }

    public function setSummaries()
    {
        if (isset($_POST['firname'])) {
            $query = $this->db->prepare('UPDATE users SET first_name = :first_name WHERE id = :user_id');
            $query->execute(
                [
                    ':first_name' => $_POST['firname'],
                    ':user_id'    => $_SESSION['user']['id'],
                ]
            );

            if ($query->errorCode() !== '00000') {
                $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
            }
        }

        if (isset($_POST['surname'])) {
            $query = $this->db->prepare('UPDATE users SET last_name = :last_name WHERE id = :user_id');
            $query->execute(
                [
                    ':last_name' => $_POST['surname'],
                    ':user_id'   => $_SESSION['user']['id'],
                ]
            );

            if ($query->errorCode() !== '00000') {
                $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
            }
        }

        if (isset($_POST['midname'])) {
            $query = $this->db->prepare('UPDATE users SET patronymic = :midname WHERE id = :user_id');
            $query->execute(
                [
                    ':midname' => $_POST['midname'],
                    ':user_id' => $_SESSION['user']['id'],
                ]
            );

            if ($query->errorCode() !== '00000') {
                $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
            }
        }

        if (isset($_POST['brand'])) {
            $query = $this->db->prepare('UPDATE users SET brand_name = :brand_name WHERE id = :user_id');
            $query->execute(
                [
                    ':brand_name' => $_POST['brand'],
                    ':user_id'    => $_SESSION['user']['id'],
                ]
            );

            if ($query->errorCode() !== '00000') {
                $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
            }
        }

        if (isset($_POST['company'])) {
            $query = $this->db->prepare('UPDATE users SET company_name = :company_name WHERE id = :user_id');
            $query->execute(
                [
                    ':company_name' => $_POST['company'],
                    ':user_id'      => $_SESSION['user']['id'],
                ]
            );

            if ($query->errorCode() !== '00000') {
                $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
            }
        }
    }

    public function registration()
    {
        $sql = 'INSERT INTO users ({%columns%}) VALUES ({%values%}) RETURNING *';
        $columns = "registration_timestamp";
        $values = "now()";

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

        if ($this->db->errorCode() !== '00000') {
            $this->error(self::DB_INSERT_ERROR);
        }

        $user = $query->fetch();
        unset($user['password']);
        unset($_SESSION['registration']);

        $_SESSION['authorized'] = true;

        $_SESSION['user'] = $user;
        $_SESSION['user']['photo'] = $_SESSION['user']['profile_foto_id'];

        // TODO: Удалить в будущем
        $_SESSION['userID'] = $user['id'];
        $_SESSION['firstName'] = $user['first_name'];
        $_SESSION['lastName'] = $user['last_name'];
        $_SESSION['status'] = $user['status'];

        $secret_key = Registry::get('config')['secret_key'];
        $_SESSION['user_hash'] = hash('sha512', 'user_id=' . $user['id'] . 'secret_key=' . $secret_key);

        $this->getUserInfo();
    }

    public function getUserInfo($userID = null)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :user_id');

        if ($userID) {
            $query->execute([':user_id' => $userID]);

            if ($query->errorCode() !== '00000') {
                $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
            }

            $user = $query->fetch();
            unset($user['active_text']);
            unset($user['password']);

            $this->response($user);
        }

        if (!isset($_SESSION['user']['id'])) {
            $this->response([
                'id'     => session_id(),
                'status' => -1,
                'hash'   => hash('sha512', 'user_id=' . session_id() . 'secret_key=' . Registry::get('config')['secret_key']),
            ]);
        }

        $query->execute([':user_id' => $_SESSION['user']['id']]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
        }

        $user = $query->fetch();

        unset($user['active_text']);
        unset($user['password']);

        if (isset($_GET['extend']) ? $_GET['extend'] : null == '1') {
            $this->response($user);
        } else {
            $this->response([
                'id'              => $user['id'],
                'avatar_original' => isset($user['avatar_original']) ? $user['avatar_original'] : null,
                'avatar_50'       => isset($user['avatar_50']) ? $user['avatar_50'] : null,
                'avatar_100'      => isset($user['avatar_100']) ? $user['avatar_100'] : null,
                'name'            => $user['first_name'] . ' ' . $user['last_name'],
                'email'           => $user['email'],
                'status'          => $user['status'],
                'hash'            => $_SESSION['user_hash'],
            ]);
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

        $this->response(true);
    }

    public function passwordRestore($step)
    {
        switch ($step) {
            case '1':
                $login = isset($_POST['login']) ? $_POST['login'] : null;

                if (strrpos($login, '@')) {
                    if (!v::email()->validate($login)) {
                        $this->error(self::EMAIL_INCORRECT_ERROR);
                    }

                    $query = $this->db->prepare('SELECT id, password FROM users WHERE email = :email');
                    $query->execute([
                        ':email' => $login,
                    ]);

                    if ($query->errorCode() !== '00000') {
                        $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
                    }

                    $user = $query->fetch();

                    if (!$user) {
                        $this->error(self::USER_NOT_EXIST_ERROR);
                    }

                    $restore_hash = sha1($user['id'] . $user['password'] . time());

                    $query = $this->db->prepare('UPDATE users SET restore_hash = :restore_hash WHERE id = :user_id');
                    $query->execute([
                        ':restore_hash' => $restore_hash,
                        ':user_id'      => $user['id'],
                    ]);

                    if ($query->errorCode() !== '00000') {
                        $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
                    }

                    $restore_url = "https://{$_SERVER['HTTP_HOST']}/restore/{$restore_hash}:{$user['id']}";

                    require_once ROOT_DIR . 'vendor' . DS . 'phpmailer' . DS . 'phpmailer' . DS . 'PHPMailerAutoload.php';

                    $mail = new PHPMailer;
                    $mail->isSMTP();
                    $mail->Host = 'smtp.yandex.ru';
                    $mail->Port = 465;
                    $mail->SMTPSecure = 'ssl';
                    $mail->SMTPAuth = true;
                    $mail->Username = "admin@lant.io";
                    $mail->Password = "ZSH1wb88";
                    $mail->setLanguage('ru');
                    $mail->setFrom('admin@lant.io', 'LANT.IO');
                    $mail->addAddress($login);
                    $mail->Subject = 'Password restore';
                    $mail->msgHTML("Вы воспользовались формой восстановления пароля, перейдите по ссылке: {$restore_url}, что бы продолжить.");

                    if ($mail->send()) {
                        $this->response(['login_type' => 'restore_email']);
                    } else {
                        $this->error(self::EMAIL_MESSAGE_SEND_ERROR, $mail->ErrorInfo);
                    }
                } elseif (v::phone()->validate($login)) {
                    // TODO: Доделать обработку для sms
                } else {
                    $this->error(self::LOGIN_INCORRECT_ERROR);
                }
                break;
            case '2':
                break;
            case '3':
                break;
        }
    }
}
