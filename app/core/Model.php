<?php

class Model extends Application
{
    protected $db;

    /*
     * Метод должен обрабатывать Ajax запросы
     */


    protected function getUserFirstName(PDO $PDO, $userID)
    {
        $query = $PDO->prepare("SELECT first_name FROM users WHERE id = :userID");
        $query->execute(array(':userID' => $userID));
        $result = $query->fetch();

        if ($query->errorCode()) {
            return $query->errorInfo();
        }

        return $result;
    }

    protected function getUserLastName(PDO $PDO, $userID)
    {
        $query = $PDO->prepare("SELECT last_name FROM users WHERE id = :userID");
        $query->execute(array(':userID' => $userID));
        $result = $query->fetch();

        if ($query->errorCode()) {
            return $query->errorInfo();
        }

        return $result;
    }
}