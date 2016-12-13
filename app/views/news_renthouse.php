<h3>Сдать в аренду дом</h3> 
<input type="hidden" name="category" value="23">
        
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
        <!-- Разница с продажей начало -->
        <label>
        <span>Тип аренды: </span>
        <select name="type_of_rent">
        <option value="1" <?php inputToSelect('type_of_rent','1'); ?>>Часовая</option>
        <option value="2" <?php inputToSelect('type_of_rent','2'); ?>>Посуточная</option>
        <option value="3" <?php inputToSelect('type_of_rent','3'); ?>>Долгосрочная</option>
        </select>
        </label>
        <!-- Разница с продажей конец -->
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
        <!-- отличие от продажи (вставка) -->
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
        
        <span>Электроника для досуга:</span>
        
        <label>
        <span>Телевизор</span>
        <input type="checkbox"   class="showСheckboxButton" name="televisor_checkbox" value="1" <?php inputToCheckbox('televisor_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('televisor_num'); ?>">
        <input type="text" name="televisor_num" <?php inputToInput('televisor_num'); ?>/>
        </div>
        </label>
        <label>
        <span>Музыкальный центр</span>
        <input type="checkbox"   class="showСheckboxButton" name="music_center_checkbox" value="1" <?php inputToCheckbox('music_center_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('music_cente_num'); ?>">
        <input type="text" name="music_center_num" <?php inputToInput('music_center_num'); ?>/>
        </div>
        </label>
        <label>
        <span>Кондиционер</span>
        <input type="checkbox"   class="showСheckboxButton" name="conditioning_checkbox" value="1" <?php inputToCheckbox('conditioning_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('conditioning_num'); ?>">
        <input type="text" name="conditioning_num" <?php inputToInput('conditioning_num'); ?>/>
        </div>
        </label>
        
        <span>Бытовая техника:</span>
        <label>
        <span>Холодильник</span>
        <input type="checkbox"   class="showСheckboxButton" name="fridge_checkbox" value="1" <?php inputToCheckbox('fridge_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('fridge_num'); ?>">
        <input type="text" name="fridge_num" <?php inputToInput('fridge_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Плита</span>
        <input type="checkbox"   class="showСheckboxButton" name="range_checkbox" value="1" <?php inputToCheckbox('range_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('range_num'); ?>">
        <input type="text" name="range_num" <?php inputToInput('range_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Печь</span>
        <input type="checkbox"   class="showСheckboxButton" name="stove_checkbox" value="1" <?php inputToCheckbox('stove_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('stove_num'); ?>">
        <input type="text" name="stove_num" <?php inputToInput('stove_num'); ?>/>
        </div>
        </label>
                <label>
        <span>СВЧ</span>
        <input type="checkbox"   class="showСheckboxButton" name="microwave_checkbox" value="1" <?php inputToCheckbox('microwave_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('microwave_num'); ?>">
        <input type="text" name="microwave_num" <?php inputToInput('microwave_num'); ?>/>
        </div>
        </label>
                <label>
        <span>Посудомойка</span>
        <input type="checkbox"   class="showСheckboxButton" name="dishwasher_checkbox" value="1" <?php inputToCheckbox('dishwasher_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('dishwasher_num'); ?>">
        <input type="text" name="dishwasher_num" <?php inputToInput('dishwasher_num'); ?>/>
        </div>
        </label>
        <span>Мебель:</span>
                        <label>
        <span>Стол</span>
        <input type="checkbox"   class="showСheckboxButton" name="table_checkbox" value="1" <?php inputToCheckbox('table_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('table_num'); ?>">
        <input type="text" name="table_num" <?php inputToInput('table_num'); ?>/>
        </div>
        </label>
                        <label>
        <span>Кровать</span>
        <input type="checkbox"   class="showСheckboxButton" name="bed_checkbox" value="1" <?php inputToCheckbox('bed_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('bed_num'); ?>">
        <input type="text" name="bed_num" <?php inputToInput('bed_num'); ?>/>
        </div>
        </label>
                        <label>
        <span>Шкаф</span>
        <input type="checkbox"   class="showСheckboxButton" name="cupboard_checkbox" value="1" <?php inputToCheckbox('cupboard_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('cupboard_num'); ?>">
        <input type="text" name="cupboard_num" <?php inputToInput('cupboard_num'); ?>/>
        </div>
        </label>
                        <label>
        <span>Стул</span>
        <input type="checkbox"   class="showСheckboxButton" name="chair_checkbox" value="1" <?php inputToCheckbox('chair_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('chair_num'); ?>">
        <input type="text" name="chair_num" <?php inputToInput('chair_num'); ?>/>
        </div>
        </label>
                        <label>
        <span>Тумба</span>
        <input type="checkbox"   class="showСheckboxButton" name="stand_checkbox" value="1" <?php inputToCheckbox('stand_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('stand_num'); ?>">
        <input type="text" name="stand_num" <?php inputToInput('stand_num'); ?>/>
        </div>
        </label>
                        <label>
        <span>Зеркало</span>
        <input type="checkbox"   class="showСheckboxButton" name="mirror_checkbox" value="1" <?php inputToCheckbox('mirror_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('mirror_num'); ?>">
        <input type="text" name="mirror_num" <?php inputToInput('mirror_num'); ?>/>
        </div>
        </label>
                        <label>
        <span>Кресло</span>
        <input type="checkbox"   class="showСheckboxButton" name="armchair_checkbox" value="1" <?php inputToCheckbox('armchair_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('armchair_num'); ?>">
        <input type="text" name="armchair_num" <?php inputToInput('armchair_num'); ?>/>
        </div>
        </label>
                        <label>
        <span>Диван</span>
        <input type="checkbox"   class="showСheckboxButton" name="sofa_checkbox" value="1" <?php inputToCheckbox('sofa_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('sofa_num'); ?>">
        <input type="text" name="sofa_num" <?php inputToInput('sofa_num'); ?>/>
        </div>
        </label>
        
        <span>Дополнительно:</span>
        
                                <label>
        <span>Камин</span>
        <input type="checkbox"   class="showСheckboxButton" name="hearth_checkbox" value="1" <?php inputToCheckbox('hearth_checkbox'); ?>  >
        <div class="showСheckboxInput <?php addClassCheckbox('hearth_num'); ?>">
        <input type="text" name="hearth_num" <?php inputToInput('hearth_num'); ?>/>
        </div>
        </label>
        
        </fieldset> <!-- Наполнение квартиры конец-->

        
        
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