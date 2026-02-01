<?php 

class HomeController
{
    public $modelThuCung;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelThuCung = new ThuCung();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
       
    }

    public function home(){
        $listSanPham = $this->modelThuCung->getAllSanPham();
        require_once './views/Home.php';
    }

    public function chiTietSanPham(){
        // Lấy ra thông tin sản phẩm cần xem chi tiết
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelThuCung->getDetailSanPham($id);
        $listAnhSanPham = $this->modelThuCung->getListAnhSanPham($id);
        $listBinhLuan = $this->modelThuCung->getBinhLuanFromSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelThuCung->getlistSanPhamDanhMuc($sanPham['danh_muc_id']);
        if ($sanPham) {
            require_once './views/detailSanPham.php';
        }
        else{
            header('Location: ' . BASE_URL);
            exit();
        }
    }

    public function formLogin()
    {
        // Hiển thị view form đăng nhập
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }

    public function postLogin()
    {
        // Xử lý đăng nhập
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if($user == $email){ // Trường hợp đăng nhập thành công,
                $_SESSION['user_client'] = $user; 
                header('Location: ' . BASE_URL);
                exit();
            } else {
                // Nếu đăng nhập không thành công, lưu thông báo lỗi vào session
                $_SESSION['error'] = $user; 
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL . '?act=login'); // Quay lại trang đăng nhập
                exit();
            }
        }
    }

    public function logout(){
        if(isset($_SESSION['user_client'])){
            unset($_SESSION['user_client']);
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function addGioHang()
    {
        // Xử lý thêm sản phẩm vào giỏ hàng
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if(isset($_SESSION['user_client'])){
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);


                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if(!$gioHang){
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                    $gioHang = ['id'=> $gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }else{
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];
                $checkSanPham = false;

                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                        $checkSanPham = true;
                        break;
                    }
                }

                if(!$checkSanPham){
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }
                header('Location: ' . BASE_URL . '?act=gio-hang');
                exit();
            }
            else{
                header('Location: ' . BASE_URL . '?act=login'); // Quay lại trang đăng nhập
                exit();
            }
        }
    }


    public function gioHang()
    {
        // Hiển thị giỏ hàng
        if(isset($_SESSION['user_client'])){
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                $gioHang = ['id'=> $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            require_once './views/gioHang.php';
        }else{
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function thanhToan()
    {

        if(isset($_SESSION['user_client'])){
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id'=> $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            require_once './views/thanhToan.php';
        }else{
            header('Location: ' . BASE_URL . '?act=login');
        }
    }

    public function postThanhToan(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_POST);die;
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];

            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            $ma_don_hang = 'DH-' . rand(1000,9999);

            // Thêm thông tin vào db 

            $donHang = $this->modelDonHang->addDonHang($tai_khoan_id,
                                            $ten_nguoi_nhan,
                                            $email_nguoi_nhan,
                                            $sdt_nguoi_nhan,
                                            $dia_chi_nguoi_nhan,
                                            $ghi_chu,
                                            $tong_tien,
                                            $phuong_thuc_thanh_toan_id,
                                            $ngay_dat,
                                            $ma_don_hang,
                                            $trang_thai_id
            );

            $gioHang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);  

            if($donHang){
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

                foreach ($chiTietGioHang as $item) {
                    $donGia = $item['gia_khuyen_mai']  ?? $item['gia_san_pham'];
                    $this->modelDonHang->addChiTietDonHang(
                        $donHang, 
                        $item['san_pham_id'], 
                        $donGia, 
                        $item['so_luong'], 
                        $donGia * $item['so_luong']
                    );
                }

                // Xóa giỏ hàng sau
                $this->modelGioHang->clearDetailGioHang($gioHang['id']);

                $this->modelGioHang->clearGioHang($tai_khoan_id);

                header('Location: ' . BASE_URL . '?act=lich-su-mua-hang');
                exit();
            }
            else{
                var_dump("Lỗi khi thêm đơn hàng");die;
            }

        }
    }

    public function lichSuMuaHang () {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];
    
           // Lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaiDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');

            // Lấy ra danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

    
            // Lấy ra danh sách tất cả đơn hàng của tài khoản
            $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);
           require_once './views/lichSuMuaHang.php';
        } else {
            var_dump('Bạn chưa đăng nhập');
            die;
        }
    }
    


    public function huyDonHang() {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];
    
            // Lấy id đơn truyền từ URL
            $donHangId = $_GET['id'];
    
            // Kiểm tra đơn hàng
            $donHang = $this->modelDonHang->getDonHangById($donHangId);
    
            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền huỷ đơn hàng này";
                exit;
            }
    
            if ($donHang['trang_thai_id'] != 1) {
                echo "Chỉ đơn hàng ở trạng thái 'Chưa xác nhận' mới có thể thì";
                exit;
            }

            // Hủy đơn hàng
            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 11);
            header("Location: " . BASE_URL . '?act=lich-su-mua-hang');
            exit;

    
        } else {
            var_dump('Bạn chưa đăng nhập');
            die;
        }
    }

    public function sanPhamCho() {
        $idDanhMucCho = 1; // ID danh mục chó
        $listSanPham = $this->modelThuCung->getSanPhamByDanhMuc($idDanhMucCho);
        require_once 'views/sanPham.php';
    }

    public function sanPhamMeo()
    {
        // ID danh mục mèo (ví dụ id = 2)
        $idDanhMucMeo = 2;
        $listSanPham =$this->modelThuCung->getByDanhMucMeo($idDanhMucMeo);
        require_once 'views/sanPhamMeo.php';
    }

    public function lienHe()
    {
        require_once 'views/lienHe.php';
    }

    public function postLienHe()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name    = $_POST['name'] ?? '';
            $email   = $_POST['email'] ?? '';
            $phone   = $_POST['phone'] ?? '';
            $message = $_POST['message'] ?? '';

            // TODO: Xử lý lưu DB hoặc gửi email
            $_SESSION['success'] = "Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm.";

            header("Location: " . BASE_URL . "?act=lien-he");
            exit();
        }
    }

    public function formEditCaNhan(){
        $email = $_SESSION['user_client'];
        $thongTin = $this->modelTaiKhoan->getTaiKhoanFormEmail($email);
        // var_dump($thongTin);die;
        require_once 'views/editCaNhan.php';
        deleteSessionError();
    }

    public function postEditMatKhau(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];  
            $confirm_pass = $_POST['confirm_pass'];

            $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_client']);

            $checkPass = password_verify($old_pass, $user['mat_khau']);

            $errors = [];
            if(!$checkPass){
                $errors['old_pass'] = 'Mật khẩu người dùng không đúng';
            }
            if($new_pass !== $confirm_pass){
                $errors['confirm_pass'] = 'Mật khẩu nhập lại không đúng';
            }
            if(empty($old_pass)){
                $errors['old_pass'] = 'Mật khẩu cũ không được để trống';
            }
            if(empty($new_pass)){
                $errors['new_pass'] = 'Mật khẩu mới không được để trống';
            }
            if(empty($confirm_pass)){
                $errors['confirm_pass'] = 'Mật khẩu xác nhận không được để trống';
            }

            $_SESSION['error'] = $errors;

            if(!$errors){
                //Thực hiện cập nhật mật khẩu
                $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
                $status = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
                if($status){
                    $_SESSION['success'] = 'Đã cập nhật mật khẩu thành công!';
                    $_SESSION['flash'] = true;
                    header('Location: ' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan');
                }
            }
            else {//lưu thông báo lỗi vào session
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan');
            }
        }
    }

    public function postEditCaNhan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $tai_khoan_id = $_POST['tai_khoan_id'] ?? '';
            $ho_ten       = $_POST['ho_ten'] ?? '';
            $ngay_sinh    = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh    = $_POST['gioi_tinh'] ?? '';
            $email        = $_POST['email'] ?? '';
            $so_dien_thoai= $_POST['so_dien_thoai'] ?? '';
            $dia_chi      = $_POST['dia_chi'] ?? '';
            $mat_khau     = $_POST['mat_khau'] ?? '';
    
            // Mảng chứa lỗi
            $errors = [];
    
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($ngay_sinh)) {
                $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
            }
            if (empty($gioi_tinh)) {
                $errors['gioi_tinh'] = 'Vui lòng chọn giới tính';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }
    
            $_SESSION['error'] = $errors;
    
            // Nếu không có lỗi thì cập nhật
            if (empty($errors)) {
                $this->modelTaiKhoan->updateCaNhan(
                    $tai_khoan_id,
                    $ho_ten,
                    $ngay_sinh,
                    $gioi_tinh,
                    $email,
                    $so_dien_thoai,
                    $dia_chi,
                    $mat_khau
                );
                $_SESSION['success'] = 'Cập nhật thông tin thành công!';
                header('Location: ' . BASE_URL . '?act=form-sua-thong-tin-ca-nhan');
                exit;
            } else {
                // Giữ lại lỗi và quay lại form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL . '?act=sua-thong-tin-ca-nhan&id=' . $tai_khoan_id);
                exit;
            }
        }
    }
    
}