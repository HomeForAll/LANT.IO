<?php

class SiteController extends Controller {
    public function actionIndex() {
        $this->view->displayPage($this->viewName, $this->title);
    }

    public function actionSearch() {
        $this->view->displayPage($this->viewName, $this->title);
    }
}