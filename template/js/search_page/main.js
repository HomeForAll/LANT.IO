'use strict';

var getSearchParameters = function() {
    function transformToAssocArray(prmstr) {
        var params = {};
        var prmarr = prmstr.split('&');
        for(var i = 0; i < prmarr.length; i++) {
            var tmparr = prmarr[i].split('=');
            params[tmparr[0]] = tmparr[1];
        }
        return params;
    }
    var prmstr = window.location.search.substr(1);
    return prmstr !== null && prmstr !== '' ? transformToAssocArray(prmstr) : {};
};

/** Переходим в новую вкладку и получаем объявления **/
$(document).ready(function () {
    $.ajax({
        method: 'POST',
        url: 'api/search',
        data: getSearchParameters(),
        success: function(form_data) {
            console.log('form_data-success', form_data);
            renderAllApartments(form_data);
        },
        error: function (form_data) {
            console.log('form_data - error', form_data);
        }
    });
});

/** при нажатии отправить, рендерим формы **/
$('#form_2').on('submit', function () {
    var newData = {};
    $.ajax({
        method: 'POST',
        url: 'api/search',
        data: getSearchParameters(),
        success: function(form_data) {
            renderAllApartments(form_data);
            newData += form_data;
        }
    });

    /** Открываем дополнительную ифнормацию об объявлениях **/
    $('.open-close-ad').on('click', function () {
        var additionalInformationContent = '',
            $moreInformationMainBlock = $('#show-more-information').html(),
            addBlockInMain = Handlebars.compile($moreInformationMainBlock),
            $resultAllApartments = $('.result-all-apartments');

        additionalInformationContent += addBlockInMain(newData);
        $resultAllApartments.html(additionalInformationContent);
    });
});

/** Определяем нужные checkbox **/
$(function() {
    var $boxes = $('.checkbox-4 input:checkbox');

    $('.checkbox-1 input:checkbox').on('click', function(e) {
        $('#checkbox-price').html('От ' + e.target.value);
    });
    $('.checkbox-2 input:checkbox').on('click', function(e) {
        $('#size-apartments').val(e.target.value);
    });
    $('.checkbox-3 input:checkbox').on('click', function(e) {
        $('#checkbox-area').html(e.target.value);
    });

    $boxes.on('change', function(){
        var theArray = [];
        for (var i = 0; i < $boxes.length; i++) {
            var box = $boxes[i];
            if ($(box).prop('checked')) {
                theArray[theArray.length] = $(box).val();
            }
        }
        showValuesPrice(theArray);
    });

    var showValuesPrice = function(array) {
        var text = '';
        if(array.length === 0) text = 'Выбрано (0)';
        for(var i = 0; i < array.length; i++) {
            text = 'Выбрано (' + array.length + ')';
        }
        $('#checkbox-equipment').html(text);
    };
});

/** Рендеринг форм **/
function renderAllApartments(data) {
    var content = '',
        $resultAllApartments = $('.result-all-apartments');

    if (!data) {
        return false;
    }

    for (var i = 0; i < data.length; i++) {
        var $source = $('#entry-template').html(),
            template = Handlebars.compile($source);

        //data[i].preview_img = data[i].preview_img.split('|')[0];
        //data[i].preview_img = '1.png';

        content += template(data[i]);
    }
    $resultAllApartments.html(content);
}

/** Фильтр - Цена **/
$(function () {
    var $amountBeforeMain = $('#amountBeforeMain'),
        $amountAfterMain = $('#amountAfterMain');

    /** Фильтры в доп.параметрах **/
    $amountBeforeMain.val('0');
    $amountAfterMain.val('20000');
    $('#main-slider').slider({
        range: true,
        min: 0,
        max: 20000000,
        values: [75, 20000000],
        slide: function (event, ui) {
            $amountBeforeMain.val(ui.values[0]);
            $amountAfterMain.val(ui.values[1]);
        }
    });
    $amountBeforeMain.slider({values: 0});
    $amountAfterMain.slider({values: 1});
});

/** Стилизация (анимация) Header **/
$(function () {
    setInterval(function () {
        var scrolled = window.pageYOffset,
            $header = $('.show-hide-header'),
            $topHeader = $('.header'),
            $buttonHideMenu = $('.show-and-hide-menu'),
            $usersInformation = $('.user');

        if (scrolled > 500) {
            $header.fadeOut(function () {
                $topHeader.css({'background': 'none'});
            });
            $buttonHideMenu.css({'display': 'block'});
            $usersInformation.css({
                'position': 'fixed',
                'top': 'inherit',
                'button': 'inherit',
                'right': '0'
            });
        } else {
            $header.fadeIn(function () {
                $topHeader.css({'background': 'linear-gradient(to top, rgba(255, 255, 255, 0), rgba(0, 0, 0, 0.72)'});
            });
            $buttonHideMenu.css({'display': 'none'});
            $usersInformation.css({
                'position': 'fixed',
                'bottom': '65px',
                'top': '75px',
                'right': '10px'
            });
        }
    }, 1000);
});