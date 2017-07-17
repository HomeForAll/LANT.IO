
var params = {

    // параметры квартиры
    count_rooms: {
        name: "count_rooms",
        title: "Количество комнат",
        type: "checkbox",
        value: ["1", "2", "3", "4", "4+"]
    },
    count_rooms_num: {
        name: "count_rooms_num",
        title: "Количество комнат",
        type: "from-to",
    },

    area_only: {
        name: "area_only",
        title: "Площадь",
        type: "from-to",
    },
    area_residential: {
        name: "area_residential",
        title: "Площадь жилая",
        type: "from-to",
    },
    area_non_residential: {
        name: "area_non_residential",
        title: "Площадь нежилая",
        type: "from-to",
    },
    area_general: {
        name: "area_general",
        title: "Площадь общая",
        type: "from-to",
    },
    area_balcony: {
        name: "area_balcony",
        title: "Площадь балкон",
        type: "from-to",
    },

    height_ceiling: {
        name: "height_ceiling",
        title: "Высота потолков",
        type: "from-to"
    },
    floor: {
        name: "floor",
        title: "Этаж",
        type: "from-to" // Любой
    },
    bathroom: {
        name: "bathroom",
        title: "Санузел",
        type: "checkbox",
        value: ["Совмещенный", "Раздельный", "Не важно"]
    },

    // Ремонт и обустройство
    rooms: {
        name: "rooms",
        title: "Комнаты",
        type: "checkbox",
        value: ["Спальня", "Кухня", "Гостиная", "Прихожая", "Детская", "Рабочий кабинет", "Столовая", "Ванная"]
    },
    equipment: {
        name: "equipment",
        title: "Комплектация",
        type: "checkbox",
        value: ["Укомплектована", "Пустая"]
    },
    decoration: {
        name: "decoration",
        title: "Отделка",
        type: "checkbox",
        value: ["Эксклюзивного качества", "Высококачественная отделка", "Хорошая отделка", "Требуется косметический ремонт", "Требуется ремонт", "Незавершенный ремонт", "Без ремонта"]
    },

    // Характеристики дома
    count_floors: {
        name: "count_floors",
        title: "Количество этажей",
        type: "from-to"
    },
    lift: {
        name: "lift",
        title: "Наличие лифта",
        type: "checkbox",
        value: ["Грузовой", "Пассажирский", "Не важно", "Без лифта"]
    },
    garbage: {
        name: "garbage",
        title: "Наличие мусоропровода",
        type: "checkbox",
        value: ["Да"]
    },
    object_type: {
        name: "object_type",
        title: "Уточнение вида объекта",
        type: "checkbox",
        value: ["Новостройка", "Незавершенное строительство", "Участок с подрядом", "Собственность менее 5 лет", "Собственность более 5 лет"]
    },
    object_type_plot: {
        name: "object_type_plot",
        title: "Уточнение вида объекта",
        type: "checkbox",
        value: ["Собственность менее 5 лет", "Собственность более 5 лет", "Сельскохозяйственные земли", "Земли под размещение промышленных и коммерческих объектов"]
    },
    year_building: {
        name: "year_building",
        title: "Год постройки/окончания строительства",
        type: "from-to"
    },
    hc_services: {
        name: "hc_services",
        title: "Жилищно-коммунальные услуги",
        type: "checkbox",
        value: ["Отопление", "Газ", "Электричество", "Водопровод"]
    },
    hc_services_nr: {
        name: "hc_services_nr",
        title: "Жилищно-коммунальные услуги",
        type: "checkbox",
        value: ["Элетричество", "Водопровод и канализация", "Наличие санузлов"]
    },
    parking: {
        name: "parking",
        title: "Парковка",
        type: "checkbox",
        value: ["Многоуровневый парикнг", "Подземная парковка", "Гаражный комплекс", "Придомовый гараж", "Муниципальная платная", "Муниципальная бесплатная", "Отсутствует", "Не важно"]
    },
    wall_material: {
        name: "wall_material",
        title: "Материал стен (список)",
        type: "checkbox",
        value: ["Кирпич", "Монолит", "Железобетонные панели", "Другое"]
    },
    state_stairs: {
        name: "state_stairs",
        title: "Состояние лестничных клеток (список)",
        type: "checkbox",
        value: ["Высококачественная отделка", "Обычная отделка", "Требуется косметический ремонт", "Требуется ремонт", "Без ремонта"]
    },
    security: {
        name: "security",
        title: "Безопасность",
        type: "checkbox",
        value: ["Консьерж", "Охрана", "Домофон", "Видеонаблюдение", "Сигнализация"]
    },

    roofing: {
        name: "roofing",
        title: "Кровля",
        type: "checkbox",
        value: ["Железо", "Медь", "Металлочерепица", "Бескобетонная черепица", "Черепица", "Солома", "Камень", "Шифер", "Ондулин", "Временная"]
    },
    foundation: {
        name: "foundation",
        title: "Фундамент",
        type: "checkbox",
        value: ["Монолитная плета", "Шведская плита", "Ленточный", "Ростверк", "Без фундамента"]
    },
    wall_material_house: {
        name: "wall_material_house",
        title: "Материал стен",
        type: "checkbox",
        value: ["Кирпич", "Железобетон", "Пеноблок", "Газосиликатные блоки", "Шлакоблоки", "Рубленное дерево", "Лафет", "Оцилиндрованное бревно", "Профилированный брус", "Клеенный брус", "Фахтверк"]
    },
    type_house: {
        name: "type_house",
        title: "Тип дома",
        type: "checkbox",
        value: ["Дуплекс", "Таунхаус", "Коттедж"]
    },

    view_buildings: {
        name: "view_buildings",
        title: "Вид постройки",
        type: "checkbox",
        value: ["Опен спейс", "Комнаты"]
    },
    type_buildings: {
        name: "type_buildings",
        title: "Тип здания",
        type: "checkbox",
        value: ["Административное", "Жилое"]
    },

    // Участок
    add_buildings: {
        name: "add_buildings",
        title: "Дополнительные строения",
        type: "checkbox",
        value: ["Беседка", "Сарай", "Винный погреб", "Детская площадка", "Бассейн", "Баня", "Гостевой дом", "Сторожка"]
    },
    plot: {
        name: "plot",
        title: "Участок",
        type: "checkbox",
        value: ["Ровный", "Неровный", "На склоне", "Овраг", "Заболоченный"]
    },
    on_plot: {
        name: "on_plot",
        title: "На участке",
        type: "checkbox",
        value: ["Лесные деревья", "Садовые деревья", "Родник", "Река", "Берег водоема"]
    },
    guardrail: {
        name: "guardrail",
        title: "Ограждение",
        type: "checkbox",
        value: ["Пластик", "Дерево", "Профнастил", "Камень", "Бетон", "Кирпич", "Металлические прутья", "Кованная ограда"]
    },









    // Объект размещен
    hosted: {
        name: "hosted",
        title: "Объект размещен",
        type: "checkbox",
        value: ["Собственником", "Риэлтором", "Не важно"]
    },

    // Документы
    documens: {
        name: "documents",
        title: "Документы",
        type: "checkbox",
        value: ["Документы на право владения", "Договор аренды", "Документы на собственность"]
    },

    // Вложения
    project: {
        name: "project",
        title: "Проект планировки",
        type: "checkbox",
        value: ["Прилагается"]
    },
    project3d: {
        name: "project3d",
        title: "3D проект (выбор пользователя)",
        type: "checkbox",
        value: ["Прилагается"]
    },
    video: {
        name: "video",
        title: "Видео",
        type: "checkbox",
        value: ["Прилагается"]
    },
};











