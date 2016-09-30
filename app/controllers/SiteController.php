<?php

class SiteController extends Controller {
    public function actionIndex() {
        $this->view->displayPage(__FUNCTION__);
    }

    public function actionSearch() {
        $this->view->displayPage(__FUNCTION__);
    }
}