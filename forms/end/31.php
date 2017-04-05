Нежилая - Арендовать - Офисная площадь с землей
<br><form action="" method="post">
<fieldset>
<legend>Базовый раздел</legend><br>
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
<b style='box-sizing: border-box; margin-left: 20px'>Цена</b><br>
<label style="margin-left: 40px; box-sizing: border-box;" for="price-min">Стоимость:</label><br>
<input style="margin-left: 40px; box-sizing: border-box;" id="price-min" name="price-min" type="text" placeholder="от"><br>
<input style="margin-left: 40px; box-sizing: border-box;" id="price-max" name="price-max" type="text" placeholder="до"><br>
<label style="margin-left: 40px; box-sizing: border-box;" for="lease">Срок аренды</label><br>
<select style="margin-left: 40px; box-sizing: border-box;" name="lease" id="lease">
<option value="80">Более года</option>
<option value="145">Год</option>
<option value="79">Месяц</option>
<option value="138">Неделя</option>
<option value="37">День</option>
</select><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="bargain">Торг</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="bargain" id="bargain">
<option value="85">Невозможен</option>
<option value="13">Возможен</option>
</select><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="object_located">Объект размещен</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="object_located" id="object_located">
<option value="41">Не важно</option>
<option value="22">Риэлтором</option>
<option value="21">Собственником</option>
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
<br></fieldset><br><fieldset>
<legend>Документы</legend><br>
<b style='box-sizing: border-box; margin-left: 20px'>Договор аренды</b><br>
<label style="margin-left: 40px;">Договор аренды <input type="checkbox" name="lease_contract"></label><br><b style='box-sizing: border-box; margin-left: 20px'>Документы на право владения</b><br>
<label style="margin-left: 40px;">Документы на право владения <input type="checkbox" name="documents_on_ownership"></label><br><br></fieldset><br><fieldset>
<legend> Ремонт и обустройство</legend><br>
<b style='box-sizing: border-box; margin-left: 20px'>Жилищно-коммунальные услуги</b><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Электричество <input type="checkbox" name="electricity"></label><br>
<label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="electricity">Кол-во кВт:</label><br>
<input name="electricity-min" type="text" placeholder="от" style="margin-left: 60px; box-sizing: border-box;"><input name="electricity-max" type="text" placeholder="до" style="margin-left: 60px; box-sizing: border-box;"><br>
<label for="sanitation" style="margin-left: 40px;">Водопровод и канализация</label><br>
<select name="sanitation" id="sanitation" style="margin-left: 40px;">
    <option value="47">Есть</option>
    <option value="84">Нет</option>
</select><br>
<label style="margin-left: 60px;">Возможность проводки <input type="checkbox" name="possible_to_post"></label><br>
<label style="margin-left: 60px;">Описание <input type="checkbox" name="sanitation_description"></label><br>
<label for="sanitation" style="margin-left: 40px;">Наличие санузлов</label><br><label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="">Количество:</label><br>
<input name="bathroom_number-min" type="text" placeholder="от" style="margin-left: 60px; box-sizing: border-box;"><input name="bathroom_number-max" type="text" placeholder="до" style="margin-left: 60px; box-sizing: border-box;"><br><label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="">Расположение:</label><br>
<select name="bathroom_location" id="sanitation" style="margin-left: 60px;">
                                                        <option value="">---</option>
                                                     </select><br>
                                        <label style="margin-left: 60px;">Описание <input type="checkbox" name="bathroom_description"></label><br><label style="margin-left: 20px; box-sizing: border-box;" for="furnish">Отделка</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="furnish" id="furnish">
<option value="141">Без ремонта</option>
<option value="65">Незавершенный ремонт</option>
<option value="107">Требуется ремонт</option>
<option value="106">Требуется косметический ремонт</option>
<option value="57">Хорошая отделка</option>
<option value="64">Высококачественная отделка</option>
<option value="46">Эксклюзивного качества</option>
</select><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="parking">Парковка</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="parking" id="parking">
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
<option value="94">Платная</option>
<option value="51">Бесплатная</option>
</select><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="fencing">Ограждение</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="fencing" id="fencing">
<option value="84">Нет</option>
<option value="147">Да</option>
</select><br>
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
<span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Безопасность</span><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Сигнализация <input type="checkbox" name="signaling"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Видеонаблюдение <input type="checkbox" name="cctv"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Домофон <input type="checkbox" name="intercom"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Охрана <input type="checkbox" name="security"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Консьерж <input type="checkbox" name="concierge"></label><br>
<br></fieldset><br><fieldset>
<legend>Исходные параметры</legend><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="number_of_rooms-min">Количество комнат:</label><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="number_of_rooms-min" name="number_of_rooms-min" type="text" placeholder="от"><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="number_of_rooms-max" name="number_of_rooms-max" type="text" placeholder="до"><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="year_of_construction-min">Год постройки/окончания строительства:</label><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="year_of_construction-min" name="year_of_construction-min" type="text" placeholder="от"><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="year_of_construction-max" name="year_of_construction-max" type="text" placeholder="до"><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="ceiling_height-min">Высота потолков:</label><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="ceiling_height-min" name="ceiling_height-min" type="text" placeholder="от"><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="ceiling_height-max" name="ceiling_height-max" type="text" placeholder="до"><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="number_of_floors-min">Количество этажей:</label><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="number_of_floors-min" name="number_of_floors-min" type="text" placeholder="от"><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="number_of_floors-max" name="number_of_floors-max" type="text" placeholder="до"><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="space-min">Площадь:</label><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="space-min" name="space-min" type="text" placeholder="от"><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="space-max" name="space-max" type="text" placeholder="до"><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="type_of_construction">Вид постройки</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="type_of_construction" id="type_of_construction">
<option value="111">Комнаты</option>
<option value="90">Опен спэйс</option>
</select><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="wall_material">Материал стен</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="wall_material" id="wall_material">
<option value="49">Фахверк</option>
<option value="56">Клееный брус</option>
<option value="102">Профилированный брус</option>
<option value="112">Оцилиндрованное бревно</option>
<option value="24">Лафет</option>
<option value="27">Рубленое дерево</option>
<option value="28">Шлакоблоки</option>
<option value="55">Газосиликатные блоки</option>
<option value="96">Пеноблок</option>
<option value="78">Монолит</option>
<option value="105">Железобетон</option>
<option value="19">Кирпич</option>
</select><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="roofing">Кровля</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="roofing" id="roofing">
<option value="127">Временная</option>
<option value="88">Ондулин</option>
<option value="118">Шифер</option>
<option value="122">Камень</option>
<option value="123">Солома</option>
<option value="129">Черепица</option>
<option value="18">Бескобетонная черепица</option>
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
<label style="margin-left: 20px; box-sizing: border-box;" for="building_type">Тип здания</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="building_type" id="building_type">
<option value="108">Жилое</option>
<option value="8">Административное</option>
</select><br>
<br></fieldset><br><input type="submit" name="submit" value="Найти"><br></form>