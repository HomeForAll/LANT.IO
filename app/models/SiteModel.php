<?php

class SiteModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->getPGConnect();
    }

    public function getData() {
        switch ($_POST['type']) {
            case 'emailBetaAccess':
                $this->getAccessByEmail();
                break;
        }
    }

    public function getAccessByEmail()
    {
        if (!empty($_POST['key'])) {
            if ($this->getKeyAvailability()) {
                $this->setUserAccess();
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
        $stmt = $this->db->prepare("UPDATE access SET email = :email WHERE key = :key");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':key', $_POST['key']);
        $stmt->execute();

        if ($stmt->rowCount()) {
            $_SESSION['access'] = true;
            echo 'accessGranted';
        }
    }
}