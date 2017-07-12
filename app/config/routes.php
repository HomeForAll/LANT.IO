<?php

return [
    ''            => 'web_build/site/index',
    'search'      => 'search_block/search/index',

    'registration'          => 'main/user/registration',
    'registration/([a-z]+)' => 'main/user/registration/$1',
    'login'                 => 'main/user/login',
    'login/([A-Za-z]+)'     => 'main/user/OAuthInit/$1',
    'logout'                => 'main/user/logout',

    'cabinet'                  => 'main/cabinet/cabinet',
    'cabinet/profile/edit'     => 'main/cabinet/profileEdit',
    'cabinet/profile/activity' => 'main/cabinet/showactivity',
    'cabinet/profile/gadgets'  => 'main/cabinet/showgadgets',
    'cabinet/generator'        => 'main/cabinet/generator',
    'cabinet/keyeditor'        => 'main/cabinet/keyeditor',
    'cabinet/forms'            => 'main/cabinet/forms',

    'cabinet/forms/new' => 'main/cabinet/formsNew',

    'cabinet/dialogs'                 => 'main/cabinet/dialogs',
    'cabinet/chat([0-9]+)'            => 'main/cabinet/chat/$1',
    'cabinet/deleteDialog([0-9]+)'    => 'main/cabinet/deleteDialog/$1',
    'cabinet/form/new'                => 'main/cabinet/createForm',
    'cabinet/form/edit/id/([0-9]+)'   => 'main/cabinet/editForm/$1',
    'cabinet/form/delete/id/([0-9]+)' => 'main/cabinet/deleteForm/$1',
    'cabinet/form/success'            => 'main/cabinet/createSuccess',
    'cabinet/balance'                 => 'main/cabinet/balance',
    'cabinet/payment'                 => 'main/cabinet/payment',

    'cabinet/tickets_editor' => 'main/support/ticketsEditor',

    'support'                          => 'main/support/index',
    'support/tickets'                  => 'main/support/tickets',
    'support/dialog/id/([0-9]+)'       => 'main/support/dialog/$1',
    'support/dialog/close/id/([0-9]+)' => 'main/support/close/$1',
    'support/new'                      => 'main/support/new',

    'oauth/([A-Za-z]+)/state/([0-9]+)' => 'empty/user/OAuth/$1/$2',
    'oauth/([A-Za-z]+)'                => 'empty/user/OAuth/$1',
    
    //    'auth/unset' => 'empty/user/OAuthDestroy',
    //    'auth/unset/([A-Za-z]+)' => 'empty/user/OAuthDestroy/$1',
    //    'auth/([A-Za-z]+)' => 'empty/user/OAuthInit/$1',
    
    'news/([0-9]+)'           => 'main/news/newsID/$1',
    'news/editor'             => 'main/news/newsEditor',
    'news/myad'               => 'main/news/newsMyAD',
    'news/editor/([0-9]+)'    => 'main/news/newsEditor/$1',
    'news'                    => 'main/news/newsList',
    
    'service'       => 'main/service/serviceSub',
    'service/admin' => 'main/service/serviceAdmin',

    'admin'                   => 'main/admin/admin',
    'admin/news' => 'main/admin/adminNews',
    'admin/newsformgenerator' => 'main/formGenerator/newsFormGenerator',
    'admin/users/ban'         => 'main/admin/usersBan',
    'admin/users'             => 'main/admin/users',

    // API
    'api/search' => 'main/API/search',
    'api/search/count' => 'main/API/SearchAdsCount',
    'api/auth' => 'main/API/login',
    'api/logout' => 'main/API/logout',
    'api/registration/([A-Za-z\_]+)' => 'main/API/registration/$1',
    'api/user' => 'main/API/user',
    'api/upload/news/images' => 'main/API/uploadAdImage',
    'api/upload/user/avatar' => 'main/API/uploadAvatar',
    'api/(best_of_[a-z]+)' => 'main/API/BestAds/$1',
    'api/stat/users/online/([A-Za-z]+)' => 'main/API/online/$1',
    'api/stat/users/registered/([A-Za-z]+)' => 'main/API/registered/$1',
    'api/stat/ads/get/([A-Za-z]+)' => 'main/API/adsNumber/$1',
];
