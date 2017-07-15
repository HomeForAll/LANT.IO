<?php
$this->title = 'Мои диалоги';
$cabinetModel = $this->model('CabinetModel');
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
        width: 100%;
    }

    td {
        text-align: center; /* Выравниваем текст по центру ячейки */
        width: 200px;
    }
</style>

<form action="" method="post">
    <?php if ($this->data['code'] == 'getDialogs')
    { ?>
    <table>
        <tr>
            <td>
                <input type="submit" class="real_buttons" name="dialogs" value="Диалоги">
            </td>
            <td>
                <input type="submit" class="real_buttons" name="create_new_dialog" value="Создать новый диалог">
            </td>
<!--            <td>-->
<!--                <input type="submit" class="real_buttons" name="deleted_dialogs" value="Удаленные диалоги" disabled>-->
<!--            </td>-->
        </tr>
    </table>
        <?php foreach ($this->data['idsDialog'] as $item => $key)
    {
        $id = 'chat' . $key;
        $delete_id = 'delete_' . $key;
        $name = $this->data['namesDialog'][$item]; ?>
        <table>
            <tr>
                <td>
                    <a class="button" href="/cabinet/chat<?php echo $key; ?>"><?php echo $name; ?></a>
                </td>
                <td>
                    <a style="background: red" class="button" href="/cabinet/deleteDialog<?php echo $key; ?>">X</a>
                </td>
            </tr>
        </table>
    <?php } ?>
        <table>
            <tr>
                <td>
                    <input type="submit" class="real_buttons" style="background: red" name="delete_all_dialogs" value="Удалить все диалоги">
                </td>
            </tr>
        </table>
    <?php } ?>
    <?php if ($this->data['code'] == 'dialogs_not_exist')
    { ?>
        <table>
            <tr>
                <td>
                    <input type="submit" class="real_buttons" name="dialogs" value="Диалоги">
                </td>
                <td>
                    <input type="submit" class="real_buttons" name="create_new_dialog" value="Создать новый диалог">
                </td>
                <td>
                    <input type="submit" class="real_buttons" name="deleted_dialogs" value="Удаленные диалоги">
                </td>
            </tr>
        </table>
        <h4>Диалоги отсутствуют</h4>
    <?php } ?>
    <?php if ($this->data['code'] == 'users_for_dialogs')
{ ?>
    <table>
        <tr>
            <td>
                <input type="submit" class="real_buttons" name="dialogs" value="Диалоги">
            </td>
            <td>
                <input type="submit" class="real_buttons" name="create_new_dialog" value="Создать новый диалог">
            </td>
            <td>
                <input type="submit" class="real_buttons" name="deleted_dialogs" value="Удаленные диалоги">
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td>
                Название сделки
            </td>
            <td>
                <input name="chat_name" type="text" placeholder="Название сделки">
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td>
                Пользователи
            </td>
            <td>
                <input name="search_user_for_dialog" type="text" placeholder="Поиск...">
            </td>
        </tr>
    </table>
    <?php
    foreach ($this->data['idsUsersForDialog'] as $item => $key)
    {
        $id = 'addUser_' . $key;
        $value = $this->data['namesUsersForDialog'][$item]?>
    <table>
        <tr>
            <td>
                <?php echo '<label for="' . $id . '">' . $value . '</label>'; ?>
            </td>
            <td>
                <?php echo "<input type=checkbox id='$id' name='$id'>"; ?>
            </td>
        </tr>
    </table>
    <?php } ?>
    <input type="submit" name="add_users" value="Создать">
<?php } ?>
</form>
