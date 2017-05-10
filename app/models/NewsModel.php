<?php


use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

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
        $sql = "SELECT COUNT(*) FROM news_base WHERE status = 1";
// Условия поиска по категориям
        if (!empty($category_list)) {
            $sql = $sql . " AND (";
            foreach ($category_list as $value) {
                $sql = $sql . ' category = ' . $value . ' OR ';
            }
            // удаление последнего OR
            $sql = substr($sql, 0, -4);
            $sql = $sql . ' )';
        }


        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchColumn();
        return $result;
    }

    public function getNewsById($id)
    {

// Считываем базовую информацию по id
        $sql = "SELECT *"
            . " FROM news_base"
            . " WHERE id_news = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

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
                if (is_int($new_data[$key])) {
                    $new_data[$key] = $this->translateIndex($new_data[$key], $key);
                }
                if (is_bool($new_data[$key])) {
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
            'additional_buildings' => 'Дополнительные строения',
            'availability_of_bathroom' => 'Наличие санузлов',
            'availability_of_garbage_chute' => 'Наличие мусоропровода',
            'balcony' => 'Балкон',
            'bargain' => 'Торг',
            'building_type' => 'Тип здания',
            'cadastral_number' => 'Кадастровый номер',
            'ceiling_height' => 'Высота потолков',
            'clarification_of_the_object_type' => 'Уточнение вида объектов',
            'combined' => 'Совмещенный',
            'distance_from_metro' => 'Удаленность от метро',
            'distance_from_mkad_or_metro' => 'Удаленность от МКАД/метро',
            'documents_on_ownership' => 'Документы на право владения',
            'doesnt_matter' => 'Не важно',
            'electricity' => 'Электричество',
            'equipment' => 'Комплектация',
            'fencing' => 'Ограждение',
            'floor' => 'Этаж',
            'foundation' => 'Фундамент',
            'furnish' => 'Отделка',
            'lavatory' => 'Санузел',
            'lease' => 'Срок аренды',
            'lease_contract' => 'Договор аренды',
            'location_on' => 'На участке',
            'material' => 'Материал',
            'metro_station' => 'Станция метро',
            'municipal' => 'Муниципальная',
            'not_residential' => 'Нежилая',
            'number_of_floors' => 'Количество этажей',
            'number_of_rooms' => 'Количество комнат',
            'object_located' => 'Объект размещен',
            'paid' => 'Платная ',
            'parking' => 'Парковка',
            'planning_project' => 'Проект планировки',
            'price' => 'Стоимость',
            'property_documents' => 'Документы на собственность',
            'residential' => 'Жилая',
            'roofing' => 'Кровля',
            'rooms' => 'Комнаты',
            'sanitation' => 'Водопровод и канализация',
            'security' => 'Безопасность',
            'select_area_on_city' => 'Выбрать область',
            'separated' => 'Раздельный',
            'site' => 'Участок',
            'space' => 'Площадь',
            'stairwells_status' => 'Состояние лестничных клеток',
            'the_number_of_kilowatt' => 'Количество киловатт',
            'three_d_project' => '3d проект',
            'total' => 'Общая',
            'type_of_construction' => 'Вид постройки',
            'type_of_house' => 'Тип дома',
            'video' => 'Видео',
            'wall_material' => 'Материал стен',
            'year_of_construction' => 'Год постройки/окончания строительства',
            'time_walk' => 'Время от метро пешком',
            'time_car' => 'Время от метро на транспорте',
            'bathroom_available' => 'Наличие санузла',
            'alcove' => 'Беседка',
            'barn' => 'Сарай',
            'bath' => 'Баня',
            'forest_trees' => 'Лесные деревья',
            'garden_trees' => 'Садовые деревья',
            'guest_house' => 'Гостевой дом',
            'lodge' => 'Сторожка',
            'playground' => 'Детская площадка',
            'river' => 'Река',
            'spring' => 'Родник',
            'swimming_pool' => 'Бассейн',
            'waterfront' => 'Берег водоёма',
            'wine_vault' => 'Винный погреб',
        );


        //Опции !!!
        $options = array(
            '0' => 'Не указано',
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4+',
            '144' => 'c',
            '69' => 'gh',
            '48' => 'z',
            '8' => 'Административное',
            '15' => 'Баня',
            '126' => 'Бассейн',
            '141' => 'Без ремонта',
            '140' => 'Без фундамента',
            '135' => 'Берег водоёма',
            '10' => 'Беседка',
            '18' => 'Бескобетонная черепица',
            '51' => 'Бесплатная',
            '31' => 'Бетон',
            '80' => 'Более года',
            '16' => 'Ванная',
            '131' => 'Вид постройки',
            '25' => 'Видеонаблюдение',
            '139' => 'Винный погреб',
            '137' => 'Водопровод',
            '114' => 'Водопровод и канализация',
            '13' => 'Возможен',
            '101' => 'Возможность проводки',
            '127' => 'Временная',
            '26' => 'Выбрать место на карте',
            '64' => 'Высококачественная отделка',
            '54' => 'Газ',
            '55' => 'Газосиликатные блоки',
            '52' => 'Гаражный комплекс',
            '145' => 'Год',
            '146' => 'Год постройки\окончания строительства',
            '60' => 'Гостевой дом',
            '71' => 'Гостиная',
            '23' => 'Грузовой',
            '147' => 'Да',
            '37' => 'День',
            '142' => 'Дерево',
            '100' => 'Детская',
            '99' => 'Детская площадка',
            '66' => 'Домофон',
            '91' => 'Другое',
            '42' => 'Дуплекс',
            '47' => 'Есть',
            '67' => 'Железо',
            '105' => 'Железобетон',
            '32' => 'Железобетонные панели',
            '108' => 'Жилое',
            '136' => 'Заболоченный',
            '59' => 'Земли под размещение промышленных и коммерческих объектов',
            '122' => 'Камень',
            '19' => 'Кирпич',
            '56' => 'Клееный брус',
            '143' => 'Кованая ограда',
            '87' => 'Кол-во кВт',
            '86' => 'Количество',
            '128' => 'Количество киловат',
            '111' => 'Комнаты',
            '30' => 'Консьерж',
            '35' => 'Коттедж',
            '68' => 'Кухня',
            '24' => 'Лафет',
            '109' => 'Ленточный',
            '50' => 'Лесные деревья',
            '74' => 'Максимум',
            '34' => 'Медь',
            '79' => 'Месяц',
            '75' => 'Металлические прутья',
            '76' => 'Металлочерепица',
            '77' => 'Минимум',
            '81' => 'Многоуровневый паркинг',
            '78' => 'Монолит',
            '120' => 'Монолитная плита',
            '82' => 'Муниципальная',
            '89' => 'На склоне',
            '12' => 'Наличие санузлов',
            '41' => 'Не важно',
            '85' => 'Невозможен',
            '138' => 'Неделя',
            '33' => 'Незавершенное строительство',
            '65' => 'Незавершенный ремонт',
            '133' => 'Неровный',
            '84' => 'Нет',
            '83' => 'Новостройка',
            '134' => 'Обычная отделка',
            '103' => 'Овраг',
            '36' => 'Округ',
            '88' => 'Ондулин',
            '90' => 'Опен спэйс',
            '39' => 'Описание',
            '63' => 'Отопление',
            '5' => 'Отсутствует',
            '115' => 'Охрана',
            '112' => 'Оцилиндрованное бревно',
            '95' => 'Пассажирский',
            '96' => 'Пеноблок',
            '113' => 'Пескобетонная черепица',
            '97' => 'Планируется',
            '98' => 'Пластик',
            '94' => 'Платная',
            '132' => 'Подземная парковка',
            '61' => 'Полгода',
            '7' => 'Придомовой гараж',
            '11' => 'Прилагается',
            '62' => 'Прихожая',
            '102' => 'Профилированный брус',
            '38' => 'Профнастил',
            '44' => 'Пустая',
            '124' => 'Рабочий кабинет',
            '116' => 'Раздельный',
            '104' => 'Район',
            '72' => 'Расположение',
            '110' => 'Река',
            '22' => 'Риэлтором',
            '119' => 'Ровный',
            '121' => 'Родник',
            '58' => 'Ростверк',
            '27' => 'Рубленое дерево',
            '53' => 'Садовые деревья',
            '14' => 'Сарай',
            '9' => 'Сельскохозяйственные земли',
            '117' => 'Сигнализация',
            '21' => 'Собственником',
            '93' => 'Собственность более 5 лет',
            '92' => 'Собственность менее 5 лет',
            '29' => 'Совмещенный',
            '123' => 'Солома',
            '17' => 'Спальня',
            '40' => 'Столовая',
            '73' => 'Сторожка',
            '130' => 'Таунхаус',
            '20' => 'Тип здания',
            '6' => 'Точный адрес',
            '106' => 'Требуется косметический ремонт',
            '107' => 'Требуется ремонт',
            '45' => 'Укомплектованная',
            '70' => 'Участок с подрядом',
            '49' => 'Фахверк',
            '57' => 'Хорошая отделка',
            '129' => 'Черепица',
            '125' => 'Шведская плита',
            '118' => 'Шифер',
            '28' => 'Шлакоблоки',
            '46' => 'Эксклюзивного качества',
        );

        // Цифровые элементы
        $integer_elements = [
            'id_news',
            'user_id',
            'common',
            'resedential',
            'not_residential',
            'bathroom_number',
            'balcony',
            'ceiling_height',
            'distance_from_metro',
            'distance_from_mkad_or_metro',
            'floor',
            'not_residentia',
            'number_of_floors',
            'number_of_rooms',
            'price',
            'the_number_of_kilowatt',
            'year_of_construction'
        ];
        //Присваивание значениям опций - перевода
        foreach ($new_data as $key => $val) {
            if (is_int($val) && !in_array($key, $integer_elements)) {
                if (isset($options[$val])) {
                    $new_data[$key] = $options[$val];
                } else {
                    $new_data[$key] = '!!! неизвестная опция  = ' . $val;
                }

            }
        }

        //Присваивание заголовков
        foreach ($new_data as $key => $val) {
            if (!empty($header[$key])) {
                $new_data[$key . '_h'] = $header[$key];
            }
        }

        return $new_data;
    }

    /**
     * Список объявлений
     * @param int $page - страница новостей
     * @return array - выборка всех данных новостей в виде массива
     */
    public function getNewsList($page = 0, $space_type = 0, $operation_type = 0, $object_type = 0)
    {
        $data = []; //выходные данные
        // Определение номера страницы выводимых новостей
        if (empty($page)) {
            // по умолчанию первая страница
            $data['page'] = 1;
        } else {
            $data['page'] = (int)$page[0];
        }

        // Количество выводимых новостей
        $number_of_news = (int)$_SESSION['news_list']['number_of_news'];
        // Таблица новостей
        if (!empty($_SESSION['news_list']['category'])) {
            foreach ($_SESSION['news_list']['category'] as $key => $value) {
                $data['news_table_category'][(int)$key] = (int)$value;
            }
        }
        // Общее кол-во новостей
        $data['namber_of_all_rows'] = (int)$_SESSION['news_list']['namber_of_all_rows'];

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

        $sql = "SELECT id_news, date::date, title, space_type, operation_type, object_type, content, user_id, preview_img, status, category, tags "
            . "FROM news_base WHERE status = 1 ";
        if (!empty($data['news_table_category'])) {
            $sql = $sql . " AND (";
            foreach ($data['news_table_category'] as $value) {
                $sql = $sql . ' category = ' . $value . ' OR ';
            }
            // удаление последнего OR
            $sql = substr($sql, 0, -4);
            $sql = $sql . ')';
        }

        $sql = $sql . " ORDER BY date DESC"
            . " LIMIT :number_of_news"
            . " OFFSET :from_page";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':number_of_news', $number_of_news);
        $stmt->bindParam(':from_page', $from_page);
        $stmt->execute();
        $data['news'] = $stmt->fetchAll();

        // Подкотовка данных для вывода
        $data['news'] = $this->prepareNewsPreview($data['news']);

        return $data;
    }

    // Определяет и записывает в SESSION при $_POST['watch_news_list']
    // или выставляет по умолчанию
    // общее кол-во новостей, кол-во нов. на странице, категории, сортировка
    public function setSessionForNewsList()
    {
        // По умолчанию
        $category_list = [];
        $sort = 'data';
        $sort_dir = 'DESC';
        $number_of_news = 10;

        // Если переход по ссылке - категория => $_GET
        if (!empty($_GET['category'])) {
            $i = (int)$_GET['category'];
            if (preg_match('/[1,11,12,13,14,21,22,23,24]/', $i)) {
                $category_list[$i] = $i;
            }
        }


        // Если нажата кнопка выбора режима просмотра
        if (!empty($_POST['watch_news_list'])) {
            $number_of_news = (int)$_POST['number_of_news'];

            if (!empty($_POST['news_table_category']) && is_array($_POST['news_table_category'])) {
                foreach ($_POST['news_table_category'] as $k => $v) {
                    $category_list[$k] = (int)$v;
                }
            }

        }
        // общее кол-во новостей
        $namber_of_all_rows = $this->getNamber_of_all_rows($category_list);


        // Запись в SESSION
        $_SESSION['news_list']['category'] = $category_list;
        $_SESSION['news_list']['sort'] = $sort;
        $_SESSION['news_list']['sort_dir'] = $sort_dir;
        $_SESSION['news_list']['number_of_news'] = $number_of_news;
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
    /**
     * @param null $user_id
     * @return array|bool
     */
    public function getMyNewsList($user_id = NULL)
    {
        if (!empty($user_id)) {
            $sql = 'SELECT id_news, date::date, title, content, user_id, preview_img, status, space_type, operation_type, object_type, tags '
                . 'FROM news_base';
            if ($user_id !== 'admin') {
                $sql = $sql . ' WHERE user_id = :user_id';
            }

            $sql = $sql . ' ORDER BY date DESC';

            $stmt = $this->db->prepare($sql);
            if ($user_id !== 'admin') {
                $stmt->bindParam(':user_id', $user_id);
            }
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // преобразуем категории в слова
            foreach ($result as &$news) {
                $news['space_type'] = $this->translateIndex($news['space_type'], 'space_type');
                $news['operation_type'] = $this->translateIndex($news['operation_type'], 'operation_type');
                $news['object_type'] = $this->translateIndex($news['object_type'], 'object_type');
            }
        } else {
            return FALSE;
        }
        //преобразование картинок в массив
        $result = $this->explodePreviewImg($result);

        return $result;
    }

    public function setSessionForEditor($news_to_edit)
    {
//        $arr = [];
//        //Запись всех checkbox со значениями, для перезаписи их при Update
//        $checkbox_list = $this->checkboxList(); // все boolean в табл news_base
//        foreach ($news_to_edit as $key => $value) {
//            if (in_array($key, $checkbox_list) && !empty($value)) {
//                array_push($arr, $key);
//            }
//        }
//        $_SESSION['existing_num'] = $arr;
        //Запись имен картинок в базе, для перезаписи картинок при Update
        $_SESSION['preview_img'] = $news_to_edit["preview_img"];
    }

    public function getFormData($preview_img)
    {
        $new_form_data = [];

        //Определение пользователя
        if (!empty($_SESSION['userID'])) {
            $user_id = (int)$_SESSION['userID'];
        } else {
            return false;
        }

        //Удаление пробелов и переводов строк в начале и в конце строк 
        function trim_value(&$value)
        {
            $value = trim($value);
        }

        array_filter($_POST, 'trim_value');

        static $args = array(
            'form_name' => FILTER_SANITIZE_STRING,
            'space_type' => FILTER_SANITIZE_NUMBER_INT,
            'operation_type' => FILTER_SANITIZE_NUMBER_INT,
            'object_type' => FILTER_SANITIZE_NUMBER_INT,
            'category' => FILTER_SANITIZE_NUMBER_INT,
            'status' => FILTER_SANITIZE_NUMBER_INT,
            'author_id' => FILTER_SANITIZE_STRING,
            'title' => FILTER_SANITIZE_STRING,
            'content' => FILTER_SANITIZE_STRING,
            'preview_img' => FILTER_SANITIZE_STRING,
            'photo_available' => FILTER_VALIDATE_BOOLEAN,
            'tags' => FILTER_SANITIZE_STRING,
            'country' => FILTER_SANITIZE_STRING,
            'area' => FILTER_SANITIZE_STRING,
            'city' => FILTER_SANITIZE_STRING,
            'region' => FILTER_SANITIZE_STRING,
            'address' => FILTER_SANITIZE_STRING,
            'location_of_bathroom' => FILTER_SANITIZE_STRING,
            'description_of_bathroom' => FILTER_SANITIZE_STRING,
            'gas' => FILTER_VALIDATE_BOOLEAN,
            'heating' => FILTER_VALIDATE_BOOLEAN,
            'water_pipes' => FILTER_VALIDATE_BOOLEAN,
            'elevator_passangers' => FILTER_VALIDATE_BOOLEAN,
            'elevator_cargo' => FILTER_VALIDATE_BOOLEAN,
            'fencing_material' => FILTER_SANITIZE_NUMBER_INT,
            'bathroom' => FILTER_VALIDATE_BOOLEAN,
            'dining_room' => FILTER_VALIDATE_BOOLEAN,
            'study' => FILTER_VALIDATE_BOOLEAN,
            'playroom' => FILTER_VALIDATE_BOOLEAN,
            'hallway' => FILTER_VALIDATE_BOOLEAN,
            'living_room' => FILTER_VALIDATE_BOOLEAN,
            'kitchen' => FILTER_VALIDATE_BOOLEAN,
            'bedroom' => FILTER_VALIDATE_BOOLEAN,
            'signaling' => FILTER_VALIDATE_BOOLEAN,
            'cctv' => FILTER_VALIDATE_BOOLEAN,
            'intercom' => FILTER_VALIDATE_BOOLEAN,
            'concierge' => FILTER_VALIDATE_BOOLEAN,
            'common' => FILTER_SANITIZE_NUMBER_INT,
            'resedential' => FILTER_SANITIZE_NUMBER_INT,
            'elevator' => FILTER_SANITIZE_NUMBER_INT,
            'elevator_yes' => FILTER_SANITIZE_NUMBER_INT,
            'additional_buildings' => FILTER_SANITIZE_NUMBER_INT,
            'availability_of_bathroom' => FILTER_SANITIZE_NUMBER_INT,
            'availability_of_garbage_chute' => FILTER_VALIDATE_BOOLEAN,
            'balcony' => FILTER_SANITIZE_NUMBER_INT,
            'bargain' => FILTER_VALIDATE_BOOLEAN,
            'building_type' => FILTER_SANITIZE_NUMBER_INT,
            'cadastral_number' => FILTER_VALIDATE_BOOLEAN,
            'ceiling_height' => FILTER_SANITIZE_NUMBER_INT,
            'clarification_of_the_object_type' => FILTER_SANITIZE_NUMBER_INT,
            'combined' => FILTER_SANITIZE_STRING,
            'distance_from_metro' => FILTER_SANITIZE_NUMBER_INT,
            'distance_from_mkad_or_metro' => FILTER_SANITIZE_NUMBER_INT,
            'documents_on_ownership' => FILTER_VALIDATE_BOOLEAN,
            'doesnt_matter' => FILTER_SANITIZE_STRING,
            'electricity' => FILTER_VALIDATE_BOOLEAN,
            'equipment' => FILTER_SANITIZE_NUMBER_INT,
            'fencing' => FILTER_VALIDATE_BOOLEAN,
            'floor' => FILTER_SANITIZE_NUMBER_INT,
            'foundation' => FILTER_SANITIZE_NUMBER_INT,
            'furnish' => FILTER_SANITIZE_NUMBER_INT,
            'lavatory' => FILTER_SANITIZE_NUMBER_INT,
            'lease' => FILTER_SANITIZE_NUMBER_INT,
            'lease_contract' => FILTER_VALIDATE_BOOLEAN,
            'location_on' => FILTER_SANITIZE_NUMBER_INT,
            'material' => FILTER_SANITIZE_NUMBER_INT,
            'metro_station' => FILTER_SANITIZE_NUMBER_INT,
            'municipal' => FILTER_SANITIZE_NUMBER_INT,
            'not_residential' => FILTER_SANITIZE_NUMBER_INT,
            'number_of_floors' => FILTER_SANITIZE_NUMBER_INT,
            'number_of_rooms' => FILTER_SANITIZE_NUMBER_INT,
            'object_located' => FILTER_SANITIZE_NUMBER_INT,
            'paid' => FILTER_SANITIZE_NUMBER_INT,
            'parking' => FILTER_SANITIZE_NUMBER_INT,
            'planning_project' => FILTER_SANITIZE_STRING,
            'price' => FILTER_SANITIZE_NUMBER_INT,
            'property_documents' => FILTER_VALIDATE_BOOLEAN,
            'residential' => FILTER_SANITIZE_STRING,
            'roofing' => FILTER_SANITIZE_NUMBER_INT,
            'rooms' => FILTER_SANITIZE_NUMBER_INT,
            'sanitation' => FILTER_SANITIZE_NUMBER_INT,
            'security' => FILTER_VALIDATE_BOOLEAN,
            'select_area_on_city' => FILTER_SANITIZE_NUMBER_INT,
            'separated' => FILTER_SANITIZE_STRING,
            'site' => FILTER_SANITIZE_NUMBER_INT,
            'space' => FILTER_SANITIZE_STRING,
            'stairwells_status' => FILTER_SANITIZE_NUMBER_INT,
            'the_number_of_kilowatt' => FILTER_SANITIZE_NUMBER_INT,
            'three_d_project' => FILTER_SANITIZE_STRING,
            'total' => FILTER_SANITIZE_STRING,
            'type_of_construction' => FILTER_SANITIZE_NUMBER_INT,
            'type_of_house' => FILTER_SANITIZE_NUMBER_INT,
            'video' => FILTER_SANITIZE_STRING,
            'wall_material' => FILTER_SANITIZE_NUMBER_INT,
            'year_of_construction' => FILTER_SANITIZE_NUMBER_INT,
            'time_walk' => FILTER_SANITIZE_NUMBER_INT,
            'time_car' => FILTER_SANITIZE_NUMBER_INT,
            'bathroom_available' => FILTER_VALIDATE_BOOLEAN,
            'alcove' => FILTER_VALIDATE_BOOLEAN,
            'barn' => FILTER_VALIDATE_BOOLEAN,
            'bath' => FILTER_VALIDATE_BOOLEAN,
            'forest_trees' => FILTER_VALIDATE_BOOLEAN,
            'garden_trees' => FILTER_VALIDATE_BOOLEAN,
            'guest_house' => FILTER_VALIDATE_BOOLEAN,
            'lodge' => FILTER_VALIDATE_BOOLEAN,
            'playground' => FILTER_VALIDATE_BOOLEAN,
            'river' => FILTER_VALIDATE_BOOLEAN,
            'spring' => FILTER_VALIDATE_BOOLEAN,
            'swimming_pool' => FILTER_VALIDATE_BOOLEAN,
            'waterfront' => FILTER_VALIDATE_BOOLEAN,
            'wine_vault' => FILTER_VALIDATE_BOOLEAN
        );

        $new_form_data = filter_input_array(INPUT_POST, $args);
        $new_form_data['user_id'] = $user_id;


        //Переписывание параметров в 'Другое' если есть _other
//        foreach ($new_form_data as $key => $value) {
//            $oth = $key.'_other';
//
//            if (isset($new_form_data[$oth])) {
//                if ($value == 'Другое') {
//                    $new_form_data[$key] = $new_form_data[$oth];
//                }
//                unset($new_form_data[$oth]);
//            }
//        }


        //Удаление несуществующих параметров
        //C присваиванием всем не отмеченым boolean переменым false
        $checkbox_arr = $this->checkboxList();
        foreach ($new_form_data as $key => $value) {
            if (!empty($value)) {
                $form_data[$key] = $new_form_data[$key];
            } elseif (in_array($key, $checkbox_arr) && isset($_POST[$key])) {
                $form_data[$key] = 'false';
            }
        }

        //Присваивание NULL для неотмеченных checkbox или непроставленных для них значений, нужно для Update
//        if (!empty($_SESSION['existing_num'])) {
//            foreach ($_SESSION['existing_num'] as $key_num) {
//                $check = strstr($key_num, '_num', true).'_checkbox';
//                if (empty($_POST[$check]) || empty($_POST[$key_num])) {
//                    $form_data[$key_num] = NULL;
//                }
//            }
//        }

        // записываем строку с адресами картинок для добавления в БД в конец массива (т.к. это записывается в базовую таблицу)
        if (!empty($preview_img)) {
            $form_data['preview_img'] = $preview_img;
            $form_data['photo_available'] = 'TRUE';
        } else {
            $form_data['preview_img'] = NULL;
            $form_data['photo_available'] = 'FALSE';
        }

        return $form_data;
    }


    public function makeNewsInsert($form_data)
    {
        //Запись информации в основную таблицу
        $sql = "INSERT INTO news_base (";
        foreach ($form_data as $key => $val) {
            $sql = $sql . $key . ', ';
        }
        // удаляем последнюю запятую
        $sql = substr($sql, 0, -2);
        $sql = $sql . ') VALUES (';
        foreach ($form_data as $key => $val) {
            $sql = $sql . ':' . $key . ', ';
        }
        $sql = substr($sql, 0, -2);
        $sql = $sql . ')';

        $stmt = $this->db->prepare($sql);

        //bindParam
        foreach ($form_data as $key => $val) {
            $p = ':' . $key;
            $stmt->bindParam($p, $form_data[$key]);

        }
        return ($stmt->execute());
    }

    public function makeNewsUpdate($news_to_edit_id, $form_data)
    {

        $sql = "UPDATE news_base SET ";
        foreach ($form_data as $key => $val) {
            $sql = $sql . $key . ' = :' . $key . ', ';
        }
        $sql = substr($sql, 0, -2);

        $sql = $sql . " WHERE id_news = :news_to_edit_id";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':news_to_edit_id', $news_to_edit_id);

        foreach ($form_data as $key => $val) {
            $p = ':' . $key;
            $stmt->bindParam($p, $form_data[$key]);
        }
        return ($stmt->execute());
    }

    public function makeNewsDelete($id)
    {
        global $news_message, $news_error;
        //Удаление загруженых картинок новости
        //Получаем имена файлов на удаление
        $sql = "SELECT preview_img FROM news_base WHERE id_news = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($data['preview_img'])) {
            // разбиваем имена в массив
            $data['preview_img'] = explode('|', $data['preview_img']);
            foreach ($data['preview_img'] as $key => $value) {
                if (file_exists('/uploads/images/' . $value)) {
                    unlink('/uploads/images/' . $value);
                    unlink('/uploads/images/s_' . $value);
                } else {
                    array_push($news_error, 'Картинка ' . $value . ' не существует, невозможно удалить.');
                }
            }
        }


        $sql = "DELETE FROM news_base WHERE id_news = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Добавление сообщения
            array_push($news_message, 'Удалена новость c id = ' . $id);
        } else {
            array_push($news_error, 'Новость с id = ' . $id . ' не удалось удалить');
        };
        return;
    }

    public function makeNewsStatus()
    {
        global $news_message, $news_error;
        foreach ($_SESSION['stat_arr'] as $s_id => $s_stat) {
            $j = 'status_' . $s_id;
            if ($_POST[$j] != $s_stat) {
                //Удаление новости
                if ($_POST[$j] == 3) {
                    $this->makeNewsDelete($s_id);
                } else {
                    $sql = "UPDATE news_base SET status = :status  WHERE id_news = :id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':id', $s_id);
                    $stmt->bindParam(':status', $_POST[$j], PDO::PARAM_INT);
                    if ($stmt->execute()) {
                        // Добавление сообщения
                        array_push($news_message,
                            'Изменён статус у новости c id = ' . $s_id);
                    } else {
                        array_push($news_error,
                            'Статус у новости с id = ' . $s_id . ' не удалось изменить');
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

        $blacklistOfFile = array(".php", ".phtml", ".php3", ".php4"); // Запрещенный формат файлов
        $imgMaxSize = 3050000; // Максимальный размер картинок в байтах
        $return_image_arr = []; //подготовительный массив для сохранения порядка следования
        $return_image_names = ''; // Возвращаемая строка имен картинок

        if (!empty($_FILES)) {
            //Получаем имена полей "image_name_?" ввода картинок переданных POST
            $image_name_keys = preg_grep("/^image_name_/", array_keys($_FILES));

            //отсееваем и записываем имена уже существующих картинок
            foreach ($image_name_keys as $k => $v) {
                if (preg_match("/_saved_/", $v)) {
                    // определяеи номер (отнимаем 1 т.к. для массива)
                    $i = (int)substr($v, 11, 2) - 1;
                    // определяем имя файла
//                 $f_name =strstr($v, 'news_') ;
                    //переделываем 4 знак конца в точку
//                 $f_name = substr_repla($f_name, '.', -4, 1);
                    // добавляем в подготовельный массив под номером
                    $return_image_arr[$i] = $_SESSION['preview_img'][$i];

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
                    array_push($news_error,
                        'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. Можно загружать только картинки с расширением jpeg, png, gif.');
                    continue;
                }
                // Расширения новых имен:
                $name_big = $name_big . $type;
                $name_small = $name_small . $type;

                // Проверка на недопустимые форматы
                foreach ($blacklistOfFile as $item) {
                    if (preg_match("/$item\$/i",
                        $_FILES[$image_name_key]['name'])) {
                        array_push($news_error,
                            'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. PHP файлы не разрешены для загрузки.');
                        continue;
                    }
                }
                // Проверяем размер файла
                if ($_FILES[$image_name_key]['size'] > $imgMaxSize) {
                    array_push($news_error,
                        'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. Слишком большой размер файла картинки.');
                    continue;
                }

                //Изменение размеров и запись
                $this->newsPicturesResize($_FILES[$image_name_key], 'big',
                    $name_big);
                $this->newsPicturesResize($_FILES[$image_name_key], 'small',
                    $name_small);

                //Запись в подгот. массив под номером ключа соотв. имени
                // Определяем номер (отнимаем 1 т.к. для массива)
                $i = (int)substr($image_name_key, 11, 2) - 1;

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
                    $return_image_names = $return_image_names . '|' . $value;
                }
            }
        }

// Удаление всех картинок находящихся в БД, но не переданных на апдейт
        if (!empty($_SESSION['preview_img'][0])) {
            //Расхождение массива $_SESSION['preview_img'] от $return_image_arr
            $img_arr_for_delete = array_diff($_SESSION['preview_img'], $return_image_arr);

            foreach ($img_arr_for_delete as $value) {
                unlink('uploads/images/' . $value);
                unlink('uploads/images/s_' . $value);
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
        if (!@copy($tmpPath . $new_name, $imgPath . $new_name)) {
            array_push($news_error, 'Произошла ошибка при загрузке картинки');
        }
        //Удаляем временный файл
        unlink($tmpPath . $new_name);
    }

    // Вывод картинки во временную директорию
    public function picturesSaveAndClear($file, $dest, $name, $quality)
    {
        global $tmpPath;

        if ($file['type'] == 'image/jpeg')
            imagejpeg($dest, $tmpPath . $name, $quality);
        elseif ($file['type'] == 'image/png')
            imagepng($dest, $tmpPath . $name, $quality);
        elseif ($file['type'] == 'image/gif')
            imagegif($dest, $tmpPath . $name, $quality);
        else return false;
    }

    //Принимает индекс и имя переменной
    //Возвращает значение соответствующее индексу
    public function translateIndex($index = 0, $names_type = '')
    {

        // Проверочный массив

        static $test_array = array(
            'space_type' => array(
                1 => 'Нежилая',
                2 => 'Жилая'
            ),
            'operation_type' => array(
                1 => 'Арендовать',
                2 => 'Купить'
            ),
            'object_type' => array(
                1 => 'Квартира',
                2 => 'Офисная площадь',
                3 => 'Торговая площадь',
                4 => 'Офисная площадь с землей',
                5 => 'Производственно-складские здания',
                6 => 'Производственно-складские помещения ',
                7 => 'Рынок/Ярмарка',
                8 => 'Комплекс ОСЗ',
                9 => 'ОСЗ',
                10 => 'Торговое здание',
                11 => 'Комната',
                12 => 'Дом',
                13 => 'Гараж/Машиноместо',
                14 => 'Земельный участок'
            ),
        );
// Определение значения
        if (!empty($index) && !empty($names_type)) {
            if (isset($test_array[$names_type][$index])) {
                $index = $test_array[$names_type][$index];
            }
        }
        return $index;
    }

    public function getLastViewedNews()
    {

        $cook_last_v = [];
        $result = [];
        // Последние новости из COOKIE
        if (isset($_COOKIE['last_viewed_news'])) {
            foreach ($_COOKIE['last_viewed_news'] as $key => $value) {
                $key = (int)$key;
                $value = (int)$value;
                if (!empty($value)) {
                    $cook_last_v_news[$key] = $value;
                }
            }
            //запрос в бд
            $sql = 'SELECT id_news, title, preview_img '
                . 'FROM news_base WHERE ';


            foreach ($cook_last_v_news as $key => $value) {
                $sql = $sql . 'id_news = :id' . $key . ' OR ';
            }
//              удаление последнего OR
            $sql = substr($sql, 0, -4);

            $stmt = $this->db->prepare($sql);
            foreach ($cook_last_v_news as $key => $value) {
                $name = ':id' . $key;
                $stmt->bindParam($name, $cook_last_v_news[$key]);

            }
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // нахождение первой картинки в preview_img
            foreach ($res as $key => $value) {
                if (!empty($value['preview_img'])) {
                    //               $p = strpos($value['preview_img'], '|');
                    //               $res[$key]['preview_img'] = substr($value['preview_img'], $p);
                    if (!($res[$key]['preview_img'] = strstr($value['preview_img'], '|', TRUE))) {
                        $res[$key]['preview_img'] = $value['preview_img'];
                    }

                }
            }
            //сортировка массива в соответствии с COOKIE

            foreach ($cook_last_v_news as $key => $value) {
                foreach ($res as $news) {
                    if ($value == $news['id_news']) {
                        $result[$key] = $news;
                    }
                }
            }
        } else {
            $result[0]['title'] = 'За последнее время вы ни чего не просматривали';
        }
        return $result;
    }

    /**
     * Возвращает список всех chekbox (boolean) параметров из Базы данных
     * это нужно для проверки при перезаписи объявления
     * список контролируется из административной панели
     * @return array
     */
    public function checkboxList()
    {
        $all_checkbox_list = ['photo_available', 'gas', 'heating', 'water_pipes', 'elevator_passangers', 'elevator_cargo', 'bathroom', 'dining_room', 'study', 'playroom', 'hallway', 'living_room', 'kitchen', 'bedroom', 'signaling', 'cctv', 'intercom', 'concierge', 'availability_of_garbage_chute', 'bargain', 'cadastral_number', 'documents_on_ownership', 'electricity', 'fencing', 'lease_contract', 'property_documents', 'security'];
        return $all_checkbox_list;
    }


    /**
     * Возвращает список последних объявлений
     * @param int $time_start - период до начала поиска в часах
     * @param int $time - период до конца поиска в часах
     * @param int $max_numder - количество объявлений
     * @param int $space_type - Тип площади
     * @param int $operation_type - Операция
     * @param int $object_type - Тип объекта
     * @param bool $best - Только лучшие объявления
     * @return array
     */
    public function getRecentNewsList($time_start = 0, $time = 24, $max_numder = 20, $space_type = 0, $operation_type = 0,
                                      $object_type = 0, $best = false, $status = true)
    {
        //Заданное время начала поиска ($time - час)
        $news_time = time() - $time * 60 * 60;
        //Текущая Дата в формате стандарта ISO 8601
        $news_date = date('c', $news_time);

        //Дата окончания поиска (по умолчанию настоящее время)
        if (!empty($time_start)) {
            $time_start = date('c', strtotime($time_start)+86400);
        } else {
            $time_start = 0;
        }

        $sql = "SELECT id_news, date::date, title, space_type, operation_type, object_type, content, user_id, preview_img, status, category, tags "
            . "FROM news_base WHERE (date >= :date) ";

        if ($time_start) {
            $sql .= "AND (date <= :date_start) ";
        }
        if ($status) {
            $sql .= "AND (status = 1) ";
        }
        if ($space_type != 0) {
            $sql .= "AND (space_type = :space_type) ";
        }
        if ($operation_type != 0) {
            $sql .= "AND (operation_type = :operation_type) ";
        }
        if ($object_type != 0) {
            $sql .= "AND (object_type = :object_type) ";
        }
        if ($best) {
            $sql .= "AND (category = 1) ";
        }

        $sql .= " ORDER BY date DESC"
            . " LIMIT :max_numder";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':date', $news_date);
        if ($time_start != 0) {
            $stmt->bindParam(':date_start', $time_start);
        }
        $stmt->bindParam(':max_numder', $max_numder);
        if ($space_type != 0) {
            $stmt->bindParam(':space_type', $space_type);
        }
        if ($operation_type != 0) {
            $stmt->bindParam(':operation_type', $operation_type);
        }
        if ($object_type != 0) {
            $stmt->bindParam(':object_type', $object_type);
        }
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Подкотовка данных для вывода
        $data = $this->prepareNewsPreview($data);

        return $data;
    }

    /**
     * Подкотовка данных для вывода превью объявлений
     * @param $data - исходные данные объявлений из БД в виде arr[[0]=>arr, [1]=>arr...]
     * @return mixed - преобразованные данные
     */
    public function prepareNewsPreview($data)
    {
        //Строку файлов картинок преобразуем в массив $data['news'][number]['preview_img'][]
        $data = $this->explodePreviewImg($data);

        foreach ($data as $key => $value) {
            // Получение имен категорий
            $data[$key]['space_type'] = $this->translateIndex($data[$key]['space_type'], 'space_type');
            $data[$key]['operation_type'] = $this->translateIndex($data[$key]['operation_type'], 'operation_type');
            $data[$key]['object_type'] = $this->translateIndex($data[$key]['object_type'], 'object_type');
            // Превью содержания
            $short_len = 60; // длина предпросмотра (short_content) в символах

            if (!empty($data[$key]['content'])) {
                if (strlen($data[$key]['content']) > $short_len) {
                    //Обрезка содержания по окончанию слова (пробелу)
                    if ($short_content_position = strpos($data[$key]['content'], ' ', $short_len)) {
                        $data[$key]['content'] = substr($data[$key]['content'], 0, $short_content_position);
                        $data[$key]['content'] .= '...';
                    }
                }
            }
        }
        return $data;
    }

    public function sendNewNewsByRabbitMQ($message)
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();
        // Параметры Обмена - "точки доступа"
        //Имя Обмена; false-НЕ пассив(сервер может создать очередь); true - надежный(durable)
        //false - НЕ auto-delete когда отписывается последний подписчик;
        // $channel->exchange_declare('ex_newNews', 'fanout', false, true, false);

        //Очередь
        //Имя очереди; false-НЕ пассив(сервер может создать очередь); true - надежный(durable)
        //false - НЕ используется только данным соединением;
        // false - очередь НЕ автоудаляется, когда отписывается последний подписчик
        $channel->queue_declare('newNews', false, true, false, false);

        //delivery_mode - сообщение постоянно, чтобы не потерялось при падении сервера
        $msg = new AMQPMessage($message, array('delivery_mode' => 2));
        //$msg - (сообщение, обмен, ключ очереди)
        //$channel->basic_publish($msg, 'ex_newNews');
        $channel->basic_publish($msg, '', 'newNews');

        $channel->close();
        $connection->close();
        return;
    }

    public function getNewNewsByRabbitMQ()
    {
        global $rabbitmq_message_newnews;
        $rabbitmq_message_newnews = [];
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        //$channel->exchange_declare('ex_newNews', 'fanout', false, true, false);
        $channel->queue_declare('newNews', false, true, false, false);
        //не отправляем новое сообщение на обработчик,
        // пока он не обработал и не подтвердил предыдущее. Вместо этого
        // направляем сообщение на любой свободный обработчик
        //null - без ограничения размера выборки
        //1 - количество предварительных выборок
        //null - настройки QoS применяются для получателей (true - к каналу)
        $channel->basic_qos(null, 1, null);

        $callback = function ($msg) {
            global $rabbitmq_message_newnews;
            $message = $msg->body;
            array_push($rabbitmq_message_newnews, $message);
        };


        // Установление подписки
        // newNews - очередь , '' - тег канала Обмена
        // false - не локальный; true -  подтверждения ВЫКЛючены
        // false - не эксклюзивная; false -  НЕ не ждать ответа сервера
        // функция обратного вызова
        $channel->basic_consume('newNews', '', false, true, false, false, $callback);

//        while(count($channel->callbacks)) {
//            $channel->wait();
//        }


        // wait function works only with sockets, we have to catch the exception
        $timeout = 5;
        while (count($channel->callbacks)) {
            try {
                $channel->wait(null, false, $timeout);
            } catch (\PhpAmqpLib\Exception\AMQPTimeoutException $e) {
                $channel->close();
                $connection->close();
                return $rabbitmq_message_newnews;
            }
        }

        $channel->close();
        $connection->close();
        return $rabbitmq_message_newnews;
    }


}