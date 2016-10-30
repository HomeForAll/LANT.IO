<?php

class SearchController extends Controller {
    public function actionIndex() {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $this->model->ajaxHandler();
            exit;
        }
        $this->view->render('search');
    }
}