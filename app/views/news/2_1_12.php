Жилая - Арендовать - Дом
<br><form action="" method="post">
    <fieldset>
        <legend>Базовый раздел</legend><br>
        <b style='box-sizing: border-box; margin-left: 20px'>Цена</b><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="price-min">Стоимость:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="price-min" name="price-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="price-max" name="price-max" type="text" placeholder="до"><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="lease">Срок аренды</label><br>
        <select style="margin-left: 40px; box-sizing: border-box;" name="lease" id="lease">
            <option value="80">Более года</option>
            <option value="145">Год</option>
            <option value="61">Полгода</option>
            <option value="79">Месяц</option>
            <option value="138">Неделя</option>
            <option value="37">День</option>
        </select><br>
        <b style='box-sizing: border-box; margin-left: 20px'>Расположение</b><br>
        <input type="text" name="address" style="margin: 10px 0 10px 40px;" placeholder="Адрес..." id="suggest"><br><span style="margin-left: 40px">Страна: </span><br><span style="margin-left: 40px">Область: </span><br><span style="margin-left: 40px">Город: </span><br><span style="margin-left: 40px">Район: </span><br><span style="margin-left: 40px">Дом: </span><br><div id="ymap" style="margin: 0 auto; width: 700px; height: 700px; background: #000;"></div>
        <script>
            ymaps.ready(function () {
                var map = new ymaps.Map("ymap", {
                    center: [55.451332, 37.369336],
                    zoom: 10,
                    controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
                });

                window.suggests = new ymaps.SuggestView("suggest", {width: 300, offset: [0, 4], results: 20});
            });
        </script><label style="margin-left: 40px; box-sizing: border-box;" for="distance_from_mkad_or_metro-min">Удаленность от МКАД/метро:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="distance_from_mkad_or_metro-min" name="distance_from_mkad_or_metro-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="distance_from_mkad_or_metro-max" name="distance_from_mkad_or_metro-max" type="text" placeholder="до"><br>
        <label style="margin-left: 40px; box-sizing: border-box;">Кадастровый номер <input type="checkbox" name="cadastral_number"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;">Торг <input type="checkbox" name="bargain"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="object_located">Объект размещен</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="object_located" id="object_located">
            <option value="41">Не важно</option>
            <option value="22">Риэлтором</option>
            <option value="21">Собственником</option>
        </select><br>
        <br></fieldset><br><fieldset>
        <legend>Параметры объекта</legend><br>
        <b style='box-sizing: border-box; margin-left: 20px'>Площадь</b><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="residential-min">Жилая:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="residential-min" name="residential-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="residential-max" name="residential-max" type="text" placeholder="до"><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="not_residential-min">Нежилая:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="not_residential-min" name="not_residential-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="not_residential-max" name="not_residential-max" type="text" placeholder="до"><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="total-min">Общая:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="total-min" name="total-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="total-max" name="total-max" type="text" placeholder="до"><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="balcony-min">Балкон:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="balcony-min" name="balcony-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="balcony-max" name="balcony-max" type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="number_of_rooms">Количество комнат</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="number_of_rooms" id="number_of_rooms">
            <option value="4">4+</option>
            <option value="3">3</option>
            <option value="2">2</option>
            <option value="1">1</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="number_of_floors-min">Количество этажей:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="ceiling_height-min">Высота потолков:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="lavatory">Санузел</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="lavatory" id="lavatory">
            <option value="41">Не важно</option>
            <option value="116">Раздельный</option>
            <option value="29">Совмещенный</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="roofing">Кровля</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="roofing" id="roofing">
            <option value="127">Временная</option>
            <option value="88">Ондулин</option>
            <option value="118">Шифер</option>
            <option value="122">Камень</option>
            <option value="123">Солома</option>
            <option value="129">Черепица</option>
            <option value="113">Пескобетонная черепица</option>
            <option value="76">Металлочерепица</option>
            <option value="34">Медь</option>
            <option value="67">Железо</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="foundation">Фундамент</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="foundation" id="foundation">
            <option value="140">Без фундамента</option>
            <option value="58">Ростверк</option>
            <option value="109">Ленточный</option>
            <option value="125">Шведская плита</option>
            <option value="120">Монолитная плита</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="wall_material">Материал стен</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="wall_material" id="wall_material">
            <option value="49">Фахверк</option>
            <option value="56">Клееный брус</option>
            <option value="102">Профилированный брус</option>
            <option value="112">Оцилиндрованное бревно</option>
            <option value="24">Лафет</option>
            <option value="27">Рубленое дерево</option>
            <option value="105">Железобетон</option>
            <option value="28">Шлакоблоки</option>
            <option value="55">Газосиликатные блоки</option>
            <option value="96">Пеноблок</option>
            <option value="19">Кирпич</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="type_of_house">Тип дома</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="type_of_house" id="type_of_house">
            <option value="35">Коттедж</option>
            <option value="130">Таунхаус</option>
            <option value="42">Дуплекс</option>
        </select><br>
        <br></fieldset><br><fieldset>
        <legend> Ремонт и обустройство</legend><br>
        <span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Комнаты</span><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Ванная <input type="checkbox" name="bathroom"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Столовая <input type="checkbox" name="dining_room"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Рабочий кабинет <input type="checkbox" name="study"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Детская <input type="checkbox" name="playroom"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Прихожая <input type="checkbox" name="hallway"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Гостиная <input type="checkbox" name="living_room"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Кухня <input type="checkbox" name="kitchen"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Спальня <input type="checkbox" name="bedroom"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="equipment">Комплектация</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="equipment" id="equipment">
            <option value="44">Пустая</option>
            <option value="45">Укомплектованная</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="furnish">Отделка</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="furnish" id="furnish">
            <option value="141">Без ремонта</option>
            <option value="65">Незавершенный ремонт</option>
            <option value="107">Требуется ремонт</option>
            <option value="106">Требуется косметический ремонт</option>
            <option value="57">Хорошая отделка</option>
            <option value="64">Высококачественная отделка</option>
            <option value="46">Эксклюзивного качества</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="clarification_of_the_object_type">Уточнение вида объектов</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="clarification_of_the_object_type" id="clarification_of_the_object_type">
            <option value="93">Собственность более 5 лет</option>
            <option value="92">Собственность менее 5 лет</option>
            <option value="70">Участок с подрядом</option>
            <option value="33">Незавершенное строительство</option>
            <option value="83">Новостройка</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="year_of_construction-min">Год постройки/окончания строительства:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до"><br>
        <span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Жилищно-коммунальные услуги</span><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Водопровод <input type="checkbox" name="water_pipes"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Электричество <input type="checkbox" name="electricity"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Газ <input type="checkbox" name="gas"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Отопление <input type="checkbox" name="heating"></label><br>
        <span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Безопасность</span><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Сигнализация <input type="checkbox" name="signaling"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Видеонаблюдение <input type="checkbox" name="cctv"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Домофон <input type="checkbox" name="intercom"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Охрана <input type="checkbox" name="security"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Консьерж <input type="checkbox" name="concierge"></label><br>
        <br></fieldset><br><fieldset>
        <legend>Участок</legend><br>
        <b style='box-sizing: border-box; margin-left: 20px'>Ограждение</b><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="fencing" id="fencing">
            <option value="1">Да</option><option value="0">Нет</option></select><br>
        <select style="margin-left: 40px; box-sizing: border-box;" name="fencing_yes" id="fencing_yes">
            <option value="143">Кованая ограда</option>
            <option value="75">Металлические прутья</option>
            <option value="19">Кирпич</option>
            <option value="31">Бетон</option>
            <option value="122">Камень</option>
            <option value="38">Профнастил</option>
            <option value="142">Дерево</option>
            <option value="98">Пластик</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="parking">Парковка</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="parking" id="parking">
            <option value="41">Не важно</option>
            <option value="5">Отсутствует</option>
            <option value="7">Придомовой гараж</option>
            <option value="52">Гаражный комплекс</option>
            <option value="132">Подземная парковка</option>
            <option value="81">Многоуровневый паркинг</option>
        </select><br>
        <span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Дополнительные строения</span><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Сторожка <input type="checkbox" name="lodge"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Гостевой дом <input type="checkbox" name="guest_house"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Баня <input type="checkbox" name="bath"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Бассейн <input type="checkbox" name="swimming_pool"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Детская площадка <input type="checkbox" name="playground"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Винный погреб <input type="checkbox" name="wine_vault"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Сарай <input type="checkbox" name="barn"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Беседка <input type="checkbox" name="alcove"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="site">Участок</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="site" id="site">
            <option value="136">Заболоченный</option>
            <option value="103">Овраг</option>
            <option value="89">На склоне</option>
            <option value="133">Неровный</option>
            <option value="119">Ровный</option>
        </select><br>
        <span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">На участке</span><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Берег водоёма <input type="checkbox" name="waterfront"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Река <input type="checkbox" name="river"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Родник <input type="checkbox" name="spring"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Садовые деревья <input type="checkbox" name="garden_trees"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Лесные деревья <input type="checkbox" name="forest_trees"></label><br>
        <br></fieldset><br><fieldset>
        <legend>Вложения</legend><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="planning_project">Проект планировки</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="planning_project" id="planning_project">
            <option value="41">Не важно</option>
            <option value="11">Прилагается</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="three_d_project">3d проект</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="three_d_project" id="three_d_project">
            <option value="41">Не важно</option>
            <option value="11">Прилагается</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="video">Видео</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="video" id="video">
            <option value="41">Не важно</option>
            <option value="11">Прилагается</option>
        </select><br>
        <br></fieldset><br><input type="submit" name="submit" value="Найти"><br></form>