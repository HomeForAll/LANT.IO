<?php

class CabinetModel extends Model
{
    const IDSPERPAGE = 5;
    private $mailer;


    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function ajaxHandler()
    {
    }

    public function getinfo()
    {
        $_SESSION['userID'] = 1;
        $profile_id = $_SESSION['userID'];

        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = $profile_id");
        $stmt->execute();
        $info = $stmt->fetchAll();
        return $info;
    }

    public function showActivity()
    {

    }

    public function savePersonalInfo()
    {
        $_SESSION['userID'] = 1;
        $_SESSION['error'] = [];
        $profile_id = $_SESSION['userID'];


        $n = 4; // kol-vo post dlia proverki
        for ($i=0;$i<=$n-1;$i++){
            $error_array[$i] = "";
            $_SESSION['error'][$i] = 0;
        }

        if (isset($_POST['save_1']))
        {
            $str = $_POST['name'];
            $str = trim($str);
            $pattern = "/([a-z0-9])+/i";
            if(preg_match($pattern, $str, $matches))
                $error_array[0] = 1;
            if($str == '')
                $error_array[0] = 1;
            $_POST['name'] = $str;
            if ($error_array[0] == 0)
                $this->db->query("UPDATE users SET first_name = '{$_POST['name']}' WHERE id = $profile_id");

            $str = $_POST['surname'];
            $str = trim($str);
            $pattern = "/([a-z0-9])+/i";
            if(preg_match($pattern, $str, $matches))
                $error_array[1] = 1;
            if($str == '')
                $error_array[1] = 1;
            $_POST['surname'] = $str;
            if ($error_array[1] == 0)
                $this->db->query("UPDATE users SET last_name = '{$_POST['surname']}' WHERE id = $profile_id");

            $str = $_POST['patronymic'];
            $str = trim($str);
            $pattern = "/([a-z0-9])+/i";
            if(preg_match($pattern, $str, $matches))
                $error_array[2] = 1;
            if($str == '')
                $error_array[2] = 1;
            $_POST['patronymic'] = $str;
            if ($error_array[2] == 0)
                $this->db->query("UPDATE users SET patronymic = '{$_POST['patronymic']}' WHERE id = $profile_id");

            $str = $_POST['phonenumber'];
            $str = trim($str);
            $str = preg_replace("/[^0-9]/", '', $str);
            $_POST['phonenumber'] = $str;
            $this->db->query("UPDATE users SET phone_number = '{$_POST['phonenumber']}' WHERE id = $profile_id");

            $month = array(
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь");

            $_POST['sel_date'] = preg_replace("/[^0-9]/", '', $_POST['sel_date']);
            $day = $_POST['sel_date'];
            if (($_POST['sel_date'] > 31) || ($_POST['sel_date'] < 1))
                $error_array[3] = 1;

            $_POST['sel_year'] = preg_replace("/[^0-9]/", '', $_POST['sel_year']);
            if (($_POST['sel_year'] > date('Y')) || ($_POST['sel_year'] < 1920))
                $error_array[3] = 1;

            $month_num = 0;
            for ($i = 0; $i < 12; $i++) {
                $var1 = $_POST['sel_month'];
                $var2 = $month[$i];
                if (strcasecmp($var1, $var2) == 0) {
                    $_POST['sel_month'] = $i + 1;
                    $month_num = $i + 1;
                    break;
                }
                else {
                    if ($i == 12) {
                        echo $var1;
                        echo $var2;
                        $error_array[3] = 1;
                    }
                }
            }


            if ($month_num == 4 || $month_num == 6 || $month_num == 9 || $month_num == 11) {
                if ($day > 30) {
                    $error_array[3] = 1;
                }
            }
            if ($month_num == 2) {
                if ($day > 28) {
                    $error_array[3] = 1;
                }
            }

            if ($error_array[3] == 0)
                $this->db->query("UPDATE users SET birthday = '{$_POST['sel_date']}.{$_POST['sel_month']}.{$_POST['sel_year']}' WHERE id = $profile_id");

            $_SESSION['error'] = $error_array;
        }

        if (isset($_POST['save_2']))
        {
            $_SESSION['email_error'] = 0;
            if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                $this->db->query("UPDATE users SET email = '{$_POST['email']}' WHERE id = $profile_id");
            }
            else {
                $_SESSION['email_error'] = 1;
            }


            $this->db->query("UPDATE users SET vk_id = '{$_POST['vkcom']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET ok_id = '{$_POST['classmates']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET mail_id = '{$_POST['mailru']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET ya_id = '{$_POST['yandexru']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET google_id = '{$_POST['google']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET facebook_id = '{$_POST['facebook']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET steam_id = '{$_POST['steam']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET profile_foto_id = '{$_POST['profile_foto']}' WHERE id = $profile_id");
        }

        if (isset($_POST['save_3']))
        {
            $stmt = $this->db->prepare("SELECT password FROM users WHERE id = $profile_id");
            $stmt->execute();
            $result = $stmt->fetchAll();

            $new_result = $result[0]['password'];

            if (password_verify($_POST['old_pass'], $new_result)) {
                $passwordHash = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
                $this->db->query("UPDATE users SET password = '{$passwordHash}' WHERE id = $profile_id");
            } else {
                $_SESSION['password_error'] = 1;
            }
        }

        if (isset($_POST['save_aboutme']))
        {
            $aboutme = $_POST['aboutme'];
            $this->db->query("UPDATE users SET about_me = '{$aboutme}' WHERE id = $profile_id");
        }

        if (isset($_POST['save_4']))
        {
            if (isset($_POST['phone_only']))
            {
                $this->db->query("UPDATE users SET phone_only = 1 WHERE id = $profile_id");
            }
            if (isset($_POST['site_only']))
            {
                $this->db->query("UPDATE users SET site_only = 1 WHERE id = $profile_id");
            }
            if (!isset($_POST['phone_only']))
            {
                $this->db->query("UPDATE users SET phone_only = 0 WHERE id = $profile_id");
            }
            if (!isset($_POST['site_only']))
            {
                $this->db->query("UPDATE users SET site_only = 0 WHERE id = $profile_id");
            }
        }

        if (isset($_POST['save_5']))
        {
            echo 123;
            if (isset($_POST['new_dialog']))
            {
                $this->db->query("UPDATE users SET new_dialog = 1 WHERE id = $profile_id");
            }
            if (isset($_POST['close_ad']))
            {
                $this->db->query("UPDATE users SET close_ad = 1 WHERE id = $profile_id");
            }
            if (isset($_POST['prom_offers']))
            {
                $this->db->query("UPDATE users SET prom_offers = 1 WHERE id = $profile_id");
            }
            if (!isset($_POST['new_dialog']))
            {
                $this->db->query("UPDATE users SET new_dialog = 0 WHERE id = $profile_id");
            }
            if (!isset($_POST['close_ad']))
            {
                $this->db->query("UPDATE users SET close_ad = 0 WHERE id = $profile_id");
            }
            if (!isset($_POST['prom_offers']))
            {
                $this->db->query("UPDATE users SET prom_offers = 0 WHERE id = $profile_id");
            }
        }

        if (isset($_POST['show_all_gadgets'])) {
            $user_agent = $_SERVER["HTTP_USER_AGENT"];
            if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
            elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
            elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
            elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
            elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
            else $browser = "Неизвестный";

            if (!empty($_SERVER['HTTP_CLIENT_IP']))
            {
                $ip=$_SERVER['HTTP_CLIENT_IP'];
            }
            elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
            }
            else
            {
                $ip=$_SERVER['REMOTE_ADDR'];
            }

            $stmt = $this->db->prepare("SELECT active_text FROM users WHERE id = $profile_id");
            $stmt->execute();
            $info = $stmt->fetchAll();

$found_match = "Unknown";
 if($curl = curl_init() ) {
     curl_setopt($curl, CURLOPT_URL, 'http://www.ip2location.com/demo?ip=' . $ip);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_POSTFIELDS, "ipaddress=$ip");
     $out = curl_exec($curl);
     $matches = array();
     preg_match_all("~td.*</td>~i", $out, $matches);
     $found_match = $matches[0][4];
     preg_match_all("~>.*<~i", $found_match, $matches);
     $found_match = $matches[0][0];
     $found_match = ltrim($found_match, ">");
     $found_match = rtrim($found_match, "<");
     preg_match("~flags/.*.png~", $found_match, $flag_country);
     $found_match = preg_replace("~\/images\/flags~", "http://www.ip2location.com/images/flags", $found_match);
     curl_close($curl);
 }

