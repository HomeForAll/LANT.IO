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
        url: 'http://localhost/api/search?tabs=1&city=0&type=2&area=50&price%5Bfrom%5D=1000&price%5Bto%5D=20000000&term=1&blah=&non-commission=1&count_rooms=&area_residential%5Bfrom%5D=&area_residential%5Bto%5D=&area_non_residential%5Bfrom%5D=&area_non_residential%5Bto%5D=&area_general%5Bfrom%5D=&area_general%5Bto%5D=&area_balcony%5Bfrom%5D=&area_balcony%5Bto%5D=&height_ceiling%5Bfrom%5D=&height_ceiling%5Bto%5D=&floor%5Bfrom%5D=&floor%5Bto%5D=&bathroom=&hosted=&rooms=&equipment=&decoration=&count_floors%5Bfrom%5D=&count_floors%5Bto%5D=&lift=&garbage=&object_type=&year_building%5Bfrom%5D=&year_building%5Bto%5D=&hc_services=&parking=&wall_material=&state_stairs=&security=&project=&project3d=&video=',
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
        url: 'http://localhost/api/search?tabs=1&city=0&type=2&area=50&price%5Bfrom%5D=1000&price%5Bto%5D=20000000&term=1&blah=&non-commission=1&count_rooms=&area_residential%5Bfrom%5D=&area_residential%5Bto%5D=&area_non_residential%5Bfrom%5D=&area_non_residential%5Bto%5D=&area_general%5Bfrom%5D=&area_general%5Bto%5D=&area_balcony%5Bfrom%5D=&area_balcony%5Bto%5D=&height_ceiling%5Bfrom%5D=&height_ceiling%5Bto%5D=&floor%5Bfrom%5D=&floor%5Bto%5D=&bathroom=&hosted=&rooms=&equipment=&decoration=&count_floors%5Bfrom%5D=&count_floors%5Bto%5D=&lift=&garbage=&object_type=&year_building%5Bfrom%5D=&year_building%5Bto%5D=&hc_services=&parking=&wall_material=&state_stairs=&security=&project=&project3d=&video=',
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
        data[i].preview_img = '1.png';

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