

<form id="search" action="/search">

    <div class="tabs cf">
        <input id="tab1" type="radio" name="tabs" value="1" checked>
        <label for="tab1" class="search-tabs">Арендовать</label>

        <input id="tab2" type="radio" name="tabs" value="2">
        <label for="tab2" class="search-tabs">Продажа</label>

<!--        <input id="tab3" type="radio" name="tabs" value="3">-->
        <label for="tab3" class="search-tabs search-tabs-disabled">Оценка</label>

<!--        <input id="tab4" type="radio" name="tabs" value="4">-->
        <label for="tab4" class="search-tabs search-tabs-disabled">Услуги</label>

        <div class="search-advanced-button search-flex"><img src="/template/img/invalid-name.svg" alt="">&nbsp;&nbsp;&nbsp;Расширенный поиск</div>
    </div>
    <div class="search-main">
        <div class="search-city elem"><select name="city">
            <option value="0" icon="/template/img/loupe.png">Введите город…</option>
            <option value="1" icon="/template/img/blazon.png">Москва и область</option>
            <option value="2" icon="/template/img/blazon.png">Санкт-Петербург</option>
        </select></div>
        <div class="search-type elem"><select name="type">
            <optgroup label="Жилая">
                <option value="0" icon="/template/img/loupe.png">Выберете тип недвижимости…</option>
                <option value="1" icon="/template/img/kvartira-svg.svg">Квартира</option>
                <option value="2" icon="/template/img/dom-svg.svg">Дом</option>
                <option value="3" icon="/template/img/komnata-svg.svg">Комната</option>
                <option value="4" icon="/template/img/uchastok-svg.svg">Земельный Участок</option>
                <option value="5" icon="/template/img/garazh-svg.svg">Гараж/Машиноместо</option>
                <option value="6" icon="/template/img/invalid-name_2.svg">Доля</option>
                <option value="7" icon="/template/img/invalid-name_3.svg">Таунхаус</option>
            </optgroup>
            <optgroup label="Коммерческая">
                <option value="8" icon="/template/img/ofis-svg.svg">Офисная Площадь</option>
                <option value="9" icon="/template/img/kvartira-svg.svg">Отдельно Стоящее Здание</option>
                <option value="10" icon="/template/img/ozs-svg.svg">Комплекс ОСЗ</option>
                <option value="11" icon="/template/img/yarmarka-svg.svg">Рынок/Ярмарка</option>
                <option value="12" icon="/template/img/sklad-svg.svg">Производственно-Складские Помещения</option>
                <option value="13" icon="/template/img/proizvodstvo-svg.svg">Производственно-Складские Здания</option>
                <option value="14" icon="/template/img/turism-svg.svg">Недвижимость Для Туризма И Отдыха</option>
            </optgroup>
        </select></div>
<!--        <div class="search-flex search-rooms elem"><select>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>4+</option>
        </select> комнат</div>-->
        <div class="search-flex search-area elem">
            <label>Площать <input type="number" name="area" value="50"></label><span class="search-m2">м<sup>2</sup></span>
        </div>

        <div class="search-flex search-price elem">
            <label>от <input type="number" name="price[from]" value="1000"></label>
            <label>до <input type="number" name="price[to]" value="10000"></label>
            <img src="/template/img/ruble-svg.svg" alt="">
        </div>
        <div class="search-flex search-term elem"><select name="term">
            <option value="1">Посуточно</option>
            <option value="2">Долгосрочно</option>
        </select></div>
        <div class="search-flex search-metro"><img src="/template/img/shape.svg" alt="">&nbsp;&nbsp;&nbsp;Метро</div>
        <button type="submit" class="search-flex search-button">Найти</button>
    </div>
    <div class="search-advanced search-flex">
        <div class="search-advanced-tags">
            <input type="text" id="demo-input" name="blah" />
        <!--
            <div class="search-tags">
                <span>Ленинский проспект</span>
                <a class="search-tags-remove"></a>
            </div>
            <div class="search-tags">
                <span>метро Кузьминки</span>
                <a class="search-tags-remove"></a>
            </div>
            <div class="search-tags">
                <span>метро Свибловое</span>
                <a class="search-tags-remove"></a>
            </div>
            <div class="search-tags">
                <span>проезд Мира, 6</span>
                <a class="search-tags-remove"></a>
            </div>
            <div class="search-tags">
                <span>ул. Бориса Голушкина</span>
                <a class="search-tags-remove"></a>
            </div>
            -->
        </div>
        <div class="search-advanced-params">
            <label><input type="checkbox" name="non-commission" value="1" checked="checked"> Без комиссии</label>
            <label><input type="checkbox" name="bargain" value="1"> Торг уместен</label>
        </div>
    </div>
    <div class="search-more">
    </div>
</form>
