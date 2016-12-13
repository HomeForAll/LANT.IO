<?php


class NewsModel extends Model
{
    public function __construct()
    {
        $this->db = new DataBase;
    }

    public function ajaxHandler()
    {
        
    }

    // Проверка строки на вредоносные элементы
    public function checkingString($str)
    {
        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str);
        return $str;
    }

    public function getNamber_of_all_rows($category_list = [])
    {

// Составление запроса
        $sql = "SELECT COUNT(*) FROM news_base";
// Условия поиска по категориям
        if (!empty($category_list)) {
            $sql = $sql.' WHERE ';
            foreach ($category_list as $value) {
                $sql = $sql.' category = '.$value.' OR ';
            }
            // удаление последнего OR
            $sql = substr($sql, 0, -4);
        }


        $stmt   = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    public function getNewsById($id)
    {

// Считываем базовую информацию по id
        $sql = "SELECT *"
            ." FROM news_base"
            ." WHERE id_news = :id";
        $stmt     = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data     = $stmt->fetch(PDO::FETCH_ASSOC);

// разбиваем имена и передаем их в массиве
        $data['preview_img'] = explode('|', $data['preview_img']);

        return $data;
    }

    public function prepareNewsView($news)
    {

        //новый массив данных новости
        $new_data = [];
        //Удаление несуществующих параметров
        // и Перевод чисел в слова
        foreach ($news as $key => $val) {
            if (!empty($val)) {
                $new_data[$key] = $news[$key];
                if(is_int($new_data[$key])) {
                  $new_data[$key] = $this-> translateIndex($new_data[$key], $key);
                }
                if(is_bool($new_data[$key])){
                    if ($new_data[$key]) {
                       $new_data[$key] = 'Да';
                    } else {
                       $new_data[$key] = 'Нет';
                    }
                }
            }
        }



        //!!! Заголовки !!!
        static $header = array(
            'title' => 'Название',
            'date' => 'Дата',
            'category' => 'Категория',
            'plan_available' => 'План квартиры',
            'three_d_available' => '3D проект',
            'video_available' => 'Видео',
            'photo_available' => 'Фото',

            'concierge' => 'Консьерж',
            'security' => 'Охрана',
            'intercom' => 'Домофон',
            'cctv' => 'Видеонаблюдение',

            'country' => 'Страна',
            'area' => 'Область',
            'city' => 'Город (посёлок)',
            'region' => 'Район',
            'street' => 'Улица',
            'house_number' => 'Номер дома',
            'apartment_number' => 'Номер квартиры',

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
            'rooms_for_sale' => 'Комнат в продажу (шт)',
            'room_location' => 'Нахождение комнаты',
            'number_of_minutes_parking' => 'кол-во минут',
            'room_condition' => 'Состояние комнаты',
            'flora' => 'Флора'
        );

        //Присваивание заголовков
        foreach ($new_data as $key => $val) {
            if (!empty($header[$key])) {
                $new_data[$key.'_h'] = $header[$key];
            }
        }

        return $new_data;
    }

    // Вход: страница новостей
    // Возвращает: выборку всех данных новостей в виде массива
    public function getNewsList($page = 0)
    {

        $data = []; //выходные данные
        // Определение номера страницы выводимых новостей
        if (empty($page)) {
            // по умолчанию первая страница
            $data['page'] = 1;
        } else {
            $data['page'] = (int) $page[0];
        }

        // Количество выводимых новостей
        $number_of_news              = (int) $_SESSION['news_list']['number_of_news'];
        // Таблица новостей
        if (!empty($_SESSION['news_list']['category'])){
        foreach ($_SESSION['news_list']['category'] as $key => $value) {
         $data['news_table_category'][(int)$key]  = (int)$value;
        }
        }
        // Общее кол-во новостей
        $data['namber_of_all_rows']  = (int) $_SESSION['news_list']['namber_of_all_rows'];

        // Количество станиц и диапазон = $data['firstnews'],$data['lastnews']
        $total_pages = ceil($data['namber_of_all_rows'] / $number_of_news);

        if ($data['page'] > $total_pages) {
            $data['page'] = 1;
        }

        $data['firstnews'] = $data['page'] * $number_of_news - $number_of_news + 1;

        if ($data['page'] * $number_of_news > $data['namber_of_all_rows']) {
            $data['lastnews'] = $data['page'] * $number_of_news - ($data['page']
                * $number_of_news - $data['namber_of_all_rows']);
        } else {
            $data['lastnews'] = $data['page'] * $number_of_news;
        }

        // Запрос БД      
        $from_page = $data['firstnews'] - 1;

        $sql = "SELECT id_news, date::date, title, short_content, content, author_name, preview_img, status, category, tags "
            ."FROM news_base";
        if (!empty($data['news_table_category'])){
            $sql = $sql.' WHERE';
            foreach ($data['news_table_category'] as $value) {
            $sql = $sql.' category = '.$value.' OR ';
            }
             // удаление последнего OR
            $sql = substr($sql, 0, -4);
        }

        $sql = $sql." ORDER BY date DESC"
            ." LIMIT :number_of_news"
            ." OFFSET :from_page";

        $stmt         = $this->db->prepare($sql);
        $stmt->bindParam(':number_of_news', $number_of_news);
        $stmt->bindParam(':from_page', $from_page);
        $stmt->execute();
        $data['news'] = $stmt->fetchAll();
        //Строку файлов картинок преобразуем в массив $data['news'][number]['preview_img'][]
        $data['news'] = $this->explodePreviewImg($data['news']);
        return $data;
    }

    // Определяет и записывает в SESSION при $_POST['watch_news_list']
    // или выставляет по умолчанию
    // общее кол-во новостей, кол-во нов. на странице, категории, сортировка
    public function setSessionForNewsList()
    {
                    // По умолчанию
            $category_list = [];
            $sort           = 'data';
            $sort_dir       = 'DESC';
            $number_of_news = 10;

        if (!empty($_POST['watch_news_list'])) {
            // Если нажата кнопка выбора режима просмотра
            $number_of_news = (int) $_POST['number_of_news'];

            if(!empty($_POST['news_table_category']) && is_array($_POST['news_table_category'])){
                foreach ($_POST['news_table_category'] as $k => $v){
                    $category_list[$k] = (int)$v;
                }
            }
        
        }
        // общее кол-во новостей
        $namber_of_all_rows = $this->getNamber_of_all_rows($category_list);

        // Запись в SESSION
        $_SESSION['news_list']['category']           = $category_list;
        $_SESSION['news_list']['sort']               = $sort;
        $_SESSION['news_list']['sort_dir']           = $sort_dir;
        $_SESSION['news_list']['number_of_news']     = $number_of_news;
        $_SESSION['news_list']['namber_of_all_rows'] = $namber_of_all_rows;
    }

    public function explodePreviewImg($data_news)
    {

        foreach ($data_news as $k => $news_array) {
            $data_news[$k]['preview_img'] = explode('|',
                $news_array['preview_img']);
        }
        return $data_news;
    }

//Получает список новостей из заданной табицы($table) или из всех таблиц новостей(по умолчанию)
// отсортированный по дате    
    public function getNewsListForEditor()
    {
        $sql = 'SELECT id_news, date::date, title, author_name, status, category, tags '
            .'FROM news_base ORDER BY date DESC';

        $stmt   = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        // преобразуем категории в слова
        foreach ($result as &$news) {
        $news['category'] = $this->translateIndex($news['category'], 'category');
        }
        return $result;
    }

    public function setSessionForEditor($news_to_edit)
    {
        $arr = [];
        foreach ($news_to_edit as $key => $value) {
            //Запись всех checkbox со значениями, для перезаписи их при Update
            if (preg_match('/_num/', $key) && !empty($value)) {
                array_push($arr, $key);
            }
        }
        $_SESSION['existing_num'] = $arr;
        //Запись имен картинок в базе, для перезаписи картинок при Update
        $_SESSION['preview_img']  = $news_to_edit["preview_img"];
    }

    public function getFormData($preview_img)
    {

        //Удаление пробелов и переводов строк в начале и в конце строк 
        function trim_value(&$value)
        {
            $value = trim($value);
        }
        array_filter($_POST, 'trim_value');

        static $args = array(
            'title' => FILTER_SANITIZE_STRING,
            'author_name' => FILTER_SANITIZE_STRING,
            'short_content' => FILTER_SANITIZE_STRING,
            'content' => FILTER_SANITIZE_STRING,
            'status' => array(
                'filter' => FILTER_VALIDATE_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
                'flags' => FILTER_NULL_ON_FAILURE,
            ),
            'category' => FILTER_VALIDATE_INT,
            'tags' => FILTER_SANITIZE_STRING,
            'price' => array(
                'filter' => FILTER_VALIDATE_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
                'flags' => FILTER_NULL_ON_FAILURE,
                'options' => array('min_range' => 0)
            ),

            'bargain_available' => FILTER_VALIDATE_BOOLEAN,
            'type_of_rent' => FILTER_SANITIZE_NUMBER_INT,
            'region' => FILTER_SANITIZE_STRING,
            'district' => FILTER_SANITIZE_STRING,
            'metro_station' => FILTER_SANITIZE_STRING,
            'distance_from_metro' => array(
                'filter' => FILTER_SANITIZE_NUMBER_INT,
                'flags' => FILTER_REQUIRE_SCALAR,
                'flags' => FILTER_NULL_ON_FAILURE,
            ),

            'country' => FILTER_SANITIZE_STRING,
            'area' => FILTER_SANITIZE_STRING,
            'city' => FILTER_SANITIZE_STRING,
            'region' => FILTER_SANITIZE_STRING,
            'street' => FILTER_SANITIZE_STRING,
            'house_number' => FILTER_SANITIZE_STRING,
            'apartment_number' => FILTER_SANITIZE_STRING,

            'home_series' => FILTER_SANITIZE_STRING,
            'tszh' => FILTER_SANITIZE_NUMBER_INT,
            'tszh_other' => FILTER_SANITIZE_STRING,
            'number_of_rooms' => FILTER_SANITIZE_NUMBER_INT,
            'space' => FILTER_SANITIZE_NUMBER_INT,
            'floor' => FILTER_SANITIZE_NUMBER_INT,
            'equipment' => FILTER_SANITIZE_NUMBER_INT,
            'ceiling_height' => FILTER_SANITIZE_NUMBER_INT,
            'type_of_house' => FILTER_SANITIZE_NUMBER_INT,
            'type_of_house_other' => FILTER_SANITIZE_NUMBER_INT,
            'number_of_floors' => FILTER_SANITIZE_NUMBER_INT,
            'elevator_available' => FILTER_VALIDATE_BOOLEAN,
            'stairs_available' => FILTER_VALIDATE_BOOLEAN,
            'garbage_available' => FILTER_VALIDATE_BOOLEAN,
            'concierge' => FILTER_VALIDATE_BOOLEAN,
            'security' => FILTER_VALIDATE_BOOLEAN,
            'intercom' => FILTER_VALIDATE_BOOLEAN,
            'cctv' => FILTER_VALIDATE_BOOLEAN,
            'parking_type' => FILTER_SANITIZE_NUMBER_INT,
            'number_of_minutes_parkin' => FILTER_SANITIZE_NUMBER_INT,
            'bedroom_num' => FILTER_SANITIZE_NUMBER_INT,
            'kitchen_num' => FILTER_SANITIZE_NUMBER_INT,
            'living_room_num' => FILTER_SANITIZE_NUMBER_INT,
            'hallway_num' => FILTER_SANITIZE_NUMBER_INT,
            'play_room_num' => FILTER_SANITIZE_NUMBER_INT,
            'cabinet_num' => FILTER_SANITIZE_NUMBER_INT,
            'dining_room_num' => FILTER_SANITIZE_NUMBER_INT,
            'bathroom_num' => FILTER_SANITIZE_NUMBER_INT,
            'flat_condition' => FILTER_SANITIZE_NUMBER_INT,
            'toilet' => FILTER_SANITIZE_NUMBER_INT,
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
            'balcony' => FILTER_SANITIZE_NUMBER_INT,
            'devices_available' => FILTER_VALIDATE_BOOLEAN,
            'electronics_available' => FILTER_VALIDATE_BOOLEAN,
            'furniture_available' => FILTER_VALIDATE_BOOLEAN,
            'sanitary_available' => FILTER_VALIDATE_BOOLEAN,
            'heating_available' => FILTER_VALIDATE_BOOLEAN,
            'gas_available' => FILTER_VALIDATE_BOOLEAN,
            'electricity_available' => FILTER_VALIDATE_BOOLEAN,
            'plumbing_available' => FILTER_VALIDATE_BOOLEAN,
            'seasonality' => FILTER_SANITIZE_NUMBER_INT,
            'distance_from_city' => FILTER_SANITIZE_NUMBER_INT,
            'style_of_house' => FILTER_SANITIZE_NUMBER_INT,
            'material_lining' => FILTER_SANITIZE_NUMBER_INT,
            'parking_space' => FILTER_SANITIZE_NUMBER_INT,
            'fencing' => FILTER_SANITIZE_NUMBER_INT,
            'landscape' => FILTER_SANITIZE_NUMBER_INT,
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
            'house_condition' => FILTER_SANITIZE_NUMBER_INT,
            'number_of_inputs' => FILTER_SANITIZE_NUMBER_INT,
            'hearth_num' => FILTER_SANITIZE_NUMBER_INT,
            'rooms_for_sale' => FILTER_SANITIZE_NUMBER_INT,
            'room_location' => FILTER_SANITIZE_NUMBER_INT,
            'number_of_minutes_parking' => FILTER_SANITIZE_NUMBER_INT,
            'room_condition' => FILTER_SANITIZE_NUMBER_INT,
            'flora' => FILTER_SANITIZE_NUMBER_INT
        );

        $new_form_data = filter_input_array(INPUT_POST, $args);

        //Переписывание параметров в 'Другое' если есть _other
        foreach ($new_form_data as $key => $value) {
            $oth = $key.'_other';

            if (isset($new_form_data[$oth])) {
                if ($value == 'Другое') {
                    $new_form_data[$key] = $new_form_data[$oth];
                }
                unset($new_form_data[$oth]);
            }
        }


        //Удаление несуществующих параметров
        //С присваиванием значения FALSE = 'нет' для чекбоксов _available, нужно для Update

        foreach ($new_form_data as $key => $value) {
            if (!empty($value)) {
                $form_data[$key] = $new_form_data[$key];
            } elseif (preg_match('/_available/', $key) && isset($_POST[$key])) {
                $form_data[$key] = 'false';
            }
        }

        //Присваивание NULL для неотмеченных checkbox или непроставленных для них значений, нужно для Update
        if (!empty($_SESSION['existing_num'])) {
            foreach ($_SESSION['existing_num'] as $key_num) {
                $check = strstr($key_num, '_num', true).'_checkbox';
                if (empty($_POST[$check]) || empty($_POST[$key_num])) {
                    $form_data[$key_num] = NULL;
                }
            }
        }

        // записываем строку с адресами картинок для добавления в БД в конец массива (т.к. это записывается в базовую таблицу)
        if (!empty($preview_img)) {
            $form_data['preview_img'] = $preview_img;
            $form_data['photo_available'] = 'true';
        } else {
            $form_data['preview_img'] = NULL;
            $form_data['photo_available'] = 'false';
        }

        return $form_data;
    }

    
    public function makeNewsInsert($form_data)
    {
        //Запись информации в основную таблицу
        $sql = "INSERT INTO news_base (";
        foreach ($form_data as $key => $val) {
            $sql = $sql.$key.', ';
        }
        // удаляем последнюю запятую
        $sql = substr($sql, 0, -2);
        $sql = $sql.') VALUES (';
        foreach ($form_data as $key => $val) {
            $sql = $sql.':'.$key.', ';
        }
        $sql  = substr($sql, 0, -2);
        $sql  = $sql.')';

        $stmt = $this->db->prepare($sql);

        //bindParam
        foreach ($form_data as $key => $val) {
            $p = ':'.$key;
            $stmt->bindParam($p, $form_data[$key]);

        }
        return ($stmt->execute());
    }

    public function makeNewsUpdate($news_to_edit_id, $form_data)
    {

        $sql = "UPDATE news_base SET ";
        foreach ($form_data as $key => $val) {
            $sql = $sql.$key.' = :'.$key.', ';
        }
        $sql = substr($sql, 0, -2);

        $sql  = $sql." WHERE id_news = :news_to_edit_id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':news_to_edit_id', $news_to_edit_id);

        foreach ($form_data as $key => $val) {
            $p = ':'.$key;
            $stmt->bindParam($p, $form_data[$key]);
        }
        return ($stmt->execute());
    }

    public function makeNewsDelete($id)
    {
        global $news_message, $news_error;
        //Удаление загруженых картинок новости
        //Получаем имена файлов на удаление
        $sql                 = "SELECT preview_img FROM news_base WHERE id_news = :id";
        $stmt                = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data                = $stmt->fetch(PDO::FETCH_ASSOC);
        // разбиваем имена в массив
        $data['preview_img'] = explode('|', $data['preview_img']);
        foreach ($data['preview_img'] as $key => $value) {
            unlink('uploads/images/'.$value);
            unlink('uploads/images/s_'.$value);
        }


        $sql  = "DELETE FROM news_base WHERE id_news = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Добавление сообщения
            array_push($news_message, 'Удалена новость c id = '.$id);
        } else {
            array_push($news_error, 'Новость с id = '.$id.' не удалось удалить');
        };
        return;
    }

    public function makeNewsStatus()
    {
        global $news_message, $news_error;
        foreach ($_SESSION['stat_arr'] as $s_id => $s_stat) {
            $j = 'status_'.$s_id;
            if ($_POST[$j] != $s_stat) {
                //Удаление новости
                if ($_POST[$j] == 3) {
                    $this->makeNewsDelete($s_id);
                } else {
                    $sql  = "UPDATE ".$table." SET status = :status  WHERE id_news = :id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':id', $s_id);
                    $stmt->bindParam(':status', $_POST[$j], PDO::PARAM_INT);
                    if ($stmt->execute()) {
                        // Добавление сообщения
                        array_push($news_message,
                            'Изменён статус у новости c id = '.$s_id);
                    } else {
                        array_push($news_error,
                            'Статус у новости с id = '.$s_id.' не удалось изменить');
                    }
                }
            }
        }

        return;
    }

    // Возвращает строку имен (через '|') больших картинок 
    //(имя эскиза s_имя больш)
    public function saveNewsPictures()
    {
        global $news_error;

        $blacklistOfFile    = array(".php", ".phtml", ".php3", ".php4"); // Запрещенный формат файлов
        $imgMaxSize         = 3050000; // Максимальный размер картинок в байтах
        $return_image_arr   = []; //подготовительный массив для сохранения порядка следования
        $return_image_names = ''; // Возвращаемая строка имен картинок 

        if (!empty($_FILES)) {
            //Получаем имена полей "image_name_?" ввода картинок переданных POST
            $image_name_keys = preg_grep("/^image_name_/", array_keys($_FILES));

            //отсееваем и записываем имена уже существующих картинок
            foreach ($image_name_keys as $k => $v) {
                if (preg_match("/_saved_/", $v)) {
                    // определяеи номер (отнимаем 1 т.к. для массива)
                    $i                    = (int) substr($v, 11, 2) - 1;
                    // определяем имя файла
//                 $f_name =strstr($v, 'news_') ;
                    //переделываем 4 знак с конца в точку
//                 $f_name = substr_replace($f_name, '.', -4, 1);
                    // добавляем в подготовительный массив под номером
                    $return_image_arr[$i] = $_SESSION['preview_img'][$i];

                    //удаляем ссылку на поле ввода, что бы исключить обработку
                    unset($image_name_keys[$k]);
                }
            }

            foreach ($image_name_keys as $image_name_key) {

                //Генерируем случайное имя картинки
                $name_rand  = md5(time()).rand(10, 99); // Базовая часть
                $name_big   = 'news_'.$name_rand; // Новое имя для большой картинки
                $name_small = 's_'.$name_big; // Новое имя для маленькой картинки
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
                    array_push($news_error,
                        'Файл:"'.$_FILES[$image_name_key]['name'].'" не загружен. Можно загружать только картинки с расширением jpeg, png, gif.');
                    continue;
                }
                // Расширения новых имен:
                $name_big   = $name_big.$type;
                $name_small = $name_small.$type;

                // Проверка на недопустимые форматы
                foreach ($blacklistOfFile as $item) {
                    if (preg_match("/$item\$/i",
                            $_FILES[$image_name_key]['name'])) {
                        array_push($news_error,
                            'Файл:"'.$_FILES[$image_name_key]['name'].'" не загружен. PHP файлы не разрешены для загрузки.');
                        continue;
                    }
                }
                // Проверяем размер файла
                if ($_FILES[$image_name_key]['size'] > $imgMaxSize) {
                    array_push($news_error,
                        'Файл:"'.$_FILES[$image_name_key]['name'].'" не загружен. Слишком большой размер файла картинки.');
                    continue;
                }

                //Изменение размеров и запись
                $this->newsPicturesResize($_FILES[$image_name_key], 'big',
                    $name_big);
                $this->newsPicturesResize($_FILES[$image_name_key], 'small',
                    $name_small);

                //Запись в подгот. массив под номером ключа соотв. имени
                // Определяем номер (отнимаем 1 т.к. для массива)
                $i = (int) substr($image_name_key, 11, 2) - 1;

                $return_image_arr[$i] = $name_big;
//                if (empty($return_image_names)) {
//                    $return_image_names = $name_big;
//                } else {
//                    $return_image_names = $return_image_names . '|' . $name_big;
//                }
            }

            // Получаем строку имен файлов из массива
            sort($return_image_arr);
            foreach ($return_image_arr as $value) {
                if (empty($return_image_names)) {
                    $return_image_names = $value;
                } else {
                    $return_image_names = $return_image_names.'|'.$value;
                }
            }
        }

