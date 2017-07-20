<?php

class FormGeneratorController extends Controller
{
    public function __construct($template)
    {
        parent::__construct($template);
        $this->checkAuth();
        $this->setModel(new FormGeneratorModel());
        $this->setModel(new NewsModel());
        $this->setModel(new SearchModel());
    }

      public function actionNewsFormGenerator(){

          $this->ifAJAX(function () {
              $keys = $this->model('SearchModel')->getKeys();
              $form_data = $this->model('NewsModel')->getRequestForItemsAddFromPOST($keys);
              $this->model('NewsModel')->makeNewsInsert($form_data['ad'], $form_data['photos']);
              echo json_encode($this->model('NewsModel')->getResponse(), JSON_UNESCAPED_UNICODE);

  //                echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
                  die();

          });
//        !!!!
//        Тип данных формируется в модели generationNewsElements()
//        там же задаются все имена переменных для записи в БД
//        !!!!
        $data = [];
        $form = [];
        $data['message'] = [];
        // Получение данных для выбора форм
        $data['form_options'] = $this->model('FormGeneratorModel')->getFormOptionList();

          //Внесение данных в колонку
          if (!empty($_POST['update_column'])) {
              array_push($data['message'], $this->model('FormGeneratorModel')->updateСolumnByData($_POST['table'], $_POST['column'], $_POST['names_str']));
          }



        //Все уникальные элементы всех форм
        if (!empty($_POST['show_unique_forms_elements'])) {
            if (isset($_POST['rus'])) {
                $rus = TRUE;
            } else {
                $rus = FALSE;
            }
            $data['all_forms_elements'] = $this->model('FormGeneratorModel')->getAllUniqueFormsElements($_POST['table'], $rus);
        }
        // Определение вида формы
        if (!empty($_POST['submit_add_news']) OR !empty($_POST['see_select_form'])) {
            $form = [];
            $space_types_id = (int)$_POST['space_types'];
            $operation_types_id = (int)$_POST['operation_types'];
            $object_types_id = (int)$_POST['object_types'];

            // Определение id формы
            $form_id = $this->model('FormGeneratorModel')->getFormID($space_types_id, $operation_types_id, $object_types_id);

            // Получение формы
            $form = $this->model('FormGeneratorModel')->getFormByID($form_id);

            $form['form_id'] = $form_id;
            $data['form'] = $form;
            $data['form'] = array_merge($data['form'],
                $this->model('FormGeneratorModel')->getFormBaseParamFromFormOptions($space_types_id, $operation_types_id, $object_types_id, $data['form_options']));

        }
        //Вспомогательная функция поиска формы по id элемента   !!!!!!
        //$this->model('FormGeneratorModel')->getFormNameByIdOfELEMENT($data['form_options']);

        //Альтернативные данные из файла
        // $data['form'] = $this->model('FormGeneratorModel')->getFormFromFile('2_1_1.php');


        //Вспомогательная функция поиска формы по id элемента   !!!!!!
        if (!empty($_POST['show_same_name'])) {
            $data['same_name'] = [];
            foreach ($data['form_options']['base'] as $help_id) {
                $help_form = $this->model('FormGeneratorModel')->getFormByID($help_id['id']);
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

        //Генерация данных для Таблицы Новостей в БД на основе форм
        $data['news_db'] = $this->model('FormGeneratorModel')->generationNewsElements();

          //Вывести таблицу новостей news_base
          if (!empty($_POST['generation_news_base'])) {
              $data['news_base'] = $this->model('FormGeneratorModel')->generationNewsBaseTable();
              //Перевод из модели новостей
              $rus_eng = $this->model('NewsModel')->prepareNewsView($data['news_base']['db']);
              $data['news_base']['rus_eng'] = $this->model('FormGeneratorModel')->generationNewsBaseTableRusEng($rus_eng, $data['news_base']['db']);
              $data['news_base_test'] = $this->model('FormGeneratorModel')->testNewsTable($data['news_base']['db']);
              if (!empty($data['news_base_test']['commands'])) {
                  $data['news_base_commands'] = $data['news_base_test']['commands'];
              }
              unset ($data['news_base_test']['commands']);
              if (empty($data['news_base_test'])) {
                  $data['news_base_commands'][0] = 'Различий не обнаружено!';
              }

          }

        //Исправления Индексов для списков
        if (!empty($_POST['show_index_select_opt'])) {
            $data['show_index_select_opt'] = $this->model('FormGeneratorModel')->getIndexSelectOpt();
        }

        //Таблица новости в БД
        if (!empty($_POST['generation_news_table'])) {
            $data['news_table'] = $this->model('FormGeneratorModel')->generationNewsTable($data['news_db']);
        }
        //Расхождения текущей БД со сгенерированной таблицой
        if (!empty($_POST['generation_news_table_2'])) {
            $data['news_table'] = $this->model('FormGeneratorModel')->generationNewsTable($data['news_db']);
            $data['news_table_test'] = $this->model('FormGeneratorModel')->testNewsTable($data['news_table']);
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
            $data['news_form_generation_file'] = $this->model('FormGeneratorModel')->generatingNewsFormsBySearchForms($data['news_db'], $_POST['generation_file_name']);
        }


          //Генерация кода для VIEWS
          if (!empty($_POST['generating_news_views'])) {
              $data['news_base'] = $this->model('FormGeneratorModel')->generationNewsBaseTable();
              $rus_eng = $this->model('NewsModel')->prepareNewsView($data['news_base']['db']);

              $data['generating_news_views'] = $this->model('FormGeneratorModel')->generatingNewsViews($data['form_options'], $_POST['generation_file_name'], $rus_eng);
          }




        //Вставка php кода заполнения полей при редактировании
        if (!empty($_POST['inserting_php_code_for_filling_fields'])) {
            $data['news_form_with_php_code'] = $this->model('FormGeneratorModel')->insertingPhpCodeForFillingFields($_POST['generation_file_name']);
        }


        //Генерировать $args - код фильтрации POST для getFormData модели news
        if (!empty($_POST['generation_news_post_args'])) {
            $data['args'] = $this->model('FormGeneratorModel')->generationNewsPostArgs($data['news_db']);
        }

        //Генерировать массив всех checkbox и записать в NewsModel.php
        if (!empty($_POST['all_checkbox_list'])) {
            $this->model('FormGeneratorModel')->allCheckboxList($data['news_db']);
        }

        // Список ВСЕХ элементов и опций (не уникальных)
        // для проверки всех вариантов
        if (!empty($_POST['all_forms_elements_and_options'])) {
            $data['all_forms_elements_and_options'] =
                $this->model('FormGeneratorModel')->getAllFormsElementsAndOptions($data['form_options']['base']);
        }

        // Установка input_type элементов в соотв. с типом данных БД (см. модели generationNewsElements())
        // И в соотв. с правилами и исключениями этой функции
        if (isset($data['form']['category'])) {
            $data['form']['category'] =
                $this->model('FormGeneratorModel')->setInputTypeForElements($data['form']['category'], $data['news_db']);

            //Исправление нелепых данных в формах
            $data['form']['category'] = $this->model('FormGeneratorModel')->correctingStupidData($data['form']['category']);

        }

        // для проверки всех вариантов
        if (!empty($_POST['elements_eng_rus'])) {
            $data['elements_eng_rus'] =
                $this->model('FormGeneratorModel')->elementsEngRus($data['news_db']);
        }


        //Внесение изменений в меню новостей в файле $f_name = news_myad.php
        if (isset($_POST['change_news_menu'])) {
            $f_name = "template/js/news.editor.menu.js";
            array_push($data['message'], $this->model('FormGeneratorModel')->changeFileNewsMenu($f_name, $data['form_options']));
        }


        $this->view->render('news_form_generator', $data);
    }

}