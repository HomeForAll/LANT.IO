<div class="visitor-statistics">
    <div class="container-w-2">
        <p>Прямо сейчас с нами: Вы и еще<span><?php echo $siteModel->getRegisteredUsers(); ?></span>пользователей
        </p>
        <ul>
            <li><img src="/template/images/sec-4-1.png"
                     alt="icon"><?php echo $siteModel->getUniquePeopleThisDay(); ?>
                <p>Людей зашло сегодня</p>
            </li>
            <li><img src="/template/images/sec-4-2.png" alt="icon"><?php echo $siteModel->getNumberOfAds(); ?>
                <p>объявлений выложено</p>
            </li>
            <li><img src="/template/images/sec-4-3.png" alt="icon">11 345
                <p>объявлений в вашем городе</p>
            </li>
            <li><img src="/template/images/sec-4-4.png"
                     alt="icon"><?php echo $siteModel->getActiveDialogs(); ?>
                <p>активных сделак сейчас</p>
            </li>
        </ul>
        <div class="schedule">
            <div class="schedule-interface">
                <div class="year-schedule-interface"></div>
            </div>
            <!-- График n3-charts -->
            <!--  <div class="container" ng-app="schedule" ng-controller="ExampleCtrl">
                  <linechart data="data" options="options"></linechart>
              </div> -->
            <a><span id="yellow"></span>Октябрь</a>
            <a><span id="green"></span>Ноябрь</a>
            <a><span id="blue"></span>Декабрь</a>
        </div>
    </div>
</div>