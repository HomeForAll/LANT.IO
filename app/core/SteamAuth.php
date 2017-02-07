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

}