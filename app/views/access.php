<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Получение доступа</title>
    <link rel="stylesheet" href="/template/css/fonts.css">
    <link rel="stylesheet" href="/template/css/jquery.scrollbar.css">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>-->
    <script src="/template/js/jquery.min.js"></script>
    <script src="/template/js/jquery.scrollbar.min.js"></script>
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

        #emailError {
            border: solid 4px #c65555;
            width: 350px;
            height: 10px;
            padding: 22px 16px 22px 86px;
            margin: 0 0 25px -230px;
            background: url("/template/images/msg.png") 29px 19px no-repeat #ffffff;
        }

        #key {
            display: none;
            padding: 0 20px 0 90px;
            margin: 0 0 0 -230px;
            height: 0;
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

        #loading {
            background-color: #000;
            height: 100%;
            width: 100%;
            position: fixed;
            z-index: 999;
            margin-top: 0px;
            top: 0px;
        }

        #loading-center {
            width: 100%;
            height: 100%;
            position: relative;
        }

        #loading-center-absolute {
            position: absolute;
            left: 50%;
            top: 50%;
            height: 200px;
            width: 200px;
            margin-top: -100px;
            margin-left: -100px;

        }

        .object {
            -moz-border-radius: 50% 50% 50% 50%;
            -webkit-border-radius: 50% 50% 50% 50%;
            border-radius: 50% 50% 50% 50%;
            position: absolute;
            border-left: 5px solid #FFF;
            border-right: 5px solid #FFF;
            border-top: 5px solid transparent;
            border-bottom: 5px solid transparent;
            -webkit-animation: animate 2s infinite;
            animation: animate 2s infinite;
        }

        #object_one {
            left: 75px;
            top: 75px;
            width: 50px;
            height: 50px;
        }

        #object_two {
            left: 65px;
            top: 65px;
            width: 70px;
            height: 70px;
            -webkit-animation-delay: 0.1s;
            animation-delay: 0.1s;
        }

        #object_three {
            left: 55px;
            top: 55px;
            width: 90px;
            height: 90px;
            -webkit-animation-delay: 0.2s;
            animation-delay: 0.2s;
        }

        #object_four {
            left: 45px;
            top: 45px;
            width: 110px;
            height: 110px;
            -webkit-animation-delay: 0.3s;
            animation-delay: 0.3s;

        }

        #rules {
            position: absolute;
            top: 20px;
            left: 50%;
            opacity: 0;
            visibility: hidden;
            margin-left: -385px;
            width: 770px;
            height: 860px;
            background: #FFFFFF;
            z-index: 999;
        }

        .rulesTitle {
            font: 15pt 'Gotham Pro Bold';
            padding: 75px 70px 45px 70px;
        }

        .rulesWrapper {
            overflow: hidden;
            margin: 0 auto;
            width: 630px;
            height: 500px;
        }

        .rulesBody {
            font: 10pt 'Gotham Pro Regular';
            line-height: 20px;
            width: 596px;
        }

        #buttons {
            position: relative;
            width: inherit;
            text-align: center;
        }

        #agree {
            display: block;
            margin: 30px auto 0 auto;
            font: 11pt 'Gotham Pro Regular';
            width: 150px;
            padding: 14px 45px 14px 45px;
            border-radius: 4px;
            opacity: 1;
            background: #75b668;

            -webkit-transition: background 0.25s;
            -moz-transition: background 0.25s;
            -o-transition: background 0.25s;
            transition: background 0.25s;
        }

        #agree:hover {
            background: #60a253;
        }

        #denial {
            display: block;
            font: 11pt 'Gotham Pro Regular';
            opacity: 0.3;
            margin-top: 35px;
            color: #000000;

            -webkit-transition: opacity 0.25s;
            -moz-transition: opacity 0.25s;
            -o-transition: opacity 0.25s;
            transition: opacity 0.25s;
        }

        #denial:hover {
            opacity: 1;
        }

        @-webkit-keyframes animate {

            50% {
                -ms-transform: rotate(180deg);
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
            }

            100% {
                -ms-transform: rotate(0deg);
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

        }

        @keyframes animate {

            50% {
                -ms-transform: rotate(180deg);
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
            }

            100% {
                -ms-transform: rotate(0deg);
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }

        }
    </style>

    <script>
        $(window).on('load', function () {
            $("#loading-center").fadeOut(800, function () {
                $("#loading").fadeOut(1000);
            });
        });

        setCookie('agree', 'rules');

        function getCookie(name) {
            var matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }

        function setCookie(name, value, options) {
            options = options || {};

            var expires = options.expires;

            if (typeof expires == "number" && expires) {
                var d = new Date();
                d.setTime(d.getTime() + expires * 1000);
                expires = options.expires = d;
            }
            if (expires && expires.toUTCString) {
                options.expires = expires.toUTCString();
            }

            value = encodeURIComponent(value);

            var updatedCookie = name + "=" + value;

            for (var propName in options) {
                updatedCookie += "; " + propName;
                var propValue = options[propName];
                if (propValue !== true) {
                    updatedCookie += "=" + propValue;
                }
            }

            document.cookie = updatedCookie;
        }

        function showRules() {
            $('#rules').css({
                visibility: 'visible'
            }).animate({
                top: '30px',
                opacity: '1'
            }, 400)
        }

        function hideRules() {
            $.when(
                $('#rules').animate({
                    top: '20px',
                    opacity: '0'
                }, 400)
            ).then(function () {
                $(this).css({
                    visibility: 'hidden'
                });
            });
        }

        function query() {
            var emailInput = $('input[name=email]');
            var keyInput = $("input[name=key]");

            var email = emailInput.val();
            var key = keyInput.val();

            var request = "email=" + email + "&key=" + key + "&agree=" + getCookie('agree');

            if (key !== '' && getCookie('agree') == 'rules') {
                setCookie('agree', '');
                showRules();
            } else {
                $.ajax({
                    type: "POST",
                    url: "/",
                    data: "type=emailBetaAccess&" + request,
                    success: function (msg) {
                        switch (msg) {
                            case 'accessGranted':
                                $.then(
                                    location.reload()
                                );
                                break;
                            case 'incorrectEmail':
                                emailInput.attr('id', 'emailError');
                                break;
                            case 'keyRequest':
                                keyInput.animate({
                                    padding: '26px 20px 26px 90px',
                                    margin: '0 0 25px -230px',
                                    height: '10px'
                                }, 150);
                                $("input[type=submit]").val('Активировать доступ');
                                break;
                            case 'incorrectKey':
                                setCookie('agree', 'rules');
                                keyInput.attr('id', 'keyError');
                                break;
                            case 'keyDeleted':
                                $.then(
                                    location.reload()
                                );
                                break;
                        }
                    }
                });
            }
        }

        $(document).ready(function () {
            $('.scrollbar-inner').scrollbar();

            $("form").on('submit', function (event) {
                query();
                event.preventDefault();
            });

            $("#agree").on('click', function (event) {
                setCookie('agree', true);
                query();
                hideRules();
                event.preventDefault();
            });

            $("#denial").on('click', function (event) {
                setCookie('agree', '');
                query();
                hideRules();
                event.preventDefault();
            });
        });
    </script>
</head>
<body>
<div id="rules">
    <div class="rulesTitle">Соглашение о <span style="color: red;">неразглашении конфиденциальной информации</span> в
        ходе тестирования «LANT.IO»
    </div>
    <div class="rulesWrapper scrollbar-inner">
        <div class="rulesBody">
            В момент подачи заявки на участие в тестировании проекта, Вы соглашаетесь, что Вы прочитали, полностью
            поняли, приняли и согласились с условиями настоящего соглашения о неразглашении конфиденциальной информации
            и предоставлении лицензии для тестирования (далее – «Соглашение»).<br><br>
            Соглашение о неразглашении конфиденциальной информации и предоставлении лицензии для тестирования сайта
            «<strong>LANT.IO</strong>».<br><br>
            Компания предоставляет Вам ограниченную лицензию для тестирования сайта, доступ к сайту, включая обновления,
            документацию, доступ к конфиденциальным разделам сайта <strong>www.lant.io</strong> , другую
            конфиденциальную информацию, исключительно для Вашего личного использования, при условии соблюдения
            настоящего Соглашения.<br><br>
            Компания <strong>LANT.IO</strong>, именуемая в дальнейшем, в зависимости от контекста, «Раскрывающая
            сторона», «Компания», «мы», и допущенный к тестированию проекта «<strong>LANT.IO</strong>» (далее – «Сайт»
            или «Платформа») пользователь, именуемый в дальнейшем, в зависимости от контекста, «Получающая сторона»,
            «Пользователь», «Вы», «Я», далее совместно именуемые «Стороны», заключили настоящее Соглашение о
            нижеследующем:<br><br><br><br><br>


            <span style="color: red;">Я обязуюсь не разглашать информацию и сведения</span>, являющиеся
            конфиденциальными и ставшие мне известными в результате тестирования. В соответствии с настоящим
            Соглашением, Раскрывающая сторона предоставляет Получающей стороне определенную конфиденциальную информацию,
            ограниченную лицензию для тестирования Сайта, доступ к Сайту, включая обновления, документацию, доступ к
            конфиденциальным разделам сайта на условиях, описанных в данном Соглашении.<br><br>
            <span style="color: red;">Я предупрежден(а)</span>, что версия Сайта, доступ к которой предоставляется мне
            по настоящему Соглашению, содержит дефекты и основной целью предоставления мне данной лицензии для
            тестирования Сайта и конфиденциальной информации является получение от меня обратной связи по
            функционированию Сайта и выявление дефектов или проблем Сайта.<br><br>
            <span style="color: red;">Я предупрежден(а), что несу ответственность и обязательства</span> по защите
            конфиденциальной информации и персональных данных, обязуюсь соблюдать должную предусмотрительность и
            осторожность в использовании Сайта, не рассчитывать и не полагаться каким-либо образом на корректное
            функционирование Сайта и / или сопутствующих материалов.<br><br>
            <span style="color: red;">Я предупрежден(а)</span>, что в случае нарушения любых пунктов данного соглашения
            я буду лишён(а) всех выданных мне привилегий на сайте «LANT.IO», а также понесу наказание в соответствии
            нынешнего законодательства.<br><br>
        </div>
    </div>
    <div id="buttons">
        <a href="" id="agree">Принимаю условия</a>
        <a href="" id="denial">Отказ, анулирует ключ</a>
    </div>
</div>

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

<div id="logo"><img src="/template/images/access_logo_element.png" alt="access">lant.io</div>

<form action="" method="post" autocomplete="off">
    <input id="email" name="email" type="text" placeholder="Ваш email"><br>
    <input id="key" name="key" type="text" placeholder="Ключ доступа"><br>
    <input type="submit" name="submit" value="Войти">
</form>

<div id="link"><a
        href="https://docs.google.com/forms/d/e/1FAIpQLSdimqMUr3q4ruMuDQAXGec4wXeL56sS9V6nqKGvhY9YZXIoug/viewform?c=0&w=1"
        target="_blank">У меня нет доступа</a>
</div>

</body>
</html>