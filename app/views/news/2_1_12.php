Жилая - Арендовать - Дом

<fieldset>
    <legend>Базовый раздел</legend>
    <br>
    <b>Цена</b><br>
    <label for="price">Стоимость:</label><br>
    <input id="price" name="price" <?php inputToInput("price"); ?> type="text"><br>
    <label for="lease">Срок аренды</label><br>
    <select name="lease" id="lease">
        <option value="0">---</option>
        <option value="80" <?php inputToSelect('lease', '80'); ?> >Более года</option>
        <option value="145" <?php inputToSelect('lease', '145'); ?> >Год</option>
        <option value="79" <?php inputToSelect('lease', '79'); ?> >Месяц</option>
        <option value="138" <?php inputToSelect('lease', '138'); ?> >Неделя</option>
        <option value="37" <?php inputToSelect('lease', '37'); ?> >День</option>
    </select><br>
    <label>Торг <input type="hidden" name="bargain" value="">
        <input type="checkbox" name="bargain" <?php inputToCheckbox("bargain"); ?> ></label><br>
    <b>Расположение</b><br>
    <label for="suggest">Полный адрес
        <input type="text" name="address" style=" width: 600px;" <?php inputToInput("address"); ?> id="suggest"
               placeholder="Полный адрес"><br>
    </label>
    <label for="country">Страна
        <input type="text" name="country" id="country" class="address" placeholder="Страна"><br>
    </label>
    <label for="area">Область
        <input type="text" name="area" id="area" class="address" placeholder="Область"><br>
    </label>
    <label for="city">Город
        <input type="text" name="city" id="city" class="address" placeholder="Город"><br>
    </label>
    <label for="street">Улица
        <input type="text" name="street" id="street" class="address" placeholder="Улица"><br>
    </label>
    <label for="house">Дом
        <input type="text" name="house" id="house" class="address" placeholder="Дом"><br>
    </label>
    <div id="ymap" style="margin: 0 auto; width: 400px; height: 400px; background: #000;"></div>

    <label>Кадастровый номер <input type="text"
                                    name="cadastral_number" <?php inputToInput("cadastral_number"); ?> ></label><br>
    <label for="distance_from_metro">Удаленность от метро:</label><br>
    <input id="distance_from_metro"
           name="distance_from_metro" <?php inputToInput("distance_from_metro"); ?> type="text"><br>

    <label for="object_located">Объект размещен</label><br>
    <select name="object_located" id="object_located">
        <option value="0">---</option>
        <option value="22" <?php inputToSelect('object_located', '22'); ?> >Риэлтором</option>
        <option value="21" <?php inputToSelect('object_located', '21'); ?> >Собственником</option>
    </select><br>
    <br>
</fieldset><br>

