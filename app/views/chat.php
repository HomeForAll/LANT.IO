<?php
$this->title = 'Чат';
$dialog_id = $this->data['idChat'];
$name_of_dialog = $this->data['nameChat'];
$persona_name = $_SESSION['firstName'] . ' ' . $_SESSION['lastName'];
$cabinetModel = $this->model('CabinetModel');

?>
<script>
    var dialog = <?php echo $dialog_id; ?>,
        name = '<?php echo $persona_name; ?>';


    $(document).ready(function () {
        var message = $('#message'),
            messages = document.getElementById('messages');

        messages.scrollTop = 9999999;

        message.parent().on('submit', function (event) {
            event.preventDefault();
            if (message.val() != '') {
                socket.emit('message', {
                    "dialog": dialog,
                    "name": name,
                    "message": message.val()
                });

                var messageDiv = document.createElement('div'),
                    b = document.createElement('b'),
                    user = document.createTextNode(name),
                    msg = document.createTextNode(message.val()),
                    content = document.createElement('p');

                messageDiv.setAttribute('class', 'message');
                content.setAttribute('style', 'margin-top: 10px;');

                b.appendChild(user);
                content.appendChild(msg);
                messageDiv.appendChild(b);
                messageDiv.appendChild(content);
                messages.appendChild(messageDiv);

                messages.scrollTop = 999999;

                message.val('');
            }
        });
    });

    socket.on('message', function (data) {
        var messages = document.getElementById('messages');

        if (+data.dialog == +dialog) {
            var messageDiv = document.createElement('div'),
                b = document.createElement('b'),
                user = document.createTextNode(data.name),
                msg = document.createTextNode(data.message),
                content = document.createElement('p');

            messageDiv.setAttribute('class', 'message');
            content.setAttribute('style', 'margin-top: 10px;');

            b.appendChild(user);
            content.appendChild(msg);
            messageDiv.appendChild(b);
            messageDiv.appendChild(content);
            messages.appendChild(messageDiv);

            messages.scrollTop = 999999;
        }
    });
</script>
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

    input[type=text] {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        width: 100%;
        box-sizing: border-box;
        padding: 10px 15px 10px 15px;
        margin: 15px 0 0 0;
        border: solid 1px gray;
        border-radius: 3px;
    }

    #messages {
        box-sizing: border-box;
        padding: 15px;
        width: 100%;
        height: 500px;
        background: #C3CBD1;
        overflow-y: scroll;
    }

    .message {
        box-sizing: border-box;
        padding: 10px;
        margin-bottom: 15px;
        width: 100%;
        background: #FFFFFF;
    }
</style>

<h4><?php print_r($name_of_dialog) ?></h4>
<form action="" method="post">
    <input type=submit class="" name=add_user value="Добавить пользователя">
    <input type=submit class="" name=delete_dialog_instantly value="Удалить диалог досрочно">
    <input type=submit class="" name=add_admin value="Добавить администратора">

    <?php if (isset($_POST['add_admin'])) { ?>
        <input type=submit class="" name=add_user_yes value="Добавить">
        <input type=submit class="" name=add_user_no value="Отмена">
        <?php if ($this->data['code'] == 'idsAdminsForDialog') { ?>
            <table>
                <tr>
                    <td>
                        Админы
                    </td>
                    <td>
                        <input name="search_admin_for_dialog" type="text" placeholder="Поиск...">
                    </td>
                </tr>
            </table>
            <?php
            foreach ($this->data['idsAdminsForDialog'] as $item => $key) {
                $id = 'addUser_' . $key;
                $value = $this->data['namesAdminsForDialog'][$item] ?>
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
            <?php }
        }
    }
    ?>
</form>

<div id="messages">
    <?php
    foreach ($cabinetModel->getChatMessages($this->data['idChat']) as $message) {
        $message = json_decode($message);
        ?>
        <div class="message">
            <span><b><?php echo $message->name; ?></b></span>
            <p style="margin-top: 10px;">
                <?php echo $message->message; ?>
            </p>
        </div>
        <?php
//        print_r($message->name);
//        print_r('<br>');
//        print_r($message->message);
//        print_r('<br>');
    }
    ?>

    <!--    <div class="message">-->
    <!--        <span><b>Имя отправителя:</b> Dmitry</span>-->
    <!--        <p style="margin-top: 10px;">-->
    <!--            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet laboriosam neque numquam perspiciatis-->
    <!--            voluptatum! Dicta excepturi nobis possimus quia repudiandae!-->
    <!--        </p>-->
    <!--    </div>-->
</div>
<form action="">
    <input id="message" type="text" placeholder="Сообщение ...">
</form>