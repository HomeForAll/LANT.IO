'use strict';
var productSearch, showAndHideTopMenu, boolean, rootBlock, showFilter = false,
    blockFilterAndShadow = $('.property-type-apartment-settings, .decorativeShadowBlock'),
    imagesWidth = 130,
    valueButton = {
        'more': (function () {
            imagesWidth += 10;
            return imagesWidth;
        }),
        'less': (function () {
            imagesWidth -= 10;
            return imagesWidth;
        })
    };

/** Select **/
$('select').styler({
    selectSearch: true
});
//---------------------------------------------------------

/** Слайдер **/
$(document).ready(function(){
    $('.bxslider').bxSlider({
        slideWidth: 500, // ширина слайдера
        minSlides: 1,
        maxSlides: 2,
        moveSlides: 2, // прокрутка по 2 блока
        slideMargin: 10,
        pager: false,
        auto: true, // прокрутка
        infiniteLoop: true // бесконечная прокрутка
    });
    $('.bxslider-partners').bxSlider({
    	slideWidth: 150,
     	minSlides: 1,
     	maxSlides: 5,
     	moveSlides: 2,
     	slideMargin: 50,
     	pager: false,
        auto: true,
        pause: 15000,
        infiniteLoop: true
    });
    $('.apartments-wallpapers').bxSlider({
        slideWidth: 70,
        minSlides: 1,
        maxSlides: 5,
        moveSlides: 3,
        slideMargin: 0,
        pager: false,
        pause: 20000,
        auto: true,
        infiniteLoop: true
    });
});
//---------------------------------------------------------

/** Цвета линий метро **/
function formatState (state) {
    var $allMetroLines = $('<span><a class="branch-line"></a>' + state.text + '</span>'),
        $tagSearchByClass = $allMetroLines.find('a');

    if (state.id === '0') {
        $tagSearchByClass.css({'background': 'orange'});
    }
    if (state.id === '1') {
        $tagSearchByClass.css({'background': 'red'});
    }
    if (state.id === '2') {
        $tagSearchByClass.css({'background': 'blue'});
    }
    if (state.id === '3') {
        $tagSearchByClass.css({'background': 'silver'});
    }
    if (state.id === '4') {
        $tagSearchByClass.css({'background': 'yellowgreen'});
    }

    if (!state.id) {
        return state.text;
    } else return $allMetroLines;
}
//---------------------------------------------------------

/** Отслежка и изменение расширенного и простого блока **/
function choiceBlock(allBlock) {
    if (!rootBlock) {return false}
    var $bigSearchMenu = $('.big-search-menu'),
        $bigSearchMenuTenancy = $('.big-search-menu-tenancy'),
        $a = $('#blockToRent'),
        $b = $('#Buy'),
        $searchMenu = $('.search-menu-apartment');

    if (allBlock === 'toRent') {
        $a.css({'background': '#5e9152'}).find('a').css({'color':'#fff'});
        $b.css({'background': 'none'}).find('a').css({'color':'#898989'});
        $bigSearchMenu.css({'display':'block'});
        $bigSearchMenuTenancy.css({'display':'none'});
    } else {
        $a.css({'background': 'none'}).find('a').css({'color':'#898989'});
        $b.css({'background': '#5e9152'}).find('a').css({'color':'#fff'});
        $searchMenu.css({'display':'none'});
        $bigSearchMenu.css({'display':'none'});
        $bigSearchMenuTenancy.css({'display':'block'});
    }
}

