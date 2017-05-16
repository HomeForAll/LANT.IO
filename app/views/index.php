<?php
$this->title = 'Главная';

//$this->printInPre($this->data);

foreach ($this->model('SiteModel')->getAds(12) as $ad) {
    $ad['preview_img'] = explode("|", $ad['preview_img']);

    $short_len = 100;

    if (strlen($ad['content']) > $short_len) {
        if($short_content_position = strpos($ad['content'], ' ', $short_len)){
            $short_content = substr($ad['content'], 0, $short_content_position);
        } else{
            $short_content = $ad['content'];
        }
    } else {
        $short_content = $ad['content'];
    }

    $ad['content'] = $short_content;
?>

    <div class="block-apartments">
        <img src="<?php echo '/uploads/images/' . $ad['preview_img'][0]; ?>" alt="apartments">
        <span><?php echo $ad['title']?></span>
        <div class="price-of-apartments-and-show-apartments">
            <div class="price-of-apartments">
                <span><?php echo $ad['price']; ?> <i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                <div class="location">
                    <p><img src="../../template/images/m.png" alt="img">Рижская</p>
                    <span><img src="../../template/images/people.png" alt="img"><?php echo !empty($ad['distance_from_mkad_or_metro']) ? $ad['distance_from_mkad_or_metro'] : $ad['distance_from_metro'] ?> мин</span>
                </div>
            </div>
            <div class="show-apartments">
                <a href="#"><img src="../../template/images/show.png" alt="show"></a>
            </div>
        </div>
        <p><?php echo $ad['content'] . '...'; ?></p>
    </div>

<?php } ?>
