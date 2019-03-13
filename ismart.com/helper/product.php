<?php

//1. Lấy ra chi tiết từng sản phẩm theo id
function get_product_by_id($product_id) {
    $item = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id` = {$product_id}");
    $item['product_url'] = "?mod=product&controller=detail&action=index&id={$item['product_id']}";
    $item['url_add_cart'] = "?mod=product&controller=detail&action=add&id={$item['product_id']}";
    return $item;
}

function get_list_cat() {
    $product = array();
    $result = multi_data_cat(db_fetch_array("SELECT * FROM `tbl_product_cat`"));
    //show_array($result);
    foreach ($result as $item) {
        $item['url'] = "?mod=product&controller=index&action=index&cat_id={$item['cat_id']}";
        $product[] = $item;
    }
    return $product;
}

function check_exists_child($cat_id) {
    $check = db_num_rows("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = {$cat_id}");
    if ($check > 0)
        return true;
}

function get_child($cat_id) {
    return db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = {$cat_id}");
}

//Lấy ra danh mục theo level
function get_cat_by_level($level) {
    $list_cat = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `level` = {$level}");
    return $list_cat;
}

//Lấy ra danh sách sản phẩm nổi bật
function get_list_product_by_high_light($high_light) {
    $result = db_fetch_array("SELECT * FROM `tbl_product` WHERE `high_light` = {$high_light} AND `status` = 3");
    foreach ($result as &$item) {
        $item['url_product'] = "?mod=product&controller=detail&action=index&id={$item['product_id']}";
        $item['url_add_cart'] = "?mod=product&controller=detail&action=add&id={$item['product_id']}";
        $item['url_checkout'] = "?mod=checkout&controller=index&action=index&id={$item['product_id']}";
    }
    return $result;
}
