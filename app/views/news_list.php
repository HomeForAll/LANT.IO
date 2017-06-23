<?php
$this->title = 'Объявления';
function showNews($data)
{
    if (!empty($data)) {
        foreach ($data as $news) {
            ?>
            <div class="news">
                <a href="<?php echo "/news/" . $news['id_news'] . ""; ?>"
                   style="background-image: url(<?php
                   if (!empty($news['preview_img'][0])) { ?>
                           /uploads/images/s_<?php echo $news['preview_img'][0]; ?>
                   <?php } ?>);">
        <span>
        <h3><?php echo $news['title']; ?></h3>
        </span>
                </a>


                <div class="news_content">
                    <?php if (!empty($news['content'])) {
                        echo $news['content'];
                    } ?>
                </div>
                <div class="news_date"><?php echo " Дата :" . $news['date']; ?></div>
                <?php if (!empty($news['author_name'])) { ?>
                    <div class="news_author_name"><?php echo " Автор :" . $news['author_name']; ?></div>
                <?php } ?>
                <?php if (!empty($news['space_type']) && !empty($news['operation_type']) && !empty($news['object_type'])) { ?>
                    <div class="news_space_type"><?php echo $news['space_type'] . '-'
                            . $news['operation_type'] . '-' . $news['object_type']; ?></div>
                <?php } ?>

                <?php if (!empty($news['tags'])) { ?>
                    <div class="news_tags"><?php echo " Метки :" . $news['tags']; ?></div>
                <?php } ?>
            </div>
            <?php
        }
    }
}

?>

<h2>Последние объявления за 24 часа!</h2>
<div class="last_news clearfix">
    <?php
    // Получение данных
    $data_24 = $this->model('NewsModel')->getRecentNewsList(0, 24, 20, 0, 0, 0);
    //Вывод
    showNews($data_24);

    ?>

</div>


<!-- Вывод листинга новостей 24 часа - конец -->


<h2>Объявления</h2>
<!-- Меню просмотра объявлений -->
<form id="watch_news_list" action="" method="post">
    <?php
    $form_options = [];
    $form_options['space_types'] = [1 => 'Нежилая', 2 => 'Жилая',];
    $form_options['operation_types'] = [1 => 'Арендовать', 2 => 'Купить',];
    $form_options['object_types'] = [
        1 => 'Квартира',
        2 => 'Офисная площадь',
        3 => 'Торговая площадь',
        4 => 'Офисная площадь с землей',
        5 => 'Производственно-складские здания',
        6 => 'Производственно-складские помещения ',
        7 => 'Рынок/Ярмарка',
        8 => 'Комплекс ОСЗ',
        9 => 'ОСЗ',
        10 => 'Торговое здание',
        11 => 'Комната',
        12 => 'Дом',
        13 => 'Гараж/Машиноместо',
        14 => 'Земельный участок',
    ];

    ?>
    <legend>Поиск объявлений</legend>
    <label for="space_type">Тип площади:</label>
    <select name="space_type" id="space_type">
        <option value="0">---</option>
        <?php foreach ($form_options['space_types'] as $k => $options) { ?>
            <option value="<?php echo $k; ?>">
                <?php echo $options; ?>
            </option>
        <?php } ?>
    </select>
    <label for="operation_type">Операция:</label>
    <select name="operation_type" id="operation_type">
        <option value="0">---</option>
        <?php foreach ($form_options['operation_types'] as $k => $options) { ?>
            <option value="<?php echo $k; ?>">
                <?php echo $options; ?>
            </option>
        <?php } ?>
    </select>
    <label for="object_type">Тип объекта:</label>
    <select name="object_type" id="object_type">
        <option value="0">---</option>
        <?php foreach ($form_options['object_types'] as $k => $options) { ?>
            <option value="<?php echo $k; ?>">
                <?php echo $options; ?>
            </option>
        <?php } ?>
    </select>
    <br>
    <label for="max_number">Количество выводимых объявлений</label>
    <select name="max_number" id="max_number">
        <option value="9">9</option>
        <option value="18">18</option>
        <option value="27">27</option>
    </select>
    <input type="submit" name="watch_news_list" value="Смотреть">
</form>

<!-- Навигация -->
<div id="news_pages">
    Всего объявлений:<?php if (!empty($this->data['news_number'])) {
        echo  $this->data['news_number'];
    } ?>
    <?php
    for ($i = 1; $i < $this->data['news_number']; $i = $i + $this->data['max_number']) {
        $j = $i + $this->data['max_number'] - 1;
        if ($j > $this->data['news_number']) {
            $j = $this->data['news_number'];
        }
        echo "<a href='" . $i . "' class='news_page'>[" . $i . '-' . $j . "] </a>";
    }
    ?>
</div>
<!--    <DIV>-->
<!--        --><?php //echo $this->data['firstnews']; ?><!-- - --><?php //echo $this->data['lastnews']; ?>
<!--        из: --><?php //echo $this->data['namber_of_all_rows']; ?>
<!--        --><?php //if ($this->data['firstnews'] != 1) {
//            echo '<a href="/news/page' . ($this->data['page'] - 1) . '"><<</a> ';
//        } else {
//            echo '<< ';
//        }
//        if ($this->data['lastnews'] != $this->data['namber_of_all_rows']) {
//            echo ' <a href="/news/page' . ($this->data['page'] + 1) . '">>></a>';
//        } else {
//            echo ' >>';
//        }
//        ?>
<!--    </DIV>-->

<!-- Последние новости -->

<h3>Новости</h3>
<div class="last_news clearfix">
    <div id="news_list">
    <!-- Вывод листинга новостей -->
    <?php
    showNews($this->data['news']);
    ?>
    </div>
</div>

<!-- Просмотренные новости -->
<div class="last_viewed_news clearfix">

    <?php
    foreach ($this->data['last_viewed_news'] as $value) {
        ?> <span>
    <a href="/news/<?php if (!empty($value['id_news'])) {
        echo $value['id_news'];
    } ?>">

        <?php
        //    echo"<br> title =  ".$value['title'];
        //    echo"<br> id_news =  ".$value['id_news'];
        //    echo"<br> preview_img =  ".$value['preview_img']."<br>";


        ?>

        <?php if (!empty($value['preview_img'])) { ?><img src="/uploads/images/s_<?php echo $value['preview_img']; ?>">

        <?php }
        if (!empty($value['title'])) {
            echo $value['title'];
        }

        ?>

    </a>
</span>

        <?php
    }
    ?>
    </div>
<!-- Просмотренные новости - конец-->

<?php
//unset($value);
?>

<script type="text/javascript" src="/template/js/news.list.js"></script>



