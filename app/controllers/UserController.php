<?php

class UserController extends Controller
{
    use Cleaner;

    public function actionRegistration()
    {
        if (isset($_SESSION['OAuth_state'])) {
            if ($_SESSION['OAuth_state'] == 2) {
                if (isset($_POST['submit'])) {
                    $this->view->render('social_registration', array(
                        'user_id' => $_SESSION['OAuth_user_id'],
                        'avatar' => $_SESSION['OAuth_avatar'],
                        'first_name' => $_SESSION['OAuth_first_name'],
                        'last_name' => $_SESSION['OAuth_last_name'],
                        'service_name' => $_SESSION['OAuth_service'],
                        'errors' => $this->model->doRegistration(),
                    ));
                } elseif (isset($_POST['cancel_social_registration'])) {
                    $this->clearOAuth();
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
                    exit;
                } else {
                    $this->view->render('social_registration', array(
                        'user_id' => $_SESSION['OAuth_user_id'],
                        'avatar' => $_SESSION['OAuth_avatar'],
                        'first_name' => $_SESSION['OAuth_first_name'],
                        'last_name' => $_SESSION['OAuth_last_name'],
                        'service_name' => $_SESSION['OAuth_service'],
                    ));
                }
            } else {
                $this->view->render('registration');
            }
        } elseif (isset($_POST['submit'])) {
            $this->view->render('registration', $this->model->doRegistration());
        } else {
            $this->view->render('registration');
        }
    }

    public function actionLogin()
    {
        if (isset($_POST['submit'])) {
            $this->view->render('login', $this->model->doLogin());
        } elseif (isset($_SESSION['OAuth_state'])) {
            if ($_SESSION['OAuth_state'] == 1) {
                $this->model->OAuthLogin($_SESSION['OAuth_service'], $_SESSION['OAuth_user_id']);
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
        unset($_SESSION['authorized']);
        unset($_SESSION['userID']);
        unset($_SESSION['status']);
        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit;
    }

    public function actionOAuth($data = null)
    {
        $this->model->getOAuthData($data);
    }
}