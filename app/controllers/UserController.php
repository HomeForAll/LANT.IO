<?php

class UserController extends Controller {
    public function __construct($pageName, $view, $modelName) {
        parent::__construct($pageName, $view);
        $this->model = new $modelName();
    }

    public function actionRegistration() {
        $errors = array();

        if (isset($_POST['submit'])) {
            $errors = $this->model->checkUserInformation();

            if (empty($errors)) {
                $errors[] = 'Благодарим вас за регистрацию!';
                $this->model->registerUser();
                unset($_POST);
            }
        }
        $this->view->displayPage($this->viewName, $this->title, $errors);
    }

    public function actionLogin() {
        if (isset($_POST['submit'])) {
            if ($this->model->userVerify()) {
                $_SESSION['authorized'] = true;
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cp');
            } else {
                $data = '<span style="color: red;">Вы указали неверные сведения.</span><br>';
                $this->view->displayPage($this->viewName, $this->title, $data);
            }
        } elseif (isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cp');
        } else {
            $this->view->displayPage($this->viewName, $this->title);
        }
    }

    public function actionLogout() {
        unset($_SESSION['authorized']);
        header('Location: http://' . $_SERVER['HTTP_HOST']);
    }
}