<?php
$this->title = 'Балланс';
?>
<h1>История балланса</h1>
<form  id="balance_history" class="balance_history"  action="" method="post">
 <label>
<span>Начало периода: </span>
<input id="calendar_start" name="calendar_start" type="text" value="01-01-2017">
 </label>
    <br>
<label for="calendar_end">Конец периода: </label>
<input id="calendar_end" name="calendar_end" type="text" value="01-01-2017">
 
    <br>
<input type="submit" name="view_balance_history" value="Посмотреть">
</form>

<?php
if(isset($this->data['balance_history']['calendar_start']) && isset($this->data['balance_history']['calendar_end']))
    {
?>
<h3> Балланс за период от <?php echo $this->data['balance_history']['calendar_start'];?> до
    <?php echo $this->data['balance_history']['calendar_end'];?> :</h3>




<?php
if(!empty($this->data['balance_history'][0]))
{
    ?>
<table border="1" class="table">
    <tr>
    <th>Дата</th><th>Операция</th><th>Объем</th><th>Остаток на баллансе</th>
    </tr>
<?php
    for($i=0; isset($this->data['balance_history'][$i]); ++$i){
?><tr>
<td><?php echo $this->data['balance_history'][$i]['to_char']; ?></td>
<td><?php echo $this->data['balance_history'][$i]['operation']; ?></td>
<td><?php echo $this->data['balance_history'][$i]['value']; ?></td>
<td><?php echo $this->data['balance_history'][$i]['rest_balance']; ?></td>

</tr><?php

    }

} else {
    ?>
<p> Ничего не найдено </p>
<?php
}
?>
</table>
<?php
}
?>
