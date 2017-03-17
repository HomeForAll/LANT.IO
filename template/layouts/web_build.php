<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php $this->title(); ?></title>
    <?php
        // Подключение стилей в контроллере
    if (isset($this->data['css'])) {
        foreach ($this->data['css'] as $key => $value) {
            echo '<link rel="stylesheet"  href="/template/css/'.$value.'">'."\r\n";
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
    echo '<script src="/template/js/'.$value.'"></script>'."\r\n";
}
}
?>
    <script>
        var socket = io('http://91.202.180.160:8089?user_id=<?php echo $user_id; ?>&hash=<?php echo $hash; ?>');

        socket.on('connect', function(){
            console.log('Соединение установлено.');
        });

        socket.on('message', function(data){
            console.log('****************');
            console.log('* Принято собщение: ');
            console.log('*');
            console.log('* ' + data.message);
            console.log('****************');
        });

        socket.on('error', function(data){
            console.log(data);
        });

        socket.on('disconnect', function(){
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
            return '<fieldset> <legend>Базовые параметры</legend> <div style="margin: 15px"> Цена: <div class="indent"> Стоимость: <input name="minPrice" type="text" placeholder="Мин."> <input name="maxPrice" type="text" placeholder="Макс."><br> <label for="bargain">Торг:</label> <select name="bargain" id="bargain"> <option value="">---</option> <option value="yes">Возможен</option> <option value="">Не возможен</option> </select><br> <label for="rentType">Тип аренды:</label> <select name="rentType" id="rentType"> <option value="">---</option> <option value="hourRent">Часовая</option> <option value="dailyRent">Посуточная</option> <option value="longRent">Долгосрочная</option> </select> </div> Расположение: <br> <div class="indent"> <label for="region">Область:</label> <input type="text" name="region" id="region"><br> <label for="city">Город:</label> <input type="text" name="city" id="city"><br> <div class="indent"> <label for="district">Округ:</label> <input type="text" name="district" id="district"><br> <label for="area">Район:</label> <input type="text" name="area" id="area"><br> <label for="address">Адрес:</label> <input type="text" name="address" id="address"><br> </div> Станция метро: <br> <div class="indent"> Удаленность от метро: <input type="text" name="metroMin" placeholder="Мин."> <input type="text" name="metroMax" placeholder="Макс."><br> </div> </div> </div> </fieldset> <br><br> <fieldset> <legend>Описание объекта</legend> <div style="margin: 15px"> <strong>Квартира:</strong> <div class="indent"> <label for="roomsNumber">Количество комнат:</label> <select name="roomsNumber" id="roomsNumber" onchange=""> <option value="">---</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="more">4+</option> </select><br> Площадь: <input type="text" name="spaceMin" placeholder="От"> <input type="text" name="spaceMax" placeholder="До"><br> Этаж: <input type="text" name="floorMin" placeholder="От"> <input type="text" name="floorMax" placeholder="До"><br> <label for="equipment">Комплектация:</label> <select name="equipment" id="equipment"> <option value="">---</option> <option value="1">Укомплектована</option> <option value="">Пустая</option> </select><br> <label for="ceilingHeight">Высота потолков:</label> <input type="text" name="ceilingHeight" id="ceilingHeight"> </div> </div> <div style="margin: 15px"> <strong>Дом квартиры:</strong> <div class="indent"> <label for="houseType">Тип дома:</label> <select name="houseType" id="houseType" onchange=""> <option value="">---</option> <option value="1">Блочный</option> <option value="2">Брежневка</option> <option value="3">Индивидуальный</option> <option value="4">Кирпично-монолитный</option> <option value="5">Монолит</option> <option value="6">Панельный</option> <option value="7">Сталинка</option> <option value="8">Хрущевка</option> <option value="9">Серия дома</option> </select><br> <label for="houseFloorNumber">Количество этажей:</label> <input type="text" name="houseFloorNumber" id="houseFloorNumber"><br> <label for="lift">Лифт:</label> <select name="lift" id="lift" onchange=""> <option value="">---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="parking">Парковка:</label> <select name="parking" id="parking" onchange=""> <option value="">---</option> <option value="1">Подземная</option> <option value="2">Во дворе</option> <option value="2">Платная (неподалеку)</option> </select><br> Безопасность: <div class="indent"> <label for="concierge">Консьерж</label> <input type="checkbox" name="concierge" id="concierge"><br> <label for="security">Охрана</label> <input type="checkbox" name="security" id="security"><br> <label for="intercom">Домофон</label> <input type="checkbox" name="intercom" id="intercom"><br> <label for="CCTV">Видеонаблюдение</label> <input type="checkbox" name="CCTV" id="CCTV"><br> </div> <label for="chute">Мусоропровод:</label> <select name="chute" id="chute" onchange=""> <option value="">---</option> <option value="1">Да</option> <option value="2">Нет</option> </select><br> </div> <strong>Состав квартиры:</strong> <div class="indent"> Комнаты: <div class="indent"> <label for="bedroom">Спальня</label> <input type="checkbox" name="bedroom" id="bedroom"><br> <label for="kitchen">Кухня</label> <input type="checkbox" name="kitchen" id="kitchen"><br> <label for="livingRoom">Гостиная</label> <input type="checkbox" name="livingRoom" id="livingRoom"><br> <label for="hallway">Прихожая</label> <input type="checkbox" name="hallway" id="hallway"><br> <label for="nursery">Детская</label> <input type="checkbox" name="nursery" id="nursery"><br> <label for="study">Рабочий кабинет</label> <input type="checkbox" name="study" id="study"><br> <label for="canteen">Столовая</label> <input type="checkbox" name="canteen" id="canteen"><br> <label for="bathroom">Ванная</label> <input type="checkbox" name="bathroom" id="bathroom"><br> </div> Состояние квартиры: <div class="indent"> <label for="decoration">Отделка:</label> <select name="decoration" id="decoration"> <option value="">---</option> <option value="1">Да</option> <option value="0">Нет</option> </select> <select name="decorationValue"> <option value="">---</option> <option value="1">Люкс</option> <option value="0">Косметическая</option> </select><br> </div> <label for="lavatory">Санузел:</label> <select name="lavatory" id="lavatory"> <option value="">---</option> <option value="1">Совмещенный</option> <option value="0">Раздельный</option> </select><br> <label for="balcony">Обязательное наличие балкона</label> <input type="checkbox" name="balcony" id="balcony"><br> Жилищно-комунальные услуги: <div class="indent"> <label for="heating">Отопление</label> <input type="checkbox" name="heating" id="heating"><br> <label for="gas">Газ</label> <input type="checkbox" name="gas" id="gas"><br> <label for="electricity">Электричество</label> <input type="checkbox" name="electricity" id="electricity"><br> <label for="water">Водопровод</label> <input type="checkbox" name="water" id="water"><br> </div> Наполнение квартиры: <div class="indent"> Электроника для досуга и отдыха: <div class="indent"> <label for="TV">Телевизор</label> <input type="checkbox" name="TV" id="TV"><br> <label for="musicCenter">Музыкльный центр</label> <input type="checkbox" name="musicCenter" id="musicCenter"><br> <label for="conditioner">Кондиционер</label> <input type="checkbox" name="conditioner" id="conditioner"><br> </div> Бытовая техника: <div class="indent"> <label for="fridge">Холодильник</label> <input type="checkbox" name="fridge" id="fridge"><br> <label for="plate">Плита</label> <input type="checkbox" name="plate" id="plate"><br> <label for="bake">Печь</label> <input type="checkbox" name="bake" id="bake"><br> <label for="microwave">СВЧ</label> <input type="checkbox" name="microwave" id="microwave"><br> <label for="dishwasher">Посудомойка</label> <input type="checkbox" name="dishwasher" id="dishwasher"><br> </div> Мебель: <div class="indent"> <label for="table">Стол</label> <input type="checkbox" name="table" id="table"><br> <label for="bed">Кровать</label> <input type="checkbox" name="bed" id="bed"><br> <label for="cupboard">Шкаф</label> <input type="checkbox" name="cupboard" id="cupboard"><br> <label for="stand">Тумба</label> <input type="checkbox" name="stand" id="stand"><br> <label for="mirror">Зеркало</label> <input type="checkbox" name="mirror" id="mirror"><br> <label for="armchair">Кресло</label> <input type="checkbox" name="armchair" id="armchair"><br> <label for="sofa">Диван</label> <input type="checkbox" name="sofa" id="sofa"><br> </div> </div> </div> <strong>Вложения:</strong> <div class="indent"> <label for="plan">План квартиры:</label> <select name="plan" id="plan" onchange=""> <option value="">---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="3d">3D проект:</label> <select name="3d" id="3d" onchange=""> <option value="">---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="video">Видео:</label> <select name="video" id="video" onchange=""> <option value="">---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> </div> </div> </fieldset> <input style="margin-top: 20px" type="submit" name="extended" value="Найти">';
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
<!--<div id="loading">
    <div id="loading-center">
        <div id="loading-center-absolute">
            <div class="object" id="object_four"></div>
            <div class="object" id="object_three"></div>
            <div class="object" id="object_two"></div>
            <div class="object" id="object_one"></div>
        </div>
    </div>
</div> -->
<?php if (isset($_SESSION['authorized'])) { ?>
<div id="navigation">
    <div class="logo-img"><a href="#"><img src="../../template/images/logo.png" alt="logo"></a></div>
    <div class="registration-users">
        <div class="place-an-ad">
            <a href="../../index.php"><img src="../../template/images/add-blue.png" alt="add">Дать объявление</a>
        </div>
        <div class="registration">
            <a href="../../index.php"><img src="../../template/images/add-green.png" alt="add">Войти</a>
        </div>
    </div>
</div>
<div id="wrapper">
    <div id="navigation">
        <ul>
            <li><a href="/news">Объявления</a></li>
            <li><a href="/search">Поиск</a></li>
            <?php if (isset($_SESSION['authorized'])) { ?>
                <li><a href="/cabinet">Личный кабинет</a></li>
                <li><a href="/logout">Выход</a></li>
            <?php } else { ?>
                <li><a href="/registration">Регистрация</a></li>
                <li><a href="/login">Вход</a></li>
            <?php } ?>
        </ul>
        <button class="show-and-hide-menu"><i class="fa fa-bars" aria-hidden="true"></i></button>
    </div>
</div>
<?php } else { ?>
<div id="navigation-true">
    <div class="logo-img"><a href="#"><img src="../../template/images/logo-mob.png" alt="logo-true"></a></div>
    <div class="registration-users">
        <div class="place-an-ad">
            <a href="../../index.php"><img src="../../template/images/add-blue.png" alt="add">Дать объявление</a>
        </div>
        <div class="registration">
            <div class="message"><img src="../../template/images/notification.png" alt="notification"></div>
            <div class="user">
                <div class="users-information">
                    <p>Александр Никулин</p>
                    <span><img src="../../template/images/crown.png" alt="user">Пользователь +</span>
                </div>
                <img src="../../template/images/user.png" alt="user">
                <ul>
                    <li><a href="#"><img src="../../template/images/m1.png" alt="menu">Мои объявления</a></li>
                    <li><a href="#"><img src="../../template/images/m2.png" alt="menu">Избранное</a></li>
                    <li><a href="#"><img src="../../template/images/m3.png" alt="menu">Тех поддержка</a></li>
                    <li><a href="#"><img src="../../template/images/m4.png" alt="menu">Настройка профиля</a></li>
                    <li><a href="#"><img src="../../template/images/m5.png" alt="menu">Выйти из системы</a></li>
                </ul>
            </div>
        </div>
        <button class="show-and-hide-menu"><i class="fa fa-bars" aria-hidden="true"></i></button>
    </div>
</div>
<?php } ?>
<div id="content">
<!--<?php $this->content(); ?> -->
    <div class="section-1">
        <div class="apartment-search">
            <ul>
                <li><a href="#">Аренда</a></li>
                <li><a href="#">Продажа</a></li>
            </ul>
            <div class="search-menu-apartment">
                <select>
                    <option value="1">Москва и область</option>
                    <option value="2">Москва и область</option>
                </select>
                <select>
                    <option value="3">Офис</option>
                    <option value="4">Офис</option>
                </select>
                <select>
                    <option value="5">Цена</option>
                    <option value="6">Цена</option>
                </select>
                <button>Найти</button>
            </div>
            <div class="big-search"><a href="#">Расширенный поиск</a><i class="fa fa-angle-right" aria-hidden="true"></i></div>
        </div>
    </div>
    <div class="section-2">
        <ul>
            <li>Удобный поиск по карте
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia iusto architecto quia!</p>
            </li>
            <li>Обширный список<br> юридических услуг
                <p>Lorem ipsum dolor sit amet, consectetur.</p>
            </li>
            <li>Обширный список критериев
                <p>Для поиска и составления объявлений</p>
            </li>
            <li>Онлайн-чат 
                <p>Онлайн-чат со службой поддержки, которая всегда решает ваши вопросы</p>
            </li>
            <li>Постоянная модерация объявлений
                <p>Мы гарантируем только самые реальные и честные объявления</p>
            </li>
            <li>Удобный быстрый поиск
                <p>Мы гарантируем только самые реальные и честные объявления</p>
            </li>
            <li>Информативная страница объявлений
                <p>Мы гарантируем только самые реальные и честные объявления</p>
            </li>
            <li>Бонусы для премиум клиентов
                <p>Мы гарантируем только самые реальные и честные объявления</p>
            </li>
            <li>Профессионалы недвижимости
                <p>На сайте работают профессиональные участники рынка недвижимости</p>
            </li>
        </ul>
    </div>
    <div class="section-3">
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
    <div class="section-4">
        <div class="container-w-2">
            <p>Сегодня вы и еще<span>143 645</span>человек сейчас с нами, а так же:</p>
            <ul>
                <li><img src="../../template/images/sec-4-1.png" alt="icon">645 644
                    <p>Людей зашло сегодня</p>
                </li>
                <li><img src="../../template/images/sec-4-2.png" alt="icon">23 635 773
                    <p>объявлений выложено</p>
                </li>
                <li><img src="../../template/images/sec-4-3.png" alt="icon">11 345
                    <p>объявлений в вашем городе</p>
                </li>
                <li><img src="../../template/images/sec-4-4.png" alt="icon">342 244
                    <p>активных сделак сейчас</p>
                </li>
            </ul>
            <div class="schedule">
                <div class="schedule-interface">
                    <div class="year-schedule-interface"></div>
                </div>
                <a href="#"><span id="yellowe"></span>Октябрь</a>
                <a href="#"><span id="green"></span>Ноябрь</a>
                <a href="#"><span id="blue"></span>Декабрь</a>
            </div>
        </div>
    </div>
    <div class="section-5">
        <div class="top-appertaments">
        <h2>Лучшие объявления за 24 часа</h2>
            <div class="filter-and-top-blocks">
                <div class="filter-apartament">
                    <a><p>тип недвижемости</p>
                    <select>
                        <option value="1">Квартира</option>
                        <option value="2">Квартира</option>
                    </select></a>
                    <select>
                        <option value="3">от 20 000...</option>
                        <option value="4">от 20 000...</option>
                    </select>
                    <p id="style">Площадь</p>
                    <select>
                        <option value="5">от 120 м2 до 230 м2</option>
                        <option value="6">от 120 м2 до 230 м2</option>
                    </select>
                </div>
                <!-- Основной блок TOP апартаментов -->
                <div class="all-apartments-top">
                    <!-- Информация одного TOP апартамента -->
                    <div class="top-block">
                        <div class="left-wallpaper">
                            <a href="#"><img src="../../template/images/apartaments/1.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
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
                            <a href="#"><img src="../../template/images/apartaments/2.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
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
                            <a href="#"><img src="../../template/images/apartaments/3.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
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
                            <a href="#"><img src="../../template/images/apartaments/4.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
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
                            <a href="#"><img src="../../template/images/apartaments/5.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
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
                            <a href="#"><img src="../../template/images/apartaments/6.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
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
                            <a href="#"><img src="../../template/images/apartaments/7.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
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
                            <a href="#"><img src="../../template/images/apartaments/8.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
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
                            <a href="#"><img src="../../template/images/apartaments/2.png" alt="apartments"></a>
                            <p>2-комн. кв. 134м<sup>2</sup></p>
                        </div>
                        <div class="right-information-block">
                            <span>Шикардосная двушка в самом центре столицы</span>
                            <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до...</p>
                            <div class="price-and-view-the-apartment">
                                <div class="price">
                                    <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img src="../../template/images/people.png" alt="">2 мин</span></p>
                                    <span class="decorate-number">25 000<i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
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
    <div class="section-6">
        <div class="container-w">
             <div class="app-store">
                <h5>Поиск удобнее в приложении</h5>
                <p>Доступно для любых операционных систем, скачивайте и пользуйтесь удобным приложением по подбору недвижемости прямо сейчас.</p>
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
    <div class="section-7">
        <div class="container-w-2"> 
            <h2>Мы трудимся для Вас</h2>
            <div class="carousel">
                <div class="left-button">
                    <img src="../../template/images/left-button.png" alt="left-button">
                </div>
                <div class="main-block">
                    <ul>
                        <li>
                            <img src="../../template/images/daniil.png" alt="child">
                            <div class="admins">
                                <h6>Даниил Мельников</h6>
                                <span>Гениральный директор</span>
                                <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий комфортное приобретение или аренду жилья</p>
                            </div>
                        </li>
                        <li>
                            <img src="../../template/images/aleksandr.png" alt="child">
                            <div class="admins">
                                <h6>Александр Никулин</h6>
                                <span>Гениральный директор</span>
                                <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий комфортное приобретение или аренду жилья</p>
                            </div>
                        </li>
                        <li>
                            <img src="../../template/images/daniil.png" alt="child">
                            <div class="admins">
                                <h6>Даниил Мельников</h6>
                                <span>Гениральный директор</span>
                                <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий комфортное приобретение или аренду жилья</p>
                            </div>
                        </li>
                        <li>
                            <img src="../../template/images/aleksandr.png" alt="child">
                            <div class="admins">
                                <h6>Александр Никулин</h6>
                                <span>Гениральный директор</span>
                                <p>Наш сервис не просто воплощение стараний нашей команды, это сервис обеспечивающий комфортное приобретение или аренду жилья</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right-button">
                    <img src="../../template/images/right-button.png" alt="right-button">
                </div>
            </div>
        </div>
    </div>
    <div class="section-8">
        <div class="partners">
            <h2>Официальные партнеры</h2>
            <div class="carousel-2">
                <div class="left-button-2">
                    <img src="../../template/images/left-button.png" alt="left-button">
                </div>
                <div class="main-block-2">
                    <ul>
                        <li>
                            <a href="#"><img src="../../template/images/sec-6-1.png" alt="partners"></a>
                        </li>
                        <li>
                            <a href="#"><img src="../../template/images/sec-6-2.png" alt="partners"></a>
                        </li>
                        <li>
                            <a href="#"><img src="../../template/images/sec-6-3.png" alt="partners"></a>
                        </li>
                        <li>
                            <a href="#"><img src="../../template/images/sec-6-4.png" alt="partners"></a>
                        </li>
                        <li>
                            <a href="#"><img src="../../template/images/sec-6-5.png" alt="partners"></a>
                        </li>
                    </ul>
                </div>
                <div class="right-button-2">
                    <img src="../../template/images/right-button.png" alt="right-button">
                </div>
            </div>
        </div>
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
            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i><span>Читай</span></a></li>
            <li><a href="#"><i class="fa fa-vk" aria-hidden="true"></i><span>Вступай</span></a></li>
            <li><a href="#"><i class="fa fa-youtube" aria-hidden="true"></i><span>Смотри</span></a></li>
            <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i><span>Подписывайся</span></a></li>
            <li><a href="#"><img src="../../template/images/work.png" alt="work"><span>У нас</span></a></li>
        </ul>
    </div>
</div>
    <?php
// Подключение скрипта в контролле../../template/images/1.pngре для футера
if (isset($this->data['script_footer'])) {
    foreach ($this->data['script_footer'] as $key => $value) {
        echo '<script src="/template/js/'.$value.'"></script>'."\r\n";
    }}
?>
<!-- Load CSS -->
<script>
    function loadCSS(hf) {var ms=document.createElement("link");
        ms.rel="stylesheet";ms.href=hf;document.getElementsByTagName("head")[0].appendChild(ms);}
    loadCSS("/bower_components/font-awesome/css/font-awesome.min.css");
    loadCSS("template/css/style.css");
    loadCSS("/template/css/news_style.css");
</script>
<!-- Load Scripts -->
<script>
    var scr = {"scripts":[
        {"src" : "//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js", "async" : false},
        {"src" : "//api-maps.yandex.ru/2.1/?lang=ru_RU", "async" : false},
        {"src" : "/template/js/mapController.js", "async" : false},
        {"src" : "/template/js/forms.editor.handler.js", "async" : false},
        {"src" : "/template/js/socket.io.min.js", "async" : false},
        {"src" : "/template/js/main.js", "async" : false}
]};!function(t,n,r){"use strict";var c=function(t){if("[object Array]"!==Object.prototype.toString.call(t))return!1;for(var r=0;r<t.length;r++){var c=n.createElement("script"),e=t[r];c.src=e.src,c.async=e.async,n.body.appendChild(c)}return!0};t.addEventListener?t.addEventListener("load",function(){c(r.scripts);},!1):t.attachEvent?t.attachEvent("onload",function(){c(r.scripts)}):t.onload=function(){c(r.scripts)}}(window,document,scr);
</script>
</body>
</html>