<?php

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;

class NewsModel extends Model
{
    private $response = [];
    private $errors = [];
    private $user_id;

    public function __construct()
    {
        $this->db = new DataBase;
        if (isset($_SESSION['user']['id'])) {
            $this->user_id = (int)$_SESSION['user']['id'];
        }
    }

    /**
     * Проверка строки на вредоносные элементы
     *
     * @param $str
     *
     * @return string
     */
    private function checkingString($str)
    {
        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str);

        return $str;
    }

    /**
     * Переводит время от настоящего момента (в часах) в дату стандарта ISO 8601
     *
     * @param int $time
     *
     * @return false|int|string
     */
    private function dateFormatForDB($time = 0)
    {
        $date = time() - ($time * 60 * 60);
        if ($date < 0) {
            $this->error(self::DATE_INCORRECT_ERROR);
        }
        $date = date('c', $date);

        return $date;
    }


    /**
     * Определение новое ли объявление
     *
     * @param $date - дата объявления в формате YYYY-MM-DD HH24:MI:SS
     *
     * @return bool - является ли объявление новым
     */
    private function checkAdsIsNew($date)
    {
        //Промежуток времени в часах, когда объявление считается новым
        $delta_new_time = 24;
        $time = strtotime($date);

        return (((time() - $time) / 60 / 60) <= $delta_new_time);
    }


    /**
     * Количество объявлений удовлетворяющих условиям
     *
     * @param int $time_from - за промежуток от времени в часах
     * (по умолчанию, за всё время)
     * @param int $time_to - за промежуток до времени в часах
     * (по умолчанию, до настоящего времени)
     * @param int $space_type - Тип площади
     * @param int $operation_type - Операция
     * @param int $object_type - Тип объекта
     * @param int $price_from - Цена от
     * @param int $price_to - Цена до
     * @param int $space_from - Площадь от
     * @param int $space_to - Площадь до
     * @param int $city - город
     * @param int $status - Статус (активное/не активное)
     * @param string $title_like
     *
     * @return int - Количество объявлений
     */
    public function getNamberOfAllNews(
        $time_from = 0,
        $time_to = 0,
        $space_type = 0,
        $operation_type = 0,
        $object_type = 0,
        $price_from = 0,
        $price_to = 0,
        $space_from = 0,
        $space_to = 0,
        $city = 0,
        $status = 1,
        $title_like = ''
    )
    {
        $sql = "SELECT COUNT(*) FROM news_base WHERE ";
        //Дата окончания поиска (по умолчанию настоящее время)
        $time_to = $this->dateFormatForDB($time_to);
        $sql .= " (date <= :time_to) ";
        //Дата начала поиска
        if ($time_from != 0) {
            $time_from = $this->dateFormatForDB($time_from);
            $sql .= "AND (date >= :time_from) ";
        }
        if ($status == 1) {
            // Только активные(видимые)
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
        if ($price_from != 0) {
            $sql .= "AND (price >= :price_from) ";
        }
        if ($price_to != 0) {
            $sql .= "AND (price <= :price_to) ";
        }
        if ($space_from != 0) {
            $sql .= "AND (space >= :space_from) ";
        }
        if ($space_to != 0) {
            $sql .= "AND (space <= :space_to) ";
        }
        if ($city != 0) {
            $sql .= "AND (city = :city) ";
        }
        if ($title_like) {
            $title_like = $this->checkingString($title_like);
            $sql .= "AND (title LIKE '%" . $title_like . "%') ";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':time_to', $time_to);
        if ($time_from != 0) {
            $stmt->bindParam(':time_from', $time_from);
        }
        if ($space_type != 0) {
            $stmt->bindParam(':space_type', $space_type);
        }
        if ($operation_type != 0) {
            $stmt->bindParam(':operation_type', $operation_type);
        }
        if ($object_type != 0) {
            $stmt->bindParam(':object_type', $object_type);
        }
        if ($price_from != 0) {
            $stmt->bindParam(':price_from', $price_from);
        }
        if ($price_to != 0) {
            $stmt->bindParam(':price_to', $price_to);
        }
        if ($space_from != 0) {
            $stmt->bindParam(':space_from', $space_from);
        }
        if ($space_to != 0) {
            $stmt->bindParam(':space_to', $space_to);
        }
        if ($city != 0) {
            $stmt->bindParam(':city', $city);
        }
        if (!$stmt->execute()) {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $result = $stmt->fetchColumn();
        //для Ajax запроса
        $this->response['count'] = $result;

        return $result;
    }

    /**
     * Получить все данные объявления по его id
     *
     * @param $id
     *
     * @return mixed - массив данных, адреса картинок - ввиде массива ['preview_img']
     */
    public function getNewsById($id)
    {

        // Считываем базовую информацию по id
        $sql = "SELECT *"
            . " FROM news_base"
            . " WHERE id_news = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        if (!$stmt->execute()) {
            $this->error(self::DB_SELECT_ERROR);
        }
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // Получение фото
        $data = getAdsPhotos($data);

        return $data;
    }

    /**
     * Подсчет просмотров объявления и установка последних просмотренных объявлений
     * Параметры по умолчанию:
     * $last_viewed_news_namber - количество хранящихся последних просмотров
     * $last_viewed_news_time - время хранения куки
     *
     * @param $id_news
     * @param $user_ip
     */
    public function setCountViewsNews($id_news, $user_ip)
    {
        // Установление куки о просмотренной странице
        $last_viewed_news_namber = 5; // 5 новостей
        $last_viewed_news_time = 1; // время хранения (дней) 0.00694 = 10мин

        $last_viewed_news_namber--;
        $last_viewed_news_time = $last_viewed_news_time * 60 * 60 * 24;
        // массив для записи и сортировки COOKIE
        $last_viewed_news_array = [];

        if (isset($_COOKIE['last_viewed_news'])) {
            //запись COOKIE в массив
            for ($index = $last_viewed_news_namber; $index >= 0; $index--) {
                if (isset($_COOKIE['last_viewed_news'][$index])) {
                    $last_viewed_news_array[$index] = (int)$_COOKIE['last_viewed_news'][$index];
                }
            }
            ksort($last_viewed_news_array);

            //Проверка существует ли уже новость в массиве (находим позицию в массиве)
            $id_key = array_search($id_news, $last_viewed_news_array);
            if ($id_key !== false) {
                // если да, то удаляем этот элемент
                array_splice($last_viewed_news_array, $id_key, 1);
            } else {
                // Проверка наличия просмотра в базе
                //ip в число с учетом 32разрядных систем
                $user_ip = sprintf('%u', ip2long($user_ip));
                // Проверка в БД IP
                $sql = "SELECT id FROM news_views WHERE id_news = :id_news AND user_ip = :user_ip";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id_news', $id_news);
                $stmt->bindParam(':user_ip', $user_ip);
                if (!$stmt->execute()) {
                    $this->error(self::DB_SELECT_ERROR);
                }
                if (!$stmt->fetchColumn()) {
                    //Если нет => Запись IP
                    if (isset($_SESSION['userID'])) {
                        $userID = (int)$_SESSION['userID'];
                    } else {
                        $userID = false;
                    }
                    $sql = "INSERT INTO news_views (id_news, user_ip";
                    if ($userID) {
                        $sql .= " ,user_id";
                    }
                    $sql .= ") VALUES (:id_news, :user_ip";
                    if ($userID) {
                        $sql .= " ,:user_id";
                    }
                    $sql .= ")";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':id_news', $id_news);
                    $stmt->bindParam(':user_ip', $user_ip);
                    if ($userID) {
                        $stmt->bindParam(':user_id', $userID);
                    }
                    if (!$stmt->execute()) {
                        $this->error(self::DB_INSERT_ERROR);
                    }
                    //Увеличение рейтинга просмотров
                    $sql = "UPDATE news_base SET rating_views = rating_views + 1 WHERE id_news = :id_news";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindParam(':id_news', $id_news);
                    if (!$stmt->execute()) {
                        $this->error(self::DB_UPDATE_ERROR);
                    }
                }
            }
        }

        // Добавляем id в начало массива
        array_unshift($last_viewed_news_array, $id_news);
        // Обрезаем массив
        array_splice($last_viewed_news_array, ($last_viewed_news_namber + 1));

        // Запись COOKIE
        foreach ($last_viewed_news_array as $key => $value) {
            $name = "last_viewed_news[$key]";
            setcookie($name, $value, time() + $last_viewed_news_time);
        }
    }

    //    /**
    //     * Подготовка объявлений- удаление пустых данных и перевод индексов
    //     *
    //     * @param $news
    //     *
    //     * @return array
    //     */
    //    public function prepareNewsView($news)
    //    {
    //        //новый массив данных новости
    //        $new_data = [];
    //        //Удаление несуществующих параметров
    //        // и Перевод чисел в слова
    //        foreach ($news as $key => $val) {
    //            if (!empty($val)) {
    //                $new_data[$key] = $news[$key];
    //                if (is_int($new_data[$key])) {
    //                    $new_data[$key] = $this->translateIndex($new_data[$key], $key);
    //                }
    //                if (is_bool($new_data[$key])) {
    //                    if ($new_data[$key]) {
    //                        $new_data[$key] = 'Да';
    //                    } else {
    //                        $new_data[$key] = 'Нет';
    //                    }
    //                }
    //            }
    //        }
    //
    //
    //        //!!! Заголовки !!!
    //        $header = [
    //            'id_news'             => 'Индекс объявления',
    //            'form_name'           => 'Имя формы',
    //            'space_type'          => 'Тип площади',
    //            'operation_type'      => 'Операция',
    //            'object_type'         => 'Тип объекта',
    //            'rating_views'        => 'Рейтинг просмотров',
    //            'rating_admin'        => 'Рейтинг администрации',
    //            'rating_donate'       => 'Рейтинг по оплате',
    //            'status'              => 'Статус',
    //            'user_id'             => 'ID пользователя',
    //            'title'               => 'Название новости',
    //            'date'                => 'Дата',
    //            'content'             => 'Контент',
    //            'photo_available'     => 'Наличие фотографий',
    //            'tags'                => 'Тег',
    //            'country'             => 'Страна',
    //            'area'                => 'Область',
    //            'city'                => 'Город',
    //            'region'              => 'Регион',
    //            'address'             => 'Адрес',
    //            'gas'                 => 'Газ',
    //            'heating'             => 'Отопление',
    //            'water_pipes'         => 'Водопровод',
    //            'elevator_passangers' => 'Пассажирский лифт',
    //            'elevator_cargo'      => 'Грузовой лифт',
    //            'bathroom'            => 'Ванная',
    //            'dining_room'         => 'Столовая',
    //            'study'               => 'Рабочий кабинет',
    //            'playroom'            => 'Детская',
    //            'hallway'             => 'Прихожая',
    //            'living_room'         => 'Гостиная',
    //            'kitchen'             => 'Кухня',
    //            'bedroom'             => 'Спальня',
    //            'signaling'           => 'Сигнализация',
    //            'cctv'                => 'Видеонаблюдение',
    //            'intercom'            => 'Домофон',
    //            'concierge'           => 'Консьерж',
    //            'common'              => 'Общая',
    //            'resedential'         => 'Жилая',
    //
    //            'bathroom_description'             => 'Описание санузлов',
    //            'bathroom_location'                => 'Расположение санузлов',
    //            'bathroom_number'                  => 'Количество санузлов',
    //            'possible_to_post'                 => 'Возможность проводки',
    //            'sanitation_description'           => 'Описание',
    //            'documents_on_tenure'              => 'Документы на право владения',
    //            'additional_buildings'             => 'Дополнительные строения',
    //            'availability_of_bathroom'         => 'Наличие санузлов',
    //            'availability_of_garbage_chute'    => 'Наличие мусоропровода',
    //            'balcony'                          => 'Балкон',
    //            'bargain'                          => 'Торг',
    //            'building_type'                    => 'Тип здания',
    //            'cadastral_number'                 => 'Кадастровый номер',
    //            'ceiling_height'                   => 'Высота потолков',
    //            'clarification_of_the_object_type' => 'Уточнение вида объектов',
    //            'combined'                         => 'Совмещенный',
    //            'distance_from_metro'              => 'Удаленность от метро',
    //            'distance_from_mkad_or_metro'      => 'Удаленность от МКАД/метро',
    //            'documents_on_ownership'           => 'Документы на право владения',
    //            'doesnt_matter'                    => 'Не важно',
    //            'electricity'                      => 'Электричество',
    //            'equipment'                        => 'Комплектация',
    //            'fencing'                          => 'Ограждение',
    //            'floor'                            => 'Этаж',
    //            'foundation'                       => 'Фундамент',
    //            'furnish'                          => 'Отделка',
    //            'lavatory'                         => 'Санузел',
    //            'lease'                            => 'Срок аренды',
    //            'lease_contract'                   => 'Договор аренды',
    //            'location_on'                      => 'На участке',
    //            'material'                         => 'Материал',
    //            'metro_station'                    => 'Станция метро',
    //            'municipal'                        => 'Муниципальная',
    //            'not_residential'                  => 'Нежилая',
    //            'number_of_floors'                 => 'Количество этажей',
    //            'number_of_rooms'                  => 'Количество комнат',
    //            'object_located'                   => 'Объект размещен',
    //            'paid'                             => 'Платная ',
    //
    //            'planning_project'       => 'Проект планировки',
    //            'price'                  => 'Стоимость',
    //            'property_documents'     => 'Документы на собственность',
    //            'residential'            => 'Жилая',
    //            'roofing'                => 'Кровля',
    //            'rooms'                  => 'Комнаты',
    //            'sanitation'             => 'Водопровод и канализация',
    //            'security'               => 'Охрана',
    //            'select_area_on_city'    => 'Выбрать область',
    //            'separated'              => 'Раздельный',
    //            'site'                   => 'Участок',
    //            'space'                  => 'Площадь',
    //            'stairwells_status'      => 'Состояние лестничных клеток',
    //            'the_number_of_kilowatt' => 'Количество киловатт',
    //            'three_d_project'        => '3d проект',
    //            'type_of_construction'   => 'Вид постройки',
    //            'type_of_house'          => 'Тип дома',
    //            'video'                  => 'Видео',
    //            'wall_material'          => 'Материал стен',
    //            'year_of_construction'   => 'Год постройки/окончания строительства',
    //            'time_walk'              => 'Время от метро пешком',
    //            'time_car'               => 'Время от метро на транспорте',
    //            'bathroom_available'     => 'Наличие санузла',
    //            'alcove'                 => 'Беседка',
    //            'barn'                   => 'Сарай',
    //            'bath'                   => 'Баня',
    //            'forest_trees'           => 'Лесные деревья',
    //            'garden_trees'           => 'Садовые деревья',
    //            'guest_house'            => 'Гостевой дом',
    //            'lodge'                  => 'Сторожка',
    //            'playground'             => 'Детская площадка',
    //            'river'                  => 'Река',
    //            'spring'                 => 'Родник',
    //            'swimming_pool'          => 'Бассейн',
    //            'waterfront'             => 'Берег водоёма',
    //            'wine_vault'             => 'Винный погреб',
    //            'preview_img'            => 'Фото',
    //            'non_commission'         => 'Нет комиссии',
    //            'house'                  => 'Дом',
    //            'street'                 => 'Улица',
    //
    //            'lift_lifting'   => 'Грузвовой лифт',
    //            'lift_passenger' => 'Пассажирский лифт',
    //            'lift_none'      => 'Без лифта',
    //
    //            'parking_multilevel'     => 'Парковка - Многоуровневая парковка',
    //            'parking_underground'    => 'Парковка - Подземная парковка',
    //            'parking_garage_complex' => 'Парковка - Гаражный комплекс',
    //            'parking_lot_garage'     => 'Парковка - Придомовый гараж',
    //            'parking_none'           => 'Парковка Отсутствует',
    //
    //            'plot_smooth'       => 'Участок Ровный',
    //            'plot_uneven'       => 'Участок Неровный',
    //            'plot_on_the_slope' => 'Участок На склоне',
    //            'plot_of_ravine'    => 'Участок Овраг',
    //            'plot_wetland'      => 'Участок Заболоченный',
    //        ];
    //
    //
    //        //Опции !!!
    //        $options = [
    //            '0'   => 'Не указано',
    //            '1'   => '1',
    //            '2'   => '2',
    //            '3'   => '3',
    //            '4'   => '4+',
    //            '144' => 'c',
    //            '69'  => 'gh',
    //            '48'  => 'z',
    //            '8'   => 'Административное',
    //            '15'  => 'Баня',
    //            '126' => 'Бассейн',
    //            '141' => 'Без ремонта',
    //            '140' => 'Без фундамента',
    //            '135' => 'Берег водоёма',
    //            '10'  => 'Беседка',
    //            '18'  => 'Бескобетонная черепица',
    //            '51'  => 'Бесплатная',
    //            '31'  => 'Бетон',
    //            '80'  => 'Более года',
    //            '16'  => 'Ванная',
    //            '131' => 'Вид постройки',
    //            '25'  => 'Видеонаблюдение',
    //            '139' => 'Винный погреб',
    //            '137' => 'Водопровод',
    //            '114' => 'Водопровод и канализация',
    //            '13'  => 'Возможен',
    //            '101' => 'Возможность проводки',
    //            '127' => 'Временная',
    //            '26'  => 'Выбрать место на карте',
    //            '64'  => 'Высококачественная отделка',
    //            '54'  => 'Газ',
    //            '55'  => 'Газосиликатные блоки',
    //            '52'  => 'Гаражный комплекс',
    //            '145' => 'Год',
    //            '146' => 'Год постройки\окончания строительства',
    //            '60'  => 'Гостевой дом',
    //            '71'  => 'Гостиная',
    //            '23'  => 'Грузовой',
    //            '147' => 'Да',
    //            '37'  => 'День',
    //            '142' => 'Дерево',
    //            '100' => 'Детская',
    //            '99'  => 'Детская площадка',
    //            '66'  => 'Домофон',
    //            '91'  => 'Другое',
    //            '42'  => 'Дуплекс',
    //            '47'  => 'Есть',
    //            '67'  => 'Железо',
    //            '105' => 'Железобетон',
    //            '32'  => 'Железобетонные панели',
    //            '108' => 'Жилое',
    //            '136' => 'Заболоченный',
    //            '59'  => 'Земли под размещение промышленных и коммерческих объектов',
    //            '122' => 'Камень',
    //            '19'  => 'Кирпич',
    //            '56'  => 'Клееный брус',
    //            '143' => 'Кованая ограда',
    //            '87'  => 'Кол-во кВт',
    //            '86'  => 'Количество',
    //            '128' => 'Количество киловат',
    //            '111' => 'Комнаты',
    //            '30'  => 'Консьерж',
    //            '35'  => 'Коттедж',
    //            '68'  => 'Кухня',
    //            '24'  => 'Лафет',
    //            '109' => 'Ленточный',
    //            '50'  => 'Лесные деревья',
    //            '74'  => 'Максимум',
    //            '34'  => 'Медь',
    //            '79'  => 'Месяц',
    //            '75'  => 'Металлические прутья',
    //            '76'  => 'Металлочерепица',
    //            '77'  => 'Минимум',
    //            '81'  => 'Многоуровневый паркинг',
    //            '78'  => 'Монолит',
    //            '120' => 'Монолитная плита',
    //            '82'  => 'Муниципальная',
    //            '89'  => 'На склоне',
    //            '12'  => 'Наличие санузлов',
    //            '41'  => 'Не важно',
    //            '85'  => 'Невозможен',
    //            '138' => 'Неделя',
    //            '33'  => 'Незавершенное строительство',
    //            '65'  => 'Незавершенный ремонт',
    //            '133' => 'Неровный',
    //            '84'  => 'Нет',
    //            '83'  => 'Новостройка',
    //            '134' => 'Обычная отделка',
    //            '103' => 'Овраг',
    //            '36'  => 'Округ',
    //            '88'  => 'Ондулин',
    //            '90'  => 'Опен спэйс',
    //            '39'  => 'Описание',
    //            '63'  => 'Отопление',
    //            '5'   => 'Отсутствует',
    //            '115' => 'Охрана',
    //            '112' => 'Оцилиндрованное бревно',
    //            '95'  => 'Пассажирский',
    //            '96'  => 'Пеноблок',
    //            '113' => 'Пескобетонная черепица',
    //            '97'  => 'Планируется',
    //            '98'  => 'Пластик',
    //            '94'  => 'Платная',
    //            '132' => 'Подземная парковка',
    //            '61'  => 'Полгода',
    //            '7'   => 'Придомовой гараж',
    //            '11'  => 'Прилагается',
    //            '62'  => 'Прихожая',
    //            '102' => 'Профилированный брус',
    //            '38'  => 'Профнастил',
    //            '44'  => 'Пустая',
    //            '124' => 'Рабочий кабинет',
    //            '116' => 'Раздельный',
    //            '104' => 'Район',
    //            '72'  => 'Расположение',
    //            '110' => 'Река',
    //            '22'  => 'Риэлтором',
    //            '119' => 'Ровный',
    //            '121' => 'Родник',
    //            '58'  => 'Ростверк',
    //            '27'  => 'Рубленое дерево',
    //            '53'  => 'Садовые деревья',
    //            '14'  => 'Сарай',
    //            '9'   => 'Сельскохозяйственные земли',
    //            '117' => 'Сигнализация',
    //            '21'  => 'Собственником',
    //            '93'  => 'Собственность более 5 лет',
    //            '92'  => 'Собственность менее 5 лет',
    //            '29'  => 'Совмещенный',
    //            '123' => 'Солома',
    //            '17'  => 'Спальня',
    //            '40'  => 'Столовая',
    //            '73'  => 'Сторожка',
    //            '130' => 'Таунхаус',
    //            '20'  => 'Тип здания',
    //            '6'   => 'Точный адрес',
    //            '106' => 'Требуется косметический ремонт',
    //            '107' => 'Требуется ремонт',
    //            '45'  => 'Укомплектованная',
    //            '70'  => 'Участок с подрядом',
    //            '49'  => 'Фахверк',
    //            '57'  => 'Хорошая отделка',
    //            '129' => 'Черепица',
    //            '125' => 'Шведская плита',
    //            '118' => 'Шифер',
    //            '28'  => 'Шлакоблоки',
    //            '46'  => 'Эксклюзивного качества',
    //        ];
    //
    //        // Цифровые элементы
    //        $integer_elements = [
    //            'id_news',
    //            'user_id',
    //            'common',
    //            'resedential',
    //            'not_residential',
    //            'bathroom_number',
    //            'balcony',
    //            'ceiling_height',
    //            'distance_from_metro',
    //            'distance_from_mkad_or_metro',
    //            'floor',
    //            'not_residentia',
    //            'number_of_floors',
    //            'number_of_rooms',
    //            'price',
    //            'the_number_of_kilowatt',
    //            'year_of_construction',
    //            'time_walk',
    //        ];
    //        //Присваивание значениям опций - перевода
    //        foreach ($new_data as $key => $val) {
    //            if (is_int($val) && !in_array($key, $integer_elements)) {
    //                if (isset($options[$val])) {
    //                    $new_data[$key] = $options[$val];
    //                } else {
    //                    if ($key = 'metro_station') {
    //                        //Станции метро
    //                        $sql = "SELECT metro_id, metro_name, line_id "
    //                            . "FROM metro_stations "
    //                            . "WHERE working = 1 AND metro_id =" . (int)$val;
    //                        $stmt = $this->db->prepare($sql);
    //                        if (!$stmt->execute()){
    //                            $this->error(self::DB_SELECT_ERROR);
    //                        }
    //                        $metro_stations = $stmt->fetch(PDO::FETCH_ASSOC);
    //
    //                        $new_data[$key] = $metro_stations['metro_name'];
    //
    //                    } else {
    //                        $new_data[$key] = '!!! неизвестная опция  = ' . $val;
    //                    }
    //                }
    //
    //            }
    //        }
    //
    //        //Присваивание заголовков
    //        foreach ($new_data as $key => $val) {
    //            if (!empty($header[$key])) {
    //                $new_data[$key . '_h'] = $header[$key];
    //            }
    //        }
    //
    //        return $new_data;
    //    }


    /**
     * @param array $data
     * @param int $space_type
     * @param int $operation_type
     * @param int $object_type
     *
     * @return array
     */
    public function getPathOfNewsForm($data, $space_type = 0, $operation_type = 0, $object_type = 0)
    {
        if (!empty($space_type) || !empty($operation_type) || !empty($object_type)) {
            $data['space_type'] = $space_type;
            $data['operation_type'] = $operation_type;
            $data['object_type'] = $object_type;
        }
        $data['form_name'] = $data['space_type'] . '_' . $data['operation_type'] . '_' . $data['object_type'];
        $data['form_path'] = 'app/views/news/' . $data['form_name'] . '.php';

        return $data;
    }

    /**
     * Получение сообщений
     *
     * @param $data
     *
     * @return mixed
     */
    public function getNewsMessageAndError($data)
    {
        $data['message'] = $this->getUserError('news_message');
        $data['error'] = $this->getUserError('news_error');

        return $data;
    }

    /**
     * Список объявлений
     *
     * @param int $page - страница новостей
     *
     * @return array - выборка всех данных новостей в виде массива
     */
    public function getNewsList($space_type = 0, $operation_type = 0, $object_type = 0, $max_number = 0, $offset = 0)
    {
        $data = [];

        $sql = "SELECT id_news, to_char(date,'YYYY-MM-DD HH24:MI:SS') as date, title, space_type, operation_type, object_type, content, user_id, "
            . "preview_img, status, metro_station, rating_views, rating_admin, rating_donate, (rating_views + rating_admin+rating_donate) as rating_real "
            . "FROM news_base WHERE (status = 1) ";

        if ($space_type != 0) {
            $sql .= "AND (space_type = :space_type) ";
        }
        if ($operation_type != 0) {
            $sql .= "AND (operation_type = :operation_type) ";
        }
        if ($object_type != 0) {
            $sql .= "AND (object_type = :object_type) ";
        }

        $sql .= " ORDER BY date DESC LIMIT :max_number";
        if ($offset != 0) {
            $sql .= " OFFSET " . $offset;
        }

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':max_number', $max_number);

        if ($space_type != 0) {
            $stmt->bindParam(':space_type', $space_type);
        }
        if ($operation_type != 0) {
            $stmt->bindParam(':operation_type', $operation_type);
        }
        if ($object_type != 0) {
            $stmt->bindParam(':object_type', $object_type);
        }
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR, $stmt->errorInfo());
        }
        $data['news'] = $stmt->fetchAll();

        // Подкотовка данных для вывода
        $data['news'] = $this->prepareNewsPreview($data['news']);

        return $data;
    }

    /**
     * Массив новостей => картинки из стоки записываются в массив
     *
     * @param $data_news - массив новостей
     *
     * @return mixed - исправленный массив новостей
     */
    private function getAdsPhotos($data_news)
    {
        $ad_id = [];
        $photo = [];
        if (!empty($data_news)) {
            //Массив id объявлений
            foreach ($data_news as $k => $ad) {
                $ad_id[$k] = $ad['id_news'];
            }
            $ad_id = implode(', ', $ad_id);
            //Получение адресов картинок из БД
            $sql = "SELECT id, original, s_250_140, s_500_280, s_360_230, s_720_460, ad_id"
                . " FROM ads_images"
                . " WHERE ad_id IN ($ad_id)";
            $stmt = $this->db->prepare($sql);
            if (!$stmt->execute()) {
                $this->error(self::DB_EXECUTE_ERROR);
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                foreach ($result as $p) {
                    $ad_id = $p['ad_id'];
                    unset($p['ad_id']);
                    if (!isset($photo[$ad_id])) {
                        $photo[$ad_id] = [];
                    }
                    array_push($photo[$ad_id], $p);
                }
                //Присваивание данных обратно в массив объявлений
                foreach ($data_news as $k => $ad) {
                    if (isset($photo[$ad['id_news']])) {
                        $data_news[$k]['photos'] = $photo[$ad['id_news']];
                    }
                }
            }
        }

        return $data_news;
    }


    /**
     * Получает список новостей из заданной табицы($table) или из всех таблиц новостей(по умолчанию)
     * отсортированный по дате
     *
     * @param null $user_id
     *
     * @return array|bool
     */
    public function getMyNewsList($user_id = null)
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
            if (!$stmt->execute()) {
                $this->error(self::DB_EXECUTE_ERROR);
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // преобразуем категории в слова
            foreach ($result as &$news) {
                $news['space_type'] = $this->translateIndex($news['space_type'], 'space_type');
                $news['operation_type'] = $this->translateIndex($news['operation_type'], 'operation_type');
                $news['object_type'] = $this->translateIndex($news['object_type'], 'object_type');
            }
        } else {
            return false;
        }
        //преобразование картинок в массив
        $result = $this->getAdsPhotos($result);

        return $result;
    }

    //    /**
    //     * Установка сессии для редактирования картинок
    //     * @param $news_to_edit
    //     */
    //    public function setSessionForEditor($news_to_edit = [])
    //    {
    //        if (empty($news_to_edit)) {
    //            // Удаление сессии запоминания картинки
    //            $_SESSION['preview_img'] = [];
    //        } else {
    //            //Запись имен картинок в базе, для перезаписи картинок при Update
    //            $_SESSION['preview_img'] = $news_to_edit["preview_img"];
    //        }
    //    }

    /**
     * Получение и обработка данных из форм редактора объявлений
     *
     * @param $preview_img
     *
     * @return bool
     */
    public function getFormDataFromPOST($preview_img)
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

        static $args = [
            'address'                          => FILTER_SANITIZE_STRING,
            'alcove'                           => FILTER_VALIDATE_BOOLEAN,
            'area'                             => FILTER_SANITIZE_STRING,
            'availability_of_garbage_chute'    => FILTER_VALIDATE_BOOLEAN,
            'balcony'                          => FILTER_SANITIZE_NUMBER_INT,
            'bargain'                          => FILTER_VALIDATE_BOOLEAN,
            'barn'                             => FILTER_VALIDATE_BOOLEAN,
            'bath'                             => FILTER_VALIDATE_BOOLEAN,
            'bathroom'                         => FILTER_VALIDATE_BOOLEAN,
            'bathroom_available'               => FILTER_VALIDATE_BOOLEAN,
            'bedroom'                          => FILTER_VALIDATE_BOOLEAN,
            'building_type'                    => FILTER_SANITIZE_NUMBER_INT,
            'cadastral_number'                 => FILTER_SANITIZE_STRING,
            'cctv'                             => FILTER_VALIDATE_BOOLEAN,
            'ceiling_height'                   => FILTER_SANITIZE_NUMBER_INT,
            'city'                             => FILTER_SANITIZE_STRING,
            'clarification_of_the_object_type' => FILTER_SANITIZE_NUMBER_INT,
            'common'                           => FILTER_SANITIZE_NUMBER_INT,
            'concierge'                        => FILTER_VALIDATE_BOOLEAN,
            'content'                          => FILTER_SANITIZE_STRING,
            'country'                          => FILTER_SANITIZE_STRING,
            'dining_room'                      => FILTER_VALIDATE_BOOLEAN,
            'distance_from_metro'              => FILTER_SANITIZE_NUMBER_INT,
            'documents_on_tenure'              => FILTER_SANITIZE_STRING,
            'electricity'                      => FILTER_VALIDATE_BOOLEAN,
            'equipment'                        => FILTER_VALIDATE_BOOLEAN,
            'fencing'                          => FILTER_SANITIZE_NUMBER_INT,
            'floor'                            => FILTER_SANITIZE_NUMBER_INT,
            'forest_trees'                     => FILTER_VALIDATE_BOOLEAN,
            'foundation'                       => FILTER_SANITIZE_NUMBER_INT,
            'furnish'                          => FILTER_SANITIZE_NUMBER_INT,
            'garden_trees'                     => FILTER_VALIDATE_BOOLEAN,
            'gas'                              => FILTER_VALIDATE_BOOLEAN,
            'guest_house'                      => FILTER_VALIDATE_BOOLEAN,
            'hallway'                          => FILTER_VALIDATE_BOOLEAN,
            'heating'                          => FILTER_VALIDATE_BOOLEAN,
            'house'                            => FILTER_SANITIZE_STRING,
            'intercom'                         => FILTER_VALIDATE_BOOLEAN,
            'kitchen'                          => FILTER_VALIDATE_BOOLEAN,
            'lavatory'                         => FILTER_SANITIZE_NUMBER_INT,
            'lease'                            => FILTER_SANITIZE_NUMBER_INT,
            'lease_contract'                   => FILTER_SANITIZE_STRING,
            'lift_lifting'                     => FILTER_VALIDATE_BOOLEAN,
            'lift_none'                        => FILTER_VALIDATE_BOOLEAN,
            'lift_passenger'                   => FILTER_VALIDATE_BOOLEAN,
            'living_room'                      => FILTER_VALIDATE_BOOLEAN,
            'lodge'                            => FILTER_VALIDATE_BOOLEAN,
            'metro_station'                    => FILTER_SANITIZE_NUMBER_INT,
            'non_commission'                   => FILTER_VALIDATE_BOOLEAN,
            'not_residential'                  => FILTER_SANITIZE_NUMBER_INT,
            'number_of_floors'                 => FILTER_SANITIZE_NUMBER_INT,
            'number_of_rooms'                  => FILTER_SANITIZE_NUMBER_INT,
            'object_located'                   => FILTER_SANITIZE_NUMBER_INT,
            'object_type'                      => FILTER_SANITIZE_NUMBER_INT,
            'operation_type'                   => FILTER_SANITIZE_NUMBER_INT,
            'parking_garage_complex'           => FILTER_VALIDATE_BOOLEAN,
            'parking_lot_garage'               => FILTER_VALIDATE_BOOLEAN,
            'parking_multilevel'               => FILTER_VALIDATE_BOOLEAN,
            'parking_none'                     => FILTER_VALIDATE_BOOLEAN,
            'parking_underground'              => FILTER_VALIDATE_BOOLEAN,
            'photo_available'                  => FILTER_VALIDATE_BOOLEAN,
            'planning_project'                 => FILTER_SANITIZE_STRING,
            'playground'                       => FILTER_VALIDATE_BOOLEAN,
            'playroom'                         => FILTER_VALIDATE_BOOLEAN,
            'plot_of_ravine'                   => FILTER_VALIDATE_BOOLEAN,
            'plot_on_the_slope'                => FILTER_VALIDATE_BOOLEAN,
            'plot_smooth'                      => FILTER_VALIDATE_BOOLEAN,
            'plot_uneven'                      => FILTER_VALIDATE_BOOLEAN,
            'plot_wetland'                     => FILTER_VALIDATE_BOOLEAN,
            'preview_img'                      => FILTER_SANITIZE_STRING,
            'price'                            => FILTER_SANITIZE_NUMBER_INT,
            'property_documents'               => FILTER_SANITIZE_STRING,
            'rating_admin'                     => FILTER_SANITIZE_NUMBER_INT,
            'rating_donate'                    => FILTER_SANITIZE_NUMBER_INT,
            'rating_views'                     => FILTER_SANITIZE_NUMBER_INT,
            'region'                           => FILTER_SANITIZE_STRING,
            'residential'                      => FILTER_SANITIZE_NUMBER_INT,
            'river'                            => FILTER_VALIDATE_BOOLEAN,
            'roofing'                          => FILTER_SANITIZE_NUMBER_INT,
            'sanitation'                       => FILTER_VALIDATE_BOOLEAN,
            'security'                         => FILTER_VALIDATE_BOOLEAN,
            'signaling'                        => FILTER_VALIDATE_BOOLEAN,
            'space'                            => FILTER_SANITIZE_NUMBER_INT,
            'space_type'                       => FILTER_SANITIZE_NUMBER_INT,
            'spring'                           => FILTER_VALIDATE_BOOLEAN,
            'stairwells_status'                => FILTER_SANITIZE_NUMBER_INT,
            'status'                           => FILTER_SANITIZE_NUMBER_INT,
            'street'                           => FILTER_SANITIZE_STRING,
            'study'                            => FILTER_VALIDATE_BOOLEAN,
            'swimming_pool'                    => FILTER_VALIDATE_BOOLEAN,
            'tags'                             => FILTER_SANITIZE_STRING,
            'three_d_project'                  => FILTER_SANITIZE_STRING,
            'time_car'                         => FILTER_SANITIZE_NUMBER_INT,
            'time_walk'                        => FILTER_SANITIZE_NUMBER_INT,
            'title'                            => FILTER_SANITIZE_STRING,
            'type_of_construction'             => FILTER_SANITIZE_NUMBER_INT,
            'type_of_house'                    => FILTER_SANITIZE_NUMBER_INT,
            'user_id'                          => FILTER_SANITIZE_NUMBER_INT,
            'video'                            => FILTER_SANITIZE_STRING,
            'wall_material'                    => FILTER_SANITIZE_NUMBER_INT,
            'water_pipes'                      => FILTER_VALIDATE_BOOLEAN,
            'waterfront'                       => FILTER_VALIDATE_BOOLEAN,
            'wine_vault'                       => FILTER_VALIDATE_BOOLEAN,
            'year_of_construction'             => FILTER_SANITIZE_NUMBER_INT,
        ];

        $new_form_data = filter_input_array(INPUT_POST, $args);
        $new_form_data['user_id'] = $user_id;

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

        // записываем строку с адресами картинок для добавления в БД в конец массива (т.к. это записывается в базовую таблицу)
        if (!empty($preview_img)) {
            $form_data['preview_img'] = $preview_img;
            $form_data['photo_available'] = 'true';
        } else {
            $form_data['preview_img'] = null;
            $form_data['photo_available'] = 'false';
        }

        return $form_data;
    }


    /**
     * Запись объявлений
     *
     * @param $form_data
     */
    public function makeNewsInsert($form_data, $photos)
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
        $sql = $sql . ') RETURNING id_news';
        $stmt = $this->db->prepare($sql);

        //bindParam
        foreach ($form_data as $key => $val) {
            $p = ':' . $key;
            $stmt->bindParam($p, $form_data[$key]);
        }
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR);
        }
        $id_news = $stmt->fetchColumn();
        if ($id_news) {
            //Добавление индекса объявления для фото ads_images
            if (!empty($photos)) {
                if (is_array($photos)) {
                    $photos_list = '';
                    foreach ($photos as $p) {
                        $photos_list .= $p . ', ';
                    }
                    $photos_list = substr($photos_list, 0, -2);
                    $sql = "UPDATE ads_images SET ad_id = '$id_news'"
                        . " WHERE id IN ($photos_list) AND ad_id = 0";
                    $stmt = $this->db->prepare($sql);
                    if ($stmt->execute()) {
                        $this->response = true;
                    } else {
                        $this->error(self::DB_EXECUTE_ERROR);
                    }
                }
            }
        } else {
            $this->error(self::DB_EXECUTE_ERROR);
        }


    }

    /**
     * Внесение исправлений а БД
     *
     * @param $news_to_edit_id
     * @param $form_data
     */
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
        if ($stmt->execute()) {
            $this->response = true;
        } else {
            $this->error(self::DB_EXECUTE_ERROR);
        }
    }

    /**
     * Удаление объявления
     *
     * @param $id
     *
     * @return array
     */
    private function makeNewsDelete($id)
    {
        $message = [];
        //Удаление загруженых картинок новости
        //Получаем имена файлов на удаление
        $sql = "SELECT preview_img FROM news_base WHERE id_news = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR);
        }
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($data['preview_img'])) {
            // разбиваем имена в массив
            $data['preview_img'] = explode('|', $data['preview_img']);
            foreach ($data['preview_img'] as $key => $value) {
                if (file_exists('/uploads/images/' . $value)) {
                    unlink('/uploads/images/' . $value);
                    unlink('/uploads/images/s_' . $value);
                }
            }
        }
        //Удаление из таблицы рейтинга
        $sql = "DELETE FROM news_views WHERE id_news = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR);
        }
        //Удаление объявления
        $sql = "DELETE FROM news_base WHERE id_news = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Добавление сообщения
            $message['news_message'] = 'Удалена новость c id = ' . $id;
        } else {
            $message['news_error'] = 'Новость с id = ' . $id . ' не удалось удалить';

            $this->error(self::DB_EXECUTE_ERROR);

        }

        return $message;
    }

    public function getNewsStatusFromPOST()
    {
        // Массив id объявлений подлежащих изменению
        $news_id_status = [];
        $news_id_rating = [];
        $news_update_id = [];
        $news_delete_id = [];
        foreach ($_POST as $key => $value) {
            if (preg_match('/^change_status_/', $key)) {
                $id_news = substr($key, 14);
                array_push($news_id_status, (int)$id_news);
            }
            if (preg_match('/^change_rating_/', $key)) {
                $id_news = (int)substr($key, 14);
                if (isset($_POST['rating_admin_' . $id_news])) {
                    $rating_admin = (int)$_POST['rating_admin_' . $id_news];
                    $id_news = [
                        'id'           => $id_news,
                        'rating_admin' => $rating_admin,
                    ];
                    array_push($news_id_rating, $id_news);
                }
            }
        }

        // Получение массивов на удаление и изменение статуса
        foreach ($news_id_status as $id_news) {
            if (isset($_POST['status_' . $id_news])) {
                $status = $_POST['status_' . $id_news];
                if ($status == 3) {
                    array_push($news_delete_id, $id_news);
                } else {
                    if ($status == 2) {
                        $status = 0;
                    }
                    $id_news_arr = [
                        'id'     => $id_news,
                        'status' => $status,
                    ];
                    array_push($news_update_id, $id_news_arr);
                }
            }
        }

        return [
            'news_id_rating' => $news_id_rating,
            'news_update_id' => $news_update_id,
            'news_delete_id' => $news_delete_id,
        ];

    }

    /**
     * Внесение изиенений статуса, рейтинга или удаления объявлений
     *
     * @return mixed
     */
    public function makeNewsStatus($news_update_id, $news_delete_id, $news_id_rating)
    {
        $news_message = '';
        $news_error = '';

        //Обработка массива удаления
        foreach ($news_delete_id as $id_news) {
            $delete = $this->makeNewsDelete($id_news);
            if (!empty($delete['news_message'])) {
                $news_message .= $delete['news_message'] . " <br>";
            } else {
                $news_error .= $delete['news_error'] . " <br>";
            }
        }

        foreach ($news_update_id as $id_news) {
            $sql = "UPDATE news_base SET status = :status  WHERE id_news = :id_news";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_news', $id_news['id']);
            $stmt->bindParam(':status', $id_news['status'], PDO::PARAM_INT);
            if ($stmt->execute()) {
                $news_message .= "Изменён статус у новости c id = " . $id_news['id'] . " <br>";
            } else {
                $news_error .= "Статус у новости с id = " . $id_news['id'] . " не удалось изменить <br>";

                $this->error(self::DB_EXECUTE_ERROR);

            }
        }


        //Обработка массива категории Лучшая новость rating_admin
        foreach ($news_id_rating as $id_news) {
            //Изменение category
            $sql = "UPDATE news_base SET rating_admin = :rating_admin  WHERE id_news = :id_news";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_news', $id_news['id']);
            $stmt->bindParam(':rating_admin', $id_news['rating_admin'], PDO::PARAM_INT);
            if ($stmt->execute()) {
                // Добавление сообщения
                $news_message .= "Изменение статуса Лучшее объявление для id = " . $id_news['id'] . "прошло успешно <br>";
            } else {
                $news_error .= "Изменение статуса Лучшее объявление (id = " . $id_news['id'] . ") не удалось <br>";
                $this->error(self::DB_EXECUTE_ERROR);
            }
        }
        //Сообщения
        if ($news_message) {
            $this->setUserError('news_message', $news_message);
        }
        if ($news_error) {
            $this->setUserError('news_error', $news_error);
        }
        //сообщения для Ajax
        $data['news_message'] = $news_message;
        $data['news_error'] = $news_error;
        $data['news_delete_id'] = $news_delete_id;

        return $data;
    }


    /**
     * Лучшие объявления за 24 часа
     *
     * @param int $time - за промежуток времени
     * @param int $space_type - Тип площади
     * @param int $operation_type - Операция
     * @param int $object_type - Тип объекта
     * @param int $city - Город
     * @param int $price_from - Цена от
     * @param int $price_to - Цена до
     * @param int $space_from - Площадь от
     * @param int $space_to - Площадь до
     * @param int $max_number - Количество объявлений
     *
     * @return array -
     * ['best_news'] - arr [0][1]... Данные Лучших объявлений
     *
     */
    public function getBestNewsOfTime(
        $time = 24,
        $space_type = 0,
        $operation_type = 0,
        $object_type = 0,
        $city = 0,
        $price_from = 0,
        $price_to = 0,
        $space_from = 0,
        $space_to = 0,
        $max_number = 9
    )
    {
        $data = [];

        //Заданное время начала поиска ($time - час)
        //Текущая Дата в формате стандарта ISO 8601
        $news_date = $this->dateFormatForDB($time);

        $sql = "SELECT n.id_news, to_char(n.date,'YYYY-MM-DD HH24:MI:SS') as date, n.title,"
            . " n.space_type, n.operation_type, n.object_type, n.city,"
            . " n.content, n.user_id, n.status,  n.price, n.lease, n.space,"
            . " (n.rating_views + n.rating_admin+n.rating_donate) as rating,"
            . " n.number_of_rooms, n.metro_station, n.time_walk, n.time_car, n.lat, n.lng,"
            . " i.original, i.s_250_140, i.s_500_280, i.s_360_230, i.s_720_460, i.ad_id";

        //Включение в запрос поля favorite если это зарегистрированный пользователь
        if(!empty($this->user_id)){
            $sql .=  ", f.ad_id as favorite";
        }

        $sql .=  " FROM news_base n LEFT JOIN (SELECT DISTINCT ON(ad_id) * FROM ads_images) i"
            . " ON (n.id_news = i.ad_id)";

        //Включение в запрос поля favorite если это зарегистрированный пользователь
        if(!empty($this->user_id)){
            $sql .=  " LEFT JOIN favorite_ads f ON (n.id_news = f.ad_id AND f.user_id = ".$this->user_id.")";
        }
        $sql .= " WHERE (n.date >= :date)";

        // Только активные(видимые)
        $sql .= "AND (status = 1) ";

        if ($space_type != 0) {
            $sql .= "AND (space_type = :space_type) ";
        }
        if ($operation_type != 0) {
            $sql .= "AND (operation_type = :operation_type) ";
        }
        if ($object_type != 0) {
            $sql .= "AND (object_type = :object_type) ";
        }
        if ($city != 0) {
            $sql .= "AND (city = :city) ";
        }
        if ($price_from != 0) {
            $sql .= "AND (price >= :price_from) ";
        }
        if ($price_to != 0) {
            $sql .= "AND (price <= :price_to) ";
        }
        if ($space_from != 0) {
            $sql .= "AND (space >= :space_from) ";
        }
        if ($space_to != 0) {
            $sql .= "AND (space <= :space_to) ";
        }

        $sql .= " ORDER BY rating DESC"
            . " LIMIT :max_number";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':date', $news_date);
        $stmt->bindParam(':max_number', $max_number);

        if ($space_type != 0) {
            $stmt->bindParam(':space_type', $space_type);
        }
        if ($operation_type != 0) {
            $stmt->bindParam(':operation_type', $operation_type);
        }
        if ($object_type != 0) {
            $stmt->bindParam(':object_type', $object_type);
        }
        if ($city != 0) {
            $stmt->bindParam(':city', $city);
        }
        if ($price_from != 0) {
            $stmt->bindParam(':price_from', $price_from);
        }
        if ($price_to != 0) {
            $stmt->bindParam(':price_to', $price_to);
        }
        if ($space_from != 0) {
            $stmt->bindParam(':space_from', $space_from);
        }
        if ($space_to != 0) {
            $stmt->bindParam(':space_to', $space_to);
        }

        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR, $stmt->errorInfo());
        }
        $data = $stmt->fetchAll();

        return $data;
    }

    //    /**
    //     * Возвращает строку имен (через '|') больших картинок
    //     * (имя эскиза s_имя больш)
    //     *
    //     * @return mixed|string
    //     */
    //    public function saveNewsPictures()
    //    {
    //        global $news_error;
    //
    //        $blacklistOfFile = array(".php", ".phtml", ".php3", ".php4"); // Запрещенный формат файлов
    //        $imgMaxSize = 3050000; // Максимальный размер картинок в байтах
    //        $return_image_arr = []; //подготовительный массив для сохранения порядка следования
    //        $return_image_names = ''; // Возвращаемая строка имен картинок
    //
    //        if (!empty($_FILES)) {
    //            //Получаем имена полей "image_name_?" ввода картинок переданных POST
    //            $image_name_keys = preg_grep("/^image_name_/", array_keys($_FILES));
    //
    //            //отсееваем и записываем имена уже существующих картинок
    //            foreach ($image_name_keys as $k => $v) {
    //                if (preg_match("/_saved_/", $v)) {
    //                    // определяеи номер (отнимаем 1 т.к. для массива)
    //                    $i = (int)substr($v, 11, 2) - 1;
    //                    // определяем имя файла
    ////                 $f_name =strstr($v, 'news_') ;
    //                    //переделываем 4 знак конца в точку
    ////                 $f_name = substr_repla($f_name, '.', -4, 1);
    //                    // добавляем в подготовельный массив под номером
    //                    $return_image_arr[$i] = $_SESSION['preview_img'][$i];
    //
    //                    //удаляем ссылку на поле ввода, что бы исключить обработку
    //                    unset($image_name_keys[$k]);
    //                }
    //            }
    //
    //            foreach ($image_name_keys as $image_name_key) {
    //
    //                //Генерируем случайное имя картинки
    //                $name_rand = md5(time()) . rand(10, 99); // Базовая часть
    //                $name_big = 'news_' . $name_rand; // Новое имя для большой картинки
    //                $name_small = 's_' . $name_big; // Новое имя для маленькой картинки
    //                // Загрузка картинки в директоритю и получение ссылки на нее
    //                // Проверяем тип файла
    //                // Допустимый формат файлов .jpeg .png .gif
    //                if ($_FILES[$image_name_key]['type'] == 'image/jpeg') {
    //                    $type = '.jpg';
    //                } elseif ($_FILES[$image_name_key]['type'] == 'image/png') {
    //                    $type = '.png';
    //                } elseif ($_FILES[$image_name_key]['type'] == 'image/gif') {
    //                    $type = '.gif';
    //                } else {
    //                    array_push($news_error,
    //                        'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. Можно загружать только картинки с расширением jpeg, png, gif.');
    //                    continue;
    //                }
    //                // Расширения новых имен:
    //                $name_big = $name_big . $type;
    //                $name_small = $name_small . $type;
    //
    //                // Проверка на недопустимые форматы
    //                foreach ($blacklistOfFile as $item) {
    //                    if (preg_match("/$item\$/i",
    //                        $_FILES[$image_name_key]['name'])) {
    //                        array_push($news_error,
    //                            'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. PHP файлы не разрешены для загрузки.');
    //                        continue;
    //                    }
    //                }
    //                // Проверяем размер файла
    //                if ($_FILES[$image_name_key]['size'] > $imgMaxSize) {
    //                    array_push($news_error,
    //                        'Файл:"' . $_FILES[$image_name_key]['name'] . '" не загружен. Слишком большой размер файла картинки.');
    //                    continue;
    //                }
    //
    //                //Изменение размеров и запись
    //                $this->newsPicturesResize($_FILES[$image_name_key], 'big',
    //                    $name_big);
    //                $this->newsPicturesResize($_FILES[$image_name_key], 'small',
    //                    $name_small);
    //
    //                //Запись в подгот. массив под номером ключа соотв. имени
    //                // Определяем номер (отнимаем 1 т.к. для массива)
    //                $i = (int)substr($image_name_key, 11, 2) - 1;
    //
    //                $return_image_arr[$i] = $name_big;
    ////                if (empty($return_image_names)) {
    ////                    $return_image_names = $name_big;
    ////                } else {
    ////                    $return_image_names = $return_image_names . '|' . $name_big;
    ////                }
    //            }
    //
    //            // Получаем строку имен файлов из массива
    //            sort($return_image_arr);
    //            foreach ($return_image_arr as $value) {
    //                if (empty($return_image_names)) {
    //                    $return_image_names = $value;
    //                } else {
    //                    $return_image_names = $return_image_names . '|' . $value;
    //                }
    //            }
    //        }
    //
    //// Удаление всех картинок находящихся в БД, но не переданных на апдейт
    //        if (!empty($_SESSION['preview_img'][0])) {
    //            //Расхождение массива $_SESSION['preview_img'] от $return_image_arr
    //            $img_arr_for_delete = array_diff($_SESSION['preview_img'], $return_image_arr);
    //
    //            foreach ($img_arr_for_delete as $value) {
    //                if (file_exists('uploads/images/' . $value)) {
    //                    unlink('uploads/images/' . $value);
    //                }
    //                if (file_exists('uploads/images/s_' . $value)) {
    //                    unlink('uploads/images/s_' . $value);
    //                }
    //            }
    //        }
    //
    //        return $return_image_names;
    //    }
    //
    //    /**
    //     * Изменение размеров картинки на эскиз ($type = 'small') и нормальные ($type = 'big')
    //     * и сохраниение во временной папке  $tmpPath
    //     * Запись результата в  $imgPath
    //     * @param $file
    //     * @param string $type
    //     * @param $new_name
    //     * @return bool
    //     */
    //    private function newsPicturesResize($file, $type = 'big', $new_name)
    //    {
    //        global $news_error, $tmpPath;
    //
    //        $imgPath = 'uploads/images/'; // Путь к папке загрузки картинок
    //        $tmpPath = 'tmp/'; // Путь к папке временных файлов
    //
    //        $h_max_big_size = 800; //Всота для большой картинки
    //        $h_max_small_size = 200; //Всота для эскиза
    //        $quality = 80; // качество изображения (по умолчанию 80%)
    //        // Создание исходного изображения на основе исходного файла
    //        if ($file['type'] == 'image/jpeg') {
    //            $src = imagecreatefromjpeg($file['tmp_name']);
    //        } elseif ($file['type'] == 'image/png') {
    //            $src = imagecreatefrompng($file['tmp_name']);
    //        } elseif ($file['type'] == 'image/gif') {
    //            $src = imagecreatefromgif($file['tmp_name']);
    //        } else {
    //            return false;
    //        }
    //
    //        //Определение размеров изображения
    //        $w_src = imagesx($src);
    //        $h_src = imagesy($src);
    //
    //        // В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
    //        if ($type == 'small') {
    //            $h_max = $h_max_small_size;
    //        } else {
    //            $h_max = $h_max_big_size;
    //        }
    //        // Если высота больше заданной
    //        if ($h_src > $h_max) {
    //            // Вычисление пропорций
    //            $ratio = $h_src / $h_max;
    //            $w_dest = round($w_src / $ratio);
    //            $h_dest = round($h_src / $ratio);
    //            // Создаём пустую картинку
    //            $dest = imagecreatetruecolor($w_dest, $h_dest);
    //            // Копируем старое изображение в новое с изменением параметров
    //            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest,
    //                $w_src, $h_src);
    //            // Вывод картинки и очистка памяти
    //            $this->picturesSaveAndClear($file, $dest, $new_name, $quality);
    //            imagedestroy($dest);
    //            imagedestroy($src);
    //        } else {
    //            // Вывод картинки и очистка памяти
    //            $this->picturesSaveAndClear($file, $src, $new_name, $quality);
    //            imagedestroy($src);
    //        }
    //
    //        // Загрузка файла и вывод сообщения
    //        if (!@copy($tmpPath . $new_name, $imgPath . $new_name)) {
    //            array_push($news_error, 'Произошла ошибка при загрузке картинки');
    //        }
    //        //Удаляем временный файл
    //        unlink($tmpPath . $new_name);
    //    }


    /**
     * Вывод картинки во временную директорию
     *
     * @param $file
     * @param $dest
     * @param $name
     * @param $quality
     *
     * @return bool
     */
    public function picturesSaveAndClear($file, $dest, $name, $quality)
    {
        global $tmpPath;

        if ($file['type'] == 'image/jpeg') {
            imagejpeg($dest, $tmpPath . $name, $quality);
        } elseif ($file['type'] == 'image/png') {
            imagepng($dest, $tmpPath . $name, $quality);
        } elseif ($file['type'] == 'image/gif') {
            imagegif($dest, $tmpPath . $name, $quality);
        } else {
            return false;
        }
    }

    /**
     * Принимает индекс и имя переменной
     * Возвращает значение соответствующее индексу
     *
     * @param int $index
     * @param string $names_type
     *
     * @return int
     */
    private function translateIndex($index = 0, $names_type = '')
    {
        // Проверочный массив
        static $test_array = [
            'space_type'     => [
                1 => 'Нежилая',
                2 => 'Жилая',
            ],
            'operation_type' => [
                1 => 'Арендовать',
                2 => 'Купить',
            ],
            'object_type'    => [
                1  => 'Квартира',
                2  => 'Офисная площадь',
                3  => 'Торговая площадь',
                4  => 'Офисная площадь с землей',
                5  => 'Производственно-складские здания',
                6  => 'Производственно-складские помещения ',
                7  => 'Рынок/Ярмарка',
                8  => 'Комплекс ОСЗ',
                9  => 'ОСЗ',
                10 => 'Торговое здание',
                11 => 'Комната',
                12 => 'Дом',
                13 => 'Гараж/Машиноместо',
                14 => 'Земельный участок',
            ],
        ];
        // Определение значения
        if (!empty($index) && !empty($names_type)) {
            if (isset($test_array[$names_type][$index])) {
                $index = $test_array[$names_type][$index];
            }
        }

        return $index;
    }

    /**
     * Последние просмотренные объявления
     *
     * @return array
     */
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
            $sql = 'SELECT id_news'
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
            if (!$stmt->execute()) {
                $this->error(self::DB_EXECUTE_ERROR);
            }
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // нахождение фото
            $res = $this->getAdsPhotos($res);
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
     *
     * @return array
     */
    public function checkboxList()
    {
        $all_checkbox_list = [
            'photo_available',
            'gas',
            'heating',
            'water_pipes',
            'elevator_passangers',
            'elevator_cargo',
            'bathroom',
            'dining_room',
            'study',
            'playroom',
            'hallway',
            'living_room',
            'kitchen',
            'bedroom',
            'signaling',
            'cctv',
            'intercom',
            'concierge',
            'availability_of_garbage_chute',
            'bargain',
            'cadastral_number',
            'documents_on_ownership',
            'electricity',
            'fencing',
            'lease_contract',
            'property_documents',
            'security',
        ];

        return $all_checkbox_list;
    }


    /**
     * Возвращает список последних объявлений
     *
     * @param int $time_start - период до начала поиска в часах
     * @param int $time - период до конца поиска в часах
     * @param int $max_numder - количество объявлений
     * @param int $space_type - Тип площади
     * @param int $operation_type - Операция
     * @param int $object_type - Тип объекта
     * @param bool $status - Статус (только Видимые (true))
     * @param var $sorting - Сортировка (имя столбца)
     * @param var $title_like - Строка поиска по названию
     *
     * @return array
     */
    public function getRecentNewsList(
        $time_start = 0,
        $time = 24,
        $max_number = 20,
        $space_type = 0,
        $operation_type = 0,
        $object_type = 0,
        $status = true,
        $sorting = '',
        $title_like = '',
        $offset = 0
    )
    {
        //Заданное время начала поиска ($time - час) в формате стандарта ISO 8601
        $news_date = $this->dateFormatForDB($time);

        //Дата окончания поиска (по умолчанию настоящее время)
        if (!empty($time_start)) {
            $time_start = $this->dateFormatForDB($time_start);
        } else {
            $time_start = 0;
        }


        $sql = "SELECT id_news, to_char(date,'YYYY-MM-DD HH24:MI:SS') as date, title, space_type, operation_type, object_type, content, user_id, "
            . "status, rating_views, rating_admin, rating_donate, (rating_views + rating_admin+rating_donate) as rating_real "
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
        if ($title_like) {
            $title_like = $this->checkingString($title_like);
            $sql .= "AND (title LIKE '%" . $title_like . "%') ";
        }

        if ($sorting) {
            $sorting = $this->checkingString($sorting);
            $sql .= " ORDER BY " . $sorting . " DESC";
        } else {
            $sql .= " ORDER BY date DESC";
        }

        $sql .= " LIMIT :max_number";
        if ($offset != 0) {
            $sql .= " OFFSET " . $offset;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':date', $news_date);
        if ($time_start != 0) {
            $stmt->bindParam(':date_start', $time_start);
        }
        $stmt->bindParam(':max_number', $max_number);

        if ($space_type != 0) {
            $stmt->bindParam(':space_type', $space_type);
        }
        if ($operation_type != 0) {
            $stmt->bindParam(':operation_type', $operation_type);
        }
        if ($object_type != 0) {
            $stmt->bindParam(':object_type', $object_type);
        }
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR);
        }
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Подкотовка данных для вывода
        $data = $this->prepareNewsPreview($data);

        return $data;
    }

    /**
     * Подкотовка данных для вывода превью объявлений
     *
     * @param $data - исходные данные объявлений из БД в виде arr[[0]=>arr, [1]=>arr...]
     * @param bool $translate_indx - нужно ли переводить индексы
     * @param bool $author_info - нужна ли информация об авторе
     *
     * @return mixed - преобразованные данные
     * Добавляет параметр ad_is_new - является ли объявление новым (bool)
     * Добавляет данные об авторе
     */
    public function prepareNewsPreview($data, $translate_indx = true, $author_info = false, $photos = true)
    {
        if(empty($data)) {
            $this->response['items'] = [];
            return;
        }
        $user_id_arr = [];

        //Получение массив ссылок на картинки $data['news'][number]['photos'][]
        if($photos){
            $data = $this->getAdsPhotos($data);
        }

        // Данные индекс города -> город
        $city = [];
        $sql = "SELECT id, city FROM city";
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute()) {
            $this->error(self::DB_SELECT_ERROR);
        }
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $c) {
            $city[$c['id']] = $c["city"];
        }

        foreach ($data as $key => $value) {
            // Получение имен категорий
            if ($translate_indx) {
                $data[$key]['space_type'] = $this->translateIndex($data[$key]['space_type'], 'space_type');
                $data[$key]['operation_type'] = $this->translateIndex($data[$key]['operation_type'], 'operation_type');
                $data[$key]['object_type'] = $this->translateIndex($data[$key]['object_type'], 'object_type');
            }
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

            //Приведение favorite к 1 или 0
            !empty($data[$key]['favorite']) ? $data[$key]['favorite'] = 1 : $data[$key]['favorite'] = 0;

            //Перевод индекса города в наименование
            if (!empty($data[$key]['city'])) {
                $data[$key]['city'] = $city[$data[$key]['city']];
            } else {
              //  $this->error(self::CITY_INCORRECT_CODE_ERROR);
            }

            //Определение, является ли объявление новым (дата в формате 'YYYY-MM-DD HH24:MI:SS')
            if (!empty($data[$key]['date'])) {
                $data[$key]['ad_is_new'] = $this->checkAdsIsNew($data[$key]['date']);
            } else {
                $this->error(self::DATE_INCORRECT_ERROR);
            }

            //Массив id авторов
            if (!empty($data[$key]['user_id']) && $author_info) {
                $user_id_arr[$key] = $data[$key]['user_id'];
            }
        }
        //Получение данных об авторах объявлений
        if ($author_info) {
            $author_arr = $this->getAuthorInfo($user_id_arr);

            //Присваивание данных
            foreach ($data as $key => $val) {
                if (!empty($author_arr[$data[$key]["user_id"]])) {
                    $data[$key] = $data[$key] + $author_arr[$data[$key]["user_id"]];
                }
            }
        }
        //Перевод станций метро
        $data = $this->translateMetroStations($data);
        $this->response['items'] = $data;
    }

    /**
     * Возвращает массив параметров автора объявления
     *
     * @param $user_id_arr - массив id авторов (может быть послано просто (str) id)
     *
     * @return array - Массив с параметрами автора, и ключами = его id
     */
    private function getAuthorInfo($user_id_arr)
    {
        $author_arr = [];
        if (!is_array($user_id_arr)) {
            $user_id_arr = [$user_id_arr];
        }
        $user_id_arr_txt = implode(',', $user_id_arr);
        $sql = "SELECT id, first_name, last_name, patronymic, profile_foto_id"
            . " FROM users WHERE id IN($user_id_arr_txt)";
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR, $stmt->errorInfo());
        }
        $author_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($author_result as $val) {
            $author_arr[$val['id']] = $val;
            unset($author_arr[$val['id']]['id']);
        }

        return $author_arr;
    }

    /**
     * @param $message
     */
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
        $msg = new AMQPMessage($message, ['delivery_mode' => 2]);
        //$msg - (сообщение, обмен, ключ очереди)
        //$channel->basic_publish($msg, 'ex_newNews');
        $channel->basic_publish($msg, '', 'newNews');

        $channel->close();
        $connection->close();
        return;
    }

    /**
     * @return array
     */
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

    public function prepareBestNewsOfTime($data)
    {

        foreach ($data['best_news'] as $i => $news) {
            // Краткая пометка на картинке
            $data['best_news'][$i]['short_explanation'] = '';
            if (!empty($news['number_of_rooms'])) {
                $data['best_news'][$i]['short_explanation'] .= $news["number_of_rooms"] . '-комн. ';
            }
            switch ($news["object_type"]) {
                case 1:
                    $data['best_news'][$i]['short_explanation'] .= 'кв.';
                    break;
                case 2:
                    $data['best_news'][$i]['short_explanation'] .= 'оф.пл.';
                    break;
                case 3:
                    $data['best_news'][$i]['short_explanation'] .= 'торг.пл.';
                    break;
                case 4:
                    $data['best_news'][$i]['short_explanation'] .= 'оф.пл. с землей';
                    break;
                case 5:
                    $data['best_news'][$i]['short_explanation'] .= 'пр/скл зд.';
                    break;
                case 6:
                    $data['best_news'][$i]['short_explanation'] .= 'пр/скл пом. ';
                    break;
                case 7:
                    $data['best_news'][$i]['short_explanation'] .= 'рынок';
                    break;
                case 8:
                    $data['best_news'][$i]['short_explanation'] .= 'к. ОСЗ';
                    break;
                case 9:
                    $data['best_news'][$i]['short_explanation'] .= 'ОСЗ';
                    break;
                case 10:
                    $data['best_news'][$i]['short_explanation'] .= 'торг. зд.';
                    break;
                case 11:
                    $data['best_news'][$i]['short_explanation'] .= 'комн.';
                    break;
                case 12:
                    $data['best_news'][$i]['short_explanation'] .= 'дом';
                    break;
                case 13:
                    $data['best_news'][$i]['short_explanation'] .= 'гараж';
                    break;
                case 14:
                    $data['best_news'][$i]['short_explanation'] .= 'з/у';
                    break;
                default:
                    $data['best_news'][$i]['short_explanation'] .= 'объект';
                    break;
            }

            $data['best_news'][$i]['short_explanation'] .= ' ';
            if (!empty($news["space"])) {
                $data['best_news'][$i]['short_explanation'] .= $news["space"] . ' м<sup>2</sup> ';
            }
            // Перевод - период
            switch ($news["lease"]) {
                case 37:
                    $data['best_news'][$i]["lease"] .= 'день';
                    break;
                case 138:
                    $data['best_news'][$i]["lease"] .= 'нед.';
                    break;
                case 79:
                    $data['best_news'][$i]["lease"] .= 'мес.';
                    break;
                case 145:
                    $data['best_news'][$i]["lease"] .= 'год';
                    break;
                case 80:
                    $data['best_news'][$i]["lease"] .= 'неск. лет';
                    break;
                default:
                    $data['best_news'][$i]["lease"] .= 'пер.';
                    break;
            }

        }
        // Надпись Смотреть еще
        if (!empty($data['best_news_number'])) {
            $data['best_news_number_ending'] = $this->getNumEnding($data['best_news_number'],
                ['объявление', 'объявления', 'объявлений']);
        }

        return $data;
    }


    /**
     * @param $data
     */
    public function renderAdminNews($data)
    {
        ?>

        <?php for ($i = 0; (!empty($data['news'][$i])); $i++) { ?>
        <tr align="center"
            class="status_frm_data id_<?php echo $data['news'][$i]['id_news']; ?>">
            <td>
                <i> <?php echo $data['news'][$i]['id_news']; ?></i>
            </td>
            <td>
                <i> <?php echo $data['news'][$i]['date']; ?></i>
            </td>
            <td>
                <a href="/news/editor/<?php echo $data['news'][$i]['id_news'];
                ?>"><?php echo $data['news'][$i]['title']; ?> </a>
            </td>
            <td> <?php echo $data['news'][$i]['user_id']; ?> </td>
            <td><?php echo $data['news'][$i]['space_type']; ?></td>
            <td><?php echo $data['news'][$i]['operation_type']; ?></td>
            <td><?php echo $data['news'][$i]['object_type']; ?></td>
            <td>
                <input type="radio"
                       class="status"
                       name="status_<?php echo $data['news'][$i]['id_news']; ?>"
                       value="1" <?php
                if ($data['news'][$i]['status'] === 1) {
                    echo "checked";
                }
                ?> >
            </td>
            <td>
                <input type="radio"
                       class="status"
                       name="status_<?php echo $data['news'][$i]['id_news']; ?>"
                       value="0" <?php
                if ($data['news'][$i]['status'] === 0) {
                    echo "checked";
                }
                ?> >
            </td>
            <td> <?php echo $data['news'][$i]['rating_views']; ?> </td>
            <td>
                <select class="rating_admin"
                        name="rating_admin_<?php echo $data['news'][$i]['id_news']; ?>">
                    <?php
                    for ($j = 0; $j < 10; $j++) {
                        ?>
                        <option value="<?php echo $j; ?>" <?php
                        if ($data['news'][$i]['rating_admin'] == $j) {
                            echo "selected";
                        }
                        ?>><?php echo $j; ?></option> <?php
                    }
                    ?>
                </select>
            </td>
            <td> <?php echo $data['news'][$i]['rating_donate']; ?> </td>
            <td> <?php echo $data['news'][$i]['rating_real']; ?> </td>
            <td>
                <input type="radio"
                       class="status"
                       name="status_<?php echo $data['news'][$i]['id_news']; ?>"
                       value="3">
            </td>
        </tr>
    <?php } ?>

        <?php
    }

    /**
     * Функция возвращает окончание для множественного числа слова на основании числа и массива окончаний
     *
     * @param $number Integer Число на основе которого нужно сформировать окончание
     * @param $endingArray Array Массив слов или окончаний для чисел (1, 4, 5),
     *         например array('яблоко', 'яблока', 'яблок')
     *
     * @return String
     */
    public function getNumEnding($number, $endingArray)
    {
        $number = $number % 100;
        if ($number >= 11 && $number <= 19) {
            $ending = $endingArray[2];
        } else {
            $i = $number % 10;
            switch ($i) {
                case (1):
                    $ending = $endingArray[0];
                    break;
                case (2):
                case (3):
                case (4):
                    $ending = $endingArray[1];
                    break;
                default:
                    $ending = $endingArray[2];
            }
        }

        return $ending;
    }

    /**
     * ! Меню бэкенда
     */
    public function renderNewsEditorMenu()
    {
        $form_options = [];
        $form_options['space_types'] = [1 => 'Нежилая', 2 => 'Жилая',];
        $form_options['operation_types'] = [1 => 'Арендовать', 2 => 'Купить',];
        $form_options['object_types'] = [
            1  => 'Квартира',
            2  => 'Офисная площадь',
            3  => 'Торговая площадь',
            4  => 'Офисная площадь с землей',
            5  => 'Производственно-складские здания',
            6  => 'Производственно-складские помещения ',
            7  => 'Рынок/Ярмарка',
            8  => 'Комплекс ОСЗ',
            9  => 'ОСЗ',
            10 => 'Торговое здание',
            11 => 'Комната',
            12 => 'Дом',
            13 => 'Гараж/Машиноместо',
            14 => 'Земельный участок',
        ];
        ?>

        <form id="add_news"
              action="/news/editor"
              method="post">
            <legend>
                Выбор
                категории
                для
                создания
                нового
                объявления
            </legend>
            <label for="space_type">Тип
                площади:</label>
            <select name="space_type"
                    id="space_type">
                <?php foreach ($form_options['space_types'] as $k => $options) { ?>
                    <option value="<?php echo $k; ?>">
                        <?php echo $options; ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <label for="operation_type">Операция:</label>
            <select name="operation_type"
                    id="operation_type">
                <?php foreach ($form_options['operation_types'] as $k => $options) { ?>
                    <option value="<?php echo $k; ?>">
                        <?php echo $options; ?>
                    </option>
                <?php } ?>
            </select>
            <br>
            <label for="object_type">Тип
                объекта:</label>
            <select name="object_type"
                    id="object_type">
                <?php foreach ($form_options['object_types'] as $k => $options) { ?>
                    <option value="<?php echo $k; ?>">
                        <?php echo $options; ?>
                    </option>
                <?php } ?>
            </select>

            <input type="submit"
                   name="submit_add_news"
                   value="Добавить новость">
        </form>
        <script type="text/javascript"
                src="/template/js/news.editor.menu.js"></script>
        <?php
    }

    /**
     * ! Для форм бэкенда
     * @param int $metro_id
     */
    public function renderMetroSelect($metro_id = 0)
    {
        $sql = "SELECT metro_id, metro_name, line_id "
            . "FROM metro_stations ";
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR);
        }
        $metro_stations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql = "SELECT line_id, line_number, line_name "
            . "FROM metro_line ";
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR);
        }
        $line_arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $line = [];
        foreach ($line_arr as $k => $v) {
            $line[$v['line_id']] = $v;
        }

        ?>
        <label for="metro_station">Станция
            метро</label>
        <br>
        <select name="metro_station"
                id="metro_station">
            <?php foreach ($metro_stations as $k => $metro) { ?>
                <option value="<?php echo $metro['metro_id']; ?>" <?php
                if ($metro_id == $metro['metro_id']) {
                    echo ' selected ';
                } ?>>
                    <?php echo $metro['metro_name'] . ' - (' . $line[$metro['line_id']]['line_name']
                        . ' линия [' . $line[$metro['line_id']]['line_number'] . ']) '; ?>
                </option>
            <?php } ?>
        </select>
    <?php }

    public function getResponse()
    {
        if (empty($this->errors) && empty($this->response)) {
            return [
                'error' => [
                    [
                        'code'    => 0,
                        'message' => 'Неправильный запрос',
                    ],
                ],
            ];
        }

        if ($this->errors) {
            return [
                'error' => $this->errors,
            ];
        } else {
            return [
                'response' => $this->response,
            ];
        }
    }

    /**
     * Возврвщает массив запроса из POST и param
     *
     * @param array $post
     * @param array $param
     *
     * @return array
     */
    public function getRequestForAds($post, $param = [])
    {
        $request = [];
        $request_param_int = [
            'space_type',
            'operation_type',
            'object_type',
            'time_from',
            'time_to',
            'price_from',
            'price_to',
            'space_from',
            'space_to',
            'city',
            'status',
            'count',
            'offset',
        ];
        $request_param_str = [
            'title_like',
        ];
        if (!empty($post)) {
            foreach ($request_param_int as $name) {
                if (isset($post[$name])) {
                    $request[$name] = (int)$post[$name];
                } else {
                    $request[$name] = 0;
                }
            }
            foreach ($request_param_str as $name) {
                if (isset($post[$name])) {
                    $request[$name] = $this->checkingString($post[$name]);
                } else {
                    $request[$name] = '';
                }
            }
        }

        if (isset($param[0])) {
            // Определение времени в часах для лучших новостей на главной
            if (preg_match("/best_of_/", $param[0])) {
                $time_name = substr($param[0], 8);
                switch ($time_name) {
                    case 'day':
                        $request['time_from'] = 24;
                        break;
                    case 'week':
                        $request['time_from'] = 168;
                        break;
                    case 'month':
                        $request['time_from'] = 720;
                        break;
                    default:
                        $request['time_from'] = 24;
                }
            }
        }

        return $request;
    }

    public function getRequestForItemsAddFromPOST($keys)
    {
        $form_data = [];
        $args = [];
        $photos = [];
        $post = [];

        //Преведение $_POST - разбиение массивов
        foreach ($_POST as $name => $value) {
            if (is_array($value) && ($name != 'photos')) {
                foreach ($value as $k => $i) {
                    $post[$name . '_' . $i] = 'true';
                }
            } else {
                $post[$name] = $value;
            }
        }

        //Определение пользователя
        if (!empty($_SESSION['userID'])) {
            $user_id = (int)$_SESSION['userID'];
        } else {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);

            return false;
        }
        $form_data['user_id'] = $user_id;

        $args_db = [
            'address'                          => FILTER_SANITIZE_STRING,
            'alcove'                           => FILTER_VALIDATE_BOOLEAN,
            'area'                             => FILTER_SANITIZE_STRING,
            'availability_of_garbage_chute'    => FILTER_VALIDATE_BOOLEAN,
            'balcony'                          => FILTER_SANITIZE_NUMBER_INT,
            'bargain'                          => FILTER_VALIDATE_BOOLEAN,
            'barn'                             => FILTER_VALIDATE_BOOLEAN,
            'bath'                             => FILTER_VALIDATE_BOOLEAN,
            'bathroom'                         => FILTER_VALIDATE_BOOLEAN,
            'bathroom_available'               => FILTER_VALIDATE_BOOLEAN,
            'bedroom'                          => FILTER_VALIDATE_BOOLEAN,
            'building_type'                    => FILTER_SANITIZE_NUMBER_INT,
            'cadastral_number'                 => FILTER_SANITIZE_STRING,
            'cctv'                             => FILTER_VALIDATE_BOOLEAN,
            'ceiling_height'                   => FILTER_SANITIZE_NUMBER_INT,
            'city'                             => FILTER_SANITIZE_STRING,
            'clarification_of_the_object_type' => FILTER_SANITIZE_NUMBER_INT,
            'common'                           => FILTER_SANITIZE_NUMBER_INT,
            'concierge'                        => FILTER_VALIDATE_BOOLEAN,
            'content'                          => FILTER_SANITIZE_STRING,
            'country'                          => FILTER_SANITIZE_STRING,
            'dining_room'                      => FILTER_VALIDATE_BOOLEAN,
            'distance_from_metro'              => FILTER_SANITIZE_NUMBER_INT,
            'documents_on_tenure'              => FILTER_SANITIZE_STRING,
            'electricity'                      => FILTER_VALIDATE_BOOLEAN,
            'equipment'                        => FILTER_VALIDATE_BOOLEAN,
            'fencing'                          => FILTER_SANITIZE_NUMBER_INT,
            'floor'                            => FILTER_SANITIZE_NUMBER_INT,
            'forest_trees'                     => FILTER_VALIDATE_BOOLEAN,
            'foundation'                       => FILTER_SANITIZE_NUMBER_INT,
            'furnish'                          => FILTER_SANITIZE_NUMBER_INT,
            'garden_trees'                     => FILTER_VALIDATE_BOOLEAN,
            'gas'                              => FILTER_VALIDATE_BOOLEAN,
            'guest_house'                      => FILTER_VALIDATE_BOOLEAN,
            'hallway'                          => FILTER_VALIDATE_BOOLEAN,
            'heating'                          => FILTER_VALIDATE_BOOLEAN,
            'house'                            => FILTER_SANITIZE_STRING,
            'intercom'                         => FILTER_VALIDATE_BOOLEAN,
            'kitchen'                          => FILTER_VALIDATE_BOOLEAN,
            'lavatory'                         => FILTER_SANITIZE_NUMBER_INT,
            'lease'                            => FILTER_SANITIZE_NUMBER_INT,
            'lease_contract'                   => FILTER_SANITIZE_STRING,
            'lift_lifting'                     => FILTER_VALIDATE_BOOLEAN,
            'lift_none'                        => FILTER_VALIDATE_BOOLEAN,
            'lift_passenger'                   => FILTER_VALIDATE_BOOLEAN,
            'living_room'                      => FILTER_VALIDATE_BOOLEAN,
            'lodge'                            => FILTER_VALIDATE_BOOLEAN,
            'metro_station'                    => FILTER_SANITIZE_NUMBER_INT,
            'non_commission'                   => FILTER_VALIDATE_BOOLEAN,
            'not_residential'                  => FILTER_SANITIZE_NUMBER_INT,
            'number_of_floors'                 => FILTER_SANITIZE_NUMBER_INT,
            'number_of_rooms'                  => FILTER_SANITIZE_NUMBER_INT,
            'object_located'                   => FILTER_SANITIZE_NUMBER_INT,
            'object_type'                      => FILTER_SANITIZE_NUMBER_INT,
            'operation_type'                   => FILTER_SANITIZE_NUMBER_INT,
            'parking_garage_complex'           => FILTER_VALIDATE_BOOLEAN,
            'parking_lot_garage'               => FILTER_VALIDATE_BOOLEAN,
            'parking_multilevel'               => FILTER_VALIDATE_BOOLEAN,
            'parking_none'                     => FILTER_VALIDATE_BOOLEAN,
            'parking_underground'              => FILTER_VALIDATE_BOOLEAN,
            'photo_available'                  => FILTER_VALIDATE_BOOLEAN,
            'planning_project'                 => FILTER_SANITIZE_STRING,
            'playground'                       => FILTER_VALIDATE_BOOLEAN,
            'playroom'                         => FILTER_VALIDATE_BOOLEAN,
            'plot_of_ravine'                   => FILTER_VALIDATE_BOOLEAN,
            'plot_on_the_slope'                => FILTER_VALIDATE_BOOLEAN,
            'plot_smooth'                      => FILTER_VALIDATE_BOOLEAN,
            'plot_uneven'                      => FILTER_VALIDATE_BOOLEAN,
            'plot_wetland'                     => FILTER_VALIDATE_BOOLEAN,
            'preview_img'                      => FILTER_SANITIZE_STRING,
            'price'                            => FILTER_SANITIZE_NUMBER_INT,
            'property_documents'               => FILTER_SANITIZE_STRING,
            'rating_admin'                     => FILTER_SANITIZE_NUMBER_INT,
            'rating_donate'                    => FILTER_SANITIZE_NUMBER_INT,
            'rating_views'                     => FILTER_SANITIZE_NUMBER_INT,
            'region'                           => FILTER_SANITIZE_STRING,
            'residential'                      => FILTER_SANITIZE_NUMBER_INT,
            'river'                            => FILTER_VALIDATE_BOOLEAN,
            'roofing'                          => FILTER_SANITIZE_NUMBER_INT,
            'sanitation'                       => FILTER_VALIDATE_BOOLEAN,
            'security'                         => FILTER_VALIDATE_BOOLEAN,
            'signaling'                        => FILTER_VALIDATE_BOOLEAN,
            'space'                            => FILTER_SANITIZE_NUMBER_INT,
            'space_type'                       => FILTER_SANITIZE_NUMBER_INT,
            'spring'                           => FILTER_VALIDATE_BOOLEAN,
            'stairwells_status'                => FILTER_SANITIZE_NUMBER_INT,
            'status'                           => FILTER_SANITIZE_NUMBER_INT,
            'street'                           => FILTER_SANITIZE_STRING,
            'study'                            => FILTER_VALIDATE_BOOLEAN,
            'swimming_pool'                    => FILTER_VALIDATE_BOOLEAN,
            'tags'                             => FILTER_SANITIZE_STRING,
            'three_d_project'                  => FILTER_SANITIZE_STRING,
            'time_car'                         => FILTER_SANITIZE_NUMBER_INT,
            'time_walk'                        => FILTER_SANITIZE_NUMBER_INT,
            'title'                            => FILTER_SANITIZE_STRING,
            'type_of_construction'             => FILTER_SANITIZE_NUMBER_INT,
            'type_of_house'                    => FILTER_SANITIZE_NUMBER_INT,
            'user_id'                          => FILTER_SANITIZE_NUMBER_INT,
            'video'                            => FILTER_SANITIZE_STRING,
            'wall_material'                    => FILTER_SANITIZE_NUMBER_INT,
            'water_pipes'                      => FILTER_VALIDATE_BOOLEAN,
            'waterfront'                       => FILTER_VALIDATE_BOOLEAN,
            'wine_vault'                       => FILTER_VALIDATE_BOOLEAN,
            'year_of_construction'             => FILTER_SANITIZE_NUMBER_INT,
            ''                                 => FILTER_SANITIZE_NUMBER_INT,
        ];

        //Преобразование через keys
        foreach ($keys as $k => $v) {
            if (isset($args_db[$v['table_column_name']])) {
                $args[$k] = $args_db[$v['table_column_name']];
            } else {
                $this->error(self::MISSING_VALUES_IN_AD_RECORDING_POST_FILTER);
            }
        }
        $post_data = filter_var_array($post, $args);

        //Удаление несуществующих параметров и преобразование обратно по $key
        foreach ($post_data as $k => $v) {
            if (!empty($v)) {
                $form_data[$keys[$k]['table_column_name']] = $v;
            }
        }

        //Добавление id Картинок
        if (!empty($_POST['photos'])) {
            if (is_array($_POST['photos'])) {
                foreach ($_POST['photos'] as $k => $v) {
                    array_push($photos, (int)$v);
                }
            } else {
                $this->error(self::NOT_ARRAY);
            }
        }

        $return_data['ad'] = $form_data;
        $return_data['photos'] = $photos;

        return $return_data;
    }

    private function  translateMetroStations($data){
        if(isset($data)){
            // Данные индекс метро -> наименование
            $metro_stations = [];
            $sql = "SELECT metro_id, metro_name, line_id "
                . "FROM metro_stations ";
            $stmt = $this->db->prepare($sql);
            if (!$stmt->execute()) {
                $this->error(self::DB_SELECT_ERROR);
            }
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $m) {
                $metro_stations[$m['metro_id']] = [
                    'metro_name' => $m["metro_name"],
                    'line_id' => $m['line_id']
                ];
            }

            foreach($data as $key => $value){
                //Перевод индекса метро в наименование
                if (!empty($data[$key]['metro_station']) && !empty($metro_stations[$data[$key]['metro_station']])) {
                    $data[$key]['metro_line'] = $metro_stations[$data[$key]['metro_station']]['line_id'];
                    $data[$key]['metro_station'] = $metro_stations[$data[$key]['metro_station']]['metro_name'];
                } else {
                    // $this->error(self::METRO_STATION_INCORRECT_CODE_ERROR);
                }
            }
        }
        return $data;
    }

    public function setItemActive()
    {
        if (!isset($_REQUEST['id'])) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!isset($_SESSION['user']['id'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        $query = $this->db->prepare('SELECT id_news FROM news_base WHERE user_id = :user_id AND id_news = :news_id');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':news_id' => $_REQUEST['id'],
        ]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
        }

        if (!$query->fetch()) {
            $this->error(self::CHANGE_NOT_YOUR_DATA_ERROR);
        }

        $query = $this->db->prepare('UPDATE news_base SET status = 1 WHERE id_news = :id');
        $query->execute([':id' => $_REQUEST['id']]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
        }

        $this->response();
    }

    public function setItemUnActive()
    {
        if (!isset($_REQUEST['id'])) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!isset($_SESSION['user']['id'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        $query = $this->db->prepare('SELECT id_news FROM news_base WHERE user_id = :user_id AND id_news = :news_id');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':news_id' => $_REQUEST['id'],
        ]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
        }

        if (!$query->fetch()) {
            $this->error(self::CHANGE_NOT_YOUR_DATA_ERROR);
        }

        $query = $this->db->prepare('UPDATE news_base SET status = 0 WHERE id_news = :id');
        $query->execute([':id' => $_REQUEST['id']]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
        }

        $this->response();
    }

    public function deleteItem()
    {
        if (!isset($_REQUEST['id'])) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!isset($_SESSION['user']['id'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        $query = $this->db->prepare('SELECT id_news FROM news_base WHERE user_id = :user_id AND id_news = :news_id');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':news_id' => $_REQUEST['id'],
        ]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
        }

        if (!$query->fetch()) {
            $this->error(self::CHANGE_NOT_YOUR_DATA_ERROR);
        }

        $query = $this->db->prepare('DELETE FROM news_base WHERE id_news = :id');
        $query->execute([':id' => $_REQUEST['id']]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
        }

        $query = $this->db->prepare('DELETE FROM ads_images WHERE ad_id = :id');
        $query->execute([':id' => $_REQUEST['id']]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_UPDATE_ERROR, $query->errorInfo());
        }

        $this->response();
    }
}