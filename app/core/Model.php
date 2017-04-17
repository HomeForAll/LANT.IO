<?php

class Model
{
    use PrintHelper;

    protected $db;

    function __construct()
    {
        $this->db = new DataBase();
        $this->countStatistic();
    }

    static function instance($model)
    {
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
    private function countStatistic()
    {
        $ip = $_SERVER["REMOTE_ADDR"];

        $query = $this->db->prepare('SELECT * FROM ips WHERE ip = :ip');
        $query->execute(array(':ip' => $ip));
        $result = $query->fetch();

        if ($result) {
            $visits = $result['visits'] + 1;

            $query = $this->db->prepare('UPDATE ips SET visits = :visits WHERE ip = :ip');
            $query->execute(array(':ip' => $ip, ':visits' => $visits));

            return $query->rowCount();
        } else {
            $visits = 1;

            $query = $this->db->prepare('INSERT INTO ips (ip, visits) VALUES (:ip, :visits)');
            $query->execute(array(':ip' => $ip, ':visits' => $visits));

            return $query->rowCount();
        }
    }

}