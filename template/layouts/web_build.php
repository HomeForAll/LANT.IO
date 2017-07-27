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
<?php include_once ROOT_DIR . '/template/lucia/lucia.svg' ?>
<div class="ax-loading"></div>
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

</body>
</html>