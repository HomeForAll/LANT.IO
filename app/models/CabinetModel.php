<?php

class CabinetModel extends Model
{
    use Cleaner;

    const IDSPERPAGE = 5;
    const ADMINSTATUS = 8;

    private $mailer;
    private $response;

    public function __construct()
    {
        parent::__construct();
        $this->db = new DataBase();
    }

    public function getChatMessages($idChat)
    {
        $redis = new Redis();
        $redis->connect('127.0.0.1');
        $start = round(microtime(true) * 1000);
        $end = $start - 1000000;
        $dialog = 'dialog-' . $idChat;

        return $redis->zRangeByScore($dialog, $end, $start);
    }

    public function getChatInfo($id)
    {
        $name = $this->getDialogName($id);

        return [
            'nameChat' => $name,
            'idChat'   => $id,
        ];
    }

    public function deleteAllDialogs() // Удалить все диалоги
    {
        $profile_id = $_SESSION['userID'];
        $stmt = $this->db->prepare("UPDATE dialogs SET show = 0 WHERE user_id= $profile_id");
        $stmt->execute();

        return $this->getDialogs(true);
    }

    public function getAvatarDialogs($id)
    {
        $stmt = $this->db->prepare("SELECT owners FROM dialogs_properties WHERE id = $id");
        $stmt->execute();
        $owners = $stmt->fetchAll();
        $owners = $owners[0]['owners'];
        $massivOwners = explode(",", $owners);
        if (count($massivOwners) == 2) {
            foreach ($massivOwners as $item => $key) {
                if ($key != $_SESSION['userID']) {
                    $profile_foto_id = $this->getAvatarUser($key);

                    return $profile_foto_id;
                }
            }
        } else {
            $stmt = $this->db->prepare("SELECT avatar FROM dialogs_properties WHERE id = $id");
            $stmt->execute();
            $avatar = $stmt->fetchAll();
            $avatar = $avatar[0]['avatar'];

            return $avatar;
        }
    }

    public function getDialogs($flagOfDialog)
    {
        if ($flagOfDialog) {
            $ids = $this->getDialogsIDs();
        } else {
            $ids = $this->getDeletedDialogsIDs();
        }
        if ($ids) {
            $names = [];
            $avatars = [];
            $last_message = [];
            $last_message_text = [];
            $last_message_avatar = [];
            $last_message_time = [];
            $massiv = [];

            $code = 'getDialogs';
            foreach ($ids as $item => $key) {
                $names[$item] = $this->getDialogName($key);
                $avatars[$item] = $this->getAvatarDialogs($key);
                $last_message[$item] = $this->getLastMessage($key);
                $last_message_text[$item] = $last_message[$item]['text'];
                $last_message_avatar[$item] = $last_message[$item]['avatar'];
                $last_message_time[$item] = $last_message[$item]['time'];

                $massiv[$item]['id'] = $ids[$item];
                $massiv[$item]['title'] = $names[$item];
                $massiv[$item]['photo'] = $avatars[$item];
                $massiv[$item]['last_message'] = $last_message_text[$item];
                $massiv[$item]['last_avatar'] = $last_message_avatar[$item];
                $massiv[$item]['timestamp'] = $last_message_time[$item];
            }
            echo(json_encode($massiv, JSON_UNESCAPED_UNICODE));

            return [
                'last_message_text'   => $last_message_text,
                'last_message_avatar' => $last_message_avatar,
                'avatarsDialog'       => $avatars,
                'idsDialog'           => $ids,
                'namesDialog'         => $names,
                'code'                => $code,
            ];
        }
        $code = 'dialogs_not_exist';
        $this->setUserError('dialogs_not_exist', 'Диалогов нет!');

        return [
            'code' => $code,
        ];
    } // Получить диалоги true - активные, false - удаленные

    public function getDialogsIDs()
    {
        $profile_id = $_SESSION['userID'];
        //$profile_id = 23;
        $stmt = $this->db->prepare("SELECT * FROM dialogs WHERE user_id= $profile_id AND show= 1");
        $stmt->execute();
        $dialogs = $stmt->fetchAll();

        if ($dialogs) {
            $dialogs_ids = [];
            foreach ($dialogs as $item => $key) {
                $dialogs_ids[$item] = $key['id'];
            }

            return $dialogs_ids;
        }

        return false;
    } // Узнать все диалоги пользователя

    public function getDeletedDialogsIDs()
    {
        $profile_id = $_SESSION['userID'];
        $stmt = $this->db->prepare("SELECT * FROM dialogs WHERE user_id= $profile_id AND show= 0");
        $stmt->execute();
        $dialogs = $stmt->fetchAll();

        if ($dialogs) {
            $dialogs_ids = [];
            foreach ($dialogs as $item => $key) {
                $dialogs_ids[$item] = $key['id'];
            }

            return $dialogs_ids;
        }

        return false;
    } // Узнать удаленные диалоги пользователя

    public function getDialogName($id)
    {
        $stmt = $this->db->prepare("SELECT owners FROM dialogs_properties WHERE id = $id");
        $stmt->execute();
        $owners = $stmt->fetchAll();
        $owners = $owners[0]['owners'];
        $massivOwners = explode(",", $owners);
        if (count($massivOwners) == 2) {
            foreach ($massivOwners as $item => $key) {
                if ($key != $_SESSION['userID']) {
                    $name = $this->getNamesUsersForDialog($key);

                    return $name;
                }
            }
        }
        $stmt = $this->db->prepare("SELECT name FROM dialogs_properties WHERE id = $id");
        $stmt->execute();
        $name = $stmt->fetchAll();
        $name = $name[0]['name'];
        $name = mb_substr($name, 0, 64, 'UTF-8');

        return $name;
    } // Узнать название диалога по id

    public function getAvatarUser($id) // Возвращает ссылку на аватар пользователя по id
    {
        $stmt = $this->db->prepare("SELECT profile_foto_id FROM users WHERE id = $id");
        $stmt->execute();
        $profile_foto_id = $stmt->fetchAll();
        $profile_foto_id = $profile_foto_id[0]['profile_foto_id'];

        return $profile_foto_id;
    }

    public function getLastMessage($id)
    {
        $stmt = $this->db->prepare("SELECT max(id) FROM dialogs_messages WHERE chat_id = $id");
        $stmt->execute();
        $i = $stmt->fetchAll();
        $i = $i[0]['max'];

        if ($i != null) {
            $stmt = $this->db->prepare("SELECT * FROM dialogs_messages WHERE id = $i");
            $stmt->execute();
            $info = $stmt->fetchAll();
            $message = $info[0]['text'];
            $time = $info[0]['date'];

            $profile_foto_id = $this->getAvatarUser($info[0]['user_id']);

            return [
                'time'   => $time,
                'text'   => $message,
                'avatar' => $profile_foto_id,
            ];
        } else {
            $time = 'empty';
            $message = 'empty';
            $profile_foto_id = 'empty';

            return [
                'time'   => $time,
                'text'   => $message,
                'avatar' => $profile_foto_id,
            ];
        }
    }

