<?php
    // Установление куки о просмотренной странице

$last_viewed_news_namber = 5; // 5 новостей
$last_viewed_news_time = 0.00694; // время хранения (дней)

$last_viewed_news_namber--;
$last_viewed_news_time = $last_viewed_news_time*60*60*24;
// массив для записи и сортировки COOKIE
$last_viewed_news_array = [];


$id_news = (int)$this->data['id_news'];

if (isset($_COOKIE['last_viewed_news'])) {
    //запись COOKIE в массив
        for ($index = $last_viewed_news_namber; $index >= 0; $index--){
        if(isset($_COOKIE['last_viewed_news'][$index])) {
        $last_viewed_news_array[$index] = (int)$_COOKIE['last_viewed_news'][$index];

        }
    }
    ksort($last_viewed_news_array);

//Проверка существует ли уже новость в массиве
$id_key = array_search($id_news, $last_viewed_news_array);
if ($id_key !== FALSE){
    // если да, то удаляем этот элемент
    array_splice($last_viewed_news_array, $id_key, 1);
}
}

// Добавляем id в начало массива
array_unshift($last_viewed_news_array, $id_news);
// Обрезаем массив
array_splice($last_viewed_news_array, ($last_viewed_news_namber+1));

// Запись COOKIE
foreach ($last_viewed_news_array as $key => $value) {
    $name = "last_viewed_news[$key]";
    setcookie($name, $value, time()+$last_viewed_news_time);

}
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
