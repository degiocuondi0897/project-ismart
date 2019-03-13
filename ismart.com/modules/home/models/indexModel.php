<?php

//2. Lấy ra danh mục sản phẩm theo cấp độ
function get_list_cat_by_level($level) {
    return db_fetch_array("SELECT * FROM `tbl_product_cat` WHERE `level` = {$level}");
}

//3.Lấy danh sách sản phẩm là cháu của danh mục
function get_list_product_by_parent_id($cat_id) {
    $result = array();
    $list_product = db_fetch_array("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title`, `tbl_product_cat`.`parent_id` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `parent_id` = {$cat_id} AND `high_light` = 2 AND `tbl_product`.`status` = 3");
    foreach ($list_product as &$item) {
        $item['url_product'] = "?mod=product&controller=detail&action=index&id={$item['product_id']}";
        $item['url_add_cart'] = "?mod=product&controller=detail&action=add&id={$item['product_id']}";
        $item['url_checkout'] = "?mod=checkout&controller=index&action=index&id={$item['product_id']}";
        $result[] = $item;
    }
    return $result;
}

//4. Kiểm tra sự tồn tại của sản phẩm với từ khoá tìm kiếm
//SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_product_cat`.`cat_title` LIKE '%6%' OR `tbl_product`.`product_title` LIKE '%6%' AND `tbl_product`.`status` = 2

function exists_search($search) {
    $check = db_num_rows("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_product_cat`.`cat_title` LIKE '%{$search}%' OR `tbl_product`.`product_title` LIKE '%{$search}%' AND `tbl_product`.`status` = 3");
    if ($check > 0)
        return true;
    return false;
}

function get_product_by_search($search) {
    $result = db_fetch_array("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_product_cat`.`cat_title` LIKE '%{$search}%' OR `tbl_product`.`product_title` LIKE '%{$search}%' AND `tbl_product`.`status` = 3");
    if (!empty($result)) {
        foreach ($result as &$item) {
            $item['url_product'] = "?mod=product&controller=detail&action=index&id={$item['product_id']}";
            $item['url_add_cart'] = "?mod=product&controller=detail&action=add&id={$item['product_id']}";
            $item['url_checkout'] = "?mod=checkout&controller=index&action=index&id={$item['product_id']}";
        }
    }
    return $result;
}

function num_row_search($search) {
    return db_num_rows("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_product_cat`.`cat_title` LIKE '%{$search}%' OR `tbl_product`.`product_title` LIKE '%{$search}%' AND `tbl_product`.`status` = 3");
}

function get_list_slider($status) {
    return db_fetch_array("SELECT * FROM `tbl_slider` WHERE `status` = 2");
}
