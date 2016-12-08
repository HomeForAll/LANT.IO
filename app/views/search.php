<?php
$this->title = 'Поиск';

echo '<pre>';
print_r($this->data);
echo '</pre>';
?>
<style>
    #operation, label[for=operation] {
        display: none;
    }
    
    /*#formOptions {*/
    /*display: none;*/
    /*}*/
    
    .indent {
        margin: 15px 0 15px 30px;
    }
</style>

<h2>Расширенный поиск:</h2><br>

<span style="font-size: 15pt;">
    <strong>Аренда квартиры</strong>
</span>
<form action="/search" method="post">
    
    <input type="hidden" name="subject" value="apartment">
    <input type="hidden" name="operation" value="rent">
    
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px">
            Цена:
            <div class="indent">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс."><br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="1">Возможен</option>
                    <option value="2">Не возможен</option>
                </select>
                <br>
                <label for="rentType">Тип аренды:</label>
                <select name="rentType" id="rentType">
                    <option value="">---</option>
                    <option value="1">Часовая</option>
                    <option value="2">Посуточная</option>
                    <option value="3">Долгосрочная</option>
                </select>
            </div>
            
            Расположение:
            <br>
            <input type="text" id="search" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value)" onkeyup="return false;">
            <div id="map" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
            
            <div class="indent">
                <label for="country">Страна:</label> <span id="country"></span>
                <br>
                <label for="area">Область:</label> <span id="area"></span>
                <br>
                <label for="city">Город:</label> <span id="city"></span>
                <br>
                <label for="region">Район:</label> <span id="region"></span>
                <br>
                <label for="street">Улица:</label> <span id="street"></span>
                <br>
    
                <input id="rentApartCountry" type="hidden" name="country" value="">
                <input id="rentApartArea" type="hidden" name="area" value="">
                <input id="rentApartCity" type="hidden" name="city" value="">
                <input id="rentApartRegion" type="hidden" name="region" value="">
                <input id="rentApartStreet" type="hidden" name="street" value="">
                
                Станция метро:
                <br>
                <div class="indent">
                    Удаленность от метро:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>
        </div>
    </fieldset>
    <br><br>
    <fieldset>
        <legend>Описание объекта</legend>
        <div style="margin: 15px">
            <strong>Квартира:</strong>
            <div class="indent">
                <label for="roomsNumber">Количество комнат:</label>
                <select name="roomsNumber" id="roomsNumber" onchange="">
                    <option value="">---</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
                </select>
                <br>
                
                Площадь:
                <input type="text" name="spaceMin" placeholder="От">
                <input type="text" name="spaceMax" placeholder="До">
                <br>
                
                Этаж:
                <input type="text" name="floorMin" placeholder="От">
                <input type="text" name="floorMax" placeholder="До">
                <br>
                <label for="equipment">Комплектация:</label>
                <select name="equipment" id="equipment">
                    <option value="">---</option>
                    <option value="1">Укомплектованая</option>
                    <option value="2">Пустая</option>
                </select>
                <br>
                <label for="ceilingHeight">Высота потолков:</label>
                <input type="text" name="ceilingHeight" id="ceilingHeight">
            </div>
        </div>
        <div style="margin: 15px">
            <strong>Дом квартиры:</strong>
            <div class="indent">
                <label for="houseType">Тип дома:</label>
                <select name="houseType" id="houseType" onchange="">
                    <option value="">---</option>
                    <option value="1">Блочный</option>
                    <option value="2">Брежневка</option>
                    <option value="3">Индивидуальный</option>
                    <option value="4">Кирпично-монолитный</option>
                    <option value="5">Монолит</option>
                    <option value="6">Панельный</option>
                    <option value="7">Сталинка</option>
                    <option value="8">Хрущевка</option>
                    <option value="9">Серия дома
                    </option>
                </select>
                <br>
                
                <label for="houseFloorNumber">Количество этажей:</label>
                <input type="text" name="houseFloorNumber" id="houseFloorNumber">
                <br>
                
                <label for="lift">Лифт:</label>
                <select name="lift" id="lift" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                
                <label for="parking">Парковка:</label>
                <select name="parking" id="parking" onchange="">
                    <option value="">---</option>
                    <option value="1">Подземная</option>
                    <option value="2">Во дворе</option>
                    <option value="3">Платная (неподалеку)</option>
                </select>
                <br>
                
                Безопасность:
                <div class="indent">
                    <label for="concierge">Консьерж</label>
                    <input type="checkbox" name="concierge" id="concierge">
                    <br>
                    <label for="security">Охрана</label>
                    <input type="checkbox" name="security" id="security">
                    <br>
                    <label for="intercom">Домофон</label>
                    <input type="checkbox" name="intercom" id="intercom">
                    <br>
                    <label for="CCTV">Видеонаблюдение</label>
                    <input type="checkbox" name="CCTV" id="CCTV">
                    <br>
                </div>
                
                <label for="chute">Мусоропровод:</label>
                <select name="chute" id="chute" onchange="">
                    <option value="">---</option>
                    <option value="1">Да</option>
                    <option value="2">Нет</option>
                </select>
                <br>
            </div>
            
            <strong>Состав квартиры:</strong>
            <div class="indent">
                Комнаты:
                <div class="indent">
                    <label for="bedroom">Спальня</label>
                    <input type="checkbox" name="bedroom" id="bedroom">
                    <br>
                    <label for="kitchen">Кухня</label>
                    <input type="checkbox" name="kitchen" id="kitchen">
                    <br>
                    <label for="livingRoom">Гостиная</label>
                    <input type="checkbox" name="livingRoom" id="livingRoom">
                    <br>
                    <label for="hallway">Прихожая</label>
                    <input type="checkbox" name="hallway" id="hallway">
                    <br>
                    <label for="nursery">Детская</label>
                    <input type="checkbox" name="nursery" id="nursery">
                    <br>
                    <label for="study">Рабочий кабинет</label>
                    <input type="checkbox" name="study" id="study">
                    <br> <label for="canteen">Столовая</label>
                    <input type="checkbox" name="canteen" id="canteen">
                    <br>
                    <label for="bathroom">Ванная</label>
                    <input type="checkbox" name="bathroom" id="bathroom">
                    <br>
                </div>
                
                Состояние квартиры:
                <div class="indent">
                    <label for="decoration">Отделка:</label>
                    <select name="decoration" id="decoration">
                        <option value="">---</option>
                        <option value="1">Да</option>
                        <option value="2">Нет</option>
                    </select>
                    
                    <select name="decorationValue">
                        <option value="1">Люкс</option>
                        <option value="2">Косметическая</option>
                    </select>
                    <br>
                </div>
                <label for="lavatory">Санузел:</label>
                <select name="lavatory" id="lavatory">
                    <option value="">---</option>
                    <option value="1">Совмещенный</option>
                    <option value="2">Раздельный</option>
                </select>
                <br>
                <label for="balcony">Обязательноеналичие балкона</label>
                <input type="checkbox" name="balcony" id="balcony">
                <br>
                
                Жилищно-комунальные услуги:
                <div class="indent">
                    <label for="heating">Отопление</label>
                    <input type="checkbox" name="heating" id="heating">
                    <br>
                    <label for="gas">Газ</label>
                    <input type="checkbox" name="gas" id="gas">
                    <br>
                    <label for="electricity">Электричество</label>
                    <input type="checkbox" name="electricity" id="electricity">
                    <br>
                    <label for="water">Водопровод</label>
                    <input type="checkbox" name="water" id="water">
                    <br>
                </div>
                
                Наполнение квартиры:
                <div class="indent">
                    Электроника для досуга и отдыха:
                    <div class="indent">
                        <label for="TV">Телевизор</label>
                        <input type="checkbox" name="TV" id="TV">
                        <br>
                        <label for="musicCenter">Музыкльный центр</label>
                        <input type="checkbox" name="musicCenter" id="musicCenter">
                        <br>
                        <label for="conditioner">Кондиционер</label>
                        <input type="checkbox" name="conditioner" id="conditioner">
                        <br>
                    </div>
                    
                    Бытовая техника:
                    <div class="indent">
                        <label for="fridge">Холодильник</label>
                        <input type="checkbox" name="fridge" id="fridge">
                        <br>
                        <label for="plate">Плита</label>
                        <input type="checkbox" name="plate" id="plate">
                        <br>
                        <label for="bake">Печь</label>
                        <input type="checkbox" name="bake" id="bake">
                        <br>
                        <label for="microwave">СВЧ</label>
                        <input type="checkbox" name="microwave" id="microwave">
                        <br>
                        <label for="dishwasher">Посудомойка</label>
                        <input type="checkbox" name="dishwasher" id="dishwasher">
                        <br>
                    </div>
                    
                    Мебель:
                    <div class="indent">
                        <label for="table">Стол</label>
                        <input type="checkbox" name="table" id="table">
                        <br>
                        <label for="bed">Кровать</label>
                        <input type="checkbox" name="bed" id="bed">
                        <br>
                        <label for="cupboard">Шкаф</label>
                        <input type="checkbox" name="cupboard" id="cupboard">
                        <br>
                        <label for="stand">Тумба</label>
                        <input type="checkbox" name="stand" id="stand">
                        <br>
                        <label for="mirror">Зеркало</label>
                        <input type="checkbox" name="mirror" id="mirror">
                        <br>
                        <label for="armchair">Кресло</label>
                        <input type="checkbox" name="armchair" id="armchair">
                        <br>
                        <label for="sofa">Диван</label>
                        <input type="checkbox" name="sofa" id="sofa">
                        <br>
                    </div>
                </div>
            </div>
            
            <strong>Вложения:</strong>
            <div class="indent">
                <label for="plan">План квартиры:</label>
                <select name="plan" id="plan" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="3d">3D проект:</label>
                <select name="3d" id="3d" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="video">Видео:</label>
                <select name="video" id="video" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="photo">Фото:</label>
                <select name="photo" id="photo" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
            </div>
        </div>
    </fieldset>
    
    <input style="margin: 20px 0 50px 0" type="submit" name="apartRent" value="Найти">
