<?php

class NewsController extends Controller {

    //Функция выводит заданное количество новостей из базы данных
    public function actionNews_list($params) {
        if (!empty($params)) {
            $params = $params[0];
        } else {
            $params = '';
        }

        // Получаем категории из БД
        $this->categories = $this->model->getNewsCategories();

        $data = $this->model->getNewsList($params);
        $this->view->render('news_list', $data);
    }

    public function actionNews_id($params) {
        if (!empty($params)) {
            $params = $params[0];
        } else {
            $params = '';
        }

        //Получение данных из БД
        $news = $this->model->getNewsById($params);
        //Удаление NULL и "0" параметров и назначение имен существующим, для вывода
        $news = $this->model->prepareNewsView($news);
        $this->view->render('news_id', $news);
    }

    public function actionNews_editor($params) {

        if (!empty($params)) {
            $params = $params[0];
        } else {
            $params = '';
        }
        global $news_error, $news_message;
        $news_message = [];
        $news_error = [];
        $news_to_edit = [];
        $news_list = [];
        $data = [];
        // Получаем категории из БД
        $this->categories = $this->model->getNewsCategories();
        // Тип новостей из строки параметров
        // Определяем принадлежность блока - Квартира, Дом, Комната, Доля (строка в адресе)
        $editor_page_type = $this->model->getNewsPageType($params);





// Определяем: Если есть id новости => update или вывод формы для редактирования

        if (!empty($params) and preg_match('/id[b,r,s][a,h,r,l]?[0-9a-f]+/', $params)) {
            $news_to_edit_id = $params;
            //сообщение о редактировании $message[message][0]
            array_push($news_message, 'Редактирование новости');

// Если были посланны данные обновляем новость в БД
            if (!empty($_POST['title'])) {

                //Записываем картинки на сервер ($preview_img = имена файлов)
                $preview_img = $this->model->saveNewsPictures();
                //Приводим данные POST для добавления в БД
                $form_data = $this->model->getFormData($preview_img);
                // Апдейт БД
                if ($this->model->makeNewsUpdate($news_to_edit_id, $form_data)) {
                    // Добавление сообщения
                    array_push($news_message, 'Новость: "' . $_POST['title'] . '" успешно отредактирована!');
                } else {
                    array_push($news_error, 'Новость: "' . $_POST['title'] . '" не удалось отредактировать!');
                }
            }


// Загружаем новость для редактирования из БД в $news_to_edit 
            $news_to_edit = $this->model->getNewsById($news_to_edit_id);
        } else {  //Если это не конкретная новость:
// Определяем, Если есть $_POST => запись новость, иначе => вывод пустой формы для записи
// Добавление новости в БД (если POST )
            if (!empty($_POST['submit_editor'])) {

                if (!empty($_POST['title'])) {
                    //Записываем картинки на сервер ($preview_img = имена файлов)
                    $preview_img = $this->model->saveNewsPictures();
                    //Приводим данные POST для добавления в БД
                    $form_data = $this->model->getFormData($preview_img);

                    //Записываем в БД
                    if ($this->model->makeNewsInsert($form_data)) {
                        // Добавление сообщения
                        array_push($news_message, 'Новость: "' . $_POST['title'] . '" успешно добавлена');
                    } else {
                        array_push($news_error, 'Новость: "' . $_POST['title'] . '" не удалось добавить!');
                    }
                } else {
                    array_push($news_error, 'Новость: "' . $_POST['title'] . '" не удалось добавить так как не заполнены все поля!');
                }
            }



// Изменение статуса новостей и удаление
            if (!empty($_POST['submit_status'])) {
                $this->model->makeNewsStatus();
            }


// Загружаем из БД список всех новостей и формируем проверочный массив статуса stat_arr[id_news] => [status]
// Сессия  $_SESSION['stat_arr'] - статус пока еще не отредактированных новостей 
            if (empty($params)) {
                $table = 'news_base';
            } else {
                $table = 'news_' . $params;
            }
            $news_list = $this->model->getNewsForEditorByDate($table);



            $stat_arr = array();
            foreach ($news_list as $k => $i) {
                $stat_arr += array($i['id_news'] => $i['status']);
            }
            $_SESSION['stat_arr'] = $stat_arr;
        } // окончание else (если в строке ввода не id новости
// Объеденяем массивы данных в один для передачи data[] = параметры новости (если редактирование новости) + массив-лист всех новостей + массив сообщений
        $data = array_merge($news_to_edit, $news_list);
        $data['message'] = $news_message;
        $data['error'] = $news_error;
        $data['categories'] = $this->categories;
        $data['editor_page_type'] = $editor_page_type;

        $this->view->render('news_editor', $data);
    }

}
