<?php
class Application {
    private $settings;
    protected $db;

    public function __construct() {
        $this->settings = require CONFIG_DIR . 'settings.php';
    }

    protected function getConnect() {
        $this->db = self::getConnectObject($this->settings);
    }

    private static function getConnectObject($settings) {
        try {
            return new PDO('pgsql:host=' . $settings['host'] . ';port=5432;dbname=' . $settings['db'], $settings['username'], $settings['password']);
        } catch (Exception $e) {
            die("Не удалось подключиться к базе данных: " . $e->getMessage());
        }
        //pg_connect("host=" . $settings['host'] . " port=5432 dbname=" . $settings['db'] . " user=" . $settings['username'] . " password=" . $settings['password']);
        //return new mysqli($settings['host'], $settings['username'], $settings['password'], $settings['db']);
    }
}