<?php
require_once("model.php");
class Checkout extends Model
{
  function save($data)
  {
    $f = "";
    $v = "";
    foreach ($data as $key => $value) {
      $f .= $key . ",";
      $v .= "'" . $value . "',";
    }
    $f = trim($f, ",");
    $v = trim($v, ",");
    $query = "INSERT INTO HoaDon($f) VALUES ($v);";

    $status = $this->conn->query($query);
    
    if ($status) {
      // Get the last inserted order ID
      $query_mahd = "SELECT MaHD FROM hoadon ORDER BY NgayLap DESC LIMIT 1";
      $result = $this->conn->query($query_mahd);
      $data_mahd = $result->fetch_assoc();
      return $data_mahd['MaHD']; // Return the order ID
    }
    
    return false;
  }
  
  function save_detail($data)
  {
    $f = "";
    $v = "";
    foreach ($data as $key => $value) {
      $f .= $key . ",";
      $v .= "'" . $value . "',";
    }
    $f = trim($f, ",");
    $v = trim($v, ",");
    $query = "INSERT INTO chitiethoadon($f) VALUES ($v);";
    
    return $this->conn->query($query);
  }
  
  function update_product_quantity($productId, $quantity)
  {
    // Get current product quantity
    $query = "SELECT SoLuong FROM sanpham WHERE MaSP = $productId";
    $result = $this->conn->query($query);
    
    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $currentQuantity = $row['SoLuong'];
      
      // Calculate new quantity
      $newQuantity = max(0, $currentQuantity - $quantity);
      
      // Update product quantity
      $updateQuery = "UPDATE sanpham SET SoLuong = $newQuantity WHERE MaSP = $productId";
      return $this->conn->query($updateQuery);
    }
    
    return false;
  }
}
