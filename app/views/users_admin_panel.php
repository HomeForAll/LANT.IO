<?php
$this->title = 'Работа с пользователями';
$adminModel  = $this->model('AdminModel');
?>

<h1>Работа с пользователями</h1>

<form action="" method="post">
    <table>
        <tr>
            <th colspan="2">Параметры</th>
        </tr>
        <tr>
            <td><label for="limit">Количество пользователей: </label></td>
            <td>
                <input type="text" id="limit" name="limit" value="<?= !empty($_POST['limit']) ? $_POST['limit'] : '10' ?>">
            </td>
        </tr>
        <tr>
            <th colspan="2">Найти пользователя по ID или Email</th>
        </tr>
        <tr>
            <td><label for="id">ID: </label></td>
            <td><input type="text" id="id" name="id"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center">или</td>
        </tr>
        <tr>
            <td><label for="email">Email: </label></td>
            <td><input type="text" id="email" name="email"></td>
        </tr>
        <tr>
            <th colspan="2">Найти пользователя по Имени и/или Фамилии</th>
        </tr>
        <tr>
            <td><label for="firstName">Имя: </label></td>
            <td><input type="text" id="firstName" name="firstName"></td>
        </tr>
        <tr>
            <td><label for="lastName">Фамилия: </label></td>
            <td><input type="text" id="lastName" name="lastName"></td>
        </tr>
    </table>
    <input type="submit" name="filter" value="Показать">
    <input type="reset" value="Очистить">
</form>

<?php
$users = $adminModel->getUsers();

if ($users) {
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <th></th>
                <th>Имя</th>
                <th>Email</th>
                <th>Статус</th>
            </tr>
            <?php
            foreach ($users as $user) {
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="userIDs[]" value="<?= $user['id'] ?>">
                    </td>
                    <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= (isset($user['banned']) && $user['banned']) ? 'Заблокирован' : 'Разблокирован' ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <input type="submit" value="Выполнить">
    </form>
    <?php
}
?>
<!--<a class="button" href="/admin/users/ban">Блокировать бользователя</a>-->