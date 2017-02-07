<?php

class Model
{
    use PrintHelper;

    protected $db;

    /*
     * Метод должен обрабатывать Ajax запросы
     */


    protected function getUserFirstName(PDO $PDO, $userID)
    {
        $query = $PDO->prepare("SELECT first_name FROM users WHERE id = :userID");
        $query->execute(array(':userID' => $userID));
        $result = $query->fetch();

        return $result[0];
    }

    protected function getUserLastName(PDO $PDO, $userID)
    {
        $query = $PDO->prepare("SELECT last_name FROM users WHERE id = :userID");
        $query->execute(array(':userID' => $userID));
        $result = $query->fetch();

        return $result[0];
    }
}