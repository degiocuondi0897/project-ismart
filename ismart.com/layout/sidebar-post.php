<?php
$list_selling = get_list_selling();
?>
<div class="sidebar fl-left">
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <?php if (!empty($list_selling)) {
                ?>
                <ul class="list-item">
                    <?php
                    foreach ($list_selling as $item) {
                        $item['product_url'] = "?mod=product&controller=detail&action=index&id={$item['product_id']}";
                        $item['checkout_url'] = "?mod=checkout&controller=index&action=index&id={$item['product_id']}";
                        ?>
                        <li class="clearfix">
                            <a href="<?php echo $item['product_url'];?>" title="<?php echo $item['product_title'];?>" class="thumb fl-left">
                                <img src="admin/<?php echo $item['product_thumb'];?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="<?php echo $item['product_url'];?>" title="<?php echo $item['product_title'];?>" class="product-name"><?php echo $item['product_title'];?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($item['product_price']);?></span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="<?php echo $item['checkout_url'];?>" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                    <?php }
                    ?>
                </ul>
            <?php }
            ?>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_blog_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>