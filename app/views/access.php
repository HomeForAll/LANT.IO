<?php

/***
 * @var object $this экземпляр класса /app/core/View
 */
$this->title = 'Beta Access';
?>

<div id="logo"><img src="/templates/main/images/access_logo_element.png" alt="access">lant.io</div>

<form action="/" method="post" autocomplete="off">
    <input id="email" name="email" type="text" placeholder="Ваш email"><br>
    <div class="keyVisible">
        <input id="key" name="key" type="text" placeholder="Ключ доступа"><br>
    </div>
    <input type="submit" name="submit" value="Войти">
</form>

<div id="link"><a
        href="https://docs.google.com/forms/d/e/1FAIpQLSdimqMUr3q4ruMuDQAXGec4wXeL56sS9V6nqKGvhY9YZXIoug/viewform?c=0&w=1"
        target="_blank">У меня нет доступа</a>
</div>