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

    var saveFormParamsBtn = $("#save_params");

    saveFormParamsBtn.click(function (event) {
        var container = $('.params'),
            formData = $('form').serialize(),
            message = $('.msg');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/new',
            data: formData + '&action=saveParams',
            success: function (data) {
                data = JSON.parse(data);

                if (data.message == 'Ошибка, не все поля заполнены.') {
                    message.prepend('<pre>' + data.message + '</pre>');
                } else if (data.message == 'Параметры сохранены.') {
                    message.html('<pre>' + data.message + '</pre>');
                    container.html('');
                    saveFormParamsBtn.css({
                        display: 'none'
                    });
                    updateFormParams(data.data);
                    console.log(data.data); // TODO : Delete
                } else {
                    message.html('<pre>' + data.message + '</pre>');
                }
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    $('.params').on('click', '.deleteBtn', function (event) {
        var container = $('.params');

        $('.msg').html('');

        $(this).parent().remove();

        if (container.html() === '') {
            saveFormParamsBtn.css({
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
            error: function (xhr) {
                console.log(xhr);
            }
        });
        event.preventDefault();
    });

    var categories = $('#categories');
    var subcategories = $('#subcategories');

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

    /**
     * Удаляет блок КАТЕГОРИИ из DOM
     */
    categories.on('click', '.deleteCategory', function (event) {

        $('.messages').html('');

        $(this).parent().remove();

        if ($('#categories').find('.box').length == 0) {
            categories.html('');
        }

        event.preventDefault();
    });

    /**
     * Выполняет AJAX запрос на /cabinet/form/edit/id/formID с данными формы КАТЕГОРИЙ
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

                if (data.message == 'Категории сохранены.') {
                    messages.html('<pre>' + data.message + '</pre>');
                    form.html('');

                    $('#subcategories').find('select').each(function (index, el) {
                        el.innerHTML = '';

                        categoriesJSON.forEach(function (category) {
                            var option = document.createElement('option');

                            option.setAttribute('value', category['id']);
                            option.innerHTML = category['r_name'];

                            el.append(option);
                        });
                    });

                    updateCategories(data.categories);
                } else if (data.message == 'Ошибка, не все поля заполнены.') {
                    messages.html('<pre>' + data.message + '</pre>');
                } else {
                    messages.html('<pre>' + data.message + '</pre>');
                }

            },
            error: function (xhr) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    /**
     * Отправляем AJAX запрос на удаление КАТЕГОРИИ id="category_ID"
     */
    $('table').on('click', '.categoryDelButton', function (event) {
        var categoryID = this.id,
            messages = $('.messages');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/edit/id/' + formId,
            data: 'action=delCategory&id=' + categoryID + '&formID=' + formId,
            success: function (data) {
                data = JSON.parse(data);

                if (data.message == 'Удаление прошло успешно.') {
                    messages.html('<pre>' + data.message + '</pre>');
                    updateCategories(data.data);
                } else if (data.message == 'Возникла ошибка при удалении.') {
                    messages.html('<pre>' + data.message + '</pre>');
                } else {
                    messages.html('<pre>' + data.message + '</pre>');
                }
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    /**
     * Добавляет блок ПОДКАТЕГОРИЯ
     */
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

        if (!(typeof categoriesJSON == "undefined")) {
            categoriesJSON.forEach(function (category) {
                var option = document.createElement('option');

                option.setAttribute('value', category['id']);
                option.innerHTML = category['r_name'];

                categorySelect.append(option);
            });
        }

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

    /**
     * Удаляет текущий блок ПОДКАТЕГОРИЮ
     */
    subcategories.on('click', '.deleteSubcategory', function (event) {

        $('.messages').html('');

        $(this).parent().remove();

        if ($('#subcategories').find('.box').length == 0) {
            subcategories.html('');
        }

        event.preventDefault();
    });

    /**
     * Сохраняет ПОДКАТЕГОРИИ отправляя AJAX запрос
     */
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
                    updateSubcategories(data.subcategories);
                } else if (data.message == 'Ошибка, не все поля заполнены.') {
                    messages.html('<pre>' + data.message + '</pre>');
                } else {
                    messages.html('<pre>' + data.message + '</pre>');
                }

            },
            error: function (xhr) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    var subcategoriesTable = $('#subcategoriesTable');

    /**
     * Отправляем AJAX запрос на удаление ПОДКАТЕГОРИИ id="subcategory_ID"
     */
    subcategoriesTable.on('click', '.subcategoryDelButton', function (event) {
        var subcategoryID = this.id,
            messages = $('.messages');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/edit/id/' + formId,
            data: 'action=delSubcategory&id=' + subcategoryID + '&formID=' + formId,
            success: function (data) {
                data = JSON.parse(data);

                if (data.message == 'Удаление прошло успешно.') {
                    messages.html('<pre>' + data.message + '</pre>');
                    updateSubcategories(data.data);
                } else if (data.message == 'Возникла ошибка при удалении.') {
                    messages.html('<pre>' + data.message + '</pre>');
                } else {
                    messages.html('<pre>' + data.message + '</pre>');
                }
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    var elementsTable = $('#elementsTable');

    elementsTable.on('click', '.elDelButton', function (event) {
        var elementID = this.id,
            messages = $('.messages');

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/edit/id/' + formId,
            data: 'action=delElement&id=' + elementID + '&formID=' + formId,
            success: function (data) {
                data = JSON.parse(data);

                if (data.message == 'Удаление прошло успешно.') {
                    messages.html('<pre>' + data.message + '</pre>');
                    updateElements(data.data);
                } else if (data.message == 'Возникла ошибка при удалении.') {
                    messages.html('<pre>' + data.message + '</pre>');
                } else {
                    messages.html('<pre>' + data.message + '</pre>');
                }
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    var elements = $('#elements');

    /**
     * Добавляет блок ЭЛЕМЕНТ
     */
    $('#addRangeElement').on('click', function (event) {
        addRangeEl(elements);
        event.preventDefault();
    });

    $('#addYORNElement').on('click', function (event) {
        addYOrNEL(elements);
        event.preventDefault();
    });

    $('#addListElement').on('click', function (event) {
        addListEl(elements);
        event.preventDefault();
    });

    /**
     * Удаляем ЭЛЕМЕНТ
     */
    elements.on('click', '.deleteElement', function (event) {

        $('.messages').html('');

        $(this).parent().remove();

        if (elements.find('.box').length == 0) {
            elements.html('');
        }

        event.preventDefault();
    });

    /**
     * Сохраняем ЭЛЕМЕНТЫ
     */
    elements.on('click', '#saveElems', function (event) {
        var formData = elements.serialize(),
            messages = $('.messages'),
            listsOptions = [];

        $('.list').each(function (i, el) {
            listsOptions[i] = $(el).find('.options').find('.optionBox').length;
        });

        listsOptions[listsOptions.length] = 0;

        $.ajax({
            type: 'POST',
            url: '/cabinet/form/edit/id/' + formId,
            data: formData + '&action=saveElements&listOptions=' + listsOptions + '&formID=' + formId,
            success: function (data) {
                console.log(data);
                data = JSON.parse(data);

                messages.html('<pre>' + data.message + '</pre>');

                if (data.message == 'Элементы сохранены.') {
                    updateElements(data.elements);
                    elements.html('');
                }
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });

        event.preventDefault();
    });

    elements.on('click', '.addOptionInBox', function (event) {
        var options = $(this).parent().find('.options');
        addOption(options);
        event.preventDefault();
    });
});

/**
 * Добавляет элемент От - До
 * @param elements
 */
function addRangeEl(elements) {
    var box = document.createElement('div'),

        categoryLabel = document.createElement('label'),
        category = document.createElement('select'),

        subcategoryLabel = document.createElement('label'),
        subcategory = document.createElement('select'),

        ru_label = document.createElement('label'),
        eng_label = document.createElement('label'),

        ru_input = document.createElement('input'),
        eng_input = document.createElement('input'),

        hidden_input = document.createElement('input'),
        messages = $('.messages'),

        deleteBtn = document.createElement('a'),
        id = 'id' + Math.floor(Date.now()),
        h2 = document.createElement('h2'),

        parentElementLabel = document.createElement('label'),
        parentElement = document.createElement('select');

    parentElementLabel.setAttribute('for', id + 5);
    parentElementLabel.innerHTML = 'Родительский элемент, если не указан, будет использоваться "Подкатегория" или "Категория (Блок)":';
    parentElement.setAttribute('name', 'rangeParentElement[]');
    parentElement.setAttribute('id', id + 6);
    parentElement.setAttribute('class', 'parentElementValues');

    box.setAttribute('class', 'box');

    h2.innerHTML = 'Элемент [От-До]';
    h2.setAttribute('style', 'padding-bottom: 15px;');

    categoryLabel.setAttribute('for', id + 5);
    categoryLabel.innerHTML = 'Категория (блок):';
    category.setAttribute('name', 'rangeElementCategory[]');
    category.setAttribute('id', id + 5);
    category.setAttribute('class', 'categoryValues');

    subcategoryLabel.setAttribute('for', id + 2);
    subcategoryLabel.innerHTML = 'Подкатегория (если поле пустое, будет использоваться Категория [блок])::';
    subcategory.setAttribute('name', 'rangeElementSubcategory[]');
    subcategory.setAttribute('id', id + 2);
    subcategory.setAttribute('class', 'subcategoryValues');

    var option = document.createElement('option');
    option.setAttribute('value', '');
    option.innerHTML = '---';

    var option2 = document.createElement('option');
    option2.setAttribute('value', '');
    option2.innerHTML = '---';

    var option3 = document.createElement('option');
    option3.setAttribute('value', '');
    option3.innerHTML = '---';

    //category.append(option3);
    subcategory.append(option);
    parentElement.append(option2);

    if (!(typeof categoriesJSON == "undefined")) {
        categoriesJSON.forEach(function (categoryEl) {
            var option = document.createElement('option');

            option.setAttribute('value', categoryEl['id']);
            option.innerHTML = categoryEl['r_name'];

            category.append(option);
        });
    }

    if (!(typeof subcategoriesJSON == "undefined")) {
        subcategoriesJSON.forEach(function (subcategoryEl) {
            var option = document.createElement('option');

            option.setAttribute('value', subcategoryEl['id']);
            option.innerHTML = subcategoryEl['r_name'];

            subcategory.append(option);
        });
    }

    if (!(typeof elementsJSON == "undefined")) {
        elementsJSON.forEach(function (el) {
            var option = document.createElement('option');

            option.setAttribute('value', el['id']);
            option.innerHTML = el['r_name'];

            parentElement.append(option);
        });
    }

    ru_label.setAttribute('for', id + 3);
    ru_label.innerHTML = 'Название элемента на русском:';
    ru_input.setAttribute('type', 'text');
    ru_input.setAttribute('id', id + 3);
    ru_input.setAttribute('name', 'rangeRName[]');

    eng_label.setAttribute('for', id + 4);
    eng_label.innerHTML = 'Название элемента на английском:';
    eng_input.setAttribute('type', 'text');
    eng_input.setAttribute('id', id + 4);
    eng_input.setAttribute('name', 'rangeEName[]');

    hidden_input.setAttribute('type', 'hidden');
    hidden_input.setAttribute('name', 'formID');
    hidden_input.setAttribute('value', formId);

    deleteBtn.setAttribute('href', '#');
    deleteBtn.setAttribute('class', 'deleteElement button');
    deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
    deleteBtn.innerHTML = "Удалить";

    messages.html('');

    if (elements.html() === '') {
        var a = document.createElement('a');

        a.setAttribute('href', '#');
        a.setAttribute('id', 'saveElems');
        a.setAttribute('class', 'button');
        a.innerHTML = 'Сохранить элементы';

        elements.append(hidden_input);
        elements.append(a);
    }


    box.append(deleteBtn);
    box.append(h2);

    var checkboxLabel = document.createElement('label'),
        checkbox = document.createElement('input'),
        br = document.createElement('br');

    checkbox.setAttribute('name', 'rangeCheckbox[]');
    checkbox.setAttribute('type', 'checkbox');
    checkbox.setAttribute('checked', '');
    checkboxLabel.innerHTML = 'Блок находиться только в объекте ';
    checkboxLabel.append(checkbox);
    //box.append(checkboxLabel);
    //box.append(br);

    box.append(categoryLabel);
    box.append(category);
    box.append(subcategoryLabel);
    box.append(subcategory);
    box.append(parentElementLabel);
    box.append(parentElement);
    box.append(ru_label);
    box.append(ru_input);
    box.append(eng_label);
    box.append(eng_input);

    elements.prepend(box);
}

/**
 * Добавляет элемент Да/Нет
 * @param elements
 */
function addYOrNEL(elements) {
    var box = document.createElement('div'),
        categoryLabel = document.createElement('label'),
        category = document.createElement('select'),

        subcategoryLabel = document.createElement('label'),
        subcategory = document.createElement('select'),

        ru_label = document.createElement('label'),
        eng_label = document.createElement('label'),

        ru_input = document.createElement('input'),
        eng_input = document.createElement('input'),

        yValueLabel = document.createElement('label'),
        nValueLabel = document.createElement('label'),

        yValue = document.createElement('input'),
        nValue = document.createElement('input'),

        hidden_input = document.createElement('input'),

        messages = $('.messages'),
        deleteBtn = document.createElement('a'),
        id = 'id' + Math.floor(Date.now()),
        h2 = document.createElement('h2'),

        parentElementLabel = document.createElement('label'),
        parentElement = document.createElement('select');

    parentElementLabel.setAttribute('for', id + 5);
    parentElementLabel.innerHTML = 'Родительский элемент, если не указан, будет использоваться "Подкатегория" или "Категория (Блок)":';
    parentElement.setAttribute('name', 'YORNParentElement[]');
    parentElement.setAttribute('id', id + 6);
    parentElement.setAttribute('class', 'parentElementValues');

    h2.innerHTML = 'Элемент [Да/Нет]';
    h2.setAttribute('style', 'padding-bottom: 15px;');

    categoryLabel.setAttribute('for', id + 5);
    categoryLabel.innerHTML = 'Категория (блок):';
    category.setAttribute('name', 'YORNElementCategory[]');
    category.setAttribute('id', id + 5);
    category.setAttribute('class', 'categoryValues');

    yValueLabel.setAttribute('for', '1');
    yValueLabel.innerHTML = 'Значение ДА на русском:';
    yValue.setAttribute('type', 'text');
    yValue.setAttribute('id', id + 1);
    yValue.setAttribute('name', 'YORNElementYesValue[]');

    nValueLabel.setAttribute('for', '1');
    nValueLabel.innerHTML = 'Значение НЕТ на русском:';
    nValue.setAttribute('type', 'text');
    nValue.setAttribute('id', id + 1);
    nValue.setAttribute('name', 'YORNElementNoValue[]');

    box.setAttribute('class', 'box');

    subcategoryLabel.setAttribute('for', id + 2);
    subcategoryLabel.innerHTML = 'Подкатегория (если поле пустое, будет использоваться Категория [блок])::';
    subcategory.setAttribute('name', 'YORNElementSubcategory[]');
    subcategory.setAttribute('id', id + 2);
    subcategory.setAttribute('class', 'subcategoryValues');

    var option = document.createElement('option');
    option.setAttribute('value', '');
    option.innerHTML = '---';

    var option2 = document.createElement('option');
    option2.setAttribute('value', '');
    option2.innerHTML = '---';

    var option3 = document.createElement('option');
    option3.setAttribute('value', '');
    option3.innerHTML = '---';

    //category.append(option3);
    subcategory.append(option);
    parentElement.append(option2);

    if (!(typeof categoriesJSON == "undefined")) {
        categoriesJSON.forEach(function (categoryEl) {
            var option = document.createElement('option');

            option.setAttribute('value', categoryEl['id']);
            option.innerHTML = categoryEl['r_name'];

            category.append(option);
        });
    }

    if (!(typeof subcategoriesJSON == "undefined")) {
        subcategoriesJSON.forEach(function (subcategoryEl) {
            var option = document.createElement('option');

            option.setAttribute('value', subcategoryEl['id']);
            option.innerHTML = subcategoryEl['r_name'];

            subcategory.append(option);
        });
    }

    if (!(typeof elementsJSON == "undefined")) {
        elementsJSON.forEach(function (el) {
            var option = document.createElement('option');

            option.setAttribute('value', el['id']);
            option.innerHTML = el['r_name'];

            parentElement.append(option);
        });
    }

    ru_label.setAttribute('for', id + 3);
    ru_label.innerHTML = 'Название элемента на русском:';
    ru_input.setAttribute('type', 'text');
    ru_input.setAttribute('id', id + 3);
    ru_input.setAttribute('name', 'YORNRName[]');

    eng_label.setAttribute('for', id + 4);
    eng_label.innerHTML = 'Название элемента на английском:';
    eng_input.setAttribute('type', 'text');
    eng_input.setAttribute('id', id + 4);
    eng_input.setAttribute('name', 'YORNEName[]');

    hidden_input.setAttribute('type', 'hidden');
    hidden_input.setAttribute('name', 'formID');
    hidden_input.setAttribute('value', formId);

    deleteBtn.setAttribute('href', '#');
    deleteBtn.setAttribute('class', 'deleteElement button');
    deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
    deleteBtn.innerHTML = "Удалить";

    messages.html('');

    if (elements.html() === '') {
        var a = document.createElement('a');

        a.setAttribute('href', '#');
        a.setAttribute('id', 'saveElems');
        a.setAttribute('class', 'button');
        a.innerHTML = 'Сохранить элементы';

        elements.append(hidden_input);
        elements.append(a);
    }

    box.append(deleteBtn);
    box.append(h2);

    var checkboxLabel = document.createElement('label'),
        checkbox = document.createElement('input'),
        br = document.createElement('br');

    checkbox.setAttribute('name', 'YORNCheckbox[]');
    checkbox.setAttribute('type', 'checkbox');
    checkbox.setAttribute('checked', '');
    checkboxLabel.innerHTML = 'Блок находиться только в объекте ';
    checkboxLabel.append(checkbox);
    //box.append(checkboxLabel);
    //box.append(br);

    box.append(categoryLabel);
    box.append(category);
    box.append(subcategoryLabel);
    box.append(subcategory);
    box.append(parentElementLabel);
    box.append(parentElement);
    box.append(ru_label);
    box.append(ru_input);
    box.append(eng_label);
    box.append(eng_input);
    box.append(yValueLabel);
    box.append(yValue);
    box.append(nValueLabel);
    box.append(nValue);

    elements.prepend(box);
}

/**
 * Добавляет элемент Список
 * @param elements
 */
function addListEl(elements) {
    var box = document.createElement('div'),
        optionsBox = document.createElement('div'),

        objectLabel = document.createElement('label'),
        object = document.createElement('select'),

        categoryLabel = document.createElement('label'),
        category = document.createElement('select'),

        subcategoryLabel = document.createElement('label'),
        subcategory = document.createElement('select'),

        ru_label = document.createElement('label'),
        eng_label = document.createElement('label'),

        ru_input = document.createElement('input'),
        eng_input = document.createElement('input'),

        hidden_input = document.createElement('input'),
        messages = $('.messages'),

        addOptionBtn = document.createElement('a'),
        deleteBtn = document.createElement('a'),
        id = 'id' + Math.floor(Date.now()),
        h2 = document.createElement('h2'),

        parentElementLabel = document.createElement('label'),
        parentElement = document.createElement('select');

    parentElementLabel.setAttribute('for', id + 5);
    parentElementLabel.innerHTML = 'Родительский элемент, если не указан, будет использоваться "Подкатегория" или "Категория (Блок)":';
    parentElement.setAttribute('name', 'listParentElement[]');
    parentElement.setAttribute('id', id + 6);
    parentElement.setAttribute('class', 'parentElementValues');

    optionsBox.setAttribute('class', 'options');

    box.setAttribute('class', 'box list');

    h2.innerHTML = 'Элемент [Список]';
    h2.setAttribute('style', 'padding-bottom: 15px;');

    categoryLabel.setAttribute('for', id + 5);
    categoryLabel.innerHTML = 'Категория (блок):';
    category.setAttribute('name', 'listElementCategory[]');
    category.setAttribute('id', id + 5);
    category.setAttribute('class', 'categoryValues');

    subcategoryLabel.setAttribute('for', id + 2);
    subcategoryLabel.innerHTML = 'Подкатегория (если поле пустое, будет использоваться Категория [блок]):';
    subcategory.setAttribute('name', 'listElementSubcategory[]');
    subcategory.setAttribute('id', id + 2);
    subcategory.setAttribute('class', 'subcategoryValues');

    var option = document.createElement('option');
    option.setAttribute('value', '');
    option.innerHTML = '---';

    var option2 = document.createElement('option');
    option2.setAttribute('value', '');
    option2.innerHTML = '---';

    var option3 = document.createElement('option');
    option3.setAttribute('value', '');
    option3.innerHTML = '---';

    //category.append(option3);
    subcategory.append(option);
    parentElement.append(option2);

    if (!(typeof categoriesJSON == "undefined")) {
        categoriesJSON.forEach(function (categoryEl) {
            var option = document.createElement('option');

            option.setAttribute('value', categoryEl['id']);
            option.innerHTML = categoryEl['r_name'];

            category.append(option);
        });
    }

    if (!(typeof subcategoriesJSON == "undefined")) {
        subcategoriesJSON.forEach(function (subcategoryEl) {
            var option = document.createElement('option');

            option.setAttribute('value', subcategoryEl['id']);
            option.innerHTML = subcategoryEl['r_name'];

            subcategory.append(option);
        });
    }

    if (!(typeof elementsJSON == "undefined")) {
        elementsJSON.forEach(function (el) {
            var option = document.createElement('option');

            option.setAttribute('value', el['id']);
            option.innerHTML = el['r_name'];

            parentElement.append(option);
        });
    }

    ru_label.setAttribute('for', id + 3);
    ru_label.innerHTML = 'Название элемента на русском:';
    ru_input.setAttribute('type', 'text');
    ru_input.setAttribute('id', id + 3);
    ru_input.setAttribute('name', 'listRName[]');

    eng_label.setAttribute('for', id + 4);
    eng_label.innerHTML = 'Название элемента на английском:';
    eng_input.setAttribute('type', 'text');
    eng_input.setAttribute('id', id + 4);
    eng_input.setAttribute('name', 'listEName[]');

    hidden_input.setAttribute('type', 'hidden');
    hidden_input.setAttribute('name', 'formID');
    hidden_input.setAttribute('value', formId);

    deleteBtn.setAttribute('href', '#');
    deleteBtn.setAttribute('class', 'deleteElement button');
    deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
    deleteBtn.innerHTML = "Удалить";

    addOptionBtn.setAttribute('href', '#');
    addOptionBtn.setAttribute('class', 'addOptionInBox button');
    addOptionBtn.innerHTML = "Добавить элемент списка";

    messages.html('');

    if (elements.html() === '') {
        var a = document.createElement('a');

        a.setAttribute('href', '#');
        a.setAttribute('id', 'saveElems');
        a.setAttribute('class', 'button');
        a.innerHTML = 'Сохранить элементы';

        elements.append(hidden_input);
        elements.append(a);
    }

    box.append(deleteBtn);
    box.append(h2);

    var checkboxLabel = document.createElement('label'),
        checkbox = document.createElement('input'),
        br = document.createElement('br');

    checkbox.setAttribute('name', 'listCheckbox[]');
    checkbox.setAttribute('type', 'checkbox');
    checkbox.setAttribute('checked', '');
    checkboxLabel.innerHTML = 'Блок находиться только в объекте ';
    checkboxLabel.append(checkbox);
    //box.append(checkboxLabel);
    //box.append(br);

    box.append(categoryLabel);
    box.append(category);
    box.append(subcategoryLabel);
    box.append(subcategory);
    box.append(parentElementLabel);
    box.append(parentElement);
    box.append(ru_label);
    box.append(ru_input);
    box.append(eng_label);
    box.append(eng_input);
    box.append(addOptionBtn);
    box.append(optionsBox);

    elements.prepend(box);
}

/**
 * Добавляет значение списка в бокс элемента
 * @param elBox
 */
function addOption(elBox) {
    var box = document.createElement('div'),
        id = 'id' + Math.floor(Date.now()),
        r_label = document.createElement('label'),
        e_label = document.createElement('label'),
        r_input = document.createElement('input'),
        e_input = document.createElement('input'),
        deleteBtn = document.createElement('a');

    r_label.setAttribute('for', id + 1);
    r_label.innerHTML = 'Значение списка на русском:';
    r_input.setAttribute('type', 'text');
    r_input.setAttribute('id', id + 1);
    r_input.setAttribute('name', 'optionRName[]');

    e_label.setAttribute('for', id + 2);
    e_label.innerHTML = 'Значение списка на английском:';
    e_input.setAttribute('type', 'text');
    e_input.setAttribute('id', id + 2);
    e_input.setAttribute('name', 'optionEName[]');

    deleteBtn.setAttribute('href', '#');
    deleteBtn.setAttribute('class', 'deleteElement button');
    deleteBtn.setAttribute('style', 'position: absolute; top: 10px; right: 10px;');
    deleteBtn.innerHTML = "Удалить";

    box.setAttribute('class', 'box optionBox');
    box.setAttribute('style', 'border: solid 1px black;');

    box.append(deleteBtn);
    box.append(r_label);
    box.append(r_input);
    box.append(e_label);
    box.append(e_input);

    elBox.prepend(box);
}

function updateElements(elements) {
    elementsJSON = elements;

    var elTable = $('#elementsTable');

    elTable.find('tr').each(function (index, el) {
        if (!(this.id == 'need')) {
            el.remove();
        }
    });

    if (!(typeof elementsJSON == "undefined")) {
        elementsJSON.forEach(function (element) {
            var lastTr = elTable.find('tr:last-child');
            var tr = document.createElement('tr'),
                td1 = document.createElement('td'),
                td2 = document.createElement('td'),
                td3 = document.createElement('td'),
                td4 = document.createElement('td'),
                td5 = document.createElement('td'),
                td6 = document.createElement('td'),
                td7 = document.createElement('td'),
                a = document.createElement('a');

            a.setAttribute('id', 'element_' + element.id);
            a.setAttribute('style', 'margin: 0;');
            a.setAttribute('class', 'button elDelButton');
            a.setAttribute('href', '#');
            a.innerHTML = 'Удалить';

            var type;

            console.log(element);

            switch (element['type']) {
                case "1":
                    type = 'Элемент [От-До]';
                    break;
                case "2":
                    type = 'Элемент [Да/Нет]';
                    break;
                case "3":
                    type = 'Элемент [Список]';
                    break;
            }

            var category = searchParam(categoriesJSON, element.category)['r_name'],
                subcategoy = searchParam(subcategoriesJSON, element.subcategory)['r_name'],
                parent = searchParam(elementsJSON, element.parent_el)['r_name'];

            td1.innerHTML = element.r_name;
            td2.innerHTML = element.e_name;
            td3.innerHTML = category ? category : '';
            td4.innerHTML = subcategoy ? subcategoy : '';
            td5.innerHTML = parent ? parent : '';
            td6.innerHTML = type;
            td7.append(a);

            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            tr.append(td4);
            tr.append(td5);
            tr.append(td6);
            tr.append(td7);

            lastTr.after(tr);
        });

        $('#elements').find('.parentElementValues').each(function (index, el) {
            el.innerHTML = '';

            elementsJSON.forEach(function (element) {
                var option = document.createElement('option');

                option.setAttribute('value', element['id']);
                option.innerHTML = element['r_name'];

                el.append(option);
            });
        });
    }
}

function searchParam(params, need) {
    var result = '';

    params.forEach(function (param) {
        console.log(param[0]);
        if (param[0] == need) {
            result = param;
        }
    });

    return result ? result : '';
}

function updateSubcategories(subcategories) {
    subcategoriesJSON = subcategories;

    var subcategoriesTable = $('#subcategoriesTable');

    subcategoriesTable.find('tr').each(function (index, el) {
        if (!(this.id == 'need')) {
            el.remove();
        }
    });

    var lastTr = subcategoriesTable.find('tr:last-child');

    if (!(typeof subcategoriesJSON == "undefined")) {
        subcategoriesJSON.forEach(function (subcategory) {
            var tr = document.createElement('tr'),
                td1 = document.createElement('td'),
                td2 = document.createElement('td'),
                td3 = document.createElement('td'),
                td4 = document.createElement('td'),
                a = document.createElement('a');

            a.setAttribute('id', 'subcategory_' + subcategory.id);
            a.setAttribute('style', 'margin: 0;');
            a.setAttribute('class', 'button subcategoryDelButton');
            a.setAttribute('href', '#');
            a.innerHTML = 'Удалить';

            td1.innerHTML = subcategory.r_name;
            td2.innerHTML = subcategory.e_name;
            //console.log(categoriesJSON);
            td3.innerHTML = searchParam(categoriesJSON, subcategory.category_id)['r_name'];
            td4.append(a);

            tr.append(td1);
            tr.append(td2);
            tr.append(td3);
            tr.append(td4);

            lastTr.after(tr);
        });

        $('#elements').find('.subcategoryValues').each(function (index, el) {
            el.innerHTML = '';

            var option = document.createElement('option');
            option.setAttribute('value', '');
            option.innerHTML = '---';

            el.append(option);

            subcategoriesJSON.forEach(function (category) {
                var option = document.createElement('option');

                option.setAttribute('value', category['id']);
                option.innerHTML = category['r_name'];

                el.append(option);
            });
        });
    }
}

function updateCategories(categories) {
    categoriesJSON = categories;

    var categoriesTable = $('#categoriesTable');

    categoriesTable.find('tr').each(function (index, el) {
        if (!(this.id == 'need')) {
            el.remove();
        }
    });

    var lastTr = categoriesTable.find('tr:last-child');

    if (!(typeof categoriesJSON == "undefined")) {
        categoriesJSON.forEach(function (category) {
            var tr = document.createElement('tr'),
                td1 = document.createElement('td'),
                td2 = document.createElement('td'),
                td3 = document.createElement('td'),
                a = document.createElement('a');

            a.setAttribute('id', 'category_' + category.id);
            a.setAttribute('style', 'margin: 0;');
            a.setAttribute('class', 'button categoryDelButton');
            a.setAttribute('href', '#');
            a.innerHTML = 'Удалить';

            td1.innerHTML = category.r_name;
            td2.innerHTML = category.e_name;
            td3.append(a);

            tr.append(td1);
            tr.append(td2);
            tr.append(td3);

            lastTr.after(tr);
        });
    }

    var select = $('#subcategories').find('select');

    select.each(function (index, el) {
        el.innerHTML = '';

        categoriesJSON.forEach(function (category) {
            var option = document.createElement('option');

            option.setAttribute('value', category['id']);
            option.innerHTML = category['r_name'];

            el.append(option);
        });
    });

    var elOptions = $('#elements').find('.categoryValues');

    elOptions.each(function (index, el) {
        el.innerHTML = '';

        var option = document.createElement('option');
        option.setAttribute('value', '');
        option.innerHTML = '---';

        el.append(option);

        categoriesJSON.forEach(function (category) {
            var option = document.createElement('option');

            option.setAttribute('value', category['id']);
            option.innerHTML = category['r_name'];

            el.append(option);
        });
    });
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