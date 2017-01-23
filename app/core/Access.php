<?php

class Access
{
    public function checkAuth()
    {
        if (isset($_SESSION['authorized']) && $_SESSION['authorized']) {
            return true;
        }

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');
        exit;
    }

    public function getAccessLevel() {
        return (integer)$_SESSION['status'];
    }
}