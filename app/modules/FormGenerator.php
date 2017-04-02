<?php

class FormGenerator
{
    // Типы элементов
    const CATEGORY = 1;
    const SUBCATEGORY = 2;
    const ELEMENT = 3;

    private $db;
    private $formID;
    private $form;
    private $categories = array();
    private $subcategories = array();
    private $elements = array();
    private $options = array();
    private $formInfo;

    private $formBody;

    public function __construct($formID, $categories, $subcategories, $elements, $options)
    {
        $this->db = new DataBase();

        $this->formID = $formID;
        $this->form = $this->getFormByID($formID);
        $this->categories = $categories;
        $this->subcategories = $subcategories;
        $this->elements = $elements;
        $this->options = $options;

        $this->errorsHandler();
    }

    // Перенос элементов
    public function transferElement($name, $type, $nameTo, $typeTo)
    {
        if ($type == self::SUBCATEGORY && $typeTo == self::CATEGORY) {
            $this->transferSubcategoryToCategory($name, $nameTo);
        } elseif ($type == self::ELEMENT && $typeTo == self::CATEGORY) {
            $this->transferElementToCategory($name, $nameTo);
        } elseif ($type == self::ELEMENT && $typeTo == self::SUBCATEGORY) {
            $this->transferElementToSubcategory($name, $nameTo);
        } elseif ($type == self::ELEMENT && $typeTo == self::ELEMENT) {
            $this->transferElementToElement($name, $nameTo);
        }
    }

    private function transferSubcategoryToCategory($subcategoryName, $categoryName) {
        $subject = $this->searchSubcategoryByName($subcategoryName);
        $to = $this->searchCategoryByName($categoryName);
        $id = $subject[0];

        if ($subject && $to) {
            $this->clearPosition($id, self::SUBCATEGORY);
            $this->subcategories[$id]['category_id'] = $to[1]['id'];
        }
    }

    private function transferElementToCategory($elementName, $categoryName) {
        $subject = $this->searchSubcategoryByName($elementName);
        $to = $this->searchCategoryByName($categoryName);
        $id = $subject[0];

        if ($subject && $to) {
            $this->clearPosition($id, self::ELEMENT);
            $this->subcategories[$id]['category'] = $to[1]['id'];
        }
    }

    private function transferElementToSubcategory($elementName, $subcategoryName) {
        $subject = $this->searchSubcategoryByName($elementName);
        $to = $this->searchCategoryByName($subcategoryName);
        $id = $subject[0];

        if ($subject && $to) {
            $this->clearPosition($id, self::ELEMENT);
            $this->subcategories[$id]['subcategory'] = $to[1]['id'];
        }
    }

    private function transferElementToElement($elementName, $parentElementName) {
        $subject = $this->searchSubcategoryByName($elementName);
        $to = $this->searchCategoryByName($parentElementName);
        $id = $subject[0];

        if ($subject && $to) {
            $this->clearPosition($id, self::ELEMENT);
            $this->subcategories[$id]['parent_el'] = $to[1]['id'];
        }
    }

    private function clearPosition($id, $type)
    {
        switch ($type) {
            case self::SUBCATEGORY:
                $this->subcategories[$id]['category_id'] = null;
                break;
            case self::ELEMENT:
                $this->elements[$id]['category'] = null;
                $this->elements[$id]['subcategory'] = null;
                $this->elements[$id]['parent_el'] = null;
                break;
        }
    }

    //Поиск элементов по ID
    private function searchCategoryByID($id)
    {
        foreach ($this->categories as $category) {
            if ($category['id'] == $id) {
                return $category;
            }
        }

        return false;
    }

    private function searchSubcategoryByID($id)
    {
        foreach ($this->subcategories as $subcategory) {
            if ($subcategory['id'] == $id) {
                return $subcategory;
            }
        }

        return false;
    }

    private function searchElementByID($id)
    {
        foreach ($this->elements as $element) {
            if ($element['id'] == $id) {
                return $element;
            }
        }

        return false;
    }

    // Поиск элементов по имени
    public function searchCategoryByName($name)
    {
        foreach ($this->categories as $key => $category) {
            if (preg_match("~({$name})~i", $category['r_name']) && $category['form_id'] == $this->formID) {
                return [$key, $category];
            }
        }

        return false;
    }

    private function searchSubcategoryByName($name)
    {
        foreach ($this->subcategories as $key => $subcategory) {
            if (preg_match("~({$name})~i", $subcategory['r_name']) && $subcategory['form_id'] == $this->formID) {
                return [$key, $subcategory];
            }
        }

        return false;
    }

