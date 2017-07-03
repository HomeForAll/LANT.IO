<?php
$siteModel = $this->model('SiteModel');
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title><?php $this->title(); ?></title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/template/css/jquery.formstyler.css">
<link rel="stylesheet" href="/template/css/jquery.bxslider.min.css">
<link rel="stylesheet" href="/template/css/main_page/fonts.min.css">
<link rel="stylesheet" href="/template/css/main_page/adaptive.min.css">
<link rel="stylesheet" href="/template/css/news_style.css">
<link rel="stylesheet" href="/template/css/main_page/capabilities/capabilities.min.css">
<link rel="stylesheet" href="/template/css/main_page/header/header.min.css">
<link rel="stylesheet" href="/template/css/main_page/footer/footer.min.css">
<link rel="stylesheet" href="/template/css/main_page/main_search/main_search.min.css">
<link rel="stylesheet" href="/template/css/main_page/main_statistic/main_statistic.min.css">
<link rel="stylesheet" href="/template/css/main_page/official_partners/official_partners.min.css">
<link rel="stylesheet" href="/template/css/main_page/search_in_the_app/search_in_the_app.min.css">
<link rel="stylesheet" href="/template/css/main_page/collective/сollective.min.css">
<link rel="stylesheet" href="/template/css/main_page/todays_announcements/todays_announcements.min.css">
<link rel="stylesheet" href="/template/css/main_page/top_apartments/top_apartments.min.css">
<link rel="stylesheet" href="/template/css/main_page/valuation/valuation.min.css">
<link rel="stylesheet" href="/template/css/main_page/main_search/main_search.min.css">
<link rel="stylesheet" href="/template/html/search/chosen.min.css">
<link rel="stylesheet" href="/template/html/search/jquery.arcticmodal-0.3.css">
<link rel="stylesheet" href="/template/html/search/search.min.css">
<script type="text/javascript" src="/template/js/socket.io.min.js"></script>
<?php
// Подключение стилей в контроллере
if (isset($this->data['css'])) {
    foreach ($this->data['css'] as $key => $value) {
        echo '<link rel="stylesheet"  href="/template/css/' . $value . '">' . "\r\n";
    }
}
?>
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
/*
var socket = io('http://91.202.180.160:8089?user_id=</*  ?php echo $user_id; ?>&hash=</*  ?php echo $hash; ?>');
socket.on('connect', function () {
    console.log('Соединение установлено.');
});
socket.on('message', function (data) {
    console.log('****************');
    console.log('* Принято собщение: ');
    console.log('*');
    console.log('* ' + data.message);
    console.log('****************');
});
socket.on('error', function (data) {
    console.log(data);
});
socket.on('disconnect', function () {
    console.log('Разрыв соединения.');
});
*/

/*$(window).on('load', function () {
 $("#loading-center").fadeOut(800, function () {
 $("#loading").fadeOut(1000);
 });
 });*/

function pressEnter(a) {
    a = a || window.event;
    if (a.keyCode === 13 || a.which === 13)
        a.preventDefault ? a.preventDefault() : a.returnValue = false
}




function displayOperation() {
    var subjectVal = $('#subject').val();
    var formOptions = $('#formOptions');
    var operation = $('#operation');
    var operationLabel = $('label[for=operation]');

    if (subjectVal === '') {
        formOptions.html('');
        operation.css({
            display: 'none'
        }).val('');
        operationLabel.css({
            display: 'none'
        });
    } else {
        operation.css({
            display: 'inline-block'
        });
        operationLabel.css({
            display: 'inline-block'
        });
    }
}

function changeForm() {
    var subjectVal = $('#subject').val();
    var operationVal = $('#operation').val();
    var formOptions = $('#formOptions');

    switch (operationVal) {
        case 'rent':
            switch (subjectVal) {
                case 'apartment':
                    formOptions.html(getRentApartHTML());
                    break;
                case 'house':
                    formOptions.html('');
                    break;
                case 'ground':
                    formOptions.html('');
                    break;
                case 'room':
                    formOptions.html('');
                    break;
                default:
                    formOptions.html('');
            }
            break;
        case 'buy':
            // TODO: Обработка отображение формы при покупке
            break;
        default:
            formOptions.html('');
    }
}


