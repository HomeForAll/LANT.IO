<?php

class NewsController extends Controller
{

    //Функция выводит заданное количество новостей из базы данных
    public function actionNews_list($params)
    {

        if (!empty($params)) {
            $params = $params[0];
        } else {
            $params = '';
        }

        //Если это первый запуск или произошел выбор параметров просмотра
        //Установка начальных параметров и Запись в SESSION
        if (!empty($_POST['watch_news_list']) || empty($params)) {
            $this->model->setSessionForNewsList();
        }

        $data                     = $this->model->getNewsList($params);
        $data['last_viewed_news'] = $this->model->getLastViewedNews();

        $this->view->render('news_list', $data);
    }

    public function actionNews_id($params)
    {
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

    public function actionNews_editor($params)
    {
// Определение переменных
        if (!empty($params)) {
            $params = $params[0];
        } else {
            $params = '';
        }
        global $news_error, $news_message;
        $news_message = [];
        $news_error   = [];
        $news_to_edit = [];
        $data         = [];

        // Определение пользователя
        if (!empty($_SESSION['userID'])) {

        } else {
            array_push($news_error,
                'Ошибка! Вы не авторизованы! <br> <a href="/registration">Регистрация</a> <a href="/login">Вход</a>');
        }
// Определяем: Если есть id новости => update или вывод формы для редактирования

        if (!empty((int) $params)) {
            $news_to_edit_id = (int) $params;
            //сообщение о редактировании $message[message][0]
            array_push($news_message, 'Редактирование новости');


// Если были посланны данные обновляем новость в БД
            if (!empty($_POST['title']) || !empty($_POST["submit_editor"])) {

                //Записываем картинки на сервер ($preview_img = имена файлов)
                $preview_img = $this->model->saveNewsPictures();
                //Приводим данные POST для добавления в БД
                $form_data   = $this->model->getFormData($preview_img);
                // Апдейт БД
                if ($this->model->makeNewsUpdate($news_to_edit_id, $form_data)) {
                    // Добавление сообщения
                    array_push($news_message,
                        'Новость: "'.$_POST['title'].'" успешно отредактирована!');
                } else {
                    array_push($news_error,
                        'Новость: "'.$_POST['title'].'" не удалось отредактировать!');
                }
            }


// Загружаем новость для редактирования из БД в $news_to_edit 
            $news_to_edit = $this->model->getNewsById($news_to_edit_id);
            $this->model->setSessionForEditor($news_to_edit);
            $category     = $this->model->translateIndex($news_to_edit['category'],
                'category_eng');
        } else {
            //
            //Если это не конкретная новость:
            //
        // Категория новостей из строки параметров
            $category = $params;

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
                        array_push($news_message,
                            'Новость: "'.$_POST['title'].'" успешно добавлена');
                    } else {
                        array_push($news_error,
                            'Новость: "'.$_POST['title'].'" не удалось добавить!');
                    }
                } else {
                    array_push($news_error,
                        'Новость: "'.$_POST['title'].'" не удалось добавить так как не заполнены все поля!');
                }
            }
        } // окончание else (если в строке ввода не id новости
// Объеденяем массивы данных в один для передачи data[] = параметры новости (если редактирование новости) + массив-лист всех новостей + массив сообщений
        $data             = $news_to_edit;
        $data['message']  = $news_message;
        $data['error']    = $news_error;
        $data['category'] = $category;

        $this->view->render('news_editor', $data);
    }

    public function actionNews_myad($params)
    {
        global $news_error, $news_message;
        $news_message = [];
        $news_error   = [];
        $data         = [];


        if (!empty($_SESSION['userID'])) {

            $data['author_name'] = $_SESSION['userID'];
            $news_list           = [];
            // Изменение статуса новостей и удаление для определенной таблицы $table
            if (!empty($_POST['submit_status'])) {
                $this->model->makeNewsStatus();
            }

// Загружаем из БД список всех новостей и формируем проверочный массив статуса stat_arr[id_news] => [status]
// Сессия  $_SESSION['stat_arr'] - статус пока еще не отредактированных новостей
            $news_list = $this->model->getMyNewsList($data['author_name']);


// записываем в SESSION массив(stat_arr) из id=>status для сравнения изменений статуса
            $stat_arr = array();
            foreach ($news_list as $k => $i) {
                $stat_arr += array($i['id_news'] => $i['status']);
            }
            $_SESSION['stat_arr'] = $stat_arr;
        } else {

            array_push($news_error,
                'Ошибка! Вы не авторизованы! <br> <a href="/registration">Регистрация</a> <a href="/login">Вход</a>');
        }
        if (!empty($news_list)) {
            $data['news'] = $news_list;
        }
        $data['message'] = $news_message;
        $data['error']   = $news_error;

        $this->view->render('news_myad', $data);
    }
}