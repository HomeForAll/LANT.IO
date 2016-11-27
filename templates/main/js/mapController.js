/** 
 * Необходимо учитывать, что suggest всего лишь будет показывать текстовые подсказки,
 * обработку событий типа submit или change, Вы должны реализовать сами
 *
 * @param mapID - Индитификатор DIV в котором будет располагаться карта
 * @param center - Координаты центра карты в виде массива, пример: [56.2342, 42.26522]
 * @param suggest - Индитификатор input[type=text] поля под которым будет выпадающая панель с поисковыми подсказками
 * @param options - Объект с такими параметрами: country, area, city, region, street, house.
 *        Значениями являются индитификаторы элементов, в которые поместиться соответствующая инфомация.
 */
function MapController(mapID, center, suggest, options) {
    MapController.options = options;
    MapController.initMap(mapID, center, suggest);
}

MapController.initMap = function (mapID, center, suggest) {
    ymaps.ready(function () {
        MapController.prototype.map = new ymaps.Map(mapID, {
            center: center,
            zoom: 10,
            controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
        });
        window.suggestWiew = new ymaps.SuggestView(suggest, {width: 300, offset: [0, 4], results: 20});
    });
};

MapController.moveTo = function (bounds) {
    return MapController.prototype.map.setBounds(bounds, {
        checkZoomRange: true
    });
    // return MapController.prototype.map.panTo(coordinates, {
    //     checkZoomRange: true,
    //     duration: 1500
    // });
};

/**
 * Метод получает и обрабатывает необходимую информацию о расположении объекта.
 * @param address
 */
MapController.prototype.get = function (address) {
    ymaps.geocode(address).then(
        function (res) {
            var object = res.geoObjects.get(0);

            MapController.prototype.map.geoObjects.removeAll();
            MapController.prototype.map.geoObjects.add(object);

            var bounds = object.properties.get('boundedBy');

            MapController.moveTo(bounds);

            MapController.prototype.coordinates = object.geometry.getCoordinates();
            MapController.prototype.country = object.getCountry();
            MapController.prototype.area = object.getAdministrativeAreas()[0];
            MapController.prototype.city = object.getLocalities();
            MapController.prototype.street = object.getThoroughfare();
            MapController.prototype.house = object.getPremiseNumber();

            if ('country' in MapController.options) {
                $(MapController.options.country).text('');
                $(MapController.options.country).text(object.getCountry());
            }
            if ('area' in MapController.options) {
                console.log(object.getAdministrativeAreas()[0]);
                $(MapController.options.area).text('');
                $(MapController.options.area).text(object.getAdministrativeAreas()[0]);
            }
            if ('city' in MapController.options) {
                $(MapController.options.city).text('');
                $(MapController.options.city).text(object.getLocalities());
            }
            if ('street' in MapController.options) {
                $(MapController.options.street).text('');
                $(MapController.options.street).text(object.getThoroughfare());
            }
            if ('house' in MapController.options) {
                $(MapController.options.house).text('');
                $(MapController.options.house).text(object.getPremiseNumber());
            }

            // console.log(' --- Начало --- ');
            // console.log("Адрес: " + object.getAddressLine());
            // console.log("Страна: " + MapController.prototype.country);
            // console.log("Регион: " + MapController.prototype.area);
            // console.log("Город: " + MapController.prototype.city);
            // console.log("Улица: " + MapController.prototype.street);
            // console.log("Дом №: " + MapController.prototype.house);
            // console.log("Координаты: " + MapController.prototype.coordinates);
            // console.log(' --- Конец --- ');
        }
    ).then(
        function () {
            ymaps.geocode(MapController.prototype.coordinates, {
                kind: 'district'
            }).then(
                function (res) {
                    var object, region;

                    //console.log(res.geoObjects.get(1));

                    if (res.geoObjects.get(0) === undefined) {
                        object = undefined;
                    } else {
                        object = res.geoObjects.get(0);
                        region = object.properties.getAll().name;
                    }

                    if ('region' in MapController.options) {
                        if (region === undefined) {
                            $(MapController.options.region).text('');
                        }
                        {
                            $(MapController.options.region).text(object.properties.getAll().name);
                        }
                    }

                    // console.log("Район: " + region);
                }
            );
        }
    );
};