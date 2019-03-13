<?php

//1.Hàm kiểm tra đã login thành công 
function is_login() {
    if (isset($_SESSION['login']['is_login'])) {
        return true;
    }
    return false;
}

//2.Hàm kiểm tra tài khoản đã tồn tại trên hệ thống qua : $display_name, $email
function check_user_exists($username) {
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    if ($check > 0)
        return true;
    return false;
}

//3.Lấy ra user_login của người đăng nhập để hiển thị
function get_user_login() {
    if (isset($_SESSION['login']))
        return $_SESSION['login']['user_login'];
}

//4. Lấy là user_id_login của người đăng nhập 
function get_user_id_login() {
    if (isset($_SESSION['login']))
        return $_SESSION['login']['user_id_login'];
}

//5. lấy ra thông tin về quyền của người đăng nhập(1,2,3)
function get_role_login() {
    if (isset($_SESSION['login']))
        return $_SESSION['login']['role'];
}

//6. Hàm lấy ra toàn bộ thông tin của người đăng nhập trong hệ thống
function get_user_by_id($user_id) {
    return db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = '{$user_id}'");
}

//7. Xoá tài khoản user theo id
function delete_user($user_id) {
    return db_delete('tbl_users', "`user_id` = '{$user_id}'");
}

//8. Cập nhập tài khoản theo id
function update_user($data, $email) {
    return db_update('tbl_users', $data, "`email` = '{$email}'");
}
