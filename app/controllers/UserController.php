<?php

class UserController extends Controller {
    public function __construct($pageName, $settings, $modelName) {
        parent::__construct($pageName);
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

        $this->view->displayPage(__FUNCTION__, $this->title, $data);
    }

    public function actionLogin() {
        $this->view->displayPage(__FUNCTION__, $this->title);
    }
}