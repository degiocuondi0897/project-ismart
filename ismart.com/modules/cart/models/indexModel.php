<?php
//3 xoá từng sản phẩm theo id
function delete_product($id) {
    if (isset($_SESSION['cart']['buy'][$id])) {
        unset($_SESSION['cart']['buy'][$id]);
        update_info_cart();
        redirect_to("?mod=cart&controller=index&action=index");
    }
}
//4. Xoá tất cả giỏ hàng 
function delete_all() {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
        update_info_cart();
        redirect_to("?mod=cart&controller=index&action=index");
    }
}
//5 Lấy ra sản phẩm theo id trong mảng session
function get_product_buy_by_id($id) {
    return $_SESSION['cart']['buy'][$id];
}
