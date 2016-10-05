<?php

class NewsController extends Controller {

    public function __construct($pageName, $settings, $view, $modelName) {
        parent::__construct($pageName, $settings, $view, $modelName);
        $this->model = new $modelName($settings);
    }

    //Функция выводит заданное количество новостей из базы данных
    public function actionNewslist() {
        $numberOfNews = 2;         // Количество выводимых новостей
        $data = NewsModel::getNewsList($numberOfNews, $this->model->db);
        $this->view->displayPage($this->viewName, $this->title, $data);
    }

    public function actionNews() {
        $this->view->displayPage(__FUNCTION__);
    }

}
