<h3>Сдать в аренду участок</h3> 
<input type="hidden" name="news_object" value="rentland">
        
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
        <label>
        <span>Профиль/Ландшафт: </span>
        <span>
            Ровный <input type="radio" name="landscape" value="Ровный" <?php inputToRadio('landscape','Ровный'); ?> >
            Не ровный <input type="radio" name="landscape" value="Не ровный" <?php inputToRadio('landscape','Не ровный'); ?> >
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
        <option value="Нет" <?php inputToSelect('fencing', 'Нет'); ?> >Нет</option>
        <option value="Профнастил" <?php inputToSelect('fencing', 'Профнастил'); ?> >Профнастил</option>
        <option value="Забор из дерева" <?php inputToSelect('fencing', 'Забор из дерева'); ?> >Забор из дерева</option>
        <option value="Евроштакетник" <?php inputToSelect('fencing', 'Евроштакетник'); ?> >Евроштакетник</option>
        <option value="Сетка рабица" <?php inputToSelect('fencing', 'Сетка рабица'); ?> >Сетка рабица</option>
        <option value="Монолитный" <?php inputToSelect('fencing', 'Монолитный'); ?> >Монолитный</option>
        </select>
        </label>
        <label>
        <span>Флора </span>
        <span>
            Лесные деревья <input type="radio" name="flora" value="Лесные деревья" <?php inputToRadio('flora','Лесные деревья'); ?> >
            Садовые растения <input type="radio" name="flora" value="Садовые растения" <?php inputToRadio('flora','Садовые растения'); ?> >
        </span>
        </label>
        </div>         
        </fieldset> <!-- Основное  --> 
        
        