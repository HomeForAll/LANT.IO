Жилая - Купить - Дом

<fieldset>
    <legend>Базовый раздел</legend><br>
    <b >Цена</b><br>
    <label for="price">Стоимость:</label><br>
    <input id="price" name="price" <?php inputToInput("price"); ?> type="text" ><br>
    <label >Торг <input type="hidden" name="bargain" value="">
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

    <label >Кадастровый номер <input type="text" name="cadastral_number" <?php inputToInput("cadastral_number"); ?> ></label><br>
    <label for="residential">Удаленность от МКАД/метро:</label><br>
    <input id="residential" name="distance_from_mkad_or_metro" <?php inputToInput("distance_from_mkad_or_metro"); ?> type="text" ><br>
    <label for="object_located">Объект размещен</label><br>
    <select name="object_located" id="object_located">
        <option value="0">---</option>
        <option value="22" <?php inputToSelect('object_located','22'); ?> >Риэлтором</option>
        <option value="21" <?php inputToSelect('object_located','21'); ?> >Собственником</option>
    </select><br>
    <br>
</fieldset><br>

<fieldset>
    <legend>Параметры объекта</legend><br>
    <label for="number_of_rooms">Количество комнат</label><br>
    <select name="number_of_rooms" id="number_of_rooms">
        <option value="0">---</option>
        <option value="4" <?php inputToSelect('number_of_rooms','4'); ?> >4+</option>
        <option value="3" <?php inputToSelect('number_of_rooms','3'); ?> >3</option>
        <option value="2" <?php inputToSelect('number_of_rooms','2'); ?> >2</option>
        <option value="1" <?php inputToSelect('number_of_rooms','1'); ?> >1</option>
    </select><br>
    <label for="number_of_floors">Количество этажей:</label><br>
    <input id="number_of_floors" name="number_of_floors" <?php inputToInput("number_of_floors"); ?> type="text" ><br>
    <b>Площадь</b><br>
    <label for="residential">Жилая:</label><br>
    <input id="residential" name="residential" <?php inputToInput("residential"); ?> type="text" ><br>
    <label for="not_residential">Нежилая:</label><br>
    <input id="not_residential" name="not_residential" <?php inputToInput("not_residential"); ?> type="text" ><br>
    <label for="total">Общая:</label><br>
    <input id="total" name="total" <?php inputToInput("total"); ?> type="text" ><br>
    <label for="balcony">Балкон:</label><br>
    <input id="balcony" name="balcony" <?php inputToInput("balcony"); ?> type="text" ><br>
    <label for="ceiling_height">Высота потолков:</label><br>
    <input id="ceiling_height" name="ceiling_height" <?php inputToInput("ceiling_height"); ?> type="text" ><br>
    <label for="lavatory">Санузел</label><br>
    <select name="lavatory" id="lavatory">
        <option value="0">---</option>
        <option value="116" <?php inputToSelect('lavatory','116'); ?> >Раздельный</option>
        <option value="29" <?php inputToSelect('lavatory','29'); ?> >Совмещенный</option>
    </select><br>
    <label for="roofing">Кровля</label><br>
    <select name="roofing" id="roofing">
        <option value="0">---</option>
        <option value="127" <?php inputToSelect('roofing','127'); ?> >Временная</option>
        <option value="118" <?php inputToSelect('roofing','118'); ?> >Шифер</option>
        <option value="122" <?php inputToSelect('roofing','122'); ?> >Камень</option>
        <option value="123" <?php inputToSelect('roofing','123'); ?> >Солома</option>
        <option value="129" <?php inputToSelect('roofing','129'); ?> >Черепица</option>
        <option value="76" <?php inputToSelect('roofing','76'); ?> >Металлочерепица</option>
        <option value="34" <?php inputToSelect('roofing','34'); ?> >Медь</option>
        <option value="67" <?php inputToSelect('roofing','67'); ?> >Железо</option>
    </select><br>
    <label for="foundation">Фундамент</label><br>
    <select name="foundation" id="foundation">
        <option value="0">---</option>
        <option value="140" <?php inputToSelect('foundation','140'); ?> >Без фундамента</option>
        <option value="58" <?php inputToSelect('foundation','58'); ?> >Ростверк</option>
        <option value="109" <?php inputToSelect('foundation','109'); ?> >Ленточный</option>
        <option value="125" <?php inputToSelect('foundation','125'); ?> >Шведская плита</option>
        <option value="120" <?php inputToSelect('foundation','120'); ?> >Монолитная плита</option>
    </select><br>
    <label for="wall_material">Материал стен</label><br>
    <select name="wall_material" id="wall_material">
        <option value="0">---</option>
        <option value="49" <?php inputToSelect('wall_material','49'); ?> >Фахверк</option>
        <option value="56" <?php inputToSelect('wall_material','56'); ?> >Клееный брус</option>
        <option value="102" <?php inputToSelect('wall_material','102'); ?> >Профилированный брус</option>
        <option value="112" <?php inputToSelect('wall_material','112'); ?> >Оцилиндрованное бревно</option>
        <option value="24" <?php inputToSelect('wall_material','24'); ?> >Лафет</option>
        <option value="27" <?php inputToSelect('wall_material','27'); ?> >Рубленое дерево</option>
        <option value="105" <?php inputToSelect('wall_material','105'); ?> >Железобетон</option>
        <option value="28" <?php inputToSelect('wall_material','28'); ?> >Шлакоблоки</option>
        <option value="55" <?php inputToSelect('wall_material','55'); ?> >Газосиликатные блоки</option>
        <option value="96" <?php inputToSelect('wall_material','96'); ?> >Пеноблок</option>
        <option value="105" <?php inputToSelect('wall_material','105'); ?> >Железобетон</option>
        <option value="19" <?php inputToSelect('wall_material','19'); ?> >Кирпич</option>
    </select><br>
    <label for="type_of_house">Тип дома</label><br>
    <select name="type_of_house" id="type_of_house">
        <option value="0">---</option>
        <option value="35" <?php inputToSelect('type_of_house','35'); ?> >Коттедж</option>
        <option value="130" <?php inputToSelect('type_of_house','130'); ?> >Таунхаус</option>
        <option value="42" <?php inputToSelect('type_of_house','42'); ?> >Дуплекс</option>
    </select><br>
    <br>
