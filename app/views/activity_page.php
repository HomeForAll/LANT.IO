<?php
$this->title = 'Активность профиля';
$arrays_num = 0;
if (isset($this->data[0]['active_text']) && ($this->data[0]['active_text']) != '') {
    $str = $this->data[0]['active_text'];
    $long_str = explode(";", $str);

    foreach ($long_str as $value) {
        $short_str = explode(",", $value);
        $matrix[$arrays_num][0] = $short_str[0];
        $matrix[$arrays_num][1] = $short_str[1];
        $matrix[$arrays_num][2] = $short_str[2];
        if ($short_str[3] != 'Unknown')
            $matrix[$arrays_num][3] = $short_str[3] . '<br>' . $short_str[4] . '<br>' . $short_str[5];
        else
            $matrix[$arrays_num][3] = $short_str[3];
        $arrays_num++;
    }
}
?>

<style>
    table {
        margin: auto; /* Выравниваем таблицу по центру окна  */
    }
    td {
        text-align: center; /* Выравниваем текст по центру ячейки */
        width: 200px;
    }
</style>

<?php if ($arrays_num != 0) {
    ?>
<h1>Активность профиля</h1>
<br>
    <table>
        <tr>
            <td>
                Браузер
            </td>
            <td>
                Дата
            </td>
            <td>
                IP
            </td>
            <td>
                Геопозиция
            </td>
        </tr>
        <tr><td><br></td></tr>
    <?php for ($n = 0; $n < $arrays_num; $n++){ ?>
        <tr>
            <?php for ($m = 0; $m < 4; $m++){ ?>
            <td>
                <?php print_r($matrix[$n][$m]) ?>
            </td>
            <?php } ?>
        </tr>
        <tr><td><br></td></tr>
        <?php } ?>
    </table>
<?php }
else {
    ?>
    <h1>Активность профиля отсутствует</h1>
    <?php
}
?>
