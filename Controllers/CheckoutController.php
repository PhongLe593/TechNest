<?php
require_once("Models/checkout.php");
require_once("Config/vnpay.php");

class CheckoutController
{
    var $checkout_model;
    public function __construct()
    {
        $this->checkout_model = new Checkout();
    }
    function list()
    {
        if (isset($_SESSION['login'])) {
            $data_danhmuc = $this->checkout_model->danhmuc();
            $data_chitietDM = array();

            for ($i = 1; $i <= count($data_danhmuc); $i++) {
                $data_chitietDM[$i] = $this->checkout_model->chitietdanhmuc($i);
            }

            $count = 0;
            if (isset($_SESSION['sanpham'])) {
                foreach ($_SESSION['sanpham'] as $value) {
                    $count += $value['ThanhTien'];
                }
            }
            require_once('Views/index.php');
        } else {
            header('location: ?act=taikhoan');
        }
    }
    function save()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ThoiGian = date('Y-m-d H:i:s');

        $count = 0;
        if (isset($_SESSION['sanpham'])) {
            foreach ($_SESSION['sanpham'] as $value) {
                $count += $value['ThanhTien'];
            }
        }

        // Add shipping fee
        $totalAmount = $count + 15000;

        $data = array(
            'MaND' => $_SESSION['login']['MaND'],
            'NgayLap' => $ThoiGian,
            'NguoiNhan' => $_POST['NguoiNhan'],
            'SDT' => $_POST['SDT'],
            'DiaChi' => $_POST['DiaChi'],
            'TongTien' => $totalAmount,
            'TrangThai' => '0',
            'PhuongThuc' => isset($_POST['PhuongThuc']) ? $_POST['PhuongThuc'] : 'cod'
        );
        
