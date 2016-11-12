<?php

class SocialAuth {

    private $db;
    private $userID;
    private $settings;

    public function __construct($userID = null) {
        $this->db = new DataBase();
        $this->userID = $userID;
        $this->settings = require ROOT_DIR . '/app/config/auth.php';
    }

    public function setServiceData($service = null) {
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

    public function destroyServiceData($service = null) {
        switch ($service) {
            case 'vk':
                $this->vkDestroySessionData();
                break;
            case 'ok':
                $this->okDestroySessionData();
                break;
            case 'mail':
                $this->mailDestroySessionData();
                break;
            case 'ya':
                $this->yaDestroySessionData();
                break;
            case 'goo':
                $this->gooDestroySessionData();
                break;
            case 'fb':
                $this->fbDestroySessionData();
                break;
            case 'steam':
                $this->steamDestroySessionData();
                break;
            default:
                $this->destroyAllSessionData();
        }
    }

    private function vk() {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id'     => $this->settings['vk_AppID'],
                'client_secret' => $this->settings['vk_SecretKey'],
                'code'          => $_GET['code'],
                'redirect_uri'  => $this->settings['vk_RedirectURL'],
            );

            $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

            if (isset($token['access_token'])) {
                $params = array(
                    'uids'         => $token['user_id'],
                    'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,country',
                    'access_token' => $token['access_token'],
                );

                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['response'][0]['uid'])) {
                    $userInfo = $userInfo['response'][0];
                }

                $data = array(
                    'service'  => 'vk',
                    'userInfo' => array(
                        'vk_avatar'    => $userInfo['photo_big'],
                        'vk_userID'    => $token['user_id'],
                        'vk_email'     => $token['email'],
                        'vk_firstName' => $userInfo['first_name'],
                        'vk_lastName'  => $userInfo['last_name'],
                        'vk_birthday'  => $userInfo['bdate'],
                    ),
                );

