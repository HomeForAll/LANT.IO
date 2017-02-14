<?php
// Подключение стилей в контроллере
if (isset($this->data['css'])) {
foreach ($this->data['css'] as $key => $value) {
    echo '<link rel="stylesheet"  href="/templates/main/css/'.$value.'"  type="text/css"/>'."\r\n";
}
}