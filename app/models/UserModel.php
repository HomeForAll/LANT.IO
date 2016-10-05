<?php

class UserModel extends Model {
    public function __construct() {
        parent::__construct();
        $this->db = $this->getPGConnect();
    }

    public function checkUserInformation() {
        $errors = array();

        if (!$this->checkEmailValidationErrors($_POST['email'])) {
            $errors[] = '- Укажите корректный E-mail.';
        }
        if ($this->checkEmailAvailability($_POST['email'])) {
            $errors[] = '- Такой E-mail уже зарегистрирован.';
        }
        if ($_POST['firstName'] == '') {
            $errors[] = '- Укажите имя.';
        }
        if ($_POST['lastName'] == '') {
            $errors[] = '- Укажите фамилию.';
        }
        if ($_POST['patronymic'] == '') {
            $errors[] = '- Укажите отчество.';
        }
        if ($_POST['birthday'] == '') {
            $errors[] = '- Укажите дату рождения.';
        }
        if ($_POST['phoneNumber'] == '') {
            $errors[] = '- Укажите телефон.';
        }
        if ($_POST['password'] == '') {
            $errors[] = '- Вы не указали пароль.';
        }
        return $errors;
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

        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, email, password, phone_number) VALUES (:firstName, :lastName, :email, :password, :phoneNumber)");
        $stmt->bindParam(':firstName', $_POST['firstName']);
        $stmt->bindParam(':lastName', $_POST['lastName']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':password', $passwordHash);
        $stmt->bindParam(':phoneNumber', $_POST['phoneNumber']);
        $stmt->execute();
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