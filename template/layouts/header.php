<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/template/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(window).on('load', function () {
            $("#loading-center").fadeOut(800, function () {
                $("#loading").fadeOut(1000);
            });
        });
    </script>
</head>
<body>

<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
        </div>
    </div>
</div>

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