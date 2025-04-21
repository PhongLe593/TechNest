<?php
require_once("banner.php")
?>
<div class="tab-products single-products section-padding extra-padding-top">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title text-center">
                    <div class="product-tab nav nav-tabs">
                        <ul>
                            <li class="active"><a data-toggle="tab" href="#arrival">Điện thoại <span>/</span></a></li>
                            <li><a data-toggle="tab" href="#popular">Phụ kiện<span>/</span></a></li>
                            <li><a data-toggle="tab" href="#best">Tablet</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center tab-content">
            <div class="tab-pane fade in active" id="arrival">
                <div class="wrapper">
                    <ul class="load-list load-list-two">
                        <?php
                        if (!empty($data_sanpham1)) {
                            for ($r = 0; $r < 2; $r++) {
                        ?>
                                <li>
                                    <div class="row text-center">
                                        <?php
                                        for ($i = $r * 4; $i < min((count($data_sanpham1) - 4) * $r + 4, count($data_sanpham1)); $i++) {
                                            // Kiểm tra giảm giá
                                            $discountValue = 0;
                                            if (isset($data_sanpham1[$i]['MaKM'])) {
                                                require_once("Models/cart.php");
                                                $cartModel = new Cart();
                                                $promotion = $cartModel->get_promotion($data_sanpham1[$i]['MaKM']);
                                                $discountValue = isset($promotion['GiaTriKM']) ? $promotion['GiaTriKM'] : 0;
                                                $discountedPrice = $data_sanpham1[$i]['DonGia'] - $discountValue;
                                            }
                                        ?>
                                            <div class="col-xs-12 col-sm-6 col-md-3 r-margin-top">
                                                <div class="single-product">
                                                    <div class="product-f">
                                                        <a href="?act=detail&id=<?= $data_sanpham1[$i]['MaSP'] ?>"><img src="public/<?= $data_sanpham1[$i]['HinhAnh1'] ?>" alt="Product Title" class="img-products" /></a>
                                                        <div class="actions-btn">
                                                            <a href="?act=detail&id=<?= $data_sanpham1[$i]['MaSP'] ?>"><i class="mdi mdi-cart"></i></a>
                                                            <a href="?act=detail&id=<?= $data_sanpham1[$i]['MaSP'] ?>" data-toggle="modal"><i class="mdi mdi-eye"></i></a>
                                                        </div>
                                                        <?php if ($discountValue > 0) : ?>
                                                            <span class="discount-label">GIẢM GIÁ</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="product-dsc">
                                                        <p><a href="?act=detail&id=<?= $data_sanpham1[$i]['MaSP'] ?>"><?= $data_sanpham1[$i]['TenSP'] ?></a></p>
                                                        <?php if ($discountValue > 0) : ?>
                                                            <div class="product-price-list">
                                                                <span class="current-price"><?= number_format($discountedPrice) ?> VNĐ</span>
                                                                <span class="original-price"><del><?= number_format($data_sanpham1[$i]['DonGia']) ?> VNĐ</del></span>
                                                                <span class="discount-percent">-<?= round(($discountValue / $data_sanpham1[$i]['DonGia']) * 100) ?>%</span>
                                                            </div>
                                                        <?php else : ?>
                                                            <span><?= number_format($data_sanpham1[$i]['DonGia']) ?> VNĐ</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </li>
                        <?php
                            }
                        } else {
                            echo "";
                        } ?>
                        <li>
                            <h4>
                                <a href="?act=shop">Vào cửa hàng để xem nhiều hơn!</a>
                            </h4>
                        </li>
                    </ul>
                    <button id="load-more-two">Xem thêm</button>
                </div>
            </div>

            <div class="tab-pane fade" id="popular">
                <div class="wrapper">
                    <ul class="load-list load-list-three">
                        <?php
                        if (!empty($data_sanpham2)) {
                            for ($r = 0; $r < 2; $r++) {
                        ?>
                                <li>
                                    <div class="row text-center">
                                        <?php
                                        for ($i = $r * 4; $i < min((count($data_sanpham2) - 4) * $r + 4, count($data_sanpham2)); $i++) {
                                            // Kiểm tra giảm giá
                                            $discountValue = 0;
                                            if (isset($data_sanpham2[$i]['MaKM'])) {
                                                require_once("Models/cart.php");
                                                $cartModel = new Cart();
                                                $promotion = $cartModel->get_promotion($data_sanpham2[$i]['MaKM']);
                                                $discountValue = isset($promotion['GiaTriKM']) ? $promotion['GiaTriKM'] : 0;
                                                $discountedPrice = $data_sanpham2[$i]['DonGia'] - $discountValue;
                                            }
                                        ?>
                                            <div class="col-xs-12 col-sm-6 col-md-3 r-margin-top">
                                                <div class="single-product">
                                                    <div class="product-f">
                                                        <a href="?act=detail&id=<?= $data_sanpham2[$i]['MaSP'] ?>"><img src="public/<?= $data_sanpham2[$i]['HinhAnh1'] ?>" alt="Product Title" class="img-products" /></a>
                                                        <div class="actions-btn">
                                                            <a href="?act=detail&id=<?= $data_sanpham2[$i]['MaSP'] ?>"><i class="mdi mdi-cart"></i></a>
                                                            <a href="?act=detail&id=<?= $data_sanpham2[$i]['MaSP'] ?>" data-toggle="modal"><i class="mdi mdi-eye"></i></a>
                                                        </div>
                                                        <?php if ($discountValue > 0) : ?>
                                                            <span class="discount-label">GIẢM GIÁ</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="product-dsc">
                                                        <p><a href="?act=detail&id=<?= $data_sanpham2[$i]['MaSP'] ?>"><?= $data_sanpham2[$i]['TenSP'] ?></a></p>
                                                        <?php if ($discountValue > 0) : ?>
                                                            <div class="product-price-list">
                                                                <span class="current-price"><?= number_format($discountedPrice) ?> VNĐ</span>
                                                                <span class="original-price"><del><?= number_format($data_sanpham2[$i]['DonGia']) ?> VNĐ</del></span>
                                                                <span class="discount-percent">-<?= round(($discountValue / $data_sanpham2[$i]['DonGia']) * 100) ?>%</span>
                                                            </div>
                                                        <?php else : ?>
                                                            <span><?= number_format($data_sanpham2[$i]['DonGia']) ?> VNĐ</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </li>
                        <?php
                            }
                        } else {
                            echo "";
                        } ?>
                        <li>
                            <h4>
                                <a href="?act=shop">Vào cửa hàng để xem nhiều hơn!</a>
                            </h4>
                        </li>
                    </ul>
                    <button id="load-more-three">Tải thêm</button>
                </div>
            </div>

            <div class="tab-pane fade" id="best">
                <div class="wrapper">
                    <ul class="load-list load-list-four">
                        <?php
                        if (!empty($data_sanpham3)) {
                            for ($r = 0; $r < 2; $r++) {
                        ?>
                                <li>
                                    <div class="row text-center">
                                        <?php
                                        for ($i = $r * 4; $i < min((count($data_sanpham3) - 4) * $r + 4, count($data_sanpham3)); $i++) {
                                            // Kiểm tra giảm giá
                                            $discountValue = 0;
                                            if (isset($data_sanpham3[$i]['MaKM'])) {
                                                require_once("Models/cart.php");
                                                $cartModel = new Cart();
                                                $promotion = $cartModel->get_promotion($data_sanpham3[$i]['MaKM']);
                                                $discountValue = isset($promotion['GiaTriKM']) ? $promotion['GiaTriKM'] : 0;
                                                $discountedPrice = $data_sanpham3[$i]['DonGia'] - $discountValue;
                                            }
                                        ?>
                                            <div class="col-xs-12 col-sm-6 col-md-3 r-margin-top">
                                                <div class="single-product">
                                                    <div class="product-f">
                                                        <a href="?act=detail&id=<?= $data_sanpham3[$i]['MaSP'] ?>"><img src="public/<?= $data_sanpham3[$i]['HinhAnh1'] ?>" alt="Product Title" class="img-products" /></a>
                                                        <div class="actions-btn">
                                                            <a href="?act=detail&id=<?= $data_sanpham3[$i]['MaSP'] ?>"><i class="mdi mdi-cart"></i></a>
                                                            <a href="?act=detail&id=<?= $data_sanpham3[$i]['MaSP'] ?>" data-toggle="modal"><i class="mdi mdi-eye"></i></a>
                                                        </div>
                                                        <?php if ($discountValue > 0) : ?>
                                                            <span class="discount-label">GIẢM GIÁ</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="product-dsc">
                                                        <p><a href="?act=detail&id=<?= $data_sanpham3[$i]['MaSP'] ?>"><?= $data_sanpham3[$i]['TenSP'] ?></a></p>
                                                        <?php if ($discountValue > 0) : ?>
                                                            <div class="product-price-list">
                                                                <span class="current-price"><?= number_format($discountedPrice) ?> VNĐ</span>
                                                                <span class="original-price"><del><?= number_format($data_sanpham3[$i]['DonGia']) ?> VNĐ</del></span>
                                                                <span class="discount-percent">-<?= round(($discountValue / $data_sanpham3[$i]['DonGia']) * 100) ?>%</span>
                                                            </div>
                                                        <?php else : ?>
                                                            <span><?= number_format($data_sanpham3[$i]['DonGia']) ?> VNĐ</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </li>
                        <?php
                            }
                        } else {
                            echo "";
                        } ?>
                        <li>
                            <h4>
                                <a href="?act=shop">Vào cửa hàng để xem nhiều hơn!</a>
                            </h4>
                        </li>
                    </ul>
                    <button id="load-more-four">Tải thêm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="collection-area collection-area2 section-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <?php if (isset($data_random[0])): ?>
                    <div class="single-colect banner collect-one">
                        <a href="?act=detail&id=<?= $data_random[0]['MaSP'] ?>"><img src="public/<?= $data_random[0]['HinhAnh1'] ?>" alt="" /></a>
                    </div>
                <?php else: ?>
                    <p>Không có sản phẩm.</p>
                <?php endif; ?>
            </div>
            <div class="col-sm-4">
                <?php if (isset($data_random[0])): ?>
                    <div class="colect-text">
                        <h4><a href="#"><?= $data_random[0]['TenSP'] ?></a></h4>
                        <?php
                        // Kiểm tra giảm giá cho sản phẩm ngẫu nhiên
                        $discountValue = 0;
                        if (isset($data_random[0]['MaKM'])) {
                            require_once("Models/cart.php");
                            $cartModel = new Cart();
                            $promotion = $cartModel->get_promotion($data_random[0]['MaKM']);
                            $discountValue = isset($promotion['GiaTriKM']) ? $promotion['GiaTriKM'] : 0;
                            $discountedPrice = $data_random[0]['DonGia'] - $discountValue;
                        }
                        ?>
                        <?php if ($discountValue > 0) : ?>
                            <h4 class="current-price"><?= number_format($discountedPrice) ?> VNĐ</h4>
                            <p class="original-price"><del><?= number_format($data_random[0]['DonGia']) ?> VNĐ</del></p>
                            <span class="discount-percent-banner">-<?= round(($discountValue / $data_random[0]['DonGia']) * 100) ?>%</span>
                        <?php else : ?>
                            <h4><?= number_format($data_random[0]['DonGia'] ?? 0) ?> VNĐ</h4>
                        <?php endif; ?>
                        <a href="?act=detail&id=<?= $data_random[0]['MaSP'] ?>">Mua ngay <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                    <div class="collect-img banner margin single-colect">
                        <a href="#"><img src="public/<?= $data_random[0]['HinhAnh2'] ?>" alt="" /></a>
                    </div>
                <?php else: ?>
                    <p>Không có thông tin sản phẩm.</p>
                <?php endif; ?>
            </div>
            <div class="col-sm-4">
                <?php if (isset($data_random[1])): ?>
                    <div class="collect-img banner single-colect">
                        <a href="?act=detail&id=<?= $data_random[1]['MaSP'] ?>"><img src="public/<?= $data_random[1]['HinhAnh1'] ?>" alt="" /></a>
                    </div>
                    <div class="colect-text">
                        <h4><a href="?act=detail&id=<?= $data_random[1]['MaSP'] ?>"><?= $data_random[1]['TenSP'] ?></a></h4>
                        <h5>Giá: <?= number_format($data_random[1]['DonGia'] ?? 0) ?> VNĐ</h5>
                        <a href="?act=detail&id=<?= $data_random[1]['MaSP'] ?>">Mua ngay <i class="mdi mdi-arrow-right"></i></a>
                    </div>
                <?php else: ?>
                    <p>Không có sản phẩm.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section class="single-products  products-two section-padding extra-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-title text-center">
                    <div class="product-tab nav nav-tabs">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <ul class="load-list load-list-one">
                <?php for ($i = 0; $i < 4; $i++) { ?>
                    <li>
                        <div class="row text-center">
                            <?php
                            if ($data_arr[$i] != null) {
                                foreach ($data_arr[$i] as  $row) { 
                                    // Kiểm tra giảm giá
                                    $discountValue = 0;
                                    if (isset($row['MaKM'])) {
                                        require_once("Models/cart.php");
                                        $cartModel = new Cart();
                                        $promotion = $cartModel->get_promotion($row['MaKM']);
                                        $discountValue = isset($promotion['GiaTriKM']) ? $promotion['GiaTriKM'] : 0;
                                        $discountedPrice = $row['DonGia'] - $discountValue;
                                    }
                                ?>
                                    <div class="col-xs-12 col-sm-6 col-md-3 r-margin-top">
                                        <div class="single-product">
                                            <div class="product-f">
                                                <a href="?act=detail&id=<?= $row['MaSP'] ?>"><img src="public/<?= $row['HinhAnh1'] ?>" alt="Product Title" class="img-products" /></a>
                                                <div class="actions-btn">
                                                    <a href="?act=detail&id=<?= $row['MaSP'] ?>"><i class="mdi mdi-cart"></i></a>
                                                    <a href="?act=detail&id=<?= $row['MaSP'] ?>" data-toggle="modal"><i class="mdi mdi-eye"></i></a>
                                                </div>
                                                <?php if ($discountValue > 0) : ?>
                                                    <span class="discount-label">GIẢM GIÁ</span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="product-dsc">
                                                <p><a href="?act=detail&id=<?= $row['MaSP'] ?>"><?= $row['TenSP'] ?></a></p>
                                                <?php if ($discountValue > 0) : ?>
                                                    <div class="product-price-list">
                                                        <span class="current-price"><?= number_format($discountedPrice) ?> VNĐ</span>
                                                        <span class="original-price"><del><?= number_format($row['DonGia']) ?> VNĐ</del></span>
                                                        <span class="discount-percent">-<?= round(($discountValue / $row['DonGia']) * 100) ?>%</span>
                                                    </div>
                                                <?php else : ?>
                                                    <span><?= number_format($row['DonGia']) ?> VNĐ</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </li>
                <?php } ?>
            </ul>
            <button id="load-more-one">Tải thêm</button>
        </div>
    </div>
</section>
