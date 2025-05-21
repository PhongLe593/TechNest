<?php
require_once("model.php");
class Hoadon extends Model
{
    var $table = "hoadon";
    var $contens = "MaHD";
    function trangthai($id)
    {
        $query = "select * from HoaDon where TrangThai = $id  ORDER BY MaHD DESC";
        require("result.php");
        return $data;
    }
    function chitiethoadon($id)
    {
        $query = "select ct.*, s.TenSP as Ten from chitiethoadon as ct, sanpham as s where ct.MaSP = s.MaSP and ct.MaHD = $id ";
        require("result.php");
        return $data;
    }
    
    function getProductsByOrderId($id)
    {
        $query = "select ct.SoLuong, s.TenSP as Ten from chitiethoadon as ct, sanpham as s where ct.MaSP = s.MaSP and ct.MaHD = $id";
        require("result.php");
        return $data;
    }

    function getOrderStatus($id)
    {
        $query = "SELECT TrangThai FROM hoadon WHERE MaHD = $id";
        require("result.php");
        return $data[0]['TrangThai'];
    }
    
    function getOrderInfo($id) 
    {
        $query = "SELECT h.*, n.Ho, n.Ten, n.Email 
                 FROM hoadon h 
                 LEFT JOIN nguoidung n ON h.MaND = n.MaND 
                 WHERE h.MaHD = $id";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    function restoreProductQuantities($orderId)
    {
        // Get all products in the order
        $query = "SELECT MaSP, SoLuong FROM chitiethoadon WHERE MaHD = $orderId";
        require("result.php");
        $orderProducts = $data;

        // Restore quantities for each product
        foreach ($orderProducts as $product) {
            $updateQuery = "UPDATE sanpham SET SoLuong = SoLuong + {$product['SoLuong']} WHERE MaSP = {$product['MaSP']}";
            $this->conn->query($updateQuery);
        }
    }

    function delete($id)
    {
        // First restore product quantities
        $this->restoreProductQuantities($id);
        
        // Then delete the order
        $query = "DELETE FROM hoadon WHERE MaHD = $id";
        $this->conn->query($query);
    }
}
