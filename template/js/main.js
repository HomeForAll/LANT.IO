'use strict';
var productSearch = false,
    showAndHideTopMenu = false,
    logicBooleanSpan = false,
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
    ];
//---------------------------------------------------------

$(function () {
    var amountBefore = $('#amountBefore'),
        amountAfter = $('#amountAfter');

    /** Фильтры в доп.параметрах **/
    amountBefore.val('20000');
    amountAfter.val('20000');
    $("#slider-range").slider({
        range: true,
        min: 20000,
        max: 20000000,
        values: [75, 300],
        slide: function (event, ui) {
            $("#amountBefore").val(ui.values[0]);
            $("#amountAfter").val(ui.values[1]);
        }
    });
    $('#amount').val(amountBefore.slider("values", 0) + amountAfter.slider("values", 1));
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
//---------------------------------------------------------

/** Отслежка и изменение расширенного и простого блока **/
function showBigSearch() {
    var searchTeg = $('.big-search a i'),
        bigSearch = $('.big-search');

    productSearch = !productSearch;

    if (!productSearch) {
        $('.search-menu-apartment').css({'display': 'block'});
        $('.big-search-menu').css({'display': 'none'});
        searchTeg.remove();
        bigSearch.html('<a>Расширенный поиск</a>' + '<i class="fa fa-angle-right" aria-hidden="true"></i>');
        return productSearch = false;
    } else {
        $('.search-menu-apartment').css({'display': 'none'});
        $('.big-search-menu').css({'display': 'inline-block'});
        searchTeg.remove();
        bigSearch.html('<i class="fa fa-angle-left" aria-hidden="true"></i>' + '<a>Простой поиск</a>');
        return productSearch = true;
    }
}

/** Header меню **/
function showTopMenuAndSearch() {
    var user = $('.user ul');

    showAndHideTopMenu = !showAndHideTopMenu;

    if (!showAndHideTopMenu) {
        user.css({'display': 'none'});
        showAndHideTopMenu = false;
    } else {
        user.css({'display': 'block'});
        showAndHideTopMenu = true;
    }
}
//---------------------------------------------------------
/** Блоки с фильтрами **/
function filterOptionsApartments() {
    var propertyTypeApartmentSettings = $('.property-type-apartment-settings, .decorativeShadowBlock');

    propertyTypeApartmentSettings.css({'display': 'block'});
    setTimeout(function () {
        propertyTypeApartmentSettings.css({'display': 'none'});
    }, 5000);
}

function filterOptions() {
    var showBigOptions = $('.showBigOptions, .decorativeShadowBlock');

    showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        showBigOptions.css({'display': 'none'});
    }, 5000);
}

function apartmentSettings() {
	var apartmentSettings = $('.apartment-settings, .decorativeShadowBlock');

    apartmentSettings.css({'display': 'block'});
    setTimeout(function () {
        apartmentSettings.css({'display': 'none'});
    }, 5000);
}

function searchMetroMainBlock() {
    var searchMetro = $('.search-metro-main-block, .decorativeShadowBlock');

    searchMetro.css({'display': 'block'});
    setTimeout(function () {
        searchMetro.css({'display': 'none'});
    }, 10000);
}

function attachment() {
    var attachmentsBlock = $('.attachments, .decorativeShadowBlock');

    attachmentsBlock.css({'display': 'block'});
    setTimeout(function () {
        attachmentsBlock.css({'display': 'none'});
    }, 5000);
}

$('.select2-selection--single').on('click', function () {
	logicBooleanSpan = !logicBooleanSpan;

	if(!logicBooleanSpan) {
		$(this).css({
            'background': 'url("../../template/images/pointer_bottom.png") right 5px center no-repeat #fff',
            'background-size': 'auto'
        });
		return logicBooleanSpan = false;
	} else {
		$(this).css({
        	'background': 'url("../../template/images/pointer_top.png") right 5px center no-repeat #fff',
        	'background-size': 'auto'
   		});
		return logicBooleanSpan = true;
	}
});
//---------------------------------------------------------

function moreAndLess(sizeImage) {
   var img = $('.metro-location img');

    valueButton[sizeImage]();

    if (imagesWidth > 150) {
        return imagesWidth = 150;
    }
    if (imagesWidth < 100) {
        return imagesWidth = 100;
    }

    img.css({'width': + imagesWidth + '%'});
}

function closeFixedBlock() {
	$('.warning').css({'display':'none'})
}