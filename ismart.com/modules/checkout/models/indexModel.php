<?php

function get_order_by_order_code($order_code) {
    return db_fetch_row("SELECT * FROM `tbl_orders` WHERE `order_code` = '{$order_code}'");
}
//2.Xử lí qty_order trong tbl_product
function get_qty_order_by_id($id) {
    $result = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id` = {$id}");
    $order_qty = $result['order_qty'];
    return $order_qty;
}
//3. Lấy ra thông tin đơn hàng theo id
function get_order_by_id($order_id) {
    return db_fetch_row("SELECT * FROM `tbl_orders` WHERE `order_id` = {$order_id}");
}
