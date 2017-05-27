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
        $this->ifAJAX(function() {
            if('top_apartments' == $_POST['action']){
                $filter_result_arr = ['space_type', 'operation_type', 'object_type',
                    'price_from', 'price_to', 'space_from', 'space_to'];
                foreach($filter_result_arr as $name){
                    if (isset($_POST[$name])) {
                        $res[$name] = (int)$_POST[$name];
                    } else {
                        $res[$name] = 0;
                    }
                }
                $data['best_news'] = $this->model('NewsModel')->getBestNewsOfTime(8064,$res['space_type'],
                    $res['operation_type'], $res['object_type'], $res['price_from'], $res['price_to'],
                    $res['space_from'], $res['space_to'], 9);
                $data['best_news_number'] = $this->model('NewsModel')->getNamber_of_all_rows(8064,$res['space_type'],
                    $res['operation_type'], $res['object_type'], $res['price_from'], $res['price_to'],
                    $res['space_from'], $res['space_to']);
                $this->model('NewsModel')->renderBestNewsOfTime($data['best_news'], $data['best_news_number']);
            }
        });
        $data['best_news'] = $this->model('NewsModel')->getBestNewsOfTime(8064);
        $data['best_news_number'] = $this->model('NewsModel')->getNamber_of_all_rows(8064);
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