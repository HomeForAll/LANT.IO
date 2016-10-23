<?php

abstract class Model extends Application {
    protected $db;
    /*
     * Метод должен обрабатывать Ajax запросы
     */
    abstract public function ajaxHandler();
}