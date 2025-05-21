<?php
require_once("MVC/models/hoadon.php");
class HoaDonController
{
    var $hoadon_model;
    public function __construct()
    {
        $this->hoadon_model = new Hoadon();
    }
    function list()
    {
        $data = array();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($id > 1) {
                $id = 0;
            }
            $data = $this->hoadon_model->trangthai($id);
        } else {
            $data = $this->hoadon_model->All();
        }
        
        // Add product information to each order
        foreach ($data as $key => $value) {
            $products = $this->hoadon_model->getProductsByOrderId($value['MaHD']);
            $productNames = [];
            foreach ($products as $product) {
                $productNames[] = $product['Ten'] . ' (SL: ' . $product['SoLuong'] . ')';
            }
            $data[$key]['Products'] = implode(', ', $productNames);
        }
        
        require_once("MVC/Views/Admin/index.php");
    }
    function xetduyet()
    {
        $data = array(
            'MaHD' => $_GET['id'],
            'TrangThai' => 1,
        );
        $this->hoadon_model->update($data);
    }
    function delete()
    {
        if (isset($_GET['id'])) {
            $this->hoadon_model->delete($_GET['id']);
            header('Location: ?mod=hoadon');
        }
    }
    function chitiet()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $data = $this->hoadon_model->chitiethoadon($id);
        $orderStatus = $this->hoadon_model->getOrderStatus($id);
        require_once("MVC/Views/Admin/index.php");
    }
    
    function printInvoice()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            // Lấy thông tin hóa đơn
            $orderInfo = $this->hoadon_model->getOrderInfo($id);
            $orderDetails = $this->hoadon_model->chitiethoadon($id);
            
            // Khởi tạo TCPDF
            require_once('C:/xampp/htdocs/TechNest/TCPDF/tcpdf.php');
            
            // Tạo đối tượng PDF mới
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
            
            // Thiết lập thông tin tài liệu
            $pdf->SetCreator('TechNest');
            $pdf->SetAuthor('TechNest Admin');
            $pdf->SetTitle('Hóa đơn #' . $id);
            $pdf->SetSubject('Hóa đơn');
            
            // Xóa header/footer mặc định
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            
            // Thiết lập font chữ
            $pdf->SetFont('dejavusans', '', 10);
            
            // Thêm trang mới
            $pdf->AddPage();
            
            // Logo và thông tin cửa hàng
            //$pdf->Image('../../public/img/logo.png', 10, 10, 30, 0, 'PNG');
            $pdf->SetFont('dejavusans', 'B', 15);
            $pdf->Cell(0, 10, 'CỬA HÀNG TECHNEST', 0, 1, 'R');
            $pdf->SetFont('dejavusans', '', 10);
            $pdf->Cell(0, 6, 'Địa chỉ: 123 Đường ABC, Phường Cầu Diễn, Hà Nội', 0, 1, 'R');
            $pdf->Cell(0, 6, 'Điện thoại: 0123 456 789', 0, 1, 'R');
            $pdf->Cell(0, 6, 'Email: technest@gmail.com', 0, 1, 'R');
            
            // Tiêu đề hóa đơn
            $pdf->Ln(10);
            $pdf->SetFont('dejavusans', 'B', 15);
            $pdf->Cell(0, 10, 'HÓA ĐƠN BÁN HÀNG', 0, 1, 'C');
            $pdf->SetFont('dejavusans', 'B', 10);
            $pdf->Cell(0, 6, 'Mã hóa đơn: ' . $orderInfo['MaHD'], 0, 1, 'C');
            
            // Thông tin khách hàng
            $pdf->Ln(10);
            $pdf->SetFont('dejavusans', 'B', 12);
            $pdf->Cell(0, 8, 'THÔNG TIN KHÁCH HÀNG', 0, 1, 'L');
            $pdf->SetFont('dejavusans', '', 10);
            $pdf->Cell(30, 6, 'Người nhận:', 0, 0, 'L');
            $pdf->Cell(100, 6, $orderInfo['NguoiNhan'], 0, 1, 'L');
            $pdf->Cell(30, 6, 'Địa chỉ:', 0, 0, 'L');
            $pdf->Cell(100, 6, $orderInfo['DiaChi'], 0, 1, 'L');
            $pdf->Cell(30, 6, 'Điện thoại:', 0, 0, 'L');
            $pdf->Cell(100, 6, $orderInfo['SDT'], 0, 1, 'L');
            if (isset($orderInfo['Email'])) {
                $pdf->Cell(30, 6, 'Email:', 0, 0, 'L');
                $pdf->Cell(100, 6, $orderInfo['Email'], 0, 1, 'L');
            }
            $pdf->Cell(30, 6, 'Ngày đặt:', 0, 0, 'L');
            $pdf->Cell(100, 6, date('d/m/Y H:i', strtotime($orderInfo['NgayLap'])), 0, 1, 'L');
            
            // Thông tin đơn hàng
            $pdf->Ln(5);
            $pdf->SetFont('dejavusans', 'B', 12);
            $pdf->Cell(0, 8, 'CHI TIẾT ĐƠN HÀNG', 0, 1, 'L');
            
            // Header bảng
            $pdf->SetFont('dejavusans', 'B', 10);
            $pdf->SetFillColor(240, 240, 240);
            $pdf->Cell(10, 8, 'STT', 1, 0, 'C', 1);
            $pdf->Cell(80, 8, 'Sản phẩm', 1, 0, 'C', 1);
            $pdf->Cell(30, 8, 'Đơn giá', 1, 0, 'C', 1);
            $pdf->Cell(20, 8, 'Số lượng', 1, 0, 'C', 1);
            $pdf->Cell(40, 8, 'Thành tiền', 1, 1, 'C', 1);
            
            // Nội dung bảng
            $pdf->SetFont('dejavusans', '', 10);
            $pdf->SetFillColor(255, 255, 255);
            
            $i = 1;
            $total = 0;
            foreach ($orderDetails as $item) {
                $pdf->Cell(10, 8, $i, 1, 0, 'C', 1);
                $pdf->Cell(80, 8, $item['Ten'], 1, 0, 'L', 1);
                $pdf->Cell(30, 8, number_format($item['DonGia']) . ' VNĐ', 1, 0, 'R', 1);
                $pdf->Cell(20, 8, $item['SoLuong'], 1, 0, 'C', 1);
                $subtotal = $item['DonGia'] * $item['SoLuong'];
                $pdf->Cell(40, 8, number_format($subtotal) . ' VNĐ', 1, 1, 'R', 1);
                
                $total += $subtotal;
                $i++;
            }
            
            // Tổng tiền
            $pdf->SetFont('dejavusans', 'B', 10);
            $pdf->Cell(140, 8, 'Tổng tiền:', 1, 0, 'R', 1);
            $pdf->Cell(40, 8, number_format($total) . ' VNĐ', 1, 1, 'R', 1);
            
            // Phương thức thanh toán
            $pdf->Ln(5);
            $pdf->SetFont('dejavusans', '', 10);
            $pdf->Cell(60, 6, 'Phương thức thanh toán:', 0, 0, 'L');
            $pdf->Cell(100, 6, $orderInfo['PhuongThuc'], 0, 1, 'L');
            
            // Trạng thái đơn hàng
            $pdf->Cell(60, 6, 'Trạng thái đơn hàng:', 0, 0, 'L');
            $trangThai = ($orderInfo['TrangThai'] == 0) ? 'Chưa xét duyệt' : 'Đã xét duyệt';
            $pdf->Cell(100, 6, $trangThai, 0, 1, 'L');
            
            // Ghi chú và cảm ơn
            $pdf->Ln(10);
            $pdf->SetFont('dejavusans', 'I', 10);
            $pdf->Cell(0, 6, 'Cảm ơn quý khách đã mua hàng tại TechNest!', 0, 1, 'C');
            
            // Xuất PDF
            $pdf->Output('hoadon_' . $id . '.pdf', 'I');
            exit;
        } else {
            header('Location: ?mod=hoadon');
        }
    }
}
