<?php

class SiteController extends Controller
{

    public function actionIndex()
    {
        $db = new DataBase();
        $news = $db->prepare('SELECT * FROM news_base');
        $news->execute();

        $result = $news->fetchAll();

        $this->view->render('index', $result);
    }

    public function actionAccess()
    {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->model->ajaxHandler();
            exit;
        }

        $this->view->render('access');
    }
}