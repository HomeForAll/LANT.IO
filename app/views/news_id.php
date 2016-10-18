<div class="news">
<h2><?php echo "$data[title]"; ?></h2>
<p> <?php echo $data[short_content]; ?></p>
<p> <?php echo $data[content]; ?></p>
<div class="news_date"><?php echo "Дата: $data[date]"; ?></div>
<div class="news_author"><?php echo "Автор: $data[author_name]"; ?></div>
<div class="news_category"><?php echo "Категория: $data[category]"; ?></div>
<div class="news_tags"><?php echo "Теги: $data[tags]"; ?></div>
<a href="/news">Обратно</a>
</div>
