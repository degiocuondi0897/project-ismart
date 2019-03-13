<?php

//Hàm làm việc với database
//1. Hàm kiểm tra sự tồn tại của tài khoản trên hệ thống
function user_exists($username, $email) {
    $result = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '$username' OR `email` = '$email'");
    if ($result > 0)
        return true;
    return false;
}

//3. Hàm lấy ra user theo id
function get_user_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

//4. add user
function add_user($data) {
    return db_insert('tbl_users', $data);
}

//5 check thông tin login 
function check_login($username, $password) {
    $result = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '$username' AND `password` = '$password' AND `is_active` = '1'");
    if ($result > 0)
        return true;
    return false;
}

//6. Active tài khoản cho is_active = 1;
function active_user($active_token) {
    return db_update('tbl_users', array('is_active' => 1), "`active_token` = '{$active_token}'");
}

//7. Hàm kiểm tra mã kích hoạt 
function check_active_token($active_token) {
    $result = db_fetch_row("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}' AND `is_active` = '0'");
    if ($result > 0)
        return true;
    return false;
}

//8 hàm kiểm tra email có tồn tại trên hệ thống ?
function check_email($email) {
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}' ");
    if ($check > 0)
        return true;
    return false;
}

//9. Hàm đổi mật khẩu mới sau khi gửi yêu cầu 
function change_pass_new($data, $reset_pass_token) {
    return db_update('tbl_users', $data, "`reset_pass_token` = '{$reset_pass_token}'");
}

//10. Hàm kiểm tra mã reset_pass_token có tồn tại trên hệ thống hay ko 
function check_reset_pass_token($reset_pass_token) {
    $result = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset_pass_token` = '{$reset_pass_token}'");
    if ($result > 0)
        return true;
    return false;
}