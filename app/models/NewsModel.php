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
    public function getAdById($id)
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


        if (!empty($data)) {
            // Получение фото
            $data = $this->getAdsPhotos([$data])[0];
            // Автор
            $data = $data + $this->getAuthorInfo($data["user_id"], false, true, true);
            //Перевод города
            $data["city"] = $this->translateCity($data["city"]);
            //Перевод метро
            $data = $data + $this->translateMetroStations($data["metro_station"], true, true, true);
            // Проверка favorite
            if(!empty($this->user_id)){
                $sql = "SELECT COUNT(*) FROM favorite_ads WHERE ad_id = :id AND user_id = :user_id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':user_id', $this->user_id);
                if (!$stmt->execute()) {
                    $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
                }
                $result = $stmt->fetchColumn();
                if(!empty($result)){
                    $data['favorite'] = 1;
                }else{
                    $data['favorite'] = 0;
                }
            }else{
                $data['favorite'] = 0;
            }

        } else {
            $this->errors = "Несуществующее id";
        }


        $this->response = $data;

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
                    if (isset($_SESSION['user']['id'])) {
                        $userID = (int)$_SESSION['user']['id'];
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
        if (!empty($_SESSION['user']['id'])) {
            $user_id = (int)$_SESSION['user']['id'];
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
            'planning_project'                 => FILTER_VALIDATE_STRING,
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
        //Удаление пустых параметров (котор. принимают значение DEFAULT)
        foreach($form_data as $key => $val){
            if($val === 'DEFAULT') unset($form_data[$key]);
        }

        //Запись информации в основную таблицу
        $sql = "INSERT INTO news_base (";
        foreach ($form_data as $key => $val) {
            $sql = $sql . $key . ', ';
        }
        $sql = substr($sql, 0, -2);
        $sql = $sql . ') VALUES (';
        foreach ($form_data as $key => $val) {
            $sql = $sql . ':' . $key . ', ';
        }
        $sql = substr($sql, 0, -2);
        $sql = $sql . ') RETURNING id_news';
        $stmt = $this->db->prepare($sql);

        foreach ($form_data as $key => $val) {
            $p = ':' . $key;
            $stmt->bindParam($p, $form_data[$key]);
        }
        if ($stmt->execute()) {
            $this->response = true;
        }else{
            $this->error(self::DB_EXECUTE_ERROR);
        }
        $id_news = $stmt->fetchColumn();
         if ($id_news) {
            //Добавление индекса объявления для фото ads_images
          $this->addPhotosIndex($id_news, $photos);
        } else {
            $this->error(self::MISSING_ADD_ID);
        }


    }

    public function makeNewsUpdate($id_news, $form_data, $photos)
    {

        if(!empty($id_news)){
            $sql = "UPDATE news_base SET ";
            foreach ($form_data as $key => $val) {
                if($val !== 'DEFAULT'){
                    $sql = $sql . $key . ' = :' . $key . ', ';
                }else{
                    $sql = $sql . $key . ' = DEFAULT, ';
                }
            }
            $sql = substr($sql, 0, -2);

            $sql = $sql . " WHERE id_news = :id_news";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_news', $id_news);
            $v = [];
            foreach ($form_data as $key => $val) {
                if($val !== 'DEFAULT'){
                    $p = ':' . $key;
                    $stmt->bindParam($p, $form_data[$key]);
                }
            }
            if ($stmt->execute()) {
                $this->response = true;
            } else {
                $this->error(self::DB_EXECUTE_ERROR);
            }
           $this->addPhotosIndex($id_news, $photos);
        }else{
            $this->error(self::MISSING_ADD_ID);
        }

    }

    /**
     * Добавление индекса объявления в ads_images где id = из $photos и ad_id = 0
     * @param $id_news
     * @param $photos
     */
    private function addPhotosIndex($id_news, $photos){
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
                    $this->error(self::ADDS_IMAGES_EXECUTE_ERROR);
                }
            }
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
        $news_date = time() - ($time * 60 * 60);
        if ($news_date < 0) {
            $this->error(self::DATE_INCORRECT_ERROR);
        }
        //$news_date = $this->dateFormatForDB($time);

        $sql = "SELECT n.id_news, to_char(n.date,'YYYY-MM-DD HH24:MI:SS') as date, n.title,"
            . " n.space_type, n.operation_type, n.object_type, n.city,"
            . " n.content, n.user_id, n.status,  n.price, n.lease, n.space,"
            . " n.not_residential, n.date_best, n.rating_best,"
            . " n.number_of_rooms, n.metro_station, n.time_walk, n.time_car, n.lat, n.lng,"
            . " i.original, i.s_250_140, i.s_500_280, i.s_360_230, i.s_720_460, i.ad_id";

        //Включение в запрос поля favorite если это зарегистрированный пользователь
        if (!empty($this->user_id)) {
            $sql .= ", f.ad_id as favorite";
        }

        $sql .= " FROM news_base n LEFT JOIN (SELECT DISTINCT ON(ad_id) * FROM ads_images) i"
            . " ON (n.id_news = i.ad_id)";

        //Включение в запрос поля favorite если это зарегистрированный пользователь
        if (!empty($this->user_id)) {
            $sql .= " LEFT JOIN favorite_ads f ON (n.id_news = f.ad_id AND f.user_id = " . $this->user_id . ")";
        }
        $sql .= " WHERE (n.date_best >= :date)";

        // Только активные(видимые)
        $sql .= "AND (status > 0) ";

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

        $sql .= " ORDER BY n.rating_best DESC"
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
     * @param bool $photos - нужны ли все фото
     *
     * @return mixed - преобразованные данные
     * Добавляет параметр ad_is_new - является ли объявление новым (bool)
     * Добавляет данные об авторе
     */
    public function prepareNewsPreview($data, $translate_indx = true, $author_info = false, $photos = true)
    {
        if (empty($data)) {
            $this->response['items'] = [];

            return;
        }
        $user_id_arr = [];

        //Получение массив ссылок на картинки $data['news'][number]['photos'][]
        if ($photos) {
            $data = $this->getAdsPhotos($data);
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
            $author_arr = $this->getAuthorInfo($user_id_arr, true);

            //Присваивание данных
            foreach ($data as $key => $val) {
                if (!empty($author_arr[$data[$key]["user_id"]])) {
                    $data[$key] = $data[$key] + $author_arr[$data[$key]["user_id"]];
                }
            }
        }
        //Перевод станций метро
        $data = $this->translateMetroStations($data, false, false, true);
        //Перевод городов
        $data = $this->translateCity($data);
        $this->response['items'] = $data;
    }

    /**
     * Возвращает массив параметров автора объявления
     *
     * @param $user_id - массив id авторов (может быть послано просто (str) id)
     *
     * @return array - Массив с параметрами автора, и ключами = его id
     */
    private function getAuthorInfo($user_id, $profile_foto_id = false, $avatar = false, $status = false)
    {
        $author_arr = [];
        if (!is_array($user_id)) {
            $user_id_arr = [$user_id];
        }else{
            $user_id_arr = $user_id;
        }
        $user_id_arr_txt = implode(',', $user_id_arr);
        $sql = "SELECT id, first_name, last_name, patronymic";
        if($profile_foto_id) $sql .= ", profile_foto_id";
        if($avatar) $sql .= ", avatar_original, avatar_50, avatar_100";
        if($status) $sql .= ", status as user_status";
        $sql .= " FROM users WHERE id IN($user_id_arr_txt)";
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute()) {
            $this->error(self::DB_EXECUTE_ERROR, $stmt->errorInfo());
        }
        $author_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($author_result)){
            foreach ($author_result as $val) {
                $author_arr[$val['id']] = $val;
                unset($author_arr[$val['id']]['id']);
            }

            if (!is_array($user_id)) {
                return $author_arr[$user_id];
            }else{
                return $author_arr;
            }
        }else {
            return [];
        }


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
     *
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
                        'message' => 'Неправильный запрос (пустой response)',
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
                        $request['time_from'] = 8640;
                        break;
                    default:
                        $request['time_from'] = 24;
                }
            }
        }

        return $request;
    }

    private function getUserID(){
        if (!empty($_SESSION['user']['id'])) {
            return (int)$_SESSION['user']['id'];
        } else {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
            return false;
        }
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
                    $post[$name . '_' . $k] = $i;
                }
            } else {
                $post[$name] = $value;
            }
        }

        //Определение пользователя
        $form_data['user_id'] = $this->getUserID();

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
                /* обработка только полученного POST */
                if(isset($post[$k])){
                    $args[$k] = $args_db[$v['table_column_name']];
                }
            } else {
                $this->error(self::MISSING_VALUES_IN_AD_RECORDING_POST_FILTER);
            }
        }
        $post_data = filter_var_array($post, $args);

        //преобразование обратно по $key и присваивание пустым данным DEFAULT
        foreach ($post_data as $k => $v) {
            if(!empty($v) || $v === false){
                if(is_bool($v)){
                    $form_data[$keys[$k]['table_column_name']] = intval($v);
                }else{
                    $form_data[$keys[$k]['table_column_name']] = $v;
                }

            }else{
                $form_data[$keys[$k]['table_column_name']] = 'DEFAULT';
            }
        }
        //Добавление id Картинок
        if (!empty($_POST['photos'])) {
            if (is_array($_POST['photos'])) {
                foreach ($_POST['photos'] as $k => $v) {
                    array_push($photos, abs((int)$v));
                }
            } else {
                $this->error(self::NOT_ARRAY);
            }
        }

        //Если это update => id объявления
        if (!empty($_POST['id'])) {
            $return_data['id_news'] = abs((int)$_POST['id']);
        }

        $return_data['ad'] = $form_data;
        $return_data['photos'] = $photos;

        return $return_data;
    }

    /**
     * @param $data - arr - массив объявлений или str - id города
     *
     * @return mixed
     */
    private function translateCity($data){

        if (!is_array($data)){
            $id = (int)$data;
            $sql = "SELECT city FROM city WHERE id = ".$id;
            $stmt = $this->db->prepare($sql);
            if (!$stmt->execute()) {
                $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
            }
            return $stmt->fetchColumn();
        }
        // Данные индекс города -> город
        $city = [];
        $sql = "SELECT id, city FROM city";
        $stmt = $this->db->prepare($sql);
        if (!$stmt->execute()) {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $c) {
            $city[$c['id']] = $c["city"];
        }
        foreach ($data as $key => $value) {
            //Перевод индекса города в наименование
            if (!empty($data[$key]['city'])) {
                $data[$key]['city'] = $city[$data[$key]['city']];
            } else {
                //  $this->error(self::CITY_INCORRECT_CODE_ERROR);
            }
        }
        return $data;
    }

    /**
     * @param $data - arr объявлений или str - id станции
     * @param bool $line_number - надо выводить номер линии
     * @param bool $line_name - надо выводить имя линии
     * @param bool $line_color - надо выводить цвет линии
     *
     * @return mixed
     */
    private function translateMetroStations($data, $line_number = false, $line_name = false, $line_color = false)
    {
        if (isset($data)) {
            if(!is_array($data)){
                $metro_id = (int)$data;
                $sql = "SELECT s.metro_name";
                if ($line_number) $sql .= ", l.line_number as metro_line";
                if ($line_name) $sql .= ", l.line_name as metro_line_name";
                if ($line_color) $sql .= ", l.line_color as metro_color";
                $sql .= " FROM metro_stations s"
                    . " LEFT JOIN metro_line l ON(s.line_id = l.line_id)"
                    . " WHERE metro_id = ".$metro_id;
                $stmt = $this->db->prepare($sql);
                if (!$stmt->execute()) {
                    $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
                }
                return $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
            }
            // Данные индекс метро -> наименование
            $metro_stations = [];
            $metro_line = [];
            $sql = "SELECT metro_id, metro_name, line_id "
                . "FROM metro_stations ";
            $stmt = $this->db->prepare($sql);
            if (!$stmt->execute()) {
                $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
            }
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($res as $m) {
                $metro_stations[$m['metro_id']] = [
                    'metro_name' => $m["metro_name"],
                    'line_id'    => $m['line_id'],
                ];
            }

            if ($line_number OR $line_name OR $line_color) {
                $sql = "SELECT line_id";
                if ($line_number) $sql .= ", line_number";
                if ($line_name) $sql .= ", line_name";
                if ($line_color) $sql .= ", line_color";
                $sql .= " FROM metro_line";
                $stmt = $this->db->prepare($sql);
                if (!$stmt->execute()) {
                    $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
                }
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($res as $m) {
                    if ($line_number) $metro_line[$m['line_id']]['line_number'] = $m["line_number"];
                    if ($line_name) $metro_line[$m['line_id']]['line_name'] = $m["line_name"];
                    if ($line_color) $metro_line[$m['line_id']]['line_color'] = $m["line_color"];
                }
            }

            foreach ($data as $key => $value) {
                //Перевод индекса метро в наименование
                if (!empty($data[$key]['metro_station']) && !empty($metro_stations[$data[$key]['metro_station']])) {
                    $line_id = $metro_stations[$data[$key]['metro_station']]['line_id'];
                    if ($line_number) {
                        $data[$key]['metro_line'] = $metro_line[$line_id]['line_number'];
                    }
                    if ($line_name) {
                        $data[$key]['metro_line_name'] = $metro_line[$line_id]['line_name'];
                    }
                    if($line_color){
                        $data[$key]['metro_color'] = $metro_line[$line_id]['line_color'];
                    }

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
