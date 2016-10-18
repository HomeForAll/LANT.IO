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

    public function actionOk()
    {
        $this->model->getUserInfo('ok');
    }

    public function actionMail()
    {
        $this->model->getUserInfo('mail');
    }

    public function actionYa()
    {
        $this->model->getUserInfo('ya');
    }

    public function actionGoo() {
        // TODO: Реализовать авторизацию через Google
    }

    public function actionFb()
    {
        $this->model->getUserInfo('fb');
    }

    public function actionUnset()
    {
        $this->model->unsetServices();
    }
}