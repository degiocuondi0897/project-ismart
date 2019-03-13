<?php get_header()?>
<div id="wp_order_success">
    <div id="content_order_success">
        <h2 id="title_order">Đặt hàng thành công</h2>
        <p>Chào <strong><?php if (!empty($order)) echo $order['fullname'];?></strong>!</p>
        <p>Quý khách vừa đặt thành công sản phẩm của ISMART STORY, mã đơn hàng của quý khách là: <strong><?php if (!empty($order)) echo $order['order_code'];?></strong></p>
        <p>Sau khi shop xác nhận có hàng, sản phẩm sẽ được giao hàng đến địa chỉ của quý khách tại địa chỉ: <strong><?php if (!empty($order)) echo $order['address'];?></strong> trong 3 - 4 ngày.</p>
        <p>Mọi thông tin về đơn hàng sẽ được gửi tới email của quý khách, vui lòng kiểm tra email để biết thêm chi tiết.</p>
        <p>Vào email của quý khách để xem chi tiết đơn hàng:</p>
        <a href="https://accounts.google.com/ServiceLogin?service=mail&passive=true&rm=false&continue=https://mail.google.com/mail/&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1#identifier" class="detail_order">Chi tiết đơn hàng</a>
        <a href="?mod=home&controller=index&action=index" class="go_home">Mua sắm tiếp</a>
        <p>Cảm ơn quý khách đã tin tưởng và giao dịch tại ISMART STORE!</p>
    </div>
</div>
<?php get_footer();?>