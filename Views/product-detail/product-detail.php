<?php if ($data != null) { ?>
    <div class="pages-title section-padding">
        <div class="container">
            <ul class="text-left">
                <li><a href="?act=home">Trang chủ</a></li>
                <li><span> // </span><a href="?act=shop">Cửa Hàng</a></li>
                <li><span> // </span><?= $data['TenSP'] ?></li>
            </ul>
        </div>
    </div>

    <div class="product-details pages section-padding-top">
        <div class="container">
            <div class="row">
                <div class="single-list-view">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="quick-image">
                            <div class="single-quick-image text-center">
                                <div class="list-img">
                                    <div class="product-f tab-content">
                                        <?php if ($data['HinhAnh2'] !=  null) { ?>
                                            <div class="simpleLens-container tab-pane fade in" id="sin-1">
                                                <a class="simpleLens-image" data-lens-image="public/<?= $data['HinhAnh2'] ?>" href="#"><img src="public/<?= $data['HinhAnh2'] ?>" alt="" class="simpleLens-big-image"></a>
                                            </div>
                                        <?php } ?>
                                        <?php if ($data['HinhAnh1'] != null) { ?>
                                            <div class="simpleLens-container tab-pane active fade in" id="sin-2">
                                                <a class="simpleLens-image" data-lens-image="public/<?= $data['HinhAnh1'] ?>" href="#"><img src="public/<?= $data['HinhAnh1'] ?>" alt="" class="simpleLens-big-image"></a>
                                            </div>
                                        <?php } ?>
                                        <?php if ($data['HinhAnh3'] != null) { ?>
                                            <div class="simpleLens-container tab-pane fade in" id="sin-3">
                                                <a class="simpleLens-image" data-lens-image="public/<?= $data['HinhAnh3'] ?>" href="#"><img src="public/<?= $data['HinhAnh3'] ?>" alt="" class="simpleLens-big-image"></a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="quick-thumb">
                                <ul class="product-slider">
                                    <?php if ($data['HinhAnh2'] != null) { ?>
                                        <li class="active"><a data-toggle="tab" href="#sin-1"> <img src="public/<?= $data['HinhAnh2'] ?>" alt="quick view" /> </a></li>
                                    <?php } ?>
                                    <?php if ($data['HinhAnh1'] != null) { ?>
                                        <li><a data-toggle="tab" href="#sin-2"> <img src="public/<?= $data['HinhAnh1'] ?>" alt="small image" /> </a></li>
                                    <?php } ?>
                                    <?php if ($data['HinhAnh3'] != null) { ?>
                                        <li><a data-toggle="tab" href="#sin-3"> <img src="public/<?= $data['HinhAnh3'] ?>" alt="small image" /> </a></li>
                                    <?php } ?>
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="list-text">
                            <h3><?= $data['TenSP'] ?></h3>

                            <!-- Thêm thông tin thương hiệu và chi tiết sản phẩm -->
                            <div class="product-meta">
                                <?php if (isset($data['ThuongHieu'])) : ?>
                                    <div class="product-brand">
                                        <span>Thương hiệu:</span> <strong><?= $data['ThuongHieu'] ?? 'Chưa cập nhật' ?></strong>
                                    </div>
                                <?php endif; ?>
                                <!-- Hiển thị mã sản phẩm -->
                                <div class="product-sku">
                                    <span>Mã sản phẩm:</span> <?= $data['MaSP'] ?>
                                </div>
                                <!-- Tình trạng còn/hết hàng -->
                                <div class="product-stock">
                                    <span>Tình trạng:</span>
                                    <?php if (isset($data['SoLuong']) && $data['SoLuong'] > 0) : ?>
                                        <span class="in-stock"><i class="fas fa-check-circle"></i> Còn hàng</span>
                                    <?php else : ?>
                                        <span class="out-of-stock"><i class="fas fa-times-circle"></i> Hết hàng</span>
                                    <?php endif; ?>
                                </div>
                                <div class="product-stock">
                                    <span>Số lượng sản phẩm trong kho:</span>
                                    <span class="in-stock"><i class="fas fa-check-circle"></i> <?= $data['SoLuong'] ?></span>
                                </div>
                            </div>

                            <?php
                            if (isset($data['MaKM'])) {
                                require_once("Models/cart.php");
                                $cartModel = new Cart();
                                $promotion = $cartModel->get_promotion($data['MaKM']);
                                $discountValue = isset($promotion['GiaTriKM']) ? $promotion['GiaTriKM'] : 0;
                                $discountedPrice = $data['DonGia'] - $discountValue;
                            } else {
                                $discountValue = 0;
                                $discountedPrice = $data['DonGia'];
                            }
                            ?>
                            <div class="product-price">
                                <?php if ($discountValue > 0) : ?>
                                    <h5 class="current-price"><?= number_format($discountedPrice) ?> VNĐ</h5>
                                    <p class="original-price"><del><?= number_format($data['DonGia']) ?> VNĐ</del></p>
                                    <span class="discount-badge">
                                        -<?= round(($discountValue / $data['DonGia']) * 100) ?>%
                                    </span>
                                    <p class="promotion-name"><?= isset($promotion['TenKM']) ? $promotion['TenKM'] : '' ?></p>
                                <?php else : ?>
                                    <h4><?= number_format($data['DonGia']) ?> VNĐ</h4>
                                <?php endif; ?>
                            </div>

                            <div class="list-btn">
                                <a href="javascript:void(0);" onclick="checkStockAndAddToCart(<?= $data['MaSP'] ?>, <?= $data['SoLuong'] ?? 0 ?>)">Thêm vào giỏ</a>
                                <!-- Thêm nút mua ngay -->
                                <a href="javascript:void(0);" onclick="checkStockAndBuyNow(<?= $data['MaSP'] ?>, <?= $data['SoLuong'] ?? 0 ?>)" class="buy-now">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="product-commnit">
                            <div class="header">TechNest cam kết</div>
                            <div class="item">
                                <i class="fas fa-box"></i>
                                <p>Bộ sản phẩm gồm: Hộp, sách hướng dẫn, cây lấy sim, ốp lưng, cáp sạc, củ sạc nhanh</p>
                            </div>
                            <div class="item">
                                <i class="fas fa-sync-alt"></i>
                                <p>Hư gì đổi nấy <strong>12 tháng</strong> tại các chi nhánh toàn quốc (miễn phí tháng đầu) <a href="#">Xem chi tiết</a></p>
                            </div>
                            <div class="item">
                                <i class="fas fa-shield-alt"></i>
                                <p>Bảo hành <strong>chính hãng điện thoại 18 tháng</strong> tại các trung tâm bảo hành hãng <a href="#">Xem địa chỉ bảo hành</a></p>
                            </div>
                            <!-- Thêm thông tin giao hàng -->
                            <div class="item">
                                <i class="fas fa-truck"></i>
                                <p>Giao hàng tận nơi <strong>miễn phí</strong> với đơn hàng từ <strong>500.000đ</strong></p>
                            </div>
                            <!-- Thêm thông tin thanh toán -->
                            <div class="item">
                                <i class="fas fa-credit-card"></i>
                                <p>Hỗ trợ thanh toán: Tiền mặt, chuyển khoản, trả góp 0% qua thẻ tín dụng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="reviews margin-top">
                        <ul class="reviews-tab clearfix" id="info">
                            <?php if ($data['MaDM'] != 2) { ?>
                                <li class="active"><a data-toggle="tab" href="#moreinfo">Thông số kỹ thuật</a></li>
                            <?php } ?>
                            <!-- Thêm tab mô tả chi tiết -->
                            <li><a data-toggle="tab" href="#description">Mô tả chi tiết</a></li>
                            <!-- Thêm tab hướng dẫn sử dụng -->
                            <li><a data-toggle="tab" href="#usage">Hướng dẫn sử dụng</a></li>
                        </ul>
                        <div class="tab-content">
                            <?php if ($data['MaDM'] != 2) { ?>
                                <div class="info-reviews moreinfo tab-pane fade in active" id="moreinfo">
                                    <div class="tb">
                                        <ul>
                                            <li>
                                                <span>Màn hình</span>
                                                <div><?= $data['ManHinh'] ?></div>
                                            </li>
                                            <li>
                                                <span>Chip</span>
                                                <div><?= $data['CPU'] ?></div>
                                            </li>
                                            <li>
                                                <span>Ram</span>
                                                <div><?= $data['Ram'] ?></div>
                                            </li>
                                            <li>
                                                <span>Bộ nhớ trong</span>
                                                <div><?= $data['Rom'] ?></div>
                                            </li>
                                            <li>
                                                <span>Pin</span>
                                                <div><?= $data['Pin'] ?></div>
                                            </li>
                                            <li>
                                                <span>Camera trước</span>
                                                <div><?= $data['CamTruoc'] ?></div>
                                            </li>
                                            <li>
                                                <span>Camera sau</span>
                                                <div><?= $data['CamSau'] ?></div>
                                            </li>
                                            <li>
                                                <span>Thẻ nhớ</span>
                                                <div><?= $data['SDCard'] ?></div>
                                            </li>
                                            <li>
                                                <span>Hệ điều hành</span>
                                                <div><?= $data['HDH'] ?></div>
                                            </li>
                                            <!-- Thêm các thông số kỹ thuật khác -->
                                            <li>
                                                <span>Kết nối</span>
                                                <div><?= isset($data['KetNoi']) ? $data['KetNoi'] : 'Wifi, Bluetooth, NFC, GPS' ?></div>
                                            </li>
                                            <li>
                                                <span>Kích thước</span>
                                                <div><?= isset($data['KichThuoc']) ? $data['KichThuoc'] : 'Chưa cập nhật' ?></div>
                                            </li>
                                            <li>
                                                <span>Trọng lượng</span>
                                                <div><?= isset($data['TrongLuong']) ? $data['TrongLuong'] : 'Chưa cập nhật' ?></div>
                                            </li>
                                            <li>
                                                <span>Chống nước</span>
                                                <div><?= isset($data['ChongNuoc']) ? $data['ChongNuoc'] : 'Chưa cập nhật' ?></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php } ?>

                            <!-- Tab mô tả chi tiết -->
                            <div class="info-reviews description tab-pane fade" id="description">
                                <div class="description-content">
                                    <div class="product-desc">
                                        <?php if (isset($data['ChiTiet']) && !empty($data['ChiTiet'])): ?>
                                            <?= $data['ChiTiet'] ?>
                                        <?php else: ?>
                                            <?= $data['MoTa'] ?>
                                            <p>
                                                <?= $data['TenSP'] ?> là một sản phẩm công nghệ hiện đại đến từ thương hiệu <?= isset($data['ThuongHieu']) ? $data['ThuongHieu'] : 'hàng đầu' ?>,
                                                mang đến trải nghiệm tuyệt vời cho người dùng. Sản phẩm được thiết kế tinh tế với hiệu năng mạnh mẽ,
                                                đáp ứng mọi nhu cầu sử dụng hàng ngày của khách hàng.
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Tab hướng dẫn sử dụng -->
                            <div class="info-reviews usage tab-pane fade" id="usage">
                                <div class="usage-content">
                                    <div class="usage-guide">
                                        <?php if (isset($data['HuongDanSD']) && !empty($data['HuongDanSD'])): ?>
                                            <?= $data['HuongDanSD'] ?>
                                        <?php else: ?>
                                            <div class="guide-item">
                                                <h4>Cách sử dụng <?= $data['TenSP'] ?></h4>
                                                <ol>
                                                    <li>Sạc đầy pin trước khi sử dụng lần đầu</li>
                                                    <li>Đăng nhập tài khoản để sử dụng đầy đủ tính năng</li>
                                                    <li>Kiểm tra và cập nhật phiên bản phần mềm mới nhất</li>
                                                    <li>Tham khảo sách hướng dẫn đi kèm để biết thêm chi tiết</li>
                                                </ol>
                                            </div>
                                            <div class="guide-item">
                                                <h4>Lưu ý khi sử dụng</h4>
                                                <ol>
                                                    <li>Không để thiết bị tiếp xúc với nước hoặc độ ẩm cao</li>
                                                    <li>Tránh làm rơi hoặc va đập mạnh</li>
                                                    <li>Sử dụng phụ kiện chính hãng để bảo vệ thiết bị</li>
                                                </ol>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="single-products section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section-title text-center">
                        <h2>Sản phẩm tương tự</h2>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <?php foreach ($data_lq as $row) {
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
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="single-product">
                            <div class="product-f">
                                <a href="?act=detail&id=<?= $row['MaSP'] ?>"><img src="public/<?= $row['HinhAnh1'] ?>" alt="Product Title" class="img-products" /></a>
                                <div class="actions-btn">
                                    <a href="?act=detail&id=<?= $row['MaSP'] ?>"><i class="mdi mdi-cart"></i></a>
                                    <a href="" data-toggle="modal"><i class="mdi mdi-eye"></i></a>
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
                <?php } ?>
            </div>
        </div>
    </section>
<?php } else {
    require_once("Views/error-404.php");
} ?>

<script>
    function checkStockAndAddToCart(productId, availableStock) {
        if (availableStock <= 0) {
            alert('Sản phẩm hiện đang hết hàng. Vui lòng chọn sản phẩm khác.');
            return false;
        }

        window.location.href = `?act=cart&xuli=add&id=${productId}`;
        return true;
    }

    function checkStockAndBuyNow(productId, availableStock) {
        if (availableStock <= 0) {
            alert('Sản phẩm hiện đang hết hàng. Vui lòng chọn sản phẩm khác.');
            return false;
        }

        window.location.href = `?act=cart&xuli=addnow&id=${productId}`;
        return true;
    }
</script>