// Удаление всех картинок находящихся в БД, но не переданных на апдейт
        if (!empty($_SESSION['preview_img'][0])) {
        //Расхождение массива $_SESSION['preview_img'] от $return_image_arr
            $img_arr_for_delete = array_diff($_SESSION['preview_img'], $return_image_arr);

                foreach ($img_arr_for_delete as $value) {
                    unlink('uploads/images/'.$value);
                    unlink('uploads/images/s_'.$value);
                }
            }

        return $return_image_names;
    }

    //Изменение размеров картинки на эскиз ($type = 'small') и нормальные ($type = 'big') 
    //и сохраниение во временной папке  $tmpPath
    //Запись результата в  $imgPath
    public function newsPicturesResize($file, $type = 'big', $new_name)
    {
        global $news_error, $tmpPath;

        $imgPath = 'uploads/images/'; // Путь к папке загрузки картинок
        $tmpPath = 'tmp/'; // Путь к папке временных файлов

        $h_max_big_size   = 800; //Всота для большой картинки
        $h_max_small_size = 200; //Всота для эскиза
        $quality          = 80; // качество изображения (по умолчанию 80%)
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
            $ratio  = $h_src / $h_max;
            $w_dest = round($w_src / $ratio);
            $h_dest = round($h_src / $ratio);
            // Создаём пустую картинку
            $dest   = imagecreatetruecolor($w_dest, $h_dest);
            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest,
                $w_src, $h_src);
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
        if (!@copy($tmpPath.$new_name, $imgPath.$new_name)) {
            array_push($news_error, 'Произошла ошибка при загрузке картинки');
        }
        //Удаляем временный файл
        unlink($tmpPath.$new_name);
    }

    // Вывод картинки во временную директорию
    public function picturesSaveAndClear($file, $dest, $name, $quality)
    {
        global $tmpPath;

        if ($file['type'] == 'image/jpeg')
                imagejpeg($dest, $tmpPath.$name, $quality);
        elseif ($file['type'] == 'image/png')
                imagepng($dest, $tmpPath.$name, $quality);
        elseif ($file['type'] == 'image/gif')
                imagegif($dest, $tmpPath.$name, $quality);
        else return false;
    }

    //Принимает индекс и имя переменной
    //Возвращает значение соответствующее индексу
    public function translateIndex($index = 0, $name = '')
    {

    // Проверочный массив
        
    static $test_array = array(
                'category_eng' => array(
                    11 => 'saleroom',
                    12 => 'saleapart',
                    13 => 'salehouse',
                    14 => 'saleland',
                    21 => 'rentroom',
                    22 => 'rentapart',
                    23 => 'renthouse',
                    24 => 'rentland'
                    ),
                'category' => array(
                    1  => 'Без категории',
                    11 => 'Продажа комнаты',
                    12 => 'Продажа квартиры',
                    13 => 'Продажа дома',
                    14 => 'Продажа участка',
                    21 => 'Аренда комнаты',
                    22 => 'Аренда квартиры',
                    23 => 'Аренда дома',
                    24 => 'Аренда участка'
                    ),
                'type_of_rent' =>array(
                    1 => 'Часовая',
                    2 => 'Посуточная',
                    3 => 'Долгосрочная'
                    ),
                'equipment' =>array(
                    1 => 'Укомплектованная',
                    2 => 'Пустая'
                    ),
                'type_of_house' =>array(
                    1 => 'Блочный',
                    2 => 'Брежневка',
                    3 => 'Индивидуальный',
                    4 => 'Кирпично-монолитный',
                    5 => 'Монолит',
                    6 => 'Панельный',
                    7 => 'Сталинка',
                    8 => 'Хрущевка',
                    9 => 'Другое',
                    10 => 'Частный',
                    11 => 'Многоквартирный',
                    12 => 'Таунхаус',
                    13 => 'Усадьба'
                    ),
                'style_of_house' =>array(
                    1 => 'Классический',
                    2 => 'Русский',
                    3 => 'Русская усадьба',
                    4 => 'Замковый',
                    5 => 'Ренессанс',
                    6 => 'Готический',
                    7 => 'Барокко',
                    8 => 'Рококо',
                    9 => 'Классицизм',
                    10 => 'Ампир',
                    11 => 'Эклектика',
                    12 => 'Модерн',
                    13 => 'Органическая архитектура',
                    14 => 'Конструктивизм',
                    15 => 'Ар-деко',
                    16 => 'Минимализм',
                    17 => 'High tech',
                    18 => 'Финский минимализм',
                    19 => 'Шале',
                    20 => 'Фахверк',
                    21 => 'Скандинавский',
                    22 => 'Восточный',
                    23 => 'Американский кантри',
                    24 => 'Шато',
                    25 => 'Адирондак',
                    26 => 'Стильпрерий'
                    ),
                'material_lining' =>array(
                    1 => 'Кирпич',
                    2 => 'Камень',
                    3 => 'Фасадная плитка',
                    4 => 'Фасадная панель',
                    5 => 'Деревянная панель',
                    6 => 'Штукатурка'
                    ),
                'parking_space' =>array(
                    1 => 'Парковочное место',
                    2 => 'Закрытый гараж',
                    3 => 'За пределами участка'
                    ),
                'landscape' =>array(
                    1 => 'Ровный',
                    2 => 'Не ровный'
                    ),
                'security' =>array(
                    1 => 'Консьерж',
                    2 => 'Охрана',
                    3 => 'Домофон',
                    4 => 'Видеонаблюдение'
                    ),
                'toilet' =>array(
                    1 => 'Совмещенный',
                    2 => 'Раздельный'
                    ),
                'seasonality' =>array(
                    1 => 'Круглый год',
                    2 => 'Весна-лето'
                    ),
                'flora' =>array(
                    1 => 'Лесные деревья',
                    2 => 'Садовые растения'
                    ),
                'rooms_for_sale' =>array(
                    1 => '1',
                    2 => '2',
                    3 => '3+'
                    ),
                'room_location' =>array(
                    1 => 'Квартира',
                    2 => 'Общежитие',
                    3 => 'Частный дом'
                    ),

                'tszh' => array(
                    1 => 'Нет',
                    2 => 'Кооператив',
                    3 => 'Кондоминиум',
                    4 => 'Частный дом',
                    5 => 'Другое'
                    ),
                'parking_type' => array(
                    1 => 'Нет',
                    2 => 'Подземная',
                    3 => 'Обозначенная, во дворе',
                    4 => 'Не обозначенная, во дворе',
                    5 => 'Платная(неподалёку)'
                    ),
                'fencing' => array(
                    1 => 'Нет',
                    2 => 'Профнастил',
                    3 => 'Забор из дерева',
                    4 => 'Евроштакетник',
                    5 => 'Сетка рабица',
                    6 => 'Монолитный'
                    ),
                'house_condition' => array(
                    1 => 'Отделки нет',
                    2 => 'Стандартная отделка',
                    3 => 'Премиум отделка'
                    ),
                'flat_condition' => array(
                    1 => 'Отделки нет',
                    2 => 'Стандартная отделка',
                    3 => 'Премиум отделка'
                    ),
                'balcony' => array(
                    1 => 'Отсутствует',
                    2 => 'Незастеклённый',
                    3 => 'Лоджия'
                    ),
                'room_condition' => array(
                    1 => 'Отделки нет',
                    2 => 'Стандартная отделка',
                    3 => 'Премиум отделка'
                    )
            );
// Определение значения
        if(!empty($index) && !empty($name)){
            if (isset($test_array[$name][$index])){
            $index = $test_array[$name][$index];
            }
        }
        return $index;
    }







}