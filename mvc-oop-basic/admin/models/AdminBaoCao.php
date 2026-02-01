<?php
class AdminBaoCao {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getOrderStatsByMonth() {
        $sql = "SELECT 
                    MONTH(ngay_dat) as month, 
                    COUNT(*) as total_orders
                FROM don_hangs
                GROUP BY MONTH(ngay_dat)
                ORDER BY MONTH(ngay_dat)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();

        // Mảng 12 tháng mặc định = 0
        $result = array_fill(1, 12, 0);
        foreach ($data as $row) {
            $result[(int)$row['month']] = (int)$row['total_orders'];
        }
        return $result;
    }
}
