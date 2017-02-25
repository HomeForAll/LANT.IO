<?php

class UserModel extends Model
{
    use Cleaner;

    private $socialNets;

    public function __construct()
    {
        $this->db = new DataBase;
        $this->socialNets = new SocialNets('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    }

    public function doLogin()
    {
        $data = $this->getUserData($_POST['login'], $_POST['password']);

        if ($data) {
            $this->atLogin($data['userID'], $data['status'], $data['personaName']);
        } else {
            $errors = '<span style="color: red;">Вы указали неверные сведения или пользователь не существует.</span><br>';

            return $errors;
        }

        return false;
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

        return !empty($errors) ? $errors : false;
    }

    private function checkFirstName($first_name)
    {
        $errors = array();

        if ($first_name == '') {
            $errors[] = 'Вы должны указать имя.';
        }
        return !empty($errors) ? $errors : false;
    }

    private function checkLastName($last_name)
    {
        $errors = array();

        if ($last_name == '') {
            $errors[] = 'Вы должны указать фамилию.';
        }

        return !empty($errors) ? $errors : false;
    }

    private function checkPatronymic($patronymic)
    {
        $errors = array();

        if ($patronymic == '') {
            $errors[] = 'Вы должны указать отчество.';
        }
        return !empty($errors) ? $errors : false;

    }

    private function checkBirthday($birthday)
    {
        $errors = array();

        if ($birthday == '') {
            $errors[] = 'Укажите дату рождения.';
        }
        return !empty($errors) ? $errors : false;
    }

    private function checkPhone($phone)
    {
        $errors = array();

        if ($phone == '') {
            $errors[] = 'Телефон не может быть пустым.';
        }
        return !empty($errors) ? $errors : false;
    }

    private function checkEmail($email)
    {
        $errors = array();

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
        $errors = array();

        if ($password == '') {
            $errors['password'][] = 'Вы не указали пароль.';
        }

        return !empty($errors) ? $errors : false;
    }

    private function getUserData($login, $password)
    {
        $login = trim($login);
        $login = str_replace(' ', '', $login);

        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $query = $this->db->prepare("SELECT * FROM users WHERE email = :login");
        } else {
            $query = $this->db->prepare("SELECT * FROM users WHERE phone_number = :login");
            $login = $this->extractPhoneNumber($login);
        }

        $query->execute(array(':login' => $login));
        $result = $query->fetch();

        if ($result) {
            if (password_verify($password, $result['password'])) {
                return array(
                    'userID' => $result['id'],
                    'status' => $result['status'],
                    'personaName' => $result['first_name'] . ' ' . $result['last_name']
                );
            }
        }

        return false;
    }

    private function atLogin($userID, $userStatus, $personaName)
    {
        $secret_key = 'secret';

        $_SESSION['authorized'] = true;
        $_SESSION['userID'] = $userID;
        $_SESSION['personaName'] = $personaName;
        $_SESSION['user_hash'] = hash('sha512', 'user_id=' . $userID . 'secret_key=' . $secret_key);
        $this->activityWrite($userID);
        $_SESSION['status'] = $userStatus;
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet');
        exit;
    }

    public function activityWrite($userID)
    {
        $user_agent = $_SERVER["HTTP_USER_AGENT"];
        if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
        elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
        elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
        elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
        elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
        else $browser = "Неизвестный";

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
            $matches = array();
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
        $str_for_active = $str_for_active . $info[0][0];
        $str_for_active = trim($str_for_active, ';');
        $query = $this->db->prepare("UPDATE users SET active_text = :active WHERE id = :id");
        $query->execute(array(":active" => $str_for_active, ":id" => $userID));

        $device = new Detection\MobileDetect();
        $device_name = 'PC';

        if ($device->isiPhone() ) {
            $device_name = 'Iphone';
        }
        if ($device->isBlackBerry() ) {
            $device_name = 'BlackBerry';
        }
        if ($device->isHTC() ) {
            $device_name = 'HTC';
        }
        if ($device->isNexus() ) {
            $device_name = 'Nexus';
        }
        if ($device->isMotorola() ) {
            $device_name = 'Motorola';
        }
        if ($device->isSamsung() ) {
            $device_name = 'Samsung';
        }
        if ($device->isSony() ) {
            $device_name = 'Sony';
        }
        if ($device->isAsus() ) {
            $device_name = 'Asus';
        }
        if ($device->isPalm() ) {
            $device_name = 'Palm';
        }
        if ($device->isGenericPhone() ) {
            $device_name = 'GenericPhone';
        }
        if ($device->isBlackBerryTablet() ) {
            $device_name = 'BlackBerryTablet';
        }
        if ($device->isiPad() ) {
            $device_name = 'iPad';
        }
        if ($device->isKindle() ) {
            $device_name = 'Kindle';
        }
        if ($device->isSamsungTablet() ) {
            $device_name = 'SamsungTablet';
        }
        if ($device->isHTCtablet() ) {
            $device_name = 'HTCtablet';
        }
        if ($device->isMotorolaTablet() ) {
            $device_name = 'MotorolaTablet';
        }
        if ($device->isAsusTablet() ) {
            $device_name = 'AsusTablet';
        }
        if ($device->isNookTablet() ) {
            $device_name = 'NookTablet';
        }
        if ($device->isAcerTablet() ) {
            $device_name = 'AcerTablet';
        }
        if ($device->isYarvikTablet() ) {
            $device_name = 'YarvikTablet';
        }
        if ($device->isGenericTablet() ) {
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
        }
        else
        {
            $i_max = 0;
            $massiv = [];
            foreach ($info as $value) {
                $i_max++;
            }
            for ($i = 0; $i < $i_max; $i++) {
                $massiv[$i] = $info[$i][0];
            }
            $flag_exist = 0;
            $name_session = session_id();

            foreach ($massiv as $value)
                if (session_id() == $value)
                    $flag_exist = 1;

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

            $query->execute([
                ':firstName' => $first_name,
                ':lastName' => $last_name,
                ':phoneNumber' => $phone_number,
                ':email' => $email,
                ':password' => $password_hash,
                ':serviceID' => $service_id,
                ':serviceName' => $name,
                ':serviceAvatar' => $avatar,
            ]);

            if ($query->rowCount()) {
                $this->clearOAuth();
                return array('result' => true);
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
            $query->execute([
                ':firstName' => $first_name,
                ':lastName' => $last_name,
                ':patronymic' => $patronymic,
                ':birthday' => $birthday,
                ':phoneNumber' => $phone_number,
                ':email' => $email,
                ':password' => $password_hash,
            ]);

            if ($query->rowCount()) {
                return array('result' => true);
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
        $services = array(
            'vk' => 'vk_id',
            'ok' => 'ok_id',
            'mail' => 'mail_id',
            'ya' => 'ya_id',
            'google' => 'google_id',
            'fb' => 'facebook_id',
            'steam' => 'steam_id',
        );

        $result = $this->db->select('*')->from('users')->where($services[$service], '=', trim($id))->execute();

        $this->clearOAuth();

        if ($result) {
            $this->atLogin($result[0]['id'], $result[0]['status'], $result[0]['first_name'] . ' ' . $result[0]['last_name']);
        }
    }
}