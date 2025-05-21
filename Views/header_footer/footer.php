<footer class="footer-two bg-dark text-light">
    <div class="footer-top section-padding py-5">
        <div class="footer-dsc">
            <div class="container">
                <div class="row g-4">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="single-text">
                            <div class="footer-title mb-4">
                                <h4 class="text-white"><i class="mdi mdi-contact-mail me-2"></i> Liên hệ</h4>
                            </div>
                            <div class="footer-text">
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <i class="mdi mdi-map-marker text-primary me-2"></i>
                                        <p class="mb-0">Cầu Diễn, Hà Nội</p>
                                    </li>
                                    <li class="mb-3">
                                        <i class="mdi mdi-phone text-primary me-2"></i>
                                        <p class="mb-0">(+84) 987654321</p>
                                        <p class="mb-0">(+84) 987654321</p>
                                    </li>
                                    <li class="mb-3">
                                        <i class="mdi mdi-email text-primary me-2"></i>
                                        <p class="mb-0">technest@gmail.com</p>
                                        <p class="mb-0">technest@.com.vn</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <div class="single-text">
                            <div class="footer-title mb-4">
                                <h4 class="text-white"><i class="mdi mdi-account me-2"></i> Tài khoản</h4>
                            </div>
                            <div class="footer-menu">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><a href="?act=taikhoan&xuli=account" class="text-light text-decoration-none"><i class="mdi mdi-account-edit me-2"></i>Tài khoản</a></li>
                                    <li class="mb-2"><a href="?act=cart" class="text-light text-decoration-none"><i class="mdi mdi-cart me-2"></i>Giỏ Hàng</a></li>
                                    <li class="mb-2"><a href="?act=taikhoan" class="text-light text-decoration-none"><i class="mdi mdi-login me-2"></i>Đăng Nhập</a></li>
                                    <li class="mb-2"><a href="?act=checkout" class="text-light text-decoration-none"><i class="mdi mdi-credit-card me-2"></i>Thanh Toán</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col-md-3">
                        <div class="single-text">
                            <div class="footer-title mb-4">
                                <h4 class="text-white"><i class="mdi mdi-folder me-2"></i> Danh mục</h4>
                            </div>
                            <div class="footer-menu">
                                <ul class="list-unstyled">
                                    <?php foreach ($data_danhmuc as $row) { ?>
                                        <li class="mb-2"><a href="?act=shop&sp=<?= $row['MaDM'] ?>" class="text-light text-decoration-none"><i class="mdi mdi-chevron-right me-2"></i><?= $row['TenDM'] ?></a></li>
                                    <?php  } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3">
                        <div class="single-text">
                            <div class="footer-title mb-4">
                                <h4 class="text-white"><i class="mdi mdi-share-variant me-2"></i> Đồng hành cùng</h4>
                            </div>
                            <div class="footer-menu">
                                <a href="?act=home" class="d-block mb-4">
                                    <img class="logo_header" src="public/img/logo.png" alt="TechNest" />
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</footer>