    public function getDeletedDialogs()
    {
        $dialogs = $this->getDialogs(false);
        if (isset($dialogs['idsDialog'])) {
            $dialogs = $dialogs['idsDialog'];
            $code = 'deleted_dialogs';
            $datesOfDelete = [];
            foreach ($dialogs as $item => $key) {
                $datesOfDelete[$item] = $this->getDateOfDelete($key);
            }

            return [
                'ids'           => $dialogs['idsDialog'],
                'names'         => $dialogs['namesDialog'],
                'datesOfDelete' => $datesOfDelete,
                'code'          => $code,
            ];
        } else {
            $code = 'deleted_dialogs_not_exist';

            return [
                'code' => $code,
            ];
        }
    }

    public function getIDsAdminsForDialog() // Узнать IDs Админов
    {
        $profile_id = $_SESSION['userID'];
        $status = self::ADMINSTATUS;
        $stmt = $this->db->prepare("SELECT id FROM users WHERE id != $profile_id AND status == $status");
        $stmt->execute();
        $users = $stmt->fetchAll();

        if ($users) {
            $usersForDialog = [];
            foreach ($users as $item => $key) {
                $usersForDialog[$item] = $key['id'];
            }

            return $usersForDialog;
        }

        return false;
    }

    public function getAdminsForDialog() // Получить пользователей для добавления в диалог
    {
        $ids = $this->getIdsAdminsForDialog();
        if ($ids) {
            $code = 'admins_for_dialogs';
            $names = [];
            foreach ($ids as $item => $key) {
                $names[$item] = $this->getNamesUsersForDialog($key);
            }

            return [
                'idsAdminsForDialog'    => $ids,
                'namesAdminssForDialog' => $names,
                'code'                  => $code,
            ];
        }
        $code = 'admins_for_dialogs_not_exist';

        return [
            'code' => $code,
        ];
    }

    public function getDateOfDelete($id)
    {
        $stmt = $this->db->prepare("SELECT date_of_delete FROM dialogs_properties WHERE id = $id");
        $stmt->execute();
        $dateOfDelete = $stmt->fetchAll();
        $dateOfDelete = $dateOfDelete[0]['date_of_delete'];

        return $dateOfDelete;
    }

    public function createNameForDialog($id)
    {
        $profile_id = $_SESSION['userID'];
        $stmt = $this->db->prepare("SELECT owners FROM dialogs_properties WHERE id = $id");
        $stmt->execute();
        $owners = $stmt->fetchAll();
        $massivOwners = $owners[0]['owners'];
        $massivOwners = explode(",", $massivOwners);

        if (!isset($massivOwners[2])) {
            foreach ($massivOwners as $item => $key) {
                if ($key != $profile_id) {
                    $stmt = $this->db->prepare("SELECT first_name FROM users WHERE id = {$key}");
                    $stmt->execute();
                    $name = $stmt->fetchAll();
                    $fullName = $name[0]['first_name'];
                    $stmt = $this->db->prepare("SELECT last_name FROM users WHERE id = {$key}");
                    $stmt->execute();
                    $name = $stmt->fetchAll();
                    $fullName .= ' ' . $name[0]['last_name'];
                    $stmt = $this->db->prepare("UPDATE dialogs_properties SET name = :name WHERE id = :id");
                    $stmt->execute([':name' => $fullName, ':id' => $id]);
                }
            }
        } else {
            foreach ($massivOwners as $item => $key) {
                $stmt = $this->db->prepare("SELECT first_name FROM users WHERE id = {$key}");
                $stmt->execute();
                $name = $stmt->fetchAll();
                $fullName = '';
                if ($item = 0)
                    $fullName = $name[0]['first_name'];
                else
                    $fullName .= ',' . $name[0]['first_name'];
                $stmt = $this->db->prepare("UPDATE dialogs_properties SET name = :name WHERE id = :id");
                $stmt->execute([':name' => $fullName, ':id' => $id]);
            }
        }
    } // Создать имя диалога по id

    public function createDateOfDelete($id) // Создать дату удаления диалога по id, возвращает дату!
    {
        $inactiveDate = new DateTime();
        $inactiveDate->add(new DateInterval('P3M'));
        $dateOfDelete = $inactiveDate->format('Y-m-d');

        $stmt = $this->db->prepare("UPDATE dialogs_properties SET date_of_delete = :date WHERE id = :id");
        $stmt->execute([':date' => $dateOfDelete, ':id' => $id]);

        return $dateOfDelete;
    }

