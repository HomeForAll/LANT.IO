<?php
$this->title = 'Генератор форм для объявлений';

global $data_for_news;
global $form_code;
global $element_list;
$data_for_news = $this->data;
$form_code = '';
$element_list = [];
?>

<!--/api/best_of_day-->
<!--/api/best_of_week-->
<!--/api/best_of_month-->

<form id="test" action="/api/best_of_month" method="post">
    <input type="text" name="space_types" value="0">space_types<br>
    <input type="text" name="operation_types" value="0">operation_types<br>
    <input type="text" name="object_types" value="0">object_types<br>
    <input type="text" name="city" value="0">city<br>
    <input type="text" name="price_from" value="0">price_from<br>
    <input type="text" name="price_to" value="0">price_to<br>
    <input type="text" name="space_from" value="0">space_from<br>
    <input type="text" name="space_to" value="0">space_to<br>
    <input type="text" name="count" value="0">count<br>
    <input type="submit" name="best" value="Проба лучших объявлений">
</form>

<form id="test_ads_save" action="/api/items/add" method="post">
    <input type="text" name="tabs" value="0">operation_type<br>
    <input type="text" name="type" value="0">object_type<br>
    <input type="text" name="city" value="0">city<br>
    <input type="text" name="price" value="0">price<br>
    <input type="text" name="bargain" value="0">bargain<br>
    <input type="text" name="count_rooms" value="0">number_of_rooms<br>
    <input type="text" name="area_residential" value="0">residential<br>
    <input type="text" name="garbage" value="0">availability_of_garbage_chute<br>
    <input type="submit" name="best" value="Проба Записи объявлений">
</form>
<script>
    function addAds(formResult) {
        alert(formResult);
        $.ajax({
            type:"POST",
            data: formResult,
            url:"/admin/newsformgenerator",
            success:function(html){
                console.log(html);
            }
        });
    }
    $("#test_ads_save input[type='submit']").click(function (e) {
        e.preventDefault();
        var photos = [1, 2, 3];
        var add_buildings = [true, false, true, true, true, true, true];
        var rooms = [true, false, true, true, true, true, true];
        var formResult = {'action':'test','photos':photos, 'rooms':rooms, 'add_buildings':add_buildings};
        addAds(formResult,photos);
    });
</script>

<?php
//Генерация форм новостей на основе форм поиска
if (!empty($this->data['news_form_generation_file'])) {


    if (!empty($this->data['news_form_generation_file']['elements_out_db'])) {
        echo "<h2> Элементы формы не входящие в БД</h2>";
        foreach ($this->data['news_form_generation_file']['elements_out_db'] as $key => $value) {
            echo $value . "<br>";
        }
    }


    echo "<hr><h2> Элементы формы входящие в БД</h2>";
    echo "<table>";
    foreach ($this->data['news_form_generation_file']['elements_in_db'] as $key => $value) {

        switch ($value) {
            case 'character varying(255)':
                $color = 'blue';
                break;
            case 'smallint':
                $color = 'brown';
                break;
            case 'integer':
                $color = 'red';
                break;
            case 'boolean':
                $color = 'green';
                break;
            default:
                $color = 'black';
                break;
        }
        echo '<tr style="color:' . $color . ';"><td>' . $key . "</td><td>" . $value . "</td></tr>";
    }
    echo "</table><hr>";

// обработка формы

    foreach ($this->data['news_form_generation_file']['form'] as $lines) {
        ecHHo($lines);
    }
}
// -------------------

//Генерация форм новостей на основе форм поиска
if (!empty($this->data['news_form_with_php_code'])) {
    ?> <h2> Обработка формы с php кодом</h2> <?php
    foreach ($this->data['news_form_with_php_code'] as $lines) {
        ecHHo($lines);
    }
}

//Генерация views на основе форм поиска
if (!empty($this->data['generating_news_views'])) {
    foreach ($this->data['generating_news_views'] as $lines) {
        ecHHo($lines);
    }
}
// -------------------


