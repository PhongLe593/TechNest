<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      <?php
      $mod = isset($_GET['mod']) ? $_GET['mod'] : "thống kê";
      echo "Quản lý " . $mod;
      ?>
    </h6>
  </div>

  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow d-sm-none">
      <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-search fa-fw"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
        <form class="form-inline mr-auto w-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li>

    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <span class="badge badge-danger badge-counter">0</span>
      </a>
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
          Thông báo mới
        </h6>
        <a class="dropdown-item text-center small text-gray-500" href="#">Hiển thị tất cả</a>
      </div>
    </li>

    <li class="nav-item dropdown no-arrow mx-1">
      <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-envelope fa-fw"></i>
        <span class="badge badge-danger badge-counter">0</span>
      </a>
      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">
          Tin nhắn mới
        </h6>
        <a class="dropdown-item text-center small text-gray-500" href="#">Hiển thị tất cả</a>
      </div>
    </li>

    <div class="topbar-divider d-none d-sm-block"></div>

    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $_SESSION['login']['TaiKhoan'] ?></span>
        <img class="img-profile rounded-circle" src="../public/img/author.png">
      </a>
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="../index.php?act=taikhoan&xuli=account" target="_blank">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          Tài khoản
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="../?act=home">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Cửa hàng
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="../?act=taikhoan&xuli=dangxuat">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Đăng xuất
        </a>
      </div>
    </li>
  </ul>
</nav>