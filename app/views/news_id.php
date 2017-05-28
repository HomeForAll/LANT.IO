<?php

?>

<?php
function ecHHo($name, $data, $type = 'element'){

    if ($type == 'h1'){
        echo"<tr>\n";
        echo'<td colspan="2" bgcolor="#FBF0DB" style="padding: 5px;">'."\n";
        echo "<h3>$name</h3>\n";
        echo"</td>\n";
        echo"</tr>\n";
    } elseif($type == 'h2'){
        echo"<tr>\n";
        echo"<td colspan=\"2\" bgcolor=\"#EEEEEE\" style=\"padding: 5px;\">\n";
        echo "<b>$name</b>\n";
        echo"</td>\n";
        echo"</tr>\n";
    } elseif($type == 'h3'){
        echo"<tr>\n";
        echo"<td colspan=\"2\" style=\"padding: 5px;\">\n";
        echo "<b>$name</b>\n";
        echo"</td>\n";
        echo"</tr>\n";
    }else{
        echo"<tr>\n";
        $h = $name.'_h';
        if(!empty($data[$h])){ echo "<td style=\"padding: 5px; color: #555555;\"><b>$data[$h]</b></td>\n";}
        if(!empty($data[$name])){ echo "<td style=\"padding: 5px;\">$data[$name]</td>\n";}
        echo"</tr>\n";
    }
}
?>


<div class="news_view"> 
<h2><?php  if (!empty($this->data['title'])){ echo $this->data['title']; } ?></h2>
    <?php if (!empty($data['preview_img'])) { ?> 
    <img src="/uploads/images/s_<?php echo $this->data['preview_img'][0]; ?>">
    <?php } ?>

    <?php
    //Подгрузка файла вывода содержимого
    if(!empty($this->data['form_name'])){
        include_once 'app/views/news_views/'.$this->data['form_name'].'_v.php';
    }

    //Вывод новостей с hederами см. в Моделях function prepareNewsView($news)
//    foreach ($this->data as $key => $val) {
//        if (substr($key,-2,2) == '_h') {
//        // ключ данных
//            $key_i = substr($key, 0, -2);
//         echo'<div class="'.$key_i.'">';
//         echo '<b>'.$this->data[$key].': </b> '.$this->data[$key_i];
//         echo "</div>\r\n";
//        }
//    }
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
