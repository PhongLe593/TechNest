<?php
require_once("Models/cart.php");
class CartController
{
    var $cart_model;
    public function __construct()
    {
        $this->cart_model = new Cart();
    }
    function list_cart()
    {
        $data_danhmuc = $this->cart_model->danhmuc();
        $data_chitietDM = array();

        for ($i = 1; $i <= count($data_danhmuc); $i++) {
            $data_chitietDM[$i] = $this->cart_model->chitietdanhmuc($i);
        }

        $count = 0;
        if (isset($_SESSION['sanpham'])) {
            foreach ($_SESSION['sanpham'] as $value) {
                $count += $value['ThanhTien'];
            }
        }
        require_once('Views/index.php');
    }
    function add_cart()
    {
        $id = $_GET['id'];
        $data = $this->cart_model->detail_sp($id);
        
        // Check stock before adding to cart
        if (!isset($data['SoLuong']) || $data['SoLuong'] <= 0) {
            echo "<script>alert('Sản phẩm đã hết hàng!'); window.location.href='?act=detail&id=$id';</script>";
            return;
        }
        
        // Get promotion information
        $promotion = $this->cart_model->get_promotion($data['MaKM']);
        $discountValue = isset($promotion['GiaTriKM']) ? $promotion['GiaTriKM'] : 0;
        $discountedPrice = $data['DonGia'] - $discountValue;
        
        $count = 0;
        if (isset($_SESSION['sanpham'][$id])) {
            $arr = $_SESSION['sanpham'][$id];
            // Check if adding one more exceeds stock
            if ($arr['SoLuong'] + 1 > $data['SoLuong']) {
                echo "<script>alert('Số lượng sản phẩm vượt quá số lượng tồn kho!'); window.location.href='?act=cart#dxd';</script>";
                return;
            }
            
            $arr['SoLuong'] = $arr['SoLuong'] + 1;
            $arr['ThanhTien'] = $arr['SoLuong'] * $arr["DonGia"];
            $arr['MaxSoLuong'] = $data['SoLuong']; // Update stock information
            $_SESSION['sanpham'][$id] = $arr;
        } else {
            $arr['MaSP'] = $data['MaSP'];
            $arr['TenSP'] = $data['TenSP'];
            $arr['DonGia'] = $discountedPrice; // Use discounted price
            $arr['GiaGoc'] = $data['DonGia']; // Store original price
            $arr['GiamGia'] = $discountValue; // Store discount value
            $arr['SoLuong'] = 1;
            $arr['MaxSoLuong'] = $data['SoLuong']; // Store stock information
            $arr['ThanhTien'] = $discountedPrice;
            $arr['HinhAnh1'] = $data['HinhAnh1'];
            $_SESSION['sanpham'][$id] = $arr;
        }

        foreach ($_SESSION['sanpham'] as $value) {
            $count += $value['ThanhTien'];
        }

        header('Location:?act=cart#dxd');
    }
    function update_cart()
    {
        $arr = $_SESSION['sanpham'][$_GET['id']];
        $arr['SoLuong'] = $arr['SoLuong'] + 1;
        $arr['ThanhTien'] = $arr['SoLuong'] * $arr["DonGia"];
        $_SESSION['sanpham'][$_GET['id']] = $arr;
        header('Location: ?act=cart#dxd');
    }
    function delete_cart()
    {
        $arr = $_SESSION['sanpham'][$_GET['id']];
        if ($arr['SoLuong'] == 1) {
            unset($_SESSION['sanpham'][$_GET['id']]);
        } else {
            $arr = $_SESSION['sanpham'][$_GET['id']];
            $arr['SoLuong'] = $arr['SoLuong'] - 1;
            $arr['ThanhTien'] = $arr['SoLuong'] * $arr["DonGia"];
            $_SESSION['sanpham'][$_GET['id']] = $arr;
        }
        header('Location: ?act=cart#dxd');
    }
    function deleteall_cart()
    {
        unset($_SESSION['sanpham'][$_GET['id']]);
        header('Location: ?act=cart#dxd');
    }
    
    function update_ajax()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        
        if ($id <= 0 || $quantity <= 0) {
            echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ']);
            return;
        }
        
        // Check product stock
        $product = $this->cart_model->detail_sp($id);
        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
            return;
        }
        
        // Check if quantity is valid
        if (isset($product['SoLuong']) && $quantity > $product['SoLuong']) {
            echo json_encode([
                'success' => false, 
                'message' => 'Số lượng sản phẩm vượt quá số lượng tồn kho (' . $product['SoLuong'] . ')'
            ]);
            return;
        }
        
        if (isset($_SESSION['sanpham'][$id])) {
            $arr = $_SESSION['sanpham'][$id];
            $arr['SoLuong'] = $quantity;
            $arr['ThanhTien'] = $quantity * $arr["DonGia"];
            $_SESSION['sanpham'][$id] = $arr;
            
            // Calculate total cart price
            $cartTotal = 0;
            foreach ($_SESSION['sanpham'] as $value) {
                $cartTotal += $value['ThanhTien'];
            }
            
            // Return updated values
            echo json_encode([
                'success' => true,
                'itemPrice' => number_format($arr['ThanhTien']),
                'cartTotal' => number_format($cartTotal),
                'cartTotalWithShipping' => number_format($cartTotal + 15000)
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không có trong giỏ hàng']);
        }
    }
}