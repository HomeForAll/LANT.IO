<h3>Жилая - Арендовать - Квартира</h3>
<fieldset>
    <legend>Базовый раздел</legend>
    <br>
    <b>Цена</b><br>
    <label for="price">Стоимость:</label><br>
    <input id="price" name="price" <?php inputToInput("price"); ?> type="text"><br>
    <label for="lease">Срок аренды</label><br>
    <select name="lease" id="lease">
        <option value="0">---</option>
        <option value="80" <?php inputToSelect('lease','80'); ?> >Более года</option>
        <option value="145" <?php inputToSelect('lease','145'); ?> >Год</option>
        <option value="79" <?php inputToSelect('lease','79'); ?> >Месяц</option>
        <option value="138" <?php inputToSelect('lease','138'); ?> >Неделя</option>
        <option value="37" <?php inputToSelect('lease','37'); ?> >День</option>
    </select><br>
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

    <label for="cadastral_number">Кадастровый номер</label><br>
    <input id="cadastral_number" name="cadastral_number" <?php inputToInput("cadastral_number"); ?> type="text"><br>
<!--    <label for="metro_station">Станция метро</label><br>-->
<!--    <select name="metro_station" id="metro_station">-->
<!--        <option value="0">---</option>-->
<!--    </select><br>-->
<!--    <input id="metro_station" name="metro_station" --><?php //inputToInput("metro_station"); ?><!-- type="text"><br>-->
<!--    <input id="time_walk" name="time_walk" type="text" class="valid" aria-invalid="false">   -->
    <?php
    if(isset($this->data['metro_station'])){
        $this->model('NewsModel')->renderMetroSelect($this->data['metro_station']);
    }else{
        $this->model('NewsModel')->renderMetroSelect();
    }
    ?>
    <label for="time_walk">Удаленность от метро пешком (мин):</label><br>
    <input id="time_walk" name="time_walk" <?php inputToInput("time_walk"); ?> type="text"><br>
    <label>Торг <input type="hidden" name="bargain" value="">
<input type="checkbox" name="bargain" <?php inputToCheckbox("bargain"); ?> ></label><br>
    <label for="object_located">Объект размещен</label><br>
    <select name="object_located" id="object_located">
        <option value="0">---</option>
        <option value="22" <?php inputToSelect('object_located','22'); ?> >Риэлтором</option>
        <option value="21" <?php inputToSelect('object_located','21'); ?> >Собственником</option>
    </select><br>
    <br></fieldset><br>
<fieldset>
    <legend>Исходные параметры квартиры</legend>
    <br>
    <b>Площадь</b><br>
    <label for="residential">Жилая:</label><br>
    <input id="residential" name="residential" <?php inputToInput("residential"); ?> type="text"><br>
    <label for="not_residential">Нежилая:</label><br>
    <input id="not_residential" name="not_residential" <?php inputToInput("not_residential"); ?> type="text"><br>
    <label for="common">Общая:</label><br>
    <input id="common" name="common" <?php inputToInput("common"); ?> type="text"><br>
    <label for="balcony">Балкон:</label><br>
    <input id="balcony" name="balcony" <?php inputToInput("balcony"); ?> type="text"><br>
    <label for="number_of_rooms">Количество комнат</label><br>
    <select name="number_of_rooms" id="number_of_rooms">
        <option value="0">---</option>
        <option value="4" <?php inputToSelect('number_of_rooms','4'); ?> >4+</option>
        <option value="3" <?php inputToSelect('number_of_rooms','3'); ?> >3</option>
        <option value="2" <?php inputToSelect('number_of_rooms','2'); ?> >2</option>
        <option value="1" <?php inputToSelect('number_of_rooms','1'); ?> >1</option>
    </select><br>
    <label for="ceiling_height">Высота потолков:</label><br>
    <input id="ceiling_height" name="ceiling_height" <?php inputToInput("ceiling_height"); ?> type="text"><br>
    <label for="floor">Этаж:</label><br>
    <input id="floor" name="floor" <?php inputToInput("floor"); ?> type="text"><br>
    <label for="lavatory">Санузел</label><br>
    <select name="lavatory" id="lavatory">
        <option value="0">---</option>
        <option value="116" <?php inputToSelect('lavatory','116'); ?> >Раздельный</option>
        <option value="29" <?php inputToSelect('lavatory','29'); ?> >Совмещенный</option>
    </select><br>
    <br></fieldset><br>
<fieldset>
    <legend>Ремонт и обустройство квартиры</legend>
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

    <label>Комплектация - Укомплектованная<input type="hidden" name="equipment" value="">
        <input type="checkbox" name="equipment" <?php inputToCheckbox("equipment"); ?> ></label><br>
    <br></fieldset><br>

