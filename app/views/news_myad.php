<div class="my_news clearfix">
    <h3>Мои объявления</h3>
    <p> Вы вошли как: <?php
        if (empty($this->data['user_id'])) {
            $this->data['user_id'] = 'Aноним';
        }
        echo $this->data['user_id'];
        ?></p>

    <br>
   <?php
   //Меню
   $this->model('NewsModel')->renderNewsEditorMenu();

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
    <div class="clearfix">
    <?php
    if (!empty($this->data['news'])) {
        foreach ($this->data['news'] as $news) {
            ?>
            <div class="news">
                <a href="<?php echo "/news/" . $news['id_news'] . ""; ?>"
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
                        if (strlen($news['content']) > $short_len) {
                            if ($short_content_position = strpos($news['content'], ' ', $short_len)) {
                                $short_content = substr($news['content'], 0, $short_content_position);
                            } else {
                                $short_content = $news['content'];
                            }
                        } else {
                            $short_content = $news['content'];
                        }
                        echo $short_content . '...';

                    } ?>
                </div>
                <div class="news_date"><?php echo " Дата :" . $news['date']; ?></div>
                <?php if (!empty($news['category'])) { ?>
                    <div class="news_category"><?php echo 'Категория : <a href="/news/?category=' . $news['category'] . '"> ' . $news['category'] . ' </a>'; ?></div>
                <?php } ?>
                <?php if (!empty($news['tags'])) { ?>
                    <div class="news_tags"><?php echo " Метки :" . $news['tags']; ?></div>
                <?php } ?>
                <a href="<?php echo "../news/editor/" . $news['id_news']; ?>">редактировать</a>
            </div>
            <?php
        }

    }
    ?>
</div>
</div>
<!-- Последние новости - конец -->


<!-- Список новостей для редактирования, изменения статуса или удаления -->
<div class="clearfix">
<?php if (!empty($this->data['news'])) { ?>
<form id="status_frm" action="" method="post">

    <table border="1" , cellspacing="0">

        <tr align="center">
            <td>id</td>
            <td>Дата</td>
            <td>Заголовок</td>
            <td>Тип площади</td>
            <td>Операция</td>
            <td>Тип объекта</td>
            <td>Видна</td>
            <td>Скрыта</td>
            <td>Удалить</td>
        </tr>

        <?php foreach ($this->data['news'] as $news) { ?>
            <tr align="center">
                <td><i> <?php echo $news['id_news']; ?></i></td>
                <td><i> <?php echo $news['date']; ?></i></td>
                <td>
                    <a href="/news/editor/<?php echo $news['id_news'];
                    ?>"><?php echo $news['title']; ?> </a>
                </td>
                <td><?php echo $news['space_type']; ?></td>
                <td><?php echo $news['operation_type']; ?></td>
                <td><?php echo $news['object_type']; ?></td>
                <td><input type="radio" class="status" name="status_<?php echo $news['id_news']; ?>"
                           value="1" <?php
                    if ($news['status'] === 1) {
                        echo "checked";
                    }
                    ?> >
                </td>
                <td><input type="radio" class="status" name="status_<?php echo $news['id_news']; ?>"
                           value="0" <?php
                    if ($news['status'] === 0) {
                        echo "checked";
                    }
                    ?> >
                </td>
                <td><input type="radio" class="status" name="status_<?php echo $news['id_news']; ?>"
                           value="3">
                </td>


            </tr>

        <?php }
        } ?>
    </table>
    <!--            <input type="hidden" id="stat_arr" name="stat_arr" value="--><?php
    //            if (!empty($this->data['stat_arr'])) {
    //                echo $this->data['stat_arr'];
    //            }
    //            ?><!--"/>-->
    <input type="submit" name="submit_status" value="Изменить статус"> <input type="reset" value="Отмена">
</form>
</div>
<!-- Список новостей для редактирования, изменения статуса или удаления Конец-->

<script type="text/javascript" src="/template/js/news_javascript.js"></script>