    private function searchElementByName($name)
    {
        foreach ($this->elements as $key => $element) {
            if (preg_match("~({$name})~i", $element['r_name']) && $element['form_id'] == $this->formID) {
                return [$key, $element];
            }
        }

        return false;
    }

    // Возврат элементов по ID
    public function getCategoryByID($id)
    {
        return $this->categories[$id];
    }

    public function getSubcategoryByID($id)
    {
        return $this->subcategories[$id];
    }

    public function getElementByID($id)
    {
        return $this->elements[$id];
    }

    // Получение формы
    private function getFormByID($id)
    {
        return $this->db->select('*')->from('forms')->where('id', '=', $id)->execute();
    }

    private function getFormByOptions($space, $operation, $object)
    {
        $form = $this->db->select('*')->from('forms')->where('space_type', '=', $space)->where('object_type', '=', $object)->where('operation', '=', $operation)->execute();

        return $form ? $form : null;
    }

    // Обработка ошибок
    private function errorsHandler()
    {
        // Обработка подкатегорий
        foreach ($this->subcategories as $key => $subcategory) {
            if ($subcategory['form_id'] == $this->formID) {
                //если название элемента совпадает с названием категории, переносим в категорию
                foreach ($this->elements as $element) {
                    if ($element['subcategory'] == $subcategory['id']) {
                        if (preg_match("~(" . $element['r_name'] . ")~i", $subcategory['r_name'])) {
                            $category = $this->searchCategoryByID($subcategory['category_id']);
                            $this->transferElement($element['r_name'], self::ELEMENT, $category['r_name'], self::CATEGORY);
                        }
                    }
                }

                // Если в подкатегории нет ничего, удаляем ее
                $deleteSubcategory = true;
                foreach ($this->elements as $element) {
                    if ($element['subcategory'] == $subcategory['id']) {
                        $deleteSubcategory = false;
                    }
                }

                if ($deleteSubcategory) {
                    unset($this->subcategories[$key]);
                }
            }
        }

    }

    // Очистка пустых элементов
    private function clearEmpty()
    {
        foreach ($this->categories as $key => $category) {
            if ($category['form_id'] == $this->formID) {
                $deleteCategory = true;

                foreach ($this->subcategories as $subcategory) {
                    if ($subcategory['category_id'] == $category['id']) {
                        $deleteCategory = false;
                    }
                }

                foreach ($this->elements as $element) {
                    if ($element['category'] == $category['id']) {
                        $deleteCategory = false;
                    }
                }

                if ($deleteCategory) {
                    unset($this->categories[$key]);
                }
            }
        }
    }

