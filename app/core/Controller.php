<?php

class Controller extends Access
{
    use PrintHelper;

    protected $view;

    /**
     * @var $model $model
     */
    protected $model;
    protected $access;
    
    public function __construct($layout, $model)
    {
        $this->view  = View::instance($layout);
        $this->model = Model::instance($model);

        if (isset($_SESSION['userID']) ){
            $this->access = $this->checkAccessLevel($_SESSION['status']);
        }
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