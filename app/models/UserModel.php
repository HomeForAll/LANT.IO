<?php

class UserModel extends Model {
    public function __construct() {
        parent::__construct();
        $this->db = $this->getPGConnect();
    }

    public function getData() {

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
        $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, patronymic, birthday, phone_number, email, password) VALUES (:firstName, :lastName, :patronymic, :birthday, :phoneNumber, :email, :password)");
        $stmt->bindParam(':firstName', $_POST['firstName']);
        $stmt->bindParam(':lastName', $_POST['lastName']);
        $stmt->bindParam(':patronymic', $_POST['patronymic']);
        $stmt->bindParam(':birthday', $_POST['birthday']);
        $stmt->bindParam(':phoneNumber', $_POST['phoneNumber']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->execute();
        print_r($stmt->errorInfo());
    }

    public function userVerify() {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $_SESSION['userID'] = $result['id'];
            return password_verify($_POST['password'], $result['password']);
        }

        return false;
    }
}