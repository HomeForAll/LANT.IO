<?php
$this->title = 'Поиск';
?>
<h2>Купить:</h2>
<form action="" method="post">
    <fieldset style="margin-bottom: 15px">
        <legend>Основные параметры</legend>

        <div style="margin: 15px">
            Объект:
            <select name="subject" id="subject" onchange="getRegions()">
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
            <div style="padding-left: 30px">
                Начните вводить город:
                <input type="text" name="address" oninput="getGeoData(this.value)">
                <div id="cities"></div>
                <!--Регион:
                <select name="region" id="region">
                    <option value="" selected>---</option>
                </select><br>
                Область:
                <select name="area" id="area">
                    <option value="" selected>---</option>
                </select><br>
                Населенный пункт:
                <select name="city" id="city">
                    <option value="" selected>---</option>
                </select>-->
            </div>
        </div>
    </fieldset>
    <input type="submit" name="submit" value="Найти">
</form>

<h2>Арендоавть:</h2>
<form action="" method="post">

</form>
