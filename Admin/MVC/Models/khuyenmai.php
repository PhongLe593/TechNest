<?php
require_once("model.php");
class khuyenmai extends Model
{
    var $table = "khuyenmai";
    var $contens = "MaKM";
    
    // Kiểm tra xem có sản phẩm nào đang sử dụng khuyến mãi này không
    function check_km_in_use($makm)
    {
        $query = "SELECT COUNT(*) as count FROM sanpham WHERE MaKM = $makm";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();
        return $row['count'];
    }
    
    // Cập nhật khuyến mãi cho tất cả sản phẩm từ makm_old sang makm_new
    function update_products_km($makm_old, $makm_new)
    {
        $query = "UPDATE sanpham SET MaKM = $makm_new WHERE MaKM = $makm_old";
        return $this->conn->query($query);
    }
}
