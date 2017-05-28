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

        // Проверка доступа
        global $news_message, $news_error;
        $this->getAccessFor('admin');
        $news_message = [];
        $news_error = [];
        $data = [];
        // Данные проchange_news_menuсмотра таблицы редактирования объявлений
//        $data = $this->model('AdminModel')->getDataFromPost();

        $this->ifAJAX(function() {

            if('news_search' == $_POST['action']){
                $data = $this->model('AdminModel')->getDataFromPost();

                    //Кол-во объявлений
                    $data['news_number']= $this->model('NewsModel')->
                    getNamberOfAllNews( $data['time_start'], $data['time'], $data['space_type'],
                        $data['operation_type'], $data['object_type'], 0, 0, 0, 0, $data['status'], $data['title_like']);

                    $data['one_page'] = $data['max_number'];

                $data['news'] = $this->model('NewsModel')->
                getRecentNewsList($data['time_start'], $data['time'], $data['max_number'], $data['space_type'],
                    $data['operation_type'], $data['object_type'], $data['status'],$data['sorting'], $data['title_like'], $data['offset']);

                //$this->model('NewsModel')->renderAdminNews($data);
                echo json_encode($data);
                die();
            }
            if('submit_status' == $_POST['action']){
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
        $data['news'] = $this->model('NewsModel')->getRecentNewsList(0,24,10,0,0,0,FALSE,FALSE);
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
        $data['message'] = [];
        // Получение данных для выбора форм
        $data['form_options'] = $this->model('AdminModel')->getFormOptionList();

        //Все уникальные элементы всех форм
        if (!empty($_POST['show_unique_forms_elements'])) {
            if (isset($_POST['rus'])) {
                $rus = TRUE;
            } else {
                $rus = FALSE;
            }
            $data['all_forms_elements'] = $this->model('AdminModel')->getAllUniqueFormsElements($_POST['table'], $rus);
        }
        // Определение вида формы
        if (!empty($_POST['submit_add_news']) OR !empty($_POST['see_select_form'])) {
            $form = [];
            $space_types_id = (int)$_POST['space_types'];
            $operation_types_id = (int)$_POST['operation_types'];
            $object_types_id = (int)$_POST['object_types'];

            // Определение id формы
            $form_id = $this->model('AdminModel')->getFormID($space_types_id, $operation_types_id, $object_types_id);

            // Получение формы
            $form = $this->model('AdminModel')->getFormByID($form_id);

            $form['form_id'] = $form_id;
            $data['form'] = $form;
            $data['form'] = array_merge($data['form'],
                $this->model('AdminModel')->getFormBaseParamFromFormOptions($space_types_id, $operation_types_id, $object_types_id, $data['form_options']));

        }
        //Вспомогательная функция поиска формы по id элемента   !!!!!!
        //$this->model('AdminModel')->getFormNameByIdOfELEMENT($data['form_options']);

        //Альтернативные данные из файла
        // $data['form'] = $this->model('AdminModel')->getFormFromFile('2_1_1.php');


        //Вспомогательная функция поиска формы по id элемента   !!!!!!
        if (!empty($_POST['show_same_name'])) {
            $data['same_name'] = [];
            foreach ($data['form_options']['base'] as $help_id) {
                $help_form = $this->model('AdminModel')->getFormByID($help_id['id']);
                array_push($data['same_name'], "<h3>Форма с id = " . $help_id['id'] . " [ "
                    . $help_id['space_type']['r_name']
                    . " - " . $help_id['object_type']['r_name']
                    . " - " . $help_id['operation']['r_name']
                    . " ]</h3>");
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
        $data['news_db'] = $this->model('AdminModel')->generationNewsElements();


        //Исправления Индексов для сприсков
        if (!empty($_POST['show_index_select_opt'])) {
            $data['show_index_select_opt'] = $this->model('AdminModel')->getIndexSelectOpt();
        }

        //Таблица новости в БД
        if (!empty($_POST['generation_news_table'])) {
            $data['news_table'] = $this->model('AdminModel')->generationNewsTable($data['news_db']);
        }
        //Расхождения текущей БД со сгенерированной таблицой
        if (!empty($_POST['generation_news_table_2'])) {
            $data['news_table'] = $this->model('AdminModel')->generationNewsTable($data['news_db']);
            $data['news_table_test'] = $this->model('AdminModel')->testNewsTable($data['news_table']);
            if (!empty($data['news_table_test']['commands'])) {
                $data['news_table_test_commands'] = $data['news_table_test']['commands'];
            }
            unset ($data['news_table_test']['commands']);
            if (empty($data['news_table_test'])) {
                $data['news_table_test'][0] = 'Различий не обнаружено!';
            }

        }


        //Генерация форм новостей на основе форм поиска
        if (!empty($_POST['generating_news_forms_by_search_forms'])) {
            $data['news_form_generation_file'] = $this->model('AdminModel')->generatingNewsFormsBySearchForms($data['news_db'], $_POST['generation_file_name']);
        }
        //Вставка php кода заполнения полей при редактировании
        if (!empty($_POST['inserting_php_code_for_filling_fields'])) {
            $data['news_form_with_php_code'] = $this->model('AdminModel')->insertingPhpCodeForFillingFields($_POST['generation_file_name']);
        }


        //Генерировать $args - код фильтрации POST для getFormData модели news
        if (!empty($_POST['generation_news_post_args'])) {
            $data['args'] = $this->model('AdminModel')->generationNewsPostArgs($data['news_db']);
        }

        //Генерировать массив всех checkbox и записать в NewsModel.php
        if (!empty($_POST['all_checkbox_list'])) {
            $this->model('AdminModel')->allCheckboxList($data['news_db']);
        }

        // Список ВСЕХ элементов и опций (не уникальных)
        // для проверки всех вариантов
        if (!empty($_POST['all_forms_elements_and_options'])) {
            $data['all_forms_elements_and_options'] =
                $this->model('AdminModel')->getAllFormsElementsAndOptions($data['form_options']['base']);
        }

        // Установка input_type элементов в соотв. с типом данных БД (см. модели generationNewsElements())
        // И в соотв. с правилами и исключениями этой функции
        if (isset($data['form']['category'])) {
            $data['form']['category'] =
                $this->model('AdminModel')->setInputTypeForElements($data['form']['category'], $data['news_db']);

            //Исправление нелепых данных в формах
            $data['form']['category'] = $this->model('AdminModel')->correctingStupidData($data['form']['category']);

        }

        // для проверки всех вариантов
        if (!empty($_POST['elements_eng_rus'])) {
            $data['elements_eng_rus'] =
                $this->model('AdminModel')->elementsEngRus($data['news_db']);
        }


        //Внесение изменений в меню новостей в файле $f_name = news_myad.php
        if (isset($_POST['change_news_menu'])) {
            $f_name = "template/js/news.editor.menu.js";
            array_push($data['message'], $this->model('AdminModel')->changeFileNewsMenu($f_name, $data['form_options']));
        }


        $this->view->render('news_form_generator', $data);
    }
}
