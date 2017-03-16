function generateForm(id) {
    var formsData = {},
        info = getInfo();

    $.getJSON('/app/config/forms.json', function (data) {
        formsData = data;

        var container = $(id),
            wrapper = document.createElement('div'),
            form = document.createElement('form'),
            submit = document.createElement('input');

        container.html('');

        wrapper.id = 'content_wrap';

        submit.setAttribute('type', 'submit');
        submit.setAttribute('name', 'submit');
        submit.setAttribute('value', 'Найти');

        form.setAttribute('action', '/search');
        form.setAttribute('method', 'post');

        switch (info.operation) {
            case 'rent':
                switch (info.object) {
                    case 'apart':
                        formsData = formsData.rent.apart;
                        break;
                    case 'house':
                        formsData = formsData.rent.house;
                        break;
                    case 'groun':
                        formsData = formsData.rent.ground;
                        break;
                    case 'room':
                        formsData = formsData.rent.room;
                        break;
                }
                break;
            case 'sell':
                switch (info.object) {
                    case 'apart':
                        formsData = formsData.sell.apart;
                        break;
                    case 'house':
                        formsData = formsData.sell.house;
                        break;
                    case 'groun':
                        formsData = formsData.sell.ground;
                        break;
                    case 'room':
                        formsData = formsData.sell.room;
                        break;
                }
                break;
        }

        var span = document.createElement('span');
        span.setAttribute('class', 'formTitle');
        span.innerHTML = formsData.name;
        form.append(span);

        formsData.fieldSets.forEach(function (fieldSet) {
            var fieldSetContainer = document.createElement('fieldset'),
                legend = document.createElement('legend');

            legend.innerHTML = fieldSet.name;

            fieldSetContainer.append(legend);

            fieldSet.blocks.forEach(function (block) {
                var span = document.createElement('span'),
                    div = document.createElement('div');

                span.setAttribute('class', 'title');
                span.innerHTML = block.name + ':<br>';

                div.setAttribute('class', 'indent');

                block.inputs.forEach(function (input) {
                    inputHandler(div, input);
                });

                wrapper.append(span);
                wrapper.append(div);
            });

            fieldSetContainer.append(wrapper);
            form.append(fieldSetContainer);
        });

        form.append(submit);
        container.append(form);
    });
}

function inputHandler(el, input) {
    switch (input.type) {
        case 'text':
            addTextInput(el, input.id, input.name, input.disabled);
            break;
        case 'textRange':
            addTextRangeInput(el, input.idMin, input.idMax, input.name);
            break;
        case 'checkbox':
            addCheckBox(el, input.id, input.name);
            break;
        case 'select':
            addSelect(el, input.id, input.name, input.options);
            break;
    }
}

function addTextInput(el, id, name, disabled) {
    var label = document.createElement('label'),
        input = document.createElement('input');

    label.setAttribute('for', id);
    label.innerHTML = name + ':';

    input.setAttribute('type', 'text');
    input.setAttribute('name', id);
    input.setAttribute('id', id);
    input.setAttribute('value', formData[id] ? formData[id] : '');

    if (disabled) {
        input.setAttribute('disabled', '');
    }

    $(el).append(label);
    $(el).append(input);

    if (id == 'suggest') {
        var map = document.createElement('div');
        map.id = 'yMap';
        map.setAttribute('class', 'map');

        $(el).append(map);

        ymaps.ready(function () {
            window.yMmap = new ymaps.Map(map.id, {
                center: [55.753559, 37.609218],
                zoom: 10,
                controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
            });
            window.suggests[suggest] = new ymaps.SuggestView(suggest, {width: 400, offset: [0, 4], results: 20});

            if (formData[id]) {
                getGeoCodeInfo(formData[id], function (bounds) {
                    move(bounds);
                });
            }
        });
    }
}

function addTextRangeInput(el, minId, maxId, name) {
    var title = document.createElement('div'),
        min = document.createElement('input'),
        max = document.createElement('input');

    title.setAttribute('class', 'title');
    title.innerHTML = name + ':';

    min.setAttribute('type', 'text');
    min.setAttribute('id', minId);
    min.setAttribute('name', minId);
    min.setAttribute('placeholder', 'От');

    max.setAttribute('type', 'text');
    max.setAttribute('id', maxId);
    max.setAttribute('name', maxId);
    max.setAttribute('placeholder', 'До');

    if (formData[minId]) {
        min.setAttribute('value', formData[minId]);
    }

    if (formData[maxId]) {
        max.setAttribute('value', formData[maxId]);
    }

    $(el).append(title);
    $(el).append(min);
    $(el).append(max);
}

function addCheckBox(el, id, name) {
    var checkbox = '<label><input type="checkbox" name="' + id + '" ' + (formData[id] ? 'checked' : '') + '>' + name + '</label><br>',
        label = document.createElement('label'),
        input = document.createElement('input'),
        br = document.createElement('br');

    input.setAttribute('type', 'checkbox');
    input.setAttribute('id', id);
    input.setAttribute('name', id);

    if (formData[id]) {
        input.setAttribute('checked', '');
    }

    label.append(input);
    label.append(name);

    $(el).append(label);
    $(el).append(br);
}

function addSelect(el, id, name, optionsArr) {
    var select = document.createElement('select'),
        label = '<label for="' + id + '">' + name + ':</label>';

    select.setAttribute('name', id);

    for (var i = 0; optionsArr[i]; i++) {
        var option = document.createElement('option');
        option.setAttribute('value', optionsArr[i].value);

        if (formData[id] && optionsArr[i].value == formData[id]) {
            option.setAttribute('selected', '');
        }

        option.innerHTML = optionsArr[i].name;

        select.append(option);
    }

    $(el).append(label);
    $(el).append(select);
}

function getGeoCodeInfo(address, cb) {
    ymaps.geocode(address).then(
        function (res) {
            var object = res.geoObjects.get(0),
                bounds = object.properties.get('boundedBy'),
                coordinates = object.geometry.getCoordinates();

            var country = object.getCountry();
            var area = object.getAdministrativeAreas()[0];
            var city = object.getLocalities();
            getDistrict(coordinates);
            var street = object.getThoroughfare();
            //var house = object.getPremiseNumber();

            $('#country').val(country);
            $('#area').val(area);
            $('#city').val(city);
            $('#street').val(street);

            if (cb) {
                cb(bounds, {});
            }
        }
    );
}

function getDistrict(coordinates) {
    ymaps.geocode(coordinates, {
        kind: 'district'
    }).then(
        function (res) {
            var object, district;

            if (res.geoObjects.get(0) === undefined) {
                return false;
            } else {
                object = res.geoObjects.get(0);
                district = object.properties.getAll().name;
            }

            $('#district').val(district);
        }
    );
}

function move(bounds) {
    window.yMmap.setBounds(bounds, {
        checkZoomRange: true
    });
}

function getInfo() {
    var object = document.getElementById('object'),
        operation = document.getElementById('operation');

    return {
        "object": object.value,
        "operation": operation.value
    };
}