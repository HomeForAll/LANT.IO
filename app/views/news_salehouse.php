<h3>Продать дом</h3>
<input type="hidden" name="category" value="13">


        
        <fieldset>
        <legend>Базовая информация</legend>
        <div  class="spoiler_button"> + </div>
         <div class="spoiler_body">
        <label>
        <span>Цена: </span>
        <input type="text" name="price" <?php inputToInput('price'); ?>/>
        </label>
        <label>
        <span>Торг возможен:</span>
        <input type="hidden" name="bargain_available" value="">
        <input type="checkbox" name="bargain_available" value="true" <?php inputToCheckbox('bargain_available'); ?>>
        </label>
             <!-- Разница с арендой (вставка) -->
        <label>
        <span>Количество этажей: </span>
        <input type="text" name="number_of_floors" <?php inputToInput('number_of_floors'); ?>/>
        </label>
                        <label>
        <span>Сезонность: </span>
        <span>
            Круглый год <input type="radio" name="seasonality" value="1" <?php inputToRadio('seasonality','1'); ?> >
            Весна-лето <input type="radio" name="seasonality" value="2" <?php inputToRadio('seasonality','2'); ?> >
        </span>
                </label>
        
         <fieldset>
        <legend>Расположение</legend>
        <label>
        <span>Страна: </span>
        <input type="text" name="country" <?php inputToInput('country'); ?>/>
        </label>
        <label>
        <span>Область: </span>
        <input type="text" name="area"  <?php inputToInput('area'); ?>/>
        </label>
        <label>
        <span>Город (посёлок): </span>
        <input type="text" name="city" <?php inputToInput('city'); ?>/>
        </label>
        <label>
        <span>Район: </span>
        <input type="text" name="region"  <?php inputToInput('region'); ?>/>
        </label>
        <label>
        <span>Улица: </span>
        <input type="text" name="street" <?php inputToInput('street'); ?>/>
        </label>
        <label>
        <span>Номер дома: </span>
        <input type="text" name="house_number"  <?php inputToInput('house_number'); ?>/>
        </label>

        
        <span>Выбрать область на карте</span>
        
        <label>
        <span>Удаленность от города: </span>
        <input type="text" name="distance_from_city" <?php inputToInput('distance_from_city'); ?>/>
        </label>
        
                
         </fieldset>
         </div>
        </fieldset><!-- Базовая информация  -->
        
                <fieldset>
        <legend>Основное</legend>
                <div  class="spoiler_button"> + </div>
                <div class="spoiler_body">
        <fieldset>
        <legend>Описание дома</legend>
        <label>
        <span>Количество комнат: </span>
        <input type="text" name="number_of_rooms" <?php inputToInput('number_of_rooms'); ?>/>
        </label>
        <label>
        <span>Площадь: </span>
        <input type="text" name="space" <?php inputToInput('number_of_rooms'); ?>/>
        </label>
        <label>
        <span>Комплектация: </span>
        <span>
            Укомплектованная <input type="radio" name="equipment" value="1" <?php inputToRadio('equipment','1'); ?> >
            Пустая <input type="radio" name="equipment" value="2" <?php inputToRadio('equipment','2'); ?> >
        </span>
        </label>
                <label>
        <span>Тип дома: </span>
        <select name="type_of_house">
        <option value="11" <?php inputToSelect('type_of_house', '11'); ?> >Частный</option>
        <option value="12" <?php inputToSelect('type_of_house', '12'); ?> >Многоквартирный</option>
        <option value="13" <?php inputToSelect('type_of_house', '13'); ?> >Таунхаус</option>
        <option value="14" <?php inputToSelect('type_of_house', '14'); ?> >Усадьба</option>
        </select>
                </label>
                        <label>
        <span>Стиль дома: </span>
        <select name="style_of_house">
        <option value="1" <?php inputToSelect('style_of_house', '1'); ?> >Классический</option>
        <option value="2" <?php inputToSelect('style_of_house', '2'); ?> >Русский</option>
        <option value="3" <?php inputToSelect('style_of_house', '3'); ?> >Русская усадьба</option>
        <option value="4" <?php inputToSelect('style_of_house', '4'); ?> >Замковый</option>
        <option value="5" <?php inputToSelect('style_of_house', '5'); ?> >Ренессанс</option>
        <option value="6" <?php inputToSelect('style_of_house', '6'); ?> >Готический</option>
        <option value="7" <?php inputToSelect('style_of_house', '7'); ?> >Барокко</option>
        <option value="8" <?php inputToSelect('style_of_house', '8'); ?> >Рококо</option>
        <option value="9" <?php inputToSelect('style_of_house', '9'); ?> >Классицизм</option>
        <option value="10" <?php inputToSelect('style_of_house', '10'); ?> >Ампир</option>
        <option value="11" <?php inputToSelect('style_of_house', '11'); ?> >Эклектика</option>
        <option value="12" <?php inputToSelect('style_of_house', '12'); ?> >Модерн</option>
        <option value="13" <?php inputToSelect('style_of_house', '13'); ?> >Органическая архитектура</option>
        <option value="14" <?php inputToSelect('style_of_house', '14'); ?> >Конструктивизм</option>
        <option value="15" <?php inputToSelect('style_of_house', '15'); ?> >Ар-деко</option>
        <option value="16" <?php inputToSelect('style_of_house', '16'); ?> >Минимализм</option>
        <option value="17" <?php inputToSelect('style_of_house', '17'); ?> >High tech</option>
        <option value="18" <?php inputToSelect('style_of_house', '18'); ?> >Финский минимализм</option>
        <option value="19" <?php inputToSelect('style_of_house', '19'); ?> >Шале</option>
        <option value="20" <?php inputToSelect('style_of_house', '20'); ?> >Фахверк</option>
        <option value="21" <?php inputToSelect('style_of_house', '21'); ?> >Скандинавский</option>
        <option value="22" <?php inputToSelect('style_of_house', '22'); ?> >Восточный</option>
        <option value="23" <?php inputToSelect('style_of_house', '23'); ?> >Американский кантри</option>
        <option value="24" <?php inputToSelect('style_of_house', '24'); ?> >Шато</option>
        <option value="25" <?php inputToSelect('style_of_house', '25'); ?> >Адирондак</option>
        <option value="26" <?php inputToSelect('style_of_house', '26'); ?> >Стильпрерий</option>
        </select>
                </label>
                        <label>
        <span>Материал облицовки: </span>
        <select name="material_lining">
        <option value="1" <?php inputToSelect('material_lining', '1'); ?> >Кирпич</option>
        <option value="2" <?php inputToSelect('material_lining', '2'); ?> >Камень</option>
        <option value="3" <?php inputToSelect('material_lining', '3'); ?> >Фасадная плитка</option>
        <option value="4" <?php inputToSelect('material_lining', '4'); ?> >Фасадная панель</option>
        <option value="5" <?php inputToSelect('material_lining', '5'); ?> >Деревянная панель</option>
        <option value="6" <?php inputToSelect('material_lining', '6'); ?> >Штукатурка</option>
        </select>
                </label>
                <label>
        <span>Высота потолков: </span>
        <input type="text" name="ceiling_height" <?php inputToInput('ceiling_height'); ?>/>
        </label>
                             
        </fieldset> <!-- Описание дома  -->  
        
        <fieldset>
        <legend>Описание участка</legend>
         <!-- отличие от аренды  --> 
        <label>
        <span>ТСЖ: </span>
        <select name="tszh"  class="showOtherButton">
        <option value="1" <?php inputToSelect('tszh', '1'); ?> >Нет</option>
        <option value="2" <?php inputToSelect('tszh', '2'); ?> >Кооператив</option>
        <option value="3" <?php inputToSelect('tszh', '3'); ?> >Кондоминиум</option>
        <option value="4" <?php inputToSelect('tszh', '4'); ?> >Частный дом</option>
        <option value="5" <?php inputToSelect('tszh', '5'); ?> >Другое...</option>
        </select>
        </label>
         <!-- отличие от аренды  конец --> 
        
        <label>
        <span>Место для автомобиля: </span>
        <select name="parking_space">
        <option value="1" <?php inputToSelect('parking_space', '1'); ?> >Парковочное место</option>
        <option value="2" <?php inputToSelect('parking_space', '2'); ?> >Закрытый гараж</option>
        <option value="3" <?php inputToSelect('parking_space', '3'); ?> >За пределами участка</option>
        </select>
        </label>
        <label>
        <span>Ограждение: </span>
        <select name="fencing">
        <option value="1" <?php inputToSelect('fencing', '1'); ?> >Нет</option>
        <option value="2" <?php inputToSelect('fencing', '2'); ?> >Профнастил</option>
        <option value="3" <?php inputToSelect('fencing', '3'); ?> >Забор из дерева</option>
        <option value="4" <?php inputToSelect('fencing', '4'); ?> >Евроштакетник</option>
        <option value="5" <?php inputToSelect('fencing', '5'); ?> >Сетка рабица</option>
        <option value="6" <?php inputToSelect('fencing', '6'); ?> >Монолитный</option>
        </select>
        </label>
        <label>
        <span>Профиль/Ландшафт: </span>
        <span>
            Ровный <input type="radio" name="landscape" value="1" <?php inputToRadio('landscape','1'); ?> >
            Не ровный <input type="radio" name="landscape" value="2" <?php inputToRadio('landscape','2'); ?> >
        </span>
        </label>
        
        <span>Дополнительные постройки:</span>
        
        <label>
        <span>Баня</span>
        <input type="checkbox"   class="showСheckboxButton" name="bathhouse_checkbox" value="1" <?php inputToCheckbox('bathhouse_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('bathhouse_num'); ?>">
        <input type="text" name="bathhouse_num" <?php inputToInput('bathhouse_num'); ?>/>
        </div>
        </label>
        <label>
        <span>Гараж</span>
        <input type="checkbox"   class="showСheckboxButton" name="garage_checkbox" value="1" <?php inputToCheckbox('garage_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('garage_num'); ?>">
        <input type="text" name="garage_num" <?php inputToInput('garage_num'); ?>/>
        </div>
        </label>
        <label>
        <span>Сарай</span>
        <input type="checkbox"   class="showСheckboxButton" name="barn_checkbox" value="1" <?php inputToCheckbox('barn_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('barn_num'); ?>">
        <input type="text" name="barn_num" <?php inputToInput('barn_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Бассейн</span>
        <input type="checkbox"   class="showСheckboxButton" name="pool_checkbox" value="1" <?php inputToCheckbox('pool_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('pool_num'); ?>">
        <input type="text" name="pool_num" <?php inputToInput('pool_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Беседка</span>
        <input type="checkbox"   class="showСheckboxButton" name="pavilion_checkbox" value="1" <?php inputToCheckbox('pavilion_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('pavilion_num'); ?>">
        <input type="text" name="pavilion_num" <?php inputToInput('pavilion_num'); ?>/>
        </div>
        </label>
               
        </fieldset> <!-- Описание участка  --> 
                    
        </div>  <!-- Основное  -->
        </fieldset>

        
        <fieldset>
        <legend>Состав дома</legend>
                <div  class="spoiler_button"> + </div>
                <div class="spoiler_body">
        

        
        <span>Наличие и количество комнат: </span>
       <label>
        <span>Спальня:</span>
        <input type="checkbox"   class="showСheckboxButton" name="bedroom_checkbox" value="1" <?php inputToCheckbox('bedroom_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('bedroom_num'); ?>">
        <input type="text" name="bedroom_num" <?php inputToInput('bedroom_num'); ?>/>
        </div>
        </label>
               <label>
        <span>Кухня:</span>
        <input type="checkbox"   class="showСheckboxButton" name="kitchen_checkbox" value="1" <?php inputToCheckbox('kitchen_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('kitchen_num'); ?>">
        <input type="text" name="kitchen_num" <?php inputToInput('kitchen_num'); ?>/>
        </div>
        </label>
               <label>
        <span>Гостиная:</span>
        <input type="checkbox"   class="showСheckboxButton" name="living_room_checkbox" value="1" <?php inputToCheckbox('living_room_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('living_room_num'); ?>">
        <input type="text" name="living_room_num" <?php inputToInput('living_room_num'); ?>/>
        </div>
        </label>
               <label>
        <span>Прихожая:</span>
        <input type="checkbox"   class="showСheckboxButton" name="hallway_checkbox" value="1" <?php inputToCheckbox('hallway_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('hallway_num'); ?>">
        <input type="text" name="hallway_num" <?php inputToInput('hallway_num'); ?>/>
        </div>
        </label>
               <label>
        <span>Детская:</span>
        <input type="checkbox"   class="showСheckboxButton" name="play_room_checkbox" value="1" <?php inputToCheckbox('play_room_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('play_room_num'); ?>">
        <input type="text" name="play_room_num" <?php inputToInput('play_room_num'); ?>/>
        </div>
        </label>
               <label>
        <span>Рабочий кабинет:</span>
        <input type="checkbox"   class="showСheckboxButton" name="cabinet_checkbox" value="1" <?php inputToCheckbox('cabinet_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('cabinet_num'); ?>">
        <input type="text" name="cabinet_num" <?php inputToInput('cabinet_num'); ?>/>
        </div>
        </label>
               <label>
        <span>Столовая:</span>
        <input type="checkbox"   class="showСheckboxButton" name="dining_room_checkbox" value="1" <?php inputToCheckbox('dining_room_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('dining_room_num'); ?>">
        <input type="text" name="dining_room_num" <?php inputToInput('dining_room_num'); ?>/>
        </div>
        </label>
        <label>
        <span>Ванная:</span>
        <input type="checkbox"   class="showСheckboxButton" name="bathroom_checkbox" value="1" <?php inputToCheckbox('bathroom_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('bathroom_num'); ?>">
        <input type="text" name="bathroom_num" <?php inputToInput('bathroom_num'); ?>/>
        </div>
        </label>
        <label>
        <span>Зал:</span>
        <input type="checkbox"   class="showСheckboxButton" name="hall_checkbox" value="1" <?php inputToCheckbox('hall_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('hall_num'); ?>">
        <input type="text" name="hall_num" <?php inputToInput('hall_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Подвал:</span>
        <input type="checkbox"   class="showСheckboxButton" name="basement_checkbox" value="1" <?php inputToCheckbox('basement_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('basement_num'); ?>">
        <input type="text" name="basement_num" <?php inputToInput('basement_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Котельная:</span>
        <input type="checkbox"   class="showСheckboxButton" name="boiler_checkbox" value="1" <?php inputToCheckbox('boiler_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('boiler_num'); ?>">
        <input type="text" name="boiler_num" <?php inputToInput('boiler_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Виранда:</span>
        <input type="checkbox"   class="showСheckboxButton" name="veranda_checkbox" value="1" <?php inputToCheckbox('veranda_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('veranda_num'); ?>">
        <input type="text" name="veranda_num" <?php inputToInput('veranda_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Гардеробная:</span>
        <input type="checkbox"   class="showСheckboxButton" name="dressingroom_checkbox" value="1" <?php inputToCheckbox('dressingroom_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('dressingroom_num'); ?>">
        <input type="text" name="dressingroom_num" <?php inputToInput('dressingroom_num'); ?>/>
        </div>
        </label>
        
                <label>
        <span>Состояние дома: </span>
        <select name="house_condition">
        <option value="1" <?php inputToSelect('house_condition', '1'); ?> >Отделки нет</option>
        <option value="2" <?php inputToSelect('house_condition', '2'); ?> >Стандартная отделка</option>
        <option value="3" <?php inputToSelect('house_condition', '3'); ?> >Премиум отделка</option>
        </select>
        </label>
        
        <label>
        <span>Балкон: </span>
        <span>
            Отсутствует <input type="radio" name="balcony" value="1" <?php inputToRadio('balcony','1'); ?> >
            Незастеклённый <input type="radio" name="balcony" value="2" <?php inputToRadio('balcony','2'); ?> >
            Лоджия <input type="radio" name="balcony" value="3" <?php inputToRadio('balcony','3'); ?> >
        </span>
        </label>
        
        <label>
        <span>Количество входов: </span>
        <input type="text" name="number_of_inputs" <?php inputToInput('number_of_inputs'); ?>/>
        </label>
 
        
        <fieldset>
        <legend>Наполнение дома</legend>
        <!-- в отличие от аренды, более кратко прописано -->
        <label>
        <span>Бытовая техника:</span>
        <input type="hidden" name="devices_available" value="">
        <input type="checkbox" name="devices_available" value="true" <?php inputToCheckbox('devices_available'); ?> >
        </label>
        <label>
        <span>Электроника для досуга:</span>
        <input type="hidden" name="electronics_available" value="">
        <input type="checkbox" name="electronics_available" value="true" <?php inputToCheckbox('electronics_available'); ?> >
        </label>
        <label>
        <span>Мебель:</span>
        <input type="hidden" name="furniture_available" value="">
        <input type="checkbox" name="furniture_available" value="true" <?php inputToCheckbox('furniture_available'); ?> >
        </label>
        <label>
        <span>Сантехника:</span>
        <input type="hidden" name="sanitary_available" value="">
        <input type="checkbox" name="sanitary_available" value="true" <?php inputToCheckbox('sanitary_available'); ?> >
        </label>
        
        </fieldset> <!-- Наполнение квартиры -->

        
        
                <span>Жилищно-коммунальные услуги:</span>
        
        <label>
        <span>Отопление:</span>
        <input type="hidden" name="heating_available" value="">
        <input type="checkbox" name="heating_available" value="true" <?php inputToCheckbox('heating_available'); ?> >
        </label>
        <label>
        <span>Газ:</span>
        <input type="hidden" name="gas_available" value="">
        <input type="checkbox" name="gas_available" value="true" <?php inputToCheckbox('gas_available'); ?> >
        </label>
        <label>
        <span>Электричество:</span>
        <input type="hidden" name="electricity_available" value="">
        <input type="checkbox" name="electricity_available" value="true" <?php inputToCheckbox('electricity_available'); ?> >
        </label>
        <label>
        <span>Водопровод:</span>
        <input type="hidden" name="plumbing_available" value="">
        <input type="checkbox" name="plumbing_available" value="true" <?php inputToCheckbox('plumbing_available'); ?> >
        </label>
  
                    
        </div>  <!-- Состав дома  -->
        </fieldset>

