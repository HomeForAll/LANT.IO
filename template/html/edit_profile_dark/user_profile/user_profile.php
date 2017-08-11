<div class="user-profile">
    <form action="" id="edit-profile">
        <div class="top-title">
            <a class="hash-tabs">Личная информация</a>
            <a class="hash-tabs">Безопасность</a>
            <a class="hash-tabs">Настройка сервиса</a>
            <button type="submit" id="save-profile">СОХРАНИТЬ</button>
        </div>
        <div class="user-all-information">
            <div class="photo-user">
                <div class="photo">
                    <div class="img-user">
                        <img src="/template/img/fiz.png" alt="user">
                        <div>
                            <a href="#" class="repeat"></a>
                            <a href="#" class="basket"></a>
                        </div>
                    </div>
                </div>
                <div class="subscribe">
                    <a href="#" class="vk" name="socialNet_VK"></a>
                    <a href="#" class="facebook" name="socialNet_YA"></a>
                    <a href="#" class="google-plus" name="socialNet_GOOGLE"></a>
                </div>
            </div>
            <div class="user-data">
                <div class="fio">
                    <label>Имя<input placeholder="Иван" class="bold-text" pattern="^[А-Яа-яA-Za-zЁё\s]+" name="name_name" /></label>
                    <label>Отчество<input placeholder="Сердюков" class="bold-text" pattern="^[А-Яа-яA-Za-zЁё\s]+" name="name_patronymic" /></label>
                    <label>Фамилия<input placeholder="Петрович" class="bold-text" pattern="^[А-Яа-яA-Za-zЁё\s]+" name="name_surname" /></label>
                    <label>Дата рождения<input type="date" class="bold-text" name="name_birthday" /></label>
                </div>
                <div class="contact-information">
                    <p>Паспортные данные</p>
                    <label>серия<input data-inputmask="'mask': '99-99'" placeholder="00-00" name="passport_series" /></label>
                    <label>номер<input data-inputmask="'mask': '999-999'" placeholder="000-000" name="passport_number" /></label>
                    <p>Адрес регистрации</p>
                    <label>индекс<input placeholder="000000" data-inputmask="'mask': '999999'" name="adress_index" /></label>
                    <label>город<input placeholder="Белгород" pattern="^[А-Яа-яA-Za-zЁё\s]+" name="adress_city" /></label>
                    <label>Улица<input placeholder="Пушкина" pattern="^[А-Яа-яA-Za-zЁё\s]+" name="adress_street" /></label>
                    <label>Дом<input placeholder="343" pattern="^[0-9]+$" name="adress_home" /></label>
                    <label>Квартира<input placeholder="15" pattern="^[0-9]+$" name="adress_flat" /></label>
                    <label>Информация о себе<textarea name="about_me"></textarea></label>
                    <p>Контакты:</p>
                    <label>Номер телефона<input type="text" name="contacts_number" placeholder="+7(___)___-__-__" data-inputmask="'mask': '+7(999)999-99-99'"></label>
                    <label>Email<input data-inputmask="'mask': '*{1,20}@*{1,20}[.*{2,6}]'" placeholder="example@mail.ru" name="contacts_email" /></label>
                </div>
            </div>
        </div>
        <div class="user-all-information">
            <div class="contact-information">
                <p>Параметры безопасности:</p>
                <label>Старый пароль<input type="password" placeholder="Введите пароль" name="series" /></label>
                <label>Новый пароль<input type="password" placeholder="Введите пароль" name="passport-id" /></label>
                <label>Двух этапная аутентификация<button onclick="authenticator();">Поключить</button></label>
            </div>
        </div>
        <div class="user-all-information">
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
        </div>
    </form>
</div>