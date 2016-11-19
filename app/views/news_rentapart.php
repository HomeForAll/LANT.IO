<h3>Сдать в аренду квартиру</h3>        
<input type="hidden" name="news_object" value="rentapart">
        
        
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
        <span>Точный адрес: </span>
        <input type="text" name="address"  <?php inputToInput('address'); ?>/>
        </label>
        <label>
        <span>Станция метро: </span>
        <input type="text" name="metro_station"  <?php inputToInput('metro_station'); ?>/>
        </label>
        <label>
        <span>Удаленность от метро: </span>
        <input type="text" name="distance_from_metro"  <?php inputToInput('distance_from_metro'); ?>/>
        </label>
                
         </fieldset>
         </div>
        </fieldset>
        
        
        <fieldset>
        <legend>Основное</legend>
                <div  class="spoiler_button"> + </div>
                <div class="spoiler_body">
               <fieldset>
        <legend>Описание квартиры</legend>
        <label>
        <span>Количество комнат: </span>
        <input type="text" name="number_of_rooms" <?php inputToInput('number_of_rooms'); ?>/>
        </label>
                <label>
        <span>Площадь: </span>
        <input type="text" name="space" <?php inputToInput('number_of_rooms'); ?>/>
        </label>
                <label>
        <span>Этаж: </span>
        <input type="text" name="floor" <?php inputToInput('floor'); ?>/>
        </label>
                <label>
        <span>Комплектация: </span>
        <span>
            Укомплектованная <input type="radio" name="equipment" value="Укомплектованная" <?php inputToRadio('equipment','Укомплектованная'); ?> >
            Пустая <input type="radio" name="equipment" value="Пустая" <?php inputToRadio('equipment','Пустая'); ?> >
        </span>
                </label>
                <label>
        <span>Высота потолков: </span>
        <input type="text" name="ceiling_height" <?php inputToInput('ceiling_height'); ?>/>
        </label>
               </fieldset>
                    
        <fieldset>
        <legend>Описание дома</legend>
        <label>
        <span>Тип дома: </span>
        <select name="type_of_house">
        <option value="Блочный" <?php inputToSelect('type_of_house', 'Блочный'); ?> >Блочный</option>
        <option value="Брежневка" <?php inputToSelect('type_of_house', 'Брежневка'); ?> >Брежневка</option>
        <option value="Индивидуальный" <?php inputToSelect('type_of_house', 'Индивидуальный'); ?> >Индивидуальный</option>
        <option value="Кирпично-монолитный" <?php inputToSelect('type_of_house', 'Кирпично-монолитный'); ?> >Кирпично-монолитный</option>
        <option value="Панельный" <?php inputToSelect('type_of_house', 'Панельный'); ?> >Панельный</option>
        <option value="Сталинка" <?php inputToSelect('type_of_house', 'Сталинка'); ?> >Сталинка</option>
        <option value="Хрущевка" <?php inputToSelect('type_of_house', 'Хрущевка'); ?> >Хрущевка</option>
        <option value="Другое" <?php inputToSelect('type_of_house', 'Другое'); ?> >Другое...</option>
        </select>
        </label>
                        <label>
        <span>Серия дома: </span>
        <input type="text" name="home_series" <?php inputToInput('home_series'); ?>/> Уточнение
        </label>
              <label>
        <span>ТСЖ: </span>
        <select name="tszh"  class="showOtherButton">
        <option value="Кооператив" <?php inputToSelect('tszh', 'Кооператив'); ?> >Кооператив</option>
        <option value="Кондоминиум" <?php inputToSelect('tszh', 'Кондоминиум'); ?> >Кондоминиум</option>
        <option value="Частный дом" <?php inputToSelect('tszh', 'Частный дом'); ?> >Частный дом</option>
        <option value="Другое" <?php inputToSelect('tszh', 'Другое'); ?> >Другое...</option>
        </select>
        <!-- блок для вывода информации ДРУГОЕ... см. javascript 
        Должно присутствовать value="Другое" -->
        <div class="showOtherInput">
        <input type="text" name="tszh_other" <?php inputToInput('tszh_other'); ?>/>
        </div>
        </label>
        </fieldset>
        <label>
        <span>Количество этажей: </span>
        <input type="text" name="number_of_floors" <?php inputToInput('number_of_floors'); ?>/>
        </label>
        <label>
        <span>Наличие лифта:</span>
        <input type="hidden" name="elevator_available" value="">
        <input type="checkbox" name="elevator_available" value="1"  <?php inputToCheckbox('elevator_available'); ?>>
        </label>
        <label>
        <span>Наличие лестницы:</span>
        <input type="hidden" name="stairs_available" value="">
        <input type="checkbox" name="stairs_available" value="1" <?php inputToCheckbox('stairs_available'); ?>>
        </label>
        <label>
        <span>Наличие мусоропровода:</span>
        <input type="hidden" name="garbage_available" value="">
        <input type="checkbox" name="garbage_available" value="1" <?php inputToCheckbox('garbage_available'); ?>>
        </label>
                    
                    
        <label>
        <span>Безопасность: </span>
        <select name="security">
        <option value="Консьерж" <?php inputToSelect('security', 'Консьерж'); ?> >Консьерж</option>
        <option value="Охрана" <?php inputToSelect('security', 'Охрана'); ?> >Охрана</option>
        <option value="Домофон" <?php inputToSelect('security', 'Домофон'); ?> >Домофон</option>
        <option value="Видеонаблюдение" <?php inputToSelect('security', 'Видеонаблюдение'); ?> >Видеонаблюдение</option>
        </select>
        </label>
                    
        <div>Парковка</div>
         <div  class="spoiler_button"> + </div>
        <div class="spoiler_body"> 
            
        <label>
        <span>Вид парковки: </span>
        <select name="parking_type">
        <option value="Нет" <?php inputToSelect('parking_type', 'Нет'); ?> >Отсутствует</option>
        <option value="Подземная" <?php inputToSelect('parking_type', 'Подземная'); ?> >Подземная</option>
        <option value="Обозначенная, <?php inputToSelect('parking_type', 'Обозначенная'); ?>  во дворе">Обозначенная, во дворе</option>
        <option value="Не обозначенная, во дворе" <?php inputToSelect('parking_type', 'Не обозначенная, во дворе'); ?> >Не обозначенная, во дворе</option>
        <option value="Платная(неподалёку)" <?php inputToSelect('parking_type', 'Платная(неподалёку)'); ?> >Платная(неподалёку)</option>
        </select>
        </label>
        <label>
        <span>кол-во минут:</span>
        <input type="text" name="number_of_minutes_parking" <?php inputToInput('number_of_minutes_parking'); ?>/>
        </label>
        </div>
                
         
            <fieldset>
        <legend>Состав квартиры</legend>
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
        <span>Состояние квартиры: </span>
        <select name="flat_condition">
        <option value="Отделки нет" <?php inputToSelect('flat_condition', 'Отделки нет'); ?> >Отделки нет</option>
        <option value="Стандартная отделка" <?php inputToSelect('flat_condition', 'Стандартная отделка'); ?> >Стандартная отделка</option>
        <option value="Премиум отделка" <?php inputToSelect('flat_condition', 'Премиум отделка'); ?> >Премиум отделка</option>
        </select>
        </label>
        
                <label>
        <span>Санузел: </span>
        <span>
            Совмещенный <input type="radio" name="toilet" value="Совмещенный" <?php inputToRadio('toilet','Совмещенный'); ?> >
            Раздельный <input type="radio" name="toilet" value="Раздельный" <?php inputToRadio('toilet','Раздельный'); ?> >
        </span>
                </label>
        
        <!-- Разница с продажей начало -->
                <fieldset>
        <legend>Наполнение квартиры</legend>
        
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
        
        </fieldset> <!-- Наполнение квартиры -->
        <!-- Разница с продажей конец -->

        
        <label>
        <span>Балкон: </span>
        <span>
            Отсутствует <input type="radio" name="balcony" value="Отсутствует" <?php inputToRadio('balcony','Отсутствует'); ?> >
            Незастеклённый <input type="radio" name="balcony" value="Незастеклённый" <?php inputToRadio('balcony','Незастеклённый'); ?> >
            Лоджия <input type="radio" name="balcony" value="Лоджия" <?php inputToRadio('balcony','Лоджия'); ?> >
        </span>
        </label>
        
        
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
        
         </div>        <!-- Состав квартиры -->
         </fieldset>
         
         </div>    <!-- Основное -->
        </fieldset>
         
        


