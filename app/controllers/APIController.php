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
        switch ($step[0]) {
            case 'step_type_user':
                if (isset($_POST['type'])) {
                    $this->model('UserModel')->setUserType($_POST['type']);
                }
                break;
            case 'step_type_document':
                if (isset($_POST['document_type'])) {
                    $this->model('UserModel')->setDocumentType($_POST['document_type']);
                }
                break;
            case 'step_document':
                if (isset($_POST['document'])) {
                    $this->model('UserModel')->setDocumentNumber($_POST['document']);
                }
                break;
            case 'step_company':
                if (isset($_POST['brand']) && isset($_POST['company'])) {
                    $this->model('UserModel')->setCompanyData($_POST['brand'], $_POST['company']);
                }
                break;
            case 'step_name':
                if (isset($_POST['name'])) {
                    $this->model('UserModel')->setFirstName($_POST['name']);
                }
                break;
            case 'step_phone':
                if (isset($_POST['phone'])) {
                    $this->model('UserModel')->setPhone($_POST['phone']);
                }
                break;
            case 'step_code':
                if (isset($_POST['code'])) {
                    $this->model('UserModel')->verifySMSCode($_POST['code']);
                }
                break;
            case 'step_email':
                if (isset($_POST['email'])) {
                    $this->model('UserModel')->setEmail($_POST['email']);
                }
                break;
            case 'step_password':
                if (isset($_POST['password'])) {
                    $this->model('UserModel')->setPassword($_POST['password']);
                }
                break;
            case 'step_summary':
                if (!empty($_GET)) {
                    $this->model('UserModel')->getRegisterSummaries();
                } elseif (!empty($_POST)) {
                }
                break;
        }
        
        echo json_encode($this->model('UserModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }
}
