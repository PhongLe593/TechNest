<?php
require_once("model.php");
class Detail extends Model
{
    function detail_sp($id)
    {
        $query =  "SELECT * from SanPham where MaSP = $id AND TrangThai = 1";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }
}
