<?php get_header(); ?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title=""><?php if (!empty($cat)) echo $cat['cat_title']; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <?php
            if (!empty($item)) {
                //show_array($item);
                ?>
                <div class="section" id="detail-product-wp">
                    <div class="section-detail clearfix">
                        <div class="thumb-wp fl-left">
                            <a href="" title="" id="main-thumb">
                                <img src="admin/<?php echo $item['product_thumb']; ?>" alt="">
    <!--                                <img id="zoom" src="admin/<?php echo $item['product_thumb']; ?>" data-zoom-image=""/>-->
                            </a>
                            <!--                            <div id="list-thumb">
                                                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                                            </a>
                                                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                                            </a>
                                                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                                            </a>
                                                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                                            </a>
                                                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_70aaf2_700x700_maxb.jpg">
                                                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/sxlpFs_simg_02d57e_50x50_maxb.jpg" />
                                                            </a>
                                                            <a href="" data-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_ab1f47_350x350_maxb.jpg" data-zoom-image="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_70aaf2_700x700_maxb.jpg">
                                                                <img id="zoom" src="https://media3.scdn.vn/img2/2017/10_30/BlccRg_simg_02d57e_50x50_maxb.jpg" />
                                                            </a>
                                                        </div>-->
                        </div>
                        <div class="thumb-respon-wp fl-left">
                            <img src="admin/<?php echo $item['product_thumb']; ?>" alt="">
                        </div>
                        <div class="info fl-right">
                            <h3 class="product-name"><?php echo $item['product_title']; ?></h3>
                            <div class="desc">
                                <?php echo $item['product_desc']; ?>
                            </div>
                            <div class="num-product">
                                <span class="title">Sản phẩm: </span>
                                <span class="status">Còn hàng</span>
                            </div>
                            <p class="price"><?php echo currency_format($item['product_price']); ?></p>
                            <form action="<?php echo $item['url_add_cart']; ?>" method="POST" class="add_cart">
                                <div id="num-order-wp">
                                    <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                    <input type="text" name="num-order" value="1" id="num-order">
                                    <a title="" id="plus"><i class="fa fa-plus"></i></a>
                                </div>
                                <button name="btn_add_cart" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</button>
                                <!--<a href="<?php echo $item['url_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart">Thêm giỏ hàng</a>-->
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section" id="post-product-wp">
                    <div class="section-head">
                        <h3 class="section-title">Mô tả sản phẩm</h3>
                    </div>
                    <div class="section-detail">
                        <?php echo $item['product_content']; ?>
                    </div>
                </div>
            <?php }
            ?>

            <!------------>
            <div class="section" id="same-category-wp">
                <div class="section-head">
                    <h3 class="section-title">Các sản phẩm liên quan</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_product)) {
                        ?>
                        <ul class="list-item">
                            <?php
                            foreach ($list_product as $flug) {
                                $flug['product_url'] = "?mod=product&controller=detail&action=index&id={$flug['product_id']}";
                                $flug['url_add_cart'] = "?mod=cart&controller=index&action=add&id={$flug['product_id']}";
                                $flug['url_checkout'] = "?mod=checkout&controller=index&action=index&id={$flug['product_id']}";
                                ?>
                                <li>
                                    <a href="<?php echo $flug['product_url']; ?>" title="" class="thumb">
                                        <img src="admin/<?php echo $flug['product_thumb']; ?>">
                                    </a>
                                    <a href="" title="" class="product-name"><?php echo $flug['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($flug['product_price']); ?></span>
                                        <span class="old">20.900.000đ</span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $flug['url_add_cart']; ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="<?php echo $flug['url_checkout']; ?>" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
        <?php get_sidebar('home'); ?>
    </div>
</div>
<?php get_footer(); ?>