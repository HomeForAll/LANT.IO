$(document).ready(function () {
    $("#space_type_btn").on('click', function (event) {
        event.preventDefault();

        var box = document.createElement('div'),
            span = document.createElement('span'),
            label_ru = document.createElement('label'),
            input_ru = document.createElement('input'),
            label_eng = document.createElement('label'),
            deleteBtn = document.createElement('a'),
            input_eng = document.createElement('input'),
            container = $('.params'),
            save_btn = $("#save_params"),
            msg = $('.msg');

        msg.html('');

        deleteBtn.setAttribute('href', '#');
        deleteBtn.setAttribute('class', 'deleteBtn button');
        deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
        deleteBtn.innerHTML = "Удалить";

        if (save_btn.hasClass('dNone')) {
            save_btn.css({
                display: 'inline-block'
            });
        }


        box.setAttribute('style', 'position:relative; padding: 15px; border: dotted 1px gray; margin-bottom: 15px;');

        span.setAttribute('style', 'font-size: 14pt; font-weight: bold;');
        span.innerHTML = 'Параметры площади: <br><br>';

        input_ru.id = "inputID" + Math.floor(Date.now() / 1000);
        input_eng.id = "inputID" + Math.floor(Date.now() / 1000) + 1;

        label_ru.setAttribute('for', input_ru.id);
        label_ru.innerHTML = 'Тип площади на русском';
        label_eng.setAttribute('for', input_eng.id);
        label_eng.innerHTML = 'Тип площади на английском';

        input_ru.setAttribute('type', 'text');
        input_ru.setAttribute('name', 'inputSpaceTypeRu[]');
        input_eng.setAttribute('type', 'text');
        input_eng.setAttribute('name', 'inputSpaceTypeEng[]');

        box.append(span);
        box.append(label_ru);
        box.append(input_ru);
        box.append(label_eng);
        box.append(input_eng);
        box.append(deleteBtn);

        container.prepend(box);
    });

    $("#operation_type_btn").on('click', function (event) {
        event.preventDefault();

        var box = document.createElement('div'),
            span = document.createElement('span'),
            label_ru = document.createElement('label'),
            input_ru = document.createElement('input'),
            label_eng = document.createElement('label'),
            deleteBtn = document.createElement('a'),
            input_eng = document.createElement('input'),
            container = $('.params'),
            save_btn = $("#save_params"),
            msg = $('.msg');

        msg.html('');

        deleteBtn.setAttribute('href', '#');
        deleteBtn.setAttribute('class', 'deleteBtn button');
        deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
        deleteBtn.innerHTML = "Удалить";

        if (save_btn.hasClass('dNone')) {
            save_btn.css({
                display: 'inline-block'
            });
        }

        box.setAttribute('style', 'position:relative; padding: 15px; border: dotted 1px gray; margin-bottom: 15px;');

        span.setAttribute('style', 'font-size: 14pt; font-weight: bold;');
        span.innerHTML = 'Параметры операции: <br><br>';

        input_ru.id = "inputID" + Math.floor(Date.now() / 1000);
        input_eng.id = "inputID" + Math.floor(Date.now() / 1000) + 1;

        label_ru.setAttribute('for', input_ru.id);
        label_ru.innerHTML = 'Тип операции на русском';
        label_eng.setAttribute('for', input_eng.id);
        label_eng.innerHTML = 'Тип операции на английском';

        input_ru.setAttribute('type', 'text');
        input_ru.setAttribute('name', 'inputOperationTypeRu[]');
        input_eng.setAttribute('type', 'text');
        input_eng.setAttribute('name', 'inputOperationTypeEng[]');

        box.append(span);
        box.append(label_ru);
        box.append(input_ru);
        box.append(label_eng);
        box.append(input_eng);
        box.append(deleteBtn);

        container.prepend(box);
    });

    $("#object_type_btn").on('click', function (event) {
        event.preventDefault();

        var box = document.createElement('div'),
            span = document.createElement('span'),
            label_ru = document.createElement('label'),
            input_ru = document.createElement('input'),
            label_eng = document.createElement('label'),
            input_eng = document.createElement('input'),
            deleteBtn = document.createElement('a'),
            container = $('.params'),
            save_btn = $("#save_params"),
            msg = $('.msg');

        msg.html('');

        if (save_btn.hasClass('dNone')) {
            save_btn.css({
                display: 'inline-block'
            });
        }

        deleteBtn.setAttribute('href', '#');
        deleteBtn.setAttribute('class', 'deleteBtn button');
        deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
        deleteBtn.innerHTML = "Удалить";

        box.setAttribute('style', 'position:relative; padding: 15px; border: dotted 1px gray; margin-bottom: 15px;');

        span.setAttribute('style', 'font-size: 14pt; font-weight: bold;');
        span.innerHTML = 'Параметры объекта: <br><br>';

        input_ru.id = "inputID" + Math.floor(Date.now() / 1000);
        input_eng.id = "inputID" + Math.floor(Date.now() / 1000) + 1;

        label_ru.setAttribute('for', input_ru.id);
        label_ru.innerHTML = 'Название объекта на русском';
        label_eng.setAttribute('for', input_eng.id);
        label_eng.innerHTML = 'Название объекта на английском';

        input_ru.setAttribute('type', 'text');
        input_ru.setAttribute('name', 'inputObjectTypeRu[]');
        input_eng.setAttribute('type', 'text');
        input_eng.setAttribute('name', 'inputObjectTypeEng[]');

        box.append(span);
        box.append(label_ru);
        box.append(input_ru);
        box.append(label_eng);
        box.append(input_eng);
        box.append(deleteBtn);

        container.prepend(box);
    });

    var save_btn = $("#save_params");

    save_btn.click(function (event) {
        var container = $('.params'),
            msg = $('form').serialize(),
            error = $('.msg'),
            spaceTypes = $('#spaceType'),
            operationTypes = $('#operationType'),
            objectTypes = $('#objectType');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/new',
            data: msg,
            success: function (data) {
                data = JSON.parse(data);

                if (data.message == 'Ошибка, не все поля заполнены.') {
                    error.prepend('<pre>' + data.message + '</pre>');
                } else {
                    error.html('<pre>' + data.message + '</pre>');
                    container.html('');
                    save_btn.css({
                        display: 'none'
                    });

                    spaceTypes.html('');
                    data.data.spaceTypes.forEach(function (element) {
                        var optionEl = document.createElement('option');
                        optionEl.setAttribute('value', element.id);
                        optionEl.innerHTML = element.r_name;
                        spaceTypes.append(optionEl);
                    });

                    operationTypes.html('');
                    data.data.operationTypes.forEach(function (element) {
                        var optionEl = document.createElement('option');
                        optionEl.setAttribute('value', element.id);
                        optionEl.innerHTML = element.r_name;
                        operationTypes.append(optionEl);
                    });

                    objectTypes.html('');
                    data.data.objectTypes.forEach(function (element) {
                        var optionEl = document.createElement('option');
                        optionEl.setAttribute('value', element.id);
                        optionEl.innerHTML = element.r_name;
                        objectTypes.append(optionEl);
                    });
                }
            },
            error: function (xhr, str) {
                container.html('Возникла ошибка: ' + xhr.responseCode);
            }
        });

        event.preventDefault();
    });

    $('.params').on('click', '.deleteBtn', function (event) {
        var container = $('.params');

        $(this).parent().remove()

        if (container.html() === '') {
            save_btn.css({
                display: 'none'
            });
        }

        event.preventDefault();
    });
});