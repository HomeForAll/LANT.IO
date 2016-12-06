<?php
$this->title = 'Поиск';

echo '<pre>';
print_r($this->data);
echo '</pre>';
?>
<style>
    #operation, label[for=operation] {
        display: none;
    }

    /*#formOptions {*/
    /*display: none;*/
    /*}*/

    .indent {
        margin: 15px 0 15px 30px;
    }
</style>
<!--
<h2>Простой поиск:</h2>
<form action="/search" method="post">
    <fieldset>
        <legend>Основные параметры</legend>

        <div style="margin: 15px">
            <label for="subject">Объект:</label>
            <select name="subject" id="subject" onchange="">
                <option value="apartment">Квартира</option>
                <option value="house">Дом</option>
                <option value="ground">Участок</option>
                <option value="room">Комната</option>
            </select><br>

            Цена:
            <div style="padding-left: 30px">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс."><br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="yes">Возможен</option>
                    <option value="">Не возможен</option>
                </select>
            </div>
            Расположение: --- <br>
            <!--
            <div style="padding-left: 30px">
                Область:
                <select name="district" id="disctrict">
                    <option value="1">Республика Адыгея</option>
                    <option value="2">Республика Башкортостан</option>
                    <option value="3">Республика Бурятия</option>
                    <option value="4">Республика Алтай</option>
                    <option value="5">Республика Дагестан</option>
                    <option value="6">Республика Ингушетия</option>
                    <option value="7">Кабардино-Балкарская Республика</option>
                    <option value="8">Республика Калмыкия</option>
                    <option value="9">Республика Карачаево-Черкессия</option>
                    <option value="10">Республика Карелия</option>
                    <option value="11">Республика Коми</option>
                    <option value="12">Республика Марий Эл</option>
                    <option value="13">Республика Мордовия</option>
                    <option value="14">Республика Саха (Якутия)</option>
                    <option value="15">Республика Северная Осетия-Алания</option>
                    <option value="16">Республика Татарстан</option>
                    <option value="17">Республика Тыва</option>
                    <option value="18">Удмуртская Республика</option>
                    <option value="19">Республика Хакасия</option>
                    <option value="20">Чувашская Республика</option>
                    <option value="21">Алтайский край</option>
                    <option value="22">Краснодарский край</option>
                    <option value="23">Красноярский край</option>
                    <option value="24">Приморский край</option>
                    <option value="25">Ставропольский край</option>
                    <option value="26">Хабаровский край</option>
                    <option value="27">Амурская область</option>
                    <option value="28">Архангельская область</option>
                    <option value="29">Астраханская область</option>
                    <option value="30">Белгородская область</option>
                    <option value="31">Брянская область</option>
                    <option value="32">Владимирская область</option>
                    <option value="33">Волгоградская область</option>
                    <option value="34">Вологодская область</option>
                    <option value="35">Воронежская область</option>
                    <option value="36">Ивановская область</option>
                    <option value="37">Иркутская область</option>
                    <option value="38">Калиниградская область</option>
                    <option value="39">Калужская область</option>
                    <option value="40">Камчатская область</option>
                    <option value="41">Кемеровская область</option>
                    <option value="42">Кировская область</option>
                    <option value="43">Костромская область</option>
                    <option value="44">Курганская область</option>
                    <option value="45">Курская область</option>
                    <option value="46">Ленинградская область</option>
                    <option value="47">Липецкая область</option>
                    <option value="48">Магаданская область</option>
                    <option value="49">Московская область</option>
                    <option value="50">Мурманская область</option>
                    <option value="51">Нижегородская область</option>
                    <option value="52">Новгородская область</option>
                    <option value="53">Новосибирская область</option>
                    <option value="54">Омская область</option>
                    <option value="55">Оренбургская область</option>
                    <option value="56">Орловская область</option>
                    <option value="57">Пензенская область</option>
                    <option value="58">Пермская область</option>
                    <option value="59">Псковская область</option>
                    <option value="60">Ростовская область</option>
                    <option value="61">Рязанская область</option>
                    <option value="62">Самарская область</option>
                    <option value="63">Саратовская область</option>
                    <option value="64">Сахалинская область</option>
                    <option value="65">Свердловская область</option>
                    <option value="66">Смоленская область</option>
                    <option value="67">Тамбовская область</option>
                    <option value="68">Тверская область</option>
                    <option value="69">Томская область</option>
                    <option value="70">Тульская область</option>
                    <option value="71">Тюменская область</option>
                    <option value="72">Ульяновская область</option>
                    <option value="73">Челябинская область</option>
                    <option value="74">Читинская область</option>
                    <option value="75">Ярославская область</option>
                    <option value="76">г. Москва</option>
                    <option value="77">г. Санкт-Петербург</option>
                    <option value="78">Еврейская автономная область</option>
                    <option value="79">Агинский Бурятский авт. округ</option>
                    <option value="80">Коми-Пермяцкий автономный округ</option>
                    <option value="81">Корякский автономный округ</option>
                    <option value="82">Ненецкий автономный округ</option>
                    <option value="83">Таймырский (Долгано-Ненецкий) автономный округ</option>
                    <option value="84">Усть-Ордынский Бурятский автономный округ</option>
                    <option value="85">Ханты-Мансийский автономный округ</option>
                    <option value="86">Чукотский автономный округ</option>
                    <option value="87">Эвенкийский автономный округ</option>
                    <option value="88">Ямало-Ненецкий автономный округ</option>
                    <option value="89">Чеченская Республика</option>
                </select><br>
            </div>

            <label for="rooms">Количество комнат:</label>
            <select name="rooms" id="rooms">
                <option value="">---</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="more">4+</option>
            </select><br>
            Площадь:
            <input name="minArea" type="text" placeholder="От">
            <input name="maxArea" type="text" placeholder="До"><br>
            <label for="equipment">Комплектация:</label>
            <select name="equipment" id="equipment">
                <option value="">---</option>
                <option value="1">Укомплектованая</option>
                <option value="">Пустая</option>
            </select><br>
        </div>
    </fieldset>
    <input style="margin-top: 20px" type="submit" name="simple" value="Найти">
