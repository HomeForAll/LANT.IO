<?php

class Access
{

    /**
     * Проверяет авторизован ли пользователь
     * @see UserModel::atLogin()
     * @return bool - возвращает true, если авторизован
     */
    public function checkAuth()
    {
        if (isset($_SESSION['authorized']) && $_SESSION['authorized']) {
            return true;
        }

        header('Location: http://'.$_SERVER['HTTP_HOST'].'/login');
        exit;
    }

    /**
     * Возвращает уровень доступа пользователя
     *
     * @return int - Колонка status в таблице users
     */
    public function getAccessLevel()
    {
        return (integer) $_SESSION['status'];
    }


     /**
     * Проверка уровня доступа
     *
     * @param type $status - статус пользователя
     * @return array - ассоциативный массив допусков TRUE/FALSE
     */
    public function checkAccessLevel($status = 0)
    {

        //статус пользователя в Базе Данных
        $guest        = 0; // Гость
        $user1        = 1; // Пользователь
        $user2        = 2; // Пользователь +
        $user3        = 3; // ЭКСПЕРТ
        $user4        = 4; // ?
        $admin        = 5; //АДМИН
        //Указание доступа для функций сайта
        $access_array = [
            'add_announces' =>// Добавлять объявления
            [0, 1, 1, 1, 1, 1],
            'add_review' =>// Добавлять пользовательские отзывы
            [0, 1, 1, 1, 1, 1],
            'add_services' =>// Подключать к сервисы
            [0, 1, 1, 1, 1, 1],
            'edit_profile' =>// Редактировать профиль
            [0, 1, 1, 1, 1, 1]
            ];

        // Приведение статуса в БД к позиции в массиве (см. соответствие выше)
        switch ($status) {
            case $guest:
                $status = 0;
                break;
            case $user1:
                $status = 1;
                break;
            case $user2:
                $status = 2;
                break;
            case $user3:
                $status = 3;
                break;
            case $user4:
                $status = 4;
                break;
            case $admin:
                $status = 5;
                break;
            default: $status = 0;
        }

//Получение массива допусков для данного статуса пользователя
        $access=[];
        foreach ($access_array as $key => $value){
            $access[$key] = (boolean)$value[$status];
        }
        return  $access;
    }
}