<?php
$this->title = 'Устройсва профиля';
?>

<style>
    .buttons {
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

    .dbbutton {
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

    .dbbutton:hover {
        color: grey;
        background: white;
    }

    .buttons:hover {
        color: grey;
        background: white;
    }

    .real_buttons {
        display: block;
        background: grey;
        width: auto;
        text-align: center;
        text-decoration: none;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        border: solid 1px grey;
        height: 30px;
    }

    .real_buttons:hover {
        color: grey;
        background: white;
    }

    .text {
        font-size: 16px;
        font-family: Arial;
    }
    table {
        margin: auto; /* Выравниваем таблицу по центру окна  */
    }
    td {
        text-align: center; /* Выравниваем текст по центру ячейки */
        width: 200px;
    }
</style>

<?php
$matrix = $this->data;
$i_max = $_SESSION['count_of_delete_buttons_for_gadgets'];
if ($i_max != 0) {
    ?>
    <h1>Устройства профиля</h1>
    <br>
    <table>
        <?php for ($n = 0; $n < $i_max; $n++){ ?>
            <tr>
                <td>
                    <?php print_r($matrix[$n][0]) ?>
                </td>
                <td>
                    <form action="" method="post">
                        <?php
                        $name = "delete" . $n;
                        echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=$name
                           value=\"Отключить\">";
                        ?>
                    </form>
                </td>
            </tr>
            <tr><td><br></td></tr>
        <?php } ?>
    </table>
<?php }
else {
    ?>
    <h1>Устройства профиля отсутствует</h1>
    <?php
}
?>
