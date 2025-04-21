<?php
require_once("model.php");

class Order extends Model {
    function getOrderHistory($userId) {
        $query = "SELECT h.*, GROUP_CONCAT(
                    CONCAT(c.SoLuong, ' x ', s.TenSP) SEPARATOR ', '
                ) as Products
                FROM hoadon h
                LEFT JOIN chitiethoadon c ON h.MaHD = c.MaHD
                LEFT JOIN sanpham s ON c.MaSP = s.MaSP
                WHERE h.MaND = $userId
                GROUP BY h.MaHD
                ORDER BY h.NgayLap DESC";
        require("result.php");
        return $data;
    }
}
