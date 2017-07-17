<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filters</title>
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/template/css/search_block/header/header.min.css">
    <link rel="stylesheet" href="/template/css/search_block/main_search/main_search.min.css">
    <link rel="stylesheet" href="/template/css/search_block/top_result/top_result.min.css">
    <link rel="stylesheet" href="/template/css/search_block/informationAboutOurService/informationAboutOurService.min.css">
    <link rel="stylesheet" href="/template/html/search/chosen.min.css">
    <link rel="stylesheet" href="/template/html/search/jquery.arcticmodal-0.3.css">
    <link rel="stylesheet" href="/template/html/search/search.min.css">
    <script src="/bower_components/handlebars/handlebars.runtime.min.js"></script>
    <script src="/bower_components/handlebars/handlebars.min.js"></script>
    <script id="show-more-information" type="text/x-handlebars-template">
        <div class="show-result-parametrs">
            <div class="left-information-block-apartment">
                <div class="carousel">
                    <img src="/uploads/images/{{preview_img}}" alt="apartment">
                    <ul class="apartments-wallpapers">
                        <li>
                            <a><img src="/uploads/images/{{preview_img}}" alt="partners"></a>
                        </li>
                        <li>
                            <a><img src="/uploads/images/{{preview_img}}" alt="partners"></a>
                        </li>
                        <li>
                            <a><img src="/uploads/images/{{preview_img}}" alt="partners"></a>
                        </li>
                        <li>
                            <a><img src="/uploads/images/{{preview_img}}" alt="partners"></a>
                        </li>
                        <li>
                            <a><img src="/uploads/images/{{preview_img}}" alt="partners"></a>
                        </li>
                    </ul>
                </div>
                <div class="small-description">
                    <span>{{title}}м<sup>2</sup></span>
                    <p class="apartment-description">{{content}}</p>
                </div>
                <div class="price-and-view-the-apartment">
                    <div class="price">
                        <span class="decorate-number">{{price}}
                            <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub>
                        </span>
                        <p>
                            <img src="/template/images/m.png" alt="metro">Рижская
                            <span><img src="/template/images/people-2.png" alt="people">{{distance_from_metro}}мин</span>
                        </p>
                    </div>
                </div>
                <div class="back-call">
                    <button class="back-call-web"><i class="fa fa-phone" aria-hidden="true"></i>Звонок через сайт</button>
                    <button class="back-call-message"><i class="fa fa-envelope" aria-hidden="true"></i>Написать сообщение</button>
                </div>
            </div>
            <div class="right-information-block-apartment">
                <p>Кол-во<br>комнат<span>{{number_of_rooms}}</span></p>
                <p>Этаж<span>{{object_located}}</span></p>
                <p>Безопасность<span>{{equipment}}</span></p>
                <p>Комплектация<span>Полная</span></p>
                <p>Высота<br>потолков<span>{{ceiling_height}}м</span></p>
                <p>Санузел<span>{{bathroom}}</span></p>
                <p>Жилая<br>площадь<span>{{resedential}}м<sup>2</sup></span></p>
                <p>Парковка(вок)<span>{{parking}}</span></p>
                <button>Смотреть полностью</button>
                <div class="private-person">
                    <div class="person-user">
                        <img src="/template/images/user-test.png" alt="user">
                        <span>Олег Герасимов</span>
                        <p>Олег Герасимов</p>
                    </div>
                    <div class="ad-close">
                        <p>Свернуть
                            <button class="open-close-ad">
                                <img src="/template/images/close.png" alt="clear">
                            </button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </script>
    <script id="entry-template" type="text/x-handlebars-template">
        <div class="top-block">
            <div class="left-wallpaper">
                <a href="#"><img src="/uploads/images/{{preview_img}}" alt="apartments"></a>
                <p>{{title}}м<sup>2</sup></p>
            </div>
            <div class="right-information-block">
                <span>Шикардосная двушка в самом центре столицы</span>
                <p>{{content}}</p>
                <div class="price-and-view-the-apartment">
                    <div class="price">
                        <p>
                            <img src="/template/images/m.png" alt="metro">Рижская<span>
                            <img src="/template/images/people.png" alt="">2 мин</span>
                        </p>
                        <span class="decorate-number">{{price}}
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
<div class="content">
    <?php include_once ROOT_DIR . '/template/html/search_page/header/header.php'?>
    <div class="search-and-filter">
        <div class="container-w-0">
        <?php include_once ROOT_DIR . '/template/html/search/search.php' ?><br><br><br><br>
            <?php /*include_once ROOT_DIR . '/template/html/search_page/main_search/main_search.php'*/?>
            <?php include_once ROOT_DIR . '/template/html/search_page/top_result/top_result.php'?>
            <?php include_once ROOT_DIR . '/template/html/search_page/informationAboutOurService/informationAboutOurService.php'?>
        </div>
    </div>
</div>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/template/js/jquery.formstyler.min.js"></script>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script src="/template/js/mapController.js"></script>
<script src="/template/js/jquery.bxslider.min.js"></script>
<script src="/template/js/search_page/main.js"></script>
<script src="/template/html/search/jquery.arcticmodal-0.3.min.js"></script>
<script src="/template/html/search/chosen.jquery.min.js"></script>
<script src="/template/html/search/jquery.tokeninput.js"></script>
<script src="/template/html/search/search.min.js"></script>
</body>
</html>
