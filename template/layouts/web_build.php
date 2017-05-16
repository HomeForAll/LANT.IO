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
<!--    <link rel="stylesheet" href="/bower_components/n3-charts/build/lineChart.min.css">-->
    <link rel="stylesheet" href="/template/css/style.css">
    <link rel="stylesheet" href="/template/css/news_style.css">
<!--    <link rel="stylesheet" href="/template/css/graphics.css">-->
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
        var socket = io('http://91.202.180.160:8089?user_id=<?php echo $user_id; ?>&hash=<?php echo $hash; ?>');

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

        /*var rentApartMap = new MapController('rentApartMap', [55.753559, 37.609218], 'rentApartSuggest', {
         country: '#rentApartSpanCountry',
         area: '#rentApartSpanArea',
         city: '#rentApartSpanCity',
         region: '#rentApartSpanRegion',
         street: '#rentApartSpanStreet'
         });*/

        //    var map1 = new MapController('rentHouseMap', [55.753559, 37.609218], 'rentHouseSuggest', {
        //        country: '#rentApartSpanCountry',
        //        area: '#rentApartSpanArea',
        //        city: '#rentApartSpanCity',
        //        region: '#rentApartSpanRegion',
        //        street: '#rentApartSpanStreet'
        ////        house: '#house'
        //    });
        //
        //    var map2 = new MapController('rentGroundMap', [55.753559, 37.609218], 'rentGroundSuggest', {
        //        country: '#rentApartSpanCountry',
        //        area: '#rentApartSpanArea',
        //        city: '#rentApartSpanCity',
        //        region: '#rentApartSpanRegion',
        //        street: '#rentApartSpanStreet'
        ////        house: '#house'
        //    });
        //
        //    var map3 = new MapController('rentRoomMap', [55.753559, 37.609218], 'rentRoomSuggest', {
        //        country: '#rentApartSpanCountry',
        //        area: '#rentApartSpanArea',
        //        city: '#rentApartSpanCity',
        //        region: '#rentApartSpanRegion',
        //        street: '#rentApartSpanStreet'
        ////        house: '#house'
        //    });
        //
        //    var map4 = new MapController('sellApartMap', [55.753559, 37.609218], 'sellApartSuggest', {
        //        country: '#rentApartSpanCountry',
        //        area: '#rentApartSpanArea',
        //        city: '#rentApartSpanCity',
        //        region: '#rentApartSpanRegion',
        //        street: '#rentApartSpanStreet'
        ////        house: '#house'
        //    });
        //
        //    var map5 = new MapController('sellHouseMap', [55.753559, 37.609218], 'sellHouseSuggest', {
        //        country: '#rentApartSpanCountry',
        //        area: '#rentApartSpanArea',
        //        city: '#rentApartSpanCity',
        //        region: '#rentApartSpanRegion',
        //        street: '#rentApartSpanStreet'
        ////        house: '#house'
        //    });
        //
        //    var map6 = new MapController('sellGroundMap', [55.753559, 37.609218], 'sellGroundSuggest', {
        //        country: '#rentApartSpanCountry',
        //        area: '#rentApartSpanArea',
        //        city: '#rentApartSpanCity',
        //        region: '#rentApartSpanRegion',
        //        street: '#rentApartSpanStreet'
        ////        house: '#house'
        //    });
        //
        //    var map7 = new MapController('sellRoomMap', [55.753559, 37.609218], 'sellRoomSuggest', {
        //        country: '#rentApartSpanCountry',
        //        area: '#rentApartSpanArea',
        //        city: '#rentApartSpanCity',
        //        region: '#rentApartSpanRegion',
        //        street: '#rentApartSpanStreet'
        ////        house: '#house'
        //    });
        //
        //    var map = new MapController('map', [55.753559, 37.609218], 'search', {
        //        country: '#country',
        //        area: '#area',
        //        city: '#city',
        //        region: '#region',
        //        street: '#street'
        ////        house: '#house'
        //    });

        //    $(document).ready(function () {
        //        $('#mapForm').on('submit', function (event) {
        //            event.preventDefault();
        //            var inputVal = inputCur.val();
        //            map.get(inputVal);
        //        });
        //
        //        var inputCur = $('input');
        //
        //        inputCur.on('change', function () {
        //            var inputVal = inputCur.val();
        //            rentApartMap.get(inputVal);
        //        });
        //    });

        function displayOperation() {
            var subjectVal = $('#subject').val();
            var formOptions = $('#formOptions');
            var operation = $('#operation');
            var operationLabel = $('label[for=operation]');

            if (subjectVal == '') {
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

        function getRentApartHTML() {
            return '<fieldset> <legend>Базовые параметры</legend> <div style="margin: 15px"> Цена: <div class="indent"> Стоимость: <input name="minPrice" type="text" placeholder="Мин."> <input name="maxPrice" type="text" placeholder="Макс."><br> <label for="bargain">Торг:</label> <select name="bargain" id="bargain"> <option value=>---</option> <option value="yes">Возможен</option> <option>Не возможен</option> </select><br> <label for="rentType">Тип аренды:</label> <select name="rentType" id="rentType"> <option value=>---</option> <option value="hourRent">Часовая</option> <option value="dailyRent">Посуточная</option> <option value="longRent">Долгосрочная</option> </select> </div> Расположение: <br> <div class="indent"> <label for="region">Область:</label> <input type="text" name="region" id="region"><br> <label for="city">Город:</label> <input type="text" name="city" id="city"><br> <div class="indent"> <label for="district">Округ:</label> <input type="text" name="district" id="district"><br> <label for="area">Район:</label> <input type="text" name="area" id="area"><br> <label for="address">Адрес:</label> <input type="text" name="addressclassid="address"><br> </div> Станция метро: <br> <div class="indent"> Удаленность от метро: <input type="text" name="metroMin" placeholder="Мин."> <input type="text" name="metroMax" placeholder="Макс."><br> </div> </div> </div> </fieldset> <br><br> <fieldset> <legend>Описание объекта</legend> <div style="margin: 15px"> <strong>Квартира:</strong> <div class="indent"> <label for="roomsNumber">Количество комнат:</label> <select name="roomsNumber" id="roomsNumber" onchange=""> <option value=>---</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="more">4+</option> </select><br> Площадь: <input type="text" name="spaceMin" placeholder="От"> <input type="text" name="spaceMax" placeholder="До"><br> Этаж: <input type="text" name="floorMin" placeholder="От"> <input type="text" name="floorMax" placeholder="До"><br> <label for="equipment">Комплектация:</label> <select name="equipment" id="equipment"> <option value=>---</option> <option value="1">Укомплектована</option> <option>Пустая</option> </select><br> <label for="ceilingHeight">Высота потолков:</label> <input type="text" name="ceilingHeight" id="ceilingHeight"> </div> </div> <div style="margin: 15px"> <strong>Дом квартиры:</strong> <div class="indent"> <label for="houseType">Тип дома:</label> <select name="houseType" id="houseType" onchange=""> <option value=>---</option> <option value="1">Блочный</option> <option value="2">Брежневка</option> <option value="3">Индивидуальный</option> <option value="4">Кирпично-монолитный</option> <option value="5">Монолит</option> <option value="6">Панельный</option> <option value="7">Сталинка</option> <option value="8">Хрущевка</option> <option value="9">Серия дома</option> </select><br> <label for="houseFloorNumber">Количество этажей:</label> <input type="text" name="houseFloorNumber" id="houseFloorNumber"><br> <label for="lift">Лифт:</label> <select name="lift" id="lift" onchange=""> <option value=>---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="parking">Парковка:</label> <select name="parking" id="parking" onchange=""> <option value=>---</option> <option value="1">Подземная</option> <option value="2">Во дворе</option> <option value="2">Платная (неподалеку)</option> </select><br> Безопасность: <div class="indent"> <label for="concierge">Консьерж</label> <input type="checkbox" name="concierge" id="concierge"><br> <label for="security">Охрана</label> <input type="checkbox" name="security" id="security"><br> <label for="intercom">Домофон</label> <input type="checkbox" name="intercom" id="intercom"><br> <label for="CCTV">Видеонаблюдение</label> <input type="checkbox" name="CCTV" id="CCTV"><br> </div> <label for="chute">Мусоропровод:</label> <select name="chute" id="chute" onchange=""> <option value=>---</option> <option value="1">Да</option> <option value="2">Нет</option> </select><br> </div> <strong>Состав квартиры:</strong> <div class="indent"> Комнаты: <div class="indent"> <label for="bedroom">Спальня</label> <input type="checkbox" name="bedroom" id="bedroom"><br> <label for="kitchen">Кухня</label> <input type="checkbox" name="kitchen" id="kitchen"><br> <label for="livingRoom">Гостиная</label> <input type="checkbox" name="livingRoom" id="livingRoom"><br> <label for="hallway">Прихожая</label> <input type="checkbox" name="hallway" id="hallway"><br> <label for="nursery">Детская</label> <input type="checkbox" name="nursery" id="nursery"><br> <label for="study">Рабочий кабинет</label> <input type="checkbox" name="study" id="study"><br> <label for="canteen">Столовая</label> <input type="checkbox" name="canteen" id="canteen"><br> <label for="bathroom">Ванная</label> <input type="checkbox" name="bathroom" id="bathroom"><br> </div> Состояние квартиры: <div class="indent"> <label for="decoration">Отделка:</label> <select name="decoration" id="decoration"> <option value=>---</option> <option value="1">Да</option> <option value="0">Нет</option> </select> <select name="decorationValue"> <option value=>---</option> <option value="1">Люкс</option> <option value="0">Косметическая</option> </select><br> </div> <label for="lavatory">Санузел:</label> <select name="lavatory" id="lavatory"> <option value=>---</option> <option value="1">Совмещенный</option> <option value="0">Раздельный</option> </select><br> <label for="balcony">Обязательное наличие балкона</label> <input type="checkbox" name="balcony" id="balcony"><br> Жилищно-комунальные услуги: <div class="indent"> <label for="heating">Отопление</label> <input type="checkbox" name="heating" id="heating"><br> <label for="gas">Газ</label> <input type="checkbox" name="gas" id="gas"><br> <label for="electricity">Электричество</label> <input type="checkbox" name="electricity" id="electricity"><br> <label for="water">Водопровод</label> <input type="checkbox" name="water" id="water"><br> </div> Наполнение квартиры: <div class="indent"> Электроника для досуга и отдыха: <div class="indent"> <label for="TV">Телевизор</label> <input type="checkbox" name="TV" id="TV"><br> <label for="musicCenter">Музыкльный центр</label> <input type="checkbox" name="musicCenter" id="musicCenter"><br> <label for="conditioner">Кондиционер</label> <input type="checkbox" name="conditioner" id="conditioner"><br> </div> Бытовая техника: <div class="indent"> <label for="fridge">Холодильник</label> <input type="checkbox" name="fridge" id="fridge"><br> <label for="plate">Плита</label> <input type="checkbox" name="plate" id="plate"><br> <label for="bake">Печь</label> <input type="checkbox" name="bake" id="bake"><br> <label for="microwave">СВЧ</label> <input type="checkbox" name="microwave" id="microwave"><br> <label for="dishwasher">Посудомойка</label> <input type="checkbox" name="dishwasher" id="dishwasher"><br> </div> Мебель: <div class="indent"> <label for="table">Стол</label> <input type="checkbox" name="table" id="table"><br> <label for="bed">Кровать</label> <input type="checkbox" name="bed" id="bed"><br> <label for="cupboard">Шкаф</label> <input type="checkbox" name="cupboard" id="cupboard"><br> <label for="stand">Тумба</label> <input type="checkbox" name="stand" id="stand"><br> <label for="mirror">Зеркало</label> <input type="checkbox" name="mirror" id="mirror"><br> <label for="armchair">Кресло</label> <input type="checkbox" name="armchair" id="armchair"><br> <label for="sofa">Диван</label> <input type="checkbox" name="sofa" id="sofa"><br> </div> </div> </div> <strong>Вложения:</strong> <div class="indent"> <label for="plan">План квартиры:</label> <select name="plan" id="plan" onchange=""> <option value=>---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="3d">3D проект:</label> <select name="3d" id="3d" onchange=""> <option value=>---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="video">Видео:</label> <select name="video" id="video" onchange=""> <option value=>---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> </div> </div> </fieldset> <input style="margin-top: 20px" type="submit" name="extended" value="Найти">';
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

        function getCities(region_id) {
            $.ajax({
                type: "POST",
                url: "/search",
                data: "type=getCities&region_id=" + region_id,
                success: function (data) {
                    var citiesCursor = $("select[name=city]");
                    citiesCursor.html("");

                    var cities = JSON.parse(data);

                    var html = "<option value=\"\" selected>---</option>";
                    cities.forEach(function (citi, i) {
                        html += "<option value=\"" + citi.id + "\">" + citi.title + "</option>";
                    });
                    citiesCursor.html(html);
                }
            });
        }

        var timer;
        function getTimeout(delay, callback) {
            clearTimeout(timer);
            timer = setTimeout(function () {
                callback();
            }, delay);
        }

        function getGeoData(address) {
            var divCitiesCursor = $('#cities');

            getTimeout(1000, function () {
                $.ajax({
                    type: "POST",
                    url: "/search",
                    data: "type=getGeoData&address=" + address,
                    success: function (data) {
                        divCitiesCursor.html(data);
                    }
                });
            });
        }

        function getGeoCoderData(address, mapID) {
            getTimeout(1000, function () {
                rentApartMap.get(address, mapID);
            });
        }
    </script>
    <?php $this->head() ?>
</head>
<body>
<!-- Heeader -->
<?php include_once 'header.php' ?>
<!-- Content -->
<div id="content">
    <ul id="scene">
        <li class="layer" data-depth="0.20"><img src="../../template/images/paralax/home-1.png"></li>
        <li class="layer" data-depth="0.40"><img src="../../template/images/paralax/home-2.png"></li>
        <li class="layer" data-depth="0.40"><img src="../../template/images/paralax/tree-l.png"></li>
        <li class="layer" data-depth="0.60"><img src="../../template/images/paralax/tree-r.png"></li>
        <li class="layer" data-depth="0.80"><img src="../../template/images/paralax/back-1.png"></li>
    </ul>
    <div class="section-home-with-filters">
        <form action="/search" method="post" novalidate> <!--novalidate -->
            <div class="property-type-apartment-settings">
                <ul>
                    <li>Жилая</li>
                    <li onclick="allFilterBlocks('1');">
                    <img src="../../template/images/b-s-1.png" alt="icon">
                        <p>Квартира</p></li>
                    <li onclick="allFilterBlocks('2');">
                    <img src="../../template/images/b-s-2.png" alt="icon">
                        <p>Дом</p></li>
                    <li onclick="allFilterBlocks('3');">
                    <img src="../../template/images/b-s-3.png" alt="icon">
                        <p>Комната</p></li>
                    <li onclick="allFilterBlocks('7');">
                    <img src="../../template/images/b-s-4.png" alt="icon">
                        <p>Земельный участок</p></li>
                    <li onclick="allFilterBlocks('8');">
                    <img src="../../template/images/b-s-5.png" alt="icon">
                        <p>Гараж/машиноместо</p></li>
                </ul>
                <ul>
                    <li>Коммерческая</li>
                    <li onclick="allFilterBlocks('4');">
                    <img src="../../template/images/b-s-6.png" alt="icon">
                        <p>Офисная площадь</p></li>
                    <li onclick="allFilterBlocks('5');">
                    <img src="../../template/images/b-s-1.png" alt="icon">
                        <p>Отдельно стоящее здание</p></li>
                    <li onclick="allFilterBlocks('6');">
                    <img src="../../template/images/b-s-7.png" alt="icon">
                        <p>Комплекс ОСЗ</p></li>
                    <li onclick="allFilterBlocks('9');">
                    <img src="../../template/images/b-s-8.png" alt="icon">
                        <p>Рынок/Ярмарка</p></li>
                    <li onclick="allFilterBlocks('10');">
                    <img src="../../template/images/b-s-9.png" alt="icon">
                        <p>Производственно-складские помещения</p></li>
                    <li onclick="allFilterBlocks('11');">
                    <img src="../../template/images/b-s-10.png" alt="icon">
                        <p>Производственно-складские здания</p></li>
                    <li onclick="allFilterBlocks('12');">
                    <img src="../../template/images/b-s-11.png" alt="icon">
                        <p>Недвижимость для туризма и отдыха</p></li>
                </ul>
            </div>
            <div class="apartment-search">
                <ul class="vkl">
                    <li id="blockToRent" onclick="choiceBlock('toRent')"><a>Арендовать</a></li>
                    <li id="Buy" onclick="choiceBlock('Buy')"><a>Купить</a></li>
                </ul>
                <div class="search-menu-apartment">
                    <div class="decorativeShadowBlock"></div>
                    <div class="main-filter">
                        <div class="select">
                            <input type="text" id="address" name="address" placeholder="Москва, ул, Малая Ордынка" autocomplete="off" class="api-search-city">
                        </div>
                    </div>
                    <div class="main-filter" onclick="filterOptionsApartments()">
                        <span class="value-text">
                            <img src="../../template/images/apartments.png" alt="apartments">Тип недвижимости
                        </span>
                    </div>
                    <div class="main-filter" onclick="allParam('bigOption')">
                        <label><img src="../../template/images/s3.png" alt="price">Цена</label>
                        <div class="showBigOptions">
                            <p>От<label for="amountBeforeBy"><input name="price-min" type="text" id="amountBeforeBy" readonly disabled></label></p>
                            <p>До<label for="amountAfterBy"><input name="price-max" type="text" id="amountAfterBy" readonly disabled></label></p>
                            <div id="slider-range-buy"></div>
                            <div class="currency">
                                <p>Валюта</p>
                                <button class="closeCurrency"><i class="fa fa-rub" aria-hidden="true"></i>рубли</button>
                                <button class="closeCurrency"><i class="fa fa-usd" aria-hidden="true"></i>доллары
                                </button>
                                <button class="closeCurrency"><i class="fa fa-eur" aria-hidden="true"></i>евро</button>
                            </div>
                        </div>
                    </div>
                    <button>Найти</button>
                </div>
            </div>
            <div class="warning">
                <p>Выберите<br>тип недвижимости</p>
                <span>Чтобы перейти к заполнению подробных настроек</span>
                <button onclick="closeFixedBlock();">Закрыть</button>
            </div>
            <!-- Блок Купить -->
            <div class="big-search-menu">
                <div class="apartment-settings-apartment">
                    <h2>Исходные параметры квартиры</h2>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="number_of_rooms">Кол-во комнат
                                    <select class="number-apartments" name="number_of_rooms" id="number_of_rooms">
                                        <option value="">---</option>
                                        <option value="5">4+</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                            <p>От<input name="total-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="total-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Высота потолков</span>
                            <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Этаж</span>
                            <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li>
                            <div class="select">
                                <label for="lavatory">Санузел
                                    <select name="lavatory" id="lavatory">
                                        <option value="">---</option>
                                        <option value="41">Не важно</option>
                                        <option value="116">Раздельный</option>
                                        <option value="29">Совмещенный</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                    </ul>
                    <button class="closeBlock">Готово</button>
                </div>
                <div class="apartment-settings-home">
                    <h2>Параметры дома</h2>
                     <ul>
                         <li><span class="names-parameters">Кол-во комнат</span>
                             <p class="number-apartments">
                                 <span>1</span>
                                 <span>2</span>
                                 <span>3</span>
                                 <span>4</span>
                                 <span>4+</span>
                             </p>
                         </li>
                         <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                             <p>От<input name="total-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                             <p>До<input name="total-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                         </li>
                         <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                             <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                             <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                         </li>
                         <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                             <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                             <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                         </li>
                         <li><span class="names-parameters">Балкон м2</span>
                             <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                             <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                         </li>
                     </ul>
                     <ul>
                         <li>
                             <div class="select">
                                 <label for="0">
                                     <select name="0">
                                         <option value="">---</option>
                                         <option>Language</option>
                                         <option>English</option>
                                         <option>Spanish</option>
                                     </select>
                                 </label>
                             </div>
                         </li>
                         <li>
                             <div class="select">
                                 <label for="0">
                                     <select name="0">
                                         <option value="">---</option>
                                         <option>Language</option>
                                         <option>English</option>
                                         <option>Spanish</option>
                                     </select>
                                 </label>
                             </div>
                         </li>
                         <li><span class="names-parameters">Высота потолков м</span>
                             <p>От<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                             </p>
                             <p>До<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                             </p>
                         </li>
                     </ul>
                     <a>
                         <button>Готово</button>
                     </a>
                 </div>
                <div class="apartment-settings-room">
                     <h2>Параметры комнаты</h2>
                     <ul>
                         <li><span class="names-parameters">Кол-во комнат</span>
                             <p class="number-apartments">
                                 <span>1</span>
                                 <span>2</span>
                                 <span>3</span>
                                 <span>4</span>
                                 <span>4+</span>
                             </p>
                         </li>
                         <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                             <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                             <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                         </li>
                         <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                             <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                             <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                         </li>
                         <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                             <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                             <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                         </li>
                         <li><span class="names-parameters">Балкон м2</span>
                             <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                             <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                             </p>
                         </li>
                     </ul>
                     <ul>
                         <li>
                             <div class="select">
                                 <label for="0">
                                     <select name="0">
                                         <option value="">---</option>
                                         <option>Language</option>
                                         <option>English</option>
                                         <option>Spanish</option>
                                     </select>
                                 </label>
                             </div>
                         </li>
                         <li>
                             <div class="select">
                                 <label for="0">
                                     <select name="0">
                                         <option value="">---</option>
                                         <option>Language</option>
                                         <option>English</option>
                                         <option>Spanish</option>
                                     </select>
                                 </label>
                             </div>
                         </li>
                         <li><span class="names-parameters">Высота потолков м</span>
                             <p>От<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                             </p>
                             <p>До<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                             </p>
                         </li>
                     </ul>
                     <a>
                         <button>Готово</button>
                     </a>
                 </div>
                <div class="apartment-settings-office-area">
                    <h2>Офисная площадь</h2>
                    <ul>
                        <li><span class="names-parameters">Кол-во комнат</span>
                            <p class="number-apartments">
                                <span>1</span>
                                <span>2</span>
                                <span>3</span>
                                <span>4</span>
                                <span>4+</span>
                            </p>
                        </li>
                        <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select name="0">
                                        <option value="">---</option>
                                        <option>Language</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select name="0">
                                        <option value="">---</option>
                                        <option>Language</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                            </p>
                        </li>
                    </ul>
                    <a>
                        <button>Готово</button>
                    </a>
                </div>
                <div class="apartment-settings-separate-building"> <!-- name="0" -->
                    <h2>Отдельное стоящее здание</h2>
                    <ul>
                        <li><span class="names-parameters">Кол-во комнат</span>
                            <p class="number-apartments">
                                <span>1</span>
                                <span>2</span>
                                <span>3</span>
                                <span>4</span>
                                <span>4+</span>
                            </p>
                        </li>
                        <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select name="0">
                                        <option value="">---</option>
                                        <option>Language</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select name="0">
                                        <option value="">---</option>
                                        <option>Language</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                            </p>
                        </li>
                    </ul>
                    <a>
                        <button>Готово</button>
                    </a>
                </div>
                <div class="apartment-settings-ozs-сomplex">
                    <h2>Комплекс ОЗС</h2>
                    <ul>
                        <li><span class="names-parameters">Кол-во комнат</span>
                            <p class="number-apartments">
                                <span>1</span>
                                <span>2</span>
                                <span>3</span>
                                <span>4</span>
                                <span>4+</span>
                            </p>
                        </li>
                        <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select name="0">
                                        <option value="">---</option>
                                        <option>Language</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select name="0">
                                        <option value="">---</option>
                                        <option>Language</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                            </p>
                            <p>До<input name="0" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}">
                            </p>
                        </li>
                    </ul>
                    <a>
                        <button>Готово</button>
                    </a>
                </div>
                <div class="search-more-precisely-search">
                    <div class="exact-area">
                        <div class="history-search" onclick="allFilterBlocks('historySearch')">
                            <span class="search-city active-search">
                                <img src="../../template/images/s1.png" alt="city">
                                <input type="text" id="address" name="address" placeholder="Москва, ул, Малая Ордынка" autocomplete="off" class="api-search-city history-text">
                            </span>
                            <h5>История</h5>
                            <div class="all-history-search">
                                <div class="history">
                                    <img src="../../template/images/m-r.png" alt="metro">
                                    <p>Красные ворота<span>не более 15 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-w.png" alt="metro">
                                    <p>Свиблово, Бабушкинская<span>не более 5 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-w.png" alt="metro">
                                    <p>Академичекий<span>не более 5 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-r.png" alt="metro">
                                    <p>Красные ворота<span>не более 15 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-w.png" alt="metro">
                                    <p>Свиблово, Бабушкинская<span>не более 5 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-w.png" alt="metro">
                                    <p>Академичекий<span>не более 5 мин пешком</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="the-exact-address">
                        <span onclick="allFilterBlocks('searchMetroMainBlock')" class="location-metro-map">Третьяковская
                            <span class="metro-people">
                                <img src="../../template/images/people.png" alt="people">2мин.</span>
                        </span>
                        <div class="search-metro-main-block">
                            <div class="top-search-results">
                                <span>Свиблово<i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                            <div class="metro-location-and-travel-information">
                                <div class="metro-location">
                                    <div class="panel-move">
                                            <span onclick="moreAndLess('more')">
                                                <i class="fa fa-plus" aria-hidden="true"></i></span>
                                        <span onclick="moreAndLess('less')">
                                                <i class="fa fa-minus" aria-hidden="true"></i></span>
                                    </div>
                                    <img src="../../template/images/map-location-metro.png" alt="map">
                                </div>
                                <div class="travel-information">
                                    <div class="distance-on-foot">
                                        <img src="../../template/images/people-2.png" alt="icon"><p>Удаленность пекшом не более</p>
                                        <span><input type="number" name="foot" placeholder="5" value=""
                                                     max="60" step="5">
                                            <span class="timer">Минут</span></span>
                                    </div>
                                    <div class="distance-on-transport">
                                        <img src="../../template/images/avto.png" alt="icon"><p>Удаленность пекшом не более</p>
                                        <span><input type="number" name="transport" placeholder="5" value=""
                                                     max="60" step="5">
                                            <span class="timer">Минут</span></span>
                                    </div>
                                    <button class="closeSearchMetro">Готово</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button onclick="quickSearch(event)">Задать точнее</button>
                    <div class="quick-search">
                        <h5><i class="fa fa-map-marker" aria-hidden="true"></i>Введите город, район, область или точный адрес</h5>
                        <ul class="quick-search-by-parameters">
                            <li>
                                <div class="select">Область
                                    <label for="area">
                                        <input name="area" type="text" placeholder="Московская">
                                    </label>
                                </div>
                            <li>
                                <div class="select">Город
                                    <label for="city">
                                        <input name="city" type="text" placeholder="Москва">
                                    </label>
                                </div>
                            <li>
                                <div class="select">Округ
                                    <label for="region">
                                        <select name="region">
                                            <option value="">---</option>
                                            <option>Северо-западный</option>
                                            <option>Северо-западный</option>
                                            <option>Северо-западный</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Район
                                    <label for="district">
                                        <select name="district">
                                            <option value="">---</option>
                                            <option>Северное медведково</option>
                                            <option>Северное медведково</option>
                                            <option>Северное медведково</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Улица
                                    <label for="street">
                                        <select name="street">
                                            <option value="">---</option>
                                            <option>Ениивмасейская</option>
                                            <option>Ениивмасейская</option>
                                            <option>Ениивмасейская</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Дом
                                    <label for="house">
                                        <input name="house" type="text" placeholder="16" maxlength="4"
                                               pattern="[0-9]{4}">
                                    </label>
                                </div>
                            <li>
                                <div class="select">Метро
                                    <label for="metro_station">
                                        <select name="metro_station">
                                            <option value="">---</option>
                                            <option>Выбрано1</option>
                                            <option>Выбрано2</option>
                                            <option>Выбрано3</option>
                                            <option>Выбрано4</option>
                                            <option>Выбрано5</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Удаленность от метро не более
                                    <label for="distance_from_metro">
                                        <select name="distance_from_metro">
                                            <option value="">---</option>
                                            <option value="5">5 мин пешком</option>
                                            <option value="10">10 мин пешком</option>
                                            <option value="15">15 мин пешком</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <button class="closeQuickSearch">Готово</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <button>Найти</button>
                <ul class="filter-block-big-menu">
                    <li class="pointer" onclick="filterOptionsApartments()">
                        <span class="value-text">
                            <img src="../../template/images/apartments.png" alt="apartments">Тип недвижимости
                        </span>
                    </li>
                    <li onclick="allParam('bigOption')">
                        <label><img src="../../template/images/s3.png" alt="price">Цена</label>
                        <div class="showBigOptions">
                            <p>От<label for="amountBeforeSearch"><input name="price-min" type="text" id="amountBeforeSearch" readonly disabled></label></p>
                            <p>До<label for="amountAfterSearch"><input name="price-max" type="text" id="amountAfterSearch" readonly disabled></label></p>
                            <div id="slider-range-search"></div>
                            <div class="currency">
                                <p>Валюта</p>
                                <button class="closeCurrency"><i class="fa fa-rub" aria-hidden="true"></i>рубли</button>
                                <button class="closeCurrency"><i class="fa fa-usd" aria-hidden="true"></i>доллары</button>
                                <button class="closeCurrency"><i class="fa fa-eur" aria-hidden="true"></i>евро</button>
                            </div>
                        </div>
                        <div class="decorativeShadowBlock"></div>
                    </li>
                    <li>
                        <label for="clast">
                            <input name="bargain" id="clast" type="checkbox">Торг возможен
                        </label>
                    </li>
                    <li>
                        <div class="select"><img src="../../template/images/ava.png" alt="icons">
                            <label for="object_located">
                                <select name="object_located" id="object_located">
                                    <option value="">---</option>
                                    <option>Объект размещен</option>
                                    <option value="41">Не важно</option>
                                    <option value="22">Риэлтором</option>
                                    <option value="21">Собственником</option>
                                </select>
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="select">
                            <label for="lease">
                                <img src="../../template/images/timer.png" alt="icons">
                                <select name="lease" id="lease">
                                    <option value="">---</option>
                                    <option>Срок аренды</option>
                                    <option value="80">Более года</option>
                                    <option value="145">Год</option>
                                    <option value="79">Месяц</option>
                                    <option value="138">Неделя</option>
                                    <option value="37">День</option>
                                </select>
                            </label>
                        </div>
                    </li>
                </ul>
                <div class="advanced-search-options">
                    <p>Заполните параметры ниже, для более точного поиска</p>
                    <ul class="building-parameters-apartment">
                        <li onclick="allParam('apartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Исходные параметры квартиры
                            <div class="apartment-settings">
                                <h2>Исходные параметры квартиры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="number_of_rooms">Кол-во комнат
                                                <select class="number-apartments" name="number_of_rooms" id="number_of_rooms">
                                                    <option value="">---</option>
                                                    <option value="5">4+</option>
                                                    <option value="4">4</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                                        <p>От<input name="total-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="total-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Балкон м2</span>
                                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Высота потолков</span>
                                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Этаж</span>
                                        <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="lavatory">Санузел
                                                <select name="lavatory" id="lavatory">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="116">Раздельный</option>
                                                    <option value="29">Совмещенный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeBlock">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства квартиры
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства квартиры</h2>
                                <ul>
                                    <li>
                                        <p class="title-center">Комнаты</p>
                                        <label>Ванная<input type="checkbox" name="bathroom"></label>
                                        <label>Столовая<input type="checkbox" name="dining_room"></label>
                                        <label>Рабочий кабинет <input type="checkbox" name="study"></label>
                                        <label>Детская<input type="checkbox" name="playroom"></label>
                                        <label>Прихожая<input type="checkbox" name="hallway"></label>
                                        <label>Гостиная<input type="checkbox" name="living_room"></label>
                                        <label>Кухня<input type="checkbox" name="kitchen"></label>
                                        <label>Спальня<input type="checkbox" name="bedroom"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="141">Без ремонта</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="equipment">Комплектация
                                                <select name="equipment" id="equipment">
                                                    <option value="">---</option>
                                                    <option value="45">Укомплектованная</option>
                                                    <option value="44">Пустая</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('houseCharacteristics')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Характеристики дома
                            <div class="house-characteristics">
                                <h2>Характеристики дома</h2>
                                <ul>
                                    <li>
                                        <div class="select more-settings">
                                            <label for="elevator">Наличие лифта
                                                <select name="elevator" id="elevator">
                                                    <option value="">---</option>
                                                    <option value="1">Да</option>
                                                    <option value="0">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="elevator_yes">
                                                <select name="elevator_yes" id="elevator_yes">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="95">Пассажирский</option>
                                                    <option value="23">Грузовой</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"
                                                   placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"
                                                   placeholder="до">
                                        </label>
                                        <label>Наличие мусоропровода<input type="checkbox" name="availability_of_garbage_chute"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="146">Год постройки\окончания строительства</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="5">Отсутствует</option>
                                                    <option value="7">Придомовой гараж</option>
                                                    <option value="52">Гаражный комплекс</option>
                                                    <option value="132">Подземная парковка</option>
                                                    <option value="81">Многоуровневый паркинг</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="91">Другое</option>
                                                    <option value="32">Железобетонные панели</option>
                                                    <option value="78">Монолит</option>
                                                    <option value="19">Кирпич</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="stairwells_status">Состояние лестничных клеток
                                                <select name="stairwells_status" id="stairwells_status">
                                                    <option value="">---</option>
                                                    <option value="141">Без ремонта</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="134">Обычная отделка</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <p>Жилищно-коммунальные услуги</p>
                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>
                                        <label>Электричество <input type="checkbox" name="electricity"></label>
                                        <label>Газ <input type="checkbox" name="gas"></label>
                                        <label>Отопление <input type="checkbox" name="heating"></label>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:
                                            <input id="year_of_construction-min" name="year_of_construction-min"
                                                   type="text" placeholder="от">
                                            <input id="year_of_construction-max" name="year_of_construction-max"
                                                   type="text" placeholder="до">
                                        </label>
                                    </li>
                                </ul>
                                <button class="close-house-characteristics">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-home">
                        <li onclick="allParam('objectParameters')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Параметры объекта
                            <div class="object-parameters">
                                <h2>Параметры объекта</h2>
                                <ul>
                                    <li>
                                        <label for="residential-min">Жилая:
                                            <input id="residential-min" name="residential-min" type="text" placeholder="от">
                                            <input id="residential-max" name="residential-max" type="text" placeholder="до">
                                        </label>
                                        <label for="not_residential-min">Нежилая:
                                            <input id="not_residential-min" name="not_residential-min" type="text" placeholder="от">
                                            <input id="not_residential-max" name="not_residential-max" type="text" placeholder="до">
                                        </label>
                                        <label for="total-min">Общая:
                                            <input id="total-min" name="total-min" type="text" placeholder="от">
                                            <input id="total-max" name="total-max" type="text" placeholder="до">
                                        </label>
                                        <label for="balcony-min">Балкон:
                                            <input id="balcony-min" name="balcony-min" type="text" placeholder="от">
                                            <input id="balcony-max" name="balcony-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="number_of_rooms">Количество комнат
                                                <select name="number_of_rooms" id="number_of_rooms">
                                                    <option value="">---</option>
                                                    <option value="4">4+</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="number_of_rooms">Количество комнат
                                                <select name="number_of_rooms" id="number_of_rooms">
                                                    <option value="">---</option>
                                                    <option value="4">4+</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="number_of_floors-min">Количество этажей:</label>
                                        <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                        <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        <label for="ceiling_height-min">Высота потолков:</label>
                                        <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                        <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="lavatory">Санузел
                                                <select name="lavatory" id="lavatory">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="116">Раздельный</option>
                                                    <option value="29">Совмещенный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="roofing">Кровля
                                                <select name="roofing" id="roofing">
                                                    <option value="">---</option>
                                                    <option value="127">Временная</option>
                                                    <option value="118">Шифер</option>
                                                    <option value="122">Камень</option>
                                                    <option value="123">Солома</option>
                                                    <option value="129">Черепица</option>
                                                    <option value="76">Металлочерепица</option>
                                                    <option value="34">Медь</option>
                                                    <option value="67">Железо</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="foundation">Фундамент
                                                <select name="foundation" id="foundation">
                                                    <option value="">---</option>
                                                    <option value="140">Без фундамента</option>
                                                    <option value="58">Ростверк</option>
                                                    <option value="109">Ленточный</option>
                                                    <option value="125">Шведская плита</option>
                                                    <option value="120">Монолитная плита</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="49">Фахверк</option>
                                                    <option value="56">Клееный брус</option>
                                                    <option value="102">Профилированный брус</option>
                                                    <option value="112">Оцилиндрованное бревно</option>
                                                    <option value="24">Лафет</option>
                                                    <option value="27">Рубленое дерево</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="28">Шлакоблоки</option>
                                                    <option value="55">Газосиликатные блоки</option>
                                                    <option value="96">Пеноблок</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="19">Кирпич</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="type_of_house">Тип дома
                                                <select name="type_of_house" id="type_of_house">
                                                    <option value="">---</option>
                                                    <option value="35">Коттедж</option>
                                                    <option value="130">Таунхаус</option>
                                                    <option value="42">Дуплекс</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="close-object-parameters">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfHome')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства дома
                            <div class="repair-and-utilities-of-home">
                                <h2>Ремонт и обустройства дома</h2>
                                <ul>
                                    <li>
                                        <p class="title-center">Комнаты</p>
                                        <label>Ванная<input type="checkbox" name="bathroom"></label>
                                        <label>Столовая<input type="checkbox" name="dining_room"></label>
                                        <label>Рабочий кабинет <input type="checkbox" name="study"></label>
                                        <label>Детская<input type="checkbox" name="playroom"></label>
                                        <label>Прихожая<input type="checkbox" name="hallway"></label>
                                        <label>Гостиная<input type="checkbox" name="living_room"></label>
                                        <label>Кухня<input type="checkbox" name="kitchen"></label>
                                        <label>Спальня<input type="checkbox" name="bedroom"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="141">Без ремонта</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="equipment">Комплектация
                                                <select name="equipment" id="equipment">
                                                    <option value="">---</option>
                                                    <option value="45">Укомплектованная</option>
                                                    <option value="44">Пустая</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:
                                            <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                            <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <span>Жилищно-коммунальные услуги</span>
                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>
                                        <label>Электричество <input type="checkbox" name="electricity"></label>
                                        <label>Отопление <input type="checkbox" name="heating"></label>
                                        <label>Газ <input type="checkbox" name="gas"></label>
                                    </li>
                                    <li>
                                        <span>Безопасность</span>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-home">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('plotOfLand');">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-3.png" alt="search">Участок
                            <div class="plot-of-land">
                                <h2>Участок</h2>
                                <ul>
                                    <li>
                                        <div class="select">Участок
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="5">Отсутствует</option>
                                                    <option value="7">Придомовой гараж</option>
                                                    <option value="52">Гаражный комплекс</option>
                                                    <option value="132">Подземная парковка</option>
                                                    <option value="81">Многоуровневый паркинг</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">Дополнительные строения
                                            <label>Сторожка <input type="checkbox" name="lodge"></label>
                                            <label>Гостевой дом <input type="checkbox" name="guest_house"></label>
                                            <label>Баня <input type="checkbox" name="bath"></label>
                                            <label>Бассейн <input type="checkbox" name="swimming_pool"></label>
                                            <label>Детская площадка <input type="checkbox" name="playground"></label>
                                            <label>Винный погреб <input type="checkbox" name="wine_vault"></label>
                                            <label>Сарай <input type="checkbox" name="barn"></label>
                                            <label>Беседка <input type="checkbox" name="alcove"></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="site">Участок
                                                <select name="site" id="site">
                                                    <option value="">---</option>
                                                    <option value="136">Заболоченный</option>
                                                    <option value="103">Овраг</option>
                                                    <option value="89">На склоне</option>
                                                    <option value="133">Неровный</option>
                                                    <option value="119">Ровный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <p>На участке</p>
                                            <label>Берег водоема <input type="checkbox" name="waterfront"></label>
                                            <label>Река <input type="checkbox" name="river"></label>
                                            <label>Родник <input type="checkbox" name="spring"></label>
                                            <label>Садовые деревья <input type="checkbox" name="garden_trees"></label>
                                            <label>Лесные деревья <input type="checkbox" name="forest_trees"></label>
                                            <label>Ограждение <input type="checkbox" name="fencing"></label>
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="close-plot-of-land">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-room">
                        <li onclick="allParam('apartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Исходные параметры квартиры
                            <div class="apartment-settings">
                                <h2>Исходные параметры квартиры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="number_of_rooms">Кол-во комнат
                                                <select class="number-apartments" name="number_of_rooms" id="number_of_rooms">
                                                    <option value="">---</option>
                                                    <option value="5">4+</option>
                                                    <option value="4">4</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                                        <p>От<input name="total-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="total-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Балкон м2</span>
                                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Высота потолков</span>
                                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Этаж</span>
                                        <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="lavatory">Санузел
                                                <select name="lavatory" id="lavatory">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="116">Раздельный</option>
                                                    <option value="29">Совмещенный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeBlock">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('apperanceOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Внешний вид квартиры
                            <div class="appearance-of-the-apartment">
                                <h2>Внешний вид квартиры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="object_located">Объект размещен
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="22">Риэлтором</option>
                                                    <option value="21">Собственником</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="search">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('buildingParametersFilter');">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-3.png" alt="search">Параметры здания
                            <div class="building-parameters-filter">
                                <h2>Параметры здания</h2>
                                <ul>
                                    <li><span class="names-parameters">Количество этажей</span>
                                        <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}"
                                            ></p>
                                        <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}"
                                            ></p>
                                    </li>
                                    <li><span class="names-parameters">Год окончания строительства</span>
                                        <p>От<input name="0" type="text" placeholder="0" maxlength="4" pattern="[0-9]{4}"
                                            ></p>
                                        <p>До<input name="0" type="text" placeholder="0" maxlength="4" pattern="[0-9]{4}"
                                            ></p>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="0">
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option>Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="0">
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option>Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="0">
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option>Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="0">
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option>Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="close-building-parameter">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('appearanceBuild')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Исходные параметры
                            <div class="appearance-of-the-build">
                                <h2>Исходные параметры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="space-min">Площадь:</label>
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                            <label for="ceiling_height-min">Высота потолков:</label>
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                            <label for="number_of_floors-min">Количество этажей:
                                                <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                                <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                            </label>
                                            <label for="type_of_construction">Вид постройки:
                                                <select name="type_of_construction" id="type_of_construction">
                                                    <option value="">---</option>
                                                    <option value="111">Комнаты</option>
                                                    <option value="90">Опен спэйс</option>
                                                </select>
                                            </label>
                                            <label for="number_of_rooms-min">Количество комнат:
                                                <input id="number_of_rooms-min" name="number_of_rooms-min" type="text" placeholder="от">
                                                <input id="number_of_rooms-max" name="number_of_rooms-max" type="text" placeholder="до">
                                            </label>
                                            <label for="year_of_construction-min">Год постройки/окончания строительства:
                                                <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                                <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="building_type">Тип здания
                                                <select name="building_type" id="building_type">
                                                    <option value="">---</option>
                                                    <option value="108">Жилое</option>
                                                    <option value="8">Административное</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="roofing">Кровля
                                                <select name="roofing" id="roofing">
                                                    <option value="">---</option>
                                                    <option value="67">Железо</option>
                                                    <option value="34">Медь</option>
                                                    <option value="76">Металлочерепица</option>
                                                    <option value="113">Пескобетонная черепица</option>
                                                    <option value="129">Черепица</option>
                                                    <option value="123">Солома</option>
                                                    <option value="122">Камень</option>
                                                    <option value="118">Шифер</option>
                                                    <option value="88">Ондулин</option>
                                                    <option value="127">Временная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="foundation">Фундамент
                                                <select name="foundation" id="foundation">
                                                    <option value="">---</option>
                                                    <option value="120">Монолитная плита</option>
                                                    <option value="125">Шведская плита</option>
                                                    <option value="109">Ленточный</option>
                                                    <option value="58">Ростверк</option>
                                                    <option value="140">Без фундамента</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="49">Фахверк</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="78">Монолит</option>
                                                    <option value="96">Пеноблок</option>
                                                    <option value="55">Газосиликатные блоки</option>
                                                    <option value="28">Шлакоблоки</option>
                                                    <option value="27">Рубленое дерево</option>
                                                    <option value="24">Лафет</option>
                                                    <option value="112">Оцилиндрованное бревно</option>
                                                    <option value="102">Профилированный брус</option>
                                                    <option value="56">Клееный брус</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeApparenceBuild">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-office-area">
                        <li onclick="allParam('appearanceBuild')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Исходные параметры
                            <div class="appearance-of-the-build">
                                <h2>Исходные параметры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="space-min">Площадь:</label>
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                            <label for="ceiling_height-min">Высота потолков:</label>
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                            <label for="number_of_floors-min">Количество этажей:
                                                <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                                <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                            </label>
                                            <label for="type_of_construction">Вид постройки:
                                                <select name="type_of_construction" id="type_of_construction">
                                                    <option value="">---</option>
                                                    <option value="111">Комнаты</option>
                                                    <option value="90">Опен спэйс</option>
                                                </select>
                                            </label>
                                            <label for="number_of_rooms-min">Количество комнат:
                                                <input id="number_of_rooms-min" name="number_of_rooms-min" type="text" placeholder="от">
                                                <input id="number_of_rooms-max" name="number_of_rooms-max" type="text" placeholder="до">
                                            </label>
                                            <label for="year_of_construction-min">Год постройки/окончания строительства:
                                                <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                                <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="building_type">Тип здания
                                                <select name="building_type" id="building_type">
                                                    <option value="">---</option>
                                                    <option value="108">Жилое</option>
                                                    <option value="8">Административное</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="roofing">Кровля
                                                <select name="roofing" id="roofing">
                                                    <option value="">---</option>
                                                    <option value="67">Железо</option>
                                                    <option value="34">Медь</option>
                                                    <option value="76">Металлочерепица</option>
                                                    <option value="113">Пескобетонная черепица</option>
                                                    <option value="129">Черепица</option>
                                                    <option value="123">Солома</option>
                                                    <option value="122">Камень</option>
                                                    <option value="118">Шифер</option>
                                                    <option value="88">Ондулин</option>
                                                    <option value="127">Временная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="foundation">Фундамент
                                                <select name="foundation" id="foundation">
                                                    <option value="">---</option>
                                                    <option value="120">Монолитная плита</option>
                                                    <option value="125">Шведская плита</option>
                                                    <option value="109">Ленточный</option>
                                                    <option value="58">Ростверк</option>
                                                    <option value="140">Без фундамента</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="49">Фахверк</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="78">Монолит</option>
                                                    <option value="96">Пеноблок</option>
                                                    <option value="55">Газосиликатные блоки</option>
                                                    <option value="28">Шлакоблоки</option>
                                                    <option value="27">Рубленое дерево</option>
                                                    <option value="24">Лафет</option>
                                                    <option value="112">Оцилиндрованное бревно</option>
                                                    <option value="102">Профилированный брус</option>
                                                    <option value="56">Клееный брус</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeApparenceBuild">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-separate-building">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-ozs-сomplex">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <!--<li>
                                        <div class="select">
                                            <select value="name="bathroom_location" id="sanitation">
                                                <option value=>---</option>
                                            </select>
                                        </div>
                                    </li>-->
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-7">
                        <li onclick="allParam('mainSettings')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основные параметры
                            <div class="main-settings">
                                <h2>Основные параметры</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="59">Земли под размещение промышленных и коммерческих объектов</option>
                                                    <option value="9">Сельскохозяйственные земли</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="site">Участок
                                                <select name="site" id="site">
                                                    <option value="">---</option>
                                                    <option value="136">Заболоченный</option>
                                                    <option value="103">Овраг</option>
                                                    <option value="89">На склоне</option>
                                                    <option value="133">Неровный</option>
                                                    <option value="119">Ровный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p>На участке</p>
                                        <label>Берег водоема <input type="checkbox" name="waterfront"></label>
                                        <label>Река <input type="checkbox" name="river"></label>
                                        <label>Родник <input type="checkbox" name="spring"></label>
                                        <label>Садовые деревья <input type="checkbox" name="garden_trees"></label>
                                        <label>Лесные деревья <input type="checkbox" name="forest_trees"></label>
                                    </li>
                                </ul>
                                <button class="closeMainSettings">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('furnishing')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Обустройства
                            <div class="furnishing">
                                <h2>Обустройство</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="5">Отсутствует</option>
                                                    <option value="7">Придомовой гараж</option>
                                                    <option value="52">Гаражный комплекс</option>
                                                    <option value="132">Подземная парковка</option>
                                                    <option value="81">Многоуровневый паркинг</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p>Дополнительные строения</p>
                                        <label>Сторожка <input type="checkbox" name="lodge"></label>
                                        <label>Гостевой дом <input type="checkbox" name="guest_house"></label>
                                        <label>Баня <input type="checkbox" name="bath"></label>
                                        <label>Бассейн <input type="checkbox" name="swimming_pool"></label>
                                        <label>Детская площадка <input type="checkbox" name="playground"></label>
                                        <label>Винный погреб <input type="checkbox" name="wine_vault"></label>
                                        <label>Сарай <input type="checkbox" name="barn"></label>
                                        <label>Беседка <input type="checkbox" name="alcove"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p>Жилищно-коммунальные услуги</p>
                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>
                                        <label>Электричество <input type="checkbox" name="electricity"></label>
                                        <label>Отопление <input type="checkbox" name="heating"></label>
                                        <label>Газ <input type="checkbox" name="gas"></label>
                                    </li>
                                </ul>
                                <button class="closeFurnishing">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-8">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('additionallyAp')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Дополнительно
                            <div class="additionally-ap">
                                <h2>Дополнительно</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="roofing">Кровля
                                                <select name="roofing" id="roofing">
                                                    <option value="">---</option>
                                                    <option value="127">Временная</option>
                                                    <option value="118">Шифер</option>
                                                    <option value="122">Камень</option>
                                                    <option value="123">Солома</option>
                                                    <option value="129">Черепица</option>
                                                    <option value="76">Металлочерепица</option>
                                                    <option value="34">Медь</option>
                                                    <option value="67">Железо</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="foundation">Фундамент
                                                <select name="foundation" id="foundation">
                                                    <option value="">---</option>
                                                    <option value="140">Без фундамента</option>
                                                    <option value="58">Ростверк</option>
                                                    <option value="109">Ленточный</option>
                                                    <option value="125">Шведская плита</option>
                                                    <option value="120">Монолитная плита</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="49">Фахверк</option>
                                                    <option value="56">Клееный брус</option>
                                                    <option value="102">Профилированный брус</option>
                                                    <option value="112">Оцилиндрованное бревно</option>
                                                    <option value="24">Лафет</option>
                                                    <option value="27">Рубленое дерево</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="28">Шлакоблоки</option>
                                                    <option value="55">Газосиликатные блоки</option>
                                                    <option value="96">Пеноблок</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="19">Кирпич</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAdditionallyAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-9">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-10">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                   <!-- <li>
                                        <div class="select">
                                            <select value="name="bathroom_location" id="sanitation">
                                                <option value=>---</option>
                                            </select>
                                        </div>
                                    </li>-->
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-11">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">

                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-12">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-13">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-14">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки<input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание<input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <div id="map">
                        <input type="text" id="address" name="address" placeholder="Введите адрес..." autocomplete="off" class="api-search-city">
                        <button class="close-map">Закрыть карту</button>
                    </div>
                    <a onclick="allParam('map');" id="searchYandexMap">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>Поиск по карте</a>
                </div>
            </div>
            <!-- Блок Арендовать -->
            <div class="big-search-menu-tenancy">
                <div class="search-more-precisely-search">
                    <div class="exact-area">
                        <div class="history-search" onclick="allFilterBlocks('historySearch')">
                            <span class="search-city active-search">
                                <img src="../../template/images/s1.png" alt="city">
                                <input type="text" id="address" name="address" placeholder="Москва, ул, Малая Ордынка" autocomplete="off" class="api-search-city history-text">
                            </span>
                            <h5>История</h5>
                            <div class="all-history-search">
                                <div class="history">
                                    <img src="../../template/images/m-r.png" alt="metro">
                                    <p>Красные ворота<span>не более 15 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-w.png" alt="metro">
                                    <p>Свиблово, Бабушкинская<span>не более 5 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-w.png" alt="metro">
                                    <p>Академичекий<span>не более 5 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-r.png" alt="metro">
                                    <p>Красные ворота<span>не более 15 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-w.png" alt="metro">
                                    <p>Свиблово, Бабушкинская<span>не более 5 мин пешком</span></p>
                                </div>
                                <div class="history">
                                    <img src="../../template/images/m-w.png" alt="metro">
                                    <p>Академичекий<span>не более 5 мин пешком</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="the-exact-address">
                        <span onclick="allFilterBlocks('searchMetroMainBlock')" class="location-metro-map">Третьяковская
                            <span class="metro-people"><img src="../../template/images/people.png"
                                                            alt="people">2мин.</span>
                        </span>
                        <div class="search-metro-main-block">
                            <div class="top-search-results">
                                <span>Свиблово<i class="fa fa-times" aria-hidden="true"></i></span>
                            </div>
                            <div class="metro-location-and-travel-information">
                                <div class="metro-location">
                                    <div class="panel-move">
                                            <span onclick="moreAndLess('more')"><i class="fa fa-plus"
                                                                                   aria-hidden="true"></i></span>
                                        <span onclick="moreAndLess('less')"><i class="fa fa-minus"
                                                                               aria-hidden="true"></i></span>
                                    </div>
                                    <img src="../../template/images/map-location-metro.png" alt="map">
                                </div>
                                <div class="travel-information">
                                    <div class="distance-on-foot">
                                        <img src="../../template/images/people-2.png" alt="icon"><p>Уделенность пекшом не более</p>
                                        <span><input placeholder="5" type="number" name="foot" value=""
                                                     max="60" step="5"><span class="timer">Минут</span></span>
                                    </div>
                                    <div class="distance-on-transport">
                                        <img src="../../template/images/avto.png" alt="icon"><p>Уделенность пекшом не более</p>
                                        <span><input placeholder="5" type="number" name="transport" value=""
                                                     max="60" step="5"><span
                                                    class="timer">Минут</span></span>
                                    </div>
                                    <button class="closeSearchMetro">Готово</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button onclick="quickSearch(event)">Задать точнее</button>
                    <div class="quick-search">
                        <h5><i class="fa fa-map-marker" aria-hidden="true"></i>Введите город, район, область или точный адрес</h5>
                        <ul class="quick-search-by-parameters">
                            <li>
                                <div class="select">Область
                                    <label for="area">
                                        <input name="area" type="text" placeholder="Московская">
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Город
                                    <label for="city">
                                        <input name="city" type="text" placeholder="Москва">
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Район
                                    <label for="region">
                                        <select name="region">
                                            <option value="">---</option>
                                            <option>Северное медведково</option>
                                            <option>Северное медведково</option>
                                            <option>Северное медведково</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Дом
                                    <label for="house">
                                        <input name="house" type="text" placeholder="16" maxlength="4"
                                               pattern="[0-9]{4}">
                                    </label>
                                </div>
                            <li>
                                <div class="select">Метро
                                    <label for="metro_station">
                                        <select name="metro_station">
                                            <option value="">---</option>
                                            <option>Выбрано1</option>
                                            <option>Выбрано2</option>
                                            <option>Выбрано3</option>
                                            <option>Выбрано4</option>
                                            <option>Выбрано5</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Удаленность от метро не более
                                    <label for="distance_from_metro">
                                        <select name="distance_from_metro">
                                            <option value="">---</option>
                                            <option value="5">5 мин пешком</option>
                                            <option value="10">10 мин пешком</option>
                                            <option value="15">15 мин пешком</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <button class="closeQuickSearch">Готово</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <button>Найти</button>
                <ul class="filter-block-big-menu">
                    <li class="pointer" onclick="filterOptionsApartments()">
                        <span class="value-text">
                            <img src="../../template/images/apartments.png" alt="apartments">Тип недвижимости
                        </span>
                    </li>
                    <li onclick="allParam('bigOption')">

                        <label><img src="../../template/images/s3.png" alt="price">Цена</label>
                        <div class="showBigOptions">
                            <p>От<label for="amountBefore"><input name="price-min" type="text" id="amountBefore" readonly disabled></p>
                            <p>До<label for="amountAfter"><input name="price-max" type="text" id="amountAfter" readonly disabled></p>
                            <div id="slider-range"></div>
                            <div class="currency">
                                <p>Валюта</p>
                                <button class="closeCurrency"><i class="fa fa-rub" aria-hidden="true"></i>рубли</button>
                                <button class="closeCurrency"><i class="fa fa-usd" aria-hidden="true"></i>доллары
                                </button>
                                <button class="closeCurrency"><i class="fa fa-eur" aria-hidden="true"></i>евро</button>
                            </div>
                        </div>
                        <div class="decorativeShadowBlock"></div>
                    </li>
                    <li>
                        <label for="clast">
                            <input name="bargain" id="clast" type="checkbox">Торг возможен
                        </label>
                    </li>
                    <li>
                        <div class="select"><img src="../../template/images/ava.png" alt="icons">
                            <label for="object_located">
                                <select name="object_located" id="object_located">
                                    <option value="">---</option>
                                    <option>Объект размещен</option>
                                    <option value="41">Не важно</option>
                                    <option value="22">Риэлтором</option>
                                    <option value="21">Собственником</option>
                                </select>
                            </label>
                        </div>
                    </li>
                </ul>
                <div class="advanced-search-options">
                    <p>Заполните параметры ниже, для более точного поиска</p>
                    <ul class="building-parameters-apartment">
                        <li onclick="allParam('apartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Исходные параметры квартиры
                            <div class="apartment-settings">
                                <h2>Исходные параметры квартиры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="number_of_rooms">Кол-во комнат
                                                <select class="number-apartments" name="number_of_rooms" id="number_of_rooms">
                                                    <option value="">---</option>
                                                    <option value="5">4+</option>
                                                    <option value="4">4</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                                        <p>От<input name="total-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="total-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Балкон м2</span>
                                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Высота потолков</span>
                                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Этаж</span>
                                        <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="lavatory">Санузел
                                                <select name="lavatory" id="lavatory">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="116">Раздельный</option>
                                                    <option value="29">Совмещенный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeBlock">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства квартиры
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства квартиры</h2>
                                <ul>
                                    <li>
                                        <p class="title-center">Комнаты</p>
                                        <label>Ванная<input type="checkbox" name="bathroom"></label>
                                        <label>Столовая<input type="checkbox" name="dining_room"></label>
                                        <label>Рабочий кабинет <input type="checkbox" name="study"></label>
                                        <label>Детская<input type="checkbox" name="playroom"></label>
                                        <label>Прихожая<input type="checkbox" name="hallway"></label>
                                        <label>Гостиная<input type="checkbox" name="living_room"></label>
                                        <label>Кухня<input type="checkbox" name="kitchen"></label>
                                        <label>Спальня<input type="checkbox" name="bedroom"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="141">Без ремонта</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="equipment">Комплектация
                                                <select name="equipment" id="equipment">
                                                    <option value="">---</option>
                                                    <option value="45">Укомплектованная</option>
                                                    <option value="44">Пустая</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('houseCharacteristics')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Характеристики дома
                            <div class="house-characteristics">
                                <h2>Характеристики дома</h2>
                                <ul>
                                    <li>
                                        <div class="select more-settings">
                                            <label for="elevator">Наличие лифта
                                                <select name="elevator" id="elevator">
                                                    <option value="">---</option>
                                                    <option value="1">Да</option>
                                                    <option value="0">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="elevator_yes">
                                                <select name="elevator_yes" id="elevator_yes">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="95">Пассажирский</option>
                                                    <option value="23">Грузовой</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"
                                                   placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"
                                                   placeholder="до">
                                        </label>
                                        <label>Наличие мусоропровода<input type="checkbox" name="availability_of_garbage_chute"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="146">Год постройки\окончания строительства</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="5">Отсутствует</option>
                                                    <option value="7">Придомовой гараж</option>
                                                    <option value="52">Гаражный комплекс</option>
                                                    <option value="132">Подземная парковка</option>
                                                    <option value="81">Многоуровневый паркинг</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="91">Другое</option>
                                                    <option value="32">Железобетонные панели</option>
                                                    <option value="78">Монолит</option>
                                                    <option value="19">Кирпич</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="stairwells_status">Состояние лестничных клеток
                                                <select name="stairwells_status" id="stairwells_status">
                                                    <option value="">---</option>
                                                    <option value="141">Без ремонта</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="134">Обычная отделка</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <p>Жилищно-коммунальные услуги</p>
                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>
                                        <label>Электричество <input type="checkbox" name="electricity"></label>
                                        <label>Газ <input type="checkbox" name="gas"></label>
                                        <label>Отопление <input type="checkbox" name="heating"></label>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:
                                            <input id="year_of_construction-min" name="year_of_construction-min"
                                                   type="text" placeholder="от">
                                            <input id="year_of_construction-max" name="year_of_construction-max"
                                                   type="text" placeholder="до">
                                        </label>
                                    </li>
                                </ul>
                                <button class="close-house-characteristics">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-home">
                        <li onclick="allParam('objectParameters')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Параметры объекта
                            <div class="object-parameters">
                                <h2>Параметры объекта</h2>
                                <ul>
                                    <li>
                                        <label for="residential-min">Жилая:
                                            <input id="residential-min" name="residential-min" type="text" placeholder="от">
                                            <input id="residential-max" name="residential-max" type="text" placeholder="до">
                                        </label>
                                        <label for="not_residential-min">Нежилая:
                                            <input id="not_residential-min" name="not_residential-min" type="text" placeholder="от">
                                            <input id="not_residential-max" name="not_residential-max" type="text" placeholder="до">
                                        </label>
                                        <label for="total-min">Общая:
                                            <input id="total-min" name="total-min" type="text" placeholder="от">
                                            <input id="total-max" name="total-max" type="text" placeholder="до">
                                        </label>
                                        <label for="balcony-min">Балкон:
                                            <input id="balcony-min" name="balcony-min" type="text" placeholder="от">
                                            <input id="balcony-max" name="balcony-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="number_of_rooms">Количество комнат
                                                <select name="number_of_rooms" id="number_of_rooms">
                                                    <option value="">---</option>
                                                    <option value="4">4+</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="number_of_rooms">Количество комнат
                                                <select name="number_of_rooms" id="number_of_rooms">
                                                    <option value="">---</option>
                                                    <option value="4">4+</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="number_of_floors-min">Количество этажей:</label>
                                        <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                        <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        <label for="ceiling_height-min">Высота потолков:</label>
                                        <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                        <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="lavatory">Санузел
                                                <select name="lavatory" id="lavatory">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="116">Раздельный</option>
                                                    <option value="29">Совмещенный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="roofing">Кровля
                                                <select name="roofing" id="roofing">
                                                    <option value="">---</option>
                                                    <option value="127">Временная</option>
                                                    <option value="118">Шифер</option>
                                                    <option value="122">Камень</option>
                                                    <option value="123">Солома</option>
                                                    <option value="129">Черепица</option>
                                                    <option value="76">Металлочерепица</option>
                                                    <option value="34">Медь</option>
                                                    <option value="67">Железо</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="foundation">Фундамент
                                                <select name="foundation" id="foundation">
                                                    <option value="">---</option>
                                                    <option value="140">Без фундамента</option>
                                                    <option value="58">Ростверк</option>
                                                    <option value="109">Ленточный</option>
                                                    <option value="125">Шведская плита</option>
                                                    <option value="120">Монолитная плита</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="49">Фахверк</option>
                                                    <option value="56">Клееный брус</option>
                                                    <option value="102">Профилированный брус</option>
                                                    <option value="112">Оцилиндрованное бревно</option>
                                                    <option value="24">Лафет</option>
                                                    <option value="27">Рубленое дерево</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="28">Шлакоблоки</option>
                                                    <option value="55">Газосиликатные блоки</option>
                                                    <option value="96">Пеноблок</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="19">Кирпич</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="type_of_house">Тип дома
                                                <select name="type_of_house" id="type_of_house">
                                                    <option value="">---</option>
                                                    <option value="35">Коттедж</option>
                                                    <option value="130">Таунхаус</option>
                                                    <option value="42">Дуплекс</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="close-object-parameters">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfHome')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства дома
                            <div class="repair-and-utilities-of-home">
                                <h2>Ремонт и обустройства дома</h2>
                                <ul>
                                    <li>
                                        <p class="title-center">Комнаты</p>
                                        <label>Ванная<input type="checkbox" name="bathroom"></label>
                                        <label>Столовая<input type="checkbox" name="dining_room"></label>
                                        <label>Рабочий кабинет <input type="checkbox" name="study"></label>
                                        <label>Детская<input type="checkbox" name="playroom"></label>
                                        <label>Прихожая<input type="checkbox" name="hallway"></label>
                                        <label>Гостиная<input type="checkbox" name="living_room"></label>
                                        <label>Кухня<input type="checkbox" name="kitchen"></label>
                                        <label>Спальня<input type="checkbox" name="bedroom"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="141">Без ремонта</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="equipment">Комплектация
                                                <select name="equipment" id="equipment">
                                                    <option value="">---</option>
                                                    <option value="45">Укомплектованная</option>
                                                    <option value="44">Пустая</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:
                                            <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                            <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <span>Жилищно-коммунальные услуги</span>
                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>
                                        <label>Электричество <input type="checkbox" name="electricity"></label>
                                        <label>Отопление <input type="checkbox" name="heating"></label>
                                        <label>Газ <input type="checkbox" name="gas"></label>
                                    </li>
                                    <li>
                                        <span>Безопасность</span>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-home">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('plotOfLand');">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-3.png" alt="search">Участок
                            <div class="plot-of-land">
                                <h2>Участок</h2>
                                <ul>
                                    <li>
                                        <div class="select">Участок
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="5">Отсутствует</option>
                                                    <option value="7">Придомовой гараж</option>
                                                    <option value="52">Гаражный комплекс</option>
                                                    <option value="132">Подземная парковка</option>
                                                    <option value="81">Многоуровневый паркинг</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">Дополнительные строения
                                            <label>Сторожка <input type="checkbox" name="lodge"></label>
                                            <label>Гостевой дом <input type="checkbox" name="guest_house"></label>
                                            <label>Баня <input type="checkbox" name="bath"></label>
                                            <label>Бассейн <input type="checkbox" name="swimming_pool"></label>
                                            <label>Детская площадка <input type="checkbox" name="playground"></label>
                                            <label>Винный погреб <input type="checkbox" name="wine_vault"></label>
                                            <label>Сарай <input type="checkbox" name="barn"></label>
                                            <label>Беседка <input type="checkbox" name="alcove"></label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="site">Участок
                                                <select name="site" id="site">
                                                    <option value="">---</option>
                                                    <option value="136">Заболоченный</option>
                                                    <option value="103">Овраг</option>
                                                    <option value="89">На склоне</option>
                                                    <option value="133">Неровный</option>
                                                    <option value="119">Ровный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <p>На участке</p>
                                            <label>Берег водоема <input type="checkbox" name="waterfront"></label>
                                            <label>Река <input type="checkbox" name="river"></label>
                                            <label>Родник <input type="checkbox" name="spring"></label>
                                            <label>Садовые деревья <input type="checkbox" name="garden_trees"></label>
                                            <label>Лесные деревья <input type="checkbox" name="forest_trees"></label>
                                            <label>Ограждение <input type="checkbox" name="fencing"></label>
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="close-plot-of-land">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-room">
                        <li onclick="allParam('apartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Исходные параметры квартиры
                            <div class="apartment-settings">
                                <h2>Исходные параметры квартиры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="number_of_rooms">Кол-во комнат
                                                <select class="number-apartments" name="number_of_rooms" id="number_of_rooms">
                                                    <option value="">---</option>
                                                    <option value="5">4+</option>
                                                    <option value="4">4</option>
                                                    <option value="3">3</option>
                                                    <option value="2">2</option>
                                                    <option value="1">1</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>
                                        <p>От<input name="total-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="total-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Балкон м2</span>
                                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Высота потолков</span>
                                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li><span class="names-parameters">Этаж</span>
                                        <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                        <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                                        </p>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="lavatory">Санузел
                                                <select name="lavatory" id="lavatory">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="116">Раздельный</option>
                                                    <option value="29">Совмещенный</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeBlock">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('apperanceOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Внешний вид квартиры
                            <div class="appearance-of-the-apartment">
                                <h2>Внешний вид квартиры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="object_located">Объект размещен
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="22">Риэлтором</option>
                                                    <option value="21">Собственником</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="search">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('buildingParametersFilter');">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-3.png" alt="search">Параметры здания
                            <div class="building-parameters-filter">
                                <h2>Параметры здания</h2>
                                <ul>
                                    <li><span class="names-parameters">Количество этажей</span>
                                        <p>От<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}"
                                            ></p>
                                        <p>До<input name="0" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}"
                                            ></p>
                                    </li>
                                    <li><span class="names-parameters">Год окончания строительства</span>
                                        <p>От<input name="0" type="text" placeholder="0" maxlength="4" pattern="[0-9]{4}"
                                            ></p>
                                        <p>До<input name="0" type="text" placeholder="0" maxlength="4" pattern="[0-9]{4}"
                                            ></p>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="">
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option>Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="">
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option>Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="">
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option>Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="">
                                                <select name="0">
                                                    <option value="">---</option>
                                                    <option>Language</option>
                                                    <option>English</option>
                                                    <option>Spanish</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="close-building-parameter">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('appearanceBuild')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Исходные параметры
                            <div class="appearance-of-the-build">
                                <h2>Исходные параметры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="space-min">Площадь:</label>
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                            <label for="ceiling_height-min">Высота потолков:</label>
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                            <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                            <label for="type_of_construction">Вид постройки:
                                                <select name="type_of_construction" id="type_of_construction">
                                                    <option value="">---</option>
                                                    <option value="111">Комнаты</option>
                                                    <option value="90">Опен спэйс</option>
                                                </select>
                                            </label>
                                            <label for="number_of_rooms-min">Количество комнат:
                                                <input id="number_of_rooms-min" name="number_of_rooms-min" type="text" placeholder="от">
                                                <input id="number_of_rooms-max" name="number_of_rooms-max" type="text" placeholder="до">
                                            </label>
                                            <label for="year_of_construction-min">Год постройки/окончания строительства:
                                                <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                                <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="building_type">Тип здания
                                                <select name="building_type" id="building_type">
                                                    <option value="">---</option>
                                                    <option value="108">Жилое</option>
                                                    <option value="8">Административное</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="roofing">Кровля
                                                <select name="roofing" id="roofing">
                                                    <option value="">---</option>
                                                    <option value="67">Железо</option>
                                                    <option value="34">Медь</option>
                                                    <option value="76">Металлочерепица</option>
                                                    <option value="113">Пескобетонная черепица</option>
                                                    <option value="129">Черепица</option>
                                                    <option value="123">Солома</option>
                                                    <option value="122">Камень</option>
                                                    <option value="118">Шифер</option>
                                                    <option value="88">Ондулин</option>
                                                    <option value="127">Временная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="foundation">Фундамент
                                                <select name="foundation" id="foundation">
                                                    <option value="">---</option>
                                                    <option value="120">Монолитная плита</option>
                                                    <option value="125">Шведская плита</option>
                                                    <option value="109">Ленточный</option>
                                                    <option value="58">Ростверк</option>
                                                    <option value="140">Без фундамента</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="49">Фахверк</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="78">Монолит</option>
                                                    <option value="96">Пеноблок</option>
                                                    <option value="55">Газосиликатные блоки</option>
                                                    <option value="28">Шлакоблоки</option>
                                                    <option value="27">Рубленое дерево</option>
                                                    <option value="24">Лафет</option>
                                                    <option value="112">Оцилиндрованное бревно</option>
                                                    <option value="102">Профилированный брус</option>
                                                    <option value="56">Клееный брус</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeApparenceBuild">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-office-area">
                        <li onclick="allParam('appearanceBuild')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Исходные параметры
                            <div class="appearance-of-the-build">
                                <h2>Исходные параметры</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="space-min">Площадь:</label>
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                            <label for="ceiling_height-min">Высота потолков:</label>
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                            <label for="number_of_floors-min">Количество этажей:
                                                <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                                <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                            </label>
                                            <label for="type_of_construction">Вид постройки:
                                                <select name="type_of_construction" id="type_of_construction">
                                                    <option value="">---</option>
                                                    <option value="111">Комнаты</option>
                                                    <option value="90">Опен спэйс</option>
                                                </select>
                                            </label>
                                            <label for="number_of_rooms-min">Количество комнат:
                                                <input id="number_of_rooms-min" name="number_of_rooms-min" type="text" placeholder="от">
                                                <input id="number_of_rooms-max" name="number_of_rooms-max" type="text" placeholder="до">
                                            </label>
                                            <label for="year_of_construction-min">Год постройки/окончания строительства:
                                                <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                                <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="building_type">Тип здания
                                                <select name="building_type" id="building_type">
                                                    <option value="">---</option>
                                                    <option value="108">Жилое</option>
                                                    <option value="8">Административное</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="roofing">Кровля
                                                <select name="roofing" id="roofing">
                                                    <option value="">---</option>
                                                    <option value="67">Железо</option>
                                                    <option value="34">Медь</option>
                                                    <option value="76">Металлочерепица</option>
                                                    <option value="113">Пескобетонная черепица</option>
                                                    <option value="129">Черепица</option>
                                                    <option value="123">Солома</option>
                                                    <option value="122">Камень</option>
                                                    <option value="118">Шифер</option>
                                                    <option value="88">Ондулин</option>
                                                    <option value="127">Временная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="foundation">Фундамент
                                                <select name="foundation" id="foundation">
                                                    <option value="">---</option>
                                                    <option value="120">Монолитная плита</option>
                                                    <option value="125">Шведская плита</option>
                                                    <option value="109">Ленточный</option>
                                                    <option value="58">Ростверк</option>
                                                    <option value="140">Без фундамента</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="wall_material">Материал стен
                                                <select name="wall_material" id="wall_material">
                                                    <option value="">---</option>
                                                    <option value="49">Фахверк</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="105">Железобетон</option>
                                                    <option value="78">Монолит</option>
                                                    <option value="96">Пеноблок</option>
                                                    <option value="55">Газосиликатные блоки</option>
                                                    <option value="28">Шлакоблоки</option>
                                                    <option value="27">Рубленое дерево</option>
                                                    <option value="24">Лафет</option>
                                                    <option value="112">Оцилиндрованное бревно</option>
                                                    <option value="102">Профилированный брус</option>
                                                    <option value="56">Клееный брус</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeApparenceBuild">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="building-parameters-separate-building">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                     </ul>
                    <ul class="building-parameters-ozs-сomplex">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                     </ul>
                    <ul class="test-7">
                         <li onclick="allParam('mainSettings')">
                             <div class="progress-bar blue stripes">
                                 <span style="width:40%"></span>
                             </div>
                             <img src="../../template/images/search-1.png" alt="search">Основные параметры
                             <div class="main-settings">
                                 <h2>Основные параметры</h2>
                                 <ul>
                                     <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                     </li>
                                     <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="59">Земли под размещение промышленных и коммерческих объектов</option>
                                                    <option value="9">Сельскохозяйственные земли</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                </select>
                                            </label>
                                        </div>
                                     </li>
                                     <li>
                                         <div class="select">
                                             <label for="site">Участок
                                                <select name="site" id="site">
                                                    <option value="">---</option>
                                                    <option value="136">Заболоченный</option>
                                                    <option value="103">Овраг</option>
                                                    <option value="89">На склоне</option>
                                                    <option value="133">Неровный</option>
                                                    <option value="119">Ровный</option>
                                                </select>
                                             </label>
                                         </div>
                                     </li>
                                     <li>
                                         <p>На участке</p>
                                         <label>Берег водоема <input type="checkbox" name="waterfront"></label>
                                         <label>Река <input type="checkbox" name="river"></label>
                                         <label>Родник <input type="checkbox" name="spring"></label>
                                         <label>Садовые деревья <input type="checkbox" name="garden_trees"></label>
                                         <label>Лесные деревья <input type="checkbox" name="forest_trees"></label>
                                     </li>
                                 </ul>
                                 <button class="closeMainSettings">Поиск</button>
                             </div>
                         </li>
                         <li onclick="allParam('furnishing')">
                             <div class="progress-bar blue stripes">
                                 <span style="width:40%"></span>
                             </div>
                             <img src="../../template/images/search-2.png" alt="search">Обустройства
                             <div class="furnishing">
                                 <h2>Обустройство</h2>
                                 <ul>
                                     <li>
                                         <div class="select">
                                             <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="5">Отсутствует</option>
                                                    <option value="7">Придомовой гараж</option>
                                                    <option value="52">Гаражный комплекс</option>
                                                    <option value="132">Подземная парковка</option>
                                                    <option value="81">Многоуровневый паркинг</option>
                                                </select>
                                             </label>
                                        </div>
                                     </li>
                                     <li>
                                         <p>Дополнительные строения</p>
                                         <label>Сторожка <input type="checkbox" name="lodge"></label>
                                         <label>Гостевой дом <input type="checkbox" name="guest_house"></label>
                                         <label>Баня <input type="checkbox" name="bath"></label>
                                         <label>Бассейн <input type="checkbox" name="swimming_pool"></label>
                                         <label>Детская площадка <input type="checkbox" name="playground"></label>
                                         <label>Винный погреб <input type="checkbox" name="wine_vault"></label>
                                         <label>Сарай <input type="checkbox" name="barn"></label>
                                         <label>Беседка <input type="checkbox" name="alcove"></label>
                                     </li>
                                     <li>
                                         <p class="title-center">Безопасность</p>
                                         <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                         <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                         <label>Домофон <input type="checkbox" name="intercom"></label>
                                         <label>Охрана <input type="checkbox" name="security"></label>
                                         <label>Консьерж <input type="checkbox" name="concierge"></label>
                                         <label>Ограждение <input type="checkbox" name="fencing"></label>
                                     </li>
                                     <li>
                                         <div class="select">
                                             <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                             </label>
                                         </div>
                                     </li>
                                     <li>
                                         <p>Жилищно-коммунальные услуги</p>
                                         <label>Водопровод <input type="checkbox" name="water_pipes"></label>
                                         <label>Электричество <input type="checkbox" name="electricity"></label>
                                         <label>Отопление <input type="checkbox" name="heating"></label>
                                         <label>Газ <input type="checkbox" name="gas"></label>
                                     </li>
                                 </ul>
                                 <button class="closeFurnishing">Поиск</button>
                             </div>
                         </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                     </ul>
                    <ul class="test-8">
                         <li onclick="allParam('main')">
                             <div class="progress-bar blue stripes">
                                 <span style="width:40%"></span>
                             </div>
                             <img src="../../template/images/search-1.png" alt="search">Основное
                             <div class="main-ap">
                                 <h2>Основное</h2>
                                 <ul>
                                     <li>
                                         <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                         </label>
                                         <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                         </label>
                                         <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                         </label>
                                     </li>
                                     <li>
                                         <p class="title-center">Безопасность</p>
                                         <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                         <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                         <label>Домофон <input type="checkbox" name="intercom"></label>
                                         <label>Охрана <input type="checkbox" name="security"></label>
                                         <label>Консьерж <input type="checkbox" name="concierge"></label>
                                     </li>
                                     <li>
                                         <div class="select">
                                             <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                             </label>
                                         </div>
                                     </li>
                                     <li>
                                         <label>Ограждение <input type="checkbox" name="fencing"></label>
                                         <div class="select">
                                             <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                             </label>
                                         </div>
                                     </li>
                                     <li>
                                         <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                         <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                         <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                     </li>
                                 </ul>
                                 <button class="closeMainAp">Отправить</button>
                             </div>
                         </li>
                         <li onclick="allParam('additionallyAp')">
                             <div class="progress-bar blue stripes">
                                 <span style="width:40%"></span>
                             </div>
                             <img src="../../template/images/search-2.png" alt="search">Дополнительно
                             <div class="additionally-ap">
                                 <h2>Дополнительно</h2>
                                 <ul>
                                     <li>
                                         <div class="select">
                                             <label for="roofing">Кровля
                                                <select name="roofing" id="roofing">
                                                    <option value="">---</option>
                                                    <option value="127">Временная</option>
                                                    <option value="118">Шифер</option>
                                                    <option value="122">Камень</option>
                                                    <option value="123">Солома</option>
                                                    <option value="129">Черепица</option>
                                                    <option value="76">Металлочерепица</option>
                                                    <option value="34">Медь</option>
                                                    <option value="67">Железо</option>
                                                </select>
                                             </label>
                                         </div>
                                     </li>
                                     <li>
                                         <div class="select">
                                             <label for="foundation">Фундамент
                                                <select name="foundation" id="foundation">
                                                    <option value="">---</option>
                                                    <option value="140">Без фундамента</option>
                                                    <option value="58">Ростверк</option>
                                                    <option value="109">Ленточный</option>
                                                    <option value="125">Шведская плита</option>
                                                    <option value="120">Монолитная плита</option>
                                                </select>
                                             </label>
                                         </div>
                                     </li>
                                     <li>
                                         <div class="select">
                                            <label for="wall_material">Материал стен
                                               <select name="wall_material" id="wall_material">
                                                   <option value="">---</option>
                                                   <option value="49">Фахверк</option>
                                                   <option value="56">Клееный брус</option>
                                                   <option value="102">Профилированный брус</option>
                                                   <option value="112">Оцилиндрованное бревно</option>
                                                   <option value="24">Лафет</option>
                                                   <option value="27">Рубленое дерево</option>
                                                   <option value="105">Железобетон</option>
                                                   <option value="28">Шлакоблоки</option>
                                                   <option value="55">Газосиликатные блоки</option>
                                                   <option value="96">Пеноблок</option>
                                                   <option value="105">Железобетон</option>
                                                   <option value="19">Кирпич</option>
                                               </select>
                                            </label>
                                         </div>
                                     </li>
                                 </ul>
                                 <button class="closeAdditionallyAp">Отправить</button>
                             </div>
                         </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                     </ul>
                    <ul class="test-9">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                     </ul>
                    <ul class="test-10">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-11">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                     </ul>
                    <ul class="test-12">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-13">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <ul class="test-14">
                        <li onclick="allParam('main')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Основное
                            <div class="main-ap">
                                <h2>Основное</h2>
                                <ul>
                                    <li>
                                        <label for="space-min">Площадь:
                                            <input id="space-min" name="space-min" type="text" placeholder="от">
                                            <input id="space-max" name="space-max" type="text" placeholder="до">
                                        </label>
                                        <label for="ceiling_height-min">Высота потолков:
                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от">
                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до">
                                        </label>
                                        <label for="number_of_floors-min">Количество этажей:
                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от">
                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="clarification_of_the_object_type">Уточнение вида объектов
                                                <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
                                                    <option value="">---</option>
                                                    <option value="92">Собственность менее 5 лет</option>
                                                    <option value="93">Собственность более 5 лет</option>
                                                    <option value="70">Участок с подрядом</option>
                                                    <option value="33">Незавершенное строительство</option>
                                                    <option value="83">Новостройка</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Ограждение <input type="checkbox" name="fencing"></label>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="143">Кованая ограда</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="122">Камень</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="98">Пластик</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label for="year_of_construction-min">Год постройки/окончания строительства:</label>
                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от">
                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до">
                                    </li>
                                </ul>
                                <button class="closeMainAp">Отправить</button>
                            </div>
                        </li>
                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-2.png" alt="search">Ремонт и обустройства
                            <div class="repair-and-utilities-of-the-apartment">
                                <h2>Ремонт и обустройства</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="furnish">Отделка
                                                <select name="furnish" id="furnish">
                                                    <option value="">---</option>
                                                    <option value="46">Эксклюзивного качества</option>
                                                    <option value="64">Высококачественная отделка</option>
                                                    <option value="57">Хорошая отделка</option>
                                                    <option value="106">Требуется косметический ремонт</option>
                                                    <option value="107">Требуется ремонт</option>
                                                    <option value="65">Незавершенный ремонт</option>
                                                    <option value="141">Без ремонта</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Безопасность</p>
                                        <label>Консьерж <input type="checkbox" name="concierge"></label>
                                        <label>Охрана <input type="checkbox" name="security"></label>
                                        <label>Домофон <input type="checkbox" name="intercom"></label>
                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>
                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>
                                    </li>
                                    <li>
                                        <p class="title-center">Ограждение</p>
                                        <label>Ограждение<input type="checkbox" name="fencing"></label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="material">Материал
                                                <select name="material" id="material">
                                                    <option value="">---</option>
                                                    <option value="98">Пластик</option>
                                                    <option value="142">Дерево</option>
                                                    <option value="38">Профнастил</option>
                                                    <option value="122">Камень</option>
                                                    <option value="31">Бетон</option>
                                                    <option value="19">Кирпич</option>
                                                    <option value="75">Металлические прутья</option>
                                                    <option value="143">Кованая ограда</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="parking">Парковка
                                                <select name="parking" id="parking">
                                                    <option value="">---</option>
                                                    <option class="more-settings" value="81">Многоуровневый паркинг</option>
                                                    <option class="more-settings" value="132">Подземная парковка</option>
                                                    <option class="more-settings" value="52">Гаражный комплекс</option>
                                                    <option class="more-settings" value="7">Придомовой гараж</option>
                                                    <option class="more-settings" value="82">Муниципальная</option>
                                                    <option class="more-settings" value="5">Отсутствует</option>
                                                    <option class="more-settings" value="41">Не важно</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li class="show-more-settings">
                                        <div class="select">
                                            <label for="municipal">Муниципальная
                                                <select name="municipal" id="municipal">
                                                    <option value="">---</option>
                                                    <option value="94">Платная</option>
                                                    <option value="51">Бесплатная</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <p class="title-center">Жилищно-коммунальные услуги</p>
                                        <label>Электричество<input type="checkbox" name="electricity"></label>
                                        <label for="electricity">Кол-во кВт:
                                            <input name="electricity-min" type="text" placeholder="от">
                                            <input name="electricity-max" type="text" placeholder="до">
                                        </label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="sanitation">Водопровод и канализация
                                                <select name="sanitation" id="sanitation">
                                                    <option value="">---</option>
                                                    <option value="47">Есть</option>
                                                    <option value="84">Нет</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Возможность проводки <input type="checkbox" name="possible_to_post"></label>
                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>
                                        <label for="sanitation">Наличие санузлов</label>
                                        <label for="">Количество:
                                            <input name="bathroom_number-min" type="text" placeholder="от">
                                            <input name="bathroom_number-max" type="text" placeholder="до">
                                        </label>
                                        <label for="">Расположение:</label>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <select name="bathroom_location" id="sanitation">
                                                <option value="">---</option>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>
                                    </li>
                                </ul>
                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>
                            </div>
                        </li>
                        <li onclick="allParam('document')">
                            <div class="progress-bar blue stripes">
                                <span style="width:40%"></span>
                            </div>
                            <img src="../../template/images/search-1.png" alt="search">Документы
                            <div class="document">
                                <h2>Документы</h2>
                                <ul>
                                    <li>
                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>
                                    </li>
                                    <li>
                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>
                                    </li>
                                </ul>
                                <button class="closeDocument">Поиск</button>
                            </div>
                        </li>
                        <li onclick="allParam('attachment')">
                            <div class="progress-bar blue stripes">
                                <span style="width:0"></span>
                            </div>
                            <img src="../../template/images/search-4.png" alt="search">Вложения
                            <div class="attachment">
                                <h2>Вложения</h2>
                                <ul>
                                    <li>
                                        <div class="select">
                                            <label for="video">Видео
                                                <select name="video" id="video">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="planning_project">Проект планировки
                                                <select name="planning_project" id="planning_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="select">
                                            <label for="three_d_project">3d проект
                                                <select name="three_d_project" id="three_d_project">
                                                    <option value="">---</option>
                                                    <option value="41">Не важно</option>
                                                    <option value="11">Прилагается</option>
                                                </select>
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <button class="closeAttachment">Поиск</button>
                            </div>
                        </li>
                    </ul>
                    <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Поиск по карте</a>
                </div>
            </div>
            <div class="big-search" onclick="showBigSearch();">
                <a>Расширенный поиск</a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </div>
        </form>
    </div>
    <div class="information-for-the-user">
        <ul>
            <li>Поиск по карте
                <p>Для тех, кто ищет недвижимость в определённом
                    районе и тех, кто хочет увидеть полную картину</p>
            </li>
            <li>Юридические услуги
                <p>Воспользуйтесь нашими услугами для получения: Выписки из ЕГРН, Кадастрового паспорта, Регистрации прав собственности,
                    Согласования перепланировки и других юр. услуг.</p>
            </li>
            <li>Онлайн-чат
                <p>Свяжитесь с нашей службой поддержки в любой момент</p>
            </li>
            <li>Личный кабинет
                <p>Зарегистрируйтесь в 1 клик, чтобы получить доступ ко всем нашим услугам</p>
            </li>
            <li>LantioПремиум
                <p>Стать участником бонусной программы для постоянных пользователей</p>
            </li>
            <li>База фрилансеров
                <p>Воспользуйтесь услугами профессионалов: Ремонт, Дизайн, Уборка и многое другое</p>
            </li>
        </ul>
    </div>
    <div class="just-published">
        <div class="scroll-decoration">
            <h2>Только что опубликованные<span>live</span></h2>
            <div class="list-of-all-apartments">
                <!-- Основной блок всех апартаментов -->
                <div class="all-apartments">
                    <!-- Информация одного апартамента -->
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/1.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>25 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Рижская</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <!-- Закончился первый блок -->
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/2.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Свиблово</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/3.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Медведково</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/4.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Медведково</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/5.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>25 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Рижская</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/6.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Свиблово</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/7.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Медведково</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/8.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Медведково</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/1.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>25 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Рижская</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/2.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Свиблово</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/3.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Медведково</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                    <div class="block-apartments">
                        <img src="../../template/images/apartaments/4.png" alt="apartments">
                        <span>2-комн. кв. 134м<sup>2</sup></span>
                        <div class="price-of-apartments-and-show-apartments">
                            <div class="price-of-apartments">
                                <span>34 000 <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                <div class="location">
                                    <p><img src="../../template/images/m.png" alt="img">Медведково</p>
                                    <span><img src="../../template/images/people.png" alt="img">2 мин</span>
                                </div>
                            </div>
                            <div class="show-apartments">
                                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                            </div>
                        </div>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                    </div>
                </div>
                <!-- Закончились все блоки -->
            </div>
        </div>
    </div>
    <div class="visitor-statistics">
        <div class="container-w-2">
            <p>Прямо сейчас с нами: Вы и еще<span><?php echo $siteModel->getRegisteredUsers();?></span>пользователей</p>
            <ul>
                <li><img src="../../template/images/sec-4-1.png" alt="icon"><?php echo $siteModel->getUniquePeopleThisDay(); ?>
                    <p>Людей зашло сегодня</p>
                </li>
                <li><img src="../../template/images/sec-4-2.png" alt="icon"><?php echo $siteModel->getNumberOfAds(); ?>
                    <p>объявлений выложено</p>
                </li>
                <li><img src="../../template/images/sec-4-3.png" alt="icon">11 345
                    <p>объявлений в вашем городе</p>
                </li>
                <li><img src="../../template/images/sec-4-4.png" alt="icon"><?php echo $siteModel->getActiveDialogs(); ?>
                    <p>активных сделак сейчас</p>
                </li>
            </ul>
            <div class="schedule">
                <div class="schedule-interface">
                    <div class="year-schedule-interface"></div>
                </div>
                <!-- График n3-charts -->
                <!--  <div class="container" ng-app="schedule" ng-controller="ExampleCtrl">
                      <linechart data="data" options="options"></linechart>
                  </div> -->
                  <a><span id="yellow"></span>Октябрь</a>
                  <a><span id="green"></span>Ноябрь</a>
                  <a><span id="blue"></span>Декабрь</a>
              </div>
          </div>
      </div>
      <div class="sales-evaluation">
          <div class="container-w-2">
              <h2>Оценка продажи и аренды недвижимости<br>в Москве и области</h2>
              <div class="appreciate-the-apartment">
                  <ul>
                      <li><i class="fa fa-map-marker" aria-hidden="true"></i>
                          <input placeholder="например: Москва, ул. Большого Голушкина, 17">
                      </li>
                      <li>
                          <div class="select">
                              <label for="">
                                  <select name="0">
                                      <option value="">---</option>
                                      <option>Language</option>
                                      <option>English</option>
                                      <option>Spanish</option>
                                  </select>
                              </label>
                          </div>
                      </li>
                  </ul>
                  <button>Оценить</button>
              </div>
              <div class="appreciate-the-rooms">
                  <p>Кол-во<br>комнат</p>
                  <a href="#">1</a>
                  <a href="#">2</a>
                  <a href="#">3</a>
                  <a href="#">4</a>
                  <a href="#">4+</a>
              </div>
              <div class="estimate-the-area">
                  <label>Площадь м<sup>2</sup>
                      <input name="0" type="text" placeholder="0" maxlength="4" pattern="[0-9]{4}">
                  </label>
              </div>
          </div>
      </div>
      <div class="best-ads-per-day">
          <div class="top-apartments">
              <h2>Лучшие объявления за 24 часа</h2>
              <div class="filter-and-top-blocks">
                  <ul class="filter-apartment">
                      <li class="pointer" onclick="filterOptionsApartments()">
                          <span class="value-text">
                              <img src="../../template/images/apartments.png" alt="apartments"> Тип недвижимости
                          </span>
                      </li>
                      <li onclick="allParam('bigOption')">
                          <label><img src="../../template/images/s3.png" alt="price">Цена</label>
                          <div class="showBigOptions">
                              <p>От<label for="amountBeforeSearch"><input name="price-min" type="text" id="amountBeforeSearch" readonly disabled></label></p>
                              <p>До<label for="amountAfterSearch"><input name="price-max" type="text" id="amountAfterSearch" readonly disabled></label></p>
                              <div id="slider-range-search"></div>
                              <div class="currency">
                                  <p>Валюта</p>
                                  <button class="closeCurrency"><i class="fa fa-rub" aria-hidden="true"></i>рубли</button>
                                  <button class="closeCurrency"><i class="fa fa-usd" aria-hidden="true"></i>доллары</button>
                                  <button class="closeCurrency"><i class="fa fa-eur" aria-hidden="true"></i>евро</button>
                              </div>
                          </div>
                      </li>
                      <li>
                          <div class="select">
                              <label for="">Площадь
                                  <select name="0">
                                      <option value="">---</option>
                                      <option>От 120 м2 До 230 м2</option>
                                      <option>От 120 м2 До 230 м2</option>
                                      <option>От 120 м2 До 230 м2</option>
                                  </select>
                              </label>
                          </div>
                      </li>
                  </ul>
                  <!-- Основной блок TOP апартаментов -->
                <div class="all-apartments-top">
                    <!-- Информация одного TOP апартамента -->
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/1.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                                    src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Закончился первый блок -->
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/2.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                                    src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/3.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                                    src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/4.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                                    src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/5.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span>
                                            <img src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/6.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                                    src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub"
                                                                           aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/7.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                                    src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub"
                                                                           aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/8.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                                    src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub"
                                                                           aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartments/2.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                                    src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub"
                                                                           aria-hidden="true"></i><sub>/мес</sub></span>
                                </div>
                                <div class="view-the-apartment">
                                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Закончились все блоки -->
                <div class="see-more">
                    <p>Еще<span>23 423</span>объявления</p>
                    <a href="#">Смотреть все</a>
                </div>
            </div>
        </div>
    </div>
    <div class="our-application">
        <div class="container-w">
            <div class="app-store">
                <h5>Поиск удобнее в приложении</h5>
                <p>Доступно для любых операционных систем, скачивайте и пользуйтесь удобным приложением по подбору
                    недвижемости прямо сейчас.</p>
                <a href="#">
                    <img src="../../template/images/apple.png" alt="logo" id="decor-img">
                    <span>Загрузите</span>
                    <p class="decoration-text">App Store</p>
                </a>
                <a href="#">
                    <img src="../../template/images/gp.png" alt="logo">
                    <span>Загрузите</span>
                    <p class="decoration-text">Google Play</p>
                </a>
            </div>
        </div>
    </div>
