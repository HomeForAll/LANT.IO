<?php
$this->title = 'Услуги';
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


<h2>Подключенные услуги</h2>
    <table>
        <tr>
            <th>id</th>
            <th>Наименование</th>
            <th>Параметры</th>
            <th>Дата подписки</th>
            <th>Дата окончания</th>
            <th>Цена</th>
        </tr>
        <?php
        foreach($this->data['my_sub_serv'] as $value){
            ?>
<tr>
    <td><?php echo($value['service_id']); ?></td>
    <td><?php echo($this->data['my_sub_serv_data'][$value['service_id']]['service_name']); ?></td>
    <td><?php echo($this->data['my_sub_serv_data'][$value['service_id']]['parameters']); ?></td>
    <td><?php echo($value['date_of_beginning']); ?></td>
    <td><?php echo($value['date_of_expiration']); ?></td>
    <td><?php echo($this->data['my_sub_serv_data'][$value['service_id']]['price']); ?></td>
</tr>
        <?php
        }
        ?>

    </table>

<h2>Поиск услуг</h2>
<?php
    foreach ($this->data['services'] as $k => $v) {
        ?>
        <div class="service_body">


            <table>
                <tr>
                    <th colspan="4"><?php echo($v[$k]['service_name']); ?></th>
                </tr>
                <tr>
                    <td colspan="4"><div class="service_parameters"><?php echo($v[$k]['parameters']); ?></div></td>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Период</th>
                    <th>Цена</th>
                    <th></th>
                </tr>
                <?php foreach ($this->data['services'][$k] as $key => $value) { ?>
                    <tr>
                        <td><?php echo($value['service_id']); ?></td>
                        <td><?php echo($value['period']); ?></td>
                        <td><?php echo($value['price']); ?></td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="service_id" value="<?php echo($value['service_id']); ?>">
                                <input type="hidden" name="service_group_id" value="<?php echo($k); ?>">
                                <input type="submit" name="service_subscribe" value="Подписаться" class="button">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <?php
    }

?>