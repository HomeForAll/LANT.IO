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
<?php include_once ROOT_DIR . '/template/lucia/lucia.svg' ?>
<div class="ax-loading"></div>
<!-- 
<div id="hellopreloader"><div id="hellopreloader_preload"></div></div> -->
<div id="page" style="display: none">

<?php include_once ROOT_DIR . '/template/html/login/menu.html' ?>

<ul id="scene">
    <li class="layer" data-depth="0.20"><img src="/template/images/paralax/home-1.png"></li>
    <li class="layer" data-depth="0.40"><img src="/template/images/paralax/home-2.png"></li>
    <li class="layer" data-depth="0.40"><img src="/template/images/paralax/tree-l.png"></li>
    <li class="layer" data-depth="0.60"><img src="/template/images/paralax/tree-r.png"></li>
    <li class="layer" data-depth="0.80"><img src="/template/images/paralax/back-1.png"></li>
</ul>
<div id="fullpage">
    <div class="section" id="section-login" data-anchor="sectionLogin">
        <?php include_once ROOT_DIR . '/template/html/login/login.html' ?>
    </div>
    <div class="section active" id="section-search" data-anchor="sectionSearch">

        <div class="header-line">
            <div class="ax-wrapper axf">
                <a href="/"><svg width="78px" height="35px"><use xlink:href="#logo-lantio" x="0" y="0"></use></svg></a>
                <div class="header-space"></div>
                <div>

                        <div class="axf user-info">
                            <div>
                                <div class="menu-user-name">...</div>
                                <div class="menu-user-status">Пользователь +</div>
                            </div>
                            <img src="/template/img/photo_dm.png" alt="">
                        </div>
                </div>
            </div>
        </div>


        <?php include_once ROOT_DIR . '/template/html/search/search.php' ?>
    </div>
    <div class="section" id="section-ads" data-anchor="sectionAds">
        <?php include_once ROOT_DIR . '/template/html/catalog-ads/catalog-ads.html' ?>
    </div>

    <div class="section" id="section-statistic" data-anchor="sectionStat">
        <?php include_once ROOT_DIR . '/template/html/statistic/statistic.html' ?>
    </div>

    <div class="section" id="section-footer" data-anchor="sectionFooter">
        <?php include_once ROOT_DIR . '/template/html/footer/footer.html' ?>
    </div>
</div>

</div>


<!--
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
 -->
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/template/lucia/vendor.js"></script>
<script src="/template/lucia/lucia.js"></script>

<script src="/template/html/index/index.js"></script>
<script src="/template/html/login/menu.js"></script>
<script src="/template/html/login/login.js"></script>
<script src="/template/html/search/search.js"></script>
<script src="/template/html/catalog-ads/catalog-ads.js"></script>
<script src="/template/html/statistic/statistic.js"></script>
<script src="/template/html/support_tickets/support_tickets.js"></script>


<!-- <script src="/template/js/main_page/main.js"></script> -->
<!-- <script src="/template/js/mainPageNewsAjax.js"></script> -->
</body>
</html>