                $_SESSION['services'][$data['service']] = true;
                foreach ($data['userInfo'] as $key => $value) {
                    $_SESSION[$key] = $value;
                }
            }
        } else {
            $url = 'http://oauth.vk.com/authorize';
            $params = array(
                'client_id'     => $this->settings['vk_AppID'],
                'redirect_uri'  => $this->settings['vk_RedirectURL'],
                'display'       => 'page',
                'scope'         => 'email',
                'response_type' => 'code',
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }
    }

    private function ok() {
        if (isset($_GET['code'])) {
            $params = array(
                'code'          => $_GET['code'],
                'redirect_uri'  => $this->settings['ok_RedirectURL'],
                'grant_type'    => 'authorization_code',
                'client_id'     => $this->settings['ok_AppID'],
                'client_secret' => $this->settings['ok_SecretKey'],
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
                    'method'          => 'users.getCurrentUser',
                    'access_token'    => $token['access_token'],
                    'application_key' => $this->settings['ok_PublicKey'],
                    'format'          => 'json',
                    'sig'             => $sign,
                );

                $userInfo = json_decode(file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params))), true);

                $data = array(
                    'service'  => 'ok',
                    'userInfo' => array(
                        'ok_userID'    => $userInfo['uid'],
                        'ok_avatar'    => $userInfo['pic_3'],
                        'ok_firstName' => $userInfo['first_name'],
                        'ok_lastName'  => $userInfo['last_name'],
                        'ok_birthday'  => preg_replace('~([0-9]+)-([0-9]+)-([0-9]+)~', '$3.$2.$1', $userInfo['birthday']),
                    ),
                );

                $_SESSION['services'][$data['service']] = true;
                foreach ($data['userInfo'] as $key => $value) {
                    $_SESSION[$key] = $value;
                }
            }
        } else {
            $url = 'http://www.odnoklassniki.ru/oauth/authorize';

            $params = array(
                'client_id'     => $this->settings['ok_AppID'],
                'response_type' => 'code',
                'redirect_uri'  => $this->settings['ok_RedirectURL'],
            );

            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    private function mail() {
        if (isset($_GET['code'])) {

            $params = array(
                'client_id'     => $this->settings['mail_AppID'],
                'client_secret' => $this->settings['mail_SecretKey'],
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code'],
                'redirect_uri'  => $this->settings['mail_RedirectURL'],
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
                    'method'      => 'users.getInfo',
                    'secure'      => '1',
                    'app_id'      => $this->settings['mail_AppID'],
                    'session_key' => $token['access_token'],
                    'sig'         => $sign,
                );

                $userInfo = json_decode(file_get_contents('http://www.appsmail.ru/platform/api' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo[0]['uid'])) {
                    $userInfo = array_shift($userInfo);

                    $data = array(
                        'service'  => 'mail',
                        'userInfo' => array(
                            'mail_userID'    => $userInfo['uid'],
                            'mail_avatar'    => $userInfo['pic_big'],
                            'mail_firstName' => $userInfo['first_name'],
                            'mail_lastName'  => $userInfo['last_name'],
                            'mail_birthday'  => $userInfo['birthday'],
                        ),
                    );

                    $_SESSION['services'][$data['service']] = true;
                    foreach ($data['userInfo'] as $key => $value) {
                        $_SESSION[$key] = $value;
                    }
                }
            }
        } else {
            $url = 'https://connect.mail.ru/oauth/authorize';
            $params = array(
                'client_id'     => $this->settings['mail_AppID'],
                'response_type' => 'code',
                'redirect_uri'  => $this->settings['mail_RedirectURL'],
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    private function ya() {
        if (isset($_GET['code'])) {
            $params = array(
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code'],
                'client_id'     => $this->settings['ya_AppID'],
                'client_secret' => $this->settings['ya_SecretKey'],
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
                    'format'      => 'json',
                    'oauth_token' => $token['access_token'],
                );

                $userInfo = json_decode(file_get_contents('https://login.yandex.ru/info' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo['id'])) {
                    $data = array(
                        'service'  => 'ya',
                        'userInfo' => array(
                            'ya_userID'    => $userInfo['id'],
                            'ya_avatar'    => (isset($userInfo['is_avatar_empty'])) ? 'https://avatars.mds.yandex.net/get-yapic/0/0-0/islands-200' : 'https://avatars.yandex.net/get-yapic/' . $userInfo['default_avatar_id'] . '/islands-200',
                            'ya_firstName' => $userInfo['first_name'],
                            'ya_lastName'  => $userInfo['last_name'],
                            'ya_birthday'  => $userInfo['birthday'],
                        ),
                    );

                    $_SESSION['services'][$data['service']] = true;
                    foreach ($data['userInfo'] as $key => $value) {
                        $_SESSION[$key] = $value;
                    }
                }
            }
        } else {
            $url = 'https://oauth.yandex.ru/authorize';
            $params = array(
                'response_type' => 'code',
                'client_id'     => $this->settings['ya_AppID'],
                'display'       => 'popup',
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    private function goo() {
        if (isset($_GET['code'])) {

            $params = array(
                'client_id'     => $this->settings['goo_AppID'],
                'client_secret' => $this->settings['goo_SecretKey'],
                'redirect_uri'  => $this->settings['goo_RedirectURL'],
                'grant_type'    => 'authorization_code',
                'code'          => $_GET['code'],
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

                $data = array(
                    'service'  => 'goo',
                    'userInfo' => array(
                        'goo_userID'    => $userInfo['id'],
                        'goo_avatar'    => $userInfo['picture'],
                        'goo_firstName' => $userInfo['given_name'],
                        'goo_lastName'  => $userInfo['family_name'],
                    ),
                );

                $_SESSION['services'][$data['service']] = true;
                foreach ($data['userInfo'] as $key => $value) {
                    $_SESSION[$key] = $value;
                }
            }

        } else {
            $url = 'https://accounts.google.com/o/oauth2/auth';
            $params = array(
                'redirect_uri'  => $this->settings['goo_RedirectURL'],
                'response_type' => 'code',
                'client_id'     => $this->settings['goo_AppID'],
                'scope'         => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    private function fb() {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id'     => $this->settings['fb_AppID'],
                'redirect_uri'  => $this->settings['fb_RedirectURL'],
                'client_secret' => $this->settings['fb_SecretKey'],
                'code'          => $_GET['code'],
            );

            $url = 'https://graph.facebook.com/v2.8/oauth/access_token';

            $tokenInfo = json_decode(file_get_contents($url . '?' . urldecode(http_build_query($params))));

            $params = array(
                'fields'       => 'id,first_name,last_name,picture',
                'access_token' => $tokenInfo->access_token,
            );

            $userInfo = json_decode(file_get_contents('https://graph.facebook.com/v2.8/me/' . '?' . urldecode(http_build_query($params))), true);

            $data = array(
                'service'  => 'fb',
                'userInfo' => array(
                    'fb_userID'    => $userInfo['id'],
                    'fb_avatar'    => $userInfo['picture']['data']['url'],
                    'fb_firstName' => $userInfo['first_name'],
                    'fb_lastName'  => $userInfo['last_name'],
                ),
            );

            $_SESSION['services'][$data['service']] = true;
            foreach ($data['userInfo'] as $key => $value) {
                $_SESSION[$key] = $value;
            }
        } else {
            $url = 'https://www.facebook.com/v2.8/dialog/oauth';
            $params = array(
                'client_id'     => $this->settings['fb_AppID'],
                'redirect_uri'  => $this->settings['fb_RedirectURL'],
                'response_type' => 'code',
                'scope'         => 'email,public_profile,user_friends',
            );
            $location = $url . '?' . urldecode(http_build_query($params));
            header('Location: ' . $location);
            exit;
        }
    }

    private function steam() {
        $steamAuth = new SteamAuth($this->settings['s_RedirectURL'], $this->settings['s_ApiKey']);
        $steamAuth->login();
    }

    private function vkDestroySessionData() {
        unset($_SESSION['action']);
        unset($_SESSION['services']['vk']);
        unset($_SESSION['vk_userID']);
        unset($_SESSION['vk_email']);
        unset($_SESSION['vk_firstName']);
        unset($_SESSION['vk_lastName']);
        unset($_SESSION['vk_birthday']);
        unset($_SESSION['vk_avatar']);

        if (empty($_SESSION['services'])) {
            unset($_SESSION['services']);
        }
    }

    private function okDestroySessionData() {
        unset($_SESSION['action']);
        unset($_SESSION['services']['ok']);
        unset($_SESSION['ok_userID']);
        unset($_SESSION['ok_avatar']);
        unset($_SESSION['ok_firstName']);
        unset($_SESSION['ok_lastName']);
        unset($_SESSION['ok_birthday']);

        if (empty($_SESSION['services'])) {
            unset($_SESSION['services']);
        }
    }

    private function mailDestroySessionData() {
        unset($_SESSION['action']);
        unset($_SESSION['services']['mail']);
        unset($_SESSION['mail_userID']);
        unset($_SESSION['mail_avatar']);
        unset($_SESSION['mail_firstName']);
        unset($_SESSION['mail_lastName']);
        unset($_SESSION['mail_birthday']);

        if (empty($_SESSION['services'])) {
            unset($_SESSION['services']);
        }
    }

    private function yaDestroySessionData() {
        unset($_SESSION['action']);
        unset($_SESSION['services']['ya']);
        unset($_SESSION['ya_userID']);
        unset($_SESSION['ya_avatar']);
        unset($_SESSION['ya_firstName']);
        unset($_SESSION['ya_lastName']);
        unset($_SESSION['ya_birthday']);

        if (empty($_SESSION['services'])) {
            unset($_SESSION['services']);
        }
    }

    private function gooDestroySessionData() {
        unset($_SESSION['action']);
        unset($_SESSION['services']['goo']);
        unset($_SESSION['goo_userID']);
        unset($_SESSION['goo_avatar']);
        unset($_SESSION['goo_firstName']);
        unset($_SESSION['goo_lastName']);

        if (empty($_SESSION['services'])) {
            unset($_SESSION['services']);
        }
    }

    private function fbDestroySessionData() {
        unset($_SESSION['action']);
        unset($_SESSION['services']['fb']);
        unset($_SESSION['fb_userID']);
        unset($_SESSION['fb_avatar']);
        unset($_SESSION['fb_firstName']);
        unset($_SESSION['fb_lastName']);

        if (empty($_SESSION['services'])) {
            unset($_SESSION['services']);
        }
    }

    private function steamDestroySessionData() {
        unset($_SESSION['action']);
        unset($_SESSION['services']['steam']);
        unset($_SESSION['steam_userID']);
        unset($_SESSION['steam_nickName']);
        unset($_SESSION['steam_firstName']);
        unset($_SESSION['steam_avatar']);

        if (empty($_SESSION['services'])) {
            unset($_SESSION['services']);
        }
    }

    private function destroyAllSessionData() {
        unset($_SESSION['services']);

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
        unset($_SESSION['steam_userID']);
        unset($_SESSION['steam_nickName']);
        unset($_SESSION['steam_firstName']);
        unset($_SESSION['steam_avatar']);

        unset($_SESSION['action']);
    }
}