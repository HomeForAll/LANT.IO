<?php
$siteModel = $this->model('SiteModel');
?>
<!doctype html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title><?php $this->title(); ?></title>
<link rel="icon" type="image/png" href="/template/favicon.png">
<link rel="shortcut icon" type="image/png" href="/template/favicon.png">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/template/css/main_page/main_search/main_search.min.css">
<link rel="stylesheet" href="/template/css/main.css">
</head>
<body>
<style type="text/css">
#hellopreloader > #hellopreloader_preload {
    position: fixed;z-index: 99999;
    top: 0;left: 0;right: 0;bottom: 0;
    width: 100vw;height: 100vh;
    background-color: #292d48;
    background: url('/template/images/puff.svg') center no-repeat,
    url('/template/images/access_background.jpg') center no-repeat;
    background-size: 123px, cover;
}
</style>
<div id="hellopreloader"><div id="hellopreloader_preload"></div></div>

<?php include_once ROOT_DIR . '/template/html/login/menu.html' ?>

<ul id="scene" style="display: none">
    <li class="layer" data-depth="0.20"><img src="/template/images/paralax/home-1.png"></li>
    <li class="layer" data-depth="0.40"><img src="/template/images/paralax/home-2.png"></li>
    <li class="layer" data-depth="0.40"><img src="/template/images/paralax/tree-l.png"></li>
    <li class="layer" data-depth="0.60"><img src="/template/images/paralax/tree-r.png"></li>
    <li class="layer" data-depth="0.80"><img src="/template/images/paralax/back-1.png"></li>
</ul>
<div id="fullpage" style="display: none">
    <div class="section" id="section-login">
        <?php include_once ROOT_DIR . '/template/html/login/login.html' ?>
    </div>
    <div class="section" id="section-search">
        <?php include_once ROOT_DIR . '/template/html/search/search.php' ?>
    </div>
    <div class="section" id="section-ads">
        <?php include_once ROOT_DIR . '/template/html/ads/ads.html' ?>
    </div>

    <div class="section" id="section-footer">
        <?php include_once ROOT_DIR . '/template/html/footer/footer.html' ?>
    </div>
</div>


<div class=content">



    <div class="section-home-with-filters">
    </div>

    <?php include_once ROOT_DIR . '/template/html/main_page/top_apartments/top_apartments.php' ?>


</div>


<script type="text/javascript">
    var hellopreloader = document.getElementById("hellopreloader_preload");
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
    document.getElementById('scene').style.display = "block";
    document.getElementById('fullpage').style.display = "block";
</script>

<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/template/js/jquery.parallax.min.js"></script>

<script src="/template/lucia/jquery.inputmask.bundle.min.js"></script>
<script src="/template/lucia/phone-codes/phone.min.js"></script>
<script src="/template/lucia/jquery.wizard.js"></script>
<script src="/template/lucia/jquery.arcticmodal-0.3.min.js"></script>
<script src="/template/lucia/chosen.jquery.min.js"></script>
<script src="/template/lucia/jquery.tokeninput.js"></script>
<script src="/template/lucia/jquery.fullPage.js"></script>
<script src="/template/lucia/jquery.scrollbar.js"></script>
<script src="/template/lucia/lucia.js"></script>

<script src="/template/html/index/index.js"></script>
<script src="/template/html/login/menu.js"></script>
<script src="/template/html/login/login.js"></script>
<script src="/template/html/search/search.js"></script>
<script src="/template/html/ads/ads.js"></script>


<script src="/template/js/main_page/main.js"></script>
<script src="/template/js/mainPageNewsAjax.js"></script>
</body>
</html>
