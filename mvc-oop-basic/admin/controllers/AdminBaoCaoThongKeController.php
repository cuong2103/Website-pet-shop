<?php
class AdminBaoCaoThongKeController{
    public $modelBaoCao;

    public function __construct()
    {
        $this->modelBaoCao = new AdminBaoCao();
    }


    public function home() {
            $ordersByMonth =$this->modelBaoCao->getOrderStatsByMonth();
    
            require_once './views/home.php';
    }
    
}