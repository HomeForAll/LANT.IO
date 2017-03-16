<?php
if (isset($_SERVER['HTTP_REFERER'])) {
    echo "<a class='button' href='" . $_SERVER['HTTP_REFERER'] . "'>Назад</a>";
}
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

    table {
        width: 100%;
    }

</style>

<div class="box">
    <span class="info">
        Активных обращений: <span class="value"><?php echo (!empty($this->data['statistic']['active'])) ? $this->data['statistic']['active'] : 0; ?></span>
    </span>
    <span class="info">
        Ответов тех. поддержки: <span class="value"><?php echo (!empty($this->data['statistic']['answers'])) ? $this->data['statistic']['answers'] : 0; ?></span>
    </span>
    <br>
    <a href="/support/tickets" style="margin: 10px 0 10px 10px;">Просмотреть ...</a>
</div>

<a href="/support/new" class="link">Написать в тех поддержку ...</a>
<form action="" method="post">
    <table>
        <tr>
            <td>
                <input type=submit class="link" style="width: 100%" name=account value="Запись">
            </td>
            <td>
                <input type=submit class="link" style="width: 100%" name=pay value="Платежи">
            </td>
            <td>
                <input type=submit class="link" style="width: 100%" name=tech_help value="Техподдержка">
            </td>
            <td>
                <input type=submit class="link" style="width: 100%" name=other value="Другое">
            </td>
        </tr>
    </table>
    <?php if (($this->data['articles']['i_max']) != 0) { ?>
    <table>
        <tr>
            <td>
                <h3>Все статьи</h3>
            </td>
            <td>
                <h3>Частые</h3>
            </td>
        </tr>
        <tr><td><br></td></tr>
        <?php for ($i = 0; $i < $this->data['articles']['i_max']; $i++) { ?>
        <tr>
            <td>
                <?php $name = '/support/?article=' . $this->data['articles']['matrix'][$i][0] ?>
                <a href="<?php echo $name ?>"><?php echo $this->data['articles']['matrix'][$i][1] ?></a>
            </td>
            <td>
                <?php $name = '/support/?article=' . $this->data['articles']['matrix_2'][$i][0] ?>
                <a href="<?php echo $name ?>"><?php echo $this->data['articles']['matrix_2'][$i][1] ?></a>
            </td>
        </tr>
        <?php } ?>
    </table>
    <?php }
    if (isset($_POST['account']) || (isset($_POST['pay'])) || (isset($_POST['tech_help'])) || (isset($_POST['other']))) {?>
    <input type=submit class="link" style="width: 100%" name=other value="Связаться с поддержкой">
    <?php } ?>
</form>
