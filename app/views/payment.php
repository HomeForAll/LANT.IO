<?php
$this->title = 'Балланс';
?>

<h1>Балланс</h1>
<p>Ваш балланс:  <?php if(!empty($this->data['balance'])) { echo $this->data['balance']; } else {echo '0';}?> коинов </p>
<h3>Пополнить балланс:</h3>
<form action="https://demomoney.yandex.ru/eshop.xml" method="post">
<!-- Обязательные поля -->
<input name="shopId" value="151" type="hidden"/>
<input name="scid" value="363" type="hidden"/>
<input name="customerNumber" value="<?php  if(isset($this->data['id'])) { echo $this->data['id']; } ?>" type="hidden"/>
<input name="sum" value="100">
<!-- Необязательные -->
<input name="orderNumber" value="1000" type="hidden"/>
<input name="shopDefaultUrl" value="http://dev.lant.io/cabinet/payment" type="hidden"/>
<input name="shopFailURL" value="http://dev.lant.io/cabinet/payment" type="hidden"/>
<input name="shopSuccessURL" value="http://dev.lant.io/cabinet/payment" type="hidden"/>
<input name="cps_email" value="<?php  if(isset($this->data['email'])) { echo $this->data['email']; } ?>" type="hidden"/>
<input name="cps_phone" value="<?php  if(isset($this->data['phone_number'])) { echo $this->data['phone_number']; } ?>" type="hidden"/>
<!--Способ оплаты:<br>
<input name="paymentType" value="PC" type="radio">Оплата из кошелька в Яндекс.Деньгах<br>
<input name="paymentType" value="AC" type="radio">Оплата с произвольной банковской карты<br>
<input name="paymentType" value="GP" type="radio">Оплата наличными через кассы и терминалы<br><br>-->
<input type="submit" value="Заплатить"/>
</form>
<a class="button" href="#">Купить 1 коин = 1 рубль</a>
<a class="button" href="#">Купить 10 коинов = 9 рублей</a>
<!--<form  id="balance_form" class="balance_form" enctype="multipart/form-data" action="" method="post">
</form>-->
<a class="button" href="balance">История балланса</a>

