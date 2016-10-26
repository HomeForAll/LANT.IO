<?php
class CabinetController extends Controller {
    public function actionCabinet() {
        if (!isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
        } else {

            $this->view->render('cabinet');
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