'use strict';
var productSearch, showAndHideTopMenu, boolean = false,
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
    },
    /** Фильтры бибилотек **/
    data = [
        {id: 0, text: 'Москва и область'},
        {id: 1, text: 'Москва и область2'},
        {id: 2, text: 'Москва и область3'},
        {id: 3, text: 'Москва и область4'},
        {id: 4, text: 'Москва и область5'}
    ],
    offices = [
        {id: 0, text: 'Офис'},
        {id: 1, text: 'Офис2'},
        {id: 2, text: 'Офис3'},
        {id: 3, text: 'Офис4'},
        {id: 4, text: 'Офис5'}
    ],
    productPrice = [
        {id: 0, text: 'Цена'},
        {id: 1, text: 'Цена2'},
        {id: 2, text: 'Цена3'},
        {id: 3, text: 'Цена4'},
        {id: 4, text: 'Цена5'}
    ],
    locationApartments = [
        {id: 0, text: 'Квартира'},
        {id: 1, text: 'Квартира2'},
        {id: 2, text: 'Квартира3'},
        {id: 3, text: 'Квартира4'},
        {id: 4, text: 'Квартира5'}
    ],
    owner = [
        {id: 0, text: 'Собственник'},
        {id: 1, text: 'Собственник2'},
        {id: 2, text: 'Собственник3'},
        {id: 3, text: 'Собственник4'},
        {id: 4, text: 'Собственник5'}
    ],
    floor = [
    	{id: 0, text: 'Любой'},
    	{id: 1, text: 'Любой2'},
    	{id: 2, text: 'Любой3'},
    	{id: 3, text: 'Любой4'},
    	{id: 4, text: 'Любой5'}
    ],
    equipment = [
    	{id: 0, text: 'Комплектация'},
    	{id: 1, text: 'Комплектация2'},
    	{id: 2, text: 'Комплектация3'},
    	{id: 3, text: 'Комплектация4'},
    	{id: 4, text: 'Комплектация5'}
    ],
    designPlan = [
        {id: 0, text: 'Прилагается'},
        {id: 1, text: 'Прилагается2'},
        {id: 2, text: 'Прилагается3'},
        {id: 3, text: 'Прилагается4'},
        {id: 4, text: 'Прилагается5'}
    ],
    project = [
        {id: 0, text: 'Не важно'},
        {id: 1, text: 'Не важно2'},
        {id: 2, text: 'Не важно3'},
        {id: 3, text: 'Не важно4'},
        {id: 4, text: 'Не важно5'}
    ],
    video = [
        {id: 0, text: 'Прилагается'},
        {id: 1, text: 'Прилагается2'},
        {id: 2, text: 'Прилагается3'},
        {id: 3, text: 'Прилагается4'},
        {id: 4, text: 'Прилагается5'}
    ],
    rooms = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    aBathroom = [
        {id: 0, text: 'Выберите тип'},
        {id: 1, text: 'Выберите тип2'},
        {id: 2, text: 'Выберите тип3'},
        {id: 3, text: 'Выберите тип4'},
        {id: 4, text: 'Выберите тип5'}
    ],
    decoration = [
        {id: 0, text: 'Эксклюзивного качества'},
        {id: 1, text: 'Эксклюзивного качества2'},
        {id: 2, text: 'Эксклюзивного качества3'},
        {id: 3, text: 'Эксклюзивного качества4'},
        {id: 4, text: 'Эксклюзивного качества5'}
    ],
    wallMaterial = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    roof = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    foundation = [
        {id: 0, text: 'Без фундамента'},
        {id: 1, text: 'Без фундамента2'},
        {id: 2, text: 'Без фундамента3'},
        {id: 3, text: 'Без фундамента4'},
        {id: 4, text: 'Без фундамента5'}
    ],
    thePresenceOfAnElevator = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    nurseryServices = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    typeOfObject = [
        {id: 0, text: 'Собственность более...'},
        {id: 1, text: 'Собственность более...2'},
        {id: 2, text: 'Собственность более...3'},
        {id: 3, text: 'Собственность более...4'},
        {id: 4, text: 'Собственность более...5'}
    ],
    parkingArea = [
        {id: 0, text: 'Подземная парковка'},
        {id: 1, text: 'Подземная парковка2'},
        {id: 2, text: 'Подземная парковка3'},
        {id: 3, text: 'Подземная парковка4'},
        {id: 4, text: 'Подземная парковка5'}
    ],
    okrug = [
        {id: 0, text: 'Северо-западный'},
        {id: 1, text: 'Северо-западный2'},
        {id: 2, text: 'Северо-западный3'},
        {id: 3, text: 'Северо-западный4'},
        {id: 4, text: 'Северо-западный5'}
    ],
    area = [
        {id: 0, text: 'Северное медведково'},
        {id: 1, text: 'Северное медведково2'},
        {id: 2, text: 'Северное медведково3'},
        {id: 3, text: 'Северное медведково4'},
        {id: 4, text: 'Северное медведково5'}
    ],
    street = [
        {id: 0, text: 'Ениивмасейская'},
        {id: 1, text: 'Ениивмасейская2'},
        {id: 2, text: 'Ениивмасейская3'},
        {id: 3, text: 'Ениивмасейская4'},
        {id: 4, text: 'Ениивмасейская5'}
    ],
    distance = [
        {id: 0, text: '5 мин пешком'},
        {id: 1, text: '5 мин пешком2'},
        {id: 2, text: '5 мин пешком3'},
        {id: 3, text: '5 мин пешком4'},
        {id: 4, text: '5 мин пешком5'}
    ],
    subwayLines = [
       {id: 0, text: 'Выбрано(1)'},
       {id: 1, text: 'Выбрано(2)'},
       {id: 2, text: 'Выбрано(3)'},
       {id: 3, text: 'Выбрано(4)'},
       {id: 4, text: 'Выбрано(5)'}
    ],
    security = [
       {id: 0, text: 'Выберите'},
       {id: 1, text: 'Выберите2'},
       {id: 2, text: 'Выберите3'},
       {id: 2, text: 'Выберите4'},
       {id: 2, text: 'Выберите5'}
    ],
    documents = [
       {id: 0, text: 'Выберите'},
       {id: 1, text: 'Выберите2'},
       {id: 2, text: 'Выберите3'},
       {id: 2, text: 'Выберите4'},
       {id: 2, text: 'Выберите5'}
    ],
    propertyType = [
        {id: 0, text: 'Тип недвижимости'},
        {id: 1, text: 'Тип недвижимости2'},
        {id: 2, text: 'Тип недвижимости3'},
        {id: 2, text: 'Тип недвижимости4'},
        {id: 2, text: 'Тип недвижимости5'}
    ],
    leaseTerm = [
        {id: 0, text: 'Срок аренды'},
        {id: 1, text: 'Срок аренды1'},
        {id: 2, text: 'Срок аренды2'},
        {id: 3, text: 'Срок аренды3'},
        {id: 4, text: 'Срок аренды4'}
    ];
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

