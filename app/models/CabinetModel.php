<?php

use Respect\Validation\Validator as v;

class CabinetModel extends Model
{
    use Cleaner;

    const IDSPERPAGE = 5;
    const ADMINSTATUS = 8;
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

    public function getChatMessagesFromDB($id, $offset = 0, $count = 25)
    {
        if (isset($_GET['count'])) {
            $count = $_GET['count'];
        }

        if (!is_numeric($count)) {
            $this->error(self::INVALID_QWERY_ERROR);
        }

        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }

        if (!is_numeric($offset)) {
            $this->error(self::INVALID_QWERY_ERROR);
        }

        if (isset($_GET['id'])) {
            if (!is_numeric($_GET['id'])) {
                $this->error(self::INVALID_QWERY_ERROR);
            }

                $id = $_GET['id'];

                $stmt = $this->db->prepare("SELECT * FROM dialogs_messages WHERE chat_id = $id");
                $stmt->execute();
                if ($stmt->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
                }
                $messages = $stmt->fetchAll();

                $i = 0;
                $ids = [];

                if ($messages) {
                    $new_messages = array_reverse($messages);
                    $messages = $new_messages;

                    foreach ($messages as $item => $key) {
                        if (($item >= $offset)) {
                            if ($item != count($messages)) {
                                if ($i != $count) {
                                    $ids[$i] = $messages[$item]['id'];
                                    $i++;
                                }
                            }
                        }
                    }

                    $messages = [];
                    if ($ids) {
                        foreach ($ids as $item => $key) {
                            $messages[$item]['id'] = $key['id'];
                            $messages[$item]['chat_id'] = $key['chat_id'];
                            $messages[$item]['from_id'] = $key['user_id'];
                            $messages[$item]['message'] = $key['text'];
                            $massiv[$item]['photo'] = $this->getAvatarDialogs($key['user_id']);
                            $messages[$item]['attachment'] = $key['attachement'];
                            $messages[$item]['type'] = $key['type_attachement'];
                            $messages[$item]['time'] = $key['date'];
                            $messages[$item]['read_state'] = $key['read_state'];
                            $messages[$item]['out'] = $key['out'];
                        }
                    }

                    $this->response = $messages;
                }
        } else {
            $this->response(array());
        }
    }

    public function deleteAllDialogs() // Удалить все диалоги
    {
        $profile_id = $_SESSION['user']['id'];
        $stmt = $this->db->prepare("UPDATE dialogs SET show = 0 WHERE user_id= $profile_id");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
        }

        return $this->getDialogs(true);
    }

    public function getAvatarDialogs($id)
    {
        $stmt = $this->db->prepare("SELECT owners FROM dialogs_properties WHERE id = $id");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $owners = $stmt->fetchAll();
        $owners = $owners[0]['owners'];
        $massivOwners = explode(",", $owners);
        if (count($massivOwners) == 2) {
            foreach ($massivOwners as $item => $key) {
                if ($key != $_SESSION['user']['id']) {
                    $profile_foto_id = $this->getAvatarUser($key);

                    return $profile_foto_id;
                }
            }
        } else {
            $stmt = $this->db->prepare("SELECT avatar FROM dialogs_properties WHERE id = $id");
            $stmt->execute();
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
            }
            $avatar = $stmt->fetchAll();
            $avatar = $avatar[0]['avatar'];
            if ($avatar[0]['avatar'] != null)
                $avatar = $avatar[0]['avatar'];
            else
                $avatar = '';

            return $avatar;
        }
    }

    public function getDialogs($offset = 0, $count = 25)
    {
        if (isset($_GET['count'])) {
            $count = $_GET['count'];
        }

        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }


        $flagOfDialog = 1; // Сделанно в целях безапасности, по мере необходимости удаленных диалогов должно быть убранно
        if ($flagOfDialog) {
            $ids = $this->getDialogsIDs();
        } else {
            $ids = $this->getDeletedDialogsIDs();
        }

        if ($ids) {
            $massiv_to_sort['ids'] = $ids;

            foreach ($ids as $item => $key) {
                $stmt = $this->db->prepare("SELECT max(date) FROM dialogs_messages WHERE chat_id = $key");
                $stmt->execute();
                if ($stmt->errorCode() != '00000') {
                    $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
                }
                $timestamp = $stmt->fetchAll();
                if ($timestamp[0]['max'] != null)
                    $massiv_to_sort['timestamp'][$item] = $timestamp[0]['max'];
                else
                    $massiv_to_sort['timestamp'][$item] = '';
            }

            for ($i = 0; $i <= count($massiv_to_sort['ids']); $i++) {
                for ($j = $i + 1; $j < count($massiv_to_sort['ids']); $j++) {
                    if (($massiv_to_sort['timestamp'][$j] != '') && ($massiv_to_sort['timestamp'][$i] != '')) {
                        if ($massiv_to_sort['timestamp'][$j] > $massiv_to_sort['timestamp'][$i]) {
                            $temp_timestamp = $massiv_to_sort['timestamp'][$i];
                            $temp_ids = $massiv_to_sort['ids'][$i];
                            $massiv_to_sort['timestamp'][$i] = $massiv_to_sort['timestamp'][$j];
                            $massiv_to_sort['ids'][$i] = $massiv_to_sort['ids'][$j];
                            $massiv_to_sort['timestamp'][$j] = $temp_timestamp;
                            $massiv_to_sort['ids'][$j] = $temp_ids;
                        }
                    }
                }
            }

            $i = 0;
            $ids = [];
            foreach ($massiv_to_sort['ids'] as $item => $key) {
                if (($item >= $offset)) {
                    if ($item != count($massiv_to_sort['ids'])) {
                        if ($i != $count) {
                            $ids[$i] = $massiv_to_sort['ids'][$item];
                            $i++;
                        }
                    }
                }
            }
        }

        if ($ids) {
            $massiv = [];
            foreach ($ids as $item => $key) {

                $last_message = $this->getLastMessage($key);
                $last_message_text = $last_message['text'];
                $last_message_avatar = $last_message['avatar'];
                $last_message_time = $last_message['time'];
                $last_message_user_id = $last_message['user_id'];
                $last_message_type = $last_message['type'];
                $last_message_attachment = $last_message['attachment'];

                $massiv[$item]['id'] = $ids[$item];
                $massiv[$item]['title'] = $this->getDialogName($key);
                $massiv[$item]['photo'] = $this->getAvatarDialogs($key);
                $massiv[$item]['messages']['chat_id'] = $ids[$item];
                $massiv[$item]['messages']['message'] = $last_message_text;
                $massiv[$item]['messages']['from_id'] = $last_message_user_id;
                $massiv[$item]['messages']['from_name'] = $this->getNamesUsersForDialog($last_message_user_id);
                $massiv[$item]['messages']['photo'] = $last_message_avatar;
                $massiv[$item]['messages']['time'] = $last_message_time;
                $massiv[$item]['messages']['type'] = $last_message_type;
                $massiv[$item]['messages']['attachment'] = $last_message_attachment;
            }
            $this->response = $massiv;
        } else {
            $this->response(array());
        }
    } // Получить диалоги true - активные, false - удаленные

    public function getResponse()
    {
        return $this->response;
    }


    public function getDialogsIDs()
    {
        $profile_id = $_SESSION['user']['id'];
        //$profile_id = 23;
        $stmt = $this->db->prepare("SELECT * FROM dialogs WHERE user_id= $profile_id AND show= 1");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
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
        $profile_id = $_SESSION['user']['id'];
        $stmt = $this->db->prepare("SELECT * FROM dialogs WHERE user_id= $profile_id AND show= 0");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
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
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $owners = $stmt->fetchAll();
        $owners = $owners[0]['owners'];
        $massivOwners = explode(",", $owners);
        if (count($massivOwners) == 2) {
            foreach ($massivOwners as $item => $key) {
                if ($key != $_SESSION['user']['id']) {
                    $name = $this->getNamesUsersForDialog($key);

                    return $name;
                }
            }
        }
        $stmt = $this->db->prepare("SELECT name FROM dialogs_properties WHERE id = $id");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $name = $stmt->fetchAll();
        $name = $name[0]['name'];
        $name = mb_substr($name, 0, 64, 'UTF-8');

        return $name;
    } // Узнать название диалога по id

    public function getAvatarUser($id) // Возвращает ссылку на аватар пользователя по id
    {
        $stmt = $this->db->prepare("SELECT profile_foto_id FROM users WHERE id = $id");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $profile_foto_id = $stmt->fetchAll();

        if (isset($profile_foto_id[0]['profile_foto_id'])) {
            $profile_foto_id = $profile_foto_id[0]['profile_foto_id'];
        } else {
            $profile_foto_id = '';
        }

        return $profile_foto_id;
    }

    public function getLastMessage($id)
    {
        $stmt = $this->db->prepare("SELECT max(id) FROM dialogs_messages WHERE chat_id = $id");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $i = $stmt->fetchAll();
        $i = $i[0]['max'];

        if ($i != null) {
            $stmt = $this->db->prepare("SELECT * FROM dialogs_messages WHERE id = $i");
            $stmt->execute();
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
            }
            $info = $stmt->fetchAll();
            $user_id = $info[0]['user_id'];
            $message = $info[0]['text'];
            $time = $info[0]['date'];
            $attachment = $info[0]['attachment'];
            $type = $info[0]['type_attachment'];
            $profile_foto_id = $this->getAvatarUser($info[0]['user_id']);
        } else {
            $type = '';
            $attachment = '';
            $user_id = '';
            $time = '';
            $message = '';
            $profile_foto_id = '';
        }

        return [
            'attachment' => $attachment,
            'type'       => $type,
            'user_id'    => $user_id,
            'time'       => $time,
            'text'       => $message,
            'avatar'     => $profile_foto_id,
        ];
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
        $profile_id = $_SESSION['user']['id'];
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
        $profile_id = $_SESSION['user']['id'];
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
        $profile_id = $_SESSION['user']['id'];

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

        //$chat_owners = sort($chat_owners);

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
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $name = $stmt->fetchAll();
        if (isset($name[0]['first_name'])) {
            $fullName = $name[0]['first_name'];
            $stmt = $this->db->prepare("SELECT last_name FROM users WHERE id = {$id}");
            $stmt->execute();
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
            }
            $name = $stmt->fetchAll();
            $fullName .= ' ' . $name[0]['last_name'];
        } else {
            $fullName = '';
        }
        return $fullName;
    } // Узнать имя и фамилию пользователя по ID

    public function getIdsUsersForDialog()
    {
        $profile_id = $_SESSION['user']['id'];
        $status = self::ADMINSTATUS;
        $stmt = $this->db->prepare("SELECT id FROM users WHERE id != $profile_id AND status != $status");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
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
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $name = $stmt->fetchAll();
        $fullName = $name[0]['first_name'];

        return $fullName;
    }// Узнать только имя по ID

    public function checkDialogExist($owners) // Проверка существования диалога по строке owners = "1,2,3"
    {
        //$owners = sort($owners);
        $stmt = $this->db->prepare("SELECT id FROM dialogs_properties WHERE owners = '{$owners}'");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
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
        $profile_id = $_SESSION['user']['id'];
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
        $profile_id = $_SESSION['user']['id'];

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
        $profile_id = $_SESSION['user']['id'];
        $stmt = $this->db->prepare("DELETE FROM sessions WHERE id_user = $profile_id");
        $stmt->execute();
        session_destroy();
        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit;
    }

    public function delete_gadget()
    {
        $profile_id = $_SESSION['user']['id'];
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
        $profile_id = $_SESSION['user']['id'];
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = $profile_id");
        $stmt->execute();
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
        }
        $info = $stmt->fetchAll();

        return $info;
    }

    public function getProfileInfo()
    {
        $info = $this->getinfo();
        $info = $info[0];
        $massiv = [];

        $massiv['name_name'] = $info['first_name'];
        $massiv['name_surname'] = $info['last_name'];
        $massiv['name_patronymic'] = $info['patronymic'];

        $massiv['name_birthday'] = $info['birthday'];

        $massiv['about_me'] = isset($info['about_me']) ? $info['about_me'] : '';
        $massiv['name_birthday'] = isset($info['birthday']) ? $info['birthday'] : '';

        $massiv['passport_series'] = isset($info['series']) ? $info['series'] : '';
        $massiv['passport_number'] = isset($info['number']) ? $info['number'] : '';

        $massiv['adress_index'] = isset($info['index']) ? $info['index'] : '';
        $massiv['adress_city'] = isset($info['city']) ? $info['city'] : '';
        $massiv['adress_street'] = isset($info['street']) ? $info['street'] : '';
        $massiv['adress_home'] = isset($info['home']) ? $info['home'] : '';
        $massiv['adress_flat'] = isset($info['flat']) ? $info['flat'] : '';

        $massiv['contacts_number'] = isset($info['phone_number']) ? $info['phone_number'] : '';
        $massiv['contacts_email'] = isset($info['email']) ? $info['email'] : '';

        $massiv['profile_foto_link'] = isset($info['profile_foto_id']) ? $info['profile_foto_id'] : '';

        $massiv['socialNet_VK'] = isset($info['vk_id']) ? 'https://vk.com/id' . $info['vk_id'] : '';
        $massiv['socialNet_OK'] = isset($info['ok_id']) ? 'https://ok.ru/profile/' . $info['ok_id'] : '';
        $massiv['socialNet_MAIL'] = isset($info['mail_id']) ? 'https://mail.ru/profile/' . $info['mail_id'] : '';
        $massiv['socialNet_YA'] = isset($info['ya_id']) ? 'https://passport.yandex.ru/profile/' . $info['ya_id'] : '';
        $massiv['socialNet_GOOGLE'] = isset($info['google_id']) ? 'https://plus.google.com/u/0/' . $info['ya_id'] : '';
        $massiv['socialNet_STEAM'] = isset($info['steam_id']) ? 'http://steamcommunity.com/profiles/' . $info['steam_id'] : '';

        $this->response = $massiv;
    }

    public function getProfileInfoSecurity()
    {
        $info = $this->getinfo();
        $info = $info[0];

        $this->response(array());
    }

    public function getPersonalInfoSettings()
    {
        $info = $this->getinfo();
        $info = $info[0];
        $massiv = [];

        $massiv['connection_phone_only'] = isset($info['phone_only']) ? $info['phone_only'] : '1';
        $massiv['connection_site_only'] = isset($info['site_only']) ? $info['site_only'] : '1';
        $massiv['notification_new_dialog'] = isset($info['new_dialog']) ? $info['new_dialog'] : '1';
        $massiv['notification_close_ad'] = isset($info['close_ad']) ? $info['close_ad'] : '1';
        $massiv['notification_prom_offers'] = isset($info['prom_offers']) ? $info['prom_offers'] : '1';

        $this->response = $massiv;
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
        $pattern = "/([a-z0-9]+)/i";
        if (preg_match($pattern, $str, $matches))
            return false;
        if ($str == '')
            return false;
        $str = ucfirst($str);

        return $str;
    }

    public function сheckNumbers($str) // Проверка числового значения
    {
        $str = trim($str);
        $old_str = $str;
        $str = preg_replace('~([^0-9]+)~', '', $str);
        if ($old_str != $str)
            return false;
        return $str;
    }

    public function checkPassportNumbers($str) // Проверка пасспортных символов
    {
        $str = trim($str);
        $old_str = $str;
        $str = preg_replace('~([^0-9\-]+)~', '', $str);
        if ($old_str != $str)
            return false;
        return $str;
    }

    public function checkDate($str)
    {
        if (!v::Date()->validate($str))
            return false;
        return $str;
    }

    public function сheckBirthDay($str)
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

        if ($str == '')
            return false;

        $date = explode('.', $str);

        $date[0] = preg_replace("/[^0-9]/", '', $date[0]);
        $day = $date[0];
        if (($day > 31) || ($day < 1))
            return false;

        $date[2] = preg_replace("/[^0-9]/", '', $date[2]);
        $year = $date[2];
        if (($year > date('Y')) || ($year < 1920))
            return false;

        $month_choosen = $date[1];
        $month_num = 0;
        for ($i = 0; $i < 12; $i++) {
            $var1 = $month_choosen;
            $var2 = $month[$i];
            if (strcasecmp($var1, $var2) == 0) {
                $month_choosen = $i + 1;
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
        $date = $date[0] . '.' . $date[1] . '.' . $date[2];

        return $date;
    } // Проверка даты рождения

    public function сheckEmail($str)
    {
        if (!filter_var(trim($str), FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return $str;
    } // Проверка E-mail

    public function сheckIllegalSymbols($str) // Проверка на запрещенные символы, исключения "/" "."
    {
        $str = trim($str);
        if (!mb_ereg_match("^[а-яА-ЯёЁ\d\s\.\-\/]+$", $str))
            return false;
        if ($str == '')
            return false;
        $str = ucfirst($str);

        return $str;
    }

    public function checkPhoneNumber($str)
    {
        $str = trim($str);
        $str = str_replace(' ', '', $str);
        if (!mb_ereg_match("((8|\+7)(|\-)?)?(\(?\d{3}\)?(|\-)?)?[\d\- ]{7,10}$", $str))
            return false;
//        if (!v::phone()->validate($str))
//            return false;
        return $str;
    }


    public function savePersonalInfo() // Редактирование профиля
    {
        if (!isset($_SESSION['user']['id'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }
        $profile_id = $_SESSION['user']['id'];
        $update = [];

        if ($str = $this->сheckPersonalName($_POST['name_name'])) {
            $update['name_name'] = $str;
        } else {
            $this->error(self::WRONG_NAME_NAME);
        }
        if ($str = $this->сheckPersonalName($_POST['name_surname'])) {
            $update['name_surname'] = $str;
        } else {
            $this->error(self::WRONG_NAME_SURNAME);
        }
        if ($str = $this->сheckPersonalName($_POST['name_patronymic'])) {
            $update['name_patronymic'] = $str;
        } else {
            $this->error(self::WRONG_NAME_PATRONYMIC);
        }
        if ($str = $this->checkDate($_POST['name_birthday'])) {
            $update['name_birthday'] = $str;
        } else {
            $this->error(self::WRONG_BIRTHDAY);
        }
        if ($str = $this->checkPassportNumbers($_POST['passport_series'])) {
            $update['passport_series'] = $str;
        } else {
            $this->error(self::WRONG_PASSPORT_SERIES);
        }
        if ($str = $this->checkPassportNumbers($_POST['passport_number'])) {
            $update['passport_number'] = $str;
        } else {
            $this->error(self::WRONG_PASSPORT_NUMBER);
        }
        if ($str = $this->сheckNumbers($_POST['adress_index'])) {
            $update['adress_index'] = $str;
        } else {
            $this->error(self::WRONG_ADRESS_INDEX);
        }
        if ($str = $this->сheckPersonalName($_POST['adress_city'])) {
            $update['adress_city'] = $str;
        } else {
            $this->error(self::WRONG_ADRESS_CITY);
        }
        if ($str = $this->сheckIllegalSymbols($_POST['adress_street'])) {
            $update['adress_street'] = $str;
        } else {
            $this->error(self::WRONG_ADRESS_STREET);
        }
        if ($str = $this->сheckIllegalSymbols($_POST['adress_home'])) {
            $update['adress_home'] = $str;
        } else {
            $this->error(self::WRONG_ADRESS_HOME);
        }
        if ($str = $this->сheckNumbers($_POST['adress_flat'])) {
            $update['adress_flat'] = $str;
        } else {
            $this->error(self::WRONG_ADRESS_FLAT);
        }
        if ($str = $this->checkPhoneNumber($_POST['contacts_number'])) {
                $str = preg_replace('~([^0-9]+)~', '', $str);
            if (strlen($str) == 11) {
                $str[0] = 7;
            }
            $update['contacts_number'] = $str;
        } else {
            $this->error(self::WRONG_PHONE_NUMBER);
        }
        if ($str = $this->сheckEmail($_POST['contacts_email'])) {
            $update['contacts_email'] = $str;
        } else {
            $this->error(self::WRONG_EMAIL);
        }

        $update['profile_id'] = $profile_id;
        $this->saveUpdatePersonalInfo($update);
        $this->response['response'] = true;
    }

    public function savePersonalInfoSettings()
    {
        if (!isset($_SESSION['user']['id'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        $profile_id = $_SESSION['user']['id'];
        if (isset($_POST['connection_new_dialog'])) {
            $stmt = $this->db->prepare("UPDATE users SET new_dialog = 1 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (isset($_POST['connection_close_ad'])) {
            $stmt = $this->db->prepare("UPDATE users SET close_ad = 1 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (isset($_POST['connection_prom_offers'])) {
            $stmt = $this->db->prepare("UPDATE users SET prom_offers = 1 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (!isset($_POST['connection_new_dialog'])) {
            $stmt = $this->db->prepare("UPDATE users SET new_dialog = 0 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (!isset($_POST['connection_close_ad'])) {
            $stmt = $this->db->prepare("UPDATE users SET close_ad = 0 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (!isset($_POST['connection_prom_offers'])) {
            $stmt = $this->db->prepare("UPDATE users SET prom_offers = 0 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (isset($_POST['phone_only'])) {
            $stmt = $this->db->prepare("UPDATE users SET phone_only = 1 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (isset($_POST['site_only'])) {
            $stmt = $this->db->prepare("UPDATE users SET site_only = 1 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (!isset($_POST['phone_only'])) {
            $stmt = $this->db->prepare("UPDATE users SET phone_only = 0 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
        if (!isset($_POST['site_only'])) {
            $stmt = $this->db->prepare("UPDATE users SET site_only = 0 WHERE id = :profile_id");
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
            }
            $stmt->execute([':profile_id' => $profile_id]);
        }
    }


    //        // Отвязка социальных сетей
    //        if (isset($_POST['delete_vk']) || (isset($_POST['delete_steam'])) || (isset($_POST['delete_ok'])) || (isset($_POST['delete_ya'])) || (isset($_POST['delete_mail'])) || (isset($_POST['delete_facebook'])) || (isset($_POST['delete_google']))) {
    //            foreach ($_POST as $key => $value) {
    //                if ($value == 'Отвязать') {
    //                    $social_net = explode("_", $key);
    //                    if (isset($social_net[1])) {
    //                        $id = $social_net[1] . "_id";
    //                        $name = $social_net[1] . "_name";
    //                        $avatar = $social_net[1] . "_avatar";
    //                        $stmt = $this->db->prepare("UPDATE users SET :id = NULL WHERE id = :profile_id");
    //                        $stmt->execute(array(':id' => $id, ':profile_id' => $profile_id));
    //                        $stmt = $this->db->prepare("UPDATE users SET :name = NULL WHERE id = :profile_id");
    //                        $stmt->execute(array(':name' => $name, ':profile_id' => $profile_id));
    //                        $stmt = $this->db->prepare("UPDATE users SET :avatar = NULL WHERE id = :profile_id");
    //                        $stmt->execute(array(':avatar' => $avatar, ':profile_id' => $profile_id));
    //                    }
    //                }
    //            }
    //        }

    //        if (isset($_POST['check_with_passport'])) // Подтвердить паспортом
    //        {
    //        }
    //
    //        if (isset($_POST['update_foto_id']))
    //        {
    //        }
    //
    //        if (isset($_POST['delete_foto_id'])) // Установить default аватар профиля
    //        {
    //            $link = 'http://images.lant.io/profile_fotos/user_foto_id_default.jpg';
    //            $stmt = $this->db->prepare("UPDATE users SET profile_foto_id = :link WHERE id = :profile_id");
    //            $stmt->execute(array(':link' => $link, ':profile_id' => $profile_id));
    //        }

    public function saveUpdatePersonalInfo($update)
    {
        $update['passport_series'] = str_replace('-', '', $update['passport_series']);
        $update['passport_number'] = str_replace('-', '', $update['passport_number']);

        $stmt = $this->db->prepare("UPDATE users SET first_name = :name_name, last_name = :name_surname, patronymic = :name_patronymic, birthday = :name_birthday, about_me = :about_me,
                                              series = :passport_series, number = :passport_number, 
                                              index = :adress_index, city = :adress_city, street = :adress_street, home = :adress_home, flat = :adress_flat,
                                              phone_number = :contacts_number, email = :contacts_email
                                              WHERE id = :profile_id");
        $stmt->execute([
            ':name_name'      => $update['name_name'],
            'name_surname'    => $update['name_surname'],
            'name_patronymic' => $update['name_patronymic'],
            'name_birthday'   => $update['name_birthday'],
            'about_me'        => $update['about_me'],
            'passport_series' => $update['passport_series'],
            'passport_number' => $update['passport_number'],
            'adress_index'    => $update['adress_index'],
            'adress_city'     => $update['adress_city'],
            'adress_street'   => $update['adress_street'],
            'adress_home'     => $update['adress_home'],
            'adress_flat'     => $update['adress_flat'],
            'contacts_number' => $update['contacts_number'],
            'contacts_email'  => $update['contacts_email'],
            ':profile_id'     => $update['profile_id'],
        ]);
        if ($stmt->errorCode() != '00000') {
            $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
        }
    }

    public function savePassword()
    {
        if (!isset($_SESSION['user']['id'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }
        $profile_id = $_SESSION['user']['id'];
        {
            $stmt = $this->db->prepare("SELECT password FROM users WHERE id = $profile_id");
            $stmt->execute();
            if ($stmt->errorCode() != '00000') {
                $this->error(self::DB_SELECT_ERROR, $stmt->errorInfo());
            }
            $result = $stmt->fetchAll();

            $new_result = $result[0]['password'];

            if (password_verify($_POST['old_pass'], $new_result)) {
                $passwordHash = password_hash($_POST['new_pass'], PASSWORD_DEFAULT);
                $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :profile_id");
                $stmt->execute([':password' => $passwordHash, ':profile_id' => $profile_id]);
                if ($stmt->errorCode() != '00000') {
                    $this->error(self::DB_UPDATE_ERROR, $stmt->errorInfo());
                }
            } else {
                $this->error(self::WRONG_PASSWORD_ERROR);
            }
        }
        $this->response['response'] = true;
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

                $query = $this->db->prepare('UPDATE users SET profile_foto_id = :file_name WHERE id = ' . $_SESSION['user']['id']);
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
                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->Host = 'smtp.yandex.ru';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAuth = true;
                $mail->Username = "admin@lant.io";
                $mail->Password = "ZSH1wb88";

                foreach ($_SESSION['keys'] as $email => $key) {
                    $str = file_get_contents(ROOT_DIR . '/template/layouts/mail.php');
                    $content = $str;
                    $old = ["{KEY}"];
                    $new = [$key];
                    $newContent = str_replace($old, $new, $content);
                    $mail->setLanguage('ru');
                    $mail->setFrom('admin@lant.io', 'LANT.IO');
                    $mail->addAddress($email);
                    $mail->addReplyTo('admin@lant.io');
                    $mail->Subject = 'Beta Access';
                    $mail->msgHTML($newContent);

                    if ($mail->send()) {
                        $mail->clearAddresses();
                    } else {
                        var_dump($mail->ErrorInfo);
                    }

                    //                    $headers = 'MIME-Version: 1.0' . "\r\n";
//                    $headers .= 'Content-type: text/html; charset="utf-8"' . "\r\n";
//                    $headers .= "From: Lant.io <noreply@lant.io>\r\n";
//                    mail($email, "Альфа ключ", $newContent, $headers);
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
        //$_SESSION['user']['id'] = 11;
        if ($_SESSION['status'] > 4) {
            $query = $this->db->prepare("SELECT * FROM forms");
            $query->execute();
        } else {
            $query = $this->db->prepare("SELECT * FROM forms WHERE user_id = :user_id");
            $query->execute([':user_id' => $_SESSION['user']['id']]);
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
            ':user_id'     => $_SESSION['user']['id'],
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
            'userID'         => $_SESSION['user']['id'],
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
            $result = $this->setSocialNet($_SESSION['OAuth_service'], $_SESSION['OAuth_user_id'], $_SESSION['user']['id']);
        }

        return [
            'social_nets' => $this->getSocialNets(),
        ];
    }

    private function getSocialNets()
    {
        return $this->db->select('vk_id, ok_id, mail_id, ya_id, google_id, steam_id, facebook_id')->from('users')->where('id', '=', $_SESSION['user']['id'])->execute();
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
        $user_id = (int)$_SESSION['user']['id'];
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
        if (!isset($_SESSION['user'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        if (isset($_GET['count'])) {
            $count = $_GET['count'];
        }

        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }

        $query = $this->db->prepare("SELECT news_base.*, i.*, 
                                               (CASE WHEN f.user_id IS NOT NULL THEN 1 ELSE 0 END) AS favorite,
                                               ml.line_color AS metro_color, ms.metro_name AS metro_station
                                               FROM news_base 
                                               LEFT JOIN (SELECT DISTINCT ON(ad_id) * FROM ads_images) i ON (news_base.id_news = i.ad_id) 
                                               LEFT JOIN favorite_ads f ON (f.ad_id = news_base.id_news AND f.user_id = :user_id) 
                                               LEFT JOIN metro_stations ms ON (news_base.metro_station = ms.metro_id)
                                               LEFT JOIN metro_line ml ON (ms.line_id::CHAR = ml.line_number)
                                               WHERE news_base.user_id = :user_id LIMIT :limit OFFSET :offset");
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':limit'   => $count,
            ':offset'  => $offset,
        ]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
        }

        $ads = $query->fetchAll();

        if ($ads) {
            $count_query = $this->db->query("SELECT count(*) FROM news_base WHERE user_id = {$_SESSION['user']['id']}");
            $result = $count_query->fetch();

            $count_active_query = $this->db->query("SELECT count(*) FROM news_base WHERE user_id = {$_SESSION['user']['id']} AND status > 0");
            $active_result = $count_active_query->fetch();

            $count = $result ? $result['count'] : 0;
            $active_count = $active_result ? $active_result['count'] : 0;

            $this->response([
                'count' => (int)$count,
                'count_active' => (int)$active_count,
                'items' => $ads,
            ]);
        } else {
            $this->response([
                'count' => 0,
                'items' => [],
            ]);
        }
    }

    public function addAdInFavorite($ad_id)
    {
        if (!$ad_id) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!isset($_SESSION['user'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        $query = $this->db->prepare('INSERT INTO favorite_ads (user_id, ad_id) VALUES (:user_id, :ad_id)');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':ad_id'   => $ad_id,
        ]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_INSERT_ERROR, $query->errorInfo());
        }

        if ($query->rowCount()) {
            $this->response(true);
        }
    }

    public function removeAdInFavorite($ad_id)
    {
        if (!$ad_id) {
            $this->error(self::BAD_REQUEST_ERROR);
        }

        if (!isset($_SESSION['user'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        $query = $this->db->prepare('DELETE FROM favorite_ads WHERE user_id = :user_id AND ad_id = :ad_id');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':ad_id'   => $ad_id,
        ]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_DELETE_ERROR, $query->errorInfo());
        }

        if ($query->rowCount()) {
            $this->response(true);
        }
    }

    public function getListFavorite($count = 6, $offset = 0)
    {
        if (!isset($_SESSION['user'])) {
            $this->error(self::USER_NOT_AUTHORIZED_ERROR);
        }

        if (isset($_GET['count'])) {
            $count = $_GET['count'];
        }

        if (isset($_GET['offset'])) {
            $offset = $_GET['offset'];
        }

        $query = $this->db->prepare('SELECT *, ml.line_color AS metro_color, ms.metro_name AS metro_station FROM favorite_ads, news_base 
                                               LEFT JOIN (SELECT DISTINCT ON(ad_id) * FROM ads_images) i ON (news_base.id_news = i.ad_id) 
                                               LEFT JOIN metro_stations ms ON (news_base.metro_station = ms.metro_id)
                                               LEFT JOIN metro_line ml ON (ms.line_id::CHAR = ml.line_number)
                                               WHERE favorite_ads.ad_id = news_base.id_news AND favorite_ads.user_id = :user_id LIMIT :limit OFFSET :offset');
        $query->execute([
            ':user_id' => $_SESSION['user']['id'],
            ':limit'   => $count,
            ':offset'  => $offset,
        ]);

        if ($query->errorCode() !== '00000') {
            $this->error(self::DB_SELECT_ERROR, $query->errorInfo());
        }

        $ads = $query->fetchAll();

        if ($ads) {
            $count_query = $this->db->query("SELECT count(*) FROM favorite_ads WHERE user_id = {$_SESSION['user']['id']}");
            $result = $count_query->fetch();

            $count = $result ? $result['count'] : null;

            $this->response([
                'count' => (int)$count,
                'items' => $ads,
            ]);
        } else {
            $this->response([
                'count' => 0,
                'items' => [],
            ]);
        }
    }

    public function newTicket()
    {
        $ticket_query = $this->db->prepare('INSERT INTO tickets (user_id, question_title, question_message, question_type, question_deal_type) VALUES (:user_id, :question_title, :question_message, :question_type, :question_deal_type) RETURNING *');
        $ticket_query->execute([
            ':user_id'            => $_SESSION['user']['id'],
            ':question_title'     => isset($_POST['question_title']) ? $_POST['question_title'] : null,
            ':question_message'   => isset($_POST['question_message']) ? $_POST['question_message'] : null,
            ':question_type'      => isset($_POST['question_type']) ? $_POST['question_type'] : null,
            ':question_deal_type' => isset($_POST['question_deal_type']) ? $_POST['question_deal_type'] : null,
        ]);

        if ($ticket_query->errorCode() !== '00000') {
            $this->error(self::DB_INSERT_ERROR, $ticket_query->errorInfo());
        }

        $ticket = $ticket_query->fetch();

        $dialog_query = $this->db->prepare('INSERT INTO dialogs_properties (name, owners, ticket_id) VALUES (\'Техническая поддержка\', :owners, :ticket_id) RETURNING id');
        $dialog_query->execute([
            ':owners'    => $_SESSION['user']['id'] . ',0',
            ':ticket_id' => $ticket['id'],
        ]);

        if ($dialog_query->errorCode() !== '00000') {
            $this->db->query("DELETE FROM tickets WHERE id = {$ticket['id']}");
            $this->error(self::DB_INSERT_ERROR, $dialog_query->errorInfo());
        }

        $dialog_id = $dialog_query->fetch();

        $this->response([
            'dialog_id' => $dialog_id,
            'ticket'    => $ticket,
        ]);

    }
}
