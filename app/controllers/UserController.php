<?php

class UserController extends Controller
{
    public function actionRegistration()
    {
        $data = array(
            'info' => array()
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
            if ($this->model->userVerify()) {
                $_SESSION['authorized'] = true;
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet');
            } else {
                $data = '<span style="color: red;">Вы указали неверные сведения.</span><br>';
                $this->view->render('login', $data);
            }
        } elseif (isset($_SESSION['authorized'])) {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet');
        } else {
            $this->view->render('login');
        }
    }

    public function actionLogout()
    {
        unset($_SESSION['authorized']);
        header('Location: http://' . $_SERVER['HTTP_HOST']);
    }
}