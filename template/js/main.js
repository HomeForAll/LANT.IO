'use strict';
var productSearch = false,
    filterOptionsBoolean = false,
	showAndHideTopMenu = false,
	pointer = false,
/** Фильтры бибилотек **/
	data = [
	{ id: 0, text: 'Москва и область' },
	 { id: 1, text: 'Москва и область2' },
	  { id: 2, text: 'Москва и область3' },
	   { id: 3, text: 'Москва и область4' },
	    { id: 4, text: 'Москва и область5' }
	],
	offices = [
	{ id: 0, text: 'Офис' },
	 { id: 1, text: 'Офис2' },
	  { id: 2, text: 'Офис3' },
	   { id: 3, text: 'Офис4' },
	    { id: 4, text: 'Офис5' }
	],
	productPrice = [
	{ id: 0, text: 'Цена' },
	 { id: 1, text: 'Цена2' },
	  { id: 2, text: 'Цена3' },
	   { id: 3, text: 'Цена4' },
	    { id: 4, text: 'Цена5' }
	],
	locationMetro = [
	{ id: 0, text: 'Третьяковская'},
	 { id: 1, text: 'Третьяковская2' },
	  { id: 2, text: 'Третьяковская3' },
	   { id: 3, text: 'Третьяковская4' },
	    { id: 4, text: 'Третьяковская5' }
	],
	locationApartments = [
	{ id: 0, text: 'Квартира'},
	 { id: 1, text: 'Квартира2' },
	  { id: 2, text: 'Квартира3' },
	   { id: 3, text: 'Квартира4' },
	    { id: 4, text: 'Квартира5' }
	],
	owner = [
	{ id: 0, text: 'Собственник'},
	 { id: 1, text: 'Собственник2' },
	  { id: 2, text: 'Собственник3' },
	   { id: 3, text: 'Собственник4' },
	    { id: 4, text: 'Собственник5' }
	];
//---------------------------------------------------------

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

/** Фильтры в доп.параметрах **/
 $(function() {
     var amountBefore = $('#amountBefore'),
         amountAfter = $('#amountAfter');

     amountBefore.val('20000');
     amountAfter.val('20000');
    $("#slider-range").slider({
      range: true,
      min: 20000,
      max: 20000000,
      values: [75, 300],
      slide: function(event, ui) {
        $("#amountBefore").val(ui.values[0]);
        $("#amountAfter").val(ui.values[1]);
      }
    });
    $('#amount').val(amountBefore.slider("values", 0) + amountAfter.slider("values", 1 ));
  });
//---------------------------------------------------------

function showBigSearch() {

	productSearch = !productSearch;
	
	if (!productSearch) {
		$('.search-menu-apartment').css({'display':'inline-block'});
		$('.big-search-menu').css({'display':'none'});
		return productSearch = false;
		$('.big-search a i').remove();
		$('.big-search').html('<a>Расширенный поиск</a>' + '<i class="fa fa-angle-right" aria-hidden="true"></i>');
	} else {
		$('.search-menu-apartment').css({'display':'none'});
		$('.big-search-menu').css({'display':'inline-block'});
		return productSearch = true;
		$('.big-search a i').remove();
		$('.big-search').html('<i class="fa fa-angle-left" aria-hidden="true"></i>' + '<a>Простой поиск</a>');
	}
}

function showTopMenuAndSearch() {

	showAndHideTopMenu = !showAndHideTopMenu;

	if (!showAndHideTopMenu) {
		$('.user ul').css({'display':'none'});
        return showAndHideTopMenu = false;
	} else {
		$('.user ul').css({'display':'block'});
        return showAndHideTopMenu = true;
	}
}

function filterOptions() {

    filterOptionsBoolean = !filterOptionsBoolean;

	if (!filterOptionsBoolean) {
		$('.showBigOptions').css({'display':'none'});
		$('.decorativeShadowBlock').css({'display':'none'});
        return filterOptionsBoolean = false;
	} else {
		$('.showBigOptions').css({'display':'block'});
		$('.decorativeShadowBlock').css({'display':'block'});
        return filterOptionsBoolean = true;
	}
}

$('.select2-selection--single').on('click', function () {

    pointer = !pointer;

    if(pointer) {
        $(this).css({
            'background':'url("../../template/images/pointer_top.png") right center no-repeat',
            'background-size': 'auto'
        });
        return pointer = true;
    } else {
        $(this).css({
            'background':'url("../../template/images/pointer_bottom.png") right center no-repeat',
            'background-size': 'auto'
        });
        return pointer = false;
    }
});

$('.filter-block-big-menu label').on('click', function () {

    pointer = !pointer;

    if(pointer) {
        $(this).css({
            'background':'url("../../template/images/pointer_top.png") right 15px center no-repeat',
            'background-size': 'auto'
        });
        return pointer = true;
    } else {
        $(this).css({
            'background':'url("../../template/images/pointer_bottom.png") right 15px center no-repeat',
            'background-size': 'auto'
        });
        return pointer = false;
    }
});