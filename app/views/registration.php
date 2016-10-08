<?php
foreach ($data['info'] as $error) {
    echo '<span style="color: red;">' . $error . '</span><br>';
}

$firstName = (!empty($_POST['firstName'])) ? $_POST['firstName'] : '' ;
$lastName = (!empty($_POST['lastName'])) ? $_POST['lastName'] : '' ;
$patronymic = (!empty($_POST['patronymic'])) ? $_POST['patronymic'] : '' ;
$birthday = (!empty($_POST['birthday'])) ? $_POST['birthday'] : '' ;
$phoneNumber = (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : '' ;
$email = (!empty($_POST['email'])) ? $_POST['email'] : '' ;

if (isset($_SESSION['service'])) {
    switch ($_SESSION['service']) {
        case 'vk':
            ?>
            <h1>Регистрация</h1>
            <h3>Ваш профиль Вконтакте авторизован:</h3>
            Имя: <?php echo $_SESSION['vk_firstName']; ?><br>
            Фамилия: <?php echo $_SESSION['vk_lastName']; ?><br>
            Дата рождения: <?php echo $_SESSION['vk_birthday']; ?><br>
            E-Mail: <?php echo $_SESSION['vk_email'] ?><br>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="firstName" id="firstName" type="text"
                                   value="<?php echo $firstName; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="lastName" id="lastName" type="text"
                                   value="<?php echo $lastName; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="birthday" id="birthday" type="text"
                                   value="<?php echo $birthday; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="phoneNumber">
                                Номер телефона:
                            </label>
                        </td>
                        <td>
                            <input name="phoneNumber" id="phoneNumber" type="text"
                                   value="<?php echo $phoneNumber; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="email" id="email" type="text"
                                   value="<?php echo $email; ?>" hidden>
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
                            <input type="submit" name="submit" value="Зарегистрировать">
                        </td>
                    </tr>
                </table>
            </form>
            <a href="auth/unset">Не использовать больше Вконтакте</a><br><br>
        <?php
            break;
        case 'ok':
            break;
        case 'fb':
            break;
    }
?>

<?php } else { ?>
    <form action="" method="post">
        <table>
            <tr>
                <td>
                    <label for="firstName">
                        Имя:
                    </label>
                </td>
                <td>
                    <input name="firstName" id="firstName" type="text"
                           value="<?php echo $firstName; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="lastName">
                        Фамилия:
                    </label>
                </td>
                <td>
                    <input name="lastName" id="lastName" type="text"
                           value="<?php echo $lastName; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="patronymic">
                        Отчество:
                    </label>
                </td>
                <td>
                    <input name="patronymic" id="patronymic" type="text"
                           value="<?php echo $patronymic; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="birthday">
                        Дата рождения:
                    </label>
                </td>
                <td>
                    <input name="birthday" id="birthday" type="text"
                           value="<?php echo $birthday; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="phoneNumber">
                        Номер телефона:
                    </label>
                </td>
                <td>
                    <input name="phoneNumber" id="phoneNumber" type="text"
                           value="<?php echo $phoneNumber; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="email">
                        E-Mail:
                    </label>
                </td>
                <td>
                    <input name="email" id="email" type="text"
                           value="<?php echo $email; ?>">
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
                    <input type="submit" name="submit" value="Зарегистрировать">
                </td>
            </tr>
        </table>
    </form>
    <a href="auth/vk">Авторизоваться Вконтакте</a>
<?php } ?>