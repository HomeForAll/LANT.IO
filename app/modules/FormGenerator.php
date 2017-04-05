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
    public function transferSubject($name, $type, $nameTo, $typeTo)
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

    private function transferSubcategoryToCategory($subcategoryName, $categoryName)
    {
        $subject = $this->searchSubcategoryByName($subcategoryName);
        $to = $this->searchCategoryByName($categoryName);
        $id = $subject[0];

        if ($subject && $to) {
            $this->clearPosition($id, self::SUBCATEGORY);
            $this->subcategories[$id]['category_id'] = $to[1]['id'];
        }
    }

    private function transferElementToCategory($elementName, $categoryName)
    {
        $subject = $this->searchElementByName($elementName);
        $to = $this->searchCategoryByName($categoryName);
        $id = $subject[0];

        if ($subject && $to) {
            $this->clearPosition($id, self::ELEMENT);
            $this->elements[$id]['category'] = $to[1]['id'];
        }
    }

    private function transferElementToSubcategory($elementName, $subcategoryName)
    {
        $subject = $this->searchElementByName($elementName);
        $to = $this->searchCategoryByName($subcategoryName);
        $id = $subject[0];

        if ($subject && $to) {
            $this->clearPosition($id, self::ELEMENT);
            $this->elements[$id]['subcategory'] = $to[1]['id'];
        }
    }

    private function transferElementToElement($elementName, $parentElementName)
    {
        $subject = $this->searchElementByName($elementName);
        $to = $this->searchCategoryByName($parentElementName);
        $id = $subject[0];

        if ($subject && $to) {
            $this->clearPosition($id, self::ELEMENT);
            $this->elements[$id]['parent_el'] = $to[1]['id'];
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
        $query = $this->db->query("SELECT * FROM forms WHERE id = {$id}");

        return $query->fetchAll();
    }

    private function getFormByOptions($space, $operation, $object)
    {
        //  $form = $this->db->select('*')->from('forms')->where('space_type', '=', $space)->where('object_type', '=', $object)->where('operation', '=', $operation)->execute();
        $query = $this->db->prepare("SELECT * FROM forms WHERE space_type = '{$space}' AND object_type = '{$object}' AND operation = '{$operation}'");
        $query->execute();

        $result = $query->fetchAll();

        return $result ? $result : null;
    }

    // Обработка ошибок
    private function errorsHandler()
    {
//        // Обработка подкатегорий
//        foreach ($this->subcategories as $key => $subcategory) {
//            if ($subcategory['form_id'] == $this->formID) {
//                //если название элемента совпадает с названием категории, переносим в категорию
//                foreach ($this->elements as $element) {
//                    if ($element['subcategory'] == $subcategory['id']) {
//                        if (preg_match("~(" . $element['r_name'] . ")~i", $subcategory['r_name'])) {
//                            $category = $this->searchCategoryByID($subcategory['category_id']);
//                            $this->transferSubject($element['r_name'], self::ELEMENT, $category['r_name'], self::CATEGORY);
//                        }
//                    }
//                }
//
//                // Если в подкатегории нет ничего, удаляем ее
//                $deleteSubcategory = true;
//                foreach ($this->elements as $element) {
//                    if ($element['subcategory'] == $subcategory['id']) {
//                        $deleteSubcategory = false;
//                    }
//                }
//
//                if ($deleteSubcategory) {
//                    unset($this->subcategories[$key]);
//                }
//            }
//        }

//        foreach ($this->categories as $key => $category) {
//            $delete = true;
//
//            foreach ($this->subcategories as $subcategory) {
//                if ($subcategory['category_id'] == $category['id']) {
//                    $delete = false;
//                    var_dump($category['r_name']);
//                }
//            }
//
//            foreach ($this->elements as $element) {
//                if ($element['category'] == $category['id']) {
//                    $delete = false;
//                    var_dump($category['r_name']);
//                }
//            }
//
//            if ($delete) {
//                unset($this->elements[$key]);
//            }
//        }

    }

    // Очистка пустых элементов
//    private function clearEmpty()
//    {
//        foreach ($this->categories as $key => $category) {
//            if ($category['form_id'] == $this->formID) {
//                $deleteCategory = true;
//
//                foreach ($this->subcategories as $subcategory) {
//                    if ($subcategory['category_id'] == $category['id']) {
//                        $deleteCategory = false;
//                    }
//                }
//
//                foreach ($this->elements as $element) {
//                    if ($element['category'] == $category['id']) {
//                        $deleteCategory = false;
//                    }
//                }
//
//                if ($deleteCategory) {
//                    unset($this->categories[$key]);
//                }
//            }
//        }
//    }

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
                                    if (preg_match("~(Удаленность от МКАД/метро)~i", $element['r_name'])) {
                                        $element['type'] = 1;
                                    }

                                    $this->formBody .= getElToString($element, $this->options, 40);
                                    foreach ($this->elements as $el) {
                                        if ($el['parent_el'] == $element['id']) {
                                            $this->formBody .= getElToString($el, $this->options, 60);
                                        }
                                    }

                                }
                            }
                        } elseif (preg_match("~(Жилищно-коммунальные услуги)~i", $subcategory['r_name'])) {
                            // Корректно выводим "Жилищно-коммунальные услуги"
                            $element = $this->searchElementByID(700);

                            $result = '';
                            //$result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
                            foreach ($this->options as $option) {
                                if ($option['element_id'] == $element['id']) {
                                    if (preg_match("~(Электричество)~i", $option['r_name'])) {
                                        $result .= '<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                        $result .= '<label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="' . $option['e_name'] . '">Кол-во кВт:</label><br>' . "\n";
                                        $result .= '<input name="' . $option['e_name'] . '-min" type="text" placeholder="от" style="margin-left: 60px; box-sizing: border-box;">';
                                        $result .= '<input name="' . $option['e_name'] . '-max" type="text" placeholder="до" style="margin-left: 60px; box-sizing: border-box;"><br>';
                                    } elseif (preg_match("~(Водопровод и канализация)~i", $option['r_name'])) {
                                        $result .= '
<label for="sanitation" style="margin-left: 40px;">Водопровод и канализация</label><br>
<select name="sanitation" id="sanitation" style="margin-left: 40px;">
    <option value="47">Есть</option>
    <option value="84">Нет</option>
</select><br>
<label style="margin-left: 60px;">Возможность проводки <input type="checkbox" name="possible_to_post"></label><br>
<label style="margin-left: 60px;">Описание <input type="checkbox" name="sanitation_description"></label><br>';
                                    } elseif (preg_match("~(Наличие санузлов)~i", $option['r_name'])) {
                                        // корректно выводим санузлы
                                        $result .= '
<label for="sanitation" style="margin-left: 40px;">Наличие санузлов</label><br>';
                                        $result .= '<label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="">Количество:</label><br>' . "\n";
                                        $result .= '<input name="bathroom_number-min" type="text" placeholder="от" style="margin-left: 60px; box-sizing: border-box;">';
                                        $result .= '<input name="bathroom_number-max" type="text" placeholder="до" style="margin-left: 60px; box-sizing: border-box;"><br>';

                                        $result .= '<label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="">Расположение:</label><br>' . "\n";
                                        $result .= '<select name="bathroom_location" id="sanitation" style="margin-left: 60px;">
                                                        <option value="">---</option>
                                                     </select><br>
                                        <label style="margin-left: 60px;">Описание <input type="checkbox" name="bathroom_description"></label><br>';
                                    } else {
                                        $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                    }
                                }
                            }
                            $this->formBody .= $result;

                            foreach ($this->elements as $el) {
                                if ($el['parent_el'] == $element['id']) {
                                    if (preg_match("~(Электричество)~i", $el['r_name'])) {
                                        continue;
                                    } elseif (preg_match("~(Водопровод и канализация)~i", $el['r_name'])) {
                                        continue;
                                    } elseif (preg_match("~(Наличие санузлов)~i", $el['r_name'])) {
                                        continue;
                                    } else {
                                        $this->formBody .= getElToString($el, $this->options, 40);
                                    }
                                }
                            }
                        } elseif (preg_match("~(Договор аренды)~i", $subcategory['r_name']) || preg_match("~(Документы на право владения)~i", $subcategory['r_name'])) {
                            $this->formBody .= '<label style="margin-left: 40px;">' . $subcategory['r_name'] . ' <input type="checkbox" name="' . $subcategory['e_name'] . '"></label><br>';
                        } else {
                            foreach ($this->elements as $element) {
                                if ($element['subcategory'] == $subcategory['id']) {
                                    //$this->formBody .= 'Element-id: ' . $element['id'] . '<br>';
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
                        if (preg_match("~(Безопасность)~i", $element['r_name'])) {
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
                            $element = $this->searchElementByID(700);

                            $result = '';
                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
                            foreach ($this->options as $option) {
                                if ($option['element_id'] == $element['id']) {
                                    if (preg_match("~(Электричество)~i", $option['r_name'])) {
                                        $result .= '<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                        $result .= '<label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="' . $option['e_name'] . '">Кол-во кВт:</label><br>' . "\n";
                                        $result .= '<input name="' . $option['e_name'] . '-min" type="text" placeholder="от" style="margin-left: 60px; box-sizing: border-box;">';
                                        $result .= '<input name="' . $option['e_name'] . '-max" type="text" placeholder="до" style="margin-left: 60px; box-sizing: border-box;"><br>';
                                    } elseif (preg_match("~(Водопровод и канализация)~i", $option['r_name'])) {
                                        $result .= '
<label for="sanitation" style="margin-left: 40px;">Водопровод и канализация</label><br>
<select name="sanitation" id="sanitation" style="margin-left: 40px;">
    <option value="47">Есть</option>
    <option value="84">Нет</option>
</select><br>
<label style="margin-left: 60px;">Возможность проводки <input type="checkbox" name="possible_to_post"></label><br>
<label style="margin-left: 60px;">Описание <input type="checkbox" name="sanitation_description"></label><br>';
                                    } elseif (preg_match("~(Наличие санузлов)~i", $option['r_name'])) {
                                        // корректно выводим санузлы
                                        $result .= '
<label for="sanitation" style="margin-left: 40px;">Наличие санузлов</label><br>';
                                        $result .= '<label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="">Количество:</label><br>' . "\n";
                                        $result .= '<input name="bathroom_number-min" type="text" placeholder="от" style="margin-left: 60px; box-sizing: border-box;">';
                                        $result .= '<input name="bathroom_number-max" type="text" placeholder="до" style="margin-left: 60px; box-sizing: border-box;"><br>';

                                        $result .= '<label style="margin-left: 60px; box-sizing: border-box; font-weight: normal;" for="">Расположение:</label><br>' . "\n";
                                        $result .= '<select name="bathroom_location" id="sanitation" style="margin-left: 60px;">
                                                        <option value="">---</option>
                                                     </select><br>
                                        <label style="margin-left: 60px;">Описание <input type="checkbox" name="bathroom_description"></label><br>';
                                    } else {
                                        $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
                                    }
                                }
                            }
                            $this->formBody .= $result;

                            foreach ($this->elements as $el) {
                                if ($el['parent_el'] == $element['id']) {
                                    if (preg_match("~(Электричество)~i", $el['r_name'])) {
                                        continue;
                                    } elseif (preg_match("~(Водопровод и канализация)~i", $el['r_name'])) {
                                        continue;
                                    } elseif (preg_match("~(Наличие санузлов)~i", $el['r_name'])) {
                                        continue;
                                    } else {
                                        $this->formBody .= getElToString($el, $this->options, 40);
                                    }
                                }
                            }
                        } elseif (preg_match("~(Парковка)~i", $element['r_name'])) {
                            // Корректно выводим "Парковка"
                            $element = $this->searchElementByID(698);

                            //$this->formBody .= "element-id: {$element['id']}<br>";
                            $this->formBody .= getElToString($element, $this->options, 20);
                            foreach ($this->elements as $el) {
                                if ($el['parent_el'] == $element['id']) {
                                    $this->formBody .= getElToString($el, $this->options, 40);
                                }
                            }
                        } else {
                            //$this->formBody .= "element-id: {$element['id']}<br>";
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

//    public function build()
//    {
//        $this->formBody .= $this->formInfo;
//        $this->formBody .= '<form action="" method="post">' . "\n";
//        //Выводим категории
//        foreach ($this->categories as $key => $category) {
//            if ($category['form_id'] == $this->formID) {
//
//                $this->formBody .= '<fieldset>' . "\n";
//                $this->formBody .= '<legend>' . $category['r_name'] . '</legend><br>' . "\n";
//
//                foreach ($this->subcategories as $subcategory) {
//                    if ($subcategory['category_id'] == $category['id']) {
//
//                        $this->formBody .= "<b style='box-sizing: border-box; margin-left: 20px'>" . $subcategory['r_name'] . "</b><br>" . "\n";
//
//                        if (preg_match("~(Расположение)~i", $subcategory['r_name'])) {
//                            // Выводим корректно расположение
//                            $this->formBody .= '<input type="text" name="address" style="margin: 10px 0 10px 40px;" placeholder="Адрес..." id="suggest"><br>';
//                            $this->formBody .= '<span style="margin-left: 40px">Страна: </span><br>';
//                            $this->formBody .= '<span style="margin-left: 40px">Область: </span><br>';
//                            $this->formBody .= '<span style="margin-left: 40px">Город: </span><br>';
//                            $this->formBody .= '<span style="margin-left: 40px">Район: </span><br>';
//                            $this->formBody .= '<span style="margin-left: 40px">Дом: </span><br>';
//                            //Блок для карты Яндекс
//                            $this->formBody .= '<div id="ymap" style="margin: 0 auto; width: 700px; height: 700px; background: #000;"></div>';
//
//                            $this->formBody .= "
//                            <script>
//                                ymaps.ready(function () {
//                                    var map = new ymaps.Map(\"ymap\", {
//                                        center: [55.451332, 37.369336],
//                                        zoom: 10,
//                                        controls: ['fullscreenControl', 'typeSelector', 'geolocationControl', 'zoomControl']
//                                    });
//
//                                    window.suggests = new ymaps.SuggestView(\"suggest\", {width: 300, offset: [0, 4], results: 20});
//                                });
//                            </script>";
//                            // Выводим элементы в расположении объекта исключая область и город
//                            foreach ($this->elements as $element) {
//                                if ($element['subcategory'] == $subcategory['id'] && !preg_match("~(область|город)~i", $element['r_name'])) {
//                                    $this->formBody .= getElToString($element, $this->options, 40);
//                                    foreach ($this->elements as $el) {
//                                        if ($el['parent_el'] == $element['id']) {
//                                            $this->formBody .= getElToString($el, $this->options, 60);
//                                        }
//                                    }
//                                }
//                            }
//                        } elseif (preg_match("~(Наличие лифта)~i", $subcategory['r_name'])) {
//                            // Корректный вывод элемента "Наличие лифта"
//                            $result = '';
//                            $result .= '<select style="margin-left: ' . 20 . 'px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '" id="' . $subcategory['e_name'] . '">' . "\n";
//                            $result .= '<option value="1">Да</option>';
//                            $result .= '<option value="0">Нет</option>';
//                            $result .= '</select><br>' . "\n";
//                            $this->formBody .= $result;
//                            foreach ($this->elements as $element) {
//                                if ($element['subcategory'] == $subcategory['id'] && preg_match("~(Да)~i", $element['r_name'])) {
//                                    $result = '';
//                                    $result .= '<select style="margin-left: ' . 20 . 'px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '_yes" id="' . $subcategory['e_name'] . '_yes">' . "\n";
//                                    foreach ($this->options as $option) {
//                                        if ($option['element_id'] == $element['id']) {
//                                            $result .= '<option value="' . $option['value'] . '">' . $option['r_name'] . '</option>' . "\n";
//                                        }
//                                    }
//                                    $result .= '</select><br>' . "\n";
//                                    $this->formBody .= $result;
//                                }
//                            }
//                        } elseif (preg_match("~(Ограждение)~i", $subcategory['r_name'])) {
//                            // Корректный вывод элемента "Наличие лифта"
//                            $result = '';
//                            $result .= '<select style="margin-left: ' . 20 . 'px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '" id="' . $subcategory['e_name'] . '">' . "\n";
//                            $result .= '<option value="1">Да</option>';
//                            $result .= '<option value="0">Нет</option>';
//                            $result .= '</select><br>' . "\n";
//                            $this->formBody .= $result;
//
//                            foreach ($this->elements as $element) {
//                                if ($element['subcategory'] == $subcategory['id'] && preg_match("~(Материал)~i", $element['r_name'])) {
//                                    $result = '';
//                                    $result .= '<select style="margin-left: 40px; box-sizing: border-box;" name="' . $subcategory['e_name'] . '_yes" id="' . $subcategory['e_name'] . '_yes">' . "\n";
//                                    foreach ($this->options as $option) {
//                                        if ($option['element_id'] == $element['id']) {
//                                            $result .= '<option value="' . $option['value'] . '">' . $option['r_name'] . '</option>' . "\n";
//                                        }
//                                    }
//                                    $result .= '</select><br>' . "\n";
//                                    $this->formBody .= $result;
//                                }
//                            }
//                        } else {
//                            foreach ($this->elements as $element) {
//                                if ($element['subcategory'] == $subcategory['id']) {
//                                    $this->formBody .= getElToString($element, $this->options, 40);
//                                    foreach ($this->elements as $el) {
//                                        if ($el['parent_el'] == $element['id']) {
//                                            echo getElToString($el, $this->options, 60);
//                                        }
//                                    }
//                                }
//                            }
//                        }
//                    }
//                }
//
//                foreach ($this->elements as $element) {
//                    if ($element['category'] == $category['id']) {
//                        if (preg_match("~(Комнаты)~i", $element['r_name'])) {
//                            // Корректно выводим комнаты
//                            $result = '';
//                            $result .= '<span style="margin-left: 20px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
//                            foreach ($this->options as $option) {
//                                if ($option['element_id'] == $element['id']) {
//                                    $result .= '<label style="margin-left: 40px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
//                                }
//                            }
//                            $this->formBody .= $result;
//                        } elseif (preg_match("~(Безопасность)~i", $element['r_name'])) {
//                            // Корректно выводим "Безопасность"
//                            $result = '';
//                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
//                            foreach ($this->options as $option) {
//                                if ($option['element_id'] == $element['id']) {
//                                    $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
//                                }
//                            }
//                            $this->formBody .= $result;
//                        } elseif (preg_match("~(На участке)~i", $element['r_name'])) {
//                            // Корректно выводим "Безопасность"
//                            $result = '';
//                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
//                            foreach ($this->options as $option) {
//                                if ($option['element_id'] == $element['id']) {
//                                    $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
//                                }
//                            }
//                            $this->formBody .= $result;
//                        } elseif (preg_match("~(Дополнительные строения)~i", $element['r_name'])) {
//                            // Корректно выводим "Безопасность"
//                            $result = '';
//                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
//                            foreach ($this->options as $option) {
//                                if ($option['element_id'] == $element['id']) {
//                                    $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
//                                }
//                            }
//                            $this->formBody .= $result;
//                        } elseif (preg_match("~(Жилищно-коммунальные услуги)~i", $element['r_name'])) {
//                            // Корректно выводим "Жилищно-коммунальные услуги"
//                            $result = '';
//                            $result .= '<span style="margin-left: ' . 20 . 'px; box-sizing: border-box; font-weight: bold;">' . $element['r_name'] . '</span><br>' . "\n";
//                            foreach ($this->options as $option) {
//                                if ($option['element_id'] == $element['id']) {
//                                    $result .= '<label style="margin-left: ' . 40 . 'px; box-sizing: border-box; font-weight: normal;">' . $option['r_name'] . ' <input type="checkbox" name="' . $option['e_name'] . '"></label><br>' . "\n";
//                                }
//                            }
//                            $this->formBody .= $result;
//                        } else {
//                            $this->formBody .= getElToString($element, $this->options, 20);
//                            foreach ($this->elements as $el) {
//                                if ($el['parent_el'] == $element['id']) {
//                                    $this->formBody .= getElToString($el, $this->options, 40);
//                                }
//                            }
//                        }
//                    }
//                }
//
//                $this->formBody .= '<br>';
//                $this->formBody .= '</fieldset><br>';
//            }
//        }
//
//        $this->formBody .= '<input type="submit" name="submit" value="Найти"><br>';
//        $this->formBody .= '</form>';
//
//        return $this->formBody;
//    }

    private function clear()
    {
        $this->formBody = '';
    }

    private function writeToFile($form_id)
    {
        $file = fopen(ROOT_DIR . '/forms/' . $form_id . '.php', 'w+');
        chmod(ROOT_DIR . '/forms/' . $form_id . '.php', 0777);

        fwrite($file, $this->formBody);
        fclose($file);
    }

    public function writeForms($space_types, $operation_types, $object_types)
    {
//        foreach ($this->data['forms'] as $form) {
//            foreach ($this->data['types']['space_types'] as $space_type) {
//                if (preg_match("~(Жилая)~i", $space_type['r_name'])) {
//                    foreach ($this->data['types']['operation_types'] as $operation_type) {
//                        if (preg_match("~(Арендовать)~i", $operation_type['r_name'])) {
//                            foreach ($this->data['types']['object_types'] as $object_type) {
//                                if ($form['space_type'] == $space_type['id'] && $form['operation'] == $operation_type['id'] && $form['object_type'] == $object_type['id']) {
//                                    echo '<a href="/forms_gen/' . $form['id'] . '" class="button ' . (!empty($this->data['id']) ? $form['id'] == $this->data['id'] ? 'active' : '' : '') . '">' . $space_type['r_name'] . '/' . $operation_type['r_name'] . '/' . $object_type['r_name'] . '</a><br>';
//                                }
//                            }
//                        }
//                    }
//                }
//            }
//        }

        echo 'Work!';

        foreach ($space_types as $space_type) {
            if (preg_match("~(Нежилая)~i", $space_type['r_name'])) {
                foreach ($object_types as $object_type) {
                    foreach ($operation_types as $operation_type) {
                        if (preg_match("~(Арендовать)~i", $operation_type['r_name'])) {
                            $this->form = $this->getFormByOptions($space_type['id'], $operation_type['id'], $object_type['id']);

                            if ($this->form) {
                                $this->formInfo = "{$space_type['r_name']} - {$operation_type['r_name']} - {$object_type['r_name']}\n<br>";
                                $this->formID = $this->form[0]['id'];
                                $this->clear();

                                $this->transferSubject("Объект размещен", FormGenerator::ELEMENT, "Базовый раздел", FormGenerator::CATEGORY);
                                $this->transferSubject("Кровля", FormGenerator::ELEMENT, "Исходные параметры", FormGenerator::CATEGORY);
                                $this->transferSubject("Парковка", FormGenerator::ELEMENT, "Ремонт и обустройство", FormGenerator::CATEGORY);
                                $this->transferSubject("Расположение", FormGenerator::SUBCATEGORY, "Базовый раздел", FormGenerator::CATEGORY);

                                $this->build();
                                $this->writeToFile($this->form[0]['id']);
                                $this->clear();
                            }

                            //echo $this->form[0]['id'] . "<br>\n";
                        }
                    }
                }
            }
        }
    }
}