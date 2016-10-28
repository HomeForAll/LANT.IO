<?php
$this->title = 'Поиск';
?>
<h2>Купить:</h2>
<form action="" method="post">
    <fieldset>
        <legend>Основные параметры</legend>

        <div style="margin: 15px">
            Объект:
            <select name="subject" id="subject" onchange="">
                <option value="" selected>---</option>
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
                Торг:
                <select name="bargain" id="bargain">
                    <option value="" selected>---</option>
                    <option value="yes">Возможен</option>
                    <option value="no">Не возможен</option>
                </select>
            </div>
            Расположение:
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
            -->
        </div>
    </fieldset>
    <input type="submit" name="submit" value="Отправить">
</form>

<h2>Арендоавть:</h2>
<form action="" method="post">

</form>
