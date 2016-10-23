<?php
class CPController extends Controller {
    public function actionCP() {
        if (!isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
        } else {

            $this->view->render('cp');
        }
    }

    public function actionChat() {
        $this->view->render('chat');
    }

    public function actionGenerator() {
        $this->model->generate();
        $this->model->handleKeys();
        $this->view->render('generator');
    }
}