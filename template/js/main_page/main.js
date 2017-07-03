'use strict';
var productSearch, showAndHideTopMenu, boolean, rootBlock, showFilter, openMap = false,
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


/** Через Socket.io обрабатываем запросы **/
$(document).ready(function () {
    /*
    var socket = io('http://91.202.180.160:8089?user_id=<?php echo $user_id; ?>&hash=<?php echo $hash; ?>'),
        userRegister = {
            1: 'Зарегестрирован',
            2: 'Не зарегистрирован'
        };

    if (socket.disconnected) {
        console.log('Нет подключения');
    } else if (!socket.connected) {
        console.log('Подключено');
    }
    if (!socket.uri) {
        verificationOfRegistration(userRegister[2]);
    } else {
        verificationOfRegistration(userRegister[1]);
    }

    socket.on('socket', function (ad) {
        JSON.stringify(ad);
        console.log('Получили свежие бъявления', ad);
    });
    */
});

/** Проверка регистрации **/
function verificationOfRegistration(registration) {
    console.log('Проверяем регистрацию', registration);
    var $mainMessageBlock = $('.main-message-block'),
        message = $('<div class="messageBlock">' + registration + '</div>');

    $mainMessageBlock.prepend(message);
    setTimeout(function () {
        message.remove();
    }, 5000);
}

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
    }, 100);
});

/** Инициализация Paralax **/
$('#scene').parallax({
    calibrateX: false,
    calibrateY: true,
    invertX: false,
    invertY: true,
    limitX: false,
    limitY: 10,
    scalarX: 2,
    scalarY: 8,
    frictionX: 0.2,
    frictionY: 0.8,
    originX: 0.0,
    originY: 1.0
});
//---------------------------------------------------------

/** Select **/
// $('select').styler({
//     selectSearch: true
// });
//---------------------------------------------------------

