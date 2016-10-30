<?php

return array(
    // 'URI' => 'template/controller/action'
    '' => 'main/site/index',
    'search' => 'main/search/index',

    'registration' => 'main/user/registration',
    'login' => 'main/user/login',
    'logout' => 'main/user/logout',

    'cabinet' => 'main/cabinet/cabinet',
    'cabinet/chat' => 'main/cabinet/chat',
    'cabinet/generator' => 'main/cabinet/generator',

    'auth/vk' => 'main/auth/vk',
    'auth/ok' => 'main/auth/ok',
    'auth/mail' => 'main/auth/mail',
    'auth/ya' => 'main/auth/ya',
    'auth/goo' => 'main/auth/goo',
    'auth/fb' => 'main/auth/fb',
    'auth/steam' => 'main/auth/steam',
    'auth/unset/vk' => 'main/auth/unsetVk',
    'auth/unset/ok' => 'main/auth/unsetOk',
    'auth/unset/mail' => 'main/auth/unsetMail',
    'auth/unset/ya' => 'main/auth/unsetYa',
    'auth/unset/goo' => 'main/auth/unsetGoo',
    'auth/unset/fb' => 'main/auth/unsetFb',
    'auth/unset/steam' => 'main/auth/unsetSteam',
    'auth/unset' => 'main/auth/unset',

    'news/page([0-9]+)' => 'main/news/news_list/$1',
    'news/([0-9]+)' => 'main/news/news_id/$1', 
    'news/editor' => 'main/news/news_editor',
    'news/editor/([0-9]+)' => 'main/news/news_editor/$1',
    'news' => 'main/news/news_list'
);