<?php
//1. Hàm lấy ra chi tiết bài viết theo id
function get_post_by_id($id) {
    return db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id` = {$id}");
}
