<?php
class AdminTaiKhoanController
{
    public $modelTaiKhoan;
    public $modelDonHang;
    public $modelSanPham;
    public function __construct()
    {
        // Khởi tạo model
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDonHang = new AdminDonHang();
        $this->modelSanPham = new AdminSanPham();
    }

    public function danhSachTaiKhoanQuanTri()
    {
        // Lấy danh sách tài khoản quản trị
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);

        // Hiển thị view danh sách tài khoản quản trị
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }

    public function formAddQuanTri()
    {
        // Hiển thị view form thêm tài khoản quản trị
        require_once './views/taikhoan/quantri/addQuanTri.php';
        deleteSessionError();
    }

    public function postAddQuanTri()
    {
        // Xử lý thêm tài khoản quản trị
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ho_ten = $_POST['ho_ten'];
            $email = $_POST['email'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $dia_chi = $_POST['dia_chi']; // Có thể để trống 

            $errors = [];
            // Validate dữ liệu
            if (empty($ho_ten)) {
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if (empty($email)) {
                $errors['email'] = 'Email không được để trống';
            }
            if (empty($so_dien_thoai)) {
                $errors['so_dien_thoai'] = 'SĐT không được để trống';
            }
            if (empty($dia_chi)) {
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }

            $_SESSION['error'] = $errors;

            // Nếu có lỗi thì quay lại form
            if (empty($errors)) {

                $password = password_hash('123456', PASSWORD_BCRYPT); // Mật khẩu mặc định
                //Khai báo biến chuc_vu_id
                $chuc_vu_id = 1; // ID của chức vụ quản trị viên
                // var_dump($password);die;
                $this->modelTaiKhoan->insertTaiKhoan(
                    $ho_ten,
                    $email,
                    $password,
                    $chuc_vu_id,
                    $so_dien_thoai,
                    $dia_chi
                );
                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit();
            } else {
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-them-quan-tri');
                exit();
            }
        }
    }

    public function edit()
    {
        // Lấy ID từ URL
        $id_quan_tri = $_GET['id_quan_tri'];

        // Lấy thông tin tài khoản quản trị theo ID
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);

        // Hiển thị view form sửa tài khoản quản trị
        require_once './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();
    }

    public function postEditQuanTri(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu cũ của sản phẩm
            $quan_tri_id = $_POST['quan_tri_id'] ?? '';

            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';


            //Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
           if(empty($ho_ten)){
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if(empty($email)){
                $errors['email'] = 'Email không được để trống';
            }
            if(empty($so_dien_thoai)){
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if(empty($dia_chi)){
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }
            if(empty($trang_thai)){
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái tài khoản';
            }
            
            $_SESSION['error'] = $errors;
            //Nếu không có lỗi thì thêm sản phẩm
            if (empty($errors)) {
                // Nếu không có lỗi thì thêm sản phẩm
                $this->modelTaiKhoan->updateTaiKhoan(
                    $quan_tri_id, 
                    $ho_ten, 
                    $email, 
                    $so_dien_thoai, 
                    $dia_chi, 
                    $trang_thai
                );
                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
                exit;
            }
            else{
                // Trả về form và lỗi
                //Đặt chỉ thị xóa seesion sau khi hiễn thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
                exit;
            }
        }
    }

    public function resetPasswordQuanTri()
    {
        // Lấy ID từ URL
        $tai_khoan_id = $_GET['id_quan_tri'];
        $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
        $password = password_hash('123456', PASSWORD_BCRYPT); // Mật khẩu mặc định
        $status = $this->modelTaiKhoan->resetPasswordQuanTri($tai_khoan_id, $password);
        if($status && $tai_khoan['chuc_vu_id'] == 1){
            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
            exit();
        }
        else if($status && $tai_khoan['chuc_vu_id'] == 2){
            header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
            exit();
        }
        else{
            var_dump('Lỗi reset mật khẩu');die; // Thông báo lỗi nếu không reset được
        }
        

        // Hiển thị thông báo thành công
        $_SESSION['flash'] = 'Đã reset mật khẩu thành công!';
        header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri');
        exit();
    }

    public function danhSachTaiKhoanKhachHang()
    {
        // Lấy danh sách tài khoản quản trị
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);

        // Hiển thị view danh sách tài khoản quản trị
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }

    public function formEditKhachHang()
    {
        // Lấy ID từ URL
        $id_khach_hang= $_GET['id_khach_hang'];

        // Lấy thông tin tài khoản quản trị theo ID
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

        // Hiển thị view form sửa tài khoản quản trị
        require_once './views/taikhoan/khachhang/editKhachhang.php';
        deleteSessionError();
    }
    
    public function postEditKhachHang(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu cũ của sản phẩm
            $khach_hang_id = $_POST['khach_hang_id'] ?? '';
            $ho_ten = $_POST['ho_ten'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $gioi_tinh = $_POST['gioi_tinh'] ?? '';
            $email = $_POST['email'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
            $dia_chi = $_POST['dia_chi'] ?? '';
            $trang_thai = $_POST['trang_thai'] ?? '';


            //Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
           if(empty($ho_ten)){
                $errors['ho_ten'] = 'Họ tên không được để trống';
            }
            if(empty($ngay_sinh)){
                $errors['ngay_sinh'] = 'Ngày sinh không được để trống';
            }
            if(empty($gioi_tinh)){
                $errors['gioi_tinh'] = 'Vui lòng chọn giới tính';
            }
            if(empty($email)){
                $errors['email'] = 'Email không được để trống';
            }
            if(empty($so_dien_thoai)){
                $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
            }
            if(empty($dia_chi)){
                $errors['dia_chi'] = 'Địa chỉ không được để trống';
            }
            if(empty($trang_thai)){
                $errors['trang_thai'] = 'Vui lòng chọn trạng thái tài khoản';
            }
            
            $_SESSION['error'] = $errors;
            //Nếu không có lỗi thì thêm sản phẩm
            if (empty($errors)) {
                // Nếu không có lỗi thì thêm sản phẩm
               $this->modelTaiKhoan->updateKhachHang(
                    $khach_hang_id, 
                    $ho_ten, 
                    $ngay_sinh,
                    $gioi_tinh,
                    $email, 
                    $so_dien_thoai, 
                    $dia_chi,
                    $trang_thai
                );
                header('Location: ' . BASE_URL_ADMIN . '?act=list-tai-khoan-khach-hang');
                exit;
            }
            else{
                // Trả về form và lỗi
                //Đặt chỉ thị xóa seesion sau khi hiễn thị form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
                exit;
            }
        }
    }

    public function detailKhachHang(){
        // Lấy ID từ URL
        $id_khach_hang = $_GET['id_khach_hang'];

        // Lấy thông tin tài khoản quản trị theo ID
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);

        $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);

        // Hiển thị view form sửa tài khoản quản trị
        require_once './views/taikhoan/khachhang/detailKhachHang.php';
        deleteSessionError();
    }

    public function formLogin()
    {
        // Hiển thị view form đăng nhập
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }

    public function login()
    {
        // Xử lý đăng nhập
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            // Kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if($user == $email){ // Trường hợp đăng nhập thành công,
                $_SESSION['user_admin'] = $user; 
                header('Location: ' . BASE_URL_ADMIN);
                exit();
            } else {
                // Nếu đăng nhập không thành công, lưu thông báo lỗi vào session
                $_SESSION['error'] = $user; 
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=login-admin'); // Quay lại trang đăng nhập
                exit();
            }
        }
    }

    public function logout(){
        if(isset($_SESSION['user_admin'])){
            unset($_SESSION['user_admin']);
            header('Location: ' . BASE_URL_ADMIN . '?act=login-admin');
        }
    }

    public function formEditCaNhanQuanTri(){
        $email = $_SESSION['user_admin'];
        $thongTin = $this->modelTaiKhoan->getTaiKhoanFormEmail($email);
        // var_dump($thongTin);die;
        require_once './views/taikhoan/canhan/editCaNhan.php';
        deleteSessionError();
    }

    public function postEditMatKhauCaNhan(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];  
            $confirm_pass = $_POST['confirm_pass'];

            $user = $this->modelTaiKhoan->getTaiKhoanFormEmail($_SESSION['user_admin']);

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
                $status = $this->modelTaiKhoan->resetPasswordQuanTri($user['id'], $hashPass);
                if($status){
                    $_SESSION['success'] = 'Đã cập nhật mật khẩu thành công!';
                    $_SESSION['flash'] = true;
                    header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                }
            }
            else {//lưu thông báo lỗi vào session
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
            }
        }
    }

    public function postEditCaNhanQuanTri() {
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
                $this->modelTaiKhoan->updateCaNhanQuanTri(
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
                header('Location: ' . BASE_URL_ADMIN . '?act=form-sua-thong-tin-ca-nhan-quan-tri');
                exit;
            } else {
                // Giữ lại lỗi và quay lại form
                $_SESSION['flash'] = true;
                header('Location: ' . BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri&id=' . $tai_khoan_id);
                exit;
            }
        }
    }
    
    

}
