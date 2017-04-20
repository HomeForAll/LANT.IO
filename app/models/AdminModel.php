<?php

class AdminModel extends Model
{
    use Cleaner;

    public function __construct()
    {
        $this->db = new DataBase();
    }


    /**
     * Возвращает массив для формирования выбора форм
     * space_types - Тип площади
     * object_types - Тип объекта
     * operation_types - Тип операции
     *
     * @return array
     */
    public function getFormOptionList()
    {
        function sortFormBase($a, $b)
        {
            $r = strcmp($b['space_type']['r_name'], $a['space_type']['r_name']);
            if ($r == 0) {
                $r = strcmp($a['operation']['r_name'], $b['operation']['r_name']);
            } else {
                return $r;
            }
            if ($r == 0) {
                $r = $a['object_type']['id'] - $b['object_type']['id'];
            } else {
                return $r;
            }
            return $r;
        }

        $result = [];
        $r = [];
        // $space_types $object_types $operation
        // Получение из БД - Все базовые параметры форм
        $sql = 'SELECT * FROM forms';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result['base'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Получение из БД - Тип площади
        $sql = 'SELECT id, r_name, e_name FROM form_space_types';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $v) {
            $result['space_types'][$v['id']] = $v;
        }

        // Получение из БД - Тип объекта
        $sql = 'SELECT id, r_name, e_name FROM form_object_types';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $v) {
            $result['object_types'][$v['id']] = $v;
        }

