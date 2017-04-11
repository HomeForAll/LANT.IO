'use strict';
var productSearch, showAndHideTopMenu, boolean, rootBlock = false,
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
});
$(document).ready(function(){
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
});

//---------------------------------------------------------

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
    var $propertyTypeApartmentSettings = $('.property-type-apartment-settings');
    //shadowBlock();

    $propertyTypeApartmentSettings.css({'display': 'block'});
    setTimeout(function () {
        $propertyTypeApartmentSettings.css({'display': 'none'});
    }, 2500);
}

function filterOptions() {
    var $showBigOptions = $('.showBigOptions');
    //shadowBlock();

    $showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 5000);
}

function apartmentSettings() {
	var $apartmentSettings = $('.apartment-settings');
	//shadowBlock();

    $apartmentSettings.css({'display': 'block'});
    setTimeout(function () {
        $apartmentSettings.css({'display': 'none'});
    }, 10000);
}

function appearanceofTheApartment() {
	var $appearanceOfTheApartments = $('.appearance-of-the-apartment');
	//shadowBlock();

    $appearanceOfTheApartments.css({'display': 'block'});
    setTimeout(function () {
        $appearanceOfTheApartments.css({'display': 'none'});
    }, 10000);
}

function appearanceOfTheBuilding() {
	var $appearanceOfTheBuild = $('.appearance-of-the-build');
	//shadowBlock();

    $appearanceOfTheBuild.css({'display': 'block'});
    setTimeout(function () {
        $appearanceOfTheBuild.css({'display': 'none'});
    }, 10000);
}

function allFilterBlocks(filters) {

   //shadowBlock();

    switch (filters) {
        case 'searchMetroMainBlock':
            var $searchMetro = $('.search-metro-main-block');
            $searchMetro.css({'display': 'block'});

            $('.closeSearchMetro').on('click', function () {
                $searchMetro.hide('slow', function () {
                    $(this).css({'display':'none'});
                    $('.decorativeShadowBlock').css({'display':'none'})
                });
                event.preventDefault();
            });
            break;
        case 'appearanceOfTheApartment' :
            var $b = $('.appearance-of-the-apartment');
            $b.css({'display': 'block'});

           // $('.close-building-parameters-filter').on('click', function () {
           //     $searchMetro.hide('slow', function () {
           //         $(this).css({'display':'none'});
           //         $('.decorativeShadowBlock').css({'display':'none'})
           //     });
           //     event.preventDefault();
           // });
            setTimeout(function () {
                $b.hide();
            }, 10000);
            break;
        case 'buildingParametersFilter' :
            var $a = $('.building-parameters-filter');
            $a.css({'display': 'block'});

            $('.close-building-parameters-filter').on('click', function () {
                $searchMetro.hide('slow', function () {
                    $(this).css({'display':'none'});
                    $('.decorativeShadowBlock').css({'display':'none'})
                });
                event.preventDefault();
            });
            setTimeout(function () {
                $a.hide();
            }, 10000);
            break;
        case 'historySearch':
            var $history = $('.history-search');

            $history.css({'display': 'block'});

            setTimeout(function () {
                $history.css({'display': 'none'});
                $('.decorativeShadowBlock').css({'display':'none'})
            }, 10000);
            break;
        default : console.log('Фильтр не найден');
    }
}

function filter1() {
    var $showBigOptions = $('.building-parameters-apartment'),
    mB = $('.property-type-apartment-settings');
    mB.hide();
    $('.building-parameters').css({'display':'none'});

    //$('.value-text').text('квартира');

    //shadowBlock();

    $showBigOptions.show();
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 15000);
}

function filter2() {
    var $showBigOptions = $('.building-parameters-home'),
    mB = $('.property-type-apartment-settings');
    mB.hide();
    $('.building-parameters').css({'display':'none'});

    //$('.value-text').text('дом');

    //shadowBlock();

    $showBigOptions.show();
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 15000);
}

function filter3() {
    var $showBigOptions = $('.building-parameters-room'),
    mB = $('.property-type-apartment-settings');
    mB.hide();
    $('.building-parameters').css({'display':'none'});

    //$('.value-text').text('комната');

    //shadowBlock();

    $showBigOptions.show();
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 15000);
}

function filter4() {
    var $showBigOptions = $('.building-parameters-office-area'),
    mB = $('.property-type-apartment-settings');
    mB.hide();
    $('.building-parameters').css({'display':'none'});

    //$('.value-text').text('Офисная площадь');

    //shadowBlock();

    $showBigOptions.show();
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 15000);
}

