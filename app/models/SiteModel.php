<?php

class SiteModel extends Model
{
    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function ajaxHandler()
    {
        switch ($_POST['type']) {
            case 'emailBetaAccess':
                $this->getAccessByEmail();
                break;
        }
    }

    public function getAccessByEmail()
    {
        if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            if (!empty($_POST['key'])) {
                if ($this->getKeyAvailability()) {
                    if (!empty($_POST['agree'])) {
                        $this->setUserAccess();
                    } else {
                        $this->deleteActivationKey();
                    }
                } else {
                    echo 'incorrectKey';
                }
            } else {
                $stmt = $this->db->prepare("SELECT * FROM access WHERE email = :email");
                $stmt->bindParam(':email', $_POST['email']);
                $stmt->execute();
                $result = $stmt->fetch();

                if (isset($result['email']) && !empty($result['email'])) {
                    $_SESSION['access'] = true;
                    echo 'accessGranted';
                } else {
                    echo 'keyRequest';
                }
            }
        } else {
            echo 'incorrectEmail';
        }
    }

    private function getKeyAvailability()
    {
        $stmt = $this->db->prepare("SELECT * FROM access WHERE key = :key");
        $stmt->bindParam(':key', $_POST['key']);
        $stmt->execute();
        $result = $stmt->fetch();

        return (isset($result['key']) && !empty($result['key']) && empty($result['email'])) ? true : false;
    }

    private function setUserAccess()
    {
        $stmt = $this->db->prepare("UPDATE access SET email = :email, status = 1 WHERE key = :key");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':key', $_POST['key']);
        $stmt->execute();

        if ($stmt->rowCount()) {
            $_SESSION['access'] = true;
            echo 'accessGranted';
        }
    }

    private function deleteActivationKey() {
        $stmt = $this->db->prepare("DELETE FROM access WHERE key = :key");
        $stmt->bindParam(':key', $_POST['key']);
        $stmt->execute();

        if ($stmt->rowCount()) {
            echo 'keyDeleted';
        }
    }
}