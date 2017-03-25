'use strict';
var productSearch = false,
    showAndHideTopMenu = false,
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
    locationMetro = [
        {id: 0, text: 'Третьяковская'},
        {id: 1, text: 'Третьяковская2'},
        {id: 2, text: 'Третьяковская3'},
        {id: 3, text: 'Третьяковская4'},
        {id: 4, text: 'Третьяковская5'}
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
$('.js-example-data-array, .location-metro').select2({
    data: locationMetro
});
$('.js-example-data-array, .location-apartments').select2({
    data: locationApartments
});
$('.js-example-data-array, .owner').select2({
    data: owner
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
$('.js-example-data-array-selected, .location-metro').select2({
    data: locationMetro
});
$('.js-example-data-array-selected, .location-apartments').select2({
    data: locationApartments
});
$('.js-example-data-array-selected, .owner').select2({
    data: owner
});
//---------------------------------------------------------

function showBigSearch() {
    var searchTeg = $('.big-search a i'),
        bigSearch = $('.big-search');

    productSearch = !productSearch;

    if (!productSearch) {
        $('.search-menu-apartment').css({'display': 'inline-block'});
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

function filterOptions() {
    var showBigOptions = $('.showBigOptions, .decorativeShadowBlock');

    showBigOptions.css({'display': 'block'});
    setTimeout(function () {
        showBigOptions.css({'display': 'none'});
    }, 6500);
}

function filterOptionsApartments() {
    var propertyTypeApartmentSettings = $('.property-type-apartment-settings, .decorativeShadowBlock');

    propertyTypeApartmentSettings.css({'display': 'block'});
    setTimeout(function () {
        propertyTypeApartmentSettings.css({'display': 'none'});
    }, 6500);
}

$('.select2-selection--single').on('click', function () {
    $(this).css({
        'background': 'url("../../template/images/pointer_bottom.png") right 5px center no-repeat #fff',
        'background-size': 'auto'
    });
    setTimeout(function () {
        $(this).css({
            'background': 'url("../../template/images/pointer_top.png") right 5px center no-repeat #fff',
            'background-size': 'auto'
        });
    }, 6500);
});