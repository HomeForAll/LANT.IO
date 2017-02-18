<?php

class CabinetModel extends Model
{
    const IDSPERPAGE = 5;
    private $mailer;


    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function open_chat()
    {
    }

    public function delete_all_dialogs()
    {
        $profile_id = $_SESSION['userID'];
        $this->db->query("UPDATE dialogs SET show = 0 WHERE user_id= $profile_id");
        return $this->getdialogs();
    }

    public function return_dialog()
    {
        $profile_id = $_SESSION['userID'];

        $stmt = $this->db->prepare("SELECT * FROM dialogs WHERE user_id= $profile_id AND show= 0");
        $stmt->execute();
        $dialogs = $stmt->fetchAll();

        $i_max = 0;

        foreach ($dialogs as $value) {
            $i_max++;
        }
        $_SESSION['count_of_dialogs'] = $i_max;
//$_SESSION['count_of_users'] = $i_max;   // CRITICAL MISTAKE EXPERCTED!!!!!!!!!!!!!!!!

        foreach ($dialogs as $key => $value) {
            $matrix[$key][0] = $value[0];
            $this->db->query("UPDATE dialogs_properties SET date_of_delete = NULL WHERE id = {$matrix[$key][0]}");

            $stmt = $this->db->prepare("SELECT name FROM dialogs_properties WHERE id = {$matrix[$key][0]}");
            $stmt->execute();
            $name = $stmt->fetchAll();

            $matrix[$key][1] = $name[0][0];
        }

        if (isset($matrix)) {
            $_SESSION['matrix_for_dialogs'] = $matrix;
        }

        for ($i = 0; $i <= $_SESSION['count_of_dialogs']; $i++) {
            if (isset($_POST["return" . $i])) {
                if (($_SESSION['matrix_for_dialogs'][$i][0])) {
                    $this->db->query("UPDATE dialogs SET show = 1 WHERE id = {$_SESSION['matrix_for_dialogs'][$i][0]} AND user_id = {$profile_id}");
                }
            }
        }
        return $this->getdialogs();
    }

    public function turn_back_dialog()
    {
        $profile_id = $_SESSION['userID'];
        if (isset($_SESSION['last_deleted_dialog'])) {
            $this->db->query("UPDATE dialogs SET show = 1 WHERE id = {$_SESSION['last_deleted_dialog']} AND user_id= $profile_id");
            $this->db->query("UPDATE dialogs_properties SET date_of_delete = NULL WHERE id = {$_SESSION['last_deleted_dialog']}");
            unset($_SESSION['last_deleted_dialog']);
            unset($_SESSION['last_deleted_dialog_name']);
        }
        return $this->getdialogs();
    }

    public function getdialogs()
    {
        unset($_SESSION['deleted_dialogs_button']);
        $_SESSION['count_of_dialogs'] = 0;
        $profile_id = $_SESSION['userID'];

        $stmt = $this->db->prepare("SELECT * FROM dialogs WHERE user_id= $profile_id AND show= 0");
        $stmt->execute();
        $dialogs = $stmt->fetchAll();
        $i_max = 0;
        foreach ($dialogs as $value) {
            $i_max++;
        }
        $count_of_dialogs_deleted = $i_max;
        $_SESSION['count_of_dialogs_deleted'] = $count_of_dialogs_deleted;
        
        if (!isset($_POST['deleted_dialogs'])) {
            $stmt = $this->db->prepare("SELECT * FROM dialogs WHERE user_id= $profile_id AND show= 1");
            $stmt->execute();
            $dialogs = $stmt->fetchAll();
        } else {
            $stmt = $this->db->prepare("SELECT * FROM dialogs WHERE user_id= $profile_id AND show= 0");
            $stmt->execute();
            $dialogs = $stmt->fetchAll();
        }
        $i_max = 0;
        foreach ($dialogs as $value) {
            $i_max++;
        }
        $_SESSION['count_of_dialogs'] = $i_max;
        //$_SESSION['count_of_users'] = $i_max;   // CRITICAL MISTAKE EXPERCTED!!!!!!!!!!!!!!!!

        foreach ($dialogs as $key => $value) {
            $matrix[$key][0] = $value[0];

            if (isset($_POST['deleted_dialogs'])) {
                $_SESSION['deleted_dialogs_button'] = 1;
                $stmt = $this->db->prepare("SELECT date_of_delete FROM dialogs_properties WHERE id = {$matrix[$key][0]}");
                $stmt->execute();
                $date_of_delete = $stmt->fetchAll();

                if (($date_of_delete[0]['date_of_delete'])) {

                    $today = date('Y-m-d');

                    $result = ($today < $date_of_delete[0]['date_of_delete']);
                    if ($result == true) {
                        $matrix[$key][2] = $date_of_delete[0]['date_of_delete'];
                    } else {
                        // DELETE DIALOG
                    }
                } else {
                    $stmt = $this->db->prepare("SELECT owners FROM dialogs_properties WHERE id = {$matrix[$key][0]}");
                    $stmt->execute();
                    $owners = $stmt->fetchAll();

                    $massiv_owners = $owners[0]['owners'];
                    $massiv_owners = explode(",", $massiv_owners);

                    $full_delete_dialog_flag = true;
                    foreach ($massiv_owners as $value) {
                        $stmt = $this->db->prepare("SELECT show FROM dialogs WHERE id = {$matrix[$key][0]} AND user_id = $value");
                        $stmt->execute();
                        $show = $stmt->fetchAll();

                        if ($show[0]['show'] == 1) {
                            $full_delete_dialog_flag = false;
                        }
                    }
                    if ($full_delete_dialog_flag == true) {
                        $inactiveDate = new DateTime();
                        $inactiveDate->add(new DateInterval('P3M'));
                        $date_of_delete = $inactiveDate->format('Y-m-d');
                        $this->db->query("UPDATE dialogs_properties SET date_of_delete = '{$date_of_delete}' WHERE id = {$matrix[$key][0]}");
                    }
                }
            }

            $stmt = $this->db->prepare("SELECT name FROM dialogs_properties WHERE id = {$matrix[$key][0]}");
            $stmt->execute();
            $name = $stmt->fetchAll();

            $stmt = $this->db->prepare("SELECT owners FROM dialogs_properties WHERE id = {$matrix[$key][0]}");
            $stmt->execute();
            $owners = $stmt->fetchAll();
            $massiv_owners = $owners[0]['owners'];
            $massiv_owners = explode(",", $massiv_owners);

            if (isset($massiv_owners[2]))
                $matrix[$key][1] = $name[0][0];
            else
            {
                foreach ($massiv_owners as $k => $z)
                {
                    if ($z != $profile_id)
                    {
                        $stmt = $this->db->prepare("SELECT first_name FROM users WHERE id = {$z}");
                        $stmt->execute();
                        $name = $stmt->fetchAll();
                        $matrix[$key][1] = $name[0][0];
                        $matrix[$key][1] .= ' ';
                        $stmt = $this->db->prepare("SELECT last_name FROM users WHERE id = {$z}");
                        $stmt->execute();
                        $name = $stmt->fetchAll();
                        $matrix[$key][1] .= $name[0][0];
                    }
                }
            }
        }

        if (isset($matrix)) {
            $_SESSION['matrix_for_dialogs'] = $matrix;
            return $matrix;
        }
    }

