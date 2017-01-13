<?php
class CabinetController extends Controller {
    public function actionCabinet() {
        if (!isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
            exit;
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

    public function actionShowActivity(){
        $this->view->render('activity_page', $this->model->getinfo());
    }
    public function actionProfileEdit(){
        $this->model->savePersonalInfo();
        $this->view->render('profileEdit', $this->model->getinfo());
    }

    public function actionKeyeditor() {
        $showdb = $this->model->showdb();
        $keyeditor = $this->model->keyeditor();
        $keylock = $this->model->keylock();
        $keyunlock = $this->model->keyunlock();
        $installdate = $this->model->installdate();
        $page = $this->model->page();
        $viewkeyeditor = '';

        for ($i = 1; $i <= $_SESSION['numberofpages']; $i++) {
            if (isset($_POST["page" . $i]))
                $viewkeyeditor = $page;
        }
        if (isset($_POST['updateinfo']))
            $viewkeyeditor = $keyeditor;
        if (isset($_POST['idworkgo']))
            $viewkeyeditor = $keyeditor;
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
        if (isset($_POST['installemail']))
            $viewkeyeditor = $installdate;

        $this->view->render('keyeditor', $viewkeyeditor);
    }
}