var aaaa = {


    asdsdad: {
        title: "title",
        type: "checkbox",
        value: ["value", "value", "value"]
    },
    asdsdad: {},
    asdsdad: {},
    asdsdad: {},
    asdsdad: {},
    asdsdad: {},
    asdsdad: {},
    asdsdad: {},
};





var data_all = [1,2,3,4,5,6,7,8,9,10,11,12,13,14];

// Квартира
data_all[1] = [];
data_all[1].push({
    title: "Исходные параметры квартиры",
    data: [
        params.count_rooms,
        params.area_residential,
        params.area_non_residential,
        params.area_general,
        params.area_balcony,
        params.height_ceiling,
        params.floor,
        params.bathroom,
        params.hosted
    ]
});
data_all[1].push({
    title: "Ремонт и обустройство квартиры",
    data: [
        params.rooms,
        params.equipment,
        params.decoration
    ]
});
data_all[1].push({
    title: "Характеристики дома",
    data: [
        params.count_floors,
        params.lift,
        params.garbage,
        params.object_type,
        params.year_building,
        params.hc_services,
        params.parking,
        params.wall_material,
        params.state_stairs,
        params.security
    ]
});
data_all[1].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// Дом
data_all[2] = [];
data_all[2].push({
    title: "Параметры объекта",
    data: [
        params.count_rooms,
        params.count_floors,
        params.area_residential,
        params.area_non_residential,
        params.area_general,
        params.area_balcony,
        params.height_ceiling,
        params.bathroom,
        params.roofing,
        params.foundation,
        params.wall_material_house,
        params.type_house,
        params.hosted
    ]
});
data_all[2].push({
    title: "Ремонт и обустройство",
    data: [
        params.rooms,
        params.equipment,
        params.decoration,
        params.object_type,
        params.year_building,
        params.hc_services,
        params.security
    ]
});
data_all[2].push({
    title: "Участок",
    data: [
        params.parking,
        params.add_buildings,
        params.plot,
        params.on_plot,
        params.guardrail,

    ]
});
data_all[2].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// Комната
data_all[3] = [];
data_all[3].push({
    title: "Исходные параметры квартиры",
    data: [
        params.count_rooms,
        params.area_residential,
        params.area_non_residential,
        params.area_general,
        params.area_balcony,
        params.height_ceiling,
        params.floor,
        params.bathroom,
        params.hosted
    ]
});
data_all[3].push({
    title: "Ремонт и обустройство квартиры",
    data: [
        params.rooms,
        params.equipment,
        params.decoration
    ]
});
data_all[3].push({
    title: "Характеристики дома",
    data: [
        params.count_floors,
        params.lift,
        params.garbage,
        params.object_type,
        params.year_building,
        params.hc_services,
        params.parking,
        params.wall_material,
        params.state_stairs,
        params.security
    ]
});
data_all[3].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});


