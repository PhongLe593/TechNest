<div class="pages-title section-padding">
	<div class="container">
		<ul class="text-left">
			<li><a href="?act=home">Trang chủ</a></li>
			<li><span> // </span>Thanh Toán</li>
		</ul>
	</div>
</div>

<section class="pages checkout section-padding">
	<div class="container">
		<?php if (!isset($_SESSION['sanpham']) || empty($_SESSION['sanpham'])): ?>
			<div class="alert alert-info">
				Không có sản phẩm nào để thanh toán. Vui lòng thêm sản phẩm vào giỏ hàng.
			</div>
		<?php else: ?>
			<div class="row">
				<div class="col-sm-6">
					<div class="main-input single-cart-form">
						<div class="log-title">
							<h3><strong>Thông tin vận chuyển</strong></h3>
						</div>
						<div class="custom-input">
							<form action="?act=checkout&xuli=save" method="post">
								<input type="text" name="NguoiNhan" placeholder="Người nhận" required value="<?php echo isset($_SESSION['login']['Ho']) && isset($_SESSION['login']['Ten']) ? htmlspecialchars($_SESSION['login']['Ho'] . " " . $_SESSION['login']['Ten']) : ''; ?>" />
								<input type="email" name="Email" placeholder="Địa chỉ Email.." required value="<?= isset($_SESSION['login']['Email']) ? htmlspecialchars($_SESSION['login']['Email']) : '' ?>" />
								<input type="text" name="SDT" placeholder="Số điện thoại.." required pattern="[0-9]+" minlength="10" value="<?= isset($_SESSION['login']['SDT']) ? htmlspecialchars($_SESSION['login']['SDT']) : '' ?>" />
								<input type="text" name="DiaChi" placeholder="Đại chỉ giao hàng" required value="<?= isset($_SESSION['login']['DiaChi']) ? htmlspecialchars($_SESSION['login']['DiaChi']) : '' ?>" />
								<div class="payment-method">
									<h4><strong>Phương thức thanh toán</strong></h4>
									<div class="payment-options">
										<div class="payment-option">
											<input type="radio" id="cod" name="PhuongThuc" value="cod" checked>
											<label for="cod">Thanh toán khi nhận hàng (COD)</label>
										</div>
										<div class="payment-option">
											<input type="radio" id="vnpay" name="PhuongThuc" value="vnpay">
											<label for="vnpay">Thanh toán qua VNPay</label>
										</div>
									</div>
								</div>
								</br>
								<div class="submit-text">
									<button type="submit">Thanh toán</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="main-input single-cart-form">
						<div class="log-title">
							<h3><strong>Thông tin đơn hàng</strong></h3>
						</div>
						<div class="cart-form-text pay-details table-responsive">
							<table>
								<tbody>
									<tr>
										<td>Sản phẩm</td>
										<?php if (isset($_SESSION['sanpham'])) {
											foreach ($_SESSION['sanpham'] as $value) { ?>
												<td>
													<?= isset($value['TenSP']) ? (mb_strlen($value['TenSP']) > 20 ? htmlspecialchars(mb_substr($value['TenSP'], 0, 17)) . '...' : htmlspecialchars($value['TenSP'])) : '' ?>
												</td>
										<?php }
										} ?>
									</tr>
									<tr>
										<td>Đơn giá</td>
										<?php if (isset($_SESSION['sanpham'])) {
											foreach ($_SESSION['sanpham'] as $value) { ?>
												<td><?= isset($value['ThanhTien']) ? number_format((float)$value['ThanhTien'], 0, ',', '.') : 0 ?> VNĐ</td>
										<?php }
										} ?>
									</tr>
									<tr>
										<td>Vận Chuyển</td>
										<td>15,000 VNĐ</td>
									</tr>
									<tr>
										<td><strong>Tổng</strong></td>
										<td><strong><?= isset($count) ? number_format((float)$count + 15000, 0, ',', '.') : '15,000' ?> VNĐ</strong></td>
									</tr>
								</tbody>
							</table>
							<div class="payment-logos">
								<h4>Thanh toán qua:</h4>
								<div class="logos-container">
									<img src="public/img/payment/cod.png" alt="COD" />
									<img src="public/img/payment/vnpay.png" alt="VNPay" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</section>