<div class="news">
<h2><?php  if (!empty($this->data['title'])){ echo $this->data['title']; } ?></h2>
    <?php if (!empty($data['preview_img'])) { ?> 
    <img src="/uploads/images/s_<?php echo $this->data['preview_img'][0]; ?>">
    <?php } ?>
<p> <?php if (!empty($this->data['short_content'])){  echo $this->data['short_content']; } ?></p>
<p> <?php if (!empty($this->data['content'])){ echo $this->data['content']; } ?></p>
<div class="news_date"><?php if (!empty($this->data['date'])){ echo "Дата: ".$this->data['date']; } ?></div>
<div class="news_author"><?php if (!empty($this->data['author_name'])){ echo "Автор: ".$this->data['author_name']; } ?></div>
<div class="news_category"><?php if (!empty($this->data['category'])){ echo "Категория: ".$this->data['category']; } ?></div>
<div class="news_tags"><?php if (!empty($this->data['tags'])){ echo "Теги: ".$this->data['tags']; } ?></div>
<div class="news_gallery">
    <?php 
    foreach ($this->data['preview_img'] as $img){
     ?> <a href="/uploads/images/<?php echo $img;?>"><img src="/uploads/images/s_<?php echo $img;?>"></a>
        
    <?php
    }
    
    
    ?>
    
    
</div>
<a href="/news">Обратно</a>
</div>
