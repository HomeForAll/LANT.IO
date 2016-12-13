<h3>Сдать в аренду комнату</h3>
<input type="hidden" name="category" value="21">

       
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
        <span>Комнат в продажу (шт): </span>
        <select name="rooms_for_sale">
        <option value="1" <?php inputToSelect('rooms_for_sale', '1'); ?> >1</option>
        <option value="2" <?php inputToSelect('rooms_for_sale', '2'); ?> >2</option>
        <option value="3" <?php inputToSelect('rooms_for_sale', '3'); ?> >3+</option>
        </select>
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
             
         <label>
        <span>Нахождение комнаты: </span>
        <select name="room_location">
        <option value="1" <?php inputToSelect('room_location', '1'); ?> >Квартира</option>
        <option value="2" <?php inputToSelect('room_location', '2'); ?> >Общежитие</option>
        <option value="3" <?php inputToSelect('room_location', '3'); ?> >Частный дом</option>
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
            Укомплектованная <input type="radio" name="equipment" value="1" <?php inputToRadio('equipment','1'); ?> >
            Пустая <input type="radio" name="equipment" value="2" <?php inputToRadio('equipment','2'); ?> >
        </span>
        </label>
        <label>
        <span>Высота потолков: </span>
        <input type="text" name="ceiling_height" <?php inputToInput('ceiling_height'); ?>/>
        </label>
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
                
        <label>
        <span>Балкон: </span>
        <span>
            Отсутствует <input type="radio" name="balcony" value="1" <?php inputToRadio('balcony','1'); ?> >
            Незастеклённый <input type="radio" name="balcony" value="2" <?php inputToRadio('balcony','2'); ?> >
            Лоджия <input type="radio" name="balcony" value="3" <?php inputToRadio('balcony','3'); ?> >
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
            Совмещенный <input type="radio" name="toilet" value="1" <?php inputToRadio('toilet','1'); ?> >
            Раздельный <input type="radio" name="toilet" value="2" <?php inputToRadio('toilet','2'); ?> >
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
        
        </fieldset> <!-- Описание квартиры -->
        
        <fieldset>
        <legend>Описание дома</legend>
        <div  class="spoiler_button"> + </div>
         <div class="spoiler_body">
        
        <label>
        <span>Тип дома: </span>
        <select name="type_of_house"  class="showOtherButton">
        <option value="1" <?php inputToSelect('type_of_house', '1'); ?> >Блочный</option>
        <option value="2" <?php inputToSelect('type_of_house', '2'); ?> >Брежневка</option>
        <option value="3" <?php inputToSelect('type_of_house', '3'); ?> >Индивидуальный</option>
        <option value="4" <?php inputToSelect('type_of_house', '4'); ?> >Кирпично-монолитный</option>
        <option value="5" <?php inputToSelect('type_of_house', '5'); ?> >Монолит</option>
        <option value="6" <?php inputToSelect('type_of_house', '6'); ?> >Панельный</option>
        <option value="7" <?php inputToSelect('type_of_house', '7'); ?> >Сталинка</option>
        <option value="8" <?php inputToSelect('type_of_house', '8'); ?> >Хрущевка</option>
        <option value="9" <?php inputToSelect('type_of_house', '9'); ?> >Другое</option>
 <!--       <option value="8" <?php // inputOtherSelect('type_of_house', array('Блочный','Брежневка','Индивидуальный','Кирпично-монолитный','Панельный','Сталинка','Хрущевка')); ?>>Другое...</option> -->
        </select>
        <!-- блок для вывода информации ДРУГОЕ... см. javascript 
        Должно присутствовать value="Другое" 
        <div class="showOtherInput <?php // addClassOtherInput('type_of_house', array('Блочный','Брежневка','Индивидуальный','Кирпично-монолитный','Панельный','Сталинка','Хрущевка')); ?>">
        <input type="text" name="type_of_house_other" <?php // inputToInput('type_of_house'); ?>/>
        </div> -->
        </label>
        <label>
        <span>Серия дома: </span>
        <input type="text" name="home_series" <?php inputToInput('home_series'); ?>/> Уточнение
        </label>
     
               
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
        </fieldset> <!-- Описание дома -->

        </div>    <!-- Основное -->
        </fieldset>
