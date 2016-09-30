<?php

class Controller {
    protected $view;
    protected $model;
    protected $title;

    public function __construct($pageName, $settings = null, $modelName = null) {
        $this->view = new View();
        $this->title = $pageName;
    }
}