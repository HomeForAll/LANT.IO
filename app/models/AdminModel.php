<?php

class AdminModel extends Model
{
    use Cleaner;
    private $users        = [];
    private $block_result = false;
    
   /**
     * Возвращает массив первоначальных данных таблицы просмотра административной панели
     * в зависимости от POST
     *
     * @return array
     */
    public function getDataFromPost()
    {
        $data = [];
        if (!empty($_POST)) {
            if (!empty((int)$_POST['time_from'])) {
                $data['time_from'] = (int)$_POST['time_from'];
            } else {
                $data['time_from'] = 0;
            }
            if (!empty((int)$_POST['time_to'])) {
                $time_start_arr = explode('-', $_POST['time_to']);
                if (isset($time_start_arr[0])) {
                    $data['time_to'] = (int)$time_start_arr[0];
                }else {
                    $data['time_to'] = (int)$_POST['time_to'];
                }
                if (isset($time_start_arr[1])) {
                    $data['time_to'] .= '-' . (int)$time_start_arr[1];
                } else {
                    $data['time_to'] .= '-01';
                }
                if (isset($time_start_arr[2])) {
                    $data['time_to'] .= '-' . (int)$time_start_arr[2];
                } else {
                    $data['time_to'] .= '-01';
                }
                //Переводим в часы
                $data['time_to'] = (time() - strtotime($data['time_to']))/60/60;

            } else {
                $data['time_to'] = 0;
            }

            if (!empty((int)$_POST['max_number'])) {
                $data['max_number'] = (int)$_POST['max_number'];
            } else {
                $data['max_number'] = 0;
            }
            $data['space_type']     = (int)$_POST['space_type'];
            $data['operation_type'] = (int)$_POST['operation_type'];
            $data['object_type']    = (int)$_POST['object_type'];
            if (isset($_POST['status'])) {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            if (isset($_POST['sorting'])) {
                $data['sorting'] = $_POST['sorting'];
            } else {
                $data['sorting'] = '';
            }
            if (isset($_POST['title_like'])) {
                $data['title_like'] = $_POST['title_like'];
            } else {
                $data['title_like'] = '';
            }
            if (isset($_POST['offset'])) {
                $data['offset'] = (int)$_POST['offset'];
            } else {
                $data['offset'] = 0;
            }
        }
         return $data;
    }
         
    public function fetchUserByID($id)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $query->execute([':id' => $id]);
        $this->users = array_merge($this->users, $query->fetchAll());
    }
    
    public function fetchUserByEmail($email)
    {
        $query = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute([':email' => $email]);
        $this->users = array_merge($this->users, $query->fetchAll());
    }
    
    /**
     * Получает массив с пользователями и помещает его в $this->users,
     * фильтрация пользователей с помощью имени и фамилии
     *
     * @param int $limit необходимое количество
     * @param int $offset смещение на заданное количество строк таблицы
     * @param string $firstName
     * @param string $lastName
     */
    public function fetchUsers($limit = 10, $offset = 0, $firstName = null, $lastName = null)
    {
        if ($firstName && $lastName) {
            $query = $this->db->prepare('SELECT * FROM users WHERE first_name LIKE :first_name AND last_name LIKE :last_name LIMIT :limit OFFSET :offset');
            $query->execute(
                [
                    ':limit'      => $limit,
                    ':offset'     => $offset,
                    ':first_name' => $firstName,
                    ':last_name'  => $lastName,
                ]
            );
        } elseif ($firstName) {
            $query = $this->db->prepare('SELECT * FROM users WHERE first_name LIKE :first_name LIMIT :limit OFFSET :offset');
            $query->execute(
                [
                    ':limit'      => $limit,
                    ':offset'     => $offset,
                    ':first_name' => $firstName,
                ]
            );
        } elseif ($lastName) {
            $query = $this->db->prepare('SELECT * FROM users WHERE last_name LIKE :last_name LIMIT :limit OFFSET :offset');
            $query->execute(
                [
                    ':limit'     => $limit,
                    ':offset'    => $offset,
                    ':last_name' => $lastName,
                ]
            );
        } else {
            $query = $this->db->prepare('SELECT * FROM users LIMIT :limit OFFSET :offset');
            $query->execute([':limit' => $limit, ':offset' => $offset]);
        }
        
        $this->users = array_merge($this->users, $query->fetchAll());
    }
    
    /**
     * @return array Массив с пользователями
     */
    public function getUsers()
    {
        return $this->users;
    }
    
    /**
     * Банит пользователя на время или навсегда, если дата не указана
     *
     * @param $users
     * @param $date
     */
    public function banUsers($users, $date = null)
    {
        $query = null;
        
        if ($date) {
            $query = $this->db->prepare('UPDATE users SET banned = true, ban_date = :block_date WHERE id = :user_id');
            
            foreach ($users as $id) {
                $query->execute(
                    [
                        ':user_id'    => $id,
                        ':block_date' => $date,
                    ]
                );
            }
        } else {
            $query = $this->db->prepare('UPDATE users SET banned = true, ban_date = \'01.01.2199\' WHERE id = :user_id');
            
            foreach ($users as $id) {
                $query->execute([':user_id' => $id,]);
            }
        }
        
        if ($query->rowCount()) {
            $this->block_result = true;
        }
    }
    
    public function getBlockResult()
    {
        return $this->block_result;
    }
    
    public function unbanUsers($users)
    {
        $query = $this->db->prepare('UPDATE users SET banned = null, ban_date = null WHERE id = :user_id');
    
        foreach ($users as $id) {
            $query->execute([':user_id' => $id,]);
        }
        
        if ($query->rowCount()) {
            echo 'Пользователь(и) разблокирован(ы).';
        }
    }
}
