Жилая - Купить - Земельный участок
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
<label style="margin-left: 40px; box-sizing: border-box;" for="distance_from_mkad_or_metro-min">Удаленность от МКАД/метро:</label><br>
<input style="margin-left: 40px; box-sizing: border-box;" id="distance_from_mkad_or_metro-min" name="distance_from_mkad_or_metro-min" type="text" placeholder="от"><br>
<input style="margin-left: 40px; box-sizing: border-box;" id="distance_from_mkad_or_metro-max" name="distance_from_mkad_or_metro-max" type="text" placeholder="до"><br>
<label style="margin-left: 20px; box-sizing: border-box;">Торг <input type="checkbox" name="bargain"></label><br>
    <label style="margin-left: 20px; box-sizing: border-box;" for="object_located">Объект размещен</label><br>
    <select style="margin-left: 20px; box-sizing: border-box;" name="object_located" id="object_located">
        <option value="41">Не важно</option>
        <option value="22">Риэлтором</option>
        <option value="21">Собственником</option>
    </select><br>
<br></fieldset><br><fieldset>
<legend>Основные параметры</legend><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="space-min">Площадь:</label><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="space-min" name="space-min" type="text" placeholder="от"><br>
<input style="margin-left: 20px; box-sizing: border-box;" id="space-max" name="space-max" type="text" placeholder="до"><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="clarification_of_the_object_type">Уточнение вида объектов</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="clarification_of_the_object_type" id="clarification_of_the_object_type">
<option value="59">Земли под размещение промышленных и коммерческих объектов</option>
<option value="9">Сельскохозяйственные земли</option>
<option value="92">Собственность менее 5 лет</option>
<option value="93">Собственность более 5 лет</option>
</select><br>
<label style="margin-left: 20px; box-sizing: border-box;" for="site">Участок</label><br>
<select style="margin-left: 20px; box-sizing: border-box;" name="site" id="site">
<option value="136">Заболоченный</option>
<option value="103">Овраг</option>
<option value="89">На склоне</option>
<option value="133">Неровный</option>
<option value="119">Ровный</option>
</select><br>
<span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">На участке</span><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Берег водоема <input type="checkbox" name="waterfront"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Река <input type="checkbox" name="river"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Родник <input type="checkbox" name="spring"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Садовые деревья <input type="checkbox" name="garden_trees"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Лесные деревья <input type="checkbox" name="forest_trees"></label><br>
<br></fieldset><br><fieldset>
<legend>Обустройство</legend><br>
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
<span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Безопасность</span><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Сигнализация <input type="checkbox" name="signaling"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Видеонаблюдение <input type="checkbox" name="cctv"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Домофон <input type="checkbox" name="intercom"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Охрана <input type="checkbox" name="security"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Консьерж <input type="checkbox" name="concierge"></label><br>
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
<span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">Жилищно-коммунальные услуги</span><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Водопровод <input type="checkbox" name="water_pipes"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Электричество <input type="checkbox" name="electricity"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Отопление <input type="checkbox" name="heating"></label><br>
<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">Газ <input type="checkbox" name="gas"></label><br>
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