    public function delete_dialog($i)
    {
        $profile_id = $_SESSION['userID'];

        if (!isset($_SESSION['last_deleted_dialog'])) {
            if (($_SESSION['matrix_for_dialogs'][$i][0])) {
                $matrix = $_SESSION['matrix_for_dialogs'][$i];

                $this->db->query("UPDATE dialogs SET show = 0 WHERE id = {$matrix[0]} AND user_id = {$profile_id}");

                $_SESSION['last_deleted_dialog'] = $matrix[0];
                $_SESSION['last_deleted_dialog_name'] = $matrix[1];
            }
        }
        return $this->getdialogs();
    }

    public function create_new_dialog()
    {
        $admin_status = 5;
        $profile_id = $_SESSION['userID'];
        if (isset($_POST['add_user']) || (isset($_POST['add_admin']))) {
            $matrix = $_SESSION['matrix_for_dialogs'][$_SESSION['chat']];
            $matrix = $matrix[0];
            $stmt = $this->db->prepare("SELECT owners FROM dialogs_properties WHERE id = {$matrix}");
            $stmt->execute();
            $chat_owner = $stmt->fetchAll();

            $chat_owners = explode(",", $chat_owner[0]['owners']);

            $query = 'SELECT * FROM users WHERE id != ';
            foreach ($chat_owners as $value => $key) {
                if ($value == 0)
                    $query .= $key;
                else
                    $query .= ' AND id != ' . $key;
            }

            if (isset($_POST['add_admin']))
                $query .= ' AND status = ' . $admin_status;
            else
                $query .= ' AND status != ' . $admin_status;

            $stmt = $this->db->prepare($query);
        } else {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id != {$profile_id} AND status != " . $admin_status);
        }
        $stmt->execute();
        $users = $stmt->fetchAll();
        $arrays_num = 0;
        $i_max = 0;

        foreach ($users as $value) {
            $i_max++;
        }

        $matrix = [];

        $_SESSION['count_of_users'] = $i_max;

        foreach ($users as $key => $value) {
            $matrix[$key][1] = $value[1];
            $matrix[$key][2] = $value[2];
            $arrays_num++;
        }

        if (isset($matrix)) {
            $_SESSION['matrix_for_users'] = $matrix;
            return $matrix;
        }
    }

