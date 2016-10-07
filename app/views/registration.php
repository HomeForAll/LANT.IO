<?php
foreach ($data['info'] as $error) {
    echo '<span style="color: red;">' . $error . '</span><br>';
}

$firstName = (!empty($_POST['firstName'])) ? $_POST['firstName'] : (isset($_SESSION['firstName'])) ? $_SESSION['firstName'] : '' ;
$lastName = (!empty($_POST['lastName'])) ? $_POST['lastName'] : (isset($_SESSION['lastName'])) ? $_SESSION['lastName'] : '' ;;
$patronymic = (!empty($_POST['patronymic'])) ? $_POST['patronymic'] : '' ;;
$birthday = (!empty($_POST['birthday'])) ? $_POST['birthday'] : (isset($_SESSION['birthday'])) ? $_SESSION['birthday'] : '' ;;
$phoneNumber = (!empty($_POST['phoneNumber'])) ? $_POST['phoneNumber'] : '' ;;
$email = (!empty($_POST['email'])) ? $_POST['email'] : (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ;;
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
                <input type="submit" name="submit">
            </td>
        </tr>
    </table>
</form>
<h2><a href="auth/vk">Заполнить данные используя Вконтакте</a></h2>