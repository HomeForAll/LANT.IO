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

$firstName = (isset($_POST['firstName']) && !empty($_POST['firstName'])) ? $_POST['firstName'] : '';
$lastName = (isset($_POST['lastName']) && !empty($_POST['lastName'])) ? $_POST['lastName'] : '';
$patronymic = (isset($_POST['patronymic']) && !empty($_POST['patronymic'])) ? $_POST['patronymic'] : '';
$birthday = (isset($_POST['birthday']) && !empty($_POST['birthday'])) ? $_POST['birthday'] : '';
$phoneNumber = (isset($_POST['phoneNumber']) && !empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : '';
$email = (isset($_POST['email']) && !empty($_POST['email'])) ? $_POST['email'] : '';

// Записываем ошибки если они есть

$firstNameErr = isset($this->data['first_name']) && $this->data['first_name'] ? $this->data['first_name'] : [];
$lastNameErr = isset($this->data['last_name']) && $this->data['last_name'] ? $this->data['last_name'] : [];
$patronymicErr = isset($this->data['patronymic']) && $this->data['patronymic'] ? $this->data['patronymic'] : [];
$birthdayErr = isset($this->data['birthday']) && $this->data['birthday'] ? $this->data['birthday'] : [];
$phoneNumberErr = isset($this->data['phone']) && $this->data['phone'] ? $this->data['phone'] : [];
$emailErr = isset($this->data['email']) && $this->data['email'] ? $this->data['email'] : [];
$passwordErr = isset($this->data['password']) && $this->data['password'] ? $this->data['password'] : [];

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

<?php if (isset($this->data['result']) && $this->data['result']) { ?>
    <h1>Регистрация успешно завершена!</h1>
<?php } else { ?>
    <h1>Регистрация</h1>

    <form action="" method="post">
        <label for="firstName">Имя:</label>
        <?php $this->printFormError($firstNameErr) ?>
        <input name="firstName" id="firstName" type="text" value="<?php echo $firstName; ?>">

        <label for="lastName">Фамилия:</label>
        <?php $this->printFormError($lastNameErr) ?>
        <input name="lastName" id="lastName" type="text" value="<?php echo $lastName; ?>">

        <label for="patronymic">Отчество:</label>
        <?php $this->printFormError($patronymicErr) ?>
        <input name="patronymic" id="patronymic" type="text" value="<?php echo $patronymic; ?>">

        <label for="birthday">Дата рождения:</label>
        <?php $this->printFormError($birthdayErr) ?>
        <input name="birthday" id="birthday" type="date" value="<?php echo $birthday; ?>">

        <label for="phoneNumber">Номер телефона:</label>
        <?php $this->printFormError($phoneNumberErr) ?>
        <input name="phoneNumber" id="phoneNumber" type="text" value="<?php echo $phoneNumber; ?>">

        <label for="email">E-Mail:</label>
        <?php $this->printFormError($emailErr) ?>
        <input name="email" id="email" type="text" value="<?php echo $email; ?>">

        <label for="password">Пароль:</label>
        <?php $this->printFormError($passwordErr) ?>
        <input name="password" id="password" type="password">

        <input type="submit" name="submit" value="Создать аккаунт">
    </form>

    <div id="soc_net">
        <a href="oauth/vk/state/2"><img src="/template/main/images/soc_net/vk_2.png" alt="VK"></a>
        <a href="oauth/ok/state/2"><img src="/template/main/images/soc_net/ok.png" alt="OK"></a>
        <a href="oauth/mail/state/2"><img src="/template/main/images/soc_net/mail_ru.png" alt="Mail"></a>
        <a href="oauth/ya/state/2"><img src="/template/main/images/soc_net/yandex_2.png" alt="YA"></a>
        <a href="oauth/google/state/2"><img src="/template/main/images/soc_net/google.png" alt="Google"></a>
        <a href="oauth/fb/state/2"><img src="/template/main/images/soc_net/facebook_2.png" alt="FaceBook"></a>
        <a href="oauth/steam/state/2"><img src="/template/main/images/soc_net/steam.png" alt="Steam"></a>
        <div style="clear: both"></div>
    </div>
<?php } ?>