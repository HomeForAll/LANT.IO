<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Получение доступа</title>
    <link rel="stylesheet" href="/template/css/fonts.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            padding: 170px 0 0 0;
            color: #ffffff;
            font: 150pt 'Fedra Sense Pro Bold';
            text-align: center;
        }

        input::-moz-placeholder {
            color: #000000;
        }

        input::-webkit-input-placeholder {
            color: #000000;
        }

        input:-ms-input-placeholder {
            color: #000000;
        }

        input[type=text] {
            position: relative;
            left: 50%;
            font: 11pt 'Gotham Pro Regular';
            border: none;
            border-radius: 3px;
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
            border-radius: 3px;
            background: #4f85c8;
            margin: 0 0 0 -230px;
        }

        input[type=submit]:hover {
            background: #2f66aa;
        }
    </style>
</head>
<body>
<div id="logo">lant.io</div>

<form action="" method="post">
    <input id="email" name="email" type="text" placeholder="Ваш email" value="<?php if (!empty($_POST['email'])) echo $_POST['email']; ?>"><br>
    <?php if ($data == 'keyRequest') { ?>
    <input id="key" name="key" placeholder="Ключ доступа" type="text"><br>
    <?php } elseif($data == 'wrongKey') { ?>
        <input style="border: solid 1px red;" id="key" name="key" placeholder="Ключ доступа" type="text"><br>
    <?php } ?>
    <input type="submit" name="submit" value="Войти">
</form>

</body>
</html>