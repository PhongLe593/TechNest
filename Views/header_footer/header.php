<header class="header-one header-two shadow-sm">
    <div class="header-top bg-light py-2">
        <div class="container">
            <div class="header-wrapper d-flex justify-content-between align-items-center">
                <div class="header-search">
                    <form action="?act=shop" method="post" class="d-flex">
                        <input type="text" class=" rounded-start" placeholder="Tìm kiếm sản phẩm..." name="keyword">
                        <button type="submit" class="btn btn-primary rounded-end">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                    </form>
                </div>
                <div class="header-user d-flex gap-3">
                    <a href="" class="text-dark"><i class="mdi mdi-bell fs-5" title="Thông báo"></i></a>
                    <a href="" class="text-dark"><i class="mdi mdi-email fs-5" title="Liên hệ"></i></a>
                    <a href="" class="text-dark"><i class="mdi mdi-help-circle fs-5" title="Trợ giúp"></i></a>
                    <div class="header-account">
                        <div class="account-icon">
                            <a href="#" class="text-dark"><i class="mdi mdi-account fs-5"></i></a>
                        </div>
                        <ul class="account-dropdown bg-white shadow-sm rounded p-2">
                            <?php if (isset($_SESSION['login'])) { ?>
                                <li class="py-2 border-bottom"><strong><i class="mdi mdi-account-circle me-2"></i><?= $_SESSION['login']['Ho'] ?> <?= $_SESSION['login']['Ten'] ?></strong></li>
                                <?php if (isset($_SESSION['isLogin_Admin']) || isset($_SESSION['isLogin_Nhanvien'])) { ?>
                                    <li class="py-2"><a href="admin/?mod=login" class="text-dark"><i class="mdi mdi-cog me-2"></i>Trang quản lý</a></li>
                                <?php } ?>
                                <li class="py-2"><a href="?act=taikhoan&xuli=account" class="text-dark"><i class="mdi mdi-account-edit me-2"></i>Tài khoản</a></li>
                                <li class="py-2"><a href="?act=order_history" class="text-dark"><i class="mdi mdi-package-variant me-2"></i>Đơn hàng</a></li>
                                <li class="py-2"><a href="?act=taikhoan&xuli=dangxuat" class="text-dark"><i class="mdi mdi-logout me-2"></i>Đăng xuất</a></li>
                            <?php } else { ?>
                                <li class="py-2"><a href="?act=taikhoan" class="text-dark"><i class="mdi mdi-login me-2"></i>Đăng nhập</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-sm-2">
                <div class="logo">
                    <a href="?act=home"><img class="logo_header" src="public/img/logo.png" alt="TechNest" /></a>
                </div>
            </div>
            <div class="col-sm-8.5">
                <div class="header-middel">
                    <div class="mainmenu">
                        <nav>
                            <ul class="d-flex gap-4 mb-0">
                                <li><a href="?act=home" class="text-dark"><i class="mdi mdi-home me-1"></i>Trang chủ</a></li>
                                <li><a href="?act=shop" class="text-dark"><i class="mdi mdi-store me-1"></i>Cửa Hàng</a>
                                    <ul class="magamenu bg-white shadow-sm rounded p-3">
                                        <li class="banner"></li>
                                        <?php $i = 1;
                                        foreach ($data_chitietDM as $row) { ?>
                                            <li>
                                                <a href="?act=shop&sp=<?= $i ?>" class="text-dark">
                                                    <h5><i class="mdi mdi-folder me-2"></i> <?= $data_danhmuc[$i - 1]['TenDM'] ?></h5>
                                                </a>
                                                <ul>
                                                    <?php foreach ($row as $value) { ?>
                                                        <li><a href="?act=shop&sp=<?= $value['MaDM'] ?>&loai=<?= $value['TenLSP'] ?>" class="text-dark"><?= $value['TenLSP'] ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php $i++;
                                        } ?>
                                        <li class="banner"></li>
                                    </ul>
                                </li>
                                <li><a class="cart-itme-a text-dark" href="?act=cart"><i class="mdi mdi-cart me-1"></i>Giỏ hàng</a></li>
                                <li><a href="?act=checkout" class="text-dark"><i class="mdi mdi-credit-card me-1"></i>Thanh Toán</a></li>
                                <li><a href="?act=about" class="text-dark"><i class="mdi mdi-information me-1"></i>Giới thiệu</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="mobile-menu-area">
                        <div class="mobile-menu">
                            <nav id="dropdown">
                                <ul class="list-unstyled">
                                    <li class="py-2"><a href="?act=home" class="text-dark"><i class="mdi mdi-home me-2"></i>Trang chủ</a></li>
                                    <li class="py-2"><a href="?act=shop" class="text-dark"><i class="mdi mdi-store me-2"></i>Cửa hàng</a>
                                        <ul>
                                            <?php $i = 1;
                                            foreach ($data_chitietDM as $row) { ?>
                                                <li>
                                                    <a href="?act=shop&sp=<?= $i ?>" class="text-dark">
                                                        <h5><i class="mdi mdi-folder me-2"></i><?= $data_danhmuc[$i - 1]['TenDM'] ?></h5>
                                                    </a>
                                                    <ul>
                                                        <?php foreach ($row as $value) { ?>
                                                            <li><a href="?act=shop&sp=<?= $value['MaDM'] ?>&loai=<?= $value['TenLSP'] ?>" class="text-dark"><i class="mdi mdi-chevron-right me-2"></i><?= $value['TenLSP'] ?></a></li>
                                                        <?php } ?>
                                                    </ul>
                                                </li>
                                            <?php $i++;
                                            } ?>
                                        </ul>
                                    </li>
                                    <li class="py-2"><a class="cart-itme-a text-dark" href="?act=cart"><i class="mdi mdi-cart me-2"></i>Giỏ hàng</a></li>
                                    <li class="py-2"><a href="?act=checkout" class="text-dark"><i class="mdi mdi-credit-card me-2"></i>Thanh Toán</a></li>
                                    <li class="py-2"><a href="?act=about" class="text-dark"><i class="mdi mdi-information me-2"></i>Giới thiệu</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>