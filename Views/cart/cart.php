<div class="pages-title section-padding">
	<div class="container">
		<ul class="text-left">
			<li><a href="?act=home">Trang chủ</a></li>
			<li><span> // </span>Giỏ Hàng</li>
		</ul>
	</div>
</div>

<section class="pages cart-page section-padding">
	<div class="container">
		<div class="row">
			<?php if (!isset($_SESSION['sanpham']) || empty($_SESSION['sanpham'])): ?>
				<div class="alert alert-info">
					Giỏ hàng của bạn đang trống. Vui lòng thêm sản phẩm vào giỏ hàng.
				</div>
			<?php else: ?>
				<div class="table-responsive">
					<table class="wishlist-table text-center" id="dxd">
						<thead>
							<tr>
								<th>Sản phẩm</th>
								<th>Giá</th>
								<th>Số lượng</th>
								<th>Thành tiền</th>
                                
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if (isset($_SESSION['sanpham'])) {
								foreach ($_SESSION['sanpham'] as $value) { ?>
									<tr data-product-id="<?= $value['MaSP'] ?>">
										<td class="td-img">
											<a href="?act=detail&id=<?= $value['MaSP'] ?>"><img src="public/<?= $value['HinhAnh1'] ?>" alt="Add Product" /></a>
											<a href="?act=detail&id=<?= $value['MaSP'] ?>">
												<?= strlen($value['TenSP']) > 30 ? substr($value['TenSP'], 0, 27) . '...' : $value['TenSP'] ?>
											</a>
										</td>
										<td>
											<?php if (isset($value['GiaGoc']) && $value['GiaGoc'] > $value['DonGia'] && isset($value['GiamGia']) && $value['GiamGia'] > 0) : ?>
												<span class="original-price-cart"><del><?= number_format($value['GiaGoc']) ?> VNĐ</del></span><br>
												<span class="discounted-price-cart"><?= number_format($value['DonGia']) ?> VNĐ</span>
												<span class="discount-badge-cart">-<?= round(($value['GiamGia'] / $value['GiaGoc']) * 100) ?>%</span>
											<?php else : ?>
												<?= number_format($value['DonGia']) ?> VNĐ
											<?php endif; ?>
										</td>
										<td>
											<form action="" method="POST">
												<div class="plus-minus">
													<a href="javascript:void(0);" class="dec qtybutton" onclick="updateQuantity(<?= $value['MaSP'] ?>, -1)">-</a>
													<input type="number" id="qty-<?= $value['MaSP'] ?>" class="plus-minus-box" value="<?= $value['SoLuong'] ?>" min="1" max="<?= isset($value['MaxSoLuong']) ? $value['MaxSoLuong'] : 10 ?>" onchange="updateQuantityDirect(<?= $value['MaSP'] ?>, this.value)">
													<a href="javascript:void(0);" class="inc qtybutton" onclick="updateQuantity(<?= $value['MaSP'] ?>, 1)">+</a>
												</div>
											</form>
										</td>
										<td>
											<strong class="item-total"><?= number_format($value['ThanhTien']) ?> VNĐ</strong>
										</td>
										<td><a href="?act=cart&xuli=deleteall&id=<?= $value['MaSP'] ?>"><i class="mdi mdi-close" title="Remove this product"></i></a></td>
									</tr>
							<?php }
							} ?>
						</tbody>
					</table>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="single-cart-form">
							<div class="log-title">
								<h3><strong>Chi tiết thanh toán</strong></h3>
							</div>
							<div class="cart-form-text pay-details table-responsive">
								<form action="?act=checkout" method="post">
									<table>
										<tbody>
											<tr>
												<th>Tổng Giỏ Hàng</th>
												<td class="cart-subtotal"><?= number_format($count) ?> VNĐ</td>
											</tr>
											<tr>
												<th>Vận Chuyển</th>
												<td>15,000 VNĐ</td>
											</tr>
											<tr>
												<th>Vat</th>
												<td>0 VNĐ</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<th class="tfoot-padd">Tổng tiền</th>
												<td class="tfoot-padd cart-total"><?= number_format($count + 15000) ?> VNĐ</td>
											</tr>
										</tfoot>
									</table>
									<div class="submit-text coupon">
										<button type="submit">Đặt hàng</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<script>
function updateQuantity(productId, change) {
    const inputElement = document.getElementById(`qty-${productId}`);
    let currentQty = parseInt(inputElement.value);
    let newQty = currentQty + parseInt(change);
    
    if (newQty < 1) {
        newQty = 1;
    }
    
    const maxQty = parseInt(inputElement.max);
    if (newQty > maxQty) {
        alert(`Số lượng sản phẩm tồn kho chỉ còn ${maxQty}.`);
        newQty = maxQty;
    }
    
    // Update the input field value immediately for visual feedback
    inputElement.value = newQty;
    
    // Update the cart on the server
    updateCart(productId, newQty);
}

