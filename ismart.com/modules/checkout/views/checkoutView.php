<?php get_header(); ?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" action="?mod=checkout&controller=index&action=index" name="form-checkout">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname'); ?>">
                            <?php echo form_error('fullname'); ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>">
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>">
                            <?php echo form_error('address'); ?>
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo set_value('phone'); ?>">
                            <?php echo form_error('phone'); ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="note">Ghi chú</label>
                            <textarea name="note"><?php echo set_value('note'); ?></textarea>
                            <?php echo form_error('note'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_buy)) {
                        ?>
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <td>Sản phẩm</td>
                                    <td>Tổng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_buy as $item) {
                                    ?>
                                    <tr class="cart-item">
                                        <td class="product-name"><?php echo $item['product_title']; ?><strong class="product-quantity">x <?php echo $item['qty']; ?></strong></td>
                                        <td class = "product-total"><?php echo currency_format($item['sub_total']); ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                            <tfoot>
                                <?php if (!empty($info_cart)) {
                                    ?>
                                    <tr class="order-total">
                                        <td>Tổng đơn hàng:</td>
                                        <td><strong class="total-price"><?php echo currency_format($info_cart['total']); ?></strong></td>
                                    </tr>
                                <?php }
                                ?>
                            </tfoot>
                        </table>
                    <?php }
                    ?>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment_method" value="direct-payment" <?php if(isset($_POST['payment_method']) && $_POST['payment_method'] == 'direct-payment') echo "checked='checked'";?>/>
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment_method" value="payment-home" <?php if(isset($_POST['payment_method']) && $_POST['payment_method'] == 'payment-home') echo "checked='checked'";?>/>
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                        </ul>
                        <?php echo form_error('payment_method');?>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" name="order-now" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php get_footer(); ?>