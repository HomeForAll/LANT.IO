<?php

class NewsController extends Controller {

    public function __construct($pageName, $view, $modelName) {
        parent::__construct($pageName, $view);
        $this->model = new $modelName();
    }

    //Функция выводит заданное количество новостей из базы данных
    public function actionNews_list() {
        $numberOfNews = 5;         // Количество выводимых новостей
        $data = $this->model->getNewsList($numberOfNews);
        $this->view->displayPage($this->viewName, $this->title, $data);
    }

    public function actionNews_id($uri) {
        $uri = explode('/', $uri);
        $id = (int) $uri[1];
        $news = $this->model->getNewsById($id);
        $this->view->displayPage($this->viewName, $this->title, $news);
    }

    public function actionNews_editor($uri) {
        $message = array('message' => array());
        $news_to_edit = array();
        $data = array();
        session_start();
        
// Определяем режим изменения новости по GET 
// Если да, то определяем id        
        $uri = explode('/', $uri);
        $news_to_edit_id = (int) $uri[2];
        if (!empty($news_to_edit_id)) {
            //           сообщение о редактировании $message[message][0]
            $message[message][0] = 'Редактирование новости';
// Если были посланны данные обновляем новость в БД
            if (!empty($_POST[newsTitle]) and !empty($_POST[newsContent])) {

                if ($this->model->makeNewsUpdate($news_to_edit_id)) {
                    // Добавление сообщения
                    array_push($message[message], 'Новость: "' . $_POST[newsTitle] . '" успешно отредактирована!');
                } else {
                    array_push($message[message], 'Новость: "' . $_POST[newsTitle] . '" не удалось отредактировать!');
                }
            }
// Загружаем новость для редактирования из БД в $news_to_edit 
            $news_to_edit = $this->model->getNewsById($news_to_edit_id);
        }
   
        
// Добавление новости в БД
        if (empty($news_to_edit_id) and !empty($_POST['submit_editor'])) {
        
           if (!empty($_POST[newsTitle]) and !empty($_POST[newsContent])){
                if ($this->model->makeNewsInsert()) {
                    // Добавление сообщения
                    array_push($message[message], 'Новость: "' . $_POST[newsTitle] . '" успешно добавлена');
                } else {
                    array_push($message[message], 'Новость: "' . $_POST[newsTitle] . '" не удалось добавить!');
                }
           } else {
                    array_push($message[message], 'Новость: "' . $_POST[newsTitle] . '" не удалось добавить так как не заполнены все поля!');
                }
        }
        
// Изменение статуса новостей и удаление
        if (!empty($_POST['submit_status'])) {
            $message = $this->model->makeNewsStatus($message);
        }
        
        
// Загружаем из БД список всех новостей и формируем проверочный массив статуса stat_arr[id_news] => [status]
// Сессия  $_SESSION['stat_arr'] - статус пока еще не отредактированных новостей       
        $news_list = $this->model->getNewsForEditor();
        $stat_arr = array();
        foreach ($news_list as $k => $i) {
            $stat_arr += array($i[id_news] =>$i[status]);
        }
        $_SESSION['stat_arr'] = $stat_arr;
        
// Объеденяем массивы данных в один для передачи data[] = параметры новости (если редактирование новости) + массив-лист всех новостей + массив сообщений
        $data = array_merge($news_to_edit, $news_list, $message);
         
        $this->view->displayPage($this->viewName, $this->title, $data);
      
        
//        if ($_POST) {
//                echo '<pre>';
//                echo htmlspecialchars(print_r($_POST, true));
//                echo '</pre>';
//            }
    }

}
