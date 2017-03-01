<?php
$this->title = 'Чат';
$matrix = $this->data;
$name_of_dialog = $_SESSION['matrix_for_dialogs'][$_SESSION['chat']];
$dialog_id = $name_of_dialog[0];
$persona_name = $_SESSION['personaName'];
$name_of_dialog = $name_of_dialog[1];
$i_max = $_SESSION['count_of_dialogs'];
if (isset($_POST['add_user']) || (isset($_POST['add_admin']))) {
    $i_max = $_SESSION['count_of_users'];
}
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
    <?php if (!isset($_POST['add_user']) && (!isset($_POST['add_admin']))) { ?>
        <input type=submit class="" name=add_user value="Добавить пользователя">
        <input type=submit class="" name=delete_dialog_instantly value="Удалить диалог досрочно">
        <input type=submit class="" style="width: 300px; background: red" name=add_admin
               value="Призвать Царя-Админа">
    <?php } else { ?>
        <input type=submit class="" name=add_user_yes value="Добавить">
        <input type=submit class="" name=add_user_no value="Отмена">
    <?php }
    if ($i_max != 0) {
    ?>
    <table>
        <?php for ($n = 0;
                   $n < $i_max;
                   $n++) { ?>
        <tr>
            <td><br></td>
        </tr>
        <tr>
            <td>
                <?php
                $new_value = '';
                $value = isset($matrix[$n][1]) ? $matrix[$n][1] : array();
                if (isset($_POST['add_user']) || (isset($_POST['add_admin']))) {
                    $value = $matrix[$n][1] . ' ' . $matrix[$n][2];
                    $name = "add_user" . $n;
                    echo '<label class="buttons" style="float: left" for="' . $name . '">' . $value . '</label>';
                    echo "<input type=checkbox id={$name} name={$name}>";
                }
                ?>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
</form>

<div id="messages">
    <?php
    foreach ($this->data as $message) {
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