<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <?php if (isset($_COOKIE['msg'])) { ?>
        <div class="alert alert-warning">
            <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
        </div>
    <?php } ?>
    <form action="?mod=khuyenmai&act=store" method="POST" role="form" enctype="multipart/form-data">
        <h3>Thêm khuyến mãi</h3>
        <div class="form-group">
            <label for="">Tên khuyến mãi</label>
            <input type="text" class="form-control" id="" placeholder="" name="TenKM">
        </div>
        <div class="form-group">
            <label for="">Loại khuyến mãi</label>
            <input type="text" class="form-control" id="" placeholder="" name="LoaiKM">
        </div>
        <div class="form-group">
            <label for="">Giá trị khuyến mãi</label>
            <input type="text" class="form-control" id="" placeholder="" name="GiaTriKM">
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</table>