<?php

class UserModel extends Model {
    public function __construct() {
        $this->db = new DataBase;
    }

    public function ajaxHandler() {

    }

    public function checkUserInformation() {
        $data = array(
            'info' => array()
        );

        if (!$this->checkEmailValidationErrors($_POST['email'])) {
            $data['info'][] = '- Укажите корректный E-mail.';
        }
        if ($this->checkEmailAvailability($_POST['email'])) {
            $data['info'][] = '- Такой E-mail уже зарегистрирован.';
        }
        if ($_POST['firstName'] == '') {
            $data['info'][] = '- Укажите имя.';
        }
        if ($_POST['lastName'] == '') {
            $data['info'][] = '- Укажите фамилию.';
        }
        if ($_POST['birthday'] == '') {
            $data['info'][] = '- Укажите дату рождения.';
        }
        if ($_POST['phoneNumber'] == '') {
            $data['info'][] = '- Укажите телефон.';
        }
        if ($_POST['password'] == '') {
            $data['info'][] = '- Вы не указали пароль.';
        }
        return $data;
    }

    private function checkEmailValidationErrors($email) {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    private function checkEmailAvailability($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function registerUser() {
        $vk_userID = (isset($_SESSION['vk_userID']) && !empty($_SESSION['vk_userID'])) ? $_SESSION['vk_userID'] : null;
        $ok_userID = (isset($_SESSION['ok_userID']) && !empty($_SESSION['ok_userID'])) ? $_SESSION['ok_userID'] : null;
        $mail_userID = (isset($_SESSION['mail_userID']) && !empty($_SESSION['mail_userID'])) ? $_SESSION['mail_userID'] : null;
        $ya_userID = (isset($_SESSION['ya_userID']) && !empty($_SESSION['ya_userID'])) ? $_SESSION['ya_userID'] : null;
        $goo_userID = (isset($_SESSION['goo_userID']) && !empty($_SESSION['goo_userID'])) ? $_SESSION['goo_userID'] : null;
        $steam_userID = (isset($_SESSION['steam_userID']) && !empty($_SESSION['steam_userID'])) ? $_SESSION['steam_userID'] : null;

        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, patronymic, birthday, phone_number, email, password, vk_id, ok_id, mail_id, ya_id, google_id, steam_id) VALUES (:firstName, :lastName, :patronymic, :birthday, :phoneNumber, :email, :password, :vk_userID, :ok_userID, :mail_userID, :ya_userID, :google_userID, :steam_userID)");
        $stmt->bindParam(':firstName', $_POST['firstName']);
        $stmt->bindParam(':lastName', $_POST['lastName']);
        $stmt->bindParam(':patronymic', $_POST['patronymic']);
        $stmt->bindParam(':birthday', $_POST['birthday']);
        $stmt->bindParam(':phoneNumber', trim($_POST['phoneNumber'], '+'));
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':vk_userID', $vk_userID);
        $stmt->bindParam(':ok_userID', $ok_userID);
        $stmt->bindParam(':mail_userID', $mail_userID);
        $stmt->bindParam(':ya_userID', $ya_userID);
        $stmt->bindParam(':google_userID', $goo_userID);
        $stmt->bindParam(':steam_userID', $steam_userID);
        $stmt->execute();
        print_r($stmt->errorInfo());
    }

    public function userVerify() {
        if (filter_var($_POST['login'], FILTER_VALIDATE_EMAIL)) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $_POST['login']);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE phone_number = :phone");
            $stmt->bindParam(':phone', trim($_POST['login'], '+'));
        }
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $_SESSION['userID'] = $result['id'];
            return password_verify($_POST['password'], $result['password']);
        }

        return false;
    }
}