</fieldset><br>

<fieldset>
    <legend> Ремонт и обустройство</legend><br>
    <span >Комнаты</span><br>
    <label >Ванная <input type="hidden" name="bathroom" value="">
<input type="checkbox" name="bathroom" <?php inputToCheckbox("bathroom"); ?> ></label><br>
    <label >Столовая <input type="hidden" name="dining_room" value="">
<input type="checkbox" name="dining_room" <?php inputToCheckbox("dining_room"); ?> ></label><br>
    <label >Рабочий кабинет <input type="hidden" name="study" value="">
<input type="checkbox" name="study" <?php inputToCheckbox("study"); ?> ></label><br>
    <label >Детская <input type="hidden" name="playroom" value="">
<input type="checkbox" name="playroom" <?php inputToCheckbox("playroom"); ?> ></label><br>
    <label >Прихожая <input type="hidden" name="hallway" value="">
<input type="checkbox" name="hallway" <?php inputToCheckbox("hallway"); ?> ></label><br>
    <label >Гостиная <input type="hidden" name="living_room" value="">
<input type="checkbox" name="living_room" <?php inputToCheckbox("living_room"); ?> ></label><br>
    <label >Кухня <input type="hidden" name="kitchen" value="">
<input type="checkbox" name="kitchen" <?php inputToCheckbox("kitchen"); ?> ></label><br>
    <label >Спальня <input type="hidden" name="bedroom" value="">
