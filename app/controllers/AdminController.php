<?php

class AdminController extends Controller
{
    public function __construct($template)
    {
        parent::__construct($template);
        $this->checkAuth();
        $this->setModel(new AdminModel());
        $this->setModel(new NewsModel());
    }

    public function actionAdmin()
    {

    }

    public function actionAdminNews()
    {

        // Проверка доступа
        global $news_message, $news_error;
        $this->getAccessFor('admin');
        $news_message = [];
        $news_error = [];
        $data = [];

        $this->ifAJAX(function () {

            if ('news_search' == $_POST['action']) {
                $data = $this->model('AdminModel')->getDataFromPost();

                //Кол-во объявлений
                $data['news_number'] = $this->model('NewsModel')->
                getNamberOfAllNews($data['time_start'], $data['time'], $data['space_type'],
                    $data['operation_type'], $data['object_type'], 0, 0, 0, 0, $data['status'], $data['title_like']);

                $data['one_page'] = $data['max_number'];

                $data['news'] = $this->model('NewsModel')->
                getRecentNewsList($data['time_start'], $data['time'], $data['max_number'], $data['space_type'],
                    $data['operation_type'], $data['object_type'], $data['status'], $data['sorting'], $data['title_like'], $data['offset']);

                echo json_encode($data);
                die();
            }
            if ('submit_status' == $_POST['action']) {
                $messege = $this->model('NewsModel')->makeNewsStatus();
                echo json_encode($messege);
                die();
            }
        });

        if (!empty($_POST['submit_status'])) {
            //Запись $_POST параметров в БД
            $this->model('NewsModel')->makeNewsStatus();
        }

        if (!empty($_POST['test2'])) {
            $data['rabbitmq_message_newnews'] = $this->model('NewsModel')->getNewNewsByRabbitMQ();
        }
        // Таблица новостей по умолчанию
        $data['news'] = $this->model('NewsModel')->getRecentNewsList(0, 24, 10, 0, 0, 0, FALSE, FALSE);
        $data['message'] = $news_message;
        $data['error'] = $news_error;
        $this->view->render('admin_news', $data);
    }
      
    /**
     * Административная панель, для работы с пользователями
     */
    public function actionUsers()
    {
        if (isset($_POST['filter'])) {
            $limit = 10;
            
            if (!empty($_POST['limit'])) {
                $limit = (int)$_POST['limit'];
            }
            
            if (!empty($_POST['id'])) {
                $this->model('AdminModel')->fetchUserByID($_POST['id']);
            } elseif (!empty($_POST['email'])) {
                $this->model('AdminModel')->fetchUserByEmail($_POST['email']);
            } elseif (!empty($_POST['firstName']) && !empty($_POST['lastName'])) {
                $this->model('AdminModel')->fetchUsers($limit, 0, $_POST['firstName'], $_POST['lastName']);
            } elseif (!empty($_POST['firstName'])) {
                $this->model('AdminModel')->fetchUsers($limit, 0, $_POST['firstName']);
            } elseif (!empty($_POST['lastName'])) {
                $this->model('AdminModel')->fetchUsers($limit, 0, null, $_POST['lastName']);
            } else {
                $this->model('AdminModel')->fetchUsers($limit);
            }
        } elseif (isset($_POST['doIt'])) {
            switch ($_POST['action']) {
                case 'ban':
                    $this->model('AdminModel')->banUsers($_POST['userIDs'], $_POST['banDate']);
                    break;
                case 'perm_ban':
                    $this->model('AdminModel')->banUsers($_POST['userIDs']);
                    break;
                case 'unban':
                    $this->model('AdminModel')->unbanUsers($_POST['userIDs']);
                    break;
            }
            
            $this->model('AdminModel')->fetchUsers(10);
        } else {
            $this->model('AdminModel')->fetchUsers();
        }
        
        $this->view->render('users_admin_panel');
    }
    
    /**
     * Панель блокировки пользователей
     * TODO: реализовать проверку на пустую дату
     */
    public function actionUsersBan()
    {
        if (isset($_POST['search'])) {
            $this->model('AdminModel')->searchUser($_POST['email']);
        } elseif (isset($_POST['block'])) {
            $this->model('AdminModel')->blockUser($_POST['user_id'], $_POST['block_date']); // блокировка по дате
        } elseif (isset($_POST['perm_block'])) {
            $this->model('AdminModel')->blockUser($_POST['user_id']); // блокировка навсегда
        }
        
        $this->view->render('users_ban_panel');
    }
}
