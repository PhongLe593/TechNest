<?php if (isset($_COOKIE['msg'])) { ?>
  <div class="alert alert-warning">
    <strong>Cảnh báo!</strong> <?= $_COOKIE['msg'] ?>
  </div>
<?php } ?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Xác nhận xóa khuyến mãi</h6>
  </div>
  <div class="card-body">
    <div class="alert alert-danger">
      <p>Khuyến mãi này đang được sử dụng bởi một số sản phẩm. Nếu bạn xóa khuyến mãi này, tất cả sản phẩm sẽ được chuyển sang khuyến mãi mặc định (Không khuyến mãi).</p>
      <p>Bạn có chắc chắn muốn tiếp tục?</p>
    </div>
    
    <div class="text-center mt-4">
      <a href="?mod=khuyenmai&act=list" class="btn btn-secondary">Hủy</a>
      <a href="?mod=khuyenmai&act=delete&id=<?= $id ?>&action=force" class="btn btn-danger">Xác nhận xóa</a>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Highlight nav menu
    $('#khuyenmai-nav').addClass('active');
  });
</script> 