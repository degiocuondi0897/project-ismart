<?php

//1. Hàm lấy ra tất cả số lượng page 
function get_num_all_page() {
    return db_num_rows("SELECT * FROM `tbl_pages`");
}

//2. Hàm lấy ra số lượng page theo status
function get_num_page_by_status($status) {
    return db_num_rows("SELECT * FROM `tbl_pages` WHERE `status` = {$status}");
}
