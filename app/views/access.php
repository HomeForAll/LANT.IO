<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Получение доступа</title>
    <link rel="stylesheet" href="/template/css/fonts.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        body {
            background: url("/template/images/access_background.jpg") center center fixed no-repeat;
            background-size: cover;
        }

        #logo {
            position: relative;
            cursor: default;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            padding: 170px 0 0 0;
            color: #ffffff;
            font: 130pt 'Fedra Sense Pro Bold';
            text-align: center;
        }

        img {
            position: absolute;
            top: 325px;
            left: 50%;
            margin-left: -210px;
            width: 135px;
        }

        form {
            padding-top: 30px;
        }

        input::-moz-placeholder {
            color: #494949;
        }

        input::-webkit-input-placeholder {
            color: #494949;
        }

        input:-ms-input-placeholder {
            color: #494949;
        }

        input[type=text] {
            position: relative;
            left: 50%;
            font: 11pt 'Gotham Pro Regular';
            border: none;
            border-radius: 4px;
            outline: none;
            width: 350px;
            height: 10px;
            padding: 26px 20px 26px 90px;
            margin: 0 0 25px -230px;
        }

        #email {
            background: url("/template/images/msg.png") 33px 23px no-repeat #ffffff;
        }

        #key {
            background: url("/template/images/key.png") 30px 19px no-repeat #ffffff;
        }

        #keyError {
            border: solid 4px #c65555;
            width: 350px;
            height: 10px;
            padding: 22px 16px 22px 86px;
            margin: 0 0 25px -230px;
            background: url("/template/images/key.png") 26px 15px no-repeat #ffffff;
        }

        input[type=submit] {
            position: relative;
            cursor: pointer;
            left: 50%;
            color: #ffffff;
            border: none;
            outline: none;
            width: 460px;
            height: 65px;
            font: 18pt 'Gotham Pro Regular';
            border-radius: 4px;
            background: #4f85c8;
            margin: 0 0 0 -230px;

            -webkit-transition: background 0.25s;
            -moz-transition: background 0.25s;
            -o-transition: background 0.25s;
            transition: background 0.25s;
        }

        input[type=submit]:hover {
            background: #2f66aa;
        }

        a {
            font: 12pt 'Open Sans';
            color: #ffffff;
            text-decoration: none;
            opacity: 0.7;

            -webkit-transition: opacity 0.25s;
            -moz-transition: opacity 0.25s;
            -o-transition: opacity 0.25s;
            transition: opacity 0.25s;

        }

        a:hover {
            opacity: 1;
        }

        #link {
            padding: 40px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<div id="logo"><img src="/template/images/access_logo_element.png" alt="access">lant.io</div>

<form action="" method="post" autocomplete="off">
    <input id="email" name="email" type="text" placeholder="Ваш email" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>"><br>
    <?php if ($data == 'keyRequest') { ?>
    <input id="key" name="key" placeholder="Ключ доступа" type="text"><br>
    <?php } elseif($data == 'wrongKey') { ?>
        <input id="keyError" name="key" placeholder="Ключ доступа" type="text" value="<?php if (!empty($_POST['key'])) echo $_POST['key']; ?>"><br>
    <?php } ?>
    <input type="submit" name="submit" value="Войти">
</form>

<div id="link"><a href="https://docs.google.com/forms/d/e/1FAIpQLSdimqMUr3q4ruMuDQAXGec4wXeL56sS9V6nqKGvhY9YZXIoug/viewform?c=0&w=1" target="_blank">У меня нет доступа</a></div>

</body>
</html>