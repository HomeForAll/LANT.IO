<?php

class AuthController extends Controller
{
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
        $this->model->getUserInfo('goo');
    }

    public function actionFb()
    {
        $this->model->getUserInfo('fb');
    }

    public function actionSteam()
    {
        $this->model->getUserInfo('steam');
    }

    public function actionUnsetVk() {
        $this->model->unsetVk();
    }

    public function actionUnsetOk() {
        $this->model->unsetOk();
    }

    public function actionUnsetMail() {
        $this->model->unsetMail();
    }

    public function actionUnsetYa() {
        $this->model->unsetYa();
    }

    public function actionUnsetGoo() {
        $this->model->unsetGoo();
    }

    public function actionUnsetFb() {
        $this->model->unsetFb();
    }

    public function actionUnsetSteam() {
        $this->model->unsetSteam();
    }

    public function actionUnset()
    {
        $this->model->unsetServices();
    }
}