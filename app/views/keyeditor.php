<h1>
    <hr> Панель управления ключами
    <form method="post">
        <input type = submit name = showdb value="Вывести всю БД!">
        <br><br>
        Введите id ключа:
        <input name ="id_key_keyeditor" type="text">
        <input type = submit name = keyworkgo value="Перейти к работе с данным id">
        <br><br>
    </form>
    <hr>

    <?php
    if (isset($_SESSION['id_key_keyeditor'])) {
        ?>

        <hr>
        <form method="post">
            <input type=submit name=lock value="Заблокировать!">
            <input type=submit name=unlock value="Разблокировать!">
            <br><br>
            Установить новую дату окончания работы ключа на:<br>
            День - <input name="day" type="text"><br>
            Месяц - <input name="month" type="text"><br>
            Год - <input name="year" type="text"><br>
            <input type=submit name=installdate value="Установить">
            <br><br>
        </form>
        <hr>

        <?php
    }
    ?>
<?php

echo '<pre>';
print_r($this->data);
echo '</pre>';
?>