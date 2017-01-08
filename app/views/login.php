<?php
if (isset($this->data)) echo $this->data;
$this->title = 'Авторизация';
?>
<style>
    table td {
        vertical-align: top;
    }

    #soc_net {
        margin: 10px 0 0 0;
        width: 300px;
    }

    #soc_net a {
        display: block;
        float: left;
        text-decoration: none;
        margin-left: 5px;
    }

    #soc_net img {
        height: 30px;
    }
</style>

<form action="" method="post" style="margin: 0 auto;">
    <table>
        <tr>
            <td>
                <label for="login">
                    E-Mail или номер телефона:
                </label>
            </td>
            <td>
                <input name="login" id="login" type="text"
                       value="<?php if (!empty($_POST['login'])) echo $_POST['login']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <label for="password">
                    Пароль:
                </label>
            </td>
            <td>
                <input name="password" id="password" type="password">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" value="Войти">
            </td>
        </tr>
    </table>
</form>

<div id="soc_net">
    <a href="login/vk"><img src="/templates/main/images/soc_net/vk_2.png" alt="VK"></a>
    <a href="login/ok"><img src="/templates/main/images/soc_net/ok.png" alt="OK"></a>
    <a href="login/mail"><img src="/templates/main/images/soc_net/mail_ru.png" alt="Mail"></a>
    <a href="login/ya"><img src="/templates/main/images/soc_net/yandex_2.png" alt="YA"></a>
    <a href="login/goo"><img src="/templates/main/images/soc_net/google.png" alt="Google"></a>
    <a href="login/fb"><img src="/templates/main/images/soc_net/facebook_2.png" alt="FaceBook"></a>
    <a href="login/steam"><img src="/templates/main/images/soc_net/steam.png" alt="Steam"></a>
    <div style="clear: both"></div>
</div>