</form>

<span style="font-size: 15pt;">
    <strong>Аренда дома</strong>
</span>
<form action="/search" method="post">
    
    <input type="hidden" name="subject" value="house">
    <input type="hidden" name="operation" value="rent">
    
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px">
            Цена:
            <div class="indent">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс.">
                <br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="1">Возможен</option>
                    <option value="2">Не возможен</option>
                </select>
                <br>
                <label for="rentType">Тип аренды:</label>
                <select name="rentType" id="rentType">
                    <option value="">---</option>
                    <option value="1">Часовая</option>
                    <option value="2">Посуточная</option>
                    <option value="3">Долгосрочная</option>
                </select>
            </div>
            
            <div class="indent">
                <label for="floorsNumber">Количество этажей:</label>
                <select name="floorsNumber" id="roomsNumber" onchange="">
                    <option value="">---</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3+</option>
                    <option value="">Любое</option>
                </select>
            </div>
            
            <div class="indent">
                <label for="parking">Наличие парковочных мест:</label>
                <select name="parking" id="parking" onchange="">
                    <option value="">---</option>
                    <option value="1">1</option>
                    <option value="2">2+</option>
                    <option value="3">Отсутсвует</option>
                </select>
            </div>
            
            <div class="indent">
                <label for="season">Сезонность:</label>
                <select name="season" id="season" onchange="">
                    <option value="">---</option>
                    <option value="1">Круглый год</option>
                    <option value="2">Весна/лето</option>
                    <option value="">Любая</option>
                </select>
            </div>
            
            Расположение:
            <br>
    
            <input type="text" id="search" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value)" onkeyup="return false;">
            <div id="map" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
    
            <div class="indent">
                <label for="country">Страна:</label> <span id="country"></span>
                <br>
                <label for="area">Область:</label> <span id="area"></span>
                <br>
                <label for="city">Город:</label> <span id="city"></span>
                <br>
                <label for="region">Район:</label> <span id="region"></span>
                <br>
                <label for="street">Улица:</label> <span id="street"></span>
                <br>
    
                <input id="rentHouseCountry" type="hidden" name="country" value="">
                <input id="rentHouseArea" type="hidden" name="area" value="">
                <input id="rentHouseCity" type="hidden" name="city" value="">
                <input id="rentHouseRegion" type="hidden" name="region" value="">
                <input id="rentHouseStreet" type="hidden" name="street" value="">
                
                <div class="indent">
                    Удаленность от города:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>
        </div>
    </fieldset>
    <br>
    <br>
    <fieldset>
        <legend>Описание объекта</legend>
        <div style="margin: 15px">
            <strong>Основное:</strong>
            <div style="margin: 15px">
                <strong>Описание дома:</strong>
                <div class="indent">
                    <label for="roomsNumber">Количество комнат:</label>
                    <select name="roomsNumber" id="roomsNumber" onchange="">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4+</option>
                    </select>
                    <br>
                    Площадь:
                    <input type="text" name="spaceMin" placeholder="От">
                    <input type="text" name="spaceMax" placeholder="До">
                    <br>
                    <label for="equipment">Комплектация:</label>
                    <select name="equipment" id="equipment">
                        <option value="">---</option>
                        <option value="1">Укомплектован</option>
                        <option value="2">Пустой</option>
                    </select>
                    <br>
                    
                    <label for="type">Тип:</label>
                    <select name="type" id="type">
                        <option value="">---</option>
                        <option value="1">Частный</option>
                        <option value="2">Многоквартирный</option>
                        <option value="3">Таунхаус</option>
                        <option value="4">Усадьба</option>
                    </select><br>
                    
                    <label for="style">Стиль:</label>
                    <select name="style" id="style">
                        <option value="">---</option>
                        <option value="1">Классический</option>
                        <option value="2">Русский</option>
                        <option value="3">Русская усадьба</option>
                        <option value="4">Замковый</option>
                        <option value="5">Ренессанс</option>
                        <option value="6">Готический</option>
                        <option value="7">Барокко</option>
                        <option value="8">Рококо</option>
                        <option value="9">Классицизм</option>
                        <option value="10">Ампир</option>
                        <option value="11">Эклектика</option>
                        <option value="12">Модерн</option>
                        <option value="13">Органическая архитектура</option>
                        <option value="14">Конструктивизм</option>
                        <option value="15">Ар-деко</option>
                        <option value="16">Минимализм</option>
                        <option value="17">High tech</option>
                        <option value="18">Финский минимализм</option>
                        <option value="19">Шале</option>
                        <option value="20">Фахверк</option>
                        <option value="21">Скандинавский</option>
                        <option value="22">Восточный</option>
                        <option value="23">Американский кантри</option>
                        <option value="24">Шато</option>
                        <option value="25">Адирондак</option>
                        <option value="25">Стиль прерий</option>
                    </select>
                    <br>
                    
                    <label for="Material">Материал облицовки:</label>
                    <select name="Material" id="Material">
                        <option value="">---</option>
                        <option value="1">Кирпич</option>
                        <option value="2">Камень</option>
                        <option value="3">Фасадная плитка</option>
                        <option value="4">Фасадная панель</option>
                        <option value="5">Деревянная панель</option>
                        <option value="6">Штукатурка</option>
                    </select>
                    <br>
                    
                    <label for="ceilingHeight">Высота потолков:</label>
                    <select name="ceilingHeight" id="ceilingHeight">
                        <option value="">---</option>
                        <option value="1">2м</option>
                        <option value="2">3м</option>
                        <option value="3">4м</option>
                        <option value="4">5м</option>
                    </select>
                    <br>
                </div>
                <div style="margin: 15px">
                    <strong>Описание участка:</strong>
                    
                    <div class="indent">
                        <label for="TSJ">ТСЖ:</label>
                        <select name="TSJ" id="TSJ">
                            <option value="">---</option>
                            <option value="1">Кооператив</option>
                            <option value="2">Кондоминиум</option>
                            <option value="3">Частный дом</option>
                            <option value="4">Другое</option>
                        </select>
                        <br>
                        
                        <label for="parking">Место для автомобиля:</label>
                        <select name="parking" id="parking">
                            <option value="">---</option>
                            <option value="1">Парковачное место</option>
                            <option value="2">Закрытый гараж</option>
                            <option value="3">За пределами участка</option>
                        </select>
                        <br>
                        
                        <label for="fencing">Ограждение</label>
                        <input type="checkbox" name="fencing" id="fencing">
                        <br>
                        <label for="fencing">Ограждение:</label>
                        <select name="fencing" id="fencing">
                            <option value="">---</option>
                            <option value="1">Профнастил</option>
                            <option value="2">Забор из дерева</option>
                            <option value="3">Евроштакетник</option>
                            <option value="4">Сетка рабица</option>
                            <option value="5">Монолитный</option>
                        </select>
                        <br>
                        
                        <label for="landscape">Профиль/ландшафт:</label>
                        <select name="landscape" id="landscape">
                            <option value="">---</option>
                            <option value="1">Ровный</option>
                            <option value="2">Не ровный</option>
                        </select>
                        <br>
                        <br>
                        
                        Дополнительные постройки:
                        <div class="indent">
                            <label for="bath">Баня</label>
                            <input type="checkbox" name="bath" id="bath">
                            <br>
                            <label for="garage">Гараж</label>
                            <input type="checkbox" name="garage" id="garage">
                            <br>
                            <label for="barn">Сарай</label>
                            <input type="checkbox" name="barn" id="barn">
                            <br>
                            <label for="pool">Бассейн</label>
                            <input type="checkbox" name="pool" id="pool">
                            <br>
                            <label for="alcove">Беседка</label>
                            <input type="checkbox" name="alcove" id="alcove">
                            <br>
                        </div>
                    </div>
                </div>
                
                <strong>Состав дома:</strong>
                <div class="indent">
                    Комнаты:
                    <div class="indent">
                        <label for="bedroom">Спальня</label>
                        <input type="checkbox" name="bedroom" id="bedroom">
                        <br>
                        <label for="kitchen">Кухня</label>
                        <input type="checkbox" name="kitchen" id="kitchen">
                        <br>
                        <label for="livingRoom">Гостиная</label>
                        <input type="checkbox" name="livingRoom" id="livingRoom">
                        <br>
                        <label for="hallway">Прихожая</label>
                        <input type="checkbox" name="hallway" id="hallway">
                        <br>
                        <label for="nursery">Детская</label>
                        <input type="checkbox" name="nursery" id="nursery">
                        <br>
                        <label for="study">Рабочий кабинет</label>
                        <input type="checkbox" name="study" id="study">
                        <br>
                        <label for="canteen">Столовая</label>
                        <input type="checkbox" name="canteen" id="canteen">
                        <br>
                        <label for="bathroom">Ванная</label>
                        <input type="checkbox" name="bathroom" id="bathroom">
                        <br>
                        
                        <label for="Hall">Зал</label>
                        <input type="checkbox" name="Hall" id="Hall">
                        <br>
                        <label for="basement">Подвал</label>
                        <input type="checkbox" name="basement" id="basement">
                        <br>
                        <label for="boilerroom">Котельная</label>
                        <input type="checkbox" name="boilerroom" id="boilerroom">
                        <br> <label for="veranda">Веранда</label>
                        <input type="checkbox" name="veranda" id="veranda">
                        <br>
                        <label for="wardrobe">Гардеробная</label>
                        <input type="checkbox" name="wardrobe" id="nursery">
                        <br>
                    </div>
                    
                    <label for="balcony">Балкон:</label>
                    <select name="balcony" id="balcony">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3+</option>
                        <option value="4">Нет</option>
                    </select>
                    <br>
                    <br>
                    
                    <label for="entrance">Количество входов:</label>
                    <select name="entrance" id="entrance">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3+</option>
                    </select>
                    <br>
                    <br>
                    
                    Состояние дома:
                    <div class="indent">
                        <label for="decoration">Отделка:</label>
                        <select name="decoration" id="decoration">
                            <option value="">---</option>
                            <option value="1">Да</option>
                            <option value="2">Нет</option>
                        </select>
                        <select name="decorationValue">
                            <option value="">---</option>
                            <option value="1">Премиум</option>
                            <option value="2">Стандартная</option>
                        </select>
                        <br>
                    </div>
                    <label for="lavatory">Санузел:</label>
                    <select name="lavatory" id="lavatory">
                        <option value="">---</option>
                        <option value="1">Совмещенный</option>
                        <option value="2">Раздельный</option>
                    </select>
                    <br>
                    
                    Жилищно-комунальные услуги:
                    <div class="indent">
                        <label for="heating">Отопление</label>
                        <input type="checkbox" name="heating" id="heating">
                        <br>
                        <label for="gas">Газ</label>
                        <input type="checkbox" name="gas" id="gas">
                        <br>
                        <label for="electricity">Электричество</label>
                        <input type="checkbox" name="electricity" id="electricity">
                        <br>
                        <label for="water">Водопровод</label>
                        <input type="checkbox" name="water" id="water">
                        <br>
                    </div>
                    
                    Наполнение дома:
                    <div class="indent">
                        Электроника для досуга и отдыха:
                        <div class="indent">
                            <label for="TV">Телевизор</label>
                            <input type="checkbox" name="TV" id="TV">
                            <br>
                            <label for="musicCenter">Музыкльный центр</label>
                            <input type="checkbox" name="musicCenter" id="musicCenter">
                            <br>
                            <label for="conditioner">Кондиционер</label>
                            <input type="checkbox" name="conditioner" id="conditioner">
                            <br>
                        </div>
                        
                        Бытовая техника:
                        <div class="indent">
                            <label for="fridge">Холодильник</label>
                            <input type="checkbox" name="fridge" id="fridge">
                            <br>
                            <label for="plate">Плита</label>
                            <input type="checkbox" name="plate" id="plate">
                            <br>
                            <label for="bake">Печь</label>
                            <input type="checkbox" name="bake" id="bake">
                            <br>
                            <label for="microwave">СВЧ</label>
                            <input type="checkbox" name="microwave" id="microwave">
                            <br>
                            <label for="dishwasher">Посудомойка</label>
                            <input type="checkbox" name="dishwasher" id="dishwasher">
                            <br>
                        </div>
                        
                        Мебель:
                        <div class="indent">
                            <label for="table">Стол</label>
                            <input type="checkbox" name="table" id="table">
                            <br>
                            <label for="bed">Кровать</label>
                            <input type="checkbox" name="bed" id="bed">
                            <br>
                            <label for="cupboard">Шкаф</label>
                            <input type="checkbox" name="cupboard" id="cupboard">
                            <br>
                            <label for="stand">Тумба</label>
                            <input type="checkbox" name="stand" id="stand">
                            <br>
                            <label for="mirror">Зеркало</label>
                            <input type="checkbox" name="mirror" id="mirror">
                            <br>
                            <label for="armchair">Кресло</label>
                            <input type="checkbox" name="armchair" id="armchair">
                            <br>
                            <label for="sofa">Диван</label>
                            <input type="checkbox" name="sofa" id="sofa">
                            <br>
                        </div>
                    </div>
                </div>
                <strong>Вложения:</strong>
                <div class="indent">
                    <label for="plan">План дома:</label>
                    <select name="plan" id="plan" onchange="">
                        <option value="">---</option>
                        <option value="1">Есть</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                    <label for="3d">3D проект:</label>
                    <select name="3d" id="3d" onchange="">
                        <option value="">---</option>
                        <option value="1">Есть</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                    <label for="video">Видео:</label>
                    <select name="video" id="video" onchange="">
                        <option value="">---</option>
                        <option value="1">Есть</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                    <label for="photo">Фото:</label>
                    <select name="photo" id="photo" onchange="">
                        <option value="">---</option>
                        <option value="1">Есть</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                </div>
            </div>
    </fieldset>
    
    <input style="margin: 20px 0 50px 0" type="submit" name="houseRent" value="Найти">
