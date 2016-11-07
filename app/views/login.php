<?php if (isset($this->data)) echo $this->data;
$this->title = 'Авторизация';
?>
<form action="" method="post" style="margin: 0 auto;">
    <table>
        <tr>
            <td>
                <label for="login">
                    E-Mail или номер телефона:
                </label>
            </td>
            <td>
                <input name="login" id="login" type="text" value="<?php if (!empty($_POST['login'])) echo $_POST['login']; ?>">
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

<div>
    <a href="login/vk/in">Авторизоваться через Вконтакте</a><br>
    <a href="login/ok/in">Авторизоваться через Одноклассники</a><br>
    <a href="login/mail/in">Авторизоваться через Mail.ru</a><br>
    <a href="login/ya/in">Авторизоваться через Yandex.ru</a><br>
    <a href="login/goo/in">Авторизоваться через Google</a><br>
    <a href="login/fb/in">Авторизоваться через Facebook</a><br>
    <a href="login/steam/in">Авторизоваться через Steam</a><br>
</div>