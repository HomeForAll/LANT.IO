<?php

class UserModel extends Model {
    public function checkEmailValidationErrors($email) {
        return (filter_var($email, FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    public function checkEmailAvailability($email) {
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
}