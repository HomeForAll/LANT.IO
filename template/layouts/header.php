<!-- Для импорта содержания из другого домена требуется поддержка CORS for html -->
<?php if (isset($_SESSION['authorized'])) { ?>
    <!-- Если пользователь не зарегистрирован -->
    <div class="navigation">
        <div class="container-w-0"></div>
    </div>
<?php } else { ?>
    <div class="navigation">
        <div class="container-w-0">
            <div class="user" onclick="showTopMenuAndSearch();">
                <div class="users-information">
                    <img src="../../template/images/user.png" alt="user">
                    <p>Александр Никулин</p>
                    <div class="user-add">
                        <img src="../../template/images/crown.png" alt="crown">Пользователь
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </div>
                </div>
                <ul>
                    <li><a href="#"><img src="../../template/images/m1.png" alt="menu">Уведомления<span>100</span></a></li>
                    <li><a href="#"><img src="../../template/images/m1.png" alt="menu">Мои объявления</a></li>
                    <li><a href="#"><img src="../../template/images/m2.png" alt="menu">Избранное</a></li>
                    <li><a href="#"><img src="../../template/images/m3.png" alt="menu">Тех поддержка</a></li>
                    <li><a href="#"><img src="../../template/images/m4.png" alt="menu">Настройка профиля</a></li>
                    <li><a href="#"><img src="../../template/images/m5.png" alt="menu">Выйти из системы</a></li>
                </ul>
                <button class="show-and-hide-menu" onclick="showTopMenuAndSearch();">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
<?php } ?>