</form>

<span style="font-size: 15pt;">
    <strong>Аренда участка</strong>
</span>
<form action="/search" method="post">
    
    <input type="hidden" name="subject" value="ground">
    <input type="hidden" name="operation" value="rent">
    
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px">
            Цена:
            <div class="indent">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс.">
                <br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="1">Возможен</option>
                    <option value="2">Не возможен</option>
                </select>
                <br>
                <label for="rentType">Тип аренды:</label>
                <select name="rentType" id="rentType">
                    <option value="">---</option>
                    <option value="1">Часовая</option>
                    <option value="2">Посуточная</option>
                    <option value="3">Долгосрочная</option>
                </select>
            </div>
    
            Расположение:
            <br>
    
            <input type="text" id="search" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value)" onkeyup="return false;">
            <div id="map" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
    
            <div class="indent">
                <label for="country">Страна:</label> <span id="country"></span>
                <br>
                <label for="area">Область:</label> <span id="area"></span>
                <br>
                <label for="city">Город:</label> <span id="city"></span>
                <br>
                <label for="region">Район:</label> <span id="region"></span>
                <br>
                <label for="street">Улица:</label> <span id="street"></span>
                <br>
    
                <input id="rentGroundCountry" type="hidden" name="country" value="">
                <input id="rentGroundArea" type="hidden" name="area" value="">
                <input id="rentGroundCity" type="hidden" name="city" value="">
                <input id="rentGroundRegion" type="hidden" name="region" value="">
                <input id="rentGroundStreet" type="hidden" name="street" value="">
                
                <div class="indent">
                    Удаленность от города:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>
            
            <label for="landscape">Профиль/ландшафт:</label>
            <select name="landscape" id="landscape">
                <option value="">---</option>
                <option value="1">Ровный</option>
                <option value="2">Не ровный</option>
            </select>
            <br>
            <br>
        </div>
    </fieldset>
    
    <br>
    <br>
    
    <fieldset>
        <legend>Описание объекта</legend>
        <div style="margin: 15px">
            <strong>Основное:</strong>
            <div style="margin: 15px">
                <strong>Описание участка:</strong>
                <div class="indent">
                    <label for="TSJ">ТСЖ:</label>
                    <select name="TSJ" id="TSJ">
                        <option value="">---</option>
                        <option value="1">Кооператив</option>
                        <option value="2">Кондоминиум</option>
                        <option value="3">Частный дом</option>
                        <option value="4">Другое</option>
                    </select>
                    <br>
                    
                    <label for="fencing">Ограждение</label>
                    <input type="checkbox" name="fencing" id="fencing">
                    <br>
                    
                    <label for="fencing">Ограждение:</label>
                    <select name="fencing" id="fencing">
                        <option value="">---</option>
                        <option value="1">Профнастил</option>
                        <option value="2">Забор из дерева</option>
                        <option value="3">Евроштакетник</option>
                        <option value="4">Сетка рабица</option>
                        <option value="5">Монолитный</option>
                    </select>
                    <br>
                    
                    <label for="Flora">Флора:</label>
                    <select name="Flora" id="Flora">
                        <option value="">---</option>
                        <option value="1">Лесные деревья</option>
                        <option value="2">Садовые растения</option>
                    </select>
                    <br>
                </div>
            </div>
            
            <strong>Вложения:</strong>
            <div class="indent">
                <label for="plan">План участка:</label>
                <select name="plan" id="plan" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="3d">3D проект:</label>
                <select name="3d" id="3d" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="video">Видео:</label>
                <select name="video" id="video" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="photo">Фото:</label>
                <select name="photo" id="photo" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
            </div>
        </div>
    </fieldset>
    
    <input style="margin: 20px 0 50px 0" type="submit" name="groundRent" value="Найти">
</form>

<span style="font-size: 15pt;">
    <strong>Аренда комнаты</strong>