<!--    <div class="our-work">-->
<!--        <div class="container-w-2">-->
<!--            <h2>Мы трудимся для Вас</h2>-->
<!--            <ul class="bxslider">-->
<!--                <li>-->
<!--                    <img src="../../template/images/01.png"/>-->
<!--                    <div class="admins">-->
<!--                        <h6>Александр Никулин</h6>-->
<!--                        <span>Гениральный директор</span>-->
<!--                        <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий-->
<!--                            комфортное-->
<!--                            приобретение или аренду жилья</p>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <img src="../../template/images/02.png"/>-->
<!--                    <div class="admins">-->
<!--                        <h6>Александр Никулин</h6>-->
<!--                        <span>Гениральный директор</span>-->
<!--                        <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий-->
<!--                            комфортное-->
<!--                            приобретение или аренду жилья</p>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <img src="../../template/images/03.png"/>-->
<!--                    <div class="admins">-->
<!--                        <h6>Александр Никулин</h6>-->
<!--                        <span>Гениральный директор</span>-->
<!--                        <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий-->
<!--                            комфортное-->
<!--                            приобретение или аренду жилья</p>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <img src="../../template/images/04.png"/>-->
<!--                    <div class="admins">-->
<!--                        <h6>Александр Никулин</h6>-->
<!--                        <span>Гениральный директор</span>-->
<!--                        <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий-->
<!--                            комфортное-->
<!--                            приобретение или аренду жилья</p>-->
<!--                    </div>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <img src="../../template/images/05.png"/>-->
<!--                    <div class="admins">-->
<!--                        <h6>Александр Никулин</h6>-->
<!--                        <span>Гениральный директор</span>-->
<!--                        <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий-->
<!--                            комфортное-->
<!--                            приобретение или аренду жилья</p>-->
<!--                    </div>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
<!--    </div>-->
    <div class="official-partners">
        <div class="partners">
            <h2>Официальные партнеры</h2>
            <ul class="bxslider-partners main-block-2">
                <li>
                    <img src="../../template/images/sec-6-1.png" alt="partners">
                </li>
                <li>
                    <img src="../../template/images/sec-6-2.png" alt="partners">
                </li>
                <li>
                    <img src="../../template/images/sec-6-3.png" alt="partners">
                </li>
                <li>
                    <img src="../../template/images/sec-6-4.png" alt="partners">
                </li>
                <li>
                    <img src="../../template/images/sec-6-5.png" alt="partners">
                </li>
            </ul>
        </div>
    </div>
    <div class="footer">
        <div class="container-w-2">
            <div class="lant-io">
                <p>© 2016-2017 Lant.io</p>
                <p>ООО «ЛЭНТИО»</p>
            </div>
            <div class="policy">
                <p><a href="#">Техническая поддержка</a></p>
                <p><a href="#">Пользовательское соглашение</a></p>
                <p><a href="#">Политика конфиденциальности</a></p>
                <p><a href="#">Команда проекта</a></p>
            </div>
            <ul>
                <li><a href="//twitter.com/LantioP"><i class="fa fa-twitter" aria-hidden="true"></i><span>Читай</span></a></li>
                <li><a href="//vk.com/lantio"><i class="fa fa-vk" aria-hidden="true"></i><span>Вступай</span></a></li>
                <li><a href="//www.youtube.com/channel/UC54yeyBi5X4wsyQYLje0v-w"><i class="fa fa-youtube" aria-hidden="true"></i><span>Смотри</span></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i><span>Подписывайся</span></a></li>
                <li><a href="#"><div class="icon-footer"></div><span>У нас</span></a></li>
            </ul>
        </div>
    </div>
