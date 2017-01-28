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
            error = $('.msg');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/new',
            data: msg + '&action=saveParams',
            success: function (data) {
                data = JSON.parse(data);

                if (data.message == 'Ошибка, не все поля заполнены.') {
                    error.prepend('<pre>' + data.message + '</pre>');
                } else if (data.message == 'Параметры сохранены.') {
                    error.html('<pre>' + data.message + '</pre>');
                    container.html('');
                    save_btn.css({
                        display: 'none'
                    });
                    updateFormParams(data.data);
                } else {
                    error.html('<pre>' + data.message + '</pre>');
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

        $('.msg').html('');

        $(this).parent().remove();

        if (container.html() === '') {
            save_btn.css({
                display: 'none'
            });
        }

        event.preventDefault();
    });

    $('#paramsTable').on('click', '.deleteParam', function (event) {
        var button = $(this);

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/new',
            data: 'action=deleteParam&id=' + button.attr('id'),
            success: function (data) {
                data = JSON.parse(data);

                button.parent().parent().remove();
                updateFormParams(data.data)
            },
            error: function (xhr, str) {
                console.log(xhr);
            }
        });
        event.preventDefault();
    });

    /**
     * Создает label`ы, input`ы и помещает их в #categories, параллельно удаляет все из сообщений .messages
     */
    $('#addCategory').on('click', function (event) {
        var form = $('#categories'),
            box = document.createElement('div'),
            ru_label = document.createElement('label'),
            eng_label = document.createElement('label'),
            ru_input = document.createElement('input'),
            eng_input = document.createElement('input'),
            hidden_input = document.createElement('input'),
            messages = $('.messages'),
            deleteBtn = document.createElement('a'),
            id = 'id' + Math.floor(Date.now());

        messages.html('');

        deleteBtn.setAttribute('href', '#');
        deleteBtn.setAttribute('class', 'deleteCategory button');
        deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
        deleteBtn.innerHTML = "Удалить";

        box.append(deleteBtn);

        ru_label.setAttribute('for', id);
        eng_label.setAttribute('for', id + 1);

        ru_label.innerHTML = 'Название категории на русском:';
        eng_label.innerHTML = 'Название категории на английском:';

        ru_input.setAttribute('type', 'text');
        ru_input.setAttribute('id', id);
        ru_input.setAttribute('name', 'categoriesRu[]');

        eng_input.setAttribute('type', 'text');
        eng_input.setAttribute('id', id + 1);
        eng_input.setAttribute('name', 'categoriesEng[]');

        hidden_input.setAttribute('type', 'hidden');
        hidden_input.setAttribute('name', 'formID');
        hidden_input.setAttribute('value', formId);

        if (form.html() === '') {
            var a = document.createElement('a');

            a.setAttribute('href', '#');
            a.setAttribute('id', 'saveCategories');
            a.setAttribute('class', 'button');
            a.innerHTML = 'Сохранить категории';

            form.append(hidden_input);
            form.append(a);
        }

        box.setAttribute('class', 'box');

        box.append(ru_label);
        box.append(ru_input);
        box.append(eng_label);
        box.append(eng_input);

        form.prepend(box);

        event.preventDefault();
    });

    var categories = $('#categories');

    categories.on('click', '.deleteCategory', function (event) {

        $('.messages').html('');

        $(this).parent().remove();

        if ($('#categories .box').length == 0) {
            categories.html('');
        }

        event.preventDefault();
    });

    /**
     * Выполняет AJAX запрос на /cabinet/form/edit/id/formID с данными формы категорий
     */
    categories.on('click', '#saveCategories', function (event) {
        var form = $('#categories'),
            formData = form.serialize(),
            messages = $('.messages');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/edit/id/' + formId,
            data: formData + '&action=saveCategories',
            success: function (data) {
                data = JSON.parse(data);

                categoriesJSON = data.categories;

                $('#subcategories select').each(function (index, el) {
                    el.innerHTML = '';

                    categoriesJSON.forEach(function (category) {
                        var option = document.createElement('option');

                        option.setAttribute('value', category['id']);
                        option.innerHTML = category['r_name'];

                        el.append(option);
                    });
                });

                if (data.message == 'Категории сохранены.') {
                    messages.html('<pre>' + data.message + '</pre>');

                    form.html('');
                } else if (data.message == 'Ошибка, не все поля заполнены.') {
                    messages.html('<pre>' + data.message + '</pre>');
                } else {
                    messages.html('<pre>' + data.message + '</pre>');
                }

            },
            error: function (xhr, str) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    $('#addSubcategory').on('click', function (event) {
        var form = $('#subcategories'),
            box = document.createElement('div'),
            ru_label = document.createElement('label'),
            eng_label = document.createElement('label'),
            ru_input = document.createElement('input'),
            eng_input = document.createElement('input'),
            hidden_input = document.createElement('input'),
            messages = $('.messages'),
            deleteBtn = document.createElement('a'),
            id = 'id' + Math.floor(Date.now()),
            categorySelect = document.createElement('select'),
            categoryLabel = document.createElement('label');


        categoryLabel.setAttribute('for', id + 2);
        categoryLabel.innerHTML = 'В какой категории (блоке) находиться:';
        categorySelect.setAttribute('name', 'parentCategory[]');
        categorySelect.setAttribute('id', id + 2);

        categoriesJSON.forEach(function (category, key) {
            var option = document.createElement('option');

            option.setAttribute('value', category['id']);
            option.innerHTML = category['r_name'];

            categorySelect.append(option);
        });

        deleteBtn.setAttribute('href', '#');
        deleteBtn.setAttribute('class', 'deleteSubcategory button');
        deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
        deleteBtn.innerHTML = "Удалить";

        messages.html('');

        ru_label.setAttribute('for', id);
        eng_label.setAttribute('for', id + 1);

        ru_label.innerHTML = 'Название подкатегории на русском:';
        eng_label.innerHTML = 'Название подкатегории на английском:';

        ru_input.setAttribute('type', 'text');
        ru_input.setAttribute('id', id);
        ru_input.setAttribute('name', 'subcategoriesRu[]');

        eng_input.setAttribute('type', 'text');
        eng_input.setAttribute('id', id + 1);
        eng_input.setAttribute('name', 'subcategoriesEng[]');

        hidden_input.setAttribute('type', 'hidden');
        hidden_input.setAttribute('name', 'formID');
        hidden_input.setAttribute('value', formId);

        if (form.html() === '') {
            var a = document.createElement('a');

            a.setAttribute('href', '#');
            a.setAttribute('id', 'saveSubcategories');
            a.setAttribute('class', 'button');
            a.innerHTML = 'Сохранить подкатегории';

            form.append(hidden_input);
            form.append(a);
        }

        box.setAttribute('class', 'box');

        box.append(deleteBtn);
        box.append(ru_label);
        box.append(ru_input);
        box.append(eng_label);
        box.append(eng_input);
        box.append(categoryLabel);
        box.append(categorySelect);

        form.prepend(box);

        event.preventDefault();
    });

    var subcategories = $('#subcategories');

    subcategories.on('click', '.deleteSubcategory', function (event) {

        $('.messages').html('');

        $(this).parent().remove();

        if ($('#subcategories .box').length == 0) {
            subcategories.html('');
        }

        event.preventDefault();
    });

    subcategories.on('click', '#saveSubcategories', function (event) {
        var form = $('#subcategories'),
            formData = form.serialize(),
            messages = $('.messages');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/edit/id/' + formId,
            data: formData + '&action=saveSubcategories',
            success: function (data) {
                data = JSON.parse(data);

                if (data.message == 'Подкатегории сохранены.') {
                    messages.html('<pre>' + data.message + '</pre>');
                    form.html('');
                } else if (data.message == 'Ошибка, не все поля заполнены.') {
                    messages.html('<pre>' + data.message + '</pre>');
                } else {
                    messages.html('<pre>' + data.message + '</pre>');
                }

            },
            error: function (xhr, str) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    $('table').on('click', '.categoryDelButton', function (event) {
        var button = this.id,
            form = $('#subcategories'),
            formData = form.serialize(),
            messages = $('.messages');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/edit/id/' + formId,
            data: 'action=delCategory&id=' + button + '&formID=' + formId,
            success: function (data) {
                data = JSON.parse(data);

                if (data.message == 'Удаление прошло успешно.') {
                    messages.html('<pre>' + data.message + '</pre>');
                    updateCategory();
                    form.html('');
                } else if (data.message == 'Возникла ошибка при удалении.') {
                    messages.html('<pre>' + data.message + '</pre>');
                } else {
                    messages.html('<pre>' + data.message + '</pre>');
                }
            },
            error: function (xhr, str) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });
});

function updateCategory() {
    $('#categoriesTable tr').each(function (index, el) {
        if (!(this.id == 'need')){
            el.remove();
        }
    });

    // TODO: Дописать обновление категорий
}

function updateFormParams(data) {
    var spaceTypes = $('#spaceType'),
        operationTypes = $('#operationType'),
        objectTypes = $('#objectType');

    $("tr").each(function () {
        if (!(this.id == 'tableSpaceTypes') && !(this.id == 'tableOperationTypes') && !(this.id == 'tableObjectTypes')) {
            $(this).remove();
        }
    });

    spaceTypes.html('');
    data.spaceTypes.forEach(function (element) {
        var optionEl = document.createElement('option'),
            tr = document.createElement('tr'),
            td1 = document.createElement('td'),
            td2 = document.createElement('td'),
            td3 = document.createElement('td'),
            a = document.createElement('a');

        a.setAttribute('href', '#');
        a.setAttribute('id', 'spaceType_' + element.id);
        a.setAttribute('class', 'button deleteParam');
        a.setAttribute('style', 'margin:0;');
        a.innerHTML = 'Удалить';

        td1.innerHTML = element.r_name;
        td2.innerHTML = element.e_name;
        td3.append(a);

        tr.append(td1);
        tr.append(td2);
        tr.append(td3);

        tr.setAttribute('id', 'param');

        $('#tableSpaceTypes').after(tr);

        optionEl.setAttribute('value', element.id);
        optionEl.innerHTML = element.r_name;
        spaceTypes.append(optionEl);
    });

    operationTypes.html('');
    data.operationTypes.forEach(function (element) {
        var optionEl = document.createElement('option'),
            tr = document.createElement('tr'),
            td1 = document.createElement('td'),
            td2 = document.createElement('td'),
            td3 = document.createElement('td'),
            a = document.createElement('a');

        a.setAttribute('href', '#');
        a.setAttribute('id', 'operationType_' + element.id);
        a.setAttribute('class', 'button deleteParam');
        a.setAttribute('style', 'margin:0;');
        a.innerHTML = 'Удалить';

        td1.innerHTML = element.r_name;
        td2.innerHTML = element.e_name;
        td3.append(a);

        tr.append(td1);
        tr.append(td2);
        tr.append(td3);

        tr.setAttribute('id', 'param');

        $('#tableOperationTypes').after(tr);

        optionEl.setAttribute('value', element.id);
        optionEl.innerHTML = element.r_name;
        operationTypes.append(optionEl);
    });

    objectTypes.html('');
    data.objectTypes.forEach(function (element) {
        var optionEl = document.createElement('option'),
            tr = document.createElement('tr'),
            td1 = document.createElement('td'),
            td2 = document.createElement('td'),
            td3 = document.createElement('td'),
            a = document.createElement('a');

        a.setAttribute('href', '#');
        a.setAttribute('id', 'objectType_' + element.id);
        a.setAttribute('class', 'button deleteParam');
        a.setAttribute('style', 'margin:0;');
        a.innerHTML = 'Удалить';

        td1.innerHTML = element.r_name;
        td2.innerHTML = element.e_name;
        td3.append(a);

        tr.append(td1);
        tr.append(td2);
        tr.append(td3);

        tr.setAttribute('id', 'param');

        $('#tableObjectTypes').after(tr);

        optionEl.setAttribute('value', element.id);
        optionEl.innerHTML = element.r_name;
        objectTypes.append(optionEl);
    });
}