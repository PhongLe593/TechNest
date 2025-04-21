<?php
require_once("Models/order.php");

class OrderController {
    var $order_model;

    function __construct() {
        $this->order_model = new Order();
    }

    function order_history() {
        // Check for any type of login: regular user, admin or staff
        if (
            (!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] != true) && 
            (!isset($_SESSION['isLogin_Admin']) || $_SESSION['isLogin_Admin'] != true) && 
            (!isset($_SESSION['isLogin_Nhanvien']) || $_SESSION['isLogin_Nhanvien'] != true)
        ) {
            header('location: ?act=taikhoan');
            return;
        }

        // Get user ID from the login session data
        $userId = $_SESSION['login']['MaND'];
        $data = $this->order_model->getOrderHistory($userId);
        $data_danhmuc = $this->order_model->danhmuc();
        $data_chitietDM = array();

        for ($i = 1; $i <= count($data_danhmuc); $i++) {
            $data_chitietDM[$i] = $this->order_model->chitietdanhmuc($i);
        }

        require_once("Views/index.php");
    }
}
