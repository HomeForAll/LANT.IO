
    <div class="visitor-statistics">
        <div class="container-w-2">
            <p>Прямо сейчас с нами: Вы и еще<span><?php echo $siteModel->getRegisteredUsers(); ?></span>пользователей
            </p>
            <ul>
                <li><img src="../../template/images/sec-4-1.png"
                         alt="icon"><?php echo $siteModel->getUniquePeopleThisDay(); ?>
                    <p>Людей зашло сегодня</p>
                </li>
                <li data-for="schedule-all"><img src="../../template/images/sec-4-2.png" alt="icon"><?php echo $siteModel->getNumberOfAds(); ?>
                    <p>объявлений выложено</p>
                </li>
                <li data-for="schedule-in-city"><img src="../../template/images/sec-4-3.png" alt="icon">11 345
                    <p>объявлений в вашем городе</p>
                </li>
                <li><img src="../../template/images/sec-4-4.png"
                         alt="icon"><?php echo $siteModel->getActiveDialogs(); ?>
                    <p>активных сделак сейчас</p>
                </li>
            </ul>
            <div class="schedule" id="schedule-all">
                <div class="schedule-interface">
                    <div class="chart-lines">
                        <div id="chart-line-1" class="chart-line" data-chart='{"fill":["rgba(139,191,227,0.7)"],"data":[479,466,228,251,384,83,500,346,110,364,391,492,82,247,220,400,67,217,83,441,493,92,296,326,242,356,74,427,183,388]}'></div>
                        <div id="chart-line-2" class="chart-line" data-chart='{"fill":["rgba(116,209,87,0.7)"],"data":[254,459,73,178,324,368,420,62,421,100,483,370,309,138,359,149,418,303,366,434,71,195,158,273,136,75,493,260,380,427]}'></div>
                        <div id="chart-line-3" class="chart-line" data-chart='{"fill":["rgba(255,237,83,0.7)"],"data":[318,152,228,294,98,173,84,119,331,280,415,77,122,293,215,321,120,254,462,339,309,424,149,285,456,403,257,88,107,454]}'></div>
                    </div>
                </div>
                <a data-for="chart-line-3"><span id="yellow"></span>Октябрь</a>
                <a data-for="chart-line-2"><span id="green"></span>Ноябрь</a>
                <a data-for="chart-line-1"><span id="blue"></span>Декабрь</a>
            </div>
            <div class="schedule" id="schedule-in-city">
                <div class="schedule-interface">
                    <div class="chart-lines">
                        <div id="chart-line-4" class="chart-line" data-chart='{"fill":["rgba(139,191,227,0.7)"],"data":[173,63,183,67,234,118,27,148,131,151,228,113,169,222,181,236,236,254,263,86,76,26,148,217,137,21,216,197,164,20]}'></div>
                        <div id="chart-line-5" class="chart-line" data-chart='{"fill":["rgba(116,209,87,0.7)"],"data":[93,222,66,263,21,71,237,89,39,117,248,90,31,282,195,117,26,64,33,161,189,227,141,72,266,271,194,124,143,117]}'></div>
                        <div id="chart-line-6" class="chart-line" data-chart='{"fill":["rgba(255,237,83,0.7)"],"data":[163,253,60,238,266,239,234,82,290,220,151,251,264,257,48,173,73,272,21,261,23,45,26,226,283,59,161,199,35,95]}'></div>
                    </div>
                </div>
                <a data-for="chart-line-6"><span id="yellow"></span>Октябрь</a>
                <a data-for="chart-line-5"><span id="green"></span>Ноябрь</a>
                <a data-for="chart-line-4"><span id="blue"></span>Декабрь</a>
            </div>
        </div>
    </div>
    
    
<link rel="stylesheet" href="/template/layouts/visitor-statistics/visitor-statistics.css">