    public function add_dialog()
    {
        $profile_id = $_SESSION['userID'];
        $count_of_owners = 0;
        $massiv = [];
        $flag_user_selected = false;
        $count_of_dialogs = 0;
        $massiv_dialogs = [];
        $new_owners = '';

        if (isset($_POST['add_user_yes'])) {
            for ($i = 0; $i < $_SESSION['count_of_users']; $i++) {
                $name = "add_user" . $i;

                if (isset($_POST[$name])) {
                    $stmt = $this->db->prepare("SELECT id FROM users WHERE first_name = '{$_SESSION['matrix_for_users'][$i][1]}' AND last_name = '{$_SESSION['matrix_for_users'][$i][2]}'");
                    $stmt->execute();
                    $user_dialog = $stmt->fetchAll();
                    $names_of_users[$count_of_owners] = $_SESSION['matrix_for_users'][$i][1];
                    $massiv[$count_of_owners] = $user_dialog[0][0];
                    $count_of_owners++;
                    $flag_user_selected = true;
                }
            }


            if ($flag_user_selected == true) {
                $matrix = $_SESSION['matrix_for_dialogs'][$_SESSION['chat']];
                $matrix = $matrix[0];

                $stmt = $this->db->prepare("SELECT owners FROM dialogs_properties WHERE id = {$matrix}");
                $stmt->execute();
                $users_dialog = $stmt->fetchAll();
                $stmt = $this->db->prepare("SELECT name FROM dialogs_properties WHERE id = {$matrix}");
                $stmt->execute();
                $names_dialog = $stmt->fetchAll();

                $array_users = explode(",", $users_dialog[0][0]);
                $array_names = explode(",", $names_dialog[0][0]);

                $count = 0;
                $new_owners_names = '';

                foreach ($array_users as $value => $key)
                    $massiv[$count_of_owners + $value] = $key;

                foreach ($array_names as $value => $key) {
                    if (count($array_users) == 2) {
                        $matrix = ($_SESSION['matrix_for_dialogs'][$_SESSION['chat']]);
                        $matrix = $matrix[1];
                        $name_parts = explode(' ', $matrix);
                        $names_of_users[$count_of_owners + $value] = $name_parts[0];

                        $stmt = $this->db->prepare("SELECT first_name FROM users WHERE id = {$profile_id}");
                        $stmt->execute();
                        $name = $stmt->fetchAll();

                        $names_of_users[$count_of_owners + $value + 1] = $name[0]['first_name'];
                    } else {
                        $names_of_users[$count_of_owners + $value] = $key;
                    }
                }


                sort($massiv);
                foreach ($massiv as $value)
                    $count++;

                for ($j = 0; $j < $count; $j++) {
                    if ($j == 0) {
                        $new_owners = $massiv[$j];
                        $new_owners_names = $names_of_users[$j];
                    } else {
                        $new_owners .= ',' . $massiv[$j];
                        $new_owners_names .= ',' . $names_of_users[$j];
                    }
                }
            } else {
                echo 'ne vibral';
                $_POST['add_user'] = 1;
                return $this->create_new_dialog();
            }
        }


        if (isset($_POST["add_users"])) {
            for ($i = 0; $i < $_SESSION['count_of_users']; $i++) {
                $name = "add" . $i;

                if (isset($_POST[$name])) {
                    $stmt = $this->db->prepare("SELECT id FROM users WHERE first_name = '{$_SESSION['matrix_for_users'][$i][1]}' AND last_name = '{$_SESSION['matrix_for_users'][$i][2]}'");
                    $stmt->execute();
                    $user_dialog = $stmt->fetchAll();
                    $names_of_users[$count_of_owners] = $_SESSION['matrix_for_users'][$i][1];
                    $massiv[$count_of_owners] = $user_dialog[0][0];
                    $count_of_owners++;
                    $massiv[$count_of_owners] = $profile_id;
                    $flag_user_selected = true;
                    $number_for_solo_dialog = $i;
                }
            }


            if ($flag_user_selected == true) {
                $stmt = $this->db->prepare("SELECT * FROM users WHERE id = $profile_id");
                $stmt->execute();
                $user_owner = $stmt->fetchAll();
                $names_of_users[$count_of_owners] = ($user_owner[0]['first_name']);

                sort($massiv);

                $count = 0;
                $new_owners_names = '';
                foreach ($massiv as $value)
                    $count++;
                for ($j = 0; $j < $count; $j++) {
                    if ($j == 0) {
                        $new_owners = $massiv[$j];
                        $new_owners_names = $names_of_users[$j];
                    } else {
                        $new_owners .= ',' . $massiv[$j];
                        $new_owners_names .= ',' . $names_of_users[$j];
                    }
                }

                if ($count_of_owners == 1)
                    $new_owners_names = $_SESSION['matrix_for_users'][$number_for_solo_dialog][1] . ' ' . $_SESSION['matrix_for_users'][$number_for_solo_dialog][2];

                $query = "SELECT id FROM dialogs WHERE ";
                $query .= "user_id = ";
                $query .= $profile_id;
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                $dialog = $stmt->fetchAll();

                foreach ($dialog as $value)
                    $count_of_dialogs++;

                for ($j = 0; $j < $count_of_dialogs; $j++) {
                    $query = "SELECT owners FROM dialogs_properties WHERE id = {$dialog[$j][0]}";
                    $stmt = $this->db->prepare($query);
                    $stmt->execute();
                    $flag_dialog_exist = $stmt->fetchAll();
                    $massiv_dialogs[$j] = $flag_dialog_exist[0][0];
                }

                $flag = false;
                for ($j = 0; $j < $count_of_dialogs; $j++) {
                    if ($new_owners == $massiv_dialogs[$j]) {
                        $query = "SELECT id FROM dialogs_properties WHERE owners = '{$new_owners}'";
                        $stmt = $this->db->prepare($query);
                        $stmt->execute();
                        $id = $stmt->fetchAll();
                        foreach ($_SESSION['matrix_for_dialogs'] as $key => $value) {
                            if ($value[0] == $id[0]['id'])
                            {
                                $_SESSION['chat'] = $key;
                                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet/chat');
                                exit;
                            }
                        }
                    }
                }

                if ($flag == false) {
                    $query = $this->db->prepare("INSERT INTO dialogs_properties (name, owners) VALUES (:name, :owners) RETURNING id");
                    $query->execute([
                        ':name' => $new_owners_names,
                        ':owners' => $new_owners,
                    ]);
                    $result = $query->fetch();

                    $query = $this->db->prepare("INSERT INTO dialogs (id, user_id, show) VALUES (:id, :user_id, :show)");
                    foreach ($massiv as $key => $value) {
                        $query->execute([
                            ':id' => $result[0],
                            ':user_id' => $massiv[$key],
                            ':show' => 1,
                        ]);
                    }
                    return $this->getdialogs();
                }
            } else {
                echo 'Не выбран!';
                $_POST['create_new_dialog'] = 1;
                return $this->create_new_dialog();
            }
        }
    }

