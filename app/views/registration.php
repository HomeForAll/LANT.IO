<h1>Регистрация</h1>
<?php
foreach ($this->data['info'] as $error) {
    echo '<span style="color: red;">' . $error . '</span><br>';
}

$nickname = '';
$firstName = (isset($_POST['firstName']) && !empty($_POST['firstName'])) ? $_POST['firstName'] : '';
$lastName = (isset($_POST['lastName']) && !empty($_POST['lastName'])) ? $_POST['lastName'] : '';
$patronymic = (isset($_POST['patronymic']) && !empty($_POST['patronymic'])) ? $_POST['patronymic'] : '';
$birthday = (isset($_POST['birthday']) && !empty($_POST['birthday'])) ? $_POST['birthday'] : '';
$phoneNumber = (isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : '';
$email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : '';

$vk_userID = (isset($_SESSION['vk_userID']) && !empty($_SESSION['vk_userID'])) ? $_SESSION['vk_userID'] : '';
$ok_userID = (isset($_SESSION['ok_userID']) && !empty($_SESSION['ok_userID'])) ? $_SESSION['ok_userID'] : '';
$mail_userID = (isset($_SESSION['mail_userID']) && !empty($_SESSION['mail_userID'])) ? $_SESSION['mail_userID'] : '';
$ya_userID = (isset($_SESSION['ya_userID']) && !empty($_SESSION['ya_userID'])) ? $_SESSION['ya_userID'] : '';
$goo_userID = (isset($_SESSION['goo_userID']) && !empty($_SESSION['goo_userID'])) ? $_SESSION['goo_userID'] : '';
$steam_userID = (isset($_SESSION['steam_userID']) && !empty($_SESSION['steam_userID'])) ? $_SESSION['steam_userID'] : '';

if (isset($_SESSION['services']) && !empty($_SESSION['services'])) {
    foreach ($_SESSION['services'] as $service => $status) {
        if (isset($_SESSION[$service . '_firstName'])) {
            $firstName = $_SESSION[$service . '_firstName'];
        }

        if (isset($_SESSION[$service . '_lastName'])) {
            $lastName = $_SESSION[$service . '_lastName'];
        }

        if (isset($_SESSION[$service . '_patronymic'])) {
            $patronymic = $_SESSION[$service . '_patronymic'];
        }

        if (isset($_SESSION[$service . '_birthday'])) {
            $birthday = $_SESSION[$service . '_birthday'];
        }

        if (isset($_SESSION[$service . '_phoneNumber'])) {
            $phoneNumber = $_SESSION[$service . '_phoneNumber'];
        }
        if (isset($_SESSION[$service . '_email'])) {
            $email = $_SESSION[$service . '_email'];
        }
    }
}
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
                    Номер телефона: +
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

<?php
if (isset($_SESSION['services']) && !empty($_SESSION['services'])) {
    if (isset($_SESSION['services']['vk'])) {
        ?>
        Ваш профиль Вконтакте: <br>
        <div style="height: 80px;">
            <img style="float: left; width: 50px; padding: 15px 15px 15px 0;"
                 src="<?php echo $_SESSION['vk_avatar']; ?>"
                 alt="Аватар">
            <div
                style="line-height: 80px"><?php echo $_SESSION['vk_firstName'] . ' ' . $_SESSION['vk_lastName']; ?></div>
        </div>
        <a href="auth/unset/vk">Отвязать Вконтакте</a><br><br>
        <?php
    }
    if (isset($_SESSION['services']['ok'])) {
        ?>
        Ваш профиль Одноклассники: <br>
        <div style="height: 80px;">
            <img style="float: left; width: 50px; padding: 15px 15px 15px 0;"
                 src="<?php echo $_SESSION['ok_avatar']; ?>" alt="Аватар">
            <div
                style="line-height: 80px"><?php echo $_SESSION['ok_firstName'] . ' ' . $_SESSION['ok_lastName']; ?></div>
        </div>
        <a href="auth/unset/ok">Отвязать Одноклассники</a><br><br>
        <?php
    }
    if (isset($_SESSION['services']['mail'])) {
        ?>
        Ваш профиль Mail.ru: <br>
        <div style="height: 80px;">
            <img style="float: left; width: 50px; padding: 15px 15px 15px 0;"
                 src="<?php echo $_SESSION['mail_avatar']; ?>" alt="Аватар">
            <div
                style="line-height: 80px"><?php echo $_SESSION['mail_firstName'] . ' ' . $_SESSION['mail_lastName']; ?></div>
        </div>
        <a href="auth/unset/mail">Отвязать Mail.ru</a><br><br>
        <?php
    }
    if (isset($_SESSION['services']['ya'])) {
        ?>
        Ваш профиль Yandex.ru: <br>
        <div style="height: 80px;">
            <img style="float: left; width: 50px; padding: 15px 15px 15px 0;"
                 src="<?php echo $_SESSION['ya_avatar']; ?>" alt="Аватар">
            <div
                style="line-height: 80px"><?php echo $_SESSION['ya_firstName'] . ' ' . $_SESSION['ya_lastName']; ?></div>
        </div>
        <a href="auth/unset/ya">Отвязать Yandex.ru</a><br><br>
        <?php
    }
    if (isset($_SESSION['services']['goo'])) {
        ?>
        Ваш профиль Google: <br>
        <div style="height: 80px;">
            <img style="float: left; width: 50px; padding: 15px 15px 15px 0;"
                 src="<?php echo $_SESSION['goo_avatar']; ?>" alt="Аватар">
            <div
                style="line-height: 80px"><?php echo $_SESSION['goo_firstName'] . ' ' . $_SESSION['goo_lastName']; ?></div>
        </div>
        <a href="auth/unset/goo">Отвязать Google</a><br><br>
        <?php
    }
    if (isset($_SESSION['services']['fb'])) {
        ?>
        Ваш профиль Facebook: <br>
        <div style="height: 80px;">
            <img style="float: left; width: 50px; padding: 15px 15px 15px 0;"
                 src="<?php echo $_SESSION['fb_avatar']; ?>" alt="Аватар">
            <div
                style="line-height: 80px"><?php echo $_SESSION['fb_firstName'] . ' ' . $_SESSION['fb_lastName']; ?></div>
        </div>
        <a href="auth/unset/fb">Отвязать Facebook</a><br><br>
        <?php
    }
    if (isset($_SESSION['services']['steam'])) {
        ?>
        Ваш профиль Steam: <br>
        <div style="height: 80px;">
            <img style="float: left; width: 50px; padding: 15px 15px 15px 0;"
                 src="<?php echo $_SESSION['steam_avatar']; ?>" alt="Аватар">
            <div style="line-height: 80px"><?php echo $_SESSION['steam_nickName']; ?></div>
        </div>
        <a href="auth/unset/steam">Отвязать Steam</a><br><br>
        <?php
    }

    ?>
    <a href="auth/unset">Отвязать все сервисы</a><br><br>
    <?php
        if (!isset($_SESSION['services']['vk'])) {
            ?>
            <a href="auth/vk">Авторизоваться через Вконтакте</a><br>
            <?php
        }
        if (!isset($_SESSION['services']['ok'])) {
            ?>
            <a href="auth/ok">Авторизоваться через Одноклассники</a><br>
            <?php
        }
        if (!isset($_SESSION['services']['mail'])) {
            ?>
            <a href="auth/mail">Авторизоваться через Mail.ru</a><br>
            <?php
        }
        if (!isset($_SESSION['services']['ya'])) {
            ?>
            <a href="auth/ya">Авторизоваться через Yandex.ru</a><br>
            <?php
        }
        if (!isset($_SESSION['services']['goo'])) {
            ?>
            <a href="auth/goo">Авторизоваться через Google</a><br>
            <?php
        }
        if (!isset($_SESSION['services']['fb'])) {
            ?>
            <a href="auth/fb">Авторизоваться через Facebook</a><br>
            <?php
        }
        if (!isset($_SESSION['services']['steam'])) {
            ?>
            <a href="auth/steam">Авторизоваться через Steam</a><br>
            <?php
        }
} else {
    ?>
    <a href="auth/vk">Авторизоваться через Вконтакте</a><br>
    <a href="auth/ok">Авторизоваться через Одноклассники</a><br>
    <a href="auth/mail">Авторизоваться через Mail.ru</a><br>
    <a href="auth/ya">Авторизоваться через Yandex.ru</a><br>
    <a href="auth/goo">Авторизоваться через Google</a><br>
    <a href="auth/fb">Авторизоваться через Facebook</a><br>
    <a href="auth/steam">Авторизоваться через Steam</a><br>
    <?php
}
?>