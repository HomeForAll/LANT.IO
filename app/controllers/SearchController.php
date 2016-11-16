<?php

class SearchController extends Controller {
    public function actionIndex() {
        if (isset($_POST['submit'])) {
            $data = $this->model->getData();
        }
        $this->view->render('search');
    }
}