// Земельный участок
data_all[4] = [];
data_all[4].push({
    title: "Основные параметры",
    data: [
        params.area_only,
        params.object_type_plot,
        params.plot,
        params.on_plot
    ]
});
data_all[4].push({
    title: "Обустройство",
    data: [
        params.hc_services,
        params.parking,
        params.add_buildings,
        params.guardrail,
        params.security
    ]
});
data_all[4].push({
    title: "Объект размещен",
    data: [ params.hosted ]
});
data_all[4].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});


// Гараж/машиноместо
data_all[5] = [];
data_all[5].push({
    title: "Основное",
    data: [
        params.area_only,
        params.height_ceiling,
        params.count_floors,
        params.security,
        params.year_building,
        params.object_type,
        params.guardrail,
    ]
});
data_all[5].push({
    title: "Дополнительно",
    data: [
        params.roofing,
        params.foundation,
        params.wall_material_house
    ]
});
data_all[5].push({
    title: "Объект размещен",
    data: [ params.hosted ]
});
data_all[5].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});




// Офисная площадь
data_all[8] = [];
data_all[8].push({
    title: "Исходные параметры",
    data: [
        params.area_only,
        params.height_ceiling,
        params.count_floors,
        params.view_buildings,
        params.count_rooms_num,
        params.year_building,
        params.type_buildings,
        params.wall_material_house,
        params.roofing,
        params.foundation,
        params.hosted,
    ]
});
data_all[8].push({
    title: "Ремонт и обустройство",
    data: [
        params.decoration,
        params.hc_services_nr,
        params.parking,
        params.guardrail,
        params.security,
    ]
});
data_all[8].push({
    title: "Документы",
    data: [ params.documens ]
});
data_all[8].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// Офисная площадь с землей
data_all[9] = [];
data_all[9].push({
    title: "Исходные параметры",
    data: [
        params.area_only,
        params.height_ceiling,
        params.count_floors,
        params.view_buildings,
        params.count_rooms_num,
        params.year_building,
        params.type_buildings,
        params.wall_material_house,
        params.roofing,
        params.foundation,
        params.hosted,
    ]
});
data_all[9].push({
    title: "Ремонт и обустройство",
    data: [
        params.decoration,
        params.hc_services_nr,
        params.parking,
        params.guardrail,
        params.security,
    ]
});
data_all[9].push({
    title: "Документы",
    data: [ params.documens ]
});
data_all[9].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// Торговая площадь
data_all[10] = [];
data_all[10].push({
    title: "Исходные параметры",
    data: [
        params.area_only,
        params.height_ceiling,
        params.count_floors,
        params.view_buildings,
        params.count_rooms_num,
        params.year_building,
        params.type_buildings,
        params.wall_material_house,
        params.roofing,
        params.foundation,
        params.hosted,
    ]
});
data_all[10].push({
    title: "Ремонт и обустройство",
    data: [
        params.decoration,
        params.hc_services_nr,
        params.parking,
        params.guardrail,
        params.security,
    ]
});
data_all[10].push({
    title: "Документы",
    data: [ params.documens ]
});
data_all[10].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// Торговое здание
data_all[11] = [];
data_all[11].push({
    title: "Исходные параметры",
    data: [
        params.area_only,
        params.height_ceiling,
        params.count_floors,
        params.view_buildings,
        params.count_rooms_num,
        params.year_building,
        params.type_buildings,
        params.wall_material_house,
        params.roofing,
        params.foundation,
        params.hosted,
    ]
});
data_all[11].push({
    title: "Ремонт и обустройство",
    data: [
        params.decoration,
        params.hc_services_nr,
        params.parking,
        params.guardrail,
        params.security,
    ]
});
data_all[11].push({
    title: "Документы",
    data: [ params.documens ]
});
data_all[11].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// ОСЗ
data_all[12] = [];
data_all[12].push({
    title: "Исходные параметры",
    data: [
        params.area_only,
        params.height_ceiling,
        params.count_floors,
        params.view_buildings,
        params.count_rooms_num,
        params.year_building,
        params.type_buildings,
        params.wall_material_house,
        params.roofing,
        params.foundation,
        params.hosted,
    ]
});
data_all[12].push({
    title: "Ремонт и обустройство",
    data: [
        params.decoration,
        params.hc_services_nr,
        params.parking,
        params.guardrail,
        params.security,
    ]
});
data_all[12].push({
    title: "Документы",
    data: [ params.documens ]
});
data_all[12].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// Комплекс ОСЗ
data_all[13] = [];
data_all[13].push({
    title: "Исходные параметры",
    data: [
        params.area_only,
        params.height_ceiling,
        params.count_floors,
        params.view_buildings,
        params.count_rooms_num,
        params.year_building,
        params.type_buildings,
        params.wall_material_house,
        params.roofing,
        params.foundation,
        params.hosted,
    ]
});
data_all[13].push({
    title: "Ремонт и обустройство",
    data: [
        params.decoration,
        params.hc_services_nr,
        params.parking,
        params.guardrail,
        params.security,
    ]
});
data_all[13].push({
    title: "Документы",
    data: [ params.documens ]
});
data_all[13].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// Рынок/ярмарка
data_all[14] = [];
data_all[14].push({
    title: "Исходные параметры",
    data: [
        params.area_only,
        params.height_ceiling,
        params.count_floors,
        params.view_buildings,
        params.count_rooms_num,
        params.year_building,
        params.type_buildings,
        params.wall_material_house,
        params.roofing,
        params.foundation,
        params.hosted
    ]
});
data_all[14].push({
    title: "Ремонт и обустройство",
    data: [
        params.decoration,
        params.hc_services_nr,
        params.parking,
        params.guardrail,
        params.security,
    ]
});
data_all[14].push({
    title: "Документы",
    data: [ params.documens ]
});
data_all[14].push({
    title: "Вложения",
    data: [
        params.project,
        params.project3d,
        params.video
    ]
});