function showBigSearch() {
    var $searchTeg = $('.big-search a i'),
        $bigSearch = $('.big-search'),
        $searchMenuApartment = $('.search-menu-apartment'),
        $bigSearchMenu = $('.big-search-menu'),
        $bigSearchMenuTenancy = $('.big-search-menu-tenancy');

    rootBlock = true;
    choiceBlock();

    $searchMenuApartment.css({'display':'none'});

    productSearch = !productSearch;

    if (!productSearch) {
        $searchTeg.remove();
        $bigSearch.html('<a>Расширенный поиск</a>' + '<i class="fa fa-angle-right" aria-hidden="true"></i>');
        $searchMenuApartment.css({'display':'block'});
        $bigSearchMenu.css({'display':'none'});
        $bigSearchMenuTenancy.css({'display':'none'});
        rootBlock = false;
        return productSearch = false;
    } else {
        $searchTeg.remove();
        $bigSearch.html('<i class="fa fa-angle-left" aria-hidden="true"></i>' + '<a>Простой поиск</a>');
        $bigSearchMenu.css({'display':'block'});
        $bigSearchMenuTenancy.css({'display':'none'});
        $searchMenuApartment.css({'display':'none'});
        rootBlock = true;
        return productSearch = true;
    }
}
//---------------------------------------------------------

/** Header меню **/
function showTopMenuAndSearch() {
    var $user = $('.user ul');

    showAndHideTopMenu = !showAndHideTopMenu;

    if (!showAndHideTopMenu) {
        $user.css({'display': 'none'});
        showAndHideTopMenu = false;
    } else {
        $user.css({'display': 'block'});
        showAndHideTopMenu = true;
    }
}
//---------------------------------------------------------

/** Блоки с фильтрами **/
function filterOptionsApartments() {

    showFilter = !showFilter;

    if (!showFilter) {
        return false;
    }
    blockFilterAndShadow.fadeIn('slow');
}

function allParam(filterParam) {

    switch (filterParam) {
        case 'apartment':
            var $apartmentSettings = $('.apartment-settings');
            $apartmentSettings.css({'display': 'block'});

            $('.closeBlock').on('click', function (e) {
                e.preventDefault();
                $apartmentSettings.fadeOut('slow');
            });
            break;
        case 'houseCharacteristics':
            var $houseCharacteristics = $('.house-characteristics');
            $houseCharacteristics.css({'display': 'block'});

            $('.closeHouseCharacteristics').on('click', function (e) {
                e.preventDefault();
                $houseCharacteristics.fadeOut('slow');
            });
            break;
        case 'apperanceOfTheApartment':
            var $apartmentApartment = $('.appearance-of-the-apartment');
            $apartmentApartment.css({'display': 'block'});

            $('.search').on('click', function (e) {
                e.preventDefault();
                $apartmentApartment.fadeOut('slow');
            });
            break;
        case 'appearanceBuild':
            var $apparenceBuild = $('.appearance-of-the-build');
            $apparenceBuild.css({'display': 'block'});

            $('.closeApparenceBuild').on('click', function (e) {
                e.preventDefault();
                $apparenceBuild.fadeOut('slow');
            });
            break;
        case 'attachment':
            var $attachment = $('.attachment');
            $attachment.css({'display': 'block'});

            $('.closeAttachment').on('click', function (e) {
                e.preventDefault();
                $attachment.fadeOut('slow');
            });
            break;
        case 'document':
            var $document = $('.document');
            $document.css({'display': 'block'});

            $('.closeDocument').on('click', function (e) {
                e.preventDefault();
                $document.fadeOut('slow');
            });
            break;
        case 'bigOption':
            var $bigOption = $('.showBigOptions'),
                qa = $('.decorativeShadowBlock');
            $bigOption.css({'display': 'block'});
            qa.css({'display':'block'});

            $('.closeCurrency').on('click', function (e) {
                e.preventDefault();
                $bigOption.fadeOut('slow', function () {
                    qa.css({'display':'none'});
                });
            });
            break;
        case 'map':
            var $map = $('#map'),
                openMap = false;

            openMap = true;

            if (!openMap) {return false;}

            yandexMap();

            $('#searchYandexMap').hide();
            $map.css({'display': 'block'});

            $('.close-map').on('click', function (e) {
                e.preventDefault();
                $('#searchYandexMap').show();
                $map.fadeOut('slow');
            });
            break;
        case 'plotOfLand':
            var $plotOfLand = $('.plot-of-land');
            $plotOfLand.css({'display': 'block'});

            $('.close-plot-of-land').on('click', function (e) {
                e.preventDefault();
                $plotOfLand.fadeOut('slow');
            });
            break;
        case 'repairAndUtilitiesOfTheApartment':
            var $repairAndUtilitiesOfTheApartment = $('.repair-and-utilities-of-the-apartment');
            $repairAndUtilitiesOfTheApartment.css({'display': 'block'});

            $('.close-repair-and-utilities-of-the-apartment').on('click', function (e) {
                e.preventDefault();
                $repairAndUtilitiesOfTheApartment.fadeOut('slow');
            });
            break;
        case 'buildingParametersFilter':
            var $parametrFilter = $('.building-parameters-filter');
            $parametrFilter.css({'display': 'block'});

            $('.close-building-parameter').on('click', function (e) {
                e.preventDefault();
                $parametrFilter.fadeOut('slow');
            });
            break;
        default: console.log('Параметр не найден');
    }
}

