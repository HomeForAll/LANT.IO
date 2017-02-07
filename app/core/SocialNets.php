<?php

class SocialNets extends LightOpenID
{
    private $steamID;
    private $steamApiKey;
    private $settings;
    private $redirectURL;

    public function __construct($redirectURL)
    {
        parent::__construct($redirectURL);
        $this->settings = require ROOT_DIR . '/app/config/auth.php';
        $this->redirectURL = $redirectURL;
        $this->steamApiKey = $this->settings['s_ApiKey'];
    }

    public function getVkData()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id' => $this->settings['vk_AppID'],
                'client_secret' => $this->settings['vk_SecretKey'],
                'code' => $_GET['code'],
                'redirect_uri' => $this->redirectURL,
            );

            $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

            if (isset($token['access_token'])) {
                $params = array(
                    'uids' => $token['user_id'],
                    'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,country',
                    'access_token' => $token['access_token'],
                );

                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['response'][0]['uid'])) {
                    $user = $userInfo['response'][0];

                    return array(
                        'avatar' => $user['photo_big'],
                        'userID' => $token['user_id'],
                        'email' => $token['email'],
                        'firstName' => $user['first_name'],
                        'lastName' => $user['last_name'],
                        'birthday' => $user['bdate'],
                    );
                }
            }
        } else {
            $url = 'http://oauth.vk.com/authorize';
            $params = array(
                'client_id' => $this->settings['vk_AppID'],
                'redirect_uri' => $this->redirectURL,
                'display' => 'page',
                'scope' => 'email',
                'response_type' => 'code',
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    public function getOkData()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'code' => $_GET['code'],
                'redirect_uri' => $this->redirectURL,
                'grant_type' => 'authorization_code',
                'client_id' => $this->settings['ok_AppID'],
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
                    'method' => 'users.getCurrentUser',
                    'access_token' => $token['access_token'],
                    'application_key' => $this->settings['ok_PublicKey'],
                    'format' => 'json',
                    'sig' => $sign,
                );

                $userInfo = json_decode(file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params))), true);

                if ($userInfo) {
                    return array(
                        'userID' => $userInfo['uid'],
                        'avatar' => $userInfo['pic_3'],
                        'firstName' => $userInfo['first_name'],
                        'lastName' => $userInfo['last_name'],
                        'birthday' => preg_replace('~([0-9]+)-([0-9]+)-([0-9]+)~', '$3.$2.$1', $userInfo['birthday']),
                    );
                }
            }
        } else {
            $url = 'http://www.odnoklassniki.ru/oauth/authorize';

            $params = array(
                'client_id' => $this->settings['ok_AppID'],
                'response_type' => 'code',
                'redirect_uri' => $this->redirectURL,
            );

            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    public function getMailData()
    {
        if (isset($_GET['code'])) {

            $params = array(
                'client_id' => $this->settings['mail_AppID'],
                'client_secret' => $this->settings['mail_SecretKey'],
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'redirect_uri' => $this->redirectURL,
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
                    'sig' => $sign,
                );

                $userInfo = json_decode(file_get_contents('http://www.appsmail.ru/platform/api' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo[0]['uid'])) {
                    $userInfo = array_shift($userInfo);

                    return array(
                        'userID' => $userInfo['uid'],
                        'avatar' => $userInfo['pic_big'],
                        'firstName' => $userInfo['first_name'],
                        'lastName' => $userInfo['last_name'],
                        'birthday' => $userInfo['birthday'],
                    );
                }
            }
        } else {
            $url = 'https://connect.mail.ru/oauth/authorize';
            $params = array(
                'client_id' => $this->settings['mail_AppID'],
                'response_type' => 'code',
                'redirect_uri' => $this->redirectURL,
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    public function getYaData()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'client_id' => $this->settings['ya_AppID'],
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
                    'format' => 'json',
                    'oauth_token' => $token['access_token'],
                );

                $userInfo = json_decode(file_get_contents('https://login.yandex.ru/info' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['id'])) {
                    return array(
                        'userID' => $userInfo['id'],
                        'avatar' => (isset($userInfo['is_avatar_empty'])) ? 'https://avatars.mds.yandex.net/get-yapic/0/0-0/islands-200' : 'https://avatars.yandex.net/get-yapic/' . $userInfo['default_avatar_id'] . '/islands-200',
                        'firstName' => $userInfo['first_name'],
                        'lastName' => $userInfo['last_name'],
                        'birthday' => $userInfo['birthday'],
                    );
                }
            }
        } else {
            $url = 'https://oauth.yandex.ru/authorize';
            $params = array(
                'response_type' => 'code',
                'client_id' => $this->settings['ya_AppID'],
                'display' => 'popup',
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    public function getGooData()
    {
        if (isset($_GET['code'])) {

            $params = array(
                'client_id' => $this->settings['goo_AppID'],
                'client_secret' => $this->settings['goo_SecretKey'],
                'redirect_uri' => $this->redirectURL,
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
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

                return array(
                    'userID' => $userInfo['id'],
                    'avatar' => $userInfo['picture'],
                    'firstName' => $userInfo['given_name'],
                    'lastName' => $userInfo['family_name'],
                );
            }
        } else {
            $url = 'https://accounts.google.com/o/oauth2/auth';
            $params = array(
                'redirect_uri' => $this->redirectURL,
                'response_type' => 'code',
                'client_id' => $this->settings['goo_AppID'],
                'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    public function getFbData()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id' => $this->settings['fb_AppID'],
                'redirect_uri' => $this->redirectURL,
                'client_secret' => $this->settings['fb_SecretKey'],
                'code' => $_GET['code'],
            );

            $url = 'https://graph.facebook.com/v2.8/oauth/access_token';

            $tokenInfo = json_decode(file_get_contents($url . '?' . urldecode(http_build_query($params))));

            $params = array(
                'fields' => 'id,first_name,last_name,picture',
                'access_token' => $tokenInfo->access_token,
            );

            $userInfo = json_decode(file_get_contents('https://graph.facebook.com/v2.8/me/' . '?' . urldecode(http_build_query($params))), true);

            if ($userInfo) {
                return array(
                    'userID' => $userInfo['id'],
                    'avatar' => $userInfo['picture']['data']['url'],
                    'firstName' => $userInfo['first_name'],
                    'lastName' => $userInfo['last_name'],
                );
            }
        } else {
            $url = 'https://www.facebook.com/v2.8/dialog/oauth';
            $params = array(
                'client_id' => $this->settings['fb_AppID'],
                'redirect_uri' => $this->redirectURL,
                'response_type' => 'code',
                'scope' => 'email,public_profile,user_friends',
            );
            $location = $url . '?' . urldecode(http_build_query($params));
            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    /**
     * Возвращает информацию о SteamID используя SteamAPI, если не удалось получить информацию, вернет false
     *
     * @see https://developer.valvesoftware.com/wiki/Steam_Web_API#GetPlayerSummaries_.28v0002.29
     * @return bool|array
     */
    public function getSteamData()
    {
        if ($this->getSteamID()) {
            $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $this->steamApiKey . "&steamids=" . $this->steamID;
            $userInfo = json_decode(file_get_contents($url));

            if ($userInfo->response) {
                $user = $userInfo->response->players[0];

                return array(
                    'userID' => $user->steamid,
                    'nickName' => $user->personaname,
                    'firstName' => $user->realname,
                    'avatar' => $user->avatarfull,
                );
            }
        }

        return false;
    }

    /**
     * Получает SteamID и записывает в $this->steamID возвращая true, если не удалось получить информацию
     * возвращает false
     *
     * @return bool
     */
    private function getSteamID()
    {
        if (!$this->mode) {
            $this->identity = 'http://steamcommunity.com/openid/?l=russian';
            header('Location: ' . $this->authUrl());
            exit;
        }

        if ($this->validate()) {
            $steamProfileURL = $this->identity;
            $ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";

            preg_match($ptn, $steamProfileURL, $matches);

            $this->steamID = $matches[1];
            return true;
        }

        return false;
    }
}