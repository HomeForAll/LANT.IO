<?php

class NewsModel extends Model {

    // Список всех таблиц новостей
    const all_news_tables = 'news_base, news_rentapart';

    public function __construct() {
        $this->db = new DataBase;
    }

    public function ajaxHandler() {
        
    }

    // Проверка строки на вредоносные элементы
    public function checkingString($str) {
        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    public function getNewsCategories() {
        $stmt = $this->db->prepare("SELECT category FROM news_category ORDER BY category");
        $stmt->execute();
        $coll = $stmt->fetchall(PDO::FETCH_NUM);
        foreach ($coll as $key => $value) {
            $result[$key] = $value[0];
        }
        return $result;
    }

    public function getNamberOfAllRows($table = 'base') {
        if ($table == 'base') {
            $table = 'news_base';
        } else {
            $table = 'news_' . $table;
        }

        $q = "SELECT COUNT(*) FROM " . $table;
        if ($stmt = $this->db->query($q)) {
            $result = $stmt->fetchColumn();
        } else {
            $this->getNamberOfAllRows();
        }
        return $result;
    }

    public function getNewsPageType($str) {
        //Если это id
        if (substr($str, 0, 2) == 'id') {
            if (substr($str, 2, 1) == 'b') {
                $editor_page_type = 'base';
            } else {
                if (substr($str, 2, 1) == 'r') {
                    $editor_page_type = 'rent';
                }
                if (substr($str, 2, 1) == 's') {
                    $editor_page_type = 'sale';
                }
                if (substr($str, 3, 1) == 'a') {
                    $editor_page_type = $editor_page_type . 'apart';
                }
                if (substr($str, 3, 1) == 'h') {
                    $editor_page_type = $editor_page_type . 'house';
                }
                if (substr($str, 3, 1) == 'r') {
                    $editor_page_type = $editor_page_type . 'room';
                }
                if (substr($str, 3, 1) == 'l') {
                    $editor_page_type = $editor_page_type . 'land';
                }
            }
        } else {
            if (!empty($str)) {
                $editor_page_type = $str;
            } else {
                $editor_page_type = 'base';
            }
        }
        return $editor_page_type;
    }

    public function getNewsById($id) {
        //определяем тип новости
        $editor_page_type = $this->getNewsPageType($id);

        // !!! определение имени таблицы по id
        $news_table = 'news_' . $editor_page_type;

        $stmt = $this->db->prepare("SELECT * "
                . "FROM " . $news_table
                . " WHERE id_news = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

// разбиваем имена и передаем их в массиве
        $data['preview_img'] = explode('|', $data['preview_img']);
        return $data;
    }

    public function prepareNewsView($news) {
        //новый массив данных новости
        $new_data = [];
        //Удаление несуществующих параметров
        foreach ($news as $key => $val) {
            if (!empty($val)) {
                $new_data[$key] = $news[$key];
            }
        }

        //!!! Заголовки !!!
        $header = array(
            'address' => 'Точный адрес',
            'armchair_num' => 'Кресло',
            'author_name' => 'Автор',
            'balcony' => 'Балкон',
            'bargain_available' => 'Торг возможен',
            'barn_num' => 'Сарай',
            'basement_num' => 'Подвал',
            'bathhouse_num' => 'Баня',
            'bathroom_num' => 'Ванная',
            'bed_num' => 'Кровать',
            'bedroom_num' => 'Спальня',
            'boiler_num' => 'Котельная',
            'cabinet_num' => 'Рабочий кабинет',
            'category' => 'Категория',
            'ceiling_height' => 'Высота потолков',
            'chair_num' => 'Стул',
            'conditioning_num' => 'Кондиционер',
            'content' => 'Основное содержание',
            'cupboard_num' => 'Шкаф',
            'devices_available' => 'Бытовая техника',
            'dining_room_num' => 'Столовая',
            'dishwasher_num' => 'Посудомойка',
            'distance_from_city' => 'Удаленность от города',
            'distance_from_metro' => 'Удаленность от метро',
            'district' => 'Район',
            'dressingroom_num' => 'Гардеробная',
            'electricity_available' => 'Электричество',
            'electronics_available' => 'Электроника для досуга',
            'elevator_available' => 'Наличие лифта',
            'equipment' => 'Комплектация',
            'fencing' => 'Ограждение',
            'flat_condition' => 'Состояние квартиры',
            'floor' => 'Этаж',
            'fridge_num' => 'Холодильник',
            'furniture_available' => 'Мебель',
            'garage_num' => 'Гараж',
            'garbage_available' => 'Наличие мусоропровода',
            'gas_available' => 'Газ',
            'hall_num' => 'Зал',
            'hallway_num' => 'Прихожая',
            'hearth_num' => 'Камин',
            'heating_available' => 'Отопление',
            'home_series' => 'Серия дома',
            'house_condition' => 'Состояние дома',
            'kitchen_num' => 'Кухня',
            'landscape' => 'Профиль/Ландшафт',
            'living_room_num' => 'Гостиная',
            'material_lining' => 'Материал облицовки',
            'metro_station' => 'Станция метро',
            'microwave_num' => 'СВЧ',
            'mirror_num' => 'Зеркало',
            'music_center_num' => 'Музыкальный центр',
            'number_of_floors' => 'Количество этажей',
            'number_of_inputs' => 'Количество входов',
            'number_of_minutes_parkin' => 'кол-во минут',
            'number_of_rooms' => 'Количество комнат',
            'parking_space' => 'Место для автомобиля',
            'parking_type' => 'Вид парковки',
            'pavilion_num' => 'Беседка',
            'play_room_num' => 'Детская',
            'plumbing_available' => 'Водопровод',
            'pool_num' => 'Бассейн',
            'price' => 'Цена',
            'range_num' => 'Плита',
            'region' => 'Округ',
            'sanitary_available' => 'Сантехника',
            'seasonality' => 'Сезонность',
            'security' => 'Безопасность',
            'short_content' => 'Короткое содержание',
            'sofa_num' => 'Диван',
            'space' => 'Площадь',
            'stairs_available' => 'Наличие лестницы',
            'stand_num' => 'Тумба',
            'stove_num' => 'Печь',
            'style_of_house' => 'Стиль дома',
            'table_num' => 'Стол',
            'tags' => 'Теги',
            'televisor_num' => 'Телевизор',
            'toilet' => 'Санузел',
            'tszh' => 'ТСЖ',
            'type_of_house' => 'Тип дома',
            'type_of_rent' => 'Тип аренды',
            'veranda_num' => 'Виранда',
            'village' => 'Деревня',
            'rooms_for_sale' => 'Комнат в продажу (шт)',
            'room_location' => 'Нахождение комнаты',
            'number_of_minutes_parking' => 'кол-во минут',
            'room_condition' => 'Состояние комнаты',
            'flora' => 'Флора'
        );


        //Присваивание заголовков
        foreach ($new_data as $key => $val) {
            if (!empty($header[$key])) {
                $new_data[$key . '_h'] = $header[$key];
            }
        }

        return $new_data;
    }

    // Вход: страница новостей
    // Возвращает: выборку всех данных новостей в виде массива
    public function getNewsList($page) {


        $data = []; //выходные данные
        $numberOfNews = 10; // Количество выводимых новостей по умолчани
        // Определение номера страницы выводимых новостей
        if (empty($page)) {
            // по умолчанию первая страница
            $data['page'] = 1;
        } else {
            $data['page'] = (int) $page[0];
        }

        // Количество выводимых новостей
        if (!empty($_POST['numberOfNews'])) {
            $numberOfNews = (int) $_POST['numberOfNews'];
            $_SESSION['numberOfNews'] = $numberOfNews;
        } elseif (!empty($_SESSION['numberOfNews'])) {
            $numberOfNews = $_SESSION['numberOfNews'];
        }
        // Таблица новостей
        if (!empty($_POST['news_table_category'])) {
            $data['news_table_category'] = $_POST['news_table_category'];
            $_SESSION['news_table_category'] = $data['news_table_category'];
        } elseif (!empty($_SESSION['news_table_category'])) {
            $data['news_table_category'] = $_SESSION['news_table_category'];
        } else {
            $data['news_table_category'] = 'base';
        }


        // Общее кол-во новостей
        $data['namberofallrows'] = $this->getNamberOfAllRows($data['news_table_category']);
        // Количество станиц и диапазон = $data['firstnews'],$data['lastnews'] 
        $total_pages = ceil($data['namberofallrows'] / $numberOfNews);

        if ($data['page'] > $total_pages) {
            $data['page'] = 1;
        }

        $data['firstnews'] = $data['page'] * $numberOfNews - $numberOfNews + 1;

        if ($data['page'] * $numberOfNews > $data['namberofallrows']) {
            $data['lastnews'] = $data['page'] * $numberOfNews - ($data['page'] * $numberOfNews - $data['namberofallrows']);
        } else {
            $data['lastnews'] = $data['page'] * $numberOfNews;
        }

        // Запрос БД      
        $from_page = $data['firstnews'] - 1;

        $stmt = $this->db->prepare("SELECT id_news, date::date, title, short_content, content, author_name, preview_img, status, category, tags "
                . "FROM news_" . $data['news_table_category']
                . " ORDER BY id_news DESC"
                . " LIMIT :numberofnews"
                . " OFFSET :from_page");
        $stmt->bindParam(':numberofnews', $numberOfNews);
        $stmt->bindParam(':from_page', $from_page);
        $stmt->execute();
        $data['news'] = $stmt->fetchAll();
        //Строку файлов картинок преобразуем в массив $data['news'][number]['preview_img'][]
        $data['news'] = $this->explodePreviewImg($data['news']);
        return $data;
    }

    public function explodePreviewImg($data_news) {

        foreach ($data_news as $k => $news_array) {
            $data_news[$k]['preview_img'] = explode('|', $news_array['preview_img']);
        }
        return $data_news;
    }

//Получает список новостей из заданной табицы($table) или из всех таблиц новостей(по умолчанию)
// отсортированный по дате    
    public function getNewsForEditorByDate($table = 'all') {
        $sql = 'SELECT id_news, date::date, title, author_name, status, category, tags ';
        $sql = $sql . 'FROM ';
        if ($table == 'all') {
            $sql = $sql . 'news, news_rentapart ';
        } else {
            $sql = $sql . $table;
        }
        $sql = $sql . ' ORDER BY date DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();


        return $result;
    }

    public function getFormData($preview_img) {

        //Удаление пробелов и переводов строк в начале и в конце строк 
        function trim_value(&$value) {
            $value = trim($value);
        }

        array_filter($_POST, 'trim_value');

        $args = array(
            'news_object' => FILTER_SANITIZE_STRING,
            'author_name' => FILTER_SANITIZE_STRING,
            'title' => FILTER_SANITIZE_STRING,
            'short_content' => FILTER_SANITIZE_STRING,
            'content' => FILTER_SANITIZE_STRING,
            'status' => array(
                'filter' => FILTER_VALIDATE_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
                'flags' => FILTER_NULL_ON_FAILURE,
            ),
            'category' => FILTER_SANITIZE_STRING,
            'tags' => FILTER_SANITIZE_STRING,
            'price' => array(
                'filter' => FILTER_VALIDATE_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
                'flags' => FILTER_NULL_ON_FAILURE,
                'options' => array('min_range' => 0)
            ),
            'bargain_available' => FILTER_SANITIZE_NUMBER_INT,
            'type_of_rent' => FILTER_SANITIZE_STRING,
            'region' => FILTER_SANITIZE_STRING,
            'district' => FILTER_SANITIZE_STRING,
            'address' => FILTER_SANITIZE_STRING,
            'metro_station' => FILTER_SANITIZE_STRING,
            'distance_from_metro' => array(
                'filter' => FILTER_VALIDATE_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
                'flags' => FILTER_NULL_ON_FAILURE,
            ),
            'number_of_rooms' => FILTER_SANITIZE_STRING,
            'space' => FILTER_SANITIZE_STRING,
            'floor' => FILTER_SANITIZE_STRING,
            'equipment' => FILTER_SANITIZE_STRING,
            'ceiling_height' => FILTER_SANITIZE_STRING,
            'type_of_house' => FILTER_SANITIZE_STRING,
            'home_series' => FILTER_SANITIZE_STRING,
            'tszh' => FILTER_SANITIZE_STRING,
            'tszh_other' => FILTER_SANITIZE_STRING,
            'number_of_floors' => FILTER_SANITIZE_STRING,
            'elevator_available' => FILTER_SANITIZE_NUMBER_INT,
            'stairs_available' => FILTER_SANITIZE_NUMBER_INT,
            'garbage_available' => FILTER_SANITIZE_NUMBER_INT,
            'security' => FILTER_SANITIZE_STRING,
            'parking_type' => FILTER_SANITIZE_STRING,
            'number_of_minutes_parkin' => FILTER_SANITIZE_STRING,
            'bedroom_num' => FILTER_SANITIZE_NUMBER_INT,
            'kitchen_num' => FILTER_SANITIZE_NUMBER_INT,
            'living_room_num' => FILTER_SANITIZE_NUMBER_INT,
            'hallway_num' => FILTER_SANITIZE_NUMBER_INT,
            'play_room_num' => FILTER_SANITIZE_NUMBER_INT,
            'cabinet_num' => FILTER_SANITIZE_NUMBER_INT,
            'dining_room_num' => FILTER_SANITIZE_NUMBER_INT,
            'bathroom_num' => FILTER_SANITIZE_NUMBER_INT,
            'flat_condition' => FILTER_SANITIZE_STRING,
            'toilet' => FILTER_SANITIZE_STRING,
            'televisor_num' => FILTER_SANITIZE_NUMBER_INT,
            'music_center_num' => FILTER_SANITIZE_NUMBER_INT,
            'conditioning_num' => FILTER_SANITIZE_NUMBER_INT,
            'fridge_num' => FILTER_SANITIZE_NUMBER_INT,
            'range_num' => FILTER_SANITIZE_NUMBER_INT,
            'stove_num' => FILTER_SANITIZE_NUMBER_INT,
            'microwave_num' => FILTER_SANITIZE_NUMBER_INT,
            'dishwasher_num' => FILTER_SANITIZE_NUMBER_INT,
            'table_num' => FILTER_SANITIZE_NUMBER_INT,
            'bed_num' => FILTER_SANITIZE_NUMBER_INT,
            'cupboard_num' => FILTER_SANITIZE_NUMBER_INT,
            'chair_num' => FILTER_SANITIZE_NUMBER_INT,
            'stand_num' => FILTER_SANITIZE_NUMBER_INT,
            'mirror_num' => FILTER_SANITIZE_NUMBER_INT,
            'armchair_num' => FILTER_SANITIZE_NUMBER_INT,
            'sofa_num' => FILTER_SANITIZE_NUMBER_INT,
            'balcony' => FILTER_SANITIZE_STRING,
            'devices_available' => FILTER_SANITIZE_NUMBER_INT,
            'electronics_available' => FILTER_SANITIZE_NUMBER_INT,
            'furniture_available' => FILTER_SANITIZE_NUMBER_INT,
            'sanitary_available' => FILTER_SANITIZE_NUMBER_INT,
            'heating_available' => FILTER_SANITIZE_NUMBER_INT,
            'gas_available' => FILTER_SANITIZE_NUMBER_INT,
            'electricity_available' => FILTER_SANITIZE_NUMBER_INT,
            'plumbing_available' => FILTER_SANITIZE_NUMBER_INT,
            'seasonality' => FILTER_SANITIZE_STRING,
            'village' => FILTER_SANITIZE_STRING,
            'distance_from_city' => FILTER_SANITIZE_NUMBER_INT,
            'style_of_house' => FILTER_SANITIZE_STRING,
            'material_lining' => FILTER_SANITIZE_STRING,
            'parking_space' => FILTER_SANITIZE_STRING,
            'fencing' => FILTER_SANITIZE_STRING,
            'landscape' => FILTER_SANITIZE_STRING,
            'bathhouse_num' => FILTER_SANITIZE_NUMBER_INT,
            'garage_num' => FILTER_SANITIZE_NUMBER_INT,
            'barn_num' => FILTER_SANITIZE_NUMBER_INT,
            'pool_num' => FILTER_SANITIZE_NUMBER_INT,
            'pavilion_num' => FILTER_SANITIZE_NUMBER_INT,
            'hall_num' => FILTER_SANITIZE_NUMBER_INT,
            'basement_num' => FILTER_SANITIZE_NUMBER_INT,
            'boiler_num' => FILTER_SANITIZE_NUMBER_INT,
            'veranda_num' => FILTER_SANITIZE_NUMBER_INT,
            'dressingroom_num' => FILTER_SANITIZE_NUMBER_INT,
            'house_condition' => FILTER_SANITIZE_STRING,
            'number_of_inputs' => FILTER_SANITIZE_NUMBER_INT,
            'hearth_num' => FILTER_SANITIZE_NUMBER_INT,
            'rooms_for_sale' => FILTER_SANITIZE_STRING,
            'room_location' => FILTER_SANITIZE_STRING,
            'number_of_minutes_parking' => FILTER_SANITIZE_NUMBER_INT,
            'room_condition' => FILTER_SANITIZE_STRING,
            'flora' => FILTER_SANITIZE_STRING
        );

        $new_form_data = filter_input_array(INPUT_POST, $args);

        //Присваивание 0 для не существующих чекбоксов и значения int для существующих
        foreach ($new_form_data as $key => $value) {
            if (preg_match('/_num/', $key) == 1) {
                $check = strstr($key, '_num', true) . '_checkbox';

                if (empty($_POST[$check])) {
                    $new_form_data[$key] = NULL;
                }
            }
        }

        //Переписывание параметров в 'Другое' если есть _other
        foreach ($new_form_data as $key => $value) {
            $oth = $key . '_other';
            if (isset($new_form_data[$oth])) {
                if ($value == 'Другое') {
                    $new_form_data[$key] = $new_form_data[$oth];
                }
                unset($new_form_data[$oth]);
            }
        }
        //Удаление несуществующих параметров
        //С присваиванием значения 0 для чекбоксов _available, нужно для Update       
        foreach ($new_form_data as $key => $value) {
            if (!empty($value)) {
                $form_data[$key] = $new_form_data[$key];
            } elseif (preg_match('/_available/', $key) == 1 && isset($_POST[$key])) {
                $form_data[$key] = '0';
            }
        }

        // записываем строку с адресами картинок для добавления в БД
        if (!empty($preview_img)) {
            $form_data['preview_img'] = $preview_img;
        }

        return $form_data;
    }

    public function makeNewsInsert($form_data) {
        // новый ключ id для новости
        //    $newId = $this->db->lastInsertId('name_id_news_seq');
        // !!!! тк. пока не занаю как делать выборку из нескольких таблиц 
        // имя таблицы в id
        $name_tb = substr($form_data['news_object'], 0, 1) . substr($form_data['news_object'], 4, 1);
        if ($name_tb == 'b') {
            $name_tb = 'ba';
        }
        // !!!!
        $this->id = 'id' . $name_tb . md5(microtime());
        // определение таблицы записи
        $table_name = 'news_' . $form_data['news_object'];

        // формирование запроса для соответствующих таблиц
        $sql = 'INSERT INTO ' . $table_name . '(id_news';
        foreach ($form_data as $key => $val) {
            if ($key != 'news_object') {
                $sql = $sql . ', ' . $key;
            }
        }

        $sql = $sql . ') VALUES (:id_news';
        foreach ($form_data as $key => $val) {
            if ($key != 'news_object') {
                $sql = $sql . ', :' . $key;
            }
        }

        $sql = $sql . ')';

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':id_news', $this->id);

        foreach ($form_data as $key => $val) {
            if ($key != 'news_object') {
                $p = ':' . $key;
                $stmt->bindParam($p, $form_data[$key]);
            }
        }

        return $stmt->execute();
    }

    public function makeNewsUpdate($news_to_edit_id, $form_data) {

        $sql = "UPDATE news_" . $form_data['news_object'] . " SET ";
        foreach ($form_data as $key => $val) {
            if ($key != 'news_object') {
                $sql = $sql . $key . ' = :' . $key . ', ';
            }
        }
        $sql = substr($sql, 0, -2);

        $sql = $sql . " WHERE id_news = :news_to_edit_id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':news_to_edit_id', $news_to_edit_id);

        foreach ($form_data as $key => $val) {
            if ($key != 'news_object') {
                $p = ':' . $key;
                $stmt->bindParam($p, $form_data[$key]);
            }
        }
        return $stmt->execute();
    }

    public function makeNewsDelete($id) {
        global $news_message, $news_error;
        $stmt = $this->db->prepare("DELETE FROM news"
                . " WHERE id_news = :id");
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Добавление сообщения
            array_push($news_message, 'Удалена новость c id = ' . $id);
        } else {
            array_push($news_error, 'Новость с id = ' . $id . ' не удалось удалить');
        };
        return;
    }

