<?php


//1.Hàm kiểm tra nội dung đăng nhập đã đúng với CSDL: check_login
function check_login($username, $password) {
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if ($check > 0)
        return true;
    return false;
}

//2.Lấy ra thông tin người dùng khi đăng nhập
function info_user_login($username) {
    $user = db_fetch_row("SELECT * FROM `tbl_users` WHERE `username` = '{$username}'");
    if (!empty($user))
    return $user;
}

//Hàm cập nhập thông tin người login 
function update_user_login($username, $data) {
    return db_update('tbl_users', $data, "`username` = '$username'");
}


//4. Hàm kiểm tra mật khẩu cũ khi thực hiện đổi mật khẩu
function check_pass($pass) {
    $user_id = get_user_id_login();
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `user_id` = '{$user_id}' AND `password` = '{$pass}'");
    if ($check > 0)
        return true;
    return false;
}

//5 Hàm cập nhập mật khẩu
function update_pass($data, $user_id) {
     return db_update('tbl_users', $data, "`user_id` = {$user_id}");
}




