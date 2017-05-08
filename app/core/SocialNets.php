<?php

class SocialNets extends LightOpenID
{
    private $steamID;
    private $steamApiKey;
    private $config;
    private $currentURL;
    private $state;

    const STATE_LOGIN = 1;
    const STATE_REGISTRATION = 2;
    const STATE_UPDATE_SERVICE = 3;

    public function __construct($currentURL)
    {
        parent::__construct($currentURL);

        $redis = Registry::get('redis');
        $this->config = unserialize($redis->get('config'));
        // Запоминаем URL на котором сейчас находимся
        $this->currentURL = $currentURL;
        $this->steamApiKey = $this->config['steam_api_key'];
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    /**
     * Записывает необходимые денные в сессию
     *
     * @param array $data - массив данных пользователя
     */
    private function setData(array $data)
    {
        $_SESSION['OAuth_user_id'] = $data['user_id'];
        $_SESSION['OAuth_avatar'] = $data['avatar'];
        $_SESSION['OAuth_first_name'] = $data['first_name'];
        $_SESSION['OAuth_last_name'] = $data['last_name'];
        $_SESSION['OAuth_service'] = $data['service'];
        $_SESSION['OAuth_state'] = $data['state'];
    }

    /**
     * Получает данные пользователя используя token или перенаправляет пользователя на страницу авторизации VK.COM
     * если отсутствует код для получения токена
     */
    public function vk()
    {
        // Если сервер в ответ прислал GET запрос с параметром "code"
        if (isset($_GET['code'])) {
            // Вбиваем в массив данные которые хотим отправить в GET запросе
            $params = array(
                'client_id' => $this->config['vk_app_id'],
                'client_secret' => $this->config['vk_secret_key'],
                'code' => $_GET['code'],
                'redirect_uri' => $this->config['vk_redirect_url'],
            );

            // Инициализируем cURL
            $curl = curl_init();
            // Указываем URL, предварительно скомпилировав параметры из массива $params
            curl_setopt($curl, CURLOPT_URL, 'https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // Получаем токен закдированный в JSON формате
            $out = curl_exec($curl);
            $token = json_decode($out, true);
            curl_close($curl);

            if (isset($token['access_token'])) {
                // Указываем параметры полученые из token и данные которые мы хотим получить
                $params = array(
                    'uids' => $token['user_id'],
                    'fields' => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,country',
                    'access_token' => $token['access_token'],
                );

                $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

                if (isset($userInfo['response'][0]['uid'])) {
                    $user = $userInfo['response'][0];

                    // Записываем полученные данные в сессию
                    $this->setData([
                        'user_id' => $token['user_id'],
                        'avatar' => $user['photo_big'],
                        'first_name' => $user['first_name'],
                        'last_name' => $user['last_name'],
                        'service' => 'vk',
                        'state' => $this->getState(),
                    ]);

                    // Исходя из установленного статуса запроса, перенаправляем человека либо на регистрацию
                    // или на авторизацию
                    $this->redirect();
                }
            }
        } else {
            // Составляем параметры для получения $_GET['code'] и перенарпавляем пользователя на авторизацию в соц. сети
            $url = 'http://oauth.vk.com/authorize';
            $params = array(
                'client_id' => $this->config['vk_app_id'],
                'redirect_uri' => $this->config['vk_redirect_url'],
                'display' => 'page',
                'scope' => 'email',
                'response_type' => 'code',
                'state' => $this->getState(),
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }
    }

    /**
     * Получает данные пользователя используя token или перенаправляет пользователя на страницу авторизации OK.RU
     * если отсутствует код для получения токена
     */
    public function ok()
    {
        if (isset($_GET['code'])) {
            // Составляем параметры дл получения token
            $params = array(
                'code' => $_GET['code'],
                'redirect_uri' => $this->config['ok_redirect_url'],
                'grant_type' => 'authorization_code',
                'client_id' => $this->config['ok_app_id'],
                'client_secret' => $this->config['ok_secret_key'],
            );

            $url = 'http://api.odnoklassniki.ru/oauth/token.do';
            // Компилируем параметры и делаем POST запрос, для получения token
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $result = curl_exec($curl);
            curl_close($curl);

            // Декодируем реультат из JSON в массив
            $token = json_decode($result, true);

            if (isset($token['access_token'])) {
                $sign = md5("application_key={$this->config['ok_public_key']}format=jsonmethod=users.getCurrentUser" . md5("{$token['access_token']}{$this->config['ok_secret_key']}"));

                $params = array(
                    'method' => 'users.getCurrentUser',
                    'access_token' => $token['access_token'],
                    'application_key' => $this->config['ok_public_key'],
                    'format' => 'json',
                    'sig' => $sign,
                );

                // Получаем данные пользователя используя токен
                $userInfo = json_decode(file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params))), true);

                if ($userInfo) {
                    // Записываем данные в сессию
                    $this->setData([
                        'user_id' => $userInfo['uid'],
                        'avatar' => $userInfo['pic_3'],
                        'first_name' => $userInfo['first_name'],
                        'last_name' => $userInfo['last_name'],
                        'service' => 'ok',
                        'state' => $this->getState(),
                    ]);

                    // Перенапрвялем пользователя на страницу, соттветствующую статусу запроса
                    $this->redirect();
                }
            }
        } else {
            // Получаем $_GET['code'], перенаправляя пользователя на страницу авторизации OK.RU
            $url = 'http://www.odnoklassniki.ru/oauth/authorize';

            $params = array(
                'client_id' => $this->config['ok_app_id'],
                'response_type' => 'code',
                'redirect_uri' => $this->config['ok_redirect_url'],
                'state' => $this->getState(),
            );

            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    /**
     * Получает данные пользователя используя token или перенаправляет пользователя на страницу авторизации MAIL.RU
     * если отсутствует код для получения токена, операции схожи с авторизацией OK.RU
     *
     * @see SocialNets::ok()
     */
    public function mail()
    {
        if (isset($_GET['code'])) {

            $params = array(
                'client_id' => $this->config['mail_app_id'],
                'client_secret' => $this->config['mail_secret_key'],
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'redirect_uri' => $this->config['mail_redirect_url'],
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
                $sign = md5("app_id={$this->config['mail_app_id']}method=users.getInfosecure=1session_key={$token['access_token']}{$this->config['mail_secret_key']}");

                $params = array(
                    'method' => 'users.getInfo',
                    'secure' => '1',
                    'app_id' => $this->config['mail_app_id'],
                    'session_key' => $token['access_token'],
                    'sig' => $sign,
                );

                $userInfo = json_decode(file_get_contents('http://www.appsmail.ru/platform/api' . '?' . urldecode(http_build_query($params))), true);
                if (isset($userInfo[0]['uid'])) {
                    $userInfo = array_shift($userInfo);

                    $this->setData([
                        'user_id' => $userInfo['uid'],
                        'avatar' => $userInfo['pic_big'],
                        'first_name' => $userInfo['first_name'],
                        'last_name' => $userInfo['last_name'],
                        'service' => 'mail',
                        'state' => $this->getState(),
                    ]);

                    $this->redirect();
                }
            }
        } else {
            $url = 'https://connect.mail.ru/oauth/authorize';
            $params = array(
                'client_id' => $this->config['mail_app_id'],
                'response_type' => 'code',
                'redirect_uri' => $this->config['mail_redirect_url'],
                'state' => $this->getState(),
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    /**
     * Получает данные пользователя используя token или перенаправляет пользователя на страницу авторизации YANDEX.RU
     * если отсутствует код для получения токена, операции схожи с авторизацией VK.COM
     *
     * @see SocialNets::vk()
     */
    public function ya()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'grant_type' => 'authorization_code',
                'code' => $_GET['code'],
                'client_id' => $this->config['ya_app_id'],
                'client_secret' => $this->config['ya_secret_key'],
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
                    $this->setData([
                        'user_id' => $userInfo['id'],
                        'avatar' => (isset($userInfo['is_avatar_empty'])) ? 'https://avatars.mds.yandex.net/get-yapic/0/0-0/islands-200' : 'https://avatars.yandex.net/get-yapic/' . $userInfo['default_avatar_id'] . '/islands-200',
                        'first_name' => $userInfo['first_name'],
                        'last_name' => $userInfo['last_name'],
                        'service' => 'ya',
                        'state' => $this->getState(),
                    ]);

                    $this->redirect();
                }
            }
        } else {
            $url = 'https://oauth.yandex.ru/authorize';
            $params = array(
                'response_type' => 'code',
                'client_id' => $this->config['ya_app_id'],
                'display' => 'popup',
                'state' => $this->getState(),
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }
    }

    /**
     * Получает данные пользователя используя token или перенаправляет пользователя на страницу авторизации GOOGLE.COM
     * если отсутствует код для получения токена, операции схожи с авторизацией VK.COM
     *
     * @see SocialNets::vk()
     */
    public function google()
    {
        if (isset($_GET['code'])) {

            $params = array(
                'client_id' => $this->config['google_app_id'],
                'client_secret' => $this->config['google_secret_key'],
                'redirect_uri' => $this->config['google_redirect_url'],
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

                if ($userInfo) {
                    $this->setData([
                        'user_id' => $userInfo['id'],
                        'avatar' => $userInfo['picture'],
                        'first_name' => $userInfo['given_name'],
                        'last_name' => $userInfo['family_name'],
                        'service' => 'google',
                        'state' => $this->getState(),
                    ]);

                    $this->redirect();
                }
            }
        } else {
            $url = 'https://accounts.google.com/o/oauth2/auth';
            $params = array(
                'redirect_uri' => $this->config['google_redirect_url'],
                'response_type' => 'code',
                'client_id' => $this->config['google_app_id'],
                'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
                'state' => $this->getState(),
            );
            $location = $url . '?' . urldecode(http_build_query($params));

            header('Location: ' . $location);
            exit;
        }

        return false;
    }

    /**
     * Получает данные пользователя используя token или перенаправляет пользователя на страницу авторизации FACEBOOK.COM
     * если отсутствует код для получения токена, операции схожи с авторизацией VK.COM
     *
     * @see SocialNets::vk()
     */
    public function fb()
    {
        if (isset($_GET['code'])) {
            $params = array(
                'client_id' => $this->config['fb_app_id'],
                'redirect_uri' => $this->config['fb_redirect_url'],
                'client_secret' => $this->config['fb_secret_key'],
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
                $this->setData([
                    'user_id' => $userInfo['id'],
                    'avatar' => $userInfo['picture']['data']['url'],
                    'first_name' => $userInfo['first_name'],
                    'last_name' => $userInfo['last_name'],
                    'service' => 'fb',
                    'state' => $this->getState(),
                ]);

                $this->redirect();
            }
        } else {
            $url = 'https://www.facebook.com/v2.8/dialog/oauth';
            $params = array(
                'client_id' => $this->config['fb_app_id'],
                'redirect_uri' => $this->config['fb_redirect_url'],
                'response_type' => 'code',
                'scope' => 'email,public_profile,user_friends',
                'state' => $this->getState(),
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
     */
    public function steam()
    {
        if ($this->getSteamID()) {
            $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $this->steamApiKey . "&steamids=" . $this->steamID;
            $userInfo = json_decode(file_get_contents($url));

            if ($userInfo->response) {
                $user = $userInfo->response->players[0];

                $this->setData([
                    'user_id' => $user->steamid,
                    'avatar' => $user->avatarfull,
                    'first_name' => $user->realname,
                    'last_name' => $user->personaname,
                    'service' => 'steam',
                    'state' => $this->getState(),
                ]);

                $this->redirect();
            }
        }
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

    private function redirect(){
        if ($this->getState() == self::STATE_LOGIN) {
            header('Location: ' . $this->config['login_url']);
            exit;
        } elseif ($this->getState() == self::STATE_REGISTRATION) {
            header('Location: ' . $this->config['registration_url']);
            exit;
        } elseif ($this->getState() == self::STATE_UPDATE_SERVICE) {
            header('Location: ' . $this->config['update_service_url']);
            exit;
        }
    }
}