<?php

class ServiceModel extends Model
{
    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function makeServiceInsert($user = 0)
    {
        $form_data = $this->getFormData($user);

        // Формирование массива данных для записи
        $new_form_data = [];
        foreach ($form_data as $key => $val) {
            if (strpos($key, 'period_') !== FALSE) {
                //Определяем номер подпункта
                $i = (int)explode('_', $key)[1];
                //Формируем строку для БД
                $new_form_data[$i]['owner_id'] = $form_data['author_name'];
                $new_form_data[$i]['service_name'] = $form_data['service_name'];
                $new_form_data[$i]['parameters'] = $form_data['parameters'];
                $new_form_data[$i]['period'] = $form_data['period_' . $i];
                $new_form_data[$i]['price'] = $form_data['price_' . $i];
            }
        }


        //Определяем еденичная запись или групповая
        if (count($new_form_data) > 1) {
            $new_form_data[0]['service_group_id'] = 'parent';
        } else {
            $new_form_data[0]['service_group_id'] = 'single';
        }

        //Запись первой строки $i = 0
        $sql = "INSERT INTO services (";
        foreach ($new_form_data[0] as $key => $val) {
            $sql = $sql . $key . ', ';
        }
        // удаляем последнюю запятую
        $sql = substr($sql, 0, -2);
        $sql = $sql . ') VALUES (';
        foreach ($new_form_data[0] as $key => $val) {
            $sql = $sql . ':' . $key . ', ';
        }
        $sql = substr($sql, 0, -2);
        $sql = $sql . ')';

        //Если это группа записей => определяем id для руппы
        if ($new_form_data[0]['service_group_id'] == 'parent') {
            $sql = $sql . ' RETURNING service_id';
        }

        $stmt = $this->db->prepare($sql);

        //bindParam
        foreach ($new_form_data[0] as $key => $val) {
            $p = ':' . $key;
            $stmt->bindParam($p, $new_form_data[0][$key]);
        }


        //Добавление добавочных опций
        if ($new_form_data[0]['service_group_id'] == 'single') {
            return ($stmt->execute());
        } else {
            if ($stmt->execute()) {
                $service_id = $stmt->fetchColumn();
            } else {
                return FALSE;
            }
            //Удаление первой записи из массива
            unset($new_form_data[0]);
            // Задание service_group_id для оставшихся записей
            foreach ($new_form_data as $key => $val) {
                $new_form_data[$key]['service_group_id'] = $service_id;
            }
            // Запись всех оставшихся элементов в БД в цикле
            foreach ($new_form_data as $o_data) {
                $sql = "INSERT INTO services (";
                foreach ($o_data as $key => $val) {
                    $sql = $sql . $key . ', ';
                }
                // удаляем последнюю запятую
                $sql = substr($sql, 0, -2);
                $sql = $sql . ') VALUES (';
                foreach ($o_data as $key => $val) {
                    $sql = $sql . ':' . $key . ', ';
                }
                $sql = substr($sql, 0, -2);
                $sql = $sql . ')';

                $stmt = $this->db->prepare($sql);
                //bindParam
                foreach ($o_data as $key => $val) {
                    $p = ':' . $key;
                    $stmt->bindParam($p, $o_data[$key]);
                }
                if (!($stmt->execute())) {
                    return FALSE;
                }
            }
            return TRUE;
        }

    }


    public function getFormData($user = 0)
    {
        //Определение пользователя
        if (!empty($_SESSION['user']['id'])) {
            $author_name = (int)$_SESSION['user']['id'];
        } else {
            return false;
        }

        //Удаление пробелов и переводов строк в начале и в конце строк
        function trim_value(&$value)
        {
            $value = trim($value);
        }

        array_filter($_POST, 'trim_value');
        $arg = [];
        //Получение массива имен $_POST и задание им фильтров
        foreach ($_POST as $k => $v) {
            if ($k == 'service_name' OR $k == 'parameters') {
                $arg[$k] = FILTER_SANITIZE_STRING;
            } elseif ($k == 'service_add') {
            } else {
                $arg[$k] = array(
                    'filter' => FILTER_VALIDATE_INT,
                    'flags' => FILTER_REQUIRE_SCALAR,
                    'flags' => FILTER_NULL_ON_FAILURE,
                    'options' => array('min_range' => 0)
                );
            }
        }

        $form_data = filter_input_array(INPUT_POST, $arg);
        $form_data['author_name'] = $author_name;

        return $form_data;
    }

