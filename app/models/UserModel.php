<?php

class UserModel extends Model
{
    
    private $socialAuth;
    
    public function __construct()
    {
        $this->db         = new DataBase;
        $this->socialAuth = new SocialAuth(self::getUserID());
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
    
    public function doRegistration()
    {
        $errors = $this->getDataErrors();
        if (!$errors) {
            $this->recordUserData();
        } else {
            return $errors;
        }
        
        return false;
    }
    
    private function getDataErrors()
    {
        $errors      = [];
        $email       = $_POST['email'];
        $firstName   = $_POST['firstName'];
        $lastName    = $_POST['lastName'];
        $patronymic  = $_POST['patronymic'];
        $birthday    = $_POST['birthday'];
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
    
    public function recordUserData()
    {
        $email        = $_POST['email'];
        $firstName    = $_POST['firstName'];
        $lastName     = $_POST['lastName'];
        $patronymic   = $_POST['patronymic'];
        $birthday     = $_POST['birthday'];
        $phoneNumber  = $_POST['phoneNumber'];
        $password     = $_POST['password'];
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        $vk_userID    = (isset($_SESSION['vk_userID']) && !empty($_SESSION['vk_userID'])) ? $_SESSION['vk_userID'] : null;
        $ok_userID    = (isset($_SESSION['ok_userID']) && !empty($_SESSION['ok_userID'])) ? $_SESSION['ok_userID'] : null;
        $mail_userID  = (isset($_SESSION['mail_userID']) && !empty($_SESSION['mail_userID'])) ? $_SESSION['mail_userID'] : null;
        $ya_userID    = (isset($_SESSION['ya_userID']) && !empty($_SESSION['ya_userID'])) ? $_SESSION['ya_userID'] : null;
        $goo_userID   = (isset($_SESSION['goo_userID']) && !empty($_SESSION['goo_userID'])) ? $_SESSION['goo_userID'] : null;
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
        $_SESSION['redirectURL'] = $_SERVER['HTTP_REFERER'];
        
        if (isset($service) && !empty($service)) {
            $this->socialAuth->getServiceData($service[0]);
            
            header('Location: ' . $_SESSION['redirectURL']);
            exit;
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
            exit;
        }
    }
    
    public function destroyOAuthData($service)
    {
        if (isset($service) && !empty($service)) {
            $this->socialAuth->destroyServiceData($service[0]);
        } else {
            $this->socialAuth->destroyServiceData();
        }
    }
    
    private function getUserID()
    {
        return (isset($_SESSION['userID']) && !empty($_SESSION['userID'])) ? $_SESSION['userID'] : null;
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
    
    public function choiceAction()
    {
        $path = parse_url($_SESSION['redirectURL'], PHP_URL_PATH);
        
        switch ($path) {
            case 'login':
                foreach ($_SESSION['services'] as $service => $value) {
                    switch ($service) {
                        case 'vk':
                            $data = $this->getDataByOAuthUserID('vk', $_SESSION['vk_userID']);
                            if ($data) {
                                $this->atLogin($data['id'], $data['status']);
                            }
                            $this->destroyOAuthData($service);
                            break;
                        case 'ok':
                            $data = $this->getDataByOAuthUserID('ok', $_SESSION['ok_userID']);
                            if ($data) {
                                $this->atLogin($data['id'], $data['status']);
                            }
                            $this->destroyOAuthData($service);
                            break;
                        case 'mail':
                            $data = $this->getDataByOAuthUserID('mail', $_SESSION['mail_userID']);
                            if ($data) {
                                $this->atLogin($data['id'], $data['status']);
                            }
                            $this->destroyOAuthData($service);
                            break;
                        case 'ya':
                            $data = $this->getDataByOAuthUserID('ya', $_SESSION['ya_userID']);
                            if ($data) {
                                $this->atLogin($data['id'], $data['status']);
                            }
                            $this->destroyOAuthData($service);
                            break;
                        case 'goo':
                            $data = $this->getDataByOAuthUserID('goo', $_SESSION['goo_userID']);
                            if ($data) {
                                $this->atLogin($data['id'], $data['status']);
                            }
                            $this->destroyOAuthData($service);
                            break;
                        case 'fb':
                            $data = $this->getDataByOAuthUserID('fb', $_SESSION['fb_userID']);
                            if ($data) {
                                $this->atLogin($data['id'], $data['status']);
                            }
                            $this->destroyOAuthData($service);
                            break;
                        case 'steam':
                            $data = $this->getDataByOAuthUserID('steam', $_SESSION['steam_userID']);
                            if ($data) {
                                $this->atLogin($data['id'], $data['status']);
                            }
                            $this->destroyOAuthData($service);
                            break;
                    }
                }
                break;
            case 'registration':
                break;
            default:
                // TODO: Придумать действие когда URL не подходит
        }
    }
    
    
    private function atLogin($userID, $userStatus)
    {
        $_SESSION['authorized']    = true;
        $_SESSION['userID']        = $userID;
        $_SESSION['accountStatus'] = $userStatus;
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet');
        exit;
    }
}