    public
    function getgadgets()
    {
        //$_SESSION['userID'] = 1;
        $profile_id = $_SESSION['userID'];

        $stmt = $this->db->prepare("SELECT * FROM sessions WHERE id_user = $profile_id");
        $stmt->execute();
        $gadgets = $stmt->fetchAll();
        $arrays_num = 0;
        $i_max = 0;

        foreach ($gadgets as $value) {
            $i_max++;
        }
        $_SESSION['count_of_delete_buttons_for_gadgets'] = $i_max;

        foreach ($gadgets as $key => $value) {
            $matrix[$key][0] = $value[3];
            $matrix[$key][1] = $value[1];
            $arrays_num++;
        }

        if (isset($matrix)) {
            $_SESSION['matrix_for_gadgets'] = $matrix;
            return $matrix;
        }
    }

    public
    function delete_gadget()
    {
        $profile_id = $_SESSION['userID'];
        for ($i = 0; $i <= $_SESSION['count_of_delete_buttons_for_gadgets']; $i++) {
            if (isset($_POST["delete" . $i])) {
                $matrix = $_SESSION['matrix_for_gadgets'][$i];
                $stmt = $this->db->prepare("DELETE FROM sessions WHERE name_session = '{$matrix[1]}' and id_user = $profile_id");
                $stmt->execute();
                if ($_SESSION['matrix_for_gadgets'][$i][1] == session_id()) {
                    session_destroy();
                    header('Location: http://' . $_SERVER['HTTP_HOST']);
                    exit;
                }
            }
        }
        return $this->getgadgets();
    }

    public
    function ajaxHandler()
    {
    }

    public
    function getinfo()
    {
        //$_SESSION['userID'] = 1;
        $profile_id = $_SESSION['userID'];

        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = $profile_id");
        $stmt->execute();
        $info = $stmt->fetchAll();
        return $info;
    }

    public
    function showActivity()
    {
    }

    public
    function savePersonalInfo()
    {
        //$_SESSION['userID'] = 3;
        $_SESSION['error'] = [];
        $profile_id = $_SESSION['userID'];


        $n = 4; // kol-vo post dlia proverki
        for ($i = 0; $i <= $n - 1; $i++) {
            $error_array[$i] = "";
            $_SESSION['error'][$i] = 0;
        }

        if (isset($_POST['save_1'])) {
            $str = $_POST['name'];
            $str = trim($str);
            $pattern = "/([a-z0-9])+/i";
            if (preg_match($pattern, $str, $matches))
                $error_array[0] = 1;
            if ($str == '')
                $error_array[0] = 1;
            $_POST['name'] = $str;
            if ($error_array[0] == 0)
                $this->db->query("UPDATE users SET first_name = '{$_POST['name']}' WHERE id = $profile_id");

            $str = $_POST['surname'];
            $str = trim($str);
            $pattern = "/([a-z0-9])+/i";
            if (preg_match($pattern, $str, $matches))
                $error_array[1] = 1;
            if ($str == '')
                $error_array[1] = 1;
            $_POST['surname'] = $str;
            if ($error_array[1] == 0)
                $this->db->query("UPDATE users SET last_name = '{$_POST['surname']}' WHERE id = $profile_id");

            $str = $_POST['patronymic'];
            $str = trim($str);
            $pattern = "/([a-z0-9])+/i";
            if (preg_match($pattern, $str, $matches))
                $error_array[2] = 1;
            if ($str == '')
                $error_array[2] = 1;
            $_POST['patronymic'] = $str;
            if ($error_array[2] == 0)
                $this->db->query("UPDATE users SET patronymic = '{$_POST['patronymic']}' WHERE id = $profile_id");

            $_SESSION['phone_error'] = 0;
            $str = $_POST['phonenumber'];
            $old_str = $str;
            $str = trim($str);
            $str = preg_replace("/[^0-9]/", '', $str);
            $_POST['phonenumber'] = $str;
            if ($old_str != $str)
                $_SESSION['phone_error'] = 1;
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
                } else {
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

            $_SESSION['email_error'] = 0;
            if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
                $this->db->query("UPDATE users SET email = '{$_POST['email']}' WHERE id = $profile_id");
            } else {
                $_SESSION['email_error'] = 1;
            }

            $_SESSION['error'] = $error_array;
            $this->db->query("UPDATE users SET profile_foto_id = '{$_POST['profile_foto']}' WHERE id = $profile_id");
        }

