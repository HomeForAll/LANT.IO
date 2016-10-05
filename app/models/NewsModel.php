<?php

class NewsModel extends Model {

    public static function getNewsItemById($id) {

    }

    // Вход: Количество новостей
    // Возвращает: выборку всех данных новостей в виде массива
    public static function getNewsList($numberOfNews, $db) {

        $result = $db->query("SELECT id, date, name, message, status "
                . "FROM news"
                . " ORDER BY id DESC"
                . " LIMIT $numberOfNews");
        if (!$result) {
            echo "Произошла ошибка!\n";
            exit;
        }

        return $result->fetchAll();
    }

}

?>