<?php

class AJAXController extends Controller
{
    public function __construct($layout)
    {
        parent::__construct($layout);
        $this->setModel(new SearchModel());
    }

    public function actionSearch()
    {
        //$this->ifAJAX(
            //function () {
                if (!empty($_GET)) {
                    $this->model('SearchModel')->fetchAds($_GET);
                    echo json_encode($this->model('SearchModel')->getAds(), JSON_UNESCAPED_UNICODE);
                } elseif (!empty($_POST)) {
                    $this->model('SearchModel')->fetchAds($_POST);
                    echo json_encode($this->model('SearchModel')->getAds(), JSON_UNESCAPED_UNICODE);
                }
            //}
        //);
    }
}
