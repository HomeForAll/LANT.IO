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
            case 'mail':
                $this->mail();
                break;
            case 'fb':
                $this->fb();
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
                $_SESSION['vk_avatar'] = $userInfo['photo_big'];
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
        if (isset($_GET['code'])) {
            $params = array(
                'code' => $_GET['code'],
                'redirect_uri' => $this->settings['ok_RedirectURL'],
                'grant_type' => 'authorization_code',
                'client_id' => $this->settings['ok_AppID'],
                'client_secret' => $this->settings['ok_SecretKey']
            );

            $url = 'http://api.odnoklassniki.ru/oauth/token.do';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            $token = json_decode($result, true);

            if (isset($token['access_token'])) {
                $sign = md5("application_key={$this->settings['ok_PublicKey']}format=jsonmethod=users.getCurrentUser" . md5("{$token['access_token']}{$this->settings['ok_SecretKey']}"));

                $params = array(
                    'method' => 'users.getCurrentUser',
                    'access_token' => $token['access_token'],
                    'application_key' => $this->settings['ok_PublicKey'],
                    'format' => 'json',
                    'sig' => $sign
                );

                $userInfo = json_decode(file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params))), true);

                $_SESSION['service'] = 'ok';
                $_SESSION['ok_userID'] = $userInfo['uid'];
                $_SESSION['ok_avatar'] = $userInfo['pic_3'];
                $_SESSION['ok_firstName'] = $userInfo['first_name'];
                $_SESSION['ok_lastName'] = $userInfo['last_name'];
                $_SESSION['ok_birthday'] = preg_replace('~([0-9]+)-([0-9]+)-([0-9]+)~', '$3.$2.$1',$userInfo['birthday']);

                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
            }
        } else {
            $url = 'http://www.odnoklassniki.ru/oauth/authorize';

            $params = array(
                'client_id' => $this->settings['ok_AppID'],
                'response_type' => 'code',
                'redirect_uri' => $this->settings['ok_RedirectURL']
            );

            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
        }
    }

    private function mail()
    {
        if (isset($_GET['code'])) {

            $params = array(
                'client_id'     => $this->settings['mail_AppID'],
                'client_secret' => $this->settings['mail_SecretKey'],
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code'],
                'redirect_uri'  => $this->settings['mail_RedirectURL']
            );

            $url = 'https://connect.mail.ru/oauth/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            $token = json_decode($result, true);

            if (isset($token['access_token'])) {
                $sign = md5("app_id={$this->settings['mail_AppID']}method=users.getInfosecure=1session_key={$token['access_token']}{$this->settings['mail_SecretKey']}");

                $params = array(
                    'method'       => 'users.getInfo',
                    'secure'       => '1',
                    'app_id'       => $this->settings['mail_AppID'],
                    'session_key'  => $token['access_token'],
                    'sig'          => $sign
                );

                $userInfo = json_decode(file_get_contents('http://www.appsmail.ru/platform/api' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo[0]['uid'])) {
                    $userInfo = array_shift($userInfo);

                    $_SESSION['service'] = 'mail';
                    $_SESSION['mail_userID'] = $userInfo['uid'];
                    $_SESSION['mail_avatar'] = $userInfo['pic_big'];
                    $_SESSION['mail_firstName'] = $userInfo['first_name'];
                    $_SESSION['mail_lastName'] = $userInfo['last_name'];
                    $_SESSION['mail_birthday'] = $userInfo['birthday'];

                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
                }
            }
        } else {
            $url = 'https://connect.mail.ru/oauth/authorize';
            $params = array(
                'client_id'     => $this->settings['mail_AppID'],
                'response_type' => 'code',
                'redirect_uri'  => $this->settings['mail_RedirectURL']
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
        }
    }

    private function fb()
    {

    }

    public function unsetServices()
    {
        unset($_SESSION['service']);

        unset($_SESSION['vk_userID']);
        unset($_SESSION['vk_email']);
        unset($_SESSION['vk_firstName']);
        unset($_SESSION['vk_lastName']);
        unset($_SESSION['vk_birthday']);
        unset($_SESSION['vk_avatar']);

        unset($_SESSION['ok_userID']);
        unset($_SESSION['ok_avatar']);
        unset($_SESSION['ok_firstName']);
        unset($_SESSION['ok_lastName']);
        unset($_SESSION['ok_birthday']);

        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
    }
}