<!-- Этот код генерируется из администратвной части создания форм объявлений-->
<!-- Нельзя удалять эти переменные-->
<?php
$form_options = [];
$form_options['space_types'] = [1=>'Нежилая', 2=>'Жилая', ];
$form_options['operation_types'] = [1=>'Арендовать', 2=>'Купить', ];
$form_options['object_types'] = [1=>'Квартира', 2=>'Офисная площадь', 3=>'Торговая площадь', 4=>'Офисная площадь с землей', 5=>'Производственно-складские здания', 6=>'Производственно-складские помещения ', 7=>'Рынок/Ярмарка', 8=>'Комплекс ОСЗ', 9=>'ОСЗ', 10=>'Торговое здание', 11=>'Комната', 12=>'Дом', 13=>'Гараж/Машиноместо', 14=>'Земельный участок', ];
?>
<script>
var form_options_menu = {1:{1:{2:1, 3:1, 4:1, 5:1, 6:1, 7:1, 8:1, 9:1, 10:1}, 2:{2:1, 3:1, 4:1, 5:1, 6:1, 7:1, 8:1, 9:1, 10:1}}, 2:{1:{1:1, 11:1, 12:1, 13:1, 14:1}, 2:{1:1, 11:1, 12:1, 13:1, 14:1}}};
</script>
<!-- Конец генерируемого кода -->
<div class="my_news clearfix">
    <h3>Мои объявления</h3>
    <p> Вы вошли как: <?php
        if (empty($this->data['user_id'])) {
            $this->data['user_id'] = 'Aноним';
        }
        echo $this->data['user_id'];
        ?></p>

    <br>
    <form id="add_news" action="/news/editor" method="post">
        <legend>Выбор категории для создания нового объявления</legend>
        <label for="space_type">Тип площади:</label>
        <select name="space_type" id="space_type">
            <?php foreach ($form_options['space_types'] as $k => $options) { ?>
                <option value="<?php echo $k; ?>">
                    <?php echo $options; ?>
                </option>
            <?php } ?>
        </select>
        <br>
        <label for="operation_type">Операция:</label>
        <select name="operation_type" id="operation_type">
            <?php foreach ($form_options['operation_types'] as $k => $options) { ?>
                <option value="<?php echo $k; ?>">
                    <?php echo $options; ?>
                </option>
            <?php } ?>
        </select>
        <br>
        <label for="object_type">Тип объекта:</label>
        <select name="object_type" id="object_type">
            <?php foreach ($form_options['object_types'] as $k => $options) { ?>
                <option value="<?php echo $k; ?>">
                    <?php echo $options; ?>
                </option>
            <?php } ?>
        </select>

        <input type="submit" name="submit_add_news" value="Добавить новость">
    </form>

<?php

//Вывод сообщений
if (!empty($this->data['error'])) {
    foreach ($this->data['error'] as $error) {
        echo '<span style="color: red">' . $error . '</span><br>';
    }
}
if (!empty($this->data['message'])) {
    foreach ($this->data['message'] as $message) {
        echo '<span style="color: green">' . $message . '</span><br>';
    }
}
?>

<!-- Вывод листинга новостей -->
<?php
if (!empty($this->data['news'])){
foreach ($this->data['news'] as $news) {
 ?>
<div class="news">
    <a href="<?php echo "/news/".$news['id_news'].""; ?>"
       style="background-image: url(<?php if (!empty($news['preview_img'][0])) { ?>/uploads/images/s_<?php echo $news['preview_img'][0]; ?>
        <?php } ?>);">
        <span>
        <h3><?php echo $news['title']; ?></h3>
        </span>
    </a>


    <div class="news_content">
    <?php
    // Поиск конца ('_') короткого контента и обрезка
    $short_len = 60; // длина предпросмотра (short_content) в символах

    if (!empty($news['content'])) {
    if (strlen($news['content'])>$short_len) {
        if($short_content_position = strpos($news['content'], ' ', $short_len)){
        $short_content = substr($news['content'], 0, $short_content_position);
        } else{
          $short_content = $news['content'];
        }
    } else {
        $short_content = $news['content'];
    }
    echo $short_content.'...';

    } ?>
    </div>
    <div class="news_date"><?php echo " Дата :".$news['date']; ?></div>
    <?php if (!empty($news['category'])) { ?>
    <div class="news_category"><?php echo 'Категория : <a href="/news/?category='.$news['category'].'"> '.$news['category'].' </a>'; ?></div>
    <?php } ?>
    <?php if (!empty($news['tags'])) { ?>
    <div class="news_tags"><?php echo " Метки :". $news['tags']; ?></div>
    <?php } ?>
    <a href="<?php echo "../news/editor/". $news['id_news']; ?>">редактировать</a>
</div>
    <?php
}

    }
    ?>
</div>
<!-- Последние новости - конец -->


<!-- Список новостей для редактирования, изменения статуса или удаления -->
<form  id="status_frm" action="" method="post">
<?php
if (empty($this->data['news']['id_news'])) {
    ?>

        <table border="1", cellspacing="0">
            <tr>
                <td> Дата </td>
                <td> Заголовок <br>(нажмите для редактирования новости) </td>
                <?php if($this->data['user_id'] == 'admin'){ ?>
                <td> Автор </td>
                <?php } ?>
                <td> Статус</td>
            </tr>

    <?php for ($i = 0; (!empty($this->data['news'][$i])); $i++) { ?>
                <tr>

                    <td><i> <?php echo $this->data['news'][$i]['date']; ?></i> </td>
                    <td><a href="/news/editor/<?php echo $this->data['news'][$i]['id_news']; ?>"> <?php echo $this->data['news'][$i]['title']; ?> </a>
                        <p><b>Категория:</b> <?php echo $this->data['news'][$i]['space_type'].'-'
                                .$this->data['news'][$i]['operation_type'].'-'
                            .$this->data['news'][$i]['object_type']; ?> ; <b>Метки:</b>  <?php echo $this->data['news'][$i]['tags']; ?> </p>
                    </td>
                    <?php if($this->data['user_id'] == 'admin'){ ?>
                    <td> <?php echo $this->data['news'][$i]['user_id']; ?> </td>
                    <?php } ?>
                    <td>
                        <input type="radio" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>" value="1" <?php
                               if ($this->data['news'][$i]['status'] == 1) {
                                   echo "checked";
                               }
                               ?> > Видна
                        <input type="radio" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>" value="0" <?php
                               if ($this->data['news'][$i]['status'] == 0) {
                                   echo "checked";
                               }
                               ?> > Скрыта
                        <input type="radio" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>" value="3"> Удаление
                    </td>


                </tr>

               <?php } ?>
        </table>
        <input type="hidden" id="stat_arr" name="stat_arr" value= "<?php
               if (!empty($this->data['stat_arr'])) {
                   echo $this->data['stat_arr'];
               }
               ?>" />
        <input type="submit" name="submit_status" value="Изменить статус"> <a href="/news">Отмена</a>
<?php } ?>
</form>

<script>
    $(document).ready(function () {
            $('#add_news').submit(function(){
                var opt1 = $('#space_type').val();
                var opt2 = $('#operation_type').val();
                var opt3 = $('#object_type').val();
                if (typeof form_options_menu[opt1][opt2][opt3] === "undefined"){
                    alert('Данной опции не существует!');
                    return false;
                }
            });
            });
</script>


<script type="text/javascript" src="/template/js/news_javascript.js"></script>