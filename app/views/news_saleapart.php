<h3>Продажа квартиры</h3>        
<input type="hidden" name="news_object" value="saleapart">
        
        
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
        <input type="text" name="tszh_other" <?php inputToInput('tszh'); ?>/>
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
        
        <!-- Разница с арендой начало -->
        <span>Наполнение квартиры:</span>
        
        <label>
        <span>Бытовая техника:</span>
        <input type="checkbox" name="devices_available" value="1" <?php inputToCheckbox('devices_available'); ?> >
        </label>
        <label>
        <span>Электроника для досуга:</span>
        <input type="checkbox" name="electronics_available" value="1" <?php inputToCheckbox('electronics_available'); ?> >
        </label>
        <label>
        <span>Мебель:</span>
        <input type="checkbox" name="furniture_available" value="1" <?php inputToCheckbox('furniture_available'); ?> >
        </label>
        <label>
        <span>Сантехника:</span>
        <input type="checkbox" name="sanitary_available" value="1" <?php inputToCheckbox('sanitary_available'); ?> >
        </label>
        
        <!-- Разница с арендой конец -->
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
         
        