?>
<hr>
<hr> <?php


function ecHHo($code)
{
    global $form_code;
    $form_code .= $code . "\r\n";
    echo htmlspecialchars($code);
    echo "<br>";
}

function showElement($category)
{
    global $element_list;
    if (isset($category['element'])) {
        foreach ($category['element'] as $element) {


            ecHHo('<label for="' . $element['e_name'] . '">' . $element['r_name'] . '</label>');

            //select
            if ($element['input_type'] == 'select') {
                ecHHo('<select name="' . $element['e_name'] . '" id="' . $element['e_name'] . '">');
                foreach ($element['select_options'] as $select_options) {
                    ecHHo('<option value="' . $select_options['value'] . '">' . $select_options['r_name'] . '</option>');
                }
                ecHHo('</select>');
            }

            //checkbox
            if ($element['input_type'] == 'checkbox') {
                ecHHo('<input type="hidden" name="' . $element['e_name'] . '" value="">');
                ecHHo('<input type="checkbox" name="' . $element['e_name'] . '" value="true">');
            }

            //text
            if ($element['input_type'] == 'text') {
                ecHHo('<input type="text" name="' . $element['e_name'] . '"/>');
            }

            //file
            if ($element['input_type'] == 'file') {
                ecHHo('<input type="file" name="' . $element['e_name'] . '"  multiple accept="" />');
            }

            //deleted - по ошибке пробрался элемент не прописаный в БД
            if ($element['input_type'] == 'deleted') {
                ecHHo('<h4>по ошибке пробрался элемент - ' . $element['e_name'] . ' не прописаный в БД</h4>');
            }
            // Список всех элементов
            $element_list[$element['e_name']] = ['e_name' => $element['e_name'], 'r_name' => $element['r_name']];


        }
    }
}

function inputToInput($item = '')
{
    global $data_for_news;

    if ($item != '') {
        if (!empty($data_for_news[$item])) {
            echo 'value="' . $data_for_news[$item] . '"';
        }
    }
}

function inputToCheckbox($item = '')
{
    global $data_for_news;

    if ($item != '' && !empty($data_for_news[$item])) {
        if ($data_for_news[$item] == 1) {
            echo 'checked';
        }
    }

//проверка на Checkbox для раскрывающегося поля ( => в названии _checkbox)
    if (preg_match('/_checkbox/', $item)) {
        $num = strstr($item, '_checkbox', true) . '_num';
        if (!empty($data_for_news[$num])) {
            echo 'checked';
        }
    }
}

function inputToSelect($item = '', $selection = null)
{
    global $data_for_news;

    if ($item != '' && !empty($data_for_news[$item])) {
        if ($data_for_news[$item] == $selection) {
            echo 'selected';
        }
    }
}

function inputToRadio($item = '', $selection = null)
{
    global $data_for_news;

    if ($item != '' && !empty($data_for_news[$item])) {
        if ($data_for_news[$item] == $selection) {
            echo 'checked';
        }
    }
}

//Проверка на выбор Другое в Select
//должен присутствовать option value="Другое"
function inputOtherSelect($item = '', $arr = [])
{
    global $data_for_news;

    if ($item != '' && !empty($data_for_news[$item])) {
        if (!empty($data_for_news[$item]) && !(in_array($data_for_news[$item], $arr))) {
            echo 'selected';
        }
    }
}

function addClassOtherInput($item = '', $arr = [])
{
    global $data_for_news;

    if ($item != '') {
        if (!empty($data_for_news[$item]) && !(in_array($data_for_news[$item], $arr))) {
            echo 'showOtherInput_show';
        }
    }
}

?>
<h1>Общие админ функции</h1>
<h4>заполнить колонку значениями:</h4>
<form id="db" action="" method="post">
    <input type="text" name="table" value="0">Таблица<br>
    <input type="text" name="column" value="0">Колонка<br>
    <input type="text" name="names_str" value="0">Значения через запятую<br>
    <input type="submit" name="update_column" value="Внести изменения">
