<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
    /*$(window).on('load', function () {
     $("#loading-center").fadeOut(800, function () {
     $("#loading").fadeOut(1000);
     });
     });*/

    function displayOperation() {
        var subjectVal = $('#subject').val();
        var formOptions = $('#formOptions');
        var operation = $('#operation');
        var operationLabel = $('label[for=operation]');

        if (subjectVal == '') {
            formOptions.html('');
            operation.css({
                display: 'none'
            }).val('');
            operationLabel.css({
                display: 'none'
            });
        } else {
            operation.css({
                display: 'inline-block'
            });
            operationLabel.css({
                display: 'inline-block'
            });
        }
    }

    function changeForm() {
        var subjectVal = $('#subject').val();
        var operationVal = $('#operation').val();
        var formOptions = $('#formOptions');

        switch (operationVal) {
            case 'rent':
                switch (subjectVal) {
                    case 'apartment':
                        formOptions.html(getRentApartHTML());
                        break;
                    case 'house':
                        formOptions.html('');
                        break;
                    case 'ground':
                        formOptions.html('');
                        break;
                    case 'room':
                        formOptions.html('');
                        break;
                    default:
                        formOptions.html('');
                }
                break;
            case 'buy':
                // TODO: Обработка отображение формы при покупке
                break;
            default:
                formOptions.html('');
        }
    }

    function getRentApartHTML() {
        return '<fieldset> <legend>Базовые параметры</legend> <div style="margin: 15px"> Цена: <div class="indent"> Стоимость: <input name="minPrice" type="text" placeholder="Мин."> <input name="maxPrice" type="text" placeholder="Макс."><br> <label for="bargain">Торг:</label> <select name="bargain" id="bargain"> <option value="">---</option> <option value="yes">Возможен</option> <option value="">Не возможен</option> </select><br> <label for="rentType">Тип аренды:</label> <select name="rentType" id="rentType"> <option value="">---</option> <option value="hourRent">Часовая</option> <option value="dailyRent">Посуточная</option> <option value="longRent">Долгосрочная</option> </select> </div> Расположение: <br> <div class="indent"> <label for="region">Область:</label> <input type="text" name="region" id="region"><br> <label for="city">Город:</label> <input type="text" name="city" id="city"><br> <div class="indent"> <label for="district">Округ:</label> <input type="text" name="district" id="district"><br> <label for="area">Район:</label> <input type="text" name="area" id="area"><br> <label for="address">Адрес:</label> <input type="text" name="address" id="address"><br> </div> Станция метро: <br> <div class="indent"> Удаленность от метро: <input type="text" name="metroMin" placeholder="Мин."> <input type="text" name="metroMax" placeholder="Макс."><br> </div> </div> </div> </fieldset> <br><br> <fieldset> <legend>Описание объекта</legend> <div style="margin: 15px"> <strong>Квартира:</strong> <div class="indent"> <label for="roomsNumber">Количество комнат:</label> <select name="roomsNumber" id="roomsNumber" onchange=""> <option value="">---</option> <option value="1">1</option> <option value="2">2</option> <option value="3">3</option> <option value="more">4+</option> </select><br> Площадь: <input type="text" name="spaceMin" placeholder="От"> <input type="text" name="spaceMax" placeholder="До"><br> Этаж: <input type="text" name="floorMin" placeholder="От"> <input type="text" name="floorMax" placeholder="До"><br> <label for="equipment">Комплектация:</label> <select name="equipment" id="equipment"> <option value="">---</option> <option value="1">Укомплектована</option> <option value="">Пустая</option> </select><br> <label for="ceilingHeight">Высота потолков:</label> <input type="text" name="ceilingHeight" id="ceilingHeight"> </div> </div> <div style="margin: 15px"> <strong>Дом квартиры:</strong> <div class="indent"> <label for="houseType">Тип дома:</label> <select name="houseType" id="houseType" onchange=""> <option value="">---</option> <option value="1">Блочный</option> <option value="2">Брежневка</option> <option value="3">Индивидуальный</option> <option value="4">Кирпично-монолитный</option> <option value="5">Монолит</option> <option value="6">Панельный</option> <option value="7">Сталинка</option> <option value="8">Хрущевка</option> <option value="9">Серия дома</option> </select><br> <label for="houseFloorNumber">Количество этажей:</label> <input type="text" name="houseFloorNumber" id="houseFloorNumber"><br> <label for="lift">Лифт:</label> <select name="lift" id="lift" onchange=""> <option value="">---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="parking">Парковка:</label> <select name="parking" id="parking" onchange=""> <option value="">---</option> <option value="1">Подземная</option> <option value="2">Во дворе</option> <option value="2">Платная (неподалеку)</option> </select><br> Безопасность: <div class="indent"> <label for="concierge">Консьерж</label> <input type="checkbox" name="concierge" id="concierge"><br> <label for="security">Охрана</label> <input type="checkbox" name="security" id="security"><br> <label for="intercom">Домофон</label> <input type="checkbox" name="intercom" id="intercom"><br> <label for="CCTV">Видеонаблюдение</label> <input type="checkbox" name="CCTV" id="CCTV"><br> </div> <label for="chute">Мусоропровод:</label> <select name="chute" id="chute" onchange=""> <option value="">---</option> <option value="1">Да</option> <option value="2">Нет</option> </select><br> </div> <strong>Состав квартиры:</strong> <div class="indent"> Комнаты: <div class="indent"> <label for="bedroom">Спальня</label> <input type="checkbox" name="bedroom" id="bedroom"><br> <label for="kitchen">Кухня</label> <input type="checkbox" name="kitchen" id="kitchen"><br> <label for="livingRoom">Гостиная</label> <input type="checkbox" name="livingRoom" id="livingRoom"><br> <label for="hallway">Прихожая</label> <input type="checkbox" name="hallway" id="hallway"><br> <label for="nursery">Детская</label> <input type="checkbox" name="nursery" id="nursery"><br> <label for="study">Рабочий кабинет</label> <input type="checkbox" name="study" id="study"><br> <label for="canteen">Столовая</label> <input type="checkbox" name="canteen" id="canteen"><br> <label for="bathroom">Ванная</label> <input type="checkbox" name="bathroom" id="bathroom"><br> </div> Состояние квартиры: <div class="indent"> <label for="decoration">Отделка:</label> <select name="decoration" id="decoration"> <option value="">---</option> <option value="1">Да</option> <option value="0">Нет</option> </select> <select name="decorationValue"> <option value="">---</option> <option value="1">Люкс</option> <option value="0">Косметическая</option> </select><br> </div> <label for="lavatory">Санузел:</label> <select name="lavatory" id="lavatory"> <option value="">---</option> <option value="1">Совмещенный</option> <option value="0">Раздельный</option> </select><br> <label for="balcony">Обязательное наличие балкона</label> <input type="checkbox" name="balcony" id="balcony"><br> Жилищно-комунальные услуги: <div class="indent"> <label for="heating">Отопление</label> <input type="checkbox" name="heating" id="heating"><br> <label for="gas">Газ</label> <input type="checkbox" name="gas" id="gas"><br> <label for="electricity">Электричество</label> <input type="checkbox" name="electricity" id="electricity"><br> <label for="water">Водопровод</label> <input type="checkbox" name="water" id="water"><br> </div> Наполнение квартиры: <div class="indent"> Электроника для досуга и отдыха: <div class="indent"> <label for="TV">Телевизор</label> <input type="checkbox" name="TV" id="TV"><br> <label for="musicCenter">Музыкльный центр</label> <input type="checkbox" name="musicCenter" id="musicCenter"><br> <label for="conditioner">Кондиционер</label> <input type="checkbox" name="conditioner" id="conditioner"><br> </div> Бытовая техника: <div class="indent"> <label for="fridge">Холодильник</label> <input type="checkbox" name="fridge" id="fridge"><br> <label for="plate">Плита</label> <input type="checkbox" name="plate" id="plate"><br> <label for="bake">Печь</label> <input type="checkbox" name="bake" id="bake"><br> <label for="microwave">СВЧ</label> <input type="checkbox" name="microwave" id="microwave"><br> <label for="dishwasher">Посудомойка</label> <input type="checkbox" name="dishwasher" id="dishwasher"><br> </div> Мебель: <div class="indent"> <label for="table">Стол</label> <input type="checkbox" name="table" id="table"><br> <label for="bed">Кровать</label> <input type="checkbox" name="bed" id="bed"><br> <label for="cupboard">Шкаф</label> <input type="checkbox" name="cupboard" id="cupboard"><br> <label for="stand">Тумба</label> <input type="checkbox" name="stand" id="stand"><br> <label for="mirror">Зеркало</label> <input type="checkbox" name="mirror" id="mirror"><br> <label for="armchair">Кресло</label> <input type="checkbox" name="armchair" id="armchair"><br> <label for="sofa">Диван</label> <input type="checkbox" name="sofa" id="sofa"><br> </div> </div> </div> <strong>Вложения:</strong> <div class="indent"> <label for="plan">План квартиры:</label> <select name="plan" id="plan" onchange=""> <option value="">---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="3d">3D проект:</label> <select name="3d" id="3d" onchange=""> <option value="">---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> <label for="video">Видео:</label> <select name="video" id="video" onchange=""> <option value="">---</option> <option value="1">Есть</option> <option value="2">Нет</option> </select><br> </div> </div> </fieldset> <input style="margin-top: 20px" type="submit" name="extended" value="Найти">';
    }

    function getRegions() {
        $.ajax({
            type: "POST",
            url: "/search",
            data: "type=getRegions",
            success: function (data) {
                var regionsCursor = $("select[name=region]");
                regionsCursor.html("");
                var regions = JSON.parse(data);

                var html = "<option value=\"\" selected>---</option>";
                regions.forEach(function (region, i) {
                    html += "<option value=\"" + region.region_id + "\">" + region.title + "</option>";
                });
                regionsCursor.html(html);
            }
        });
    }

    function getCities(region_id) {
        $.ajax({
            type: "POST",
            url: "/search",
            data: "type=getCities&region_id=" + region_id,
            success: function (data) {
                var citiesCursor = $("select[name=city]");
                citiesCursor.html("");

                var cities = JSON.parse(data);

                var html = "<option value=\"\" selected>---</option>";
                cities.forEach(function (citi, i) {
                    html += "<option value=\"" + citi.id + "\">" + citi.title + "</option>";
                });
                citiesCursor.html(html);
            }
        });
    }

    var timer;
    function getTimeout(delay, callback) {
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback();
        }, delay);
    }

    function getGeoData(address) {
        var divCitiesCursor = $('#cities');

        getTimeout(1000, function () {
            $.ajax({
                type: "POST",
                url: "/search",
                data: "type=getGeoData&address=" + address,
                success: function (data) {
                    divCitiesCursor.html(data);
                }
            });
        });
    }
</script>