            $geo = $found_match;
            $str_for_active = $browser . "," . date('d F \в H:i:s') . "," . $ip . "," . $geo . ";";
            $str_for_active = $str_for_active . $info[0][0];
            $str_for_active = trim($str_for_active, ';');
            $query = $this->db->prepare("UPDATE users SET active_text = :active WHERE id = :id");
            $query->execute(array(":active"=>$str_for_active, ":id"=>$profile_id));
            print_r($this->db->errorInfo());
        }
    }

    private function geoip_client($ip, $opt, $sid)
    {
// Делаем запрос к серверу
        if ($xml = file_get_contents('http://geoip.top/cgi-bin/getdata.pl?ip=' . $ip . '&hex=' . $opt . '&sid=' . $sid)) {
            $xmlObj = new XmlToArray($xml); // преобразуем xml в массив
            $arrayData = $xmlObj->createArray();

// если есть ошибки выбрасываем исключения
            if (isset($arrayData['GeoIP']['GeoAddr'][0]['Error'])) {
                switch ($arrayData['GeoIP']['GeoAddr'][0]['Error']) {
                    case 0:
                        ;
                        break;
                    case 10:
                        throw new Exception('Geo_IP: Неверная длина указанного адреса');
                        break;
                    case 11:
                        throw new Exception('Geo_IP: Неверный формат адреса');
                        break;
                    case 150:
                        throw new Exception('Geo_IP: Внутренняя ошибка сервера');
                        break;
                    case 162:
                        throw new Exception('Geo_IP: Идентификатор сайта не указан');
                        break;
                    case 163:
                        throw new Exception('Geo_IP: Идентификатор сайта содержит ошибку или не зарегистрирован');
                        break;
                    case 200:
                        throw new Exception('Geo_IP: Ошибка соединения с сервером');
                        break;
                    case 205:
                        throw new Exception('Geo_IP: Нет данных по запросу');
                        break;
                }
            }
// возвращаем полученные данные в виде массива
            return $arrayData['GeoIP']['GeoAddr'][0];

        } else {
// если ответа от сервера не дождались вбрасываем исключение
            throw new Exception('Geo_IP: Нет связи с сервером');
        }

    }

    public function handleKeys()
    {

        if (isset($_POST['handle'])) {
            if (isset($_POST['sendCheck'])) {
                foreach ($_SESSION['keys'] as $email => $key) {
                    $str = file_get_contents(ROOT_DIR . '/templates/layouts/mail.php');
                    $phrase = $str;
                    $old = array("KEY");
                    $new = array($key);
                    $newphrase = str_replace($old, $new, $phrase);
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset="utf-8"' . "\r\n";
                    $headers .= "From: Lant.io <noreply@lant.io>\r\n";
                    mail($email, "Альфа ключ", $newphrase, $headers);
                }
            }
            if (isset($_POST['dbCheck'])) {
                foreach ($_SESSION['keys'] as $email => $key) {
                    $date = new DateTime();
                    $inactiveDate = new DateTime();
                    $inactiveDate->add(new DateInterval('P1M'));
                    $this->db->query("INSERT INTO access (email, key, email_sent, creation_date, inactive_date, status) VALUES (NULL, '{$key}', '{$email}', '{$date->format('Y-m-d')}', '{$inactiveDate->format('Y-m-d')}', 0)");
                }
            }
//            print_r($this->db->errorInfo());
            unset($_SESSION['keys']);
        }
    }

    public function generate()
    {
        if (isset($_POST['generate'])) {
            $_SESSION['keys'] = $this->composeKeysData($this->handleEmails());
        }
    }

    private function composeKeysData($emails)
    {
        $keys = array();

        foreach ($emails as $email) {
            $keys[$email] = $this->getKey($email);
        }

        return $keys;
    }

    private function handleEmails()
    {
        $explodedEmails = explode("\n", $_POST['emails']);
        $emails = array();

        foreach ($explodedEmails as $email) {
            if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                array_push($emails, trim($email));
            } else {
                continue;
            }
        }

        return $emails;
    }

    private function getKey($string)
    {
        $emailSHA = sha1($string);
        $selection = $emailSHA['35'] . $emailSHA['22'] . $emailSHA['1'] . $emailSHA['3'] . $emailSHA['4'] . $emailSHA['8'] . $emailSHA['12'] . $emailSHA['15'] . $emailSHA['17'] . $emailSHA['29'];
        $selectionMD5 = md5($selection);

        $key = $selectionMD5['3'] . $selectionMD5['4'] . $selectionMD5['7'] . $selectionMD5['1'] . '-';
        $key .= $selectionMD5['10'] . $selectionMD5['30'] . $selectionMD5['12'] . $selectionMD5['8'] . '-';
        $key .= $selectionMD5['15'] . $selectionMD5['6'] . $selectionMD5['9'] . $selectionMD5['11'] . '-';
        $key .= $selectionMD5['19'] . $selectionMD5['21'] . $selectionMD5['25'] . $selectionMD5['26'];
        return strtoupper($key);
    }

    public function numberofpages()
    {
        $array = [];
        $stmt = $this->db->prepare("SELECT * FROM access");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $_SESSION['keys_keyeditor'] = $result;
        foreach ($_SESSION['keys_keyeditor'] as $key) {
            $array[$key['id']] = $key;
        }

        if (count($array) % self::IDSPERPAGE == 0)
            $result = count($array) / self::IDSPERPAGE;
        else
            $result = (count($array) / self::IDSPERPAGE) + 1;
        $_SESSION['numberofpages'] = $result;
    }

    public function showdb()
    {
        unset($_SESSION['sessioncheck']);
        $this->numberofpages();
        if (isset($_POST['showdb'])) {
            unset($_SESSION['id_key_keyeditor']);
            $stmt = $this->db->prepare("SELECT * FROM access");
            $stmt->execute();
            $result = $stmt->fetchAll();
            $_SESSION['keys_keyeditor'] = $result;
            $result = '';
            $array = [];
            $temp = [];

            if (isset($_POST['showdb'])) {
                foreach ($_SESSION['keys_keyeditor'] as $key) {
                    $array[$key['id']] = $key;
                }

                for ($i = 1; $i <= count($array); $i++) { // сортировка
                    $temp[$i] = $array[$i];
                }
                $array = $temp;


                foreach ($array as $info) {
                    $part = "ID - {$info['id']}" . '<br>' . "Key - {$info['key']}" . '<br>' . "Email - {$info['email']}" .
                        '<br>' . "Email_sent - {$info['email_sent']}" . '<br>' . "Creation_date - {$info['creation_date']}" .
                        '<br>' . "Inactive date - {$info['inactive_date']}" . '<br>';

                    $var0 = "0";
                    $var1 = "1";
                    $var2 = "2";
                    $var = $info['status'];

                    if (strcasecmp($var, $var0) == 0)
                        $part .= "Status - " . '<font color=grey>' . "Inactive" . '</font>' . '<br>' . '<br>';
                    if (strcasecmp($var, $var1) == 0)
                        $part .= "Status - " . '<font color=#00FF00>' . "Active" . '</font>' . '<br>' . '<br>';
                    if (strcasecmp($var, $var2) == 0)
                        $part .= "Status - " . '<font color=red>' . "Banned" . '</font>' . '<br>' . '<br>';
                    $result .= $part;
                }
            }
            return $result;
        }
        return false;
    }

    public function keyeditor()
    {
        if (isset($_POST['idworkgo'])) {
            $id_key = $_POST['id_key_keyeditor'];
            $array = [];

            foreach ($_SESSION['keys_keyeditor'] as $key) {
                $array[$key['id']] = $key;
            }
            if (isset($array[$id_key])) {
                $part = "ID - {$array[$id_key]['id']}" . '<br>' . "Key - {$array[$id_key]['key']}" . '<br>' . "Email - {$array[$id_key]['email']}" .
                    '<br>' . "Email_sent - {$array[$id_key]['email_sent']}" . '<br>' . "Creation_date - {$array[$id_key]['creation_date']}" .
                    '<br>' . "Inactive date - {$array[$id_key]['inactive_date']}" . '<br>';

                $var0 = "0";
                $var1 = "1";
                $var2 = "2";
                $var = $array[$id_key]['status'];

                if (strcasecmp($var, $var0) == 0)
                    $part .= "Status - " . '<font color=grey>' . "Inactive" . '</font>' . '<br>' . '<br>';
                if (strcasecmp($var, $var1) == 0)
                    $part .= "Status - " . '<font color=#00FF00>' . "Active" . '</font>' . '<br>' . '<br>';
                if (strcasecmp($var, $var2) == 0)
                    $part .= "Status - " . '<font color=red>' . "Banned" . '</font>' . '<br>' . '<br>';

                $result = $part;
                $_SESSION['notice_id'] = $array[$id_key]['id'];
                $_SESSION['id_key_keyeditor'] = $id_key;
                $_SESSION['array_keyeditor'] = $array[$id_key];
                $_SESSION['sessioncheck'] = 1;
                return $result;
            } else {
                $result = "ID = $id_key отсутсвует!";
                return $result;
            }
        }
        if (isset($_POST['keyworkgo'])) {
            $id_key = $_POST['key_key_keyeditor'];

            $array = [];

            foreach ($_SESSION['keys_keyeditor'] as $key) {
                $array[$key['key']] = $key;
            }

            if (isset($array[$id_key])) {
                $part = "ID - {$array[$id_key]['id']}" . '<br>' . "Key - {$array[$id_key]['key']}" . '<br>' . "Email - {$array[$id_key]['email']}" .
                    '<br>' . "Email_sent - {$array[$id_key]['email_sent']}" . '<br>' . "Creation_date - {$array[$id_key]['creation_date']}" .
                    '<br>' . "Inactive date - {$array[$id_key]['inactive_date']}" . '<br>';

                $var0 = "0";
                $var1 = "1";
                $var2 = "2";
                $var = $array[$id_key]['status'];

                if (strcasecmp($var, $var0) == 0)
                    $part .= "Status - Inactive" . '<br>' . '<br>';
                if (strcasecmp($var, $var1) == 0)
                    $part .= "Status - Active" . '<br>' . '<br>';
                if (strcasecmp($var, $var2) == 0)
                    $part .= "Status - Banned" . '<br>' . '<br>';

                $result = $part;
                $_SESSION['notice_id'] = $array[$id_key]['id'];


                $_SESSION['id_key_keyeditor'] = $array[$id_key]['id'];
                $_SESSION['array_keyeditor'] = $array[$id_key];

                return $result;
            } else {
                $result = "KEY = $id_key отсутсвует!";
                return $result;
            }
        }
        if (isset($_POST['updateinfo'])) {
            $array = ($_SESSION['array_keyeditor']);
            $id_key = $array['id'];

            foreach ($_SESSION['keys_keyeditor'] as $key) {
                $array[$key['id']] = $key;
            }
            if (isset($array[$id_key])) {
                $part = "ID - {$array[$id_key]['id']}" . '<br>' . "Key - {$array[$id_key]['key']}" . '<br>' . "Email - {$array[$id_key]['email']}" .
                    '<br>' . "Email_sent - {$array[$id_key]['email_sent']}" . '<br>' . "Creation_date - {$array[$id_key]['creation_date']}" .
                    '<br>' . "Inactive date - {$array[$id_key]['inactive_date']}" . '<br>';

                $var0 = "0";
                $var1 = "1";
                $var2 = "2";
                $var = $array[$id_key]['status'];

                if (strcasecmp($var, $var0) == 0)
                    $part .= "Status - Inactive" . '<br>' . '<br>';
                if (strcasecmp($var, $var1) == 0)
                    $part .= "Status - Active" . '<br>' . '<br>';
                if (strcasecmp($var, $var2) == 0)
                    $part .= "Status - Banned" . '<br>' . '<br>';

                $result = $part;
                $_SESSION['notice_id'] = $array[$id_key]['id'];
                $_SESSION['id_key_keyeditor'] = $id_key;
                $_SESSION['array_keyeditor'] = $array[$id_key];
                return $result;
            }
        }
        return false;
    }

    public function keylock()
    {
        if (isset($_POST['lock'])) {
            $this->db->query("UPDATE access SET status = 2 WHERE id = {$_SESSION['id_key_keyeditor']}");
            $result = "{$_SESSION['array_keyeditor']['key']} заблокирован!";
            return $result;
        }
        return false;
    }

    public function keyunlock()
    {
        if (isset($_POST['unlock'])) {
            $today = date("Ymd");
            $arraytime = explode("-", $_SESSION['array_keyeditor']['inactive_date']);
            $checkdate = $arraytime[0] . $arraytime[1] . $arraytime[2];
            if ($checkdate > $today) {
                $this->db->query("UPDATE access SET status = 1 WHERE id = {$_SESSION['id_key_keyeditor']}");
                $result = "{$_SESSION['array_keyeditor']['key']} разблокирован!";
                return $result;
            } else
                $result = "Ключ просрочен!";
            return $result;
        }
    }

    public function installdate()
    {
        if (isset($_POST['installdate'])) {
            $day = $_POST['day'];
            $month = $_POST['month'];
            $year = $_POST['year'];
            $flag = true;
            if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) {
                if ($day > 31) {
                    $flag = false;
                }
            }

            if ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
                if ($day > 30) {
                    $flag = false;
                }
            }
            if ($month == 2) {
                if ($day > 28) {
                    $flag = false;
                }
            }
            if ($month > 12) {
                $flag = false;
            }

            if ($flag == true) {
                $date = "{$year}-{$month}-{$day}";
                $this->db->query("UPDATE access SET inactive_date = '{$date}' WHERE id = {$_SESSION['id_key_keyeditor']}");
                $result = "Срок действия ключа {$_SESSION['array_keyeditor']['key']} истекает {$date}";
                return $result;

            } else {
                $result = "Ошибка записи даты!";
                return $result;
            }
        }
        if (isset($_POST['installemail'])) {
            $email = $_POST['new_email'];
            if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $this->db->query("UPDATE access SET email = '{$email}' WHERE id = {$_SESSION['id_key_keyeditor']}");
                $result = "Email ключа {$_SESSION['array_keyeditor']['key']} изменен на {$email}";
            }
            else
                $result = 'Email введ неверно!';
            return $result;
        }
        return false;
    }

    public function page()
    {
        $count = $_SESSION["numberofpages"];
        $idsperpage = self::IDSPERPAGE;

        for ($i = 1; $i <= $count; $i++) {
            if (isset($_POST["page" . $i])) {

                $stmt = $this->db->prepare("SELECT * FROM access WHERE id >= ((($i-1) * $idsperpage) + 1) AND id <= ($i * $idsperpage)");
                $stmt->execute();
                $result = $stmt->fetchAll();
                $_SESSION['keys_keyeditor'] = $result;
                $result = '';
                $array = [];
                $temp = [];

                foreach ($_SESSION['keys_keyeditor'] as $key) {
                    $array[$key['id']] = $key;
                }

                $a = count($array);

                for ($j = ((($i-1) * $idsperpage) + 1); $j <= ((($i-1) * $idsperpage) + 1) + $a - 1; $j++) { // сортировка
                    $temp[$j] = $array[$j];
                }
                $array = $temp;

                foreach ($array as $info) {
                    $part = "ID - {$info['id']}" . '<br>' . "Key - {$info['key']}" . '<br>' . "Email - {$info['email']}" .
                        '<br>' . "Email_sent - {$info['email_sent']}" . '<br>' . "Creation_date - {$info['creation_date']}" .
                        '<br>' . "Inactive date - {$info['inactive_date']}" . '<br>';

                    $var0 = "0";
                    $var1 = "1";
                    $var2 = "2";
                    $var = $info['status'];

                    if (strcasecmp($var, $var0) == 0)
                        $part .= "Status - Inactive" . '<br>' . '<br>';
                    if (strcasecmp($var, $var1) == 0)
                        $part .= "Status - Active" . '<br>' . '<br>';
                    if (strcasecmp($var, $var2) == 0)
                        $part .= "Status - Banned" . '<br>' . '<br>';
                    $result .= $part;
                }
                return $result;
            }
        }
    }
}
