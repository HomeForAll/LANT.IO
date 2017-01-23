<?php

class Application extends Access
{
    //    private $settings;
    //    protected $db;
    //
    //    public function __construct() {
    //        $this->settings = require CONFIG_DIR . 'settings.php';
    //    }
    //
    //    /*
    //     * Возвращает экземпляр класса PDO с драйвером PostgreSQL
    //     */
    //    protected function getPGConnect() {
    //        try {
    //            return new PDO('pgsql:host=' . $this->settings['db_host'] . ';port=5432;dbname=' . $this->settings['db'], $this->settings['db_username'], $this->settings['db_password']);
    //        } catch (Exception $e) {
    //            die("Не удалось подключиться к базе данных:<br>" . $e->getMessage());
    //        }
    //    }

    protected function printData($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    protected function ifAJAX(callable $callback)
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            call_user_func($callback);
            exit;
        }
//        return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
//            && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
        return false;
    }
}