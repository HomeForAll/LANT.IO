<?php

class UserController extends Controller
{
    
    public function actionRegistration()
    {
        $this->printData($_SERVER['HTTP_REFERER']);
        
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
            $this->model->choiceAction();
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