</span>
<form action="/search" method="post">
    
    <input type="hidden" name="subject" value="room">
    <input type="hidden" name="operation" value="rent">
    
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px">
            Цена:
            <div class="indent">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс.">
                <br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="1">Возможен</option>
                    <option value="2">Не возможен</option>
                </select>
                <br>
                <label for="rentType">Тип аренды:</label>
                <select name="rentType" id="rentType">
                    <option value="">---</option>
                    <option value="1">Часовая</option>
                    <option value="2">Посуточная</option>
                    <option value="3">Долгосрочная</option>
                </select>
            </div>
            
            <label for="roomsperpay">Комнат в продажу (шт.):</label>
            <select name="roomsperpay" id="roomsperpay">
                <option value="">---</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            
            <br>
            <br>
    
            Расположение:
            <br>
            <input type="text" id="search" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value)" onkeyup="return false;">
            <div id="map" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
    
            <div class="indent">
                <label for="country">Страна:</label> <span id="country"></span>
                <br>
                <label for="area">Область:</label> <span id="area"></span>
                <br>
                <label for="city">Город:</label> <span id="city"></span>
                <br>
                <label for="region">Район:</label> <span id="region"></span>
                <br>
                <label for="street">Улица:</label> <span id="street"></span>
                <br>
    
                <input id="rentRoomCountry" type="hidden" name="country" value="">
                <input id="rentRoomArea" type="hidden" name="area" value="">
                <input id="rentRoomCity" type="hidden" name="city" value="">
                <input id="rentRoomRegion" type="hidden" name="region" value="">
                <input id="rentRoomStreet" type="hidden" name="street" value="">
                
                Станция метро:
                <br>
                <div class="indent">
                    Удаленность от метро:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>
            
            <label for="roomlocation">Нахождение комнаты:</label>
            <select name="roomlocation" id="roomlocation">
                <option value="">---</option>
                <option value="1">Квартира</option>
                <option value="2">Общежитие</option>
                <option value="3">Частный дом</option>
            </select>
            <br>
            <br>
        </div>
    </fieldset>
    
    <br>
    <br>
    
    <fieldset>
        <legend>Описание объекта</legend>
        <div style="margin: 15px">
            <strong>Описание комнаты:</strong>
            <div class="indent">
                Площадь:
                <input type="text" name="spaceMin" placeholder="От">
                <input type="text" name="spaceMax" placeholder="До">
                <br>
                Этаж:
                <input type="text" name="floorMin" placeholder="От">
                <input type="text" name="floorMax" placeholder="До">
                <br>
                <label for="equipment">Комплектация:</label>
                <select name="equipment" id="equipment">
                    <option value="">---</option>
                    <option value="1">Укомплектованая</option>
                    <option value="2">Пустая</option>
                </select>
                <br>
                <label for="ceilingHeight">Высота потолков:</label>
                <input type="text" name="ceilingHeight" id="ceilingHeight">
            </div>
            
            Наполнение квартиры:
            <div class="indent">
                Электроника для досуга и отдыха:
                <div class="indent">
                    <label for="TV">Телевизор</label>
                    <input type="checkbox" name="TV" id="TV">
                    <br>
                    <label for="musicCenter">Музыкльный центр</label>
                    <input type="checkbox" name="musicCenter" id="musicCenter">
                    <br>
                    <label for="conditioner">Кондиционер</label>
                    <input type="checkbox" name="conditioner" id="conditioner">
                    <br>
                </div>
                
                Бытовая техника:
                <div class="indent">
                    <label for="fridge">Холодильник</label>
                    <input type="checkbox" name="fridge" id="fridge">
                    <br>
                    <label for="plate">Плита</label>
                    <input type="checkbox" name="plate" id="plate">
                    <br>
                    <label for="bake">Печь</label>
                    <input type="checkbox" name="bake" id="bake">
                    <br>
                    <label for="microwave">СВЧ</label>
                    <input type="checkbox" name="microwave" id="microwave">
                    <br>
                    <label for="dishwasher">Посудомойка</label>
                    <input type="checkbox" name="dishwasher" id="dishwasher">
                    <br>
                </div>
                
                Мебель:
                <div class="indent">
                    <label for="table">Стол</label>
                    <input type="checkbox" name="table" id="table">
                    <br>
                    <label for="bed">Кровать</label>
                    <input type="checkbox" name="bed" id="bed">
                    <br>
                    <label for="cupboard">Шкаф</label>
                    <input type="checkbox" name="cupboard" id="cupboard">
                    <br>
                    <label for="stand">Тумба</label>
                    <input type="checkbox" name="stand" id="stand">
                    <br>
                    <label for="mirror">Зеркало</label>
                    <input type="checkbox" name="mirror" id="mirror">
                    <br>
                    <label for="armchair">Кресло</label>
                    <input type="checkbox" name="armchair" id="armchair">
                    <br>
                    <label for="sofa">Диван</label>
                    <input type="checkbox" name="sofa" id="sofa">
                    <br>
                </div>
            </div>
            
            <div class="indent">
                <label for="decoration">Отделка:</label>
                <select name="decoration" id="decoration">
                    <option value="">---</option>
                    <option value="1">Да</option>
                    <option value="2">Нет</option>
                </select>
                <select name="decorationValue">
                    <option value="">---</option>
                    <option value="1">Премиум</option>
                    <option value="2">Стандартная</option>
                </select>
                <br>
            </div>
            
            <label for="balcony">Балкон:</label>
            <select name="balcony" id="balcony" onchange="">
                <option value="">---</option>
                <option value="1">Незастекленный</option>
                <option value="2">Лоджия</option>
            </select>
            <br>
            
            <div style="margin: 15px">
                <strong>Описание квартиры:</strong>
                <div class="indent">
                    <label for="houseType">Тип дома:</label>
                    <select name="houseType" id="houseType" onchange="">
                        <option value="">---</option>
                        <option value="1">Блочный</option>
                        <option value="2">Брежневка</option>
                        <option value="3">Индивидуальный</option>
                        <option value="4">Кирпично-монолитный</option>
                        <option value="5">Монолит</option>
                        <option value="6">Панельный</option>
                        <option value="7">Сталинка</option>
                        <option value="8">Хрущевка</option>
                        <option value="9">Серия дома</option>
                    </select>
                    <br>
                    
                    <div class="indent">
                        <label for="roomsNumber">Количество комнат:</label>
                        <select name="roomsNumber" id="roomsNumber" onchange="">
                            <option value="">---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4+</option>
                        </select>
                        <br>
                        
                        Площадь:
                        <input type="text" name="spaceMin" placeholder="От">
                        <input type="text" name="spaceMax" placeholder="До">
                        <br>
                        
                        Кухня:
                        <input type="text" name="spaceMinKitchen" placeholder="От">
                        <input type="text" name="spaceMaxKitchen" placeholder="До">
                        <br>
                        Этаж:
                        <input type="text" name="floorMin" placeholder="От">
                        <input type="text" name="floorMax" placeholder="До">
                        <br>
                        <label for="lavatory">Санузел:</label>
                        <select name="lavatory" id="lavatory">
                            <option value="">---</option>
                            <option value="1">Совмещенный</option>
                            <option value="2">Раздельный</option>
                        </select>
                        <br>
                        Жилищно-комунальные услуги:
                        <div class="indent">
                            <label for="heating">Отопление</label>
                            <input type="checkbox" name="heating" id="heating">
                            <br>
                            <label for="gas">Газ</label>
                            <input type="checkbox" name="gas" id="gas">
                            <br>
                            <label for="electricity">Электричество</label>
                            <input type="checkbox" name="electricity" id="electricity">
                            <br>
                            <label for="water">Водопровод</label>
                            <input type="checkbox" name="water" id="water">
                            <br>
                        </div>
                    </div>
                </div>
                <strong>Описание дома:</strong>
                <div class="indent">
                    <label for="houseType">Тип дома:</label>
                    <select name="houseType" id="houseType" onchange="">
                        <option value="">---</option>
                        <option value="1">Блочный</option>
                        <option value="2">Брежневка</option>
                        <option value="3">Индивидуальный</option>
                        <option value="4">Кирпично-монолитный</option>
                        <option value="5">Монолит</option>
                        <option value="6">Панельный</option>
                        <option value="7">Сталинка</option>
                        <option value="8">Хрущевка</option>
                        <option value="9">Серия дома</option>
                    </select>
                    <br>
                    
                    <label for="TSJ">ТСЖ:</label>
                    <select name="TSJ" id="TSJ">
                        <option value="">---</option>
                        <option value="1">Кооператив</option>
                        <option value="2">Кондоминиум</option>
                        <option value="3">Другое</option>
                    </select>
                    <br>
                    
                    <label for="houseFloorNumber">Количество этажей:</label>
                    <input type="text" name="houseFloorNumber" id="houseFloorNumber">
                    <br>
                    <label for="lift">Лифт</label>
                    <input type="checkbox" name="lift" id="lift">
                    <br>
                    <label for="stairs">Лестница</label>
                    <input type="checkbox" name="stairs" id="stairs">
                    <br>

                    <br>
                    <label for="parking">Парковка:</label>
                    <select name="parking" id="parking" onchange="">
                        <option value="">---</option>
                        <option value="1">Подземная</option>
                        <option value="2">Во дворе</option>
                        <option value="3">Платная (неподалеку)</option>
                    </select>
                    <br>
                    
                    Безопасность:
                    <div class="indent">
                        <label for="concierge">Консьерж</label>
                        <input type="checkbox" name="concierge" id="concierge">
                        <br>
                        <label for="security">Охрана</label>
                        <input type="checkbox" name="security" id="security">
                        <br>
                        <label for="intercom">Домофон</label>
                        <input type="checkbox" name="intercom" id="intercom">
                        <br>
                        <label for="CCTV">Видеонаблюдение</label>
                        <input type="checkbox" name="CCTV" id="CCTV">
                        <br>
                    </div>
                    
                    <label for="chute">Мусоропровод:</label>
                    <select name="chute" id="chute" onchange="">
                        <option value="">---</option>
                        <option value="1">Да</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                </div>
            </div>
            
            <strong>Вложения:</strong>
            <div class="indent">
                <label for="plan">План квартиры:</label>
                <select name="plan" id="plan" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="3d">3D проект:</label>
                <select name="3d" id="3d" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="video">Видео:</label>
                <select name="video" id="video" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="photo">Фото:</label>
                <select name="photo" id="photo" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
            </div>
        </div>
    </fieldset>
    
    <input style="margin: 20px 0 50px 0" type="submit" name="roomRent" value="Найти">