    public function makeNewsStatus() {
        global $news_message, $news_error;
        foreach ($_SESSION['stat_arr'] as $s_id => $s_stat) {
            $j = 'status_' . $s_id;
            if ($_POST[$j] != $s_stat) {
                //Удаление новости
                if ($_POST[$j] == 3) {
                    $this->makeNewsDelete($s_id);
                } else {

                    $stmt = $this->db->prepare("UPDATE news SET"
                            . " status = :status"
                            . " WHERE id_news = :id");
                    $stmt->bindParam(':id', $s_id);
                    $stmt->bindParam(':status', $_POST[$j], PDO::PARAM_INT);
                    if ($stmt->execute()) {
                        // Добавление сообщения
                        array_push($news_message, 'Изменён статус у новости c id = ' . $s_id);
                    } else {
                        array_push($news_error, 'Статус у новости с id = ' . $s_id . ' не удалось изменить');
                    }
                }
            }
        }

        return;
    }

    // Возвращает строку имен (через '|') больших картинок 
    //(имя эскиза s_имя больш)
    public function saveNewsPictures() {
        global $news_error;

        $blacklistOfFile = array(".php", ".phtml", ".php3", ".php4"); // Запрещенный формат файлов
        $imgMaxSize = 3050000; // Максимальный размер картинок в байтах
        $return_image_arr = []; //подготовительный массив для сохранения порядка следования
        $return_image_names = ''; // Возвращаемая строка имен картинок 

        if (!empty($_FILES)) {
            //Получаем имена полей "image_name_?" ввода картинок переданных POST
            $image_name_keys = preg_grep("/^image_name_/", array_keys($_FILES));

            //отсееваем и записываем уже существующие картинки
            foreach ($image_name_keys as $k => $v) {
                if (preg_match("/_news_/", $v)) {
                    // определяеи номер
                    $i = (int) substr($v, 11, 2);
                    // определяем имя файла
                    $f_name = strstr($v, 'news_');
                    //переделываем 4 знак с конца в точку
                    $f_name = substr_replace($f_name, '.', -4, 1);
                    // добавляем в подготовительный массив под номером
                    $return_image_arr[$i] = $f_name;
                    //удаляем ссылку на поле ввода, что бы исключить обработку
                    unset($image_name_keys[$k]);
                }
            }


            foreach ($image_name_keys as $image_name_key) {

                //Генерируем случайное имя картинки
                $name_rand = md5(time()) . rand(10, 99); // Базовая часть
                $name_big = 'news_' . $name_rand; // Новое имя для большой картинки
                $name_small = 's_' . $name_big; // Новое имя для маленькой картинки
                // Загрузка картинки в директоритю и получение ссылки на нее
                // Проверяем тип файла
                // Допустимый формат файлов .jpeg .png .gif
                if ($_FILES[$image_name_key]['type'] == 'image/jpeg') {
                    $type = '.jpg';
                } elseif ($_FILES[$image_name_key]['type'] == 'image/png') {
                    $type = '.png';
                } elseif ($_FILES[$image_name_key]['type'] == 'image/gif') {
                    $type = '.gif';
                } else {
                    array_push($news_error, 'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. Можно загружать только картинки с расширением jpeg, png, gif.');
                    continue;
                }
                // Расширения новых имен:
                $name_big = $name_big . $type;
                $name_small = $name_small . $type;

                // Проверка на недопустимые форматы
                foreach ($blacklistOfFile as $item) {
                    if (preg_match("/$item\$/i", $_FILES[$image_name_key]['name'])) {
                        array_push($news_error, 'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. PHP файлы не разрешены для загрузки.');
                        continue;
                    }
                }
                // Проверяем размер файла
                if ($_FILES[$image_name_key]['size'] > $imgMaxSize) {
                    array_push($news_error, 'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. Слишком большой размер файла картинки.');
                    continue;
                }

                //Изменение размеров и запись
                $this->newsPicturesResize($_FILES[$image_name_key], 'big', $name_big);
                $this->newsPicturesResize($_FILES[$image_name_key], 'small', $name_small);

                //Запись в подгот. массив под номером ключа соотв. имени
                // Определяем номер
                $i = (int) substr($image_name_key, 11, 2);

                $return_image_arr[$i] = $name_big;
//                if (empty($return_image_names)) {
//                    $return_image_names = $name_big;
//                } else {
//                    $return_image_names = $return_image_names . '|' . $name_big;
//                }
            }

            // Получаем строку имен файлов из массива
            foreach ($return_image_arr as $value) {
                if (empty($return_image_names)) {
                    $return_image_names = $value;
                } else {
                    $return_image_names = $return_image_names . '|' . $value;
                }
            }
        }

        return $return_image_names;
    }

