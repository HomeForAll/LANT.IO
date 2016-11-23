<h3>Сдать в аренду дом</h3> 
<input type="hidden" name="news_object" value="renthouse">
        
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
        <input type="checkbox" name="bargain_available" value="1" <?php inputToCheckbox('bargain_available'); ?>>
        </label>
        <!-- Разница с продажей начало -->
        <label>
        <span>Тип аренды: </span>
        <select name="type_of_rent">
        <option value="Часовая" <?php inputToSelect('type_of_rent','Часовая'); ?>>Часовая</option>
        <option value="Посуточная" <?php inputToSelect('type_of_rent','Посуточная'); ?>>Посуточная</option>
        <option value="Долгосрочная" <?php inputToSelect('type_of_rent','Долгосрочная'); ?>>Долгосрочная</option>
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
            Круглый год <input type="radio" name="seasonality" value="Круглый год" <?php inputToRadio('seasonality','Круглый год'); ?> >
            Весна-лето <input type="radio" name="seasonality" value="Весна-лето" <?php inputToRadio('seasonality','Весна-лето'); ?> >
        </span>
                </label>
        
         <fieldset>
        <legend>Расположение</legend>
        <label>
        <span>Округ: </span>
        <input type="text" name="region" <?php inputToInput('region'); ?>/>
        </label>
        <label>
        <span>Район: </span>
        <input type="text" name="district"  <?php inputToInput('district'); ?>/>
        </label>
        <label>
        <span>Деревня: </span>
        <input type="text" name="village" <?php inputToInput('village'); ?>/>
        </label>
        <label>
        <span>Точный адрес: </span>
        <input type="text" name="address"  <?php inputToInput('address'); ?>/>
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
        <span>Комплектация: </span>
        <span>
            Укомплектованная <input type="radio" name="equipment" value="Укомплектованная" <?php inputToRadio('equipment','Укомплектованная'); ?> >
            Пустая <input type="radio" name="equipment" value="Пустая" <?php inputToRadio('equipment','Пустая'); ?> >
        </span>
        </label>
                <label>
        <span>Тип дома: </span>
        <select name="type_of_house">
        <option value="Частный" <?php inputToSelect('type_of_house', 'Частный'); ?> >Частный</option>
        <option value="Многоквартирный" <?php inputToSelect('type_of_house', 'Многоквартирный'); ?> >Многоквартирный</option>
        <option value="Таунхаус" <?php inputToSelect('type_of_house', 'Таунхаус'); ?> >Таунхаус</option>
        <option value="Усадьба" <?php inputToSelect('type_of_house', 'Усадьба'); ?> >Усадьба</option>
        </select>
                </label>
                        <label>
        <span>Стиль дома: </span>
        <select name="style_of_house">
        <option value="Классический" <?php inputToSelect('style_of_house', 'Классический'); ?> >Классический</option>
        <option value="Русский" <?php inputToSelect('style_of_house', 'Русский'); ?> >Русский</option>
        <option value="Русская усадьба" <?php inputToSelect('style_of_house', 'Русская усадьба'); ?> >Русская усадьба</option>
        <option value="Замковый" <?php inputToSelect('style_of_house', 'Замковый'); ?> >Замковый</option>
        <option value="Ренессанс" <?php inputToSelect('style_of_house', 'Ренессанс'); ?> >Ренессанс</option>
        <option value="Готический" <?php inputToSelect('style_of_house', 'Готический'); ?> >Готический</option>
        <option value="Барокко" <?php inputToSelect('style_of_house', 'Барокко'); ?> >Барокко</option>
        <option value="Рококо" <?php inputToSelect('style_of_house', 'Рококо'); ?> >Рококо</option>
        <option value="Классицизм" <?php inputToSelect('style_of_house', 'Классицизм'); ?> >Классицизм</option>
        <option value="Ампир" <?php inputToSelect('style_of_house', 'Ампир'); ?> >Ампир</option>
        <option value="Эклектика" <?php inputToSelect('style_of_house', 'Эклектика'); ?> >Эклектика</option>
        <option value="Модерн" <?php inputToSelect('style_of_house', 'Модерн'); ?> >Модерн</option>
        <option value="Органическая архитектура" <?php inputToSelect('style_of_house', 'Органическая архитектура'); ?> >Органическая архитектура</option>
        <option value="Конструктивизм" <?php inputToSelect('style_of_house', 'Конструктивизм'); ?> >Конструктивизм</option>
        <option value="Ар-деко" <?php inputToSelect('style_of_house', 'Ар-деко'); ?> >Ар-деко</option>
        <option value="Минимализм" <?php inputToSelect('style_of_house', 'Минимализм'); ?> >Минимализм</option>
        <option value="High tech" <?php inputToSelect('style_of_house', 'High tech'); ?> >High tech</option>
        <option value="Финский минимализм" <?php inputToSelect('style_of_house', 'Финский минимализм'); ?> >Финский минимализм</option>
        <option value="Шале" <?php inputToSelect('style_of_house', 'Шале'); ?> >Шале</option>
        <option value="Фахверк" <?php inputToSelect('style_of_house', 'Фахверк'); ?> >Фахверк</option>
        <option value="Скандинавский" <?php inputToSelect('style_of_house', 'Скандинавский'); ?> >Скандинавский</option>
        <option value="Восточный" <?php inputToSelect('style_of_house', 'Восточный'); ?> >Восточный</option>
        <option value="Американский кантри" <?php inputToSelect('style_of_house', 'Американский кантри'); ?> >Американский кантри</option>
        <option value="Шато" <?php inputToSelect('style_of_house', 'Шато'); ?> >Шато</option>
        <option value="Адирондак" <?php inputToSelect('style_of_house', 'Адирондак'); ?> >Адирондак</option>
        <option value="Стильпрерий" <?php inputToSelect('style_of_house', 'Стильпрерий'); ?> >Стильпрерий</option>
        </select>
                </label>
                        <label>
        <span>Материал облицовки: </span>
        <select name="material_lining">
        <option value="Кирпич" <?php inputToSelect('material_lining', 'Кирпич'); ?> >Кирпич</option>
        <option value="Камень" <?php inputToSelect('material_lining', 'Камень'); ?> >Камень</option>
        <option value="Фасадная плитка" <?php inputToSelect('material_lining', 'Фасадная плитка'); ?> >Фасадная плитка</option>
        <option value="Фасадная панель" <?php inputToSelect('material_lining', 'Фасадная панель'); ?> >Фасадная панель</option>
        <option value="Деревянная панель" <?php inputToSelect('material_lining', 'Деревянная панель'); ?> >Деревянная панель</option>
        <option value="Штукатурка" <?php inputToSelect('material_lining', 'Штукатурка'); ?> >Штукатурка</option>
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
        <option value="Парковочное место" <?php inputToSelect('Место для автомобиля', 'Парковочное место'); ?> >Парковочное место</option>
        <option value="Закрытый гараж" <?php inputToSelect('Место для автомобиля', 'Закрытый гараж'); ?> >Закрытый гараж</option>
        <option value="За пределами участка" <?php inputToSelect('Место для автомобиля', 'За пределами участка'); ?> >За пределами участка</option>
        </select>
        </label>
        <label>
        <span>Ограждение: </span>
        <select name="fencing">
        <option value="Нет" <?php inputToSelect('fencing', 'Нет'); ?> >Нет</option>
        <option value="Профнастил" <?php inputToSelect('fencing', 'Профнастил'); ?> >Профнастил</option>
        <option value="Забор из дерева" <?php inputToSelect('fencing', 'Забор из дерева'); ?> >Забор из дерева</option>
        <option value="Евроштакетник" <?php inputToSelect('fencing', 'Евроштакетник'); ?> >Евроштакетник</option>
        <option value="Сетка рабица" <?php inputToSelect('fencing', 'Сетка рабица'); ?> >Сетка рабица</option>
        <option value="Монолитный" <?php inputToSelect('fencing', 'Монолитный'); ?> >Монолитный</option>
        </select>
        </label>
        <label>
        <span>Профиль/Ландшафт: </span>
        <span>
            Ровный <input type="radio" name="landscape" value="Ровный" <?php inputToRadio('landscape','Ровный'); ?> >
            Не ровный <input type="radio" name="landscape" value="Не ровный" <?php inputToRadio('landscape','Не ровный'); ?> >
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
        <option value="Отделки нет" <?php inputToSelect('house_condition', 'Отделки нет'); ?> >Отделки нет</option>
        <option value="Стандартная отделка" <?php inputToSelect('house_condition', 'Стандартная отделка'); ?> >Стандартная отделка</option>
        <option value="Премиум отделка" <?php inputToSelect('house_condition', 'Премиум отделка'); ?> >Премиум отделка</option>
        </select>
        </label>
        
        <label>
        <span>Балкон: </span>
        <span>
            Отсутствует <input type="radio" name="balcony" value="Отсутствует" <?php inputToRadio('balcony','Отсутствует'); ?> >
            Незастеклённый <input type="radio" name="balcony" value="Незастеклённый" <?php inputToRadio('balcony','Незастеклённый'); ?> >
            Лоджия <input type="radio" name="balcony" value="Лоджия" <?php inputToRadio('balcony','Лоджия'); ?> >
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
        <input type="checkbox" name="heating_available" value="1" <?php inputToCheckbox('heating_available'); ?> >
        </label>
        <label>
        <span>Газ:</span>
        <input type="hidden" name="gas_available" value="">
        <input type="checkbox" name="gas_available" value="1" <?php inputToCheckbox('gas_available'); ?> >
        </label>
        <label>
        <span>Электричество:</span>
        <input type="hidden" name="electricity_available" value="">
        <input type="checkbox" name="electricity_available" value="1" <?php inputToCheckbox('electricity_available'); ?> >
        </label>
        <label>
        <span>Водопровод:</span>
        <input type="hidden" name="plumbing_available" value="">
        <input type="checkbox" name="plumbing_available" value="1" <?php inputToCheckbox('plumbing_available'); ?> >
        </label>
  
                    
        </div>  <!-- Состав дома  -->
        </fieldset>