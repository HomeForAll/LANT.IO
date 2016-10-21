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
            case 'ya':
                $this->ya();
                break;
            case 'goo':
                $this->goo();
                break;
            case 'fb':
                $this->fb();
                break;
            case 'steam':
                $this->steam();
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
                $_SESSION['ok_birthday'] = preg_replace('~([0-9]+)-([0-9]+)-([0-9]+)~', '$3.$2.$1', $userInfo['birthday']);

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
                'client_id' => $this->settings['mail_AppID'],
                'client_secret' => $this->settings['mail_SecretKey'],
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'redirect_uri' => $this->settings['mail_RedirectURL']
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
                    'method' => 'users.getInfo',
                    'secure' => '1',
                    'app_id' => $this->settings['mail_AppID'],
                    'session_key' => $token['access_token'],
                    'sig' => $sign
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
                'client_id' => $this->settings['mail_AppID'],
                'response_type' => 'code',
                'redirect_uri' => $this->settings['mail_RedirectURL']
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
        }
    }

    private function ya()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'client_id' => $this->settings['ya_AppID'],
                'client_secret' => $this->settings['ya_SecretKey']
            );

            $url = 'https://oauth.yandex.ru/token';

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
                $params = array(
                    'format' => 'json',
                    'oauth_token' => $token['access_token']
                );

                $userInfo = json_decode(file_get_contents('https://login.yandex.ru/info' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['id'])) {
                    $_SESSION['service'] = 'ya';
                    $_SESSION['ya_userID'] = $userInfo['id'];
                    $_SESSION['ya_avatar'] = (isset($userInfo['is_avatar_empty'])) ? 'https://avatars.mds.yandex.net/get-yapic/0/0-0/islands-200' : 'https://avatars.yandex.net/get-yapic/' . $userInfo['default_avatar_id'] . '/islands-200';
                    $_SESSION['ya_firstName'] = $userInfo['first_name'];
                    $_SESSION['ya_lastName'] = $userInfo['last_name'];
                    $_SESSION['ya_birthday'] = $userInfo['birthday'];

                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
                }
            }
        } else {
            $url = 'https://oauth.yandex.ru/authorize';
            $params = array(
                'response_type' => 'code',
                'client_id' => $this->settings['ya_AppID'],
                'display' => 'popup'
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
        }
    }

    private function goo()
    {
        if (isset($_GET['code'])) {

            $params = array(
                'client_id' => $this->settings['goo_AppID'],
                'client_secret' => $this->settings['goo_SecretKey'],
                'redirect_uri' => $this->settings['goo_RedirectURL'],
                'grant_type' => 'authorization_code',
                'code' => $_GET['code']
            );

            $url = 'https://accounts.google.com/o/oauth2/token';

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);
            $tokenInfo = json_decode($result, true);

            if (isset($tokenInfo['access_token'])) {
                $params['access_token'] = $tokenInfo['access_token'];

                $userInfo = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo' . '?' . urldecode(http_build_query($params))), true);
            }

            if ($result) {
                $_SESSION['service'] = 'goo';
                $_SESSION['goo_userID'] = $userInfo['id'];
                $_SESSION['goo_avatar'] = $userInfo['picture'];
                $_SESSION['goo_firstName'] = $userInfo['given_name'];
                $_SESSION['goo_lastName'] = $userInfo['family_name'];
            }

            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');

        } else {
            $url = 'https://accounts.google.com/o/oauth2/auth';
            $params = array(
                'redirect_uri' => $this->settings['goo_RedirectURL'],
                'response_type' => 'code',
                'client_id' => $this->settings['goo_AppID'],
                'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile'
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
        }
    }

    private function fb()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id' => $this->settings['fb_AppID'],
                'redirect_uri' => $this->settings['fb_RedirectURL'],
                'client_secret' => $this->settings['fb_SecretKey'],
                'code' => $_GET['code']
            );

            $url = 'https://graph.facebook.com/v2.8/oauth/access_token';

            $tokenInfo = json_decode(file_get_contents($url . '?' . urldecode(http_build_query($params))));

            $params = array(
                'fields' => 'id,first_name,last_name,picture',
                'access_token' => $tokenInfo->access_token,
            );

            $userInfo = json_decode(file_get_contents('https://graph.facebook.com/v2.8/me/' . '?' . urldecode(http_build_query($params))), true);

            $_SESSION['service'] = 'fb';
            $_SESSION['fb_userID'] = $userInfo['id'];
            $_SESSION['fb_avatar'] = $userInfo['picture']['data']['url'];
            $_SESSION['fb_firstName'] = $userInfo['first_name'];
            $_SESSION['fb_lastName'] = $userInfo['last_name'];

            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
        } else {
            $url = 'https://www.facebook.com/v2.8/dialog/oauth';
            $params = array(
                'client_id' => $this->settings['fb_AppID'],
                'redirect_uri' => $this->settings['fb_RedirectURL'],
                'response_type' => 'code',
                'scope' => 'email,public_profile,user_friends'
            );
            $location = $url . '?' . urldecode(http_build_query($params));
            header('Location: ' . $location);
        }
    }

    public function steam() {
        $steamAuth = new SteamAuth($this->settings['s_RedirectURL'], $this->settings['s_ApiKey']);
        $steamAuth->login();
    }

    public function unsetServices()
    {
        unset($_SESSION['service']);

        // Вконтакте
        unset($_SESSION['vk_userID']);
        unset($_SESSION['vk_email']);
        unset($_SESSION['vk_firstName']);
        unset($_SESSION['vk_lastName']);
        unset($_SESSION['vk_birthday']);
        unset($_SESSION['vk_avatar']);

        // Одноклассники
        unset($_SESSION['ok_userID']);
        unset($_SESSION['ok_avatar']);
        unset($_SESSION['ok_firstName']);
        unset($_SESSION['ok_lastName']);
        unset($_SESSION['ok_birthday']);

        // Mail.ru
        unset($_SESSION['mail_userID']);
        unset($_SESSION['mail_avatar']);
        unset($_SESSION['mail_firstName']);
        unset($_SESSION['mail_lastName']);
        unset($_SESSION['mail_birthday']);

        // Yandex

        unset($_SESSION['ya_userID']);
        unset($_SESSION['ya_avatar']);
        unset($_SESSION['ya_firstName']);
        unset($_SESSION['ya_lastName']);
        unset($_SESSION['ya_birthday']);

        // Google
        unset($_SESSION['goo_userID']);
        unset($_SESSION['goo_avatar']);
        unset($_SESSION['goo_firstName']);
        unset($_SESSION['goo_lastName']);

        // FaceBook
        unset($_SESSION['fb_userID']);
        unset($_SESSION['fb_avatar']);
        unset($_SESSION['fb_firstName']);
        unset($_SESSION['fb_lastName']);

        // Steam
        unset($_SESSION['s_userID']);
        unset($_SESSION['s_nickName']);
        unset($_SESSION['s_firstName']);
        unset($_SESSION['s_avatar']);


        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/registration');
    }
}