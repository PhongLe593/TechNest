<?php
require_once("connection.php");
class Model
{
    var $conn;
    var $table;
    var $contens;
    function __construct()
    {
        $conn_obj = new Connection();
        $this->conn = $conn_obj->conn;
    }
    function All()
    {
        $query = "select * from $this->table ORDER BY $this->contens DESC ";
        require("result.php");
        return $data;
    }
    function find($id)
    {
        $query = "select * from $this->table where $this->contens =$id";
        return $this->conn->query($query)->fetch_assoc();
    }
    function delete($id)
    {
        // Chỉ kiểm tra liên kết đơn hàng khi đang xóa người dùng
        if ($this->table == "nguoidung") {
            $queryCheck = "SELECT COUNT(*) as count FROM hoadon WHERE MaND=$id";
            $result = $this->conn->query($queryCheck);
            $row = $result->fetch_assoc();

            if ($row['count'] > 0) {
                setcookie('msg', 'Không thể xóa vì có đơn hàng liên quan', time() + 2);
                header('Location: ?mod=' . $this->table);
                return;
            }
        }
        
        // Nếu là bảng hoadon, kiểm tra và xóa chi tiết hóa đơn trước
        if ($this->table == "hoadon") {
            $queryDeleteDetail = "DELETE FROM chitiethoadon WHERE MaHD=$id";
            $this->conn->query($queryDeleteDetail);
        }
        
        // Tiến hành xóa
        $query = "DELETE FROM $this->table WHERE $this->contens=$id";
        $status = $this->conn->query($query);

        if ($status == true) {
            setcookie('msg', 'Xóa thành công', time() + 2);
        } else {
            setcookie('msg', 'Xóa không thành công', time() + 2);
        }
        
        header('Location: ?mod=' . $this->table);
    }

    function store($data)
    {
        try {
            unset($data['MaDanhMuc']);
            $f = "";
            $v = "";
            foreach ($data as $key => $value) {
                $f .= $key . ",";
                $v .= "'" . $value . "',";
            }
            $f = trim($f, ",");
            $v = trim($v, ",");
            $query = "INSERT INTO $this->table($f) VALUES ($v);";

            $status = $this->conn->query($query);

            if ($status == true) {
                setcookie('msg', 'Thêm mới thành công', time() + 2);
                header('Location: ?mod=' . $this->table);
            } else {
                throw new Exception("Thêm vào không thành công");
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                setcookie('msg', 'Khóa chính đã tồn tại. Vui lòng nhập lại.', time() + 2);
                header('Location: ?mod=' . $this->table . '&act=add');
            } else {
                setcookie('msg', 'Thêm vào không thành công', time() + 2);
                header('Location: ?mod=' . $this->table . '&act=add');
            }
        } catch (Exception $e) {
            setcookie('msg', $e->getMessage(), time() + 2);
            header('Location: ?mod=' . $this->table . '&act=add');
        }
    }
    function update($data)
    {
        $v = "";
        foreach ($data as $key => $value) {
            $v .= $key . "='" . $value . "',";
        }
        $v = trim($v, ",");

        $query = "UPDATE $this->table SET  $v   WHERE $this->contens = " . $data[$this->contens];
        $result = $this->conn->query($query);

        if ($result == true) {
            setcookie('msg', 'thao tác thành công', time() + 2);
            header('Location: ?mod=' . $this->table);
        } else {
            setcookie('msg', 'Cập nhật không thành công', time() + 2);
            header('Location: ?mod=' . $this->table . '&act=edit&id=' . $data['id']['id']);
        }
    }
}
