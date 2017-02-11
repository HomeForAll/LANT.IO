<?php

class UserController extends Controller
{

    public function actionRegistration($socialServiceName = null)
    {
        if (!empty($socialServiceName || isset($_SESSION['social_data']))) {
            if (isset($_POST['cancel_social_registration'])) {
                unset($_SESSION['social_data']);
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
                exit;
            } elseif (isset($_SESSION['social_data'])) {
                $data = $_SESSION['social_data'];

                if (isset($_POST['submit'])) {
                    $this->view->render('social_registration', array(
                        'user_id' => $data['userID'],
                        'avatar' => $data['avatar'],
                        'first_name' => $data['firstName'],
                        'last_name' => $data['lastName'],
                        'service_name' => $data['service_name'],
                        'errors' => $this->model->doRegistration(),
                    ));
                } else {
                    $this->view->render('social_registration', array(
                        'user_id' => $data['userID'],
                        'avatar' => $data['avatar'],
                        'first_name' => $data['firstName'],
                        'last_name' => $data['lastName'],
                        'service_name' => $data['service_name'],
                    ));
                }
            } else {
                $socialNets = new SocialNets('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
                $result = $socialNets->router($socialServiceName[0]);
                $result['service_name'] = $socialServiceName[0];
                $_SESSION['social_data'] = $result;

                if (isset($_POST['submit'])) {
                    $this->view->render('social_registration', array(
                        'user_id' => $result['userID'],
                        'avatar' => $result['avatar'],
                        'first_name' => $result['firstName'],
                        'last_name' => $result['lastName'],
                        'service_name' => $result['service_name'],
                        'errors' => $this->model->doRegistration(),
                    ));
                } else {
                    $this->view->render('social_registration', array(
                        'user_id' => $result['userID'],
                        'avatar' => $result['avatar'],
                        'first_name' => $result['firstName'],
                        'last_name' => $result['lastName'],
                        'service_name' => $result['service_name'],
                    ));
                }
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
            $this->model->OAuthLogin($_SESSION['OAuth_service'], $_SESSION['OAuth_user_id']);
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