function allFilterBlocks(filters) {

    $('.advanced-search-options').find('.building-parameters-apartment,' +
        ' .building-parameters-home, .building-parameters-room, .building-parameters-office-area,' +
        '.building-parameters-separate-building, .building-parameters-ozs-сomplex,' +
        '.test-7, .test-8, .test-9, .test-10, .test-11, .test-12').css({'display': 'none'});

    switch (filters) {
        case 'searchMetroMainBlock':
            var $searchMetro = $('.search-metro-main-block');
            $searchMetro.css({'display': 'block'});

            $('.closeSearchMetro').on('click', function (e) {
                e.preventDefault();
                $searchMetro.hide('slow', function () {
                    $(this).css({'display': 'none'});
                });
            });
            break;
        case 'historySearch':
            var $exactArea = $('.exact-area');

            $exactArea.fadeIn('slow', function () {
                $(this).css({
                    'position': 'absolute',
                    'height': '435px',
                    'width': '85%'
                });
            });

            setTimeout(function () {
                $exactArea.fadeOut('slow', function () {
                    $(this).css({
                        'position': 'relative',
                        'height': '75px',
                        'width': '37%',
                        'display': 'inline-block'
                    });
                });
            }, 10000);
            break;
        case '1':
            $('.building-parameters-apartment').css({'display': 'flex'});
            break;
        case '2':
            $('.building-parameters-home').css({'display': 'flex'});
            break;
        case '3':
            $('.building-parameters-room').css({'display': 'flex'});
            break;
        case '4':
            $('.building-parameters-office-area').css({'display': 'flex'});
            break;
        case '5':
            $('.building-parameters-separate-building').css({'display': 'flex'});
            break;
        case '6':
            $('.building-parameters-ozs-сomplex').css({'display': 'flex'});
            break;
        case '7':
            $('.test-7').css({'display': 'flex'});
            break;
        case '8':
            $('.test-8').css({'display': 'flex'});
            break;
        case '9':
            $('.test-9').css({'display': 'flex'});
            break;
        case '10':
            $('.test-10').css({'display': 'flex'});
            break;
        case '11':
            $('.test-11').css({'display': 'flex'});
            break;
        case '12':
            $('.test-12').css({'display': 'flex'});
            break;
        default: console.log('Фильтр не настроен');
    }
    blockFilterAndShadow.fadeOut('slow');
}

/** Показать больше надстроек в фильтрах **/
$('.more-settings').on('click', function () {
    $('.show-more-settings').fadeIn('slow', $(this).css({'display':'block'}));
});
//---------------------------------------------------------

/** Отмена На переход **/
function quickSearch(event) {
    var $quickSearch = $('.quick-search');

    event.preventDefault();

    $quickSearch.css({'display': 'block'});

    $('.closeQuickSearch').on('click', function (e) {
        e.preventDefault();
        $quickSearch.fadeOut('slow');
    });
}
//---------------------------------------------------------

