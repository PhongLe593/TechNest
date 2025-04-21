<div class="pages-title section-padding">
	<div class="container">
		<ul class="text-left">
			<li><a href="?act=home">Trang chủ</a></li>
			<li><span> // </span>HOÀN THÀNH ĐƠN HÀNG</li>
		</ul>
	</div>
</div>

<section class="pages checkout order-complete section-padding">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<div class="complete-title">
					<h4>Cảm ơn bạn đã tin dùng, đơn hàng của bạn sẽ sớm được xử lý !!!</h4>
					<?php if (isset($_SESSION['order_complete']['PhuongThuc']) && $_SESSION['order_complete']['PhuongThuc'] == 'vnpay'): ?>
						<div class="payment-badge">
							<span class="payment-method-badge vnpay">Thanh toán qua VNPay</span>
							<span class="payment-status-badge success">Đã thanh toán</span>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="log-title">
					<h3><strong>Thông tin đơn hàng</strong></h3>
				</div>
				<div class="cart-form-text pay-details">
					<table>
						<tbody>
							<tr>
								<td>Sản phẩm</td>
								<?php if (isset($_SESSION['order_complete']['products'])) {
									foreach ($_SESSION['order_complete']['products'] as $value) { ?>
										<td>
											<?= isset($value['TenSP']) ? (mb_strlen($value['TenSP']) > 20 ? htmlspecialchars(mb_substr($value['TenSP'], 0, 17)) . '...' : htmlspecialchars($value['TenSP'])) : '' ?>
										</td>
								<?php }
								} ?>
							</tr>
							<tr>
								<td>Thành tiền</td>
								<?php if (isset($_SESSION['order_complete']['products'])) {
									foreach ($_SESSION['order_complete']['products'] as $value) { ?>
										<td><?= isset($value['ThanhTien']) ? number_format((float)$value['ThanhTien'], 0, ',', '.') : 0 ?> VNĐ</td>
								<?php }
								} ?>
							</tr>
							<tr>
								<td>Vận Chuyển</td>
								<td>15,000 VNĐ</td>
							</tr>
							<tr>
								<td>Vat</td>
								<td>0 VNĐ</td>
							</tr>
							<tr>
								<td><strong>Tổng</strong></td>
								<td><strong><?= isset($_SESSION['order_complete']['total']) ? number_format((float)$_SESSION['order_complete']['total'], 0, ',', '.') : '15,000' ?> VNĐ</strong></td>
							</tr>
							<tr>
								<td><strong>Phương thức thanh toán</strong></td>
								<td>
									<?php if (isset($_SESSION['order_complete']['PhuongThuc']) && $_SESSION['order_complete']['PhuongThuc'] == 'vnpay'): ?>
										<strong>VNPay (Đã thanh toán)</strong>
									<?php else: ?>
										<strong>COD (Thanh toán khi nhận hàng)</strong>
									<?php endif; ?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="order-details">
					<div class="log-title">
						<h3><strong>Thông tin khách hàng</strong></h3>
					</div>
					<div class="por-dse clearfix">
						<ul>
							<li><span>Họ và tên</span> <?php echo isset($_SESSION['order_complete']['NguoiNhan']) ? htmlspecialchars($_SESSION['order_complete']['NguoiNhan']) : (isset($_SESSION['login']['Ho']) && isset($_SESSION['login']['Ten']) ? htmlspecialchars($_SESSION['login']['Ho'] . " " . $_SESSION['login']['Ten']) : ''); ?></li>
							<li><span>Email</span> <?= isset($_SESSION['login']['Email']) ? htmlspecialchars($_SESSION['login']['Email']) : '' ?></li>
							<li><span>Số điện thoại</span> <?= isset($_SESSION['order_complete']['SDT']) ? htmlspecialchars($_SESSION['order_complete']['SDT']) : (isset($_SESSION['login']['SDT']) ? htmlspecialchars($_SESSION['login']['SDT']) : ''); ?></li>
						</ul>
					</div>
				</div>
				<div class="order-address">
					<div class="log-title">
						<h3><strong>Địa chỉ giao hàng</strong></h3>
					</div>
					<p><?= isset($_SESSION['order_complete']['DiaChi']) ? htmlspecialchars($_SESSION['order_complete']['DiaChi']) : (isset($_SESSION['login']['DiaChi']) ? htmlspecialchars($_SESSION['login']['DiaChi']) : ''); ?></p>
					<p>Phone: <?= isset($_SESSION['order_complete']['SDT']) ? htmlspecialchars($_SESSION['order_complete']['SDT']) : (isset($_SESSION['login']['SDT']) ? htmlspecialchars($_SESSION['login']['SDT']) : ''); ?></p>
					<p>Email: <?= isset($_SESSION['login']['Email']) ? htmlspecialchars($_SESSION['login']['Email']) : '' ?></p>
				</div>
			</div>
		</div>
	</div>
</section>

<style>
.payment-badge {
	margin-top: 15px;
	display: flex;
	justify-content: center;
	gap: 10px;
}
.payment-method-badge, .payment-status-badge {
	display: inline-block;
	padding: 5px 10px;
	border-radius: 3px;
	font-weight: bold;
	font-size: 14px;
}
.payment-method-badge.vnpay {
	background-color: #0066FF;
	color: white;
}
.payment-status-badge.success {
	background-color: #28a745;
	color: white;
}
</style>