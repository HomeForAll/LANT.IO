$(document).ready(function () {



    //Ajax запрос + вывод объявлений + page меню
    var sendAjaxNewsListSearch = function (formResult) {
        $.ajax({
            url: "/news",
            method: 'POST',
            dataType: 'json',
            data: formResult,
            success: function (data) {
                if (typeof data.news_number !== "undefined") {
                    $('#news_pages').text('Всего объявлений:' + data.news_number + ' ');
                    //Постраничная навигация
                    for (i = 1; i <= data.news_number; i = i + data.max_number) {
                        var i_end = i + data.max_number - 1;
                        if (i_end > data.news_number) i_end = data.news_number;
                        if (i == (data.offset + 1)) {
                            //текущая страница
                            $('<b/>', {
                                'text': ' [' + i + '-' + i_end + '] ',
                            }).appendTo($('#news_pages'));
                        } else {
                            if ((i == 1)
                                || (i_end == data.news_number)
                                || (i == (data.offset + 1) + data.max_number)
                                || (i == (data.offset + 1) - data.max_number)
                            ){
                                $('<a/>', {
                                    'class': "news_page",
                                    'href': i,
                                    'text': ' [' + i + '-' + i_end + '] ',
                                }).appendTo($('#news_pages'));
                            }else if((i == (data.offset + 1) + 2*data.max_number)
                                || (i == (data.offset + 1) - 2*data.max_number)
                            ){
                                $('<span/>', {
                                    'text':'...'
                                }).appendTo($('#news_pages'));
                            }
                        }
                    }

                    $('#news_list .news').remove();

                    $.each(data.news, function (i, news) {
                        var div = $('<div/>', {
                            'class': 'news'
                        }).appendTo($('#news_list'));

                        var a = $('<a/>', {
                            'href': '/news/' + news.id_news,
                            'style': 'background-image : url(/uploads/images/s_' + news.preview_img[0] + ')'
                        }).appendTo(div);
                        var span = $('<span/>').appendTo(a);
                        $('<h3/>', {
                            'text': news.title
                        }).appendTo(span);

                        $('<div/>', {
                            'class': 'news_content',
                            'text': news.content
                        }).appendTo(div);
                        $('<div/>', {
                            'class': 'news_date',
                            'text': ' Дата : ' + news.date
                        }).appendTo(div);
                        if (typeof news.author_name !== "undefined") {
                            $('<div/>', {
                                'class': 'news_author_name',
                                'text': ' Автор : ' + news.author_name
                            }).appendTo(div);
                        }

                        $('<div/>', {
                            'class': 'news_space_type',
                            'text': news.space_type + '-' + news.operation_type + '-' + news.object_type
                        }).appendTo(div);
                        if (typeof news.metro_station !== "undefined" && news.metro_station !== null) {
                            $('<div/>', {
                                'class': 'metro_station',
                                'text': 'Метро: ' + news.metro_station
                            }).appendTo(div);
                        }
                        if (typeof news.tags !== "undefined") {
                            $('<div/>', {
                                'class': 'news_tags',
                                'text': ' Метки : ' + news.tags
                            }).appendTo(div);
                        }

                    });
                }
                $(".news_page").on('click', newsListPageAjax);

            }
        });
    };

    //Ajax запрос для кнопки Показать объявления
    $("#watch_news_list").submit(function (e) {
        e.preventDefault();
        var formResult = 'action=watch_news_list&offset=0&' + $('#watch_news_list').serialize();
        sendAjaxNewsListSearch(formResult);
    });


    //Ajax ссылки страниц
    var newsListPageAjax = function (e) {
        e.preventDefault();
        //  var sorting = $('input[name=sorting]:checked').val();
        var formResult = 'action=watch_news_list&offset=' + ($(this).attr('href') - 1) + '&' + $('#watch_news_list').serialize();
        sendAjaxNewsListSearch(formResult);
    };

    $(".news_page").on('click', newsListPageAjax);
    $("#watch_news_list").trigger('submit');


});
