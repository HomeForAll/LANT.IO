'use strict';

var getSearchParameters = function() {
    function transformToAssocArray( prmstr ) {
        var params = {};
        var prmarr = prmstr.split("&");
        for ( var i = 0; i < prmarr.length; i++) {
            var tmparr = prmarr[i].split("=");
            params[tmparr[0]] = tmparr[1];
        }
        return params;
    }
    var prmstr = window.location.search.substr(1);
    return prmstr !== null && prmstr !== "" ? transformToAssocArray(prmstr) : {};
};

/** Переходим в новую вкладку и получаем объявления **/
$(document).ready(function () {
    $.ajax({
        method: 'GET',
        url: 'api/search',
        data: getSearchParameters(),
        dataType: 'Json',
        success: function(form_data) {
            renderAllApartments(form_data);
        }
    });
});

/** при нажатии отправить, рендерим формы **/
$('#form_2').on('submit', function () {
    var newData = {};
    $.ajax({
        method: 'POST',
        url: 'api/search',
        data: getSearchParameters(),
        success: function(form_data) {
            renderAllApartments(form_data);
            newData += form_data;
        }
    });

    /** Открываем дополнительную ифнормацию об объявлениях **/
    $('.open-close-ad').on('click', function () {
        var additionalInformationContent = '',
            $moreInformationMainBlock = $('#show-more-information').html(),
            addBlockInMain = Handlebars.compile($moreInformationMainBlock),
            $resultAllApartments = $('.result-all-apartments');

        additionalInformationContent += addBlockInMain(newData);
        $resultAllApartments.html(additionalInformationContent);
    });
});

/** Определяем нужные checkbox **/
$(function() {
    var $boxes = $('.checkbox-4 input:checkbox');

    $('.checkbox-1 input:checkbox').on('click', function(e) {
        $('#checkbox-price').html('От ' + e.target.value);
    });
    $('.checkbox-2 input:checkbox').on('click', function(e) {
        $('#size-apartments').val(e.target.value);
    });
    $('.checkbox-3 input:checkbox').on('click', function(e) {
        $('#checkbox-area').html(e.target.value);
    });

    $boxes.on('change', function(){
        var theArray = [];
        for (var i = 0; i < $boxes.length; i++) {
            var box = $boxes[i];
            if ($(box).prop('checked')) {
                theArray[theArray.length] = $(box).val();
            }
        }
        showValuesPrice(theArray);
    });

    var showValuesPrice = function(array) {
        var text = '';
        if(array.length === 0) text = 'Выбрано (0)';
        for(var i = 0; i < array.length; i++) {
            text = 'Выбрано (' + array.length + ')';
        }
        $('#checkbox-equipment').html(text);
    };
});

/** Рендеринг форм **/
function renderAllApartments(data) {
    var content = '',
        $resultAllApartments = $('.result-all-apartments');

    if (!data) {
        console.log('Данные не полные');
        return false;
    }

    for (var i = 0; i < data.length; i++) {
        var $source = $("#entry-template").html(),
            template = Handlebars.compile($source);

        data[i].preview_img = "5.png";

        content += template(data[i]);
    }
    $resultAllApartments.html(content);
}

/** Select **/
// $('select').styler({
//     selectSearch: true
// });

/** Фильтр - Цена **/
$(function () {
    var $amountBeforeMain = $('#amountBeforeMain'),
        $amountAfterMain = $('#amountAfterMain');

    /** Фильтры в доп.параметрах **/
    $amountBeforeMain.val('0');
    $amountAfterMain.val('20000');
    $("#main-slider").slider({
        range: true,
        min: 0,
        max: 20000000,
        values: [75, 20000000],
        slide: function (event, ui) {
            $amountBeforeMain.val(ui.values[0]);
            $amountAfterMain.val(ui.values[1]);
        }
    });
    $amountBeforeMain.slider({values: 0});
    $amountAfterMain.slider({values: 1});
});

