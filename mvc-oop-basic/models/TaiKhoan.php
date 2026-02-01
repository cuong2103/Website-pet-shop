<?php
class TaiKhoan{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    

    public function checkLogin($email, $mat_khau){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $user = $stmt->fetch();

            if ($user && password_verify($mat_khau, $user['mat_khau'])) {
                if($user['chuc_vu_id'] == 2){
                    if($user['trang_thai'] == 1){
                        return $user['email']; //Đăng nhập thành công
                    }else {
                        return "Tài khoản bị cấm."; //Tài khoản bị khóa
                    }
                }else{
                    return "Tài khoản không có quyền truy cập."; //Tài khoản không có quyền truy cập
                }
            }else {
                return "Bạn nhập sai thông tin tài khoản hoặc mật khẩu.";
            }
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
            return false;
        }
    }

    public function getTaiKhoanFromEmail($email){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    public function resetPassword($id, $mat_khau){
        try {
            $sql = 'UPDATE tai_khoans SET mat_khau = :mat_khau WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':id' => $id,
                    ':mat_khau' => $mat_khau
                ]
            );
            return true;
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    public function getTaiKhoanFormEmail($email){
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(
                [
                    ':email' => $email
                ]
            );
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }


    public function updateCaNhan($id, $ho_ten, $ngay_sinh, $gioi_tinh, $email, $so_dien_thoai, $dia_chi)
{
    try {
        $sql = 'UPDATE tai_khoans 
                SET ho_ten = :ho_ten, 
                    ngay_sinh = :ngay_sinh, 
                    gioi_tinh = :gioi_tinh, 
                    email = :email, 
                    so_dien_thoai = :so_dien_thoai, 
                    dia_chi = :dia_chi
                WHERE id = :id';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':ho_ten' => $ho_ten,
            ':ngay_sinh' => $ngay_sinh,
            ':gioi_tinh' => $gioi_tinh,
            ':email' => $email,
            ':so_dien_thoai' => $so_dien_thoai,
            ':dia_chi' => $dia_chi
        ]);
        return true;
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}

}