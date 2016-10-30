<?php
$this->title = 'Редактор новостей';
?>
<h1>Редактор новостей</h1>
<!--<pre><?php // print_r($this->data);     ?></pre>-->
<?php
//Вывод сообщений
if (!empty($this->data['error'])) {
    foreach ($this->data['error'] as $error) {
        echo '<span style="color: red">' . $error . '</span><br>';
    }
}
if (!empty($this->data['message'])) {
    foreach ($this->data['message'] as $message) {
        echo '<span style="color: green">' . $message . '</span><br>';
    }
}
?>



<form  id="editor_form" enctype="multipart/form-data" action="" method="post">
    <section>
        <label for="newsName">Название новости:</label>
        <input name="newsTitle" id="newstitle" type="text" value="<?php if (!empty($this->data['title'])) {
    echo $this->data['title'];
} ?>">
    </section>
    <section>
        <label for="newsShortContent">Короткое содержание: </label>
        <textarea rows="3" cols="80" name="newsShortContent" id="newsshortcontent" type="text"><?php if (!empty($this->data['short_content'])) {
    echo $this->data['short_content'];
} ?></textarea>
    </section>
    <section>
        <label for="newsContent">Основное содержание: </label>
        <textarea rows="20" cols="80" name="newsContent" id="newscontent" type="text"><?php if (!empty($this->data['content'])) {
    echo $this->data['content'];
} ?></textarea>
    </section>
    <section>
        <label for="newsCategory">Категория:</label>
        <select name="newsCategory" id="newscategory">
                <?php for ($i = 0; (!empty($this->data['categories'][$i])); $i++) { ?>
                <option <?php
                if (!empty($this->data['category'])){
                if ($this->data['category'] == $this->data['categories'][$i]) {
                    echo 'selected';
                }
                }
                ?> value="<?php echo $this->data['categories'][$i] ?>"><?php echo $this->data['categories'][$i] ?></option>
<?php } ?> 
        </select>
    </section>
    <section>
        <label for="newsTags">Теги (через запятую):</label>
        <input name="newsTags" id="newstags" type="text" value="<?php if (!empty($this->data['tags'])) {
    echo $this->data['tags'];
} ?>">
    </section>

    <section>
        <label for="newsContent">  Статус новости: </label>
        <input type="radio" name="statusForUpdate" value="1" <?php
        if (!empty($this->data['status'])){
               if ($this->data['status'] == 1 or empty($this->data['id_news'])) {
                   echo "checked";
               }
        }
               ?> > Публикация 
        <input type="radio" name="statusForUpdate" value="0" <?php
        if (!empty($this->data['status'])){
               if ($this->data['status'] === 0) {
                   echo "checked";
               }
        }
               ?> > Скрыть
    </section>


<!-- Ввод картинки -->
<section>
    <div>Вы можете выбрать 5 файлов для загрузки. </div>
        <div id="inputImageContainer">
            
      <div id="addDynamicField">
        <input type="button" id="addFieldButton" value="Добавить Фотографию:">
        <div id="imageMessage"></div>
      </div>
 
</div>
</section>
    
    
    
 <input type="submit" name="submit_editor" value="Записать новость"> <a href="/news/editor">Отмена</a>
</form>  




<!-- Список новостей для редактирования, изменения статуса или удаления -->
<form  id="status_frm" action="" method="post">
<?php
if (empty($this->data['id_news'])) {
    ?>

        <table border="1", cellspacing="0">

            <tr>
                <td>#</td>
                <td> Дата </td>
                <td> Заголовок <br>(нажмите для редактирования новости) </td>
                <td> Автор </td>
                <td> Статус</td>
            </tr>

    <?php for ($i = 0; (!empty($this->data[$i])); $i++) { ?>   
                <tr>
                    <td><b> <?php echo $this->data[$i]['id_news']; ?> </b></td>
                    <td><i> <?php echo $this->data[$i]['date']; ?></i> </td>
                    <td><a href="/news/editor/<?php echo $this->data[$i]['id_news']; ?>"> <?php echo $this->data[$i]['title']; ?> </a>
                        <p><b>Категория:</b> <?php echo $this->data[$i]['category']; ?> ; <b>Метки:</b>  <?php echo $this->data[$i]['tags']; ?> </p>
                    </td>
                    <td> <?php echo $this->data[$i]['author_name']; ?> </td>
                    <td>  
                        <input type="radio" name="status_<?php echo $this->data[$i]['id_news']; ?>" value="1" <?php
                               if ($this->data[$i]['status'] == 1) {
                                   echo "checked";
                               }
                               ?> > Видна 
                        <input type="radio" name="status_<?php echo $this->data[$i]['id_news']; ?>" value="0" <?php
                               if ($this->data[$i]['status'] == 0) {
                                   echo "checked";
                               }
                               ?> > Скрыта 
                        <input type="radio" name="status_<?php echo $this->data[$i]['id_news']; ?>" value="3"> Удаление 
                    </td>


                </tr>

    <?php } ?>  
        </table>
        <input type="hidden" id="stat_arr" name="stat_arr" value= "<?php 
        if (!empty($this->data['stat_arr'])){ 
            echo $this->data['stat_arr'];
        } ?>" />
        <input type="submit" name="submit_status" value="Изменить статус"> <a href="/news/editor">Отмена</a>
<?php } ?>  
</form>

<script type="text/javascript" src="/templates/main/js/news_javascript.js"></script> 



