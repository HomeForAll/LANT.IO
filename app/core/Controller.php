<?php

class Controller extends Access
{
    use PrintHelper;

    protected $view;
    protected $models;
    protected $access;
    
    public function __construct($layout)
    {
        $this->view  = View::instance($layout);

        if (isset($_SESSION['user']['id']) ){
            $this->access = $this->checkAccessLevel();
        }
    }

    /**
     * Записывает экземпляр класса модели в массив $this->models и передает его в View
     *
     * @param Model $model
     */
    protected function setModel(Model $model)
    {
        $this->view->setModel($model);
        $this->models[$model->getClassName()] = $model;
    }

    /**
     * Возвращает экземпляр класса модели из $this->models по имени
     *
     * @param string $name
     * @return mixed
     */
    public function model($name) {
        return $this->models[$name];
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