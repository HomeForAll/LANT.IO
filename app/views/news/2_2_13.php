Жилая - Купить - Гараж/Машиноместо

<fieldset>
    <legend>Базовый раздел</legend><br>
    <b >Цена</b><br>
    <label for="price">Стоимость:</label><br>
    <input id="price" name="price" <?php inputToInput("price"); ?> type="text" ><br>
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
    <label for="distance_from_metro">Удаленность от метро:</label><br>
    <input id="distance_from_metro" name="distance_from_metro" <?php inputToInput("distance_from_metro"); ?> type="text" ><br>
    <label for="object_located">Объект размещен</label><br>
    <select name="object_located" id="object_located">
        <option value="0">---</option>
        <option value="22" <?php inputToSelect('object_located','22'); ?> >Риэлтором</option>
        <option value="21" <?php inputToSelect('object_located','21'); ?> >Собственником</option>
    </select><br>
    <label >Торг <input type="hidden" name="bargain" value="">
<input type="checkbox" name="bargain" <?php inputToCheckbox("bargain"); ?> ></label><br>
    <br>
</fieldset><br>

<fieldset>
    <legend>Основное</legend><br>
    <label for="space">Площадь:</label><br>
    <input id="space" name="space" <?php inputToInput("space"); ?> type="text" ><br>
    <label for="ceiling_height">Высота потолков:</label><br>
    <input id="ceiling_height" name="ceiling_height" <?php inputToInput("ceiling_height"); ?> type="text" ><br>
    <label for="number_of_floors">Количество этажей:</label><br>
    <input id="number_of_floors" name="number_of_floors" <?php inputToInput("number_of_floors"); ?> type="text" ><br>
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
    <label for="clarification_of_the_object_type">Уточнение вида объектов</label><br>
    <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
        <option value="0">---</option>
        <option value="92" <?php inputToSelect('clarification_of_the_object_type','92'); ?> >Собственность менее 5 лет</option>
        <option value="93" <?php inputToSelect('clarification_of_the_object_type','93'); ?> >Собственность более 5 лет</option>
        <option value="70" <?php inputToSelect('clarification_of_the_object_type','70'); ?> >Участок с подрядом</option>
        <option value="33" <?php inputToSelect('clarification_of_the_object_type','33'); ?> >Незавершенное строительство</option>
        <option value="83" <?php inputToSelect('clarification_of_the_object_type','83'); ?> >Новостройка</option>
    </select><br>
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
    <label for="year_of_construction">Год постройки/окончания строительства:</label><br>
    <input id="year_of_construction" name="year_of_construction" <?php inputToInput("year_of_construction"); ?> type="text" ><br>
    <br>
</fieldset><br>

<fieldset>
    <legend>Дополнительно</legend><br>
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
    <br>
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