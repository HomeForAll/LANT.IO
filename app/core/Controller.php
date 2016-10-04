<?php

class Controller {
    protected $view;
    protected $viewName;
    protected $model;
    protected $title;

    public function __construct($pageName, $settings = null, $view = null, $modelName = null) {
        $this->view = new View();
        $this->title = $pageName;
        $this->viewName = $view;
    }
}