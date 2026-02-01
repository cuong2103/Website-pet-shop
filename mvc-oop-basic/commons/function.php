<?php

// Kết nối CSDL qua PDO
function connectDB() {
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}
// Hàm upload file
function uploadFile($file, $folderUpload) {
    $pathStorage = $folderUpload . '/' . $file['name'];

    $from = $file['tmp_name']; 
    $to = PATH_ROOT . $pathStorage;
    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    } else {
        return false;
    }
}
//Xóa file
function deleteFile($filePath) {
    $fullPath = PATH_ROOT . $filePath;
    if (file_exists($fullPath)) {
        unlink($fullPath);
        return true;
    }
    return false;
}
//Xóa session sau khi load trang
function deleteSessionError(){
    if (isset($_SESSION['flash'])) {
        unset($_SESSION['flash']);
        unset($_SESSION['error']);
    }
}
// upload - update album ảnh
function uploadFileAlbum($file, $folderUpload, $key) {
    $pathStorage = $folderUpload . '/' . $file['name'][$key];

    $from = $file['tmp_name'][$key]; 
    $to = PATH_ROOT . $pathStorage;
    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    } else {
        return false;
    }
}

// Check login 
function checkLoginAdmin(){
    if(!isset($_SESSION['user_admin'])){
        require_once './views/auth/formLogin.php';
        exit();
    } 
}

function checkLoginUser(){
    if(!isset($_SESSION['user_client'])){
        require_once './views/auth/formLogin.php';
        exit();
    } 
}

// Format tiền tệ
function formmatPrice($price) {
    return number_format($price, 0, ',', '.') . ' VNĐ';
}
