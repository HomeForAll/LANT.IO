<?php
?>
<style>
    .box {
        width: 350px;
        border: dashed 1px black;
    }

    .info {
        display: inline-block;
        font-family: Arial sans-serif;
        font-size: 14pt;
        margin: 10px 0 0 10px;
    }

    .value {
        font-weight: bold;
    }

    a {
        display: inline-block;
        text-decoration: none;
    }

    .link {
        color: #FFFFFF;
        display: block;
        line-height: 40px;
        margin: 15px 0;
        width: 350px;
        border-radius: 3px;
        background: gray;
        border: solid 1px gray;
        text-align: center;
    }

    .link:hover {
        color: gray;
        background: #FFFFFF;
    }
</style>

<div class="box">
    <span class="info">
        Активных обращений: <span class="value">0</span>
    </span>
    <span class="info">
        Ответов тех. поддержки: <span class="value">0</span>
    </span>
    <br>
    <a href="/support/tickets" style="margin: 10px 0 10px 10px;">Просмотреть ...</a>
</div>

<a href="/support/new" class="link">Написать в тех поддержку ...</a>
