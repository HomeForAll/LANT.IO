<h1>Редактор новостей</h1>
<?php
// data[0] = messege(array); data[1] = news_to_edit_id; 
// data[2] = title; data[3] = short_content; data[4] = content;
// data[5...] - массив новостей [id], [date], [title], [type]

//Вывод сообщений
if (!empty($data[message])) {
foreach ($data[message] as $message) {
    echo '<span>' . $message . '</span><br>';
}
}
?>



<form action="" method="post">
    <table>
        <tr>
            <td>
                <label for="newsName">
                    Название новости:
                </label>
            </td>
            <td>
                <input name="newsTitle" id="newstitle" type="text" value="<?php if (!empty($data[title])) echo $data[title]; ?>">
            </td>
        </tr>
        <tr><td colspan="2"><p>Для отделения области предпросмотра, вставьте "---"</p></td></tr>
               <tr>
            <td>
                <label for="newsContent">
                    Содержание:
                </label>
            </td>
            <td>
                <textarea rows="20" cols="80" name="newsContent" id="newscontent" type="text">
<?php if (!empty($data[short_content])) echo $data[short_content]. "---"; if (!empty($data[content])) echo $data[content]; ?>
                </textarea>
            </td>
        </tr>
        <tr>
            <td>
                <label for="newsContent">
                    Статус новости:
                </label>
            </td>
            <td>
                <input type="radio" name="statusForUpdate" value="1" <?php if($data[status] == 1 or empty($data[id_news])) { echo "checked"; } ?> > Публикация 
                <input type="radio" name="statusForUpdate" value="0" <?php if($data[status] === 0) { echo "checked"; } ?> > Скрыть
            </td>
        </tr>
    </table>
<input type="submit" name="submit_editor" value="Записать новость"> <a href="/news/editor">Отмена</a>

<!-- Список новостей для редактирования, изменения статуса или удаления -->
<?php
if (empty($data[id_news])) {
?>
    
<table>
    
    <tr>
        <td>#</td>
        <td> Дата </td>
        <td> Заголовок <br>(нажмите для редактирования новости) </td>
        <td> Автор </td>
        <td> Статус</td>
    </tr>
   
 <?php for ($i = 0; (!empty($data[$i])); $i++) { ?>   
    <tr>
        <td><b> <?php echo $data[$i][id_news]; ?> </b></td>
        <td><i> <?php echo $data[$i][date]; ?></i> </td>
        <td><a href="/news/editor/<?php echo $data[$i][id_news]; ?>"> <?php echo $data[$i][title]; ?> </a></td>
        <td> <?php echo $data[$i][author_name]; ?> </td>
        <td>  
            <input type="radio" name="status_<?php echo $data[$i][id_news]; ?>" value="1" <?php if($data[$i][status] == 1) { echo "checked"; } ?> > Видна 
            <input type="radio" name="status_<?php echo $data[$i][id_news]; ?>" value="0" <?php if($data[$i][status] == 0) { echo "checked"; } ?> > Скрыта 
            <input type="radio" name="status_<?php echo $data[$i][id_news]; ?>" value="3"> Удаление 
        </td>

        
    </tr>
    
<?php   } ?>  
</table>
<input type="hidden" id="stat_arr" name="stat_arr" value= <?php $data[stat_arr] ?>/>
<input type="submit" name="submit_status" value="Изменить статус"> <a href="/news/editor">Отмена</a>
<?php   } ?>  
</form>