<fieldset>
    <legend>Характеристики дома</legend>
    <br>
    <b>Наличие лифта</b><br>
     <label>Грузвовой лифт<input type="hidden" name="lift_lifting" value="">
        <input type="checkbox" name="lift_lifting" <?php inputToCheckbox("lift_lifting"); ?> ></label><br>
    <label>Пассажирский лифт<input type="hidden" name="lift_passenger" value="">
        <input type="checkbox" name="lift_passenger" <?php inputToCheckbox("lift_passenger"); ?> ></label><br>
    <label>Без лифта<input type="hidden" name="lift_none" value="">
        <input type="checkbox" name="lift_none" <?php inputToCheckbox("lift_none"); ?> ></label><br>

    <label for="number_of_floors">Количество этажей:</label><br>
    <input id="number_of_floors" name="number_of_floors" <?php inputToInput("number_of_floors"); ?> type="text"><br>
    <label>Наличие мусоропровода <input type="hidden" name="availability_of_garbage_chute" value="">
<input type="checkbox" name="availability_of_garbage_chute" <?php inputToCheckbox("availability_of_garbage_chute"); ?> ></label><br>
    <label for="clarification_of_the_object_type">Уточнение вида объектов</label><br>
    <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
        <option value="0">---</option>
        <option value="146" <?php inputToSelect('clarification_of_the_object_type','146'); ?> >Год постройки\окончания строительства</option>
        <option value="92" <?php inputToSelect('clarification_of_the_object_type','92'); ?> >Собственность менее 5 лет</option>
        <option value="93" <?php inputToSelect('clarification_of_the_object_type','93'); ?> >Собственность более 5 лет</option>
        <option value="70" <?php inputToSelect('clarification_of_the_object_type','70'); ?> >Участок с подрядом</option>
        <option value="33" <?php inputToSelect('clarification_of_the_object_type','33'); ?> >Незавершенное строительство</option>
        <option value="83" <?php inputToSelect('clarification_of_the_object_type','83'); ?> >Новостройка</option>
    </select><br>
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
    <label for="wall_material">Материал стен</label><br>
    <select name="wall_material" id="wall_material">
        <option value="0">---</option>
        <option value="91" <?php inputToSelect('wall_material','91'); ?> >Другое</option>
        <option value="32" <?php inputToSelect('wall_material','32'); ?> >Железобетонные панели</option>
        <option value="78" <?php inputToSelect('wall_material','78'); ?> >Монолит</option>
        <option value="19" <?php inputToSelect('wall_material','19'); ?> >Кирпич</option>
    </select><br>
    <label for="stairwells_status">Состояние лестничных клеток</label><br>
    <select name="stairwells_status" id="stairwells_status">
        <option value="0">---</option>
        <option value="141" <?php inputToSelect('stairwells_status','141'); ?> >Без ремонта</option>
        <option value="107" <?php inputToSelect('stairwells_status','107'); ?> >Требуется ремонт</option>
        <option value="106" <?php inputToSelect('stairwells_status','106'); ?> >Требуется косметический ремонт</option>
        <option value="134" <?php inputToSelect('stairwells_status','134'); ?> >Обычная отделка</option>
        <option value="64" <?php inputToSelect('stairwells_status','64'); ?> >Высококачественная отделка</option>
    </select><br>
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
    <span>Жилищно-коммунальные услуги</span><br>
    <label>Водопровод <input type="hidden" name="water_pipes" value="">
<input type="checkbox" name="water_pipes" <?php inputToCheckbox("water_pipes"); ?> ></label><br>
    <label>Электричество <input type="hidden" name="electricity" value="">
<input type="checkbox" name="electricity" <?php inputToCheckbox("electricity"); ?> ></label><br>
    <label>Газ <input type="hidden" name="gas" value="">
<input type="checkbox" name="gas" <?php inputToCheckbox("gas"); ?> ></label><br>
    <label>Отопление <input type="hidden" name="heating" value="">
<input type="checkbox" name="heating" <?php inputToCheckbox("heating"); ?> ></label><br>
    <label for="year_of_construction">Год постройки/окончания строительства:</label><br>
    <input id="year_of_construction" name="year_of_construction" <?php inputToInput("year_of_construction"); ?> type="text"><br>
    <br></fieldset><br>
<fieldset>
    <legend> Вложения</legend>
    <label for="planning_project">Проект планировки</label>
    <input type="file" name="planning_project" multiple accept=""/>
    <label for="three_d_project">3d проект</label>
    <input type="file" name="three_d_project" multiple accept=""/>
    <label for="video">Видео</label>
    <input type="file" name="video" multiple accept=""/>
</fieldset>