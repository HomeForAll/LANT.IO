/** Фильтры бибилотек **/
var data = [
        {id: 0, text: 'Москва и область'},
        {id: 1, text: 'Москва и область2'},
        {id: 2, text: 'Москва и область3'},
        {id: 3, text: 'Москва и область4'},
        {id: 4, text: 'Москва и область5'}
    ],
    locationApartments = [
        {id: 0, text: 'Квартира'},
        {id: 1, text: 'Квартира2'},
        {id: 2, text: 'Квартира3'},
        {id: 3, text: 'Квартира4'},
        {id: 4, text: 'Квартира5'}
    ],
    material = [
        {id: 0, text: 'Пластик'},
        {id: 1, text: 'Дерево'},
        {id: 2, text: 'Профнастил'},
        {id: 3, text: 'Камень'},
        {id: 4, text: 'Бетон'},
        {id: 5, text: 'Кирпич'},
        {id: 6, text: 'Металлические прутья'},
        {id: 7, text: 'Кованая ограда'}
    ],
    wall_material = [
        {id: 0, text: 'Другое', value: 91},
        {id: 1, text: 'Железобетонные панели', value: 32},
        {id: 2, text: 'Монолит', value: 78},
        {id: 3, text: 'Кирпич', value: 19}
    ],
    owner = [
        {id: 0, text: 'Собственник'},
        {id: 1, text: 'Собственник2'},
        {id: 2, text: 'Собственник3'},
        {id: 3, text: 'Собственник4'},
        {id: 4, text: 'Собственник5'}
    ],
    municipal = [
        {id: 0, text: 'Платная', value: 94},
        {id: 1, text: 'Бесплатная', value: 51}
    ],
    parking = [
        {id: 0, text: 'Не важно', value: 41},
        {id: 1, text: 'Отсутствует', value: 5},
        {id: 2, text: 'Придомовой гараж', value: 7},
        {id: 3, text: 'Гаражный комплекс', value: 52},
        {id: 4, text: 'Подземная парковка', value: 132},
        {id: 5, text: 'Многоуровневый паркинг', value: 81}
    ],
    floor = [
        {id: 0, text: 'Любой'},
        {id: 1, text: 'Любой2'},
        {id: 2, text: 'Любой3'},
        {id: 3, text: 'Любой4'},
        {id: 4, text: 'Любой5'}
    ],
    equipment = [
        {id: 0, text: 'Не важно', value: 41},
        {id: 1, text: 'Раздельный', value: 16},
        {id: 2, text: 'Сомещенный', value: 29}
    ],
    designPlan = [
        {id: 0, text: 'Прилагается'},
        {id: 1, text: 'Прилагается2'},
        {id: 2, text: 'Прилагается3'},
        {id: 3, text: 'Прилагается4'},
        {id: 4, text: 'Прилагается5'}
    ],
    project = [
        {id: 0, text: 'Не важно'},
        {id: 1, text: 'Не важно2'},
        {id: 2, text: 'Не важно3'},
        {id: 3, text: 'Не важно4'},
        {id: 4, text: 'Не важно5'}
    ],
    video = [
        {id: 0, text: 'Прилагается'},
        {id: 1, text: 'Прилагается2'},
        {id: 2, text: 'Прилагается3'},
        {id: 3, text: 'Прилагается4'},
        {id: 4, text: 'Прилагается5'}
    ],
    rooms = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    aBathroom = [
        {id: 0, text: 'Выберите тип'},
        {id: 1, text: 'Выберите тип2'},
        {id: 2, text: 'Выберите тип3'},
        {id: 3, text: 'Выберите тип4'},
        {id: 4, text: 'Выберите тип5'}
    ],
    decoration = [
        {id: 0, text: 'Эксклюзивного качества'},
        {id: 1, text: 'Эксклюзивного качества2'},
        {id: 2, text: 'Эксклюзивного качества3'},
        {id: 3, text: 'Эксклюзивного качества4'},
        {id: 4, text: 'Эксклюзивного качества5'}
    ],
    wallMaterial = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    roof = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    foundation = [
        {id: 0, text: 'Без фундамента'},
        {id: 1, text: 'Без фундамента2'},
        {id: 2, text: 'Без фундамента3'},
        {id: 3, text: 'Без фундамента4'},
        {id: 4, text: 'Без фундамента5'}
    ],
    thePresenceOfAnElevator = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    nurseryServices = [
        {id: 0, text: 'Выбрано'},
        {id: 1, text: 'Выбрано2'},
        {id: 2, text: 'Выбрано3'},
        {id: 3, text: 'Выбрано4'},
        {id: 4, text: 'Выбрано5'}
    ],
    typeOfObject = [
        {id: 0, text: 'Собственность более...'},
        {id: 1, text: 'Собственность более...2'},
        {id: 2, text: 'Собственность более...3'},
        {id: 3, text: 'Собственность более...4'},
        {id: 4, text: 'Собственность более...5'}
    ],
    parkingArea = [
        {id: 0, text: 'Подземная парковка'},
        {id: 1, text: 'Подземная парковка2'},
        {id: 2, text: 'Подземная парковка3'},
        {id: 3, text: 'Подземная парковка4'},
        {id: 4, text: 'Подземная парковка5'}
    ],
    equipment = [
        {id: 0, text: 'Укомплектованная', value:45},
        {id: 1, text: 'Пустая', value:44}
    ],
    okrug = [
        {id: 0, text: 'Северо-западный'},
        {id: 1, text: 'Северо-западный2'},
        {id: 2, text: 'Северо-западный3'},
        {id: 3, text: 'Северо-западный4'},
        {id: 4, text: 'Северо-западный5'}
    ],
    area = [
        {id: 0, text: 'Северное медведково'},
        {id: 1, text: 'Северное медведково2'},
        {id: 2, text: 'Северное медведково3'},
        {id: 3, text: 'Северное медведково4'},
        {id: 4, text: 'Северное медведково5'}
    ],
    street = [
        {id: 0, text: 'Ениивмасейская'},
        {id: 1, text: 'Ениивмасейская2'},
        {id: 2, text: 'Ениивмасейская3'},
        {id: 3, text: 'Ениивмасейская4'},
        {id: 4, text: 'Ениивмасейская5'}
    ],
    stairwells_status = [
        {id: 0, text: 'Без ремонта', value: 141},
        {id: 1, text: 'Требуется ремонт', value: 107},
        {id: 2, text: 'Требуется косметический ремонт', value: 106},
        {id: 3, text: 'Обычная отделка', value: 134},
        {id: 4, text: 'Высококачественная отделка', value: 64}
    ],
    distance = [
        {id: 0, text: '5 мин пешком'},
        {id: 1, text: '5 мин пешком2'},
        {id: 2, text: '5 мин пешком3'},
        {id: 3, text: '5 мин пешком4'},
        {id: 4, text: '5 мин пешком5'}
    ],
    furnish = [
        {id: 0, text: 'Без ремонта', value: 141},
        {id: 1, text: 'Незавершенный ремонт', value: 65},
        {id: 2, text: 'Требуется ремонт', value: 107},
        {id: 3, text: 'Требуется косметический ремонт', value: 106},
        {id: 4, text: 'Хорошая отделка', value: 57},
        {id: 5, text: 'Высококачественная отделка', value: 64},
        {id: 6, text: 'Эксклюзивного качества', value: 46}
    ],
    building_type = [
        {id: 0, text: 'Жилое', value: 108},
        {id: 1, text: 'Административное', value: 8}
    ],
    subwayLines = [
        {id: 0, text: 'Выбрано(1)'},
        {id: 1, text: 'Выбрано(2)'},
        {id: 2, text: 'Выбрано(3)'},
        {id: 3, text: 'Выбрано(4)'},
        {id: 4, text: 'Выбрано(5)'}
    ],
    wall_material = [
        {id: 0, text: 'Фахверк', value: 49},
        {id: 1, text: 'Кирпич', value: 19},
        {id: 2, text: 'Железобетон', value: 105},
        {id: 3, text: 'Монолит', value: 78},
        {id: 4, text: 'Пеноблок', value: 96},
        {id: 5, text: 'Газосиликатные блоки', value: 55},
        {id: 6, text: 'Шлакоблоки', value: 28},
        {id: 7, text: 'Рубленое дерево', value: 27},
        {id: 8, text: 'Лафет', value: 24},
        {id: 9, text: 'Оцилиндрованное бревно', value: 112},
        {id: 10, text: 'Профилированный брус', value: 102},
        {id: 11, text: 'Клееный брус', value: 56}
    ],
    sanitation = [
        {id: 0, text: 'Есть', value: 47},
        {id: 1, text: 'Нет', value: 84}
    ],
    foundation = [
        {id: 0, text: 'Монолитная плита', value: 120},
        {id: 1, text: 'Шведская плита', value: 125},
        {id: 2, text: 'Ленточный', value: 109},
        {id: 3, text: 'Ростверк', value: 58},
        {id: 4, text: 'Без фундамента', value: 140}
    ],
    yesAndNo = [
        {id: 0, text: 'Да', value: 1},
        {id: 0, text: 'Нет', value: 0}
    ],
    security = [
        {id: 0, text: 'Выберите'},
        {id: 1, text: 'Выберите2'},
        {id: 2, text: 'Выберите3'},
        {id: 3, text: 'Выберите4'},
        {id: 4, text: 'Выберите5'}
    ],
    clarification_of_the_object_type = [
        {id: 0, text: 'Год постройки - окончания строительства', value: 146},
        {id: 1, text: 'Собственность менее 5 лет', value: 92},
        {id: 2, text: 'Собственность более 5 лет', value: 93},
        {id: 3, text: 'Участок с подрядом', value: 70},
        {id: 4, text: 'Незавершенное строительство', value: 33},
        {id: 6, text: 'Новостройка', value: 83}
    ],
    type_of_construction = [
        {id: 0, text: 'Комнаты', value: 111},
        {id: 1, text: ' Опен спэйс', value: 90}
    ],
    documents = [
        {id: 0, text: 'Выберите'},
        {id: 1, text: 'Выберите2'},
        {id: 2, text: 'Выберите3'},
        {id: 3, text: 'Выберите4'},
        {id: 4, text: 'Выберите5'}
    ],
    propertyType = [
        {id: 0, text: 'Тип недвижимости'},
        {id: 1, text: 'Тип недвижимости2'},
        {id: 2, text: 'Тип недвижимости3'},
        {id: 3, text: 'Тип недвижимости4'},
        {id: 4, text: 'Тип недвижимости5'}
    ],
    roofing = [
        {id: 0, text: 'Железо', value: 67},
        {id: 1, text: 'Медь', value: 34},
        {id: 2, text: 'Металлочерепица', value: 76},
        {id: 3, text: 'Пескобетонная черепица', value: 113},
        {id: 4, text: 'Черепица', value: 129},
        {id: 5, text: 'Солома', value: 123},
        {id: 6, text: 'Камень', value: 122},
        {id: 7, text: 'Шифер', value: 118},
        {id: 8, text: 'Ондулин', value: 88},
        {id: 9, text: 'Временная', value: 127}
    ],
    video = [
        {id: 0, text: 'Не важно', value: 41},
        {id: 1, text: 'Прилагается', value: 11}
    ],
    planning_project = [
        {id: 0, text: 'Не важно', value: 41},
        {id: 1, text: 'Прилагается', value: 11}
    ],
    three_d_project = [
        {id: 0, text: 'Не важно', value: 41},
        {id: 1, text: 'Прилагается', value: 11}
    ],
    elevator_yes = [
        {id: 0, text: 'Не важно', value: 41},
        {id: 1, text: 'Пассажирский', value: 95},
        {id: 2, text: 'Грузовой', value: 23}
    ],
    leaseTerm = [
        {id: 0, text: 'Срок аренды'},
        {id: 1, text: 'Срок аренды1'},
        {id: 2, text: 'Срок аренды2'},
        {id: 3, text: 'Срок аренды3'},
        {id: 4, text: 'Срок аренды4'}
    ];
