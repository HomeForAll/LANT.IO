<?php
$this->title = 'Новости';
?>
<h2>Новости</h2>
<a href="/news/editor">Редактор новостей</a>

<!-- Выбор количества выводимых новостей -->
<form action="" method="post">
    <label for="number_of_news">Количество выводимых новостей:</label>
    <select name="number_of_news">
            <option  value="2">2</option>
            <option <?php
            if (!empty($_POST['number_of_news'])){
                if ($_POST['number_of_news'] == 5) {
                    echo 'selected';
                }
            }
                ?> value="5">5</option>
            <option  <?php
            if (!empty($_POST['number_of_news'])){
                if ($_POST['number_of_news'] == 10) {
                    echo 'selected';
                }
            }
                ?> value="10">10</option>
    </select>
    <br>
    <label class="news_table_category">
        <h3>Категория новостей: </h3>
        <span>
            Общие новости<input type="checkbox" name="news_table_category[1]" value="1" <?php if (!empty($this->data['news_table_category[1]'])) { echo 'checked';} ?> >
            Продажа комнат <input type="checkbox" name="news_table_category[11]" value="11" <?php if (!empty($this->data['news_table_category[11]'])) { echo 'checked';} ?> >
            Продажа квартир <input type="checkbox" name="news_table_category[12]" value="12" <?php if (!empty($this->data['news_table_category[12]'])) { echo 'checked';} ?> >
            Продажа домов <input type="checkbox" name="news_table_category[13]" value="13" <?php if (!empty($this->data['news_table_category[13]'])) { echo 'checked';} ?> >
            Продажа участков <input type="checkbox" name="news_table_category[14]" value="14" <?php if (!empty($this->data['news_table_category[14]'])) { echo 'checked';} ?> >
            Аренда комнат <input type="checkbox" name="news_table_category[21]" value="21" <?php if (!empty($this->data['news_table_category[21]'])) { echo 'checked';} ?> >
            Аренда квартир <input type="checkbox" name="news_table_category[22]" value="22" <?php if (!empty($this->data['news_table_category[22]'])) { echo 'checked';} ?> >
            Аренда домов <input type="checkbox" name="news_table_category[23]" value="23" <?php if (!empty($this->data['news_table_category[23]'])) { echo 'checked';} ?> >
            Аренда участков <input type="checkbox" name="news_table_category[24]" value="24" <?php if (!empty($this->data['news_table_category[24]'])) { echo 'checked';} ?> >
        </span>
        </label>
    <br>
     <input type="submit" name="watch_news_list" value="Смотреть">
</form>

<!-- Навигация -->
<DIV>
    <?php echo $this->data['firstnews']; ?> - <?php echo $this->data['lastnews']; ?> из: <?php echo $this->data['namber_of_all_rows']; ?>
    <?php if($this->data['firstnews'] != 1){ 
        echo '<a href="/news/page'.($this->data['page']-1).'"><<</a> '; 
    } else {
      echo '<< ';  
    }
    if($this->data['lastnews'] != $this->data['namber_of_all_rows']){ 
        echo ' <a href="/news/page'.($this->data['page']+1).'">>></a>'; 
    } else {
      echo ' >>';  
    }
?>
</DIV>


<!-- Вывод листинга новостей -->
<?php 
foreach ($this->data['news'] as $news) {
 ?>
<div class="news">
    <h3><a href="<?php echo "/news/".$news['id_news'].""; ?>"><?php echo $news['title']; ?></a></h3>
    <?php if (!empty($news['preview_img'][0])) { ?> 
    <a href="<?php echo "/news/".$news['id_news'].""; ?>"><img src="/uploads/images/s_<?php echo $news['preview_img'][0]; ?>"></a>
    <?php } ?>
    <?php echo $news['short_content'] . '<br>' . $news['content']; ?>
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
    ?>


<div class="last_viewed_news">
<?php
foreach ($this->data['last_viewed_news'] as $value) {
?> <span>
    <a href="/news/<?php if (!empty($value['id_news'])){ echo $value['id_news']; } ?>">

        <?php
//    echo"<br> title =  ".$value['title'];
//    echo"<br> id_news =  ".$value['id_news'];
//    echo"<br> preview_img =  ".$value['preview_img']."<br>";


    ?>
    
<?php if (!empty($value['preview_img'])){ ?><img src="/uploads/images/s_<?php echo $value['preview_img']; ?>">

<?php }
    if (!empty($value['title'])){ echo $value['title']; }

 ?>

    </a>
</span>

<?php
}
?>
</div>

<?php
unset($value);



