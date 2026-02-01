<?php
session_start(); // Bắt đầu phiên làm việc

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/ThuCung.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php';


// Route
$act = $_GET['act'] ?? '/';

if($act !== 'login' && $act !== 'check-login' && $act !== 'logout') {
    // Kiểm tra đăng nhập
    checkLoginUser();
}

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    '/' => (new HomeController())->home(),
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    'them-gio-hang' => (new HomeController())->addGioHang(),
    'gio-hang' => (new HomeController())->gioHang(),
    'thanh-toan' => (new HomeController())->thanhToan(),
    'xu-ly-thanh-toan' => (new HomeController())->postThanhToan(),
    'lich-su-mua-hang' => (new HomeController())->lichSuMuaHang(),
    'huy-don-hang' => (new HomeController())->huyDonHang(),
    'san-pham-cho' => (new HomeController())->sanPhamCho(),
    'san-pham-meo' => (new HomeController())->sanPhamMeo(),
    'lien-he' => (new HomeController())->lienHe(),
    'send' => (new HomeController())->postLienHe(),
    'form-sua-thong-tin-ca-nhan' => (new HomeController())->formEditCaNhan(),
    'sua-thong-tin-ca-nhan' => (new HomeController())->postEditCaNhan(),
    'sua-mat-khau-ca-nhan' => (new HomeController())->postEditMatKhau(),


    // // Các route liên quan đến đăng nhập
    'login' => (new HomeController())->formlogin(),
    'check-login' => (new HomeController())->postLogin(),
    'logout' => (new HomeController())->logout(),
};
