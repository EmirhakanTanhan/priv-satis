<?php
$Product = Product();
$Banner = Sorgu("*", "Banner");
?>

<?php if ($Banner) {
    foreach ($Banner as $banner) {
        if ($banner['status'] == "1") {
            $count_banner += 1;
            $show_banner = 1;
        }
    }
    if ($show_banner == 1) { ?>
        <div class="owl-carousel owl-theme" style="padding-top: 142px; margin-bottom: -294px">
            <?php foreach ($Banner as $banner) {
                if ($banner['status'] == "1") { ?>
                    <div class="item" <?php if ($count_banner == "1") echo "style='margin-bottom: 34px'"; ?> >
                        <img src="<?php echo $banner['image'] ?>" alt="<?php echo $banner['description'] ?>">
                        <div class="owl-spacing">
                            <?php if ($banner['name']) { ?>
                                <div class="owl-description">
                                    <span><?php echo $banner['name'] ?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    <?php }
} ?>

<section class="section section--bg section--first" data-bg="/Design/img/bg.jpg"">
<?php
foreach ($Product as $category) {
    if ($category['status']) {
        ?>
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <div class="section__title-wrap">
                        <h2 class="section__title"><?php echo $category['name']; ?></h2>

                        <div class="section__nav-wrap">
                            <a href="catalog.html" class="section__view">Hepsini Gör</a>

                            <button class="section__nav section__nav--prev" type="button" data-nav="#carousel1">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <polyline points='328 112 184 256 328 400'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/>
                                </svg>
                            </button>

                            <button class="section__nav section__nav--next" type="button" data-nav="#carousel1">
                                <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                                    <polyline points='184 112 328 256 184 400'
                                              style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px'/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- end title -->
            </div>
        </div>

        <!-- carousel -->
        <div class="container" style="margin-bottom: 100px">
            <div class="row">

                <?php
                foreach ($category['product'] as $product) {
                    if ($product['status']) {
                        ?>
                        <!-- card -->
                        <div style="width: 188px; margin: 0 15px">
                            <div class="card">
                                <a href="<?php echo $product['link'] ?>" class="card__cover" style="height: 225px">
                                    <img src="<?php echo $product['image'] ?>" alt=""
                                         style="height: inherit; object-fit: cover; <?php if ($product['stock'] == "0") echo "filter:grayscale(1)" ?>">
                                    <?php if ($product['discount']) { ?>
                                        <span class="card__preorder">%<?php echo $product['discount'] ?></span>
                                    <?php }
                                    if ($product['stock'] == "0") { ?>
                                        <span class="card__preorder bg-danger">Stokta Kalmadı</span>
                                    <?php } ?>
                                </a>

                                <div class="card__title">
                                    <h3 title="<?php echo $product['name'] ?>"><a
                                                href="<?php echo $product['link'] ?>"><?php echo $product['name']; ?></a>
                                    </h3>
                                    <?php if (!$product['discount']) { ?>
                                        <span><?php echo number_format($product['price'], "2"); ?> TL</span>
                                    <?php }
                                    if ($product['discount']) { ?>
                                        <span><?php echo number_format(DiscountedPrice($product['price'], $product['discount']), "2") ?> TL
                                <s><?php echo number_format($product['price'], "2"); ?> TL</s></span>
                                    <?php } ?>
                                </div>

                                <div class="card__actions">
                                    <button class="card__buy w-100"
                                            type="button" <?php if ($product['stock'] == "0") echo "disabled style='background-color: gray'" ?>
                                            onclick="BasketAdd(<?php echo $product['id']; ?>)">Sepete Ekle
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
                    <?php }
                } ?>

            </div>
        </div>
        <!-- end carousel -->
        </section>
        <!-- end section -->
        <?php
    }
}
?>

<!-- section HABER-BLOG-->
<section class="section">
    <div class="container">
        <div class="row">
            <!-- title -->
            <div class="col-12">
                <div class="section__title-wrap section__title-wrap--single">
                    <h2 class="section__title">Latest news</h2>

                    <div class="section__nav-wrap">
                        <a href="news.html" class="section__view">View All</a>
                    </div>
                </div>
            </div>
            <!-- end title -->

            <!-- big post -->
            <div class="col-12 col-md-12 col-lg-6">
                <div class="post post--big">
                    <a href="article.html" class="post__img">
                        <img src="/Design/img/posts/2.jpg" alt="">
                    </a>

                    <div class="post__content">
                        <a href="#" class="post__category">NFS</a>
                        <h3 class="post__title"><a href="article.html">New hot race from your favorite computer games
                                studio</a></h3>
                        <div class="post__meta">
                            <span class="post__date"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                          viewBox='0 0 512 512'><path
                                            d='M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z'
                                            style='fill:none;stroke-miterlimit:10;stroke-width:32px'/><polyline
                                            points='256 128 256 272 352 272'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg> 2 hours ago</span>
                            <span class="post__comments"><svg xmlns='http://www.w3.org/2000/svg' width='512'
                                                              height='512' viewBox='0 0 512 512'><path
                                            d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path
                                            d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg> 17</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end big post -->

            <!-- big video post -->
            <div class="col-12 col-md-12 col-lg-6">
                <div class="post post--big">
                    <a href="interview.html" class="post__img">
                        <img src="/Design/img/posts/1.jpg" alt="">
                    </a>

                    <a href="http://www.youtube.com/watch?v=0O2aH4XLbto" class="post__video">
                        <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                            <path d='M112,111V401c0,17.44,17,28.52,31,20.16l247.9-148.37c12.12-7.25,12.12-26.33,0-33.58L143,90.84C129,82.48,112,93.56,112,111Z'
                                  style='fill:none;stroke-miterlimit:10;stroke-width:32px'/>
                        </svg>
                    </a>

                    <div class="post__content">
                        <a href="#" class="post__category">CS:GO</a>
                        <h3 class="post__title"><a href="interview.html">Top 20 CS:GO players of 2020 according to
                                HOTFLIX.tv</a></h3>
                        <div class="post__meta">
                            <span class="post__date"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                          viewBox='0 0 512 512'><path
                                            d='M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z'
                                            style='fill:none;stroke-miterlimit:10;stroke-width:32px'/><polyline
                                            points='256 128 256 272 352 272'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg> 3 hours ago</span>
                            <span class="post__comments"><svg xmlns='http://www.w3.org/2000/svg' width='512'
                                                              height='512' viewBox='0 0 512 512'><path
                                            d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path
                                            d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg> 11</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end big video post -->

            <!-- video post -->
            <div class="col-12 col-md-6 col-xl-4">
                <div class="post">
                    <a href="interview.html" class="post__cover">
                        <img src="/Design/img/posts/3.jpg" alt="">
                    </a>

                    <a href="http://www.youtube.com/watch?v=0O2aH4XLbto" class="post__video">
                        <svg xmlns='http://www.w3.org/2000/svg' width='512' height='512' viewBox='0 0 512 512'>
                            <path d='M112,111V401c0,17.44,17,28.52,31,20.16l247.9-148.37c12.12-7.25,12.12-26.33,0-33.58L143,90.84C129,82.48,112,93.56,112,111Z'
                                  style='fill:none;stroke-miterlimit:10;stroke-width:32px'/>
                        </svg>
                    </a>

                    <div class="post__content">
                        <a href="#" class="post__category">Overview</a>
                        <h3 class="post__title"><a href="interview.html">Updated and customized gamepad</a></h3>
                        <div class="post__meta">
                            <span class="post__date"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                          viewBox='0 0 512 512'><path
                                            d='M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z'
                                            style='fill:none;stroke-miterlimit:10;stroke-width:32px'/><polyline
                                            points='256 128 256 272 352 272'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg> 4 hours ago</span>
                            <span class="post__comments"><svg xmlns='http://www.w3.org/2000/svg' width='512'
                                                              height='512' viewBox='0 0 512 512'><path
                                            d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path
                                            d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg> 14</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end video post -->

            <!-- post -->
            <div class="col-12 col-md-6 col-xl-4">
                <div class="post">
                    <a href="article.html" class="post__img">
                        <img src="/Design/img/posts/4.jpg" alt="">
                    </a>

                    <div class="post__content">
                        <a href="#" class="post__category">PC</a>
                        <h3 class="post__title"><a href="article.html">Gaming computer RXZ-3000 Ultra with
                                revolutionary..</a></h3>
                        <div class="post__meta">
                            <span class="post__date"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                          viewBox='0 0 512 512'><path
                                            d='M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z'
                                            style='fill:none;stroke-miterlimit:10;stroke-width:32px'/><polyline
                                            points='256 128 256 272 352 272'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg> 2 hours ago</span>
                            <span class="post__comments"><svg xmlns='http://www.w3.org/2000/svg' width='512'
                                                              height='512' viewBox='0 0 512 512'><path
                                            d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path
                                            d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg> 18</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end post -->

            <!-- post -->
            <div class="col-12 col-md-6 col-xl-4">
                <div class="post">
                    <a href="article.html" class="post__img">
                        <img src="/Design/img/posts/5.jpg" alt="">
                    </a>

                    <div class="post__content">
                        <a href="#" class="post__category">VR</a>
                        <h3 class="post__title"><a href="article.html">Augmented reality (AR) and Virtual Reality (VR)
                                bridge..</a></h3>
                        <div class="post__meta">
                            <span class="post__date"><svg xmlns='http://www.w3.org/2000/svg' width='512' height='512'
                                                          viewBox='0 0 512 512'><path
                                            d='M256,64C150,64,64,150,64,256s86,192,192,192,192-86,192-192S362,64,256,64Z'
                                            style='fill:none;stroke-miterlimit:10;stroke-width:32px'/><polyline
                                            points='256 128 256 272 352 272'
                                            style='fill:none;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px'/></svg> 9 hours ago</span>
                            <span class="post__comments"><svg xmlns='http://www.w3.org/2000/svg' width='512'
                                                              height='512' viewBox='0 0 512 512'><path
                                            d='M431,320.6c-1-3.6,1.2-8.6,3.3-12.2a33.68,33.68,0,0,1,2.1-3.1A162,162,0,0,0,464,215c.3-92.2-77.5-167-173.7-167C206.4,48,136.4,105.1,120,180.9a160.7,160.7,0,0,0-3.7,34.2c0,92.3,74.8,169.1,171,169.1,15.3,0,35.9-4.6,47.2-7.7s22.5-7.2,25.4-8.3a26.44,26.44,0,0,1,9.3-1.7,26,26,0,0,1,10.1,2L436,388.6a13.52,13.52,0,0,0,3.9,1,8,8,0,0,0,8-8,12.85,12.85,0,0,0-.5-2.7Z'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/><path
                                            d='M66.46,232a146.23,146.23,0,0,0,6.39,152.67c2.31,3.49,3.61,6.19,3.21,8s-11.93,61.87-11.93,61.87a8,8,0,0,0,2.71,7.68A8.17,8.17,0,0,0,72,464a7.26,7.26,0,0,0,2.91-.6l56.21-22a15.7,15.7,0,0,1,12,.2c18.94,7.38,39.88,12,60.83,12A159.21,159.21,0,0,0,284,432.11'
                                            style='fill:none;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px'/></svg> 50</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end post -->
        </div>
    </div>
</section>
<!-- end section -->

<!-- section D-NONE -->
<div class="section section--last d-none">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="partners owl-carousel">
                    <a href="#" class="partners__img">
                        <img src="/Design/img/partners/3docean-light-background.png" alt="">
                    </a>

                    <a href="#" class="partners__img">
                        <img src="/Design/img/partners/activeden-light-background.png" alt="">
                    </a>

                    <a href="#" class="partners__img">
                        <img src="/Design/img/partners/audiojungle-light-background.png" alt="">
                    </a>

                    <a href="#" class="partners__img">
                        <img src="/Design/img/partners/codecanyon-light-background.png" alt="">
                    </a>

                    <a href="#" class="partners__img">
                        <img src="/Design/img/partners/photodune-light-background.png" alt="">
                    </a>

                    <a href="#" class="partners__img">
                        <img src="/Design/img/partners/themeforest-light-background.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end section -->
