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