// Производственно-складские помещения
//data_all[5] = [];


// Производственно-складские здания
//data_all[5] = [];











var max = "?";
$.each(params, function(i, item) {
    max += i + "=10&";
});

console.log(max);



$(".search-main select[name=type]").change(function(){
    if (data_all[$(this).val()]) {
        var data = data_all[$(this).val()];

    if (typeof data === 'object') {
        //console.log(item);
        $(".search-more").html("");
        var block = $("<div>").addClass("search-block").appendTo(".search-more");

        $("<p>").html("<b>Найдено 13 245 объектов</b> Заполните данные ниже, для более точного поиска").appendTo(block);


        var block = $("<div>").addClass("search-flex").appendTo(block);
        var modals = $("<div>").addClass("search-modals").hide().appendTo(".search-more");

        $.each(data, function(i, item) {
            if (item.title !== undefined && item.data !== undefined) {

                var _modal = $("<div>").addClass("search-modal").appendTo(modals);

                var button = $("<div>").addClass("search-more-button").addClass("search-flex").click(function(){
                    _modal.arcticmodal();
                }).appendTo(block);
                $("<div>").html(item.title).appendTo(button);


                //var block = $("<div>").addClass("search-block").appendTo(".search-more");


                var page = $("<div>").addClass("search-modal-title").html(item.title).appendTo(_modal);
                var modal = $("<div>").addClass("search-modal-body").appendTo(_modal);
                $.each(item.data, function(i, item) {
                    if (item.type == 'checkbox') {

                        var line = $("<div>").addClass("search-flex").addClass("search-modal-line").appendTo(modal);
                        $("<div>").addClass("search-modal-label").html(item.title).appendTo(line);
                        var value = $("<div>").addClass("search-flex").addClass("search-modal-value").appendTo(line);

                        $("<input>").prop("type", "hidden").prop("name", item.name).appendTo(value);

                        var select = $("<select>").data("placeholder", "Выберете параметры...").prop("multiple", "multiple").appendTo(value);
                        $.each(item.value, function(id, item) {
                            $("<option>").val(id).html(item).appendTo(select);
                        });

                        var name = item.name;
                        select.chosen({
                            width: "320px",
                            placeholder_text_multiple: "Выберете параметры..."
                        }).change(function(evt, params) {
                            //console.log(select.val())
                            if (select.val() !== null) {
                                $("input[name=" + name + "]").val(select.val().join(','));
                            }
                        });
                        /*
                        $.each(item.value, function(id, item) {
                            var label = $("<label>").html(item).appendTo(value);

                            $("<input>").prop("type", "checkbox").val(id).addClass("search-modal-value-" + name).change(function(){
                                var val = [];
                                $(".search-modal-value-" + name).filter(':checked').each(function(i, item) {
                                    val.push($(this).val());
                                });
                                $("input[name=" + name + "]").val(val.join(','));
                            }).prependTo(label);
                        });
                        */
                    }

                    if (item.type == 'from-to') {
                        var line = $("<div>").addClass("search-flex").addClass("search-modal-line").appendTo(modal);
                        $("<div>").addClass("search-modal-label").html(item.title).appendTo(line);
                        var value = $("<div>").addClass("search-flex").addClass("search-modal-value").appendTo(line);

                        var label = $("<label>").html("от ").appendTo(value);
                        $("<input>").prop("type", "number").prop("name", item.name+"[from]").appendTo(label);

                        var label = $("<label>").html("до ").appendTo(value);
                        $("<input>").prop("type", "number").prop("name", item.name+"[to]").appendTo(label);
                    }
                });
                var modal = $("<div>").addClass("arcticmodal-close").addClass("search-modal-ok").html("Готово").appendTo(modal);

            }
        });
    }
    }
});





