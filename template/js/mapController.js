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

window.maps = {};
window.suggests = {};

MapController.initMap = function (mapID, center, suggest) {
    ymaps.ready(function () {
        window.maps[mapID] = new ymaps.Map(mapID, {
            center: center,
            zoom: 10,
            controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
        });
        window.suggests[suggest] = new ymaps.SuggestView(suggest, {width: 300, offset: [0, 4], results: 20});
    });
};

MapController.moveTo = function (bounds, mapID) {
    return window.maps[mapID].setBounds(bounds, {
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
 * @param mapID
 */
MapController.prototype.get = function (address, mapID) {
    //console.log(window.maps);
    ymaps.geocode(address).then(
        function (res) {
            var object = res.geoObjects.get(0);

            window.maps[mapID].geoObjects.removeAll();
            window.maps[mapID].geoObjects.add(object);

            var bounds = object.properties.get('boundedBy');

            MapController.moveTo(bounds, mapID);

            MapController.prototype.coordinates = object.geometry.getCoordinates();
            var country = object.getCountry();
            var area = object.getAdministrativeAreas()[0];
            var city = object.getLocalities();
            var street = object.getThoroughfare();
            var house = object.getPremiseNumber();

            if ('country' in MapController.options) {
                var countrySpan = $(MapController.options.country);
                var countryInput = $('#country');

                countrySpan.text('');
                countrySpan.text(country);

                countryInput.val('');
                countryInput.val(country);
            }

            if ('area' in MapController.options) {
                var areaSpan = $(MapController.options.area);
                var areaInput = $('#area');

                areaSpan.text('');
                areaSpan.text(area);

                areaInput.val('');
                areaInput.val(area);
            }

            if ('city' in MapController.options) {
                var citySpan = $(MapController.options.city);
                var cityInput = $('#city');

                citySpan.text('');
                citySpan.text(city);

                cityInput.val('');
                cityInput.val(city);
            }

            if ('street' in MapController.options) {
                var streetSpan = $(MapController.options.street);
                var streetInput = $('#street');

                streetSpan.text('');
                streetSpan.text(street);

                streetInput.val('');
                streetInput.val(street);
            }

            if ('house' in MapController.options) {
                var houseSpan = $(MapController.options.house);
                var houseInput = $('#house');

                houseSpan.text('');
                houseSpan.text(house);

                houseInput.val('');
                houseInput.val(house);
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

                    var region = object.properties.getAll().name;

                    if ('region' in MapController.options) {
                        var regionSpan = $(MapController.options.region);
                        var regionInput = $('#region');

                        regionSpan.text('');
                        regionSpan.text(region);

                        regionInput.val('');
                        regionInput.val(region);
                    }
                }
            );
        }
    );
};