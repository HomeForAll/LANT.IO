<?php
class CPController extends Controller {
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
}