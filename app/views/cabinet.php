<?php
$this->title = 'Личный кабинет';

$access = $this->checkAccessLevel();
?>
    <h1>Личный кабинет!</h1>

    <br>
<?php
if ($access['key_generator']) {
    ?>
    <a class="button" href="cabinet/generator">Генератор ключей</a>
    <?php
}

if ($access['key_editor']) {
    ?>
    <a class="button" href="cabinet/keyeditor">Редактор ключей</a>
    <?php
}

if ($access['admin_tickets']) {
    ?>
    <a class="button" href="cabinet/tickets_editor">Редактор тикетов</a>
<?php }
?>
    <br>
    <a class="button" href="cabinet/profile/edit">Редактировать профиль</a>
<?php
if ($access['forms_editor']) {
    ?>
    <a class="button" href="cabinet/forms">Редактор форм</a>
    <?php
}
?>
    <a class="button" href="cabinet/dialogs">Мои диалоги</a>
    <div style="position: absolute; top: 5px; right: 5px;">
        <a href="/support" class="button">Тех. поддержка</a>
    </div>

    <a class="button" href="/news/myad">Мои объявления</a>

    <p>Ваш балланс: <?php if (isset($this->data[0]['balance'])) {
            echo $this->data[0]['balance'];
        } else {
            echo '0';
        } ?> коинов </p>
    <a class="button" href="cabinet/payment">Платежи</a>

    <a class="button" href="service">Услуги</a>
    <a class="button" href="service/admin">Добавление\Редактирование услуг</a>
     <a class="button" href="admin">Административная панель</a>
    
<?php
if ($access['admin_service']) {
    ?>
    <a class="button" href="service/admin">Добавление\Редактирование услуг</a>
    <?php
}

function checkEmpty($array)
{
    $i = 0;
    foreach ($array as $item) {
        if (empty($item)) {
            $i++;
        }
    }

    return $i;
}

if (checkEmpty($this->data['social_nets'][0]) > 0) {
    ?>
    <h3>Привязать социальную сеть:</h3>
    <div id="soc_net">
        <?php
        if ($this->data['social_nets'][0]['vk_id'] == '') {
            ?>
            <a href="oauth/vk/state/3"><img src="/template/images/soc_net/vk_2.png" alt="VK"></a>
            <?php
        }

        if ($this->data['social_nets'][0]['ok_id'] == '') {
            ?>
            <a href="oauth/ok/state/3"><img src="/template/images/soc_net/ok.png" alt="OK"></a>
            <?php
        }

        if ($this->data['social_nets'][0]['mail_id'] == '') {
            ?>
            <a href="oauth/mail/state/3"><img src="/template/images/soc_net/mail_ru.png" alt="Mail"></a>
            <?php
        }

        if ($this->data['social_nets'][0]['ya_id'] == '') {
            ?>
            <a href="oauth/ya/state/3"><img src="/template/images/soc_net/yandex_2.png" alt="YA"></a>
            <?php
        }

        if ($this->data['social_nets'][0]['google_id'] == '') {
            ?>
            <a href="oauth/google/state/3"><img src="/template/images/soc_net/google.png" alt="Google"></a>
            <?php
        }

        if ($this->data['social_nets'][0]['facebook_id'] == '') {
            ?>
            <a href="oauth/fb/state/3"><img src="/template/images/soc_net/facebook_2.png" alt="FaceBook"></a>
            <?php
        }

        if ($this->data['social_nets'][0]['steam_id'] == '') {
            ?>
            <a href="oauth/steam/state/3"><img src="/template/images/soc_net/steam.png" alt="Steam"></a>
            <?php
        }
        ?>
        <div style="clear: both"></div>
    </div>
    <?php
}
?>