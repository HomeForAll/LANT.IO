<?php

class CabinetController extends Controller
{
    public function __construct($template, $model)
    {
        parent::__construct($template, $model);
        $this->checkAuth();
    }

    public function actionCabinet()
    {
        $this->view->render('cabinet');
    }

    public function actionGenerator()
    {
        $this->model->generate();
        $this->model->handleKeys();
        $this->view->render('generator');
    }

    public function actionShowActivity()
    {
        $this->view->render('activity_page', $this->model->getinfo());
    }

    public function actionProfileEdit()
    {
        $this->model->savePersonalInfo();
        $this->view->render('profileEdit', $this->model->getinfo());
    }

    public function actionKeyeditor()
    {
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

    public function actionForms()
    {
        $this->view->render('forms', $this->model->getForms());
    }

    public function actionEditForm($id)
    {
        $this->view->render('edit_form', $id);
    }

    public function actionCreateForm()
    {
        $this->ifAJAX(function () {
            $this->model->createFormParams();
        });

        if (isset($_POST['submit'])) {
            $this->view->render('messages', $this->model->createForm());
            exit;
        }

        $this->view->render('new_form', $this->model->getFormParams());
    }

    public function actionDeleteForm($id)
    {
        if ($this->model->deleteForm($id[0])) {
            $this->view->render('messages', 'Форма успешно удалена.');
        } else {
            $this->view->render('messages', 'Произошла ошибка при удалении.');
        }
    }

    public function actionCreateSuccess()
    {
        $this->view->render('messages', 'Форма успешно создана.');
    }
}