$(document).ready(function () {
    //Ограничение меню добавления новостей
    $('#show_news').submit(function () {
        var opt1 = $('#space_type').val();
        var opt2 = $('#operation_type').val();
        var opt3 = $('#object_type').val();
        if (typeof form_options_menu[opt1][opt2][opt3] === "undefined") {
            alert('Данной опции не существует!');
            return false;
        }
    });
    // Добавление поля hidden при изменении status
    var changeStatus = function () {
        var hidName = ($(this).attr('name'));
        hidName = hidName.substr(7);
        $(this).after('<input type="hidden" name="change_status_' + hidName + '" value="' + hidName + '">');
    };
    // Добавление поля hidden при изменении rating_admin
    var changeRatingAdmin = function () {
        var hidName = ($(this).attr('name'));
        hidName = hidName.substr(13);
        $(this).after('<input type="hidden" name="change_rating_' + hidName + '" value="' + hidName + '">');
    };

    //Ajax запрос + вывод таблицы + page меню
    var sendAjaxNewsSearch = function (formResult) {
        $.ajax({
            url: "/admin/news",
            method: 'POST',
            dataType: 'json',
            data: formResult,
            success: function (data) {
                if (typeof data.news_number !== "undefined") {
                    $('#status_pages').text('Всего объявлений:' + data.news_number + ' ');
                    for (i = 1; i <= data.news_number; i = i + data.one_page) {
                        var i_end = i + data.one_page - 1;
                        if (i_end > data.news_number) i_end = data.news_number;
                        if (i == (data.offset + 1)) {
                            $('<b/>', {
                                'text': ' [' + i + '-' + i_end + '] ',
                            }).appendTo($('#status_pages'));
                        } else {
                            $('<a/>', {
                                'class': "status_page",
                                'href': i,
                                'text': ' [' + i + '-' + i_end + '] ',
                            }).appendTo($('#status_pages'));
                        }
                    }

                    $('.status_frm_data').remove();

                    $.each(data.news, function (i, news) {
                        var tr = $('<tr/>', {
                            'class': 'status_frm_data id_' + news.id_news,
                            'align': 'center'
                        }).appendTo($('#status_frm_table'));

                        $('<td/>').html(news.id_news).appendTo(tr);
                        $('<td/>').html(news.date).appendTo(tr);
                        $('<td/>').html('<a href="/news/editor/' + news.id_news + '" >' + news.title + '</a>').appendTo(tr);
                        $('<td/>').html(news.user_id).appendTo(tr);
                        $('<td/>').html(news.space_type).appendTo(tr);
                        $('<td/>').html(news.operation_type).appendTo(tr);
                        $('<td/>').html(news.object_type).appendTo(tr);
                        var stat1 = $('<input/>', {
                            'type': "radio",
                            'class': "status",
                            'name': 'status_' + news.id_news,
                            'value': "1"
                        });
                        $('<td/>').html(stat1).appendTo(tr);
                        var stat2 = $('<input/>', {
                            'type': "radio",
                            'class': "status",
                            'name': 'status_' + news.id_news,
                            'value': "2"
                        });
                        $('<td/>').html(stat2).appendTo(tr);
                        $('<td/>').html(news.rating_views).appendTo(tr);
                        var ratingAdmin = $('<select/>', {
                            class: "rating_admin",
                            name: 'rating_admin_' + news.id_news
                        });
                        for (var j = 0; j < 10; j++) {
                            $('<option/>', {
                                'value': j,
                                'text': j
                            }).appendTo(ratingAdmin);
                        }
                        $('<td/>').html(ratingAdmin).appendTo(tr);
                        $('<td/>').html(news.rating_donate).appendTo(tr);
                        $('<td/>').html(news.rating_real).appendTo(tr);
                        var statDel = $('<input/>', {
                            'type': "radio",
                            'class': "status",
                            'name': 'status_' + news.id_news,
                            'value': "3"
                        });
                        $('<td/>').html(statDel).appendTo(tr);
                        //простановка чекбоксов
                        if (news.status == 1) {
                            stat1.attr('checked', true);
                        } else {
                            stat2.attr('checked', true);
                        }
                        $('select[name="rating_admin_' + news.id_news + '"] option[value='
                            + news.rating_admin + ']').attr('selected', 'true');
                    });
                }
                $(".status").on('change', changeStatus);
                $(".rating_admin").on('change', changeRatingAdmin);
                $(".status_page").on('click', statusPageAjax);
            }
        });
    };

    //Ajax запрос для кнопки Показать объявления
    $("#submit_show_news").click(function (e) {
        e.preventDefault();
        var formResult = 'action=news_search&' + $('#show_news').serialize();
        sendAjaxNewsSearch(formResult);
    });

    //Ajax выбор сортировки
    $("input[name=sorting]").change(function (e) {
        var sorting = $('input[name=sorting]:checked').val();
        var formResult = 'action=news_search&sorting=' + sorting + '&' + $('#show_news').serialize();
        sendAjaxNewsSearch(formResult);
    });

    //Ajax запрос для статуса
    var sendAjaxStatusFrm = function (formResult) {
        $.ajax({
            url: "/admin/news",
            method: 'POST',
            dataType: 'json',
            data: formResult,
            success: function (data) {
                //Удаление старых сообщений
                $('#news_message').empty();
                $('#news_error').empty();
                //Вывод сообщений
                if (typeof data.news_message !== "undefined") {
                    $('#news_message').append('<p>' + data.news_message + '</p>');
                }
                if (typeof data.news_error !== "undefined") {
                    $('#news_error').append('<p>' + data.news_error + '</p>');
                }
                if (typeof data.news_delete_id !== "undefined") {
                    $.each(data.news_delete_id, function (i, id) {
                        $('.id_' + id).remove();
                    });
                }
                //Удаление скрытых input
                $('#status_frm input[type=hidden]').remove();
            }
        });
    };

    //Ajax запрос для изменения статуса
    $("#submit_status").click(function (e) {
        e.preventDefault();
        var formResult = 'action=submit_status&' + $('#status_frm').serialize();
        sendAjaxStatusFrm(formResult);
    });

    //Ajax ссылки страниц
    var statusPageAjax = function (e) {
        e.preventDefault();
        var sorting = $('input[name=sorting]:checked').val();
        var formResult = 'action=news_search&offset=' + ($(this).attr('href') - 1) + '&sorting=' + sorting + '&' + $('#show_news').serialize();
        sendAjaxNewsSearch(formResult);
    };

    //Вызов и построение первоначальной таблицы
    $("#submit_show_news").trigger('click');

});