<input type="checkbox" name="bedroom" <?php inputToCheckbox("bedroom"); ?> ></label><br>
    <label for="equipment">Комплектация</label><br>
    <select name="equipment" id="equipment">
        <option value="0">---</option>
        <option value="44" <?php inputToSelect('equipment','44'); ?> >Пустая</option>
        <option value="45" <?php inputToSelect('equipment','45'); ?> >Укомплектованная</option>
    </select><br>
    <label for="furnish">Отделка</label><br>
    <select name="furnish" id="furnish">
        <option value="0">---</option>
        <option value="141" <?php inputToSelect('furnish','141'); ?> >Без ремонта</option>
        <option value="65" <?php inputToSelect('furnish','65'); ?> >Незавершенный ремонт</option>
        <option value="107" <?php inputToSelect('furnish','107'); ?> >Требуется ремонт</option>
        <option value="106" <?php inputToSelect('furnish','106'); ?> >Требуется косметический ремонт</option>
        <option value="57" <?php inputToSelect('furnish','57'); ?> >Хорошая отделка</option>
        <option value="64" <?php inputToSelect('furnish','64'); ?> >Высококачественная отделка</option>
        <option value="46" <?php inputToSelect('furnish','46'); ?> >Эксклюзивного качества</option>
    </select><br>
    <label for="clarification_of_the_object_type">Уточнение вида объектов</label><br>
    <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
        <option value="0">---</option>
        <option value="92" <?php inputToSelect('clarification_of_the_object_type','92'); ?> >Собственность менее 5 лет</option>
        <option value="93" <?php inputToSelect('clarification_of_the_object_type','93'); ?> >Собственность более 5 лет</option>
        <option value="70" <?php inputToSelect('clarification_of_the_object_type','70'); ?> >Участок с подрядом</option>
        <option value="33" <?php inputToSelect('clarification_of_the_object_type','33'); ?> >Незавершенное строительство</option>
        <option value="83" <?php inputToSelect('clarification_of_the_object_type','83'); ?> >Новостройка</option>
    </select><br>
    <label for="year_of_construction">Год постройки/окончания строительства:</label><br>
    <input id="year_of_construction" name="year_of_construction" <?php inputToInput("year_of_construction"); ?> type="text" ><br>
    <span >Жилищно-коммунальные услуги</span><br>
    <label >Водопровод <input type="hidden" name="water_pipes" value="">
<input type="checkbox" name="water_pipes" <?php inputToCheckbox("water_pipes"); ?> ></label><br>
    <label >Электричество <input type="hidden" name="electricity" value="">
<input type="checkbox" name="electricity" <?php inputToCheckbox("electricity"); ?> ></label><br>
    <label >Отопление <input type="hidden" name="heating" value="">
<input type="checkbox" name="heating" <?php inputToCheckbox("heating"); ?> ></label><br>
    <label >Газ <input type="hidden" name="gas" value="">
<input type="checkbox" name="gas" <?php inputToCheckbox("gas"); ?> ></label><br>
    <span >Безопасность</span><br>
    <label >Сигнализация <input type="hidden" name="signaling" value="">
<input type="checkbox" name="signaling" <?php inputToCheckbox("signaling"); ?> ></label><br>
    <label >Видеонаблюдение <input type="hidden" name="cctv" value="">
<input type="checkbox" name="cctv" <?php inputToCheckbox("cctv"); ?> ></label><br>
    <label >Домофон <input type="hidden" name="intercom" value="">
<input type="checkbox" name="intercom" <?php inputToCheckbox("intercom"); ?> ></label><br>
    <label >Охрана <input type="hidden" name="security" value="">
<input type="checkbox" name="security" <?php inputToCheckbox("security"); ?> ></label><br>
    <label >Консьерж <input type="hidden" name="concierge" value="">
<input type="checkbox" name="concierge" <?php inputToCheckbox("concierge"); ?> ></label><br>
</fieldset><br>

<fieldset>
    <legend>Участок</legend><br>
    <label for="parking">Парковка</label><br>
    <select name="parking" id="parking">
        <option value="0">---</option>
        <option value="5" <?php inputToSelect('parking','5'); ?> >Отсутствует</option>
        <option value="7" <?php inputToSelect('parking','7'); ?> >Придомовой гараж</option>
        <option value="52" <?php inputToSelect('parking','52'); ?> >Гаражный комплекс</option>
        <option value="132" <?php inputToSelect('parking','132'); ?> >Подземная парковка</option>
        <option value="81" <?php inputToSelect('parking','81'); ?> >Многоуровневый паркинг</option>
    </select><br>
    <span >Дополнительные строения</span><br>
    <label >Сторожка <input type="hidden" name="lodge" value="">
