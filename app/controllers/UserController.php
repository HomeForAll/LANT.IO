<?php

class UserController extends Controller
{
    
    public function actionRegistration()
    {
        
        if (isset($_SESSION['action'])) {
            if ($_SESSION['action'] == 'login') {
                $this->model->destroyOAuthSessionData();
            }
        }
        
        $data = array(
            'info' => array(),
        );
        
        if (isset($_POST['submit'])) {
            $data = $this->model->checkUserInformation();
            
            if (empty($data['info'])) {
                $data['info'][] = 'Благодарим вас за регистрацию!';
                $this->model->registerUser();
                unset($_POST);
            }
        }
        $this->view->render('registration', $data);
    }
    
    public function actionLogin()
    {
        if (isset($_POST['submit'])) {
            $this->view->render('login', $this->model->doLogin());
        } elseif (isset($_SESSION['action'])) {
            if ($_SESSION['action'] == 'login') {
                foreach ($_SESSION['services'] as $service => $value) {
                    switch ($service) {
                        case 'vk':
                            $this->model->checkService('vk', $_SESSION['vk_userID']);
                            break;
                        case 'ok':
                            $this->model->checkService('ok', $_SESSION['ok_userID']);
                            break;
                        case 'mail':
                            $this->model->checkService('mail', $_SESSION['mail_userID']);
                            break;
                        case 'ya':
                            $this->model->checkService('ya', $_SESSION['ya_userID']);
                            break;
                        case 'goo':
                            $this->model->checkService('goo', $_SESSION['goo_userID']);
                            break;
                        case 'fb':
                            $this->model->checkService('fb', $_SESSION['fb_userID']);
                            break;
                        case 'steam':
                            $this->model->checkService('steam', $_SESSION['steam_userID']);
                            break;
                    }
                }
            }
        } elseif (isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet');
            exit;
        } else {
            $this->view->render('login');
        }
    }
    
    public function actionOAuthGetData($service = null)
    {
        $this->model->getOAuthSessionData($service);
    }
    
    public function actionOAuthDestroyData($service = null)
    {
        $this->model->destroyOAuthSessionData($service);
        
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
        exit;
    }
    
    public function actionLogout()
    {
        unset($_SESSION['authorized']);
        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit;
    }
}