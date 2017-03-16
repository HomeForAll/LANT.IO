<script>
    var formId = <?php echo $this->data['id']; ?>;
    var categoriesJSON = <?php echo $this->data['categoriesJSON']; ?>;
    var subcategoriesJSON = <?php echo $this->data['subcategoriesJSON']; ?>;
    var elementsJSON = <?php echo $this->data['elementsJSON']; ?>;
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
        width: 860px;
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

<?php

//$this->printInPre($this->data['user']);
function searchParam($params, $need)
{
    foreach ($params as $key => $param) {
        if ($param[0] == $need) {
            return $param;
        }
    }
    return false;
}
?>

<table>
    <tr>
        <th colspan="4">Параметры</th>
    </tr>
    <tr>
        <th>Тип площади</th>
        <th>Тип операции</th>
        <th colspan="2">Тип объекта</th>
    </tr>
    <tr style="height: 70px">
        <td><?php echo searchParam($this->data['formParams']['spaceTypes'], $this->data['form'][0]['space_type'])['r_name']; ?></td>
        <td><?php echo searchParam($this->data['formParams']['operationTypes'], $this->data['form'][0]['operation'])['r_name']; ?></td>
        <td colspan="2"><?php echo searchParam($this->data['formParams']['objectTypes'], $this->data['form'][0]['object_type'])['r_name']; ?></td>
    </tr>
    <tr>
        <th colspan="4">Пользователь</th>
    </tr>
    <tr>
        <th>UserID</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
    </tr>
    <tr>
        <td><?php echo $this->data['user'][0]['id']; ?></td>
        <td><?php echo $this->data['user'][0]['first_name']; ?></td>
        <td><?php echo $this->data['user'][0]['last_name']; ?></td>
        <td><?php echo $this->data['user'][0]['patronymic']; ?></td>
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
        <th colspan="4">Подкатегории</th>
    </tr>
    <tr id="need">
        <th>Название на русском</th>
        <th>Название на английском</th>
        <th>Катгория(блок)</th>
        <th>Действие</th>
    </tr>
    <?php
    foreach ($this->data['subcategories'] as $subcategory) {
        ?>
        <tr>
            <td><?php echo $subcategory['r_name']; ?></td>
            <td><?php echo $subcategory['e_name']; ?></td>
            <td><?php echo searchParam($this->data['categories'], $subcategory['category_id'])['r_name']; ?></td>
            <td>
                <a id="#subcategory_<?php echo $subcategory['id']; ?>" style="margin: 0;"
                   class="button subcategoryDelButton" href="#">Удалить</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<table id="elementsTable" style="width: 860px;">
    <tr id="need">
        <th colspan="7">Элементы</th>
    </tr>
    <tr id="need">
        <th>Название на русском</th>
        <th>Название на английском</th>
        <th>Категория (Блок)</th>
        <th>Подкатегория</th>
        <th>Родительский элемент</th>
        <th>Тип</th>
        <th>Действие</th>
    </tr>
    <?php
    foreach ($this->data['elements'] as $element) {
        ?>
        <tr>
            <td><?php echo $element['r_name']; ?></td>
            <td><?php echo $element['e_name']; ?></td>
            <td><?php echo searchParam($this->data['categories'], $element['category'])['r_name']; ?></td>
            <td><?php echo searchParam($this->data['subcategories'], $element['subcategory'])['r_name']; ?></td>
            <td><?php echo searchParam($this->data['elements'], $element['parent_el'])['r_name']; ?></td>
            <td>
                <?php
                switch ($element['type']) {
                    case 1:
                        echo 'Элемент [От-До]';
                        break;
                    case 2:
                        echo 'Элемент [Да/Нет]';
                        break;
                    case 3:
                        echo 'Элемент [Список]';
                        break;
                }
                ?>
            </td>
            <td>
                <a id="element_<?php echo $element['id']; ?>" style="margin: 0;"
                   class="button elDelButton" href="#">Удалить</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>