<?php
$this->title = 'Мои диалоги';
$matrix = $this->data;
$i_max = $_SESSION['count_of_dialogs'];
$count_of_latters = 40;
if (isset($_POST['create_new_dialog'])) {
    $i_max = $_SESSION['count_of_users'];
}?>
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

    td {
        text-align: center; /* Выравниваем текст по центру ячейки */
        width: 200px;
    }
</style>
<?php
if ($i_max != 0) {
?>


<form action="" method="post">
    <table>
        <tr>
            <td>
                <input type=submit class="real_buttons" name=dialogs value="Диалоги">
            </td>
            <td>
                <input type=submit class="real_buttons" name=deleted_dialogs value="Удаленные диалоги">
            </td>
            <td>
                <?php if (!isset($_POST['create_new_dialog'])) { ?>
                    <input type=submit class="real_buttons" name=create_new_dialog value="Создать новый диалог">
                <?php } else { ?>
                    <input type=submit class="real_buttons" name=add_users value="Создать">
                <?php } ?>
            </td>
        </tr>
        <?php if(isset($_POST['create_new_dialog'])) { ?>
        <h3>Вся история сообщений сохраняется и даже после удаления лично у вас, она всё равно хранится на сайте.
            В связи с этим, всегда есть возможность вернуть удаленные диалоги.
        </h3>
        <?php }
        ?>
        <tr>
            <td><br></td>
        </tr>
        <?php for ($n = 0; $n < $i_max; $n++) { ?>
            <tr>
                <td>
                    <?php
                    $new_value = '';
                    $value = $matrix[$n][1];
                    if (isset($_POST['create_new_dialog'])) {
                        $value = $matrix[$n][1] . ' ' . $matrix[$n][2];
                        $name = "add" . $n;
                        echo '<label class="buttons" style="float: left" for="' . $name . '">' . $value . '</label>';
                        echo "<input type=checkbox id={$name} name={$name}>";
                    } else { ?>
                        <?php
                        $name = "chat" . $n;

                        if (isset($_POST['deleted_dialogs'])) {
                            $name = 'return' . $n;
                            if (isset($value[$count_of_latters])) {
                                for ($i = 0; $i <= $count_of_latters; $i++) {
                                    $new_value .= $value[$i];
                                }
                                $new_value[$i-1] = '.';
                                $new_value .= '..';
                                echo "<input class=\"real_buttons\" style=\"float: left\" type=\"submit\" name='$name'
                            value='$new_value'>";
                            }
                            else {
                                echo "<input class=\"real_buttons\" style=\"float: left\" type=\"submit\" name='$name'  
                            value='$value'>";
                            }
                        }
                        else {
                            if (isset($value[$count_of_latters])) {
                                for ($i = 0; $i <= $count_of_latters; $i++) {
                                    $new_value .= $value[$i];
                                }
                                $new_value[$i - 1] = '.';
                                $new_value .= '..';
                                echo "<input class=\"real_buttons\" style=\"float: left\" type=\"submit\" name='$name'
                            value='$new_value'>";
                            } else {
                                echo "<input class=\"real_buttons\" style=\"float: left\" type=\"submit\" name='$name'  
                            value='$value'>";
                            }
                        }
                        ?>

                    <?php } ?>
                </td>
                <?php if (!isset($_POST['create_new_dialog'])) { ?>

                    <?php
                    if (isset($_POST['deleted_dialogs'])) { ?>
                        <td>
                            <?php
                            if (isset($matrix[$n][2])) {
                                echo 'Будет удален ';
                                echo $matrix[$n][2];
                            } else {
                                echo 'Актуально';
                            }
                            ?>
                        </td>

                    <?php }
                } ?>
                <td>
                    <?php if (!isset($_POST['create_new_dialog'])) { ?>

                        <?php
                        if (!isset($_POST['deleted_dialogs'])) {
                            $name = "delete" . $n;
                            echo "<input class=\"real_buttons\" style=\"float: left; color: red\" type=submit name=$name
                           value=X>";
                        } else {
                            $name = "return" . $n;
                            echo "<input class=\"real_buttons\" style=\"float: left; color: limegreen\" type=submit name=$name
                           value=Восстановить>";
                        }
                        ?>

                    <?php } else {
                        ?>
                        <?php
                        ?>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
        <?php } ?>
        <tr>
            <td>

                <?php
                if (isset($_SESSION['last_deleted_dialog'])) {
                    $new_value = '';
                    $value = $_SESSION['last_deleted_dialog_name'];
                    $name = "last_deleted_dialog";
                    if (isset($value[$count_of_latters])) {
                        for ($i = 0; $i <= $count_of_latters; $i++) {
                            $new_value .= $value[$i];
                        }
                        $new_value[$i-1] = '.';
                        $new_value .= '..';
                        echo "<input class=\"real_buttons\" style=\"float: left; background: red\" type=\"submit\" name='$name'
                            value='$new_value'>";
                    }
                    else {
                        echo "<input class=\"real_buttons\" style=\"float: left; background: red\" type=\"submit\" name='$name'
                            value='$value'>";
                    }
                }
                ?>

            </td>
            <td>
                <?php
                if (isset($_SESSION['last_deleted_dialog'])) {
                if (!isset($_POST['create_new_dialog'])) { ?>

                <?php
                $name = "turn_back_dialog";
                echo "<input class=\"real_buttons\" style=\"float: left; color: limegreen\" type=submit name=$name
                           value=√>";
                ?>

        <tr>
            <td><br></td>
        </tr>
    <?php }
    } ?>
    </table>

    <table>
        <tr>
            <td>
                <?php
                if (!isset($_POST['create_new_dialog'])) {
                    if (!isset($_POST['delete_all_dialogs'])) {
                        if (!isset($_POST['deleted_dialogs'])) {
                            $name = "delete_all_dialogs";
                            echo "<input class=\"real_buttons\" style=\"float: left; background: red\" type=submit name=$name
                           value='Удалить все диалоги'>";
                        }
                    } else {
                        echo 'Удалить все диалоги?';
                    }
                }
                ?>
                <?php
                if (!isset($_POST['create_new_dialog'])) {
                    if (isset($_POST['delete_all_dialogs'])) {
                        $name = 'delete_all_dialogs_yes';
                        echo "<input class=\"real_buttons\" style=\"float: left; color: limegreen;\" type=submit name=$name
                           value='Угусики'>";
                        $name = 'delete_all_dialogs_no';
                        echo "<input class=\"real_buttons\" style=\"float: left; margin-left: 25px; color: red;\" type=submit name=$name
                           value='Да ну нах'>";
                    }
                }
                ?>
            </td>
        </tr>
    </table>
    <?php } else { ?>
    <form action="" method="post">
        <?php
        if (!isset($_POST['deleted_dialogs'])) {
            ?>
            <h1>Диалогов нет</h1>
            <table>
                <tr>
                    <td>
                        <input type=submit class="real_buttons" name=create_new_dialog value="Создать новый диалог">
                    </td>
                    <td>
                        <input type=submit class="real_buttons" name=deleted_dialogs value="Удаленные диалоги">
                    </td>
                </tr>
            </table>
            <?php
        } else {
            ?>
            <h1>Удаленных диалогов нет</h1>
            <input type=submit class="real_buttons" name=dialogs value="Диалоги">
            <?php
        }
        }
        ?>
    </form>
</form>
