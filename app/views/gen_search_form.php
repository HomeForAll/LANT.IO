<style>
    .active {
        color: #FFFFFF;
        background: lightslategray;
    }

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

<?php

//$count = 0;
//
//foreach ($this->data['subcategories'] as $subcategory) {
//    if (in_array('Расположение', $subcategory)){
//        $count++;
//    }
//}
//
//echo 'Найдено совпадений: ' . $count . "<br>\n";

// Вывод ссылок на формы
foreach ($this->data['forms'] as $form) {
    foreach ($this->data['types']['space_types'] as $space_type) {
        if (preg_match("~(Жилая)~i", $space_type['r_name'])) {
            foreach ($this->data['types']['operation_types'] as $operation_type) {
                if (preg_match("~(Арендовать)~i", $operation_type['r_name'])) {
                    foreach ($this->data['types']['object_types'] as $object_type) {
                        if ($form['space_type'] == $space_type['id'] && $form['operation'] == $operation_type['id'] && $form['object_type'] == $object_type['id']) {
                            echo '<a href="/forms_gen/' . $form['id'] . '" class="button ' . (!empty($this->data['id']) ? $form['id'] == $this->data['id'] ? 'active' : '' : '') . '">' . $space_type['r_name'] . '/' . $operation_type['r_name'] . '/' . $object_type['r_name'] . '</a><br>';
                        }
                    }
                }
            }
        }
    }
}

function getElToString($el, $options, $indent)
{
    $result = "";

    switch ($el['type']) {
        case '1':
            $result .= '<label style="margin-left: ' . $indent . 'px; box-sizing: border-box;" for="' . $el['e_name'] . '-min">' . $el['r_name'] . ':</label><br>' . "\n";
            $result .= '<input style="margin-left: ' . $indent . 'px; box-sizing: border-box;" id="' . $el['e_name'] . '-min" name="' . $el['e_name'] . '-min" type="text" placeholder="от"><br>' . "\n";
            $result .= '<input style="margin-left: ' . $indent . 'px; box-sizing: border-box;" id="' . $el['e_name'] . '-max" name="' . $el['e_name'] . '-max" type="text" placeholder="до"><br>' . "\n";
            break;
        case '2':
            $result .= '<label style="margin-left: ' . $indent . 'px; box-sizing: border-box;">' . $el['r_name'] . ' <input type="checkbox" name="' . $el['e_name'] . '"></label><br>' . "\n";
            break;
        case '3':
            $result .= '<label style="margin-left: ' . $indent . 'px; box-sizing: border-box;" for="' . $el['e_name'] . '">' . $el['r_name'] . '</label><br>' . "\n";
            $result .= '<select style="margin-left: ' . $indent . 'px; box-sizing: border-box;" name="' . $el['e_name'] . '" id="' . $el['e_name'] . '">' . "\n";
            foreach ($options as $option) {
                if ($option['element_id'] == $el['id']) {
                    $result .= '<option value="' . $option['value'] . '">' . $option['r_name'] . '</option>' . "\n";
                }
            }
            $result .= '</select><br>' . "\n";
            break;
    }

    return $result;
}

