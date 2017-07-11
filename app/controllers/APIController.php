<?php

class APIController extends Controller
{
    public function __construct($layout)
    {
        parent::__construct($layout);
        $this->setModel(new SearchModel());
        $this->setModel(new UserModel());
        $this->setModel(new UploadModel());
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
                $this->model('UserModel')->setUserType(isset($_POST['type']) ? $_POST['type'] : null);
                break;
            case 'step_type_document':
                $this->model('UserModel')->setDocumentType(isset($_POST['document_type']) ? $_POST['document_type'] : null);
                break;
            case 'step_document':
                $this->model('UserModel')->setDocumentNumber(isset($_POST['document']) ? $_POST['document'] : null);
                break;
            case 'step_company':
                $this->model('UserModel')->setCompanyData(isset($_POST['brand']) ? $_POST['brand'] : null, isset($_POST['company']) ? $_POST['company'] : null);
                break;
            case 'step_name':
                $this->model('UserModel')->setFirstName(isset($_POST['name']) ? $_POST['name'] : null);
                break;
            case 'step_phone':
                $this->model('UserModel')->setPhone(isset($_POST['phone']) ? $_POST['phone'] : null);
                break;
            case 'step_code':
                $this->model('UserModel')->verifySMSCode(isset($_POST['code']) ? $_POST['code'] : null);
                break;
            case 'step_email':
                $this->model('UserModel')->setEmail(isset($_POST['email']) ? $_POST['email'] : null);
                break;
            case 'step_password':
                $this->model('UserModel')->setPassword(isset($_POST['password']) ? $_POST['password'] : null);
                if ($this->model('UserModel')->getResponse() == true) {
                    $this->model('UserModel')->registration();
                }
                break;
            case 'step_summary':
                if (!empty($_POST)) {
                    $this->model('UserModel')->setSummaries();
                } else {
                    $this->model('UserModel')->summaries();
                }
                break;
        }
        
        echo json_encode($this->model('UserModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }
    
    public function actionUser()
    {
        $this->model('UserModel')->getUserInfo();
        echo json_encode($this->model('UserModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }
    
    public function actionLogout()
    {
        $this->model('UserModel')->logout();
        echo json_encode($this->model('UserModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }
    
    public function actionUploadAdImage()
    {
        $this->model('UploadModel')->uploadImage();
    }
    
    public function actionUploadAvatar()
    {
        $this->model('UploadModel')->uploadAvatar();
    }
}
