<?php
class AdminDanhMucController{
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function danhSachDanhMuc(){
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }

    public function formAddDanhMuc(){
        //Dùng để hiển thị form nhập
        require_once './views/danhmuc/addDanhMuc.php';
    }

    public function postAddDanhMuc(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            //Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            //Nếu không có lỗi thì thêm danh mục
            if (empty($errors)) {
                // Nếu không có lỗi thì thêm danh mục
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc, $mo_ta);
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit;
            }
            else{
                // Trả về form và lỗi
                require_once './views/danhmuc/addDanhMuc.php';
            }
        }
    }

    public function formEditDanhMuc(){
        //Dùng để hiển thị form nhập
        // Lấy ra thông tin danh mục cần sửa
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            require_once './views/danhmuc/editDanhMuc.php';
        }
        else{
            header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
            exit();
        }
    }

    public function postEditDanhMuc(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_danh_muc = $_POST['id_danh_muc'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];
            //Tạo 1 mảng trống để chứa dữ liệu
            $errors = [];
            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống';
            }
            //Nếu không có lỗi thì sửa danh mục
            if (empty($errors)) {
                // Nếu không có lỗi thì sửa danh mục
                $this->modelDanhMuc->updateDanhMuc($id_danh_muc, $ten_danh_muc, $mo_ta);
                header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
                exit;
            }
            else{
                // Trả về form và lỗi
                $danhMuc = ['id' => $id_danh_muc, 'ten_danh_muc' => $ten_danh_muc, 'mo_ta' => $mo_ta];
                require_once './views/danhmuc/editDanhMuc.php';
            }
        }
    }

    public function deleteDanhMuc(){
        // Xử lý xóa danh mục
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if ($danhMuc) {
            $this->modelDanhMuc->deleteDanhMuc($id);
        } else {
            // Nếu không tìm thấy danh mục, có thể hiển thị thông báo lỗi hoặc làm gì đó khác
            $_SESSION['error'] = 'Danh mục không tồn tại hoặc đã bị xóa trước đó.';
            // Quay lại trang danh sách danh mục
        }
        header('Location: ' . BASE_URL_ADMIN . '?act=danh-muc');
        exit;
    }
}
?>