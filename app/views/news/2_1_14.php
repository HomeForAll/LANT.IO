Жилая - Арендовать - Земельный участок

<fieldset>
    <legend>Базовый раздел</legend><br>
    <b >Цена</b><br>
    <label for="price">Стоимость:</label><br>
    <input id="price" name="price" <?php inputToInput("price"); ?> type="text" ><br>
    <label for="lease">Срок аренды</label><br>
    <select name="lease" id="lease">
        <option value="0">---</option>
        <option value="80" <?php inputToSelect('lease','80'); ?> >Более года</option>
        <option value="145" <?php inputToSelect('lease','145'); ?> >Год</option>
        <option value="79" <?php inputToSelect('lease','79'); ?> >Месяц</option>
        <option value="138" <?php inputToSelect('lease','138'); ?> >Неделя</option>
        <option value="37" <?php inputToSelect('lease','37'); ?> >День</option>
    </select><br>
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

    <script>
        ymaps.ready(init);

        function init() {
            var map = new ymaps.Map('ymap', {
                center: [55.753994, 37.622093],
                zoom: 9
            });

            // Поле подсказки
            suggestView = new ymaps.SuggestView("suggest", {width: 300, offset: [0, 4], results: 20});

            // Определение адреса при выборе подсказки и вывод метки.
            suggestView.state.events.add('change', function () {
                var activeIndex = suggestView.state.get('activeIndex');
                if (typeof activeIndex == 'number') {
                    activeItem = suggestView.state.get('items')[activeIndex];
                    if (activeItem && activeItem.value != address) {
                        var address = activeItem.value;
                        setMark(address);
                    }
                }
            });

            // Определение координат клика по карте.
            map.events.add('click', function (e) {
                var coords = e.get('coords');
                getAddress(coords);
            });

            // Определяем адрес по координатам (обратное геокодирование) и вывод метки.
            function getAddress(coords) {
                ymaps.geocode(coords).then(function (res) {
                    var firstGeoObject = res.geoObjects.get(0);
                    var address = firstGeoObject.properties.get('text');
                    $('#suggest').val(address);
                    setMark(address);
                });
            };

            //Вывод метки при вводе в поле suggest вручную
            $('#suggest').change(function(){
                var address = $(this).val();
                setMark(address);
            });

            // Метка на карте и запись данных метки в поля адреса
            function setMark(address) {
                // Поиск координат
                ymaps.geocode(address, {
                    results: 1
                }).then(function (res) {
                    // Выбираем первый результат геокодирования.
                    var firstGeoObject = res.geoObjects.get(0),
                        // Координаты геообъекта.
                        coords = firstGeoObject.geometry.getCoordinates(),
                        // Область видимости геообъекта.
                        bounds = firstGeoObject.properties.get('boundedBy');
                    map.geoObjects.removeAll();
                    // Добавляем первый найденный геообъект на карту.
                    map.geoObjects.add(firstGeoObject);
                    // Масштабируем карту на область видимости геообъекта.
                    map.setBounds(bounds, {
                        // Проверяем наличие тайлов на данном масштабе.
                        checkZoomRange: true
                    });
                    //Метаданные геокодера Address.Components -> Запись в поля адреса
                    addr = firstGeoObject.properties.get('metaDataProperty.GeocoderMetaData.Address.Components');
                    $.each(addr, function (i, obj) {
                        switch (obj.kind) {
                            case 'country':
                                $('#country').val(obj.name);
                                break;
                            case 'province':
                                $('#area').val(obj.name);
                                break;
                            case 'locality':
                                $('#city').val(obj.name);
                                break;
                            case 'street':
                                $('#street').val(obj.name);
                                break;
                            case 'district':
                                $('#street').val(obj.name);
                                break;
                            case 'house':
                                $('#house').val(obj.name);
                                break;
                        }
                    });
                });
            };
        };
    </script>

    <label >Кадастровый номер <input type="text" name="cadastral_number" <?php inputToInput("cadastral_number"); ?> ></label><br>
    <label for="distance_from_mkad_or_metro">Удаленность от МКАД/метро:</label><br>
    <input id="distance_from_mkad_or_metro" name="distance_from_mkad_or_metro" <?php inputToInput("distance_from_mkad_or_metro"); ?> type="text" ><br>
    <label for="object_located">Объект размещен</label><br>
    <select name="object_located" id="object_located">
        <option value="0">---</option>
        <option value="22" <?php inputToSelect('object_located','22'); ?> >Риэлтором</option>
        <option value="21" <?php inputToSelect('object_located','21'); ?> >Собственником</option>
    </select><br>
    <br>
</fieldset><br>

<fieldset>
    <legend>Основные параметры</legend><br>
    <label for="space">Площадь:</label><br>
    <input id="space" name="space" <?php inputToInput("space"); ?> type="text" ><br>
    <label for="clarification_of_the_object_type">Уточнение вида объектов</label><br>
    <select name="clarification_of_the_object_type" id="clarification_of_the_object_type">
        <option value="0">---</option>
        <option value="59" <?php inputToSelect('clarification_of_the_object_type','59'); ?> >Земли под размещение промышленных и коммерческих объектов</option>
        <option value="9" <?php inputToSelect('clarification_of_the_object_type','9'); ?> >Сельскохозяйственные земли</option>
        <option value="92" <?php inputToSelect('clarification_of_the_object_type','92'); ?> >Собственность менее 5 лет</option>
        <option value="93" <?php inputToSelect('clarification_of_the_object_type','93'); ?> >Собственность более 5 лет</option>
    </select><br>
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
    <br>
</fieldset><br>

<fieldset>
    <legend>Обустройство</legend><br>
    <span >Жилищно-коммунальные услуги</span><br>
    <label >Водопровод <input type="hidden" name="water_pipes" value="">
<input type="checkbox" name="water_pipes" <?php inputToCheckbox("water_pipes"); ?> ></label><br>
    <label >Электричество <input type="hidden" name="electricity" value="">
<input type="checkbox" name="electricity" <?php inputToCheckbox("electricity"); ?> ></label><br>
    <label >Отопление <input type="hidden" name="heating" value="">
<input type="checkbox" name="heating" <?php inputToCheckbox("heating"); ?> ></label><br>
    <label >Газ <input type="hidden" name="gas" value="">
<input type="checkbox" name="gas" <?php inputToCheckbox("gas"); ?> ></label><br>
    <br>
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
    <legend> Вложения</legend>
    <label for="planning_project">Проект планировки</label>
    <input type="file" name="planning_project" multiple accept=""/>
    <label for="three_d_project">3d проект</label>
    <input type="file" name="three_d_project" multiple accept=""/>
    <label for="video">Видео</label>
    <input type="file" name="video" multiple accept=""/>
</fieldset>