    public function cancelDateOfDelete($id) // Удалить дату удаления
    {
        $stmt = $this->db->prepare("UPDATE dialogs_properties SET date_of_delete = NULL WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    public function deleteDialog($id)
    {
        $profile_id = $_SESSION['userID'];

        $stmt = $this->db->prepare("UPDATE dialogs SET show = :show WHERE id = :id AND user_id = :profile_id");
        $stmt->execute([':show' => 0, ':id' => $id, ':profile_id' => $profile_id]);

        return $this->createDateOfDelete($id);
    } // Удалить диалог по ID

    public function countOfUsersInDialogCheck($chat_owners)  // Проверка кол-ва пользователей в диалоге(исключая админов). На вход массив, на выход false, если превысило максимальное
    {
        $admin_status = self::ADMINSTATUS;
        $max_count_of_dialog_users = 5;
        $count_of_owners = 0;
        $countOfUsersInDialogCheck_flag = 1;

        foreach ($chat_owners as $key => $value) {
            $stmt = $this->db->prepare("SELECT status FROM users WHERE id = {$value}");
            $stmt->execute();
            $user_or_admin_flag = $stmt->fetchAll();

            if ($user_or_admin_flag[0][0] != $admin_status) {
                $count_of_owners++;
            }
        }

        if ($count_of_owners >= $max_count_of_dialog_users) {
            $countOfUsersInDialogCheck_flag = 0;
        }

        return $countOfUsersInDialogCheck_flag;
    }

    public function getUsersForDialog() // Получить пользователей для добавления в диалог
    {
        $ids = $this->getIdsUsersForDialog();
        if ($ids) {
            $code = 'users_for_dialogs';
            $names = [];
            foreach ($ids as $item => $key) {
                $names[$item] = $this->getNamesUsersForDialog($key);
            }

            return [
                'idsUsersForDialog'   => $ids,
                'namesUsersForDialog' => $names,
                'code'                => $code,
            ];
        }
        $code = 'users_for_dialogs_not_exist';

        return [
            'code' => $code,
        ];
    }

    public function getNamesUsersForDialog($id)
    {
        $stmt = $this->db->prepare("SELECT first_name FROM users WHERE id = {$id}");
        $stmt->execute();
        $name = $stmt->fetchAll();
        $fullName = $name[0]['first_name'];
        $stmt = $this->db->prepare("SELECT last_name FROM users WHERE id = {$id}");
        $stmt->execute();
        $name = $stmt->fetchAll();
        $fullName .= ' ' . $name[0]['last_name'];

        return $fullName;
    } // Узнать имя и фамилию пользователя по ID

    public function getIdsUsersForDialog()
    {
        $profile_id = $_SESSION['userID'];
        $status = self::ADMINSTATUS;
        $stmt = $this->db->prepare("SELECT id FROM users WHERE id != $profile_id AND status != $status");
        $stmt->execute();
        $users = $stmt->fetchAll();

        if ($users) {
            $usersForDialog = [];
            foreach ($users as $item => $key) {
                $usersForDialog[$item] = $key['id'];
            }

            return $usersForDialog;
        }

        return false;
    } // Получить IDs пользователей

    public function getOnlyNames($id)
    {
        $stmt = $this->db->prepare("SELECT first_name FROM users WHERE id = {$id}");
        $stmt->execute();
        $name = $stmt->fetchAll();
        $fullName = $name[0]['first_name'];

        return $fullName;
    }// Узнать только имя по ID

    public function checkDialogExist($owners) // Проверка существования диалога по строке owners = "1,2,3"
    {
        $stmt = $this->db->prepare("SELECT id FROM dialogs_properties WHERE owners = '{$owners}'");
        $stmt->execute();
        $id = $stmt->fetchAll();
        if (!empty($id))
            return $id[0]['id'];
        else
            return false;
    }

    public function addDialog($names, $ids)
    {
        $query = $this->db->prepare("INSERT INTO dialogs_properties (name, owners) VALUES (:name, :owners) RETURNING id");
        $query->execute([
            ':name'   => $names,
            ':owners' => $ids,
        ]);
        $result = $query->fetch();
        $id = explode(',', $ids);
        foreach ($id as $item => $key) {
            $query = $this->db->prepare("INSERT INTO dialogs (id, user_id, show) VALUES (:id, :user_id, 1)");
            $query->execute([
                ':id'      => $result[0],
                ':user_id' => $key,
            ]);
        }

        return $this->getDialogs(true);
    }

    public function createNewDialog()
    {
        $profile_id = $_SESSION['userID'];
        $i = 0;
        $usersToAddMassiv = [];
        foreach ($_POST as $item => $key) {
            if (($item != 'add_users') && ($item != 'chat_name') && ($item != 'search_user_for_dialog')) {
                $usersToAdd = explode("_", $item);
                $usersToAddMassiv[$i] = $usersToAdd[1];
                $i++;
                $usersToAddMassiv[$i] = $profile_id;
            }
        }
        if ($usersToAddMassiv) {
            if ($this->countOfUsersInDialogCheck($usersToAddMassiv)) {
                $ids = '';
                $names = '';
                sort($usersToAddMassiv);
                foreach ($usersToAddMassiv as $item => $key) {
                    if ($item == 0) {
                        $names = $this->getOnlyNames($key);
                        $ids = $key;
                    } else {
                        $names .= ',' . $this->getOnlyNames($key);
                        $ids .= ',' . $key;
                    }
                }
                if ($id = $this->checkDialogExist($ids)) // true - существует, false - нет
                {
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/cabinet/chat' . $id);
                    exit;
                } else {
                    if (isset($_POST['chat_name'])) {
                        trim($_POST['chat_name']);
                        if ($_POST['chat_name'] != '') {
                            $names = $_POST['chat_name'];
                        } else {
                            $code = 'chat_name_incorrect';
                        }
                    }
                    $this->addDialog($names, $ids);
                }
            } else {
                $code = 'too_much_users_choosen';

                return [
                    'code' => $code,
                    $this->getUsersForDialog(),
                ];
            }
        } else {
            $code = 'users_not_choosen';

            return [
                'code' => $code,
            ];
        }
    }

    public function getgadgets()
    {
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

    public function close_all_sessions()
    {
        $profile_id = $_SESSION['userID'];
        $stmt = $this->db->prepare("DELETE FROM sessions WHERE id_user = $profile_id");
        $stmt->execute();
        session_destroy();
        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit;
    }

    public function delete_gadget()
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

    public function getinfo()
    {
        $profile_id = $_SESSION['userID'];
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = $profile_id");
        $stmt->execute();
        $info = $stmt->fetchAll();

        return $info;
    }

    public function showActivity()
    {
    }

    public function getVisitsOfNews($profile_id) // На вход id пользователя, на выходе кол-во просмотров по его объявлениям
    {
        $stmt = $this->db->prepare("SELECT SUM(rating_views) FROM news_base WHERE id = {$profile_id}");
        $stmt->execute();
        $count = $stmt->fetch();

        return $count;
    }

    public function getBalance($profile_id) // Возвращает баланс пользователя
    {
        $stmt = $this->db->prepare("SELECT balance FROM users WHERE id = {$profile_id}");
        $stmt->execute();
        $count = $stmt->fetch();

        return $count;
    }

    public function сheckPersonalName($str) // Проверка ФИО пользователя
    {
        $str = trim($str);
        $pattern = "/([a-z0-9])+/i";
        if (preg_match($pattern, $str, $matches))
            return false;
        if ($str == '')
            return false;
        $str = ucfirst($str);

        return $str;
    }

    public function сheckNumbers($str) // Проверка числового значения
    {
        $old_str = $str;
        $str = trim($str);
        $str = preg_replace("/[^0-9]/", '', $str);
        if ($old_str != $str)
            return false;

        return $str;
    }

    public function сheckBirthDay()
    { // Проверка дня рождения
        $month = [
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
            "Декабрь",
        ];

        $_POST['sel_date'] = preg_replace("/[^0-9]/", '', $_POST['sel_date']);
        $day = $_POST['sel_date'];
        if (($_POST['sel_date'] > 31) || ($_POST['sel_date'] < 1))
            return false;

        $_POST['sel_year'] = preg_replace("/[^0-9]/", '', $_POST['sel_year']);
        if (($_POST['sel_year'] > date('Y')) || ($_POST['sel_year'] < 1920))
            return false;

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
                    return false;
                }
            }
        }

        if ($month_num == 4 || $month_num == 6 || $month_num == 9 || $month_num == 11) {
            if ($day > 30) {
                return false;
            }
        }
        if ($month_num == 2) {
            if ($day > 28) {
                return false;
            }
        }

        return true;
    } // Проверка даты рождения

    public function сheckEmail($profile_id)
    {
        if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
            $this->db->query("UPDATE users SET email = '{$_POST['email']}' WHERE id = $profile_id");
        } else {
            return false;
        }