function filter5() {
    var $showBigOptions = $('.building-parameters-separate-building'),
    mB = $('.property-type-apartment-settings');
    mB.hide();
    $('.building-parameters').css({'display':'none'});

    //$('.value-text').text('Отдельно стоящее здание');

    //shadowBlock();

    $showBigOptions.show();
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 15000);
}

function filter6() {
    var $showBigOptions = $('.building-parameters-ozs-сomplex'),
    mB = $('.property-type-apartment-settings');
    mB.hide();
    $('.building-parameters').css({'display':'none'});

    //$('.value-text').text('Комплекс ОСЗ');

    //shadowBlock();

    $showBigOptions.show();
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 15000);
}

function attachment() {
    var attachmentsBlock = $('.attachments');
    //shadowBlock();

    attachmentsBlock.css({'display': 'block'});
    setTimeout(function () {
        attachmentsBlock.css({'display': 'none'});
    }, 10000);
}

function quickSearch() {
    var $quickSearchBlock = $('.quick-search');
   //shadowBlock();

    $quickSearchBlock.css({'display': 'block'});
    setTimeout(function () {
        $quickSearchBlock.css({'display': 'none'});
    }, 10000);
}

/** Тени в открывшимся блоке **/
function shadowBlock() {
    var $shadowBlocks = $('.decorativeShadowBlock');

    $shadowBlocks.css({'display': 'none'});
    //$shadowBlocks.css({'display': 'block'});
}

$('.select2-selection--single, .pointer').on('click', function () {
    $(this).css({
        'background': 'url("../../template/images/pointer_top.png") right 5px center no-repeat',
        'background-size': 'auto'
    });
    setTimeout(function () {
        closePointer();
    }, 4500);
});

function closePointer() {
    var el = $('.select2-selection--single, .pointer');
    el.css({
        'background': 'url("../../template/images/pointer_bottom.png") right 5px center no-repeat',
        'background-size': 'auto'
    });
}
//---------------------------------------------------------

function moreAndLess(sizeImage) {
   var $img = $('.metro-location img');

    valueButton[sizeImage]();

    if (imagesWidth > 150) {
        return imagesWidth = 150;
    }
    if (imagesWidth < 100) {
        return imagesWidth = 100;
    }

    $img.css({'width': + imagesWidth + '%'});
}

function closeFixedBlock() {
	$('.warning').css({'display':'block'})
}
/** Яндекс карты **/
ymaps.ready(function () {
    var map = new ymaps.Map("ymap", {
        center: [55.451332, 37.369336],
        zoom: 10,
        controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
    });

    window.suggests = new ymaps.SuggestView("suggest", {width: 300, offset: [0, 4], results: 20});
});
//---------------------------------------------------------

/** Получение данных через Ajax и отправка данных**/
function data(e) {
    e.preventDefault();

    $("#form").on('submit', function(e) { // устанавливаем событие отправки для формы с id=form

        var form_data = $(this).serialize(); // собераем все данные из формы

        if (data.value === undefined) {
            return '';
        }

        $.ajax({
            type: "POST",
            url: "/search.php",
            dataType: 'json',
            data: form_data,
            success: function(form_data) {
                alert("Ваше сообщение отправлено!");
                console.log('Собрынные данные - ', form_data);
            },
            error: function() {
                console.log('Ошибка отправки');
            }
        });
    });
}
//---------------------------------------------------------

/** Фильтр - Цена **/
$(function () {
    var $amountBefore = $('#amountBefore'),
        $amountAfter = $('#amountAfter'),
        $amountBeforeBuy = $('#amountBeforeBuy'),
        $amountAfterBuy = $('#amountAfterBuy');

    /** Фильтры в доп.параметрах **/
    $amountBefore.val('20000');
    $amountAfter.val('20000');
    $amountBeforeBuy.val('20000');
    $amountAfterBuy.val('20000');
    $("#slider-range").slider({
        range: true,
        min: 20000,
        max: 20000000,
        values: [75, 300],
        slide: function (event, ui) {
            $amountBefore.val(ui.values[0]);
            $amountAfter.val(ui.values[1]);
        }
    });
    $("#slider-range-buy").slider({
        range: true,
        min: 20000,
        max: 20000000,
        values: [75, 300],
        slide: function (event, ui) {
            $amountBeforeBuy.val(ui.values[0]);
            $amountAfterBuy.val(ui.values[1]);
        }
    });
    $('#amount').val($amountBefore.slider('values', 0) + $amountAfter.slider('values', 1));
    $('#amount-buy').val($amountBeforeBuy.slider('values', 0) + $amountAfterBuy.slider('values', 1));
});
//---------------------------------------------------------

/** Яндекс карты **/
function yandexMap() {
    var element = $('#address');
    $('#map').show();

    $('#searchYandexMap').hide();

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