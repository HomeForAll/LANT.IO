<?php

class CabinetController extends Controller
{
    public function __construct($template)
    {
        parent::__construct($template);
        $this->checkAuth();
        $this->setModel(new CabinetModel());
    }

    public function actionCabinet()
    {
        $data = array_merge($this->model('CabinetModel')->getCabinetData(), $this->model('CabinetModel')->getinfo());
        $data['access'] = $this->checkAccessLevel();
        $this->view->render('cabinet', $data);
    }

    public function actionChat($idChat)
    {
        $idChat = $idChat[0];
        $viewchat = $this->model('CabinetModel')->getChatInfo($idChat);

        if (isset($_POST['add_admin']))
            $viewchat = $this->model('CabinetModel')->getAdminsForDialog();


        $this->view->render('chat', $viewchat);
    }

    public function actionDeleteDialog($idDialog)
    {
        $idDialog = $idDialog[0];
        $this->model('CabinetModel')->deleteDialog($idDialog);
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet/dialogs');
        exit;
    }

    public function actionDialogs()
    {
        $dialogs_page_defualt = $this->model('CabinetModel')->getDialogs(true);
        $viewdialogs = $dialogs_page_defualt;
        if (isset($_POST['dialogs']))
            $viewdialogs = $this->model('CabinetModel')->getDialogs(true);

        if (isset($_POST['deleted_dialogs']))
            $viewdialogs = $this->model('CabinetModel')->getDeletedDialogs();

        if (isset($_POST['create_new_dialog']))
            $viewdialogs = $this->model('CabinetModel')->getUsersForDialog();

        if (isset($_POST['add_users']))
            $viewdialogs = $this->model('CabinetModel')->createNewDialog();

        $this->view->render('dialogs', $viewdialogs);
    }

    public function actionGenerator()
    {
        if (!$this->access['key_generator']) {
            $this->view->render('no_access');
            return;
        }

        $this->model('CabinetModel')->generate();
        $this->model('CabinetModel')->handleKeys();
        $this->view->render('generator');
    }

    public function actionShowActivity()
    {
        $this->view->render('activity_page', $this->model('CabinetModel')->getinfo());
    }

    public function actionShowGadgets()
    {
        $gadgets_page_default = $this->model('CabinetModel')->getgadgets();
        $viewgadgets = $gadgets_page_default;

        for ($i = 0; $i <= $_SESSION['count_of_delete_buttons_for_gadgets']; $i++) {
            if (isset($_POST["delete" . $i]))
                $viewgadgets = $this->model('CabinetModel')->delete_gadget();
        }

        if (isset($_POST['close_all_sessions'])) {
            $this->model('CabinetModel')->close_all_sessions();
        }

        $this->view->render('gadgets', $viewgadgets);
    }

    public function actionGetProfileInfo()
    {
        $this->model('CabinetModel')->getProfileInfo();
    }

    public function actionProfileEdit()
    {
        $this->model('CabinetModel')->savePersonalInfo();
        $this->view->render('profileEdit', $this->model('CabinetModel')->getinfo());
    }

    public function actionKeyeditor()
    {
        if (!$this->access['key_editor']) {
            $this->view->render('no_access');
            return;
        }

        $showdb = $this->model('CabinetModel')->showdb();
        $keyeditor = $this->model('CabinetModel')->keyeditor();
        $keylock = $this->model('CabinetModel')->keylock();
        $keyunlock = $this->model('CabinetModel')->keyunlock();
        $installdate = $this->model('CabinetModel')->installdate();
        $page = $this->model('CabinetModel')->page();
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
        $this->view->render('forms', $this->model('CabinetModel')->getForms());
    }

    public function actionEditForm($id)
    {
        $this->ifAJAX(function () {
            $this->model('CabinetModel')->handleFormParams();
        });

        $this->view->render('edit_form', $this->model('CabinetModel')->getFormData($id[0]));
    }

    public function actionCreateForm()
    {
        $this->ifAJAX(function () {
            $this->model('CabinetModel')->handleFormParams();
        });

        if (isset($_POST['submit'])) {
            $this->view->render('messages', $this->model('CabinetModel')->createForm());
            exit;
        }

        $this->view->render('new_form', $this->model('CabinetModel')->getFormParams());
    }

    public function actionDeleteForm($id)
    {
        if ($this->model('CabinetModel')->deleteForm($id[0])) {
            $this->view->render('messages', 'Форма успешно удалена.');
        } else {
            $this->view->render('messages', 'Произошла ошибка при удалении.');
        }
    }

    public function actionFormsNew()
    {
        $this->view->render('form_editor');
    }

    public function actionCreateSuccess()
    {
        $this->view->render('messages', 'Форма успешно создана.');
    }

    public function actionPayment()
    {
        $data = $this->model('CabinetModel')->getinfo()[0];
        $access = $this->checkAccessLevel();
        $data['access'] = $access;
        $this->view->render('payment', $data);
    }

    public function actionBalance()
    {
        // Если отправлен запрос на поиск истории балланса
        if (!empty($_POST["view_balance_history"])) {
            $data['balance_history'] = $this->model('CabinetModel')->getBalanceHistory();

        }
        $access = $this->checkAccessLevel();
        $data['access'] = $access;
        $this->view->addJSFile('pickmeup.js');

        $data['script'][0] = 'pickmeup.js';
        $data['css'][0] = 'calendar.css';
        $this->view->render('balance', $data);
    }
}
