<?php

//Sản phẩm bán chạy
function get_list_selling() {
    $list_selling = db_fetch_array("SELECT * FROM `tbl_product` WHERE `status`= 3 ORDER BY `order_qty` DESC LIMIT 8");
    foreach ($list_selling as &$selling) {
        $selling['url_product'] = "?mod=product&controller=detail&action=index&id={$selling['product_id']}";
        $selling['url_add_cart'] = "?mod=product&controller=detail&action=add&id={$selling['product_id']}";
        $selling['url_checkout'] = "?mod=checkout&controller=index&action=index&id={$selling['product_id']}";
    }
    return $list_selling;
}
