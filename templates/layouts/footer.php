<div id="wrapper">
    <div id="navigation">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="../../index.php">Поиск</a></li>
            <li><a href="../../index.php">Новости</a></li>
            <?php if (isset($_SESSION['authorized'])) { ?>
                <li><a href="../../index.php">Личный кабинет</a></li>
                <li><a href="../../index.php">Выход</a></li>
            <?php } else { ?>
                <li><a href="../../index.php">Регистрация</a></li>
                <li><a href="../../index.php">Вход</a></li>
            <?php } ?>
        </ul>
    </div>
    <div id="content">
    </div>
</div>
</body>
</html>