<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/template/css/style.css">
</head>
<body>
<div id="wrapper">
    <div id="navigation">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/search">Поиск</a></li>
            <li><a href="/news">Новости</a></li>
            <?php if (isset($_SESSION['authorized'])) { ?>
                <li><a href="/cp">Личный кабинет</a></li>
                <li><a href="/logout">Выход</a></li>
            <?php } else { ?>
                <li><a href="/registration">Регистрация</a></li>
                <li><a href="/login">Вход</a></li>
            <?php } ?>
        </ul>
    </div>
    <div id="content">