$.fn.ImageSelect = function() {

    console.log(arguments[0]);

    switch (typeof (arguments[0])) {
        case 'string': {
        switch (arguments[0]) {
            case 'getVal': {
                //GETTER
                var Selector = $(this).first();
                var val = Selector.find('.head').attr('val');
                return val;
            } break;
            case 'setVal': {
                console.log('setter');
                //SETTER
                var setval = arguments[1];
                return this.each(function () {
                var Selector = $(this);
                var opt = Selector.find('.option[val="' + setval + '"] ');
                Selector.find('.head').attr('val', opt.attr('val'));
                Selector.find('.head').html(opt.html());
                });
            } break;
            default: return this;
            }
        } break;
        case 'object': {
            var width = 194;
            if (arguments[0].width) {
                width = arguments[0].width;
            }

            return this.each(function () {
                var select = $(this);

                var outStr = '';

                var listgroup = '';
                if (select.find('optgroup').length > 0) {
                    select.find('optgroup').each(function() {
                        var optgroup = $(this);
                        listgroup = " listgroup";
                        outStr += '<div class="optgroup">'
                        optgroup.find('option').each(function () {
                            var option = $(this);


                            outStr += '<div class="option" val="' + option.attr('value') + '"  >';
                            if (option.attr('icon') != undefined) outStr += '<img src="' + option.attr('icon') + '"  />';
                            outStr += '<span>' + option.text() + '</span></div>';
                        });
                        outStr += '</div>';
                        //optgroup.remove();
                    });
                } else {
                    select.find('option').each(function () {
                        var option = $(this);
                        outStr += '<div class="option" val="' + option.attr('value') + '"  >';
                        if (option.attr('icon') != undefined) outStr += '<img src="' + option.attr('icon') + '"  />';
                        outStr += '<span>' + option.text() + '</span></div>';
                    });
                }
                var list = $('<div class="list'+listgroup+'" >' + outStr + '</div>');
                var head = $('<div class="head" val=""></div>');

                list.find('.option').each(function () {
                    var opt = $(this);
                    opt.mouseenter(function () {
                        //opt.css({ 'background-color': '#658cbb', 'color': 'white' });
                        opt.find('.normal').hide();
                        opt.find('.hover').show();
                    }).mouseleave(function () {
                        //opt.css({ 'background-color': 'white', 'color': '#333' });
                        opt.find('.normal').show();
                        opt.find('.hover').hide();
                    }).click(function () {
                        var val = opt.attr('val');
                        opt.find('.normal').show();
                        opt.find('.hover').hide();
                        head.attr('val', opt.attr('val'));
                        select.val(head.attr('val'));
                        select.trigger('change');
                        head.html(opt.html());
                    });
                });

                head.attr('val', (list.find('.option').first().attr('val')));
                select.val(head.attr('val'));
                head.html(list.find('.option').first().html());

                head.addClass("search-flex");
                list.find('.option').addClass("search-flex");
                list.find('.option[val=0]').remove();
                //head.find('img').css({ 'height': '14px', 'margin': '2px 0 0 3px' });
                //list.find('img').css({ 'height': '14px', 'margin': '2px 0 0 3px' });

                var newSel = $('<div></div>');

                newSel.attr('id', select.attr('id'));
                newSel.attr('class', select.attr('class'));
                newSel.attr('class', 'select');

                select.after(newSel);
                newSel.append(head).append(list);
                select.hide();

                //list.hide();

                var isClicked = false;
                var isShowed = false;
                //to show
                head.mouseenter(function () {
                    isClicked = true;
                }).mouseleave(function () {
                    isClicked = false;
                }).click(function () {
                    if (isShowed) {
                    //list.hide();
                    newSel.removeClass('show');
                    isShowed = false;
                    return false;
                    }
                });
                //to hide
                $(document).click(function () {
                    if (isClicked) {
                        //list.show();
                        newSel.addClass('show');
                        isShowed = true;
                    } else {
                        newSel.removeClass('show');
                        //list.hide();
                        isShowed = false;
                    }
                });
            });
        } break;
    }
};