</form>


<span style="font-size: 15pt;">
    <strong>Продажа квартиры</strong>
</span>
<form action="/search" method="post">
    
    <input type="hidden" name="subject" value="apartment">
    <input type="hidden" name="operation" value="sell">
    
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px">
            Цена:
            <div class="indent">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс."><br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="yes">Возможен</option>
                    <option value="">Не возможен</option>
                </select>
                <br>
            </div>
            
            Расположение:
            <br>
            <input type="text" id="search" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value)" onkeyup="return false;">
            <div id="map" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
            
            <div class="indent">
                <label for="country">Страна:</label> <span id="country"></span>
                <br>
                <label for="area">Область:</label> <span id="area"></span>
                <br>
                <label for="city">Город:</label> <span id="city"></span>
                <br>
                <label for="region">Район:</label> <span id="region"></span>
                <br>
                <label for="street">Улица:</label> <span id="street"></span>
                <br>
    
                <input id="sellApartCountry" type="hidden" name="country" value="">
                <input id="sellApartArea" type="hidden" name="area" value="">
                <input id="sellApartCity" type="hidden" name="city" value="">
                <input id="sellApartRegion" type="hidden" name="region" value="">
                <input id="sellApartStreet" type="hidden" name="street" value="">
                
                Станция метро:
                <br>
                <div class="indent">
                    Удаленность от метро:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>
        </div>
    </fieldset>
    <br><br>
    <fieldset>
        <legend>Описание объекта</legend>
        <div style="margin: 15px">
            <strong>Квартира:</strong>
            <div class="indent">
                <label for="roomsNumber">Количество комнат:</label>
                <select name="roomsNumber" id="roomsNumber" onchange="">
                    <option value="">---</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4+</option>
                </select>
                <br>
                
                Площадь:
                <input type="text" name="spaceMin" placeholder="От">
                <input type="text" name="spaceMax" placeholder="До">
                <br>
                
                Этаж:
                <input type="text" name="floorMin" placeholder="От">
                <input type="text" name="floorMax" placeholder="До">
                <br>
                <label for="equipment">Комплектация:</label>
                <select name="equipment" id="equipment">
                    <option value="">---</option>
                    <option value="1">Укомплектованая</option>
                    <option value="2">Пустая</option>
                </select>
                <br>
                <label for="ceilingHeight">Высота потолков:</label>
                <input type="text" name="ceilingHeight" id="ceilingHeight">
            </div>
        </div>
        <div style="margin: 15px">
            <strong>Дом квартиры:</strong>
            <div class="indent">
                <label for="houseType">Тип дома:</label>
                <select name="houseType" id="houseType" onchange="">
                    <option value="">---</option>
                    <option value="1">Блочный</option>
                    <option value="2">Брежневка</option>
                    <option value="3">Индивидуальный</option>
                    <option value="4">Кирпично-монолитный</option>
                    <option value="5">Монолит</option>
                    <option value="6">Панельный</option>
                    <option value="7">Сталинка</option>
                    <option value="8">Хрущевка</option>
                    <option value="9">Серия дома
                    </option>
                </select>
                <br>
                
                <label for="houseFloorNumber">Количество этажей:</label>
                <input type="text" name="houseFloorNumber" id="houseFloorNumber">
                <br>
                
                <label for="lift">Лифт:</label>
                <select name="lift" id="lift" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                
                <label for="parking">Парковка:</label>
                <select name="parking" id="parking" onchange="">
                    <option value="">---</option>
                    <option value="1">Подземная</option>
                    <option value="2">Во дворе</option>
                    <option value="3">Платная (неподалеку)</option>
                </select>
                <br>
                
                Безопасность:
                <div class="indent">
                    <label for="concierge">Консьерж</label>
                    <input type="checkbox" name="concierge" id="concierge">
                    <br>
                    <label for="security">Охрана</label>
                    <input type="checkbox" name="security" id="security">
                    <br>
                    <label for="intercom">Домофон</label>
                    <input type="checkbox" name="intercom" id="intercom">
                    <br>
                    <label for="CCTV">Видеонаблюдение</label>
                    <input type="checkbox" name="CCTV" id="CCTV">
                    <br>
                </div>
                
                <label for="chute">Мусоропровод:</label>
                <select name="chute" id="chute" onchange="">
                    <option value="">---</option>
                    <option value="1">Да</option>
                    <option value="2">Нет</option>
                </select>
                <br>
            </div>
            
            <strong>Состав квартиры:</strong>
            <div class="indent">
                Комнаты:
                <div class="indent">
                    <label for="bedroom">Спальня</label>
                    <input type="checkbox" name="bedroom" id="bedroom">
                    <br>
                    <label for="kitchen">Кухня</label>
                    <input type="checkbox" name="kitchen" id="kitchen">
                    <br>
                    <label for="livingRoom">Гостиная</label>
                    <input type="checkbox" name="livingRoom" id="livingRoom">
                    <br>
                    <label for="hallway">Прихожая</label>
                    <input type="checkbox" name="hallway" id="hallway">
                    <br>
                    <label for="nursery">Детская</label>
                    <input type="checkbox" name="nursery" id="nursery">
                    <br>
                    <label for="study">Рабочий кабинет</label>
                    <input type="checkbox" name="study" id="study">
                    <br> <label for="canteen">Столовая</label>
                    <input type="checkbox" name="canteen" id="canteen">
                    <br>
                    <label for="bathroom">Ванная</label>
                    <input type="checkbox" name="bathroom" id="bathroom">
                    <br>
                </div>
                
                Состояние квартиры:
                <div class="indent">
                    <label for="decoration">Отделка:</label>
                    <select name="decoration" id="decoration">
                        <option value="">---</option>
                        <option value="1">Да</option>
                        <option value="2">Нет</option>
                    </select>
                    
                    <select name="decorationValue">
                        <option value="1">Люкс</option>
                        <option value="2">Косметическая</option>
                    </select>
                    <br>
                </div>
                <label for="lavatory">Санузел:</label>
                <select name="lavatory" id="lavatory">
                    <option value="">---</option>
                    <option value="1">Совмещенный</option>
                    <option value="2">Раздельный</option>
                </select>
                <br>
                <label for="balcony">Обязательноеналичие балкона</label>
                <input type="checkbox" name="balcony" id="balcony">
                <br>
                
                Жилищно-комунальные услуги:
                <div class="indent">
                    <label for="heating">Отопление</label>
                    <input type="checkbox" name="heating" id="heating">
                    <br>
                    <label for="gas">Газ</label>
                    <input type="checkbox" name="gas" id="gas">
                    <br>
                    <label for="electricity">Электричество</label>
                    <input type="checkbox" name="electricity" id="electricity">
                    <br>
                    <label for="water">Водопровод</label>
                    <input type="checkbox" name="water" id="water">
                    <br>
                </div>
                
                Наполнение квартиры:
                <div class="indent">
                    Электроника для досуга и отдыха:
                    <div class="indent">
                        <label for="TV">Телевизор</label>
                        <input type="checkbox" name="TV" id="TV">
                        <br>
                        <label for="musicCenter">Музыкльный центр</label>
                        <input type="checkbox" name="musicCenter" id="musicCenter">
                        <br>
                        <label for="conditioner">Кондиционер</label>
                        <input type="checkbox" name="conditioner" id="conditioner">
                        <br>
                    </div>
                    
                    Бытовая техника:
                    <div class="indent">
                        <label for="fridge">Холодильник</label>
                        <input type="checkbox" name="fridge" id="fridge">
                        <br>
                        <label for="plate">Плита</label>
                        <input type="checkbox" name="plate" id="plate">
                        <br>
                        <label for="bake">Печь</label>
                        <input type="checkbox" name="bake" id="bake">
                        <br>
                        <label for="microwave">СВЧ</label>
                        <input type="checkbox" name="microwave" id="microwave">
                        <br>
                        <label for="dishwasher">Посудомойка</label>
                        <input type="checkbox" name="dishwasher" id="dishwasher">
                        <br>
                    </div>
                    
                    Мебель:
                    <div class="indent">
                        <label for="table">Стол</label>
                        <input type="checkbox" name="table" id="table">
                        <br>
                        <label for="bed">Кровать</label>
                        <input type="checkbox" name="bed" id="bed">
                        <br>
                        <label for="cupboard">Шкаф</label>
                        <input type="checkbox" name="cupboard" id="cupboard">
                        <br>
                        <label for="stand">Тумба</label>
                        <input type="checkbox" name="stand" id="stand">
                        <br>
                        <label for="mirror">Зеркало</label>
                        <input type="checkbox" name="mirror" id="mirror">
                        <br>
                        <label for="armchair">Кресло</label>
                        <input type="checkbox" name="armchair" id="armchair">
                        <br>
                        <label for="sofa">Диван</label>
                        <input type="checkbox" name="sofa" id="sofa">
                        <br>
                    </div>
                </div>
            </div>
            
            <strong>Вложения:</strong>
            <div class="indent">
                <label for="plan">План квартиры:</label>
                <select name="plan" id="plan" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="3d">3D проект:</label>
                <select name="3d" id="3d" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="video">Видео:</label>
                <select name="video" id="video" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="photo">Фото:</label>
                <select name="photo" id="photo" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
            </div>
        </div>
    </fieldset>
    
    <input style="margin: 20px 0 50px 0" type="submit" name="apartSell" value="Найти">