</div>
<!-- Preloader -->
<style type="text/css">#hellopreloader>#hellopreloader_preload{position:fixed;z-index:99999;top:0;left:0;right:0;bottom:0;width:100vw;height:100vh;background: url('../../template/images/puff.svg') center no-repeat, url('../../template/images/access_background.jpg') center no-repeat;background-size:123px,cover;}</style>
<div id="hellopreloader"><div id="hellopreloader_preload"></div></div>
<script type="text/javascript">var hellopreloader = document.getElementById("hellopreloader_preload");function fadeOutnojquery(el){el.style.opacity = 1;var interhellopreloader = setInterval(function(){el.style.opacity = el.style.opacity - 0.05;if (el.style.opacity <=0.05){ clearInterval(interhellopreloader);hellopreloader.style.display = "none";}},16);}window.onload = function(){setTimeout(function(){fadeOutnojquery(hellopreloader);},1000);};</script>
<?php
// Подключение скрипта в контролле../../template/images/1.pngре для футера
if (isset($this->data['script_footer'])) {
    foreach ($this->data['script_footer'] as $key => $value) {
        echo '<script src="/template/js/'.$value.'"></script>'."\r\n";
    }}
?>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!--<script src="/bower_components/angular/angular.min.js"></script>-->
<!--<script src="/bower_components/d3/d3.min.js"></script>-->
<!--<script src="bower_components/n3-charts/build/lineChart.js"></script>-->
<script src="/template/js/jquery.formstyler.min.js"></script>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script src="/template/js/mapController.js"></script>
<!--<script src="/template/js/graphics.min.js"></script>-->
<script src="/template/js/jquery.bxslider.min.js"></script>
<script src="/template/js/jquery.parallax.min.js"></script>
<script src="/bower_components/handlebars/handlebars.runtime.min.js"></script>
<script src="/bower_components/handlebars/handlebars.min.js"></script>
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
                        <img src="../../template/images/m.png" alt="metro">Рижская<span>
                        <img src="../../template/images/people.png" alt="">2 мин</span>
                    </p>
                    <span class="decorate-number">{{price}}
                        <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub>
                    </span>
                </div>
                <div class="view-the-apartment">
                    <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                </div>
            </div>
        </div>
    </div>
</script>
<script src="/template/js/main.min.js"></script>
</body>
</html>