<?php

class SiteController extends Controller
{
    public function __construct($layout)
    {
        parent::__construct($layout);
        $this->setModel(new SiteModel());
         $this->setModel(new NewsModel());
    }

 public function actionIndex()
    {
        $data = [];
        $this->ifAJAX(function() {

            
        });
        $this->view->render('index', $data);
    }

    public function actionAccess()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->model('SiteModel')->ajaxHandler();
            exit;
        }

        $this->view->render('access');
    }
}