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

            $query = $this->db->prepare("INSERT INTO tickets (user_id, user_name, question, description, status) VALUES (:userID, :userName, :question, :description, true)");

            $query->execute(array(
                ':userID' => $userID,
                ':userName' => $userName,
                ':question' => $question,
                ':description' => $description,
            ));

            if (!$query->errorInfo()[1]) {
                return "Сообщение отправлено, ожидайте ответа.";
            } else {
                return "Неизвестная ошибка.";
            }
        } else {
            return "Вы не авторизованы!";
        }
    }
}