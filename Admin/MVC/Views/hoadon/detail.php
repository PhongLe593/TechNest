<?php if (isset($data) and $data != null) { ?>
    <?php if ($orderStatus == 0) { ?>
        <a href="?mod=hoadon&act=xetduyet&id=<?= $data['0']['MaHD'] ?>" class="btn btn-success">Duyệt đơn</a>
        <a href="?mod=hoadon&act=delete&id=<?= $data['0']['MaHD'] ?>" onclick="return confirm('Bạn có thật sự muốn hủy đơn hàng này? Số lượng sản phẩm sẽ được hoàn trả.');" type="button" class="btn btn-danger">Hủy đơn</a>
    <?php } ?>
    <a href="?mod=hoadon&act=printInvoice&id=<?= $data['0']['MaHD'] ?>" class="btn btn-primary" target="_blank">In hóa đơn</a>
<?php } ?>
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
            <th scope="col">Sản phẩm</th>
            <th scope="col">Đơn giá</th>
            <th scope="col">Số lượng</th>
            <th scope="col">Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><?= $row['MaHD'] ?></td>
                <td><?= $row['Ten'] ?></td>
                <td><?= number_format($row['DonGia']) ?> VNĐ</td>
                <td><?= $row['SoLuong'] ?></td>
                <td><?= number_format($row['DonGia'] * $row['SoLuong']) ?> VNĐ</td>
            </tr>
        <?php } ?>
</table>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>