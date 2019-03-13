<?php
get_header();
?>
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?mod=home&controller=index&action=index" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <?php if (!empty($list_buy)) {
                ?>
                <div class="section-detail table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <form action="" method="POST">
                            <tbody>
                                <?php
                                foreach ($list_buy as $item) {
                                    $item['delete'] = "?mod=cart&controller=index&action=delete&id={$item['id']}";
                                    ?>
                                    <tr>
                                        <td><?php echo $item['product_title']; ?></td>
                                        <td>
                                            <a href="<?php echo $item['product_url']; ?>" title="<?php echo $item['product_title']; ?>" class="thumb">
                                                <img src="admin/<?php echo $item['product_thumb']; ?>" alt="">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="<?php echo $item['product_url']; ?>" title="<?php echo $item['product_title']; ?>" class="name-product"><?php echo $item['product_title']; ?></a>
                                        </td>
                                        <td><?php echo currency_format($item['product_price']); ?></td>
                                        <td>
                                            <input type="number" name="num-order" id="<?php echo $item['id']; ?>" value="<?php echo $item['qty']; ?>" min="1" max="10" class="num-order num-order-<?php echo $item['id']; ?>">
                                        </td>
                                        <td class="sub_total_<?php echo $item['id'];?>"><?php echo currency_format($item['sub_total']); ?></td>
                                        <td>
                                            <a href="<?php echo $item['delete']; ?>" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </form>
                        <?php if (!empty($info_cart)) {
                            ?>
                            <tfoot>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <p id="total-price" class="fl-right">Tổng giá: <span><?php echo currency_format($info_cart['total']); ?></span></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="clearfix">
                                            <div class="fl-right">
                                                <a href="?mod=checkout&controller=index&action=index" title="" id="checkout-cart">Thanh toán</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        <?php }
                        ?>
                    </table>
                </div>
            <?php }
            ?>

        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="?" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="?mod=cart&controller=index&action=delete_all" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>