/** Библиотека select2(фильтры) **/
$('.js-example-data-array, .region').select2({
    data: data
});
$('.js-example-data-array, .offices').select2({
    data: offices
});
$('.js-example-data-array, .product-price').select2({
    data: productPrice
});
$('.js-example-data-array, .location-apartments').select2({
    data: locationApartments
});
$('.js-example-data-array, .owner').select2({
    data: owner,
    maximumInputLength: 2
});
$('.js-example-data-array, .floor').select2({
    data: floor
});
$('.js-example-data-array, .equipment').select2({
    data: equipment
});
$('.js-example-data-array, .design-plan').select2({
    data: designPlan
});
$('.js-example-data-array, .project').select2({
    data: project
});
$('.js-example-data-array, .video').select2({
    data: video
});
$('.js-example-data-array, .rooms').select2({
    data: rooms
});
$('.js-example-data-array, .a-bathroom').select2({
    data: aBathroom
});
$('.js-example-data-array, .decoration').select2({
    data: decoration
});
$('.js-example-data-array, .wall-material').select2({
    data: wallMaterial
});
$('.js-example-data-array, .roof').select2({
    data: roof
});
$('.js-example-data-array, .foundation').select2({
    data: foundation
});
$('.js-example-data-array, .the-presence-of-an-elevator').select2({
    data: thePresenceOfAnElevator
});
$('.js-example-data-array, .nursery-services').select2({
    data: nurseryServices
});
$('.js-example-data-array, .type-of-object').select2({
    data: typeOfObject
});
$('.js-example-data-array, .parking-area').select2({
    data: parkingArea
});
$('.js-example-data-array, .okrug').select2({
    data: okrug
});
$('.js-example-data-array, .area').select2({
    data: area
});
$('.js-example-data-array, .street').select2({
    data: street
});
$('.js-example-data-array, .distance').select2({
    data: distance
});
$('.js-example-data-array, .security').select2({
    data: security
});
$('.js-example-data-array, .documents').select2({
    data: documents
});
$('.js-example-data-array, .property-type').select2({
    data: propertyType
});
$('.js-example-data-array, .lease-term').select2({
    data: leaseTerm,
    maximumInputLength: 2
});
//---------------------------------------------------------
$('.js-example-data-array-selected, .region').select2({
    data: data
});
$('.js-example-data-array-selected, .offices').select2({
    data: offices
});
$('.js-example-data-array-selected, .product-price').select2({
    data: productPrice
});
$('.js-example-data-array-selected, .location-apartments').select2({
    data: locationApartments
});
$('.js-example-data-array-selected, .owner').select2({
    data: owner,
    maximumInputLength: 2
});
$('.js-example-data-array-selected, .floor').select2({
    data: floor
});
$('.js-example-data-array-selected, .equipment').select2({
    data: equipment
});
$('.js-example-data-array-selected, .design-plan').select2({
    data: designPlan
});
$('.js-example-data-array-selected, .project').select2({
    data: project
});
$('.js-example-data-array-selected, .video').select2({
    data: video
});
$('.js-example-data-array-selected, .rooms').select2({
    data: rooms
});
$('.js-example-data-array-selected, .a-bathroom').select2({
    data: aBathroom
});
$('.js-example-data-array-selected, .decoration').select2({
    data: decoration
});
$('.js-example-data-array-selected, .wall-material').select2({
    data: wallMaterial
});
$('.js-example-data-array-selected, .roof').select2({
    data: roof
});
$('.js-example-data-array-selected, .foundation').select2({
    data: foundation
});
$('.js-example-data-array-selected, .the-presence-of-an-elevator').select2({
    data: thePresenceOfAnElevator
});
$('.js-example-data-array-selected, .nursery-services').select2({
    data: nurseryServices
});
$('.js-example-data-array-selected, .type-of-object').select2({
    data: typeOfObject
});
$('.js-example-data-array-selected, .parking-area').select2({
    data: parkingArea
});
$('.js-example-data-array-selected, .okrug').select2({
    data: okrug
});
$('.js-example-data-array-selected, .area').select2({
    data: area
});
$('.js-example-data-array-selected, .street').select2({
    data: street
});
$('.js-example-data-array-selected, .distance').select2({
    data: distance
});
$('.js-example-data-array-selected, .security').select2({
    data: security
});
$('.js-example-data-array-selected, .documents').select2({
    data: documents
});
$('.js-example-data-array-selected, .property-type').select2({
    data: propertyType
});
$('.js-example-data-array-selected, .lease-term').select2({
    data: leaseTerm,
    maximumInputLength: 2
});
$(".js-example-templating, .select-price-by-scrolling").select2({
    templateResult: formatState,
    data: subwayLines
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
function showBigSearch(showBlock) {
    var $searchTeg = $('.big-search a i'),
        $bigSearch = $('.big-search'),
        $searchMenuApartment = $('.search-menu-apartment'),
        $bigSearchMenu = $('.big-search-menu'),
        $bigSearchMenuTenancy = $('.big-search-menu-tenancy');

    if (showBlock !== 'rootShowBlock') {
        return false;
    }

    $searchMenuApartment.css({'display':'none'});

    productSearch = !productSearch;

     if (!productSearch) {
        $searchTeg.remove();
        $bigSearch.html('<a>Расширенный поиск</a>' + '<i class="fa fa-angle-right" aria-hidden="true"></i>');
        $searchMenuApartment.css({'display':'block'});
        $bigSearchMenu.css({'display':'none'});
        $bigSearchMenuTenancy.css({'display':'none'});
        return productSearch = false;
    } else {
        $searchTeg.remove();
        $bigSearch.html('<i class="fa fa-angle-left" aria-hidden="true"></i>' + '<a>Простой поиск</a>');
        $bigSearchMenu.css({'display':'block'});
        $bigSearchMenuTenancy.css({'display':'none'});
        $searchMenuApartment.css({'display':'none'});
        return productSearch = true;
    }
}

function choiceBlock(allBlock) {
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
    shadowBlock();

    $propertyTypeApartmentSettings.css({'display': 'block'});
    setTimeout(function () {
        $propertyTypeApartmentSettings.css({'display': 'none'});
    }, 15000);
}

function filterOptions() {
    var $showBigOptions = $('.showBigOptions');
    shadowBlock();

    $showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 5000);
}

function apartmentSettings() {
	var $apartmentSettings = $('.apartment-settings');
	shadowBlock();

    $apartmentSettings.css({'display': 'block'});
    setTimeout(function () {
        $apartmentSettings.css({'display': 'none'});
    }, 5000);
}

function appearanceofTheApartment() {
	var $appearanceOfTheApartments = $('.appearance-of-the-apartment');
	shadowBlock();

    $appearanceOfTheApartments.css({'display': 'block'});
    setTimeout(function () {
        $appearanceOfTheApartments.css({'display': 'none'});
    }, 5000);
}

function appearanceOfTheBuilding() {
	var $appearanceOfTheBuild = $('.appearance-of-the-build');
	shadowBlock();

    $appearanceOfTheBuild.css({'display': 'block'});
    setTimeout(function () {
        $appearanceOfTheBuild.css({'display': 'none'});
    }, 5000);
}

function buildingParametersFilter() {
    var $buildingParameterFilter = $('.building-parameters-filter');
    shadowBlock();

    $buildingParameterFilter.css({'display': 'block'});
    setTimeout(function () {
        $buildingParameterFilter.css({'display': 'none'});
    }, 5000);
}

function searchMetroMainBlock() {
    var $searchMetro = $('.search-metro-main-block');
        //$closeBlock = $('.closeSearchMetro');
    shadowBlock();

    $searchMetro.css({'display': 'block'});

    setTimeout(function () {
        $searchMetro.css({'display': 'none'});
    }, 5000);

    //$closeBlock.on('click', function () {
    //    console.log('Работает');
    //    $searchMetro.css({'display': 'none'});
    //    shadowBlock();
    //})
}

function filter1() {
    var $showBigOptions = $('.apartment-settings-apartment');
    shadowBlock();

    $showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 5000);
}

