<div class="user-profile">
    <div class="top-title">
        <a class="hash-tabs">Личная информация</a>
        <a class="hash-tabs">Безопасность</a>
        <a class="hash-tabs">Настройка сервиса</a>
        <button id="save-profile">СОХРАНИТЬ</button>
    </div>
    <form action="" id="user_edit_1" class="user-all-information">
        <div class="photo-user">
            <div class="photo">
                <div class="img-user">
                    <div>
                        <a href="#" class="repeat"></a>
                        <a href="#" class="basket"></a>
                    </div>
                </div>
            </div>
            <div class="subscribe">
                <a href="#" class="vk"></a>
                <a href="#" class="facebook"></a>
                <a href="#" class="google-plus"></a>
            </div>
        </div>
        <div class="user-data">
            <div class="fio">
                <label>Имя<input class="bold-text" type="text" value="Александр" name="name"></label>
                <label>Отчество<input class="bold-text" type="text" value="Иванович" name="middle-name"></label>
                <label>Фамилия<input class="bold-text" type="text" value="Никулин" name="surname"></label>
                <label>Дата рождения<input class="bold-text" type="date" name="surname"></label>
            </div>
            <div class="contact-information">
                <p>Паспортные данные</p>
                <label>серия<input type="text" value="2423" name="series"></label>
                <label>номер<input type="text" value="233635" name="passport-id"></label>
                <p>Адрес регистрации</p>
                <label>индекс<input type="text" value="125353" name="index"></label>
                <label>город<input type="text" value="Москва" name="city"></label>
                <label>Улица<input type="text" value="Москва" name="street"></label>
                <label>Дом<input type="text" value="Москва" name="home"></label>
                <label>Квартира<input type="text" value="Москва" name="apartment"></label>
                <p>Контакты:</p>
                <label>Номер телефона<input type="text" name="phone" placeholder="+7 (___) ___ - __ - __" data-inputmask="'mask': '+7 (999) 999 - 99 - 99'"></label>
                <label>Email<input type="text" pattern="/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/" name="email" required></label>
            </div>
        </div>
    </form>
    <form action="" id="user_edit_2" class="user-all-information">
        <div class="contact-information">
            <p>Параметры безопасности:</p>
            <label>Старый пароль<input type="text" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="series"></label>
            <label>Новый пароль<input type="text" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="passport-id"></label>
            <label>Информация о себе<textarea name="more-information"></textarea></label>
        </div>
    </form>
    <form action="" id="user_edit_3" class="user-all-information">
        <div class="contact-information">
            <p>Настройки оповещений и связи:</p>
            <label>Через телефон<input type="checkbox" name="phone-settings"></label>
            <label>Через сайт<input type="checkbox" name="site-settings"></label>
            <p>Уведомления от сайта:</p>
            <label>Уведомления о новом диалоге<input type="checkbox" name="notification-settings"></label>
            <label>Уведомление о закрытии объявления,<br> помеченного как “избранное”<input type="checkbox" name="notification-close-settings"></label>
            <label>Рекламные предложения<input type="checkbox" name="ap-settings"></label>
            <label>Список активности<input type="checkbox" name="active-user-settings"></label>
            <label>Список подключенных устройств<input type="checkbox" name="root-device-settings"></label>
        </div>
    </form>
</div>