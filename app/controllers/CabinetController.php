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

    public function actionKeyeditor() {
        $showdb = $this->model->showdb();
        $keyeditor = $this->model->keyeditor();
        $keylock = $this->model->keylock();
        $keyunlock = $this->model->keyunlock();
        $installdate = $this->model->installdate();
        $viewkeyeditor = '';
        if (isset($_POST['keyworkgo']))
            $viewkeyeditor = $keyeditor;
        if (isset($_POST['showdb']))
            $viewkeyeditor = $showdb;
        if (isset($_POST['lock']))
            $viewkeyeditor = $keylock;
        if (isset($_POST['unlock']))
            $viewkeyeditor = $keyunlock;
        if (isset($_POST['installdate']))
            $viewkeyeditor = $installdate;
        $this->view->render('keyeditor', $viewkeyeditor);
    }
}