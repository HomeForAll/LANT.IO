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
       $data = array_merge($this->model->getCabinetData(), $this->model->getinfo());
       $data['access'] = $this->checkAccessLevel($_SESSION['status']);
        $this->view->render('cabinet', $data);
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

    public function actionShowGadgets()
    {
        $gadgets_page_default = $this->model->getgadgets();
        $delete_gadget = $this->model->delete_gadget();

        $viewgadgets = $gadgets_page_default;

        for ($i = 0; $i <= $_SESSION['count_of_delete_buttons_for_gadgets']; $i++) {
            if (isset($_POST["delete" . $i]))
                $viewgadgets = $delete_gadget;
        }
        $this->view->render('gadgets', $viewgadgets);
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
        $this->ifAJAX(function () {
            $this->model->handleFormParams();
        });

        $this->view->render('edit_form', $this->model->getFormData($id[0]));
    }

    public function actionCreateForm()
    {
        $this->ifAJAX(function () {
            $this->model->handleFormParams();
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
    
        public function actionBalance()
    {
        $data = $this->model-> getinfo();
       $access =  $this->checkAccessLevel($_SESSION['status']);
       $data['access'] = $access;
        $this->view->render('balance', $data);
    }

    public function actionBalanceHistory()
    {
      // Если отправлен запрос на поиск истории балланса
      if(!empty($_POST["view_balance_history"])){
       $data['balance_history'] = $this->model->getBalanceHistory();

      }
       $access =  $this->checkAccessLevel($_SESSION['status']);
       $data['access'] = $access;
       $data['script'][0] = 'pickmeup.js';
       $data['css'][0] = 'calendar.css';
       $this->view->render('balancehistory', $data);
    }
}
