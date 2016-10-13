<?php

class SiteController extends Controller {
    public function __construct($pageName, $view, $modelName)
    {
        parent::__construct($pageName, $view);
        $this->model = new $modelName();
    }

    public function actionIndex() {
        $this->view->displayPage($this->viewName, $this->title);
    }

    public function actionAccess() {
        $data = array(
            'title' => $this->title,
            'email_exists' => $this->model->checkAccess()
        );
        $this->model->getAccess();
        $this->view->displayAccessPage($this->viewName, $data);
    }

    public function actionSearch() {
        $this->view->displayPage($this->viewName, $this->title);
    }
}