</form>
<form id="admin" action="" method="post">
    <input type="submit" name="see_error_file" value="Просмотреть лог файл ошибок">
</form>
<h1>Генератор форм для объявлений</h1>
<?php
//Вывод сообщений
if (!empty($this->data['message'])) {
    foreach ($this->data['message'] as $message) {
        echo '<span style="color: green">' . $message . '</span><br>';
    }
}
?>

<form id="menu" action="" method="post">
    <fieldset>
        <legend>Уникальные данных всех форм</legend>
        <section>
            <label>Выбор таблицы данных:
                <select name="table">
                    <option value="form_categories">Категории</option>
                    <option value="form_subcategories">Подкатегории</option>
                    <option value="form_elements">Элементы</option>
                    <option value="form_select_options">Опции(списки)</option>
                </select>
            </label>
            <label>Сортировать по русскому имени?
                <input type="checkbox" name="rus" value="true">
            </label>
        </section>
        <input type="submit" name="show_unique_forms_elements" value="Уникальные элементы всех форм">
    </fieldset>
    <hr>
    <input type="submit" name="show_same_name" value="Показать совпадение имен в таблицах">
    <input type="submit" name="show_index_select_opt" value="Исправления Индексов для списков">
    <hr>
    <h4>Генерация различного кода</h4>
    <input type="submit" name="generation_news_base" value="Вывести таблицу новостей news_base">
    <input type="submit" name="generation_news_table" value="Генерировать таблицу новостей БД на основе форм">
    <input type="submit" name="generation_news_table_2" value="Расхождения текущей БД со сгенерированной таблицой">
    <input type="submit" name="generation_news_post_args"
           value="Генерировать $args - код фильтрации POST для getFormData модели news">
    <input type="submit" name="all_forms_elements_and_options" value="Вывести ВСЕ элементы и списки в forms">
    <input type="submit" name="elements_eng_rus" value="Вывести все параметры в БД eng - rus">
    <hr>
    <h4>Генерация форм новостей на основе форм поиска</h4>
    <label for="generation_file_name">Имя файла (типа: 2_1_1)</label>
    <p>При генерации, файл остается неизменным.</p>
    <input name="generation_file_name" type="text"><br>
    <input type="submit" name="generating_news_forms_by_search_forms"
           value="Генерация форм новостей на основе форм поиска">
    <input type="submit" name="inserting_php_code_for_filling_fields"
           value="Вставка php кода заполнения полей при редактировании">
    <input type="submit" name="generating_news_views" value="Генерация кода для VIEWS">
    <p>При вставке php кода заполнения полей, желательно "причесать" файл</p>
    <hr>
    <h4>Внесение изменений в файлы сайта</h4>
    <input type="submit" name="change_news_menu" value="Обновить меню в файле news_myad">
    <input type="submit" name="all_checkbox_list" value="Генерировать массив всех checkbox и записать в NewsModel.php">
</form>

<!-- Выбор формы -->


<!--<div id="add_news_menu_button" class="clearfix icon add_news_menu_plus">Добавить новость</div>-->
<!--<div id="add_news_menu_body" class="clearfix">-->

<form id="add_news" action="" method="post">
    <legend>Выбор категории для создания нового объявления</legend>
    <label for="space_types">Тип площади:</label>
    <select name="space_types" id="space_types">
        <?php foreach ($this->data['form_options']['space_types'] as $k => $options) { ?>
            <option value="<?php echo $options['id']; ?>">
                <?php echo $options['r_name']; ?>
            </option>
        <?php } ?>
    </select>
    <br>
    <label for="operation_types">Операция:</label>
    <select name="operation_types" id="operation_types">
        <?php foreach ($this->data['form_options']['operation_types'] as $k => $options) { ?>
            <option value="<?php echo $options['id']; ?>">
                <?php echo $options['r_name']; ?>
            </option>
        <?php } ?>
    </select>
    <br>
    <label for="object_types">Тип объекта:</label>
    <select name="object_types" id="object_types">
        <?php foreach ($this->data['form_options']['object_types'] as $k => $options) { ?>
            <option value="<?php echo $options['id']; ?>">
                <?php echo $options['r_name']; ?>
            </option>
        <?php } ?>
    </select>

    <input type="submit" name="submit_add_news" value="Далее">