function getRegions() {
    $.ajax({
        type: "POST",
        url: "/search",
        data: "type=getRegions",
        success: function (data) {
            var regionsCursor = $("select[name=region]");
            regionsCursor.html("");
            var regions = JSON.parse(data);

            var html = "<option value=\"\" selected>---</option>";
            regions.forEach(function (region, i) {
                html += "<option value=\"" + region.region_id + "\">" + region.title + "</option>";
            });
            regionsCursor.html(html);
        }
    });
}


</script>
</head>
<body>
<!-- Header -->
<?php include_once ROOT_DIR . '/template/html/main_page/header/header.php' ?>
<!-- Content -->
<div class=content">
    <div class="main-message-block"></div>

    <ul id="scene">
        <li class="layer" data-depth="0.20"><img src="/template/images/paralax/home-1.png"></li>
        <li class="layer" data-depth="0.40"><img src="/template/images/paralax/home-2.png"></li>
        <li class="layer" data-depth="0.40"><img src="/template/images/paralax/tree-l.png"></li>
        <li class="layer" data-depth="0.60"><img src="/template/images/paralax/tree-r.png"></li>
        <li class="layer" data-depth="0.80"><img src="/template/images/paralax/back-1.png"></li>
    </ul>
    <div class="section-home-with-filters">
    <?php include_once ROOT_DIR . '/template/html/search/search.php' ?>
    </div>


    <?php //include_once ROOT_DIR . '/template/html/main_page/main_search/main_search.php' ?>
    <?php //include_once ROOT_DIR . '/template/html/main_page/capabilities/capabilities.php' ?>
    <?php //include_once ROOT_DIR . '/template/html/main_page/main_statistic/main_statistic.php' ?>
    <?php //include_once ROOT_DIR . '/template/html/main_page/valuation/valuation.php' ?>
    <?php include_once ROOT_DIR . '/template/html/main_page/top_apartments/top_apartments.php' ?>
    <?php //include_once ROOT_DIR . '/template/html/main_page/search_in_the_app/search_in_the_app.php' ?>
    <?php //include_once ROOT_DIR . '/template/html/main_page/collective/collective.php' ?>
    <?php include_once ROOT_DIR . '/template/html/main_page/footer/footer.php' ?>
</div>
<!-- Preloader -->

<!--<style type="text/css">#hellopreloader > #hellopreloader_preload {position: fixed;z-index: 99999;top: 0;left: 0;right: 0;bottom: 0;width: 100vw;height: 100vh;background: url('/template/images/puff.svg') center no-repeat, url('/template/images/access_background.jpg') center no-repeat;background-size: 123px, cover;
    }</style>
<div id="hellopreloader"><div id="hellopreloader_preload"></div></div>
<script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");
    function fadeOutnojquery(el) {
        el.style.opacity = 1;
        var interhellopreloader = setInterval(function () {
            el.style.opacity = el.style.opacity - 0.05;
            if (el.style.opacity <= 0.05) {
                clearInterval(interhellopreloader);
                hellopreloader.style.display = "none";
            }
        }, 16);
    }
    window.onload = function () {
        setTimeout(function () {
            fadeOutnojquery(hellopreloader);
        }, 1000);
    };
</script>-->

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!--<script src="/template/js/jquery.formstyler.min.js"></script>-->
<!--<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>-->
<!--<script src="/template/js/mapController.js"></script>-->
<script src="/template/js/jquery.bxslider.min.js"></script>
<script src="/template/js/jquery.parallax.min.js"></script>
<script src="/template/js/main_page/main.js"></script>
<script src="/template/html/search/jquery.arcticmodal-0.3.min.js"></script>
<script src="/template/html/search/chosen.jquery.min.js"></script>
<script src="/template/html/search/jquery.tokeninput.js"></script>
<script src="/template/html/search/search.min.js"></script>
<script src="/template/js/mainPageNewsAjax.js"></script>
</body>
</html>
