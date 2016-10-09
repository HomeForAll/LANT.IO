<?php

class NewsModel extends Application {
    public function __construct() {
        parent::__construct();
        $this->db = $this->getPGConnect();
    }
    
    
    public function getNewsById($id) {
            
        $stmt = $this->db->prepare("SELECT id_news, date, title, short_content, content, author_name, preview_img, status "
                . "FROM news"
                . " WHERE id_news = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // Вход: Количество новостей
    // Возвращает: выборку всех данных новостей в виде массива
    public function getNewsList($numberOfNews) {

        $stmt = $this->db->prepare("SELECT id_news, date, title, short_content, content, author_name, preview_img, status "
                . "FROM news"
                . " ORDER BY id_news DESC"
                . " LIMIT :numberofnews");
        $stmt->bindParam(':numberofnews', $numberOfNews);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
   
    }

    
    public function getNewsForEditor() {

        $stmt = $this->db->prepare("SELECT id_news, date, title, author_name, status "
                . "FROM news"
                . " ORDER BY id_news DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
    
    public function getContentFromPOST($content_name){
        $cont = explode('---', $_POST[newsContent]);
        if (!empty($cont[1])) {
           if ($content_name == 'short_content') $result = $cont[0];
           if ($content_name == 'content') $result = $cont[1];
        } else {
            if ($content_name == 'short_content') $result = '';
            if ($content_name == 'content') $result = $cont[0];
        } 
        return $result;
    }
    
    public function makeNewsInsert() {
        $content = $this->getContentFromPOST('content');
        $short_content = $this->getContentFromPOST('short_content');
        $newId = $this->db->lastInsertId('name_id_news_seq');
                
        $stmt = $this->db->prepare("INSERT INTO news(" 
            . "date, title, short_content, content, author_name, preview_img, status)"
            . " VALUES ("
            . ":date, :title, :short_content, :content, :author_name, :preview_img, :status)");
    $stmt->bindParam(':date', date("Y-d-m"));
    $stmt->bindParam(':title', $_POST[newsTitle], PDO::PARAM_STR);
    $stmt->bindParam(':short_content', $short_content, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':author_name', $_POST[authorName], PDO::PARAM_STR);
    $stmt->bindParam(':preview_img', $_POST[previewImg], PDO::PARAM_STR);
    $stmt->bindParam(':status', $_POST[statusForUpdate], PDO::PARAM_INT);
    return $stmt->execute();
    }
    
    
    public function makeNewsUpdate($news_to_edit_id) {
        $content = $this->getContentFromPOST('content');
        $short_content = $this->getContentFromPOST('short_content');
        
 
        $stmt = $this->db->prepare("UPDATE news SET" 
            . " date = :date,"
            . " title = :title,"
            . " short_content = :short_content,"
            . " content = :content,"
            . " author_name = :author_name,"
            . " preview_img = :preview_img,"
            . " status = :status"
            . " WHERE id_news = :news_to_edit_id");
    $stmt->bindParam(':news_to_edit_id', $news_to_edit_id, PDO::PARAM_INT);
    $stmt->bindParam(':date', date("Y-d-m"));
    $stmt->bindParam(':title', $_POST[newsTitle], PDO::PARAM_STR);
    $stmt->bindParam(':short_content', $short_content, PDO::PARAM_STR);
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':author_name', $_POST[authorName], PDO::PARAM_STR);
    $stmt->bindParam(':preview_img', $_POST[previewImg], PDO::PARAM_STR);
    $stmt->bindParam(':status', $_POST[statusForUpdate], PDO::PARAM_INT);
    return $stmt->execute();
    }
    
    public function makeNewsDelete($id, $message) {
    $stmt = $this->db->prepare("DELETE FROM news" 
            . " WHERE id_news = :id");
    $stmt->bindParam(':id', $id);
        
    if ($stmt->execute()){
                    // Добавление сообщения
                    array_push($message[message], 'Удалена новость c id = ' . $id );
                } else {
                    array_push($message[message], 'Новость с id = ' . $id . ' не удалось удалить');
                };
                return $message;
    }
    
    public function makeNewsStatus($message) {
                   
        foreach ($_SESSION['stat_arr'] as $s_id => $s_stat){
        $j='status_'.$s_id;
            if ($_POST[$j] != $s_stat){
                     //Удаление новости
            if ($_POST[$j] == 3) {
            $message = $this->makeNewsDelete($s_id, $message);
            } else { 
                
                $stmt = $this->db->prepare("UPDATE news SET" 
            . " status = :status"
            . " WHERE id_news = :id");
    $stmt->bindParam(':id', $s_id);
    $stmt->bindParam(':status', $_POST[$j], PDO::PARAM_INT);
        if ($stmt->execute()){
                    // Добавление сообщения
                    array_push($message[message], 'Изменён статус у новости c id = ' . $s_id );
                } else {
                    array_push($message[message], 'Статус у новости с id = ' . $s_id . ' не удалось изменить');
                };   
                
            }  
            }
            
            }
 
        return $message;
    }

}

?>