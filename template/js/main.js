'use strict';
var productSearch = false,
    showAndHideTopMenu = false,
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
    ];
//---------------------------------------------------------

/** Фильтр - Цена **/
$(function () {
    var $amountBefore = $('#amountBefore'),
        $amountAfter = $('#amountAfter');

    /** Фильтры в доп.параметрах **/
    $amountBefore.val('20000');
    $amountAfter.val('20000');
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
    $('#amount').val($amountBefore.slider('values', 0) + $amountAfter.slider('values', 1));
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
    data: owner
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
    data: owner
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
$(".js-example-templating, .select-price-by-scrolling").select2({
    templateResult: formatState,
    data: subwayLines
});
//---------------------------------------------------------

/** Слайдер **/
$(document).ready(function(){
  $('.bxslider').bxSlider({
  		slideWidth: 500,
   		minSlides: 1,
   		maxSlides: 2,
   		moveSlides: 2,
   		slideMargin: 10,
   		pager: false
  });
});
$(document).ready(function(){
  $('.bxslider-partners').bxSlider({
  		slideWidth: 150,
   		minSlides: 1,
   		maxSlides: 5,
   		moveSlides: 5,
   		slideMargin: 50,
   		pager: false
  });
});

//---------------------------------------------------------

function formatState (state) {
    var $state = $('<span><a class="branch-line"></a>' + state.text + '</span>'),
    data = [],
    $a = $state.find('a');

    data.push($a);

    //$a.css({'background':'red'});
    //console.log(subwayLines[2]);

    //subwayLines[2].find('a').css({'background':'red'});

    //console.log('Все найденные теги -', $a);
    //console.log('Массив -', data);

    $a.each(function (i) {
        console.log('Each - ',i);
        switch (i) {
            case 0 :
                console.log('0');
                $a.css({'background':'red'});
                break;
            case 1 :
                console.log('1');
                $a.css({'background':'orange'});
                break;
            case 2 :
                console.log('2');
                $a.css({'background':'blue'});
                break;
            case 3 :
                console.log('3');
                $a.css({'background':'green'});
                break;
            case 4 :
                console.log('4');
                $a.css({'background':'yellowgreen'});
                break;
            default :
                $a.css({'background':'silver'});
                break;
        }
    });

    if (!state.id) {
        return state.text;
    }

    return $state;
}

//---------------------------------------------------------

/** Отслежка и изменение расширенного и простого блока **/
function showBigSearch() {
    var $searchTeg = $('.big-search a i'),
        $bigSearch = $('.big-search'),
        $searchMenuApartment = $('.search-menu-apartment'),
        $bigSearchMenu = $('.big-search-menu');

    productSearch = !productSearch;

    if (!productSearch) {
        $searchMenuApartment.css({
            'display': 'block'
        });
        $bigSearchMenu.css({
            'display': 'none'
        });
        $searchTeg.remove();
        $bigSearch.html('<a>Расширенный поиск</a>' + '<i class="fa fa-angle-right" aria-hidden="true"></i>');
        return productSearch = false;
    } else {
        $searchMenuApartment.css({
            'display': 'none'
        });
        $bigSearchMenu.css({
            'display': 'inline-block'
        });
        $searchTeg.remove();
        $bigSearch.html('<i class="fa fa-angle-left" aria-hidden="true"></i>' + '<a>Простой поиск</a>');
        return productSearch = true;
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
    }, 5000);
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
    shadowBlock();

    $searchMetro.css({'display': 'block'});
    setTimeout(function () {
        $searchMetro.css({'display': 'none'});
    }, 10000);
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
	$('.warning').css({'display':'none'})
}