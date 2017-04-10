<?php

return array(
    '' => 'web_build/site/index',
    'search' => 'main/search/index',

    'registration' => 'main/user/registration',
    'registration/([a-z]+)' => 'main/user/registration/$1',
    'login' => 'main/user/login',
    'login/([A-Za-z]+)' => 'main/user/OAuthInit/$1',
    'logout' => 'main/user/logout',

    'cabinet' => 'main/cabinet/cabinet',
    'cabinet/profile/edit' => 'main/cabinet/profileEdit',
    'cabinet/profile/activity' => 'main/cabinet/showactivity',
    'cabinet/profile/gadgets' => 'main/cabinet/showgadgets',
    'cabinet/generator' => 'main/cabinet/generator',
    'cabinet/keyeditor' => 'main/cabinet/keyeditor',
    'cabinet/forms' => 'main/cabinet/forms',

    'cabinet/forms/new' => 'main/cabinet/formsNew',

    'cabinet/dialogs' => 'main/cabinet/dialogs',
    'cabinet/chat' => 'main/cabinet/chat',
    'cabinet/form/new' => 'main/cabinet/createForm',
    'cabinet/form/edit/id/([0-9]+)' => 'main/cabinet/editForm/$1',
    'cabinet/form/delete/id/([0-9]+)' => 'main/cabinet/deleteForm/$1',
    'cabinet/form/success' => 'main/cabinet/createSuccess',
    'cabinet/balance' => 'main/cabinet/balance',
    'cabinet/payment' => 'main/cabinet/payment',

    'cabinet/tickets_editor' => 'main/support/ticketsEditor',

    'support' => 'main/support/index',
    'support/tickets' => 'main/support/tickets',
    'support/dialog/id/([0-9]+)' => 'main/support/dialog/$1',
    'support/dialog/close/id/([0-9]+)' => 'main/support/close/$1',
    'support/new' => 'main/support/new',

    'oauth/([A-Za-z]+)/state/([0-9]+)' => 'empty/user/OAuth/$1/$2',
    'oauth/([A-Za-z]+)' => 'empty/user/OAuth/$1',

//    'auth/unset' => 'empty/user/OAuthDestroy',
//    'auth/unset/([A-Za-z]+)' => 'empty/user/OAuthDestroy/$1',
//    'auth/([A-Za-z]+)' => 'empty/user/OAuthInit/$1',

    'news/page([0-9]+)' => 'main/news/news_list/$1',
    'news/([0-9]+)' => 'main/news/news_id/$1',
    'news/editor' => 'main/news/news_editor',
    'news/myad' => 'main/news/news_myad',
    'news/editor/([0-9]+)' => 'main/news/news_editor/$1',
    'news/editor/(saleapart)' => 'main/news/news_editor/$1',
    'news/editor/(salehouse)' => 'main/news/news_editor/$1',
    'news/editor/(saleroom)' => 'main/news/news_editor/$1',
    'news/editor/(salepart)' => 'main/news/news_editor/$1',
    'news/editor/(saleland)' => 'main/news/news_editor/$1',
    'news/editor/(rentapart)' => 'main/news/news_editor/$1',
    'news/editor/(renthouse)' => 'main/news/news_editor/$1',
    'news/editor/(rentroom)' => 'main/news/news_editor/$1',
    'news/editor/(rentland)' => 'main/news/news_editor/$1',
    'news' => 'main/news/news_list',

    'service' => 'main/service/serviceSub',
    'service/admin' => 'main/service/serviceAdmin',

    'admin/newsformgenerator' => 'main/admin/newsFormGenerator',

    'forms_gen' => 'main/search/GenSearchForm',
    'forms_gen/([0-9]+)' => 'main/search/GenSearchForm/$1',
);