<?php
require_once("MVC/models/hoadon.php");
class HoaDonController
{
    var $hoadon_model;
    public function __construct()
    {
        $this->hoadon_model = new Hoadon();
    }
    function list()
    {
        $data = array();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($id > 1) {
                $id = 0;
            }
            $data = $this->hoadon_model->trangthai($id);
        } else {
            $data = $this->hoadon_model->All();
        }
        
        // Add product information to each order
        foreach ($data as $key => $value) {
            $products = $this->hoadon_model->getProductsByOrderId($value['MaHD']);
            $productNames = [];
            foreach ($products as $product) {
                $productNames[] = $product['Ten'] . ' (SL: ' . $product['SoLuong'] . ')';
            }
            $data[$key]['Products'] = implode(', ', $productNames);
        }
        
        require_once("MVC/Views/Admin/index.php");
    }
    function xetduyet()
    {
        $data = array(
            'MaHD' => $_GET['id'],
            'TrangThai' => 1,
        );
        $this->hoadon_model->update($data);
    }
    function delete()
    {
        if (isset($_GET['id'])) {
            $this->hoadon_model->delete($_GET['id']);
        }
    }
    function chitiet()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $data = $this->hoadon_model->chitiethoadon($id);
        require_once("MVC/Views/Admin/index.php");
    }
}
