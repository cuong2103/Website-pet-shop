<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-3">
                    <div class="text-center">
                        <img src="<?= BASE_URL . $thongTin['anh_dai_dien']; ?>" style="width: 100px; height: 100px;" class="avatar img-circle" alt="avatar" onerror="this.onerror=null; this.src='data:image/jpeg;base64,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'">
                        <h5 class="mt-2">Họ tên: <?= $thongTin['ho_ten'] ?></h5>
                        <h6 class="mt-2">Chức vụ: <?= $thongTin['chuc_vu_id'] ?></h6>
                    </div>
                </div>

                <!-- edit form column -->
                <div class="col-md-9 personal-info">
                    <h3>Thông tin cá nhân</h3>

                    <?php if (!empty($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?= $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>

                    <form action="<?= BASE_URL . '?act=sua-thong-tin-ca-nhan' ?>" method="POST">
                        <input type="hidden" name="tai_khoan_id" value="<?= $thongTin['id'] ?>">

                        <div class="card-body">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" class="form-control" name="ho_ten" value="<?= $thongTin['ho_ten'] ?>" placeholder="Nhập họ và tên">
                                <?php if (isset($_SESSION['error']['ho_ten'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['ho_ten'] ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label>Ngày sinh</label>
                                <input type="date" class="form-control" name="ngay_sinh" value="<?= $thongTin['ngay_sinh'] ?>">
                                <?php if (isset($_SESSION['error']['ngay_sinh'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['ngay_sinh'] ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label>Giới tính</label>
                                <select id="gioi_tinh" class="form-control" name="gioi_tinh">
                                    <option value="">-- Chọn giới tính --</option>
                                    <option <?= $thongTin['gioi_tinh'] == 1 ? 'selected' : ''; ?> value="1">Nam</option>
                                    <option <?= $thongTin['gioi_tinh'] == 2 ? 'selected' : ''; ?> value="2">Nữ</option>
                                </select>
                                <?php if (isset($_SESSION['error']['gioi_tinh'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['gioi_tinh'] ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="<?= $thongTin['email'] ?>" placeholder="Nhập email">
                                <?php if (isset($_SESSION['error']['email'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['email'] ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="tel" class="form-control" name="so_dien_thoai" value="<?= $thongTin['so_dien_thoai'] ?>" placeholder="Nhập số điện thoại">
                                <?php if (isset($_SESSION['error']['so_dien_thoai'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['so_dien_thoai'] ?></p>
                                <?php } ?>
                            </div>

                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" class="form-control" name="dia_chi" value="<?= $thongTin['dia_chi'] ?>" placeholder="Nhập địa chỉ">
                                <?php if (isset($_SESSION['error']['dia_chi'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['dia_chi'] ?></p>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-sqr d-block">Lưu</button>
                        </div>
                    </form>



                    <hr>

                    <h3>Đổi mật khẩu</h3>
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-info alert-dismissable">
                            <a class="panel-close close" data-dismiss="alert">×</a>
                            <i class="fa fa-coffee"></i>
                            <?= $_SESSION['success']; ?>
                        </div>
                        <?php unset($_SESSION['success']); ?>
                    <?php } ?>

                    <form action="<?= BASE_URL . '?act=sua-mat-khau-ca-nhan' ?>" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu cũ:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="password" value="" name="old_pass">
                                <?php if (isset($_SESSION['error']['old_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['old_pass'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật khẩu mới:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="password" value="" name="new_pass">
                                <?php if (isset($_SESSION['error']['new_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['new_pass'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhập lại mật khẩu mới:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="password" value="" name="confirm_pass">
                                <?php if (isset($_SESSION['error']['confirm_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['confirm_pass'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-sqr d-block" value="Đổi mật khẩu">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <hr>
        <!-- /.container-fluid -->
    </section>



<?php require_once 'layout/miniCart.php'; ?>

<?php require_once 'layout/footer.php'; ?>