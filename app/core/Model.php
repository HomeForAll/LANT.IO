<?php

class Model
{
    use PrintHelper;

    protected $db;

    static function instance($model) {
        if (file_exists(ROOT_DIR . '/app/models/' . $model . '.php')) {
            return new $model;
        }

        return null;
    }

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