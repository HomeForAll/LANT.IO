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
        $data = '';

        if (isset($_POST['submit'])) {
            $data = $this->model->getAccessByEmail();
        }

        $this->view->displayAccessPage($this->viewName, $data);
    }

    public function actionSearch() {
        $this->view->displayPage($this->viewName, $this->title);
    }
}