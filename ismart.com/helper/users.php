<?php
//1.Hàm kiểm tra đã login thành công 
function is_login() {
    if (isset($_SESSION['login']['is_login'])) {
        return true;
    }
    return false;
}


//2.Hàm get_info_user: lấy ra thông tin user để hiển thị
function get_info_user($label_field) {
    if (is_login()) {
        $list_user = db_fetch_array("SELECT * FROM `tbl_users`");
        if (isset($_SESSION['login']['is_login'])) {
            foreach ($list_user as $user) {
                if ($_SESSION['login']['user_login'] == $user['username']) {
                    if (array_key_exists($label_field, $user)) {
                        return $user[$label_field];
                    }
                }
            }
        }
        return false;
    }
}