/** Стилизация (анимация) Header **/
$(function () {
    setInterval(function () {
        var scrolled = window.pageYOffset,
            $header = $('.show-hide-header'),
            $topHeader = $('.header'),
            $buttonHideMenu = $('.show-and-hide-menu'),
            $usersInformation = $('.user');

        if (scrolled > 500) {
            $header.fadeOut(function () {
                $topHeader.css({'background': 'none'});
            });
            $buttonHideMenu.css({'display': 'block'});
            $usersInformation.css({
                'position': 'fixed',
                'top': 'inherit',
                'button': 'inherit',
                'right': '0'
            });
        } else {
            $header.fadeIn(function () {
                $topHeader.css({'background': 'linear-gradient(to top, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.72)'});
            });
            $buttonHideMenu.css({'display': 'none'});
            $usersInformation.css({
                'position': 'fixed',
                'bottom': '65px',
                'top': '75px',
                'right': '10px'
            });
        }
    }, 1000);
});

/** Яндекс карты **/
function yandexMap() {
    var element = $('#address');

    ymaps.ready(function () {
        var map = new ymaps.Map("map", {
            center: [55.76, 37.64],
            zoom: 10,
            controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
        });

        //myMap.geoObjects.add(
        //    new ymaps.Placemark(
        //        coords,
        //        {
        //            balloonContentHeader: geolocation.country, // страна
        //            balloonContent: geolocation.city, // город
        //            balloonContentFooter: geolocation.region // регион
        //        }
        //    )
        //);

        element.on('change', function () {
            ymaps.geocode(element.val()).then(
                function (res) {
                    var object = res.geoObjects.get(0);

                    map.geoObjects.removeAll();
                    map.geoObjects.add(object);

                    var bounds = object.properties.get('boundedBy');

                    var coordinates = object.geometry.getCoordinates();
                    var country = object.getCountry();
                    var area = object.getAdministrativeAreas()[0];
                    var city = object.getLocalities();
                    var street = object.getThoroughfare();
                    var house = object.getPremiseNumber();

                    map.setBounds(bounds, {
                        checkZoomRange: true
                    });

//              if ('country' in MapController.options) {
//                  var countrySpan = $(MapController.options.country);
//                  var countryInput = $('#country');
//
//                  countrySpan.text('');
//                  countrySpan.text(country);
//
//                  countryInput.val('');
//                  countryInput.val(country);
//              }
//
//              if ('area' in MapController.options) {
//                  var areaSpan = $(MapController.options.area);
//                  var areaInput = $('#area');
//
//                  areaSpan.text('');
//                  areaSpan.text(area);
//
//                  areaInput.val('');
//                  areaInput.val(area);
//              }
//
//              if ('city' in MapController.options) {
//                  var citySpan = $(MapController.options.city);
//                  var cityInput = $('#city');
//
//                  citySpan.text('');
//                  citySpan.text(city);
//
//                  cityInput.val('');
//                  cityInput.val(city);
//              }
//
//              if ('street' in MapController.options) {
//                  var streetSpan = $(MapController.options.street);
//                  var streetInput = $('#street');
//
//                  streetSpan.text('');
//                  streetSpan.text(street);
//
//                  streetInput.val('');
//                  streetInput.val(street);
//              }
//
//              if ('house' in MapController.options) {
//                  var houseSpan = $(MapController.options.house);
//                  var houseInput = $('#house');
//
//                  houseSpan.text('');
//                  houseSpan.text(house);
//
//                  houseInput.val('');
//                  houseInput.val(house);
//              }

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
                        });

                    console.log(' --- Начало --- ');
                    console.log("Адрес: " + object.getAddressLine());
                    console.log("Страна: " + country);
                    console.log("Регион: " + area);
                    console.log("Город: " + city);
                    console.log("Улица: " + street);
                    console.log("Дом №: " + house);
                    console.log("Координаты: " + coordinates);
                    console.log(' --- Конец --- ');
                })
        });

        window.suggests = new ymaps.SuggestView("address", {width: 300, offset: [0, 4], results: 20});
    });
}

/** Поиск по городам **/
ymaps.ready(function () {
    new ymaps.SuggestView('address', {width: 300, offset: [0, 4], results: 20});
});
