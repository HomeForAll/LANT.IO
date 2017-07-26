'use strict';
var leftBar = false;

$(document).ready(function () {

    /** Получаем данные о пользователе **/
    $.ajax({
        method: 'GET',
        url: '/api/profile/get/profile',
        dataType: 'Json',
        success: function (data) {

            if (!data) return false;

            $('input[name="name_name"]').val(data.name_name);
            $('input[name="name_patronymic"]').val(data.name_patronymic);
            $('input[name="name_surname"]').val(data.name_surname);
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

            console.log('Данные получены', data);
        },
        error: function (data) {
            console.log('Данные не получены', data);
        }
    });

    /** Получаем API для header **/
    $.getJSON("/api/user", {}, function(user) {
        if (!user) {
            $('.img-user img').attr('src', user.response.avatar_original);
            $('.profile-user a').html(user.response.name + '<img src="'+ user.response.avatar_50 +'">');
        }
    });

    $('#edit-profile').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();
        console.log('Собрали на отправку ', data);

        $.ajax({
            method: 'POST',
            url: '/api/profile/save/profile',
            dataType: 'Json',
            data: data,
            success: function (e) {
                if (data.response) {
                    console.log('Данные отправлены', data);
                    console.log('Данные отправлены - e - ', e);
                } else {
                    console.log('Ошибка', data);
                }
            },
            error: function (e) {
                console.log('Данные не отправлены', data);
                console.log('Данные не отправлены - e - ', e);
            }
        });
    });
});

$(document).ready(function () {

    /** Табы **/
    $('.user-all-information').not(':first').hide();

    $('.top-title .hash-tabs').click(function() {

        $('.top-title .hash-tabs').removeClass('active-hash').eq($(this).index()).addClass('active-hash');
        $('.user-all-information').hide().eq($(this).index()).fadeIn();

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