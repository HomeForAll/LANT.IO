<?php
class CPController extends Controller {
    public function __construct($pageName, $view, $modelName)
    {
        parent::__construct($pageName, $view);
        $this->model = new $modelName();
    }

    public function actionCP() {
        if (!isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
        } else {
            $this->view->displayPage($this->viewName, $this->title);
        }
    }

    public function actionChat() {
        $this->view->displayPage($this->viewName, $this->title);
    }

    public function actionKey() {
        $key = $this->model->generateKey();
        $this->view->displayPage($this->viewName, $this->title, $key);
    }
}