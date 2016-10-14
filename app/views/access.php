<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Получение доступа</title>
</head>
<body>
<h1>Получение бета доступа</h1>
<form action="" method="post">
    <label for="email">E-Mail:</label>
    <input id="email" name="email" type="text" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>"><br>
    <?php if ($data == 'keyRequest') { ?>
    <label for="key">Ключ:</label>
    <input id="key" name="key" type="text"><br>
    <?php } elseif($data == 'wrongKey') { ?>
        <label for="key">Ключ:</label>
        <input style="border: solid 1px red;" id="key" name="key" type="text"><br>
    <?php } ?>
    <input type="submit" name="submit">
</form>
</body>
</html>