// Вывод формы
if (!empty($this->data['id'])) {
    $generator = new FormGenerator($this->data['id'], $this->data['categories'], $this->data['subcategories'], $this->data['elements'], $this->data['lists']);

    $generator->transferElement("Объект размещен", FormGenerator::ELEMENT, "Базовый раздел", FormGenerator::CATEGORY);
    $generator->transferElement("Жилая", FormGenerator::ELEMENT, "Площадь", FormGenerator::SUBCATEGORY);
    $generator->transferElement("Кровля", FormGenerator::ELEMENT, "Исходные параметры", FormGenerator::CATEGORY);

    var_dump($generator->searchCategoryByName('Основное'));

    echo $generator->build();
    //$generator->writeForms($this->data['types']['space_types'], $this->data['types']['operation_types'], $this->data['types']['object_types']);

}
//    echo '<form action="" method="post">' . "\n";
//    foreach ($this->data['categories'] as $key => $category) {
//        if ($category['form_id'] == $this->data['id'] && !preg_match("~(Объект размещен)~i", $category['r_name'])) {
//            echo '<fieldset>' . "\n";
//            echo '<legend>' . $category['r_name'] . '</legend><br>' . "\n";
//
//            foreach ($this->data['subcategories'] as $subcategory) {
//                if ($subcategory['category_id'] == $category['id']) {
//                    //echo $subcategory['r_name'] . "<br>";
//
//                    // Проверка на одинаковое название подкатегории и елемента
//                    $flag = false;
//                    $margin_left = '20';
//
//                    foreach ($this->data['elements'] as $element) {
//                        if (preg_match("~(Площадь)~i", $subcategory['r_name'])){
//                            continue;
//                        } elseif ($element['r_name'] == $subcategory['r_name']) {
//                            $flag = true;
//                        }
//                    }
//
//                    if (!$flag) {
//                        $margin_left = '40';
//                        echo "<b style='box-sizing: border-box; margin-left: 20px'>" . $subcategory['r_name'] . "</b><br>" . "\n";
//                    }
//
//                    if (preg_match("~(Расположение)~i", $subcategory['r_name'])) {
//                        echo '<input type="text" name="address" style="margin: 10px 0 10px ' . $margin_left . 'px;" placeholder="Адрес..."><br>';
//                        echo '<span style="margin-left: ' . $margin_left . 'px">Страна: </span><br>';
//                        echo '<span style="margin-left: ' . $margin_left . 'px">Область: </span><br>';
//                        echo '<span style="margin-left: ' . $margin_left . 'px">Город: </span><br>';
//                        echo '<span style="margin-left: ' . $margin_left . 'px">Район: </span><br>';
//                        echo '<span style="margin-left: ' . $margin_left . 'px">Дом: </span><br>';
//                        //Блок для карты Яндекс
//                        echo '<div style="margin: 0 auto; width: 700px; height: 700px; background: #000;"></div>';
//
//                        // Выводим элементы в расположении объекта исключая область и город
//                        foreach ($this->data['elements'] as $element) {
//                            if ($element['subcategory'] == $subcategory['id'] && !preg_match("~(область|город)~i", $element['r_name'])) {
//                                echo getElToString($element, $this->data['lists'], $margin_left);
//                                foreach ($this->data['elements'] as $el) {
//                                    if ($el['parent_el'] == $element['id']) {
//                                        echo getElToString($el, $this->data['lists'], $margin_left == 40 ? 60 : 40);
//                                    }
//                                }
//                            }
//                        }
//                    } elseif (preg_match("~(Наличие лифта)~i", $subcategory['r_name'])) {
//                        // Корректный вывод элемента "Наличие лифта"
//                        $result = '';
//                        $result .= '<label style="margin-left: ' . 20 . 'px; box-sizing: border-box;" for="' . $subcategory['e_name'] . '">' . $subcategory['r_name'] . '</label><br>' . "\n";
//                        $result .= '<select style="margin-left: ' . 20 . 'px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '" id="' . $subcategory['e_name'] . '">' . "\n";
//                        $result .= '<option value="1">Да</option>';
//                        $result .= '<option value="0">Нет</option>';
//                        $result .= '</select><br>' . "\n";
//                        echo $result;
//                        foreach ($this->data['elements'] as $element) {
//                            if ($element['subcategory'] == $subcategory['id'] && preg_match("~(Да)~i", $element['r_name'])) {
//                                $result = '';
//                                $result .= '<select style="margin-left: ' . 20 . 'px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '_yes" id="' . $subcategory['e_name'] . '_yes">' . "\n";
//                                foreach ($this->data['lists'] as $option) {
//                                    if ($option['element_id'] == $element['id']) {
//                                        $result .= '<option value="' . $option['value'] . '">' . $option['r_name'] . '</option>' . "\n";
//                                    }
//                                }
//                                $result .= '</select><br>' . "\n";
//                                echo $result;
//                            }
//                        }
//                    } else {
//                        foreach ($this->data['elements'] as $element) {
//                            if ($element['subcategory'] == $subcategory['id']) {
//                                if (preg_match("~(Комнаты)~i", $element['r_name'])) {
//                                    // Корректно выводим комнаты
//                                    $result = '';
//                                    $result .= '<span style="margin-left: ' . $margin_left . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
//                                    foreach ($this->data['lists'] as $option) {
//                                        if ($option['element_id'] == $element['id']) {
//                                            $margin = (integer)$margin_left + 20;
//                                            $result .= '<label style="margin-left: ' . $margin . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
//                                        }
//                                    }
//                                    echo $result;
//                                } else {
//                                    echo getElToString($element, $this->data['lists'], $margin_left);
//                                    foreach ($this->data['elements'] as $el) {
//                                        if ($el['parent_el'] == $element['id']) {
//                                            echo getElToString($el, $this->data['lists'], $margin_left == '40' ? 60 : 40);
//                                        }
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
//            }
//
//            foreach ($this->data['elements'] as $element) {
//                if (preg_match("~(Жилищно-коммунальные услуги)~i", $element['r_name']) && $element['form_id'] == $this->data['id'] && preg_match("~(Характеристики дома)~i", $category['r_name'])) {
//                    // Корректно выводим "Жилищно-коммунальные услуги"
//                    $result = '';
//                    $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
//                    foreach ($this->data['lists'] as $option) {
//                        if ($option['element_id'] == $element['id']) {
//                            $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
//                        }
//                    }
//                    echo $result;
//                } elseif (preg_match("~(Безопасность)~i", $element['r_name']) && $element['form_id'] == $this->data['id'] && preg_match("~(Характеристики дома)~i", $category['r_name'])) {
//                    // Корректно выводим "Безопасность"
//                    $result = '';
//                    $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
//                    foreach ($this->data['lists'] as $option) {
//                        if ($option['element_id'] == $element['id']) {
//                            $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
//                        }
//                    }
//                    echo $result;
//                } elseif ($element['category'] == $category['id'] || (preg_match("~(Объект размещен)~i", $element['r_name']) && preg_match("~(Базовая)~i", $category['r_name'])) && $element['form_id'] == $this->data['id']) {
//                    echo getElToString($element, $this->data['lists'], 20);
//                    foreach ($this->data['elements'] as $el) {
//                        if ($el['parent_el'] == $element['id']) {
//                            echo getElToString($el, $this->data['lists'], 40);
//                        }
//                    }
//                }
//            }
//
//            echo '<br>';
//            echo '</fieldset><br>';
//        }
//    }
//    echo '<input type="submit" name="submit" value="Найти"><br>';
//    echo '</form>';
//}