</form>

<span style="font-size: 15pt;">
    <strong>Продажа дома</strong>
</span>
<form action="/search" method="post">
    
    <input type="hidden" name="subject" value="house">
    <input type="hidden" name="operation" value="sell">
    
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px">
            Цена:
            <div class="indent">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс.">
                <br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="1">Возможен</option>
                    <option value="2">Не возможен</option>
                </select>
                <br>
            </div>
            
            <div class="indent">
                <label for="floorsNumber">Количество этажей:</label>
                <select name="floorsNumber" id="roomsNumber" onchange="">
                    <option value="">---</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3+</option>
                    <option value="">Любое</option>
                </select>
            </div>
            
            <div class="indent">
                <label for="parking">Наличие парковочных мест:</label>
                <select name="parking" id="parking" onchange="">
                    <option value="">---</option>
                    <option value="1">1</option>
                    <option value="2">2+</option>
                    <option value="3">Отсутсвует</option>
                </select>
            </div>
            
            <div class="indent">
                <label for="season">Сезонность:</label>
                <select name="season" id="season" onchange="">
                    <option value="">---</option>
                    <option value="1">Круглый год</option>
                    <option value="2">Весна/лето</option>
                    <option value="">Любая</option>
                </select>
            </div>
            
            Расположение:
            <br>
            
            <input type="text" id="search" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value)" onkeyup="return false;">
            <div id="map" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
            
            <div class="indent">
                <label for="country">Страна:</label> <span id="country"></span>
                <br>
                <label for="area">Область:</label> <span id="area"></span>
                <br>
                <label for="city">Город:</label> <span id="city"></span>
                <br>
                <label for="region">Район:</label> <span id="region"></span>
                <br>
                <label for="street">Улица:</label> <span id="street"></span>
                <br>
    
                <input id="sellHouseCountry" type="hidden" name="country" value="">
                <input id="sellHouseArea" type="hidden" name="area" value="">
                <input id="sellHouseCity" type="hidden" name="city" value="">
                <input id="sellHouseRegion" type="hidden" name="region" value="">
                <input id="sellHouseStreet" type="hidden" name="street" value="">
                
                <div class="indent">
                    Удаленность от города:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>
        </div>
    </fieldset>
    <br>
    <br>
    <fieldset>
        <legend>Описание объекта</legend>
        <div style="margin: 15px">
            <strong>Основное:</strong>
            <div style="margin: 15px">
                <strong>Описание дома:</strong>
                <div class="indent">
                    <label for="roomsNumber">Количество комнат:</label>
                    <select name="roomsNumber" id="roomsNumber" onchange="">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4+</option>
                    </select>
                    <br>
                    Площадь:
                    <input type="text" name="spaceMin" placeholder="От">
                    <input type="text" name="spaceMax" placeholder="До">
                    <br>
                    <label for="equipment">Комплектация:</label>
                    <select name="equipment" id="equipment">
                        <option value="">---</option>
                        <option value="1">Укомплектован</option>
                        <option value="2">Пустой</option>
                    </select>
                    <br>
                    
                    <label for="type">Тип:</label>
                    <select name="type" id="type">
                        <option value="">---</option>
                        <option value="1">Частный</option>
                        <option value="2">Многоквартирный</option>
                        <option value="3">Таунхаус</option>
                        <option value="4">Усадьба</option>
                    </select><br>
                    
                    <label for="style">Стиль:</label>
                    <select name="style" id="style">
                        <option value="">---</option>
                        <option value="1">Классический</option>
                        <option value="2">Русский</option>
                        <option value="3">Русская усадьба</option>
                        <option value="4">Замковый</option>
                        <option value="5">Ренессанс</option>
                        <option value="6">Готический</option>
                        <option value="7">Барокко</option>
                        <option value="8">Рококо</option>
                        <option value="9">Классицизм</option>
                        <option value="10">Ампир</option>
                        <option value="11">Эклектика</option>
                        <option value="12">Модерн</option>
                        <option value="13">Органическая архитектура</option>
                        <option value="14">Конструктивизм</option>
                        <option value="15">Ар-деко</option>
                        <option value="16">Минимализм</option>
                        <option value="17">High tech</option>
                        <option value="18">Финский минимализм</option>
                        <option value="19">Шале</option>
                        <option value="20">Фахверк</option>
                        <option value="21">Скандинавский</option>
                        <option value="22">Восточный</option>
                        <option value="23">Американский кантри</option>
                        <option value="24">Шато</option>
                        <option value="25">Адирондак</option>
                        <option value="25">Стиль прерий</option>
                    </select>
                    <br>
                    
                    <label for="Material">Материал облицовки:</label>
                    <select name="Material" id="Material">
                        <option value="">---</option>
                        <option value="1">Кирпич</option>
                        <option value="2">Камень</option>
                        <option value="3">Фасадная плитка</option>
                        <option value="4">Фасадная панель</option>
                        <option value="5">Деревянная панель</option>
                        <option value="6">Штукатурка</option>
                    </select>
                    <br>
                    
                    <label for="ceilingHeight">Высота потолков:</label>
                    <select name="ceilingHeight" id="ceilingHeight">
                        <option value="">---</option>
                        <option value="1">2м</option>
                        <option value="2">3м</option>
                        <option value="3">4м</option>
                        <option value="4">5м</option>
                    </select>
                    <br>
                </div>
                <div style="margin: 15px">
                    <strong>Описание участка:</strong>
                    
                    <div class="indent">
                        <label for="TSJ">ТСЖ:</label>
                        <select name="TSJ" id="TSJ">
                            <option value="">---</option>
                            <option value="1">Кооператив</option>
                            <option value="2">Кондоминиум</option>
                            <option value="3">Частный дом</option>
                            <option value="4">Другое</option>
                        </select>
                        <br>
                        
                        <label for="parking">Место для автомобиля:</label>
                        <select name="parking" id="parking">
                            <option value="">---</option>
                            <option value="1">Парковачное место</option>
                            <option value="2">Закрытый гараж</option>
                            <option value="3">За пределами участка</option>
                        </select>
                        <br>
                        
                        <label for="fencing">Ограждение</label>
                        <input type="checkbox" name="fencing" id="fencing">
                        <br>
                        <label for="fencing">Ограждение:</label>
                        <select name="fencing" id="fencing">
                            <option value="">---</option>
                            <option value="1">Профнастил</option>
                            <option value="2">Забор из дерева</option>
                            <option value="3">Евроштакетник</option>
                            <option value="4">Сетка рабица</option>
                            <option value="5">Монолитный</option>
                        </select>
                        <br>
                        
                        <label for="landscape">Профиль/ландшафт:</label>
                        <select name="landscape" id="landscape">
                            <option value="">---</option>
                            <option value="1">Ровный</option>
                            <option value="2">Не ровный</option>
                        </select>
                        <br>
                        <br>
                        
                        Дополнительные постройки:
                        <div class="indent">
                            <label for="bath">Баня</label>
                            <input type="checkbox" name="bath" id="bath">
                            <br>
                            <label for="garage">Гараж</label>
                            <input type="checkbox" name="garage" id="garage">
                            <br>
                            <label for="barn">Сарай</label>
                            <input type="checkbox" name="barn" id="barn">
                            <br>
                            <label for="pool">Бассейн</label>
                            <input type="checkbox" name="pool" id="pool">
                            <br>
                            <label for="alcove">Беседка</label>
                            <input type="checkbox" name="alcove" id="alcove">
                            <br>
                        </div>
                    </div>
                </div>
                
                <strong>Состав дома:</strong>
                <div class="indent">
                    Комнаты:
                    <div class="indent">
                        <label for="bedroom">Спальня</label>
                        <input type="checkbox" name="bedroom" id="bedroom">
                        <br>
                        <label for="kitchen">Кухня</label>
                        <input type="checkbox" name="kitchen" id="kitchen">
                        <br>
                        <label for="livingRoom">Гостиная</label>
                        <input type="checkbox" name="livingRoom" id="livingRoom">
                        <br>
                        <label for="hallway">Прихожая</label>
                        <input type="checkbox" name="hallway" id="hallway">
                        <br>
                        <label for="nursery">Детская</label>
                        <input type="checkbox" name="nursery" id="nursery">
                        <br>
                        <label for="study">Рабочий кабинет</label>
                        <input type="checkbox" name="study" id="study">
                        <br>
                        <label for="canteen">Столовая</label>
                        <input type="checkbox" name="canteen" id="canteen">
                        <br>
                        <label for="bathroom">Ванная</label>
                        <input type="checkbox" name="bathroom" id="bathroom">
                        <br>
                        
                        <label for="Hall">Зал</label>
                        <input type="checkbox" name="Hall" id="Hall">
                        <br>
                        <label for="basement">Подвал</label>
                        <input type="checkbox" name="basement" id="basement">
                        <br>
                        <label for="boilerroom">Котельная</label>
                        <input type="checkbox" name="boilerroom" id="boilerroom">
                        <br> <label for="veranda">Веранда</label>
                        <input type="checkbox" name="veranda" id="veranda">
                        <br>
                        <label for="wardrobe">Гардеробная</label>
                        <input type="checkbox" name="wardrobe" id="nursery">
                        <br>
                    </div>
                    
                    <label for="balcony">Балкон:</label>
                    <select name="balcony" id="balcony">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3+</option>
                        <option value="4">Нет</option>
                    </select>
                    <br>
                    <br>
                    
                    <label for="entrance">Количество входов:</label>
                    <select name="entrance" id="entrance">
                        <option value="">---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3+</option>
                    </select>
                    <br>
                    <br>
                    
                    Состояние дома:
                    <div class="indent">
                        <label for="decoration">Отделка:</label>
                        <select name="decoration" id="decoration">
                            <option value="">---</option>
                            <option value="1">Да</option>
                            <option value="2">Нет</option>
                        </select>
                        <select name="decorationValue">
                            <option value="">---</option>
                            <option value="1">Премиум</option>
                            <option value="2">Стандартная</option>
                        </select>
                        <br>
                    </div>
                    <label for="lavatory">Санузел:</label>
                    <select name="lavatory" id="lavatory">
                        <option value="">---</option>
                        <option value="1">Совмещенный</option>
                        <option value="2">Раздельный</option>
                    </select>
                    <br>
                    
                    Жилищно-комунальные услуги:
                    <div class="indent">
                        <label for="heating">Отопление</label>
                        <input type="checkbox" name="heating" id="heating">
                        <br>
                        <label for="gas">Газ</label>
                        <input type="checkbox" name="gas" id="gas">
                        <br>
                        <label for="electricity">Электричество</label>
                        <input type="checkbox" name="electricity" id="electricity">
                        <br>
                        <label for="water">Водопровод</label>
                        <input type="checkbox" name="water" id="water">
                        <br>
                    </div>
                    
                    Наполнение дома:
                    <div class="indent">
                        Электроника для досуга и отдыха:
                        <div class="indent">
                            <label for="TV">Телевизор</label>
                            <input type="checkbox" name="TV" id="TV">
                            <br>
                            <label for="musicCenter">Музыкльный центр</label>
                            <input type="checkbox" name="musicCenter" id="musicCenter">
                            <br>
                            <label for="conditioner">Кондиционер</label>
                            <input type="checkbox" name="conditioner" id="conditioner">
                            <br>
                        </div>
                        
                        Бытовая техника:
                        <div class="indent">
                            <label for="fridge">Холодильник</label>
                            <input type="checkbox" name="fridge" id="fridge">
                            <br>
                            <label for="plate">Плита</label>
                            <input type="checkbox" name="plate" id="plate">
                            <br>
                            <label for="bake">Печь</label>
                            <input type="checkbox" name="bake" id="bake">
                            <br>
                            <label for="microwave">СВЧ</label>
                            <input type="checkbox" name="microwave" id="microwave">
                            <br>
                            <label for="dishwasher">Посудомойка</label>
                            <input type="checkbox" name="dishwasher" id="dishwasher">
                            <br>
                        </div>
                        
                        Мебель:
                        <div class="indent">
                            <label for="table">Стол</label>
                            <input type="checkbox" name="table" id="table">
                            <br>
                            <label for="bed">Кровать</label>
                            <input type="checkbox" name="bed" id="bed">
                            <br>
                            <label for="cupboard">Шкаф</label>
                            <input type="checkbox" name="cupboard" id="cupboard">
                            <br>
                            <label for="stand">Тумба</label>
                            <input type="checkbox" name="stand" id="stand">
                            <br>
                            <label for="mirror">Зеркало</label>
                            <input type="checkbox" name="mirror" id="mirror">
                            <br>
                            <label for="armchair">Кресло</label>
                            <input type="checkbox" name="armchair" id="armchair">
                            <br>
                            <label for="sofa">Диван</label>
                            <input type="checkbox" name="sofa" id="sofa">
                            <br>
                        </div>
                    </div>
                </div>
                <strong>Вложения:</strong>
                <div class="indent">
                    <label for="plan">План дома:</label>
                    <select name="plan" id="plan" onchange="">
                        <option value="">---</option>
                        <option value="1">Есть</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                    <label for="3d">3D проект:</label>
                    <select name="3d" id="3d" onchange="">
                        <option value="">---</option>
                        <option value="1">Есть</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                    <label for="video">Видео:</label>
                    <select name="video" id="video" onchange="">
                        <option value="">---</option>
                        <option value="1">Есть</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                    <label for="photo">Фото:</label>
                    <select name="photo" id="photo" onchange="">
                        <option value="">---</option>
                        <option value="1">Есть</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                </div>
            </div>
    </fieldset>
    
    <input style="margin: 20px 0 50px 0" type="submit" name="houseSell" value="Найти">
