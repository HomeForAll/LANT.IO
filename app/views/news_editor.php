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

function addClassCheckbox($item = '') {
    global $data_for_news;

    if ($item != '') {
        if (!empty($data_for_news[$item])) {
            echo 'showСheckboxInput_show';
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
    foreach ($this->data['error'] as $error) {
        echo '<span style="color: red">' . $error . '</span><br>';
    }
}
if (!empty($this->data['message'])) {
    foreach ($this->data['message'] as $message) {
        echo '<span style="color: green">' . $message . '</span><br>';
    }
}
?>

<form  id="editor_form" class="main_editor_form" enctype="multipart/form-data" action="" method="post">
<input type="hidden" name="category" value="<?php echo $this->data['category']; ?>">



    


    <fieldset>
        <legend>Название</legend>
        <section>
            <label>Название новости*:
                <input name="title" type="text" <?php inputToInput('title'); ?>>
            </label>

        </section>
    </fieldset>


<!--    <fieldset>
        <legend>Проба карты</legend>
        <div id="map" style="position: relative; width: 500px; height: 500px;"></div>
    </fieldset>-->

<!--<fieldset>
                Расположение:
            <br>
            <input type="text" id="rentApartSuggest" placeholder="Адрес ..." style="padding: 10px; width: 477px; position: relative; left: 50%; margin: 0 0 0 -250px;" oninput="getGeoCoderData(this.value, 'rentApartMap')" onkeypress="pressEnter();">
            <div id="rentApartMap" style="position: relative; left: 50%; margin: 20px 0 0 -250px; width: 500px; height: 500px"></div>
            

            <div class="indent">
                <label for="rentApartSpanCountry">Страна:</label> <span id="rentApartSpanCountry"></span>
                <br>
                <label for="rentApartSpanArea">Область:</label> <span id="rentApartSpanArea"></span>
                <br>
                <label for="rentApartSpanCity">Город:</label> <span id="rentApartSpanCity"></span>
                <br>
                <label for="rentApartSpanRegion">Район:</label> <span id="rentApartSpanRegion"></span>
                <br>
                <label for="rentApartSpanStreet">Улица:</label> <span id="rentApartSpanStreet"></span>
                <br>

                <input id="rentApartCountry" type="hidden" name="country" value="">
                <input id="rentApartArea" type="hidden" name="area" value="">
                <input id="rentApartCity" type="hidden" name="city" value="">
                <input id="rentApartRegion" type="hidden" name="region" value="">
                <input id="rentApartStreet" type="hidden" name="street" value="">

                Станция метро:
                <br>
                <div class="indent">
                    Удаленность от метро:
                    <input type="text" name="metroMin" placeholder="Мин.">
                    <input type="text" name="metroMax" placeholder="Макс.">
                    <br>
                </div>
            </div>


</fieldset>-->






    <!-- Вставляемые блоки -->
    <?php
    if (!empty($this->data['category'])) {
        if ($this->data['category'] != 'base') {
            include_once 'app/views/news_'.$this->data['category'].'.php';
        } else {
            echo '<input type="hidden" name="category" value="1">';
        }
    }
    ?>





    <!-- Долнительная информация -->
    <fieldset>
        <legend>Долнительная информация</legend>
        <section>
            <label>Короткое содержание: 
                <textarea name="short_content" type="text"><?php
                    if (!empty($this->data['short_content'])) {
                        echo $this->data['short_content'];
                    }
                    ?></textarea>
            </label>
        </section>
        <section>
            <label >Основное содержание: 
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
            <label>  Статус новости: 
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
            <div>Вы можете выбрать 5 файлов для загрузки. </div>
            <div id="inputImageContainer">

                <div id="addDynamicField">
                    <input type="button" id="addFieldButton" value="Добавить Фотографию:">
                    <div id="imageMessage"><?php if (!empty($this->data["preview_img"][0])) { ?> Вы можете загрузить ещё: <?php  echo (5-count($this->data["preview_img"])); ?> фотографий. <?php } ?></div>
                </div>
                
           <?php 
           // Вывод уже имеющихся фотографий
            if (!empty($this->data["preview_img"][0])) {
            foreach ($this->data["preview_img"] as $k => $img) {
               $i = $k+1; ?>
               <div class="imgInput imgInput_<?php echo $i; ?>">
                    <label>Выберите  фотографию: <?php echo $i; ?></label>
                <br>
                <img id="img-preview_<?php echo $i; ?>" src="/uploads/images/s_<?php echo $img; ?>">
                <input type="file" id="image_input_<?php echo $i; ?>" name="image_name_<?php echo $i.'_saved_'; ?>" class="inputfile" onchange="{document.getElementById(&quot;img-preview_<?php echo $i; ?>&quot;).src = window.URL.createObjectURL(this.files[0]);document.getElementById(&quot;image_input_<?php echo $i; ?>&quot;).setAttribute('name', &quot;image_name_<?php echo $i; ?>&quot;);}">
                <br>
                <input value="Удаление" type="button" class="DeleteField">
            </div>
           <?php    
            } }
           ?>
            
      

            </div>
        </section>
    </fieldset>



    <input type="submit" name="submit_editor" value="Записать новость"> <a href="/news/editor">Отмена</a>
</form>  






<script type="text/javascript" src="/templates/main/js/jquery.validate.js"></script>
<script type="text/javascript" src="/templates/main/js/news_javascript.js"></script> 

