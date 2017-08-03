<?php
// Запись ошибок в лог файл
require_once('error_handler.php');
// Подключение к БД
$config = require '../app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
$db = new PDO('pgsql:host=' . $config['db_host'] . ';port=5432;dbname=' . $config['db'], $config['db_username'],
    $config['db_password']);

//Варианты запросов Лучшее Объявление
define('BEST_ADS_SEARCHING_TYPE', [
    'object_type'    => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
    'operation_type' => [1, 2],
    'city'           => [1, 2],
]);
//Количество объявлений в выборке
define('BEST_ADS_SEARCHING_LIMIT', 10);

//Текущее время
$time = time();

//Запись даты у лучших объявлений по категориям запросов
foreach (BEST_ADS_SEARCHING_TYPE['object_type'] as $object_type) {
    foreach (BEST_ADS_SEARCHING_TYPE['operation_type'] as $operation_type) {
        foreach (BEST_ADS_SEARCHING_TYPE['city'] as $city) {

            //Определение лучших объявлений
            $sql = "SELECT id_news, (rating_views * (1 + rating_admin + rating_donate)) as rating"
                . " FROM news_base WHERE"
                . " (object_type = $object_type)"
                . " AND (operation_type = $operation_type)"
                . " AND (city = $city)"
                . " AND (status = 1)"
                . " ORDER BY rating DESC"
                . " LIMIT " . BEST_ADS_SEARCHING_LIMIT;

            $stmt = $db->prepare($sql);
            if (!$stmt->execute()) trigger_error("Ошибка запроса в БД", E_USER_WARNING);
            $best_ads = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($best_ads)) {
                $sql = "UPDATE news_base SET date_best = $time, rating_best = CASE";
                foreach ($best_ads as $ad) {
                    $sql .= " WHEN id_news = " . $ad['id_news'] . " THEN " . $ad['rating'];
                }
                $sql .= " END"
                    . " WHERE id_news IN (";
                foreach ($best_ads as $ad) {
                    $sql .= $ad['id_news'] . ', ';
                }
                $sql = substr($sql, 0, -2);
                $sql .= ")";

                $stmt = $db->prepare($sql);
                if (!$stmt->execute()) trigger_error("Ошибка запроса в БД", E_USER_WARNING);
            }
        }
    }
}
