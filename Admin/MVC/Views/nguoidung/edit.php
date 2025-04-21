<?php if (isset($_COOKIE['msg'])) { ?>
    <div class="alert alert-success">
        <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
    </div>
<?php } ?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <h3>Chỉnh sửa người dùng</h3>
    <form action="?mod=nguoidung&act=update" method="POST" role="form" enctype="multipart/form-data">
        <input type="hidden" name="MaND" value="<?= $data['MaND'] ?>">
        <div class="form-group"></div>
        <label for="">Họ</label>
        <input type="text" class="form-control" id="" placeholder="" name="Ho" value="<?= $data['Ho'] ?>">
        </div>
        <div class="form-group">
            <label for="">Tên</label>
            <input type="text" class="form-control" id="" placeholder="" name="Ten" value="<?= $data['Ten'] ?>">
        </div>
        <div class="form-group">
            <label for="">Tên tài khoản</label>
            <input type="text" class="form-control" id="" placeholder="" name="TaiKhoan" value="<?= $data['TaiKhoan'] ?>">
        </div>
        <div class="form-group">
            <label for="">Giới tính</label>
            <select id="" name="GioiTinh" class="form-control">
                <option <?= ($data['GioiTinh'] == 'Nam') ? 'selected' : '' ?> value="Nam"> Nam</option>
                <option <?= ($data['GioiTinh'] == 'Nữ') ? 'selected' : '' ?> value="Nữ"> Nữ</option>
                <option <?= ($data['GioiTinh'] == 'Khác') ? 'selected' : '' ?> value="Khác"> Khác</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Số điện thoại</label>
            <input type="text" class="form-control" id="" placeholder="" name="SDT" value="<?= $data['SDT'] ?>">
        </div>
        <div class="form-group">
            <label for="">Địa chỉ</label>
            <input type="text" class="form-control" id="" placeholder="" name="DiaChi" value="<?= $data['DiaChi'] ?>">
        </div>
        <div class="form-group">
            <label for="">Mật khẩu</label>
            <input type="Password" class="form-control" id="" placeholder="" name="MatKhau" value="">
            <input type="hidden" name="OldMatKhau" value="<?= $data['MatKhau'] ?>">
        </div>
        <div class="form-group">
            <label for="">Trạng thái</label>
            <input type="text" class="form-control" id="" placeholder="" name="TrangThai" value="<?= $data['TrangThai'] ?>">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="Email" class="form-control" id="" placeholder="" name="Email" value="<?= $data['Email'] ?>">
        </div>
        <!-- <div class="form-group"> -->
        <div class="form-group">
            <label for="">Phân quyền</label>
            <select id="" name="MaQuyen" class="form-control">
                <option <?= ($data['MaQuyen'] == '1') ? 'selected' : '' ?> value="1"> Khách hàng</option>
                <option <?= ($data['MaQuyen'] == '2') ? 'selected' : '' ?> value="2"> Quản trị viên</option>
                <option <?= ($data['MaQuyen'] == '3') ? 'selected' : '' ?> value="3"> Nhân viên</option>
            </select>
        </div>
        <!-- </div> -->
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
    <!-- </tbody> -->
</table>