        // Получение из БД - Тип операции
        $sql = 'SELECT id, r_name, e_name FROM form_operation_types';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $v) {
            $result['operation_types'][$v['id']] = $v;
        }

        foreach ($result['base'] as $key => $val) {
            $result['base'][$key]['space_type'] = $result['space_types'][$result['base'][$key]['space_type']];
            $result['base'][$key]['object_type'] = $result['object_types'][$result['base'][$key]['object_type']];
            $result['base'][$key]['operation'] = $result['operation_types'][$result['base'][$key]['operation']];
        }

        usort($result['base'], "sortFormBase");
        return $result;
    }


    public function getFormID($space_types, $operation, $object_type)
    {
        $sql = 'SELECT id FROM forms WHERE space_type =:space_type'
            . ' AND operation =:operation'
            . ' AND object_type =:object_type';

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':space_type', $space_types);
        $stmt->bindParam(':operation', $operation);
        $stmt->bindParam(':object_type', $object_type);
        $stmt->execute();
        return $result = $stmt->fetchColumn();
    }

    public function getFormBaseParamFromFormOptions($space_types_id, $operation_id, $object_type_id, $form_options = [])
    {
        $result = [];
        foreach ($form_options['space_types'] as $opt_arr) {
            if ($opt_arr['id'] == $space_types_id) {
                foreach ($opt_arr as $index => $opt) {
                    $result['space_types'][$index] = $opt;
                }
            }
        }
        foreach ($form_options['operation_types'] as $opt_arr) {
            if ($opt_arr['id'] == $operation_id) {
                foreach ($opt_arr as $index => $opt) {
                    $result['operation_types'][$index] = $opt;
                }
            }
        }
        foreach ($form_options['object_types'] as $opt_arr) {
            if ($opt_arr['id'] == $object_type_id) {
                foreach ($opt_arr as $index => $opt) {
                    $result['object_types'][$index] = $opt;
                }
            }
        }

        return $result;
    }


    public function getFormByID($form_id = 0)
    {
        $result = [];
        $same_id = [];

        //Категория
        $sql = 'SELECT * FROM form_categories WHERE form_id =:form_id ORDER BY id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':form_id', $form_id);
        $stmt->execute();
        $category = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Подкатегория
        $sql = 'SELECT * FROM form_subcategories WHERE form_id =:form_id ORDER BY id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':form_id', $form_id);
        $stmt->execute();
        $subcategory = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Элементы
        $sql = 'SELECT * FROM form_elements WHERE form_id =:form_id ORDER BY id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':form_id', $form_id);
        $stmt->execute();
        $elements = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Опции выбора
        //Все опции (element_id) соответствующие id Элементов
        $sql = 'SELECT * FROM form_select_options';
        if (!empty($elements[0])) {
            $sql = $sql . ' WHERE element_id IN (';
            foreach ($elements as $k => $el) {
                $sql = $sql . $el['id'] . ', ';
            }
            // удаление последней запятой
            $sql = substr($sql, 0, -2);
            $sql = $sql . ') ORDER BY id';
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $select_options = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Нахождение одинаковых названий
        foreach ($category as $k => $v) {
            $same_id['category']['r_name_' . $k] = $v['r_name'];
            $same_id['category']['e_name_' . $k] = $v['e_name'];
        }

        foreach ($subcategory as $k => $v) {
            $same_id['subcategory']['r_name_' . $k] = $v['r_name'];
            $same_id['subcategory']['e_name_' . $k] = $v['e_name'];
        }

        foreach ($elements as $k => $v) {
            $same_id['elements']['r_name_' . $k] = $v['r_name'];
            $same_id['elements']['e_name_' . $k] = $v['e_name'];
        }

        foreach ($select_options as $k => $v) {
            $same_id['select_options']['r_name_' . $k] = $v['r_name'];
            $same_id['select_options']['e_name_' . $k] = $v['e_name'];
        }

        $same_id_category = array_count_values($same_id['category']);
        $same_id_subcategory = array_count_values($same_id['subcategory']);
        $same_id_elements = array_count_values($same_id['elements']);
        $same_id_select_options = array_count_values($same_id['select_options']);


        foreach ($same_id_category as $k => $v) {
            if ($v != 1) {
                $result['same_name']['category'][$k] = $v;
            }
        }
        foreach ($same_id_subcategory as $k => $v) {
            if ($v != 1) {
                $result['same_name']['subcategory'][$k] = $v;
            }
        }
        foreach ($same_id_elements as $k => $v) {
            if ($v != 1) {
                $result['same_name']['elements'][$k] = $v;
            }
        }
        foreach ($same_id_select_options as $k => $v) {
            if ($v != 1) {
                $result['same_name']['select_options'][$k] = $v;
            }
        }
        if (!isset($result['same_name'])) {
            $result['same_name']['Нет совпадающих элементов'] = array();
        }

        //Приведение данных в удобный для вывода массив
        // 1. Вложение select_options в elements
        foreach ($select_options as $opt_k => $opt_arr) {
            foreach ($elements as $el_k => $el_arr) {
                if ($opt_arr['element_id'] == $el_arr['id']) {
                    $elements[$el_k]['select_options'][$opt_k] = $opt_arr;
                }
            }
        }
        // 2. Вложение elements в subcategory
        foreach ($elements as $el_k => $el_arr) {
            foreach ($subcategory as $sub_k => $sub_arr) {
                if ($el_arr['subcategory'] == $sub_arr['id']) {
                    $subcategory[$sub_k]['element'][$el_k] = $el_arr;
                }
            }
        }
        // 3. Вложение elements в category
        foreach ($elements as $el_k => $el_arr) {
            foreach ($category as $cat_k => $cat_arr) {
                if ($el_arr['category'] == $cat_arr['id']) {
                    $category[$cat_k]['element'][$el_k] = $el_arr;
                }
            }
        }
        // 3. Вложение subcategory в category
        foreach ($subcategory as $sub_k => $sub_arr) {
            foreach ($category as $cat_k => $cat_arr) {
                if ($sub_arr['category_id'] == $cat_arr['id']) {
                    $category[$cat_k]['subcategory'][$sub_k] = $sub_arr;
                }
            }
        }

        //Сортировка категорий и подкатегорий
        //Функции сортировки
        function sortFormCategory($a, $b)
        {
            $sort = [
                'Базовый раздел' => 1,
                'Основное' => 2,
                'Основные параметры' => 3,
                'Исходные параметры' => 4,
                'Исходные параметры квартиры' => 5,
                'Характеристики дома' => 6,
                'Категории дома' => 7,
                'Обустройство' => 8,
                'Объект размещен' => 9,
                'Параметры объекта' => 10,
                'Ремонт и обустройство' => 11,
                'Ремонт и обустройство квартиры' => 12,
                'Участок' => 13,
                'Документы' => 14,
                'Вложения' => 15,
                'Дополнительно' => 16,
            ];

            if (!isset($sort[$a['r_name']]) OR !isset($sort[$b['r_name']])) {
                return 0;
            } else {
                if ($sort[$a['r_name']] > $sort[$b['r_name']]) {
                    return 1;
                } else {
                    return -1;
                };
            }

            return 0;
        }

        function sortFormSubcategory($a, $b)
        {
            if ($a['r_name'] == 'Цена') {
                return -1;
            }
            return 0;
        }

        //Сортировка подкатегорий
        foreach ($category as $k => $v) {
            if (isset($v['subcategory'])) {
                usort($category[$k]['subcategory'], "sortFormSubcategory");
            }
        }
        //Сортировка категорий
        usort($category, "sortFormCategory");

        //Результат
        $result['category'] = $category;
        return $result;


    }

    public function getAllUniqueFormsElements($table = 'form_elements', $rus = FALSE)
    {
        if ($rus) {
            $eng = 'r';
            $rus = 'e';
        } else {
            $eng = 'e';
            $rus = 'r';
        }
        $sql = 'SELECT DISTINCT ON (' . $eng . '_name, ' . $rus . '_name) ' . $eng . '_name, ' . $rus . '_name, id FROM ' . $table;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFormNameByIdOfELEMENT($form_options)
    {
        // Форма по id  select_option Вспомогательное
        $element_id = 2487;
        $sql = 'SELECT element_id FROM form_select_options WHERE id = ' . $element_id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $element_id = $stmt->fetchColumn();

        $sql = 'SELECT form_id, r_name  FROM form_elements WHERE id = ' . $element_id;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $form_id = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        echo '<br> Элемент: ' . $form_id['r_name'] . '<br>';

        $sql = 'SELECT * FROM forms WHERE id = ' . $form_id['form_id'];
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        foreach ($form_options['space_types'] as $v) {
            if ($v['id'] == $res['space_type']) {
                $res['space_type'] = $v['r_name'];
            };
        }
        foreach ($form_options['operation_types'] as $v) {
            if ($v['id'] == $res['operation']) {
                $res['operation'] = $v['r_name'];
            };
        }
        foreach ($form_options['object_types'] as $v) {
            if ($v['id'] == $res['object_type']) {
                $res['object_type'] = $v['r_name'];
            };
        }


        //Конец вспоможения
        return;
    }

    public function getIDOfAllForms()
    {
        $result = [];
        $sql = 'SELECT id FROM forms ORDER BY id';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_NUM) as $k => $v) {
            $result[$k] = $v[0];
        }
        return $result;
    }

    public function getIndexSelectOpt()
    {
        $sql = 'SELECT DISTINCT ON (e_name) e_name, r_name, value FROM form_select_options';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function generationNewsElements()
    {
        $result = [];
        // Исключения
        $exceptions = array(
            'price' => 'integer',
            'number_of_floors' => 'integer',
            'number_of_rooms' => 'integer',
            'the_number_of_kilowatt' => 'integer',
            'planning_project' => 'character varying(255)',
            'three_d_project' => 'character varying(255)',
            'video' => 'character varying(255)',
            'bargain' => 'boolean',
            'distance_from_mkad_or_metro' => 'integer',
            'availability_of_bathroom' => 'smallint',  // Количество санузлов
            'floor' => 'integer',
            'metro_station' => 'smallint',
            'balcony' => 'integer',
            'ceiling_height' => 'integer',
            'distance_from_metro' => 'integer',
            'electricity' => 'boolean',
            'not_residential' => 'integer',
            'security' => 'boolean',
            'year_of_construction' => 'integer',
            'lease_contract' => 'character varying(255)',
            'cadastral_number' => 'character varying(255)',

        );


        // Удалить
        $delete = ['no', 'yes', 'region_city', 'housing_and_communal_services', 'availability_of_elevator'];
        // По умолчанию, дополнительные параметры
        $on_default = array(
            'id_news' => 'serial',
            'form_name' => 'character varying(255)',
            'space_type' => 'smallint',
            'operation_type' => 'smallint',
            'object_type' => 'smallint',
            'category' => 'smallint',
            'status' => 'smallint',
            'user_id' => 'integer',
            'title' => 'character varying(255)',
            'date' => 'timestamp with time zone',
            'content' => 'text',
            'preview_img' => 'character varying(255)',
            'photo_available' => 'boolean',
            'tags' => 'character varying(255)',
            'country' => 'character varying(255)',
            'area' => 'character varying(255)',
            'city' => 'character varying(255)',
            'region' => 'character varying(255)',
            'address' => 'character varying(255)',
            'gas' => 'boolean',
            'heating' => 'boolean',
            'water_pipes' => 'boolean',
            'elevator_passangers' => 'boolean',
            'elevator_cargo' => 'boolean',
            'bathroom' => 'boolean',
            'dining_room' => 'boolean',
            'study' => 'boolean',
            'playroom' => 'boolean',
            'hallway' => 'boolean',
            'living_room' => 'boolean',
            'kitchen' => 'boolean',
            'bedroom' => 'boolean',
            'signaling' => 'boolean',
            'cctv' => 'boolean',
            'intercom' => 'boolean',
            'concierge' => 'boolean',
            'common' => 'integer',
            'resedential' => 'integer',
            'elevator' => 'smallint',
            'elevator_yes' => 'smallint',
            'bathroom_available' => 'boolean',
            'bathroom_description' => 'character varying(255)',
            'bathroom_location' => 'smallint',
            'bathroom_number' => 'integer',
            'possible_to_post' => 'boolean',
            'sanitation_description' => 'character varying(255)',
            'documents_on_tenure' => 'character varying(255)',
            'alcove' => 'boolean',
            'barn' => 'boolean',
            'bath' => 'boolean',
            'forest_trees' => 'boolean',
            'garden_trees' => 'boolean',
            'guest_house' => 'boolean',
            'lodge' => 'boolean',
            'playground' => 'boolean',
            'river' => 'boolean',
            'spring' => 'boolean',
            'swimming_pool' => 'boolean',
            'waterfront' => 'boolean',
            'wine_vault' => 'boolean',


        );
        // получение всех id элементов со списками
        $sql = 'SELECT DISTINCT ON (element_id) element_id FROM form_select_options';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        foreach ($stmt->fetchAll(PDO::FETCH_NUM) as $k => $v) {
            $select_options_el_id[$k] = $v[0];
        }

        $sql = 'SELECT DISTINCT ON (e_name) * FROM form_elements';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $all_el_for_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Запись массива имен e_name и назначение типа переменных
        foreach ($all_el_for_db as $el) {

            // Определение типа
            // 1) По умолчанию - строка 255 символов
            $type = 'character varying(255)';
            // 2) Если задан yes_value => boolean
            if (isset($el['yes_value'])) {
                $type = 'boolean';
            }
            // 3) Если список => индекс (smallint)
            if (in_array($el['id'], $select_options_el_id)) {
                $type = 'smallint';
            }
            // 4) Если Исключение =>
            if (array_key_exists($el['e_name'], $exceptions)) {
                $type = $exceptions[$el['e_name']];
            }
            //Запись массива имен
            if (!in_array($el['e_name'], $delete)) {
                $result['table'][$el['e_name']] = $type;
            }
        }

        //Соединение дополнительных параметров с генерированными
        return array_merge($on_default, $result['table']);

    }

    public function generationNewsTable($data)
    {
        $result = $data;
        // Исключения для параметров по умолчанию в таблице
        $default_exeptions = array(
            'id_news' => '',
            'category' => 'DEFAULT 1',
            'status' => 'DEFAULT 1',
            'date' => 'NOT NULL DEFAULT current_timestamp',

        );

        //Добавление параметров по умолчанию
        foreach ($result as $name => $type) {
            // Исключения
            if (isset($default_exeptions[$name])) {
                $result[$name] = $type . ' ' . $default_exeptions[$name];
            } else {
                $result[$name] = $type . ' DEFAULT NULL';
            }
        }

        return $result;
    }

    /**
     * Список ВСЕХ элементов и опций (не уникальных)
     * для проверки всех вариантов
     * @param $form - список действительных форм для отсева мусора
     * @return array
     */
    public function getAllFormsElementsAndOptions($forms)
    {
        $elements = [];
        $sql = 'SELECT e_name, r_name, id, form_id FROM form_elements';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        // id элементов записываем как ключи массива
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $v) {
            $elements[$v['id']] = $v;
        }


        // Плучение id всех форм
        $forms_id = [];
        foreach ($forms as $f) {
            $forms_id[$f['id']] = $f['id'];
        }
        // Отсев элементов не входящих в существующие формы
        foreach ($elements as $el_id => $el) {
            if (!isset($forms_id[$el['form_id']])) {
                unset($elements[$el_id]);
            }
        }

        //Списки
        $sql = 'SELECT e_name, r_name, value, element_id FROM form_select_options';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        // опции записываем в соответствующий element_id массив
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $k => $v) {
            if (isset($elements[$v['element_id']])) {
                $elements[$v['element_id']]['options'][$k] = $v;
            }
        }

        return $elements;
    }

    /**
     * Назначение вида вывода 'input_type' для элементов
     * @param $category = data['form']['category']
     * @param $news_db = type всех элементов в таблице новостей
     * @return массив $category с дополнеными значениями 'input_type'
     */
    public function setInputTypeForElements($category, $news_db)
    {

        //text select checkbox
        function setInputType($element, $news_db)
        {
            //Исключения
            $exceptions = array(
                'planning_project' => 'file',
                'three_d_project' => 'file',
                'video' => 'file',
            );
            // Предварительное назначение типа в соответствии с БД
            if (isset($news_db[$element['e_name']])) {
                switch ($news_db[$element['e_name']]) {
                    case 'boolean':
                        $type = 'checkbox';
                        break;
                    case 'smallint':
                        $type = 'select';
                        break;
                    default:
                        $type = 'text';
                }

                // Обработка исключений
                if (isset($exceptions[$element['e_name']])) {
                    $type = $exceptions[$element['e_name']];
                }
            } else {
                $type = 'deleted';
            }
            return $type;
        }


        foreach ($category as $k_c => $v_c) {
            // элементы без подкатегорий
            if (isset($v_c['element'])) {
                foreach ($v_c['element'] as $k_e => $v_e) {
                    $category[$k_c]['element'][$k_e]['input_type'] = setInputType($v_e, $news_db);
                }
            }
            // подкатегории
            if (isset($v_c['subcategory'])) {
                foreach ($v_c['subcategory'] as $k_sc => $v_sc) {
                    if (isset($v_sc['element'])) {
                        foreach ($v_sc['element'] as $k_e => $v_e) {
                            $category[$k_c]['subcategory'][$k_sc]['element'][$k_e]['input_type'] = setInputType($v_e, $news_db);
                        }
                    }
                }
            }
        }

        return $category;
    }

    public function correctingStupidData($return_category)
    {
        //Исключения !!!!
        //Категории
        $c_new = [''];
        //Подкатегории
        $s_new = ['elevator', 'fencing'];
        //Элементы
        $e_new = ['region_city', 'availability_of_bathroom', 'housing_and_communal_services', 'fencing'];

        //Функции правок
        function correctingCategory($k_c, $v_c, $category)
        {
            if ($v['e_name'] = '') {

            }
            return $category;
        }

        function correctingSubcategory($k_s, $name_s, $category)
        {

            if ($name_s == 'elevator') {
                // Очистка подкатегории
                $category['subcategory'][$k_s]['element'] = [];
                //Новые элементы
                $category['subcategory'][$k_s]['element'] = [
                    ['r_name' => 'Пассажирский',
                        'e_name' => 'elevator_passangers',
                        'input_type' => 'checkbox'],
                    ['r_name' => 'Грузовой',
                        'e_name' => 'elevator_cargo',
                        'input_type' => 'checkbox'],
                ];
            }

            if ($name_s == 'fencing') {
                //Удаление подкатегории
                unset($category['subcategory'][$k_s]);
                //Новые элементы
                $id_1 = notExistingID($category['element']);
                $category['element'][$id_1] = [
                    'r_name' => 'Ограждение',
                    'e_name' => 'fencing',
                    'input_type' => 'checkbox'];
                $id_2 = notExistingID($category['element']);
                $category['element'][$id_2] = [
                    'r_name' => 'Материал ограждения',
                    'e_name' => 'fencing_material',
                    'input_type' => 'select',
                    'select_options' => [
                        0 => [
                            'r_name' => 'Кованая ограда',
                            'e_name' => 'wrought_iron_fence',
                            'value' => '143'
                        ],
                        1 => [
                            'r_name' => 'Металлические прутья',
                            'e_name' => 'metal_rods',
                            'value' => '75'
                        ],
                        2 => [
                            'r_name' => 'Кирпич',
                            'e_name' => 'brick',
                            'value' => '19'
                        ],
                        3 => [
                            'r_name' => 'Бетон',
                            'e_name' => 'concrete',
                            'value' => '31'
                        ],
                        4 => [
                            'r_name' => 'Камень',
                            'e_name' => 'stone',
                            'value' => '122'
                        ],
                        5 => [
                            'r_name' => 'Профнастил',
                            'e_name' => 'decking',
                            'value' => '38'
                        ],
                        6 => [
                            'r_name' => 'Дерево',
                            'e_name' => 'wood',
                            'value' => '142'
                        ],
                        7 => [
                            'r_name' => 'Пластик',
                            'e_name' => 'plastic',
                            'value' => '98'
                        ],
                    ]];
            }


            return $category;
        }


        function correctingElement($indx_e, $name_e, $category)
        {

            //$category - текущяя категория
            //$category['subcategory'] - массив подкатегории(если это категория)
            //$category['element'] - массив элементов

            if ($name_e == 'region_city') {
                //Вставляются 5 новых элемента
                //передвигаем ключи других элементов на 4 вперед
                $category['element'] = shiftID(4, $indx_e, $category['element']);
                $category['element'][($indx_e + 0)] = [
                    'r_name' => 'Страна',
                    'e_name' => 'country',
                    'input_type' => 'text'];
                $category['element'][($indx_e + 1)] = [
                    'r_name' => 'Область',
                    'e_name' => 'area',
                    'input_type' => 'text'];
                $category['element'][($indx_e + 2)] = [
                    'r_name' => 'Город',
                    'e_name' => 'city',
                    'input_type' => 'text'];
                $category['element'][($indx_e + 3)] = [
                    'r_name' => 'Район',
                    'e_name' => 'region',
                    'input_type' => 'text'];
                $category['element'][($indx_e + 4)] = [
                    'r_name' => 'Точный адрес',
                    'e_name' => 'address',
                    'input_type' => 'text'];
            }

            if ($name_e == 'availability_of_bathroom') {

                // Элемент =>  3 новых элемента
                $category['element'] = shiftID(3, $indx_e, $category['element']);
                $category['element'][($indx_e + 0)] = [
                    'r_name' => 'Количество санузлов',
                    'e_name' => 'availability_of_bathroom',
                    'input_type' => 'select',
                    'select_options' => [
                        0 => [
                            'r_name' => 'Нет',
                            'e_name' => 'no',
                            'value' => '84'
                        ],
                        1 => [
                            'r_name' => '1',
                            'e_name' => '1',
                            'value' => '1'
                        ],
                        2 => [
                            'r_name' => '2',
                            'e_name' => '2',
                            'value' => '2'
                        ],
                        3 => [
                            'r_name' => '3',
                            'e_name' => '3',
                            'value' => '3'
                        ],
                        4 => [
                            'r_name' => '4+',
                            'e_name' => '4+',
                            'value' => '4'
                        ],
                    ]];
                $category['element'][($indx_e + 1)] = [
                    'r_name' => 'Расположение санузлов',
                    'e_name' => 'location_of_bathroom',
                    'input_type' => 'text'];
                $category['element'][($indx_e + 2)] = [
                    'r_name' => 'Описание санузлов',
                    'e_name' => 'description_of_bathroom',
                    'input_type' => 'text'];
            }

            if ($name_e == 'housing_and_communal_services') {
                //Удаляем элемент
                unset($category['element'][$indx_e]);
                //Новая подкатегория
                if (isset($category['subcategory'])) {
                    $new_subcategory_id = notExistingID($category['subcategory']);
                } else $new_subcategory_id = 1;

                $category['subcategory'][$new_subcategory_id] = [
                    'r_name' => 'Жилищно-коммунальные услуги',
                    'e_name' => 'housing_and_communal_services',
                    'id' => 0,
                    'element' => [
                        ['r_name' => 'Отопление',
                            'e_name' => 'availability_of_heating',
                            'input_type' => 'checkbox'],
                        ['r_name' => 'Газ',
                            'e_name' => 'availability_of_gas',
                            'input_type' => 'checkbox'],
                        ['r_name' => 'Электричество',
                            'e_name' => 'availability_of_electricity',
                            'input_type' => 'checkbox'],
                        ['r_name' => 'Водопровод',
                            'e_name' => 'availability_of_water_pipes',
                            'input_type' => 'checkbox']
                    ]
                ];

            }

            if ($name_e == 'fencing') {
                // Проверка на присутствие пункта "материал ограждения"
                foreach ($category['element'] as $v) {
                    if ($v['e_name'] == 'fencing_material') {
                        return $category;
                    }
                }
                //Если нет => элемент ограждение
                $category['element'][$indx_e] = [
                    'r_name' => 'Ограждение',
                    'e_name' => 'fencing',
                    'input_type' => 'checkbox'];
                // Добавляем список материал ограждения
                $new_id = notExistingID($category['element']);
                $category['element'][$new_id] = [
                    'r_name' => 'Материал ограждения',
                    'e_name' => 'fencing_material',
                    'input_type' => 'select',
                    'select_options' => [
                        0 => [
                            'r_name' => 'Кованая ограда',
                            'e_name' => 'wrought_iron_fence',
                            'value' => '143'
                        ],
                        1 => [
                            'r_name' => 'Металлические прутья',
                            'e_name' => 'metal_rods',
                            'value' => '75'
                        ],
                        2 => [
                            'r_name' => 'Кирпич',
                            'e_name' => 'brick',
                            'value' => '19'
                        ],
                        3 => [
                            'r_name' => 'Бетон',
                            'e_name' => 'concrete',
                            'value' => '31'
                        ],
                        4 => [
                            'r_name' => 'Камень',
                            'e_name' => 'stone',
                            'value' => '122'
                        ],
                        5 => [
                            'r_name' => 'Профнастил',
                            'e_name' => 'decking',
                            'value' => '38'
                        ],
                        6 => [
                            'r_name' => 'Дерево',
                            'e_name' => 'wood',
                            'value' => '142'
                        ],
                        7 => [
                            'r_name' => 'Пластик',
                            'e_name' => 'plastic',
                            'value' => '98'
                        ],
                    ]];
            }

            ksort($category['element']);
            return $category;
        }


        // функция смещения id элементов(в массиве array_c) на n вперед,
        // если они находятся после
        // вставляемого элемента с id = id_k_e
        function shiftID($n, $id_k_e, $array_c)
        {
            $buffer = [];
            foreach ($array_c as $k => $v) {
                if ($k > $id_k_e) {
                    $buffer[$k + 4] = $v;
                } else {
                    $buffer[$k] = $v;
                }
            }
            return $buffer;
        }

// функция выдает первый id не содержащийся в массиве начиная с 1
        function notExistingID($array)
        {
            for ($i = 1; $i < 100; $i++) {
                if (!isset($array[$i])) {
                    return $i;
                }
            }
        }


        //Внесение исправлений
        //категории
        foreach ($return_category as $k_c => $v_c) {
            if (in_array($v_c['e_name'], $c_new)) {
                $return_category = correctingCategory($k_c, $v_c['e_name'], $return_category);
            }
            //элементы в категориях
            if (isset($return_category[$k_c]['element'])) {
                foreach ($return_category[$k_c]['element'] as $k_e => $v_e) {
                    if (in_array($v_e['e_name'], $e_new)) {
                        $return_category[$k_c] = correctingElement($k_e, $v_e['e_name'], $return_category[$k_c]);
                    }
                }
            }
            //подкатегории
            if (isset($return_category[$k_c]['subcategory'])) {
                foreach ($return_category[$k_c]['subcategory'] as $k_s => $v_s) {
                    if (in_array($v_s['e_name'], $s_new)) {
                        $return_category[$k_c] = correctingSubcategory($k_s, $v_s['e_name'], $return_category[$k_c]);
                    }
                    //элементы в подкатегориях
                    if (isset($return_category[$k_c]['subcategory'][$k_s]['element'])) {
                        foreach ($return_category[$k_c]['subcategory'][$k_s]['element'] as $k_e => $v_e) {
                            if (in_array($v_e['e_name'], $e_new)) {
                                $return_category[$k_c]['subcategory'][$k_s] = correctingElement($k_e, $v_e['e_name'], $return_category[$k_c]['subcategory'][$k_s]);
                            }
                        }
                    }
                }
            }

        }


        return $return_category;

    }

    public function changeFileNewsMenu($f_name, $form_options)
    {
        //Чтение файла
        if (file_exists($f_name)) {

            $lines = file($f_name); // построчное чтение

            foreach ($lines as $key => $value) {
                if (preg_match('/^\$form_options\[\'space_types\'\]/', $value)) {
                    $var_text = '';
                    ksort($form_options['space_types']);
                    foreach ($form_options['space_types'] as $k => $v) {
                        $var_text .= $k . '=>\'' . $v['r_name'] . '\', ';
                    }
                    $lines[$key] = "\$form_options['space_types'] = [" . $var_text . "];\n";
                }
                if (preg_match('/^\$form_options\[\'operation_types\'\]/', $value)) {
                    $var_text = '';
                    ksort($form_options['operation_types']);
                    foreach ($form_options['operation_types'] as $k => $v) {
                        $var_text .= $k . '=>\'' . $v['r_name'] . '\', ';
                    }
                    $lines[$key] = "\$form_options['operation_types'] = [" . $var_text . "];\n";
                }
                if (preg_match('/^\$form_options\[\'object_types\'\]/', $value)) {
                    $var_text = '';
                    ksort($form_options['object_types']);
                    foreach ($form_options['object_types'] as $k => $v) {
                        $var_text .= $k . '=>\'' . $v['r_name'] . '\', ';
                    }
                    $lines[$key] = "\$form_options['object_types'] = [" . $var_text . "];\n";
                }
                if (preg_match('/var form_options_menu/', $value)) {
                    $var_arr = [];
                    $var_text = '';
                    //Все возможные доступные варианты меню из БД
                    foreach ($form_options['base'] as $value) {
                        $var_arr[$value['space_type']['id']][$value['operation']['id']][$value['object_type']['id']] = 1;
                    }
                    $var_text .= "{";
                    foreach ($var_arr as $k1 => $v1) {
                        $var_text .= $k1 . ':{';
                        foreach ($v1 as $k2 => $v2) {
                            $var_text .= $k2 . ':{';
                            foreach ($v2 as $k3 => $v3) {
                                $var_text .= $k3 . ':';
                                $var_text .= $v3;
                                $var_text .= ', ';
                            }
                            // удаляем последнюю запятую
                            $var_text = substr($var_text, 0, -2);
                            $var_text .= '}, ';
                        }
                        $var_text = substr($var_text, 0, -2);
                        $var_text .= '}, ';
                    }
                    $var_text = substr($var_text, 0, -2);
                    $var_text .= "}";
                    $lines[$key] = "var form_options_menu = " . $var_text . ";\n";
                }
            }

            $f = fopen($f_name, "w");
            foreach ($lines as $v) {
                fputs($f, $v);
            }
            fclose($f);


            return "Произведена успешная перезапись файла \"$f_name\" в соответствии с БД form";
        } else {
            return "Файл \"$f_name\" не найден";
        }

    }

    /**
     * Генерировать $args - код фильтрации POST для getFormData модели news
     * @param $news_db
     * @return array
     */
    public function generationNewsPostArgs($news_db)
    {
        $args = [];

        foreach ($news_db as $name => $value) {

            switch ($value) {
                case 'character varying(255)':
                    $filt = 'FILTER_SANITIZE_STRING';
                    break;
                case 'text':
                    $filt = 'FILTER_SANITIZE_STRING';
                    break;
                case 'smallint':
                    $filt = 'FILTER_SANITIZE_NUMBER_INT';
                    break;
                case 'integer':
                    $filt = 'FILTER_SANITIZE_NUMBER_INT';
                    break;
                case 'boolean':
                    $filt = 'FILTER_VALIDATE_BOOLEAN';
                    break;
                default:
                    $filt = 'NO !!!!!!';
                    break;
            }
            $args[$name] = $filt;

            //Удаление ненужных параметров
            unset($args['id_news']);
            unset($args['date']);


        }
        return $args;
    }

    public function allCheckboxList($news_db)
    {
        //Открытие файла NewsModel.php
        $file_name = 'app/models/NewsModel.php';
        if (file_exists($file_name)) {
            $lines = file($file_name);
            foreach ($lines as $key => $value) {
                if (preg_match('/\$all_checkbox_list/', $value) && preg_match('/\](?=\;)/', $value)) {
                    //получение всех boolean типов из БД
                    $bool_type = [];
                    foreach ($news_db as $k => $v) {
                        if ($v == 'boolean') {
                            array_push($bool_type, $k);
                        }
                    }
                    //Изменение строки
                    $lines[$key] = '$all_checkbox_list = [';
                    foreach ($bool_type as $v) {
                        $lines[$key] .= "'" . $v . "', ";
                    }
                    $lines[$key] = substr($lines[$key], 0, -2);
                    $lines[$key] .= "];\n";
                }
            }

            //Запись обратно
            $f = fopen($file_name, "w");
            foreach ($lines as $v) {
                fputs($f, $v);
            }
            fclose($f);
        }
        return;
    }


    //Получение данных из файла не доделано
    public function generatingNewsFormsBySearchForms($news_db, $generation_file_name)
    {


        $result = [];
        $file_name = 'app/views/news/' . $generation_file_name;

        // Определение переменных из файла
        $db_vars = [];
        if (file_exists($file_name)) {
            $lines = file($file_name);

            foreach ($lines as $key => $value) {
                if (preg_match('/name="\w*.\w*"/', $value, $matches)) {
                    $matches[0] = substr($matches[0], 6, -1);
                    if (preg_match('/max$/', $matches[0]) OR preg_match('/min$/', $matches[0])) {
                        $matches[0] = substr($matches[0], 0, -4);
                    }
                    array_push($db_vars, $matches[0]);
                }
            }

            $db_vars = array_unique($db_vars);
            asort($db_vars);

            //Определение переменных присутствующих в БД и отсутствующих
            foreach ($db_vars as $value) {
                if (isset($news_db[$value])) {
                    $result['elements_in_db'][$value] = $news_db[$value];
                } else {
                    $result['elements_out_db'][$value] = $value;
                }
            }
            // обработка формы
            $result['form'] = [];
            foreach ($lines as $key => $value) {
                $start = 'style=\'';
                $end = '\'';
                $lines[$key] = $this->cutLine($lines[$key], $start, $end);

                $start = 'style="';
                $end = '"';
                $lines[$key] = $this->cutLine($lines[$key], $start, $end);

                $start = 'style="';
                $end = '"';
                $lines[$key] = $this->cutLine($lines[$key], $start, $end);

                $start = 'placeholder="';
                $end = '"';
                $lines[$key] = $this->cutLine($lines[$key], $start, $end);

                $start = '-mi';
                $end = 'n';
                $lines[$key] = $this->cutLine($lines[$key], $start, $end);

                $start = '-ma';
                $end = 'x';
                $lines[$key] = $this->cutLine($lines[$key], $start, $end);

                $start = '-mi';
                $end = 'n';
                $lines[$key] = $this->cutLine($lines[$key], $start, $end);

                $start = '-ma';
                $end = 'x';
                $lines[$key] = $this->cutLine($lines[$key], $start, $end);

                //Замена некоторых полей checkbox -> text
                $checkbox_to_text = ['bathroom_description', 'sanitation_description', 'cadastral_number'];

                if (preg_match("/type=\"checkbox\"/", $lines[$key])) {
                    // Имя
                    $name = $this->getNameFromLine($lines[$key]);
                    if (in_array($name, $checkbox_to_text)) {
                        $start_pos = strpos($lines[$key], 'type="');
                        $end_pos = strpos($lines[$key], '"', ($start_pos + strlen('type="'))) + 1;
                        $line_before = substr($lines[$key], 0, $start_pos);
                        $line_after = substr($lines[$key], $end_pos);
                        $lines[$key] = $line_before . 'type="text"' . $line_after;
                    }

                }

                array_push($result['form'], $lines[$key]);

            }

        } else {

        }
//Удаление двойных строк
        foreach ($result['form'] as $k => $v) {
            if ($k > 1) {
                if ($result['form'][$k] == $result['form'][($k - 1)]) {
                    unset($result['form'][($k - 1)]);
                }
            }
        }
        return $result;
    }


    public function cutLine($line, $start, $end)
    {
        if (preg_match("/$start/", $line)) {
            $start_pos = strpos($line, $start);
            $end_pos = strpos($line, $end, ($start_pos + strlen($start))) + 1;
            $line_before = substr($line, 0, $start_pos);
            $line_after = substr($line, $end_pos);
            return $line_before . $line_after;
        } else return $line;
    }

    public function insertLineAfterName($line, $insert_line, $name = "name=\"")
    {
        if (preg_match("/$name/", $line)) {
            //позиция начала имени
            $start_pos = strpos($line, $name);
            //позиция после задания имени
            $insert_pos = strpos($line, '"', ($start_pos + strlen($name))) + 1;
            //части перед и после вставки
            $line_before = substr($line, 0, $insert_pos);
            $line_after = substr($line, $insert_pos);
            //Вставка отрезка
            return $line_before . ' ' . $insert_line . ' ' . $line_after;
        } else return $line;
    }

    public function getNameFromLine($line)
    {
        //имя
        if (preg_match('/name="\w*.\w*"/', $line, $matches)) {
            $name = substr($matches[0], 6, -1);
            return $name;
        } else {
            return FALSE;
        }

    }

    /**
     * Вставка php кода заполнения полей при редактировании
     * И удаление опций "Не важно", Вставка первой опции "---"
     * @param $generation_file_name
     * @return array
     */
    public function insertingPhpCodeForFillingFields($generation_file_name)
    {
        $file_name = 'app/views/news/' . $generation_file_name;
        if (file_exists($file_name)) {
            $lines = file($file_name);

            foreach ($lines as $key => $line) {
                //news_editor.php функции
                //inputToInput
                //inputToCheckbox
                //inputToSelect

                // отсутствует inputToRadio
                // отсутствует addClassCheckbox
                // отсутствует inputOtherSelect
                // отсутствует addClassOtherInput

                //inputToInput
                if (preg_match("/input/", $line) && preg_match("/type=\"text\"/", $line)) {
                    $name = $this->getNameFromLine($line);
                    $insert_line = '<?php inputToInput("' . $name . '"); ?>';
                    $lines[$key] = $this->insertLineAfterName($line, $insert_line);
                }

                //inputToCheckbox
                if (preg_match("/input/", $line) && preg_match("/type=\"checkbox\"/", $line)) {
                    $name = $this->getNameFromLine($line);
                    $insert_line = '<?php inputToCheckbox("' . $name . '"); ?>';
                    $lines[$key] = $this->insertLineAfterName($line, $insert_line);

                    //перед импутом вставляем спрятаный импут пустого значения
                    $insert_line = " <input type=\"hidden\" name=\"" . $name . "\" value=\"\"> ";
                    //позиция начала имени
                    $insert_pos = strpos($lines[$key], '<input ');
                    //части перед и после вставки
                    $line_before = substr($lines[$key], 0, $insert_pos);
                    $line_after = substr($lines[$key], $insert_pos);
                    //Вставка отрезка
                    $lines[$key] = $line_before . ' ' . $insert_line . ' ' . $line_after;
                }

                //inputToSelect
                if (preg_match("/option/", $line) && preg_match("/value/", $line)) {
                    // Имя опции
                    preg_match('/value="\w*.\w*"/', $line, $matches);
                    $option_name = substr($matches[0], 7, -1);
                    //Имя селекта
                    for ($i = $key; $i > 0; $i--) {
                        if ($select_name = $this->getNameFromLine($lines[$i])) {
                            break;
                        }
                    }
                    $insert_line = ' <?php inputToSelect(\'' . $select_name . '\',\'' . $option_name . '\'); ?> ';
                    $lines[$key] = $this->insertLineAfterName($line, $insert_line, "value=\"");


                }


            }
            //Вставка первой опции "---"

            do {
                foreach ($lines as $key => $line) {
                    $end = 1;
                    if (preg_match("/<select/", $line) && !preg_match("/option value=\"0\"/", $lines[($key + 1)])) {
                        echo $key;
                        $arr_1 = array_slice($lines, 0, ($key + 1));
                        $arr_2 = array_slice($lines, ($key + 1));
                        array_push($arr_1, '<option value="0">---</option>');
                        $lines = array_merge($arr_1, $arr_2);
                        $end = 0;
                        break;
                    }
                }

            } while ($end == 0);


            //Удаление опции "Не важно"
            foreach ($lines as $key => $line) {
                if (preg_match("/option/", $line) && preg_match("/value/", $line)) {
                    // Имя опции
                    preg_match('/value="\w*.\w*"/', $line, $matches);
                    $option_name = substr($matches[0], 7, -1);
                    if ($option_name == 41) {
                        unset($lines[$key]);
                    }
                }
            }

        }
        return $lines;
    }


    public function elementsEngRus($news_db)
    {
        $news_en_ru = [];
        $form_en_ru = [];
        // Дополнительные параметры
        $dop_en_ru = [
            'id_news' => 'Индекс объявления',
            'form_name' => 'Имя формы',
            'space_type' => 'Тип площади',
            'operation_type' => 'Операция',
            'object_type' => 'Тип объекта',
            'category' => 'Категория',
            'status' => 'Статус',
            'user_id' => 'ID пользователя',
            'title' => 'Название новости',
            'date' => 'Дата',
            'content' => 'Контент',
            'photo_available' => 'Наличие фотографий',
            'tags' => 'Тег',
            'country' => 'Страна',
            'area' => 'Область',
            'city' => 'Город',
            'region' => 'Регион',
            'address' => 'Адрес',
            'gas' => 'Газ',
            'heating' => 'Отопление',
            'water_pipes' => 'Водопровод',
            'elevator_passangers' => 'Пассажирский лифт',
            'elevator_cargo' => 'Грузовой лифт',
            'bathroom' => 'Ванная',
            'dining_room' => 'Столовая',
            'study' => 'Рабочий кабинет',
            'playroom' => 'Детская',
            'hallway' => 'Прихожая',
            'living_room' => 'Гостиная',
            'kitchen' => 'Кухня',
            'bedroom' => 'Спальня',
            'signaling' => 'Сигнализация',
            'cctv' => 'Видеонаблюдение',
            'intercom' => 'Домофон',
            'concierge' => 'Консьерж',
            'common' => 'Общая',
            'resedential' => 'Жилая',
            'elevator' => 'Наличие лифта',
            'elevator_yes' => 'Лифт',
            'bathroom_description' => 'Описание санузлов',
            'bathroom_location' => 'Расположение санузлов',
            'bathroom_number' => 'Количество санузлов',
            'possible_to_post' => 'Возможность проводки',
            'sanitation_description' => 'Описание',
            'documents_on_tenure' => 'Документы на право владения',
        ];
        // Удалить
        $delete_en_ru = ['preview_img'];
        // Получение рус. названий из БД form
        $sql = 'SELECT DISTINCT ON (e_name) e_name, r_name FROM form_elements';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stmt_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($stmt_result as $k => $v) {
            $form_en_ru[$v['e_name']] = $v['r_name'];
        }
        // Список переменных из базы данных news_base
        foreach ($news_db as $k => $v) {
            if (isset($form_en_ru[$k])) {
                $news_en_ru['element'][$k] = $form_en_ru[$k];
            } elseif (in_array($k, $delete_en_ru)) {
            } else {
                $news_en_ru['element'][$k] = '!!!';
            }

        }
// Ввод дополнительных параметров
        foreach ($dop_en_ru as $e => $r) {
            $news_en_ru['element'][$e] = $r;
        }

//Опции

// Получение рус. названий из БД form
        $sql = 'SELECT DISTINCT ON (value) value, r_name FROM form_select_options';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stmt_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($stmt_result as $k => $v) {
            $news_en_ru['options'][$v['value']] = $v['r_name'];
        }
        asort($news_en_ru['options']);
        return $news_en_ru;
    }


}
