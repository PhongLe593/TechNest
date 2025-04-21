<?php
require_once("MVC/Models/khuyenmai.php");
class KhuyenmaiController
{
	var $khuyenmai_model;
	function __construct()
	{
		$this->khuyenmai_model = new khuyenmai();
	}

	public function list()
	{
		$data = $this->khuyenmai_model->All();
		// Đảm bảo $data luôn là một mảng, ngay cả khi không có dữ liệu trả về
		if (!is_array($data)) {
			$data = array();
		}
		require_once("MVC/Views/Admin/index.php");
		require_once('MVC/views/khuyenmai/list.php');
	}
	public function add()
	{
		require_once("MVC/Views/Admin/index.php");
		require_once('MVC/views/khuyenmai/add.php');
	}
	public function store()
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$NgayBD =  date('Y-m-d H:i:s');
		$data = array(
			'TenKM' => $_POST['TenKM'],
			'LoaiKM' => $_POST['LoaiKM'],
			'GiaTriKM' => $_POST['GiaTriKM'],
			'NgayBD' => $NgayBD,
			'TrangThai' => '1'
		);
		foreach ($data as $key => $value) {
			if (strpos($value, "'") != false) {
				$value = str_replace("'", "\'", $value);
				$data[$key] = $value;
			}
		}
		$this->khuyenmai_model->store($data);
	}
	public function detail()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 5;
		$data = $this->khuyenmai_model->find($id);
		require_once("MVC/Views/Admin/index.php");
		require_once('MVC/views/khuyenmai/detail.php');
	}
	public function delete()
	{
		if (isset($_GET['id'])) {
			$id = $_GET['id'];
			
			// Kiểm tra xem có sản phẩm nào đang sử dụng khuyến mãi này không
			$products_using_km = $this->khuyenmai_model->check_km_in_use($id);
			
			// Nếu không có action hoặc action khác 'force', và có sản phẩm đang sử dụng khuyến mãi
			if ((!isset($_GET['action']) || $_GET['action'] != 'force') && $products_using_km > 0) {
				// Hiển thị thông báo và tùy chọn
				setcookie('msg', 'Khuyến mãi này đang được sử dụng bởi '.$products_using_km.' sản phẩm. Bạn có muốn tiếp tục?', time() + 2);
				
				// Chuyển hướng đến trang xác nhận
				require_once("MVC/Views/Admin/index.php");
				require_once('MVC/views/khuyenmai/confirm_delete.php');
				return;
			}
			
			// Nếu người dùng xác nhận xóa (action = force) hoặc không có sản phẩm nào sử dụng khuyến mãi
			if (isset($_GET['action']) && $_GET['action'] == 'force') {
				// Cập nhật tất cả sản phẩm sử dụng khuyến mãi này sang khuyến mãi mặc định (MaKM = 1)
				$this->khuyenmai_model->update_products_km($id, 1);
			}
			
			// Tiến hành xóa khuyến mãi
			$this->khuyenmai_model->delete($id);
		}
	}
	public function edit()
	{
		$id = isset($_GET['id']) ? $_GET['id'] : 5;
		$data = $this->khuyenmai_model->find($id);
		require_once("MVC/Views/Admin/index.php");
		require_once('MVC/views/khuyenmai/edit.php');
	}
	public function update()
	{
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$NgayBD =  date('Y-m-d H:i:s');
		$data = array(
			'MaKM' => $_POST['MaKM'],
			'TenKM' => $_POST['TenKM'],
			'LoaiKM' => $_POST['LoaiKM'],
			'GiaTriKM' => $_POST['GiaTriKM'],
			'NgayBD' => $NgayBD,
			'TrangThai' => $_POST['TrangThai']
		);
		foreach ($data as $key => $value) {
			if (strpos($value, "'") != false) {
				$value = str_replace("'", "\'", $value);
				$data[$key] = $value;
			}
		}
		$this->khuyenmai_model->update($data);
	}
}