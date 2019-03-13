<?php
//show_array($list_slider);
//show_array($list_cat);
get_header();
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <?php
                    if (!empty($list_slider)) {
                        foreach ($list_slider as $slider) {
                            ?>
                            <div class="item">
                                <img src="admin/<?php echo $slider['slide_thumb']; ?>" alt="">
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <?php if (!empty($list_product_high_light)) {
                    ?>
                    <div class="section-detail">
                        <ul class="list-item list_high_light">
                            <?php
                            foreach ($list_product_high_light as $product_high_light) {
                                ?>
                                <li>
                                    <a href="<?php echo $product_high_light['url_product']; ?>" title="<?php echo $product_high_light['product_title']; ?>" class="thumb">
                                        <img src="admin/<?php echo $product_high_light['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $product_high_light['url_product']; ?>" title="" class="product-name"><?php echo $product_high_light['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($product_high_light['product_price']); ?></span>
                                        <span class="old">20.900.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $product_high_light['url_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $product_high_light['url_checkout']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                <?php }
                ?>
            </div>
            <!--end product-high_light-->
            <?php
            if (!empty($list_cat)) {
                foreach ($list_cat as $cat) {
                    $cat_id = $cat['cat_id'];
                    ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title"><?php echo $cat['cat_title']; ?> nổi bật</h3>
                        </div>
                        <div class="section-detail">
                            <?php
                            $list_product = get_list_product_by_parent_id($cat_id);
                            if (!empty($list_product)) {
                                ?>
                                <ul class="list-item clearfix">
                                    <?php
                                    foreach ($list_product as $item) {
                                        //show_array($item);
                                        ?>
                                        <li>
                                            <a href="<?php echo $item['product_url']; ?>" title="<?php echo $item['product_title']; ?>" class="thumb">
                                                <img src="admin/<?php echo $item['product_thumb']; ?>">
                                            </a>
                                            <a href="<?php echo $item['url_product']; ?>" title="" class="product-name"><?php echo $item['product_title']; ?></a>
                                            <div class="price">
                                                <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                                <span class="old">10.790.000đ</span>
                                            </div>
                                            <div class="action clearfix">
                                                <a href="<?php echo $item['url_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                                <a href="<?php echo $item['url_checkout']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                            </div>
                                        </li>
                                    <?php }
                                    ?>
                                </ul>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <!--            <div class="section" id="list-product-wp">
                            <div class="section-head">
                                <h3 class="section-title">Laptop</h3>
                            </div>
                            <div class="section-detail">
                                <ul class="list-item clearfix">
                                    <li>
                                        <a href="" title="" class="thumb">
                                            <img src="public/images/img-pro-23.png">
                                        </a>
                                        <a href="" title="" class="product-name">Laptop Asus A540UP I5</a>
                                        <div class="price">
                                            <span class="new">14.490.000đ</span>
                                            <span class="old">16.490.000đ</span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="?page=cart" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="?page=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>-->
        </div>
        <?php get_sidebar('home'); ?>
    </div>
</div>
<?php get_footer(); ?>