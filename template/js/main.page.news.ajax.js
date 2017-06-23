/** Ajax запрос для блока "Лучшие объявления за 24 часа" **/
$(document).ready(function () {
    //
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
            'Недвижимость для туризма и отдыха': 0,
        };
        object_type = namesSettings[object_type];
        if (typeof object_type !== "undefined") {
            filterResult += '&object_type=' + object_type;
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
        topAdsAjaxSender(filterResult);
    };

        function topAdsAjaxSender(filterResult) {
            $.ajax({
                url: "/",
                method: 'POST',
                dataType: 'json',
                data: filterResult,
                success: function (data) {

                    $('.top-block').remove();
                    $('.see-more').empty();

                    if (typeof data.best_news !== "undefined") {
                        $.each(data.best_news, function (i, news) {

                            var topBlock = $('<div/>', {
                                'class': "top-block"
                            }).appendTo($('.all-apartments-top'));
                            var leftWallpaper = $('<div/>', {
                                'class': "left-wallpaper"
                            }).appendTo(topBlock);
                            var a = $('<a/>', {
                                'href': "#"
                            }).appendTo(leftWallpaper);
                            $('<img/>', {
                                'src': '/uploads/images/s_' + news.preview_img[0],
                                'alt': news.title
                            }).appendTo(a);
                            $('<p/>', {
                                'html': news.short_explanation
                            }).appendTo(leftWallpaper);
                            var rightInformationBlock = $('<div/>', {
                                'class': "right-information-block"
                            }).appendTo(topBlock);
                            $('<span/>', {
                                'html': news.title
                            }).appendTo(rightInformationBlock);
                            $('<p/>', {
                                'html': news.content
                            }).appendTo(rightInformationBlock);
                            var priceAndViewTheApartment = $('<div/>', {
                                'class': 'price-and-view-the-apartment'
                            }).appendTo(rightInformationBlock);
                            var price = $('<div/>', {
                                'class': 'price'
                            }).appendTo(priceAndViewTheApartment);
                            if (typeof news.metro_station !== "undefined" && news.metro_station !== null) {
                                var p = $('<p/>', {
                                    'html': '<img src="../../template/images/m.png" alt="metro">' + news.metro_station
                                    + '<span><img src="../../template/images/people.png" alt="">' + news.time_walk + ' мин</span>'
                                }).appendTo(price);
                            }

                            $('<span/>', {
                                'class': 'decorate-number',
                                'html': news.price + '<i class="fa fa-rub" aria-hidden="true"></i><sub>/' +
                                news.lease + '</sub>'
                            }).appendTo(price);

                            var viewTheApartment = $('<div/>', {
                                'class': 'view-the-apartment'
                            }).appendTo(priceAndViewTheApartment);

                            $('<button/>', {
                                'class': 'open-close-ad',
                                'html': '<img src="../../template/images/show.png" alt="show">'
                            }).appendTo(viewTheApartment);
                        });
                    }

                    var seeMore = $('.see-more');

                    if (typeof data.best_news_number !== "undefined" && data.best_news_number != 0) {
                        if (data.best_news_number <= 9) {
                            $('<p/>', {
                                'text': "Всего " + data.best_news_number + ' ' + data.best_news_number_ending
                            }).appendTo(seeMore);
                        } else {
                            $('<p/>', {
                                'text': "Ещё " + data.best_news_number + ' ' + data.best_news_number_ending
                            }).appendTo(seeMore);
                            $('<a/>', {
                                'href': '#',
                                'text': "Смотреть все"
                            }).appendTo(seeMore);
                        }

                    } else {
                        $('<p/>', {
                            'text': "К сожалению, ничего не найдено."
                        }).appendTo(seeMore);
                    }

                }
            });
        };


    $(".top-apartments .filter-apartment select").on('change', topAdsAjaxHandler);
    $(".closeCurrency").on('click', topAdsAjaxHandler);
    $(".property-type-apartment-settings").on('click', topAdsAjaxHandler);
    topAdsAjaxSender('action=top_apartments&object_type=1');

});
