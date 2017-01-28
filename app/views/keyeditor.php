<h1>Панель управления ключами</h1>
<br>
<style>
    .buttons
    {
        float: left;
        margin: 0;
        padding: 0;
        display: block;
        background: grey;
        width: 140px;
        text-align: center;
        line-height: 29px;
        text-decoration: none;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        border: solid 1px grey;
    }
    .dbbutton
    {
        float: left;
        margin-left: 15px;
        padding: 0;
        display: block;
        background: grey;
        width: 140px;
        text-align: center;
        text-decoration: none;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        border: solid 1px grey;
    }
    .dbbutton:hover
    {
    color: grey;
    background: white;
}
    .buttons:hover
    {
    color: grey;
    background: white;
}
    .real_buttons
    {
        display: block;
        background: grey;
        width: auto;
        text-align: center;
        text-decoration: none;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        border: solid 1px grey;
    }
    .real_buttons:hover
    {
        color: grey;
        background: white;
    }
    .text
    {
        font-size: 16px;
        font-family: Arial;
    }
</style>

    <form method="post">
        <a class="buttons" href="/cabinet/generator">Генератор ключей</a>
        <input class="dbbutton" type = submit name = showdb value="Вывести всю БД!">
        <br><br>
        <br>

        <span style="float: left" class="text">Введите ID ключа:</span>
        <input name ="id_key_keyeditor" type="text">
        <input style="float: right" name ="key_key_keyeditor" type="text">
        <span style="float: right" class="text">Введите ИМЯ ключа:</span>
        <br><br>
        <input class="real_buttons" style="float: left" type = submit name = idworkgo value="Перейти к работе с данным ID">
        <input class="real_buttons" style="float: right" type = submit name = keyworkgo value="Перейти к работе с данным KEY">
        <br><br><br><br>
    </form>


    <?php

    if (isset($_SESSION['sessioncheck']) && !empty($_SESSION['sessioncheck'])) {
        ?>

        <hr>
        <form method="post">
            <h2>
            <?php
            if (isset($_SESSION['notice_id']))
                echo "Вы работаете с ключом, который имеет ID = " . $_SESSION['notice_id'];
            ?>
                </h2>
            <span class="text">
                <br>
                <input class="real_buttons" style="float: left" type=submit name=lock value="Заблокировать!">
            <input class="real_buttons" style="margin-left: 15px; float: left" type=submit name=unlock value="Разблокировать!">
                <input class="real_buttons" style="float: left; margin-left: 15px" type=submit name=updateinfo value=Обновить>

                <br><br><br>
            Установить новую дату окончания работы ключа на:<br><br>
                <?php
                $str  = $_SESSION['inactive_day'];
                $pieces = explode("-", $str);
                $day = $pieces[2];
                $month_num = $pieces[1] - 1;
                $year = $pieces[0];
                $month = array(
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь"
                );

                // Число
                echo "<select name='sel_date' id='sel_date'>";
                echo "<option value='" . $day . "'>$day</option>";

                $i = 1;
                while ($i < $day) {
                    echo "<option value='" . $i . "'>$i</option>";
                    $i++;
                }
                $i = $day + 1;
                while ($i <= 31) {
                    echo "<option value='" . $i . "'>$i</option>";
                    $i++;
                }
                echo "</select>";

                // Месяц
                echo "<select name='sel_month' id='sel_month'>";
                echo "<option value='" . $month[$month_num] . "'>$month[$month_num]</option>";

                foreach ($month as $key=>$m) {
                    if ($key == $month_num)
                        continue;
                    echo "<option value='" . $m . "'>$m</option>";
                }
                echo "</select>";

                // Год
                echo "<select name='sel_year' id='sel_year'>";
                echo "<option value='" . $year . "'>$year</option>";
                $j = date('Y');
                $date_year = date('Y');
                $date_year += 10;
                while ($j < $year) {
                    echo "<option value='" . $j . "'>$j</option>";
                    $j++;
                }
                $j = $year + 1;
                while ($j <= $date_year) {
                    echo "<option value='" . $j . "'>$j</option>";
                    $j++;
                }
                echo "</select>";
                ?>

            <input class="real_buttons" style="float: right" type=submit name=installdate value="Установить">
            <br>
            <br>Установить новую почту на:<br><br>
            Email - <input name="new_email" type="text"><br>
            <input class="real_buttons" style="float: right" type=submit name=installemail value="Установить">
            <br><br>
                </span>
        </form>
        <hr>

        <?php
    }


echo '<pre>';
print_r($this->data);
echo '</pre>';
?>

    <form method="post">
        <?php
        for ($i = 1; $i <= $_SESSION['numberofpages']; $i++) {
            $name = "page" . $i;
            echo "<input type = submit name = $name value= $i>";
        }
        ?>
    </form>
