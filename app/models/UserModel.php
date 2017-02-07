<?php

class UserModel extends Model
{
    private $socialNets;

    public function __construct()
    {
        $this->db = new DataBase;
        $this->socialNets = new SocialNets(self::getUserID());
    }

    public function ajaxHandler()
    {

    }

    public function doLogin()
    {
        $data = $this->getUserData($_POST['login'], $_POST['password']);

        if ($data) {
            $this->atLogin($data['userID'], $data['status']);
        } else {
            $errors = '<span style="color: red;">Вы указали неверные сведения или пользователь не существует.</span><br>';

            return $errors;
        }

        return false;
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
                );
            }
        }

        return false;
    }

    private function atLogin($userID, $userStatus)
    {
        $_SESSION['authorized'] = true;
        $_SESSION['userID'] = $userID;
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
    }

    public function doRegistration()
    {
        $errors = $this->getDataErrors();
        if (!$errors) {
            $this->saveUserData();
        } else {
            return $errors;
        }

        return false;
    }

    private function getDataErrors()
    {
        $errors = [];
        $email = $_POST['email'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $patronymic = $_POST['patronymic'];
        $birthday = $_POST['birthday'];
        $phoneNumber = $this->extractPhoneNumber($_POST['phoneNumber']);;
        $password = $_POST['password'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $result = $stmt->fetch();

            if ($result) {
                $errors['email'][] = 'Такой E-mail уже зарегистрирован.';
            }
        } else {
            $errors['email'][] = 'Укажите корректный E-mail.';
        }

        if ($firstName == '') {
            $errors['firstName'][] = 'Укажите имя.';
        }

        if ($lastName == '') {
            $errors['lastName'][] = 'Укажите фамилию.';
        }

        if ($patronymic == '') {
            $errors['patronymic'][] = 'Укажите отчество.';
        }

        if ($birthday == '') {
            $errors['birthday'][] = 'Укажите дату рождения.';
        }

        if ($phoneNumber == '') {
            $errors['phoneNumber'][] = 'Укажите телефон.';
        }

        if ($password == '') {
            $errors['password'][] = 'Вы не указали пароль.';
        }

        return $errors;
    }

    public function saveUserData()
    {
        $email = $_POST['email'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $patronymic = $_POST['patronymic'];
        $birthday = $_POST['birthday'];
        $phoneNumber = $_POST['phoneNumber'];
        $password = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $vk_userID = (isset($_SESSION['vk_userID']) && !empty($_SESSION['vk_userID'])) ? $_SESSION['vk_userID'] : null;
        $ok_userID = (isset($_SESSION['ok_userID']) && !empty($_SESSION['ok_userID'])) ? $_SESSION['ok_userID'] : null;
        $mail_userID = (isset($_SESSION['mail_userID']) && !empty($_SESSION['mail_userID'])) ? $_SESSION['mail_userID'] : null;
        $ya_userID = (isset($_SESSION['ya_userID']) && !empty($_SESSION['ya_userID'])) ? $_SESSION['ya_userID'] : null;
        $goo_userID = (isset($_SESSION['goo_userID']) && !empty($_SESSION['goo_userID'])) ? $_SESSION['goo_userID'] : null;
        $steam_userID = (isset($_SESSION['steam_userID']) && !empty($_SESSION['steam_userID'])) ? $_SESSION['steam_userID'] : null;

        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, patronymic, birthday, phone_number, email, password, vk_id, ok_id, mail_id, ya_id, google_id, steam_id) VALUES (:firstName, :lastName, :patronymic, :birthday, :phoneNumber, :email, :password, :vk_userID, :ok_userID, :mail_userID, :ya_userID, :google_userID, :steam_userID)");
        $stmt->execute([
            ':firstName' => $firstName,
            ':lastName' => $lastName,
            ':patronymic' => $patronymic,
            ':birthday' => $birthday,
            ':phoneNumber' => $phoneNumber,
            ':email' => $email,
            ':password' => $passwordHash,
            ':vk_userID' => $vk_userID,
            ':ok_userID' => $ok_userID,
            ':mail_userID' => $mail_userID,
            ':ya_userID' => $ya_userID,
            ':google_userID' => $goo_userID,
            ':steam_userID' => $steam_userID,
        ]);

        print_r($stmt->errorInfo());
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

    public function getOAuthData($service)
    {
        if (isset($_SERVER['HTTP_REFERER'])) {
            $_SESSION['redirectURL'] = $_SERVER['HTTP_REFERER'];
        }

        if (isset($service) && !empty($service)) {
            $this->socialNets->getServiceData($service[0]);

            $url = $this->handleOAuthUrl();

            header('Location: ' . $url);
            exit;
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
            exit;
        }
    }

    public function destroyOAuthData($service)
    {
        if (isset($service) && !empty($service)) {
            $this->socialNets->destroyServiceData($service[0]);
        } else {
            $this->socialNets->destroyServiceData();
        }
    }

    private function getDataByOAuthUserID($service, $id)
    {
        $services = array(
            'vk' => 'vk_id',
            'ok' => 'ok_id',
            'mail' => 'mail_id',
            'ya' => 'ya_id',
            'goo' => 'google_id',
            'steam' => 'steam_id',
        );

        $query = $this->db->prepare("SELECT * FROM users WHERE " . $services[$service] . " = :id");
        $query->execute([':id' => trim($id)]);
        $result = $query->fetch();


        if ($result) {
            return $result;
        }

        return false;
    }

    private function handleOAuthUrl()
    {
        $path = parse_url($_SESSION['redirectURL'], PHP_URL_PATH);
        $path = trim($path, '/');
        $url = $_SESSION['redirectURL'];

        if ($path == 'registration') {
            unset($_SESSION['redirectURL']);
        }

        return $url;
    }

    public function loginThroughOAuth()
    {
        if (isset($_SESSION['services']['vk'])) {
            echo 'Я есть Вконтакте!';
            $data = $this->getDataByOAuthUserID('vk', $_SESSION['vk_userID']);
            $this->destroyOAuthData('vk');
            unset($_SESSION['redirectURL']);
            if ($data) {
                $this->atLogin($data['id'], $data['status']);
            }
        } elseif (isset($_SESSION['services']['ok'])) {
            $data = $this->getDataByOAuthUserID('ok', $_SESSION['ok_userID']);
            $this->destroyOAuthData('ok');
            unset($_SESSION['redirectURL']);
            if ($data) {
                $this->atLogin($data['id'], $data['status']);
            }
        } elseif (isset($_SESSION['services']['mail'])) {
            $data = $this->getDataByOAuthUserID('mail', $_SESSION['mail_userID']);
            $this->destroyOAuthData('mail');
            unset($_SESSION['redirectURL']);
            if ($data) {
                $this->atLogin($data['id'], $data['status']);
            }
        } elseif (isset($_SESSION['services']['ya'])) {
            $data = $this->getDataByOAuthUserID('ya', $_SESSION['ya_userID']);
            $this->destroyOAuthData('ya');
            unset($_SESSION['redirectURL']);
            if ($data) {
                $this->atLogin($data['id'], $data['status']);
            }
        } elseif (isset($_SESSION['services']['goo'])) {
            $data = $this->getDataByOAuthUserID('goo', $_SESSION['goo_userID']);
            $this->destroyOAuthData('goo');
            unset($_SESSION['redirectURL']);
            if ($data) {
                $this->atLogin($data['id'], $data['status']);
            }
        } elseif (isset($_SESSION['services']['fb'])) {
            $data = $this->getDataByOAuthUserID('fb', $_SESSION['fb_userID']);
            $this->destroyOAuthData('fb');
            unset($_SESSION['redirectURL']);
            if ($data) {
                $this->atLogin($data['id'], $data['status']);
            }
        } elseif (isset($_SESSION['services']['steam'])) {
            $data = $this->getDataByOAuthUserID('steam', $_SESSION['steam_userID']);
            $this->destroyOAuthData('steam');
            unset($_SESSION['redirectURL']);
            if ($data) {
                $this->atLogin($data['id'], $data['status']);
            }
        }
        $this->destroyOAuthData(null);
    }

    private function getUserID()
    {
        return (isset($_SESSION['userID']) && !empty($_SESSION['userID'])) ? $_SESSION['userID'] : null;
    }
}