</form>

<span style="font-size: 15pt;">
    <strong>Продажа участка</strong>
</span>
<form action="/search" method="post">
    
    <input type="hidden" name="subject" value="ground">
    <input type="hidden" name="operation" value="sell">
    
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px">
            Цена:
            <div class="indent">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс.">
                <br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="1">Возможен</option>
                    <option value="2">Не возможен</option>
                </select>
                <br>
            </div>
            
            Расположение:
            <br>
            
            <input type="text" id="search" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value)" onkeyup="return false;">
            <div id="map" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
            
            <div class="indent">
                <label for="country">Страна:</label> <span id="country"></span>
                <br>
                <label for="area">Область:</label> <span id="area"></span>
                <br>
                <label for="city">Город:</label> <span id="city"></span>
                <br>
                <label for="region">Район:</label> <span id="region"></span>
                <br>
                <label for="street">Улица:</label> <span id="street"></span>
                <br>
    
                <input id="sellGroundCountry" type="hidden" name="country" value="">
                <input id="sellGroundArea" type="hidden" name="area" value="">
                <input id="sellGroundCity" type="hidden" name="city" value="">
                <input id="sellGroundRegion" type="hidden" name="region" value="">
                <input id="sellGroundStreet" type="hidden" name="street" value="">
                
                <div class="indent">
                    Удаленность от города:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>
            
            <label for="landscape">Профиль/ландшафт:</label>
            <select name="landscape" id="landscape">
                <option value="">---</option>
                <option value="1">Ровный</option>
                <option value="2">Не ровный</option>
            </select>
            <br>
            <br>
        </div>
    </fieldset>
    
    <br>
    <br>
    
    <fieldset>
        <legend>Описание объекта</legend>
        <div style="margin: 15px">
            <strong>Основное:</strong>
            <div style="margin: 15px">
                <strong>Описание участка:</strong>
                <div class="indent">
                    <label for="TSJ">ТСЖ:</label>
                    <select name="TSJ" id="TSJ">
                        <option value="">---</option>
                        <option value="1">Кооператив</option>
                        <option value="2">Кондоминиум</option>
                        <option value="3">Частный дом</option>
                        <option value="4">Другое</option>
                    </select>
                    <br>
                    
                    <label for="fencing">Ограждение</label>
                    <input type="checkbox" name="fencing" id="fencing">
                    <br>
                    
                    <label for="fencing">Ограждение:</label>
                    <select name="fencing" id="fencing">
                        <option value="">---</option>
                        <option value="1">Профнастил</option>
                        <option value="2">Забор из дерева</option>
                        <option value="3">Евроштакетник</option>
                        <option value="4">Сетка рабица</option>
                        <option value="5">Монолитный</option>
                    </select>
                    <br>
                    
                    <label for="Flora">Флора:</label>
                    <select name="Flora" id="Flora">
                        <option value="">---</option>
                        <option value="1">Лесные деревья</option>
                        <option value="2">Садовые растения</option>
                    </select>
                    <br>
                </div>
            </div>
            
            <strong>Вложения:</strong>
            <div class="indent">
                <label for="plan">План участка:</label>
                <select name="plan" id="plan" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="3d">3D проект:</label>
                <select name="3d" id="3d" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="video">Видео:</label>
                <select name="video" id="video" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="photo">Фото:</label>
                <select name="photo" id="photo" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
            </div>
        </div>
    </fieldset>
    
    <input style="margin: 20px 0 50px 0" type="submit" name="groundSell" value="Найти">
</form>

<span style="font-size: 15pt;">
    <strong>Продажа комнаты</strong>
