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
    <br>
    <label>
        <h3>Категория новостей: </h3>
        <span>
            Общие новости<input type="radio" name="news_table_category" value="base" <?php if ($this->data['news_table_category'] == "base") { echo 'checked';} ?> >
            <br>
            <b>Продажа:</b> квартир <input type="radio" name="news_table_category" value="saleapart" <?php if ($this->data['news_table_category'] == "saleapart") { echo 'checked';} ?> >
            домов <input type="radio" name="news_table_category" value="salehouse" <?php if ($this->data['news_table_category'] == "salehouse") { echo 'checked';} ?> >
            комнат <input type="radio" name="news_table_category" value="saleroom" <?php if ($this->data['news_table_category'] == "saleroom") { echo 'checked';} ?> >
            участков <input type="radio" name="news_table_category" value="saleland" <?php if ($this->data['news_table_category'] == "saleland") { echo 'checked';} ?> >
            <br>
            <b>Аренда:</b> квартир <input type="radio" name="news_table_category" value="rentapart" <?php if ($this->data['news_table_category'] == "rentapart") { echo 'checked';} ?> >
            домов <input type="radio" name="news_table_category" value="renthouse" <?php if ($this->data['news_table_category'] == "renthouse") { echo 'checked';} ?> >
            комнат <input type="radio" name="news_table_category" value="rentroom" <?php if ($this->data['news_table_category'] == "rentroom") { echo 'checked';} ?> >
            участков <input type="radio" name="news_table_category" value="rentland" <?php if ($this->data['news_table_category'] == "rentland") { echo 'checked';} ?> >
        </span>
        </label>
    <br>
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