<fieldset>
    <legend>Параметры объекта</legend>
    <br>
    <label for="number_of_rooms">Количество комнат</label><br>
    <select name="number_of_rooms" id="number_of_rooms">
        <option value="0">---</option>
        <option value="4" <?php inputToSelect('number_of_rooms', '4'); ?> >4+</option>
        <option value="3" <?php inputToSelect('number_of_rooms', '3'); ?> >3</option>
        <option value="2" <?php inputToSelect('number_of_rooms', '2'); ?> >2</option>
        <option value="1" <?php inputToSelect('number_of_rooms', '1'); ?> >1</option>
    </select><br>
    <label for="number_of_floors">Количество этажей:</label><br>
    <input id="number_of_floors" name="number_of_floors" <?php inputToInput("number_of_floors"); ?> type="text"><br>
    <b>Площадь</b><br>
    <label for="residential">Жилая:</label><br>
    <input id="residential" name="residential" <?php inputToInput("residential"); ?> type="text"><br>
    <label for="not_residential">Нежилая:</label><br>
    <input id="not_residential" name="not_residential" <?php inputToInput("not_residential"); ?> type="text"><br>
    <label for="common">Общая:</label><br>
    <input id="common" name="common" <?php inputToInput("common"); ?> type="text"><br>
    <label for="balcony">Балкон:</label><br>
    <input id="balcony" name="balcony" <?php inputToInput("balcony"); ?> type="text"><br>
    <label for="ceiling_height">Высота потолков:</label><br>
    <input id="ceiling_height" name="ceiling_height" <?php inputToInput("ceiling_height"); ?> type="text"><br>
    <label for="lavatory">Санузел</label><br>
    <select name="lavatory" id="lavatory">
        <option value="0">---</option>
        <option value="116" <?php inputToSelect('lavatory', '116'); ?> >Раздельный</option>
        <option value="29" <?php inputToSelect('lavatory', '29'); ?> >Совмещенный</option>
    </select><br>
    <label for="roofing">Кровля</label><br>
    <select name="roofing" id="roofing">
        <option value="0">---</option>
        <option value="127" <?php inputToSelect('roofing', '127'); ?> >Временная</option>
        <option value="118" <?php inputToSelect('roofing', '118'); ?> >Шифер</option>
        <option value="122" <?php inputToSelect('roofing', '122'); ?> >Камень</option>
        <option value="123" <?php inputToSelect('roofing', '123'); ?> >Солома</option>
        <option value="129" <?php inputToSelect('roofing', '129'); ?> >Черепица</option>
        <option value="76" <?php inputToSelect('roofing', '76'); ?> >Металлочерепица</option>
        <option value="34" <?php inputToSelect('roofing', '34'); ?> >Медь</option>
        <option value="67" <?php inputToSelect('roofing', '67'); ?> >Железо</option>
    </select><br>
    <label for="foundation">Фундамент</label><br>
    <select name="foundation" id="foundation">
        <option value="0">---</option>
        <option value="140" <?php inputToSelect('foundation', '140'); ?> >Без фундамента</option>
        <option value="58" <?php inputToSelect('foundation', '58'); ?> >Ростверк</option>
        <option value="109" <?php inputToSelect('foundation', '109'); ?> >Ленточный</option>
        <option value="125" <?php inputToSelect('foundation', '125'); ?> >Шведская плита</option>
        <option value="120" <?php inputToSelect('foundation', '120'); ?> >Монолитная плита</option>
    </select><br>
    <label for="wall_material">Материал стен</label><br>
    <select name="wall_material" id="wall_material">
        <option value="0">---</option>
        <option value="49" <?php inputToSelect('wall_material', '49'); ?> >Фахверк</option>
        <option value="56" <?php inputToSelect('wall_material', '56'); ?> >Клееный брус</option>
        <option value="102" <?php inputToSelect('wall_material', '102'); ?> >Профилированный брус</option>
        <option value="112" <?php inputToSelect('wall_material', '112'); ?> >Оцилиндрованное бревно</option>
        <option value="24" <?php inputToSelect('wall_material', '24'); ?> >Лафет</option>
        <option value="27" <?php inputToSelect('wall_material', '27'); ?> >Рубленое дерево</option>
        <option value="105" <?php inputToSelect('wall_material', '105'); ?> >Железобетон</option>
        <option value="28" <?php inputToSelect('wall_material', '28'); ?> >Шлакоблоки</option>
        <option value="55" <?php inputToSelect('wall_material', '55'); ?> >Газосиликатные блоки</option>
        <option value="96" <?php inputToSelect('wall_material', '96'); ?> >Пеноблок</option>
        <option value="105" <?php inputToSelect('wall_material', '105'); ?> >Железобетон</option>
        <option value="19" <?php inputToSelect('wall_material', '19'); ?> >Кирпич</option>
    </select><br>
    <label for="type_of_house">Тип дома</label><br>
    <select name="type_of_house" id="type_of_house">
        <option value="0">---</option>
        <option value="35" <?php inputToSelect('type_of_house', '35'); ?> >Коттедж</option>
        <option value="130" <?php inputToSelect('type_of_house', '130'); ?> >Таунхаус</option>
        <option value="42" <?php inputToSelect('type_of_house', '42'); ?> >Дуплекс</option>
    </select><br>
    <br>
</fieldset><br>

