<?php
//1. Thêm danh mục sản phẩm
function add_product_cat($data) {
    if (!empty($data))
        return db_insert ('tbl_product_cat', $data);
    return false;
}
//2. Hàm lấy ra cấp độ
function get_level($parent_id) {
    $level = 0;
    $data = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    foreach ($data as $item) {
        if ($item['cat_id'] == $parent_id) {
            $level = $item['level'] + 1;
        }
    }
    return $level;
}

//3. Hàm kiểm tra sự tồn tại của cat_title
function cat_title_exists($cat_title) {
    $check  = db_num_rows("SELECT * FROM `tbl_product_cat` WHERE `cat_title` = '{$cat_title}' OR `cat_title` LIKE '%{$cat_title}'");
    if ($check > 0)
        return true;
    return false;
}
//4. Lấy ra danh sách: danh mục sản phẩm
function get_list_cat_product() {
    $list_cat = db_fetch_array("SELECT * FROM `tbl_product_cat`");
    if (!empty($list_cat))
        return $list_cat;
    return false;
}

//5. Hàm lấy ra danh mục theo cat_id: id của danh mục
function get_cat_by_id($cat_id) {
    return db_fetch_row("SELECT * FROM `tbl_product_cat` WHERE `cat_id` = '{$cat_id}'");
}

//6. Xoá danh mục theo cat_id
function delete_cat_by_id($cat_id) {
    return db_delete('tbl_product_cat', "`cat_id` = '{$cat_id}'");
}

//7 Hàm lấy ra danh sách danh mục theo phân trang
function get_cat_pagging($start, $num_per_page, $where) {
    return db_fetch_array("SELECT * FROM `tbl_product_cat` {$where} LIMIT {$start}, {$num_per_page}");
}