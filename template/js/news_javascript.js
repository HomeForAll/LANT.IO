$(document).ready(function () {

    /**
     * Валидация формы
     */
    
    $("#editor_form").validate({
        rules: {
            title: "required",
            price: {
               required: true,
               digits: true
           },
           short_content:  "letterswithbasicpunc",
           number_of_rooms: "digits",

            space: "digits",
            floor: "digits",
            ceiling_height: "digits",
            number_of_floors: "digits",
            bedroom_num: "digits",
            kitchen_num: "digits",
            living_room_num: "digits",
            hallway_num: "digits",
            play_room_num: "digits",
            cabinet_num: "digits",
            dining_room_num: "digits",
            bathroom_num: "digits",
            televisor_num: "digits",
            music_center_num: "digits",
            conditioning_num: "digits",
            fridge_num: "digits",
            range_num: "digits",
            stove_num: "digits",
            microwave_num: "digits",
            dishwasher_num: "digits",
            table_num: "digits",
            bed_num: "digits",
            cupboard_num: "digits",
            chair_num: "digits",
            stand_num: "digits",
            mirror_num: "digits",
            armchair_num: "digits",
            sofa_num: "digits",
            village: "letterswithbasicpunc",
            distance_from_city: "digits",
            bathhouse_num: "digits",
            garage_num: "digits",
            barn_num: "digits",
            pool_num: "digits",
            pavilion_num: "digits",
            hall_num: "digits",
            basement_num: "digits",
            boiler_num: "digits",
            veranda_num: "digits",
            dressingroom_num: "digits",
            number_of_inputs: "digits",
            hearth_num: "digits",
            rooms_for_sale: "digits"

        },
        messages: {
            title: "Введите название новости"

        }
        
    });
    
    //
    //
    // Дополнительные правила Валидации
    //
    //
    
    $.validator.addMethod( "price", function( value, element ) {
	return this.optional( element ) || /^\d+[\.,]?\d{0,2}?$/.test( value );
}, "Допускается вводить только цифры (.) (,)" );

$.validator.addMethod( "letterswithbasicpunc", function( value, element ) {
	return this.optional( element ) || /^[а-яА-ЯA-Za-z0-9\-.,\!()'"\s]+$/i.test( value );
}, "Допускаются только буквы и знаки препинания" );


    /**
     * Добавление картинок
     */
    //Максимальное количество загружаемых фотографий
    var maxItem = 5;

    $('#addFieldButton').on('click', function (event) {
        
        //Определение номера последнего поля ввода из количества выведенных полей
        var fileInputNumber = $(".inputfile").length + 1;
        var fileInputID = fileInputNumber;
        //Проверка лимита и прорисовка поля
        if (fileInputNumber <= maxItem) {
            $("#imageMessage").html('Вы можете загрузить ещё: ' + (maxItem - fileInputNumber) + ' фотографий.');
        //Определение ID
        //если поле с таким id уже есть, то находим номер
        if(document.getElementById('img-preview_' + fileInputNumber)) {
        for (fileInputNumber=1;(document.getElementById('img-preview_' + fileInputNumber)); fileInputNumber++){};
        fileInputID = fileInputNumber;
        }
            addField(fileInputID);
        } else {
            $("#imageMessage").html('Вы достигли лимита.');
        };
        return false;
    });

    //Прорисовка поля
    function addField(fileInputID) {
        var div = $('<div/>', {
            'class': 'imgInput imgInput_' + fileInputID
        }).appendTo($('#inputImageContainer'));
        // Заголовок
        var label = $('<label/>').html("Выберите  фотографию: " + fileInputID).appendTo(div);
        // перенос строки
        var br = $('<br/>').appendTo(div);
        // картинка предпросмотра
        var imgpreview = $('<img/>', {
            'id': 'img-preview_' + fileInputID,
            'src': '/template/main/images/default-preview.jpg'
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
            'value': 'Удаление',
            'type': 'button',
            'class': 'DeleteField'
        }).appendTo(div);
        // При клике удаляет род. элемент
        input.click(function () {
            $("#imageMessage").html('Вы можете загрузить ещё: ' + (maxItem - ($(".inputfile").length) + 1) + ' фотографий.');
            $(this).parent().remove();
        });

    };


    /**
     * Удаление блока с картинкой
     */
    $('.DeleteField').on('click', function () {
    $(this).parent().remove();
    });

});
