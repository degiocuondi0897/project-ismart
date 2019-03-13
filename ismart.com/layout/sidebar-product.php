<?php
$list_cat = get_list_cat();
//$child = get_child(46);
//show_array($list_cat);
?>
<div class="sidebar fl-left">
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="secion-detail">
            <ul class="list-item">
                <?php
                if (!empty($list_cat)) {
                    foreach ($list_cat as $item) {
                        ?>
                        <?php
                        if ($item['level'] == 0) {
                            $cat_id = $item['cat_id'];
                            ?>
                            <li>
                                <a href="?mod=product&controller=index&action=index&cat_id=<?php echo $item['cat_id']; ?>" title=""><?php echo $item['cat_title']; ?></a>
                                <!--Nếu có menu con-->
                                <?php
                                if (check_exists_child($cat_id)) {
                                    ?>
                                    <ul class="sub-menu">
                                        <?php
                                        $list_child = get_child($cat_id);
                                        foreach ($list_child as $child) {
                                            $cat_id_child = $child['cat_id'];
                                            ?>
                                            <li>
                                                <a href="?mod=product&controller=index&action=index&cat_id=<?php echo $child['cat_id']; ?>" title=""><?php echo $child['cat_title']; ?></a>
                                                <?php
                                                if (check_exists_child($cat_id_child)) {
                                                    ?>
                                                    <ul class="sub-menu">
                                                        <?php
                                                        $list_child_1 = get_child($cat_id_child);
                                                        foreach ($list_child_1 as $child_1) {
                                                            //$cat_id = $child['parent_id'];
                                                            ?>
                                                            <li>
                                                                <a href="?mod=product&controller=index&action=index&cat_id=<?php echo $child_1['cat_id']; ?>" title=""><?php echo $child_1['cat_title']; ?></a>
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
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title">Bộ lọc</h3>
        </div>
        <div class="section-detail">
            <form method="POST" action="">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="r-price" class="r-price" value="1"></td>
                            <td>Dưới 500.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="r-price" value="2"></td>
                            <td>500.000đ - 1.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="r-price" value="3"></td>
                            <td>1.000.000đ - 5.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="r-price" value="4"></td>
                            <td>5.000.000đ - 10.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="r-price" value="5"></td>
                            <td>10.000.000đ - 20.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" class="r-price" value="6"></td>
                            <td>Trên 20.000.000đ</td>
                        </tr>
                    </tbody>
                </table>
<!--                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Hãng</td>
                        </tr>
                    </thead>
                    <?php if (!empty(get_cat_by_level(1))) {
                        ?>
                        <tbody>
                            <?php
                            foreach (get_cat_by_level(1) as $item) {
                                //show_array($item);
                                ?>
                                <tr>
                                    <td><input type="radio" name="r-brand" class="r-price" cat_id="<?php echo $item['cat_id'] ?>"></td>
                                    <td><?php echo $item['cat_title'] ?></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    <?php }
                    ?>
                </table>-->
<!--                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Loại</td>
                        </tr>
                    </thead>
                    <?php if (!empty(get_cat_by_level(0))) {
                        ?>
                        <tbody>
                            <?php foreach (get_cat_by_level(0) as $flug) {
                                ?>
                                <tr>
                                    <td><input type="radio" name="r-price" cat_id="<?php echo $flug['cat_id'];?>"></td>
                                    <td><?php echo $flug['cat_title'];?></td>
                                </tr>
                                <?php }
                            ?>
                        </tbody>
                    <?php }
                    ?>
                </table>-->
            </form>
        </div>
    </div>
    <div class="section" id="banner-wp">
        <div class="section-detail">
            <a href="?page=detail_product" title="" class="thumb">
                <img src="public/images/banner.png" alt="">
            </a>
        </div>
    </div>
</div>