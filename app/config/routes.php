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
    'cabinet/keyeditor' => 'main/cabinet/keyeditor',

    'auth/login/([A-Za-z]+)' => 'empty/user/OAuthLogin/$1',
    'auth/unset' => 'empty/user/DestroyRegOAuthData',
    'auth/unset/([A-Za-z]+)' => 'empty/user/DestroyRegOAuthData/$1',
    'auth/([A-Za-z]+)' => 'empty/user/GetOAuthRegData/$1',

    'news/page([0-9]+)' => 'main/news/news_list/$1',
    'news/([0-9]+)' => 'main/news/news_id/$1', 
    'news/editor' => 'main/news/news_editor',
    'news/editor/([0-9]+)' => 'main/news/news_editor/$1',
    'news' => 'main/news/news_list'
);