<fieldset>
    <legend> Ремонт и обустройство</legend>
    <br>
    <span>Комнаты</span><br>
    <label>Ванная <input type="hidden" name="bathroom" value="">
        <input type="checkbox" name="bathroom" <?php inputToCheckbox("bathroom"); ?> ></label><br>
    <label>Столовая <input type="hidden" name="dining_room" value="">
        <input type="checkbox" name="dining_room" <?php inputToCheckbox("dining_room"); ?> ></label><br>
    <label>Рабочий кабинет <input type="hidden" name="study" value="">
        <input type="checkbox" name="study" <?php inputToCheckbox("study"); ?> ></label><br>
    <label>Детская <input type="hidden" name="playroom" value="">
        <input type="checkbox" name="playroom" <?php inputToCheckbox("playroom"); ?> ></label><br>
    <label>Прихожая <input type="hidden" name="hallway" value="">
        <input type="checkbox" name="hallway" <?php inputToCheckbox("hallway"); ?> ></label><br>
    <label>Гостиная <input type="hidden" name="living_room" value="">
        <input type="checkbox" name="living_room" <?php inputToCheckbox("living_room"); ?> ></label><br>
    <label>Кухня <input type="hidden" name="kitchen" value="">
        <input type="checkbox" name="kitchen" <?php inputToCheckbox("kitchen"); ?> ></label><br>
    <label>Спальня <input type="hidden" name="bedroom" value="">
        <input type="checkbox" name="bedroom" <?php inputToCheckbox("bedroom"); ?> ></label><br>

    <label>Комплектация - Укомплектованная<input type="hidden" name="equipment" value="">
        <input type="checkbox" name="equipment" <?php inputToCheckbox("equipment"); ?> ></label><br>
    <br></fieldset><br>

    <label for="furnish">Отделка</label><br>
    <select name="furnish" id="furnish">
        <option value="0">---</option>
        <option value="141" <?php inputToSelect('furnish', '141'); ?> >Без ремонта</option>
        <option value="65" <?php inputToSelect('furnish', '65'); ?> >Незавершенный ремонт</option>
        <option value="107" <?php inputToSelect('furnish', '107'); ?> >Требуется ремонт</option>
        <option value="106" <?php inputToSelect('furnish', '106'); ?> >Требуется косметический ремонт</option>
        <option value="57" <?php inputToSelect('furnish', '57'); ?> >Хорошая отделка</option>
        <option value="64" <?php inputToSelect('furnish', '64'); ?> >Высококачественная отделка</option>
        <option value="46" <?php inputToSelect('furnish', '46'); ?> >Эксклюзивного качества</option>
    </select><br>
    <label for="clarification_of_the_object_type">Уточнение вида объектов</label><br>
    <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
        <option value="0">---</option>
        <option value="92" <?php inputToSelect('clarification_of_the_object_type', '92'); ?> >Собственность менее 5
            лет
        </option>
        <option value="93" <?php inputToSelect('clarification_of_the_object_type', '93'); ?> >Собственность более 5
            лет
        </option>
        <option value="70" <?php inputToSelect('clarification_of_the_object_type', '70'); ?> >Участок с подрядом
        </option>
        <option value="33" <?php inputToSelect('clarification_of_the_object_type', '33'); ?> >Незавершенное
            строительство
        </option>
        <option value="83" <?php inputToSelect('clarification_of_the_object_type', '83'); ?> >Новостройка</option>
    </select><br>
    <label for="year_of_construction">Год постройки/окончания строительства:</label><br>
    <input id="year_of_construction" name="year_of_construction" <?php inputToInput("year_of_construction"); ?>
           type="text"><br>
    <span>Жилищно-коммунальные услуги</span><br>
    <label>Водопровод <input type="hidden" name="water_pipes" value="">
        <input type="checkbox" name="water_pipes" <?php inputToCheckbox("water_pipes"); ?> ></label><br>
    <label>Электричество <input type="hidden" name="electricity" value="">
        <input type="checkbox" name="electricity" <?php inputToCheckbox("electricity"); ?> ></label><br>
    <label>Отопление <input type="hidden" name="heating" value="">
        <input type="checkbox" name="heating" <?php inputToCheckbox("heating"); ?> ></label><br>
    <label>Газ <input type="hidden" name="gas" value="">
        <input type="checkbox" name="gas" <?php inputToCheckbox("gas"); ?> ></label><br>
    <span>Безопасность</span><br>
    <label>Сигнализация <input type="hidden" name="signaling" value="">
        <input type="checkbox" name="signaling" <?php inputToCheckbox("signaling"); ?> ></label><br>
    <label>Видеонаблюдение <input type="hidden" name="cctv" value="">
        <input type="checkbox" name="cctv" <?php inputToCheckbox("cctv"); ?> ></label><br>
    <label>Домофон <input type="hidden" name="intercom" value="">
        <input type="checkbox" name="intercom" <?php inputToCheckbox("intercom"); ?> ></label><br>
    <label>Охрана <input type="hidden" name="security" value="">
        <input type="checkbox" name="security" <?php inputToCheckbox("security"); ?> ></label><br>
    <label>Консьерж <input type="hidden" name="concierge" value="">
        <input type="checkbox" name="concierge" <?php inputToCheckbox("concierge"); ?> ></label><br>
</fieldset><br>

