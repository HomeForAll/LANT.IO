<h1>Регистрация</h1>
<?php
foreach ($data['info'] as $error) {
    echo '<span style="color: red;">' . $error . '</span><br>';
}

if (isset($_SESSION['service'])) {
    switch ($_SESSION['service']) {
        case 'vk':
            ?>
            <div style="height: 100px; padding: 15px 0">
                <h3>Ваш профиль Вконтакте авторизован:</h3>
                <img style="float: left; width: 70px; padding: 0 15px 0 0" src="<?php echo $_SESSION['vk_avatar']; ?>"
                     alt="Аватар">
                Имя: <?php echo $_SESSION['vk_firstName']; ?><br>
                Фамилия: <?php echo $_SESSION['vk_lastName']; ?><br>
                Дата рождения: <?php echo $_SESSION['vk_birthday']; ?>
            </div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="firstName" id="firstName" type="text"
                                   value="<?php echo $_SESSION['vk_firstName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="lastName" id="lastName" type="text"
                                   value="<?php echo $_SESSION['vk_lastName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="birthday" id="birthday" type="text"
                                   value="<?php echo $_SESSION['vk_birthday']; ?>" hidden>
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
                                   value="<?php echo (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : ''; ?>">
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
                                   value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>">
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
            <a href="auth/unset">Отвязать Вконтакте</a><br><br>
            <?php
            break;
        case 'ok':
            ?>
            <div style="height: 100px; padding: 15px 0">
                <h3>Ваш профиль Одноклассники авторизован:</h3>
                <img style="float: left; width: 70px; padding: 0 15px 0 0" src="<?php echo $_SESSION['ok_avatar']; ?>"
                     alt="Аватар">
                Имя: <?php echo $_SESSION['ok_firstName']; ?><br>
                Фамилия: <?php echo $_SESSION['ok_lastName']; ?><br>
                Дата рождения: <?php echo $_SESSION['ok_birthday']; ?>
            </div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="firstName" id="firstName" type="text"
                                   value="<?php echo $_SESSION['ok_firstName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="lastName" id="lastName" type="text"
                                   value="<?php echo $_SESSION['ok_lastName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="birthday" id="birthday" type="text"
                                   value="<?php echo $_SESSION['ok_birthday']; ?>" hidden>
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
                                   value="<?php echo (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : ''; ?>">
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
                                   value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>">
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
            <a href="auth/unset">Отвязать Одноклассники</a><br><br>
            <?php
            break;
        case 'mail':
            ?>
            <div style="height: 100px; padding: 15px 0">
                <h3>Ваш профиль Mail.ru авторизован:</h3>
                <img style="float: left; width: 70px; padding: 0 15px 0 0" src="<?php echo $_SESSION['mail_avatar']; ?>"
                     alt="Аватар">
                Имя: <?php echo $_SESSION['mail_firstName']; ?><br>
                Фамилия: <?php echo $_SESSION['mail_lastName']; ?><br>
                Дата рождения: <?php echo $_SESSION['mail_birthday']; ?>
            </div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="firstName" id="firstName" type="text"
                                   value="<?php echo $_SESSION['mail_firstName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="lastName" id="lastName" type="text"
                                   value="<?php echo $_SESSION['mail_lastName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="birthday" id="birthday" type="text"
                                   value="<?php echo $_SESSION['mail_birthday']; ?>" hidden>
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
                                   value="<?php echo (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : ''; ?>">
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
                                   value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>">
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
            <a href="auth/unset">Отвязать Mail.ru</a><br><br>
            <?php
            break;
        case 'ya':
            ?>
            <div style="height: 100px; padding: 15px 0">
                <h3>Ваш профиль Yandex.ru авторизован:</h3>
                <img style="float: left; width: 70px; padding: 0 15px 0 0" src="<?php echo $_SESSION['ya_avatar']; ?>"
                     alt="Аватар">
                Имя: <?php echo $_SESSION['ya_firstName']; ?><br>
                Фамилия: <?php echo $_SESSION['ya_lastName']; ?><br>
                <?php if (!empty($_SESSION['ya_birthday'])) {
                    echo 'Дата рождения: ' . $_SESSION['ya_birthday'] . '<br>';
                } ?>
            </div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="firstName" id="firstName" type="text"
                                   value="<?php echo $_SESSION['ya_firstName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="lastName" id="lastName" type="text"
                                   value="<?php echo $_SESSION['ya_lastName']; ?>" hidden>
                        </td>
                    </tr>

                    <?php if (!empty($_SESSION['ya_birthday'])) { ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input name="birthday" id="birthday" type="text"
                                       value="<?php echo $_SESSION['ya_birthday']; ?>" hidden>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td>
                                <label for="birthday">
                                    Дата рождения:
                                </label>
                            </td>
                            <td>
                                <input name="birthday" id="birthday" type="text"
                                       value="<?php echo (!empty($_POST['birthday'])) ? $_POST['birthday'] : ''; ?>">
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <label for="phoneNumber">
                                Номер телефона:
                            </label>
                        </td>
                        <td>
                            <input name="phoneNumber" id="phoneNumber" type="text"
                                   value="<?php echo (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : ''; ?>">
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
                                   value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>">
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
            <a href="auth/unset">Отвязать Yandex.ru</a><br><br>
            <?php
            break;
        case 'goo':
            ?>
            <div style="height: 100px; padding: 15px 0">
                <h3>Ваш профиль Google.com авторизован:</h3>
                <img style="float: left; width: 70px; padding: 0 15px 0 0" src="<?php echo $_SESSION['goo_avatar']; ?>"
                     alt="Аватар">
                Имя: <?php echo $_SESSION['goo_firstName']; ?><br>
                Фамилия: <?php echo $_SESSION['goo_lastName']; ?><br>
                <?php if (!empty($_SESSION['goo_birthday'])) {
                    echo 'Дата рождения: ' . $_SESSION['goo_birthday'] . '<br>';
                } ?>
            </div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="firstName" id="firstName" type="text"
                                   value="<?php echo $_SESSION['goo_firstName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="lastName" id="lastName" type="text"
                                   value="<?php echo $_SESSION['goo_lastName']; ?>" hidden>
                        </td>
                    </tr>

                    <?php if (!empty($_SESSION['goo_birthday'])) { ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input name="birthday" id="birthday" type="text"
                                       value="<?php echo $_SESSION['goo_birthday']; ?>" hidden>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td>
                                <label for="birthday">
                                    Дата рождения:
                                </label>
                            </td>
                            <td>
                                <input name="birthday" id="birthday" type="text"
                                       value="<?php echo (!empty($_POST['birthday'])) ? $_POST['birthday'] : ''; ?>">
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <label for="phoneNumber">
                                Номер телефона:
                            </label>
                        </td>
                        <td>
                            <input name="phoneNumber" id="phoneNumber" type="text"
                                   value="<?php echo (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : ''; ?>">
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
                                   value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>">
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
            <a href="auth/unset">Отвязать Google.com</a><br><br>
            <?php
            break;
        case 'fb':
            ?>
            <div style="height: 100px; padding: 15px 0">
                <h3>Ваш профиль Facebook авторизован:</h3>
                <img style="float: left; width: 70px; padding: 0 15px 0 0" src="<?php echo $_SESSION['fb_avatar']; ?>"
                     alt="Аватар">
                Имя: <?php echo $_SESSION['fb_firstName']; ?><br>
                Фамилия: <?php echo $_SESSION['fb_lastName']; ?><br>
                <?php if (!empty($_SESSION['fb_birthday'])) {
                    echo 'Дата рождения: ' . $_SESSION['fb_birthday'] . '<br>';
                } ?>
            </div>
            <form action="" method="post">
                <table>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="firstName" id="firstName" type="text"
                                   value="<?php echo $_SESSION['fb_firstName']; ?>" hidden>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input name="lastName" id="lastName" type="text"
                                   value="<?php echo $_SESSION['fb_lastName']; ?>" hidden>
                        </td>
                    </tr>

                    <?php if (!empty($_SESSION['fb_birthday'])) { ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input name="birthday" id="birthday" type="text"
                                       value="<?php echo $_SESSION['fb_birthday']; ?>" hidden>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td>
                                <label for="birthday">
                                    Дата рождения:
                                </label>
                            </td>
                            <td>
                                <input name="birthday" id="birthday" type="text"
                                       value="<?php echo (!empty($_POST['birthday'])) ? $_POST['birthday'] : ''; ?>">
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <label for="phoneNumber">
                                Номер телефона:
                            </label>
                        </td>
                        <td>
                            <input name="phoneNumber" id="phoneNumber" type="text"
                                   value="<?php echo (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : ''; ?>">
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
                                   value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>">
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
            <a href="auth/unset">Отвязать Facebook</a><br><br>
            <?php
            break;
        case 'steam':
            ?>
            <div style="height: 50px; padding: 15px 0">
                <h3>Ваш профиль Steam авторизован:</h3>
                NickName: <?php echo $_SESSION['s_nickName']; ?><br>
                <?php if (!empty($_SESSION['s_firstName'])) {
                    echo 'Имя: ' . $_SESSION['s_firstName'];
                } ?>
            </div>
            <form action="" method="post">
                <table>
                    <?php if (!empty($_SESSION['s_firstName'])) { ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input name="firstName" id="firstName" type="text"
                                       value="<?php echo $_SESSION['s_firstName']; ?>" hidden>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td>
                                <label for="firstName">
                                    Имя:
                                </label>
                            </td>
                            <td>
                                <input name="firstName" id="firstName" type="text"
                                       value="<?php echo (!empty($_POST['firstName'])) ? $_POST['firstName'] : ''; ?>">
                            </td>
                        </tr>
                    <?php } ?>


                    <tr>
                        <td>
                            <label for="lastName">Фамилия:</label>
                        </td>
                        <td>
                            <input name="lastName" id="lastName" type="text"
                                   value="<?php echo (!empty($_POST['lastName'])) ? $_POST['lastName'] : ''; ?>">
                        </td>
                    </tr>

                    <?php if (!empty($_SESSION['s_birthday'])) { ?>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input name="birthday" id="birthday" type="text"
                                       value="<?php echo $_SESSION['s_birthday']; ?>" hidden>
                            </td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td>
                                <label for="birthday">
                                    Дата рождения:
                                </label>
                            </td>
                            <td>
                                <input name="birthday" id="birthday" type="text"
                                       value="<?php echo (!empty($_POST['birthday'])) ? $_POST['birthday'] : ''; ?>">
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>
                            <label for="phoneNumber">
                                Номер телефона:
                            </label>
                        </td>
                        <td>
                            <input name="phoneNumber" id="phoneNumber" type="text"
                                   value="<?php echo (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : ''; ?>">
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
                                   value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : ''; ?>">
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
            <a href="auth/unset">Отвязать Steam</a><br><br>
            <?php
            break;
    }
    ?>

<?php } else {
    $firstName = (!empty($_POST['firstName'])) ? $_POST['firstName'] : '';
    $lastName = (!empty($_POST['lastName'])) ? $_POST['lastName'] : '';
    $patronymic = (!empty($_POST['patronymic'])) ? $_POST['patronymic'] : '';
    $birthday = (!empty($_POST['birthday'])) ? $_POST['birthday'] : '';
    $phoneNumber = (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : '';
    $email = (!empty($_POST['email'])) ? $_POST['email'] : '';
    ?>

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
    <a href="auth/vk">Авторизоваться через Вконтакте</a><br>
    <a href="auth/ok">Авторизоваться через Одноклассники</a><br>
    <a href="auth/mail">Авторизоваться через Mail.ru</a><br>
    <a href="auth/ya">Авторизоваться через Yandex.ru</a><br>
    <a href="auth/goo">Авторизоваться через Google</a><br>
    <a href="auth/fb">Авторизоваться через Facebook</a><br>
    <a href="auth/steam">Авторизоваться через Steam</a><br>
<?php } ?>