/** Указатели в теге select **/
$('.select').on('click', function (e) {
    var pointer = $('.jq-selectbox__trigger-arrow');

    e.preventDefault();

    pointer.css({
        'background': 'url("../../template/images/pointer_top.png") center right 5px no-repeat',
        'background-size': 'auto'
    });

    setTimeout(function () {
        pointer.css({
            'background': 'url("../../template/images/pointer_bottom.png") center right 5px no-repeat',
            'background-size': 'auto'
        });
    }, 5000);
});
//---------------------------------------------------------

/** Масштаб карты **/
function moreAndLess(sizeImage) {
   var $img = $('.metro-location img');

    valueButton[sizeImage]();

    if (imagesWidth > 150) {
        return imagesWidth = 150;
    }
    if (imagesWidth < 100) {
        return imagesWidth = 100;
    }

    $img.css({
        'width': + imagesWidth + '%',
        'height': + imagesWidth +'%'
    });
}
//---------------------------------------------------------

/** Блок предупреждения **/
function closeFixedBlock() {
    $('.warning').css({'display':'block'})
}
//---------------------------------------------------------

/** Получение данных через Ajax и отправка данных**/
$("#form").on('submit', function(e) { // устанавливаем событие отправки для формы с id=form

    e.preventDefault();

    var form_data = $(this).serialize(); // собераем все данные из формы

    $.ajax({
        type: "POST",
        url: "/search",
        data: form_data,
        success: function(form_data) {
            //window.location.href = '/template/layouts/searchBlock.php';
            console.log('Собрынные данные - ', form_data);
        },
        error: function() {
            console.log('Ошибка отправки');
        }
    });
});
//---------------------------------------------------------

/** Фильтр - Цена **/
 $(function () {
    var $amountBefore = $('#amountBefore'),
        $amountAfter = $('#amountAfter'),
        $amountBeforeBuy = $('#amountBeforeBy'),
        $amountAfterBuy = $('#amountAfterBy'),
        $amountBeforeSearch = $('#amountBeforeSearch'),
        $amountAfterSearch = $('#amountAfterSearch');

    /** Фильтры в доп.параметрах **/
    $amountBefore.val('75');$amountAfter.val('20000');
    $amountBeforeBuy.val('75');$amountAfterBuy.val('20000');
    $amountBeforeSearch.val('75');$amountAfterSearch.val('20000');
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 20000000,
        values: [75, 10000],
        slide: function (event, ui) {
            $amountBefore.val(ui.values[0]);
            $amountAfter.val(ui.values[1]);
        }
    });
    $("#slider-range-buy").slider({
        range: true,
        min: 0,
        max: 20000000,
        values: [75, 10000],
        slide: function (event, ui) {
            $amountBeforeBuy.val(ui.values[0]);
            $amountAfterBuy.val(ui.values[1]);
        }
    });
    $("#slider-range-search").slider({
        range: true,
        min: 0,
        max: 20000000,
        values: [75, 10000],
        slide: function (event, ui) {
            $amountBeforeSearch.val(ui.values[0]);
            $amountAfterSearch.val(ui.values[1]);
        }
    });
    $amountBefore.slider({values: 0}); $amountAfter.slider({values: 1});
    $amountBeforeBuy.slider({values: 0}); $amountAfterBuy.slider({values: 1});
    $amountBeforeSearch.slider({values: 0}); $amountAfterSearch.slider({values: 1});
});
//---------------------------------------------------------

/** Яндекс карты **/
function yandexMap() {
    var element = $('#address');

    ymaps.ready(function () {
        var map = new ymaps.Map("map", {
            center: [55.76, 37.64],
            zoom: 10,
            controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
        });

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

/** Яндекс карты внутри параметров **/
ymaps.ready(function () {
    var map = new ymaps.Map("ymap", {
        center: [55.451332, 37.369336],
        zoom: 10,
        controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
    });

    window.suggests = new ymaps.SuggestView("suggest", {width: 300, offset: [0, 4], results: 20});
});

/** Поиск по городам **/
ymaps.ready(function () {
    var metroLocation = new ymaps.SuggestView('address', {width: 300, offset: [0, 4], results: 20});
    metroLocation();
});