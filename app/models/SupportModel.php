<?php

class SupportModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = new DataBase();
    }

    public function get_tickets()
    {
        $cursor = $this->db->query("SELECT * FROM tickets WHERE new_answer = false AND status = true");
        $result = $cursor->fetchAll();

        $matrix = [];
        foreach ($result as $item) {
            if ($item['answerer_user_id'] == '')
            {
                array_push($matrix, $item);
            }
            if ($item['answerer_user_id'] == $_SESSION['user']['id'])
            {
                array_push($matrix, $item);
            }
        }
        return $matrix;
    }


    public function support_articles($article)
    {
        $matrix = [];
        $matrix_2 = [];
        $temp = [];

        $stmt = $this->db->prepare("SELECT * FROM support_articles WHERE article= '{$article}'");
        $stmt->execute();
        $articles = $stmt->fetchAll();

        $i_max = 0;
        foreach ($articles as $value) {
            $i_max++;
        }

        for ($i = 0; $i < $i_max; $i++)
        {
            $matrix[$i][0] = $articles[$i][0];
            $matrix[$i][1] = $articles[$i][1];
            $matrix_2[$i] = $articles[$i];
        }

        for ($i = 0; $i < $i_max; $i++)
        {
            for ($j = $i; $j < $i_max; $j++)
            {
                if ($matrix_2[$j][4] > $matrix_2[$i][4])
                {
                    $temp = $matrix_2[$i];
                    $matrix_2[$i] = $matrix_2[$j];
                    $matrix_2[$j] = $temp;
                }
            }
        }

        return array(
            'i_max'=> $i_max,
            'matrix'=> $matrix,
            'matrix_2'=>$matrix_2
        );
    }

    public function article_id($id)
    {
        $stmt = $this->db->prepare("SELECT visited_times FROM support_articles WHERE id = $id");
        $stmt->execute();
        $visited_times = $stmt->fetchAll();

        $visited_times = $visited_times[0][0] + 1;
        $this->db->query("UPDATE support_articles SET visited_times = $visited_times WHERE id = $id");

        $stmt = $this->db->prepare("SELECT text FROM support_articles WHERE id= $id");
        $stmt->execute();
        $text = $stmt->fetchAll();
        return $text[0];
    }

    public function addTicket()
    {
        $userID = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;

        if ($userID) {
            $firstName = $this->getUserFirstName($this->db, $userID);
            $lastName = $this->getUserLastName($this->db, $userID);
            $userName = $firstName . " " . $lastName;
            $question = $_POST['question'];
            $description = $_POST['description'];

            if (!$question) {
                return 'Введите вопрос.';
            }

            if (!$description) {
                return 'Опишите проблему.';
            }

            $date = date("Y-m-d H:i:s");

            $query = $this->db->prepare("INSERT INTO tickets (user_id, user_name, question, description, new_answer, create_date_time, status) VALUES (:userID, :userName, :question, :description, false, :createTime, true)");

            $query->execute(array(
                ':userID' => $userID,
                ':userName' => $userName,
                ':question' => $question,
                ':description' => $description,
                ':createTime' => $date,
            ));

            if (!$query->errorInfo()[1]) {
                unset($_POST);
                return "Сообщение отправлено, ожидайте ответа.";
            } else {
                return "Неизвестная ошибка.";
            }
        } else {
            return "Вы не авторизованы!";
        }
    }

    public function addMessage($ticketID) {
        $userID = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 0;

        if ($userID) {

            $firstName = $this->getUserFirstName($this->db, $userID);
            $lastName = $this->getUserLastName($this->db, $userID);
            $userName = $firstName . " " . $lastName;
            $message = $_POST['msg'];
            $date = date("Y-m-d H:i:s");

            if (!$message) {
                return 'Сообщение пустое.';
            }

            if (($_SESSION['status'] >= 5)) {
                $flag = 'true';
                $cursor = $this->db->query("UPDATE tickets SET answerer_user_id ={$_SESSION['user']['id']} WHERE id = {$ticketID[0]}");
                $cursor = $this->db->query("UPDATE tickets SET answerer_user_name = '{$userName}' WHERE id = {$ticketID[0]}");
            }
            else
                $flag = 'false';

            $cursor = $this->db->query("UPDATE tickets SET new_answer =" . $flag . " WHERE id = {$ticketID[0]}");

            $query = $this->db->prepare("INSERT INTO ticket_answers (ticket_id, answerer_user_id, answerer_user_name, answer, answer_date, status) VALUES (:ticketID, :userID, :userName, :answer, :answerDate, {$flag})");

            $query->execute(array(
                ':ticketID' => $ticketID[0],
                ':userID' => $userID,
                ':userName' => $userName,
                ':answer' => $message,
                ':answerDate' => $date,
            ));


            if (!$query->errorInfo()[1]) {
                unset($_POST);
                return "Сообщение отправлено, ожидайте ответа.";
            } else {
                return "Неизвестная ошибка.";
            }
        } else {
            return "Вы не авторизованы!";
        }
    }

    public function getTickets($page = 0)
    {
        $offset = $page * 10;

        $cursor = $this->db->query("SELECT * FROM tickets WHERE user_id = {$_SESSION["userID"]} LIMIT 10 OFFSET {$offset}");
        $result = $cursor->fetchAll();

        return $result;
    }

    public function getDialog($ticketID)
    {
        return array(
            'ticket' => $this->getTicket($ticketID),
            'messages' => $this->getMessages($ticketID),
        );
    }

    private function getMessages($ticketID)
    {
        $cursor = $this->db->query("SELECT * FROM ticket_answers WHERE ticket_id = {$ticketID}");
        $result = $cursor->fetchAll();

//        $arr_main = [];
//        foreach ($result as $item=>$key)
//        {
//            $arr_main[$item] = $key;
//        }
//
//        function cmp($a, $b) {
//            if ($a[0] == $b[0]) {
//                return 0;
//            }
//            return ($a[0] < $b[0]) ? -1 : 1;
//        }
//        usort($arr_main,"cmp");
//        $result = $arr_main;

        return $result;
    }

    private function getTicket($ticketID)
    {
        $cursor = $this->db->query("SELECT * FROM tickets WHERE id = {$ticketID}");
        $result = $cursor->fetchAll();

        return $result;
    }

    public function getStatistic()
    {
        return array(
            'active' => $this->countActiveTicketsQuantity(),
            'answers' => $this->countNumberOfAnswers(),
        );
    }

    private function countNumberOfAnswers()
    {
        $cursor = $this->db->query("SELECT count(*) FROM tickets WHERE user_id = {$_SESSION["userID"]} AND new_answer = true AND status = true");
        $result = $cursor->fetch()[0];

        return $result;
    }

    private function countActiveTicketsQuantity()
    {
        $cursor = $this->db->query("SELECT count(*) FROM tickets WHERE user_id = {$_SESSION["userID"]} AND status = true");
        $result = $cursor->fetch()[0];

        return $result;
    }

    public function closeTicket($ticketID)
    {
        $cursor = $this->db->query("UPDATE tickets SET status = false WHERE id = {$ticketID}");
        $result = $cursor->rowCount();

        return ($result) ? 'Запрос успешно закрыт.' : 'Неизвестная ошибка.';
    }
}