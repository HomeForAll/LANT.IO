<?php
if (isset($this->data['types'])) {
    echo "<h3>Типы площади:</h3>\n";
    foreach ($this->data['types']['space_types'] as $type) {
        echo $type['id'] . ". " . $type['r_name'] . "<br>\n";
    }

    echo "<br><h3>Типы объекта:</h3>\n";
    foreach ($this->data['types']['object_types'] as $type) {
        echo $type['id'] . ". " . $type['r_name'] . "<br>\n";
    }

    echo "<br><h3>Типы операции:</h3>\n";
    foreach ($this->data['types']['operation_types'] as $type) {
        echo $type['id'] . ". " . $type['r_name'] . "<br>\n";
    }
}
?>
<style>
    label {
        font-weight: bold;
    }

    input[type=text], select {
        font-family: Arial, sans-serif;
        font-size: 10pt;
        width: 70%;
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
</style>

<br>
<form action="" method="post">
    <label>
        Тип площади:
        <input type="text" name="space_type"
               value="<?php if (isset($_POST['space_type'])) echo $_POST['space_type']; ?>">
    </label>
    <br>
    <label>
        Тип объекта:
        <input type="text" name="object_type"
               value="<?php if (isset($_POST['object_type'])) echo $_POST['object_type']; ?>">
    </label>
    <br>
    <label>
        Тип операции:
        <input type="text" name="operation_type"
               value="<?php if (isset($_POST['operation_type'])) echo $_POST['operation_type']; ?>">
    </label>
    <br>
    <input type="submit" name="submit" value="Генерировать">
</form>

<?php
function getElToString($el, $options, $indent)
{
    $result = "";

    switch ($el['type']) {
        case '1':
            $result .= '<label style="margin-left: ' . $indent . 'px; box-sizing: border-box;" for="' . $el['e_name'] . 'min">' . $el['r_name'] . ':</label><br>' . "\n";
            $result .= '<input style="margin-left: ' . $indent . 'px; box-sizing: border-box;" id="' . $el['e_name'] . 'min" name="' . $el['e_name'] . 'min" type="text" placeholder="от"><br>' . "\n";
            $result .= '<input style="margin-left: ' . $indent . 'px; box-sizing: border-box;" id="' . $el['e_name'] . 'max" name="' . $el['e_name'] . 'max" type="text" placeholder="до"><br>' . "\n";
            break;
        case '2':
            $result .= '<label style="margin-left: ' . $indent . 'px; box-sizing: border-box;">' . $el['r_name'] . ' <input type="checkbox" name="' . $el['e_name'] . '"></label><br>' . "\n";
            break;
        case '3':
            $result .= '<label style="margin-left: ' . $indent . 'px; box-sizing: border-box;" for="' . $el['e_name'] . '">' . $el['r_name'] . '</label><br>' . "\n";
            $result .= '<select style="margin-left: ' . $indent . 'px; box-sizing: border-box;" name="' . $el['e_name'] . '" id="' . $el['e_name'] . '">' . "\n";
            foreach ($options as $option) {
                if ($option['element_id'] == $el['id']) {
                    $result .= '<option value="' . $option['e_name'] . '">' . $option['r_name'] . '</option>' . "\n";
                }
            }
            $result .= '</select><br>' . "\n";
            break;
    }

    return $result;
}


if (!empty($this->data['forms'])) {

    $this->printInPre("Количество: " . count($this->data['forms']));

    echo '<form action="" method="post">' . "\n";

    foreach ($this->data['categories'] as $category) {
        if ($category['form_id'] == $this->data['forms'][0]['id']) {
            echo '<fieldset>' . "\n";

            echo '<legend>' . $category['r_name'] . '</legend><br>' . "\n";

            foreach ($this->data['subcategories'] as $subcategory) {
                if ($subcategory['category_id'] == $category['id']) {
                    echo "<b style='box-sizing: border-box; margin-left: 20px'>" . $subcategory['r_name'] . "</b><br>" . "\n";

                    foreach ($this->data['elements'] as $element) {
                        if ($element['subcategory'] == $subcategory['id']) {
                            echo getElToString($element, $this->data['lists'], 40);
                            foreach ($this->data['elements'] as $el) {
                                if ($el['parent_el'] == $element['id']) {
                                    echo getElToString($el, $this->data['lists'], 60);
                                }
                            }
                        }
                    }
                }
            }

            foreach ($this->data['elements'] as $element) {
                if ($element['category'] == $category['id']) {

                    echo getElToString($element, $this->data['lists'], 20);
                    foreach ($this->data['elements'] as $el) {
                        if ($el['parent_el'] == $element['id']) {
                            echo getElToString($el, $this->data['lists'], 40);
                        }
                    }
                }
            }

            echo '<br>';
            echo '</fieldset><br>';
        }
    }

    echo '</form>';
}

function getFormData($space_type, $operation_type = null, $object_type = null)
{
    $db = new DataBase();

    $query = $db->select('*')->from('forms')->where('space_type', '=', $space_type);

    if ($object_type) {
        $query->where('object_type', '=', $object_type);
    }

    if ($operation_type) {
        $query->where('operation', '=', $operation_type);
    }

    return $query->execute();
}

// Вывод форм в файл
foreach ($this->data['types']['space_types'] as $space_type) {
    foreach ($this->data['types']['object_types'] as $object_type) {
        foreach ($this->data['types']['operation_types'] as $operation_type) {
            $form_data = getFormData($space_type['id'], $operation_type['id'], $object_type['id']);

            if ($form_data) {

                if (!file_exists(ROOT_DIR . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'])) {
                    mkdir(ROOT_DIR . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'], 0777, true);
                }

                $form = '<form action="" method="post">' . "\n";

                foreach ($this->data['categories'] as $category) {
                    if ($category['form_id'] == $form_data[0]['id']) {
                        $form .= '<fieldset>' . "\n";
                        $form .= '<legend>' . $category['r_name'] . '</legend><br>' . "\n";

                        foreach ($this->data['subcategories'] as $subcategory) {
                            if ($subcategory['category_id'] == $category['id']) {
                                $form .= "<b style='box-sizing: border-box; margin-left: 20px'>" . $subcategory['r_name'] . "</b><br>\n";

                                foreach ($this->data['elements'] as $element) {
                                    if ($element['subcategory'] == $subcategory['id']) {
                                        $form .= getElToString($element, $this->data['lists'], 40);

                                        foreach ($this->data['elements'] as $el) {
                                            if ($el['parent_el'] == $element['id']) {
                                                $form .= getElToString($el, $this->data['lists'], 60);
                                            }
                                        }
                                    }
                                }
                            }
                        }

                        foreach ($this->data['elements'] as $element) {
                            if ($element['category'] == $category['id']) {

                                $form .= getElToString($element, $this->data['lists'], 20);
                                foreach ($this->data['elements'] as $el) {
                                    if ($el['parent_el'] == $element['id']) {
                                        $form .= getElToString($el, $this->data['lists'], 40);
                                    }
                                }
                            }
                        }

                        $form .= '<br>' . "\n";
                        $form .= '</fieldset><br>' . "\n";
                    }
                }

                $form .= '</form>' . "\n";

                $file = fopen(ROOT_DIR . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'] . '/' . $object_type['e_name'] . '.php', 'w+');
                chmod(ROOT_DIR . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'] . '/' . $object_type['e_name'] . '.php', 0777);
                fwrite($file, $form);
                fclose($file);
            }

            echo 'Форма: ' . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'] . '/' . $object_type['e_name'] . '.php' . " готова.<br>\n";

//            sleep(2);
        }
    }
}


//$file = fopen(ROOT_DIR . '/forms/' . $this->data['forms'][0]['id'] . '.php', 'w+');
//chmod(ROOT_DIR . '/forms/paths.php', 0777);
//
//fwrite($file, getFormToString($this));
//fclose($file);

//$db = new DataBase();
//
//echo '<br>Категории (таблица form_categories): <br>';
//foreach ($this->data['categories'] as $category) {
//    if (preg_match("/[^a-zA-Z0-9_]/", $category['e_name'])) {
//        echo 'ID: ' . $category['id'] . ', название на английском: ' . $category['e_name'] . '<br>';
//
//        $name = $category['e_name'];
//        $name = trim($name);
//        $name = preg_replace("/[ ]/", "_", $name);
//        $name = preg_replace("/[,]/", "_", $name);
//        $name = preg_replace("~[/]~", "_", $name);
//        $name = preg_replace("/(__)/", "_", $name);
//
////        $db->query("UPDATE form_categories SET e_name='{$name}' WHERE id={$category['id']};");
////        var_dump($db->errorInfo());
//    }
//}
//
//echo '<br>Подкатегории (таблица form_subcategories): <br>';
//foreach ($this->data['subcategories'] as $subcategory) {
//    if (preg_match("/[^a-zA-Z0-9_]/", $subcategory['e_name'])) {
//        echo 'ID: ' . $subcategory['id'] . ', название на английском: ' . $subcategory['e_name'] . '<br>';
//
//        $name = $subcategory['e_name'];
//        $name = trim($name);
//        $name = preg_replace("/[ ]/", "_", $name);
//        $name = preg_replace("/[,]/", "_", $name);
//        $name = preg_replace("~[/]~", "_", $name);
//        $name = preg_replace("/(__)/", "_", $name);
//
////        $db->query("UPDATE form_subcategories SET e_name='{$name}' WHERE id={$subcategory['id']};");
////        var_dump($db->errorInfo());
//    }
//}
//
//echo '<br>Элементы (таблица form_elements): <br>';
//foreach ($this->data['elements'] as $element) {
//    if (preg_match("~[,]~i", $element['e_name'])) {
//        echo 'ID: ' . $element['id'] . ', название на английском: ' . $element['e_name'] . '<br>';
//
//        $name = $element['e_name'];
//        $name = trim($name);
//        $name = preg_replace("/[ ]/", "_", $name);
//        $name = preg_replace("/[,]/", "_", $name);
//        $name = preg_replace("~[/]~", "_", $name);
//        $name = preg_replace("/(__)/", "_", $name);
//
////        $db->query("UPDATE form_elements SET e_name='{$name}' WHERE id={$element['id']};");
////        var_dump($db->errorInfo());
//    }
//}
//
//echo '<br>Опции списка (таблица form_select_options): <br>';
//foreach ($this->data['lists'] as $option) {
//    if (preg_match("/[^a-zA-Z0-9_]/", $option['e_name'])) {
//        echo 'ID: ' . $option['id'] . ', название на английском: ' . $option['e_name'] . '<br>';
//
//        $name = $option['e_name'];
//        $name = trim($name);
//        $name = preg_replace("/[ ]/", "_", $name);
//        $name = preg_replace("/[,]/", "_", $name);
//        $name = preg_replace("~[/]~", "_", $name);
//        $name = preg_replace("/(__)/", "_", $name);
//
////        $db->query("UPDATE form_select_options SET e_name='{$name}' WHERE id={$option['id']};");
////        var_dump($db->errorInfo());
//    }
//}

//echo count($this->data['categories']) + count($this->data['subcategories']) + count($this->data['elements']) + count($this->data['lists']);
?>

