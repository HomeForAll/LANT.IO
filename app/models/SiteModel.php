<?php

class SiteModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->getPGConnect();
    }

    public function checkAccess()
    {
        if ($_POST['submit'] && !isset($_POST['key'])) {
            $stmt = $this->db->prepare("SELECT * FROM access WHERE email = :email");
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
            $result = $stmt->fetch();

            if (isset($result['email'])) {
                $_SESSION['access'] = true;
                header('Location: http://' . $_SERVER['HTTP_HOST']);
            } else {
                return false;
            }
        }
        return true;
    }

    public function getAccess()
    {
        if ($_POST['submit'] && isset($_POST['key'])) {
            $keyStmt = $this->db->prepare("SELECT * FROM access WHERE email = :email");
            $keyStmt->bindParam(':email', $_POST['email']);
            $keyStmt->execute();
            $result = $keyStmt->fetch();

            if (isset($result['key'])) {
                if ($result['key'] == $_POST['key']) {
                    return false;
                }
            }

            $stmt = $this->db->prepare("INSERT INTO access (email, `key`) VALUES (:email, :key)");
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':key', $_POST['key']);
            $stmt->execute();

            if (!$stmt->errorInfo()) {
                $_SESSION['access'] = true;
                header('Location: http://' . $_SERVER['HTTP_HOST']);
                return true;
            }
        }
        return false;
    }
}