</form>

<?php if (isset($this->data['form']) && isset($this->data['form_options']['base'])) { ?>
    <h3>Список всех форм</h3>
    <table border="1px">
        <?php foreach ($this->data['form_options']['base'] as $base) {
            ?>
            <tr <?php if ($this->data['form']['form_id'] == $base['id']) {
                echo 'style="background:#CCC;"';
            }; ?>>
                <td> <?php echo $base['id']; ?></td>
                <td> <?php echo $base['space_type']['r_name']; ?></td>
                <td> <?php echo $base['operation']['r_name']; ?></td>
                <td> <?php echo $base['object_type']['r_name']; ?></td>
                <td> <?php echo $base['space_type']['id'] . '_' . $base['operation']['id'] . '_' . $base['object_type']['id'] . '.php'; ?></td>
                <td>
                    <form id="menu" action="" method="post">
                        <input type="hidden" name="space_types" value="<?php echo $base['space_type']['id']; ?>">
                        <input type="hidden" name="operation_types" value="<?php echo $base['operation']['id']; ?>">
                        <input type="hidden" name="object_types" value="<?php echo $base['object_type']['id']; ?>">
                        <input type="submit" name="see_select_form" value="Смотреть">
                    </form>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php } ?>

<?php if (isset($this->data['same_name'])) { ?>
    <h2>Одинаковые имена во всех таблицах БД</h2>
    <?php
    foreach ($this->data['same_name'] as $v) {
        echo $v;
    }
} ?>
<hr>

<!--</div>-->


<!-- Код для БД списки -->
<?php

if (isset($this->data['show_index_select_opt'])) {
    echo '<h3>Код для присвоения индексов для списков</h3>';
    echo '<br>DECLARE @I, @N;<br>';
    foreach ($this->data['show_index_select_opt'] as $i => $e) {
        echo 'BEGIN<br>';
        echo "SET @I = '" . ($i + 1) . "';<br>";
        echo "SET @N = '" . $e['e_name'] . "';<br>";
        echo "SET @ResultRec = UPDATE form_select_options SET value = '@I' WHERE e_name = '@N';<br>";
        echo "print @ResultRec;<br>";
        echo 'END<br>';
    }
}
?>

<!-- Код для БД списки  конец-->


<!-- Код для таблицы новостей БД -->
<?php
// новый код для таблицы
if (isset($this->data['news_table'])) {
    echo '<h3>Таблица новости</h3><hr>';
    echo 'DROP TABLE IF EXISTS news_base CASCADE;<br>CREATE TABLE news_base<br>(<br>';
    foreach ($this->data['news_table'] as $name => $type) {
        $color = 'black';
        if ($type == 'character varying(255) DEFAULT NULL') {
            $color = 'blue';
        }
        if ($type == 'boolean DEFAULT NULL') {
            $color = 'green';
        }
        if ($type == 'smallint DEFAULT NULL') {
            $color = 'brown';
        }
        if ($type == 'integer DEFAULT NULL') {
            $color = 'red';
        }
        echo '<p style="color:' . $color . ';">' . $name . ' ' . $type . ",</p>";
    }
    echo '  CONSTRAINT news_base_pkey PRIMARY KEY (id_news)<br>)<br>
  WITH (<br>  OIDS=FALSE<br>);<br>ALTER TABLE news_base<br>  OWNER TO postgres;<br><hr>';
}
?>

<!-- Код для таблицы новостей БД   конец-->
<!-- Расхождения текущей БД со сгенерированной таблицой -->
<?php if (!empty($this->data['news_table_test'])) { ?>
    <h3>Расхождения текущей БД со сгенерированной таблицой</h3>
    <?php
    foreach ($this->data['news_table_test'] as $v) {
        echo "* " . $v . '<br>';
    }
    ?>
<?php } ?>


<?php if (!empty($this->data['news_table_test_commands'])) { ?>
    <h3>Команды</h3>
    <?php
    foreach ($this->data['news_table_test_commands'] as $v) {
        echo $v . '<br>';
    }
    ?>
<?php } ?>


<!-- Расхождения текущей БД со сгенерированной таблицой  конец -->


<!-- Одинаковые имена в форме -->
<?php if (isset($this->data['form'])) { ?>
    <h3>Одинаковые имена в форме:</h3>
    <?php
    foreach ($this->data['form']['same_name'] as $key => $value) {
        if (isset($value)) {
            echo '<p style="color:red;">' . $key . '</p>';
        }
        foreach ($value as $k => $v) {
            echo $k . '[' . $v . ']<br>';
        }
    }
    ?>
    <hr>


    <!--  !!!!!!!!!!!!!! -->

    <!-- Генерация ФОРМЫ -->


    <?php
    echo "<!-- Начало формы -->";
    foreach ($this->data['form']['category'] as $category) {

        ecHHo('<fieldset>');
        ecHHo('<legend> ' . $category['r_name'] . ' [id= ' . $category['id'] . ' ] </legend>');

        //Элементы без подкатегорий
        showElement($category);


        // Подкатегории
        if (isset($category['subcategory'])) {
            foreach ($category['subcategory'] as $subcategory) {
                ecHHo('<fieldset>');
                ecHHo('<legend>' . $subcategory['r_name'] . ' [id= ' . $subcategory['id'] . ' ] </legend>');

                //Элементы внутри подкатегорий
                showElement($subcategory);

                ecHHo('</fieldset>');
            }
        }


        ecHHo('</fieldset>');

    }

    echo "<!-- Конец формы -->";
    ?>
    <!-- Конец генерации формы -->


    <form id="editor_form" class="main_editor_form" enctype="multipart/form-data" action="" method="post">
        <input type="hidden" name="form_id" value="<?php echo $this->data['form']['form_id']; ?>">


        <fieldset>
            <legend>Название</legend>
            <section>
                <label>Название новости*:
                    <input name="title" type="text" <?php inputToInput('title'); ?>>
                </label>

            </section>
        </fieldset>

        <!-- Вывод Генерируемой Формы -->

        <?php
        echo $form_code;
        ?>
        <!-- Конец формы -->

        <!-- Долнительная информация -->
        <fieldset>
            <legend>Долнительная информация</legend>
            <!--        <section>-->
            <!--            <label>Короткое содержание: -->
            <!--                <textarea name="short_content" type="text">--><?php
            //                    if (!empty($this->data['short_content'])) {
            //                        echo $this->data['short_content'];
            //                    }
            //                    ?><!--</textarea>-->
            <!--            </label>-->
            <!--        </section>-->
            <section>
                <label>Cодержание:
                    <textarea id="news_content" name="content" type="text"><?php
                        if (!empty($this->data['content'])) {
                            echo $this->data['content'];
                        }
                        ?></textarea>
                </label>
            </section>

            <section>
                <label>Теги (через запятую):
                    <input name="tags" type="text" value="<?php
                    if (!empty($this->data['tags'])) {
                        echo $this->data['tags'];
                    }
                    ?>">
                </label>
            </section>

            <section>
                <label> Статус новости:
                    <input type="radio" name="statusForUpdate" value="1" <?php
                    if (!empty($this->data['status'])) {
                        if ($this->data['status'] == 1 or empty($this->data['id_news'])) {
                            echo "checked";
                        }
                    }
                    ?> > Публикация
                    <input type="radio" name="statusForUpdate" value="0" <?php
                    if (!empty($this->data['status'])) {
                        if ($this->data['status'] === 0) {
                            echo "checked";
                        }
                    }
                    ?> > Скрыть
                </label>
            </section>
        </fieldset>

        <!-- Ввод картинки -->
        <fieldset>
            <legend>Загрузка картинок</legend>
            <section>
                <div>Вы можете выбрать 5 файлов для загрузки.</div>
                <div id="inputImageContainer">

                    <div id="addDynamicField">
                        <input type="button" id="addFieldButton" value="Добавить Фотографию:">
                        <div id="imageMessage"><?php if (!empty($this->data["preview_img"][0])) { ?> Вы можете загрузить ещё: <?php echo(5 - count($this->data["preview_img"])); ?> фотографий. <?php } ?></div>
                    </div>

                    <?php
                    // Вывод уже имеющихся фотографий
                    if (!empty($this->data["preview_img"][0])) {
                        foreach ($this->data["preview_img"] as $k => $img) {
                            $i = $k + 1; ?>
                            <div class="imgInput imgInput_<?php echo $i; ?>">
                                <label>Выберите фотографию: <?php echo $i; ?></label>
                                <br>
                                <img id="img-preview_<?php echo $i; ?>" src="/uploads/images/s_<?php echo $img; ?>">
                                <input type="file" id="image_input_<?php echo $i; ?>"
                                       name="image_name_<?php echo $i . '_saved_'; ?>" class="inputfile"
                                       onchange="{document.getElementById(&quot;img-preview_<?php echo $i; ?>&quot;).src = window.URL.createObjectURL(this.files[0]);document.getElementById(&quot;image_input_<?php echo $i; ?>&quot;).setAttribute('name', &quot;image_name_<?php echo $i; ?>&quot;);}">
                                <br>
                                <input value="Удаление" type="button" class="DeleteField">
                            </div>
                            <?php
                        }
                    }
                    ?>


                </div>
            </section>
        </fieldset>


        <input type="submit" name="submit_editor" value="Записать новость"> <a href="/news/editor">Отмена</a>
    </form>
    <?php
}
//Конец вывода формы(проверки на присутствие data['form'])
?>
<h2>Элементы формы:</h2>
<table>
    <?php
    //Присвоение типов элементов
    foreach ($element_list as $i => $el) {
        $element_list[$i]['type'] = $this->data['news_db'][$el['e_name']];
    }
    ksort($element_list);
    foreach ($element_list as $el) {
        switch ($el['type']) {
            case 'character varying(255)':
                $color = 'blue';
                break;
            case 'smallint':
                $color = 'brown';
                break;
            case 'integer':
                $color = 'red';
                break;
            case 'boolean':
                $color = 'green';
                break;
            default:
                $color = 'black';
                break;
        }
        echo '<tr style="color:' . $color . ';">';
        echo '<td>' . $el['e_name'] . '</td><td>' . $el['r_name'] . '</td><td>' . $el['type'] . '</td>';
        echo '</tr>';
    }
    ?>
</table>


<?php
// Исправление форм
if (isset($this->data['all_forms_elements'])) {
    ?> <h2>Исправление форм</h2> <?php
    echo '---- $this->data[all_forms_elements] ----';
    echo '<br>';
    var_dump($this->data['all_forms_elements']);
    echo '<br>';
    echo '_____________<br><br>';

}


?>

<!-- Вывод всех элементов и списков для проверки вариантов из form -->
<?php

if (isset($this->data['all_forms_elements_and_options'])) {

    echo '<h3>Вывод всех элементов и списков для проверки вариантов из form</h3>';
    foreach ($this->data['all_forms_elements_and_options'] as $id => $e) {
        echo $e['r_name'] . ' ( ' . $e['form_id'] . ' )  -  [' . $e['id'] . ']<br>';
        if (isset($e['options'])) {
            foreach ($e['options'] as $opt) {
                echo ' - ' . $opt['r_name'] . '<br>';
            }
        }
    }
}
?>

<!-- Вывод всех элементов и списков для проверки вариантов из form   конец-->


<!-- Генерировать $args - код фильтрации POST для getFormData модели news -->
<?php
if (isset($this->data['args'])) {
    echo "static \$args = array(<br>";
    foreach ($this->data['args'] as $key => $value) {
        echo "'" . $key . "' => " . $value . ",<br>";
    }
    echo " );<br>";
}

?>
<!-- Генерировать $args - код фильтрации POST для getFormData модели news    конец -->

<!-- Вывод элементов БД eng-rus -->
<?php
if (isset($this->data['elements_eng_rus'])) {
    echo "<h2>Вывод элементов БД</h2>";
    foreach ($this->data['elements_eng_rus']['element'] as $key => $value) {
        echo "'" . $key . "' => '" . $value . "',<br>";
    }
    echo " );<br>";

    echo "<h2>Вывод опций БД</h2>";
    foreach ($this->data['elements_eng_rus']['options'] as $key => $value) {
        echo $key . " => '" . $value . "',<br>";
    }
    echo " );<br>";
}

?>
<!-- Вывод элементов БД eng-rus    конец -->


<!-- Вывод элементов БД news_base -->
<?php
if (isset($this->data['news_base'])) {

    echo "<h2>Вывод таблицы news_base</h2>";

    echo 'DROP TABLE IF EXISTS news_base CASCADE;<br>CREATE TABLE news_base<br>(<br>';
    foreach ($this->data['news_base']['db'] as $name => $type) {
        $color = 'black';
        if ($type == 'character varying(255) DEFAULT NULL') {
            $color = 'blue';
        }
        if ($type == 'boolean DEFAULT NULL') {
            $color = 'green';
        }
        if ($type == 'smallint DEFAULT NULL') {
            $color = 'brown';
        }
        if ($type == 'integer DEFAULT NULL') {
            $color = 'red';
        }
        echo '<p style="color:' . $color . ';">' . $name . ' ' . $type . ",</p>";
    }
    echo '  CONSTRAINT news_base_pkey PRIMARY KEY (id_news)<br>)<br>
  WITH (<br>  OIDS=FALSE<br>);<br>ALTER TABLE news_base<br>  OWNER TO postgres;<br><hr>';

    echo "<h2>Вывод наименований переменных</h2>";
    foreach ($this->data['news_base']['rus_eng'] as $eng => $rus) {
        echo $rus . " => '" . $eng . "',<br>";
    }
    echo " );<br><hr><br><hr>";
    ?>
    <h3>Расхождения текущей БД с данной таблицей</h3>
    <?php
    if (!empty($this->data['news_base_test'])) {
        foreach ($this->data['news_base_test'] as $v) {
            echo "* " . $v . '<br>';
        }?>
        <h3>Команды</h3>
        <?php
    }

    if (!empty($this->data['news_base_commands'])) {
        foreach ($this->data['news_base_commands'] as $v) {
            echo $v . '<br>';
        }
    }

    if (!empty($this->data['news_base']['rus_eng'])){
        ksort($this->data['news_base']['rus_eng']);
        ?><hr><h2>Заголовки {для (NewsModel) prepareNewsView()}</h2><?php
        foreach ($this->data['news_base']['rus_eng'] as $eng => $rus) {
            echo "'".$eng . "' => '" . $rus . "',<br>";
        }
    }
    if (!empty($this->data['news_base']['args'])) {
        ?><hr><h2>Фильтры {args для (NewsModel) getFormData()}</h2><?php
        foreach ($this->data['news_base']['args'] as $k => $v) {
            echo "'".$k . "' => " . $v . ",<br>";
        }
    }

}

?>


<script type="text/javascript" src="/template/js/jquery.validate.js"></script>
<script type="text/javascript" src="/template/js/news_javascript.js"></script>