/** Слайдер **/
$(document).ready(function () {
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

/** Отслежка и изменение расширенного и простого блока **/
function choiceBlock(allBlock) {
    if (!rootBlock) {
        return false
    }
    var $bigSearchMenu = $('.big-search-menu'),
        $bigSearchMenuTenancy = $('.big-search-menu-tenancy'),
        $a = $('#blockToRent'),
        $b = $('#Buy'),
        $searchMenu = $('.search-menu-apartment');

    if (allBlock === 'toRent') {
        $a.css({'background': '#5e9152'}).find('a').css({'color': '#fff'});
        $b.css({'background': 'none'}).find('a').css({'color': '#898989'});
        $bigSearchMenu.css({'display': 'block'});
        $bigSearchMenuTenancy.css({'display': 'none'});
    } else {
        $a.css({'background': 'none'}).find('a').css({'color': '#898989'});
        $b.css({'background': '#5e9152'}).find('a').css({'color': '#fff'});
        $searchMenu.css({'display': 'none'});
        $bigSearchMenu.css({'display': 'none'});
        $bigSearchMenuTenancy.css({'display': 'block'});
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

    $searchMenuApartment.css({'display': 'none'});

    productSearch = !productSearch;

    if (!productSearch) {
        $searchTeg.remove();
        $bigSearch.html('<a>Расширенный поиск</a>' + '<i class="fa fa-angle-right" aria-hidden="true"></i>');
        $searchMenuApartment.css({'display': 'block'});
        $bigSearchMenu.css({'display': 'none'});
        $bigSearchMenuTenancy.css({'display': 'none'});
        rootBlock = false;
        return productSearch = false;
    } else {
        $searchTeg.remove();
        $bigSearch.html('<i class="fa fa-angle-left" aria-hidden="true"></i>' + '<a>Простой поиск</a>');
        $bigSearchMenu.css({'display': 'block'});
        $bigSearchMenuTenancy.css({'display': 'none'});
        $searchMenuApartment.css({'display': 'none'});
        rootBlock = true;
        return productSearch = true;
    }
}
//---------------------------------------------------------

/** Header меню **/
function showTopMenuAndSearch() {
    var $user = $('.user');

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
function filterOptionsApartments(valTab) {
    var $namesSettings = {
            key_1: {
                newData: [{
                    name: 'Исходные параметры квартиры',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Характеристики дома',
                    img: 'search-3',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Квартира',
                size: 4
            },
            key_2: {
                newData: [{
                    name: 'Параметры объекта',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства дома',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Участок',
                    img: 'search-3',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Дом',
                size: 4
            },
            key_3: {
                newData: [{
                    name: 'Исходные параметры квартиры',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Внешний вид квартиры',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Параметры здания',
                    img: 'search-3',
                    bar: 0
                },{
                    name: 'Исходные параметры',
                    img: 'search-4',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Комната',
                size: 7
            },
            key_4: {
                newData: [{
                    name: 'Исходные параметры',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Земельный участок',
                size: 4
            },
            key_5: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Гараж/машиноместо',
                size: 4
            },
            key_6: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Офисная площадь',
                size: 4
            },
            key_7: {
                newData: [{
                    name: 'Основные параметры',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Отдельно стоящее здание',
                size: 3
            },
            key_8: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Дополнительно',
                    img: 'search-4',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Комплекс ОСЗ',
                size: 3
            },
            key_9: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Рынок/Ярмарка',
                size: 4
            },
            key_10: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Производственно-складские помещения',
                size: 4
            },
            key_11: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Производственно-складские здания',
                size: 4
            },
            key_12: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Недвижимость для туризма и отдыха',
                size: 4
            },
            key_13: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Недвижимость для туризма и отдыха',
                size: 4
            },
            key_14: {
                newData: [{
                    name: 'Основное',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Ремонт и обустройства',
                    img: 'search-2',
                    bar: 0
                },{
                    name: 'Документы',
                    img: 'search-1',
                    bar: 0
                },{
                    name: 'Вложения',
                    img: 'search-1',
                    bar: 0
                }],
                id: 'Недвижимость для туризма и отдыха',
                size: 4
            }
        },
        addFormData = '',
        valueText = $('.value-text'),
        mainBlock = $('.render-building-parameters'),
        html = '';

    showFilter = !showFilter;
    mainBlock.empty();
    blockFilterAndShadow.fadeIn();

    if (valTab === '' && undefined) {
        return false;
    }

    switch (valTab) {
        case 'key_1':
            addFormData = $namesSettings.key_1;
            break;
        case 'key_2':
            addFormData = $namesSettings.key_2;
            break;
        case 'key_3':
            addFormData = $namesSettings.key_3;
            break;
        case 'key_4':
            addFormData = $namesSettings.key_4;
            break;
        case 'key_5':
            addFormData = $namesSettings.key_5;
            break;
        case 'key_6':
            addFormData = $namesSettings.key_6;
            break;
        case 'key_7':
            addFormData = $namesSettings.key_7;
            break;
        case 'key_8':
            addFormData = $namesSettings.key_8;
            break;
        case 'key_9':
            addFormData = $namesSettings.key_9;
            break;
        case 'key_10':
            addFormData = $namesSettings.key_10;
            break;
        case 'key_11':
            addFormData = $namesSettings.key_11;
            break;
        case 'key_12':
            addFormData = $namesSettings.key_12;
            break;
    }

    if (valueText === undefined) {
        return '';
    }

    valueText.empty().prepend('<img src="/template/images/apartments.png" alt="icon">' + addFormData.id);

    if (addFormData !== '') {
        blockFilterAndShadow.fadeOut();
    }

    $.each(addFormData.newData, function (key, value) {
        html += '<li><img src="/template/images/' + value.img + '.png" alt="icon">' + value.name + '</li>';
    });

    mainBlock.html(html);
}


// Зависания
// function allParam(filterParam) {
//
//     switch (filterParam) {
//         case 'apartment':
//             var $apartmentSettings = $('.apartment-settings');
//             $apartmentSettings.css({'display': 'block'});
//
//             $('.closeBlock').on('click', function (e) {
//                 e.preventDefault();
//                 $apartmentSettings.fadeOut('slow');
//             });
//             break;
//         case 'houseCharacteristics':
//             var $houseCharacteristics = $('.house-characteristics');
//             $houseCharacteristics.css({'display': 'block'});
//
//             $('.close-house-characteristics').on('click', function (e) {
//                 e.preventDefault();
//                 $houseCharacteristics.fadeOut('slow').css({'display':'none'});
//             });
//             break;
//         case 'apperanceOfTheApartment':
//             var $apartmentApartment = $('.appearance-of-the-apartment');
//             $apartmentApartment.css({'display': 'block'});
//
//             $('.search').on('click', function (e) {
//                 e.preventDefault();
//                 $apartmentApartment.fadeOut('slow');
//             });
//             break;
//         case 'appearanceBuild':
//             var $apparenceBuild = $('.appearance-of-the-build');
//             $apparenceBuild.css({'display': 'block'});
//
//             $('.closeApparenceBuild').on('click', function (e) {
//                 e.preventDefault();
//                 $apparenceBuild.fadeOut('slow');
//             });
//             break;
//         case 'attachment':
//             var $attachment = $('.attachment');
//             $attachment.css({'display': 'block'});
//
//             $('.closeAttachment').on('click', function (e) {
//                 e.preventDefault();
//                 $attachment.fadeOut('slow');
//             });
//             break;
//         case 'document':
//             var $document = $('.document');
//             $document.css({'display': 'block'});
//
//             $('.closeDocument').on('click', function (e) {
//                 e.preventDefault();
//                 $document.fadeOut('slow');
//             });
//             break;
//         case 'bigOption':
//             var $bigOption = $('.showBigOptions'),
//                 qa = $('.decorativeShadowBlock');
//             $bigOption.css({'display': 'block'});
//             qa.css({'display':'block'});
//
//             $('.closeCurrency').on('click', function (e) {
//                 e.preventDefault();
//                 $bigOption.fadeOut('slow', function () {
//                     qa.css({'display':'none'});
//                 });
//             });
//             break;
//         case 'map':
//             var $map = $('#map');
//
//             if (!openMap) {
//                 yandexMap();
//                 openMap = true;
//             }
//
//             $('#searchYandexMap').hide();
//             $map.css({'display': 'block'});
//
//             $('.close-map').on('click', function (e) {
//                 e.preventDefault();
//                 $('#searchYandexMap').show();
//                 $map.fadeOut('slow');
//             });
//             break;
//         case 'plotOfLand':
//             var $plotOfLand = $('.plot-of-land');
//             $plotOfLand.css({'display': 'block'});
//
//             $('.close-plot-of-land').on('click', function (e) {
//                 e.preventDefault();
//                 $plotOfLand.fadeOut('slow');
//             });
//             break;
//         case 'repairAndUtilitiesOfHome':
//             var $repairHome = $('.repair-and-utilities-of-home');
//             $repairHome.css({'display': 'block'});
//
//             $('.close-repair-home').on('click', function (e) {
//                 e.preventDefault();
//                 $repairHome.fadeOut('slow');
//             });
//             break;
//         case 'objectParameters':
//             var $objectParameters = $('.object-parameters');
//             $objectParameters.css({'display': 'block'});
//
//             $('.close-object-parameters').on('click', function (e) {
//                 e.preventDefault();
//                 $objectParameters.fadeOut('slow');
//             });
//             break;
//         case 'additionallyAp':
//             var $additionallyAp = $('.additionally-ap');
//             $additionallyAp.css({'display': 'block'});
//
//             $('.closeAdditionallyAp').on('click', function (e) {
//                 e.preventDefault();
//                 $additionallyAp.fadeOut('slow');
//             });
//             break;
//         case 'main':
//             var $mainAp = $('.main-ap');
//             $mainAp.css({'display': 'block'});
//
//             $('.closeMainAp').on('click', function (e) {
//                 e.preventDefault();
//                 $mainAp.fadeOut('slow');
//             });
//             break;
//         case 'furnishing':
//             var $furnishing = $('.furnishing');
//             $furnishing.css({'display': 'block'});
//
//             $('.closeFurnishing').on('click', function (e) {
//                 e.preventDefault();
//                 $furnishing.fadeOut('slow');
//             });
//             break;
//         case 'mainSettings':
//             var $mainSettings = $('.main-settings');
//             $mainSettings.css({'display': 'block'});
//
//             $('.closeMainSettings').on('click', function (e) {
//                 e.preventDefault();
//                 $mainSettings.fadeOut('slow');
//             });
//             break;
//         case 'repairAndUtilitiesOfTheApartment':
//             var $repairAndUtilitiesOfTheApartment = $('.repair-and-utilities-of-the-apartment');
//             $repairAndUtilitiesOfTheApartment.css({'display': 'block'});
//
//             $('.close-repair-and-utilities-of-the-apartment').on('click', function (e) {
//                 e.preventDefault();
//                 $repairAndUtilitiesOfTheApartment.fadeOut('slow');
//             });
//             break;
//         case 'buildingParametersFilter':
//             var $parametrFilter = $('.building-parameters-filter');
//             $parametrFilter.css({'display': 'block'});
//
//             $('.close-building-parameter').on('click', function (e) {
//                 e.preventDefault();
//                 $parametrFilter.fadeOut('slow');
//             });
//             break;
//         default: console.log('Параметр не найден');
//     }
// }

// function allFilterBlocks(filters) {
//     var $namesSettings = {
//             1: 'Квартира',
//             2: 'Дом',
//             3: 'Комната',
//             4: 'Земельный участок',
//             5: 'Гараж/машиноместо',
//             6: 'Офисная площадь',
//             7: 'Отдельно стоящее здание',
//             8: 'Комплекс ОСЗ',
//             9: 'Рынок/Ярмарка',
//             10: 'Производственно-складские помещения',
//             11: 'Производственно-складские здания',
//             12: 'Недвижимость для туризма и отдыха'
//         },
//         settingsApartment = '';
//
//     switch (filters) {
//         case 'searchMetroMainBlock':
//             var $searchMetro = $('.search-metro-main-block');
//             $searchMetro.css({'display': 'block'});
//
//             $('.closeSearchMetro').on('click', function (e) {
//                 e.preventDefault();
//                 $searchMetro.hide('slow', function () {
//                     $(this).css({'display': 'none'});
//                 });
//             });
//             break;
//         case 'historySearch':
//             var $exactArea = $('.exact-area');
//
//             setInterval(function () {
//                 var inputLocation = $('.history-text').val();
//
//                 if (inputLocation === '') {
//                     $exactArea.css({
//                         'position': 'relative',
//                         'height': '75px',
//                         'width': '37%',
//                         'display': 'inline-block'
//                     });
//                 } else {
//                     $exactArea.css({
//                         'position': 'absolute',
//                         'height': '435px',
//                         'width': '85%'
//                     });
//                 }
//             }, 1000);
//             break;
//         case '1':
//             $('.building-parameters-apartment').css({'display': 'flex'});
//             settingsApartment = $namesSettings[1];
//             break;
//         case '2':
//             $('.building-parameters-home').css({'display': 'flex'});
//             settingsApartment = $namesSettings[2];
//             break;
//         case '3':
//             $('.building-parameters-room').css({'display': 'flex'});
//             settingsApartment = $namesSettings[3];
//             break;
//         case '4':
//             $('.building-parameters-office-area').css({'display': 'flex'});
//             settingsApartment = $namesSettings[4];
//             break;
//         case '5':
//             $('.building-parameters-separate-building').css({'display': 'flex'});
//             settingsApartment = $namesSettings[5];
//             break;
//         case '6':
//             $('.building-parameters-ozs-сomplex').css({'display': 'flex'});
//             settingsApartment = $namesSettings[6];
//             break;
//         case '7':
//             $('.test-7').css({'display': 'flex'});
//             settingsApartment = $namesSettings[7];
//             break;
//         case '8':
//             $('.test-8').css({'display': 'flex'});
//             settingsApartment = $namesSettings[8];
//             break;
//         case '9':
//             $('.test-9').css({'display': 'flex'});
//             settingsApartment = $namesSettings[9];
//             break;
//         case '10':
//             $('.test-10').css({'display': 'flex'});
//             settingsApartment = $namesSettings[10];
//             break;
//         case '11':
//             $('.test-11').css({'display': 'flex'});
//             settingsApartment = $namesSettings[11];
//             break;
//         case '12':
//             $('.test-12').css({'display': 'flex'});
//             settingsApartment = $namesSettings[12];
//             break;
//         default:
//             console.log('Фильтр не настроен');
//     }
//     blockFilterAndShadow.fadeOut('slow');
// }


/** Показать больше надстроек в фильтрах **/
$('.more-settings').on('click', function () {
    $('.show-more-settings').fadeIn('slow', $(this).css({'display': 'block'}));
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
    e.preventDefault();

    $('.jq-selectbox__trigger-arrow').css({
        'background': 'url("/template/images/pointer_bottom.png") center right 5px no-repeat',
        'background-size': 'auto'
    })
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
        'width': +imagesWidth + '%',
        'height': +imagesWidth + '%'
    });
}
//---------------------------------------------------------

/** Блок предупреждения **/
function closeFixedBlock() {
    $('.warning').css({'display': 'block'})
}
//---------------------------------------------------------

$('#form_1').on('submit', function () {
    $(this).serialize();
    renderAllApartments($(this));
});

/** Получение и отправка данных через Ajax **/

$("#form_2").on('submit', function (e) {
    var form_data = $(this).serialize(); // собераем все данные из формы

    e.preventDefault();

    $.ajax({
        method: 'POST',
        url: '/search',
        data: form_data,
        dataType: 'Json',
        success: function (form_data) {
            console.log('Собранные данные', form_data);
            renderAllApartments(form_data);
        },
        error: function (form_data) {
            console.log('Ошибка отправки', form_data);
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
    $amountBefore.val('0');
    $amountAfter.val('20000');
    $amountBeforeBuy.val('0');
    $amountAfterBuy.val('20000');
    $amountBeforeSearch.val('0');
    $amountAfterSearch.val('20000');
    $("#slider-range").slider({
        range: true,
        min: 0,
        max: 20000000,
        values: [75, 20000000],
        slide: function (event, ui) {
            $amountBefore.val(ui.values[0]);
            $amountAfter.val(ui.values[1]);
        }
    });
    $("#slider-range-buy").slider({
        range: true,
        min: 0,
        max: 20000000,
        values: [75, 20000000],
        slide: function (event, ui) {
            $amountBeforeBuy.val(ui.values[0]);
            $amountAfterBuy.val(ui.values[1]);
        }
    });
    $("#slider-range-search").slider({
        range: true,
        min: 0,
        max: 20000000,
        values: [75, 20000000],
        slide: function (event, ui) {
            $amountBeforeSearch.val(ui.values[0]);
            $amountAfterSearch.val(ui.values[1]);
        }
    });
    $amountBefore.slider({values: 0});
    $amountAfter.slider({values: 1});
    $amountBeforeBuy.slider({values: 0});
    $amountAfterBuy.slider({values: 1});
    $amountBeforeSearch.slider({values: 0});
    $amountAfterSearch.slider({values: 1});
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
/*
ymaps.ready(function () {
    new ymaps.SuggestView('address', {width: 300, offset: [0, 4], results: 20});
});
*/