        // Check payment method
        if (isset($_POST['PhuongThuc']) && $_POST['PhuongThuc'] == 'vnpay') {
            // Save the order data to session for later use
            $_SESSION['pending_order'] = $data;
            $_SESSION['pending_products'] = $_SESSION['sanpham'];
            
            // Redirect to VNPay
            $this->redirect_to_vnpay($totalAmount, "Thanh toan don hang #" . time());
        } else {
            // Regular COD payment flow
            $orderId = $this->checkout_model->save($data);
            
            // Save order details and update product quantities
            if (isset($_SESSION['sanpham']) && $orderId) {
                foreach ($_SESSION['sanpham'] as $item) {
                    // Add order detail
                    $orderDetail = array(
                        'MaHD' => $orderId,
                        'MaSP' => $item['MaSP'],
                        'SoLuong' => $item['SoLuong'],
                        'DonGia' => $item['DonGia']
                    );
                    $this->checkout_model->save_detail($orderDetail);
                    
                    // Update product quantity
                    $this->checkout_model->update_product_quantity($item['MaSP'], $item['SoLuong']);
                }
            }
            
            $_SESSION['order_complete'] = array(
                'products' => $_SESSION['sanpham'],
                'total' => $totalAmount,
                'NguoiNhan' => $_POST['NguoiNhan'],
                'SDT' => $_POST['SDT'],
                'DiaChi' => $_POST['DiaChi'],
                'PhuongThuc' => 'cod'
            );
            
            unset($_SESSION['sanpham']);
            
            header('Location: ?act=checkout&xuli=order_complete');
        }
    }

    private function redirect_to_vnpay($amount, $orderInfo)
    {
        $vnp_TxnRef = time() . "-" . rand(10000, 99999); // Order ID in VNPay system
        $vnp_OrderInfo = $orderInfo;
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $amount * 100; // VNPay requires amount in smallest currency unit (1 VND = 100)
        $vnp_Locale = VNPayConfig::VNP_LOCALE;
        $vnp_BankCode = "";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes')); // Order expires after 15 minutes
        
        $inputData = array(
            "vnp_Version" => VNPayConfig::VNP_VERSION,
            "vnp_TmnCode" => VNPayConfig::VNPAY_MERCHANT_CODE,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => VNPayConfig::VNP_COMMAND,
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => VNPayConfig::VNP_CURRENCY_CODE,
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => VNPayConfig::VNPAY_RETURN_URL,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate
        );
        
        if (!empty($vnp_BankCode)) {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = VNPayConfig::VNPAY_URL . "?" . $query;
        
        // Add secured hash
        $vnpSecureHash = hash_hmac('sha512', $hashdata, VNPayConfig::VNPAY_SECRET_KEY);
        $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        
        // Store transaction info in session for validation
        $_SESSION['vnpay_txn_ref'] = $vnp_TxnRef;
        
        // Redirect to VNPay
        header('Location: ' . $vnp_Url);
        exit();
    }
    
    function vnpay_return()
    {
        $data_danhmuc = $this->checkout_model->danhmuc();
        $data_chitietDM = array();

        for ($i = 1; $i <= count($data_danhmuc); $i++) {
            $data_chitietDM[$i] = $this->checkout_model->chitietdanhmuc($i);
        }
        
        // Process VNPay return
        if (isset($_GET['vnp_ResponseCode'])) {
            $vnp_ResponseCode = $_GET['vnp_ResponseCode'];
            $vnp_TxnRef = $_GET['vnp_TxnRef'];
            
            // Verify transaction
            if ($vnp_ResponseCode == '00' && isset($_SESSION['vnpay_txn_ref']) && $_SESSION['vnpay_txn_ref'] == $vnp_TxnRef) {
                // Transaction successful
                // Save order from pending data
                if (isset($_SESSION['pending_order'])) {
                    $orderData = $_SESSION['pending_order'];
                    $orderData['TrangThai'] = '0'; // Keep the same status as COD payments
                    $orderData['PhuongThuc'] = 'vnpay'; // Set payment method
                    
                    $orderId = $this->checkout_model->save($orderData);
                    
                    // Save order details
                    if (isset($_SESSION['pending_products']) && $orderId) {
                        foreach ($_SESSION['pending_products'] as $item) {
                            // Add order detail
                            $orderDetail = array(
                                'MaHD' => $orderId,
                                'MaSP' => $item['MaSP'],
                                'SoLuong' => $item['SoLuong'],
                                'DonGia' => $item['DonGia']
                            );
                            $this->checkout_model->save_detail($orderDetail);
                            
                            // Update product quantity
                            $this->checkout_model->update_product_quantity($item['MaSP'], $item['SoLuong']);
                        }
                        
                        $_SESSION['order_complete'] = array(
                            'products' => $_SESSION['pending_products'],
                            'total' => $orderData['TongTien'],
                            'NguoiNhan' => $orderData['NguoiNhan'],
                            'SDT' => $orderData['SDT'],
                            'DiaChi' => $orderData['DiaChi'],
                            'PhuongThuc' => 'vnpay',
                            'payment_status' => 'success'
                        );
                        
                        // Clear data
                        unset($_SESSION['pending_order']);
                        unset($_SESSION['pending_products']);
                        unset($_SESSION['sanpham']);
                        unset($_SESSION['vnpay_txn_ref']);
                        
                        header('Location: ?act=checkout&xuli=order_complete');
                        exit();
                    }
                }
                $paymentStatus = 'success';
                $message = 'Thanh toán thành công!';
            } else {
                // Transaction failed
                $paymentStatus = 'failed';
                $message = 'Thanh toán thất bại hoặc bị hủy!';
            }
            
            // Display payment result
            $count = isset($_SESSION['pending_order']) ? $_SESSION['pending_order']['TongTien'] : 0;
            $_SESSION['payment_result'] = array(
                'status' => $paymentStatus,
                'message' => $message
            );
        }
        
        require_once('Views/index.php');
    }
    
    function order_complete()
    {
        $data_danhmuc = $this->checkout_model->danhmuc();
        $data_chitietDM = array();

        for ($i = 1; $i <= count($data_danhmuc); $i++) {
            $data_chitietDM[$i] = $this->checkout_model->chitietdanhmuc($i);
        }
        
        $count = isset($_SESSION['order_complete']) ? $_SESSION['order_complete']['total'] : 0;
        
        require_once('Views/index.php');
    }
}
