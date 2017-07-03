<form action="" id="form_2">
    <div class="search-apartments">
        <div class="city-filter">
            <div class="search-city-menu">
                <label>
                    <input type="text" placeholder="Москва, ул, Малая Ордынка" />
                </label>
            </div>
            <div class="search-metro-menu">
                <label>
                    <input type="text" id="metro" placeholder="Третьяковкая" />
                    <span class="people">2мин</span>
                </label>
            </div>
            <div><a href="#">Задать точнее</a></div>
        </div>
        <div class="search-apartments-button">
            <button>Найти</button>
        </div>
    </div>
    <div class="filters-search-page">
        <div class="checkbox-filters">
            <p><span id="checkbox-price">от 20 000</span></p>
            <ul class="more-checkbox-setting checkbox-1">
                <li><label><input type="checkbox" value="20000">от 20 000</label></li>
                <li><label><input type="checkbox" value="40000">от 40 000</label></li>
                <li><label><input type="checkbox" value="60000">от 50 000</label></li>
                <li><label><input type="checkbox" value="80000">от 60 000</label></li>
            </ul>
        </div>
        <div class="checkbox-filters">
            <p>Кол-во<br>комнат<input type="number" id="size-apartments" placeholder="0" max="10" maxlength="1"></p>
            <ul class="more-checkbox-setting checkbox-2">
                <li><label><input type="checkbox" value="2">2</label></li>
                <li><label><input type="checkbox" value="4">4</label></li>
                <li><label><input type="checkbox" value="6">6</label></li>
                <li><label><input type="checkbox" value="8">8</label></li>
            </ul>
        </div>
        <div class="checkbox-filters">
            <p>Площадь<span id="checkbox-area">от 120 м2 до 230 м2</span></p>
            <ul class="more-checkbox-setting checkbox-3">
                <li><label><input type="checkbox" value="от 120 м2 до 230 м2">от 120 м2 до 230 м2</label></li>
                <li><label><input type="checkbox" value="от 140 м2 до 250 м2">от 140 м2 до 250 м2</label></li>
                <li><label><input type="checkbox" value="от 160 м2 до 270 м2">от 160 м2 до 270 м2</label></li>
                <li><label><input type="checkbox" value="от 180 м2 до 290 м2">от 180 м2 до 290 м2</label></li>
            </ul>
        </div>
        <div class="checkbox-filters">
            <p>Наполнение<br>квартиры<span id="checkbox-equipment">Выбрано(0)</span></p>
            <ul class="more-checkbox-setting checkbox-4">
                <li><label><input type="checkbox" placeholder="">Бытовая техника</label></li>
                <li><label><input type="checkbox" placeholder="">Электноника для досуга</label></li>
                <li><label><input type="checkbox" placeholder="">Мебель</label></li>
                <li><label><input type="checkbox" placeholder="">Сантехника</label></li>
            </ul>
        </div>
        <div class="checkbox-filters">
            <p>Фитрация поиска<button>Показать</button></p>
        </div>
    </div>
</form>