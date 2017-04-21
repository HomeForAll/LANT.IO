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
        $date = date('Y-m-d');

        $query = $this->db->prepare('SELECT * FROM ips WHERE ip = :ip AND date = :date_val');
        $query->execute(array(':ip' => $ip, ':date_val' => $date));
        $result = $query->fetch();

        if ($result) {
            $visits = $result['visits'] + 1;

            $query = $this->db->prepare('UPDATE ips SET visits = :visits WHERE ip = :ip');
            $query->execute(array(':ip' => $ip, ':visits' => $visits));

            return $query->rowCount();
        } else {
            $visits = 1;

            $query = $this->db->prepare('INSERT INTO ips (ip, visits, date) VALUES (:ip, :visits, :date_val)');
            $query->execute(array(':ip' => $ip, ':visits' => $visits, ':date_val' => $date));

            return $query->rowCount();
        }
    }

    public function getRegisteredUsers()
    {
        $query = $this->db->prepare('SELECT count(id) FROM users');
        $query->execute();
        $result = $query->fetch();

        if ($result) {
            return $result['count'];
        }

        return 0;
    }

    public function getUniquePeopleThisDay()
    {
        $date = date('Y-m-d');

        $query = $this->db->prepare('SELECT count(*) FROM ips WHERE date = :date_val');
        $query->execute(array(":date_val" => $date));
        $result = $query->fetch();

        if ($result) {
            return $result['count'];
        }

        return 0;
    }

    public function getNumberOfAds()
    {
        $query = $this->db->prepare('SELECT count(*) FROM news_base');
        $query->execute();
        $result = $query->fetch();

        if ($result) {
            return $result['count'];
        }

        return 0;
    }

    public function getActiveDialogs()
    {
        $query = $this->db->prepare('SELECT DISTINCT(id) FROM dialogs WHERE show = \'1\'');
        $query->execute();
        $dialogs = $query->fetchAll();

        if ($dialogs) {
            $count = count($dialogs);

            return $count;
        }

        return 0;
    }
}