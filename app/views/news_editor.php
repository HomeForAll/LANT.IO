<?php
$this->title = 'Редактор новостей';


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

    <fieldset>
        <legend>Выбор категории для создания нового объявления</legend>
        <p> Продажа :
            <a href="/news/editor/saleapart">Квартира</a>
            <a href="/news/editor/salehouse">Дом</a>
            <a href="/news/editor/saleroom">Комната</a>
            <a href="/news/editor/saleland">Участок</a>
            <!--<a href="/news/editor/salepart">Доля</a>-->
        </p>

        <p> Сдать в аренду :
            <a href="/news/editor/rentapart">Квартира</a>
            <a href="/news/editor/renthouse">Дом</a>
            <a href="/news/editor/rentroom">Комната</a>
            <a href="/news/editor/rentland">Участок</a>
        </p>

    </fieldset>


    <fieldset>
        <legend>Название</legend>
        <section>
            <label>Название новости:
                <input name="title" type="text" <?php inputToInput('title'); ?>>
            </label>

        </section>
    </fieldset>


    <!-- Вставляемые блоки -->
    <?php
    if (!empty($this->data['editor_page_type'])) {
        if ($this->data['editor_page_type'] != 'base') {
            include_once 'app/views/news_' . $this->data['editor_page_type'] . '.php';
        } else {
            ?>
            <!-- По умолчанию базовый тип новостей -->
            <input type="hidden" name="news_object" value="base">
    <?php }
} ?>





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
                <textarea name="content" type="text"><?php
                    if (!empty($this->data['content'])) {
                        echo $this->data['content'];
                    }
                    ?></textarea>
            </label>
        </section>
        <section>
            <label>Категория:
                <select name="category" >
                    <?php for ($i = 0; (!empty($this->data['categories'][$i])); $i++) { ?>
                        <option <?php
                        if (!empty($this->data['category'])) {
                            if ($this->data['category'] == $this->data['categories'][$i]) {
                                echo 'selected';
                            }
                        }
                        ?> value="<?php echo $this->data['categories'][$i] ?>"><?php echo $this->data['categories'][$i] ?></option>
<?php } ?> 
                </select>
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
               <div class="fileInput_<?php echo $i; ?>">
                    <label>Выберите  фотографию: <?php echo $i; ?></label>
                <br>
                <img id="img-preview_<?php echo $i; ?>" src="/uploads/images/s_<?php echo $img; ?>">
                <input type="file" id="image_input_<?php echo $i; ?>" name="image_name_<?php echo $i.'_'.$img; ?>" class="inputfile" onchange="{document.getElementById(&quot;img-preview_<?php echo $i; ?>&quot;).src = window.URL.createObjectURL(this.files[0]);document.getElementById(&quot;image_input_<?php echo $i; ?>&quot;).setAttribute('name', &quot;image_name_<?php echo $i; ?>&quot;);}">
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




<!-- Список новостей для редактирования, изменения статуса или удаления -->
<form  id="status_frm" action="" method="post">
<?php
if (empty($this->data['id_news'])) {
    ?>

        <table border="1", cellspacing="0">

            <tr>

                <td> Дата </td>
                <td> Заголовок <br>(нажмите для редактирования новости) </td>
                <td> Автор </td>
                <td> Статус</td>
            </tr>

    <?php for ($i = 0; (!empty($this->data[$i])); $i++) { ?>   
                <tr>

                    <td><i> <?php echo $this->data[$i]['date']; ?></i> </td>
                    <td><a href="/news/editor/<?php echo $this->data[$i]['id_news']; ?>"> <?php echo $this->data[$i]['title']; ?> </a>
                        <p><b>Категория:</b> <?php echo $this->data[$i]['category']; ?> ; <b>Метки:</b>  <?php echo $this->data[$i]['tags']; ?> </p>
                    </td>
                    <td> <?php echo $this->data[$i]['author_name']; ?> </td>
                    <td>  
                        <input type="radio" name="status_<?php echo $this->data[$i]['id_news']; ?>" value="1" <?php
                               if ($this->data[$i]['status'] == 1) {
                                   echo "checked";
                               }
                               ?> > Видна 
                        <input type="radio" name="status_<?php echo $this->data[$i]['id_news']; ?>" value="0" <?php
                               if ($this->data[$i]['status'] == 0) {
                                   echo "checked";
                               }
                               ?> > Скрыта 
                        <input type="radio" name="status_<?php echo $this->data[$i]['id_news']; ?>" value="3"> Удаление 
                    </td>


                </tr>

               <?php } ?>  
        </table>
        <input type="hidden" id="stat_arr" name="stat_arr" value= "<?php
               if (!empty($this->data['stat_arr'])) {
                   echo $this->data['stat_arr'];
               }
               ?>" />
        <input type="submit" name="submit_status" value="Изменить статус"> <a href="/news/editor">Отмена</a>
<?php } ?>  
</form>




<script type="text/javascript" src="/templates/main/js/news_javascript.js"></script> 