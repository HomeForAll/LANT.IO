<?php

class SteamAuth extends LightOpenID
{
    private $apiKey;
    public $steamID;
    
    public function __construct($redirectURL, $apiKey)
    {
        parent::__construct($redirectURL);
        $this->apiKey = $apiKey;
    }
    
    public function login()
    {
        if (!$this->mode) {
            $this->identity = 'http://steamcommunity.com/openid/?l=russian';
            header('Location: ' . $this->authUrl());
            exit;
        } else {
            if ($this->validate()) {
                
                $steamProfileURL = $this->identity;
                $ptn             = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                
                preg_match($ptn, $steamProfileURL, $matches);
                
                $this->steamID = $matches[1];
                $userData      = $this->getUserData();
                
                if ($userData) {
                    $data = array(
                        'service' => 'steam',
                        'userInfo' => array(
                            'steam_userID' => $userData->steamid,
                            'steam_nickName' => $userData->personaname,
                            'steam_firstName' => $userData->realname,
                            'steam_avatar' => $userData->avatarfull,
                        ),
                    );
                    
                    $_SESSION['services'][$data['service']] = true;
                    foreach ($data['userInfo'] as $key => $value) {
                        $_SESSION[$key] = $value;
                    }
                }
            } else {
                header('Location: http://' . $_SERVER['HTTP_HOST']);
                exit;
            }
        }
        
        return false;
    }
    
    private function getUserData()
    {
        $url      = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $this->apiKey . "&steamids=" . $this->steamID;
        $userInfo = json_decode(file_get_contents($url));
        
        if ($userInfo->response) {
            return $userInfo->response->players[0];
        }
        
        return false;
    }
}