//function getFormData($id)
//{
//    $db = new DataBase();
//
//    return $db->select('*')->from('forms')->where('id', '=', $id)->execute();
//}

//
//// Вывод форм в файл
//foreach ($this->data['types']['space_types'] as $space_type) {
//    foreach ($this->data['types']['object_types'] as $object_type) {
//        foreach ($this->data['types']['operation_types'] as $operation_type) {
//            $form_data = getFormData($space_type['id'], $operation_type['id'], $object_type['id']);
//
//            if ($form_data) {
//
//                if (!file_exists(ROOT_DIR . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'])) {
//                    mkdir(ROOT_DIR . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'], 0777, true);
//                }
//
//                $form = '<form action="" method="post">' . "\n";
//
//                foreach ($this->data['categories'] as $category) {
//                    if ($category['form_id'] == $form_data[0]['id']) {
//                        $form .= '<fieldset>' . "\n";
//                        $form .= '<legend>' . $category['r_name'] . '</legend><br>' . "\n";
//
//                        foreach ($this->data['subcategories'] as $subcategory) {
//                            if ($subcategory['category_id'] == $category['id']) {
//                                $form .= "<b style='box-sizing: border-box; margin-left: 20px'>" . $subcategory['r_name'] . "</b><br>\n";
//
//                                foreach ($this->data['elements'] as $element) {
//                                    if ($element['subcategory'] == $subcategory['id']) {
//                                        $form .= getElToString($element, $this->data['lists'], 40);
//
//                                        foreach ($this->data['elements'] as $el) {
//                                            if ($el['parent_el'] == $element['id']) {
//                                                $form .= getElToString($el, $this->data['lists'], 60);
//                                            }
//                                        }
//                                    }
//                                }
//                            }
//                        }
//
//                        foreach ($this->data['elements'] as $element) {
//                            if ($element['category'] == $category['id']) {
//
//                                $form .= getElToString($element, $this->data['lists'], 20);
//                                foreach ($this->data['elements'] as $el) {
//                                    if ($el['parent_el'] == $element['id']) {
//                                        $form .= getElToString($el, $this->data['lists'], 40);
//                                    }
//                                }
//                            }
//                        }
//
//                        $form .= '<br>' . "\n";
//                        $form .= '</fieldset><br>' . "\n";
//                    }
//                }
//
//                $form .= '</form>' . "\n";
//
//                $file = fopen(ROOT_DIR . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'] . '/' . $object_type['e_name'] . '.php', 'w+');
//                chmod(ROOT_DIR . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'] . '/' . $object_type['e_name'] . '.php', 0777);
//                fwrite($file, $form);
//                fclose($file);
//            }
//
//            echo 'Форма: ' . '/forms/' . $space_type['e_name'] . '/' . $operation_type['e_name'] . '/' . $object_type['e_name'] . '.php' . " готова.<br>\n";
//
////            sleep(2);
//        }
//    }
//}


//$file = fopen(ROOT_DIR . '/forms/' . $this->data['forms'][0]['id'] . '.php', 'w+');
//chmod(ROOT_DIR . '/forms/paths.php', 0777);
//
//fwrite($file, getFormToString($this));
//fclose($file);
//
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
?>