function filter2() {
    var $showBigOptions = $('.apartment-settings-home');
    shadowBlock();

    $showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 5000);
}

function filter3() {
    var $showBigOptions = $('.apartment-settings-room');
    shadowBlock();

    $showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 5000);
}

function filter4() {
    var $showBigOptions = $('.apartment-settings-office-area');
    shadowBlock();

    $showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 5000);
}

function filter5() {
    var $showBigOptions = $('.apartment-settings-separate-building');
    shadowBlock();

    $showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 5000);
}

function filter6() {
    var $showBigOptions = $('.apartment-settings-ozs-сomplex');
    shadowBlock();

    $showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        $showBigOptions.css({'display': 'none'});
    }, 5000);
}

function attachment() {
    var attachmentsBlock = $('.attachments');
    shadowBlock();

    attachmentsBlock.css({'display': 'block'});
    setTimeout(function () {
        attachmentsBlock.css({'display': 'none'});
    }, 5000);
}

function historySearch() {
    var $history = $('.history-search');
    shadowBlock();

    $history.css({'display': 'block'});
    setTimeout(function () {
        $history.css({'display': 'none'});
    }, 5000);
}

function quickSearch() {
    var $quickSearchBlock = $('.quick-search');
    shadowBlock();

    $quickSearchBlock.css({'display': 'block'});
    setTimeout(function () {
        $quickSearchBlock.css({'display': 'none'});
    }, 5000);
}

/** Тени в открывшимся блоке **/
function shadowBlock() {
	var $shadowBlocks = $('.decorativeShadowBlock');

    $shadowBlocks.css({'display': 'block'});

	setTimeout(function () {
        $shadowBlocks.css({'display': 'none'});
    }, 5000);

    //boolean = !boolean;

    //if (boolean) {
    //    $shadowBlocks.css({'display': 'block'});
    //    return boolean = false;
    //} else {
    //    $shadowBlocks.css({'display': 'none'});
    //    return boolean = true;
    //}
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

$.ajax({
    url: url, //Адрес подгружаемой страницы
    type: "POST", //Тип запроса
    dataType: "json", //Тип данных
    data: $('#dataUsers').serialize(),
    beforeSend: function () {
        console.log('Отправка данных');
    },
    success: function(result) { //Если все нормально
        console.log('Отправлено: <br>', result);
    },
    error: function () {
        alert('Данные не отправлены');
    }
});
//---------------------------------------------------------