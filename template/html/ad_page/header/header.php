<!-- Для импорта содержания из другого домена требуется поддержка CORS for html -->
<?php if (isset($_SESSION['authorized'])) { ?>
    <!-- Если пользователь не зарегистрирован -->
    <div class="header-back">
        <div class="header">
            <div class="container-w-0">
                <div class="user-is-not-registration">
                    <div class="logo-false"></div>
                    <div>
                        <button class="ad-back"><i class="fa fa-arrow-left" aria-hidden="true"></i>назад к объявлениям</button>
                    </div>
                    <div>
                        <a href="#">Дать объявление</a>
                        <a href="#">Войти</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <!-- Если пользователь не зарегистрирован -->
    <div class="header-back">
        <div class="header">
            <div class="container-w-0">
                <div class="show-hide-header">
                    <div class="logo"><a href="#"><img src="/template/images/logo-true.png" alt="logo"></a></div>
                    <ul class="add-ad-and-user">
                        <li><a href="#"><img src="/template/images/add-blue.png" alt="add-blue.png">Дать объявление</a></li>
                        <li><a href="#" class="min-circle-notification"><img src="/template/images/notification.png" alt="notification"></a></li>
                        <li onclick="showTopMenuAndSearch();"><a href="#" class="user-logo"><img src="/template/images/user.png" alt="user">Александр Никулин</a>
                            <span>
                        <img src="/template/images/crown.png" alt="crown">Пользователь
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </span>
                        </li>
                    </ul>
                </div>
                <div class="navigation">
                    <div class="user" onclick="showTopMenuAndSearch();">
                        <div class="users-information">
                            <img src="/template/images/user.png" alt="user">
                            <p>Александр Никулин</p>
                            <div class="user-add">
                                <img src="/template/images/crown.png" alt="crown">Пользователь
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </div>
                        </div>
                        <ul>
                            <li><a href="#"><img src="/template/images/m1.png" alt="menu">Уведомления<span>100</span></a></li>
                            <li><a href="#"><img src="/template/images/m1.png" alt="menu">Мои объявления</a></li>
                            <li><a href="#"><img src="/template/images/m2.png" alt="menu">Избранное</a></li>
                            <li><a href="#"><img src="/template/images/m3.png" alt="menu">Тех поддержка</a></li>
                            <li><a href="#"><img src="/template/images/m4.png" alt="menu">Настройка профиля</a></li>
                            <li><a href="#"><img src="/template/images/m5.png" alt="menu">Выйти из системы</a></li>
                        </ul>
                    </div>
                </div>
                <button class="show-and-hide-menu" onclick="showTopMenuAndSearch();">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
<?php } ?>