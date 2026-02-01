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
          <h1>Quản lí danh sách thú cưng</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <a href="<?= BASE_URL_ADMIN . '?act=form-them-san-pham' ?>">
                <button class="btn btn-success">Thêm thú cưng mới</button>
              </a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($listSanPham as $key => $SanPham): ?>
                    <tr>
                      <td><?php echo $key + 1 ?></td>
                      <td><?php echo $SanPham['ten_san_pham']; ?></td>
                      <td>
                        <img src="<?php echo BASE_URL . $SanPham['hinh_anh'] ?>" style="width: 100px" alt="">
                      </td>
                      <td><?php echo $SanPham['gia_san_pham']; ?></td>
                      <td><?php echo $SanPham['so_luong']; ?></td>
                      <td><?php echo $SanPham['ten_danh_muc']; ?></td>
                      <td><?php echo $SanPham['trang_thai'] == 1 ?'Còn hàng':'Hết hàng' ; ?></td>
                      <td>
                      <a href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $SanPham['id'] ?>">
                        <button class="btn btn-primary">Chi tiết</button>
                        </a>
                        <a href="<?= BASE_URL_ADMIN . '?act=form-sua-san-pham&id_san_pham=' . $SanPham['id'] ?>">
                        <button class="btn btn-warning">Sửa</button>
                        </a>
                        <a href="<?= BASE_URL_ADMIN . '?act=xoa-san-pham&id_san_pham=' . $SanPham['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa thú cưng này không?')">
                        <button class="btn btn-danger">Xóa</button>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Số lượng</th>
                    <th>Danh mục</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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

<!-- Page specific script -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->

</body>

</html>