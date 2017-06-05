ymaps.ready(init);

function init() {
    //    ymaps.load("metro", getMetro(coords));
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

    //Вывод метки при вводе в поле suggest вручную
    $('#suggest').change(function () {
        var address = $(this).val();
        setMark(address);
    });


    /**
     * Определение адреса по координатам (обратное геокодирование) и вывод метки.
     * @param coords
     */
    function getAddress(coords) {
        ymaps.geocode(coords).then(function (res) {
            var firstGeoObject = res.geoObjects.get(0);
            var address = firstGeoObject.properties.get('text');
            $('#suggest').val(address);
            setMark(address);
            var metro = getMetro(coords);

        });
    };

    /**
     * Метка на карте и запись данных метки в поля адреса.
     * @param address
     */
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

    function getMetro(coords) {
        var myGeocoder = ymaps.geocode(coords, {
            kind: 'metro',
            results: 3
        }).then(function (res) {

            //     resMetroColl = res.GeoObjectCollection.featureMember;
            //
            // for (var i = 0, l = resMetroColl.length; i < l; i++) {
            //     var mertoAddr = resMetroColl[i].GeoObject.metaDataProperty.GeocoderMetaData.Address.formatted;
            //     var mertoName = resMetroColl[i].GeoObject.name.substring(6);
            //     var mertoCoordTxt = (resMetroColl[i].GeoObject.Point.pos).split(' ');
            //     mertoCoords = [Number(mertoCoordTxt[1]), Number(mertoCoordTxt[0])];
            //     console.log(mertoName);
            //     console.log(mertoAddr);
            //     console.log(mertoCoords);

            var nearest = res.geoObjects.get(0);
            var mertoName = nearest.properties.get('name').substring(6);
            var mertoAddr = nearest.properties.get('text');
            var mertoLine = nearest.properties.get('description').split(',')[2];
            mertoLine = mertoLine.substring(1, (mertoLine.length-6));
            // запись в поле metro_station
            var merto_find = $('#metro_station option') .filter(function(i, e) {
                return (($(e).text().toLowerCase().indexOf(mertoName.toLowerCase())>=0)
                && ($(e).text().toLowerCase().indexOf(mertoLine.toLowerCase())>=0));
            });
            $('#metro_station option[value="'+merto_find[0].value+'"]').prop('selected', true);


            //находим расстояние до метро
            var multiRoute = new ymaps.multiRouter.MultiRoute({
                referencePoints: [
                    coords,
                    mertoAddr
                ],
                params: {
                    //Тип маршрутизации - пешеходная маршрутизация.
                    routingMode: 'pedestrian'
                }
            });

            // Подписка на события модели мультимаршрута.
            multiRoute.model.events
                .add("requestsuccess", function (event) {
                    var routes = event.get("target").getRoutes()['0'];
                    var mertoTimeWalk = Math.round(routes.properties.get("distance").value / 5.5 / 1000 * 60);
                    //Запись в поле distance_from_metro
                    $('#time_walk').val(mertoTimeWalk);

                })
                .add("requestfail", function (event) {
                    console.log("Ошибка: " + event.get("error").message);
                });
        });
    };
};

