<?php
foreach ($data as $error) {
    echo $error;
}
?>

<h1>Регистрация</h1>
<form action="" method="post">
    <table>
        <tr>
            <td>
                <label for="firstName">
                    Имя:
                </label>
            </td>
            <td>
                <input name="firstName" id="firstName" type="text" value="<?php if (!empty($_POST['firstName'])) echo $_POST['firstName']; ?>">
            </td>
        </tr>
        <tr>
            <td>
                <label for="lastName">
                    Фамилия:
                </label>
            </td>
            <td>
                <input name="lastName" id="lastName" type="text" value="<?php if (!empty($_POST['lastName'])) echo $_POST['lastName']; ?>">
            </td>
        </tr>
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
                <input name="password" id="password" type="password">
            </td>
        </tr>
        <tr>
            <td>
                <label for="phoneNumber">
                    Номер телефона:
                </label>
            </td>
            <td>
                <input name="phoneNumber" id="phoneNumber" type="text"  value="<?php if (!empty($_POST['phoneNumber'])) echo $_POST['phoneNumber']; ?>">
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit">
            </td>
        </tr>
    </table>
</form>
