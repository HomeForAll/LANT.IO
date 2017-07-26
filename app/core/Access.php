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

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');
        exit;
    }

    /**
     * Возвращает уровень доступа пользователя
     *
     * @return int - Колонка status в таблице users
     */
    public function getAccessLevel()
    {
        return (integer)$_SESSION['status'];
    }


    /**
     * Возвращает массив всех допусков пользователя
     *
     * @return array - ассоциативный массив допусков TRUE/FALSE
     */
    public function checkAccessLevel()
    {
        $user_st = (int)$_SESSION['status'];

       //статус пользователя в Базе Данных
        $user = [];
        $user[0] = 0; // Гость
        $user[1] = 1; // Пользователь
        $user[2] = 2; // Профессиональный участник рынка недвижимости USER2
        $user[3] = 3; // Предоставляющий услуги - (USER3)
        $user[4] = 4; // Премиум Пользователь+ (USER4)
        $user[5] = 5; //Модератор
        $user[6] = 6; //Старший Модератор - (USER6)
        $user[7] = 7; //Администратор - (USER7)
        $user[8] = 8; //ПАХАН - (USER8)
        //Указание доступа для функций сайта
        $access_array = [
            'key_generator' => // Генерация ключей к Beta тестированию
                [0, 0, 0, 0, 0, 0, 0, 1, 1],
            'key_editor' => // Редактирование ключей от Beta тестирования
                [0, 0, 0, 0, 0, 0, 0, 1, 1],
            'admin_tickets' => // Раздел тех поддержки работы с тикетами
                [0, 0, 0, 0, 0, 1, 1, 1, 1],
            'forms_editor' => // Редактор форм поиска
                [0, 1, 1, 1, 1, 1, 1, 1, 1],
            'admin_service' => // Управление услугами сайта
                [0, 0, 0, 0, 0, 0, 0, 1, 1],
            'admin_news' => // Администрирование объявлений
                [0, 0, 0, 0, 0, 0, 0, 1, 1],
            'add_service' => // Добавление сервисов
                [0, 0, 0, 0, 0, 0, 0, 1, 1],
            'add_news' => // Добавление объявлений
                [0, 1, 1, 1, 1, 1, 1, 1, 1],
            'admin' => // Доступ к админ странице
                [0, 0, 0, 0, 0, 0, 0, 1, 1],
            'admin_users_panel' => // Доступ к админ странице
                [0, 0, 0, 0, 0, 0, 0, 1, 1],
                        'myad' => // Доступ к странице Мои объявления
                [0, 1, 1, 1, 1, 1, 1, 1, 1],

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
            $access[$key] = (boolean)$value[$status];
        }
        return $access;
    }

    public function getAccessFor($access_category = NULL){
        //Если нет ID
        if (empty($_SESSION['user']['id'])) {
            $this->view->render('login');
            return;
        }
        $this->access = $this->checkAccessLevel();
        //Проверка на доступ к данной категории
        if (!empty($access_category)){
            if (!$this->access[$access_category]) {
                $this->view->render('no_access');
                return;
            }
        }
        return;
    }
}