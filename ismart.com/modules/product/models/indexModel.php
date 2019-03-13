<?php

//1.Lấy danh sách sản phẩm là cháu của danh mục
function get_list_product_by_parent_id_pagging($cat_id, $start, $num_per_page) {
    $result = array();
    $list_product = db_fetch_array("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title`, `tbl_product_cat`.`parent_id` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `parent_id` = {$cat_id} AND `tbl_product`.`status` = 3 LIMIT {$start}, {$num_per_page}");
    foreach ($list_product as $item) {
        $item['product_url'] = "?mod=product&controller=detail&action=index&id={$item['product_id']}";
        $result[] = $item;
    }
    return $result;
}

//Đếm số sản phẩm là cháu
function num_row_by_parent_id($cat_id) {
    return db_num_rows("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title`, `tbl_product_cat`.`parent_id` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `parent_id` = {$cat_id} AND `tbl_product`.`status` = 3");
}

//------------------------------------------>
//2.Lấy ra danh sách sản phẩm là con trực tiếp của danh mục $cat_id
function get_list_product_by_cat_id_pagging($cat_id, $start, $num_per_page) {
    $result = array();
    $list_product = db_fetch_array("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title`, `tbl_product_cat`.`parent_id` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_product`.`cat_id` = {$cat_id} AND `tbl_product`.`status` = 3 LIMIT {$start}, {$num_per_page}");
    foreach ($list_product as $item) {
        $item['product_url'] = "?mod=product&controller=detail&action=index&id={$item['product_id']}";
        $result[] = $item;
    }
    return $result;
}

//Đếm số sản phẩm là con
function num_row_by_cat_id($cat_id) {
    return db_num_rows("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title`, `tbl_product_cat`.`parent_id` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_product`.`cat_id` = {$cat_id} AND `tbl_product`.`status` = 3");
}

//3.Lấy ra list danh mục theo cat_id
function get_cat_by_cat_id($cat_id) {
    return db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_id` = {$cat_id}");
}

//4. Hàm kiểm tra 1 danh mục có con hay không? theo cat_id
function check_cat_exists_child($cat_id) {
    $check = db_num_rows("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = {$cat_id}");
    if ($check > 0)
        return true;
}

//5. Lấy ra danh mục là con của danh mục có cat_id = n(2 trường hợp)
//-----cat_id : có thể là id cha của danh mục
//-----cat_id : có thể là id của chính danh mục
function get_list_cat_by_cat_id($cat_id) {
    $flug = array();
    $result = get_cat_by_cat_id($cat_id);
    $level = $result['level'];
    if ($level == 0) {
        //Nó là ông nội
        $flug = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = {$cat_id}");
    } else {
        if ($level == 1) {
            //Nó là cha: ===>  đi tìm parent_id của cha
            $item = get_cat_by_cat_id($cat_id);
            $parent_id = $item['parent_id'];
            $flug = db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `parent_id` = {$parent_id}");
        }
    }
    return $flug;
}

//6. Hàm lấy ra tất cả các sản phẩm
function get_list_all_product() {
    return db_fetch_array("SELECT * FROM `tbl_product` WHERE `status` = 3");
}

//Lọc sản phẩm theo giá tiền
//a.----- Lọc sản phẩm với giá tiền nhỏ hơn $price
function get_product_filter_price_round($price) {
    return db_fetch_array("SELECT * FROM `tbl_product` WHERE `product_price` < '{$price}'");
}
//b.----- Lọc sản phẩm trong khoảng giá $price_1, $price_2
function get_product_filter_price($price_1, $price_2) {
    return db_fetch_array("SELECT * FROM `tbl_product` WHERE `product_price` BETWEEN {$price_1} AND {$price_2}");
}
//a.----- Lọc sản phẩm với giá tiền > hơn $price
function get_product_filter_price_ceil($price) {
    return db_fetch_array("SELECT * FROM `tbl_product` WHERE `product_price` > '{$price}'");
}
