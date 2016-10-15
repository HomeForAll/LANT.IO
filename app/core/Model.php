<?php

abstract class Model extends Application {
    /*
     * Метод должен обрабатывать Ajax запросы
     */
    abstract public function getData();
}