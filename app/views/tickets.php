<?php
if (isset($_SERVER['HTTP_REFERER'])) {
    echo "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Назад</a>";
}