<?php
$this->title = 'Административная панель';

$form_options = [];
$form_options['space_types'] = [1 => 'Нежилая', 2 => 'Жилая',];
$form_options['operation_types'] = [1 => 'Арендовать', 2 => 'Купить',];
$form_options['object_types'] = [1 => 'Квартира', 2 => 'Офисная площадь', 3 => 'Торговая площадь', 4 => 'Офисная площадь с землей', 5 => 'Производственно-складские здания', 6 => 'Производственно-складские помещения ', 7 => 'Рынок/Ярмарка', 8 => 'Комплекс ОСЗ', 9 => 'ОСЗ', 10 => 'Торговое здание', 11 => 'Комната', 12 => 'Дом', 13 => 'Гараж/Машиноместо', 14 => 'Земельный участок',];
?>
<script>
    var form_options_menu = {
        1: {
            1: {2: 1, 3: 1, 4: 1, 5: 1, 6: 1, 7: 1, 8: 1, 9: 1, 10: 1},
            2: {2: 1, 3: 1, 4: 1, 5: 1, 6: 1, 7: 1, 8: 1, 9: 1, 10: 1}
        }, 2: {1: {1: 1, 11: 1, 12: 1, 13: 1, 14: 1}, 2: {1: 1, 11: 1, 12: 1, 13: 1, 14: 1}}
    };
</script>

<div class="my_news clearfix">
    <h3>Администрирование объявлений</h3>
    <p> Вы вошли как: <?php
        if (empty($this->data['user_id'])) {
            $this->data['user_id'] = 'Aноним';
        }
        echo $this->data['user_id'];
        ?></p>

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

    <form id="test" action="" method="post">
        <input type="submit" name="test2" value="Получить сообщения с канала RabbitMQ newNews">
    </form>
    <?php
    if(!empty($this->data['rabbitmq_message_newnews'])){
        foreach($this->data['rabbitmq_message_newnews'] as $k => $v){
         echo "<br><b>$k</b> : $v <br><hr>";
        }
    }
    ?>

    <br>
    <form id="show_news" action="" method="post">
        <legend>Поиск объявлений</legend>
        <label for="space_type">Тип площади:</label>
        <select name="space_type" id="space_type">
            <option value="0">---</option>
            <?php foreach ($form_options['space_types'] as $k => $options) { ?>
                <option value="<?php echo $k; ?>"
                    <?php if(isset($this->data['space_type'])){if($this->data['space_type']==
                    $k){ echo 'selected';}} ?>>
                    <?php echo $options; ?>
                </option>
            <?php } ?>
        </select>
        <label for="operation_type">Операция:</label>
        <select name="operation_type" id="operation_type">
            <option value="0">---</option>
            <?php foreach ($form_options['operation_types'] as $k => $options) { ?>
                <option value="<?php echo $k; ?>"
                    <?php if(isset($this->data['operation_type'])){if($this->data['operation_type']==
                    $k){ echo 'selected';}} ?>>
                    <?php echo $options; ?>
                </option>
            <?php } ?>
        </select>
        <label for="object_type">Тип объекта:</label>
        <select name="object_type" id="object_type">
            <option value="0">---</option>
            <?php foreach ($form_options['object_types'] as $k => $options) { ?>
                <option value="<?php echo $k; ?>"
                    <?php if(isset($this->data['object_type'])){if($this->data['object_type']==
                        $k){ echo 'selected';}} ?>>
                    <?php echo $options; ?>
                </option>
            <?php } ?>
        </select>

        <br>
        <label for="max_number">Количество выводимых новостей</label>
        <select name="max_number" id="max_number">
            <option value="5"
                <?php if(isset($this->data['max_number'])){if($this->data['max_number']==
                    5){ echo 'selected';}} ?>>5</option>
            <option value="10"
                <?php if(isset($this->data['max_number'])){if($this->data['max_number']==
                    10){ echo 'selected';}} ?>>10</option>
            <option value="20"
                <?php if(isset($this->data['max_number'])){if($this->data['max_number']==
                    20){ echo 'selected';}} ?>>20</option>
        </select>
        <br>
        <label for="time_start">Дата окончания поиска (по умолчанию настоящее время):</label>
        <input type="text" id="time_start" name="time_start" placeholder="2017-05-31">
        <br>
        <label for="time">За период</label>
        <select name="time" id="time">
            <option value="24"
                <?php if(isset($this->data['time'])){if($this->data['time']==
                    24){ echo 'selected';}} ?>>24 часа</option>
            <option value="168"
                <?php if(isset($this->data['time'])){if($this->data['time']==
                    168){ echo 'selected';}} ?>>1 неделя</option>
            <option value="672"
                <?php if(isset($this->data['time'])){if($this->data['time']==
                    672){ echo 'selected';}} ?>>1 месяц</option>
            <option value="8064"
                <?php if(isset($this->data['time'])){if($this->data['time']==
                    8064){ echo 'selected';}} ?>>1 год</option>
        </select>
        <br>
        <label for="best">Только лучшие</label>
        <input type="checkbox" name="best" value="true" <?php if(isset($this->data['best'])){if($this->data['best']==
            TRUE){ echo 'checked';}} ?>>
        <label for="best">Только активные</label>
        <input type="checkbox" name="status" value="true" <?php if(isset($this->data['status'])){if($this->data['status']==
            TRUE){ echo 'checked';}} ?>>

        <input type="submit" name="submit_show_news" value="Показать объявления">
    </form>

    <a class="button" href="admin/newsformgenerator">News Form Generator</a>

     <!-- Список новостей для редактирования, изменения статуса или удаления -->
    <form id="status_frm" action="" method="post">

            <table border="1" , cellspacing="0">

                <tr align="center">
                    <td>id</td>
                    <td>Дата</td>
                    <td>Заголовок</td>
                    <td>Автор</td>
                    <td>Тип площади</td>
                    <td>Операция</td>
                    <td>Тип объекта</td>
                    <td>Видна</td>
                    <td>Скрыта</td>
                    <td>Лучшая</td>
                    <td>Удалить</td>
                </tr>

                <?php for ($i = 0; (!empty($this->data['news'][$i])); $i++) { ?>
                    <tr align="center">
                        <td><i> <?php echo $this->data['news'][$i]['id_news']; ?></i></td>
                        <td><i> <?php echo $this->data['news'][$i]['date']; ?></i></td>
                        <td>
                            <a href="/news/editor/<?php echo $this->data['news'][$i]['id_news'];
                            ?>"><?php echo $this->data['news'][$i]['title']; ?> </a>
                        </td>
                        <td> <?php echo $this->data['news'][$i]['user_id']; ?> </td>
                        <td><?php echo $this->data['news'][$i]['space_type']; ?></td>
                        <td><?php echo $this->data['news'][$i]['operation_type']; ?></td>
                        <td><?php echo $this->data['news'][$i]['object_type']; ?></td>
                       <td><input type="radio" class="status" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>"
                                   value="1" <?php
                            if ($this->data['news'][$i]['status'] === 1) {
                                echo "checked";
                            }
                            ?> >
                       </td>
                        <td><input type="radio" class="status" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>"
                                   value="0" <?php
                            if ($this->data['news'][$i]['status'] === 0) {
                                echo "checked";
                            }
                            ?> >
                        </td>
                        <td><input type="checkbox" class="category" name="category_<?php echo $this->data['news'][$i]['id_news']; ?>"
                                   value="1" <?php
                            if ($this->data['news'][$i]['category'] === 1) {
                                echo "checked";
                            }
                            ?> >
                        </td>
                        <td><input type="radio" class="status" name="status_<?php echo $this->data['news'][$i]['id_news']; ?>"
                                   value="3">
                        </td>


                    </tr>

                <?php } ?>
            </table>
