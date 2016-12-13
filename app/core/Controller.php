<?php

class Controller
{
    protected $model;
    protected $view;
    
    public function __construct($template, $model)
    {
        $this->view  = new View($template);
        $this->model = $this->getModel($model);
    }
    
    private function getModel($model)
    {
        if (file_exists(__DIR__ . '/../models/' . $model . '.php')) {
            return new $model;
        }
        
        return false;
    }
}