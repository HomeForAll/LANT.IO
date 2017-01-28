<script>
    var formId = <?php echo $this->data['id']; ?>;
    var categoriesJSON = <?php echo $this->data['categoriesJSON']; ?>;
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
<a href="#" class="button">Добавить элемент</a>

<div class="messages"></div>

<form id="categories" action="" method="post"></form>

<form id="subcategories" action="" method="post"></form>

<div class="currentData">

</div>

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
                <a id="#category_<?php echo $category['id']; ?>" style="margin: 0;" class="button categoryDelButton" href="#">Удалить</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>

<table>
    <tr>
        <th colspan="3">Подкатегории</th>
    </tr>
    <tr>
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
                <a id="#subcategory_<?php echo $subcategory['id']; ?>" style="margin: 0;" class="button subcategoryDelButton" href="#">Удалить</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>