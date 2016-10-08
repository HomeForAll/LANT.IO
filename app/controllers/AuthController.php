<?php

class AuthController extends Controller
{
    public function __construct($pageName, $view, $modelName)
    {
        parent::__construct($pageName);
        $this->model = new $modelName();
    }

    public function actionVk()
    {
        $this->model->getUserInfo('vk');
    }

    public function actionUnset() {
        unset($_SESSION['service']);
        unset($_SESSION['vk_userID']);
        unset($_SESSION['vk_email']);
        unset($_SESSION['vk_firstName']);
        unset($_SESSION['vk_lastName']);
        unset($_SESSION['vk_birthday']);
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
    }
}