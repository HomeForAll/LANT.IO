<?php
class Application {
    private $settings;
    protected $db;

    public function __construct() {
        $this->settings = require CONFIG_DIR . 'settings.php';
    }

    protected function getPGConnect() {
        try {
            return new PDO('pgsql:host=' . $this->settings['host'] . ';port=5432;dbname=' . $this->settings['db'], $this->settings['username'], $this->settings['password']);
        } catch (Exception $e) {
            die("Не удалось подключиться к базе данных:<br>" . $e->getMessage());
        }
    }
}