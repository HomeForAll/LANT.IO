<form action="" method="post">
    <table>
        <tr>
            <td>
                <label for="email">
                    E-Mail:
                </label>
            </td>
            <td>
                <input name="email" id="email" type="text" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <label for="password">
                    Пароль:
                </label>
            </td>
            <td>
                <input name="password" id="password" type="text">
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
