<div class="news">   
<h2><?php  if (!empty($this->data['title'])){ echo $this->data['title']; } ?></h2>
    <?php if (!empty($data['preview_img'])) { ?> 
    <img src="/uploads/images/s_<?php echo $this->data['preview_img'][0]; ?>">
    <?php } ?>

    <?php

    //Вывод новостей с hederами см. в Моделях function prepareNewsView($news)
    foreach ($this->data as $key => $val) {
        if (substr($key,-2,2) == '_h') {
        // ключ данных
            $key_i = substr($key, 0, -2);
         echo'<div class="'.$key_i.'">';
         echo '<b>'.$this->data[$key].': </b> '.$this->data[$key_i];
         echo "</div>\r\n";
        }
    }
    ?>



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