    // Генерация формы
    public function build()
    {
        $this->formBody .= $this->formInfo;
        $this->formBody .= '<form action="" method="post">' . "\n";
        //Выводим категории
        foreach ($this->categories as $key => $category) {
            if ($category['form_id'] == $this->formID) {

                $this->formBody .= '<fieldset>' . "\n";
                $this->formBody .= '<legend>' . $category['r_name'] . '</legend><br>' . "\n";

                foreach ($this->subcategories as $subcategory) {
                    if ($subcategory['category_id'] == $category['id']) {

                        $this->formBody .= "<b style='box-sizing: border-box; margin-left: 20px'>" . $subcategory['r_name'] . "</b><br>" . "\n";

                        if (preg_match("~(Расположение)~i", $subcategory['r_name'])) {
                            // Выводим корректно расположение
                            $this->formBody .= '<input type="text" name="address" style="margin: 10px 0 10px 40px;" placeholder="Адрес..." id="suggest"><br>';
                            $this->formBody .= '<span style="margin-left: 40px">Страна: </span><br>';
                            $this->formBody .= '<span style="margin-left: 40px">Область: </span><br>';
                            $this->formBody .= '<span style="margin-left: 40px">Город: </span><br>';
                            $this->formBody .= '<span style="margin-left: 40px">Район: </span><br>';
                            $this->formBody .= '<span style="margin-left: 40px">Дом: </span><br>';
                            //Блок для карты Яндекс
                            $this->formBody .= '<div id="ymap" style="margin: 0 auto; width: 700px; height: 700px; background: #000;"></div>';

                            $this->formBody .= "
                            <script>
                                ymaps.ready(function () {
                                    var map = new ymaps.Map(\"ymap\", {
                                        center: [55.451332, 37.369336],
                                        zoom: 10,
                                        controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
                                    });

                                    window.suggests = new ymaps.SuggestView(\"suggest\", {width: 300, offset: [0, 4], results: 20});
                                });
                            </script>";
                            // Выводим элементы в расположении объекта исключая область и город
                            foreach ($this->elements as $element) {
                                if ($element['subcategory'] == $subcategory['id'] && !preg_match("~(область|город)~i", $element['r_name'])) {
                                    $this->formBody .= getElToString($element, $this->options, 40);
                                    foreach ($this->elements as $el) {
                                        if ($el['parent_el'] == $element['id']) {
                                            $this->formBody .= getElToString($el, $this->options, 60);
                                        }
                                    }
                                }
                            }
                        } elseif (preg_match("~(Наличие лифта)~i", $subcategory['r_name'])) {
                            // Корректный вывод элемента "Наличие лифта"
                            $result = '';
                            $result .= '<select style="margin-left: ' . 20 . 'px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '" id="' . $subcategory['e_name'] . '">' . "\n";
                            $result .= '<option value="1">Да</option>';
                            $result .= '<option value="0">Нет</option>';
                            $result .= '</select><br>' . "\n";
                            $this->formBody .= $result;
                            foreach ($this->elements as $element) {
                                if ($element['subcategory'] == $subcategory['id'] && preg_match("~(Да)~i", $element['r_name'])) {
                                    $result = '';
                                    $result .= '<select style="margin-left: ' . 20 . 'px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '_yes" id="' . $subcategory['e_name'] . '_yes">' . "\n";
                                    foreach ($this->options as $option) {
                                        if ($option['element_id'] == $element['id']) {
                                            $result .= '<option value="' . $option['value'] . '">' . $option['r_name'] . '</option>' . "\n";
                                        }
                                    }
                                    $result .= '</select><br>' . "\n";
                                    $this->formBody .= $result;
                                }
                            }
                        } elseif (preg_match("~(Ограждение)~i", $subcategory['r_name'])) {
                            // Корректный вывод элемента "Наличие лифта"
                            $result = '';
                            $result .= '<select style="margin-left: ' . 20 . 'px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '" id="' . $subcategory['e_name'] . '">' . "\n";
                            $result .= '<option value="1">Да</option>';
                            $result .= '<option value="0">Нет</option>';
                            $result .= '</select><br>' . "\n";
                            $this->formBody .= $result;

                            foreach ($this->elements as $element) {
                                if ($element['subcategory'] == $subcategory['id'] && preg_match("~(Материал)~i", $element['r_name'])) {
                                    $result = '';
                                    $result .= '<select style="margin-left: 40px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '_yes" id="' . $subcategory['e_name'] . '_yes">' . "\n";
                                    foreach ($this->options as $option) {
                                        if ($option['element_id'] == $element['id']) {
                                            $result .= '<option value="' . $option['value'] . '">' . $option['r_name'] . '</option>' . "\n";
                                        }
                                    }
                                    $result .= '</select><br>' . "\n";
                                    $this->formBody .= $result;
                                }
                            }
                        } else {
                            foreach ($this->elements as $element) {
                                if ($element['subcategory'] == $subcategory['id']) {
                                    $this->formBody .= getElToString($element, $this->options, 40);
                                    foreach ($this->elements as $el) {
                                        if ($el['parent_el'] == $element['id']) {
                                            echo getElToString($el, $this->options, 60);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                foreach ($this->elements as $element) {
                    if ($element['category'] == $category['id']) {
                        if (preg_match("~(Комнаты)~i", $element['r_name'])) {
                            // Корректно выводим комнаты
                            $result = '';
                            $result .= '<span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
                            foreach ($this->options as $option) {
                                if ($option['element_id'] == $element['id']) {
                                    $result .= '<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                }
                            }
                            $this->formBody .= $result;
                        } elseif (preg_match("~(Безопасность)~i", $element['r_name'])) {
                            // Корректно выводим "Безопасность"
                            $result = '';
                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
                            foreach ($this->options as $option) {
                                if ($option['element_id'] == $element['id']) {
                                    $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                }
                            }
                            $this->formBody .= $result;
                        } elseif (preg_match("~(На участке)~i", $element['r_name'])) {
                            // Корректно выводим "Безопасность"
                            $result = '';
                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
                            foreach ($this->options as $option) {
                                if ($option['element_id'] == $element['id']) {
                                    $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                }
                            }
                            $this->formBody .= $result;
                        } elseif (preg_match("~(Дополнительные строения)~i", $element['r_name'])) {
                            // Корректно выводим "Безопасность"
                            $result = '';
                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
                            foreach ($this->options as $option) {
                                if ($option['element_id'] == $element['id']) {
                                    $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                }
                            }
                            $this->formBody .= $result;
                        } elseif (preg_match("~(Жилищно-коммунальные услуги)~i", $element['r_name'])) {
                            // Корректно выводим "Жилищно-коммунальные услуги"
                            $result = '';
                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
                            foreach ($this->options as $option) {
                                if ($option['element_id'] == $element['id']) {
                                    $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                }
                            }
                            $this->formBody .= $result;
                        } else {
                            $this->formBody .= getElToString($element, $this->options, 20);
                            foreach ($this->elements as $el) {
                                if ($el['parent_el'] == $element['id']) {
                                    $this->formBody .= getElToString($el, $this->options, 40);
                                }
                            }
                        }
                    }
                }

                $this->formBody .= '<br>';
                $this->formBody .= '</fieldset><br>';
            }
        }

        $this->formBody .= '<input type="submit" name="submit" value="Найти"><br>';
        $this->formBody .= '</form>';

        return $this->formBody;
    }
//
//    private function clear()
//    {
//        $this->formBody = '';
//    }
//
//    private function writeToFile($form_id)
//    {
//        $file = fopen(ROOT_DIR . '/forms/' . $form_id . '.php', 'w+');
//        chmod(ROOT_DIR . '/forms/' . $form_id . '.php', 0777);
//
//        fwrite($file, $this->formBody);
//        fclose($file);
//    }
//
//    public function writeForms($space_types, $operation_types, $object_types)
//    {
////        foreach ($this->data['forms'] as $form) {
////            foreach ($this->data['types']['space_types'] as $space_type) {
////                if (preg_match("~(Жилая)~i", $space_type['r_name'])) {
////                    foreach ($this->data['types']['operation_types'] as $operation_type) {
////                        if (preg_match("~(Арендовать)~i", $operation_type['r_name'])) {
////                            foreach ($this->data['types']['object_types'] as $object_type) {
////                                if ($form['space_type'] == $space_type['id'] && $form['operation'] == $operation_type['id'] && $form['object_type'] == $object_type['id']) {
////                                    echo '<a href="/forms_gen/' . $form['id'] . '" class="button ' . (!empty($this->data['id']) ? $form['id'] == $this->data['id'] ? 'active' : '' : '') . '">' . $space_type['r_name'] . '/' . $operation_type['r_name'] . '/' . $object_type['r_name'] . '</a><br>';
////                                }
////                            }
////                        }
////                    }
////                }
////            }
////        }
//
//        echo 'Work!';
//
//        foreach ($space_types as $space_type) {
//            if (preg_match("~(Жилая)~i", $space_type['r_name'])) {
//                foreach ($object_types as $object_type) {
//                    foreach ($operation_types as $operation_type) {
//                        if (preg_match("~(Купить)~i", $operation_type['r_name'])) {
//                            $this->form = $this->getFormByOptions($space_type['id'], $operation_type['id'], $object_type['id']);
//
//                            if ($this->form) {
//                                $this->formInfo = "{$space_type['r_name']} - {$operation_type['r_name']} - {$object_type['r_name']}\n<br>";
//                                $this->formID = $this->form[0]['id'];
//                                $this->transferElement("Объект размещен", FormGenerator::ELEMENT, "Базовый раздел", FormGenerator::CATEGORY);
//                                $this->transferElement("Жилая", FormGenerator::ELEMENT, "Площадь", FormGenerator::SUBCATEGORY);
//                                $this->transferElement("Кровля", FormGenerator::ELEMENT, "Исходные параметры", FormGenerator::CATEGORY);
//                                $this->transferElement("Торг", FormGenerator::ELEMENT, "Базовый раздел", FormGenerator::CATEGORY);
//                                $this->transferElement("Высота потолков:", FormGenerator::ELEMENT, "Основное", FormGenerator::CATEGORY);
//                                $this->clear();
//                                $this->build();
//                                $this->writeToFile($this->form[0]['id']);
//                                $this->clear();
//                            }
//
//                            //echo $this->form[0]['id'] . "<br>\n";
//                        }
//                    }
//                }
//            }
//        }
//    }
}