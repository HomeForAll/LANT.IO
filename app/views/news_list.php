
<h2>Последние новости</h2>

<?php 


foreach ($data as $news) {
 ?>
<div class="news">
    <h3><?php echo "$news[title]"; ?></h3>
    <?php echo $news[short_content] . '<br>' . $news[content]; ?>
    <div class="news_date"><?php echo " Дата : $news[date]"; ?></div>
</div>  
    <?php
 
    }

unset($value);



