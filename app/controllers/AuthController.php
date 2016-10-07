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
        if (isset($_GET['code'])) {
            $token = $this->model->getVkToken($_GET['code']);
            $_SESSION['vkUserID'] = $token['user_id'];
            $_SESSION['vkUserEmail'] = $token['email'];

            if (isset($token['access_token'])) {
                $userInfo = $this->model->getVkUserInfo($token);

                $_SESSION['firstName'] = $userInfo['first_name'];
                $_SESSION['lastName'] = $userInfo['last_name'];
                $_SESSION['birthday'] = $userInfo['bdate'];
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
            }
        } else {
            $location = $this->model->getURL('vk');
            header('Location: ' . $location);
        }
    }
}