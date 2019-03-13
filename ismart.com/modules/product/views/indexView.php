<?php get_header(); ?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Sản phẩm</a>
                    </li>
                    <li>
                        <a href="" title=""><?php echo $cat_title; ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <?php
        $list_child_cat = get_list_cat_by_cat_id($cat_id);
        if (!empty($list_child_cat)) {
            ?>
            <div class="list_cat_child">
                <?php
                foreach ($list_child_cat as $child_cat) {
                    $child_cat['cat_url'] = "?mod=product&controller=index&action=index&cat_id={$child_cat['cat_id']}";
                    ?>
                    <a href="<?php echo $child_cat['cat_url']; ?>"><?php echo $child_cat['cat_title']; ?></a>
                <?php }
                ?>
            </div>
            <?php
        }
        ?>

        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $cat_title; ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiển thị 45 trên 50 sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="filter">
                    <?php if (!empty($list_product)) {
                        ?>
                        <div class="section-detail">
                            <ul id="filter" class="list-item filter clearfix">
                                <?php
                                foreach ($list_product as $item) {
                                    $item['url_add_cart'] = "?mod=product&controller=detail&action=add&id={$item['product_id']}";
                                    $item['url_checkout'] = "?mod=checkout&controller=index&action=index&id={$item['product_id']}";
                                    ?>
                                    <li>
                                        <a href="<?php echo $item['product_url']; ?>" title="<?php echo $item['product_title']; ?>" class="thumb">
                                            <img src="admin/<?php echo $item['product_thumb']; ?>">
                                        </a>
                                        <a href="<?php echo $item['product_url']; ?>" title="<?php echo $item['product_title']; ?>" class="product-name"><?php echo $item['product_title']; ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo currency_format($item['product_price']); ?></span>
                                            <span class="old">20.900.000đ</span>
                                        </div>
                                        <div class="action clearfix">
                                            <a href="<?php echo $item['url_add_cart']; ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                            <a href="<?php echo $item['url_checkout']; ?>" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                        </div>
                                    </li>
                                <?php }
                                ?>
                            </ul>
                        </div>
                    <?php }
                    ?>
                </div>

            </div>


            <div class="section" id="paging-wp">
                <div class="section-detail">
                    <?php echo get_pagging($num_page, $page, "?mod=product&controller=index&action=index&cat_id={$cat_id}") ?>
                </div>
            </div>
        </div>
        <?php get_sidebar('product'); ?>
    </div>
</div>
<?php get_footer(); ?>