</form>
<br><br>-->
<h2>Расширенный поиск:</h2><br>

<form action="/search" method="post">

    <label for="subject">
        <span style="font-size: 14pt">
            <strong>Объект:</strong>
        </span>
    </label>
    <select name="subject" id="subject" onchange="displayOperation(); changeForm()">
        <option value="">---</option>
        <option value="apartment">Квартира</option>
        <option value="house">Дом</option>
        <option value="ground">Участок</option>
        <option value="room">Комната</option>
    </select><br><br>

    <label for="operation">
        <span style="font-size: 14pt">
            <strong>Операция:</strong>
        </span>
    </label>
    <select name="operation" id="operation" onchange="changeForm()">
        <option value="">---</option>
        <option value="rent">Аренда</option>
        <option value="buy">Покупка</option>
    </select><br><br>

    Квартира
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px"> Цена:
            <div class="indent"> Стоимость: <input name="minPrice" type="text"
                                                   placeholder="Мин."> <input name="maxPrice" type="text"
                                                                              placeholder="Макс."><br> <label
                    for="bargain">Торг:</label> <select name="bargain"
                                                        id="bargain">
                    <option value="">---</option>
                    <option value="yes">Возможен</option>
                    <option value="">Не возможен</option>
                </select><br> <label
                    for="rentType">Тип аренды:</label> <select name="rentType" id="rentType">
                    <option value="">---</option>
                    <option value="1">Часовая</option>
                    <option value="2">Посуточная</option>
                    <option value="3">Долгосрочная</option>
                </select></div>
            Расположение: <br>
            <div class="indent">
                <label for="region">Область:</label> <input type="text" name="region" id="region"><br> <label
                    for="city">Город:</label> <input type="text" name="city"
                                                     id="city"><br>
                <div class="indent"><label for="district">Округ:</label> <input type="text" name="district"
                                                                                id="district"><br> <label
                        for="area">Район:</label> <input type="text" name="area" id="area"><br> <label for="address">Адрес:</label>
                    <input type="text" name="address"
                           id="address"><br></div>
                Станция метро: <br>
                <div class="indent"> Удаленность от метро: <input type="text" name="metroMin" placeholder="Мин."> <input
                        type="text" name="metroMax" placeholder="Макс."><br></div>
            </div>
        </div>
    </fieldset>
    <br><br>
    <fieldset>
        <legend>Описание объекта</legend>
        <div
            style="margin: 15px"><strong>Квартира:</strong>
            <div class="indent"><label for="roomsNumber">Количество комнат:</label> <select name="roomsNumber"
                                                                                            id="roomsNumber"
                                                                                            onchange="">
                    <option value="">---</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
                </select><br> Площадь: <input type="text" name="spaceMin" placeholder="От"> <input type="text"
                                                                                                   name="spaceMax"
                                                                                                   placeholder="До"><br>
                Этаж: <input type="text" name="floorMin" placeholder="От"> <input type="text" name="floorMax"
                                                                                  placeholder="До"><br> <label
                    for="equipment">Комплектация:</label> <select name="equipment" id="equipment">
                    <option value="">---</option>
                    <option value="1">Укомплектованая</option>
                    <option value="">Пустая</option>
                </select><br> <label for="ceilingHeight">Высота потолков:</label> <input type="text"
                                                                                         name="ceilingHeight"
                                                                                         id="ceilingHeight"></div>
        </div>
        <div style="margin: 15px"><strong>Дом квартиры:</strong>
            <div class="indent"><label for="houseType">Тип
                    дома:</label> <select name="houseType" id="houseType" onchange="">
                    <option value="">---</option>
                    <option value="1">Блочный</option>
                    <option
                        value="2">Брежневка
                    </option>
                    <option value="3">Индивидуальный</option>
                    <option value="4">Кирпично-монолитный</option>
                    <option
                        value="5">Монолит
                    </option>
                    <option value="6">Панельный</option>
                    <option value="7">Сталинка</option>
                    <option value="8">Хрущевка</option>
                    <option
                        value="9">Серия дома
                    </option>
                </select><br> <label for="houseFloorNumber">Количество этажей:</label> <input type="text"
                                                                                              name="houseFloorNumber"
                                                                                              id="houseFloorNumber"><br>
                <label for="lift">Лифт:</label> <select name="lift" id="lift" onchange="">
                    <option value="">---</option>
                    <option
                        value="1">Есть
                    </option>
                    <option value="2">Нет</option>
                </select><br> <label for="parking">Парковка:</label> <select name="parking" id="parking"
                                                                             onchange="">
                    <option value="">---</option>
                    <option value="1">Подземная</option>
                    <option value="2">Во дворе</option>
                    <option value="2">Платная
                        (неподалеку)
                    </option>
                </select><br> Безопасность:
                <div class="indent"><label for="concierge">Консьерж</label> <input type="checkbox" name="concierge"
                                                                                   id="concierge"><br> <label
                        for="security">Охрана</label> <input type="checkbox" name="security" id="security"><br> <label
                        for="intercom">Домофон</label> <input type="checkbox" name="intercom" id="intercom"><br> <label
                        for="CCTV">Видеонаблюдение</label> <input
                        type="checkbox" name="CCTV" id="CCTV"><br></div>
                <label for="chute">Мусоропровод:</label> <select name="chute" id="chute" onchange="">
                    <option
                        value="">---
                    </option>
                    <option value="1">Да</option>
                    <option value="2">Нет</option>
                </select><br></div>
            <strong>Состав квартиры:</strong>
            <div
                class="indent"> Комнаты:
                <div class="indent"><label for="bedroom">Спальня</label> <input type="checkbox" name="bedroom"
                                                                                id="bedroom"><br> <label
                        for="kitchen">Кухня</label> <input type="checkbox" name="kitchen" id="kitchen"><br> <label
                        for="livingRoom">Гостиная</label> <input type="checkbox"
                                                                 name="livingRoom" id="livingRoom"><br> <label
                        for="hallway">Прихожая</label> <input type="checkbox" name="hallway" id="hallway"><br> <label
                        for="nursery">Детская</label> <input type="checkbox" name="nursery" id="nursery"><br> <label
                        for="study">Рабочий кабинет</label> <input
                        type="checkbox" name="study" id="study"><br> <label for="canteen">Столовая</label> <input
                        type="checkbox" name="canteen" id="canteen"><br> <label
                        for="bathroom">Ванная</label> <input type="checkbox" name="bathroom" id="bathroom"><br></div>
                Состояние квартиры:
                <div class="indent"><label
                        for="decoration">Отделка:</label> <select name="decoration" id="decoration">
                        <option value="">---</option>
                        <option value="1">Да</option>
                        <option
                            value="2">Нет
                        </option>
                    </select>
                    <select name="decorationValue">
                        <option value="1">Люкс</option>
                        <option
                            value="2">Косметическая
                        </option>
                    </select><br></div>
                <label for="lavatory">Санузел:</label> <select name="lavatory" id="lavatory">
                    <option
                        value="">---
                    </option>
                    <option value="1">Совмещенный</option>
                    <option value="2">Раздельный</option>
                </select><br> <label for="balcony">Обязательное
                    наличие балкона</label> <input type="checkbox" name="balcony" id="balcony"><br> Жилищно-комунальные
                услуги:
                <div class="indent"><label
                        for="heating">Отопление</label> <input type="checkbox" name="heating" id="heating"><br> <label
                        for="gas">Газ</label> <input type="checkbox" name="gas"
                                                     id="gas"><br> <label for="electricity">Электричество</label> <input
                        type="checkbox" name="electricity" id="electricity"><br> <label
                        for="water">Водопровод</label> <input type="checkbox" name="water" id="water"><br></div>
                Наполнение квартиры:
                <div class="indent"> Электроника для
                    досуга и отдыха:
                    <div class="indent"><label for="TV">Телевизор</label> <input type="checkbox" name="TV" id="TV"><br>
                        <label
                            for="musicCenter">Музыкльный центр</label> <input type="checkbox" name="musicCenter"
                                                                              id="musicCenter"><br> <label
                            for="conditioner">Кондиционер</label> <input type="checkbox" name="conditioner"
                                                                         id="conditioner"><br></div>
                    Бытовая техника:
                    <div class="indent">
                        <label for="fridge">Холодильник</label> <input type="checkbox" name="fridge" id="fridge"><br>
                        <label for="plate">Плита</label> <input type="checkbox"
                                                                name="plate" id="plate"><br> <label
                            for="bake">Печь</label> <input type="checkbox" name="bake" id="bake"><br> <label
                            for="microwave">СВЧ</label>
                        <input type="checkbox" name="microwave" id="microwave"><br> <label
                            for="dishwasher">Посудомойка</label> <input type="checkbox" name="dishwasher"
                                                                        id="dishwasher"><br></div>
                    Мебель:
                    <div class="indent"><label for="table">Стол</label> <input type="checkbox" name="table"
                                                                               id="table"><br> <label
                            for="bed">Кровать</label> <input type="checkbox" name="bed" id="bed"><br> <label
                            for="cupboard">Шкаф</label> <input type="checkbox" name="cupboard"
                                                               id="cupboard"><br> <label for="stand">Тумба</label>
                        <input type="checkbox" name="stand" id="stand"><br> <label for="mirror">Зеркало</label> <input
                            type="checkbox" name="mirror" id="mirror"><br> <label for="armchair">Кресло</label> <input
                            type="checkbox" name="armchair" id="armchair"><br> <label
                            for="sofa">Диван</label> <input type="checkbox" name="sofa" id="sofa"><br></div>
                </div>
            </div>
            <strong>Вложения:</strong>
            <div class="indent"><label
                    for="plan">План квартиры:</label> <select name="plan" id="plan" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option
                        value="2">Нет
                    </option>
                </select><br> <label for="3d">3D проект:</label> <select name="3d" id="3d" onchange="">
                    <option value="">---</option>
                    <option
                        value="1">Есть
                    </option>
                    <option value="2">Нет</option>
                </select><br> <label for="video">Видео:</label> <select name="video" id="video" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select><br>
                <label
                    for="foto">Фото:</label> <select name="foto" id="foto" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option
                        value="2">Нет
                    </option>
                </select><br></div>
        </div>
    </fieldset>

    <input type="submit" value="Найти">
    <!--<div id="formOptions">
                <fieldset>
                    <legend>Базовые параметры</legend>

                    <div style="margin: 15px">

                        Цена:
                        <div class="indent">
                            Стоимость:
                            <input name="minPrice" type="text" placeholder="Мин.">
                            <input name="maxPrice" type="text" placeholder="Макс."><br>
                            <label for="bargain">Торг:</label>
                            <select name="bargain" id="bargain">
                                <option value="">---</option>
                                <option value="yes">Возможен</option>
                                <option value="">Не возможен</option>
                            </select><br>
                            <label for="rentType">Тип аренды:</label>
                            <select name="rentType" id="rentType">
                                <option value="">---</option>
                                <option value="hourRent">Часовая</option>
                                <option value="dailyRent">Посуточная</option>
                                <option value="longRent">Долгосрочная</option>
                            </select>
                        </div>
                        Расположение: <br>
                        <div class="indent">
                            <label for="region">Область:</label>
                            <input type="text" name="region" id="region"><br>
                            <label for="city">Город:</label>
                            <input type="text" name="city" id="city"><br>
                            <div class="indent">
                                <label for="district">Округ:</label>
                                <input type="text" name="district" id="district"><br>
                                <label for="area">Район:</label>
                                <input type="text" name="area" id="area"><br>
                                <label for="address">Адрес:</label>
                                <input type="text" name="address" id="address"><br>
                            </div>
                            Станция метро: <br>
                            <div class="indent">
                                Удаленность от метро:
                                <input type="text" name="metroMin" placeholder="Мин.">
                                <input type="text" name="metroMax" placeholder="Макс."><br>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <br><br>
                <fieldset>
                    <legend>Описание объекта</legend>

                    <div style="margin: 15px">
                        <strong>Квартира:</strong>
                        <div class="indent">
                            <label for="roomsNumber">Количество комнат:</label>
                            <select name="roomsNumber" id="roomsNumber" onchange="">
                                <option value="">---</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="more">4+</option>
                            </select><br>

                            Площадь:
                            <input type="text" name="spaceMin" placeholder="От">
                            <input type="text" name="spaceMax" placeholder="До"><br>

                            Этаж:
                            <input type="text" name="floorMin" placeholder="От">
                            <input type="text" name="floorMax" placeholder="До"><br>

                            <label for="equipment">Комплектация:</label>
                            <select name="equipment" id="equipment">
                                <option value="">---</option>
                                <option value="1">Укомплектованая</option>
                                <option value="">Пустая</option>
                            </select><br>

                            <label for="ceilingHeight">Высота потолков:</label>
                            <input type="text" name="ceilingHeight" id="ceilingHeight">
                        </div>
                    </div>
                    <div style="margin: 15px">
                        <strong>Дом квартиры:</strong>
                        <div class="indent">
                            <label for="houseType">Тип дома:</label>
                            <select name="houseType" id="houseType" onchange="">
                                <option value="">---</option>
                                <option value="1">Блочный</option>
                                <option value="2">Брежневка</option>
                                <option value="3">Индивидуальный</option>
                                <option value="4">Кирпично-монолитный</option>
                                <option value="5">Монолит</option>
                                <option value="6">Панельный</option>
                                <option value="7">Сталинка</option>
                                <option value="8">Хрущевка</option>
                                <option value="9">Серия дома</option>
                            </select><br>

                            <label for="houseFloorNumber">Количество этажей:</label>
                            <input type="text" name="houseFloorNumber" id="houseFloorNumber"><br>

                            <label for="lift">Лифт:</label>
                            <select name="lift" id="lift" onchange="">
                                <option value="">---</option>
                                <option value="1">Есть</option>
                                <option value="2">Нет</option>
                            </select><br>

                            <label for="parking">Парковка:</label>
                            <select name="parking" id="parking" onchange="">
                                <option value="">---</option>
                                <option value="1">Подземная</option>
                                <option value="2">Во дворе</option>
                                <option value="2">Платная (неподалеку)</option>
                            </select><br>
                            Безопасность:
                            <div class="indent">
                                <label for="concierge">Консьерж</label>
                                <input type="checkbox" name="concierge" id="concierge"><br>
                                <label for="security">Охрана</label>
                                <input type="checkbox" name="security" id="security"><br>
                                <label for="intercom">Домофон</label>
                                <input type="checkbox" name="intercom" id="intercom"><br>
                                <label for="CCTV">Видеонаблюдение</label>
                                <input type="checkbox" name="CCTV" id="CCTV"><br>
                            </div>
                            <label for="chute">Мусоропровод:</label>
                            <select name="chute" id="chute" onchange="">
                                <option value="">---</option>
                                <option value="1">Да</option>
                                <option value="2">Нет</option>
                            </select><br>
                        </div>

                        <strong>Состав квартиры:</strong>
                        <div class="indent">
                            Комнаты:
                            <div class="indent">
                                <label for="bedroom">Спальня</label>
                                <input type="checkbox" name="bedroom" id="bedroom"><br>
                                <label for="kitchen">Кухня</label>
                                <input type="checkbox" name="kitchen" id="kitchen"><br>
                                <label for="livingRoom">Гостиная</label>
                                <input type="checkbox" name="livingRoom" id="livingRoom"><br>
                                <label for="hallway">Прихожая</label>
                                <input type="checkbox" name="hallway" id="hallway"><br>
                                <label for="nursery">Детская</label>
                                <input type="checkbox" name="nursery" id="nursery"><br>
                                <label for="study">Рабочий кабинет</label>
                                <input type="checkbox" name="study" id="study"><br>
                                <label for="canteen">Столовая</label>
                                <input type="checkbox" name="canteen" id="canteen"><br>
                                <label for="bathroom">Ванная</label>
                                <input type="checkbox" name="bathroom" id="bathroom"><br>
                            </div>
                            Состояние квартиры:
                            <div class="indent">
                                <label for="decoration">Отделка:</label>
                                <select name="decoration" id="decoration">
                                    <option value="">---</option>
                                    <option value="1">Да</option>
                                    <option value="0">Нет</option>
                                </select>
                                <select name="decorationValue">
                                    <option value="">---</option>
                                    <option value="1">Люкс</option>
                                    <option value="0">Косметическая</option>
                                </select><br>
                            </div>

                            <label for="lavatory">Санузел:</label>
                            <select name="lavatory" id="lavatory">
                                <option value="">---</option>
                                <option value="1">Совмещенный</option>
                                <option value="0">Раздельный</option>
                            </select><br>
                            <label for="balcony">Обязательное наличие балкона</label>
                            <input type="checkbox" name="balcony" id="balcony"><br>

                            Жилищно-комунальные услуги:
                            <div class="indent">
                                <label for="heating">Отопление</label>
                                <input type="checkbox" name="heating" id="heating"><br>
                                <label for="gas">Газ</label>
                                <input type="checkbox" name="gas" id="gas"><br>
                                <label for="electricity">Электричество</label>
                                <input type="checkbox" name="electricity" id="electricity"><br>
                                <label for="water">Водопровод</label>
                                <input type="checkbox" name="water" id="water"><br>
                            </div>

                            Наполнение квартиры:
                            <div class="indent">
                                Электроника для досуга и отдыха:
                                <div class="indent">
                                    <label for="TV">Телевизор</label>
                                    <input type="checkbox" name="TV" id="TV"><br>
                                    <label for="musicCenter">Музыкльный центр</label>
                                    <input type="checkbox" name="musicCenter" id="musicCenter"><br>
                                    <label for="conditioner">Кондиционер</label>
                                    <input type="checkbox" name="conditioner" id="conditioner"><br>
                                </div>
                                Бытовая техника:
                                <div class="indent">
                                    <label for="fridge">Холодильник</label>
                                    <input type="checkbox" name="fridge" id="fridge"><br>
                                    <label for="plate">Плита</label>
                                    <input type="checkbox" name="plate" id="plate"><br>
                                    <label for="bake">Печь</label>
                                    <input type="checkbox" name="bake" id="bake"><br>
                                    <label for="microwave">СВЧ</label>
                                    <input type="checkbox" name="microwave" id="microwave"><br>
                                    <label for="dishwasher">Посудомойка</label>
                                    <input type="checkbox" name="dishwasher" id="dishwasher"><br>
                                </div>
                                Мебель:
                                <div class="indent">
                                    <label for="table">Стол</label>
                                    <input type="checkbox" name="table" id="table"><br>
                                    <label for="bed">Кровать</label>
                                    <input type="checkbox" name="bed" id="bed"><br>
                                    <label for="cupboard">Шкаф</label>
                                    <input type="checkbox" name="cupboard" id="cupboard"><br>
                                    <label for="stand">Тумба</label>
                                    <input type="checkbox" name="stand" id="stand"><br>
                                    <label for="mirror">Зеркало</label>
                                    <input type="checkbox" name="mirror" id="mirror"><br>
                                    <label for="armchair">Кресло</label>
                                    <input type="checkbox" name="armchair" id="armchair"><br>
                                    <label for="sofa">Диван</label>
                                    <input type="checkbox" name="sofa" id="sofa"><br>
                                </div>
                            </div>
                        </div>

                        <strong>Вложения:</strong>
                        <div class="indent">
                            <label for="plan">План квартиры:</label>
                            <select name="plan" id="plan" onchange="">
                                <option value="">---</option>
                                <option value="1">Есть</option>
                                <option value="2">Нет</option>
                            </select><br>
                            <label for="3d">3D проект:</label>
                            <select name="3d" id="3d" onchange="">
                                <option value="">---</option>
                                <option value="1">Есть</option>
                                <option value="2">Нет</option>
                            </select><br>
                            <label for="video">Видео:</label>
                            <select name="video" id="video" onchange="">
                                <option value="">---</option>
                                <option value="1">Есть</option>
                                <option value="2">Нет</option>
                            </select><br>

                        </div>

                    </div>
                </fieldset>
                <input style="margin-top: 20px" type="submit" name="extended" value="Найти">
    </div>-->
</form>

