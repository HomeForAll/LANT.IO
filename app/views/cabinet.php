<?php
$this->title = 'Личный кабинет';
?>
<h1>Личный кабинет!</h1>
<a class="button" href="cabinet/profile/edit">Редактировать профиль</a>
<?php
if ($this->checkAccessLevel($_SESSION['status'], 'profile')) {
    ?>
    <a class="button" href="cabinet/generator">Генератор ключей</a>
    <a class="button" href="cabinet/keyeditor">Редактор ключей</a>
    <?php
}
?>
<a class="button" href="cabinet/forms">Редактор форм</a>
<div style="position: absolute; top: 5px; right: 5px;">
    <a href="/support" class="button">Тех. поддержка</a>
</div>