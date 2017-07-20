<?php

class Model extends Response
{
    use PrintHelper;

    protected $db;

    function __construct()
    {
        $this->db = new DataBase();
        $this->countVisitorsStatistic();
    }

    public function getUserFirstName($PDO, $userID)
    {
        $query = $this->db->prepare("SELECT first_name FROM users WHERE id = :userID");
        $query->execute([':userID' => $userID]);
        $result = $query->fetch();

        return $result[0];
    }

    public function getUserLastName($PDO, $userID)
    {
        $query = $this->db->prepare("SELECT last_name FROM users WHERE id = :userID");
        $query->execute([':userID' => $userID]);
        $result = $query->fetch();

        return $result[0];
    }

    public function getUser($userID)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :userID");
        $query->execute([':userID' => $userID]);
        $result = $query->fetch();

        return $result;
    }

    private function countVisitorsStatistic()
    {
        if (isset($_COOKIE['visitor_session_id'])) {
            $session_id = $_COOKIE['visitor_session_id'];
        } else {
            $session_id = sha1(microtime() . mt_rand(1, 100));
            setcookie('visitor_session_id', $session_id, time() + 60 * 60 * 24 * 30);
        }

        $timestamp = date(DATE_ISO8601);
        $date = date('Y-m-d');
        $last_activity = date('H:i:s');

        $query = $this->db->prepare('SELECT * FROM visitors_statistic WHERE session_id = :session_id AND date = :date_val');
        $query->execute([
            ':date_val'   => $date,
            ':session_id' => $session_id,
        ]);

        $result = $query->fetch();

        if ($result) {
            $query = $this->db->prepare('UPDATE visitors_statistic SET last_activity = :last_activity WHERE session_id = :session_id');
            $query->execute([':session_id' => $session_id, ':last_activity' => $last_activity]);

            return $query->rowCount();
        } else {

            $query = $this->db->prepare('INSERT INTO visitors_statistic (date, last_activity, session_id, t_stamp) VALUES (:date_val, :last_activity, :session_id, :t_stamp)');
            $query->execute([':session_id' => $session_id, ':date_val' => $date, ':last_activity' => $last_activity, ':t_stamp' => $timestamp]);

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
        $query->execute([":date_val" => $date]);
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

    public function getClassName()
    {
        return get_called_class();
    }
}