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
        $data_24 = Registry::model('news')->getRecentNewsList(0, 24, 20, 0, 0, 0);
        //Вывод
        showNews($data_24);

        ?>

    </div>


    <!-- Вывод листинга новостей 24 часа - конец -->


    <h2>Объявления</h2>
    <!-- Выбор количества выводимых новостей -->
    <form action="" method="post">
        <label for="number_of_news">Количество выводимых объявлений:</label>
        <select name="number_of_news">
            <option value="2">2</option>
            <option <?php
            if (!empty($_POST['number_of_news'])) {
                if ($_POST['number_of_news'] == 5) {
                    echo 'selected';
                }
            }
            ?> value="5">5
            </option>
            <option <?php
            if (!empty($_POST['number_of_news'])) {
                if ($_POST['number_of_news'] == 10) {
                    echo 'selected';
                }
            }
            ?> value="10">10
            </option>
        </select>
        <br>
        <label class="news_table_category">
            <h3>Категория объявлений: </h3>
            <span>
            Общие новости<input type="checkbox" name="news_table_category[1]"
                                value="1" <?php if (!empty($this->data['news_table_category[1]'])) {
                    echo 'checked';
                } ?> >
            Продажа комнат <input type="checkbox" name="news_table_category[11]"
                                  value="11" <?php if (!empty($this->data['news_table_category[11]'])) {
                    echo 'checked';
                } ?> >
            Продажа квартир <input type="checkbox" name="news_table_category[12]"
                                   value="12" <?php if (!empty($this->data['news_table_category[12]'])) {
                    echo 'checked';
                } ?> >
            Продажа домов <input type="checkbox" name="news_table_category[13]"
                                 value="13" <?php if (!empty($this->data['news_table_category[13]'])) {
                    echo 'checked';
                } ?> >
            Продажа участков <input type="checkbox" name="news_table_category[14]"
                                    value="14" <?php if (!empty($this->data['news_table_category[14]'])) {
                    echo 'checked';
                } ?> >
            Аренда комнат <input type="checkbox" name="news_table_category[21]"
                                 value="21" <?php if (!empty($this->data['news_table_category[21]'])) {
                    echo 'checked';
                } ?> >
            Аренда квартир <input type="checkbox" name="news_table_category[22]"
                                  value="22" <?php if (!empty($this->data['news_table_category[22]'])) {
                    echo 'checked';
                } ?> >
            Аренда домов <input type="checkbox" name="news_table_category[23]"
                                value="23" <?php if (!empty($this->data['news_table_category[23]'])) {
                    echo 'checked';
                } ?> >
            Аренда участков <input type="checkbox" name="news_table_category[24]"
                                   value="24" <?php if (!empty($this->data['news_table_category[24]'])) {
                    echo 'checked';
                } ?> >
        </span>
        </label>
        <br>
        <input type="submit" name="watch_news_list" value="Смотреть">
    </form>

    <!-- Навигация -->
    <DIV>
        <?php echo $this->data['firstnews']; ?> - <?php echo $this->data['lastnews']; ?>
        из: <?php echo $this->data['namber_of_all_rows']; ?>
        <?php if ($this->data['firstnews'] != 1) {
            echo '<a href="/news/page' . ($this->data['page'] - 1) . '"><<</a> ';
        } else {
            echo '<< ';
        }
        if ($this->data['lastnews'] != $this->data['namber_of_all_rows']) {
            echo ' <a href="/news/page' . ($this->data['page'] + 1) . '">>></a>';
        } else {
            echo ' >>';
        }
        ?>
    </DIV>

    <!-- Последние новости -->
    <div class="last_news clearfix">
    <h3>Последние новости</h3>

    <!-- Вывод листинга новостей -->

        <?php
        showNews($this->data['news']);
        ?>
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
unset($value);



