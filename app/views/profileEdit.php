<?php
$this->title = 'Р РµРґР°РєС‚РёСЂРѕРІР°РЅРёРµ РїСЂРѕС„РёР»СЏ';

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
<h1>Р РµРґР°РєС‚РёСЂРѕРІР°РЅРёРµ РїСЂРѕС„РёР»СЏ</h1>

<form action="" method="post">
    <table>
        <tr>
            <td>
                <h3>РРЅС„РѕСЂРјР°С†РёСЏ Рѕ РїРѕР»СЊР·РѕРІР°С‚РµР»Рµ</h3>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><label for="name">РРјСЏ:</label></td>
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
        <tr><td><label for="surname">Р¤Р°РјРёР»РёСЏ:</label></td>
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
        <tr><td><label for="patronymic">РћС‚С‡РµСЃС‚РІРѕ:</label></td>
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
        <tr><td><label for="date">Р”Р°С‚Р° СЂРѕР¶РґРµРЅРёСЏ:</label></td>
            <td>
                <?php
                $str = $this->data[0]['birthday'];
                $pieces = explode("-", $str);
                $year = $pieces[0];
                $month_num = $pieces[1] - 1;
                $day = $pieces[2];
                $month = array(
                    "РЇРЅРІР°СЂСЊ",
                    "Р¤РµРІСЂР°Р»СЊ",
                    "РњР°СЂС‚",
                    "РђРїСЂРµР»СЊ",
                    "РњР°Р№",
                    "РСЋРЅСЊ",
                    "РСЋР»СЊ",
                    "РђРІРіСѓСЃС‚",
                    "РЎРµРЅС‚СЏР±СЂСЊ",
                    "РћРєС‚СЏР±СЂСЊ",
                    "РќРѕСЏР±СЂСЊ",
                    "Р”РµРєР°Р±СЂСЊ"
                );

                // Р§РёСЃР»Рѕ
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

                // РњРµСЃСЏС†
                echo "<select name='sel_month' id='sel_month'>";
                echo "<option value='" . $month[$month_num] . "'>$month[$month_num]</option>";

                foreach ($month as $key => $m) {
                    if ($key == $month_num)
                        continue;
                    echo "<option value='" . $m . "'>$m</option>";
                }
                echo "</select>";

                // Р“РѕРґ
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
        <tr><td><h3>РџР°СЃРїРѕСЂС‚РЅС‹Рµ РґР°РЅРЅС‹Рµ</h3></td></tr>
        <tr><td><label for="series">РЎРµСЂРёСЏ:</label></td>
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
        <tr><td><label for="number">РќРѕРјРµСЂ:</label></td>
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
        <tr><td><h3>РђРґСЂРµСЃ СЂРµРіРёСЃС‚СЂР°С†РёРё</h3></td></tr>
        <tr><td><br></td></tr>
        <tr><td><label for="index">РРЅРґРµРєСЃ:</label></td>
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
        <tr><td><label for="city">Р“РѕСЂРѕРґ:</label></td>
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
        <tr><td><label for="street">РЈР»РёС†Р°:</label></td>
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
        <tr><td><label for="home">Р”РѕРј:</label></td>
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
        <tr><td><label for="flat">РљРІР°СЂС‚РёСЂР°:</label></td>
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
                       value="РЎРѕС…СЂР°РЅРёС‚СЊ РёРЅС„РѕСЂРјР°С†РёСЋ Рѕ РїРѕР»СЊР·РѕРІР°С‚РµР»Рµ">
            </td>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=check_with_passport
                       value="РџРѕРґС‚РІРµСЂРґРёС‚СЊ РїР°СЃРїРѕСЂС‚РѕРј" disabled>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><h3>РљРѕРЅС‚Р°РєС‚С‹</h3></td></tr>
        <tr><td><label for="phonenumber">РќРѕРјРµСЂ С‚РµР»РµС„РѕРЅР°:</label></td>
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
                       value="РЎРѕС…СЂР°РЅРёС‚СЊ РєРѕРЅС‚Р°РєС‚С‹">
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><h3>РР·РѕР±СЂР°Р¶РµРЅРёРµ РїСЂРѕС„РёР»СЏ</h3></td></tr>
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
                                <label for="uploadbtn" class="buttons" style="width: 200px">РР·РјРµРЅРёС‚СЊ С„РѕС‚РѕРіСЂР°С„РёСЋ</label>
                                <input style="opacity: 0; z-index: -1;" type="file" name="upload" id="uploadbtn">
                            </td>
                        </tr>
                    <?php }
                    else { ?>
                        <tr>
                            <td width="200">
                                <label for="uploadbtn" class="buttons" style="width: 200px">Р”РѕР±Р°РІРёС‚СЊ С„РѕС‚РѕРіСЂР°С„РёСЋ</label>
                                <input style="opacity: 0; z-index: -1;" type="file" name="upload" id="uploadbtn">
                            </td>
                        </tr>
                    <?php } ?>
                    <?php if ($this->data[0]['profile_foto_id'] != 'http://images.lant.io/profile_fotos/user_foto_id_default.jpg')
                    {
                        ?>
                        <tr>
                            <td width="200">
                                <label for="deletebtn" class="buttons" style="width: 200px">РЈРґР°Р»РёС‚СЊ С„РѕС‚РѕРіСЂР°С„РёСЋ</label>
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
                    <h3>РЎРѕС†РёР°Р»СЊРЅС‹Рµ СЃРµС‚Рё Рё СЃРІСЏР·СЊ</h3>
                </td>
            </tr>
            <tr>
                <td><br></td>
            </tr>
            <?php if (isset($this->data[0]['vk_id'])) { ?>
                <tr>
                    <td>
                        <label for="vkcom">Р’РєРѕРЅС‚Р°РєС‚Рµ:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['vk_id'])) echo $this->data[0]['vk_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['vk_avatar'])) echo "<img width='30' src='{$this->data[0]['vk_avatar']}'>" ?> <?php if (isset($this->data[0]['vk_name'])) echo $this->data[0]['vk_name'] ?>
                    </td>
                    <td style="text-align: center;">
                        <?php if (isset($this->data[0]['vk_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_vk
                       value=\"РћС‚РІСЏР·Р°С‚СЊ\">" ?>
                    </td>
                </tr>
            <?php } ?>

            <?php if (isset($this->data[0]['ok_id'])) { ?>
                <tr>
                    <td>
                        <label for="classmates">РћРґРЅРѕРєР»Р°СЃСЃРЅРёРєРё:</label>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ok_id'])) echo $this->data[0]['ok_id'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ok_avatar'])) echo "<img width='30' src='{$this->data[0]['ok_avatar']}'>" ?> <?php if (isset($this->data[0]['ok_name'])) echo $this->data[0]['ok_name'] ?>
                    </td>
                    <td>
                        <?php if (isset($this->data[0]['ok_id'])) echo "<input class=\"real_buttons\" style=\"float: left\" type=submit name=delete_ok
                       value=\"РћС‚РІСЏР·Р°С‚СЊ\">" ?>
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
                       value=\"РћС‚РІСЏР·Р°С‚СЊ\">" ?>
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
                       value=\"РћС‚РІСЏР·Р°С‚СЊ\">" ?>
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
                       value=\"РћС‚РІСЏР·Р°С‚СЊ\">" ?>
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
                       value=\"РћС‚РІСЏР·Р°С‚СЊ\">" ?>
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
                       value=\"РћС‚РІСЏР·Р°С‚СЊ\">" ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
        <tr><td><br></td></tr>
        <tr><td><br></td></tr>
        <tr><td><h3>РџР°СЂР°РјРµС‚СЂС‹ Р±РµР·РѕРїР°СЃРЅРѕСЃС‚Рё</h3></td></tr>
        <tr><td><br></td></tr>
        <tr><td><label for="old_pass">РЎС‚Р°СЂС‹Р№ РїР°СЂРѕР»СЊ:</label></td>
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
        <tr><td><label for="new_pass">РќРѕРІС‹Р№ РїР°СЂРѕР»СЊ:</label></td>
            <td>
                <input name="new_pass" type="text" id="new_pass">
            </td>

        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=save_3
                       value="РЎРѕС…СЂР°РЅРёС‚СЊ РїР°СЂР°РјРµС‚СЂС‹ Р±РµР·РѕРїР°СЃРЅРѕСЃС‚Рё">
            </td>
        </tr>
    </table>
    <br>
</form>
<form action="" method="post">
    <textarea name="aboutme" cols="120" rows="20"
              placeholder="Рћ СЃРµР±Рµ..."><?php if (isset($this->data[0]['about_me'])) echo $this->data[0]['about_me'] ?></textarea>
    <input class="real_buttons" style="float: left" type=submit name=save_aboutme value="РЎРѕС…СЂР°РЅРёС‚СЊ РёРЅС„РѕСЂРјР°С†РёСЋ Рѕ СЃРµР±Рµ">
    <br>
</form>
<form action="" method="post">
    <br><br>
    <table>
        <tr><td><br></td></tr>
        <tr><td><h3>РќР°СЃС‚СЂРѕР№РєРё РѕРїРѕРІРµС‰РµРЅРёР№ Рё СЃРІСЏР·Рё</h3></td></tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <label for="phone_only">Р§РµСЂРµР· С‚РµР»РµС„РѕРЅ</label>
                <input type="checkbox" name="phone_only"
                       id="phone_only" <?php if ($this->data[0]['phone_only'] == 1) echo 'checked' ?>>
                <br>
                <label for="site_only">Р§РµСЂРµР· СЃР°Р№С‚</label>
                <input type="checkbox" name="site_only"
                       id="site_only" <?php if ($this->data[0]['site_only'] == 1) echo 'checked' ?>>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=save_4
                       value="РЎРѕС…СЂР°РЅРёС‚СЊ РЅР°СЃС‚СЂРѕР№РєРё РѕРїРѕРІРµС‰РµРЅРёР№ Рё СЃРІСЏР·Рё">
            </td>
        </tr>
        <tr><td><br></td></tr>
        <tr><td><h3>РЈРІРµРґРѕРјР»РµРЅРёСЏ РѕС‚ СЃР°Р№С‚Р°</h3></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
            <td>
                <label for="new_dialog">РЈРІРµРґРѕРјР»РµРЅРёСЏ Рѕ РЅРѕРІРѕРј РґРёР°Р»РѕРіРµ</label>
                <input type="checkbox" name="new_dialog"
                       id="new_dialog" <?php if ($this->data[0]['new_dialog'] == 1) echo 'checked' ?>> <br>
                <label for="close_ad">РЈРІРµРґРѕРјР»РµРЅРёРµ Рѕ Р·Р°РєСЂС‹С‚РёРё РѕР±СЉСЏРІР»РµРЅРёСЏ, РїРѕРјРµС‡РµРЅРЅРѕРіРѕ РєР°Рє вЂњРёР·Р±СЂР°РЅРЅРѕРµвЂќ</label>
                <input type="checkbox" name="close_ad"
                       id="close_ad" <?php if ($this->data[0]['close_ad'] == 1) echo 'checked' ?>><br>
                <label for="prom_offers">Р РµРєР»Р°РјРЅС‹Рµ РїСЂРµРґР»РѕР¶РµРЅРёСЏ</label>
                <input type="checkbox" name="prom_offers"
                       id="prom_offers" <?php if ($this->data[0]['prom_offers'] == 1) echo 'checked' ?>><br>
            </td>
        </tr>
        <tr><td><br></td>
        </tr>
        <tr>
            <td>
                <input class="real_buttons" style="float: left" type=submit name=save_5
                       value="РЎРѕС…СЂР°РЅРёС‚СЊ РЅР°СЃС‚СЂРѕР№РєРё СѓРІРµРґРѕРјР»РµРЅРёР№ РѕС‚ СЃР°Р№С‚Р°">
            </td>
        </tr>
    </table>
    <br><h3>Р”РѕРїРѕР»РЅРёС‚РµР»СЊРЅС‹Рµ С„СѓРЅРєС†РёРё</h3><br>
    <table>
        <tr>
            <td>
                <a class="real_buttons" style="line-height: 30px" href="/cabinet/profile/activity">РџРѕРєР°Р·Р°С‚СЊ
                    Р°РєС‚РёРІРЅРѕСЃС‚СЊ</a>
            </td>
            <td>
                <a class="real_buttons" style="line-height: 30px" href="/cabinet/profile/gadgets">РџСЂРѕСЃРјРѕС‚СЂ РїРѕРґРєР»СЋС‡РµРЅРЅС‹С…
                    СѓСЃС‚СЂРѕР№СЃС‚РІ</a>
            </td>
        </tr>
    </table>
</form>
