<div class="content-info-container">
    <h2 class="content-info-title">Thông tin khuyến mãi</h2>
    <div class="content-info-card">
        <?php if (isset($data) && $data != null) { ?>
            <div class="promotion-info-card">
                <p><strong>Mã khuyến mãi:</strong> <?= $data['MaKM'] ?></p>
                <p><strong>Tên khuyến mãi:</strong> <?= $data['TenKM'] ?></p>
                <p><strong>Loại khuyến mãi:</strong> <?= $data['LoaiKM'] ?></p>
                <p><strong>Giá trị khuyến mãi:</strong> <?= $data['GiaTriKM'] ?></p>
                <p><strong>Ngày bắt đầu:</strong> <?= $data['NgayBD'] ?></p>
                <p><strong>Trạng thái:</strong> <?= $data['TrangThai'] ?></p>
            </div>
        <?php } else { ?>
            <p class="no-data">Không có thông tin khuyến mãi để hiển thị.</p>
        <?php } ?>
    </div>
</div>