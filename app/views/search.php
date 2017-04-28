<?php
$this->title = 'Поиск';

if (!empty($this->data['objects'])) {
    foreach ($this->data['objects'] as $key => $value) {
        echo '<pre>';
        print_r("ID Новости: " . $value['id_news']);
        echo '</pre>';
    }
}

?>

<style>
    .title {
        font-weight: bold;
        margin: 10px 0 10px 0;
    }

    .formTitle {
        font-family: Arial, sans-serif;
        font-size: 18pt;
        font-weight: bold;
    }

    #content_wrap {
        margin: 10px;
    }

    .map {
        width: 100%;
        height: 500px;
        margin-bottom: 10px;
    }

    form {
        margin-bottom: 15px;
    }

    fieldset {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
    }

    input[type=text], select {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        width: 50%;
        box-sizing: border-box;
        padding: 10px 15px 10px 15px;
        margin-bottom: 15px;
        border: solid 1px gray;
        border-radius: 3px;
    }

    input[type=checkbox] {
        margin-right: 10px;
    }

    input[type=submit] {
        width: 200px;
    }

    .indent {
        margin: 0 0 0 20px;
    }
</style>


Нежилая - Купить - Офисная площадь
<br>
<form action="" method="post">
    <fieldset>
        <legend>Базовый раздел</legend>
        <br>
        <b style='box-sizing: border-box; margin-left: 20px'>Цена</b><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="price-min">Стоимость:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="price-min" name="price-min" type="text"
               placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="price-max" name="price-max" type="text"
               placeholder="до"><br>
        <b style='box-sizing: border-box; margin-left: 20px'>Расположение</b><br>
        <input type="text" name="address" style="margin: 10px 0 10px 40px;" placeholder="Адрес..." id="suggest"><br>

        <!-- Расположение -->
        <input type="text" name="country" placeholder="Страна"><br>
        <input type="text" name="area" placeholder="Область"><br>
        <input type="text" name="city" placeholder="Город"><br>
        <input type="text" name="region" placeholder="Район"><br>

        <div id="ymap" style="margin: 0 auto; width: 700px; height: 700px; background: #000;"></div>
        <script>
            ymaps.ready(function () {
                var map = new ymaps.Map("ymap", {
                    center: [55.451332, 37.369336],
                    zoom: 10,
                    controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
                });

                window.suggests = new ymaps.SuggestView("suggest", {width: 300, offset: [0, 4], results: 20});
            });
        </script>
        <label style="margin-left: 40px; box-sizing: border-box;" for="distance_from_mkad_or_metro-min">Удаленность от
            МКАД/метро:</label><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="distance_from_mkad_or_metro-min"
               name="distance_from_mkad_or_metro-min" type="text" placeholder="от"><br>
        <input style="margin-left: 40px; box-sizing: border-box;" id="distance_from_mkad_or_metro-max"
               name="distance_from_mkad_or_metro-max" type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;">Торг <input type="checkbox"
                                                                              name="bargain"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="object_located">Объект размещен</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="object_located" id="object_located">
            <option value="">---</option>
            <option value="41">Не важно</option>
            <option value="22">Риэлтором</option>
            <option value="21">Собственником</option>
        </select><br>
        <br></fieldset>
    <br>
    <fieldset>
        <legend>Исходные параметры</legend>
        <br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="space-min">Площадь:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="space-min" name="space-min" type="text"
               placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="space-max" name="space-max" type="text"
               placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="ceiling_height-min">Высота потолков:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="ceiling_height-min" name="ceiling_height-min"
               type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="ceiling_height-max" name="ceiling_height-max"
               type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="number_of_floors-min">Количество
            этажей:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="number_of_floors-min" name="number_of_floors-min"
               type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="number_of_floors-max" name="number_of_floors-max"
               type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="type_of_construction">Вид постройки</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="type_of_construction"
                id="type_of_construction">
            <option value="">---</option>
            <option value="111">Комнаты</option>
            <option value="90">Опен спэйс</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="number_of_rooms-min">Количество
            комнат:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="number_of_rooms-min" name="number_of_rooms-min"
               type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="number_of_rooms-max" name="number_of_rooms-max"
               type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="year_of_construction-min">Год постройки/окончания
            строительства:</label><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="year_of_construction-min"
               name="year_of_construction-min" type="text" placeholder="от"><br>
        <input style="margin-left: 20px; box-sizing: border-box;" id="year_of_construction-max"
               name="year_of_construction-max" type="text" placeholder="до"><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="building_type">Тип здания</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="building_type" id="building_type">
            <option value="">---</option>
            <option value="108">Жилое</option>
            <option value="8">Административное</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="roofing">Кровля</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="roofing" id="roofing">
            <option value="">---</option>
            <option value="67">Железо</option>
            <option value="34">Медь</option>
            <option value="76">Металлочерепица</option>
            <option value="113">Пескобетонная черепица</option>
            <option value="129">Черепица</option>
            <option value="123">Солома</option>
            <option value="122">Камень</option>
            <option value="118">Шифер</option>
            <option value="88">Ондулин</option>
            <option value="127">Временная</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="foundation">Фундамент</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="foundation" id="foundation">
            <option value="">---</option>
            <option value="120">Монолитная плита</option>
            <option value="125">Шведская плита</option>
            <option value="109">Ленточный</option>
            <option value="58">Ростверк</option>
            <option value="140">Без фундамента</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="wall_material">Материал стен</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="wall_material" id="wall_material">
            <option value="">---</option>
            <option value="49">Фахверк</option>
            <option value="19">Кирпич</option>
            <option value="105">Железобетон</option>
            <option value="78">Монолит</option>
            <option value="96">Пеноблок</option>
            <option value="55">Газосиликатные блоки</option>
            <option value="28">Шлакоблоки</option>
            <option value="27">Рубленое дерево</option>
            <option value="24">Лафет</option>
            <option value="112">Оцилиндрованное бревно</option>
            <option value="102">Профилированный брус</option>
            <option value="56">Клееный брус</option>
        </select><br>
        <br></fieldset>
    <br>
    <fieldset>
        <legend> Ремонт и обустройство</legend>
        <br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="furnish">Отделка</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="furnish" id="furnish">
            <option value="">---</option>
            <option value="46">Эксклюзивного качества</option>
            <option value="64">Высококачественная отделка</option>
            <option value="57">Хорошая отделка</option>
            <option value="106">Требуется косметический ремонт</option>
            <option value="107">Требуется ремонт</option>
            <option value="65">Незавершенный ремонт</option>
            <option value="141">Без ремонта</option>
        </select><br>
        <span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Безопасность</span><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Консьерж <input type="checkbox"
                                                                                                       name="concierge"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Охрана <input type="checkbox"
                                                                                                     name="security"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Домофон <input type="checkbox"
                                                                                                      name="intercom"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Видеонаблюдение <input
                    type="checkbox" name="cctv"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Сигнализация <input
                    type="checkbox" name="signaling"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;">Ограждение <input type="checkbox"
                                                                                    name="fencing"></label><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="material">Материал</label><br>
        <select style="margin-left: 40px; box-sizing: border-box;" name="material" id="material">
            <option value="">---</option>
            <option value="98">Пластик</option>
            <option value="142">Дерево</option>
            <option value="38">Профнастил</option>
            <option value="122">Камень</option>
            <option value="31">Бетон</option>
            <option value="19">Кирпич</option>
            <option value="75">Металлические прутья</option>
            <option value="143">Кованая ограда</option>
        </select><br>
        <label style="margin-left: 20px; box-sizing: border-box;" for="parking">Парковка</label><br>
        <select style="margin-left: 20px; box-sizing: border-box;" name="parking" id="parking">
            <option value="">---</option>
            <option value="81">Многоуровневый паркинг</option>
            <option value="132">Подземная парковка</option>
            <option value="52">Гаражный комплекс</option>
            <option value="7">Придомовой гараж</option>
            <option value="82">Муниципальная</option>
            <option value="5">Отсутствует</option>
            <option value="41">Не важно</option>
        </select><br>
        <label style="margin-left: 40px; box-sizing: border-box;" for="municipal">Муниципальная</label><br>
        <select style="margin-left: 40px; box-sizing: border-box;" name="municipal" id="municipal">
            <option value="">---</option>
            <option value="94">Платная</option>
            <option value="51">Бесплатная</option>
        </select><br>
        <span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Жилищно-коммунальные услуги</span><br>
        <label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Электричество <input
                    type="checkbox" name="electricity"></label><br>
        <label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="electricity">Кол-во
            кВт:</label><br>
        <input name="electricity-min" type="text" placeholder="от"
               style="margin-left: 60px; box-sizing: border-box;"><input name="electricity-max" type="text"
                                                                         placeholder="до"
                                                                         style="margin-left: 60px; box-sizing: border-box;"><br>
        <label for="sanitation" style="margin-left: 40px;">Водопровод и канализация</label><br>
        <select name="sanitation" id="sanitation" style="margin-left: 40px;">
            <option value="">---</option>
            <option value="47">Есть</option>
            <option value="84">Нет</option>
        </select><br>
        <label style="margin-left: 60px;">Возможность проводки <input type="checkbox"
                                                                      name="possible_to_post"></label><br>
        <label style="margin-left: 60px;">Описание <input type="checkbox" name="sanitation_description"></label><br>
        <label for="sanitation" style="margin-left: 40px;">Наличие санузлов</label><br><label
                style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="">Количество:</label><br>
        <input name="bathroom_number-min" type="text" placeholder="от"
               style="margin-left: 60px; box-sizing: border-box;"><input name="bathroom_number-max" type="text"
                                                                         placeholder="до"
                                                                         style="margin-left: 60px; box-sizing: border-box;"><br><label
                style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="">Расположение:</label><br>
        <select name="bathroom_location" id="sanitation" style="margin-left: 60px;">
            <option value="">---</option>
        </select><br>
        <label style="margin-left: 60px;">Описание <input type="checkbox" name="bathroom_description"></label><br><br>
    </fieldset>
    <br>
    <fieldset>
        <legend>Объект размещен</legend>
        <br>
        <br></fieldset>
    <br>
    <fieldset>
        <legend>Документы</legend>
        <br>
        <label style="margin-left: 20px; box-sizing: border-box;">Документы на право владения <input type="checkbox"
                                                                                                     name="documents_on_ownership"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;">Договор аренды <input type="checkbox"
                                                                                        name="lease_contract"></label><br>
        <br></fieldset>
    <br>
    <fieldset>
        <legend>Вложения</legend>
        <br>
        <label style="margin-left: 20px; box-sizing: border-box;">Проект планировки <input type="checkbox"
                                                                                           name="planning_project"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;">3d проект <input type="checkbox"
                                                                                   name="three_d_project"></label><br>
        <label style="margin-left: 20px; box-sizing: border-box;">Видео <input type="checkbox" name="video"></label><br>
        <br></fieldset>
    <br><input type="submit" name="submit" value="Найти"><br></form>

