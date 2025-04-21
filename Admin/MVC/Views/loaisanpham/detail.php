<div class="content-info-container">
    <h2 class="content-info-title">Thông tin loại sản phẩm</h2>
    <div class="content-info-card">
        <p><strong>Mã loại sản phẩm:</strong> <?= $data['MaLSP'] ?></p>
        <p><strong>Tên loại sản phẩm:</strong> <?= $data['TenLSP'] ?></p>
        <p><strong>Hình ảnh:</strong> <img src="../public/img/company/<?= $data['HinhAnh'] ?>" alt="Hình ảnh sản phẩm" class="product-image" height="100px"></p>
        <p><strong>Mô tả:</strong> <?= $data['Mota'] ?></p>
        <p><strong>Mã danh mục:</strong> <?= $data['MaDM'] ?></p>
    </div>
</div>