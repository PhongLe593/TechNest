<?php
require_once("MVC/Models/login.php");
class LoginController
{
    var $login_model;
    public function __construct()
    {
        $this->login_model = new login();
    }

    public function admin()
    {
        $data_tksp1 = $this->login_model->tk_sanpham(1);
        $data_tksp2 = $this->login_model->tk_sanpham(2);
        $data_tksp3 = $this->login_model->tk_sanpham(3);
        $data_tksp4 = $this->login_model->tk_sanpham(4);

        $data_hd = $this->login_model->tk_thongbao();

        $m = date("m");

        $data_countM = $this->login_model->tk_dtthang($m);

        $y = "20" . date("y");

        $data_countY = $this->login_model->tk_dtnam($y);

        $data_nguoidung = $this->login_model->tk_nguoidung(1);

        $data_nhanvien = $this->login_model->tk_nguoidung(3);
        
        // Handle date range filter for statistics
        if(isset($_POST['filter_stats'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            
            // Validate dates
            if(!empty($start_date) && !empty($end_date)) {
                $stats_data = $this->login_model->tk_date_range($start_date, $end_date);
                
                $period_orders = $stats_data['period_orders'];
                $period_revenue = $stats_data['period_revenue'];
                $daily_stats = $stats_data['daily_stats'];
            }
        }
        
        require_once("MVC/Views/Admin/index.php");
    }
}
