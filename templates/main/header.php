<div id="wrapper">
    <div id="navigation">
        <ul>
            <li><a href="/">Главная</a></li>
            <li><a href="/search">Поиск</a></li>
            <li><a href="/news">Объявления</a></li>
            <?php if (isset($_SESSION['authorized'])) { ?>
                <li><a href="/cabinet">Личный кабинет</a></li>
                <li><a href="/logout">Выход</a></li>
            <?php } else { ?>
                <li><a href="/registration">Регистрация</a></li>
                <li><a href="/login">Вход</a></li>
            <?php } ?>
        </ul>
    </div>
    <div id="content">