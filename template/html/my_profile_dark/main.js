'use strict';
var leftBar = false;

$(document).ready(function () {

    /** Получаем API для header **/
    $.getJSON("/api/user", {}, function(user) {

        $('.img-user').css({
            'background': 'url("'+ user.response.avatar_original +'") no-repeat center',
            'background-size': 'cover'
        });
    });

    /** Получаем данные о пользователе **/
    $.ajax({
        method: 'GET',
        url: '/api/profile/get/profile',
        dataType: 'Json',
        success: function (data) {

            console.log('data', data);

            if (data.status !== 1) return false;

            $('input[name="name_birthday"]').val(data.name_birthday);
            $('input[name="passport_series"]').val(data.passport_series);
            $('input[name="passport_number"]').val(data.passport_number);
            $('input[name="adress_index"]').val(data.adress_index);
            $('input[name="adress_city"]').val(data.adress_city);
            $('input[name="adress_street"]').val(data.adress_street);
            $('input[name="adress_home"]').val(data.adress_home);
            $('input[name="adress_flat"]').val(data.adress_flat);
            $('input[name="contacts_number"]').val(data.contacts_number);
            $('input[name="contacts_email"]').val(data.contacts_email);
        },
        error: function (data) {
            console.log('Данные не получены', data);
        }
    });

    /** Всплывающее меню **/
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

    })

});