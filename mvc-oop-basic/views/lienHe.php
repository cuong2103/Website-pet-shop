<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>

<main class="py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Form liên hệ -->
            <div class="col-lg-8 col-md-7">
                <h3 class="mb-4">Tell Us Your Project</h3>
                <?php if (!empty($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success'];
                                                        unset($_SESSION['success']); ?></div>
                <?php endif; ?>
                <form action="<?= BASE_URL . '?act=send' ?>" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Nhập tên của bạn *" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="phone" class="form-control" placeholder="Số điện thoại *" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email *" required>
                        </div>
                        <div class="col-12">
                            <textarea name="message" class="form-control" placeholder="Nội dung *" rows="6" required></textarea>
                        </div>
                        <div class="contact-btn">
                            <button class="btn btn-sqr" type="submit">Gửi</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Thông tin liên hệ -->
            <div class="col-lg-4 col-md-5">
                <h3 class="mb-4">Thông tin liên hệ</h3>
                <p class="mb-4">Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum...</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-3"><i class="fa fa-map-marker me-2 text-warning"></i> Địa chỉ: FPT POLYTECHNIC</li>
                    <li class="mb-3"><i class="fa fa-envelope me-2 text-warning"></i> E-mail: dangcuong2103@gmail.com</li>
                    <li class="mb-3"><i class="fa fa-phone me-2 text-warning"></i> +0346447249</li>
                </ul>
                <h5>Giờ làm việc</h5>
                <p>Thứ 2 – Thứ 7: 08AM – 22PM</p>
            </div>
        </div>
    </div>
</main>
<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>