$(function(){

    var getSearchParameters = function() {
        function transformToAssocArray( prmstr ) {
            var params = {};
            var prmarr = prmstr.split("&");
            for ( var i = 0; i < prmarr.length; i++) {
                var tmparr = prmarr[i].split("=");
                params[tmparr[0]] = tmparr[1];
            }
            return params;
        }
        var prmstr = window.location.search.substr(1);
        return prmstr != null && prmstr != "" ? transformToAssocArray(prmstr) : {};
    };

//    $( "form" ).on( "submit", function( event ) {
//        event.preventDefault();
//        console.log( $( this ).serialize() );
//    });

    //console.log('init');
    $('.search-main select').ImageSelect({});
    $(".search-advanced-button").click(function(){
        $("#search").toggleClass("search-advanced-show");
    });
    $("input[name=tabs]").change(function(){
        //console.log($("input[name=tabs]:checked").val());
        if ($("input[name=tabs]:checked").val() == 1) {
            $(".search-term").show();
        } else {
            $(".search-term").hide();
        }
    });
    $("#demo-input").tokenInput("https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address", {
        ajaxHeaders: {
            'Authorization': 'Token 0ae4135972ef44bfe9eadfac7eee7b8c821b1c17',
        },
        queryDefault: "Москва ",
        queryParam: "query",
        dataStringify: true,
        method: "POST",
        contentType: "application/json",
        crossDomain: false,
        jsonContainer: "suggestions",
        resultsFormatter: function(item){
            return "<li>" + item.value + "</li>"
        },
        tokenFormatter: function(item) {
            return "<li><input type=\"hidden\" name=\"address[]\" value=\"" + item.value + "\"><span class=\"token-input-title\">" + item.value + "</span></li>"
            //return "<li><p>" + item.first_name + " <b style='color: red'>" + item.last_name + "</b></p></li>"
        },
        placeholder: "Добавление адреса",
        hintText: "Введите поисковый запрос",
        noResultsText: "Нет результатов",
        searchingText: "поиск...",
        deleteText: "",
        //theme: "mac"
    });
});
