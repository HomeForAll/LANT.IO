<?php

class NewsController extends Controller
{
    public function __construct($template)
    {
        parent::__construct($template);
        $this->setModel(new NewsModel());
        $this->setModel(new UserModel());
    }

//Функция выводит заданное количество новостей из базы данных
    public function actionNews_list($params)
    {
        $this->ifAJAX(function() {
            $data = $this->model('SearchModel')->getRentApartData();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        });

        if (!empty($params)) {
            $params = $params[0];
        } else {
            $params = '';
        }

        //Если это первый запуск или произошел выбор параметров просмотра
        //Установка начальных параметров и Запись в SESSION
        if (!empty($_POST['watch_news_list']) || empty($params)) {
            $this->model('NewsModel')->setSessionForNewsList();
        }

        $data = $this->model('NewsModel')->getNewsList($params);
        $data['last_viewed_news'] = $this->model('NewsModel')->getLastViewedNews();

        $this->view->render('news_list', $data);
    }

    public function actionNews_id($params)
    {
        if (!empty($params)) {
            $params = $params[0];
        } else {
            $params = '';
        }

        //IP пользователя
        $user_ip = $this->model('UserModel')->getUserIP();
        //Получение данных из БД
        $news = $this->model('NewsModel')->getNewsById($params);
        //Изменение количества просмотров объявления на 1 и запись cookie о просмотре
        $this->model('NewsModel')->setCountViewsNews($news['id_news'], $user_ip);
        //Удаление NULL и "0" параметров и назначение имен существующим, для вывода
        $news = $this->model('NewsModel')->prepareNewsView($news);

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
        $news_error = [];
        $news_to_edit = [];
        $data = [];
        if(isset($_POST['space_type']) && isset($_POST['operation_type']) && isset($_POST['object_type'])){
            $space_type = (int)$_POST['space_type'];
            $operation_type = (int)$_POST['operation_type'];
            $object_type = (int)$_POST['object_type'];
        }

        // Проверка доступа
        $this->getAccessFor('add_news');


        // Определяем: Если есть id новости => update или вывод формы для редактирования
        if (!empty((int)$params)) {
            $news_to_edit_id = (int)$params;
            //сообщение о редактировании $message[message][0]
            array_push($news_message, 'Редактирование новости');


            // Если были посланны данные обновляем новость в БД
            if (!empty($_POST['title']) || !empty($_POST["submit_editor"])) {

                //Записываем картинки на сервер ($preview_img = имена файлов)
                $preview_img = $this->model('NewsModel')->saveNewsPictures();
                //Приводим данные POST для добавления в БД
                $form_data = $this->model('NewsModel')->getFormData($preview_img);
                // Апдейт БД
                if ($this->model('NewsModel')->makeNewsUpdate($news_to_edit_id, $form_data)) {
                    // Добавление сообщения
                    array_push($news_message,
                        'Новость: "' . $_POST['title'] . '" успешно отредактирована!');
                } else {
                    array_push($news_error,
                        'Новость: "' . $_POST['title'] . '" не удалось отредактировать!');
                }
            }


// Загружаем новость для редактирования из БД в $news_to_edit 
            $news_to_edit = $this->model('NewsModel')->getNewsById($news_to_edit_id);
            //Проверяем наличие данной новости
            if (isset($news_to_edit['id_news'])) {
                $this->model('NewsModel')->setSessionForEditor($news_to_edit);
                // тип формы
                $space_type = $news_to_edit['space_type'];
                $operation_type = $news_to_edit['operation_type'];
                $object_type = $news_to_edit['object_type'];

            } else {
                //Если нет новости с данным id -> переход обратно в мои объявления
                $this->actionNews_myad('');
                return;
            }

            //Проверка на владельца новости и уровня доступа к редактированию
            if ($news_to_edit["user_id"] != $_SESSION['userID']) {
                $this->getAccessFor('admin_news');
            }
        } else {

// Если это не конкретная новость:
//
// Определяем, Если есть $_POST => запись новость, иначе => вывод пустой формы для записи
// Добавление новости в БД (если POST )
            if (!empty($_POST['submit_editor'])) {

                if (!empty($_POST['title'])) {
                    //Записываем картинки на сервер ($preview_img = имена файлов)
                    $preview_img = $this->model('NewsModel')->saveNewsPictures();

                    //Приводим данные POST для добавления в БД
                    $form_data = $this->model('NewsModel')->getFormData($preview_img);

                    //Записываем в БД
                    if ($this->model('NewsModel')->makeNewsInsert($form_data)) {
                        // Добавление сообщения
                        array_push($news_message,
                            'Новость: "' . $_POST['title'] . '" успешно добавлена');
                    } else {
                        array_push($news_error,
                            'Новость: "' . $_POST['title'] . '" не удалось добавить!');
                    }
                } else {
                    array_push($news_error,
                        'Новость: "' . $_POST['title'] . '" не удалось добавить так как не заполнены все поля!');
                }
                //JSON формат новости и отсылка на RabbitMQ
                $news_rabbitmq = json_encode($form_data);
                $this->model('NewsModel')->sendNewNewsByRabbitMQ(json_encode($form_data));
            }
        } // окончание else (если в строке ввода не id новости
// Объеденяем массивы данных в один для передачи data[] = параметры новости (если редактирование новости) + массив-лист всех новостей + массив сообщений
        $data = $news_to_edit;
        $data['message'] = $news_message;
        $data['error'] = $news_error;
 if(isset($space_type) && isset($operation_type) && isset($object_type)){
     $data['space_type'] = $space_type;
     $data['operation_type'] = $operation_type;
     $data['object_type'] = $object_type;
     $data['form_name'] = $space_type.'_'.$operation_type.'_'.$object_type;
     $data['form_path'] = 'app/views/news/'.$data['form_name'].'.php';
 }

        $this->view->render('news_editor', $data);
    }

    public function actionNews_myad($params)
    {
        global $news_error, $news_message;
        $news_message = [];
        $news_error = [];
        $data = [];


        if (!empty($_SESSION['userID'])) {

            $data['user_id'] = (int)$_SESSION['userID'];
            $news_list = [];
            // Изменение статуса новостей и удаление
            if(!empty($_POST['submit_status'])){
                //Запись $_POST параметров в БД
                $this->model('NewsModel')->makeNewsStatus();
            }

// Загружаем из БД список всех новостей и формируем проверочный массив статуса stat_arr[id_news] => [status]
// Сессия  $_SESSION['stat_arr'] - статус пока еще не отредактированных новостей
            $news_list = $this->model('NewsModel')->getMyNewsList($data['user_id']);


//// записываем в SESSION массив(stat_arr) из id=>status для сравнения изменений статуса
//            $stat_arr = array();
//            foreach ($news_list as $k => $i) {
//                $stat_arr += array($i['id_news'] => $i['status']);
//            }
//            $_SESSION['stat_arr'] = $stat_arr;
        } else {

            array_push($news_error,
                'Ошибка! Вы не авторизованы! <br> <a href="/registration">Регистрация</a> <a href="/login">Вход</a>');
        }
        if (!empty($news_list)) {
            $data['news'] = $news_list;
        }
        $data['message'] = $news_message;
        $data['error'] = $news_error;

        $this->view->render('news_myad', $data);
    }
}