        return true;
    } // Проверка E-mail

    public function сheckIllegalSymbols($str) // Проверка на запрещенные символы, исключения "/" "."
    {
        $str = trim($str);
        //$pattern = "~([0-9а-я./\s]+)~i";
        //$pattern = "~([^0-9а-я\.\/])+~i";
        $pattern = "/[^a-zA-Z@\.]/";
        if (preg_match($pattern, $str, $matches))
            return $matches;
        if ($str == '')
            return false;
        $str = ucfirst($str);

        return $str;
    }

    public function savePersonalInfo() // Редактирование профиля
    {
        $profile_id = $_SESSION['userID'];

        if (isset($_POST['save_1'])) // Информация о пользователе
        {
            if ($str = $this->сheckPersonalName($_POST['name'])) {
                $stmt = $this->db->prepare("UPDATE users SET first_name = :first_name WHERE id = :profile_id");
                $stmt->execute([':first_name' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('name_profile_edit_error', 'Введено неверно!');
            }
            if ($str = $this->сheckPersonalName($_POST['surname'])) {
                $stmt = $this->db->prepare("UPDATE users SET last_name = :surname WHERE id = :profile_id");
                $stmt->execute([':surname' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('surname_profile_edit_error', 'Введено неверно!');
            }
            if ($str = $this->сheckPersonalName($_POST['patronymic'])) {
                $stmt = $this->db->prepare("UPDATE users SET patronymic = :patronymic WHERE id = :profile_id");
                $stmt->execute([':patronymic' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('patronymic_profile_edit_error', 'Введено неверно!');
            }
            if ($this->сheckBirthDay()) {
                $stmt = $this->db->prepare("UPDATE users SET birthday = :year-:month-:day WHERE id = :profile_id");
                $stmt->execute([':year' => $_POST['sel_year'], ':month' => $_POST['sel_month'], ':day' => $_POST['sel_date'], ':profile_id' => $profile_id]);
            } else {
                Registry::set('date_profile_edit_error', 'Введено неверно!');
            }
            if ($str = $this->сheckNumbers($_POST['series'])) {
                $stmt = $this->db->prepare("UPDATE users SET series = :series WHERE id = :profile_id");
                $stmt->execute([':series' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('series_profile_edit_error', 'Введено неверно!');
            }
            if ($str = $this->сheckNumbers($_POST['number'])) {
                $stmt = $this->db->prepare("UPDATE users SET number = :number WHERE id = :profile_id");
                $stmt->execute([':number' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('number_profile_edit_error', 'Введено неверно!');
            }
            if ($str = $this->сheckNumbers($_POST['index'])) {
                $stmt = $this->db->prepare("UPDATE users SET index = :index WHERE id = :profile_id");
                $stmt->execute([':index' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('index_profile_edit_error', 'Введено неверно!');
            }
            if ($str = $this->сheckPersonalName($_POST['city'])) {
                $stmt = $this->db->prepare("UPDATE users SET city = :city WHERE id = :profile_id");
                $stmt->execute([':city' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('city_profile_edit_error', 'Введено неверно!');
            }

            var_dump($this->сheckIllegalSymbols($_POST['street']));
            var_dump($this->сheckIllegalSymbols($_POST['home']));

            if ($str = $this->сheckNumbers($_POST['flat'])) {
                $stmt = $this->db->prepare("UPDATE users SET flat = :flat WHERE id = :profile_id");
                $stmt->execute([':flat' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('flat_profile_edit_error', 'Введено неверно!');
            }
        }

        if (isset($_POST['save_2'])) {
            if ($str = $this->сheckNumbers($_POST['phonenumber'])) {
                $stmt = $this->db->prepare("UPDATE users SET phone_number = :phonenumber WHERE id = :profile_id");
                $stmt->execute([':phonenumber' => $str, ':profile_id' => $profile_id]);
            } else {
                Registry::set('phonenumber_profile_edit_error', 'Введено неверно!');
            }
            if ($this->сheckEmail($profile_id)) {
                $stmt = $this->db->prepare("UPDATE users SET email = :email WHERE id = :profile_id");
                $stmt->execute([':email' => $_POST['email'], ':profile_id' => $profile_id]);
            } else {
                Registry::set('email_profile_edit_error', 'Введено неверно!');
            }
        } // Контакты

        // Отвязка социальных сетей
        if (isset($_POST['delete_vk']) || (isset($_POST['delete_steam'])) || (isset($_POST['delete_ok'])) || (isset($_POST['delete_ya'])) || (isset($_POST['delete_mail'])) || (isset($_POST['delete_facebook'])) || (isset($_POST['delete_google']))) {
            foreach ($_POST as $key => $value) {
                if ($value == 'Отвязать') {
                    $social_net = explode("_", $key);
                    if (isset($social_net[1])) {
                        $id = $social_net[1] . "_id";
                        $name = $social_net[1] . "_name";
                        $avatar = $social_net[1] . "_avatar";
                        $stmt = $this->db->prepare("UPDATE users SET :id = NULL WHERE id = :profile_id");
                        $stmt->execute([':id' => $id, ':profile_id' => $profile_id]);
                        $stmt = $this->db->prepare("UPDATE users SET :name = NULL WHERE id = :profile_id");
                        $stmt->execute([':name' => $name, ':profile_id' => $profile_id]);
                        $stmt = $this->db->prepare("UPDATE users SET :avatar = NULL WHERE id = :profile_id");
                        $stmt->execute([':avatar' => $avatar, ':profile_id' => $profile_id]);
                    }
                }
            }
        }

        if (isset($_POST['check_with_passport'])) // Подтвердить паспортом
        {
        }

        if (isset($_POST['update_foto_id'])) {
        }

        if (isset($_POST['delete_foto_id'])) // Установить default аватар профиля
        {
            $link = 'http://images.lant.io/profile_fotos/user_foto_id_default.jpg';
            $stmt = $this->db->prepare("UPDATE users SET profile_foto_id = :link WHERE id = :profile_id");
            $stmt->execute([':link' => $link, ':profile_id' => $profile_id]);
        }

        if (isset($_POST['save_3'])) // Изменить пароль
        {
            $stmt = $this->db->prepare("SELECT password FROM users WHERE id = $profile_id");
            $stmt->execute();
            $result = $stmt->fetchAll();

            $new_result = $result[0]['password'];

            if (password_verify($_POST['old_pass'], $new_result)) {
                $passwordHash = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
                $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :profile_id");
                $stmt->execute([':password' => $passwordHash, ':profile_id' => $profile_id]);
            } else {
                Registry::set('password_profile_edit_error', 'Введено неверно!');
            }
        }

        if (isset($_POST['save_aboutme']))  // О себе
        {
            $aboutme = $_POST['aboutme'];
            $stmt = $this->db->prepare("UPDATE users SET about_me = :aboutme WHERE id = :profile_id");
            $stmt->execute([':aboutme' => $aboutme, ':profile_id' => $profile_id]);
        }

        if (isset($_POST['save_4'])) // Связь с сайтом
        {
            if (isset($_POST['phone_only'])) {
                $stmt = $this->db->prepare("UPDATE users SET phone_only = 1 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
            if (isset($_POST['site_only'])) {
                $stmt = $this->db->prepare("UPDATE users SET site_only = 1 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
            if (!isset($_POST['phone_only'])) {
                $stmt = $this->db->prepare("UPDATE users SET phone_only = 0 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
            if (!isset($_POST['site_only'])) {
                $stmt = $this->db->prepare("UPDATE users SET site_only = 0 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
        }

        if (isset($_POST['save_5'])) // Уведомления от сайта
        {
            if (isset($_POST['new_dialog'])) {
                $stmt = $this->db->prepare("UPDATE users SET new_dialog = 1 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
            if (isset($_POST['close_ad'])) {
                $stmt = $this->db->prepare("UPDATE users SET close_ad = 1 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
            if (isset($_POST['prom_offers'])) {
                $stmt = $this->db->prepare("UPDATE users SET prom_offers = 1 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
            if (!isset($_POST['new_dialog'])) {
                $stmt = $this->db->prepare("UPDATE users SET new_dialog = 0 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
            if (!isset($_POST['close_ad'])) {
                $stmt = $this->db->prepare("UPDATE users SET close_ad = 0 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
            if (!isset($_POST['prom_offers'])) {
                $stmt = $this->db->prepare("UPDATE users SET prom_offers = 0 WHERE id = :profile_id");
                $stmt->execute([':profile_id' => $profile_id]);
            }
        }
    }

    private function saveAvatar()
    {
        ini_set('file_uploads', true);
        ini_set('upload_max_filesize', '8M');
        ini_set('upload_tmp_dir', ROOT_DIR . '/tmp');
        ini_set('post_max_size', '10M');

        $uploads = ROOT_DIR . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images';

        if (!empty($_FILES)) {
            if (!($_FILES['profileIMG']['type'] === 'image/jpeg' || $_FILES['profileIMG']['type'] === 'image/png' || $_FILES['profileIMG']['type'] === 'image/gif')) {
                echo 'Ошибка загрузки картинки, файл не соответствует требуемому формату!';

                return;
            }

            $lastPos = strrpos($_FILES['profileIMG']['name'], '.');
            $extension = substr($_FILES['profileIMG']['name'], $lastPos);

            $fileName = strtolower(md5(time()) . $extension);

            if (move_uploaded_file($_FILES['profileIMG']['tmp_name'], $uploads . DIRECTORY_SEPARATOR . $fileName)) {

                $query = $this->db->prepare('UPDATE users SET profile_foto_id = :file_name WHERE id = ' . $_SESSION['userID']);
                $query->execute([':file_name' => $fileName]);

                if ($query->rowCount()) {
                    echo "Файл корректен и был успешно загружен.\n";
                } else {
                    echo "Ошибка записи файла.\n";
                    unlink($uploads . DIRECTORY_SEPARATOR . $fileName);
                }
            } else {
                echo "Возможная атака с помощью файловой загрузки!\n";
            }
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
    } // Геолокация

    public function handleKeys()
    {
        if (isset($_POST['handle'])) {
            if (isset($_POST['sendCheck'])) {
                foreach ($_SESSION['keys'] as $email => $key) {
                    $str = file_get_contents(ROOT_DIR . '/template/layouts/mail.php');
                    $phrase = $str;
                    $old = ["KEY"];
                    $new = [$key];
                    $newphrase = str_replace($old, $new, $phrase);
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset="utf-8"' . "\r\n";
                    $headers .= "From: Lant.io <noreply@lant.io>\r\n";
                    mail($email, "Альфа ключ", $newphrase, $headers);
                }
            }
            if (isset($_POST['dbCheck'])) {
                foreach ($_SESSION['keys'] as $email => $key) {
                    if (!$this->getEmailAvailability($email)) {
                        $date = new DateTime();
                        $inactiveDate = new DateTime();
                        $inactiveDate->add(new DateInterval('P1M'));
                        $this->db->query("INSERT INTO access (email, key, email_sent, creation_date, inactive_date, status) VALUES (NULL, '{$key}', '{$email}', '{$date->format('Y-m-d')}', '{$inactiveDate->format('Y-m-d')}', 0)");
                    }
                }
            }
            //            print_r($this->db->errorInfo());
            unset($_SESSION['keys']);
        }
    }

    private function getEmailAvailability($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM access WHERE email_sent = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result ? true : false;
    }

    public function generate()
    {
        if (isset($_POST['generate'])) {
            $_SESSION['keys'] = $this->composeKeysData($this->handleEmails());
        }
    }

    private function composeKeysData($emails)
    {
        $keys = [];

        foreach ($emails as $email) {
            $keys[$email] = $this->getKey($email);
        }

        return $keys;
    }

    private function handleEmails()
    {
        $explodedEmails = explode("\n", $_POST['emails']);
        $emails = [];

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
            $day = $_POST['sel_date'];
            $month = $_POST['sel_month'];
            $year = $_POST['sel_year'];
            $flag = true;

            $month = [
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
                "Декабрь",
            ];

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

    public function getForms()
    {
        //$_SESSION['userID'] = 11;
        if ($_SESSION['status'] > 4) {
            $query = $this->db->prepare("SELECT * FROM forms");
            $query->execute();
        } else {
            $query = $this->db->prepare("SELECT * FROM forms WHERE user_id = :user_id");
            $query->execute([':user_id' => $_SESSION['userID']]);
        }

        $forms = $query->fetchAll();

        return [
            'forms' => $forms,
            'data'  => $this->getFormParams(),
        ];
    }

    public function getForm($id)
    {
        $query = $this->db->prepare("SELECT * FROM forms WHERE id = :id");
        $query->execute([':id' => $id]);
        $form = $query->fetchAll();

        return $form;
    }

    public function createForm()
    {
        $spaceType = $_POST['spaceType'];
        $operationType = $_POST['operationType'];
        $objectType = $_POST['objectType'];

        $query = $this->db->prepare("SELECT * FROM forms WHERE space_type = :space_type AND object_type = :object_type AND operation = :operation");
        $query->execute([
            ':space_type'  => $spaceType,
            ':object_type' => $objectType,
            ':operation'   => $operationType,
        ]);

        $result = $query->fetch();

        if ($result) {
            return 'Ошибка, такая форма уже существует.';
        }

        $query = $this->db->prepare("INSERT INTO forms (space_type, object_type, operation, user_id) VALUES (:space_type, :object_type, :operation, :user_id)");
        $query->execute([
            ':space_type'  => $spaceType,
            ':object_type' => $objectType,
            ':operation'   => $operationType,
            ':user_id'     => $_SESSION['userID'],
        ]);

        if ($query->rowCount()) {
            return 'Форма успешно добавлена.';
        } else {
            return 'Ошибка.';
        }
    }

    public function editForm($id)
    {

    }

    public function deleteForm($id)
    {
        $query = $this->db->prepare("DELETE FROM forms WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->rowCount();
    }

    public function getCabinetElements()
    {

    }

    /**
     * Редактор
     * форм
     * поиска
     */

    public function handleFormParams()
    {
        $answer = [];

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
                            $data = [
                                'ru'       => $value,
                                'eng'      => $_POST['inputSpaceTypeEng'][$key],
                                'messages' => &$messages,
                            ];

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
                            $data = [
                                'ru'       => $value,
                                'eng'      => $_POST['inputOperationTypeEng'][$key],
                                'messages' => &$messages,
                            ];

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
                            $data = [
                                'ru'       => $value,
                                'eng'      => $_POST['inputObjectTypeEng'][$key],
                                'messages' => &$messages,
                            ];

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
                        $answer['data'] = $this->getFormParams();
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
                            $data = [
                                'ru'       => $value,
                                'eng'      => $_POST['categoriesEng'][$key],
                                'messages' => &$messages,
                            ];

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
                            $data = [
                                'ru'       => $value,
                                'eng'      => $_POST['subcategoriesEng'][$key],
                                'messages' => &$messages,
                            ];

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

                        $answer['subcategories'] = $this->getSubcategories($_POST['formID']);
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
            case 'delSubcategory': // Удаление подкатегорий
                $data = explode('_', $_POST['id']);
                $id = $data[1];

                $query = $this->db->prepare("DELETE FROM form_subcategories WHERE id = :id");
                $query->execute([':id' => $id]);

                if ($query->rowCount()) {
                    $answer['data'] = $this->getSubcategories($_POST['formID']);
                    $answer['message'] = 'Удаление прошло успешно.';
                } else {
                    $answer['message'] = 'Возникла ошибка при удалении.';
                }
                break;
            case 'delElement': // Удаление подкатегорий
                $data = explode('_', $_POST['id']);
                $id = $data[1];

                $query = $this->db->prepare("DELETE FROM form_elements WHERE id = :id");
                $query->execute([':id' => $id]);

                if ($query->rowCount()) {
                    $answer['data'] = $this->getElements($_POST['formID']);
                    $answer['message'] = 'Удаление прошло успешно.';
                } else {
                    $answer['message'] = 'Возникла ошибка при удалении.';
                }
                break;
            case 'saveElements':
                if ($this->checkEmptyPOSTElements()) {

                    $answer['elements'] = $this->getElements($_POST['formID']);
                    $messages = '';

                    if (isset($_POST['rangeElementCategory'])) {
                        foreach ($_POST['rangeRName'] as $key => $value) {
                            $data = [
                                'ru'       => $value,
                                'eng'      => $_POST['rangeEName'][$key],
                                'messages' => &$messages,
                            ];

                            array_walk($answer['elements'], function ($element, $k, $data) {
                                if ($element['r_name'] == $data['ru']) {
                                    $data['messages'] .= "Элемент: <span style='color: red;'>'" . $data['ru'] . "'</span> уже существует. \n";
                                }

                                if ($element['e_name'] == $data['eng']) {
                                    $data['messages'] .= "Элемент: <span style='color: red;'>'" . $data['eng'] . "'</span> уже существует. \n";
                                }
                            }, $data);

                            $messages = $data['messages'];
                        }
                    }

                    if (isset($_POST['YORNElementCategory'])) {
                        foreach ($_POST['YORNRName'] as $key => $value) {
                            $data = [
                                'ru'       => $value,
                                'eng'      => $_POST['YORNEName'][$key],
                                'messages' => &$messages,
                            ];

                            array_walk($answer['elements'], function ($element, $k, $data) {
                                if ($element['r_name'] == $data['ru']) {
                                    $data['messages'] .= "Элемент: <span style='color: red;'>'" . $data['ru'] . "'</span> уже существует. \n";
                                }

                                if ($element['e_name'] == $data['eng']) {
                                    $data['messages'] .= "Элемент: <span style='color: red;'>'" . $data['eng'] . "'</span> уже существует. \n";
                                }
                            }, $data);

                            $messages = $data['messages'];
                        }
                    }

                    if (isset($_POST['listElementCategory'])) {
                        foreach ($_POST['listRName'] as $key => $value) {
                            $data = [
                                'ru'       => $value,
                                'eng'      => $_POST['listEName'][$key],
                                'messages' => &$messages,
                            ];

                            array_walk($answer['elements'], function ($element, $k, $data) {
                                if ($element['r_name'] == $data['ru']) {
                                    $data['messages'] .= "Элемент: <span style='color: red;'>'" . $data['ru'] . "'</span> уже существует. \n";
                                }

                                if ($element['e_name'] == $data['eng']) {
                                    $data['messages'] .= "Элемент: <span style='color: red;'>'" . $data['eng'] . "'</span> уже существует. \n";
                                }
                            }, $data);

                            $messages = $data['messages'];
                        }
                    }

                    if ($messages) {
                        $answer['message'] = $messages;
                    } else {

                        if (isset($_POST['rangeElementCategory'])) {
                            $type = 1;
                            $query1 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, subcategory, type, form_id) VALUES (:r_name, :e_name, :subcategory, :type, :form_id)');
                            $query2 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, type, category, form_id) VALUES (:r_name, :e_name, :type, :category, :form_id)');
                            $query3 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, type, form_id, parent_el) VALUES (:r_name, :e_name, :type, :form_id, :parent_el)');

                            foreach ($_POST['rangeRName'] as $key => $value) {
                                if (!empty($_POST['rangeParentElement'][$key])) {
                                    $query3->execute([':r_name' => $value, ':e_name' => $_POST['rangeEName'][$key], ':type' => $type, ':form_id' => $_POST['formID'], ':parent_el' => $_POST['rangeParentElement'][$key],]);
                                } elseif (empty($_POST['rangeElementSubcategory'][$key])) {
                                    $query2->execute([':r_name' => $value, ':e_name' => $_POST['rangeEName'][$key], ':type' => $type, ':category' => $_POST['rangeElementCategory'][$key], ':form_id' => $_POST['formID']]);
                                } else {
                                    $query1->execute([':r_name' => $value, ':e_name' => $_POST['rangeEName'][$key], ':subcategory' => $_POST['rangeElementSubcategory'][$key], ':type' => $type, ':form_id' => $_POST['formID']]);
                                }
                            }
                        }

                        if (isset($_POST['YORNElementCategory'])) {
                            $type = 2;
                            $query1 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, subcategory, type, yes_value, no_value, form_id) VALUES (:r_name, :e_name, :subcategory, :type, :yes_value, :no_value, :form_id)');
                            $query2 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, type, yes_value, no_value, category, form_id) VALUES (:r_name, :e_name, :type, :yes_value, :no_value, :category, :form_id)');
                            $query3 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, type, yes_value, no_value, form_id, parent_el) VALUES (:r_name, :e_name, :type, :yes_value, :no_value, :form_id, :parent_el)');

                            foreach ($_POST['YORNRName'] as $key => $value) {
                                if (!empty($_POST['YORNParentElement'][$key])) {
                                    $query3->execute([':r_name' => $value, ':e_name' => $_POST['YORNEName'][$key], ':type' => $type, ':yes_value' => $_POST['YORNElementYesValue'][$key], ':no_value' => $_POST['YORNElementNoValue'][$key], ':form_id' => $_POST['formID'], ':parent_el' => $_POST['YORNParentElement'][$key],]);
                                } elseif (empty($_POST['YORNElementSubcategory'][$key])) {
                                    $query2->execute([':r_name' => $value, ':e_name' => $_POST['YORNEName'][$key], ':type' => $type, ':yes_value' => $_POST['YORNElementYesValue'][$key], ':no_value' => $_POST['YORNElementNoValue'][$key], ':category' => $_POST['YORNElementCategory'][$key], ':form_id' => $_POST['formID']]);
                                } else {
                                    $query1->execute([':r_name' => $value, ':e_name' => $_POST['YORNEName'][$key], ':subcategory' => $_POST['YORNElementSubcategory'][$key], ':type' => $type, ':yes_value' => $_POST['YORNElementYesValue'][$key], ':no_value' => $_POST['YORNElementNoValue'][$key], ':form_id' => $_POST['formID']]);
                                }
                            }
                        }

                        if (isset($_POST['listElementCategory'])) {
                            $type = 3;
                            $query1 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, subcategory, type, form_id) VALUES (:r_name, :e_name, :subcategory, :type, :form_id) RETURNING id');
                            $query2 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, type, category, form_id) VALUES (:r_name, :e_name, :type, :category, :form_id) RETURNING id');
                            $query3 = $this->db->prepare('INSERT INTO form_elements (r_name, e_name, type, form_id, parent_el) VALUES (:r_name, :e_name, :type, :form_id, :parent_el) RETURNING id');

                            $selectOptions = explode(',', $_POST['listOptions']);
                            $count = 0;

                            //$this->printInPre($_POST);

                            foreach ($_POST['listRName'] as $key => $value) {
                                if (!empty($_POST['listParentElement'][$key])) {
                                    $query3->execute([':r_name' => $value, ':e_name' => $_POST['listEName'][$key], ':type' => $type, ':form_id' => $_POST['formID'], ':parent_el' => $_POST['listParentElement'][$key]]);
                                    $result = $query3->fetch();

                                    $optionQuery = $this->db->prepare('INSERT INTO form_select_options (r_name, e_name, value, element_id) VALUES (:r_name, :e_name, :value, :element_id)');;

                                    for ($i = $count; $i < $count + $selectOptions[$key]; $i++) {
                                        $optionQuery->execute([':r_name' => $_POST['optionRName'][$i], ':e_name' => $_POST['optionEName'][$i], ':value' => $_POST['optionEName'][$i], ':element_id' => $result[0]]);
                                    }

                                    $count += $selectOptions[$key];
                                } elseif (empty($_POST['listElementSubcategory'][$key])) {
                                    $query2->execute([':r_name' => $value, ':e_name' => $_POST['listEName'][$key], ':type' => $type, ':category' => $_POST['listElementCategory'][$key], ':form_id' => $_POST['formID']]);
                                    $result = $query2->fetch();

                                    $optionQuery = $this->db->prepare('INSERT INTO form_select_options (r_name, e_name, value, element_id) VALUES (:r_name, :e_name, :value, :element_id)');;

                                    for ($i = $count; $i < $count + $selectOptions[$key]; $i++) {
                                        $optionQuery->execute([':r_name' => $_POST['optionRName'][$i], ':e_name' => $_POST['optionEName'][$i], ':value' => $_POST['optionEName'][$i], ':element_id' => $result[0]]);
                                    }

                                    $count += $selectOptions[$key];
                                } else {
                                    $query1->execute([':r_name' => $value, ':e_name' => $_POST['listEName'][$key], ':subcategory' => $_POST['listElementSubcategory'][$key], ':type' => $type, ':form_id' => $_POST['formID']]);
                                    $result = $query1->fetch();

                                    $optionQuery = $this->db->prepare('INSERT INTO form_select_options (r_name, e_name, value, element_id) VALUES (:r_name, :e_name, :value, :element_id)');;


                                    for ($i = $count; $i < $count + $selectOptions[$key]; $i++) {
                                        $optionQuery->execute([':r_name' => $_POST['optionRName'][$i], ':e_name' => $_POST['optionEName'][$i], ':value' => $_POST['optionEName'][$i], ':element_id' => $result[0]]);
                                    }

                                    $count += $selectOptions[$key];
                                }
                            }
                        }

                        $answer['elements'] = $this->getElements($_POST['formID']);
                        $answer['message'] = 'Элементы сохранены.';
                    }

                    $answer['data'] = $this->getFormParams();
                } else {
                    $answer['message'] = 'Ошибка, не все поля заполнены.';
                }
                break;
        }

        echo json_encode($answer, JSON_UNESCAPED_UNICODE);
    }

    private function getElements($formID)
    {
        $query = $this->db->prepare("SELECT * FROM form_elements WHERE form_id = :form_id");
        $query->execute([':form_id' => $formID]);

        return $query->fetchAll();
    }

    private function checkEmptyPOSTElements($key = null)
    {
        if (!empty($key)) {
            foreach ($_POST[$key] as $element) {
                if (empty($element)) {
                    return false;
                }
            }
        } else {
            foreach ($_POST as $key => $value) {
                if ($key !== 'rangeElementSubcategory' && $key !== 'listElementSubcategory' && $key !== 'YORNElementSubcategory' &&
                    $key !== 'rangeParentElement' && $key !== 'YORNParentElement' && $key !== 'listParentElement'
                ) {
                    if (!(gettype($value) == 'array')) {
                        continue;
                    }

                    foreach ($value as $element) {
                        if (empty($element)) {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }

    public function getFormParams()
    {
        return [
            'userID'         => $_SESSION['userID'],
            'spaceTypes'     => $this->getSpaceTypes(),
            'operationTypes' => $this->getOperationTypes(),
            'objectTypes'    => $this->getObjectTypes(),
        ];
    }

    public function getFormData($id)
    {
        $categories = $this->getCategories($id);
        $subcategories = $this->getSubcategories($id);
        $form = $this->getForm($id);
        $user_id = $form[0]['user_id'];

        return [
            'id'                => $id,
            'form'              => $form,
            'user'              => $this->getUser($user_id),
            'formParams'        => $this->getFormParams(),
            'categories'        => $categories,
            'categoriesJSON'    => json_encode($categories, JSON_UNESCAPED_UNICODE),
            'subcategories'     => $subcategories,
            'subcategoriesJSON' => json_encode($subcategories, JSON_UNESCAPED_UNICODE),
            'elements'          => $this->getElements($id),
            'elementsJSON'      => json_encode($this->getElements($id), JSON_UNESCAPED_UNICODE),
        ];
    }

    public function getUser($user_id)
    {
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :user_id");
        $query->execute([':user_id' => $user_id]);

        return $query->fetchAll();
    }

    private function getSpaceTypes()
    {
        $query = $this->db->prepare("SELECT * FROM form_space_types");
        $query->execute();

        return $query->fetchAll();
    }

    private function getCategories($formID)
    {
        $query = $this->db->prepare("SELECT * FROM form_categories WHERE form_id = :form_id");
        $query->execute([':form_id' => $formID]);

        return $query->fetchAll();
    }

    private function getSubcategories($formID)
    {
        $query = $this->db->prepare("SELECT * FROM form_subcategories WHERE form_id = :form_id");
        $query->execute([':form_id' => $formID]);

        return $query->fetchAll();
    }

    private function getSpaceType($id)
    {
        $query = $this->db->prepare("SELECT * FROM form_space_types WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    private function getOperationTypes()
    {
        $query = $this->db->prepare("SELECT * FROM form_operation_types");
        $query->execute();

        return $query->fetchAll();
    }

    private function getOperationType($id)
    {
        $query = $this->db->prepare("SELECT * FROM form_operation_types WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    private function getObjectTypes()
    {
        $query = $this->db->prepare("SELECT * FROM form_object_types");
        $query->execute();

        return $query->fetchAll();
    }

    private function getObjectType($id)
    {
        $query = $this->db->prepare("SELECT * FROM form_object_types WHERE id = :id");
        $query->execute([':id' => $id]);

        return $query->fetch();
    }

    /**
     * Привязка
     * социальных
     * сетей
     */

    public function getCabinetData()
    {
        if (isset($_SESSION['OAuth_state']) && $_SESSION['OAuth_state'] == 3) {
            $result = $this->setSocialNet($_SESSION['OAuth_service'], $_SESSION['OAuth_user_id'], $_SESSION['userID']);
        }

        return [
            'social_nets' => $this->getSocialNets(),
        ];
    }

    private function getSocialNets()
    {
        return $this->db->select('vk_id, ok_id, mail_id, ya_id, google_id, steam_id, facebook_id')->from('users')->where('id', '=', $_SESSION['userID'])->execute();
    }

    private function setSocialNet($service, $service_id, $user_id)
    {
        $first_name = trim($_SESSION['OAuth_first_name']);
        $last_name = trim($_SESSION['OAuth_last_name']);

        $avatar = $_SESSION['OAuth_avatar'];
        $name = $first_name . ' ' . $last_name;

        $query = '';

        switch ($service) {
            case 'vk':
                $query = $this->db->prepare('UPDATE users SET vk_id = :service_id, vk_name = :serviceName, vk_avatar = :serviceAvatar WHERE id = :user_id');
                break;
            case 'ok':
                $query = $this->db->prepare('UPDATE users SET ok_id = :service_id, ok_name = :serviceName, ok_avatar = :serviceAvatar WHERE id = :user_id');
                break;
            case 'mail':
                $query = $this->db->prepare('UPDATE users SET mail_id = :service_id, mail_name = :serviceName, mail_avatar = :serviceAvatar WHERE id = :user_id');
                break;
            case 'ya':
                $query = $this->db->prepare('UPDATE users SET ya_id = :service_id, ya_name = :serviceName, ya_avatar = :serviceAvatar WHERE id = :user_id');
                break;
            case 'google':
                $query = $this->db->prepare('UPDATE users SET google_id = :service_id, google_name = :serviceName, google_avatar = :serviceAvatar WHERE id = :user_id');
                break;
            case 'fb':
                $query = $this->db->prepare('UPDATE users SET facebook_id = :service_id, facebook_name = :serviceName, facebook_avatar = :serviceAvatar WHERE id = :user_id');
                break;
            case 'steam':
                $query = $this->db->prepare('UPDATE users SET steam_id = :service_id, steam_name = :serviceName, steam_avatar = :serviceAvatar WHERE id = :user_id');
                break;
        }

        $query->execute([':service_id' => $service_id, ':user_id' => $user_id, ':serviceName' => $name, ':serviceAvatar' => $avatar]);

        $this->clearOAuth();

        return $query->rowCount();
    }

    public function getBalanceHistory()
    {
        $user_id = (int)$_SESSION['userID'];
        // Преобразование данных формы в дату
        $calendar_start = $_POST["calendar_start"];
        $calendar_end = $_POST["calendar_end"];

        if (preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", $calendar_start) && preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", $calendar_end)) {
            $calendar_start_arr = explode("-", $calendar_start);
            $calendar_end_arr = explode("-", $calendar_end);
            $start = $calendar_start_arr[2] . '-' . $calendar_start_arr[1] . '-' . $calendar_start_arr[0];
            $end = $calendar_end_arr[2] . '-' . $calendar_end_arr[1] . '-' . $calendar_end_arr[0];
            $sql = "SELECT to_char(date::date,'DD-MM-YYYY'), operation, value, rest_balance FROM balance_history ";
            $sql .= "WHERE user_id = :user_id AND date::date >=  :start::date AND date::date <=  :end::date ";
            $sql .= 'ORDER BY date DESC';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':start', $start);
            $stmt->bindParam(':end', $end);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $data['calendar_start'] = $calendar_start;
            $data['calendar_end'] = $calendar_end;
        } else {
            return;
        }

        return $data;
    }

    public function getMyAds($count = 10, $offset = 0)
    {
        if(!isset($_SESSION['user'])) {
            // TODO: Дописать обработку ошибки если пользователь не авторизован
            $this->response['error'] = 0;
            return;
        }

        if (isset($_GET['count'])) {
            $count = $_GET['count'];
        }

        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }

        $query = $this->db->prepare('SELECT * FROM news_base WHERE user_id = :user_id LIMIT :limit OFFSET :offset');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':limit' => $count,
            ':offset' => $offset,
        ]);

        $ads = $query->fetchAll();

        if ($ads) {
            $this->response['response'] = $ads;
        } else {
            $this->response['error'] = null;
        }
    }

    public function addAdInFavorite($ad_id)
    {
        if (!$ad_id) {
            // TODO: Обработка ошибки когда не задано id объявления
            $this->response['error'] = false;
            return;
        }

        if(!isset($_SESSION['user'])) {
            // TODO: Дописать обработку ошибки если пользователь не авторизован
            $this->response['error'] = false;
            return;
        }

        $query = $this->db->prepare('INSERT INTO favorite_ads (user_id, ad_id) VALUES (:user_id, :ad_id)');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':ad_id' => $ad_id,
        ]);

        if ($query->rowCount()) {
            $this->response['response'] = true;
        } else {
            $this->response['error'] = false;
        }
    }

    public function getListFavorite($count = 6, $offset = 0)
    {
        if(!isset($_SESSION['user'])) {
            // TODO: Дописать обработку ошибки если пользователь не авторизован
            $this->response['error'] = 0;
            return;
        }

        if (isset($_GET['count'])) {
            $count = $_GET['count'];
        }

        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }

        $query = $this->db->prepare('SELECT * FROM favorite_ads, news_base WHERE favorite_ads.ad_id = news_base.id_news AND favorite_ads.user_id = :user_id LIMIT :limit OFFSET :offset');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':limit' => $count,
            ':offset' => $offset,
        ]);

        $ads = $query->fetchAll();

        if ($ads) {
            $this->response['response'] = $ads;
        } else {
            $this->response['error'] = null;
        }
    }

    public function getResponse()
    {
        return $this->response;
    }
}