    //Изменение размеров картинки на эскиз ($type = 'small') и нормальные ($type = 'big') 
    //и сохраниение во временной папке  $tmpPath
    //Запись результата в  $imgPath
    public function newsPicturesResize($file, $type = 'big', $new_name) {
        global $news_error, $tmpPath;

        $imgPath = 'uploads/images/'; // Путь к папке загрузки картинок
        $tmpPath = 'tmp/'; // Путь к папке временных файлов

        $h_max_big_size = 800; //Всота для большой картинки
        $h_max_small_size = 200; //Всота для эскиза
        $quality = 80; // качество изображения (по умолчанию 80%)
        // Создание исходного изображения на основе исходного файла
        if ($file['type'] == 'image/jpeg') {
            $src = imagecreatefromjpeg($file['tmp_name']);
        } elseif ($file['type'] == 'image/png') {
            $src = imagecreatefrompng($file['tmp_name']);
        } elseif ($file['type'] == 'image/gif') {
            $src = imagecreatefromgif($file['tmp_name']);
        } else {
            return false;
        }

        //Определение размеров изображения
        $w_src = imagesx($src);
        $h_src = imagesy($src);

        // В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
        if ($type == 'small') {
            $h_max = $h_max_small_size;
        } else {
            $h_max = $h_max_big_size;
        }
        // Если высота больше заданной
        if ($h_src > $h_max) {
            // Вычисление пропорций
            $ratio = $h_src / $h_max;
            $w_dest = round($w_src / $ratio);
            $h_dest = round($h_src / $ratio);
            // Создаём пустую картинку
            $dest = imagecreatetruecolor($w_dest, $h_dest);
            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
            // Вывод картинки и очистка памяти
            $this->picturesSaveAndClear($file, $dest, $new_name, $quality);
            imagedestroy($dest);
            imagedestroy($src);
        } else {
            // Вывод картинки и очистка памяти
            $this->picturesSaveAndClear($file, $src, $new_name, $quality);
            imagedestroy($src);
        }

        // Загрузка файла и вывод сообщения
        if (!@copy($tmpPath . $new_name, $imgPath . $new_name)) {
            array_push($news_error, 'Произошла ошибка при загрузке картинки');
        }
        //Удаляем временный файл
        //unlink($tmpPath.$new_name);
    }

    // Вывод картинки во временную директорию
    public function picturesSaveAndClear($file, $dest, $name, $quality) {
        global $tmpPath;

        if ($file['type'] == 'image/jpeg')
            imagejpeg($dest, $tmpPath . $name, $quality);
        elseif ($file['type'] == 'image/png')
            imagepng($dest, $tmpPath . $name, $quality);
        elseif ($file['type'] == 'image/gif')
            imagegif($dest, $tmpPath . $name, $quality);
        else
            return false;
    }

}
