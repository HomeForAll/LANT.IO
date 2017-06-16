<ul id="scene">
    <li class="layer" data-depth="0.20"><img src="/template/images/paralax/home-1.png"></li>
    <li class="layer" data-depth="0.40"><img src="/template/images/paralax/home-2.png"></li>
    <li class="layer" data-depth="0.40"><img src="/template/images/paralax/tree-l.png"></li>
    <li class="layer" data-depth="0.60"><img src="/template/images/paralax/tree-r.png"></li>
    <li class="layer" data-depth="0.80"><img src="/template/images/paralax/back-1.png"></li>
</ul>
<div class="section-home-with-filters">
    <form action="/search" method="post" id="form_1" novalidate> <!--novalidate -->
        <div class="property-type-apartment-settings">
            <ul>
                <li>Жилая</li>
                <li onclick="filterOptionsApartments('key_1');">
                    <img src="/template/images/b-s-1.png" alt="icon">
                    <p>Квартира</p></li>
                <li onclick="filterOptionsApartments('key_2');">
                    <img src="/template/images/b-s-2.png" alt="icon">
                    <p>Дом</p></li>
                <li onclick="filterOptionsApartments('key_3');">
                    <img src="/template/images/b-s-3.png" alt="icon">
                    <p>Комната</p></li>
                <li onclick="filterOptionsApartments('key_4');">
                    <img src="/template/images/b-s-4.png" alt="icon">
                    <p>Земельный участок</p></li>
                <li onclick="filterOptionsApartments('key_5');">
                    <img src="/template/images/b-s-5.png" alt="icon">
                    <p>Гараж/машиноместо</p></li>
            </ul>
            <ul>
                <li>Коммерческая</li>
                <li onclick="filterOptionsApartments('key_6');">
                    <img src="/template/images/b-s-6.png" alt="icon">
                    <p>Офисная площадь</p></li>
                <li onclick="filterOptionsApartments('key_7');">
                    <img src="/template/images/b-s-1.png" alt="icon">
                    <p>Отдельно стоящее здание</p></li>
                <li onclick="filterOptionsApartments('key_8');">
                    <img src="/template/images/b-s-7.png" alt="icon">
                    <p>Комплекс ОСЗ</p></li>
                <li onclick="filterOptionsApartments('key_9');">
                    <img src="/template/images/b-s-8.png" alt="icon">
                    <p>Рынок/Ярмарка</p></li>
                <li onclick="filterOptionsApartments('key_10');">
                    <img src="/template/images/b-s-9.png" alt="icon">
                    <p>Производственно-складские помещения</p></li>
                <li onclick="filterOptionsApartments('key_11');">
                    <img src="/template/images/b-s-10.png" alt="icon">
                    <p>Производственно-складские здания</p></li>
                <li onclick="filterOptionsApartments('key_12');">
                    <img src="/template/images/b-s-11.png" alt="icon">
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
                        <input type="text" id="address" name="address" placeholder="Москва, ул, Малая Ордынка"
                               autocomplete="off" class="api-search-city">
                    </div>
                </div>
                <div class="main-filter" onclick="filterOptionsApartments()">
                        <span class="value-text">
                            <img src="/template/images/apartments.png" alt="apartments">Тип недвижимости
                        </span>
                </div>
                <div class="main-filter" onclick="allParam('bigOption')">
                    <label><img src="/template/images/s3.png" alt="price">Цена</label>
                    <div class="showBigOptions">
                        <p><label for="amountBeforeBy">От<input name="price-min" type="text" id="amountBeforeBy"
                                                                readonly disabled></label></p>
                        <p><label for="amountAfterBy">До<input name="price-max" type="text" id="amountAfterBy"
                                                               readonly disabled></label></p>
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
                                    <option value="">----------</option>
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
                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
                        </p>
                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
                        </p>
                    </li>
                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
                        </p>
                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
                        </p>
                    </li>
                    <li><span class="names-parameters">Балкон м2</span>
                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                        </p>
                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">
                        </p>
                    </li>
                    <li><span class="names-parameters">Высота потолков</span>
                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
                        </p>
                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
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
                                    <option value="">----------</option>
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
                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
                        </p>
                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
                        </p>
                    </li>
                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>
                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
                        </p>
                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3"
                                    pattern="[0-9]{3}">
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
                                    <option value="">----------</option>
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
                                    <option value="">----------</option>
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
                                    <option value="">----------</option>
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
                                    <option value="">----------</option>
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
                                    <option value="">----------</option>
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
                                    <option value="">----------</option>
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
                                    <img src="/template/images/s1.png" alt="city">
                                    <input type="text" id="address" name="address"
                                           placeholder="Москва, ул, Малая Ордынка" autocomplete="off"
                                           class="api-search-city history-text">
                                </span>
                        <h5>История</h5>
                        <div class="all-history-search">
                            <div class="history">
                                <img src="/template/images/m-r.png" alt="metro">
                                <p>Красные ворота<span>не более 15 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-w.png" alt="metro">
                                <p>Свиблово, Бабушкинская<span>не более 5 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-w.png" alt="metro">
                                <p>Академичекий<span>не более 5 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-r.png" alt="metro">
                                <p>Красные ворота<span>не более 15 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-w.png" alt="metro">
                                <p>Свиблово, Бабушкинская<span>не более 5 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-w.png" alt="metro">
                                <p>Академичекий<span>не более 5 мин пешком</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="the-exact-address">
                            <span onclick="allFilterBlocks('searchMetroMainBlock')" class="location-metro-map">Третьяковская
                                <span class="metro-people">
                                    <img src="/template/images/people.png" alt="people">2мин.</span>
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
                                <img src="/template/images/map-location-metro.png" alt="map">
                            </div>
                            <div class="travel-information">
                                <div class="distance-on-foot">
                                    <img src="/template/images/people-2.png" alt="icon">
                                    <p>Удаленность пекшом не более</p>
                                    <span><input type="number" name="foot" placeholder="5" value=""
                                                 max="60" step="5">
                                                <span class="timer">Минут</span></span>
                                </div>
                                <div class="distance-on-transport">
                                    <img src="/template/images/avto.png" alt="icon">
                                    <p>Удаленность пекшом не более</p>
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
                    <h5><i class="fa fa-map-marker" aria-hidden="true"></i>Введите город, район, область или точный
                        адрес</h5>
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
                                        <option value="">----------</option>
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
                                        <option value="">----------</option>
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
                                        <option value="">----------</option>
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
                                        <option value="">----------</option>
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
                                        <option value="">----------</option>
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
                            <img src="/template/images/apartments.png" alt="apartments">Тип недвижимости
                        </span>
                </li>
                <li onclick="allParam('bigOption')">
                    <label><img src="/template/images/s3.png" alt="price">Цена</label>
                    <div class="showBigOptions">
                        <p><label for="amountBeforeSearch">От<input name="price-min" type="text"
                                                                    id="amountBeforeSearch" readonly
                                                                    disabled></label></p>
                        <p><label for="amountAfterSearch">До<input name="price-max" type="text"
                                                                   id="amountAfterSearch" readonly disabled></label>
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
                <li>
                    <label for="clast">
                        <input name="bargain" id="clast" type="checkbox">Торг возможен
                    </label>
                </li>
                <li>
                    <div class="select"><img src="/template/images/ava.png" alt="icons">
                        <label for="object_located">
                            <select name="object_located" id="object_located">
                                <option value="">----------</option>
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
                            <img src="/template/images/timer.png" alt="icons">
                            <select name="lease" id="lease">
                                <option value="">----------</option>
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
                <ul class="render-building-parameters"></ul>
                <!--                    <ul class="building-parameters-apartment">-->
                <!--                        <li onclick="allParam('apartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Исходные параметры квартиры-->
                <!--                            <div class="apartment-settings">-->
                <!--                                <h2>Исходные параметры квартиры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="number_of_rooms">Кол-во комнат-->
                <!--                                                <select class="number-apartments" name="number_of_rooms"-->
                <!--                                                        id="number_of_rooms">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="5">4+</option>-->
                <!--                                                    <option value="4">4</option>-->
                <!--                                                    <option value="3">3</option>-->
                <!--                                                    <option value="2">2</option>-->
                <!--                                                    <option value="1">1</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="total-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="total-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Балкон м2</span>-->
                <!--                                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Высота потолков</span>-->
                <!--                                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Этаж</span>-->
                <!--                                        <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3" pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="lavatory">Санузел-->
                <!--                                                <select name="lavatory" id="lavatory">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="116">Раздельный</option>-->
                <!--                                                    <option value="29">Совмещенный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeBlock">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства квартиры-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства квартиры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Комнаты</p>-->
                <!--                                        <label>Ванная<input type="checkbox" name="bathroom"></label>-->
                <!--                                        <label>Столовая<input type="checkbox" name="dining_room"></label>-->
                <!--                                        <label>Рабочий кабинет <input type="checkbox" name="study"></label>-->
                <!--                                        <label>Детская<input type="checkbox" name="playroom"></label>-->
                <!--                                        <label>Прихожая<input type="checkbox" name="hallway"></label>-->
                <!--                                        <label>Гостиная<input type="checkbox" name="living_room"></label>-->
                <!--                                        <label>Кухня<input type="checkbox" name="kitchen"></label>-->
                <!--                                        <label>Спальня<input type="checkbox" name="bedroom"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="equipment">Комплектация-->
                <!--                                                <select name="equipment" id="equipment">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="45">Укомплектованная</option>-->
                <!--                                                    <option value="44">Пустая</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('houseCharacteristics')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Характеристики дома-->
                <!--                            <div class="house-characteristics">-->
                <!--                                <h2>Характеристики дома</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select more-settings">-->
                <!--                                            <label for="elevator">Наличие лифта-->
                <!--                                                <select name="elevator" id="elevator">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="1">Да</option>-->
                <!--                                                    <option value="0">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="elevator_yes">-->
                <!--                                                <select name="elevator_yes" id="elevator_yes">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="95">Пассажирский</option>-->
                <!--                                                    <option value="23">Грузовой</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label>Наличие мусоропровода<input type="checkbox" name="availability_of_garbage_chute"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="146">Год постройки\окончания строительства</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="5">Отсутствует</option>-->
                <!--                                                    <option value="7">Придомовой гараж</option>-->
                <!--                                                    <option value="52">Гаражный комплекс</option>-->
                <!--                                                    <option value="132">Подземная парковка</option>-->
                <!--                                                    <option value="81">Многоуровневый паркинг</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="91">Другое</option>-->
                <!--                                                    <option value="32">Железобетонные панели</option>-->
                <!--                                                    <option value="78">Монолит</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="stairwells_status">Состояние лестничных клеток-->
                <!--                                                <select name="stairwells_status" id="stairwells_status">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="134">Обычная отделка</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <p>Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>-->
                <!--                                        <label>Электричество <input type="checkbox" name="electricity"></label>-->
                <!--                                        <label>Газ <input type="checkbox" name="gas"></label>-->
                <!--                                        <label>Отопление <input type="checkbox" name="heating"></label>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания строительства:-->
                <!--                                            <input id="year_of_construction-min" name="year_of_construction-min"-->
                <!--                                                   type="text" placeholder="от">-->
                <!--                                            <input id="year_of_construction-max" name="year_of_construction-max"-->
                <!--                                                   type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-house-characteristics">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-home">-->
                <!--                        <li onclick="allParam('objectParameters')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Параметры объекта-->
                <!--                            <div class="object-parameters">-->
                <!--                                <h2>Параметры объекта</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="residential-min">Жилая:-->
                <!--                                            <input id="residential-min" name="residential-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="residential-max" name="residential-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="not_residential-min">Нежилая:-->
                <!--                                            <input id="not_residential-min" name="not_residential-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="not_residential-max" name="not_residential-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="total-min">Общая:-->
                <!--                                            <input id="total-min" name="total-min" type="text" placeholder="от">-->
                <!--                                            <input id="total-max" name="total-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="balcony-min">Балкон:-->
                <!--                                            <input id="balcony-min" name="balcony-min" type="text" placeholder="от">-->
                <!--                                            <input id="balcony-max" name="balcony-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="number_of_rooms">Количество комнат-->
                <!--                                                <select name="number_of_rooms" id="number_of_rooms">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="4">4+</option>-->
                <!--                                                    <option value="3">3</option>-->
                <!--                                                    <option value="2">2</option>-->
                <!--                                                    <option value="1">1</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="number_of_rooms">Количество комнат-->
                <!--                                                <select name="number_of_rooms" id="number_of_rooms">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="4">4+</option>-->
                <!--                                                    <option value="3">3</option>-->
                <!--                                                    <option value="2">2</option>-->
                <!--                                                    <option value="1">1</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:</label>-->
                <!--                                        <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:</label>-->
                <!--                                        <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="lavatory">Санузел-->
                <!--                                                <select name="lavatory" id="lavatory">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="116">Раздельный</option>-->
                <!--                                                    <option value="29">Совмещенный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="roofing">Кровля-->
                <!--                                                <select name="roofing" id="roofing">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="127">Временная</option>-->
                <!--                                                    <option value="118">Шифер</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="123">Солома</option>-->
                <!--                                                    <option value="129">Черепица</option>-->
                <!--                                                    <option value="76">Металлочерепица</option>-->
                <!--                                                    <option value="34">Медь</option>-->
                <!--                                                    <option value="67">Железо</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="foundation">Фундамент-->
                <!--                                                <select name="foundation" id="foundation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="140">Без фундамента</option>-->
                <!--                                                    <option value="58">Ростверк</option>-->
                <!--                                                    <option value="109">Ленточный</option>-->
                <!--                                                    <option value="125">Шведская плита</option>-->
                <!--                                                    <option value="120">Монолитная плита</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="49">Фахверк</option>-->
                <!--                                                    <option value="56">Клееный брус</option>-->
                <!--                                                    <option value="102">Профилированный брус</option>-->
                <!--                                                    <option value="112">Оцилиндрованное бревно</option>-->
                <!--                                                    <option value="24">Лафет</option>-->
                <!--                                                    <option value="27">Рубленое дерево</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="28">Шлакоблоки</option>-->
                <!--                                                    <option value="55">Газосиликатные блоки</option>-->
                <!--                                                    <option value="96">Пеноблок</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="type_of_house">Тип дома-->
                <!--                                                <select name="type_of_house" id="type_of_house">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="35">Коттедж</option>-->
                <!--                                                    <option value="130">Таунхаус</option>-->
                <!--                                                    <option value="42">Дуплекс</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-object-parameters">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfHome')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства дома-->
                <!--                            <div class="repair-and-utilities-of-home">-->
                <!--                                <h2>Ремонт и обустройства дома</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Комнаты</p>-->
                <!--                                        <label>Ванная<input type="checkbox" name="bathroom"></label>-->
                <!--                                        <label>Столовая<input type="checkbox" name="dining_room"></label>-->
                <!--                                        <label>Рабочий кабинет <input type="checkbox" name="study"></label>-->
                <!--                                        <label>Детская<input type="checkbox" name="playroom"></label>-->
                <!--                                        <label>Прихожая<input type="checkbox" name="hallway"></label>-->
                <!--                                        <label>Гостиная<input type="checkbox" name="living_room"></label>-->
                <!--                                        <label>Кухня<input type="checkbox" name="kitchen"></label>-->
                <!--                                        <label>Спальня<input type="checkbox" name="bedroom"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="equipment">Комплектация-->
                <!--                                                <select name="equipment" id="equipment">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="45">Укомплектованная</option>-->
                <!--                                                    <option value="44">Пустая</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания строительства:-->
                <!--                                            <input id="year_of_construction-min" name="year_of_construction-min"-->
                <!--                                                   type="text" placeholder="от">-->
                <!--                                            <input id="year_of_construction-max" name="year_of_construction-max"-->
                <!--                                                   type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <span>Жилищно-коммунальные услуги</span>-->
                <!--                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>-->
                <!--                                        <label>Электричество <input type="checkbox" name="electricity"></label>-->
                <!--                                        <label>Отопление <input type="checkbox" name="heating"></label>-->
                <!--                                        <label>Газ <input type="checkbox" name="gas"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <span>Безопасность</span>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-home">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('plotOfLand');">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-3.png" alt="search">Участок-->
                <!--                            <div class="plot-of-land">-->
                <!--                                <h2>Участок</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">Участок-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="5">Отсутствует</option>-->
                <!--                                                    <option value="7">Придомовой гараж</option>-->
                <!--                                                    <option value="52">Гаражный комплекс</option>-->
                <!--                                                    <option value="132">Подземная парковка</option>-->
                <!--                                                    <option value="81">Многоуровневый паркинг</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">Дополнительные строения-->
                <!--                                            <label>Сторожка <input type="checkbox" name="lodge"></label>-->
                <!--                                            <label>Гостевой дом <input type="checkbox" name="guest_house"></label>-->
                <!--                                            <label>Баня <input type="checkbox" name="bath"></label>-->
                <!--                                            <label>Бассейн <input type="checkbox" name="swimming_pool"></label>-->
                <!--                                            <label>Детская площадка <input type="checkbox" name="playground"></label>-->
                <!--                                            <label>Винный погреб <input type="checkbox" name="wine_vault"></label>-->
                <!--                                            <label>Сарай <input type="checkbox" name="barn"></label>-->
                <!--                                            <label>Беседка <input type="checkbox" name="alcove"></label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="site">Участок-->
                <!--                                                <select name="site" id="site">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="136">Заболоченный</option>-->
                <!--                                                    <option value="103">Овраг</option>-->
                <!--                                                    <option value="89">На склоне</option>-->
                <!--                                                    <option value="133">Неровный</option>-->
                <!--                                                    <option value="119">Ровный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <p>На участке</p>-->
                <!--                                            <label>Берег водоема <input type="checkbox" name="waterfront"></label>-->
                <!--                                            <label>Река <input type="checkbox" name="river"></label>-->
                <!--                                            <label>Родник <input type="checkbox" name="spring"></label>-->
                <!--                                            <label>Садовые деревья <input type="checkbox" name="garden_trees"></label>-->
                <!--                                            <label>Лесные деревья <input type="checkbox" name="forest_trees"></label>-->
                <!--                                            <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-plot-of-land">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-room">-->
                <!--                        <li onclick="allParam('apartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Исходные параметры квартиры-->
                <!--                            <div class="apartment-settings">-->
                <!--                                <h2>Исходные параметры квартиры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="number_of_rooms">Кол-во комнат-->
                <!--                                                <select class="number-apartments" name="number_of_rooms"-->
                <!--                                                        id="number_of_rooms">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="5">4+</option>-->
                <!--                                                    <option value="4">4</option>-->
                <!--                                                    <option value="3">3</option>-->
                <!--                                                    <option value="2">2</option>-->
                <!--                                                    <option value="1">1</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="total-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="total-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Балкон м2</span>-->
                <!--                                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Высота потолков</span>-->
                <!--                                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Этаж</span>-->
                <!--                                        <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="lavatory">Санузел-->
                <!--                                                <select name="lavatory" id="lavatory">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="116">Раздельный</option>-->
                <!--                                                    <option value="29">Совмещенный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeBlock">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('apperanceOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Внешний вид квартиры-->
                <!--                            <div class="appearance-of-the-apartment">-->
                <!--                                <h2>Внешний вид квартиры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="object_located">Объект размещен-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="22">Риэлтором</option>-->
                <!--                                                    <option value="21">Собственником</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="search">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('buildingParametersFilter');">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-3.png" alt="search">Параметры здания-->
                <!--                            <div class="building-parameters-filter">-->
                <!--                                <h2>Параметры здания</h2>-->
                <!--                                <ul>-->
                <!--                                    <li><span class="names-parameters">Количество этажей</span>-->
                <!--                                        <p>От<input name="0" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}"-->
                <!--                                            ></p>-->
                <!--                                        <p>До<input name="0" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}"-->
                <!--                                            ></p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Год окончания строительства</span>-->
                <!--                                        <p>От<input name="0" type="text" placeholder="0" maxlength="4"-->
                <!--                                                    pattern="[0-9]{4}"-->
                <!--                                            ></p>-->
                <!--                                        <p>До<input name="0" type="text" placeholder="0" maxlength="4"-->
                <!--                                                    pattern="[0-9]{4}"-->
                <!--                                            ></p>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="0">-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option>Language</option>-->
                <!--                                                    <option>English</option>-->
                <!--                                                    <option>Spanish</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="0">-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option>Language</option>-->
                <!--                                                    <option>English</option>-->
                <!--                                                    <option>Spanish</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="0">-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option>Language</option>-->
                <!--                                                    <option>English</option>-->
                <!--                                                    <option>Spanish</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="0">-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option>Language</option>-->
                <!--                                                    <option>English</option>-->
                <!--                                                    <option>Spanish</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-building-parameter">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('appearanceBuild')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Исходные параметры-->
                <!--                            <div class="appearance-of-the-build">-->
                <!--                                <h2>Исходные параметры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="space-min">Площадь:</label>-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                            <label for="ceiling_height-min">Высота потолков:</label>-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                            <label for="number_of_floors-min">Количество этажей:-->
                <!--                                                <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                       placeholder="от">-->
                <!--                                                <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                       placeholder="до">-->
                <!--                                            </label>-->
                <!--                                            <label for="type_of_construction">Вид постройки:-->
                <!--                                                <select name="type_of_construction" id="type_of_construction">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="111">Комнаты</option>-->
                <!--                                                    <option value="90">Опен спэйс</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                            <label for="number_of_rooms-min">Количество комнат:-->
                <!--                                                <input id="number_of_rooms-min" name="number_of_rooms-min" type="text"-->
                <!--                                                       placeholder="от">-->
                <!--                                                <input id="number_of_rooms-max" name="number_of_rooms-max" type="text"-->
                <!--                                                       placeholder="до">-->
                <!--                                            </label>-->
                <!--                                            <label for="year_of_construction-min">Год постройки/окончания строительства:-->
                <!--                                                <input id="year_of_construction-min" name="year_of_construction-min"-->
                <!--                                                       type="text" placeholder="от">-->
                <!--                                                <input id="year_of_construction-max" name="year_of_construction-max"-->
                <!--                                                       type="text" placeholder="до">-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="building_type">Тип здания-->
                <!--                                                <select name="building_type" id="building_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="108">Жилое</option>-->
                <!--                                                    <option value="8">Административное</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="roofing">Кровля-->
                <!--                                                <select name="roofing" id="roofing">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="67">Железо</option>-->
                <!--                                                    <option value="34">Медь</option>-->
                <!--                                                    <option value="76">Металлочерепица</option>-->
                <!--                                                    <option value="113">Пескобетонная черепица</option>-->
                <!--                                                    <option value="129">Черепица</option>-->
                <!--                                                    <option value="123">Солома</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="118">Шифер</option>-->
                <!--                                                    <option value="88">Ондулин</option>-->
                <!--                                                    <option value="127">Временная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="foundation">Фундамент-->
                <!--                                                <select name="foundation" id="foundation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="120">Монолитная плита</option>-->
                <!--                                                    <option value="125">Шведская плита</option>-->
                <!--                                                    <option value="109">Ленточный</option>-->
                <!--                                                    <option value="58">Ростверк</option>-->
                <!--                                                    <option value="140">Без фундамента</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="49">Фахверк</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="78">Монолит</option>-->
                <!--                                                    <option value="96">Пеноблок</option>-->
                <!--                                                    <option value="55">Газосиликатные блоки</option>-->
                <!--                                                    <option value="28">Шлакоблоки</option>-->
                <!--                                                    <option value="27">Рубленое дерево</option>-->
                <!--                                                    <option value="24">Лафет</option>-->
                <!--                                                    <option value="112">Оцилиндрованное бревно</option>-->
                <!--                                                    <option value="102">Профилированный брус</option>-->
                <!--                                                    <option value="56">Клееный брус</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeApparenceBuild">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-office-area">-->
                <!--                        <li onclick="allParam('appearanceBuild')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Исходные параметры-->
                <!--                            <div class="appearance-of-the-build">-->
                <!--                                <h2>Исходные параметры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="space-min">Площадь:</label>-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                            <label for="ceiling_height-min">Высота потолков:</label>-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                            <label for="number_of_floors-min">Количество этажей:-->
                <!--                                                <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                       placeholder="от">-->
                <!--                                                <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                       placeholder="до">-->
                <!--                                            </label>-->
                <!--                                            <label for="type_of_construction">Вид постройки:-->
                <!--                                                <select name="type_of_construction" id="type_of_construction">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="111">Комнаты</option>-->
                <!--                                                    <option value="90">Опен спэйс</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                            <label for="number_of_rooms-min">Количество комнат:-->
                <!--                                                <input id="number_of_rooms-min" name="number_of_rooms-min" type="text"-->
                <!--                                                       placeholder="от">-->
                <!--                                                <input id="number_of_rooms-max" name="number_of_rooms-max" type="text"-->
                <!--                                                       placeholder="до">-->
                <!--                                            </label>-->
                <!--                                            <label for="year_of_construction-min">Год постройки/окончания строительства:-->
                <!--                                                <input id="year_of_construction-min" name="year_of_construction-min"-->
                <!--                                                       type="text" placeholder="от">-->
                <!--                                                <input id="year_of_construction-max" name="year_of_construction-max"-->
                <!--                                                       type="text" placeholder="до">-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="building_type">Тип здания-->
                <!--                                                <select name="building_type" id="building_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="108">Жилое</option>-->
                <!--                                                    <option value="8">Административное</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="roofing">Кровля-->
                <!--                                                <select name="roofing" id="roofing">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="67">Железо</option>-->
                <!--                                                    <option value="34">Медь</option>-->
                <!--                                                    <option value="76">Металлочерепица</option>-->
                <!--                                                    <option value="113">Пескобетонная черепица</option>-->
                <!--                                                    <option value="129">Черепица</option>-->
                <!--                                                    <option value="123">Солома</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="118">Шифер</option>-->
                <!--                                                    <option value="88">Ондулин</option>-->
                <!--                                                    <option value="127">Временная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="foundation">Фундамент-->
                <!--                                                <select name="foundation" id="foundation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="120">Монолитная плита</option>-->
                <!--                                                    <option value="125">Шведская плита</option>-->
                <!--                                                    <option value="109">Ленточный</option>-->
                <!--                                                    <option value="58">Ростверк</option>-->
                <!--                                                    <option value="140">Без фундамента</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="49">Фахверк</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="78">Монолит</option>-->
                <!--                                                    <option value="96">Пеноблок</option>-->
                <!--                                                    <option value="55">Газосиликатные блоки</option>-->
                <!--                                                    <option value="28">Шлакоблоки</option>-->
                <!--                                                    <option value="27">Рубленое дерево</option>-->
                <!--                                                    <option value="24">Лафет</option>-->
                <!--                                                    <option value="112">Оцилиндрованное бревно</option>-->
                <!--                                                    <option value="102">Профилированный брус</option>-->
                <!--                                                    <option value="56">Клееный брус</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeApparenceBuild">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox" name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-separate-building">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-ozs-сomplex">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <!--<li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select value="name="bathroom_location" id="sanitation">-->
                <!--                                                <option value=>---</option>-->
                <!--                                            </select>-->
                <!--                                        </div>
                    <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-7">-->
                <!--                        <li onclick="allParam('mainSettings')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основные параметры-->
                <!--                            <div class="main-settings">-->
                <!--                                <h2>Основные параметры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="59">Земли под размещение промышленных и коммерческих-->
                <!--                                                        объектов-->
                <!--                                                    </option>-->
                <!--                                                    <option value="9">Сельскохозяйственные земли</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="site">Участок-->
                <!--                                                <select name="site" id="site">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="136">Заболоченный</option>-->
                <!--                                                    <option value="103">Овраг</option>-->
                <!--                                                    <option value="89">На склоне</option>-->
                <!--                                                    <option value="133">Неровный</option>-->
                <!--                                                    <option value="119">Ровный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p>На участке</p>-->
                <!--                                        <label>Берег водоема <input type="checkbox" name="waterfront"></label>-->
                <!--                                        <label>Река <input type="checkbox" name="river"></label>-->
                <!--                                        <label>Родник <input type="checkbox" name="spring"></label>-->
                <!--                                        <label>Садовые деревья <input type="checkbox" name="garden_trees"></label>-->
                <!--                                        <label>Лесные деревья <input type="checkbox" name="forest_trees"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainSettings">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('furnishing')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Обустройства-->
                <!--                            <div class="furnishing">-->
                <!--                                <h2>Обустройство</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="5">Отсутствует</option>-->
                <!--                                                    <option value="7">Придомовой гараж</option>-->
                <!--                                                    <option value="52">Гаражный комплекс</option>-->
                <!--                                                    <option value="132">Подземная парковка</option>-->
                <!--                                                    <option value="81">Многоуровневый паркинг</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p>Дополнительные строения</p>-->
                <!--                                        <label>Сторожка <input type="checkbox" name="lodge"></label>-->
                <!--                                        <label>Гостевой дом <input type="checkbox" name="guest_house"></label>-->
                <!--                                        <label>Баня <input type="checkbox" name="bath"></label>-->
                <!--                                        <label>Бассейн <input type="checkbox" name="swimming_pool"></label>-->
                <!--                                        <label>Детская площадка <input type="checkbox" name="playground"></label>-->
                <!--                                        <label>Винный погреб <input type="checkbox" name="wine_vault"></label>-->
                <!--                                        <label>Сарай <input type="checkbox" name="barn"></label>-->
                <!--                                        <label>Беседка <input type="checkbox" name="alcove"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p>Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>-->
                <!--                                        <label>Электричество <input type="checkbox" name="electricity"></label>-->
                <!--                                        <label>Отопление <input type="checkbox" name="heating"></label>-->
                <!--                                        <label>Газ <input type="checkbox" name="gas"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeFurnishing">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-8">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('additionallyAp')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Дополнительно-->
                <!--                            <div class="additionally-ap">-->
                <!--                                <h2>Дополнительно</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="roofing">Кровля-->
                <!--                                                <select name="roofing" id="roofing">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="127">Временная</option>-->
                <!--                                                    <option value="118">Шифер</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="123">Солома</option>-->
                <!--                                                    <option value="129">Черепица</option>-->
                <!--                                                    <option value="76">Металлочерепица</option>-->
                <!--                                                    <option value="34">Медь</option>-->
                <!--                                                    <option value="67">Железо</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="foundation">Фундамент-->
                <!--                                                <select name="foundation" id="foundation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="140">Без фундамента</option>-->
                <!--                                                    <option value="58">Ростверк</option>-->
                <!--                                                    <option value="109">Ленточный</option>-->
                <!--                                                    <option value="125">Шведская плита</option>-->
                <!--                                                    <option value="120">Монолитная плита</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="49">Фахверк</option>-->
                <!--                                                    <option value="56">Клееный брус</option>-->
                <!--                                                    <option value="102">Профилированный брус</option>-->
                <!--                                                    <option value="112">Оцилиндрованное бревно</option>-->
                <!--                                                    <option value="24">Лафет</option>-->
                <!--                                                    <option value="27">Рубленое дерево</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="28">Шлакоблоки</option>-->
                <!--                                                    <option value="55">Газосиликатные блоки</option>-->
                <!--                                                    <option value="96">Пеноблок</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAdditionallyAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-9">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-10">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <!-- <li>-->
                <!--                                         <div class="select">-->
                <!--                                             <select value="name="bathroom_location" id="sanitation">-->
                <!--                                                 <option value=>---</option>-->
                <!--                                             </select>-->
                <!--                                         </div>-->
                <!--                                     </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-11">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!---->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-12">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-13">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-14">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки<input type="checkbox"-->
                <!--                                                                          name="possible_to_post"></label>-->
                <!--                                        <label>Описание<input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <div id="map">
                    <input type="text" id="address" name="address" placeholder="Введите адрес..." autocomplete="off"
                           class="api-search-city">
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
                                <img src="/template/images/s1.png" alt="city">
                                <input type="text" id="address" name="address" placeholder="Москва, ул, Малая Ордынка"
                                       autocomplete="off" class="api-search-city history-text">
                            </span>
                        <h5>История</h5>
                        <div class="all-history-search">
                            <div class="history">
                                <img src="/template/images/m-r.png" alt="metro">
                                <p>Красные ворота<span>не более 15 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-w.png" alt="metro">
                                <p>Свиблово, Бабушкинская<span>не более 5 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-w.png" alt="metro">
                                <p>Академичекий<span>не более 5 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-r.png" alt="metro">
                                <p>Красные ворота<span>не более 15 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-w.png" alt="metro">
                                <p>Свиблово, Бабушкинская<span>не более 5 мин пешком</span></p>
                            </div>
                            <div class="history">
                                <img src="/template/images/m-w.png" alt="metro">
                                <p>Академичекий<span>не более 5 мин пешком</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="the-exact-address">
                        <span onclick="allFilterBlocks('searchMetroMainBlock')" class="location-metro-map">Третьяковская
                            <span class="metro-people"><img src="/template/images/people.png"
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
                                <img src="/template/images/map-location-metro.png" alt="map">
                            </div>
                            <div class="travel-information">
                                <div class="distance-on-foot">
                                    <img src="/template/images/people-2.png" alt="icon">
                                    <p>Уделенность пекшом не более</p>
                                    <span><input placeholder="5" type="number" name="foot" value=""
                                                 max="60" step="5"><span class="timer">Минут</span></span>
                                </div>
                                <div class="distance-on-transport">
                                    <img src="/template/images/avto.png" alt="icon">
                                    <p>Уделенность пекшом не более</p>
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
                    <h5><i class="fa fa-map-marker" aria-hidden="true"></i>Введите город, район, область или точный
                        адрес</h5>
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
                                        <option value="">----------</option>
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
                                        <option value="">----------</option>
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
                                        <option value="">----------</option>
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
                            <img src="/template/images/apartments.png" alt="apartments">Тип недвижимости
                        </span>
                </li>
                <li onclick="allParam('bigOption')">

                    <label><img src="/template/images/s3.png" alt="price">Цена</label>
                    <div class="showBigOptions">
                        <p><label for="amountBefore">От<input name="price-min" type="text" id="amountBefore"
                                                              readonly></p>
                        <p><label for="amountAfter">До<input name="price-max" type="text" id="amountAfter" readonly>
                        </p>
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
                    <div class="select"><img src="/template/images/ava.png" alt="icons">
                        <label for="object_located">
                            <select name="object_located" id="object_located">
                                <option value="">----------</option>
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
                <ul class="render-building-parameters"></ul>
                <!--                    <ul class="building-parameters-apartment">-->
                <!--                        <li onclick="allParam('apartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Исходные параметры квартиры-->
                <!--                            <div class="apartment-settings">-->
                <!--                                <h2>Исходные параметры квартиры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="number_of_rooms">Кол-во комнат-->
                <!--                                                <select class="number-apartments" name="number_of_rooms"-->
                <!--                                                        id="number_of_rooms">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="5">4+</option>-->
                <!--                                                    <option value="4">4</option>-->
                <!--                                                    <option value="3">3</option>-->
                <!--                                                    <option value="2">2</option>-->
                <!--                                                    <option value="1">1</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="total-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="total-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Балкон м2</span>-->
                <!--                                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Высота потолков</span>-->
                <!--                                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Этаж</span>-->
                <!--                                        <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="lavatory">Санузел-->
                <!--                                                <select name="lavatory" id="lavatory">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="116">Раздельный</option>-->
                <!--                                                    <option value="29">Совмещенный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeBlock">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства квартиры-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства квартиры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Комнаты</p>-->
                <!--                                        <label>Ванная<input type="checkbox" name="bathroom"></label>-->
                <!--                                        <label>Столовая<input type="checkbox" name="dining_room"></label>-->
                <!--                                        <label>Рабочий кабинет <input type="checkbox" name="study"></label>-->
                <!--                                        <label>Детская<input type="checkbox" name="playroom"></label>-->
                <!--                                        <label>Прихожая<input type="checkbox" name="hallway"></label>-->
                <!--                                        <label>Гостиная<input type="checkbox" name="living_room"></label>-->
                <!--                                        <label>Кухня<input type="checkbox" name="kitchen"></label>-->
                <!--                                        <label>Спальня<input type="checkbox" name="bedroom"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="equipment">Комплектация-->
                <!--                                                <select name="equipment" id="equipment">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="45">Укомплектованная</option>-->
                <!--                                                    <option value="44">Пустая</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('houseCharacteristics')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Характеристики дома-->
                <!--                            <div class="house-characteristics">-->
                <!--                                <h2>Характеристики дома</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select more-settings">-->
                <!--                                            <label for="elevator">Наличие лифта-->
                <!--                                                <select name="elevator" id="elevator">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="1">Да</option>-->
                <!--                                                    <option value="0">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="elevator_yes">-->
                <!--                                                <select name="elevator_yes" id="elevator_yes">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="95">Пассажирский</option>-->
                <!--                                                    <option value="23">Грузовой</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label>Наличие мусоропровода<input type="checkbox"-->
                <!--                                                                           name="availability_of_garbage_chute"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="146">Год постройки\окончания строительства</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="5">Отсутствует</option>-->
                <!--                                                    <option value="7">Придомовой гараж</option>-->
                <!--                                                    <option value="52">Гаражный комплекс</option>-->
                <!--                                                    <option value="132">Подземная парковка</option>-->
                <!--                                                    <option value="81">Многоуровневый паркинг</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="91">Другое</option>-->
                <!--                                                    <option value="32">Железобетонные панели</option>-->
                <!--                                                    <option value="78">Монолит</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="stairwells_status">Состояние лестничных клеток-->
                <!--                                                <select name="stairwells_status" id="stairwells_status">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="134">Обычная отделка</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <p>Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>-->
                <!--                                        <label>Электричество <input type="checkbox" name="electricity"></label>-->
                <!--                                        <label>Газ <input type="checkbox" name="gas"></label>-->
                <!--                                        <label>Отопление <input type="checkbox" name="heating"></label>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания строительства:-->
                <!--                                            <input id="year_of_construction-min" name="year_of_construction-min"-->
                <!--                                                   type="text" placeholder="от">-->
                <!--                                            <input id="year_of_construction-max" name="year_of_construction-max"-->
                <!--                                                   type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-house-characteristics">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-home">-->
                <!--                        <li onclick="allParam('objectParameters')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Параметры объекта-->
                <!--                            <div class="object-parameters">-->
                <!--                                <h2>Параметры объекта</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="residential-min">Жилая:-->
                <!--                                            <input id="residential-min" name="residential-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="residential-max" name="residential-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="not_residential-min">Нежилая:-->
                <!--                                            <input id="not_residential-min" name="not_residential-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="not_residential-max" name="not_residential-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="total-min">Общая:-->
                <!--                                            <input id="total-min" name="total-min" type="text" placeholder="от">-->
                <!--                                            <input id="total-max" name="total-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="balcony-min">Балкон:-->
                <!--                                            <input id="balcony-min" name="balcony-min" type="text" placeholder="от">-->
                <!--                                            <input id="balcony-max" name="balcony-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="number_of_rooms">Количество комнат-->
                <!--                                                <select name="number_of_rooms" id="number_of_rooms">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="4">4+</option>-->
                <!--                                                    <option value="3">3</option>-->
                <!--                                                    <option value="2">2</option>-->
                <!--                                                    <option value="1">1</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="number_of_rooms">Количество комнат-->
                <!--                                                <select name="number_of_rooms" id="number_of_rooms">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="4">4+</option>-->
                <!--                                                    <option value="3">3</option>-->
                <!--                                                    <option value="2">2</option>-->
                <!--                                                    <option value="1">1</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:</label>-->
                <!--                                        <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:</label>-->
                <!--                                        <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="lavatory">Санузел-->
                <!--                                                <select name="lavatory" id="lavatory">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="116">Раздельный</option>-->
                <!--                                                    <option value="29">Совмещенный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="roofing">Кровля-->
                <!--                                                <select name="roofing" id="roofing">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="127">Временная</option>-->
                <!--                                                    <option value="118">Шифер</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="123">Солома</option>-->
                <!--                                                    <option value="129">Черепица</option>-->
                <!--                                                    <option value="76">Металлочерепица</option>-->
                <!--                                                    <option value="34">Медь</option>-->
                <!--                                                    <option value="67">Железо</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="foundation">Фундамент-->
                <!--                                                <select name="foundation" id="foundation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="140">Без фундамента</option>-->
                <!--                                                    <option value="58">Ростверк</option>-->
                <!--                                                    <option value="109">Ленточный</option>-->
                <!--                                                    <option value="125">Шведская плита</option>-->
                <!--                                                    <option value="120">Монолитная плита</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="49">Фахверк</option>-->
                <!--                                                    <option value="56">Клееный брус</option>-->
                <!--                                                    <option value="102">Профилированный брус</option>-->
                <!--                                                    <option value="112">Оцилиндрованное бревно</option>-->
                <!--                                                    <option value="24">Лафет</option>-->
                <!--                                                    <option value="27">Рубленое дерево</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="28">Шлакоблоки</option>-->
                <!--                                                    <option value="55">Газосиликатные блоки</option>-->
                <!--                                                    <option value="96">Пеноблок</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="type_of_house">Тип дома-->
                <!--                                                <select name="type_of_house" id="type_of_house">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="35">Коттедж</option>-->
                <!--                                                    <option value="130">Таунхаус</option>-->
                <!--                                                    <option value="42">Дуплекс</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-object-parameters">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfHome')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства дома-->
                <!--                            <div class="repair-and-utilities-of-home">-->
                <!--                                <h2>Ремонт и обустройства дома</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Комнаты</p>-->
                <!--                                        <label>Ванная<input type="checkbox" name="bathroom"></label>-->
                <!--                                        <label>Столовая<input type="checkbox" name="dining_room"></label>-->
                <!--                                        <label>Рабочий кабинет <input type="checkbox" name="study"></label>-->
                <!--                                        <label>Детская<input type="checkbox" name="playroom"></label>-->
                <!--                                        <label>Прихожая<input type="checkbox" name="hallway"></label>-->
                <!--                                        <label>Гостиная<input type="checkbox" name="living_room"></label>-->
                <!--                                        <label>Кухня<input type="checkbox" name="kitchen"></label>-->
                <!--                                        <label>Спальня<input type="checkbox" name="bedroom"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="equipment">Комплектация-->
                <!--                                                <select name="equipment" id="equipment">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="45">Укомплектованная</option>-->
                <!--                                                    <option value="44">Пустая</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания строительства:-->
                <!--                                            <input id="year_of_construction-min" name="year_of_construction-min"-->
                <!--                                                   type="text" placeholder="от">-->
                <!--                                            <input id="year_of_construction-max" name="year_of_construction-max"-->
                <!--                                                   type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <span>Жилищно-коммунальные услуги</span>-->
                <!--                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>-->
                <!--                                        <label>Электричество <input type="checkbox" name="electricity"></label>-->
                <!--                                        <label>Отопление <input type="checkbox" name="heating"></label>-->
                <!--                                        <label>Газ <input type="checkbox" name="gas"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <span>Безопасность</span>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-home">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('plotOfLand');">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-3.png" alt="search">Участок-->
                <!--                            <div class="plot-of-land">-->
                <!--                                <h2>Участок</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">Участок-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="5">Отсутствует</option>-->
                <!--                                                    <option value="7">Придомовой гараж</option>-->
                <!--                                                    <option value="52">Гаражный комплекс</option>-->
                <!--                                                    <option value="132">Подземная парковка</option>-->
                <!--                                                    <option value="81">Многоуровневый паркинг</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">Дополнительные строения-->
                <!--                                            <label>Сторожка <input type="checkbox" name="lodge"></label>-->
                <!--                                            <label>Гостевой дом <input type="checkbox" name="guest_house"></label>-->
                <!--                                            <label>Баня <input type="checkbox" name="bath"></label>-->
                <!--                                            <label>Бассейн <input type="checkbox" name="swimming_pool"></label>-->
                <!--                                            <label>Детская площадка <input type="checkbox" name="playground"></label>-->
                <!--                                            <label>Винный погреб <input type="checkbox" name="wine_vault"></label>-->
                <!--                                            <label>Сарай <input type="checkbox" name="barn"></label>-->
                <!--                                            <label>Беседка <input type="checkbox" name="alcove"></label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="site">Участок-->
                <!--                                                <select name="site" id="site">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="136">Заболоченный</option>-->
                <!--                                                    <option value="103">Овраг</option>-->
                <!--                                                    <option value="89">На склоне</option>-->
                <!--                                                    <option value="133">Неровный</option>-->
                <!--                                                    <option value="119">Ровный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <p>На участке</p>-->
                <!--                                            <label>Берег водоема <input type="checkbox" name="waterfront"></label>-->
                <!--                                            <label>Река <input type="checkbox" name="river"></label>-->
                <!--                                            <label>Родник <input type="checkbox" name="spring"></label>-->
                <!--                                            <label>Садовые деревья <input type="checkbox" name="garden_trees"></label>-->
                <!--                                            <label>Лесные деревья <input type="checkbox" name="forest_trees"></label>-->
                <!--                                            <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-plot-of-land">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-room">-->
                <!--                        <li onclick="allParam('apartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Исходные параметры квартиры-->
                <!--                            <div class="apartment-settings">-->
                <!--                                <h2>Исходные параметры квартиры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="number_of_rooms">Кол-во комнат-->
                <!--                                                <select class="number-apartments" name="number_of_rooms"-->
                <!--                                                        id="number_of_rooms">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="5">4+</option>-->
                <!--                                                    <option value="4">4</option>-->
                <!--                                                    <option value="3">3</option>-->
                <!--                                                    <option value="2">2</option>-->
                <!--                                                    <option value="1">1</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Общая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="total-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="total-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Нежилая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="not_residential-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="not_residential-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Жилая площадь м<sup>2</sup></span>-->
                <!--                                        <p>От<input name="residential-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="residential-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Балкон м2</span>-->
                <!--                                        <p>От<input name="balcony-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="balcony-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Высота потолков</span>-->
                <!--                                        <p>От<input name="ceiling_height-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="ceiling_height-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Этаж</span>-->
                <!--                                        <p>От<input name="floor-min" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                        <p>До<input name="floor-max" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}">-->
                <!--                                        </p>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="lavatory">Санузел-->
                <!--                                                <select name="lavatory" id="lavatory">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="116">Раздельный</option>-->
                <!--                                                    <option value="29">Совмещенный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeBlock">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('apperanceOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Внешний вид квартиры-->
                <!--                            <div class="appearance-of-the-apartment">-->
                <!--                                <h2>Внешний вид квартиры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="object_located">Объект размещен-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="22">Риэлтором</option>-->
                <!--                                                    <option value="21">Собственником</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="search">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('buildingParametersFilter');">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-3.png" alt="search">Параметры здания-->
                <!--                            <div class="building-parameters-filter">-->
                <!--                                <h2>Параметры здания</h2>-->
                <!--                                <ul>-->
                <!--                                    <li><span class="names-parameters">Количество этажей</span>-->
                <!--                                        <p>От<input name="0" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}"-->
                <!--                                            ></p>-->
                <!--                                        <p>До<input name="0" type="text" placeholder="0" maxlength="3"-->
                <!--                                                    pattern="[0-9]{3}"-->
                <!--                                            ></p>-->
                <!--                                    </li>-->
                <!--                                    <li><span class="names-parameters">Год окончания строительства</span>-->
                <!--                                        <p>От<input name="0" type="text" placeholder="0" maxlength="4"-->
                <!--                                                    pattern="[0-9]{4}"-->
                <!--                                            ></p>-->
                <!--                                        <p>До<input name="0" type="text" placeholder="0" maxlength="4"-->
                <!--                                                    pattern="[0-9]{4}"-->
                <!--                                            ></p>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="">-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option>Language</option>-->
                <!--                                                    <option>English</option>-->
                <!--                                                    <option>Spanish</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="">-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option>Language</option>-->
                <!--                                                    <option>English</option>-->
                <!--                                                    <option>Spanish</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="">-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option>Language</option>-->
                <!--                                                    <option>English</option>-->
                <!--                                                    <option>Spanish</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="">-->
                <!--                                                <select name="0">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option>Language</option>-->
                <!--                                                    <option>English</option>-->
                <!--                                                    <option>Spanish</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-building-parameter">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('appearanceBuild')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Исходные параметры-->
                <!--                            <div class="appearance-of-the-build">-->
                <!--                                <h2>Исходные параметры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="space-min">Площадь:</label>-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                            <label for="ceiling_height-min">Высота потолков:</label>-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                            <label for="number_of_floors-min">Количество этажей:-->
                <!--                                                <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                       placeholder="от">-->
                <!--                                                <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                       placeholder="до">-->
                <!--                                            </label>-->
                <!--                                            <label for="type_of_construction">Вид постройки:-->
                <!--                                                <select name="type_of_construction" id="type_of_construction">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="111">Комнаты</option>-->
                <!--                                                    <option value="90">Опен спэйс</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                            <label for="number_of_rooms-min">Количество комнат:-->
                <!--                                                <input id="number_of_rooms-min" name="number_of_rooms-min" type="text"-->
                <!--                                                       placeholder="от">-->
                <!--                                                <input id="number_of_rooms-max" name="number_of_rooms-max" type="text"-->
                <!--                                                       placeholder="до">-->
                <!--                                            </label>-->
                <!--                                            <label for="year_of_construction-min">Год постройки/окончания строительства:-->
                <!--                                                <input id="year_of_construction-min" name="year_of_construction-min"-->
                <!--                                                       type="text" placeholder="от">-->
                <!--                                                <input id="year_of_construction-max" name="year_of_construction-max"-->
                <!--                                                       type="text" placeholder="до">-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="building_type">Тип здания-->
                <!--                                                <select name="building_type" id="building_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="108">Жилое</option>-->
                <!--                                                    <option value="8">Административное</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="roofing">Кровля-->
                <!--                                                <select name="roofing" id="roofing">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="67">Железо</option>-->
                <!--                                                    <option value="34">Медь</option>-->
                <!--                                                    <option value="76">Металлочерепица</option>-->
                <!--                                                    <option value="113">Пескобетонная черепица</option>-->
                <!--                                                    <option value="129">Черепица</option>-->
                <!--                                                    <option value="123">Солома</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="118">Шифер</option>-->
                <!--                                                    <option value="88">Ондулин</option>-->
                <!--                                                    <option value="127">Временная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="foundation">Фундамент-->
                <!--                                                <select name="foundation" id="foundation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="120">Монолитная плита</option>-->
                <!--                                                    <option value="125">Шведская плита</option>-->
                <!--                                                    <option value="109">Ленточный</option>-->
                <!--                                                    <option value="58">Ростверк</option>-->
                <!--                                                    <option value="140">Без фундамента</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="49">Фахверк</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="78">Монолит</option>-->
                <!--                                                    <option value="96">Пеноблок</option>-->
                <!--                                                    <option value="55">Газосиликатные блоки</option>-->
                <!--                                                    <option value="28">Шлакоблоки</option>-->
                <!--                                                    <option value="27">Рубленое дерево</option>-->
                <!--                                                    <option value="24">Лафет</option>-->
                <!--                                                    <option value="112">Оцилиндрованное бревно</option>-->
                <!--                                                    <option value="102">Профилированный брус</option>-->
                <!--                                                    <option value="56">Клееный брус</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeApparenceBuild">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-office-area">-->
                <!--                        <li onclick="allParam('appearanceBuild')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Исходные параметры-->
                <!--                            <div class="appearance-of-the-build">-->
                <!--                                <h2>Исходные параметры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="space-min">Площадь:</label>-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                            <label for="ceiling_height-min">Высота потолков:</label>-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                            <label for="number_of_floors-min">Количество этажей:-->
                <!--                                                <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                       placeholder="от">-->
                <!--                                                <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                       placeholder="до">-->
                <!--                                            </label>-->
                <!--                                            <label for="type_of_construction">Вид постройки:-->
                <!--                                                <select name="type_of_construction" id="type_of_construction">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="111">Комнаты</option>-->
                <!--                                                    <option value="90">Опен спэйс</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                            <label for="number_of_rooms-min">Количество комнат:-->
                <!--                                                <input id="number_of_rooms-min" name="number_of_rooms-min" type="text"-->
                <!--                                                       placeholder="от">-->
                <!--                                                <input id="number_of_rooms-max" name="number_of_rooms-max" type="text"-->
                <!--                                                       placeholder="до">-->
                <!--                                            </label>-->
                <!--                                            <label for="year_of_construction-min">Год постройки/окончания строительства:-->
                <!--                                                <input id="year_of_construction-min" name="year_of_construction-min"-->
                <!--                                                       type="text" placeholder="от">-->
                <!--                                                <input id="year_of_construction-max" name="year_of_construction-max"-->
                <!--                                                       type="text" placeholder="до">-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="building_type">Тип здания-->
                <!--                                                <select name="building_type" id="building_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="108">Жилое</option>-->
                <!--                                                    <option value="8">Административное</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="roofing">Кровля-->
                <!--                                                <select name="roofing" id="roofing">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="67">Железо</option>-->
                <!--                                                    <option value="34">Медь</option>-->
                <!--                                                    <option value="76">Металлочерепица</option>-->
                <!--                                                    <option value="113">Пескобетонная черепица</option>-->
                <!--                                                    <option value="129">Черепица</option>-->
                <!--                                                    <option value="123">Солома</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="118">Шифер</option>-->
                <!--                                                    <option value="88">Ондулин</option>-->
                <!--                                                    <option value="127">Временная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="foundation">Фундамент-->
                <!--                                                <select name="foundation" id="foundation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="120">Монолитная плита</option>-->
                <!--                                                    <option value="125">Шведская плита</option>-->
                <!--                                                    <option value="109">Ленточный</option>-->
                <!--                                                    <option value="58">Ростверк</option>-->
                <!--                                                    <option value="140">Без фундамента</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="49">Фахверк</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="78">Монолит</option>-->
                <!--                                                    <option value="96">Пеноблок</option>-->
                <!--                                                    <option value="55">Газосиликатные блоки</option>-->
                <!--                                                    <option value="28">Шлакоблоки</option>-->
                <!--                                                    <option value="27">Рубленое дерево</option>-->
                <!--                                                    <option value="24">Лафет</option>-->
                <!--                                                    <option value="112">Оцилиндрованное бревно</option>-->
                <!--                                                    <option value="102">Профилированный брус</option>-->
                <!--                                                    <option value="56">Клееный брус</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeApparenceBuild">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-separate-building">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="building-parameters-ozs-сomplex">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-7">-->
                <!--                        <li onclick="allParam('mainSettings')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основные параметры-->
                <!--                            <div class="main-settings">-->
                <!--                                <h2>Основные параметры</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="59">Земли под размещение промышленных и коммерческих-->
                <!--                                                        объектов-->
                <!--                                                    </option>-->
                <!--                                                    <option value="9">Сельскохозяйственные земли</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="site">Участок-->
                <!--                                                <select name="site" id="site">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="136">Заболоченный</option>-->
                <!--                                                    <option value="103">Овраг</option>-->
                <!--                                                    <option value="89">На склоне</option>-->
                <!--                                                    <option value="133">Неровный</option>-->
                <!--                                                    <option value="119">Ровный</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p>На участке</p>-->
                <!--                                        <label>Берег водоема <input type="checkbox" name="waterfront"></label>-->
                <!--                                        <label>Река <input type="checkbox" name="river"></label>-->
                <!--                                        <label>Родник <input type="checkbox" name="spring"></label>-->
                <!--                                        <label>Садовые деревья <input type="checkbox" name="garden_trees"></label>-->
                <!--                                        <label>Лесные деревья <input type="checkbox" name="forest_trees"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainSettings">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('furnishing')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Обустройства-->
                <!--                            <div class="furnishing">-->
                <!--                                <h2>Обустройство</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="5">Отсутствует</option>-->
                <!--                                                    <option value="7">Придомовой гараж</option>-->
                <!--                                                    <option value="52">Гаражный комплекс</option>-->
                <!--                                                    <option value="132">Подземная парковка</option>-->
                <!--                                                    <option value="81">Многоуровневый паркинг</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p>Дополнительные строения</p>-->
                <!--                                        <label>Сторожка <input type="checkbox" name="lodge"></label>-->
                <!--                                        <label>Гостевой дом <input type="checkbox" name="guest_house"></label>-->
                <!--                                        <label>Баня <input type="checkbox" name="bath"></label>-->
                <!--                                        <label>Бассейн <input type="checkbox" name="swimming_pool"></label>-->
                <!--                                        <label>Детская площадка <input type="checkbox" name="playground"></label>-->
                <!--                                        <label>Винный погреб <input type="checkbox" name="wine_vault"></label>-->
                <!--                                        <label>Сарай <input type="checkbox" name="barn"></label>-->
                <!--                                        <label>Беседка <input type="checkbox" name="alcove"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p>Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Водопровод <input type="checkbox" name="water_pipes"></label>-->
                <!--                                        <label>Электричество <input type="checkbox" name="electricity"></label>-->
                <!--                                        <label>Отопление <input type="checkbox" name="heating"></label>-->
                <!--                                        <label>Газ <input type="checkbox" name="gas"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeFurnishing">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-8">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('additionallyAp')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Дополнительно-->
                <!--                            <div class="additionally-ap">-->
                <!--                                <h2>Дополнительно</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="roofing">Кровля-->
                <!--                                                <select name="roofing" id="roofing">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="127">Временная</option>-->
                <!--                                                    <option value="118">Шифер</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="123">Солома</option>-->
                <!--                                                    <option value="129">Черепица</option>-->
                <!--                                                    <option value="76">Металлочерепица</option>-->
                <!--                                                    <option value="34">Медь</option>-->
                <!--                                                    <option value="67">Железо</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="foundation">Фундамент-->
                <!--                                                <select name="foundation" id="foundation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="140">Без фундамента</option>-->
                <!--                                                    <option value="58">Ростверк</option>-->
                <!--                                                    <option value="109">Ленточный</option>-->
                <!--                                                    <option value="125">Шведская плита</option>-->
                <!--                                                    <option value="120">Монолитная плита</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="wall_material">Материал стен-->
                <!--                                                <select name="wall_material" id="wall_material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="49">Фахверк</option>-->
                <!--                                                    <option value="56">Клееный брус</option>-->
                <!--                                                    <option value="102">Профилированный брус</option>-->
                <!--                                                    <option value="112">Оцилиндрованное бревно</option>-->
                <!--                                                    <option value="24">Лафет</option>-->
                <!--                                                    <option value="27">Рубленое дерево</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="28">Шлакоблоки</option>-->
                <!--                                                    <option value="55">Газосиликатные блоки</option>-->
                <!--                                                    <option value="96">Пеноблок</option>-->
                <!--                                                    <option value="105">Железобетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAdditionallyAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-9">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-10">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-11">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-12">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-13">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <!--                    <ul class="test-14">-->
                <!--                        <li onclick="allParam('main')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Основное-->
                <!--                            <div class="main-ap">-->
                <!--                                <h2>Основное</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label for="space-min">Площадь:-->
                <!--                                            <input id="space-min" name="space-min" type="text" placeholder="от">-->
                <!--                                            <input id="space-max" name="space-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="ceiling_height-min">Высота потолков:-->
                <!--                                            <input id="ceiling_height-min" name="ceiling_height-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="ceiling_height-max" name="ceiling_height-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="number_of_floors-min">Количество этажей:-->
                <!--                                            <input id="number_of_floors-min" name="number_of_floors-min" type="text"-->
                <!--                                                   placeholder="от">-->
                <!--                                            <input id="number_of_floors-max" name="number_of_floors-max" type="text"-->
                <!--                                                   placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="clarification_of_the_object_type">Уточнение вида объектов-->
                <!--                                                <select name="clarification_of_the_object_type"-->
                <!--                                                        id="clarification_of_the_object_type">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="92">Собственность менее 5 лет</option>-->
                <!--                                                    <option value="93">Собственность более 5 лет</option>-->
                <!--                                                    <option value="70">Участок с подрядом</option>-->
                <!--                                                    <option value="33">Незавершенное строительство</option>-->
                <!--                                                    <option value="83">Новостройка</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Ограждение <input type="checkbox" name="fencing"></label>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label for="year_of_construction-min">Год постройки/окончания-->
                <!--                                            строительства:</label>-->
                <!--                                        <input id="year_of_construction-min" name="year_of_construction-min" type="text"-->
                <!--                                               placeholder="от">-->
                <!--                                        <input id="year_of_construction-max" name="year_of_construction-max" type="text"-->
                <!--                                               placeholder="до">-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeMainAp">Отправить</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('repairAndUtilitiesOfTheApartment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-2.png" alt="search">Ремонт и обустройства-->
                <!--                            <div class="repair-and-utilities-of-the-apartment">-->
                <!--                                <h2>Ремонт и обустройства</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="furnish">Отделка-->
                <!--                                                <select name="furnish" id="furnish">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="46">Эксклюзивного качества</option>-->
                <!--                                                    <option value="64">Высококачественная отделка</option>-->
                <!--                                                    <option value="57">Хорошая отделка</option>-->
                <!--                                                    <option value="106">Требуется косметический ремонт</option>-->
                <!--                                                    <option value="107">Требуется ремонт</option>-->
                <!--                                                    <option value="65">Незавершенный ремонт</option>-->
                <!--                                                    <option value="141">Без ремонта</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Безопасность</p>-->
                <!--                                        <label>Консьерж <input type="checkbox" name="concierge"></label>-->
                <!--                                        <label>Охрана <input type="checkbox" name="security"></label>-->
                <!--                                        <label>Домофон <input type="checkbox" name="intercom"></label>-->
                <!--                                        <label>Видеонаблюдение <input type="checkbox" name="cctv"></label>-->
                <!--                                        <label>Сигнализация <input type="checkbox" name="signaling"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Ограждение</p>-->
                <!--                                        <label>Ограждение<input type="checkbox" name="fencing"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="material">Материал-->
                <!--                                                <select name="material" id="material">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="98">Пластик</option>-->
                <!--                                                    <option value="142">Дерево</option>-->
                <!--                                                    <option value="38">Профнастил</option>-->
                <!--                                                    <option value="122">Камень</option>-->
                <!--                                                    <option value="31">Бетон</option>-->
                <!--                                                    <option value="19">Кирпич</option>-->
                <!--                                                    <option value="75">Металлические прутья</option>-->
                <!--                                                    <option value="143">Кованая ограда</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="parking">Парковка-->
                <!--                                                <select name="parking" id="parking">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option class="more-settings" value="81">Многоуровневый паркинг-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="132">Подземная парковка-->
                <!--                                                    </option>-->
                <!--                                                    <option class="more-settings" value="52">Гаражный комплекс</option>-->
                <!--                                                    <option class="more-settings" value="7">Придомовой гараж</option>-->
                <!--                                                    <option class="more-settings" value="82">Муниципальная</option>-->
                <!--                                                    <option class="more-settings" value="5">Отсутствует</option>-->
                <!--                                                    <option class="more-settings" value="41">Не важно</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li class="show-more-settings">-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="municipal">Муниципальная-->
                <!--                                                <select name="municipal" id="municipal">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="94">Платная</option>-->
                <!--                                                    <option value="51">Бесплатная</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <p class="title-center">Жилищно-коммунальные услуги</p>-->
                <!--                                        <label>Электричество<input type="checkbox" name="electricity"></label>-->
                <!--                                        <label for="electricity">Кол-во кВт:-->
                <!--                                            <input name="electricity-min" type="text" placeholder="от">-->
                <!--                                            <input name="electricity-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="sanitation">Водопровод и канализация-->
                <!--                                                <select name="sanitation" id="sanitation">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="47">Есть</option>-->
                <!--                                                    <option value="84">Нет</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Возможность проводки <input type="checkbox"-->
                <!--                                                                           name="possible_to_post"></label>-->
                <!--                                        <label>Описание <input type="checkbox" name="sanitation_description"></label>-->
                <!--                                        <label for="sanitation">Наличие санузлов</label>-->
                <!--                                        <label for="">Количество:-->
                <!--                                            <input name="bathroom_number-min" type="text" placeholder="от">-->
                <!--                                            <input name="bathroom_number-max" type="text" placeholder="до">-->
                <!--                                        </label>-->
                <!--                                        <label for="">Расположение:</label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <select name="bathroom_location" id="sanitation">-->
                <!--                                                <option value="">----------</option>-->
                <!--                                            </select>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Описание<input type="checkbox" name="bathroom_description"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="close-repair-and-utilities-of-the-apartment">Готово</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('document')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:40%"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-1.png" alt="search">Документы-->
                <!--                            <div class="document">-->
                <!--                                <h2>Документы</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <label>Документы на право владения<input type="checkbox"-->
                <!--                                                                                 name="documents_on_ownership"></label>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <label>Договор аренды<input type="checkbox" name="lease_contract"></label>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeDocument">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                        <li onclick="allParam('attachment')">-->
                <!--                            <div class="progress-bar blue stripes">-->
                <!--                                <span style="width:0"></span>-->
                <!--                            </div>-->
                <!--                            <img src="/template/images/search-4.png" alt="search">Вложения-->
                <!--                            <div class="attachment">-->
                <!--                                <h2>Вложения</h2>-->
                <!--                                <ul>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="video">Видео-->
                <!--                                                <select name="video" id="video">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="planning_project">Проект<br>планировки-->
                <!--                                                <select name="planning_project" id="planning_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                    <li>-->
                <!--                                        <div class="select">-->
                <!--                                            <label for="three_d_project">3d проект-->
                <!--                                                <select name="three_d_project" id="three_d_project">-->
                <!--                                                    <option value="">----------</option>-->
                <!--                                                    <option value="41">Не важно</option>-->
                <!--                                                    <option value="11">Прилагается</option>-->
                <!--                                                </select>-->
                <!--                                            </label>-->
                <!--                                        </div>-->
                <!--                                    </li>-->
                <!--                                </ul>-->
                <!--                                <button class="closeAttachment">Поиск</button>-->
                <!--                            </div>-->
                <!--                        </li>-->
                <!--                    </ul>-->
                <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i>Поиск по карте</a>
            </div>
        </div>
        <div class="big-search" onclick="showBigSearch();">
            <a>Расширенный поиск</a>
            <i class="fa fa-angle-right" aria-hidden="true"></i>
        </div>
    </form>
</div>