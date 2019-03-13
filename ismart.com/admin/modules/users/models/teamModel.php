<?php

//1. Hàm kiểm tra:mã active_token trên email xác nhận với mã trên CSDL
function check_active_token($active_token) {
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}'");
    if ($check > 0)
        return true;
    return false;
}

//2. Hàm cập nhập is_active để kích hoạt tài khoản
function update_user_active($data, $active_token) {
    return db_update('tbl_users', $data, "`active_token` = '{$active_token}'");
}

//3. Hàm lấy ra danh sách user
function get_list_user() {
    return db_fetch_array("SELECT * FROM `tbl_users`");
}

//4. Hàm lấy ra danh sách user theo role(role = 1: admin, role = 2: Công tác viên);
function get_num_user_by_role($role) {
    return db_num_rows("SELECT * FROM `tbl_users` WHERE `role` = {$role}");
}

//4.Hàm kiểm tra thông tin search 
function check_search($search) {
    $sql = "SELECT * FROM `tbl_users` WHERE `display_name` LIKE '%{$search}%' OR `username` LIKE '%{$search}%' OR `email` LIKE '%{$search}%'";
    $check = db_num_rows($sql);
    if ($check > 0)
        return true;
    return false;
}

//5. Hàm tìm kiếm thông tin theo username, display_name, email
function get_result_search($search) {
    $result = array();
    $sql = "SELECT * FROM `tbl_users` WHERE `display_name` LIKE '%{$search}%' OR `username` LIKE '%{$search}%' OR `email` LIKE '%{$search}%'";
    $row = db_num_rows($sql);
    if ($row > 0) {
        $result = db_fetch_array($sql);
    }

    //show_array($result);
    return $result;
}

//6. Hàm thay đổi quyền: rule = 0 khi thực hiện xoá
function change_role($data, $user_id) {
    db_update('tbl_users', $data, "`tbl_users`.`user_id` = {$user_id}");
}
//7 Hàm xoá user theo id
function delete_user_by_id($user_id) {
    db_delete('tbl_users', "`user_id` = {$user_id}");
}

//8. Hàm lấy ra danh sách user phân trang
function get_user_pagging($start = 1, $num_per_page = 1, $where = "") {
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_users` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

