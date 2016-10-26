<?php

class SearchController extends Controller {
    public function actionIndex() {
        $this->view->render('search');
    }
}