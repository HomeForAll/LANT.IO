<?php

class APIController extends Controller
{
    public function __construct($layout)
    {
        parent::__construct($layout);
        header("Content-Type: application/json; charset=utf-8");
        $this->setModel(new SearchModel());
        $this->setModel(new UserModel());
        $this->setModel(new UploadModel());
        $this->setModel(new NewsModel());
        $this->setModel(new CabinetModel());
    }

    public function actionSavePersonalInfoSettings()
    {
        $this->model('CabinetModel')->savePersonalInfoSettings();
        echo json_encode($this->model('CabinetModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }

    public function actionSavePersonalInfo()
    {
        $this->model('CabinetModel')->savePersonalInfo();
        echo json_encode($this->model('CabinetModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }

    public function actionSavePassword()
    {
        $this->model('CabinetModel')->SavePassword();
        echo json_encode($this->model('CabinetModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }

    public function actionGetPersonalInfo()
    {
        $this->model('CabinetModel')->getProfileInfo();
        echo json_encode($this->model('CabinetModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }

    public function actionGetPersonalInfoSettings()
    {
        $this->model('CabinetModel')->getPersonalInfoSettings();
        echo json_encode($this->model('CabinetModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }

    public function actionGetPersonalInfoSecurity()
    {
        $this->model('CabinetModel')->getProfileInfoSecurity();
        echo json_encode($this->model('CabinetModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }

    public function actionGetMessagesFromDB()
    {
        $this->model('CabinetModel')->getChatMessagesFromDB();
        echo json_encode($this->model('CabinetModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }

    public function actionGetDialogs()
    {
        $this->model('CabinetModel')->getDialogs();
        echo json_encode($this->model('CabinetModel')->getResponse(), JSON_UNESCAPED_UNICODE);
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
    }

    public function actionRegistration($step)
    {
        switch ($step[0]) {
            case 'step_type_user':
                $this->model('UserModel')->setUserType(isset($_POST['type']) ? $_POST['type'] : null);
                break;
            case 'step_type_document':
                $this->model('UserModel')->setDocumentType(isset($_POST['document']) ? $_POST['document'] : null);
                break;
            case 'step_document':
                $this->model('UserModel')->setDocumentNumber();
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
    }

    public function actionUser()
    {
        $this->model('UserModel')->getUserInfo();
    }

    public function actionLogout()
    {
        $this->model('UserModel')->logout();
    }

    public function actionUploadAdImage()
    {
        $this->model('UploadModel')->uploadImage();
    }

    public function actionUploadAvatar()
    {
        $this->model('UploadModel')->uploadAvatar();
    }

    public function actionOnline($period)
    {
        $this->model('UserModel')->getOnline($period[0]);
    }

    public function actionRegistered($period)
    {
        $this->model('UserModel')->getRegistered($period[0]);
    }

    public function actionAdsNumber($period)
    {
        $this->model('UserModel')->getAdsNumber($period[0]);
    }

    public function actionAdsActiveNumber($period)
    {
        $this->model('UserModel')->getAdsActiveNumber($period[0]);
    }

    public function actionTrans($period)
    {
        $this->model('UserModel')->getTrans($period[0]);
    }

    public function actionMyAds()
    {
        $this->model('CabinetModel')->getMyAds();
    }

    public function actionAdInFavorite()
    {
        $this->model('CabinetModel')->addAdInFavorite(isset($_POST['id']) ? $_POST['id'] : null);
    }

    public function actionAdOutFavorite()
    {
        $this->model('CabinetModel')->removeAdInFavorite(isset($_POST['id']) ? $_POST['id'] : null);
    }

    public function actionListFavorite()
    {
        $this->model('CabinetModel')->getListFavorite(isset($_POST['id']) ? $_POST['id'] : null);
    }

    public function actionAddTicket()
    {
        $this->model('CabinetModel')->newTicket();
    }

    public function actionPasswordRestore()
    {
        $this->model('UserModel')->passwordRestore();
    }

    public function actionBestAds($param)
    {
        if (!empty($_GET)) {
            $request = $this->model('NewsModel')->getRequestForAds($_GET, $param);
        } elseif (!empty($_POST)) {
            $request = $this->model('NewsModel')->getRequestForAds($_POST, $param);
        }

        if (!empty($request)) {
            //Количество объявлений [count_all]
            $this->model('NewsModel')->getNamberOfAllNews($request['time_from'], $request['time_to'],
                $request['space_type'],
                $request['operation_type'], $request['object_type'], $request['price_from'], $request['price_to'],
                $request['space_from'], $request['space_to'], $request['city']);
            // Получение данных
            $db_data = $this->model('NewsModel')->getBestNewsOfTime($request['time_from'], $request['space_type'],
                $request['operation_type'], $request['object_type'], $request['city'], $request['price_from'],
                $request['price_to'],
                $request['space_from'], $request['space_to'], $request['count']);

            // Подготовка данных для вывода
            $data['best_ads'] = $this->model('NewsModel')->prepareNewsPreview($db_data, false, true);
        }
        echo json_encode($this->model('NewsModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }

    public function actionItemsAdd()
    {
        $keys = $this->model('SearchModel')->getKeys();
        $form_data = $this->model('NewsModel')->getRequestForItemsAddFromPOST($keys);
        $this->model('NewsModel')->makeNewsInsert($form_data['ad'], $form_data['photos']);
        echo json_encode($this->model('NewsModel')->getResponse(), JSON_UNESCAPED_UNICODE);
    }
}
