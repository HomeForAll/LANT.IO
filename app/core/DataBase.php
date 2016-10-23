<?php

class DataBase extends PDO {
    private $settings;

    public function __construct() {
        $this->settings = require __DIR__ . '/../config/settings.php';
        parent::__construct('pgsql:host=' . $this->settings['db_host'] . ';port=5432;dbname=' . $this->settings['db'], $this->settings['db_username'], $this->settings['db_password'], array(
            PDO::ATTR_PERSISTENT => true
        ));
    }
}