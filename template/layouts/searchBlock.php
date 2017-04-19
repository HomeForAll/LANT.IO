<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filters</title>
    <link rel="stylesheet" href="/template/css/searchBlock/search.css">
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.min.css">
</head>
<body>
<?php if (isset($_SESSION['authorized'])) { ?>
    <div id="navigation">
        <div class="background-image">
            <div class="logo-img"><a href="#"><img src="../../template/images/logo.png" alt="logo"></a></div>
            <div class="registration-users">
                <div class="place-an-ad">
                    <a href="../../index.php"><img src="../../template/images/add-blue.png" alt="add">Дать
                        объявление</a>
                </div>
                <div class="registration">
                    <a href="../../index.php"><img src="../../template/images/add-green.png" alt="add">Войти</a>
                </div>
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
    <div class="background-image">
        <div id="navigation-true">
            <div class="container-w-0">
                <div class="logo-img">
                    <a href="web_build.php"><img src="../../template/images/logo-true.png" alt=" logo-true"></a>
                </div>
                <div class="registration-users">
                    <div class="place-an-ad">
                        <a href="../../index.php"><img src="../../template/images/add-blue.png" alt="add">Дать
                            объявление</a>
                    </div>
                    <div class="registration">
                        <div class="message"><img src="../../template/images/notification.png" alt="  notification">
                        </div>
                        <div class="user" onclick="showTopMenuAndSearch();">
                            <div class="users-information">
                                <p>Александр Никулин</p>
                                <span><img src="../../template/images/crown.png" alt="user">Пользователь +</span>
                            </div>
                            <img src="../../template/images/user.png" alt="user">
                            <ul>
                                <li><a href="#"><img src="../../template/images/m1.png" alt="menu">Мои объявления</a>
                                </li>
                                <li><a href="#"><img src="../../template/images/m2.png" alt="menu">Избранное</a></li>
                                <li><a href="#"><img src="../../template/images/m3.png" alt="menu">Тех поддержка</a>
                                </li>
                                <li><a href="#"><img src="../../template/images/m4.png" alt="menu">Настройка профиля</a>
                                </li>
                                <li><a href="#"><img src="../../template/images/m5.png" alt="menu">Выйти из системы</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button class="show-and-hide-menu" onclick="showTopMenuAndSearch();">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<div class="search-and-filter">
    <div class="container-w-0">
        <form action="">
            <div class="big-search-menu">
                <div class="apartment-settings-apartment">
                    <h2>Параметры квартиры</h2>
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
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                        </li>
                    </ul>
                    <a>
                        <button>Готово</button>
                    </a>
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
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
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
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
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
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                        </li>
                    </ul>
                    <a>
                        <button>Готово</button>
                    </a>
                </div>
                <div class="apartment-settings-separate-building">
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
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
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
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                        <li><span class="names-parameters">Балкон м2</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}" required>
                            </p>
                        </li>
                    </ul>
                    <ul>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="select">
                                <label for="">
                                    <select>
                                        <option>Language of communication</option>
                                        <option>English</option>
                                        <option>Spanish</option>
                                    </select>
                                </label>
                            </div>
                        </li>
                        <li><span class="names-parameters">Высота потолков м</span>
                            <p>От<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                            <p>До<input name="" type="text" placeholder="0" maxlength="2" pattern="[0-9]{2}" required>
                            </p>
                        </li>
                    </ul>
                    <a>
                        <button>Готово</button>
                    </a>
                </div>
                <div class="search-more-precisely-search">
                    <div class="exact-area">
                                <span class="search-city" onclick="allFilterBlocks('historySearch');">
                                    <img src="../../template/images/s1.png" alt="city">
                                    <input id="inputOne" type="text" name="" placeholder="Москва, ул, Малая Ордынка"
                                           disabled>
                                </span>
                        <div class="history-search">
                                    <span class="search-city active-search">
                                        <img src="../../template/images/s1.png" alt="city">
                                        <input type="text" name="" placeholder="г. Москва Северное медведково">
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
                                        <img src="../../template/images/people-2.png" alt="icon">
                                        <p>Уделенность пекшом не более</p>
                                        <span><input placeholder="" type="number" name="foot" value="5" min="5"
                                                     max="60" step="5" disabled>
                                                <span class="timer">Минут</span></span>
                                    </div>
                                    <div class="distance-on-transport">
                                        <img src="../../template/images/avto.png" alt="icon">
                                        <p>Уделенность пекшом не более</p>
                                        <span><input placeholder="" type="number" name="transport" value="5"
                                                     min="5" max="60" step="5" disabled>
                                                <span class="timer">Минут</span></span>
                                    </div>
                                    <button class="closeSearchMetro">Готово</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button onclick="allParam('quickSearch')">Задать точнее</button>
                    <div class="quick-search">
                        <h5><i class="fa fa-map-marker" aria-hidden="true"></i>Введите город, район, область или
                            точный адрес<span><img src="../../template/images/location.png" alt="location">выделить область на карте</span>
                        </h5>
                        <ul class="quick-search-by-parameters">
                            <li>
                                <div class="select">Область
                                    <label for="">
                                        <input name="" type="text" placeholder="Московская">
                                    </label>
                                </div>
                            <li>
                                <div class="select">Город
                                    <label for="">
                                        <input name="" type="text" placeholder="Москва">
                                    </label>
                                </div>
                            <li>
                                <div class="select">Округ
                                    <label for="">
                                        <select>
                                            <option>Северо-западный</option>
                                            <option>Северо-западный</option>
                                            <option>Северо-западный</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Район
                                    <label for="">
                                        <select>
                                            <option>Северное медведково</option>
                                            <option>Северное медведково</option>
                                            <option>Северное медведково</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Улица
                                    <label for="">
                                        <select>
                                            <option>Ениивмасейская</option>
                                            <option>Ениивмасейская</option>
                                            <option>Ениивмасейская</option>
                                        </select>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="select">Дом
                                    <label for="">
                                        <input name="" type="text" placeholder="16" maxlength="4"
                                               pattern="[0-9]{4}">
                                    </label>
                                </div>
                            <li>
                                <div class="select">Метро
                                    <label for="">
                                        <select>
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
                                    <label for="">
                                        <select>
                                            <option>5 мин пешком</option>
                                            <option>10 мин пешком</option>
                                            <option>15 мин пешком</option>
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
                    <li onclick="allParam('bigOption')" class="menu-left-window">
                        <label for="#amountSearch"><img src="../../template/images/s3.png" alt="price"> Цена</label>
                        <div class="showBigOptions">
                            <p>От<input name="" placeholder="" type="text" id="amountBeforeSearch" readonly disabled>
                            </p>
                            <p>До<input name="" placeholder="" type="text" id="amountAfterSearch" readonly disabled>
                            </p>
                            <div id="slider-range-search"></div>
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
                    <li class="menu-left-window"><span class="left-names-filter">Кол-во<br>комнат</span>
                        <div class="numbers">
                            <label for="">
                                <input type="number" placeholder="0" maxlength="1" minlength="0">
                            </label>
                        </div>
                    <li><span class="left-names-filter">Площадь</span>
                        <div class="select number">
                            <label for="">
                                <select>
                                    <option>От 120м2 До 230м2</option>
                                    <option>От 120м2 До 230м2</option>
                                    <option>От 120м2 До 230м2</option>
                                </select>
                            </label>
                        </div>
                    </li>
                    <li class="number-button"><span class="left-names-filter">Наполнение<br>квартиры</span>
                        <div class="select number">
                            <label for="">
                                <select>
                                    <option>Выбрано(1)</option>
                                    <option>Выбрано(2)</option>
                                    <option>Выбрано(3)</option>
                                </select>
                            </label>
                        </div>
                    </li>
                    <li class="number-button"><span class="left-names-filter">Фильтрация<br>поиска</span>
                        <div class="select number">
                            <button>Показать</button>
                        </div>
                    </li>
                </ul>
            </div>
        </form>
        <div class="result-all-apartments">
            <div class="show-result-parametrs">
                <div class="left-information-block-apartment">
                    <div class="carousel">
                        <img src="../../template/images/test-apartment.png" alt="apartment">
                        <ul class="apartments-wallpapers">
                            <li>
                                <a><img src="../../template/images/c-a-1.png" alt="partners"></a>
                            </li>
                            <li>
                                <a><img src="../../template/images/c-a-2.png" alt="partners"></a>
                            </li>
                            <li>
                                <a><img src="../../template/images/c-a-3.png" alt="partners"></a>
                            </li>
                            <li>
                                <a><img src="../../template/images/c-a-4.png" alt="partners"></a>
                            </li>
                            <li>
                                <a><img src="../../template/images/c-a-5.png" alt="partners"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="small-description">
                        <span>Сдаю квартиру на 1,5 месяца</span>
                        <p>Шикарная 2-х комнатная квартира в тихом центре города пешая до метро Фрунзенская, рядом магазины, парковка, ночной бухло-ларек</p>
                    </div>
                    <div class="price-and-view-the-apartment">
                        <div class="price">
                            <span class="decorate-number">25 000<i class="fa fa-rub"
                                                                    aria-hidden="true"></i><sub>/мес</sub></span>
                            <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                            src="../../template/images/people.png" alt="">2 мин</span></p>
                        </div>
                    </div>
                    <div class="back-call">
                        <button class="back-call-web"><i class="fa fa-phone" aria-hidden="true"></i>Звонок через сайт</button>
                        <button class="back-call-message"><i class="fa fa-envelope" aria-hidden="true"></i>Написать сообщение</button>
                    </div>
                </div>
                <div class="right-information-block-apartment">
                    <p>Кол-во<br>комнат<span>1</span></p>
                    <p>Этаж<span>12 из 18</span></p>
                    <p>Безопасность<span>Консьерж видеонаблюдения</span></p>
                    <p>Комплектация<span>Полная</span></p>
                    <p>Высота<br>потолков<span>3.14м</span></p>
                    <p>Санузел<span>Сомещенный</span></p>
                    <p>Жилая<br>площадь<span>134м<sup>2</sup></span></p>
                    <p>Парковка<span>Нет</span></p>
                    <button>Смотреть полностью</button>
                    <div class="private-person">
                        <div class="person-user">
                            <img src="../../template/images/user-test.png" alt="user">
                            <span>Олег Герасимов</span>
                            <p>Олег Герасимов</p>
                        </div>
                        <div class="ad-close">
                            <p>Свернуть<a href="#"><img src="../../template/images/close.png" alt="clear"></a></p>
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
        </div>
    </div>
</div>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script src="/template/js/jquery.formstyler.min.js"></script>
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
<script src="/template/js/mapController.js"></script>
<script src="/template/js/jquery.bxslider.min.js"></script>
<script src="/template/js/forms.editor.handler.js"></script>
<script src="/bower_components/select2/dist/js/select2.min.js"></script>
<script src="/template/js/main.min.js"></script>
</body>
</html>