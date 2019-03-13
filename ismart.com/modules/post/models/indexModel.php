<?php
//1. Hàm lấy ra tất cả các bài viết
function get_list_post() {
    return db_fetch_array("SELECT * FROM `tbl_post` WHERE `status` = 3");
}

//2.Các hàm xử lý phân trang bài viết
//-------- Hàm lấy ra tổng số bài viết đã đăng
function get_num_all_post() {
    return db_num_rows("SELECT * FROM `tbl_post` WHERE `status` = 3");
}
//Hàm lấy ra danh sách bài viết theo phân trang 
function get_list_post_pagging($start, $num_per_page, $where) {
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    return db_fetch_array("SELECT * FROM `tbl_post` {$where} LIMIT {$start}, {$num_per_page}");
}