    public function getMyServices($user = 0, $admin = FALSE)
    {

        if (!empty($user)) {
            $sql = 'SELECT service_id, service_name, parameters, period, price, service_group_id '
                . 'FROM services';
            if (!$admin) {
                $sql = $sql . ' WHERE owner_id = :owner_id';
            }
            $sql = $sql . ' ORDER BY service_id DESC';

            $stmt = $this->db->prepare($sql);
            if (!$admin) {
                $stmt->bindParam(':owner_id', $user);
            }
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $result = $this->sortServices($res);

            return $result;
        }

    }

    public function makeServiceDelete($user, $access = FALSE, $service_id, $group = FALSE)
    {

        if ($group) {
            $ser_name_id = 'service_group_id';
        } else {
            $ser_name_id = 'service_id';
        }

            // Получение данных об удаляемом сервисе (owner_id, service_group_id)
            $sql = 'SELECT owner_id, service_group_id FROM services WHERE ' . $ser_name_id . ' = :service_id';
            if ($group) {
                $sql = $sql . ' OR service_id = :service_id2';
            }
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':service_id', $service_id);
            if ($group) {
                $stmt->bindParam(':service_id2', $service_id);
            }
            $stmt->execute();
            $ser_param = $stmt->fetch(PDO::FETCH_ASSOC);

        //Проверка прав на удаление сервиса по id, если нет админ прав access['admin_service']
        if (!$access) {
            // Проверка на соответствие id пользователя и id владельца сервиса
            if ((int)$ser_param['owner_id'] != $user) {
                return FALSE;
            }
        }

