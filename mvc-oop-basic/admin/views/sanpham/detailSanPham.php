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
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="col-12">
              <img style="width:400px; height: 400px" src="<?= BASE_URL . $SanPham['hinh_anh'] ?>" class="product-image" alt="Product Image">
            </div>
            <div class="col-12 product-image-thumbs">
              <?php foreach ($listAnhSanPham as $key => $anhSP): ?>
                <div class="product-image-thumb <?= $anhSP[$key] == 0 ? 'active' : '' ?>"><img src="<?= BASE_URL . $anhSP['link_hinh_anh'] ?>" alt="Product Image"></div>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <h3 class="my-3">Tên sản phẩm: <?= $SanPham['ten_san_pham'] ?></h3>
            <hr>
            <h4 class="mt-3">Giá tiền: <small><?= number_format($SanPham['gia_san_pham']) ?></small></h4>
            <h4 class="mt-3">Giá khuyến mãi: <small><?= number_format($sanPham['gia_khuyen_mai'] ?? 0, 0, ',', '.') ?></small></h4>
            <h4 class="mt-3">Số lượng: <small><?= $SanPham['so_luong'] ?></small></h4>
            <h4 class="mt-3">Lượt xem: <small><?= $SanPham['luot_xem'] ?></small></h4>
            <h4 class="mt-3">Ngày nhập: <small><?= $SanPham['ngay_nhap'] ?></small></h4>
            <h4 class="mt-3">Danh mục: <small><?= $SanPham['ten_danh_muc'] ?></small></h4>
            <h4 class="mt-3">Trạng thái:
              <small>
                <?php if ($SanPham['trang_thai'] == 1): ?>
                  <span class="badge badge-success">Còn hàng</span>
                <?php else: ?>
                  <span class="badge badge-danger">Hết hàng</span>
                <?php endif; ?>
              </small>
            </h4>
            <h4 class="mt-3">Mô tả: <small><?= $SanPham['mo_ta'] ?></small></h4>
          </div>
        </div>

        <div class="col-12">
          <hr>
          <h2>Bình luận của sản phẩm</h2>
          <div>
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Người bình luận</th>
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
                      <a target="_blank" href="<?= BASE_URL_ADMIN . '?act=chi-tiet-khach-hang&id_khach_hang=' . $binhLuan['tai_khoan_id']; ?>">
                        <?php echo $binhLuan['ho_ten']; ?>
                      </a>
                    </td>
                    <td><?php echo $binhLuan['noi_dung']; ?></td>
                    <td><?php echo $binhLuan['ngay_dang']; ?></td>
                    <td><?php echo $binhLuan['trang_thai'] == 1 ? 'Hiển thị' : 'Ẩn'; ?></td>
                    <td>

                      <form action="<?= BASE_URL_ADMIN . '?act=update-trang-thai-binh-luan' ?>" method="post">
                        <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                        <input type="hidden" name="name_view" value="detail_san_pham">
                        <button onclick="return confirm('Bạn có ẩn bình luận này không?')" class="btn btn-warning">
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
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function() {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>

</html>