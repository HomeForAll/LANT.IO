'use strict';
var productSearch = false,
	showAndHideTopMenu = false;
/** Хранение данных в библиотеках **/
var data = [
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
	locationApartaments = [
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
$(".js-example-data-array, .region").select2({
  data: data
})
$(".js-example-data-array, .offices").select2({
  data: offices
})
$(".js-example-data-array, .product-price").select2({
  data: productPrice
})
$(".js-example-data-array, .location-metro").select2({
  data: locationMetro
})
$(".js-example-data-array, .location-apartments").select2({
  data: locationApartaments
})
$(".js-example-data-array, .owner").select2({
  data: owner
})
//---------------------------------------------------------
$(".js-example-data-array-selected, .region").select2({
  data: data
})
$(".js-example-data-array-selected, .offices").select2({
  data: offices
})
$(".js-example-data-array-selected, .product-price").select2({
  data: productPrice
})
$(".js-example-data-array-selected, .location-metro").select2({
  data: locationMetro
})
$(".js-example-data-array-selected, .location-apartments").select2({
  data: locationApartaments
})
$(".js-example-data-array-selected, .owner").select2({
  data: owner
})
//---------------------------------------------------------

function showBigSearch() {
	//var searchOptions = $('.big-search');

	productSearch = !productSearch;
	
	if (!productSearch) {
		$('.search-menu-apartment').css({'display':'inline-block'});
		$('.big-search-menu').css({'display':'none'});
		setTimeout(function () {
			return productSearch = false;
		}, 900);
		$('.big-search a i').remove();
		$('.big-search').html('<a>Расширенный поиск</a>' + '<i class="fa fa-angle-right" aria-hidden="true"></i>');
	} else {
		$('.search-menu-apartment').css({'display':'none'});
		$('.big-search-menu').css({'display':'inline-block'});
		setTimeout(function () {
			return productSearch = true;
		}, 900);
		$('.big-search a i').remove();
		$('.big-search').html('<i class="fa fa-angle-left" aria-hidden="true"></i>' + '<a>Простой поиск</a>');
	}
}

function showTopMenuAndSearch() {
	showAndHideTopMenu = !showAndHideTopMenu;

	if (!showAndHideTopMenu) {
		$('.user ul').css({'display':'none'});
		setTimeout(function () {
			return showAndHideTopMenu = false;
		}, 900);
	} else {
		$('.user ul').css({'display':'block'});
		setTimeout(function () {
			return showAndHideTopMenu = true;
		}, 900);
		setTimeout(function () {
			showTopMenuAndSearch();
		}, 6500);
	}
}