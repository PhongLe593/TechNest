<div class="pages-title section-padding">
    <div class="container">
        <ul class="text-left">
            <li><a href="?act=home">Trang chủ</a></li>
            <li><span> // </span>Lịch sử đơn hàng</li>
        </ul>
    </div>
</div>

<section class="pages cart-page section-padding">
    <div class="container">
        <div class="row">
            <?php if (empty($data)): ?>
                <div class="alert alert-info">
                    Bạn chưa có đơn hàng nào.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="wishlist-table text-center" id="dxd">
                        <thead>
                            <tr>
                                <th>Mã đơn</th>
                                <th>Thời gian đặt</th>
                                <th>Sản phẩm</th>
                                <th>Địa chỉ nhận</th>
                                <th>Người nhận</th>
                                <th>Thanh toán</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $order): ?>
                                <tr>
                                    <td><?= isset($order['MaHD']) ? htmlspecialchars($order['MaHD']) : '' ?></td>
                                    <td><?= isset($order['NgayLap']) ? date('d/m/Y H:i', strtotime($order['NgayLap'])) : '' ?></td>
                                    <td>
                                        <?= isset($order['Products']) ? (mb_strlen($order['Products']) > 30 ? htmlspecialchars(mb_substr($order['Products'], 0, 27)) . '...' : htmlspecialchars($order['Products'])) : '' ?>
                                    </td>
                                    <td><?= isset($order['DiaChi']) ? htmlspecialchars($order['DiaChi']) : '' ?></td>
                                    <td><?= isset($order['NguoiNhan']) ? htmlspecialchars($order['NguoiNhan']) : '' ?></td>
                                    <td><?= isset($order['TongTien']) ? number_format((float)$order['TongTien'], 0, ',', '.') : 0 ?>đ</td>
                                    <td>
                                        <?php if (isset($order['TrangThai'])) {
                                            if ($order['TrangThai'] == 0) {
                                                echo 'Chưa duyệt';
                                            } else {
                                                echo 'Đã xét duyệt';
                                            }
                                        } else {
                                            echo 'Không xác định';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>