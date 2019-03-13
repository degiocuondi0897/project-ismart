<?php

//Hàm kiểm tra định dạng username
function is_username($username) {
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (preg_match($partten, $username, $matchs))
        return true;
    return false;
}

//hàm kiểm tra định dạng tel
//function is_tel($tel) {
//    $partten = "/^([0-9]){10, 12}$/";
//    if (preg_match($partten, $tel, $matchs))
//        return true;
//    return false;
//}
//hàm kiểm tra định dạng số mật khẩu
function is_password($password) {
    $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if (preg_match($partten, $password, $matchs))
        return true;
    return false;
}

//Hàm kiểm tra định dạng email
function is_email($email) {
    $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (preg_match($partten, $email, $matchs))
        return true;
    return false;
}

//function is_email($email) {
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//        return true;
//    }
//    return false;
//}

//Hàm show lỗi form validation 
function form_error($label_field) {
    global $error, $flug;
    if (isset($error[$label_field])) {
        return "<p style='color:red; font-size: 13px;'>{$error[$label_field]}</p>";
    }
}
//Hàm show lỗi form validation 
function form_success($label_field) {
    global $success;
    if (isset($success[$label_field])) {
        return "<p style='color:#3498db; font-size: 15px;'>{$success[$label_field]}</p><br>";
    }
}

//Hàm in ra giá trị form khi đã đúng định dạng
function set_value($label_field) {
    global $$label_field;
    if (isset($$label_field)) {
        return $$label_field;
    }
}
