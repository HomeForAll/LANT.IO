<?php
$this->title = 'Добавление\Редактирование услуг';
?>
<div class="message">
    <?php
    //Вывод сообщений
    if (isset($this->data['message'])) {
        foreach ($this->data['message'] as $message) {
            echo $message . '<br>';
        }
    }
    ?>
</div>


<h2>Мои услуги</h2>
<?php
if (!isset($this->data['my_services'])) {
    echo ' Вы не создали ни одного сервиса.';
} else {
    foreach ($this->data['my_services'] as $k => $v) {
        ?>
        <div class="service_header">
            <div class="service_name"><?php echo($v[$k]['service_name']); ?></div>
            <form action="" method="post">
                <input type="hidden" name="service_id" value="<?php echo $k; ?>">
                <input type="submit" name="service<?php
                if ($v[$k]['service_group_id'] == 'parent') echo '_group'; ?>_delete" value="Удалить <?php
                if ($v[$k]['service_group_id'] == 'parent') {
                    echo 'группу услуг';
                } else {
                    echo 'услугу';
                }
                ?>" class="button">
            </form>
            <div class="service_parameters"><?php echo($v[$k]['parameters']); ?></div>
        </div>
        <div class="service_body">

            <table>
                <tr>
                    <th>ID</th>
                    <th>Период</th>
                    <th>Цена</th>
                    <th></th>
                </tr>
                <?php foreach ($this->data['my_services'][$k] as $key => $value) { ?>
                    <tr>
                        <td><?php echo($value['service_id']); ?></td>
                        <td><?php echo($value['period']); ?></td>
                        <td><?php echo($value['price']); ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="service_id" value="<?php echo($value['service_id']); ?>">
                                <input type="submit" name="service_delete" value="Удалить услугу" class="button">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php
    }
}
?>

<h2>Добавление услуги</h2>

<form id="services_editor_form" class="services_editor_form" action="" method="post">
    <fieldset>
        <section>
            <label>Назвaние услуги*:
                <input name="service_name" type="text">
            </label>
        </section>
        <section>
            <label>Параметры:
                <textarea name="parameters" type="text"></textarea>
            </label>
        </section>
        <section>
            <label>Период (дней):<input class="input_dig_req" id="period_0" name="period_0" type="text"></label>
            <label>Цена:<input class="input_dig_req" id="price_0" name="price_0" type="text"></label>
        </section>
        <section>
            <div id="inputContainer">
            </div>
            <div id="addDynamicField">
                <input type="button" id="addFieldButton" value="Добавить опцию" name="0" class="button">
            </div>
        </section>
    </fieldset>

    <input type="submit" name="service_add" value="Зарегистрировать услугу" class="button">
</form>

