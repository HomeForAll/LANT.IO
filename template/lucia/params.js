
var params = {

    // параметры квартиры
    count_rooms: {
        name: "count_rooms",
        title: "Количество комнат",
        cost: "",
        type: "checkbox",
        multiple: false,
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
        cost: "м2",
        type: "from-to",
    },
    area_residential: {
        name: "area_residential",
        title: "Площадь жилая",
        cost: "м2",
        type: "from-to",
    },
    area_non_residential: {
        name: "area_non_residential",
        title: "Площадь нежилая",
        cost: "м2",
        type: "from-to",
    },
    area_general: {
        name: "area_general",
        title: "Площадь общая",
        cost: "м2",
        type: "from-to",
    },
    area_balcony: {
        name: "area_balcony",
        title: "Площадь балкон",
        cost: "м2",
        type: "from-to",
    },

    height_ceiling: {
        name: "height_ceiling",
        title: "Высота потолков",
        cost: "м",
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
        multiple: false,
        value: ["Совмещенный", "Раздельный", "Не важно"]
    },

    // Ремонт и обустройство
    rooms: {
        name: "rooms",
        title: "Комнаты",
        type: "checkbox",
        multiple: true,
        value: ["Спальня", "Кухня", "Гостиная", "Прихожая", "Детская", "Рабочий кабинет", "Столовая", "Ванная"]
    },
    equipment: {
        name: "equipment",
        title: "Комплектация",
        type: "checkbox",
        multiple: false,
        value: ["Укомплектована", "Пустая"]
    },
    decoration: {
        name: "decoration",
        title: "Отделка",
        type: "checkbox",
        multiple: false,
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
        multiple: true,
        value: ["Грузовой", "Пассажирский", "Не важно", "Без лифта"]
    },
    garbage: {
        name: "garbage",
        title: "Наличие мусоропровода",
        type: "checkbox",
        multiple: false,
        value: ["Да"]
    },
    object_type: {
        name: "object_type",
        title: "Уточнение вида объекта",
        type: "checkbox",
        multiple: false,
        value: ["Новостройка", "Незавершенное строительство", "Участок с подрядом", "Собственность менее 5 лет", "Собственность более 5 лет"]
    },
    object_type_plot: {
        name: "object_type_plot",
        title: "Уточнение вида объекта",
        type: "checkbox",
        multiple: false,
        value: ["Собственность менее 5 лет", "Собственность более 5 лет", "Сельскохозяйственные земли", "Земли под размещение промышленных и коммерческих объектов"]
    },
    year_building: {
        name: "year_building",
        title: "Год постройки/окончания строительства",
        cost: "год",
        type: "from-to"
    },
    hc_services: {
        name: "hc_services",
        title: "Жилищно-коммунальные услуги",
        type: "checkbox",
        multiple: true,
        value: ["Отопление", "Газ", "Электричество", "Водопровод"]
    },
    hc_services_nr: {
        name: "hc_services_nr",
        title: "Жилищно-коммунальные услуги",
        type: "checkbox",
        multiple: true,
        value: ["Элетричество", "Водопровод и канализация", "Наличие санузлов"]
    },
    parking: {
        name: "parking",
        title: "Парковка",
        type: "checkbox",
        multiple: true,
        value: ["Многоуровневый парикнг", "Подземная парковка", "Гаражный комплекс", "Придомовый гараж", "Муниципальная платная", "Муниципальная бесплатная", "Отсутствует", "Не важно"]
    },
    wall_material: {
        name: "wall_material",
        title: "Материал стен (список)",
        type: "checkbox",
        multiple: false,
        value: ["Кирпич", "Монолит", "Железобетонные панели", "Другое"]
    },
    state_stairs: {
        name: "state_stairs",
        title: "Состояние лестничных клеток (список)",
        type: "checkbox",
        multiple: false,
        value: ["Высококачественная отделка", "Обычная отделка", "Требуется косметический ремонт", "Требуется ремонт", "Без ремонта"]
    },
    security: {
        name: "security",
        title: "Безопасность",
        type: "checkbox",
        multiple: true,
        value: ["Консьерж", "Охрана", "Домофон", "Видеонаблюдение", "Сигнализация"]
    },

    roofing: {
        name: "roofing",
        title: "Кровля",
        type: "checkbox",
        multiple: false,
        value: ["Железо", "Медь", "Металлочерепица", "Бескобетонная черепица", "Черепица", "Солома", "Камень", "Шифер", "Ондулин", "Временная"]
    },
    foundation: {
        name: "foundation",
        title: "Фундамент",
        type: "checkbox",
        multiple: false,
        value: ["Монолитная плета", "Шведская плита", "Ленточный", "Ростверк", "Без фундамента"]
    },
    wall_material_house: {
        name: "wall_material_house",
        title: "Материал стен",
        type: "checkbox",
        multiple: false,
        value: ["Кирпич", "Железобетон", "Пеноблок", "Газосиликатные блоки", "Шлакоблоки", "Рубленное дерево", "Лафет", "Оцилиндрованное бревно", "Профилированный брус", "Клеенный брус", "Фахтверк"]
    },
    type_house: {
        name: "type_house",
        title: "Тип дома",
        type: "checkbox",
        multiple: false,
        value: ["Дуплекс", "Таунхаус", "Коттедж"]
    },

    view_buildings: {
        name: "view_buildings",
        title: "Вид постройки",
        type: "checkbox",
        multiple: false,
        value: ["Опен спейс", "Комнаты"]
    },
    type_buildings: {
        name: "type_buildings",
        title: "Тип здания",
        type: "checkbox",
        multiple: false,
        value: ["Административное", "Жилое"]
    },

    // Участок
    add_buildings: {
        name: "add_buildings",
        title: "Дополнительные строения",
        type: "checkbox",
        multiple: true,
        value: ["Беседка", "Сарай", "Винный погреб", "Детская площадка", "Бассейн", "Баня", "Гостевой дом", "Сторожка"]
    },
    plot: {
        name: "plot",
        title: "Участок",
        type: "checkbox",
        multiple: false,
        value: ["Ровный", "Неровный", "На склоне", "Овраг", "Заболоченный"]
    },
    on_plot: {
        name: "on_plot",
        title: "На участке",
        type: "checkbox",
        multiple: true,
        value: ["Лесные деревья", "Садовые деревья", "Родник", "Река", "Берег водоема"]
    },
    guardrail: {
        name: "guardrail",
        title: "Ограждение",
        type: "checkbox",
        multiple: false,
        value: ["Пластик", "Дерево", "Профнастил", "Камень", "Бетон", "Кирпич", "Металлические прутья", "Кованная ограда"]
    },









    // Объект размещен
    hosted: {
        name: "hosted",
        title: "Объект размещен",
        type: "checkbox",
        multiple: false,
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
