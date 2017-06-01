<?php
$this->title = 'Блокировка пользователя';
$adminModel = $this->model('AdminModel');
?>

<h3>Поиск пользователя</h3>
<form action="" method="post">
    <table>
        <tr>
            <td><input type="text" placeholder="Email" name="email"></td>
        </tr>
        <tr>
            <td><input type="submit" name="search" value="Найти"></td>
        </tr>
    </table>
</form>

<?php
$users = $adminModel->getUsers();

if ($users) {
    ?>
    <form action="" method="post">
        <table>
            <tr>
                <th></th>
                <th>Пользователи</th>
            </tr>
            <?php
            foreach ($users as $user) {
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="users[]" value="<?= $user['id'] ?>">
                        <!-- TODO: В будущем реализуею блокировку нескольких пользователей -->
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    </td>
                    <td><?= $user['email'] ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <label for="block_date">Дата блокировки</label>
        <input type="date" name="block_date" id="block_date">
        <input type="submit" name="block" value="Блокировать">
        <input type="submit" name="perm_block" value="Блокировать навсегда">
    </form>
    <?php
}

if ($adminModel->getBlockResult()) {
    echo '<br><span style="color: red;">Пользовтель успешно заблокирован!</span>';
}
?>

