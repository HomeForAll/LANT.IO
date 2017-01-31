<script>
    var formId = <?php echo $this->data['id']; ?>;
    var categoriesJSON = <?php echo $this->data['categoriesJSON']; ?>;
    var subcategoriesJSON = <?php echo $this->data['subcategoriesJSON']; ?>;
</script>

<style>
    form {
        margin-bottom: 15px;
    }

    .box {
        position: relative;
        padding: 50px 15px 15px 15px;
        border: dotted 1px gray;
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

    table {
        width: 100%;
        margin: 0 0 15px 0;
        border: solid 1px black;
        border-collapse: collapse;
    }

    th {
        background: #C3CBD1;
    }

    th, td {
        padding: 10px 15px 10px 15px;
        border: solid 1px black;
        text-align: center;
    }
</style>

<h1>Редактирование формы ID: <?php echo $this->data['id']; ?></h1>

<table>
    <tr>
        <th colspan="3">Параметры</th>
    </tr>
    <tr>
        <th>Тип площади</th>
        <th>Тип операции</th>
        <th>Тип объекта</th>
    </tr>
    <tr style="height: 70px">
        <td><?php echo $this->data['formParams']['spaceTypes'][$this->data['form'][0]['space_type'] - 1]['r_name']; ?></td>
        <td><?php echo $this->data['formParams']['operationTypes'][$this->data['form'][0]['operation'] - 1]['r_name']; ?></td>
        <td><?php echo $this->data['formParams']['objectTypes'][$this->data['form'][0]['object_type'] - 1]['r_name']; ?></td>
    </tr>
</table>

<a id="addCategory" href="#" class="button">Добавить категорию (блок)</a>
<a id="addSubcategory" href="#" class="button">Добавить подкатегорию</a>
<a id="addRangeElement" href="#" class="button">Добавить элемент [От-До]</a>
<a id="addYORNElement" href="#" class="button">Добавить элемент [Да/Нет]</a>
<a id="addListElement" href="#" class="button">Добавить элемент [Список]</a>

<div class="messages"></div>

<form id="categories" action="" method="post"></form>

<form id="subcategories" action="" method="post"></form>

<form id="elements" action="" method="post"></form>


<!--    Список  -->
<!--    <div class="box">-->
<!--        <label for="listElementType">Тип эелемента:</label>-->
<!--        <select name="listElementType[]" id="listElementType">-->
<!--            <option value="">Список</option>-->
<!--            <option value="">Значение [от - до]</option>-->
<!--            <option value="">Значение [да / нет]</option>-->
<!--        </select>-->
<!--        <label for="subcategoryElementType">Подкатегория (не менять если нет подкатегории):</label>-->
<!--        <select name="subcategoryElementType[]" id="subcategoryElementType">-->
<!--            <option value=""></option>-->
<!--            <option value="">Базовая</option>-->
<!--            <option value="">Расширенные</option>-->
<!--        </select>-->
<!--        <label for="listRName">Название списка на русском:</label>-->
<!--        <input id="listRName" name="listRName[]" type="text">-->
<!--        <label for="listEName">Название списка на английском:</label>-->
<!--        <input id="listEName" name="listEName[]" type="text">-->
<!--        <div class="box">-->
<!--            <label for="optionRName">Значение списка на русском:</label>-->
<!--            <input id="optionRName" name="optionRName[]" type="text">-->
<!--            <label for="optionEName">Значение списка на английском:</label>-->
<!--            <input id="optionEName" name="optionEName[]" type="text">-->
<!--        </div>-->
<!--        <a href="#" class="button">Добавить значение</a>-->
<!--    </div>-->
<!---->
<!--    Значение да/нет  -->
<!--    <div class="box">-->
<!--        <label for="choseElementType">Тип эелемента:</label>-->
<!--        <select name="choseElementType[]" id="choseElementType">-->
<!--            <option value="">Список</option>-->
<!--            <option value="">Значение [от - до]</option>-->
<!--            <option value="">Значение [да / нет]</option>-->
<!--        </select>-->
<!---->
<!--        <label for="subcategoryElementType">Подкатегория (не менять если нет подкатегории):</label>-->
<!--        <select name="subcategoryElementType[]" id="subcategoryElementType">-->
<!--            <option value=""></option>-->
<!--            <option value="">Базовая</option>-->
<!--            <option value="">Значение [да / нет]</option>-->
<!--        </select>-->
<!---->
<!--        <label for="choseRName">Название элемента на русском:</label>-->
<!--        <input id="choseRName" name="choseRName[]" type="text">-->
<!---->
<!--        <label for="choseEName">Название элемента на английском:</label>-->
<!--        <input id="choseEName" name="choseEName[]" type="text">-->
<!---->
<!--        <label for="choseRValueName">Значение да на русском:</label>-->
<!--        <input id="choseRValueName" name="choseRValueName[]" type="text">-->
<!--        <label for="choseEValueName">Значение нет на русском:</label>-->
<!--        <input id="choseEValueName" name="choseEValueName[]" type="text">-->
<!--    </div>-->
<!---->
<!--     Значение [от - до]  -->
<!--    <div class="box">-->
<!--        <label for="rangeElementType">Тип эелемента:</label>-->
<!--        <select name="rangeElementType[]" id="rangeElementType">-->
<!--            <option value="">Список</option>-->
<!--            <option value="">Значение [от - до]</option>-->
<!--            <option value="">Значение [да / нет]</option>-->
<!--        </select>-->
<!--        <label for="subcategoryElementType">Подкатегория (не менять если нет подкатегории):</label>-->
<!--        <select name="subcategoryRangeElementType[]" id="subcategoryElementType">-->
<!--            <option value=""></option>-->
<!--            <option value="">Базовая</option>-->
<!--            <option value="">Значение [да / нет]</option>-->
<!--        </select>-->
<!--        <label for="rangeRName">Название элемента на русском:</label>-->
<!--        <input id="rangeRName" name="rangeRName[]" type="text">-->
<!--        <label for="rangeEName">Название элемента на английском:</label>-->
<!--        <input id="rangeEName" name="rangeEName[]" type="text">-->
<!--    </div>-->
<!---->
<!--    <a href="#" class="button" id="saveElems">Сохранить элементы</a>-->


<table id="categoriesTable">
    <tr id="need">
        <th colspan="3">Категории (блоки)</th>
    </tr>
    <tr id="need">
        <th>Название на русском</th>
        <th>Название на английском</th>
        <th>Действие</th>
    </tr>
    <?php
    foreach ($this->data['categories'] as $category) {
        ?>
        <tr>
            <td><?php echo $category['r_name']; ?></td>
            <td><?php echo $category['e_name']; ?></td>
            <td>
                <a id="#category_<?php echo $category['id']; ?>" style="margin: 0;" class="button categoryDelButton"
                   href="#">Удалить</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<table id="subcategoriesTable">
    <tr id="need">
        <th colspan="3">Подкатегории</th>
    </tr>
    <tr id="need">
        <th>Название на русском</th>
        <th>Название на английском</th>
        <th>Действие</th>
    </tr>
    <?php
    foreach ($this->data['subcategories'] as $subcategory) {
        ?>
        <tr>
            <td><?php echo $subcategory['r_name']; ?></td>
            <td><?php echo $subcategory['e_name']; ?></td>
            <td>
                <a id="#subcategory_<?php echo $subcategory['id']; ?>" style="margin: 0;"
                   class="button subcategoryDelButton" href="#">Удалить</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<table id="subcategoriesTable">
    <tr id="need">
        <th colspan="4">Элементы</th>
    </tr>
    <tr id="need">
        <th>Название на русском</th>
        <th>Название на английском</th>
        <th>Тип</th>
        <th>Действие</th>
    </tr>
    <?php
    foreach ($this->data['subcategories'] as $subcategory) {
        ?>
        <tr>
            <td><?php echo $subcategory['r_name']; ?></td>
            <td><?php echo $subcategory['e_name']; ?></td>
            <td>Значение Да/Нет</td>
            <td>
                <a id="#subcategory_<?php echo $subcategory['id']; ?>" style="margin: 0;"
                   class="button subcategoryDelButton" href="#">Удалить</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>