<!-- Последние новости -->
<?php
if(empty($this->data['author_name'])){
    $this->data['author_name'] = 'Aноним';
}
?>

<div class="my_news clearfix">
    <h3>Мои объявления</h3>
    <p> Вы вошли как: <?php echo $this->data['author_name']; ?></p>


        <div  id="add_news_menu_button" class="clearfix icon add_news_menu_plus">Добавить новость</div>
     <div id="add_news_menu_body" class="clearfix">
        <legend>Выбор категории для создания нового объявления</legend>

            <a href="/news/editor/saleapart">Продажа Квартиры</a>
            <a href="/news/editor/salehouse">Продажа Дома</a>
            <a href="/news/editor/saleroom">Продажа Комнаты</a>
            <a href="/news/editor/saleland">Продажа Участка</a>
            <!--<a href="/news/editor/salepart">Доля</a>-->



            <a href="/news/editor/rentapart">Аренда Квартиры</a>
            <a href="/news/editor/renthouse">Аренда Дома</a>
            <a href="/news/editor/rentroom">Аренда Комнаты</a>
            <a href="/news/editor/rentland">Аренда Участка</a>

     </div>



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

<!-- Вывод листинга новостей -->
<?php
if (!empty($this->data['news'])){
foreach ($this->data['news'] as $news) {
 ?>
<div class="news">
    <a href="<?php echo "/news/".$news['id_news'].""; ?>"
       style="background-image: url(<?php if (!empty($news['preview_img'][0])) { ?>/uploads/images/s_<?php echo $news['preview_img'][0]; ?>
        <?php } ?>);">
        <span>
        <h3><?php echo $news['title']; ?></h3>
        </span>
    </a>


    <div class="news_content">
    <?php
    // Поиск конца ('_') короткого контента и обрезка
    $short_len = 60; // длина предпросмотра (short_content) в символах

    if (!empty($news['content'])) {
    if (strlen($news['content'])>$short_len) {
        if($short_content_position = strpos($news['content'], ' ', $short_len)){
        $short_content = substr($news['content'], 0, $short_content_position);
        } else{
          $short_content = $news['content'];
        }
    } else {
        $short_content = $news['content'];
    }
    echo $short_content.'...';

    } ?>
    </div>
    <div class="news_date"><?php echo " Дата :".$news['date']; ?></div>
    <?php if (!empty($news['category'])) { ?>
    <div class="news_category"><?php echo 'Категория : <a href="/news/?category='.$news['category'].'"> '.$news['category'].' </a>'; ?></div>
    <?php } ?>
    <?php if (!empty($news['tags'])) { ?>
    <div class="news_tags"><?php echo " Метки :". $news['tags']; ?></div>
    <?php } ?>
</div>
    <?php
}

    }
    ?>
</div>
<!-- Последние новости - конец -->


<!-- Список новостей для редактирования, изменения статуса или удаления -->
<form  id="status_frm" action="" method="post">
<?php
if (empty($this->data['news']['id_news'])) {
    ?>

        <table border="1", cellspacing="0">

            <tr>

                <td> Дата </td>
                <td> Заголовок <br>(нажмите для редактирования новости) </td>
                <?php if($this->data['author_name'] == 'admin'){ ?>
                <td> Автор </td>
                <?php } ?>
                <td> Статус</td>
            </tr>

    <?php for ($i = 0; (!empty($this->data['news'][$i])); $i++) { ?>
                <tr>

                    <td><i> <?php echo $this->data['news'][$i]['date']; ?></i> </td>
                    <td><a href="/news/editor/<?php echo $this->data['news'][$i]['id_news']; ?>"> <?php echo $this->data['news'][$i]['title']; ?> </a>
                        <p><b>Категория:</b> <?php echo $this->data['news'][$i]['category']; ?> ; <b>Метки:</b>  <?php echo $this->data['news'][$i]['tags']; ?> </p>
                    </td>
                    <?php if($this->data['author_name'] == 'admin'){ ?>
                    <td> <?php echo $this->data['news'][$i]['author_name']; ?> </td>
                    <?php } ?>
                    <td>
                        <input type="radio" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>" value="1" <?php
                               if ($this->data['news'][$i]['status'] == 1) {
                                   echo "checked";
                               }
                               ?> > Видна
                        <input type="radio" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>" value="0" <?php
                               if ($this->data['news'][$i]['status'] == 0) {
                                   echo "checked";
                               }
                               ?> > Скрыта
                        <input type="radio" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>" value="3"> Удаление
                    </td>


                </tr>

               <?php } ?>
        </table>
        <input type="hidden" id="stat_arr" name="stat_arr" value= "<?php
               if (!empty($this->data['stat_arr'])) {
                   echo $this->data['stat_arr'];
               }
               ?>" />
        <input type="submit" name="submit_status" value="Изменить статус"> <a href="/news">Отмена</a>
<?php } ?>
</form>


<script type="text/javascript" src="/template/js/news_javascript.js"></script>