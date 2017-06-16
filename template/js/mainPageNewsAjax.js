/** Ajax запрос для блока "Лучшие объявления за 24 часа" **/
$(document).ready(function () {
    function topAdsAjaxHandler(e) {
        e.preventDefault();
        var filterResult = 'action=top_apartments';
        //Тип объекта
        var object_type = $('.filter-and-top-blocks .value-text').text();
        var namesSettings = {
            'Квартира': 1,
            'Дом': 12,
            'Комната': 11,
            'Офисная площадь': 2,
            'Отдельно стоящее здание': 9,
            'Комплекс ОСЗ': 8,
            'Земельный участок': 14,
            'Гараж/машиноместо': 13,
            'Рынок/Ярмарка': 7,
            'Производственно-складские помещения': 6,
            'Производственно-складские здания': 5,
            'Недвижимость для туризма и отдыха': 0
        };
        object_type = namesSettings[object_type];
        if (typeof object_type !== "undefined") {
            filterResult += '&object_type='+object_type;
        }
        //Цена
        var price_from = $('#amountBeforeBy').val();
        var price_to = $('#amountAfterBy').val();
        filterResult += '&price_from=' + price_from + '&price_to=' + price_to;
        // Площадь
        if ($(".top-apartments .filter-apartment select").val() !== "") {
            var space_arr = ($(".top-apartments .filter-apartment select").val()).split('-');
            filterResult += '&space_from=' + space_arr[0];
            if (typeof space_arr[1] !== "undefined") {
                filterResult += '&space_to=' + space_arr[1];
            }
        }

        $.ajax({
            url: "/",
            method: 'POST',
            data: filterResult,
            success: function (data) {
                $( ".top-apartments .filter-and-top-blocks .all-apartments-top" ).remove();
                $( ".top-apartments .filter-and-top-blocks .see-more" ).remove();
                $(".top-apartments .filter-and-top-blocks").append($(data));
            }
        });
    }

    $(".top-apartments .filter-apartment select").on('change', topAdsAjaxHandler);
    $(".closeCurrency").on('click', topAdsAjaxHandler);
    $(".property-type-apartment-settings").on('click', topAdsAjaxHandler);

});
