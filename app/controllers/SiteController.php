<?php

class SiteController extends Controller
{
    public function __construct($pageName, $view, $modelName)
    {
        parent::__construct($pageName, $view);
        $this->model = new $modelName();
    }

    public function actionIndex()
    {
        $this->view->displayPage($this->viewName, $this->title);
    }

    public function actionAccess()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->model->ajaxHandler();
            exit;
        }
        $this->view->displayAccessPage($this->viewName);
    }

    public function actionSearch()
    {
        $this->view->displayPage($this->viewName, $this->title);
    }
}