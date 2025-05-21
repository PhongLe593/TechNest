<a href="?mod=hoadon&id=1" type="button" class="btn btn-primary">Đã duyệt</a>
<a href="?mod=hoadon&id=0" type="button" class="btn btn-primary">Chưa duyệt</a>
<?php if (isset($_COOKIE['msg'])) { ?>
  <div class="alert alert-success">
    <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
  </div>
<?php } ?>
<hr>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
  <thead>
    <tr>
      <th scope="col">Mã đơn</th>
      <th scope="col">Ngày đặt</th>
      <th scope="col">Khách hàng</th>
      <th scope="col">Địa chỉ</th>
      <th scope="col">SĐT</th>
      <th scope="col">Phương thức</th>
      <th scope="col">Tổng tiền</th>
      <th scope="col">Trạng thái</th>
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row) { ?>
      <tr>
        <td><?= $row['MaHD'] ?></td>
        <td><?= $row['NgayLap'] ?></td>
        <td><?= $row['NguoiNhan'] ?></td>
        <td><?= $row['DiaChi'] ?></td>
        <td><?= $row['SDT'] ?></td>
        <td><?= $row['PhuongThuc'] ?></td>
        <td><?= number_format($row['TongTien']) ?>VNĐ</td>
        <td><?php if ($row['TrangThai'] == 0) {
              echo 'Chưa xét duyệt';
            } else {
              echo 'Đã xét duyệt';
            }
            ?></td>
        <td>
          <a href="?mod=hoadon&act=chitiet&id=<?= $row['MaHD'] ?>" class="btn btn-success">Xem chi tiết</a>
          <?php if ($row['TrangThai'] == 0) { ?>
            <a href="?mod=hoadon&act=delete&id=<?= $row['MaHD'] ?>" onclick="return confirm('Bạn có thật sự muốn hủy đơn hàng này? Số lượng sản phẩm sẽ được hoàn trả.');" type="button" class="btn btn-danger">Hủy đơn</a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
</table>
<script>
  $(document).ready(function() {
    $('#dataTable').DataTable();
  });
</script>