<?php

class UserController extends Controller {
    public function __construct($pageName, $settings, $view, $modelName) {
        parent::__construct($pageName, $settings, $view, $modelName);
        $this->model = new $modelName($settings);
    }

    public function actionRegistration() {
        $data = array();

        if (isset($_POST['submit'])) {
            if (!$this->model->checkEmailValidationErrors($_POST['email'])) {
                $data[] = 'Укажите корректный E-mail.';
            } elseif ($this->model->checkEmailAvailability($_POST['email'])) {
                $data[] = 'Такой E-mail уже зарегистрирован.';
            }

            if (empty($data) && isset($_POST['firstName']) && isset($_POST['lastName'])
                && isset($_POST['phoneNumber']) && isset($_POST['password'])) {
                $data[] = 'Благодарим вас за регистрацию!';
                $this->model->registerUser();
                unset($_POST);
            } else {

            }
        }
        $this->view->displayPage($this->viewName, $this->title, $data);
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

    public function actionCP() {
        if (!isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
        } else {
            $this->view->displayPage($this->viewName, $this->title);
        }
    }
}