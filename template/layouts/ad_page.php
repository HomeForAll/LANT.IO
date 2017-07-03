<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ad page</title>
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/css/ad_page/fonts.min.css">
    <link rel="stylesheet" href="/template/js/ad_page/PgwSlideshow-master/pgwslideshow.css">
    <link rel="stylesheet" href="/template/js/ad_page/PgwSlideshow-master/pgwslideshow_light.min.css">
    <link rel="stylesheet" href="/template/css/search_block/header/header.min.css">
    <link rel="stylesheet" href="/template/css/ad_page/apartment_parameters/apartment_parameters.min.css">
    <link rel="stylesheet" href="/template/css/ad_page/top_today/top_today.min.css">
    <link rel="stylesheet" href="/template/css/ad_page/footer/footer.min.css">

    <script src="/bower_components/handlebars/handlebars.runtime.min.js"></script>
    <script src="/bower_components/handlebars/handlebars.min.js"></script>
    <script id="entry-template" type="text/x-handlebars-template">
        <div class="top-block">
            <div class="left-wallpaper">
                <!-- <a href="#"><img src="/uploads/images/{{preview_img}}" alt="apartments"></a> -->
                <a href="#"><img src="/template/images/apartments/1.png" alt="apartments"></a> <!-- {{preview_img}} -->
                <!-- <p>{{title}}м<sup>2</sup></p> -->
                <p>210м<sup>2</sup></p>
            </div>
            <div class="right-information-block">
                <span>Шикардосная двушка в самом центре столицы</span>
                <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                <!-- <p>{{content}}</p> -->
                <div class="price-and-view-the-apartment">
                    <div class="price">
                        <p>
                            <img src="/template/images/m.png" alt="metro">Рижская<span>
                            <img src="/template/images/people.png" alt="">2 мин</span>
                        </p>
                        <span class="decorate-number">15000 <!-- {{price}} -->
                            <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub>
                        </span>
                    </div>
                    <div class="view-the-apartment">
                        <button class="open-close-ad">
                            <img src="/template/images/show.png" alt="show">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </script>
</head>
<body>
<?php include_once ROOT_DIR . '/template/html/ad_page/header/header.php'?>
<div class="content">
    <div class="search-and-filter">
        <div class="container-w-0">
            <div class="main-ap">
                <?php include_once ROOT_DIR . '/template/html/ad_page/apartment_parameters/apartment_parameters.php'?>
            </div>
            <?php include_once ROOT_DIR . '/template/html/ad_page/top_today/top_today.php'?>
        </div>
        <?php include_once ROOT_DIR . '/template/html/footer.php'?>
    </div>
</div>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/template/js/ad_page/PgwSlideshow-master/pgwslideshow.min.js"></script>
<script src="/template/js/ad_page/main.min.js"></script>
</body>
</html>