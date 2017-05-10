<?php

class AdminController extends Controller
{
    public function __construct($template, $model)
    {
        parent::__construct($template, $model);
        $this->checkAuth();
    }

public function actionAdmin(){

        // Проверка доступа
        global $news_message, $news_error;
        $this->getAccessFor('admin');
        $news_message = [];
        $news_error = [];
        // Данные просмотра таблицы редактирования объявлений
        $data = $this->model->getDataFromPostOrSession();

        if(!empty($_POST['submit_status'])){
            //Запись $_POST параметров в БД
            $this->model->makeNewsStatus();
        }

        if (!empty($_POST['test2'])) {
            $data['rabbitmq_message_newnews'] = Registry::model('news')->getNewNewsByRabbitMQ();
        }

            $data['news'] = Registry::model('news')->
            getRecentNewsList($data['time_start'], $data['time'], $data['max_number'], $data['space_type'],
                $data['operation_type'], $data['object_type'], $data['best'], $data['status']);
        $data['message'] = $news_message;
        $data['error'] = $news_error;
        $this->view->render('admin', $data);
    }


    public function actionNewsFormGenerator()
    {
//        !!!!
//        Тип данных формируется в модели generationNewsElements()
//        там же задаются все имена переменных для записи в БД
//        !!!!

        $data = [];
        $form = [];
        $data['message'] =[];
        // Получение данных для выбора форм
        $data['form_options'] = $this->model->getFormOptionList();

        //Все уникальные элементы всех форм
        if (!empty($_POST['show_unique_forms_elements'])) {
            if(isset($_POST['rus'])) { $rus = TRUE;} else {$rus = FALSE;}
            $data['all_forms_elements'] = $this->model->getAllUniqueFormsElements($_POST['table'], $rus);
        }
        // Определение вида формы
        if (!empty($_POST['submit_add_news']) OR !empty($_POST['see_select_form'])) {
            $form = [];
            $space_types_id = (int)$_POST['space_types'];
            $operation_types_id = (int)$_POST['operation_types'];
            $object_types_id = (int)$_POST['object_types'];

            // Определение id формы
            $form_id = $this->model->getFormID($space_types_id, $operation_types_id, $object_types_id);

            // Получение формы
            $form = $this->model->getFormByID($form_id);

            $form['form_id'] = $form_id;
            $data['form'] = $form;
            $data['form'] = array_merge($data['form'],
                $this->model->getFormBaseParamFromFormOptions($space_types_id, $operation_types_id, $object_types_id, $data['form_options']));

        }
        //Вспомогательная функция поиска формы по id элемента   !!!!!!
        //$this->model->getFormNameByIdOfELEMENT($data['form_options']);

        //Альтернативные данные из файла
 //       $data['form'] = $this->model->getFormFromFile('2_1_1.php');


        //Вспомогательная функция поиска формы по id элемента   !!!!!!
        if (!empty($_POST['show_same_name'])){
            $data['same_name'] = [];
            foreach ($data['form_options']['base'] as $help_id) {
                $help_form = $this->model->getFormByID($help_id['id']);
                array_push($data['same_name'], "<h3>Форма с id = ".$help_id['id']." [ "
                    .$help_id['space_type']['r_name']
                    ." - ".$help_id['object_type']['r_name']
                    ." - ".$help_id['operation']['r_name']
                    ." ]</h3>");
                foreach ($help_form['same_name'] as $key => $value) {
                    if (isset($value)) {
                        array_push($data['same_name'], '<p style="color:red;">' . $key . '</p>');
                    }
                    foreach ($value as $k => $v) {
                        array_push($data['same_name'], $k . '[' . $v . ']<br>');
                    }
                }
            }
        }

        //Генерация данных для Таблицы Новостей в БД
        $data['news_db'] = $this->model->generationNewsElements();



        //Исправления Индексов для сприсков
        if (!empty($_POST['show_index_select_opt'])){
            $data['show_index_select_opt'] = $this->model->getIndexSelectOpt();
        }

        //Таблица новости в БД
        if (!empty($_POST['generation_news_table'])){
            $data['news_table'] = $this->model->generationNewsTable($data['news_db']);
        }



        //Генерация форм новостей на основе форм поиска
        if (!empty($_POST['generating_news_forms_by_search_forms'])){
            $data['news_form_generation_file'] = $this->model->generatingNewsFormsBySearchForms($data['news_db'], $_POST['generation_file_name']);
        }
        //Вставка php кода заполнения полей при редактировании
        if (!empty($_POST['inserting_php_code_for_filling_fields'])){
            $data['news_form_with_php_code'] = $this->model->insertingPhpCodeForFillingFields( $_POST['generation_file_name']);
        }




        //Генерировать $args - код фильтрации POST для getFormData модели news
        if (!empty($_POST['generation_news_post_args'])){
            $data['args'] = $this->model->generationNewsPostArgs($data['news_db']);
        }

        //Генерировать массив всех checkbox и записать в NewsModel.php
        if (!empty($_POST['all_checkbox_list'])){
            $this->model->allCheckboxList($data['news_db']);
        }

        // Список ВСЕХ элементов и опций (не уникальных)
        // для проверки всех вариантов
        if (!empty($_POST['all_forms_elements_and_options'])){
            $data['all_forms_elements_and_options'] =
                $this->model->getAllFormsElementsAndOptions($data['form_options']['base']);
        }

        // Установка input_type элементов в соотв. с типом данных БД (см. модели generationNewsElements())
        // И в соотв. с правилами и исключениями этой функции
        if(isset($data['form']['category'])) {
            $data['form']['category'] =
                $this->model->setInputTypeForElements($data['form']['category'], $data['news_db']);

        //Исправление нелепых данных в формах
        $data['form']['category'] = $this->model->correctingStupidData($data['form']['category']);

        }

        // для проверки всех вариантов
        if (!empty($_POST['elements_eng_rus'])){
            $data['elements_eng_rus'] =
                $this->model->elementsEngRus($data['news_db']);
        }


        //Внесение изменений в меню новостей в файле $f_name = news_myad.php
        if(isset($_POST['change_news_menu'])) {
            $f_name = "app/views/news_myad.php";
            array_push($data['message'],$this->model->changeFileNewsMenu($f_name, $data['form_options']));
        }



        $this->view->render('news_form_generator', $data);
    }
}
