<?php
$this->setModel(new Model);
$model = $this->model('Model');
$user = $model->getUser($_SESSION['user']['id']);
?>

<!-- Для импорта содержания из другого домена требуется поддержка CORS for html -->
<?php if (!isset($_SESSION['authorized'])) { ?>
    <div id="navigation">
        <div class="logo-img">
            <a href="../../index.php"><img src="../../template/images/logo-true.png" alt="logo"></a>
        </div>
        <div class="registration-users">
            <div class="place-an-ad">
                <a href="/registration"><img src="../../template/images/add-blue.png" alt="add">Дать
                    объявление</a>
            </div>
            <div class="registration">
                <a href="/login"><img src="../../template/images/add-green.png" alt="add">Войти</a>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div id="navigation-true">
        <div class="container-w-0">
            <div class="logo-img">
                <a href="#"><img src="../../template/images/logo-true.png" alt=" logo-true"></a>
            </div>
            <div class="registration-users">
                <div class="place-an-ad">
                    <a href="../../index.php"><img src="../../template/images/add-blue.png" alt="add">Дать
                        объявление</a>
                </div>
                <div class="registration">
                    <div class="message"><img src="../../template/images/notification.png" alt="  notification">
                    </div>
                    <div class="user" onclick="showTopMenuAndSearch();">
                        <div class="users-information">
                            <p><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                            <span><img src="../../template/images/crown.png" alt="user">Пользователь +</span>
                        </div>
                        <img src="<?php echo $user['profile_foto_id']; ?>" alt="user">
                        <ul>
                            <li><a href="/news/myad"><img src="../../template/images/m1.png" alt="menu">Мои объявления</a>
                            </li>
                            <li><a href="#"><img src="../../template/images/m2.png" alt="menu">Избранное</a></li>
                            <li><a href="/support"><img src="../../template/images/m3.png" alt="menu">Тех поддержка</a>
                            </li>
                            <li><a href="/cabinet/profile/edit"><img src="../../template/images/m4.png" alt="menu">Настройка профиля</a>
                            </li>
                            <li><a href="/logout"><img src="../../template/images/m5.png" alt="menu">Выйти из системы</a>
                            </li>
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