<!--            <input type="hidden" id="stat_arr" name="stat_arr" value="--><?php
//            if (!empty($this->data['stat_arr'])) {
//                echo $this->data['stat_arr'];
//            }
//            ?><!--"/>-->
            <input type="submit" name="submit_status" value="Изменить статус"> <input type="reset" value="Отмена">
    </form>

    <!-- Список новостей для редактирования, изменения статуса или удаления Конец-->


    <script>
        $(document).ready(function () {
            $('#show_news').submit(function () {
                var opt1 = $('#space_type').val();
                var opt2 = $('#operation_type').val();
                var opt3 = $('#object_type').val();
                if (typeof form_options_menu[opt1][opt2][opt3] === "undefined") {
                    alert('Данной опции не существует!');
                    return false;
                }
            });
            // Добавление поля hidden при изменении status
            $("#status_frm .status").change(function () {
                var hidName = ($(this).attr('name'));
                hidName = hidName.substr(7);
               $(this).after('<input type="hidden" name="change_status_'+ hidName +'" value="'+ hidName +'">');
            });
            // Добавление поля hidden при изменении category
            $("#status_frm .category").change(function () {
                var hidName = ($(this).attr('name'));
                hidName = hidName.substr(9);
                $(this).after('<input type="hidden" name="change_category_'+ hidName +'" value="'+ hidName +'">');
            });
        });

    </script>