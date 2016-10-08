<?php

class AuthModel
{
    private $settings;

    public function __construct()
    {
        $this->settings = require ROOT_DIR . '/app/config/auth.php';
    }

    public function getUserInfo($service)
    {
        switch ($service) {
            case 'vk':
                $this->vk();
                break;
            case 'ok':
                $this->ok();
                break;
            case 'fb':
                break;
        }
    }

    private function vk()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id' => $this->settings['vk_AppID'],
                'client_secret' => $this->settings['vk_SecretKey'],
                'code' => $_GET['code'],
                'redirect_uri' => $this->settings['vk_RedirectURL']
            );

            $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

            if (isset($token['access_token'])) {
                $params = array(
                    'uids' => $token['user_id'],
                    'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,country',
                    'access_token' => $token['access_token']
                );

                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['response'][0]['uid'])) {
                    $userInfo = $userInfo['response'][0];
                }

                $_SESSION['service'] = 'vk';
                $_SESSION['vk_userID'] = $token['user_id'];
                $_SESSION['vk_email'] = $token['email'];
                $_SESSION['vk_firstName'] = $userInfo['first_name'];
                $_SESSION['vk_lastName'] = $userInfo['last_name'];
                $_SESSION['vk_birthday'] = $userInfo['bdate'];

                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
            }
        } else {
            $url = 'http://oauth.vk.com/authorize';

            $params = array(
                'client_id' => $this->settings['vk_AppID'],
                'redirect_uri' => $this->settings['vk_RedirectURL'],
                'display' => 'page',
                'scope' => 'email',
                'response_type' => 'code'
            );

            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
        }
    }

    private function ok()
    {

    }
}