/** Библиотека select2(фильтры) **/
$(document).ready(function () {
   // var $image = $('<img src="../../template/images/s1.png" alt="Perice">');

    /** Фильтр поиска**/
    $(".js-example-placeholder-single, .data").select2({
        data: data,
        placeholder: 'Выберите область', //  $image + 'Выберите область </img>'
        allowClear: true
    });
    //-------------------------------------
    $('.js-example-data-array, .location-apartments').select2({
        data: locationApartments
    });
    $('.js-example-data-array, .municipal').select2({
        data: municipal
    });
    $('.js-example-data-array, .owner').select2({
        data: owner,
        maximumInputLength: 2
    });
    $('.js-example-data-array, .floor').select2({
        data: floor
    });
    $('.js-example-data-array, .roofing').select2({
        data: roofing
    });
    $('.js-example-data-array, .equipment').select2({
        data: equipment
    });
    $('.js-example-data-array, .design-plan').select2({
        data: designPlan
    });
    $('.js-example-data-array, .project').select2({
        data: project
    });
    $('.js-example-data-array, .video').select2({
        data: video
    });
    $('.js-example-data-array, .material').select2({
        data: material
    });
    $('.js-example-data-array, .rooms').select2({
        data: rooms
    });
    $('.js-example-data-array, .a-bathroom').select2({
        data: aBathroom
    });
    $('.js-example-data-array, .decoration').select2({
        data: decoration
    });
    $('.js-example-data-array, .wall_material').select2({
        data: wallMaterial
    });
    $('.js-example-data-array, .roof').select2({
        data: roof
    });
    $('.js-example-data-array, .foundation').select2({
        data: foundation
    });
    $('.js-example-data-array, .wall_material').select2({
        data: wall_material
    });
    $('.js-example-data-array, .the-presence-of-an-elevator').select2({
        data: thePresenceOfAnElevator
    });
    $('.js-example-data-array, .nursery-services').select2({
        data: nurseryServices
    });
    $('.js-example-data-array, .type-of-object').select2({
        data: typeOfObject
    });
    $('.js-example-data-array, .parking-area').select2({
        data: parkingArea
    });
    $('.js-example-data-array, .okrug').select2({
        data: okrug
    });
    $('.js-example-data-array, .area').select2({
        data: area
    });
    $('.js-example-data-array, .street').select2({
        data: street
    });
    $('.js-example-data-array, .distance').select2({
        data: distance
    });
    $('.js-example-data-array, .security').select2({
        data: security
    });
    $('.js-example-data-array, .documents').select2({
        data: documents
    });
    $('.js-example-data-array, .equipment').select2({
        data: equipment
    });
    $('.js-example-data-array, .type_of_construction').select2({
        data: type_of_construction
    });
    $('.js-example-data-array, .furnish').select2({
        data: furnish
    });
    $('.js-example-data-array, .furnish').select2({
        data: yesAndNo
    });
    $('.js-example-data-array, .foundation').select2({
        data: foundation
    });
    $('.js-example-data-array, .elevator_yes').select2({
        data: elevator_yes
    });
    $('.js-example-data-array, .clarification_of_the_object_type').select2({
        data: clarification_of_the_object_type
    });
    $('.js-example-data-array, .parking').select2({
        data: parking
    });
    $('.js-example-data-array, .wall_material').select2({
        data: wall_material
    });
    $('.js-example-data-array, .video').select2({
        data: video
    });
    $('.js-example-data-array, .planning_project').select2({
        data: planning_project
    });
    $('.js-example-data-array, .three_d_project').select2({
        data: three_d_project
    });
    $('.js-example-data-array, .sanitation').select2({
        data: sanitation
    });
    $('.js-example-data-array, .building_type').select2({
        data: building_type
    });
    $('.js-example-data-array, .stairwells_status').select2({
        data: stairwells_status
    });
    $('.js-example-data-array, .property-type').select2({
        data: propertyType,
        maximumInputLength: 5
    });
    $('.js-example-data-array, .leaseTerm').select2({
        data: leaseTerm,
        maximumInputLength: 2
    });
//---------------------------------------------------------
    $('.js-example-data-array-selected, .location-apartments').select2({
        data: locationApartments
    });
    $('.js-example-data-array-selected, .roofing').select2({
        data: roofing
    });
    $('.js-example-data-array-selected, .municipal').select2({
        data: municipal
    });
    $('.js-example-data-array-selected, .wall_material').select2({
        data: wall_material
    });
    $('.js-example-data-array-selected, .foundation').select2({
        data: foundation
    });
    $('.js-example-data-array-selected, .material').select2({
        data: material
    });
    $('.js-example-data-array-selected, .owner').select2({
        data: owner,
        maximumInputLength: 2
    });
    $('.js-example-data-array-selected, .floor').select2({
        data: floor
    });
    $('.js-example-data-array-selected, .sanitation').select2({
        data: sanitation
    });
    $('.js-example-data-array-selected, .equipment').select2({
        data: equipment
    });
    $('.js-example-data-array-selected, .design-plan').select2({
        data: designPlan
    });
    $('.js-example-data-array-selected, .project').select2({
        data: project
    });
    $('.js-example-data-array-selected, .video').select2({
        data: video
    });
    $('.js-example-data-array-selected, .building_type').select2({
        data: building_type
    });
    $('.js-example-data-array-selected, .rooms').select2({
        data: rooms
    });
    $('.js-example-data-array-selected, .a-bathroom').select2({
        data: aBathroom
    });
    $('.js-example-data-array-selected, .decoration').select2({
        data: decoration
    });
    $('.js-example-data-array-selected, .wall_material').select2({
        data: wallMaterial
    });
    $('.js-example-data-array-selected, .roof').select2({
        data: roof
    });
    $('.js-example-data-array-selected, .foundation').select2({
        data: foundation
    });
    $('.js-example-data-array-selected, .the-presence-of-an-elevator').select2({
        data: thePresenceOfAnElevator
    });
    $('.js-example-data-array-selected, .nursery-services').select2({
        data: nurseryServices
    });
    $('.js-example-data-array-selected, .type-of-object').select2({
        data: typeOfObject
    });
    $('.js-example-data-array-selected, .parking-area').select2({
        data: parkingArea
    });
    $('.js-example-data-array-selected, .okrug').select2({
        data: okrug
    });
    $('.js-example-data-array-selected, .area').select2({
        data: area
    });
    $('.js-example-data-array-selected, .street').select2({
        data: street
    });
    $('.js-example-data-array-selected, .distance').select2({
        data: distance
    });
    $('.js-example-data-array-selected, .security').select2({
        data: security
    });
    $('.js-example-data-array-selected, .documents').select2({
        data: documents
    });
    $('.js-example-data-array-selected, .equipment').select2({
        data: equipment
    });
    $('.js-example-data-array-selected, .furnish').select2({
        data: furnish
    });
    $('.js-example-data-array-selected, .furnish').select2({
        data: yesAndNo
    });
    $('.js-example-data-array-selected, .elevator_yes').select2({
        data: elevator_yes
    });
    $('.js-example-data-array-selected, .parking').select2({
        data: parking
    });
    $('.js-example-data-array-selected, .clarification_of_the_object_type').select2({
        data: clarification_of_the_object_type
    });
    $('.js-example-data-array-selected, .wall_material').select2({
        data: wall_material
    });
    $('.js-example-data-array-selected, .stairwells_status').select2({
        data: stairwells_status
    });
    $('.js-example-data-array-selected, .video').select2({
        data: video
    });
    $('.js-example-data-array-selected, .planning_project').select2({
        data: planning_project
    });
    $('.js-example-data-array-selected, .type_of_construction').select2({
        data: type_of_construction
    });
    $('.js-example-data-array-selected, .three_d_project').select2({
        data: three_d_project
    });
    $('.js-example-data-array-selected, .property-type').select2({
        data: propertyType,
        maximumInputLength: 5
    });
    $('.js-example-data-array-selected, .leaseTerm').select2({
        data: leaseTerm,
        maximumInputLength: 2
    });
    $(".js-example-templating, .select-price-by-scrolling").select2({
        templateResult: formatState,
        data: subwayLines
    });
});