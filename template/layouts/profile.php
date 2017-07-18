<!DOCTYPE html>
<html lang="ru"><head><meta charset="utf-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, width=device-width, height=device-height">
<title>Личный кабинет</title>
<link rel="icon" type="image/png" href="/template/favicon.png">
<link rel="shortcut icon" type="image/png" href="/template/favicon.png">
<link rel="stylesheet" href="/template/css/main.css">
<link rel="stylesheet" href="/template/profile/profile.css">
</head>
<body>
<?php include_once ROOT_DIR . '/template/lucia/lucia.svg' ?>
<div class="ax-loading"></div>


<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: none;">
    <symbol id="sidebar-icon-1" width="22" height="19" viewBox="0 0 22 19" fill="currentColor">
        <defs>
            <path id="a" d="M.003 18.318h21.955V.014H.003z"/>
        </defs>
        <g fill="none" fill-rule="evenodd" opacity=".23">
            <g transform="translate(0 .68)">
                <mask id="b" fill="#fff"><use xlink:href="#a"/></mask>
                <path fill="#FFF" d="M3.659 16.49a9.11 9.11 0 0 1-1.829-5.492c0-5.055 4.096-9.153 9.149-9.153 5.053 0 9.149 4.098 9.149 9.153a9.11 9.11 0 0 1-1.83 5.492H3.658zm15.788 1.498a10.944 10.944 0 0 0 2.51-6.99C21.958 4.932 17.043.014 10.98.014 4.915.014 0 4.932 0 10.998c0 2.587.897 5.037 2.51 6.99.174.21.432.333.705.333h15.527a.915.915 0 0 0 .705-.333z" mask="url(#b)"/>
                <path fill="#FFF" d="M10.064.93v3.66a.915.915 0 1 0 1.83 0V.93a.915.915 0 1 0-1.83 0M.915 11.914h3.66a.915.915 0 0 0 0-1.831H.914a.915.915 0 0 0 0 1.83" mask="url(#b)"/>
            </g>
            <path fill="#FFF" d="M17.357 12.693h3.654c.505 0 .914-.42.914-.939a.926.926 0 0 0-.914-.938h-3.654a.926.926 0 0 0-.913.938c0 .519.409.939.913.939M3.192 5.147l1.275 1.275a.902.902 0 1 0 1.276-1.275L4.468 3.872a.902.902 0 0 0-1.276 1.275M17.457 3.872l-1.275 1.275a.902.902 0 1 0 1.275 1.275l1.275-1.275a.902.902 0 0 0-1.275-1.275M11.15 13.519l-2.59-2.59 5.18-2.591-2.59 5.18"/>
        </g>
    </symbol>

    <symbol id="sidebar-icon-2" width="17" height="18" viewBox="0 0 17 18">
        <path fill="#FFF" fill-rule="evenodd" d="M8.367 2.306c1.256 0 2.197.939 2.197 2.195 0 1.257-.94 2.197-2.197 2.197-1.252 0-2.196-.94-2.196-2.197 0-1.256.944-2.195 2.196-2.195zm0 9.414c3.142 0 6.385 1.573 6.385 2.195v1.155H1.988v-1.155c0-.622 3.243-2.195 6.379-2.195zm0-11.402A4.199 4.199 0 0 0 4.183 4.5a4.196 4.196 0 0 0 4.184 4.184c2.304 0 4.19-1.88 4.19-4.184 0-2.299-1.886-4.183-4.19-4.183zm0 9.414C5.542 9.732 0 11.091 0 13.915v3.143h16.74v-3.143c0-2.824-5.547-4.183-8.373-4.183z" opacity=".2"/>
    </symbol>
    <symbol id="sidebar-icon-3" width="19" height="19" viewBox="0 0 19 19">
        <defs>
            <path id="a" d="M.002 18.708h18.706V0H.002z"/>
        </defs>
        <g fill="none" fill-rule="evenodd" opacity=".2">
            <g>
                <mask id="b" fill="#fff">
                    <use xlink:href="#a"/>
                </mask>
                <path fill="#FFF" d="M1.17 17.538V1.17h11.692v4.093c0 .322.261.584.584.584h4.092v11.692H1.17zM14.03 1.996l2.682 2.68H14.03v-2.68zm4.506 2.852L13.86.171A.583.583 0 0 0 13.446 0H.585A.585.585 0 0 0 0 .585v17.538c0 .323.262.585.585.585h17.538a.585.585 0 0 0 .585-.585V5.262a.583.583 0 0 0-.172-.414z" mask="url(#b)"/>
            </g>
            <path fill="#FFF" d="M3.508 9.354H15.2v-1.17H3.508zM3.508 12.277H15.2v-1.17H3.508zM3.508 15.2H15.2v-1.17H3.508zM3.508 4.092H6.43V2.923H3.508zM3.508 5.846H6.43v-1.17H3.508z"/>
        </g>
    </symbol>

    <symbol id="sidebar-icon-4" width="22" height="19" viewBox="0 0 22 19">
        <g fill="#FFF" fill-rule="evenodd" opacity=".12">
            <path d="M2.91 2.03c-.624 0-1.133.509-1.133 1.135v12.15c0 .625.509 1.135 1.134 1.135h16.178c.625 0 1.134-.51 1.134-1.135V3.165c0-.626-.509-1.135-1.134-1.135H2.911zm16.18 16.2H2.91A2.916 2.916 0 0 1 0 15.314V3.165A2.916 2.916 0 0 1 2.91.25h16.18A2.916 2.916 0 0 1 22 3.165v12.15a2.916 2.916 0 0 1-2.91 2.914z"/>
            <path d="M11 11.174a.886.886 0 0 1-.51-.16L.38 3.918a.892.892 0 0 1-.22-1.24.887.887 0 0 1 1.238-.22L11 9.196l9.602-6.737a.887.887 0 0 1 1.237.22.892.892 0 0 1-.218 1.24L11.51 11.013a.886.886 0 0 1-.51.161"/>
        </g>
    </symbol>

