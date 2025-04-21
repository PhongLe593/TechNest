<?php
require_once("MVC/Models/sanpham.php");
class SanphamController
{
    var $sanpham_model;
    public function __construct()
    {
        $this->sanpham_model = new sanpham();
    }
    public function list()
    {
        $data = $this->sanpham_model->All();
        require_once("MVC/Views/Admin/index.php");
    }
    public function detail()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $data = $this->sanpham_model->find($id);
        require_once("MVC/Views/Admin/index.php");
    }
    public function add()
    {
        $data_km = $this->sanpham_model->khuyenmai();
        $data_lsp = $this->sanpham_model->loaisp();
        $data_dm = $this->sanpham_model->danhmuc();
        require_once("MVC/Views/Admin/index.php");
    }
    public function store()
    {
        $target_dir = "../public/img/products/";

        $HinhAnh1 = "";
        $target_file = $target_dir . basename($_FILES["HinhAnh1"]["name"]);
        $status_upload = move_uploaded_file($_FILES["HinhAnh1"]["tmp_name"], $target_file);
        if ($status_upload) {
            $HinhAnh1 =  "img/products/" . basename($_FILES["HinhAnh1"]["name"]);
        }

        $HinhAnh2 = "";
        $target_file = $target_dir . basename($_FILES["HinhAnh2"]["name"]);
        $status_upload = move_uploaded_file($_FILES["HinhAnh2"]["tmp_name"], $target_file);
        if ($status_upload) {
            $HinhAnh2 =  "img/products/" . basename($_FILES["HinhAnh2"]["name"]);
        }

        $HinhAnh3 = "";
        $target_file = $target_dir . basename($_FILES["HinhAnh3"]["name"]);
        $status_upload = move_uploaded_file($_FILES["HinhAnh3"]["tmp_name"], $target_file);
        if ($status_upload) {
            $HinhAnh3 =  "img/products/" . basename($_FILES["HinhAnh3"]["name"]);
        }

        $TrangThai = 0;
        if (isset($_POST['TrangThai'])) {
            $TrangThai = $_POST['TrangThai'];
        }

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ThoiGian =  date('Y-m-d H:i:s');
        $data = array(
            'MaLSP' =>    $_POST['MaLSP'],
            'MaDM' => $_POST['MaDM'],
            'TenSP'  =>   $_POST['TenSP'],
            'DonGia' => $_POST['DonGia'],
            'SoLuong' => $_POST['SoLuong'],
            'HinhAnh1' => $HinhAnh1,
            'HinhAnh2' => $HinhAnh2,
            'HinhAnh3' => $HinhAnh3,
            'MaKM' =>  $_POST['MaKM'],
            'ManHinh' =>  $_POST['ManHinh'],
            'HDH' => $_POST['HDH'],
            'CamSau' =>  $_POST['CamSau'],
            'CamTruoc' =>  $_POST['CamTruoc'],
            'CPU' =>  $_POST['CPU'],
            'Ram' =>  $_POST['Ram'],
            'Rom' =>  $_POST['Rom'],
            'SDCard' =>  $_POST['SDCard'],
            'Pin' =>  $_POST['Pin'],
            'TrangThai' => $TrangThai,
            'MoTa' =>  $_POST['MoTa'],
            'ThoiGian' => $ThoiGian
        );
        foreach ($data as $key => $value) {
            if (strpos($value, "'") != false) {
                $value = str_replace("'", "\'", $value);
                $data[$key] = $value;
            }
        }

        $this->sanpham_model->store($data);
    }
    public function delete()
    {
        $id = $_GET['id'];
        $this->sanpham_model->delete($id);
    }
    public function edit()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $data_km = $this->sanpham_model->khuyenmai();
        $data_lsp = $this->sanpham_model->loaisp();
        $data_dm = $this->sanpham_model->danhmuc();
        $data = $this->sanpham_model->find($id);
        require_once("MVC/Views/Admin/index.php");
    }
    public function update()
    {

        $target_dir = "../public/img/products/";

        $HinhAnh1 = "";
        $target_file = $target_dir . basename($_FILES["HinhAnh1"]["name"]);
        $status_upload = move_uploaded_file($_FILES["HinhAnh1"]["tmp_name"], $target_file);
        var_dump(basename($_FILES["HinhAnh1"]["name"]));
        if ($status_upload) {
            $HinhAnh1 = "img/products/" . basename($_FILES["HinhAnh1"]["name"]);
        }

        $HinhAnh2 = "";
        $target_file = $target_dir . basename($_FILES["HinhAnh2"]["name"]);
        $status_upload = move_uploaded_file($_FILES["HinhAnh2"]["tmp_name"], $target_file);
        if ($status_upload) {
            $HinhAnh2 =  "img/products/" . basename($_FILES["HinhAnh2"]["name"]);
        }

        $HinhAnh3 = "";
        $target_file = $target_dir . basename($_FILES["HinhAnh3"]["name"]);
        $status_upload = move_uploaded_file($_FILES["HinhAnh3"]["tmp_name"], $target_file);
        if ($status_upload) {
            $HinhAnh3 =  "img/products/" . basename($_FILES["HinhAnh3"]["name"]);
        }

        $TrangThai = 0;
        if (isset($_POST['TrangThai'])) {
            $TrangThai = $_POST['TrangThai'];
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ThoiGian =  date('Y-m-d H:i:s');
        $data = array(
            'MaSP' => $_POST['MaSP'],
            'MaLSP' =>    $_POST['MaLSP'],
            'MaDM' => $_POST['MaDM'],
            'TenSP'  =>   $_POST['TenSP'],
            'DonGia' => $_POST['DonGia'],
            'SoLuong' => $_POST['SoLuong'],
            'HinhAnh1' => $HinhAnh1,
            'HinhAnh2' => $HinhAnh2,
            'HinhAnh3' => $HinhAnh3,
            'MaKM' =>  $_POST['MaKM'],
            'ManHinh' =>  $_POST['ManHinh'],
            'HDH' => $_POST["HDH"],
            'CamSau' =>  $_POST['CamSau'],
            'CamTruoc' =>  $_POST['CamTruoc'],
            'CPU' =>  $_POST['CPU'],
            'Ram' =>  $_POST['Ram'],
            'Rom' =>  $_POST['Rom'],
            'SDCard' =>  $_POST['SDCard'],
            'Pin' =>  $_POST['Pin'],
            'TrangThai' => $TrangThai,
            'MoTa' =>  $_POST['MoTa'],
            'ThoiGian' => $ThoiGian
        );
        foreach ($data as $key => $value) {
            if (strpos($value, "'") != false) {
                $value = str_replace("'", "\'", $value);
                $data[$key] = $value;
            }
        }
        if ($HinhAnh1 == "") {
            unset($data['HinhAnh1']);
        }
        if ($HinhAnh2 == "") {
            unset($data['HinhAnh2']);
        }
        if ($HinhAnh3 == "") {
            unset($data['HinhAnh3']);
        }
        $this->sanpham_model->update($data);
    }
}
