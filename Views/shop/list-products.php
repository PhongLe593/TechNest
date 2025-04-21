<div class="tab-content grid-content">
	<div class="tab-pane fade in active text-center" id="grid">
		<?php
		if (isset($data) and $data != NULL) {
			foreach ($data as $value) {
				// Kiểm tra giảm giá
				$discountValue = 0;
				if (isset($value['MaKM'])) {
					require_once("Models/cart.php");
					$cartModel = new Cart();
					$promotion = $cartModel->get_promotion($value['MaKM']);
					$discountValue = isset($promotion['GiaTriKM']) ? $promotion['GiaTriKM'] : 0;
					$discountedPrice = $value['DonGia'] - $discountValue;
				}
		?>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="single-product">
						<div class="product-f">
							<a href="?act=detail&id=<?= $value['MaSP'] ?>"><img src="public/<?= $value['HinhAnh1'] ?>" alt="Product Title" class="img-products" /></a>
							<div class="actions-btn">
								<a href="?act=detail&id=<?= $value['MaSP'] ?>"><i class="mdi mdi-cart"></i></a>
								<a href="?act=detail&id=<?= $value['MaSP'] ?>" data-toggle="modal"><i class="mdi mdi-eye"></i></a>
							</div>
							<?php if ($discountValue > 0) : ?>
								<span class="discount-label">GIẢM GIÁ</span>
							<?php endif; ?>
						</div>
						<div class="product-dsc">
							<p><a href="?act=detail&id=<?= $value['MaSP'] ?>"><?= mb_strimwidth($value['TenSP'], 0, 30, '...') ?></a></p>
							<?php if ($discountValue > 0) : ?>
								<div class="product-price-list">
									<span class="current-price"><?= number_format($discountedPrice) ?> VNĐ</span>
									<span class="original-price"><del><?= number_format($value['DonGia']) ?> VNĐ</del></span>
									<span class="discount-percent">-<?= round(($discountValue / $value['DonGia']) * 100) ?>%</span>
								</div>
							<?php else : ?>
								<span><?= number_format($value['DonGia']) ?> VNĐ</span>
							<?php endif; ?>
						</div>
					</div>
				</div>
		<?php }
		} else {
			echo '<h4>Không tìm thấy sản phẩm phù hợp</h4>';
		} ?>
	</div>
</div>