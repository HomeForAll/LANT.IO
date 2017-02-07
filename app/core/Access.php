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
     * @param type $function - функция нуждающаяся в доступе
     * @return boolean
     */
    public function checkAccessLevel($status = 0, $function = 0)
    {

        //статус пользователя в Базе Данных
        $guest        = 0; // Гость
        $user1        = 1; // Пользователь
        $user2        = 2; // Пользователь +
        $user3        = 3; // ЭКСПЕРТ
        $user4        = 4; // ?
        $admin        = 5; //АДМИН
        //Указание доступа для функций сайта
        $access_array = array(
            // Код функции  $function => [  Гость, Пользователь, Пользователь+,  ЭКСПЕРТ, ?, АДМИН ]
            1 =>
            [0, 1, 1, 1, 1, 1], //Добавлять объявления
            2 =>
            [0, 1, 1, 1, 1, 1], //Добавлять пользовательские отзывы
            'profile' =>
            [0, 1, 1, 1, 1, 1], //Редактировать профиль
        );

        // Приведение статуса в БД к позиции в массиве
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

        if (isset($access_array[$function][$status])) {
            if ($access_array[$function][$status] === 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }
}