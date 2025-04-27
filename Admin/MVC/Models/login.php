<?php
require_once("connection.php");
class login
{
    var $conn;
    function __construct()
    {
        $conn_obj = new Connection();
        $this->conn = $conn_obj->conn;
    }
    function tk_sanpham($id)
    {
        $query = "SELECT count(MaSP) as Count FROM sanpham WHERE MaDM = $id";
        return $this->conn->query($query)->fetch_assoc();
    }
    function tk_thongbao()
    {
        $query = "SELECT count(MaHD) as Count FROM HoaDon WHERE TrangThai = 0";
        return $this->conn->query($query)->fetch_assoc();
    }
    function tk_dtthang($m)
    {
        $query = "SELECT SUM(TongTien) as Count FROM HoaDon WHERE MONTH(NgayLap) = $m And TrangThai = 1";
        return $this->conn->query($query)->fetch_assoc();
    }
    function tk_dtnam($y)
    {
        $query = "SELECT SUM(TongTien) as Count FROM HoaDon WHERE YEAR(NgayLap) = $y And TrangThai = 1";
        return $this->conn->query($query)->fetch_assoc();
    }
    function tk_nguoidung($id)
    {
        $query = "SELECT count(MaND) as Count FROM NguoiDung WHERE MaQuyen = $id";
        return $this->conn->query($query)->fetch_assoc();
    }
    
    function tk_date_range($start_date, $end_date)
    {
        // Ensure we include the full end date by adding time component
        $end_date_full = $end_date . ' 23:59:59';
        
        // Get total orders and revenue for the entire period
        $query = "SELECT COUNT(MaHD) as total_orders, SUM(TongTien) as total_revenue 
                 FROM HoaDon 
                 WHERE NgayLap BETWEEN '$start_date' AND '$end_date_full' 
                 AND TrangThai = 1";
        $result = $this->conn->query($query);
        $period_stats = $result->fetch_assoc();
        
        // Get daily breakdown
        $query_daily = "SELECT DATE(NgayLap) as order_date, 
                       COUNT(MaHD) as daily_orders, 
                       SUM(TongTien) as daily_revenue 
                       FROM HoaDon 
                       WHERE NgayLap BETWEEN '$start_date' AND '$end_date_full' 
                       AND TrangThai = 1 
                       GROUP BY DATE(NgayLap) 
                       ORDER BY order_date ASC";
        $result_daily = $this->conn->query($query_daily);
        
        $daily_stats = array();
        while ($row = $result_daily->fetch_assoc()) {
            $daily_stats[] = array(
                'date' => date('d/m/Y', strtotime($row['order_date'])),
                'orders' => $row['daily_orders'],
                'revenue' => $row['daily_revenue']
            );
        }
        
        return array(
            'period_orders' => $period_stats['total_orders'] ?? 0,
            'period_revenue' => $period_stats['total_revenue'] ?? 0,
            'daily_stats' => $daily_stats
        );
    }
}
