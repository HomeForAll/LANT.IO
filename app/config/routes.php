<?php

return array(
    // 'URI' => 'template/controller/action'
    '' => 'main/site/index',
    'search' => 'main/search/index',

    'registration' => 'main/user/registration',
    'login' => 'main/user/login',
    'login/([A-Za-z]+)/([A-Za-z]+)' => 'main/user/OAuthGetData/$1/$2',
    'logout' => 'main/user/logout',

    'cabinet' => 'main/cabinet/cabinet',
    'cabinet/chat' => 'main/cabinet/chat',
    'cabinet/profile/edit' => 'main/cabinet/profileEdit',
    'cabinet/generator' => 'main/cabinet/generator',
    'cabinet/keyeditor' => 'main/cabinet/keyeditor',

    'auth/unset' => 'empty/user/OAuthDestroyData',
    'auth/unset/([A-Za-z]+)' => 'empty/user/OAuthDestroyData/$1',
    'auth/([A-Za-z]+)' => 'empty/user/OAuthGetData/$1',

    'news/page([0-9]+)' => 'main/news/news_list/$1',
    'news/(id[b,r,s][a,h,r,l]?[0-9a-f]+)' => 'main/news/news_id/$1', 
    'news/editor' => 'main/news/news_editor',
    'news/editor/(id[b,r,s][a,h,r,l]?[0-9a-f]+)' => 'main/news/news_editor/$1',
    'news/editor/(saleapart)' => 'main/news/news_editor/$1',
    'news/editor/(salehouse)' => 'main/news/news_editor/$1',
    'news/editor/(saleroom)' => 'main/news/news_editor/$1',
    'news/editor/(salepart)' => 'main/news/news_editor/$1',
    'news/editor/(saleland)' => 'main/news/news_editor/$1',
    'news/editor/(rentapart)' => 'main/news/news_editor/$1',
    'news/editor/(renthouse)' => 'main/news/news_editor/$1',
    'news/editor/(rentroom)' => 'main/news/news_editor/$1',
    'news/editor/(rentland)' => 'main/news/news_editor/$1',
    'news' => 'main/news/news_list'
);