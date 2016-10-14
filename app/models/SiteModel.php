<?php

class SiteModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->getPGConnect();
    }

    public function getAccessByEmail()
    {
        $data = '';

        if (!empty($_POST['key'])) {
            if ($this->getKeyAvailability()) {
                $this->setUserAccess();
            } else {
                $data = 'wrongKey';
            }
        } else {
            $stmt = $this->db->prepare("SELECT * FROM access WHERE email = :email");
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
            $result = $stmt->fetch();

            $data = (isset($result['email']) && !empty($result['email'])) ? 'accessConfirmed' : 'keyRequest';
            if ($data == 'accessConfirmed') {
                $_SESSION['access'] = true;
                header('Location: http://' . $_SERVER['HTTP_HOST']);
            }
        }
        return $data;
    }

    private function getKeyAvailability()
    {
        $stmt = $this->db->prepare("SELECT * FROM access WHERE key = :key");
        $stmt->bindParam(':key', $_POST['key']);
        $stmt->execute();
        $result = $stmt->fetch();

        return (isset($result['key']) && !empty($result['key'])) ? true : false;
    }

    private function setUserAccess()
    {
        $stmt = $this->db->prepare("UPDATE access SET email = :email WHERE key = :key");
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindParam(':key', $_POST['key']);
        $stmt->execute();

        if ($stmt->rowCount()) {
            $_SESSION['access'] = true;
            header('Location: http://' . $_SERVER['HTTP_HOST']);
        }
    }
}