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
    public function actionNewsList()
    {
        $this->ifAJAX(function () {
            if ('watch_news_list' == $_POST['action']) {
                $data = $this->model('NewsModel')->getNewsList((int)$_POST['space_type'], (int)$_POST['operation_type'],
                    (int)$_POST['object_type'], (int)$_POST['max_number'], (int)$_POST['offset']);
                $data['news_number'] = $this->model('NewsModel')->getNamberOfAllNews(0, 0, (int)$_POST['space_type'],
                    (int)$_POST['operation_type'], (int)$_POST['object_type']);
                $data['max_number'] = (int)$_POST['max_number'];
                $data['offset'] = (int)$_POST['offset'];
                echo json_encode($data, JSON_UNESCAPED_UNICODE);
                die();
            }
            $data = $this->model('SearchModel')->getRentApartData();
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        });

        //Кол-во выводимых объявлений по умолчанию
        $max_number = 9;
        $data = $this->model('NewsModel')->getNewsList(0, 0, 0, $max_number, 0);
        $data['max_number'] = $max_number;
        $data['news_number'] = $this->model('NewsModel')->getNamberOfAllNews();
        $data['last_viewed_news'] = $this->model('NewsModel')->getLastViewedNews();
        $this->view->render('news_list', $data);
    }

    public function actionNewsID($params)
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
        //Удаление null и "0" параметров и назначение имен существующим, для вывода
        $news = $this->model('NewsModel')->prepareNewsView($news);
        $this->view->render('news_id', $news);
    }

    public function actionNewsEditor($params)
    {
        if (!empty($params)) {
            $params = $params[0];
        } else {
            $params = '';
        }
        // Определение переменных
        $news_to_edit = [];
        // Проверка доступа
        $this->getAccessFor('add_news');
        // Определяем: Если есть id новости => update или вывод формы для редактирования
        if (!empty((int)$params)) {
            $news_to_edit_id = (int)$params;

            // Если были посланны данные обновляем новость в БД
            if (!empty($_POST["submit_editor"])) {
                //Записываем картинки на сервер ($preview_img = имена файлов)
                $preview_img = $this->model('NewsModel')->saveNewsPictures();
                //Приводим данные POST для добавления в БД
                $form_data = $this->model('NewsModel')->getFormDataFromPOST($preview_img);
                // Апдейт БД
                $this->model('NewsModel')->makeNewsUpdate($news_to_edit_id, $form_data);
            }
            // Загружаем новость для редактирования из БД в $news_to_edit
            $news_to_edit = $this->model('NewsModel')->getNewsById($news_to_edit_id);

            //Проверяем наличие данной новости
            if (isset($news_to_edit['id_news'])) {
                $this->model('NewsModel')->setSessionForEditor($news_to_edit);
            } else {
                //Если нет новости с данным id -> переход обратно в мои объявления
                $this->actionNewsMyAD('');
                return;
            }

            //Проверка на владельца новости и уровня доступа к редактированию
            if ($news_to_edit["user_id"] != $_SESSION['userID']) {
                $this->getAccessFor('admin_news');
            }
            $data = $this->model('NewsModel')->getPathOfNewsForm($news_to_edit, $news_to_edit['space_type'], $news_to_edit['operation_type'],
                $news_to_edit['object_type']);
        } else {
            // Если это не конкретная новость:
            $this->model('NewsModel')->setSessionForEditor();
            // Определяем, Если есть $_POST => запись новость, иначе => вывод пустой формы для записи
            if (!empty($_POST['submit_editor'])) {
                //Записываем картинки на сервер ($preview_img = имена файлов)
                $preview_img = $this->model('NewsModel')->saveNewsPictures();
                //Приводим данные POST для добавления в БД
                $form_data = $this->model('NewsModel')->getFormDataFromPOST($preview_img);
                //Записываем в БД
                $this->model('NewsModel')->makeNewsInsert($form_data);
                //JSON формат новости и отсылка на RabbitMQ
                $news_rabbitmq = json_encode($form_data);
                $this->model('NewsModel')->sendNewNewsByRabbitMQ(json_encode($form_data));
            }
            $data = $this->model('NewsModel')->getPathOfNewsForm($news_to_edit, $_POST['space_type'], $_POST['operation_type'],
                $_POST['object_type']);
        }
        $data = $this->model('NewsModel')->getNewsMessageAndError($data);
        $this->view->render('news_editor', $data);
    }

    public function actionNewsMyAD($params)
    {
        $data = [];
        $this->getAccessFor('myad');
        // Изменение статуса новостей и удаление
        if (!empty($_POST['submit_status'])) {
            $stat = $this->model('NewsModel')->getNewsStatusFromPOST();
            $this->model('NewsModel')->makeNewsStatus($stat['news_update_id'], $stat['news_delete_id'], $stat['news_id_rating']);
        }
        // Загрузка из БД списка всех новостей
        $data['news'] = $this->model('NewsModel')->getMyNewsList((int)$_SESSION['userID']);
        $data = $this->model('NewsModel')->getNewsMessageAndError($data);
        $this->view->render('news_myad', $data);
    }
}