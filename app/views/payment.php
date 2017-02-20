<?php
$this->title = 'Балланс';
echo'<br>------ $this->data-----<br><pre>';
var_dump($this->data);
echo'<br>______________<br></pre>';
?>

<h1>Балланс</h1>
<p>Ваш балланс:  <?php if(isset($this->data['balance'])) { echo $this->data['balance']; } else {echo 0;}?> коинов </p>
<h3>Пополнить балланс:</h3>

<a class="button" href="#">Купить 1 коин = 1 рубль</a>
<a class="button" href="#">Купить 10 коинов = 9 рублей</a>
<!--<form  id="balance_form" class="balance_form" enctype="multipart/form-data" action="" method="post">
</form>-->
<a class="button" href="balance">История балланса</a>

<h3>Подключенные услуги</h3>
 
 <a class="button" href="cabinet/services"></a>