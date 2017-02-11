<?php

class SteamAuth extends LightOpenID
{
    private $apiKey;
    public $steamID;
    
    public function __construct($currentURL, $apiKey)
    {
        parent::__construct($currentURL);
        $this->apiKey = $apiKey;
    }

}