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

    input[type=text], input[type=password], select {
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

<?php if (isset($this->data['errors']) && $this->data['errors']['result']) {?>
    <h1>Регистрация успешно завершена!</h1>
<?php } else { ?>
    <div>
        <b>Ваши данные: </b><br>
        <img width="75" style="float: left; margin-right: 15px; margin-bottom: 15px" src="<?php echo $this->data['avatar']; ?>" alt="аватар">
        Имя: <?php echo $this->data['first_name']; ?><br>
        Фамилия: <?php echo $this->data['last_name']; ?><br>
        <div style="clear: both"></div>
    </div>
    <form action="" method="post">
        <label for="phone">Укажите ваш телефон, например +380586621458:</label>
        <?php if (isset($this->data['errors']['phone'])) $this->printFormError($this->data['errors']['phone']); ?>
        <input type="text" id="phone" name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>">
        <label for="email">Укажите ваш E-Mail:</label>
        <?php if (isset($this->data['errors']['email'])) $this->printFormError($this->data['errors']['email']); ?>
        <input type="text" id="email" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
        <label for="password">Укажите пароль:</label>
        <?php if (isset($this->data['errors']['password'])) $this->printFormError($this->data['errors']['password']); ?>
        <input type="password" id="password" name="password">
        <input type="submit" style="margin-right: 15px;" value="Подтвердить" name="submit"><input type="submit" value="Отмена" name="cancel_social_registration">
    </form>
<?php } ?>