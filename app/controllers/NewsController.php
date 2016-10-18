<?php

class NewsController extends Controller {
    
    
    public function __construct($pageName, $view, $modelName) {
        parent::__construct($pageName, $view);
        $this->model = new $modelName();
        $this->categories = $this->model->getNewsCategories();
    }

    //Функция выводит заданное количество новостей из базы данных
    public function actionNews_list($page) {
    
        $data = $this->model->getNewsList($page);
//             echo '<pre>';
//             var_dump($data);
//             echo '</pre>';
        $this->view->displayPage($this->viewName, $this->title, $data);
    }

    public function actionNews_id($params) {
        $news_id = $params[0];
        $news = $this->model->getNewsById($news_id);
        $this->view->displayPage($this->viewName, $this->title, $news);
    }

    public function actionNews_editor($params) {
        global $news_error, $news_message;
        $news_message = [];
        $news_error = [];
        $news_to_edit = [];
        $data = [];
        

// Определяем режим изменения новости по наличию параметра в строке ввода
// Если да, то определяем id        
        $news_to_edit_id = $params[0];
        if (!empty($news_to_edit_id)) {
            //           сообщение о редактировании $message[message][0]
            array_push($news_message,'Редактирование новости');
            
// Если были посланны данные обновляем новость в БД
            if (!empty($_POST['newsTitle']) and !empty($_POST['newsContent'])) {
                $preview_img = $this->model->saveNewsPictures();
                if ($this->model->makeNewsUpdate($news_to_edit_id, $preview_img)) {
                    // Добавление сообщения
                    array_push($news_message, 'Новость: "' . $_POST['newsTitle'] . '" успешно отредактирована!');
                } else {
                    array_push($news_error, 'Новость: "' . $_POST['newsTitle'] . '" не удалось отредактировать!');
                }
            }
// Загружаем новость для редактирования из БД в $news_to_edit 
            $news_to_edit = $this->model->getNewsById($news_to_edit_id);
        }


// Добавление новости в БД
        if (empty($news_to_edit_id) and ! empty($_POST['submit_editor'])) {

            if (!empty($_POST['newsTitle']) and !empty($_POST['newsContent'])) {
                //Записываем картинку
                $preview_img = $this->model->saveNewsPictures();
                //Записываем в БД
                if ($this->model->makeNewsInsert($preview_img)) {
                    // Добавление сообщения
                    array_push($news_message, 'Новость: "' . $_POST['newsTitle'] . '" успешно добавлена');
                } else {
                    array_push($news_error, 'Новость: "' . $_POST['newsTitle'] . '" не удалось добавить!');
                }
            } else {
                array_push($news_error, 'Новость: "' . $_POST['newsTitle'] . '" не удалось добавить так как не заполнены все поля!');
            }
        }

// Изменение статуса новостей и удаление
        if (!empty($_POST['submit_status'])) {
            $this->model->makeNewsStatus();
        }


// Загружаем из БД список всех новостей и формируем проверочный массив статуса stat_arr[id_news] => [status]
// Сессия  $_SESSION['stat_arr'] - статус пока еще не отредактированных новостей       
        $news_list = $this->model->getNewsForEditor();
        $stat_arr = array();
        foreach ($news_list as $k => $i) {
            $stat_arr += array($i['id_news'] => $i['status']);
        }
        $_SESSION['stat_arr'] = $stat_arr;
// Объеденяем массивы данных в один для передачи data[] = параметры новости (если редактирование новости) + массив-лист всех новостей + массив сообщений
        $data = array_merge($news_to_edit, $news_list);
        $data['message'] = $news_message;
        $data['error'] = $news_error;
        $data['categories'] = $this->categories;

        $this->view->displayPage($this->viewName, $this->title, $data);


//        if ($_POST) {
//                echo '<pre>';
//                echo htmlspecialchars(print_r($_POST, true));
//                echo '</pre>';
//            }
    }

}
