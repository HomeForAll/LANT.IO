<?php

class SupportModel extends Model
{
    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function addTicket()
    {
        $userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : 0;

        if ($userID) {

            //            $firstName = $this->getUserFirstName($this->db, $userID);
//            $lastName = $this->getUserLastName($this->db, $userID);
            $userName = "Дима" . "Бадаранча";
            $question = $_POST['question'];
            $description = $_POST['description'];

            if (!$question) {
                return 'Введите вопрос.';
            }

            if (!$description) {
                return 'Опишите проблему.';
            }

            $date = date("Y-m-d H:i:s");

            $query = $this->db->prepare("INSERT INTO tickets (user_id, user_name, question, description, create_date_time, status) VALUES (:userID, :userName, :question, :description, :createTime, true)");

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

    public function getTickets($page = 0) {
        $offset = $page * 10;

        $cursor = $this->db->query("SELECT * FROM tickets WHERE user_id = {$_SESSION["userID"]} LIMIT 10 OFFSET {$offset}");
        $result = $cursor->fetchAll();

        return $result;
    }

    public function getDialog($ticketID) {
        return array(
            'ticket'=> $this->getTicket($ticketID),
            'messages' => $this->getMessages($ticketID),
        );
    }

    private function getMessages($ticketID) {
        $cursor = $this->db->query("SELECT * FROM ticket_answers WHERE ticket_id = {$ticketID}");
        $result = $cursor->fetchAll();

        return $result;
    }

    private function getTicket($ticketID) {
        $cursor = $this->db->query("SELECT * FROM tickets WHERE id = {$ticketID}");
        $result = $cursor->fetchAll();

        return $result;
    }

    public function getStatistic() {
        return array(
            'active'=> $this->countActiveTicketsQuantity(),
            'answers'=> $this->countNumberOfAnswers(),
        );
    }

    private function countNumberOfAnswers() {
        $cursor = $this->db->query("SELECT count(*) FROM tickets WHERE user_id = {$_SESSION["userID"]} AND new_answer = true");
        $result = $cursor->fetch()[0];

        return $result;
    }

    private function countActiveTicketsQuantity() {
        $cursor = $this->db->query("SELECT count(*) FROM tickets WHERE user_id = {$_SESSION["userID"]} AND status = true");
        $result = $cursor->fetch()[0];

        return $result;
    }

    public function closeTicket($ticketID) {
        $cursor = $this->db->query("UPDATE tickets SET status = false WHERE id = {$ticketID}");
        $result = $cursor->rowCount();

        return ($result) ? 'Запрос успешно закрыт.' : 'Неизвестная ошибка.';
    }
}