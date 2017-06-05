<?php

class FormgeneratorController extends Controller
{
    public function __construct($template)
    {
        parent::__construct($template);
//        $this->checkAuth();
//        $this->setModel(new AdminsideModel());
//        $this->setModel(new NewsModel());
    }

      public function actionNewsFormGenerator(){
////        !!!!
////        Тип данных формируется в модели generationNewsElements()
////        там же задаются все имена переменных для записи в БД
////        !!!!
echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
//        $data = [];
//        $form = [];
//        $data['message'] = [];
//        // Получение данных для выбора форм
//        $data['form_options'] = $this->model('AdminsideModel')->getFormOptionList();
//
//        //Все уникальные элементы всех форм
//        if (!empty($_POST['show_unique_forms_elements'])) {
//            if (isset($_POST['rus'])) {
//                $rus = TRUE;
//            } else {
//                $rus = FALSE;
//            }
//            $data['all_forms_elements'] = $this->model('AdminsideModel')->getAllUniqueFormsElements($_POST['table'], $rus);
//        }
//        // Определение вида формы
//        if (!empty($_POST['submit_add_news']) OR !empty($_POST['see_select_form'])) {
//            $form = [];
//            $space_types_id = (int)$_POST['space_types'];
//            $operation_types_id = (int)$_POST['operation_types'];
//            $object_types_id = (int)$_POST['object_types'];
//
//            // Определение id формы
//            $form_id = $this->model('AdminsideModel')->getFormID($space_types_id, $operation_types_id, $object_types_id);
//
//            // Получение формы
//            $form = $this->model('AdminsideModel')->getFormByID($form_id);
//
//            $form['form_id'] = $form_id;
//            $data['form'] = $form;
//            $data['form'] = array_merge($data['form'],
//                $this->model('AdminsideModel')->getFormBaseParamFromFormOptions($space_types_id, $operation_types_id, $object_types_id, $data['form_options']));
//
//        }
//        //Вспомогательная функция поиска формы по id элемента   !!!!!!
//        //$this->model('AdminsideModel')->getFormNameByIdOfELEMENT($data['form_options']);
//
//        //Альтернативные данные из файла
//        // $data['form'] = $this->model('AdminsideModel')->getFormFromFile('2_1_1.php');
//
//
//        //Вспомогательная функция поиска формы по id элемента   !!!!!!
//        if (!empty($_POST['show_same_name'])) {
//            $data['same_name'] = [];
//            foreach ($data['form_options']['base'] as $help_id) {
//                $help_form = $this->model('AdminsideModel')->getFormByID($help_id['id']);
//                array_push($data['same_name'], "<h3>Форма с id = " . $help_id['id'] . " [ "
//                    . $help_id['space_type']['r_name']
//                    . " - " . $help_id['object_type']['r_name']
//                    . " - " . $help_id['operation']['r_name']
//                    . " ]</h3>");
//                foreach ($help_form['same_name'] as $key => $value) {
//                    if (isset($value)) {
//                        array_push($data['same_name'], '<p style="color:red;">' . $key . '</p>');
//                    }
//                    foreach ($value as $k => $v) {
//                        array_push($data['same_name'], $k . '[' . $v . ']<br>');
//                    }
//                }
//            }
//        }
//
//        //Генерация данных для Таблицы Новостей в БД
//        $data['news_db'] = $this->model('AdminsideModel')->generationNewsElements();
//
//
//        //Исправления Индексов для сприсков
//        if (!empty($_POST['show_index_select_opt'])) {
//            $data['show_index_select_opt'] = $this->model('AdminsideModel')->getIndexSelectOpt();
//        }
//
//        //Таблица новости в БД
//        if (!empty($_POST['generation_news_table'])) {
//            $data['news_table'] = $this->model('AdminsideModel')->generationNewsTable($data['news_db']);
//        }
//        //Расхождения текущей БД со сгенерированной таблицой
//        if (!empty($_POST['generation_news_table_2'])) {
//            $data['news_table'] = $this->model('AdminsideModel')->generationNewsTable($data['news_db']);
//            $data['news_table_test'] = $this->model('AdminsideModel')->testNewsTable($data['news_table']);
//            if (!empty($data['news_table_test']['commands'])) {
//                $data['news_table_test_commands'] = $data['news_table_test']['commands'];
//            }
//            unset ($data['news_table_test']['commands']);
//            if (empty($data['news_table_test'])) {
//                $data['news_table_test'][0] = 'Различий не обнаружено!';
//            }
//
//        }
//
//
//        //Генерация форм новостей на основе форм поиска
//        if (!empty($_POST['generating_news_forms_by_search_forms'])) {
//            $data['news_form_generation_file'] = $this->model('AdminsideModel')->generatingNewsFormsBySearchForms($data['news_db'], $_POST['generation_file_name']);
//        }
//        //Вставка php кода заполнения полей при редактировании
//        if (!empty($_POST['inserting_php_code_for_filling_fields'])) {
//            $data['news_form_with_php_code'] = $this->model('AdminsideModel')->insertingPhpCodeForFillingFields($_POST['generation_file_name']);
//        }
//
//
//        //Генерировать $args - код фильтрации POST для getFormData модели news
//        if (!empty($_POST['generation_news_post_args'])) {
//            $data['args'] = $this->model('AdminsideModel')->generationNewsPostArgs($data['news_db']);
//        }
//
//        //Генерировать массив всех checkbox и записать в NewsModel.php
//        if (!empty($_POST['all_checkbox_list'])) {
//            $this->model('AdminsideModel')->allCheckboxList($data['news_db']);
//        }
//
//        // Список ВСЕХ элементов и опций (не уникальных)
//        // для проверки всех вариантов
//        if (!empty($_POST['all_forms_elements_and_options'])) {
//            $data['all_forms_elements_and_options'] =
//                $this->model('AdminsideModel')->getAllFormsElementsAndOptions($data['form_options']['base']);
//        }
//
//        // Установка input_type элементов в соотв. с типом данных БД (см. модели generationNewsElements())
//        // И в соотв. с правилами и исключениями этой функции
//        if (isset($data['form']['category'])) {
//            $data['form']['category'] =
//                $this->model('AdminsideModel')->setInputTypeForElements($data['form']['category'], $data['news_db']);
//
//            //Исправление нелепых данных в формах
//            $data['form']['category'] = $this->model('AdminsideModel')->correctingStupidData($data['form']['category']);
//
//        }
//
//        // для проверки всех вариантов
//        if (!empty($_POST['elements_eng_rus'])) {
//            $data['elements_eng_rus'] =
//                $this->model('AdminsideModel')->elementsEngRus($data['news_db']);
//        }
//
//
//        //Внесение изменений в меню новостей в файле $f_name = news_myad.php
//        if (isset($_POST['change_news_menu'])) {
//            $f_name = "template/js/news.editor.menu.js";
//            array_push($data['message'], $this->model('AdminsideModel')->changeFileNewsMenu($f_name, $data['form_options']));
//        }


 //       $this->view->render('news_form_generator', $data);
    }

}