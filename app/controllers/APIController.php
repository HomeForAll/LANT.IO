<?php

class APIController extends Controller
{
    public function __construct($layout)
    {
        parent::__construct($layout);
        $this->setModel(new SearchModel());
        $this->setModel(new UserModel());
    }
    
    public function actionSearch()
    {
        if (!empty($_GET)) {
            $this->model('SearchModel')->fetchAds($_GET);
        } elseif (!empty($_POST)) {
            $this->model('SearchModel')->fetchAds($_POST);
        }
        echo json_encode($this->model('SearchModel')->getAds(), JSON_UNESCAPED_UNICODE);
    }
    
    public function actionSearchAdsCount()
    {
        if (!empty($_GET)) {
            $this->model('SearchModel')->fetchAds($_GET, SearchModel::COUNT);
        } elseif (!empty($_POST)) {
            $this->model('SearchModel')->fetchAds($_POST, SearchModel::COUNT);
        }
        $ads = $this->model('SearchModel')->getAds();
        $ads = reset($ads);
        echo json_encode($ads, JSON_UNESCAPED_UNICODE);
    }
    
    public function actionLogin()
    {
        if (!empty($_GET)) {
            $this->model('UserModel')->login($_GET['login'], $_GET['password']);
        } elseif (!empty($_POST)) {
            $this->model('UserModel')->login($_POST['login'], $_POST['password']);
        }
        
        echo json_encode($this->model('UserModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }
    
    public function actionRegistration($step)
    {
    }
}
