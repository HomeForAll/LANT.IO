<?php
$this->title = 'Поиск';

if (!empty($this->data['formData'])) {
    foreach ($this->data['formData'] as $key => $value) {
//        var_dump($value);
        ?>

        <div class="top-block">
            <div class="left-wallpaper">
                <a href="#"><img src="/uploads/images/<?php echo $value['preview_img']; ?>" alt="apartments"></a>
                <p>2-комн. кв. 134м<sup>2</sup></p>
            </div>
            <div class="right-information-block">
                <span><?php echo $value['title']; ?></span>
                <p><?php echo $value['content']; ?></p>
                <div class="price-and-view-the-apartment">
                    <div class="price">
                        <p><img src="../../template/images/m.png" alt="metro">Рижская<span><img
                                        src="../../template/images/people.png" alt=""><?php echo !empty($value['distance_from_metro']) ? $value['distance_from_metro'] : 5; ?> мин</span></p>
                        <span class="decorate-number"><?php echo $value['price']; ?><i class="fa fa-rub" aria-hidden="true"></i><sub>/мес</sub></span>
                    </div>
                    <div class="view-the-apartment">
                        <a href="#"><img src="../../template/images/show.png" alt="show"></a>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}
?>