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
//        $_SESSION['userID'] = 1;
        $profile_id = $_SESSION['userID'];

        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = $profile_id");
        $stmt->execute();
        $info = $stmt->fetchAll();
        return $info;
    }

    public function savePersonalInfo()
    {
//        $_SESSION['userID'] = 1;
        $profile_id = $_SESSION['userID'];

        if (isset($_POST['save_1']))
        {
            $this->db->query("UPDATE users SET first_name = '{$_POST['name']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET last_name = '{$_POST['surname']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET patronymic = '{$_POST['patronymic']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET birthday = '{$_POST['date']}' WHERE id = $profile_id");
            $this->db->query("UPDATE users SET phone_number = '{$_POST['phonenumber']}' WHERE id = $profile_id");
        }

        if (isset($_POST['save_2']))
        {
            $this->db->query("UPDATE users SET email = '{$_POST['email']}' WHERE id = $profile_id");
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
    }

    public function handleKeys()
    {

        if (isset($_POST['handle'])) {
            if (isset($_POST['sendCheck'])) {
                foreach ($_SESSION['keys'] as $email => $key) {
                    $str = file_get_contents(ROOT_DIR . '/templates/layouts/mail.php');

                    $str = file_get_contents(ROOT_DIR . '/templates/layouts/mail.php');
                    $str_text = file_get_contents(ROOT_DIR . '/templates/layouts/mail_text.php');
                    $phrase = $str;
                    $old = array("KEY");
                    $new = array($key);
                    $newphrase = str_replace($old, $new, $phrase);
                    $newphrase = base64_encode($newphrase);

                    $phrase = $str_text;
                    $old = array("KEY");
                    $new = array($key);
                    $newphrase_text = str_replace($old, $new, $phrase);
                    $newphrase_text = base64_encode($newphrase_text);

                    $subject = 'Alpha KEY';
                    $boundary = uniqid('np');

                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset="utf-8"' . "\r\n";
                    $headers .= "From: Lant.io <noreply@lant.io>\r\n";
                    mail($email, "Альфа ключ", $newphrase, $headers);
                    $headers .= "From: Lant.io <noreply@lant.io>\r\n";
                    $headers .= "To: ".$email."\r\n";
                    $headers .= "Content-Type: multipart/alternative;boundary=" . $boundary . "\r\n";

                    $message = "This is a MIME encoded message.";
                    $message .= "\r\n\r\n--" . $boundary . "\r\n";
                    $message .= "Content-type: text/plain;charset=utf-8\r\n\r\n";
                    $message .= "Content-Transfer-Encoding: base64\r\n";
                    //Plain text body
                    $message .= $newphrase_text;
                    $message .= "\r\n\r\n--" . $boundary . "\r\n";
                    $message .= "Content-type: text/html;charset=utf-8\r\n";
                    $message .= "Content-Transfer-Encoding: base64\r\n";

                    //Html body
                    $message .= $newphrase;
                    $message .= "\r\n\r\n--" . $boundary . "--";

                    mail('', $subject, $message, $headers, "-fnoreply@lant.io");

//                    $text_header =
//                        "Content-Type: text/plain; charset=UTF-8\r\n" .
//                        "Content-Transfer-Encoding: base64\r\n";

                    //mail($email, "Альфа ключ", $newphrase, $headers, "-fnoreply@lant.io");
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
                        $part .= "Status - Inactive" . '<br>' . '<br>';
                    if (strcasecmp($var, $var1) == 0)
                        $part .= "Status - Active" . '<br>' . '<br>';
                    if (strcasecmp($var, $var2) == 0)
                        $part .= "Status - Banned" . '<br>' . '<br>';
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
                    $part .= "Status - Inactive" . '<br>' . '<br>';
                if (strcasecmp($var, $var1) == 0)
                    $part .= "Status - Active" . '<br>' . '<br>';
                if (strcasecmp($var, $var2) == 0)
                    $part .= "Status - Banned" . '<br>' . '<br>';

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
