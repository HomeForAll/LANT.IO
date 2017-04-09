Жилая - Купить - Гараж/Машиноместо
<br><form action="" method="post">
    <fieldset>
        <legend>Базовый раздел</legend><br>
        <b style='box-sizing: border-box; margin-left: 20px'>Цена</b><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="price-min">Стоимость:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="price-min" name="price-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="price-max" name="price-max" type="text" placeholder="до"><br>
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
        </script><label style="margin-left: 40px; box-sizing: border-box;">Кадастровый номер <input type="checkbox" name="cadastral_number"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="distance_from_metro-min">Удаленность от метро:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="distance_from_metro-min" name="distance_from_metro-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="distance_from_metro-max" name="distance_from_metro-max" type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="object_located">Объект размещен</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="object_located" id="object_located">
            <option value="41">Не важно</option>
            <option value="22">Риэлтором</option>
            <option value="21">Собственником</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;">Торг <input type="checkbox" name="bargain"></label><br>
        <br></fieldset><br><fieldset>
        <legend>Основное</legend><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="space-min">Площадь:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="space-min" name="space-min" type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="space-max" name="space-max" type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="ceiling_height-min">Высота потолков:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="number_of_floors-min">Количество этажей:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до"><br>
        <span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Безопасность</span><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Сигнализация <input type="checkbox" name="signaling"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Видеонаблюдение <input type="checkbox" name="cctv"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Домофон <input type="checkbox" name="intercom"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Охрана <input type="checkbox" name="security"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Консьерж <input type="checkbox" name="concierge"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="clarification_of_the_object_type">Уточнение вида объектов</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="clarification_of_the_object_type" id="clarification_of_the_object_type">
            <option value="92">Собственность менее 5 лет</option>
            <option value="93">Собственность более 5 лет</option>
            <option value="70">Участок с подрядом</option>
            <option value="33">Незавершенное строительство</option>
            <option value="83">Новостройка</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;">Ограждение <input type="checkbox" name="fencing"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="material">Материал</label><br>
        <select style="margin-left: 40px; box-sizing: border-box;" name="material" id="material">
            <option value="143">Кованая ограда</option>
            <option value="75">Металлические прутья</option>
            <option value="19">Кирпич</option>
            <option value="31">Бетон</option>
            <option value="122">Камень</option>
            <option value="38">Профнастил</option>
            <option value="142">Дерево</option>
            <option value="98">Пластик</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="year_of_construction-min">Год постройки/окончания строительства:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до"><br>
        <br></fieldset><br><fieldset>
        <legend>Дополнительно</legend><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="roofing">Кровля</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="roofing" id="roofing">
            <option value="127">Временная</option>
            <option value="118">Шифер</option>
            <option value="122">Камень</option>
            <option value="123">Солома</option>
            <option value="129">Черепица</option>
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
            <option value="105">Железобетон</option>
            <option value="19">Кирпич</option>
        </select><br>
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