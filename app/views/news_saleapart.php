<h3>Продажа квартиры</h3>        
<input type="hidden" name="category" value="12">
        
        
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
        <span>Город: </span>
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
        <label>
        <span>Номер квартиры: </span>
        <input type="text" name="apartment_number"  <?php inputToInput('apartment_number'); ?>/>
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
            Укомплектованная <input type="radio" name="equipment" value="1" <?php inputToRadio('equipment','1'); ?> >
            Пустая <input type="radio" name="equipment" value="2" <?php inputToRadio('equipment','2'); ?> >
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
        <option value="1" <?php inputToSelect('type_of_house', '1'); ?> >Блочный</option>
        <option value="2" <?php inputToSelect('type_of_house', '2'); ?> >Брежневка</option>
        <option value="3" <?php inputToSelect('type_of_house', '3'); ?> >Индивидуальный</option>
        <option value="4" <?php inputToSelect('type_of_house', '4'); ?> >Кирпично-монолитный</option>
        <option value="5" <?php inputToSelect('type_of_house', '5'); ?> >Панельный</option>
        <option value="6" <?php inputToSelect('type_of_house', '6'); ?> >Сталинка</option>
        <option value="7" <?php inputToSelect('type_of_house', '7'); ?> >Хрущевка</option>
        <option value="8" <?php inputToSelect('type_of_house', '8'); ?> >Другое...</option>
        </select>
        </label>
                        <label>
        <span>Серия дома: </span>
        <input type="text" name="home_series" <?php inputToInput('home_series'); ?>/> Уточнение
        </label>
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
<!--        <label>
        <span>ТСЖ: </span>
        <select name="tszh"  class="showOtherButton">
        <option value="Кооператив" <?php// inputToSelect('tszh', 'Кооператив'); ?> >Кооператив</option>
        <option value="Кондоминиум" <?php// inputToSelect('tszh', 'Кондоминиум'); ?> >Кондоминиум</option>
        <option value="Частный дом" <?php// inputToSelect('tszh', 'Частный дом'); ?> >Частный дом</option>
        <option value="Другое" <?php // inputOtherSelect('tszh', array('Кооператив', 'Кондоминиум', 'Частный дом')); ?> >Другое...</option>
        </select>-->
        <!-- блок для вывода информации ДРУГОЕ... см. javascript 
        Должно присутствовать value="Другое" -->
<!--        <div class="showOtherInput <?php // addClassOtherInput('tszh', array('Кооператив', 'Кондоминиум', 'Частный дом')); ?>">
        <input type="text" name="tszh_other" <?php // inputToInput('tszh'); ?>/>
        </div>
        </label>-->
        </fieldset>
        <label>
        <span>Количество этажей: </span>
        <input type="text" name="number_of_floors" <?php inputToInput('number_of_floors'); ?>/>
        </label>
        <label>
        <span>Наличие лифта:</span>
        <input type="hidden" name="elevator_available" value="">
        <input type="checkbox" name="elevator_available" value="true"  <?php inputToCheckbox('elevator_available'); ?>>
        </label>
        <label>
        <span>Наличие лестницы:</span>
        <input type="hidden" name="stairs_available" value="">
        <input type="checkbox" name="stairs_available" value="true" <?php inputToCheckbox('stairs_available'); ?>>
        </label>
        <label>
        <span>Наличие мусоропровода:</span>
        <input type="hidden" name="garbage_available" value="">
        <input type="checkbox" name="garbage_available" value="true" <?php inputToCheckbox('garbage_available'); ?>>
        </label>
                    
                    
        <span>Безопасность: </span>
        <label>
        <span>Консьерж:</span>
        <input type="hidden" name="concierge" value="">
        <input type="checkbox" name="concierge" value="true" <?php inputToCheckbox('concierge'); ?>>
        </label>
        <label>
        <span>Охрана:</span>
        <input type="hidden" name="security" value="">
        <input type="checkbox" name="security" value="true" <?php inputToCheckbox('security'); ?>>
        </label>
        <label>
        <span>Домофон:</span>
        <input type="hidden" name="intercom" value="">
        <input type="checkbox" name="intercom" value="true" <?php inputToCheckbox('intercom'); ?>>
        </label>
        <label>
        <span>Видеонаблюдение:</span>
        <input type="hidden" name="cctv" value="">
        <input type="checkbox" name="cctv" value="true" <?php inputToCheckbox('cctv'); ?>>
        </label>
                    
        <div>Парковка</div>
         <div  class="spoiler_button"> + </div>
        <div class="spoiler_body"> 
            
        <label>
        <span>Вид парковки: </span>
        <select name="parking_type">
        <option value="1" <?php inputToSelect('parking_type', '1'); ?> >Отсутствует</option>
        <option value="2" <?php inputToSelect('parking_type', '2'); ?> >Подземная</option>
        <option value="3" <?php inputToSelect('parking_type', '3'); ?> >Обозначенная, во дворе</option>
        <option value="4" <?php inputToSelect('parking_type', '4'); ?> >Не обозначенная, во дворе</option>
        <option value="5" <?php inputToSelect('parking_type', '5'); ?> >Платная(неподалёку)</option>
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
        <option value="1" <?php inputToSelect('flat_condition', '1'); ?> >Отделки нет</option>
        <option value="2" <?php inputToSelect('flat_condition', '2'); ?> >Стандартная отделка</option>
        <option value="3" <?php inputToSelect('flat_condition', '3'); ?> >Премиум отделка</option>
        </select>
        </label>
        
                <label>
        <span>Санузел: </span>
        <span>
            Совмещенный <input type="radio" name="toilet" value="1" <?php inputToRadio('toilet','1'); ?> >
            Раздельный <input type="radio" name="toilet" value="2" <?php inputToRadio('toilet','2'); ?> >
        </span>
                </label>
        
        <!-- Разница с арендой начало -->
        <span>Наполнение квартиры:</span>
        
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
        
        <!-- Разница с арендой конец -->
        <label>
        <span>Балкон: </span>
        <span>
            Отсутствует <input type="radio" name="balcony" value="1" <?php inputToRadio('balcony','1'); ?> >
            Незастеклённый <input type="radio" name="balcony" value="2" <?php inputToRadio('balcony','2'); ?> >
            Лоджия <input type="radio" name="balcony" value="3" <?php inputToRadio('balcony','3'); ?> >
        </span>
        </label>
        
        
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
        
         </div>        <!-- Состав квартиры -->
         </fieldset>
         
         </div>    <!-- Основное -->
        </fieldset>
         
        


