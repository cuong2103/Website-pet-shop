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
        <div class="col-sm-11">
          <h1>Sửa thông tin sản phẩm: <?= $SanPham['ten_san_pham'] ?></h1>
        </div>
        <div class="col-sm-1">
          <a href="<?= BASE_URL_ADMIN . '?act=san-pham' ?>" class="btn btn-secondary">Quay lại</a>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-8">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Thông tin sản phẩm</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <form action="<?= BASE_URL_ADMIN . '?act=sua-san-pham' ?>" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <input type="hidden" name="san_pham_id" value="<?= $SanPham['id']; ?>">
                <label for="ten_san_pham">Tên sản phẩm</label>
                <input type="text" id="ten_san_pham" class="form-control" value="<?= $SanPham['ten_san_pham']; ?>" name="ten_san_pham">
                <?php if (isset($_SESSION['error']['ten_san_pham'])) { ?>
                  <span class="text-danger"><?= $_SESSION['error']['ten_san_pham']; ?></span>
                <?php } ?>
              </div>

              <div class="form-group">
                <label for="gia_san_pham">Giá sản phẩm</label>
                <input type="number" id="gia_san_pham" class="form-control" value="<?= $SanPham['gia_san_pham']; ?>" name="gia_san_pham">
                <?php if (isset($_SESSION['error']['gia_san_pham'])) { ?>
                  <span class="text-danger"><?= $_SESSION['error']['gia_san_pham']; ?></span>
                <?php } ?>
              </div>

              <div class="form-group">
                <label for="gia_khuyen_mai">Giá khuyến mãi</label>
                <input type="number" id="gia_khuyen_mai" class="form-control" value="<?= $SanPham['gia_khuyen_mai']; ?>" name="gia_khuyen_mai">
              </div>

              <div class="form-group">
                <label for="hinh_anh">Hình ảnh</label>
                <input type="file" name="hinh_anh" id="hinh_anh" class="form-control">
              </div>

              <div class="form-group">
                <label for="so_luong">Số lượng</label>
                <input type="number" id="so_luong" class="form-control" value="<?= $SanPham['so_luong']; ?>" name="so_luong">
                <?php if (isset($_SESSION['error']['so_luong'])) { ?>
                  <span class="text-danger"><?= $_SESSION['error']['so_luong']; ?></span>
                <?php } ?>
              </div>

              <div class="form-group">
                <label for="ngay_nhap">Ngày nhập</label>
                <input type="date" id="ngay_nhap" class="form-control" value="<?= $SanPham['ngay_nhap']; ?>" name="ngay_nhap">
                <?php if (isset($_SESSION['error']['ngay_nhap'])) { ?>
                  <span class="text-danger"><?= $_SESSION['error']['ngay_nhap']; ?></span>
                <?php } ?>
              </div>

              <div class="form-group">
                <label for="danh_muc_id">Danh mục sản phẩm</label>
                <select id="danh_muc_id" class="form-control custom-select" name="danh_muc_id">
                  <?php foreach ($listDanhMuc as $danhMuc): ?>
                    <option <?= $danhMuc['id'] == $SanPham['danh_muc_id'] ? 'selected' : '' ?> value="<?= $danhMuc['id']; ?>"> <?= $danhMuc['ten_danh_muc']; ?>
                    </option>
                  <?php endforeach; ?>
                </select>
                <?php if (isset($_SESSION['error']['danh_muc_id'])) { ?>
                  <span class="text-danger"><?= $_SESSION['error']['danh_muc_id']; ?></span>
                <?php } ?>
              </div>

              <div class="form-group">
                <label for="trang_thai">Trạng thái</label>
                <select id="trang_thai" class="form-control" name="trang_thai">
                  <option <?= $SanPham['trang_thai'] == 1 ? 'selected' : ''; ?> value="1">Còn hàng</option>
                  <option <?= $SanPham['trang_thai'] == 2 ? 'selected' : ''; ?> value="2">Hết hàng</option>
                </select>
              </div>

              <div class="form-group">
                <label for="mo_ta">Mô tả</label>
                <textarea id="mo_ta" class="form-control" rows="4" name="mo_ta"><?= $SanPham['mo_ta']; ?></textarea>
              </div>
            </div>
            <!-- card body -->
            <div class="car-footer text-center">
              <button type="submit" class="btn btn-primary">Sửa thông tin</button>
            </div>
        </div>
        </form>
        <!-- /.card -->
      </div>
      <div class="col-md-4">
        <!-- /.card -->
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Album ảnh sản phẩm</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body p-0">>
            <form action="<?= BASE_URL_ADMIN . '?act=sua-album-anh-san-pham' ?>" method="post" enctype="multipart/form-data">
              <div class="table-responsive">
                <table id="faqs" class="table table-hover">
                  <thead>
                    <tr>
                      <th>Ảnh</th>
                      <th>File</th>
                      <th>
                        <div class="text-center"><button onclick="addfaqs();" type="button" class="badge badge-success"><i class="fa fa-plus"></i>Thêm</button></div>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                  <input type="hidden" name="san_pham_id" value="<?= $SanPham['id']; ?>">
                    <input type="hidden" id="img_delete" name="img_delete">
                    <?php foreach ($listAnhSanPham as $key=>$value):  ?>
                    <tr id="faqs-row-<?=$key?>">
                      <input type="hidden" name="current_img_id[]" value="<?=$value['id']?>">
                      <td><img src="<?=BASE_URL . $value['link_hinh_anh'] ?>" style="width: 50px; height:50px;" alt=""></td>
                      <td><input type="file" name="img_array[]" class="form-control"></td>
                      <td class="mt-10"><button type="button" class="badge badge-danger" onclick="removeRow(<?= $key ?>,<?= $value['id'] ?>)"><i class="fa fa-trash"></i> Xóa</button></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
          </div>
          <!-- /.card-body -->
          <div class="car-footer text-center">
            <button type="submit" class="btn btn-primary">Sửa thông tin</button>
          </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- end footer -->

</body>
<script>
  var faqs_row = <?= count($listAnhSanPham); ?>;

  function addfaqs() {
    html = '<tr id="faqs-row-' + faqs_row + '">';
    html += '<td><img src="data:image/png;base64,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" style="width: 50px; height:50px;" alt=""></td>';
    html += '<td><input type="file" name="img_array[]" class="form-control"></td>';
    html += '<td class="mt-10"><button type="button" class="badge badge-danger" onclick="removeRow('+ faqs_row +', null);"><i class="fa fa-trash"></i> Xóa</button></td>';

    html += '</tr>';

    $('#faqs tbody').append(html);

    faqs_row++;
  }
  function removeRow(rowId, imgID){
    $('#faqs-row-' + rowId).remove();
    if(imgID != null) {
      var imgDeleteInput = document.getElementById('img_delete')
      var currentValue = imgDeleteInput.value;
      imgDeleteInput.value = currentValue ? currentValue + ',' + imgID : imgID;
    }
  }
</script>

</html>