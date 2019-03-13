<?php

//1. Hàm kiểm tra cat_title đã tồn tại
function exists_cat_title($cat_title) {
    $check = db_num_rows("SELECT * FROM `tbl_post_cat` WHERE `cat_title` = '{$cat_title}'");
    if ($check > 0)
        return true;
    return false;
}

//2. Hàm thêm danh mục post
function add_post_cat($data) {
    return db_insert('tbl_post_cat', $data);
}

//3. Danh sách: list_cat
function get_list_post_cat() {
    return db_fetch_array("SELECT * FROM `tbl_post_cat`");
}

//4. Hàm lấy ra cấp độ level theo id danh mục cha
function get_level_cat($parent_id) {
    $list_cat = get_list_post_cat();
    $level = 0;
    foreach ($list_cat as $item) {
        if ($item['cat_id'] == $parent_id) {
            $level = $item['level'] + 1;
        }
    }
    return $level;
}

//5. Hàm lấy ra list_post_cat theo phân trang
function get_post_cat_pagging($start, $num_per_page, $where) {
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_post_cat` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

//6. Xoá danh mục post theo id
function delete_post_cat_by_id($id) {
    return db_delete('tbl_post_cat', "`cat_id` = {$id}");
}

//7. Lấy ra thông tin của 1 danh mục theo id
function get_post_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_post_cat` WHERE `cat_id` = {$id}");
}

