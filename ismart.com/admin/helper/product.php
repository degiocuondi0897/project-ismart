<?php 
function get_data_cat() {
    return db_fetch_array("SELECT * FROM `tbl_product_cat`");
}

//Hàm lấy ra sản phẩm theo id
function get_product_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id` = '{$id}'");
}
//Lấy ra tổng số lượng sản phẩm có trong CSDL
function get_num_product() {
    return db_num_rows("SELECT * FROM `tbl_product`");
}