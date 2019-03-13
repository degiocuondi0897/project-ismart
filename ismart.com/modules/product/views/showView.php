<?php get_header(); ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="section" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <?php if (!empty($list_cat)) {
            ?>
            <div class="list_cat_child">
                <?php
                foreach ($list_cat as $cat) {
                    $cat_id = $cat['cat_id'];
                    ?>
                    <a href="?mod=product&controller=index&action=index&cat_id=<?php echo $cat_id; ?>"><?php echo $cat['cat_title']; ?></a>
                <?php }
                ?>
            </div>
        <?php }
        ?>
        <div class="main-content fl-right">
            <!--Sản phẩm nổi bật-->
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <?php if (!empty($list_product_high_light)) {
                    ?>
                    <div class="section-detail">
                        <ul class="list-item">
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
            </div><br><br>
            <!--Sản phẩm bán chạy-->
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <?php if (!empty($list_selling)) {
                    ?>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php
                            foreach ($list_selling as $selling) {
                                ?>
                                <li>
                                    <a href="<?php echo $selling['url_product']; ?>" title="<?php echo $selling['product_title']; ?>" class="thumb">
                                        <img src="admin/<?php echo $selling['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $selling['url_product']; ?>" title="" class="product-name"><?php echo $selling['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($selling['product_price']); ?></span>
                                        <span class="old">20.900.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $selling['url_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $selling['url_checkout']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                <?php }
                ?>
            </div><br><br>
            <!--Điện thoại nổi bật-->
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Điện thoại nổi bật</h3>
                </div>
                <?php if (!empty($list_selling)) {
                    ?>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php
                            foreach ($list_selling as $selling) {
                                ?>
                                <li>
                                    <a href="<?php echo $selling['url_product']; ?>" title="<?php echo $selling['product_title']; ?>" class="thumb">
                                        <img src="admin/<?php echo $selling['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $selling['url_product']; ?>" title="" class="product-name"><?php echo $selling['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($selling['product_price']); ?></span>
                                        <span class="old">20.900.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $selling['url_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $selling['url_checkout']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                <?php }
                ?>
            </div><br><br>
            
             <!--Laptop nổi bật-->
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Laptop nổi bật</h3>
                </div>
                <?php if (!empty($list_selling)) {
                    ?>
                    <div class="section-detail">
                        <ul class="list-item">
                            <?php
                            foreach ($list_selling as $selling) {
                                ?>
                                <li>
                                    <a href="<?php echo $selling['url_product']; ?>" title="<?php echo $selling['product_title']; ?>" class="thumb">
                                        <img src="admin/<?php echo $selling['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $selling['url_product']; ?>" title="" class="product-name"><?php echo $selling['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($selling['product_price']); ?></span>
                                        <span class="old">20.900.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $selling['url_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $selling['url_checkout']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                <?php }
                ?>
            </div><br><br>

            
            
        </div>
        <?php get_sidebar('home'); ?>
    </div>
</div>
<?php get_footer(); ?>