<?php
//load('helper', 'selling');
$list_cat = get_list_cat();

//Danh sách sản phẩm bán chạy 
$list_selling = get_list_selling();
//show_array($list_selling);
?>
<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <?php if (!empty($list_cat)) {
                ?>
                <ul class="list-item">
                    <?php
                    //show_array($list_cat);die;
                    foreach ($list_cat as $cat) {
                        if ($cat['level'] == 0) {
                            //show_array($cat);die;
                            $cat_id = $cat['cat_id'];
                            ?>
                            <li>
                                <a href="<?php echo $cat['url'];?>"><?php echo $cat['cat_title'];?></a>
                                <!--Kiểm tra danh mục này có con cấp 1 hay không-->
                                <?php if (check_exists_child($cat_id)) {
                                    ?>
                                    <ul class="sub-menu">
                                        <?php
                                        $list_child = get_child($cat_id);
                                        foreach ($list_child as $child) {
                                            $child['url'] = "?mod=product&controller=index&action=index&cat_id={$child['cat_id']}";
                                            $child_id = $child['cat_id'];
                                            //show_array($child);
                                            ?>
                                            <li>
                                                <a href="<?php echo $child['url']; ?>" title=""><?php echo $child['cat_title']; ?></a>
                                                <?php
                                                if (check_exists_child($child_id)) {
                                                    $list_child_1 = get_child($child_id);
                                                    ?>
                                                    <ul class="sub-menu">
                                                        <?php
                                                        foreach ($list_child_1 as $child_1) {
                                                            $child_1['url'] = "?mod=product&controller=index&action=index&cat_id={$child_1['cat_id']}";
                                                            ?>
                                                            <li>
                                                                <a href="?page=category_product" title=""><?php echo $child_1['cat_title']; ?></a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                <?php }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                <?php }
                                ?>

                            </li>
                            <?php
                        }
                    }
                    ?>

                </ul>
            <?php }
            ?>

        </div>
    </div>
    <div class="section" id="selling-wp">
        <div class="section-head">
            <h3 class="section-title">Sản phẩm bán chạy</h3>
        </div>
        <div class="section-detail">
            <?php if (!empty($list_selling)) {
                ?>
                <ul class="list-item">
                    <?php foreach ($list_selling as $selling) {
                        ?>
                        <li class="clearfix">
                            <a href="<?php echo $selling['url_product'];?>" title="<?php echo $selling['product_title'];?>" class="thumb fl-left">
                                <img src="admin/<?php echo $selling['product_thumb'];?>" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="<?php echo $selling['url_product'];?>" title="<?php echo $selling['product_title'];?>" class="product-name"><?php echo $selling['product_title'];?></a>
                                <div class="price">
                                    <span class="new"><?php echo currency_format($selling['product_price']);?></span>
                                    <span class="old">17.190.000đ</span>
                                </div>
                                <a href="<?php echo $selling['url_checkout'];?>" title="" class="buy-now">Mua ngay</a>
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
            <a href="" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>