</svg>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">

    <symbol id="i-metro" width="19" height="13" viewBox="0 0 19 13" fill="currentColor">
        <path fill="currentColor" fill-rule="nonzero" d="M12.95.055h-.149l-3.17 6.378L6.347 0 1.851 11.62H.689v.934h6.366v-.933H5.792l1.263-3.632 2.576 4.565 2.476-4.565 1.263 3.632h-1.263v.933h6.315v-.933h-1.094z"/>
    </symbol>
    <symbol id="i-afoot" width="8" height="12" viewBox="0 0 8 12" fill="currentColor">
        <path fill="#292621" fill-rule="evenodd" d="M4.5.006a1.375 1.375 0 0 0-.377.017.85.85 0 0 0-.605.573.665.665 0 0 0-.033.37c.007.071.018.142.033.211.135.289.367.519.655.649.167.092.43.287.713.202a.892.892 0 0 0 .596-.548c.02-.05.015-.107.033-.16a.92.92 0 0 0 0-.463 1.398 1.398 0 0 0-.352-.564 1.36 1.36 0 0 0-.42-.236A1.292 1.292 0 0 1 4.5.006zm-1.502 3.27v1.903c0 .275-.03.665.084.826.066.082.14.158.218.228l.402.404L4.91 7.86l.428.43a.89.89 0 0 1 .278.37c.03.096.04.191.067.278v.06c.096.26.124.573.218.833v.06c.028.088.053.208.084.294.019.05-.001.085.017.135.031.084.053.202.084.287.018.05-.001.084.017.135.055.15.078.348.134.496a.98.98 0 0 0 .05.177.62.62 0 0 0 .739.27.686.686 0 0 0 .352-.396c.02-.253-.02-.507-.117-.741-.018-.049-.002-.08-.017-.127-.043-.133-.07-.299-.118-.43-.017-.048 0-.076-.016-.126-.029-.09-.056-.204-.084-.295V9.51c-.144-.392-.176-.863-.319-1.255-.018-.05.001-.085-.017-.135-.046-.126-.072-.289-.117-.413a.981.981 0 0 0-.034-.152.664.664 0 0 0-.117-.117c-.02-.02-.03-.049-.05-.068-.07-.07-.149-.132-.219-.202a75.774 75.774 0 0 1-.79-.809l-.293-.295a.368.368 0 0 1-.126-.151V2.879a1.71 1.71 0 0 0-.017-.295.754.754 0 0 0-.369-.286 7.578 7.578 0 0 0-.528-.32.685.685 0 0 0-.613-.017c-.338.2-.697.39-1.023.607-.039.025-.078.028-.118.05a6.534 6.534 0 0 0-.42.253c-.25.167-.566.26-.687.555a1.109 1.109 0 0 0-.033.39V5.34c0 .368-.062.553.15.767.014.013.02.038.034.05.04.024.082.04.126.05a.458.458 0 0 0 .579-.279c.033-.09-.007-.209.017-.311.02-.151.025-.304.016-.456V3.915c.07-.234.506-.373.705-.505a.613.613 0 0 1 .235-.135zm2.273.74c-.028.012-.024.014-.025.051v1.188c.082.132.188.246.311.337l.588.59c.082.105.178.199.285.278a.506.506 0 0 0 .528-.05.491.491 0 0 0 .05-.658c-.023-.026-.059-.043-.083-.067-.025-.025-.042-.06-.067-.085-.087-.086-.182-.165-.269-.252-.288-.29-.568-.586-.856-.877l-.335-.337a1.238 1.238 0 0 1-.126-.118zM3.15 6.562a1.136 1.136 0 0 1-.184.32c-.05.076-.068.16-.118.236-.11.167-.209.355-.319.522-.023.038-.025.08-.05.118-.074.114-.147.24-.218.355-.017.027-.016.056-.034.084-.08.123-.153.264-.235.388-.024.038-.024.08-.05.118-.306.464-.55.983-.856 1.45-.013.02-.005.037-.017.058-.032.059-.081.122-.117.177-.024.038-.026.08-.05.118-.116.159-.211.331-.286.513v.118a.59.59 0 0 0 .218.48.58.58 0 0 0 .185.085c.415.167.643-.2.79-.422.024-.037.025-.08.05-.118.042-.063.096-.137.134-.202v-.033c.37-.6.69-1.248 1.074-1.837.014-.02.005-.038.017-.06.053-.096.124-.202.185-.294.042-.065.058-.137.1-.202.118-.178.219-.379.335-.556.05-.076.068-.16.118-.236a.938.938 0 0 0 .184-.337.857.857 0 0 1-.193-.194l-.445-.447a.76.76 0 0 0-.218-.202z" opacity=".3"/>
    </symbol>

    <symbol id="i-eye" width="20" height="12" viewBox="0 0 20 12">
        <path fill="#B8B8B8" fill-rule="nonzero" d="M9.868.4C6.16.4 2.645 2.255.464 5.362L.016 6l.448.639C2.644 9.745 6.16 11.6 9.868 11.6s7.224-1.855 9.404-4.962L19.72 6l-.448-.639C17.092 2.255 13.576.4 9.868.4zm2.896 4.11c0 .605-.475 1.096-1.062 1.096-.586 0-1.061-.49-1.061-1.096 0-.605.475-1.096 1.061-1.096.587 0 1.062.49 1.062 1.096zM9.868 9.424C7.097 9.424 4.457 8.157 2.66 6a9.564 9.564 0 0 1 3.683-2.718 4.081 4.081 0 0 0-.34 1.63c0 2.203 1.731 3.99 3.865 3.99 2.134 0 3.864-1.787 3.864-3.99 0-.581-.123-1.132-.34-1.63A9.564 9.564 0 0 1 17.077 6C15.28 8.157 12.64 9.424 9.868 9.424z"/>
    </symbol>
