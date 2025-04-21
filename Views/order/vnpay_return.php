<div class="pages-title section-padding">
	<div class="container">
		<ul class="text-left">
			<li><a href="?act=home">Trang chủ</a></li>
			<li><span> // </span>Kết quả thanh toán</li>
		</ul>
	</div>
</div>

<section class="pages checkout section-padding">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="main-input single-cart-form">
					<div class="log-title">
						<h3><strong>Kết quả thanh toán VNPay</strong></h3>
					</div>
					<div class="payment-result">
						<?php if (isset($_SESSION['payment_result'])): ?>
							<?php if ($_SESSION['payment_result']['status'] == 'success'): ?>
								<div class="alert alert-success">
									<h4><i class="fa fa-check-circle"></i> <?= $_SESSION['payment_result']['message'] ?></h4>
									<p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đã được thanh toán thành công qua VNPay.</p>
								</div>
							<?php else: ?>
								<div class="alert alert-danger">
									<h4><i class="fa fa-times-circle"></i> <?= $_SESSION['payment_result']['message'] ?></h4>
									<p>Có lỗi xảy ra trong quá trình thanh toán. Vui lòng thử lại hoặc chọn phương thức thanh toán khác.</p>
								</div>
							<?php endif; ?>

							<div class="payment-actions">
								<a href="?act=home" class="btn btn-primary">Tiếp tục mua sắm</a>
								<?php if ($_SESSION['payment_result']['status'] == 'failed'): ?>
									<a href="?act=checkout" class="btn btn-warning">Thử lại</a>
								<?php endif; ?>
							</div>
						<?php else: ?>
							<div class="alert alert-info">
								<h4>Không có thông tin thanh toán</h4>
								<p>Không có thông tin thanh toán để hiển thị. Vui lòng quay lại trang chủ.</p>
							</div>
							<div class="payment-actions">
								<a href="?act=home" class="btn btn-primary">Về trang chủ</a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<style>
.payment-result {
	text-align: center;
	padding: 30px 20px;
}
.payment-result .alert {
	padding: 20px;
	border-radius: 5px;
	margin-bottom: 20px;
}
.payment-result .alert-success {
	background-color: #dff0d8;
	border-color: #d6e9c6;
	color: #3c763d;
}
.payment-result .alert-danger {
	background-color: #f2dede;
	border-color: #ebccd1;
	color: #a94442;
}
.payment-result .alert-info {
	background-color: #d9edf7;
	border-color: #bce8f1;
	color: #31708f;
}
.payment-actions {
	margin-top: 20px;
}
.payment-actions .btn {
	display: inline-block;
	padding: 10px 20px;
	margin: 0 10px;
	border-radius: 3px;
	text-decoration: none;
	font-weight: bold;
}
.payment-actions .btn-primary {
	background-color: #337ab7;
	border-color: #2e6da4;
	color: white;
}
.payment-actions .btn-warning {
	background-color: #f0ad4e;
	border-color: #eea236;
	color: white;
}
</style> 