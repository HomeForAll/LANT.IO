var logicBoolean = false;


/** Инициализация библиотек **/
$(document).ready(function () {
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
		price = [
		{ id: 0, text: 'Цена' },
		 { id: 1, text: 'Цена2' },
		  { id: 2, text: 'Цена3' },
		  { id: 3, text: 'Цена4' },
		   { id: 4, text: 'Цена5' }
	];

$(".js-example-data-array, .region").select2({
  data: data
})
$(".js-example-data-array, .offices").select2({
  data: offices
})
$(".js-example-data-array, .price").select2({
  data: price
})

$(".js-example-data-array-selected, .region").select2({
  data: data
})
$(".js-example-data-array-selected, .offices").select2({
  data: offices
})
$(".js-example-data-array-selected, .price").select2({
  data: price
})
})
//----------------------------

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