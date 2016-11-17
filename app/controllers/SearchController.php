<?php

class SearchController extends Controller {
    public function actionIndex() {
        $data = '';
        if (isset($_POST['simple'])) {
            $data = $this->model->getData('simple');
        } elseif (isset($_POST['extended'])) {
            $data = $this->model->getData('extended');
        }
        $this->view->render('search', $data);
    }
}