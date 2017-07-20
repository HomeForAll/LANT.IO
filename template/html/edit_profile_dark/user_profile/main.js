'use strict';
var leftBar = false;

$(document).ready(function () {

    /** Получаем данные о пользователе **/
    $.ajax({
        method: 'GET',
        url: 'api/profile/save/settings',
        dataType: 'Json',
        success: function (e) {
            console.log('result - success', e);
        },
        error: function (e) {
            console.log('result - error', e);
        }
    }).done(function (e) {
        if(error) {
            console.log('Мы незарегистрированы', e);
            return false;
        }

        console.log('Мы зарегистрированы', e);
    });
});

$(document).ready(function () {

    /** Табы **/
    $('.user-all-information').not(':first').hide();

    $('.top-title .hash-tabs').click(function() {

        $('.top-title .hash-tabs').removeClass('active-hash').eq($(this).index()).addClass('active-hash');
        $('.user-all-information').hide().eq($(this).index()).fadeIn()

    }).eq(0).addClass('active-hash');

    /** Левый бар **/
    $('.close').on('click', function () {

        leftBar = !leftBar;

        $(this).find('a').empty();

        if (leftBar) {
            $('.left-bar').fadeIn();
            $(this).find('a').append('<i class="fa fa-angle-left" aria-hidden="true"></i>Назад');
        } else {
            $('.left-bar').fadeOut();
            $(this).find('a').append('Открыть<i class="fa fa-angle-right" aria-hidden="true"></i>');
        }

    });
});