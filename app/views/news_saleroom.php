<h3>Продажа комнаты</h3>
<input type="hidden" name="news_object" value="saleroom">

       
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
        <label>
        <span>Комнат в продажу (шт): </span>
        <select name="rooms_for_sale">
        <option value="1" <?php inputToSelect('rooms_for_sale', '1'); ?> >1</option>
        <option value="2" <?php inputToSelect('rooms_for_sale', '2'); ?> >2</option>
        <option value="3+" <?php inputToSelect('rooms_for_sale', '3+'); ?> >3+</option>
        </select>
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
             
         <label>
        <span>Нахождение комнаты: </span>
        <select name="room_location">
        <option value="Квартира" <?php inputToSelect('room_location', 'Квартира'); ?> >Квартира</option>
        <option value="Общежитие" <?php inputToSelect('room_location', 'Общежитие'); ?> >Общежитие</option>
        <option value="Частный дом" <?php inputToSelect('room_location', 'Частный дом'); ?> >Частный дом</option>
        </select>
        </label>    
             
             
         </div>      <!-- Базовая информация -->
        </fieldset>
        
        
        <fieldset>
        <legend>Основное</legend>
                <div  class="spoiler_button"> + </div>
                <div class="spoiler_body">
               <fieldset>
        <legend>Описание комнаты</legend>

        <label>
        <span>Площадь: </span>
        <input type="text" name="space" <?php inputToInput('space'); ?>/>
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
        <span>Состояние комнаты: </span>
        <select name="room_condition">
        <option value="Отделки нет" <?php inputToSelect('room_condition', 'Отделки нет'); ?> >Отделки нет</option>
        <option value="Стандартная отделка" <?php inputToSelect('room_condition', 'Стандартная отделка'); ?> >Стандартная отделка</option>
        <option value="Премиум отделка" <?php inputToSelect('room_condition', 'Премиум отделка'); ?> >Премиум отделка</option>
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
                
               </fieldset> <!-- Описание комнаты -->
                    
        <fieldset>
        <legend>Описание квартиры</legend>
        <label>
        <span>Количество комнат: </span>
        <input type="text" name="number_of_rooms" <?php inputToInput('number_of_rooms'); ?>/>
        </label>
        <label>
        <span>Этаж: </span>
        <input type="text" name="floor" <?php inputToInput('floor'); ?>/>
        </label>
        <label>
        <span>Санузел: </span>
        <span>
            Совмещенный <input type="radio" name="toilet" value="Совмещенный" <?php inputToRadio('toilet','Совмещенный'); ?> >
            Раздельный <input type="radio" name="toilet" value="Раздельный" <?php inputToRadio('toilet','Раздельный'); ?> >
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
        
        </fieldset> <!-- Описание квартиры -->
        
        <fieldset>
        <legend>Описание дома</legend>
        <div  class="spoiler_button"> + </div>
         <div class="spoiler_body">
        
        <label>
        <span>Тип дома: </span>
        <select name="type_of_house"  class="showOtherButton">
        <option value="Блочный" <?php inputToSelect('type_of_house', 'Блочный'); ?> >Блочный</option>
        <option value="Брежневка" <?php inputToSelect('type_of_house', 'Брежневка'); ?> >Брежневка</option>
        <option value="Индивидуальный" <?php inputToSelect('type_of_house', 'Индивидуальный'); ?> >Индивидуальный</option>
        <option value="Кирпично-монолитный" <?php inputToSelect('type_of_house', 'Кирпично-монолитный'); ?> >Кирпично-монолитный</option>
        <option value="Панельный" <?php inputToSelect('type_of_house', 'Панельный'); ?> >Панельный</option>
        <option value="Сталинка" <?php inputToSelect('type_of_house', 'Сталинка'); ?> >Сталинка</option>
        <option value="Хрущевка" <?php inputToSelect('type_of_house', 'Хрущевка'); ?> >Хрущевка</option>
        <option value="Другое" <?php inputOtherSelect('type_of_house', array('Блочный','Брежневка','Индивидуальный','Кирпично-монолитный','Панельный','Сталинка','Хрущевка')); ?>>Другое...</option>
        </select>
        <!-- блок для вывода информации ДРУГОЕ... см. javascript 
        Должно присутствовать value="Другое" -->
        <div class="showOtherInput<?php addClassOtherInput('type_of_house', array('Блочный','Брежневка','Индивидуальный','Кирпично-монолитный','Панельный','Сталинка','Хрущевка')); ?>">
        <input type="text" name="type_of_house_other" <?php inputToInput('type_of_house'); ?>/>
        </div>
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
        <option value="Другое" <?php inputOtherSelect('tszh',  array('Кооператив','Кондоминиум','Частный дом')); ?> >Другое...</option>
        </select>
        <!-- блок для вывода информации ДРУГОЕ... см. javascript 
        Должно присутствовать value="Другое" -->
        <div class="showOtherInput <?php addClassOtherInput('tszh', array('Кооператив','Кондоминиум','Частный дом')); ?>">
        <input type="text" name="tszh_other" <?php inputToInput('tszh'); ?>/>
        </div>
        </label>     
               
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
        </fieldset> <!-- Описание дома -->

        </div>    <!-- Основное -->
        </fieldset>