        if (isset($_POST['delete_vk']) || (isset($_POST['delete_steam'])) || (isset($_POST['delete_ok'])) || (isset($_POST['delete_ya'])) || (isset($_POST['delete_mail'])) || (isset($_POST['delete_facebook'])) || (isset($_POST['delete_google'])))
        {
            foreach ($_POST as $key => $value) {
                if ($value == 'Отвязать')
                {
                    $social_net = explode("_", $key);
                    if (isset($social_net[1])) {
                        $id = $social_net[1] . "_id";
                        $name = $social_net[1] . "_name";
                        $avatar = $social_net[1] . "_avatar";
                        $this->db->query("UPDATE users SET {$id} = NULL WHERE id = $profile_id");
                        $this->db->query("UPDATE users SET {$name} = NULL WHERE id = $profile_id");
                        $this->db->query("UPDATE users SET {$avatar} = NULL WHERE id = $profile_id");
                    }
                }
            }
        }


        // save_2 отсутсвует! Удалена по ненадобности.
        if (isset($_POST['save_3'])) {
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

        if (isset($_POST['save_aboutme'])) {
            $aboutme = $_POST['aboutme'];
            $this->db->query("UPDATE users SET about_me = '{$aboutme}' WHERE id = $profile_id");
        }

        if (isset($_POST['save_4'])) {
            if (isset($_POST['phone_only'])) {
                $this->db->query("UPDATE users SET phone_only = 1 WHERE id = $profile_id");
            }
            if (isset($_POST['site_only'])) {
                $this->db->query("UPDATE users SET site_only = 1 WHERE id = $profile_id");
            }
            if (!isset($_POST['phone_only'])) {
                $this->db->query("UPDATE users SET phone_only = 0 WHERE id = $profile_id");
            }
            if (!isset($_POST['site_only'])) {
                $this->db->query("UPDATE users SET site_only = 0 WHERE id = $profile_id");
            }
        }

        if (isset($_POST['save_5'])) {
            echo 123;
            if (isset($_POST['new_dialog'])) {
                $this->db->query("UPDATE users SET new_dialog = 1 WHERE id = $profile_id");
            }
            if (isset($_POST['close_ad'])) {
                $this->db->query("UPDATE users SET close_ad = 1 WHERE id = $profile_id");
            }
            if (isset($_POST['prom_offers'])) {
                $this->db->query("UPDATE users SET prom_offers = 1 WHERE id = $profile_id");
            }
            if (!isset($_POST['new_dialog'])) {
                $this->db->query("UPDATE users SET new_dialog = 0 WHERE id = $profile_id");
            }
            if (!isset($_POST['close_ad'])) {
                $this->db->query("UPDATE users SET close_ad = 0 WHERE id = $profile_id");
            }
            if (!isset($_POST['prom_offers'])) {
                $this->db->query("UPDATE users SET prom_offers = 0 WHERE id = $profile_id");
            }
        }
    }


    private
    function geoip_client($ip, $opt, $sid)
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

    public
    function handleKeys()
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

    public
    function generate()
    {
        if (isset($_POST['generate'])) {
            $_SESSION['keys'] = $this->composeKeysData($this->handleEmails());
        }
    }

    private
    function composeKeysData($emails)
    {
        $keys = array();

        foreach ($emails as $email) {
            $keys[$email] = $this->getKey($email);
        }

        return $keys;
    }

    private
    function handleEmails()
    {
        $explodedEmails = explode("\n", $_POST['emails']);
        $emails = array();

        $query = $this->db->prepare("SELECT * FROM access WHERE email_sent = :email");
        foreach ($explodedEmails as $email) {
            if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $query->execute([
                    ':email' => $email,
                ]);

                $result = $query->fetch();

                if ($result) {
                    continue;
                }
                array_push($emails, trim($email));
            } else {
                continue;
            }
        }

