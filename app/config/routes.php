<?php

return [
    ''            => 'web_build/site/index',
    'search'      => 'search_block/search/index',
    'ad_page'      => 'ad_page/site/index',
    'dark_profile'      => 'dark_profile/site/index',
    'profile_dark'      => 'profile_dark/site/index',

    'profile' => 'profile/site/index',
    'profile/([a-z0-9\/]+)' => 'profile/site/index',

    'registration'          => 'main/user/registration',
    'registration/([a-z]+)' => 'main/user/registration/$1',
    'login'                 => 'main/user/login',
    'login/([A-Za-z]+)'     => 'main/user/OAuthInit/$1',
    'logout'                => 'main/user/logout',
    'restore/([^:]+):([0-9]+)' => 'restore/user/restore/$1/$2',

    'cabinet'                  => 'main/cabinet/cabinet',


    'cabinet/profile/edit'     => 'main/cabinet/getProfileInfo',

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
    'api/user/([0-9]+)' => 'main/API/user/$1',
    'api/user' => 'main/API/user',
    'api/user.getFiles' => 'main/API/getMyFiles',
    'api/upload/news/images' => 'main/API/uploadAdImage',
    'api/upload/user/avatar' => 'main/API/uploadAvatar',
    'api/(best_of_[a-z]+)' => 'main/API/BestAds/$1',
    'api/stat/users/online/([A-Za-z]+)' => 'main/API/online/$1',
    'api/stat/users/registered/([A-Za-z]+)' => 'main/API/registered/$1',
    'api/stat/ads/get/([A-Za-z]+)' => 'main/API/adsNumber/$1',
    'api/stat/ads/active/([A-Za-z]+)' => 'main/API/adsActiveNumber/$1',
    'api/stat/trans/close/get/([A-Za-z]+)' => 'main/API/trans/$1',
    'api/items/my' => 'main/API/myAds',
    'api/items/add' => 'main/API/itemsAdd',
    'api/items/update' => 'main/API/itemsUpdate',
    'api/favorite/add' => 'main/API/adInFavorite',
    'api/favorite/remove' => 'main/API/adOutFavorite',
    'api/favorite/list' => 'main/API/listFavorite',
    'api/support/add_ticket' => 'main/API/addTicket',
    'api/messages/dialogs' => 'main/API/getDialogs',
    'api/messages/history' => 'main/API/getMessagesFromDB',
    'api/profile/get/profile' => 'main/API/getPersonalInfo',
    'api/restore/step_([0-9])' => 'main/API/PasswordRestore/$1',
    'api/profile/get/security' => 'main/API/getPersonalInfoSecurity',
    'api/profile/get/settings' => 'main/API/getPersonalInfoSettings',
    'api/profile/save/profile' => 'main/API/savePersonalInfo',
    'api/profile/save/security' => 'main/API/savePassword',
    'api/profile/save/settings' => 'main/API/savePersonalInfoSettings',
    'api/authenticator/create/secret' => 'main/API/createGASecret',
    'api/authenticator/save' => 'main/API/saveGA',
    'api/authenticator/verify' => 'main/API/verifyGACode',
    'api/sms.sendActivateCode' => 'main/API/sendActivateSMSCode',
    'api/sms.activate2FA' => 'main/API/verifySMSActivateCode',
    'api/sms.AuthByCode' => 'main/API/AuthBySMSCode',
    'api/items.setActive' => 'main/API/itemActive',
    'api/items.setUnActive' => 'main/API/itemUnActive',
    'api/items.delete' => 'main/API/itemDelete',
    'api/upload.File' => 'main/API/uploadFile',
    'api/items.getById' => 'main/API/itemGetById',
];
