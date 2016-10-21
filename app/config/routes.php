<?php

return array(
    // 'URI' => 'pageTitle/controller/action'
    '' => 'Главная/site/index',
    'search' => 'Поиск/site/search',

    'registration' => 'Регистрация/user/registration',
    'login' => 'Вход/user/login',
    'logout' => 'Выход/user/logout',

    'cp' => 'Личный кабинет/CP/CP',
    'cp/chat' => 'Чат/CP/chat',

    'auth/vk' => 'Вконтакте/auth/vk',
    'auth/ok' => 'Одноклассники/auth/ok',
    'auth/mail' => 'Mail.ru/auth/mail',
    'auth/ya' => 'Ya.ru/auth/ya',
    'auth/goo' => 'Google.com/auth/goo',
    'auth/fb' => 'Facebook.com/auth/fb',
    'auth/unset' => 'Отключение сервиса/auth/unset',

    'news/page([0-9]+)' => 'Новости/news/news_list/$1',
    'news/([0-9]+)' => 'Новости/news/news_id/$1', 
    'news/editor' => 'Новости/news/news_editor',
    'news/editor/([0-9]+)' => 'Новости/news/news_editor/$1',
    'news' => 'Новости/news/news_list'
);