<?php if (isset($_COOKIE['msg'])) { ?>
    <div class="alert alert-success">
        <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
    </div>
<?php } ?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <h3>Chỉnh sửa sản phẩm</h3>
    <form action="?mod=sanpham&act=update" method="POST" role="form" enctype="multipart/form-data">
        <div class="form-group">
            <label for="cars">Loại sản phẩm: </label>
            <select id="" name="MaLSP" class="form-control">
                <?php foreach ($data_lsp as $row) { ?>
                    <option <?= ($row['MaLSP'] == $data['MaLSP']) ? 'selected' : '' ?> value="<?= $row['MaLSP'] ?>"><?= $row['TenLSP'] ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="hidden" name="MaSP" value="<?= $data['MaSP'] ?>">
        <div class="form-group">
            <label for="cars">Danh mục: </label>
            <select id="" name="MaDM" class="form-control">
                <?php foreach ($data_dm as $row) { ?>
                    <option <?= ($row['MaDM'] == $data['MaDM']) ? 'selected' : '' ?> value="<?= $row['MaDM'] ?>"><?= $row['TenDM'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Tên sản phẩm</label>
            <input type="text" class="form-control" id="" placeholder="" name="TenSP" value="<?= $data['TenSP'] ?>">
        </div>
        <div class="form-group">
            <label for="">Đơn giá</label>
            <input type="text" class="form-control" id="" placeholder="" name="DonGia" value="<?= $data['DonGia'] ?>">
        </div>
        <div class="form-group">
            <label for="">Số lượng</label>
            <input type="text" class="form-control" id="" placeholder="" name="SoLuong" value="<?= $data['SoLuong'] ?>">
        </div>
        <div class="form-group">
            <label for="">Hình ảnh 1</label>
            <img src="../public/<?= $data['HinhAnh1'] ?>" height="150px">
            <input type="file" class="form-control" id="" placeholder="" name="HinhAnh1" value="<?= $data['HinhAnh1'] ?>">
        </div>
        <div class="form-group">
            <label for="">Hình ảnh 2</label>
            <img src="../public/<?= $data['HinhAnh2'] ?>" height="150px">
            <input type="file" class="form-control" id="" placeholder="" name="HinhAnh2" value="<?= $data['HinhAnh2'] ?>">
        </div>
        <div class="form-group">
            <label for="">Hình ảnh 3</label>
            <img src="../public/<?= $data['HinhAnh3'] ?>" height="150px">
            <input type="file" class="form-control" id="" placeholder="" name="HinhAnh3" value="<?= $data['HinhAnh3'] ?>">
        </div>
        <div class="form-group">
            <label for="cars">Khuyến mãi </label>
            <select id="" name="MaKM" class="form-control">
                <?php foreach ($data_km as $row) { ?>
                    <option <?= ($row['MaKM'] == $data['MaKM']) ? 'selected' : '' ?> value="<?= $row['MaKM'] ?>"><?= $row['TenKM'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Màn hình</label>
            <input type="text" class="form-control" id="" placeholder="" name="ManHinh" value="<?= $data['ManHinh'] ?>">
        </div>
        <div class="form-group">
            <label for="">Hệ điều hành</label>
            <input type="text" class="form-control" id="" placeholder="" name="HDH" value="<?= $data['HDH'] ?>">
        </div>
        <div class="form-group">
            <label for="">Camera trước</label>
            <input type="text" class="form-control" id="" placeholder="" name="CamTruoc" value="<?= $data['CamTruoc'] ?>">
        </div>
        <div class="form-group">
            <label for="">Camera sau</label>
            <input type="text" class="form-control" id="" placeholder="" name="CamSau" value="<?= $data['CamSau'] ?>">
        </div>
        <div class="form-group">
            <label for="">CPU</label>
            <input type="text" class="form-control" id="" placeholder="" name="CPU" value="<?= $data['CPU'] ?>">
        </div>
        <div class="form-group">
            <label for="">Ram</label>
            <input type="text" class="form-control" id="" placeholder="" name="Ram" value="<?= $data['Ram'] ?>">
        </div>
        <div class="form-group">
            <label for="">Rom</label>
            <input type="text" class="form-control" id="" placeholder="" name="Rom" value="<?= $data['Rom'] ?>">
        </div>
        <div class="form-group">
            <label for="">Pin</label>
            <input type="text" class="form-control" id="" placeholder="" name="Pin" value="<?= $data['Pin'] ?>">
        </div>
        <div class="form-group">
            <label for="">SDCard</label>
            <input type="text" class="form-control" id="" placeholder="" name="SDCard" value="<?= $data['SDCard'] ?>">
        </div>
        <label for="">Mô tả</label>
        <div class="form-group">
            <textarea class="form-control" id="summernote" placeholder="" name="MoTa"><?= $data['MoTa'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="">Cho phép hiển thị</label>
            <input <?= ($data['TrangThai'] == 1) ? 'checked' : '' ?> type="checkbox" id="" placeholder="" value="1" name="TrangThai">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
</table>