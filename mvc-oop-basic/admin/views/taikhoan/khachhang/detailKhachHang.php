<!-- header -->
<?php include './views/layout/header.php'; ?>
<!-- end header -->

<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản lí tài khoản khách hàng</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <img
                        src="<?= BASE_URL . $khachHang['anh_dai_dien'] ?>"
                        alt=""
                        style="width: 70%;"
                        onerror="this.onerror=null; this.src='data:image/jpeg;base64,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'">
                </div>

                <div class="col-6">
                    <div class="container">
                        <table class="table table-borderless">
                            <tbody style="font-size: large;">
                                <tr>
                                    <th>Họ tên: </th>
                                    <td><?php echo $khachHang['ho_ten'] ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Email: </th>
                                    <td><?php echo $khachHang['email'] ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Ngày sinh: </th>
                                    <td><?php echo $khachHang['ngay_sinh'] ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại: </th>
                                    <td><?php echo $khachHang['so_dien_thoai'] ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Giới tính: </th>
                                    <td><?php echo $khachHang['gioi_tinh'] == 1 ? 'Nam' : 'Nữ'; ?></td>
                                </tr>
                                <tr>
                                    <th>Địa chỉ: </th>
                                    <td><?php echo $khachHang['dia_chi'] ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <th>Trạng thái tài khoản: </th>
                                    <td><?php echo $khachHang['trang_thai'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                    <h2>Lịch sử mua hàng</h2>
                    <div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên người nhân</th>
                                    <th>Số điện thoại</th>
                                    <th>Ngày đặt</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listDonHang as $key => $donHang): ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td><?php echo $donHang['ma_don_hang']; ?></td>
                                        <td><?php echo $donHang['ten_nguoi_nhan']; ?></td>
                                        <td><?php echo $donHang['sdt_nguoi_nhan']; ?></td>
                                        <td><?php echo $donHang['ngay_dat']; ?></td>
                                        <td><?php echo number_format($donHang['tong_tien'], 0, ',', '.'); ?> VNĐ</td>
                                        <td><?php echo $donHang['ten_trang_thai']; ?></td>
                                        <td>
                                            <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>">
                                                <button class="btn btn-primary">Chi tiết</button>
                                            </a>
                                            <a href="<?= BASE_URL_ADMIN . '?act=form-sua-don-hang&id_don_hang=' . $donHang['id'] ?>">
                                                <button class="btn btn-warning">Sửa</button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                    <h2>Lịch sử bình luận</h2>
                    <div>
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Sản phẩm</th>
                                    <th>Nội dung</th>
                                    <th>Ngày bình luận</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listBinhLuan as $key => $binhLuan): ?>
                                    <tr>
                                        <td><?php echo $key + 1 ?></td>
                                        <td>
                                            <a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id']; ?>">
                                                <?php echo $binhLuan['ten_san_pham']; ?>
                                            </a>
                                        </td>
                                        <td><?php echo $binhLuan['noi_dung']; ?></td>
                                        <td><?php echo $binhLuan['ngay_dang']; ?></td>
                                        <td><?php echo $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Ẩn'; ?></td>
                                        <td>

                                            <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="post">
                                                <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                                                <input type="hidden" name="name_view" value="detail_khach">
                                                <button  onclick="return confirm('Bạn có ẩn bình luận này không?')" class="btn btn-warning">
                                                   <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn' : 'Hiển thị'; ?>
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- end footer -->

</body>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        });
    });
</script>

</html>