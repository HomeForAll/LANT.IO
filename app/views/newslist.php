
<h2>Последние новости</h2>

<?php 


foreach ($data as $news) {
 ?>
<div class="news">
    <h3><?php echo "$news[name]"; ?></h3>
    <?php echo $news[message]; ?>
    <div class="news_date"><?php echo " Дата : $news[date]"; ?></div>
</div>  
    <?php
 
    }

unset($value);

?>

