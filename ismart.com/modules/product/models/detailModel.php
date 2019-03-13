<?php


//2. Lấy ra danh mục sp theo cat_id
function get_cat_by_id($cat_id) {
    return db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_id` = {$cat_id}");
}

//3 Lấy ra các sản phẩm có cùng cat_id
function get_list_product_by_cat_id($cat_id) {
    return db_fetch_array("SELECT * FROM `tbl_product` WHERE `status` = 3 AND `cat_id` = {$cat_id}");
}