        return $emails;
    }

    private
    function getKey($string)
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

    public
    function numberofpages()
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

    public
    function showdb()
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

    public
    function keyeditor()
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
                $_SESSION['inactive_day'] = $array[$id_key]['inactive_date'];

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
                    $part .= "Status - " . '<font color=grey>' . "Inactive" . '</font>' . '<br>' . '<br>';
                if (strcasecmp($var, $var1) == 0)
                    $part .= "Status - " . '<font color=#00FF00>' . "Active" . '</font>' . '<br>' . '<br>';
                if (strcasecmp($var, $var2) == 0)
                    $part .= "Status - " . '<font color=red>' . "Banned" . '</font>' . '<br>' . '<br>';

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
                    $part .= "Status - " . '<font color=grey>' . "Inactive" . '</font>' . '<br>' . '<br>';
                if (strcasecmp($var, $var1) == 0)
                    $part .= "Status - " . '<font color=#00FF00>' . "Active" . '</font>' . '<br>' . '<br>';
                if (strcasecmp($var, $var2) == 0)
                    $part .= "Status - " . '<font color=red>' . "Banned" . '</font>' . '<br>' . '<br>';

                $result = $part;
                $_SESSION['notice_id'] = $array[$id_key]['id'];
                $_SESSION['id_key_keyeditor'] = $id_key;
                $_SESSION['array_keyeditor'] = $array[$id_key];
                return $result;
            }
        }
        return false;
    }

    public
    function keylock()
    {
        if (isset($_POST['lock'])) {
            $this->db->query("UPDATE access SET status = 2 WHERE id = {$_SESSION['id_key_keyeditor']}");
            $result = "{$_SESSION['array_keyeditor']['key']} заблокирован!";
            return $result;
        }
        return false;
    }

    public
    function keyunlock()
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

    public
    function installdate()
    {
        if (isset($_POST['installdate'])) {
            $day = $_POST['sel_date'];
            $month = $_POST['sel_month'];
            $year = $_POST['sel_year'];
            $flag = true;

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
                $flag = false;

            $_POST['sel_year'] = preg_replace("/[^0-9]/", '', $_POST['sel_year']);
            $date_year = date('Y');
            $date_year += 10;
            if (($_POST['sel_year'] < date('Y')) || ($_POST['sel_year'] > $date_year))
                $flag = false;

            $month_num = 0;
            for ($i = 0; $i < 12; $i++) {
                $var1 = $_POST['sel_month'];
                $var2 = $month[$i];
                if (strcasecmp($var1, $var2) == 0) {
                    $_POST['sel_month'] = $i + 1;
                    $month_num = $i + 1;
                    break;
                } else {
                    if ($i == 12) {
                        $flag = false;
                    }
                }
            }


            if ($month_num == 1 || $month_num == 3 || $month_num == 5 || $month_num == 7 || $month_num == 8 || $month_num == 10 || $month_num == 12) {
                if ($day > 31) {
                    $flag = false;
                }
            }

            if ($month_num == 4 || $month_num == 6 || $month_num == 9 || $month_num == 11) {
                if ($day > 30) {
                    $flag = false;
                }
            }
            if ($month_num == 2) {
                if ($day > 28) {
                    $flag = false;
                }
            }
            if ($month_num > 12) {
                $flag = false;
            }

            if ($flag == true) {
                $date = "{$year}-{$month_num}-{$day}";
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
            } else
                $result = 'Email введ неверно!';
            return $result;
        }
        return false;
    }

    public
    function page()
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

                for ($j = ((($i - 1) * $idsperpage) + 1); $j <= ((($i - 1) * $idsperpage) + 1) + $a - 1; $j++) { // сортировка
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
                        $part .= "Status - " . '<font color=grey>' . "Inactive" . '</font>' . '<br>' . '<br>';
                    if (strcasecmp($var, $var1) == 0)
                        $part .= "Status - " . '<font color=#00FF00>' . "Active" . '</font>' . '<br>' . '<br>';
                    if (strcasecmp($var, $var2) == 0)
                        $part .= "Status - " . '<font color=red>' . "Banned" . '</font>' . '<br>' . '<br>';
                    $result .= $part;
                }
                return $result;
            }
        }
    }

    public
    function getForms()
    {
        $query = $this->db->prepare("SELECT * FROM forms");
        $query->execute();
        $forms = $query->fetchAll();


        return array(
            'forms' => $forms,
            'data' => $this->getFormParams(),
        );
    }

    public
    function getForm($id)
    {
        $query = $this->db->prepare("SELECT * FROM forms WHERE id = :id");
        $query->execute([':id' => $id]);
        $form = $query->fetchAll();

        return $form;
    }

    public
    function createForm()
    {
        $spaceType = $_POST['spaceType'];
        $operationType = $_POST['operationType'];
        $objectType = $_POST['objectType'];

        $query = $this->db->prepare("SELECT * FROM forms WHERE space_type = :space_type AND object_type = :object_type AND operation = :operation");
        $query->execute([
            ':space_type' => $spaceType,
            ':object_type' => $objectType,
            ':operation' => $operationType,
        ]);

        $result = $query->fetch();

        if ($result) {
            return 'Ошибка, такая форма уже существует.';
        }

        $query = $this->db->prepare("INSERT INTO forms (space_type, object_type, operation) VALUES (:space_type, :object_type, :operation)");
        $query->execute([
            ':space_type' => $spaceType,
            ':object_type' => $objectType,
            ':operation' => $operationType,
        ]);

        if ($query->rowCount()) {
            return 'Форма успешно добавлена.';
        } else {
            return 'Ошибка.';
        }
    }

    public
    function editForm($id)
    {

    }

    public
    function deleteForm($id)
    {
        $query = $this->db->prepare("DELETE FROM forms WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->rowCount();
    }

    public
    function getCabinetElements()
    {

    }

    public
    function handleFormParams()
    {
        $answer = array();

        switch ($_POST['action']) {
            case 'saveParams':
                if ($this->checkEmptyPOSTElements()) {
                    $spaceTypesQuery = $this->db->prepare("INSERT INTO form_space_types (r_name, e_name) VALUES (:r_name, :e_name)");
                    $operationTypesQuery = $this->db->prepare("INSERT INTO form_operation_types (r_name, e_name) VALUES (:r_name, :e_name)");
                    $objectTypesQuery = $this->db->prepare("INSERT INTO form_object_types (r_name, e_name) VALUES (:r_name, :e_name)");

                    $answer['data'] = $this->getFormParams();

                    $messages = '';

                    if (isset($_POST['inputSpaceTypeRu'])) {
                        foreach ($_POST['inputSpaceTypeRu'] as $key => $value) {
                            $data = array(
                                'ru' => $value,
                                'eng' => $_POST['inputSpaceTypeEng'][$key],
                                'messages' => &$messages,
                            );

                            array_walk($answer['data']['spaceTypes'], function ($spaceType, $k, $data) {
                                if ($spaceType['r_name'] == $data['ru']) {
                                    $data['messages'] .= "Тип площади: <span style='color: red;'>'" . $data['ru'] . "'</span> уже существует. \n";
                                }

                                if ($spaceType['e_name'] == $data['eng']) {
                                    $data['messages'] .= "Тип площади: <span style='color: red;'>'" . $data['eng'] . "'</span> уже существует. \n";
                                }
                            }, $data);

                            $messages = $data['messages'];
                        }
                    }

                    if (isset($_POST['inputOperationTypeRu'])) {
                        foreach ($_POST['inputOperationTypeRu'] as $key => $value) {
                            $data = array(
                                'ru' => $value,
                                'eng' => $_POST['inputOperationTypeEng'][$key],
                                'messages' => &$messages,
                            );

                            array_walk($answer['data']['operationTypes'], function ($operationType, $k, $data) {
                                if ($operationType['r_name'] == $data['ru']) {
                                    $data['messages'] .= "Тип операции: <span style='color: red;'>'" . $data['ru'] . "'</span> уже существует. \n";
                                }

                                if ($operationType['e_name'] == $data['eng']) {
                                    $data['messages'] .= "Тип операции: <span style='color: red;'>'" . $data['eng'] . "'</span> уже существует. \n";
                                }
                            }, $data);

                            $messages = $data['messages'];
                        }
                    }

                    if (isset($_POST['inputObjectTypeRu'])) {
                        foreach ($_POST['inputObjectTypeRu'] as $key => $value) {
                            $data = array(
                                'ru' => $value,
                                'eng' => $_POST['inputObjectTypeEng'][$key],
                                'messages' => &$messages,
                            );

                            array_walk($answer['data']['objectTypes'], function ($objectType, $k, $data) {
                                if ($objectType['r_name'] == $data['ru']) {
                                    $data['messages'] .= "Тип площади: <span style='color: red;'>'" . $data['ru'] . "'</span> уже существует. \n";
                                }

                                if ($objectType['e_name'] == $data['eng']) {
                                    $data['messages'] .= "Тип площади: <span style='color: red;'>'" . $data['eng'] . "'</span> уже существует. \n";
                                }
                            }, $data);

                            $messages = $data['messages'];
                        }
                    }

                    if ($messages) {
                        $answer['message'] = $messages;
                    } else {
                        if (isset($_POST['inputSpaceTypeRu'])) {
                            foreach ($_POST['inputSpaceTypeRu'] as $key => $value) {
                                $spaceTypesQuery->execute([':r_name' => $value, ':e_name' => $_POST['inputSpaceTypeEng'][$key]]);
                            }
                        }

                        if (isset($_POST['inputOperationTypeRu'])) {
                            foreach ($_POST['inputOperationTypeRu'] as $key => $value) {
                                $operationTypesQuery->execute([':r_name' => $value, ':e_name' => $_POST['inputOperationTypeEng'][$key]]);
                            }
                        }

                        if (isset($_POST['inputObjectTypeRu'])) {
                            foreach ($_POST['inputObjectTypeRu'] as $key => $value) {
                                $objectTypesQuery->execute([':r_name' => $value, ':e_name' => $_POST['inputObjectTypeEng'][$key]]);
                            }
                        }
                        $answer['message'] = 'Параметры сохранены.';
                    }
                } else {
                    $answer['message'] = 'Ошибка, не все поля заполнены.';
                }

                break;
            case 'deleteParam':
                $data = explode('_', $_POST['id']);
                $type = $data[0];
                $id = $data[1];

                $spaceTypesQuery = $this->db->prepare("DELETE FROM form_space_types WHERE id = :id");
                $operationTypesQuery = $this->db->prepare("DELETE FROM form_operation_types WHERE id = :id");
                $objectTypesQuery = $this->db->prepare("DELETE FROM form_object_types WHERE id = :id");

                if ($type == 'spaceType') {
                    $spaceTypesQuery->execute([':id' => $id]);
                }

                if ($type == 'operationType') {
                    $operationTypesQuery->execute([':id' => $id]);
                }

                if ($type == 'objectType') {
                    $objectTypesQuery->execute([':id' => $id]);
                }

                if ($spaceTypesQuery->rowCount() || $operationTypesQuery->rowCount() || $objectTypesQuery->rowCount()) {
                    $answer['data'] = $this->getFormParams();
                    $answer['message'] = 'Удаление прошло успешно.';
                } else {
                    $answer['message'] = 'Возникла ошибка при удалении.';
                }
                break;
            case 'saveCategories':
                if ($this->checkEmptyPOSTElements()) {
                    $query = $this->db->prepare("INSERT INTO form_categories (r_name, e_name, form_id) VALUES (:r_name, :e_name, :form_id)");

                    $answer['categories'] = $this->getCategories($_POST['formID']);
                    $messages = '';

                    if (isset($_POST['categoriesRu'])) {
                        foreach ($_POST['categoriesRu'] as $key => $value) {
                            $data = array(
                                'ru' => $value,
                                'eng' => $_POST['categoriesEng'][$key],
                                'messages' => &$messages,
                            );

                            array_walk($answer['categories'], function ($category, $k, $data) {
                                if ($category['r_name'] == $data['ru']) {
                                    $data['messages'] .= "Категория: <span style='color: red;'>'" . $data['ru'] . "'</span> уже существует. \n";
                                }

                                if ($category['e_name'] == $data['eng']) {
                                    $data['messages'] .= "Категория: <span style='color: red;'>'" . $data['eng'] . "'</span> уже существует. \n";
                                }
                            }, $data);

                            $messages = $data['messages'];
                        }
                    }

                    if ($messages) {
                        $answer['message'] = $messages;
                    } else {
                        if (isset($_POST['categoriesRu'])) {
                            foreach ($_POST['categoriesRu'] as $key => $value) {
                                $query->execute([':r_name' => $value, ':e_name' => $_POST['categoriesEng'][$key], ':form_id' => $_POST['formID']]);
                            }
                        }
                        $answer['message'] = 'Категории сохранены.';
                    }

                    $answer['data'] = $this->getFormParams();
                    $answer['categories'] = $this->getCategories($_POST['formID']);
                } else {
                    $answer['message'] = 'Ошибка, не все поля заполнены.';
                }
                break;
            case 'saveSubcategories':
                if ($this->checkEmptyPOSTElements()) {
                    $query = $this->db->prepare("INSERT INTO form_subcategories (r_name, e_name, category_id, form_id) VALUES (:r_name, :e_name, :category_id, :form_id)");

                    $answer['subcategories'] = $this->getSubcategories($_POST['formID']);
                    $messages = '';

                    if (isset($_POST['subcategoriesRu'])) {
                        foreach ($_POST['subcategoriesRu'] as $key => $value) {
                            $data = array(
                                'ru' => $value,
                                'eng' => $_POST['subcategoriesEng'][$key],
                                'messages' => &$messages,
                            );

                            array_walk($answer['subcategories'], function ($subcategory, $k, $data) {
                                if ($subcategory['r_name'] == $data['ru']) {
                                    $data['messages'] .= "Подкатегория: <span style='color: red;'>'" . $data['ru'] . "'</span> уже существует. \n";
                                }

                                if ($subcategory['e_name'] == $data['eng']) {
                                    $data['messages'] .= "Подкатегория: <span style='color: red;'>'" . $data['eng'] . "'</span> уже существует. \n";
                                }
                            }, $data);

                            $messages = $data['messages'];
                        }
                    }

                    if ($messages) {
                        $answer['message'] = $messages;
                    } else {
                        if (isset($_POST['subcategoriesRu'])) {
                            foreach ($_POST['subcategoriesRu'] as $key => $value) {
                                $query->execute([':r_name' => $value, ':e_name' => $_POST['subcategoriesEng'][$key], ':category_id' => $_POST['parentCategory'][$key], ':form_id' => $_POST['formID']]);
                            }
                        }
                        $answer['message'] = 'Подкатегории сохранены.';
                    }

                    $answer['data'] = $this->getFormParams();
                } else {
                    $answer['message'] = 'Ошибка, не все поля заполнены или не выбрана категория.';
                }
                break;
            case 'delCategory': // Удаление категорий
                $data = explode('_', $_POST['id']);
                $id = $data[1];

                $query = $this->db->prepare("DELETE FROM form_categories WHERE id = :id");
                $query->execute([':id' => $id]);

                if ($query->rowCount()) {
                    $answer['data'] = $this->getCategories($_POST['formID']);
                    $answer['message'] = 'Удаление прошло успешно.';
                } else {
                    $answer['message'] = 'Возникла ошибка при удалении.';
                }
                break;
        }

        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }

    private
    function checkEmptyPOSTElements()
    {
        foreach ($_POST as $value) {
            if (!(gettype($value) == 'array')) {
                continue;
            }

            foreach ($value as $element) {
                if (empty($element)) {
                    return false;
                }
            }
        }

        return true;
    }

    public
    function getFormParams()
    {
        return array(
            'spaceTypes' => $this->getSpaceTypes(),
            'operationTypes' => $this->getOperationTypes(),
            'objectTypes' => $this->getObjectTypes(),
        );
    }

    public
    function getFormData($id)
    {
        $categories = $this->getCategories($id);

        return array(
            'id' => $id,
            'form' => $this->getForm($id),
            'formParams' => $this->getFormParams(),
            'categories' => $categories,
            'categoriesJSON' => json_encode($categories, JSON_UNESCAPED_UNICODE),
            'subcategories' => $this->getSubcategories($id),
        );
    }

    private
    function getSpaceTypes()
    {
        $query = $this->db->prepare("SELECT * FROM form_space_types");
        $query->execute();

        return $query->fetchAll();
    }

    private
    function getCategories($formID)
    {
        $query = $this->db->prepare("SELECT * FROM form_categories WHERE form_id = :form_id");
        $query->execute([':form_id' => $formID]);

        return $query->fetchAll();
    }

    private
    function getSubcategories($formID)
    {
        $query = $this->db->prepare("SELECT * FROM form_subcategories WHERE form_id = :form_id");
        $query->execute([':form_id' => $formID]);

        return $query->fetchAll();
    }

    private
    function getSpaceType($id)
    {
        $query = $this->db->prepare("SELECT * FROM form_space_types WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    private
    function getOperationTypes()
    {
        $query = $this->db->prepare("SELECT * FROM form_operation_types");
        $query->execute();

        return $query->fetchAll();
    }

    private
    function getOperationType($id)
    {
        $query = $this->db->prepare("SELECT * FROM form_operation_types WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    private
    function getObjectTypes()
    {
        $query = $this->db->prepare("SELECT * FROM form_object_types");
        $query->execute();

        return $query->fetchAll();
    }

    private
    function getObjectType($id)
    {
        $query = $this->db->prepare("SELECT * FROM form_object_types WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->fetch();
    }
}