<input type="checkbox" name="lodge" <?php inputToCheckbox("lodge"); ?> ></label><br>
    <label >Гостевой дом <input type="hidden" name="guest_house" value="">
<input type="checkbox" name="guest_house" <?php inputToCheckbox("guest_house"); ?> ></label><br>
    <label >Баня <input type="hidden" name="bath" value="">
<input type="checkbox" name="bath" <?php inputToCheckbox("bath"); ?> ></label><br>
    <label >Бассейн <input type="hidden" name="swimming_pool" value="">
<input type="checkbox" name="swimming_pool" <?php inputToCheckbox("swimming_pool"); ?> ></label><br>
    <label >Детская площадка <input type="hidden" name="playground" value="">
<input type="checkbox" name="playground" <?php inputToCheckbox("playground"); ?> ></label><br>
    <label >Винный погреб <input type="hidden" name="wine_vault" value="">
<input type="checkbox" name="wine_vault" <?php inputToCheckbox("wine_vault"); ?> ></label><br>
    <label >Сарай <input type="hidden" name="barn" value="">
<input type="checkbox" name="barn" <?php inputToCheckbox("barn"); ?> ></label><br>
    <label >Беседка <input type="hidden" name="alcove" value="">
<input type="checkbox" name="alcove" <?php inputToCheckbox("alcove"); ?> ></label><br>
    <label for="site">Участок</label><br>
    <select name="site" id="site">
        <option value="0">---</option>
        <option value="136" <?php inputToSelect('site','136'); ?> >Заболоченный</option>
        <option value="103" <?php inputToSelect('site','103'); ?> >Овраг</option>
        <option value="89" <?php inputToSelect('site','89'); ?> >На склоне</option>
        <option value="133" <?php inputToSelect('site','133'); ?> >Неровный</option>
        <option value="119" <?php inputToSelect('site','119'); ?> >Ровный</option>
    </select><br>
    <span >На участке</span><br>
    <label >Берег водоема <input type="hidden" name="waterfront" value="">
<input type="checkbox" name="waterfront" <?php inputToCheckbox("waterfront"); ?> ></label><br>
    <label >Река <input type="hidden" name="river" value="">
<input type="checkbox" name="river" <?php inputToCheckbox("river"); ?> ></label><br>
    <label >Родник <input type="hidden" name="spring" value="">
<input type="checkbox" name="spring" <?php inputToCheckbox("spring"); ?> ></label><br>
    <label >Садовые деревья <input type="hidden" name="garden_trees" value="">
<input type="checkbox" name="garden_trees" <?php inputToCheckbox("garden_trees"); ?> ></label><br>
    <label >Лесные деревья <input type="hidden" name="forest_trees" value="">
<input type="checkbox" name="forest_trees" <?php inputToCheckbox("forest_trees"); ?> ></label><br>
    <label >Ограждение <input type="hidden" name="fencing" value="">
<input type="checkbox" name="fencing" <?php inputToCheckbox("fencing"); ?> ></label><br>
    <label for="material">Материал</label><br>
    <select name="material" id="material">
        <option value="0">---</option>
        <option value="143" <?php inputToSelect('material','143'); ?> >Кованая ограда</option>
        <option value="75" <?php inputToSelect('material','75'); ?> >Металлические прутья</option>
        <option value="19" <?php inputToSelect('material','19'); ?> >Кирпич</option>
        <option value="31" <?php inputToSelect('material','31'); ?> >Бетон</option>
        <option value="122" <?php inputToSelect('material','122'); ?> >Камень</option>
        <option value="38" <?php inputToSelect('material','38'); ?> >Профнастил</option>
        <option value="142" <?php inputToSelect('material','142'); ?> >Дерево</option>
        <option value="98" <?php inputToSelect('material','98'); ?> >Пластик</option>
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