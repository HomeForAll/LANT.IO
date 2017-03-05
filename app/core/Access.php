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
     * Возвращает массив всех допусков пользователя
     *
     * @param type $user_st - статус пользователя
     * @return array - ассоциативный массив допусков TRUE/FALSE
     */
    public function checkAccessLevel($user_st = 0)
    {

        //статус пользователя в Базе Данных
        $user         = [];
        $user[0]      = 0; // Гость
        $user[1]      = 1; // Пользователь
        $user[2]      = 2; // Профессиональный участник рынка недвижимости USER2
        $user[3]      = 3; // Предоставляющий услуги - (USER3)
        $user[4]      = 4; // Премиум Пользователь+ (USER4)
        $user[5]      = 5; //Модератор
        $user[6]      = 6; //Старший Модератор - (USER6)
        $user[7]      = 7; //Администратор - (USER7)
        $user[8]      = 8; //ПАХАН - (USER8)
        //Указание доступа для функций сайта
        $access_array = [
            'news_admin' => // Администрирование объявлений
            [0, 0, 0, 0, 0, 1, 1, 1, 1],
            'add_news' => // Добавлять объявления
            [0, 1, 1, 1, 1, 1, 1, 1, 1],
            'add_review' => // Добавлять пользовательские отзывы
            [0, 1, 1, 1, 1, 1, 1, 1, 1],
            'admin_service' => //  Администрирование сервисов
            [0, 0, 0, 0, 0, 1, 1, 1, 1],
            'add_service' => // Добавлять свои сервисы
            [0, 1, 1, 1, 1, 1, 1, 1, 1],
            'sub_service' => // Подключать сервисы
            [0, 1, 1, 1, 1, 1, 1, 1, 1],
            'edit_profile' => // Редактировать профиль
            [0, 1, 1, 1, 1, 1, 1, 1, 1]
        ];

        // Приведение статуса в БД к позиции в массиве (см. соответствие выше)
         $status = 0;
        foreach ($user as $kay => $value) {
            if ($user_st == $value) {
                $status = $kay;
                break;
            }
        }

//Получение массива допусков для данного статуса пользователя
        $access = [];
        foreach ($access_array as $key => $value) {
            $access[$key] = (boolean) $value[$status];
        }
        return $access;
    }
}