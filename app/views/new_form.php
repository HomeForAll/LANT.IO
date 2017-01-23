<style>
    form {
        margin-bottom: 15px;
    }

    fieldset {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
    }

    input[type=text], select {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        width: 100%;
        box-sizing: border-box;
        padding: 10px 15px 10px 15px;
        margin-bottom: 15px;
        border: solid 1px gray;
        border-radius: 3px;
    }

    input[type=checkbox] {
        margin-right: 10px;
    }

    input[type=submit] {
        width: 200px;
    }

    .save_btn {
        cursor: pointer;
        margin 0;
        display: inline-block;
        padding: 0 15px 0 15px !important;
        border: solid 1px darkred;
        line-height: 40px;
        background: darkred;
        color: white;
        border-radius: 4px;
    }

    .save_btn:hover {
        background: white;
        color: darkred;
    }

    .dNone {
        display: none;
    }
</style>
<div style="border: dotted 1px gray; padding: 15px;">
    Если нужно добавить новый параметр формы следуйте инструкции: <br><br>
    1. Ткнуть кнопку с "Добавить (нужный элемент)".<br>
    2. Заполнить ВСЕ поля.<br>
    3. Нажать кнопку "Сохранить параметры".<br>
    4. Выбрать новый параметр в соответствующем списке.<br>
    5. Нажать кнопку "Создать", для создания нововй формы.<br><br>
    <div style="color: red;">
        Названия на английском заполнять следуя трем правилам:<br><br>
        1. Все буквы в нижнем регистре<br>
        2. Пробелом служит нижнее подчеркивание "_" (земля)<br>
        3. Сокращать длинные фразы, не жертвуя смыслом<br>
    </div>
</div><br><br>

<form id="formData" action="" method="post">
    <label for="spaceType">Тип площади:</label>
    <select name="spaceType" id="spaceType">
        <?php
        if (isset($this->data['spaceTypes'])) {
            foreach ($this->data['spaceTypes'] as $spaceType) {
                ?>
                <option value="<?php echo $spaceType['id']; ?>"><?php echo $spaceType['r_name']; ?></option>
                <?php
            }
        }
        ?>
    </select>
    <label for="operationType">Операция:</label>
    <select name="operationType" id="operationType">
        <?php
        if (isset($this->data['operationTypes'])) {
            foreach ($this->data['operationTypes'] as $spaceType) {
                ?>
                <option value="<?php echo $spaceType['id']; ?>"><?php echo $spaceType['r_name']; ?></option>
                <?php
            }
        }
        ?>
    </select>
    <label for="objectType">Объект:</label>
    <select name="objectType" id="objectType">
        <?php
        if (isset($this->data['objectTypes'])) {
            foreach ($this->data['objectTypes'] as $spaceType) {
                ?>
                <option value="<?php echo $spaceType['id']; ?>"><?php echo $spaceType['r_name']; ?></option>
                <?php
            }
        }
        ?>
    </select>
    <a class="button" id="space_type_btn" href="#">Добавить тип площади</a>
    <a class="button" id="operation_type_btn" href="#">Добавить операцию</a>
    <a class="button" id="object_type_btn" href="#">Добавить объект</a>
    <input class="save_btn" type="submit" name="submit" value="Создать">
    <div class="msg"></div>
    <div class="params"></div>
    <a href="#" id="save_params" class="button dNone">Сохранить параметры</a>
    <a href="#" class="deleteBtn button" style="display: none; position: absolute; top: 10px; right: 10px;">Удалить</a>
</form>

<!--<form id="formData" action="" method="post">-->
<!--    <label for="spaceType">Тип площади:</label>-->
<!--    <select name="spaceTipe" id="spaceType">-->
<!--        <option value="residential">Жилая</option>-->
<!--        <option value="commercial">Коммерческая</option>-->
<!--    </select>-->
<!--    <label for="operationType">Операция:</label>-->
<!--    <select name="operationType" id="operationType">-->
<!--        <option value="sell">Продажа</option>-->
<!--        <option value="rent">Аренда</option>-->
<!--    </select>-->
<!--    <label for="objectType">Объект:</label>-->
<!--    <select name="objectType" id="objectType">-->
<!--        <option value="apart">Квартира</option>-->
<!--        <option value="room">Комната</option>-->
<!--        <option value="house">Дом</option>-->
<!--        <option value="garage_or_parking_place">Гараж/машиноместо</option>-->
<!--        <option value="land">Земельный участок</option>-->
<!--        <option value="office">Офисная площадь</option>-->
<!--        <option value="osz">ОСЗ</option>-->
<!--        <option value="complex_osz">Комплекс ОСЗ</option>-->
<!--        <option value="market_or_fair">Рынок/ярмарка</option>-->
<!--        <option value="production_and_storage_space">Производственно-складские помещения</option>-->
<!--        <option value="production_and_storage_buildings">Производственно-складские здания</option>-->
<!--        <option value="tour_buildings">Недвижимость для туризма и отдыха</option>-->
<!--    </select>-->
<!--    <a class="button" id="space_type_btn" href="#">Добавить тип площади</a>-->
<!--    <a class="button" id="operation_type_btn" href="#">Добавить операцию</a>-->
<!--    <a class="button" id="object_type_btn" href="#">Добавить объект</a>-->
<!--    <input class="save_btn" type="submit" name="submit" value="Создать">-->
<!--    <div class="msg"></div>-->
<!--    <div class="params"></div>-->
<!--    <a href="#" id="save_params" class="button dNone">Сохранить параметры</a>-->
<!--</form>-->