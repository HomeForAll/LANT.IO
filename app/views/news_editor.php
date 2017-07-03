<?php
$this->title = 'Редактор объявлений';

global $data_for_news;
$data_for_news = $this->data;

function inputToInput($item = '') {
    global $data_for_news;

    if ($item != '') {
        if (!empty($data_for_news[$item])) {
            echo 'value="' . $data_for_news[$item] . '"';
        }
    }
}

function inputToCheckbox($item = '') {
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

function inputToSelect($item = '', $selection = NULL) {
    global $data_for_news;

    if ($item != '' && !empty($data_for_news[$item])) {
        if ($data_for_news[$item] == $selection) {
            echo 'selected';
        }
    }
}

function inputToRadio($item = '', $selection = NULL) {
    global $data_for_news;

    if ($item != '' && !empty($data_for_news[$item])) {
        if ($data_for_news[$item] == $selection) {
            echo 'checked';
        }
    }
}
//Проверка на выбор Другое в Select
//должен присутствовать option value="Другое"
function inputOtherSelect($item = '', $arr =[] ) {
    global $data_for_news;

    if ($item != '' && !empty($data_for_news[$item])) {
        if (!empty($data_for_news[$item]) && !(in_array($data_for_news[$item], $arr))) {
            echo 'selected';
        }
    }
}
function addClassOtherInput($item = '', $arr =[]) {
    global $data_for_news;

    if ($item != '') {
        if (!empty($data_for_news[$item]) && !(in_array($data_for_news[$item], $arr))) {
            echo 'showOtherInput_show';
        }
    }
}

?>
<h1>Редактор новостей</h1>
<?php
//Вывод сообщений
if (!empty($this->data['error'])) {
        echo '<span style="color: red">' . $this->data['error'] . '</span><br>';
}
if (!empty($this->data['message'])) {
        echo '<span style="color: green">' . $this->data['message'] . '</span><br>';
}

// Вывод меню или формы
if (!isset($this->data['form_name'])){
    $this->model('NewsModel')->renderNewsEditorMenu();
}else {
    ?>

    <form id="editor_form" class="main_editor_form" enctype="multipart/form-data" action="" method="post">
        <input type="hidden" name="form_name" value="<?php echo $this->data['form_name']; ?>">
        <input type="hidden" name="space_type" value="<?php echo $this->data['space_type']; ?>">
        <input type="hidden" name="operation_type" value="<?php echo $this->data['operation_type']; ?>">
        <input type="hidden" name="object_type" value="<?php echo $this->data['object_type']; ?>">


        <fieldset>
            <legend>Название</legend>
            <section>
                <label>Название новости*:
                    <input name="title" type="text" <?php inputToInput('title'); ?>>
                </label>

            </section>
        </fieldset>

        <!-- Карта -->


        <!-- Вставляемые блоки -->
        <?php
        if (!empty($this->data['form_path'])) {
            if ($this->data['form_path'] != 'base') {
                include_once $this->data['form_path'];
            } else {
                echo '<input type="hidden" name="form_name" value="1">';
            }
        }
        ?>


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

    <?php } // Вывод меню или формы (конец)?>


<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<script src="/template/js/mapController.js"></script>

    <script type="text/javascript" src="/template/js/jquery.validate.js"></script>
    <script type="text/javascript" src="/template/js/news_javascript.js"></script>
    <script type="text/javascript" src="/template/js/map.for.news.js"></script>