</span>
<form action="/search" method="post">
    
    <input type="hidden" name="subject" value="room">
    <input type="hidden" name="operation" value="sell">
    
    <fieldset>
        <legend>Базовые параметры</legend>
        <div style="margin: 15px">
            Цена:
            <div class="indent">
                Стоимость:
                <input name="minPrice" type="text" placeholder="Мин.">
                <input name="maxPrice" type="text" placeholder="Макс.">
                <br>
                <label for="bargain">Торг:</label>
                <select name="bargain" id="bargain">
                    <option value="">---</option>
                    <option value="1">Возможен</option>
                    <option value="2">Не возможен</option>
                </select>
                <br>
            </div>
            
            <label for="roomsperpay">Комнат в продажу (шт.):</label>
            <select name="roomsperpay" id="roomsperpay">
                <option value="">---</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
            
            <br>
            <br>
            
            Расположение:
            <br>
            <input type="text" id="search" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value)" onkeyup="return false;">
            <div id="map" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
            
            <div class="indent">
                <label for="country">Страна:</label> <span id="country"></span>
                <br>
                <label for="area">Область:</label> <span id="area"></span>
                <br>
                <label for="city">Город:</label> <span id="city"></span>
                <br>
                <label for="region">Район:</label> <span id="region"></span>
                <br>
                <label for="street">Улица:</label> <span id="street"></span>
                <br>
    
                <input id="sellRoomCountry" type="hidden" name="country" value="">
                <input id="sellRoomArea" type="hidden" name="area" value="">
                <input id="sellRoomCity" type="hidden" name="city" value="">
                <input id="sellRoomRegion" type="hidden" name="region" value="">
                <input id="sellRoomStreet" type="hidden" name="street" value="">
                
                Станция метро:
                <br>
                <div class="indent">
                    Удаленность от метро:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>
            
            <label for="roomlocation">Нахождение комнаты:</label>
            <select name="roomlocation" id="roomlocation">
                <option value="">---</option>
                <option value="1">Квартира</option>
                <option value="2">Общежитие</option>
                <option value="3">Частный дом</option>
            </select>
            <br>
            <br>
        </div>
    </fieldset>
    
    <br>
    <br>
    
    <fieldset>
        <legend>Описание объекта</legend>
        <div style="margin: 15px">
            <strong>Описание комнаты:</strong>
            <div class="indent">
                Площадь:
                <input type="text" name="spaceMin" placeholder="От">
                <input type="text" name="spaceMax" placeholder="До">
                <br>
                Этаж:
                <input type="text" name="floorMin" placeholder="От">
                <input type="text" name="floorMax" placeholder="До">
                <br>
                <label for="equipment">Комплектация:</label>
                <select name="equipment" id="equipment">
                    <option value="">---</option>
                    <option value="1">Укомплектованая</option>
                    <option value="2">Пустая</option>
                </select>
                <br>
                <label for="ceilingHeight">Высота потолков:</label>
                <input type="text" name="ceilingHeight" id="ceilingHeight">
            </div>
            
            Наполнение квартиры:
            <div class="indent">
                Электроника для досуга и отдыха:
                <div class="indent">
                    <label for="TV">Телевизор</label>
                    <input type="checkbox" name="TV" id="TV">
                    <br>
                    <label for="musicCenter">Музыкльный центр</label>
                    <input type="checkbox" name="musicCenter" id="musicCenter">
                    <br>
                    <label for="conditioner">Кондиционер</label>
                    <input type="checkbox" name="conditioner" id="conditioner">
                    <br>
                </div>
                
                Бытовая техника:
                <div class="indent">
                    <label for="fridge">Холодильник</label>
                    <input type="checkbox" name="fridge" id="fridge">
                    <br>
                    <label for="plate">Плита</label>
                    <input type="checkbox" name="plate" id="plate">
                    <br>
                    <label for="bake">Печь</label>
                    <input type="checkbox" name="bake" id="bake">
                    <br>
                    <label for="microwave">СВЧ</label>
                    <input type="checkbox" name="microwave" id="microwave">
                    <br>
                    <label for="dishwasher">Посудомойка</label>
                    <input type="checkbox" name="dishwasher" id="dishwasher">
                    <br>
                </div>
                
                Мебель:
                <div class="indent">
                    <label for="table">Стол</label>
                    <input type="checkbox" name="table" id="table">
                    <br>
                    <label for="bed">Кровать</label>
                    <input type="checkbox" name="bed" id="bed">
                    <br>
                    <label for="cupboard">Шкаф</label>
                    <input type="checkbox" name="cupboard" id="cupboard">
                    <br>
                    <label for="stand">Тумба</label>
                    <input type="checkbox" name="stand" id="stand">
                    <br>
                    <label for="mirror">Зеркало</label>
                    <input type="checkbox" name="mirror" id="mirror">
                    <br>
                    <label for="armchair">Кресло</label>
                    <input type="checkbox" name="armchair" id="armchair">
                    <br>
                    <label for="sofa">Диван</label>
                    <input type="checkbox" name="sofa" id="sofa">
                    <br>
                </div>
            </div>
            
            <div class="indent">
                <label for="decoration">Отделка:</label>
                <select name="decoration" id="decoration">
                    <option value="">---</option>
                    <option value="1">Да</option>
                    <option value="2">Нет</option>
                </select>
                <select name="decorationValue">
                    <option value="">---</option>
                    <option value="1">Премиум</option>
                    <option value="2">Стандартная</option>
                </select>
                <br>
            </div>
            
            <label for="balcony">Балкон:</label>
            <select name="balcony" id="balcony" onchange="">
                <option value="">---</option>
                <option value="1">Незастекленный</option>
                <option value="2">Лоджия</option>
            </select>
            <br>
            
            <div style="margin: 15px">
                <strong>Описание квартиры:</strong>
                <div class="indent">
                    <label for="houseType">Тип дома:</label>
                    <select name="houseType" id="houseType" onchange="">
                        <option value="">---</option>
                        <option value="1">Блочный</option>
                        <option value="2">Брежневка</option>
                        <option value="3">Индивидуальный</option>
                        <option value="4">Кирпично-монолитный</option>
                        <option value="5">Монолит</option>
                        <option value="6">Панельный</option>
                        <option value="7">Сталинка</option>
                        <option value="8">Хрущевка</option>
                        <option value="9">Серия дома</option>
                    </select>
                    <br>
                    
                    <div class="indent">
                        <label for="roomsNumber">Количество комнат:</label>
                        <select name="roomsNumber" id="roomsNumber" onchange="">
                            <option value="">---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4+</option>
                        </select>
                        <br>
                        
                        Площадь:
                        <input type="text" name="spaceMin" placeholder="От">
                        <input type="text" name="spaceMax" placeholder="До">
                        <br>
                        
                        Кухня:
                        <input type="text" name="spaceMinKitchen" placeholder="От">
                        <input type="text" name="spaceMaxKitchen" placeholder="До">
                        <br>
                        Этаж:
                        <input type="text" name="floorMin" placeholder="От">
                        <input type="text" name="floorMax" placeholder="До">
                        <br>
                        <label for="lavatory">Санузел:</label>
                        <select name="lavatory" id="lavatory">
                            <option value="">---</option>
                            <option value="1">Совмещенный</option>
                            <option value="2">Раздельный</option>
                        </select>
                        <br>
                        Жилищно-комунальные услуги:
                        <div class="indent">
                            <label for="heating">Отопление</label>
                            <input type="checkbox" name="heating" id="heating">
                            <br>
                            <label for="gas">Газ</label>
                            <input type="checkbox" name="gas" id="gas">
                            <br>
                            <label for="electricity">Электричество</label>
                            <input type="checkbox" name="electricity" id="electricity">
                            <br>
                            <label for="water">Водопровод</label>
                            <input type="checkbox" name="water" id="water">
                            <br>
                        </div>
                    </div>
                </div>
                <strong>Описание дома:</strong>
                <div class="indent">
                    <label for="houseType">Тип дома:</label>
                    <select name="houseType" id="houseType" onchange="">
                        <option value="">---</option>
                        <option value="1">Блочный</option>
                        <option value="2">Брежневка</option>
                        <option value="3">Индивидуальный</option>
                        <option value="4">Кирпично-монолитный</option>
                        <option value="5">Монолит</option>
                        <option value="6">Панельный</option>
                        <option value="7">Сталинка</option>
                        <option value="8">Хрущевка</option>
                        <option value="9">Серия дома</option>
                    </select>
                    <br>
                    
                    <label for="TSJ">ТСЖ:</label>
                    <select name="TSJ" id="TSJ">
                        <option value="">---</option>
                        <option value="1">Кооператив</option>
                        <option value="2">Кондоминиум</option>
                        <option value="3">Другое</option>
                    </select>
                    <br>
                    
                    <label for="houseFloorNumber">Количество этажей:</label>
                    <input type="text" name="houseFloorNumber" id="houseFloorNumber">
                    <br>
                    <label for="lift">Лифт</label>
                    <input type="checkbox" name="lift" id="lift">
                    <br>
                    <label for="stairs">Лестница</label>
                    <input type="checkbox" name="stairs" id="stairs">
                    <br>
                    
                    <br>
                    <label for="parking">Парковка:</label>
                    <select name="parking" id="parking" onchange="">
                        <option value="">---</option>
                        <option value="1">Подземная</option>
                        <option value="2">Во дворе</option>
                        <option value="3">Платная (неподалеку)</option>
                    </select>
                    <br>
                    
                    Безопасность:
                    <div class="indent">
                        <label for="concierge">Консьерж</label>
                        <input type="checkbox" name="concierge" id="concierge">
                        <br>
                        <label for="security">Охрана</label>
                        <input type="checkbox" name="security" id="security">
                        <br>
                        <label for="intercom">Домофон</label>
                        <input type="checkbox" name="intercom" id="intercom">
                        <br>
                        <label for="CCTV">Видеонаблюдение</label>
                        <input type="checkbox" name="CCTV" id="CCTV">
                        <br>
                    </div>
                    
                    <label for="chute">Мусоропровод:</label>
                    <select name="chute" id="chute" onchange="">
                        <option value="">---</option>
                        <option value="1">Да</option>
                        <option value="2">Нет</option>
                    </select>
                    <br>
                </div>
            </div>
            
            <strong>Вложения:</strong>
            <div class="indent">
                <label for="plan">План квартиры:</label>
                <select name="plan" id="plan" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="3d">3D проект:</label>
                <select name="3d" id="3d" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="video">Видео:</label>
                <select name="video" id="video" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
                <label for="photo">Фото:</label>
                <select name="photo" id="photo" onchange="">
                    <option value="">---</option>
                    <option value="1">Есть</option>
                    <option value="2">Нет</option>
                </select>
                <br>
            </div>
        </div>
    </fieldset>
    
    <input style="margin: 20px 0 50px 0" type="submit" name="roomSell" value="Найти">
</form>