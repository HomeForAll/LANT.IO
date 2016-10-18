<?php

class NewsModel extends Application {

    public function __construct() {
        parent::__construct();
        $this->db = $this->getPGConnect();
    }

    public function getNewsCategories() {
        $stmt = $this->db->prepare("SELECT category FROM news_category ORDER BY category");
        $stmt->execute();
        $coll = $stmt->fetchall(PDO::FETCH_NUM);
        for ($i = 0; $coll[$i][0]; $i++) {
            $result[$i] = $coll[$i][0];
        }
        return $result;
    }

    public function getNamberOfAllRows() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM news");
        $result = $stmt->fetchColumn();
        return $result;
    }

    public function getNewsById($id) {

        $stmt = $this->db->prepare("SELECT id_news, date::date, title, short_content, content, author_name, preview_img, status, category, tags "
                . "FROM news"
                . " WHERE id_news = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Вход: страница новостей
    // Возвращает: выборку всех данных новостей в виде массива
    public function getNewsList($page) {

        $data = []; //выходные данные
        $numberOfNews = 10; // Количество выводимых новостей по умолчани
        // Определение номера страницы выводимых новостей
        if (empty($page)) {
            // по умолчанию первая страница
            $data['page'] = 1;
        } else {
            $data['page'] = (int) $page[0];
        }

        // Количество выводимых новостей
        if (!empty($_POST[numberOfNews])) {
            $numberOfNews = (int) $_POST[numberOfNews];
            $_SESSION[numberOfNews] = $numberOfNews;
        } elseif (!empty($_SESSION[numberOfNews])) {
            $numberOfNews = $_SESSION[numberOfNews];
        }

        // Общее кол-во новостей
        $data['namberofallrows'] = $this->getNamberOfAllRows();
        // Количество станиц и диапазон = $data['firstnews'],$data['lastnews'] 
        $total_pages = ceil($data['namberofallrows'] / $numberOfNews);

        if ($data['page'] > $total_pages) {
            $data['page'] = 1;
        }

        $data['firstnews'] = $data['page'] * $numberOfNews - $numberOfNews + 1;

        if ($data['page'] * $numberOfNews > $data['namberofallrows']) {
            $data['lastnews'] = $data['page'] * $numberOfNews - ($data['page'] * $numberOfNews - $data['namberofallrows']);
        } else {
            $data['lastnews'] = $data['page'] * $numberOfNews;
        }

        // Запрос БД      
        $from_page = $data['firstnews'] - 1;

        $stmt = $this->db->prepare("SELECT id_news, date::date, title, short_content, content, author_name, preview_img, status, category, tags "
                . "FROM news"
                . " ORDER BY id_news DESC"
                . " LIMIT :numberofnews"
                . " OFFSET :from_page");
        $stmt->bindParam(':numberofnews', $numberOfNews);
        $stmt->bindParam(':from_page', $from_page);
        $stmt->execute();
        $data['news'] = $stmt->fetchAll();
        return $data;
    }

    public function getNewsForEditor() {

        $stmt = $this->db->prepare("SELECT id_news, date::date, title, author_name, status, category, tags "
                . "FROM news"
                . " ORDER BY id_news DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    public function makeNewsInsert() {
        $newId = $this->db->lastInsertId('name_id_news_seq');

        $stmt = $this->db->prepare("INSERT INTO news("
                . "date, title, short_content, content, author_name, preview_img, status, category, tags)"
                . " VALUES ( "
                . "CURRENT_TIMESTAMP(2), :title, :short_content, :content, :author_name, :preview_img, :status, :category, :tags)");
        $stmt->bindParam(':title', $_POST['newsTitle'], PDO::PARAM_STR);
        $stmt->bindParam(':short_content', $_POST['newsShortContent'], PDO::PARAM_STR);
        $stmt->bindParam(':content', $_POST['newsContent'], PDO::PARAM_STR);
        $stmt->bindParam(':author_name', $_POST['authorName'], PDO::PARAM_STR);
        $stmt->bindParam(':preview_img', $_POST['previewImg'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $_POST['statusForUpdate'], PDO::PARAM_INT);
        $stmt->bindParam(':category', $_POST['newsCategory'], PDO::PARAM_STR);
        $stmt->bindParam(':tags', $_POST['newsTags'], PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function makeNewsUpdate($news_to_edit_id) {

        $stmt = $this->db->prepare("UPDATE news SET"
                . " date = CURRENT_TIMESTAMP(2),"
                . " title = :title,"
                . " short_content = :short_content,"
                . " content = :content,"
                . " author_name = :author_name,"
                . " preview_img = :preview_img,"
                . " status = :status,"
                . " category = :category,"
                . " tags = :tags"
                . " WHERE id_news = :news_to_edit_id");

        $stmt->bindParam(':news_to_edit_id', $news_to_edit_id);
        $stmt->bindParam(':title', $_POST['newsTitle'], PDO::PARAM_STR);
        $stmt->bindParam(':short_content', $_POST['newsShortContent'], PDO::PARAM_STR);
        $stmt->bindParam(':content', $_POST['newsContent'], PDO::PARAM_STR);
        $stmt->bindParam(':author_name', $_POST['authorName'], PDO::PARAM_STR);
        $stmt->bindParam(':preview_img', $_POST['previewImg'], PDO::PARAM_STR);
        $stmt->bindParam(':status', $_POST['statusForUpdate'], PDO::PARAM_INT);
        $stmt->bindParam(':category', $_POST['newsCategory'], PDO::PARAM_STR);
        $stmt->bindParam(':tags', $_POST['newsTags'], PDO::PARAM_STR);


        return $stmt->execute();
    }

    public function makeNewsDelete($id) {
        global $news_message, $news_error;
        $stmt = $this->db->prepare("DELETE FROM news"
                . " WHERE id_news = :id");
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Добавление сообщения
            array_push($news_message, 'Удалена новость c id = ' . $id);
        } else {
            array_push($news_error, 'Новость с id = ' . $id . ' не удалось удалить');
        };
        return;
    }

    public function makeNewsStatus() {
        global $news_message, $news_error;
        foreach ($_SESSION['stat_arr'] as $s_id => $s_stat) {
            $j = 'status_' . $s_id;
            if ($_POST[$j] != $s_stat) {
                //Удаление новости
                if ($_POST[$j] == 3) {
                    $this->makeNewsDelete($s_id);
                } else {

                    $stmt = $this->db->prepare("UPDATE news SET"
                            . " status = :status"
                            . " WHERE id_news = :id");
                    $stmt->bindParam(':id', $s_id);
                    $stmt->bindParam(':status', $_POST[$j], PDO::PARAM_INT);
                    if ($stmt->execute()) {
                        // Добавление сообщения
                        array_push($news_message, 'Изменён статус у новости c id = ' . $s_id);
                    } else {
                        array_push($news_error, 'Статус у новости с id = ' . $s_id . ' не удалось изменить');
                    };
                }
            }
        }

        return;
    }

    public function saveNewsPictures() {
        global $news_error, $tmpPath;
        $imgPath = 'uploads/images/'; // Путь к папке загрузки картинок
        $tmpPath = 'tmp/'; // Путь к папке временных файлов
        $typesOfFile = array('image/gif', 'image/png', 'image/jpeg'); // Допустимый формат файлов
        $blacklistOfFile = array(".php", ".phtml", ".php3", ".php4"); // Запрещенный формат файлов
        $imgMaxSize = 2050000; // Максимальный размер картинок в байтах

        if (!empty($_FILES['newsPicture'])) {
            //
            // Загрузка картинки в директоритю и получение ссылки на нее
            // Проверяем тип файла
            if (!in_array($_FILES['newsPicture']['type'], $typesOfFile)) {
                array_push($news_error, 'Можно загружать только картинки с расширением jpeg, png, gif.');
                return;
            }
            foreach ($blacklistOfFile as $item) {
                if (preg_match("/$item\$/i", $_FILES['newsPicture']['name'])) {
                    array_push($news_error, 'PHP файлы не разрешены для загрузки.');
                    return;
                }
                // Проверяем размер файла
                if ($_FILES['newsPicture']['size'] > $imgMaxSize) {
                    array_push($news_error, 'Слишком большой размер файла картинки.');
                    return;
                }
              
                //Изменение размеров                
                $name = $this->newsPicturesResize($_FILES['newsPicture'], 'small');
                
// Загрузка файла и вывод сообщения
                if (!@copy($tmpPath . $name, $imgPath . $name)) {
                    echo 'Что-то пошло не так';
                } else {
                    echo 'Загрузка удачна';
                }
                // Удаляем временный файл
                 unlink($tmpPath . $name);
            }
        }
    }

    //Изменение размеров картинки на эскиз ($type = 'small') и нормальные ($type = 'big') 
    //и сохраниение во временной папке  $tmpPath
    //Возвращает Имя файла 
    public function newsPicturesResize($file, $type = 'big') {
        global $tmpPath;
        var_dump($tmpPath);
        $h_max_big_size = 800; //Всота для большой картинки
        $h_max_small_size = 200; //Всота для эскиза
        $quality = 75; // качество изображения (по умолчанию 75%)
        
        // Создание исходного изображения на основе исходного файла
        if ($file['type'] == 'image/jpeg')
            $src = imagecreatefromjpeg($file['tmp_name']);
        elseif ($file['type'] == 'image/png')
            $src = imagecreatefrompng($file['tmp_name']);
        elseif ($file['type'] == 'image/gif')
            $src = imagecreatefromgif($file['tmp_name']);
        else
            return false;
        
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
              $ratio = $h_src/$h_max;
              $w_dest = round($w_src/$ratio);
              $h_dest = round($h_src/$ratio);
              // Создаём пустую картинку
              $dest = imagecreatetruecolor($w_dest, $h_dest);
              // Копируем старое изображение в новое с изменением параметров
              imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);
              // Вывод картинки и очистка памяти
              imagejpeg($dest, $tmpPath . $file['name'], $quality);
              imagedestroy($dest);
              imagedestroy($src);
              
              return $file['name'];
          } else {
            // Вывод картинки и очистка памяти
              imagejpeg($src, $tmpPath . $file['name'], $quality);
              imagedestroy($src);
              
              return $file['name'];  
           }
    }

}

?>