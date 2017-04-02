<?php

class ServiceController extends Controller
{
    private $user;
    private $status;
    protected $access;
    private $service_message;

    public function __construct($template, $model)
    {
        parent::__construct($template, $model);
        $this->checkAuth();
        $this->user = $_SESSION['userID'];
        $this->status = $this->getAccessLevel();
        $this->service_message = [];

        if (!empty($this->user)) {
            $this->access = $this->checkAccessLevel($this->status);
        } else {
            $this->view->render('login');
            return;
        };
    }

    public function actionServiceAdmin()
    {

            // Проверка доступа
            if (!$this->access['add_service']) {
                $this->view->render('no_access');
                return;
            }



        // Если посланы параметры на новый сервис
        if (!empty($_POST['service_add'])) {
            if($this->model->makeServiceInsert($this->user)){
                array_push($this->service_message, 'Запись успешно добалена');
            } else {
                array_push($this->service_message, 'Ошибка записи в базу данных');
            };
        }

        // Если посланы параметры на удаление сервиса
        if (!empty($_POST['service_delete'])) {

            if($this->model->makeServiceDelete($this->user, $this->access['admin_service'],
                (int)$_POST['service_id'], FALSE)) {
                array_push($this->service_message, 'Удаление сервиса прошло успешно');
            } else {
                array_push($this->service_message, 'Произошла ошибка при удалении сервиса');
            };
        }

        // Если посланы параметры на удаление группы сервисов
        if (!empty($_POST['service_group_delete'])) {
         if($this->model->makeServiceDelete($this->user, $this->access['admin_service'],
                (int)$_POST['service_id'], TRUE)) {
             array_push($this->service_message, 'Удаление сервиса прошло успешно');
         } else {
             array_push($this->service_message, 'Произошла ошибка при удалении сервиса');
         };

        }
        // Получение своих услуг
        $data['my_services'] = $this->model->getMyServices($this->user, $this->access['admin_service']);
        $data['css'][0] = 'service.css';
        $data['script_footer'][0] = 'jquery.validate.js';
        $data['script_footer'][1] = 'service_javascript.js';
        $data['message']=$this->service_message;
        $data['access'] = $this->access;
        $this->view->render('service_admin', $data);
    }

    public function actionServiceSub()
    {
        //Если подписка
        if (!empty($_POST['service_subscribe'])){
            array_push($this->service_message,
                ($this->model->makeServiceSubscribe($this->user, (int)$_POST['service_id'], (int)$_POST['service_group_id'] )));
        }
        //Получение подписанных услуг
        $data['my_sub_serv'] = $this->model->getMySubServices($this->user);


        //Список услуг
        $data_service_result = $this->model->getServiceList($data['my_sub_serv']);
        $data['services'] = $data_service_result['services'];
        $data['my_sub_serv_data'] = $data_service_result['my'];
        $data['css'][0] = 'service.css';
        $data['message']=$this->service_message;
        $this->view->render('service_sub', $data);
    }


}

