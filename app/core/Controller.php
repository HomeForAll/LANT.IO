<?php

class Controller extends Access
{
    use PrintHelper;

    protected $model;
    protected $view;
    
    public function __construct($template, $model)
    {
        $this->view  = new View($template);
        $this->model = $this->getModel($model);
    }
    
    private function getModel($model)
    {
        if (file_exists(ROOT_DIR . '/app/models/' . $model . '.php')) {
            return new $model;
        }
        
        return false;
    }

    protected function ifAJAX(callable $callback)
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            call_user_func($callback);
            exit;
        }

        return false;
    }
}