$(document).ready(function () {

    //
    //
    // Добавление картинок
    //
    //


    //Максимальное количество загружаемых фотографий
    var maxItem = 5;

    $('#addFieldButton').on('click', function (event) {
        //Определение номера поля ввода из количества выведенных полей
        var fileInputID = $(".inputfile").length + 1;
        //Проверка лимита и прорисовка поля
        if (fileInputID <= maxItem) {
            $("#imageMessage").html('Вы можете загрузить ещё: ' + (maxItem - fileInputID) + ' фотографий.');
            addField(fileInputID);
        } else {
            $("#imageMessage").html('Вы достигли лимита.');
        }
        ;
        return false;
    });

    //Прорисовка поля
    function addField(fileInputID) {
        var div = $('<div/>', {
            'class': 'fileInput_' + fileInputID
        }).appendTo($('#inputImageContainer'));
        // Заголовок
        var label = $('<label/>').html("Выберите  фотографию: " + fileInputID).appendTo(div);
        // перенос строки
        var br = $('<br/>').appendTo(div);
        // картинка предпросмотра
        var imgpreview = $('<img/>', {
            'id': 'img-preview_' + fileInputID,
            'src': '/templates/main/images/default-preview.jpg'
        }).appendTo(div);
        // Вставка Поля ввода
        var inputfile = $('<input/>', {
            type: 'file',
            'id': 'image_input_' + fileInputID,
            'name': 'image_name_' + fileInputID,
            'class': 'inputfile',
            'onchange': '{document.getElementById("img-preview_' + fileInputID + '").src = window.URL.createObjectURL(this.files[0]);document.getElementById("image_input_' + fileInputID + '").setAttribute("name", "image_name_' + fileInputID + '");}'
        }).appendTo(div);
        // перенос строки
        var br = $('<br/>').appendTo(div);
        // Кнопка удалить
        var input = $('<input/>', {
            value: 'Удаление',
            type: 'button',
            'class': 'DeleteField'
        }).appendTo(div);
        // При клике удаляет род. элемент
        input.click(function () {
            $("#imageMessage").html('Вы можете загрузить ещё: ' + (maxItem - ($(".inputfile").length) + 1) + ' фотографий.');
            $(this).parent().remove();
        });

    };


    //
    //
    // Кнопки переключения между полями Квартира, Дом, Комната, Доля
    //
    //



    $('#addApartmentFieldButton').on('click', function () {
        hideAllFields();
        $("#apartmentField").show("slow");
        $("#editor_form input[name=newsObject]").attr('value', "Квартира");
    });
    $('#addHouseFieldButton').on('click', function () {
        hideAllFields();
        $("#houseField").show("slow");
        $("#editor_form input[name=newsObject]").attr('value', "Дом");
    });
    $('#addRoomFieldButton').on('click', function () {
        hideAllFields();
        $("#roomField").show("slow");
        $("#editor_form input[name=newsObject]").attr('value', "Комната");
    });
    $('#addPartFieldButton').on('click', function () {
        hideAllFields();
        $("#partField").show("slow");
        $("#editor_form input[name=newsObject]").attr('value', "Доля");
    });



//Скрытие всех открытых полей
//    function hideAllFields() {
//        if ($('#apartmentField').is(':visible'))
//        {
//            $("#apartmentField").hide("slow");
//        }
//        if ($('#houseField').is(':visible'))
//        {
//            $("#houseField").hide("slow");
//        }
//        if ($('#roomField').is(':visible'))
//        {
//            $("#roomField").hide("slow");
//        }
//        if ($('#partField').is(':visible'))
//        {
//            $("#partField").hide("slow");
//        }
//    };

//Скрытие всех открытых полей
//    function addSubmitButtonValue(name) {
//
//    };
    



    //
    //
    // Раскрытие и скрытие элементов
    //
    //


$(function() {
    $('.spoiler_body').hide();
    $('.spoiler_button').click(function(){
        $(this).next().toggle('slow', function(){
            if($(this).is(":visible")){
            $(this).prev().html('-'); }
        else { $(this).prev().html('+'); };
        });
    });
});

// Появление и исчезновение поля ДРУГОЕ
$(function() {
    $('.showOtherInput').hide();
    $('.showOtherInput_show').show();
    
    $('.showOtherButton').change(function(){
    var select = $(".showOtherButton option:selected").val();
    if (select === 'Другое') {
    $(this).next('.showOtherInput').show('slow');
        } else {
            if ($(this).next('.showOtherInput').is(":visible")){
              $(this).next('.showOtherInput').hide('slow');
            }
        };

    });
});

// Появление полей при включении ЧЕКБОКС

$(function() {
    $('.showСheckboxInput').hide();
    $('.showСheckboxInput_show').show();
   
    $('.showСheckboxButton').change(function(){
    
        if ($(this).next('.showСheckboxInput').is(":visible")){
              $(this).next('.showСheckboxInput').hide('slow');
            } else {
                $(this).next('.showСheckboxInput').show('slow');
        };

    });
});






    //
    //
    // Валидация
    //
    //




});

