<div class="pages-title section-padding">
	<div class="container">
		<ul class="text-left">
			<li><a href="?act=home">Trang chủ</a></li>
			<li><span> // </span>Đăng nhập</li>
		</ul>
	</div>
</div>

<section class="pages login-page section-padding">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="main-input" id="dangnhap">
					<div class="log-title">
						<h3><strong>Bạn đã có tài khoản</strong></h3>
					</div>
					<div class="custom-input">
						<?php if (isset($_COOKIE['msg1'])) { ?>
							<div class="alert alert-success">
								<strong>Thông báo</strong> <?= $_COOKIE['msg1'] ?>
							</div>
						<?php } ?>
						<form action="?act=taikhoan&xuli=dangnhap" method="post" id="form1">
							<input type="text" name="taikhoan" placeholder="Tài khoản" required/>
							<input type="password" name="matkhau" placeholder="Mật khẩu" required/>
							<a class="forget" href="#">Quên Mật khẩu?</a>
							<div class="submit-text">
								<button name="submit" type="submit" form="form1">Đăng nhập</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="main-input new-customer" id="dangky">
					<div class="log-title">
						<h3><strong>Bạn chưa có tài khoản</strong></h3>
					</div>
					<?php if (isset($_COOKIE['msg'])) { ?>
						<div class="alert alert-success">
							<strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
						</div>
					<?php } ?>
					<div class="custom-input">
						<form action="?act=taikhoan&xuli=dangky" method="post" id="form2">
							<input type="text" name="Ho" placeholder="Họ" required />
							<input type="text" name="Ten" placeholder="Tên" required />
							<input type="text" name="TaiKhoan" placeholder="Tên tài khoản" required minlength="6" />
							<input type="email" name="Email" placeholder="Email" required />
							<input type="text" name="SĐT" placeholder="Số điện thoại" required pattern="[0-9]+" minlength="10" />
							<input type="password" name="MatKhau" placeholder="Mật khẩu" minlength="6" required />
							<input type="password" name="check_password" placeholder="Xác nhận mật khẩu" minlength="6" required />
							<div class="submit-text coupon">
								<button type="submit" form="form2">Đăng ký</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>