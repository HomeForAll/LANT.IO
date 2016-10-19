<h1>Редактор новостей</h1>
<!--<pre><?php // print_r($data);   ?></pre>-->
<?php
//Вывод сообщений
if (!empty($data['error'])) {
    foreach ($data['error'] as $error) {
        echo '<span style="color: red">' . $error . '</span><br>';
    }
}
if (!empty($data['message'])) {
    foreach ($data['message'] as $message) {
        echo '<span style="color: green">' . $message . '</span><br>';
    }
}
?>



<form enctype="multipart/form-data" action="" method="post">
    <section>
        <label for="newsName">Название новости:</label>
        <input name="newsTitle" id="newstitle" type="text" value="<?php if (!empty($data['title'])) echo $data['title']; ?>">
    </section>
    <section>
        <label for="newsShortContent">Короткое содержание: </label>
        <textarea rows="3" cols="80" name="newsShortContent" id="newsshortcontent" type="text"><?php if (!empty($data['short_content'])) echo $data['short_content']; ?></textarea>
    </section>
    <section>
        <label for="newsContent">Основное содержание: </label>
        <textarea rows="20" cols="80" name="newsContent" id="newscontent" type="text"><?php if (!empty($data['content'])) echo $data['content']; ?></textarea>
    </section>
    <section>
        <label for="newsCategory">Категория:</label>
        <select name="newsCategory" id="newscategory">
            <?php for ($i = 0; (!empty($data['categories'][$i])); $i++) { ?>
                <option <?php
                if ($data['category'] == $data['categories'][$i]) {
                    echo 'selected';
                }
                ?> value="<?php echo $data['categories'][$i] ?>"><?php echo $data['categories'][$i] ?></option>
<?php } ?> 
        </select>
    </section>
    <section>
        <label for="newsTags">Теги (через запятую):</label>
        <input name="newsTags" id="newstags" type="text" value="<?php if (!empty($data['tags'])) echo $data['tags']; ?>">
    </section>
    <section>
        <label for="newsPicture">Картинка:</label>
        <input name="newsPicture" type="file" />  
    </section>
    <section>
        <?php if (!empty($data['preview_img'])) { ?> 
    <img src="/uploads/images/s_<?php echo $data['preview_img']; ?>">
    <?php } ?>
    </section>

    <section>
        <label for="newsContent">  Статус новости: </label>
        <input type="radio" name="statusForUpdate" value="1" <?php
        if ($data['status'] == 1 or empty($data['id_news'])) {
            echo "checked";
        }
        ?> > Публикация 
        <input type="radio" name="statusForUpdate" value="0" <?php
        if ($data['status'] === 0) {
            echo "checked";
        }
        ?> > Скрыть
    </section>

    <input type="submit" name="submit_editor" value="Записать новость"> <a href="/news/editor">Отмена</a>

    <!-- Список новостей для редактирования, изменения статуса или удаления -->
    <?php
    if (empty($data['id_news'])) {
        ?>

        <table border="1", cellspacing="0">

            <tr>
                <td>#</td>
                <td> Дата </td>
                <td> Заголовок <br>(нажмите для редактирования новости) </td>
                <td> Автор </td>
                <td> Статус</td>
            </tr>

    <?php for ($i = 0; (!empty($data[$i])); $i++) { ?>   
                <tr>
                    <td><b> <?php echo $data[$i]['id_news']; ?> </b></td>
                    <td><i> <?php echo $data[$i]['date']; ?></i> </td>
                    <td><a href="/news/editor/<?php echo $data[$i]['id_news']; ?>"> <?php echo $data[$i]['title']; ?> </a>
                        <p><b>Категория:</b> <?php echo $data[$i]['category']; ?> ; <b>Метки:</b>  <?php echo $data[$i]['tags']; ?> </p>
                    </td>
                    <td> <?php echo $data[$i]['author_name']; ?> </td>
                    <td>  
                        <input type="radio" name="status_<?php echo $data[$i]['id_news']; ?>" value="1" <?php
                        if ($data[$i]['status'] == 1) {
                            echo "checked";
                        }
                        ?> > Видна 
                        <input type="radio" name="status_<?php echo $data[$i]['id_news']; ?>" value="0" <?php
                        if ($data[$i]['status'] == 0) {
                            echo "checked";
                        }
                        ?> > Скрыта 
                        <input type="radio" name="status_<?php echo $data[$i]['id_news']; ?>" value="3"> Удаление 
                    </td>


                </tr>

    <?php } ?>  
        </table>
        <input type="hidden" id="stat_arr" name="stat_arr" value= <?php $data['stat_arr'] ?>/>
        <input type="submit" name="submit_status" value="Изменить статус"> <a href="/news/editor">Отмена</a>
<?php } ?>  
</form>