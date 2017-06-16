<?php

class SearchController extends Controller
{
    public function __construct($layout)
    {
        parent::__construct($layout);
        $this->setModel(new SearchModel());
    }

    public function actionIndex()
    {
        if (!empty($_GET)) {
            $this->model('SearchModel')->fetchAds($_GET);
            $ads = $this->model('SearchModel')->getAds();
            //echo "<pre>".print_r($ads, 1)."</pre>";
            //echo json_encode($this->model('SearchModel')->getAds(), JSON_UNESCAPED_UNICODE);
        }

        $this->view->render('search');
    }
}