</svg>


<div class="profile-header">
    <a href="/" class="profile-header__logo"><svg width="67px" height="30px"><use xlink:href="#logo-lantio" x="0" y="0"></use></svg></a>
    <div class="profile-header__space"></div>

    <div class="pheader__icon pheader__icon_m"><div class="pheader__counter">3</div></div>
    <div class="pheader__icon pheader__icon_n"><div class="pheader__counter">12</div></div>
    <div class="pheader__icon pheader__icon_c"></div>

    <div class="axf user-info pheader__user">
        <div>
            <div class="user-info__name">Никулин Александр</div>
            <div class="user-info__status">Пользователь +</div>
        </div>
        <img src="/template/img/user.png" alt="">
    </div>
</div>


<div class="profile-main">
    <div class="profile-sidebar">
        <a href="/profile/" class="profile-sidebar__link">
            <svg width="22" height="16"><use xlink:href="#sidebar-icon-1" x="0" y="0"></use></svg>
            Личный кабинет</a>
        <a class="profile-sidebar__link">
            <svg width="22" height="16"><use xlink:href="#sidebar-icon-2" x="0" y="0"></use></svg>
            Мой профиль</a>
        <a  href="/profile/items" class="profile-sidebar__link">
            <svg width="22" height="16"><use xlink:href="#sidebar-icon-3" x="0" y="0"></use></svg>
            Мои объявления</a>
        <a href="/profile/items/add" class="profile-sidebar__link">
            <svg width="22" height="16"><use xlink:href="#sidebar-icon-3" x="0" y="0"></use></svg>
            Дать объявление</a>
        <a class="profile-sidebar__link profile-sidebar__link_disabled">
            <svg width="22" height="16"><use xlink:href="#sidebar-icon-4" x="0" y="0"></use></svg>
            Messager <span>Скоро</span>
        </a>
        <a class="profile-sidebar__link profile-sidebar__link_disabled">
            <svg width="22" height="16"><use xlink:href="#sidebar-icon-3" x="0" y="0"></use></svg>
            Услуги <span>Скоро</span>
        </a>

    </div>
    <div class="profile-content scrollbar-inner">

<?php


if (preg_match("/profile\/([a-z0-9\/]+)/i", $_SERVER['REQUEST_URI'], $match)
    && ($match = str_replace('/', '_', $match[1]))
    && file_exists(ROOT_DIR . "/template/profile/{$match}.html")) {
    include_once ROOT_DIR . "/template/profile/{$match}.html";
} else {
    include_once ROOT_DIR . "/template/profile/dashboard.html";
}


?>

    </div>
</div>
<script src="/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/template/lucia/chosen.jquery.min.js"></script>
<script src="/template/lucia/simpleUpload.js" type="text/javascript"></script>
<script src="/template/lucia/params.js"></script>
<script src="/template/lucia/lucia.js"></script>
<script src="/template/profile/profile.js"></script>
</body>
</html>
