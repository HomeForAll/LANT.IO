<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php $this->title(); ?></title>
    <link rel="stylesheet" href="/template/css/news_style.css">
    <link rel="stylesheet" href="/template/css/test_styles.css">
    <?php
    // Подключение стилей в контроллере
    if (isset($this->data['css'])) {
        foreach ($this->data['css'] as $key => $value) {
            echo '<link rel="stylesheet"  href="/template/css/' . $value . '">' . "\r\n";
        }
    }
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- jquery -->
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script src="/template/js/searchFormBuilder.js"></script>
    <script src="/template/js/mapController.js"></script>
    <script src="/template/js/forms.editor.handler.js"></script>

    <script src="/template/js/socket.io.min.js"></script>
    <?php
    $hash = isset($_SESSION['user_hash']) ? $_SESSION['user_hash'] : '';
    $user_id = isset($_SESSION['userID']) ? $_SESSION['userID'] : '';
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    ?>
    <?php
    // Подключение скрипта в контроллере
    if (isset($this->data['script'])) {
        foreach ($this->data['script'] as $key => $value) {
            echo '<script src="/template/js/' . $value . '"></script>' . "\r\n";
        }
    }
    ?>
    <script>
        var protectIO = io('http://<?php echo Registry::get('config')['ws_host']; ?>:<?php echo Registry::get('config')['ws_protect_port']; ?>?user_id=<?php echo $user_id; ?>&hash=<?php echo $hash; ?>');
        var commonIO = io('http://<?php echo Registry::get('config')['ws_host']; ?>:<?php echo Registry::get('config')['ws_common_port']; ?>');

        commonIO.on('connect', function () {
            console.log('Соединение с commonIO  установлено.');
        });

        protectIO.on('connect', function () {
            console.log('Соединение с protectIO установлено.');
        });


        protectIO.on('message', function (data) {
            console.log('****************');
            console.log('* Принято собщение: ');
            console.log('*');
            console.log('* ' + data.message);
            console.log('****************');
        });

        protectIO.on('message_notify', function (data) {
            console.log(data);
        });

        protectIO.on('error', function (data) {
            console.log(data);
        });

        protectIO.on('disconnect', function () {
            console.log('Разрыв соединения.');
        });

        /*$(window).on('load', function () {
         $("#loading-center").fadeOut(800, function () {
         $("#loading").fadeOut(1000);
         });
         });*/

        function pressEnter(a) {
            a = a || window.event;
            if (a.keyCode == 13 || a.which == 13)
                a.preventDefault ? a.preventDefault() : a.returnValue = false
        }

        var timer;
        function getTimeout(delay, callback) {
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback();
            }, delay);
        }
    </script>
    <?php $this->head() ?>
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
            <li><a href="/news">Объявления</a></li>
            <li><a href="/search">Поиск</a></li>
            <?php if (isset($_SESSION['authorized'])) { ?>
                <li><a href="/cabinet">Личный кабинет</a></li>
                <li><a href="/logout">Выход</a></li>
            <?php } else { ?>
                <li><a href="/registration">Регистрация</a></li>
                <li><a href="/login">Вход</a></li>
            <?php } ?>
        </ul>
    </div>
    <div id="content">
        <?php $this->content(); ?>
    </div>
</div>
<?php
// Подключение скрипта в контроллере для футера
if (isset($this->data['script_footer'])) {
    foreach ($this->data['script_footer'] as $key => $value) {
        echo '<script src="/template/js/' . $value . '"></script>' . "\r\n";
    }
}
?>
</body>
</html>