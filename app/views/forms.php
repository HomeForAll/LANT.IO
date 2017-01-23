<?php
/***
 * @var object $this экземпляр класса /app/core/View
 */
$this->title = 'Редактор форм';

$spaceType = array(
    'residential' => 'Жилая',
    'commercial' => 'Коммерческая',
);

$operationType = array(
    'sell' => 'Продажа',
    'rent' => 'Аренда',
);

$objectType = array(
    'apart' => 'Квартира',
    'room' => 'Комната',
    'house' => 'Дом',
    'garage_or_parking_place' => 'Гараж/машиноместо',
    'land' => 'Земельный участок',
    'office' => 'Офис',
    'osz' => 'ОСЗ',
    'complex_osz' => 'Комплекс ОСЗ',
    'market_or_fair' => 'Рынок/ярмарка',
    'production_and_storage_space' => 'Производственно-складские помещения',
    'production_and_storage_buildings' => 'Производственно-складские здания',
    'tour_buildings' => 'Недвижимость для туризма и отдыха',
);
?>

<style>
    table {
        margin: 0 0 15px 0;
        border: solid 1px black;
        border-collapse: collapse;
    }

    th {
        background: #C3CBD1;
    }

    th, td {
        padding: 10px 15px 10px 15px;
        border: solid 1px black;
    }
</style>

<h1>Редактор форм</h1>

<?php
if (!empty($this->data)) {
    ?>
    <table>
        <tr>
            <th>Тип площади</th>
            <th>Операция</th>
            <th>Тип объекта</th>
            <th>Действие</th>
        </tr>
        <?php
        foreach ($this->data['forms'] as $form) {
            ?>
            <tr>
                <td>
                    <?php echo $this->data['data']['spaceTypes'][$form['space_type'] - 1]['r_name']; ?>
                </td>
                <td>
                    <?php echo $this->data['data']['operationTypes'][$form['operation'] - 1]['r_name']; ?>
                </td>
                <td>
                    <?php echo $this->data['data']['objectTypes'][$form['object_type'] - 1]['r_name']; ?>
                </td>
                <td>
                    <a class="button" style="margin: 0;" href="/cabinet/form/edit/id/<?php echo $form['id']; ?>">Редактировать</a>
                    <a class="button" style="margin: 0;" href="/cabinet/form/delete/id/<?php echo $form['id']; ?>">Удалить</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
} else {
    $this->printData('Формы отсутствуют.');
}
?>
<a class="button" href="/cabinet/form/new">Создать форму</a>