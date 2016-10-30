<?php
$this->title = 'Новости';
?>
<h2>Новости</h2>
<a href="/news/editor">Редактор новостей</a>

<!-- Выбор количества выводимых новостей -->
<form action="" method="post">
    <label for="numberOfNews">Количество выводимых новостей:</label>
    <select name="numberOfNews">      
            <option  value="2">2</option>
            <option <?php
            if (!empty($_POST['numberOfNews'])){
                if ($_POST['numberOfNews'] == 5) {
                    echo 'selected';
                }
            }
                ?> value="5">5</option>
            <option  <?php
            if (!empty($_POST['numberOfNews'])){
                if ($_POST['numberOfNews'] == 10) {
                    echo 'selected';
                }
            }
                ?> value="10">10</option>
    </select>
     <input type="submit" name="submit" value="Смотреть">
</form>

<!-- Навигация -->
<DIV>
    <?php echo $this->data['firstnews']; ?> - <?php echo $this->data['lastnews']; ?> из: <?php echo $this->data['namberofallrows']; ?>
    <?php if($this->data['firstnews'] != 1){ 
        echo '<a href="/news/page'.($this->data['page']-1).'"><<</a> '; 
    } else {
      echo '<< ';  
    }
    if($this->data['lastnews'] != $this->data['namberofallrows']){ 
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

unset($value);