<div id="search_result"></div>
<div style="clear: both;"></div>
<script>
    $(document).ready(function () {
//    { ["formData"]=> array(2) { [0]=> array(101) { ["id"]=> string(1) "1" ["form_name"]=> string(4) "form" ["space_type"]=> string(1) "1" ["operation_type"]=> string(1) "2" ["object_type"]=> string(1) "3" ["category"]=> string(1) "1" ["status"]=> string(1) "1" ["user_id"]=> string(1) "3" ["title"]=> string(16) "Название" ["date"]=> string(4) "2017" ["content"]=> string(389) "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor doloribus exercitationem expedita impedit ipsam labore laboriosam magni, maiores maxime modi molestias nobis odit quas qui quo suscipit unde ut veniam! Aperiam, assumenda deleniti eius et labore laudantium maiores necessitatibus obcaecati officia perferendis, quasi reiciendis rem, repellat repudiandae sequi. Animi, facilis." ["preview_img"]=> string(62) "https://pp.userapi.com/c837728/v837728190/f812/mM48XvbIHJM.jpg" ["photo_available"]=> string(1) "1" ["tags"]=> string(3) "tag" ["country"]=> string(7) "Ukraine" ["area"]=> string(0) "" ["city"]=> string(0) "" ["region"]=> string(0) "" ["address"]=> string(0) "" ["gas"]=> string(1) "1" ["heating"]=> string(1) "0" ["water_pipes"]=> string(1) "0" ["elevator_passangers"]=> string(1) "0" ["elevator_cargo"]=> string(1) "0" ["bathroom"]=> string(1) "0" ["dining_room"]=> string(1) "0" ["study"]=> string(1) "0" ["playroom"]=> string(1) "0" ["hallway"]=> string(1) "0" ["living_room"]=> string(1) "0" ["kitchen"]=> string(1) "0" ["bedroom"]=> string(1) "0" ["signaling"]=> string(1) "0" ["cctv"]=> string(1) "0" ["intercom"]=> string(1) "1" ["concierge"]=> string(1) "1" ["common"]=> string(1) "0" ["resedential"]=> string(1) "0" ["elevator"]=> string(1) "0" ["elevator_yes"]=> string(1) "0" ["bathroom_description"]=> string(0) "" ["bathroom_location"]=> string(1) "0" ["bathroom_number"]=> string(1) "0" ["possible_to_post"]=> string(1) "0" ["sanitation_description"]=> string(0) "" ["documents_on_tenure"]=> string(0) "" ["additional_buildings"]=> string(1) "0" ["availability_of_bathroom"]=> string(1) "0" ["availability_of_garbage_chute"]=> string(1) "0" ["balcony"]=> string(1) "0" ["bargain"]=> string(1) "0" ["building_type"]=> string(1) "0" ["cadastral_number"]=> string(0) "" ["ceiling_height"]=> string(1) "0" ["clarification_of_the_object_type"]=> string(1) "0" ["combined"]=> string(0) "" ["distance_from_metro"]=> string(1) "0" ["distance_from_mkad_or_metro"]=> string(1) "0" ["documents_on_ownership"]=> string(1) "0" ["doesnt_matter"]=> string(0) "" ["electricity"]=> string(1) "0" ["equipment"]=> string(1) "0" ["fencing"]=> string(1) "0" ["floor"]=> string(1) "0" ["foundation"]=> string(1) "0" ["furnish"]=> string(1) "0" ["lavatory"]=> string(1) "0" ["lease"]=> string(1) "0" ["lease_contract"]=> string(0) "" ["location_on"]=> string(1) "0" ["material"]=> string(1) "0" ["metro_station"]=> string(1) "0" ["municipal"]=> string(1) "0" ["not_residential"]=> string(1) "0" ["number_of_floors"]=> string(1) "0" ["number_of_rooms"]=> string(1) "0" ["object_located"]=> string(1) "0" ["paid"]=> string(1) "0" ["parking"]=> string(1) "5" ["planning_project"]=> string(0) "" ["price"]=> string(2) "25" ["property_documents"]=> string(1) "0" ["residential"]=> string(0) "" ["roofing"]=> string(1) "0" ["rooms"]=> string(1) "0" ["sanitation"]=> string(1) "0" ["security"]=> string(1) "0" ["select_area_on_city"]=> string(1) "0" ["separated"]=> string(0) "" ["site"]=> string(1) "0" ["space"]=> string(0) "" ["stairwells_status"]=> string(1) "0" ["the_number_of_kilowatt"]=> string(1) "0" ["three_d_project"]=> string(0) "" ["total"]=> string(0) "" ["type_of_construction"]=> string(1) "0" ["type_of_house"]=> string(1) "0" ["video"]=> string(0) "" ["wall_material"]=> string(1) "0" ["year_of_construction"]=> string(1) "0" ["id_news"]=> string(1) "1" } [1]=> array(101) { ["id"]=> string(1) "2" ["form_name"]=> string(5) "2_2_1" ["space_type"]=> string(1) "2" ["operation_type"]=> string(1) "2" ["object_type"]=> string(1) "1" ["category"]=> string(1) "1" ["status"]=> string(1) "1" ["user_id"]=> string(1) "3" ["title"]=> string(5) "Test1" ["date"]=> string(4) "2017" ["content"]=> string(0) "" ["preview_img"]=> string(0) "" ["photo_available"]=> string(1) "0" ["tags"]=> string(0) "" ["country"]=> string(7) "Ukraine" ["area"]=> string(0) "" ["city"]=> string(0) "" ["region"]=> string(0) "" ["address"]=> string(0) "" ["gas"]=> string(1) "0" ["heating"]=> string(1) "0" ["water_pipes"]=> string(1) "0" ["elevator_passangers"]=> string(1) "0" ["elevator_cargo"]=> string(1) "0" ["bathroom"]=> string(1) "1" ["dining_room"]=> string(1) "0" ["study"]=> string(1) "0" ["playroom"]=> string(1) "0" ["hallway"]=> string(1) "0" ["living_room"]=> string(1) "0" ["kitchen"]=> string(1) "0" ["bedroom"]=> string(1) "0" ["signaling"]=> string(1) "0" ["cctv"]=> string(1) "0" ["intercom"]=> string(1) "0" ["concierge"]=> string(1) "0" ["common"]=> string(1) "0" ["resedential"]=> string(1) "0" ["elevator"]=> string(1) "1" ["elevator_yes"]=> string(1) "0" ["bathroom_description"]=> string(0) "" ["bathroom_location"]=> string(1) "0" ["bathroom_number"]=> string(1) "0" ["possible_to_post"]=> string(1) "0" ["sanitation_description"]=> string(0) "" ["documents_on_tenure"]=> string(0) "" ["additional_buildings"]=> string(1) "0" ["availability_of_bathroom"]=> string(1) "0" ["availability_of_garbage_chute"]=> string(1) "0" ["balcony"]=> string(1) "0" ["bargain"]=> string(1) "1" ["building_type"]=> string(1) "0" ["cadastral_number"]=> string(5) "false" ["ceiling_height"]=> string(1) "0" ["clarification_of_the_object_type"]=> string(3) "146" ["combined"]=> string(0) "" ["distance_from_metro"]=> string(2) "55" ["distance_from_mkad_or_metro"]=> string(1) "0" ["documents_on_ownership"]=> string(1) "0" ["doesnt_matter"]=> string(0) "" ["electricity"]=> string(1) "0" ["equipment"]=> string(2) "45" ["fencing"]=> string(1) "0" ["floor"]=> string(1) "0" ["foundation"]=> string(1) "0" ["furnish"]=> string(3) "106" ["lavatory"]=> string(3) "116" ["lease"]=> string(1) "0" ["lease_contract"]=> string(0) "" ["location_on"]=> string(1) "0" ["material"]=> string(1) "0" ["metro_station"]=> string(1) "0" ["municipal"]=> string(1) "0" ["not_residential"]=> string(1) "0" ["number_of_floors"]=> string(1) "0" ["number_of_rooms"]=> string(1) "3" ["object_located"]=> string(2) "22" ["paid"]=> string(1) "0" ["parking"]=> string(1) "5" ["planning_project"]=> string(0) "" ["price"]=> string(2) "15" ["property_documents"]=> string(1) "0" ["residential"]=> string(0) "" ["roofing"]=> string(1) "0" ["rooms"]=> string(1) "0" ["sanitation"]=> string(1) "0" ["security"]=> string(1) "0" ["select_area_on_city"]=> string(1) "0" ["separated"]=> string(0) "" ["site"]=> string(1) "0" ["space"]=> string(0) "" ["stairwells_status"]=> string(3) "141" ["the_number_of_kilowatt"]=> string(1) "0" ["three_d_project"]=> string(0) "" ["total"]=> string(0) "" ["type_of_construction"]=> string(1) "0" ["type_of_house"]=> string(1) "0" ["video"]=> string(0) "" ["wall_material"]=> string(2) "91" ["year_of_construction"]=> string(1) "0" ["id_news"]=> string(1) "2" } } }
//        formData = {
//            0:{"id":"1","title":"Название 1","space_type":"1", "operation_type":"2", "object_type": "2", "price":"25", "content":"sdflkj wtiport wpi twoerit wpeorit wpeoritwoier tpowi rtpoweir twpoiret pwoeirt wporit wporit pwoeritpwoerit wrep", "form_name":"2_1_1", "id_news":"2", "preview_img":"news_150597d1dc325210406da828e44efb1023.jpg|news_dc6df9b8cf4d8af3d77466303470144852.jpg"},
//            1:{"id":"2","title":"Название 2","space_type":"2", "operation_type":"1", "object_type": "1", "price":"100","content":"sdflkj", "form_name":"2_1_1", "id_news":"3", "preview_img":"news_e75ffa427a158c1875e3594690c45c4e29.jpg"}
//
//        };

        var formData = <?php echo json_encode($this->data['formData'], JSON_UNESCAPED_UNICODE);?>;

        var spaceTypes = {1:'Коммерческая', 2:'Жилая'};
        var operationTypes = {1:'Арендовать', 2:'Купить'};
        var objectTypes = {1:'Квартира', 2:'Офисная площадь'};

        //Вывод всех найденых объявлений
        $.each( formData, function( key, value ) {
            //получение первой картинки
            formData[key]["preview_img"] = formData[key]["preview_img"].split('|')[0];
            //обрезка контента
            if(formData[key]["content"].length > 60) {
                formData[key]["content"] = formData[key]["content"].substr(0,60)+' ... ';
            }

            //определение объекта
            formData[key]["space_type"] = spaceTypes[formData[key]["space_type"]];
            formData[key]["operation_type"] = operationTypes[formData[key]["operation_type"]];
            formData[key]["object_type"] = objectTypes[formData[key]["object_type"]];

            addField(formData[key]);
        });



        //Прорисовка поля
        function addField(Data) {
            var news = $('<div/>', {
                'class': 'news',
                'style': 'height: 350px;'
            }).appendTo($('#search_result'));
            // Cылка
            var a = $('<a/>', {
                'href':'/news/'+Data["id_news"],
                'style': 'background-image: url("/uploads/images/s_'+Data["preview_img"]+'")'
            }).appendTo(news);
            var span = $('<span/>').appendTo(a);
            var h3 = $('<h3/>').html(Data["title"]).appendTo(span);
            var news_content = $('<div/>', {
                'class': 'news_content',
                'style': 'padding:10px;'
            }).appendTo(news);
            var content = $('<p/>').html(Data["content"]).appendTo(news_content);
            $('<p/>',{
                'style': 'color:#777777; font-size: 14px;'
            }).html('Тип площади: ' + Data["space_type"]).appendTo(news_content);
            $('<p/>',{
                'style': 'color:#777777; font-size: 14px;'
            }).html('Операция: ' + Data["operation_type"]).appendTo(news_content);
            $('<p/>',{
                'style': 'color:#777777; font-size: 14px;'
            }).html('Тип объекта: ' + Data["object_type"]).appendTo(news_content);
            $('<p/>',{
                'style': 'color:#777777; font-size: 14px;'
            }).html('Цена: ' + Data["price"] + "тыс. руб.").appendTo(news_content);

        };

    });
</script>