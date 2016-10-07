<?php

class AuthModel
{
    private $settings;

    public function __construct()
    {
        $this->settings = require ROOT_DIR . '/app/config/auth.php';
    }

    public function getURL($id)
    {
        $method = $id . 'URL';
        return $this->$method();
    }

    private function vkURL()
    {
        $url = 'http://oauth.vk.com/authorize';
        $params = array(
            'client_id'     => $this->settings['vkAppID'],
            'redirect_uri'  => $this->settings['vkRedirectURL'],
            'display' => 'page',
            'scope' => 'email',
            'response_type' => 'code'
        );

        return $url . '?' . urldecode(http_build_query($params));
    }

    public function getVkToken($code) {
        $params = array(
            'client_id' => $this->settings['vkAppID'],
            'client_secret' => $this->settings['vkSecretKey'],
            'code' => $code,
            'redirect_uri' => $this->settings['vkRedirectURL']
        );
        return json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
    }

    public function getVkUserInfo($token) {
        $params = array(
            'uids'         => $token['user_id'],
            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big,country',
            'access_token' => $token['access_token']
        );

        $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get' . '?' . urldecode(http_build_query($params))), true);

        if (isset($userInfo['response'][0]['uid'])) {
            return $userInfo['response'][0];
        }
    }
}