        // Удаление сервиса или группы сервисов
        $sql = 'DELETE FROM services WHERE ' . $ser_name_id . ' = :service_id';
        if ($group) {
            $sql = $sql . ' OR service_id = :service_id2';
        }
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':service_id', $service_id);
        if ($group) {
            $stmt->bindParam(':service_id2', $service_id);
        }
        if(!$stmt->execute()) { return FALSE;};

        //Когда из группы удаляется parent элемент => перезапись parent
        if (!$group && $ser_param['service_group_id'] == 'parent'){
            // Получение id всей группы из БД
            $sql = 'SELECT service_id FROM services WHERE service_group_id = :service_id ORDER BY service_id';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':service_id', $service_id);
            $stmt->execute();
            $ser_group_id = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //Если остался только один сервис => single
            if(count($ser_group_id) == 1){
                $new_ser_group_id = 'single';
            } else {
                $new_ser_group_id = 'parent';
            }
            //Перезапись первой опции группы
            $sql = 'UPDATE services SET service_id = :service_id_2, service_group_id = :new_ser_group_id '
                .'WHERE service_id = :service_id_1';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':service_id_1', $ser_group_id[0]['service_id']);
            $stmt->bindParam(':service_id_2', $service_id);
            $stmt->bindParam(':new_ser_group_id', $new_ser_group_id);
            if(!$stmt->execute()) { return FALSE;}
        }
        return TRUE;
    }

    private function sortServices($res)
    {
        //Преобразование результата для удобства вывода
        $result = [];
        foreach ($res as $k => $v) {
            if ($res[$k]['service_group_id'] == 'single') {
                $result[$res[$k]['service_id']][$res[$k]['service_id']] = $v;
            } elseif ($res[$k]['service_group_id'] == 'parent') {
                $result[$res[$k]['service_id']][$res[$k]['service_id']] = $v;
            } elseif (isset($res[$k]['service_group_id'])) {
                $result[$res[$k]['service_group_id']][$res[$k]['service_id']] = $v;
            }
        }
        //Сортировка по id
        foreach ($result as $k => $v) {
            ksort($result[$k], SORT_NUMERIC);
        }
        ksort($result, SORT_NUMERIC);

        // Добавление первым элементам прупп метки parent при их отсутствии
        foreach ($result as $k => $v) {
            $first = current($v);
            if ($first['service_group_id'] != 'parent') {
                $first['service_group_id'] = 'parent';
            }
        }
        return $result;
    }

    public function getServiceList($my_sub_serv = [])
    {
        $sql = 'SELECT service_id, owner_id, service_name, parameters, period, price, service_group_id '
            . 'FROM services';

//        //Исключение уже подписанных сервисов
//        if(!empty($my_sub_serv)) {
//            $sql_my_sub_serv_1 ='';
//            $sql_my_sub_serv_2 ='';
//            foreach ($my_sub_serv as $key => $val){
//                $sql_my_sub_serv_1 = $sql_my_sub_serv_1.$my_sub_serv[$key]['service_group_id'].', ';
//                $sql_my_sub_serv_2 = $sql_my_sub_serv_2."'".$my_sub_serv[$key]['service_group_id']."'".', ';
//            }
//            // удаляем последнюю запятую
//            $sql_my_sub_serv_1 = substr($sql_my_sub_serv_1, 0, -2);
//            $sql_my_sub_serv_2 = substr($sql_my_sub_serv_2, 0, -2);
//            $sql = $sql . ' WHERE service_id NOT IN ('.$sql_my_sub_serv_1
//                .') AND service_group_id NOT IN ('.$sql_my_sub_serv_2.')';
//        }
        $sql = $sql . ' ORDER BY service_id DESC';

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $res = $this->sortServices($res);

//        Отделение подписанных сервисов
        $my_sub_serv_data = [];
        if (!empty($my_sub_serv)) {
            foreach ($res as $group => $s) {
                foreach ($my_sub_serv as $my_s) {
                    if ($group == $my_s['service_group_id']) {
                        $my_sub_serv_data[$my_s['service_id']] = $s[$my_s['service_id']];
                        unset($res[$group]);
                    }
                }
            }
        }
        // Массив подписанных сервисов
        $result['my'] = $my_sub_serv_data;
        // Массив всех остальных сервисов
        $result['services'] = $res;
        return $result;
    }


    public function separationServiceList ($services =[], $my_services =[]){

    }

    public function makeServiceSubscribe($user, $service_id, $service_group_id)
    {
        //Получение данных о пользователе из БД
        $sql = 'SELECT balance FROM users WHERE id = :user';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $balance = $stmt->fetchColumn();

        //Получение данных о сервисе из БД
        $sql = 'SELECT period, price FROM services WHERE service_id = :service_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':service_id', $service_id);
        $stmt->execute();
        $service = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        //Сравнение балланса и цены
        if ($balance < $service['price']) {
            return 'У вас недостаточно средств для завершения операции';
        } else {


            // Вычет цены
            $new_balance = $balance - $service['price'];

            $sql = "UPDATE users SET balance = :balance WHERE id = :id";
            $stmt1 = $this->db->prepare($sql);
            $stmt1->bindParam(':balance', $new_balance);
            $stmt1->bindParam(':id', $user);

            // Запис в историю балланса
            $sql = 'INSERT INTO balance_history (user_id, operation, value, rest_balance)'
                . ' VALUES (:user_id, :operation, :value, :rest_balance)';
            $stmt2 = $this->db->prepare($sql);
            //bindParam
            $operation = 'Подписка на сервис id=' . $service_id;
            $value = -$service['price'];
            $stmt2->bindParam(':user_id', $user);
            $stmt2->bindParam(':operation', $operation);
            $stmt2->bindParam(':value', $value);
            $stmt2->bindParam(':rest_balance', $new_balance);

            //Запись в таблицу подписок
            $sql = 'INSERT INTO service_subs (user_id, service_id, service_group_id, period, date_of_expiration)'
                . ' VALUES (:user_id, :service_id, :service_group_id, :period, :date_of_expiration)';
            $stmt3 = $this->db->prepare($sql);
            //bindParam
            $period = $service['period'];
            $date_of_expiration = date('c', strtotime('+' . $period . ' day'));

            $stmt3->bindParam(':user_id', $user);
            $stmt3->bindParam(':service_id', $service_id);
            $stmt3->bindParam(':service_group_id', $service_group_id);
            $stmt3->bindParam(':period', $period);
            $stmt3->bindParam(':date_of_expiration', $date_of_expiration);

            //Запись в БД транзакцией
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt1->execute();
                $stmt2->execute();
                $stmt3->execute();
                $this->db->commit();
            } catch (Exception $e) {
                $this->db->rollBack();
                return "Ошибка записи в базу данных. Транзакция отменена.";
            }
        }

        return "Подписка на сервис прошла успешно.";
    }

    public function getMySubServices($user)
    {
        //Получение данных о пользователе из БД
        $sql = 'SELECT service_id, service_group_id, date_of_beginning::date, date_of_expiration::date FROM service_subs WHERE user_id = :user_id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $user);
        $stmt->execute();
        $my_sub_serv = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $my_sub_serv;
    }


    /**
     * Метод возвращающий количество услуг сайта
     * @return string
     */
    public function getNumberOfServices(){
        $sql = 'SELECT COUNT(*) FROM services WHERE service_group_id = \'parent\' OR service_group_id = \'single\'';
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


}
