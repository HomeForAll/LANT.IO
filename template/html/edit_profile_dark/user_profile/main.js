'use strict';
var leftBar = false;

/** Двух этапная аутентификация **/
function authenticator() {
    $.ajax({
        method: 'GET',
        url: '/api/authenticator/create/secret',
        dataType: 'Json',
        success: function (data) {

            console.log('data.response - ', data.response);

            var mainSearchAuthenticator = document.createElement('div'),
                title = document.createElement('div'),
                imageKey = document.createElement('img'),
                key = document.createElement('input'),
                keyHidden = document.createElement('input'),
                submitBtn = document.createElement('button');

            mainSearchAuthenticator.className = 'authenticator-cl';

            title.innerHTML = 'Введите код<i class="fa fa-times" onclick="$(function() {$(\'.search-authenticator\').remove();})" aria-hidden="true"></i>';
            submitBtn.innerHTML = 'Отправить';

            imageKey.setAttribute('src', data.response.qr_img_url);
            key.setAttribute('placeholder', 'Проверочный код');
            key.setAttribute('type', 'text');

            keyHidden.value = data.response.code;
            key.value = data.response.secret_key;

            submitBtn.onclick = function () {
                $.ajax({
                    method: 'POST',
                    url: '/api/authenticator/save',
                    data: {
                        secret_key: key.value,
                        code: keyHidden.value
                    },
                    dataType: 'Json',
                    success: function () {
                        console.log('secret_key - ', key.value);
                        console.log('code - ', keyHidden.value);
                    }
                })
            };

            mainSearchAuthenticator.className = 'search-authenticator';

            $('.content').prepend(mainSearchAuthenticator);
            mainSearchAuthenticator.append(title, imageKey, keyHidden, key, submitBtn);
        },
        error: function (data) {
            console.log('Нет данных для утентификации ', data);
        }
    });
}

$(document).ready(function () {

    /** Двух этапная аутентификация **/
    $.ajax({
        method: 'GET',
        url: '/api/user?extend=1',
        dataType: 'Json',
        success: function (test) {
            console.log('Данные утентификации test - ', test.response);
        },
        error: function (test) {
            console.log('Нет данных для утентификации test - ', test);
        }
    });

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
            $('input[name="about_me"]').val(data.about_me);
            $('input[name="contacts_number"]').val(data.contacts_number);
            $('input[name="contacts_email"]').val(data.contacts_email);
        },
        error: function (data) {
            console.log('Данные не получены', data);
        }
    });

    /** Отправляем данные **/
    $('#edit-profile').submit(function (e) {
        e.preventDefault();
        var data = $(this).serialize();

        if ($('.user-data input').val() === '') {
            $('.header').append('<div class="message">Зарегистрируйтесь</div>');
            setTimeout(function () {
                $('.message').fadeOut('slow', function () {
                    $(this).remove();
                })
            }, 5000);
            return false;
        }

        $.ajax({
            method: 'POST',
            url: '/api/profile/save/profile',
            dataType: 'Json',
            data: data,
            success: function () {
                $('.header').append('<div class="message">отправлено</div>');
                setTimeout(function () {
                    $('.message').fadeOut('slow', function () {
                        $(this).remove();
                    })
                }, 5000);
            },
            error: function () {
                console.log('Данные не отправлены', data);
            }
        })
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