<fieldset>
    <legend>Участок</legend>
    <br>
    <span>Парковка</span><br>
    <label>Многоуровневая парковка<input type="hidden" name="parking_multilevel" value="">
        <input type="checkbox" name="parking_multilevel" <?php inputToCheckbox("parking_multilevel"); ?> ></label><br>
    <label>Подземная парковка<input type="hidden" name="parking_underground" value="">
        <input type="checkbox" name="parking_underground" <?php inputToCheckbox("parking_underground"); ?> ></label><br>
    <label>Гаражный комплекс<input type="hidden" name="parking_garage_complex" value="">
        <input type="checkbox" name="parking_garage_complex" <?php inputToCheckbox("parking_garage_complex"); ?> ></label><br>
    <label>Придомовый гараж<input type="hidden" name="parking_lot_garage" value="">
        <input type="checkbox" name="parking_lot_garage" <?php inputToCheckbox("parking_lot_garage"); ?> ></label><br>
    <label>Отсутствует<input type="hidden" name="parking_none" value="">
        <input type="checkbox" name="parking_none" <?php inputToCheckbox("parking_none"); ?> ></label><br>


    <span>Дополнительные строения</span><br>
    <label>Сторожка <input type="hidden" name="lodge" value="">
        <input type="checkbox" name="lodge" <?php inputToCheckbox("lodge"); ?> ></label><br>
    <label>Гостевой дом <input type="hidden" name="guest_house" value="">
        <input type="checkbox" name="guest_house" <?php inputToCheckbox("guest_house"); ?> ></label><br>
    <label>Баня <input type="hidden" name="bath" value="">
        <input type="checkbox" name="bath" <?php inputToCheckbox("bath"); ?> ></label><br>
    <label>Бассейн <input type="hidden" name="swimming_pool" value="">
        <input type="checkbox" name="swimming_pool" <?php inputToCheckbox("swimming_pool"); ?> ></label><br>
    <label>Детская площадка <input type="hidden" name="playground" value="">
        <input type="checkbox" name="playground" <?php inputToCheckbox("playground"); ?> ></label><br>
    <label>Винный погреб <input type="hidden" name="wine_vault" value="">
        <input type="checkbox" name="wine_vault" <?php inputToCheckbox("wine_vault"); ?> ></label><br>
    <label>Сарай <input type="hidden" name="barn" value="">
        <input type="checkbox" name="barn" <?php inputToCheckbox("barn"); ?> ></label><br>
    <label>Беседка <input type="hidden" name="alcove" value="">
        <input type="checkbox" name="alcove" <?php inputToCheckbox("alcove"); ?> ></label><br>

    <span>Участок</span><br>
    <label>Участок Ровный<input type="hidden" name="plot_smooth" value="">
        <input type="checkbox" name="plot_smooth" <?php inputToCheckbox("plot_smooth"); ?> ></label><br>
    <label>Участок Неровный<input type="hidden" name="plot_uneven" value="">
        <input type="checkbox" name="plot_uneven" <?php inputToCheckbox("plot_uneven"); ?> ></label><br>
    <label>Участок На склоне<input type="hidden" name="plot_on_the_slope" value="">
        <input type="checkbox" name="plot_on_the_slope" <?php inputToCheckbox("plot_on_the_slope"); ?> ></label><br>
    <label>Участок Овраг<input type="hidden" name="plot_of_ravine" value="">
        <input type="checkbox" name="plot_of_ravine" <?php inputToCheckbox("plot_of_ravine"); ?> ></label><br>
    <label>Участок Заболоченный<input type="hidden" name="plot_wetland" value="">
        <input type="checkbox" name="plot_wetland" <?php inputToCheckbox("plot_wetland"); ?> ></label><br>

    <span>На участке</span><br>
    <label>Берег водоема <input type="hidden" name="waterfront" value="">
        <input type="checkbox" name="waterfront" <?php inputToCheckbox("waterfront"); ?> ></label><br>
    <label>Река <input type="hidden" name="river" value="">
        <input type="checkbox" name="river" <?php inputToCheckbox("river"); ?> ></label><br>
    <label>Родник <input type="hidden" name="spring" value="">
        <input type="checkbox" name="spring" <?php inputToCheckbox("spring"); ?> ></label><br>
    <label>Садовые деревья <input type="hidden" name="garden_trees" value="">
        <input type="checkbox" name="garden_trees" <?php inputToCheckbox("garden_trees"); ?> ></label><br>
    <label>Лесные деревья <input type="hidden" name="forest_trees" value="">
        <input type="checkbox" name="forest_trees" <?php inputToCheckbox("forest_trees"); ?> ></label><br>

    <label for="fencing">Ограждение</label><br>
    <select name="fencing" id="fencing">
        <option value="0">---</option>
        <option value="143" <?php inputToSelect('material', '143'); ?> >Кованая ограда</option>
        <option value="75" <?php inputToSelect('material', '75'); ?> >Металлические прутья</option>
        <option value="19" <?php inputToSelect('material', '19'); ?> >Кирпич</option>
        <option value="31" <?php inputToSelect('material', '31'); ?> >Бетон</option>
        <option value="122" <?php inputToSelect('material', '122'); ?> >Камень</option>
        <option value="38" <?php inputToSelect('material', '38'); ?> >Профнастил</option>
        <option value="142" <?php inputToSelect('material', '142'); ?> >Дерево</option>
        <option value="98" <?php inputToSelect('material', '98'); ?> >Пластик</option>
    </select><br>
</fieldset><br>

<fieldset>
    <legend> Вложения</legend>
    <label for="planning_project">Проект планировки</label>
    <input type="file" name="planning_project" multiple accept=""/>
    <label for="three_d_project">3d проект</label>
    <input type="file" name="three_d_project" multiple accept=""/>
    <label for="video">Видео</label>
    <input type="file" name="video" multiple accept=""/>
</fieldset>