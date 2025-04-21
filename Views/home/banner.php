<div class="main-slider-one main-slider-two slider-area">
    <div id="wrapper">
        <div class="slider-wrapper">
            <div id="mainSlider" class="nivoSlider">
                <?php $i = 2;
                foreach ($data_banner as  $value) {  ?>
                    <img src="public/<?= $value['HinhAnh'] ?>" alt="main slider" title="#htmlcaption" />
                <?php } ?>
            </div>
            <div id="htmlcaption" class="nivo-html-caption slider-caption">
                <div class="container"></div>
            </div>
        </div>
    </div>
</div>