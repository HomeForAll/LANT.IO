<?php

class UserController extends Controller
{
    
    public function actionRegistration()
    {
        if (isset($_POST['submit'])) {
            $this->view->render('registration', $this->model->doRegistration());
        } else {
            $this->view->render('registration');
        }
    }
    
    public function actionLogin()
    {
        if (isset($_POST['submit'])) {
            $this->view->render('login', $this->model->doLogin());
        } elseif (isset($_SESSION['redirectURL'])) {
            $this->model->loginThroughOAuth();
            $this->view->render('login');
        } elseif (isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet');
            exit;
        } else {
            $this->view->render('login');
        }
    }
    
    public function actionLogout()
    {
        unset($_SESSION['authorized']);
        unset($_SESSION['userID']);
        unset($_SESSION['accountStatus']);
        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit;
    }
    
    public function actionOAuthInit($service = null)
    {
        $this->model->getOAuthData($service);
    }
    
    public function actionOAuthDestroy($service = null)
    {
        $this->model->destroyOAuthData($service);
        
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
        exit;
    }
}