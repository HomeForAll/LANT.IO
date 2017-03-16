$(document).ready(function () {

    //
    //
    // Валидация формы
    //
    //
    $.validator.addClassRules({
        input_dig_req: {
            required: true,
            digits: true
        }
    })

    $('input .input_dig_req').change(function(e) {
        $('form').validate().element($(e.target));
    });


    $("#editor_form").validate({
        rules: {
            service_name: "required",
            parameters: "letterswithbasicpunc"
        },
        messages: {
            service_name: "Введите название услуги"

        }

    });

    //
    //
    // Дополнительные правила Валидации
    //
    //

    $.validator.addMethod("letterswithbasicpunc", function (value, element) {
        return this.optional(element) || /^[а-яА-ЯA-Za-z0-9\-.,\!()'"\s]+$/i.test(value);
    }, "Допускаются только буквы и знаки препинания");


    //
    //
    // Добавление сервисов
    //
    //


    $('#addFieldButton').on('click', function (event) {

        //Определение номера следующего поля
        var inputID = ($("#addFieldButton").attr('name'))* 1 + 1;
        $("#addFieldButton").attr('name',inputID);

        addField(inputID);
        return false;
    });

    //Прорисовка поля
    function addField(inputID) {

        // Период
        var section = $('<section/>', {
            'class': 'input_opion',
        }).appendTo($('#inputContainer'));
        var label1 = $('<label/>').html("Период (дней):").appendTo(section);
        $('<input/>', {
            'type': 'text',
            'id': 'period_' + inputID,
            'name': 'period_' + inputID,
            'class': 'input_dig_req',
        }).appendTo(label1);

        //Цена
        var label2 = $('<label/>').html("Цена:").appendTo(section);
        $('<input/>', {
            'type': 'text',
            'id': 'price_' + inputID,
            'name': 'price_' + inputID,
            'class': 'input_dig_req',
        }).appendTo(label2);

        // Кнопка удалить
        var input_del = $('<input/>', {
            'value': 'Удаление',
            'type': 'button',
            'class': 'DeleteField'
        }).appendTo(section);
        // При клике удаляет род. элемент
        input_del.click(function () {
            $(this).parent().remove();
        });

    };

    //
    //
    // Раскрытие и скрытие элементов
    //
    //


    $(function() {
        $('.service_body').hide();
        $('.service_name').click(function(){
            $(this).parent().next().toggle();
        });
    });


});
