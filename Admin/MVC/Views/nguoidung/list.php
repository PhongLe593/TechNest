<?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
  <a href="?mod=nguoidung&act=add" type="button" class="btn btn-primary">Thêm mới</a>
<?php } ?>
<?php if (isset($_COOKIE['msg'])) { ?>
  <div class="alert alert-success">
    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
  </div>
<?php } ?>
<table class="table table-bordered" id="dataTable" cellspacing="0">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tài khoản</th>
      <th scope="col">SĐT</th>
      <th scope="col">Email</th>
      <th scope="col">Giới tính</th>
      <th scope="col">Vai trò</th>
      <th scope="col">Tùy chọn</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row) { ?>
      <tr>
        <td scope="row"><?= $row['MaND'] ?></td>
        <td><?= $row['TaiKhoan'] ?></td>
        <td><?= $row['SDT'] ?></td>
        <td><?= $row['Email'] ?></td>
        <td><?= $row['GioiTinh'] ?></td>
        <td>
          <?php
          if ($row['MaQuyen'] == 2) {
            echo 'Quản trị viên';
          } else {
            if ($row['MaQuyen'] == 1) {
              echo 'Khách hàng';
            } else {
              echo 'Nhân viên';
            }
          }
          ?>
        </td>
        <td>
          <a href="?mod=nguoidung&act=detail&id=<?= $row['MaND'] ?>" type="button" class="btn btn-success">Xem</a>
          <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
            <a href="?mod=nguoidung&act=edit&id=<?= $row['MaND'] ?>" type="button" class="btn btn-warning">Sửa</a>
            <a href="?mod=nguoidung&act=delete&id=<?= $row['MaND'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>