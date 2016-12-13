<h3>Сдать в аренду участок</h3> 
<input type="hidden" name="category" value="24">
        
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
        <span>Улица (точный адрес): </span>
        <input type="text" name="street" <?php inputToInput('street'); ?>/>
        </label>

        
        <span>Выбрать область на карте</span>
        
        <label>
        <span>Удаленность от города: </span>
        <input type="text" name="distance_from_city" <?php inputToInput('distance_from_city'); ?>/>
        </label>
        <label>
        <span>Профиль/Ландшафт: </span>
        <span>
            Ровный <input type="radio" name="landscape" value="1" <?php inputToRadio('landscape','1'); ?> >
            Не ровный <input type="radio" name="landscape" value="2" <?php inputToRadio('landscape','2'); ?> >
        </span>
        </label>
        
                
         </fieldset>
         </div>
        </fieldset><!-- Базовая информация  -->
        
                <fieldset>
        <legend>Основное</legend>
                <div  class="spoiler_button"> + </div>
                <div class="spoiler_body">
        
        <legend>Описание участка</legend>

        <label>
        <span>Площадь: </span>
        <input type="text" name="space" <?php inputToInput('space'); ?>/>
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
        <span>Флора </span>
        <span>
            Лесные деревья <input type="radio" name="flora" value="1" <?php inputToRadio('flora','1'); ?> >
            Садовые растения <input type="radio" name="flora" value="2" <?php inputToRadio('flora','2'); ?> >
        </span>
        </label>
        </div>         
        </fieldset> <!-- Основное  --> 
        
        