function updateQuantityDirect(productId, newQty) {
    newQty = parseInt(newQty);
    if (isNaN(newQty) || newQty < 1) {
        newQty = 1;
    }
    
    const maxQty = parseInt(document.getElementById(`qty-${productId}`).max);
    if (newQty > maxQty) {
        alert(`Số lượng sản phẩm tồn kho chỉ còn ${maxQty}.`);
        newQty = maxQty;
        document.getElementById(`qty-${productId}`).value = maxQty;
    }
    
    updateCart(productId, newQty);
}

function updateCart(productId, quantity) {
    // Disable the quantity controls during update
    const inputElement = document.getElementById(`qty-${productId}`);
    const decrementBtn = inputElement.previousElementSibling;
    const incrementBtn = inputElement.nextElementSibling;
    
    inputElement.disabled = true;
    decrementBtn.style.opacity = '0.5';
    incrementBtn.style.opacity = '0.5';
    decrementBtn.style.pointerEvents = 'none';
    incrementBtn.style.pointerEvents = 'none';
    
    // Show loading indicator
    const row = document.querySelector(`tr[data-product-id="${productId}"]`);
    if (row) {
        row.style.opacity = '0.7';
    }
    
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '?act=cart&xuli=update_ajax', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        // Re-enable controls
        inputElement.disabled = false;
        decrementBtn.style.opacity = '1';
        incrementBtn.style.opacity = '1';
        decrementBtn.style.pointerEvents = 'auto';
        incrementBtn.style.pointerEvents = 'auto';
        
        if (row) {
            row.style.opacity = '1';
        }
        
        if (this.status === 200) {
            try {
                const response = JSON.parse(this.responseText);
                if (response.success) {
                    // Update the item quantity to match server's response
                    inputElement.value = quantity;
                    
                    // Update item price
                    if (response.itemPrice) {
                        const priceElement = document.querySelector(`tr[data-product-id="${productId}"] .item-total`);
                        if (priceElement) {
                            priceElement.innerHTML = `<strong>${response.itemPrice} VNĐ</strong>`;
                        }
                    }
                    
                    // Update cart total
                    if (response.cartTotal) {
                        document.querySelector('.cart-subtotal').innerHTML = `${response.cartTotal} VNĐ`;
                        document.querySelector('.cart-total').innerHTML = `${response.cartTotalWithShipping} VNĐ`;
                    }
                    
                    // Visual feedback for successful update
                    if (row) {
                        row.style.transition = 'background-color 0.5s';
                        row.style.backgroundColor = '#e8f7e8';
                        setTimeout(() => {
                            row.style.backgroundColor = '';
                        }, 1000);
                    }
                } else {
                    // Set the input field back to the valid value
                    if (response.message && response.message.includes('vượt quá số lượng tồn kho')) {
                        const matches = response.message.match(/\((\d+)\)/);
                        if (matches && matches[1]) {
                            inputElement.value = matches[1];
                        }
                    }
                    
                    alert(response.message || 'Có lỗi xảy ra khi cập nhật giỏ hàng.');
                }
            } catch (e) {
                console.error('Failed to parse response:', e);
                alert('Có lỗi xảy ra khi cập nhật giỏ hàng.');
            }
        } else {
            alert('Có lỗi xảy ra khi cập nhật giỏ hàng. Vui lòng thử lại.');
        }
    };
    
    xhr.onerror = function() {
        // Re-enable controls on error
        inputElement.disabled = false;
        decrementBtn.style.opacity = '1';
        incrementBtn.style.opacity = '1';
        decrementBtn.style.pointerEvents = 'auto';
        incrementBtn.style.pointerEvents = 'auto';
        
        if (row) {
            row.style.opacity = '1';
        }
        
        alert('Không thể kết nối đến máy chủ. Vui lòng kiểm tra kết nối mạng và thử lại.');
    };
    
    xhr.send(`id=${productId}&quantity=${quantity}`);
}

// Validate quantities before checkout
document.querySelector('form[action="?act=checkout"]').addEventListener('submit', function(e) {
    e.preventDefault();
    
    let isValid = true;
    const inputs = document.querySelectorAll('.plus-minus-box');
    
    inputs.forEach(input => {
        const currentQty = parseInt(input.value);
        const maxQty = parseInt(input.max);
        
        if (currentQty > maxQty) {
            const productId = input.id.replace('qty-', '');
            const productName = document.querySelector(`tr[data-product-id="${productId}"] a`).textContent.trim();
            alert(`Số lượng sản phẩm "${productName}" vượt quá số lượng tồn kho (${maxQty}).`);
            isValid = false;
        }
    });
    
    if (isValid) {
        this.submit();
    }
});
</script>