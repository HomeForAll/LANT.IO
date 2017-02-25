<style>
    form {
        margin-bottom: 15px;
    }

    fieldset {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
    }

    input[type=text], input[type=date], input[type=password], select {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        width: 100%;
        box-sizing: border-box;
        padding: 10px 15px 10px 15px;
        margin-bottom: 15px;
        border: solid 1px gray;
        border-radius: 3px;
    }

    input[type=checkbox] {
        margin-right: 10px;
    }

    input[type=submit] {
        width: 200px;
    }
</style>
<?php
$this->title = 'Регистрация';

$nickname = '';
$firstName = (isset($_POST['firstName']) && !empty($_POST['firstName'])) ? $_POST['firstName'] : '';
$lastName = (isset($_POST['lastName']) && !empty($_POST['lastName'])) ? $_POST['lastName'] : '';
$patronymic = (isset($_POST['patronymic']) && !empty($_POST['patronymic'])) ? $_POST['patronymic'] : '';
$birthday = (isset($_POST['birthday']) && !empty($_POST['birthday'])) ? $_POST['birthday'] : '';
$phoneNumber = (isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : '';
$email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : '';

// Записываем ошибки если они есть

$firstNameErr = isset($this->data['firstName']) ? $this->data['firstName'] : [];
$lastNameErr = isset($this->data['lastName']) ? $this->data['lastName'] : [];
$patronymicErr = isset($this->data['patronymic']) ? $this->data['patronymic'] : [];
$birthdayErr = isset($this->data['birthday']) ? $this->data['birthday'] : [];
$phoneNumberErr = isset($this->data['phoneNumber']) ? $this->data['phoneNumber'] : [];
$emailErr = isset($this->data['email']) ? $this->data['email'] : [];
$passwordErr = isset($this->data['password']) ? $this->data['password'] : [];

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
                <input name="firstName" id="firstName" type="text"
                       value="<?php echo $firstName; ?>">
                <?php $this->printFormError($firstNameErr) ?>
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
                <?php $this->printFormError($lastNameErr) ?>
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
                <?php $this->printFormError($patronymicErr) ?>
            </td>
        </tr>
        <tr>
            <td>
                <label for="birthday">
                    Дата рождения:
                </label>
            </td>
            <td>
                <?php $this->printFormError($birthdayErr) ?>
                <input name="birthday" id="birthday" type="date" value="<?php echo $birthday; ?>">
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
                <?php $this->printFormError($phoneNumberErr) ?>
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
                <?php $this->printFormError($emailErr) ?>
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
                <?php $this->printFormError($passwordErr) ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="submit" value="Создать аккаунт">
            </td>
        </tr>
    </table>
</form>

<div id="soc_net">
    <a href="oauth/vk/state/2"><img src="/templates/main/images/soc_net/vk_2.png" alt="VK"></a>
    <a href="oauth/ok/state/2"><img src="/templates/main/images/soc_net/ok.png" alt="OK"></a>
    <a href="oauth/mail/state/2"><img src="/templates/main/images/soc_net/mail_ru.png" alt="Mail"></a>
    <a href="oauth/ya/state/2"><img src="/templates/main/images/soc_net/yandex_2.png" alt="YA"></a>
    <a href="oauth/google/state/2"><img src="/templates/main/images/soc_net/google.png" alt="Google"></a>
    <a href="oauth/fb/state/2"><img src="/templates/main/images/soc_net/facebook_2.png" alt="FaceBook"></a>
    <a href="oauth/steam/state/2"><img src="/templates/main/images/soc_net/steam.png" alt="Steam"></a>
    <div style="clear: both"></div>
</div>