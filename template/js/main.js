var logicBoolean = false,
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
	 { id: 1, text: 'Третьяковская' },
	  { id: 2, text: 'Третьяковская' },
	  { id: 3, text: 'Третьяковская' },
	   { id: 4, text: 'Третьяковская' }
	],
	locationApartaments = [
	{ id: 0, text: 'Квартира'},
	 { id: 1, text: 'Квартира' },
	  { id: 2, text: 'Квартира' },
	  { id: 3, text: 'Квартира' },
	   { id: 4, text: 'Квартира' }
	],
	owner = [
	{ id: 0, text: 'Собственник'},
	 { id: 1, text: 'Собственник' },
	  { id: 2, text: 'Собственник' },
	  { id: 3, text: 'Собственник' },
	   { id: 4, text: 'Собственник' }
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

	logicBoolean = !logicBoolean;

	if (!logicBoolean) {
		console.log(logicBoolean);
		return logicBoolean = false;
	} else {
		console.log(logicBoolean);
		return logicBoolean = true;
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