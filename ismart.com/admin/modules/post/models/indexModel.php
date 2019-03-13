<?php
//1. Danh sách: list_cat
function get_list_post_cat() {
    return db_fetch_array("SELECT * FROM `tbl_post_cat`");
}
//2. Kiểm tra tồn tại post_title
function exists_post_title($post_title) {
    $check = db_num_rows("SELECT * FROM `tbl_post` WHERE `post_title` = '{$post_title}'");
    if ($check > 0)
        return true;
    return false;
}
//3. Thêm bài viết
function add_post($data) {
    return db_insert('tbl_post', $data);
}
//4. Lấy ra danh sách bài viết
function get_list_post() {
    return db_fetch_array("SELECT * FROM `tbl_post`");
}
//5. Lấy ra sách bài viết theo phân trang
function get_list_post_pagging($start, $num_per_page, $where) {
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    return db_fetch_array("SELECT * FROM `tbl_post` {$where} LIMIT {$start}, $num_per_page");
}
//Hàm lấy ra tên danh mục theo cat_id
function get_cat_title_by_id($cat_id) {
    $cat_title = "";
    $list_cat = db_fetch_array("SELECT * FROM `tbl_post_cat`");
    foreach ($list_cat as $item) {
        if ($item['cat_id'] == $cat_id) {
            $cat_title = $item['cat_title'];
        }
    }
    return $cat_title;
}

//7. Hàm lấy ra bài viết theo id
function get_post_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id` = {$id}");
}

//8. Hàm thay đổi giá trị status khi thực hiện xoá
function change_status($data, $id) {
    return db_update('tbl_post', $data, "`post_id` = {$id}");
}

//9. Xoá post theo id
function delete_post($id) {
    return db_delete('tbl_post', "`post_id` = {$id}");
}
//10. Lấy ra số lượng post theo trang thái status
function get_num_post_by_status($status) {
    return db_num_rows("SELECT * FROM `tbl_post` WHERE `status` = {$status}");
}
//11. Lấy ra tổng số : post trong tbl_post
function get_num_post_all() {
    return db_num_rows("SELECT * FROM `tbl_post`");
}