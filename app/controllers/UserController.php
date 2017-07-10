<?php

class UserController extends Controller
{
    use Cleaner;
    
    public function __construct($layout)
    {
        parent::__construct($layout);
        $this->setModel(new UserModel());
    }
    
    public function actionRegistration()
    {
        if (isset($_SESSION['OAuth_state'])) {
            if ($_SESSION['OAuth_state'] == 2) {
                if (isset($_POST['submit'])) {
                    $this->view->render(
                        'social_registration', [
                                                 'user_id'      => $_SESSION['OAuth_user_id'],
                                                 'avatar'       => $_SESSION['OAuth_avatar'],
                                                 'first_name'   => $_SESSION['OAuth_first_name'],
                                                 'last_name'    => $_SESSION['OAuth_last_name'],
                                                 'service_name' => $_SESSION['OAuth_service'],
                                                 'errors'       => $this->model('UserModel')->doRegistration(),
                                             ]
                    );
                } elseif (isset($_POST['cancel_social_registration'])) {
                    $this->clearOAuth();
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
                    exit;
                } else {
                    $this->view->render(
                        'social_registration', [
                                                 'user_id'      => $_SESSION['OAuth_user_id'],
                                                 'avatar'       => $_SESSION['OAuth_avatar'],
                                                 'first_name'   => $_SESSION['OAuth_first_name'],
                                                 'last_name'    => $_SESSION['OAuth_last_name'],
                                                 'service_name' => $_SESSION['OAuth_service'],
                                             ]
                    );
                }
            } else {
                $this->view->render('registration');
            }
        } elseif (isset($_POST['submit'])) {
            $this->view->render('registration', $this->model('UserModel')->doRegistration());
        } else {
            $this->view->render('registration');
        }
    }
    
    public function actionLogin()
    {
        var_dump($_SESSION);
//        var_dump(password_hash('s_121994_S', PASSWORD_DEFAULT));
//        var_dump(password_verify('s_121994_S', '$2y$10$SwUuv6UPCCiX0/t0BiaU5.iskqSxQISEc1U141HxMABz3MzvYWwFq'));
        if (isset($_POST['submit'])) {
            $this->view->render('login', $this->model('UserModel')->login($_POST['login'], $_POST['password']));
        } elseif (isset($_SESSION['OAuth_state'])) {
            if ($_SESSION['OAuth_state'] == 1) {
                $this->model('UserModel')->OAuthLogin($_SESSION['OAuth_service'], $_SESSION['OAuth_user_id']);
            }
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
        $this->model('UserModel')->logout();
        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit;
    }
    
    public function actionOAuth($data = null)
    {
        $this->model('UserModel')->getOAuthData($data);
    }
}