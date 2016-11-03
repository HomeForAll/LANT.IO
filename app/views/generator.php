<?php
$this->title = 'Генератор ключей';
?>
<h1>Генератор ключей</h1>
<span style="color: #942a25">Каждый Email с нововй строки</span><br>
<span style="color: #942a25">Генерация новых ключей, уничтожит необработанные</span>
<form action="" method="post">
    <textarea name="emails" cols="120" rows="20" placeholder="Email`ы ..."></textarea>
    <input name="generate" type="submit" value="Генерировать">
</form>

<?php
if (isset($_SESSION['keys'])) {
?>
<br><br><br>
<h3>Ключи:</h3>
<br>
<form action="" method="post">
    <?php
    foreach ($_SESSION['keys'] as $email => $key) {
        echo $email . " | " . $key . "<br>";
    }
    }
    ?>
    <br>
    <label for="sendCheck">Отправлять на Email`ы? </label><input name="sendCheck" id="sendCheck" type="checkbox"><br>
    <label for="dbCheck">Записать в базу данных? </label><input name="dbCheck" id="dbCheck" type="checkbox"><br>
    Не выбрав ни одного пункта, ключи будут стерты <br>
    <input name="handle" type="submit" value="Замести следы">
    <a href="keyeditor"><input type = submit name = keyeditor value="Панель ключей"></a>
</form>
