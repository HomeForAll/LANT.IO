<?php
$this->title = 'Редактирование профиля';

?>
<style>
    .buttons {
        float: left;
        margin: 0;
        padding: 0;
        display: block;
        background: grey;
        width: 140px;
        text-align: center;
        line-height: 29px;
        text-decoration: none;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        border: solid 1px grey;
    }

    .dbbutton {
        float: left;
        margin-left: 15px;
        padding: 0;
        display: block;
        background: grey;
        width: 140px;
        text-align: center;
        text-decoration: none;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        border: solid 1px grey;
    }

    .dbbutton:hover {
        color: grey;
        background: white;
    }

    .buttons:hover {
        color: grey;
        background: white;
    }

    .real_buttons {
        display: block;
        background: grey;
        width: auto;
        text-align: center;
        text-decoration: none;
        color: white;
        border-radius: 10px;
        cursor: pointer;
        border: solid 1px grey;
        height: 30px;
    }

    .real_buttons:hover {
        color: grey;
        background: white;
    }

    .text {
        font-size: 16px;
        font-family: Arial;
    }

    table {
        width: 100%;
    }
</style>
<h1>Редактирование профиля</h1>

<form action="" method="post">
    <table>
        <tr>
            <td>
                <h3>Информация о пользователе</h3>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><label for="name">Имя:</label></td>
            <td>
                <input name="name" type="text" id="name"
                       value="<?php if (isset($this->data[0]['first_name'])) echo $this->data[0]['first_name'] ?>">
            </td>
            <td>
                <?php
                if ($error = Registry::get('name_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="surname">Фамилия:</label></td>
            <td>
                <input name="surname" type="text" id="surname"
                       value="<?php if (isset($this->data[0]['last_name'])) echo $this->data[0]['last_name'] ?>">
            </td>
            <td>
                <?php
                if ($error = Registry::get('surname_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="patronymic">Отчество:</label></td>
            <td>
                <input name="patronymic" type="text" id="patronymic"
                       value="<?php if (isset($this->data[0]['patronymic'])) echo $this->data[0]['patronymic'] ?>">
            </td>
            <td>
                <?php
                if ($error = Registry::get('patronymic_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="date">Дата рождения:</label></td>
            <td>
                <?php
                $str = $this->data[0]['birthday'];
                $pieces = explode("-", $str);
                $year = $pieces[0];
                $month_num = $pieces[1] - 1;
                $day = $pieces[2];
                $month = array(
                    "Январь",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь"
                );

                // Число
                echo "<select name='sel_date' id='sel_date'>";
                echo "<option value='" . $day . "'>$day</option>";

                $i = 1;
                while ($i < $day) {
                    echo "<option value='" . $i . "'>$i</option>";
                    $i++;
                }
                $i = $day + 1;
                while ($i <= 31) {
                    echo "<option value='" . $i . "'>$i</option>";
                    $i++;
                }
                echo "</select>";

                // Месяц
                echo "<select name='sel_month' id='sel_month'>";
                echo "<option value='" . $month[$month_num] . "'>$month[$month_num]</option>";

                foreach ($month as $key => $m) {
                    if ($key == $month_num)
                        continue;
                    echo "<option value='" . $m . "'>$m</option>";
                }
                echo "</select>";

                // Год
                echo "<select name='sel_year' id='sel_year'>";
                echo "<option value='" . $year . "'>$year</option>";
                $j = 1920;
                while ($j < $year) {
                    echo "<option value='" . $j . "'>$j</option>";
                    $j++;
                }
                $j = $year + 1;
                while ($j <= date('Y')) {
                    echo "<option value='" . $j . "'>$j</option>";
                    $j++;
                }
                echo "</select>";
                ?>
            </td>
            <td>
                <?php
                if ($error = Registry::get('date_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><h3>Паспортные данные</h3></td></tr>
        <tr><td><label for="series">Серия:</label></td>
            <td>
                <input name="series" type="text" id="series"
                       value="">
            </td>
            <td>
                <?php
                if ($error = Registry::get('series_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="number">Номер:</label></td>
            <td>
                <input name="number" type="text" id="number"
                       value="">
            </td>
            <td>
                <?php
                if ($error = Registry::get('number_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><h3>Адрес регистрации</h3></td></tr>
        <tr><td><br></td></tr>
        <tr><td><label for="index">Индекс:</label></td>
            <td>
                <input name="index" type="text" id="index"
                       value="<?php if (isset($this->data[0]['index'])) echo $this->data[0]['index'] ?>">
            </td>
            <td>
                <?php
                if ($error = Registry::get('index_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="city">Город:</label></td>
            <td>
                <input name="city" type="text" id="city"
                       value="<?php if (isset($this->data[0]['city'])) echo $this->data[0]['city'] ?>">
            </td>
            <td>
                <?php
                if ($error = Registry::get('city_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="street">Улица:</label></td>
            <td>
                <input name="street" type="text" id="street"
                       value="<?php if (isset($this->data[0]['street'])) echo $this->data[0]['street'] ?>" disabled>
            </td>
            <td>
                <?php
                if ($error = Registry::get('street_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="home">Дом:</label></td>
            <td>
                <input name="home" type="text" id="home"
                       value="<?php if (isset($this->data[0]['home'])) echo $this->data[0]['home'] ?>" disabled>
            </td>
            <td>
                <?php
                if ($error = Registry::get('home_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="flat">Квартира:</label></td>
            <td>
                <input name="flat" type="text" id="flat"
                       value="<?php if (isset($this->data[0]['flat'])) echo $this->data[0]['flat'] ?>">
            </td>
            <td>
                <?php
                if ($error = Registry::get('flat_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=save_1
                       value="Сохранить информацию о пользователе">
            </td>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=check_with_passport
                       value="Подтвердить паспортом" disabled>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><h3>Контакты</h3></td></tr>
        <tr><td><label for="phonenumber">Номер телефона:</label></td>
            <td>
                <input name="phonenumber" type="text" id="phonenumber"
                       value="<?php if (isset($this->data[0]['phone_number'])) echo $this->data[0]['phone_number'] ?>">
            </td>
            <td>
                <?php
                if ($error = Registry::get('phonenumber_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="email">Email:</label></td>
            <td>
                <input name="email" type="text" id="email"  value="<?php if (isset($this->data[0]['email'])) echo $this->data[0]['email'] ?>">
            </td>
            <td>
                <?php
                if ($error = Registry::get('email_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=save_2
                       value="Сохранить контакты">
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><h3>Изображение профиля</h3></td></tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <?php if (isset($this->data[0]['profile_foto_id'])) echo "<img width='240' src='{$this->data[0]['profile_foto_id']}'>" ?>
            </td>
            <td width="200">
                <table>
                    <?php if ($this->data[0]['profile_foto_id'] != 'http://images.lant.io/profile_fotos/user_foto_id_default.jpg')
                    {
                        ?>
                        <tr>
                            <td width="200">
                                <label for="uploadbtn" class="buttons" style="width: 200px">Изменить фотографию</label>
                                <input style="opacity: 0; z-index: -1;" type="file" name="upload" id="uploadbtn">
                            </td>
                        </tr>
                    <?php }
                    else { ?>
                        <tr>
                            <td width="200">
                                <label for="uploadbtn" class="buttons" style="width: 200px">Добавить фотографию</label>
                                <input style="opacity: 0; z-index: -1;" type="file" name="upload" id="uploadbtn">
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($this->data[0]['profile_foto_id'] != 'http://images.lant.io/profile_fotos/user_foto_id_default.jpg')
                    {
                        ?>
                        <tr>
                            <td width="200">
                                <label for="deletebtn" class="buttons" style="width: 200px">Удалить фотографию</label>
                                <input style="opacity: 0; z-index: -1;" type="submit" name="delete_foto_id" id="deletebtn">
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <?php if ((isset($this->data[0]['vk_id'])) || (isset($this->data[0]['ok_id'])) || (isset($this->data[0]['mail_id'])) || (isset($this->data[0]['ya_id'])) || (isset($this->data[0]['google_id'])) || (isset($this->data[0]['steam_id'])) || (isset($this->data[0]['facebook_id']))) { ?>
            <tr>
                <td>
                    <h3>Социальные сети и связь</h3>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <?php if (isset($this->data[0]['vk_id'])) { ?>
                <tr>
                    <td>
                        <label for="vkcom">Вконтакте:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['vk_id'])) echo $this->data[0]['vk_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['vk_avatar'])) echo "<img width='30' src='{$this->data[0]['vk_avatar']}'>" ?> <?php if (isset($this->data[0]['vk_name'])) echo $this->data[0]['vk_name'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if (isset($this->data[0]['vk_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_vk
                       value=\"Отвязать\">" ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if (isset($this->data[0]['ok_id'])) { ?>
                <tr>
                    <td>
                        <label for="classmates">Одноклассники:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ok_id'])) echo $this->data[0]['ok_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ok_avatar'])) echo "<img width='30' src='{$this->data[0]['ok_avatar']}'>" ?> <?php if (isset($this->data[0]['ok_name'])) echo $this->data[0]['ok_name'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ok_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_ok
                       value=\"Отвязать\">" ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if (isset($this->data[0]['mail_id'])) { ?>
                <tr>
                    <td>
                        <label for="mailru">Mail.ru:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['mail_id'])) echo $this->data[0]['mail_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['mail_avatar'])) echo "<img width='30' src='{$this->data[0]['mail_avatar']}'>" ?> <?php if (isset($this->data[0]['mail_name'])) echo $this->data[0]['mail_name'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['mail_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_mail
                       value=\"Отвязать\">" ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if (isset($this->data[0]['ya_id'])) { ?>
                <tr>
                    <td>
                        <label for="yandexru">Yandex.ru:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ya_id'])) echo $this->data[0]['ya_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ya_avatar'])) echo "<img width='30' src='{$this->data[0]['ya_avatar']}'>" ?> <?php if (isset($this->data[0]['ya_name'])) echo $this->data[0]['ya_name'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ya_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_ya
                       value=\"Отвязать\">" ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if (isset($this->data[0]['google_id'])) { ?>
                <tr>
                    <td>
                        <label for="google">Google:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['google_id'])) echo $this->data[0]['google_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['google_avatar'])) echo "<img width='30' src='{$this->data[0]['google_avatar']}'>" ?> <?php if (isset($this->data[0]['google_name'])) echo $this->data[0]['google_name'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['google_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_google
                       value=\"Отвязать\">" ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if (isset($this->data[0]['facebook_id'])) { ?>
                <tr>
                    <td>
                        <label for="facebook">Facebook:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['facebook_id'])) echo $this->data[0]['facebook_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['facebook_avatar'])) echo "<img width='30' src='{$this->data[0]['facebook_avatar']}'>" ?> <?php if (isset($this->data[0]['facebook_name'])) echo $this->data[0]['facebook_name'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['facebook_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_facebook
                       value=\"Отвязать\">" ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if (isset($this->data[0]['steam_id'])) { ?>
                <tr>
                    <td>
                        <label for="steam">Steam:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['steam_id'])) echo $this->data[0]['steam_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['steam_avatar'])) echo "<img width='30' src='{$this->data[0]['steam_avatar']}'>" ?> <?php if (isset($this->data[0]['steam_name'])) echo $this->data[0]['steam_name'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['steam_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_steam
                       value=\"Отвязать\">" ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        <tr><td><br></td></tr>
        <tr><td><br></td></tr>
        <tr><td><h3>Параметры безопасности</h3></td></tr>
        <tr><td><br></td></tr>
        <tr><td><label for="old_pass">Старый пароль:</label></td>
            <td>
                <input name="old_pass" type="text" id="old_pass">
            </td>
            <td>
                <?php
                if ($error = Registry::get('password_profile_edit_error'))
                    echo $error;
                ?>
            </td>
        </tr>
        <tr><td><label for="new_pass">Новый пароль:</label></td>
            <td>
                <input name="new_pass" type="text" id="new_pass">
            </td>

        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=save_3
                       value="Сохранить параметры безопасности">
            </td>
        </tr>
    </table>
    <br>
</form>
<form action="" method="post">
    <textarea name="aboutme" cols="120" rows="20"
              placeholder="О себе..."><?php if (isset($this->data[0]['about_me'])) echo $this->data[0]['about_me'] ?></textarea>
    <input class="real_buttons" style="float: left" type=submit name=save_aboutme value="Сохранить информацию о себе">
    <br>
</form>
<form action="" method="post">
    <br><br>
    <table>
        <tr><td><br></td></tr>
        <tr><td><h3>Настройки оповещений и связи</h3></td></tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <label for="phone_only">Через телефон</label>
                <input type="checkbox" name="phone_only"
                       id="phone_only" <?php if ($this->data[0]['phone_only'] == 1) echo 'checked' ?>>
                <br>
                <label for="site_only">Через сайт</label>
                <input type="checkbox" name="site_only"
                       id="site_only" <?php if ($this->data[0]['site_only'] == 1) echo 'checked' ?>>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=save_4
                       value="Сохранить настройки оповещений и связи">
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><h3>Уведомления от сайта</h3></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <label for="new_dialog">Уведомления о новом диалоге</label>
                <input type="checkbox" name="new_dialog"
                       id="new_dialog" <?php if ($this->data[0]['new_dialog'] == 1) echo 'checked' ?>> <br>
                <label for="close_ad">Уведомление о закрытии объявления, помеченного как “избранное”</label>
                <input type="checkbox" name="close_ad"
                       id="close_ad" <?php if ($this->data[0]['close_ad'] == 1) echo 'checked' ?>><br>
                <label for="prom_offers">Рекламные предложения</label>
                <input type="checkbox" name="prom_offers"
                       id="prom_offers" <?php if ($this->data[0]['prom_offers'] == 1) echo 'checked' ?>><br>
            </td>
        </tr>
        <tr><td><br></td>
        </tr>
        <tr>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=save_5
                       value="Сохранить настройки уведомлений от сайта">
            </td>
        </tr>
    </table>
    <br><h3>Дополнительные функции</h3><br>
    <table>
        <tr>
            <td>
                <a class="real_buttons" style="line-height: 30px" href="/cabinet/profile/activity">Показать
                    активность</a>
            </td>
            <td>
                <a class="real_buttons" style="line-height: 30px" href="/cabinet/profile/gadgets">Просмотр подключенных
                    устройств</a>
            </td>
        </tr>
    </table>
</form>
