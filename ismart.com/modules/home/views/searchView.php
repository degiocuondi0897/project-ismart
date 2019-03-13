
<?php get_header(); ?>

<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
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
        <div class="main-content fl-right">
            <h1 style='font-size: 28px;font-weight: bold;color: green'>
                <?php echo form_error('search'); ?>
            </h1>
            
            <?php if (!empty($info)) {
                ?>
                <div class="section" id="list-product-wp">
                    <div class="section-head clearfix">
                        <h3 class="section-title fl-left">Kết quả tìm kiếm</h3>
                        <?php
                        if (exists_search($search)) {
                            ?>
                            <br><br><p style='color: red'>Tìm thấy <?php echo $total_row; ?> kết quả phù hợp với từ khoá: <strong><?php echo $search; ?></strong></p>
                            <?php
                        }
                        ?>

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
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <?php foreach ($info as $item) {
                                ?>
                                <li>
                                    <a href="<?php echo $item['url_product']; ?>" title="<?php echo $item['product_title']; ?>" class="thumb">
                                        <img src="admin/<?php echo $item['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $item['url_product']; ?>" title="<?php echo $item['product_title']; ?>" class="product-name"><?php echo $item['product_title']; ?></a>
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
                </div>
                <div class="section" id="paging-wp">
                    <div class="section-detail">
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <?php get_sidebar('home'); ?>

    </div>
</div>

<?php get_footer(); ?>