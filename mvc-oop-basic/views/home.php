<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider1.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider2.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider3.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- hero slider area end -->

    <!-- service policy area start -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Giao hàng</h6>
                            <p>Miễn phí giao hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hỗ trợ</h6>
                            <p>Hỗ trợ 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-back"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hòan tiền</h6>
                            <p>Hoàn tiền trong 30 ngày</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Thanh toán</h6>
                            <p>Bảo mật thanh toán</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->

    <!-- banner statistics area start -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/img/slider/slider1.png" alt="product banner">
                        </a>
                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/img/slider/slider3.png" alt="product banner">
                        </a>

                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- banner statistics area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sẩn phẩm của chúng tôi</h2>
                        <p class="sub-title">Sản phẩm được cập nhật liên tục</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                                        <!-- product item start -->
                                        <div class="product-item">
                                            <figure class="product-thumb" style="width:250px; height:250px; overflow:hidden; margin:0 auto;">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                    <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product" style="width:100%; height:100%; object-fit:cover; display:block;">
                                                    <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product" style="width:100%; height:100%; object-fit:cover; display:block;">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                    if ($tinhNgay->days <= 7) { // Nếu ngày nhập trong vòng 7 ngày
                                                    ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php
                                                    }
                                                    ?>

                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <div class="product-label discount">
                                                            <span>Giảm giá</span>
                                                        </div>
                                                    <?php } ?>

                                                </div>

                                                <div class="cart-hover">
                                                    <button class="btn btn-cart"><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">Xem chi tiết</a></button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <h6 class="product-name">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span class="price-regular"><?= formmatPrice($sanPham['gia_khuyen_mai']); ?></span>
                                                        <span class="price-old"><del><?= formmatPrice($sanPham['gia_san_pham']); ?></del></span>
                                                    <?php } else { ?>
                                                        <span class="price-regular"><?= formmatPrice($sanPham['gia_san_pham']); ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- product item end -->
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                        <!-- product tab content end -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->


    <!-- group product start -->
    <section class="group-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="group-product-banner">
                        <figure class="banner-statistics">
                            <a href="#">
                                <img src="assets/img/banner/slider3.png" alt="product banner">
                            </a>
                        </figure>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="categories-group-wrapper">
                        <!-- section title start -->
                        <div class="section-title-append">
                            <h4>Sản phẩm siêu ưu đãi</h4>
                            <div class="slick-append"></div>
                        </div>
                        <!-- section title end -->

                        <!-- group list carousel start -->
                        <div class="group-list-item-wrapper">
                            <div class="group-list-carousel">

                                <?php foreach ($listSanPham as $sanPham): ?>
                                    <?php if (!empty($sanPham['gia_khuyen_mai'])): ?>
                                        <!-- group list item start -->
                                        <div class="group-slide-item">
                                            <div class="group-item">
                                                <div class="group-item-thumb">
                                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="<?= $sanPham['ten_san_pham'] ?>">
                                                    </a>
                                                </div>
                                                <div class="group-item-desc">
                                                    <h5 class="group-product-name">
                                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                            <?= $sanPham['ten_san_pham'] ?>
                                                        </a>
                                                    </h5>
                                                    <div class="price-box">
                                                        <span class="price-regular"><?= formmatPrice($sanPham['gia_khuyen_mai']); ?></span>
                                                        <span class="price-old"><del><?= formmatPrice($sanPham['gia_san_pham']); ?></del></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- group list item end -->
                                    <?php endif; ?>
                                <?php endforeach; ?>

                            </div>
                        </div>
                        <!-- group list carousel end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- group product end -->

    <!-- brand logo area start -->
    <div class="brand-logo section-padding pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="brand-logo-carousel slick-row-10 slick-arrow-style">
                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/1.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/2.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/3.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/4.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/5.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->

                        <!-- single brand start -->
                        <div class="brand-item">
                            <a href="#">
                                <img src="assets/img/brand/6.png" alt="">
                            </a>
                        </div>
                        <!-- single brand end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- brand logo area end -->
</main>




<?php require_once 'layout/miniCart.php'; ?>

<?php require_once 'layout/footer.php'; ?>