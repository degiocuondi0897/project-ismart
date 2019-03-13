<?php

function construct() {
    load_model('index');
}

function indexAction() {
    
}

function loginAction() {
    global $error, $username, $password;
    //show_array($_POST);
    if (isset($_POST['sm_login'])) {
        $error = array();
        //1. Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Username không được để trống";
        } else {
            $username = $_POST['username'];
        }
        //2. Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Password không được để trống";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Password chưa đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        //Nếu empty $error
        if (empty($error)) {
            if (check_login($username, $password)) {
                $info_user = info_user_login($username);
                //show_array($info_user);
                $_SESSION['login'] = array(
                    'is_login' => true,
                    'user_login' => $info_user['username'],
                    'user_id_login' => $info_user['user_id'],
                    'role' => $info_user['role'],
                );
                //Ghi nhớ mật khẩu 
                if (isset($_POST['remember_me'])) {
                    setcookie('is_login', true, time() + 3600);
                    setcookie('user_login', $info_user['username'], time() + 3600);
                    setcookie('user_id_login', $info_user['user_id'], time() + 3600);
                    setcookie('role', $info_user['role'], time() + 3600);
                }
                //echo "Đăng nhập thành công";
                redirect_to("?mod=users&controller=team&action=index");
                //show_array($_SESSION['login']);
            } else {
                $error['login'] = "Tài khoản không tồn tại trên hệ thống!";
                echo "Thất bại";
            }
        }
    }
    load_view('login');
}

function logoutAction() {
    $info_user = info_user_login($username);
    if (is_login()) {
        setcookie('is_login', true, time() - 3600);
        setcookie('user_login', $info_user['username'], time() - 3600);
        setcookie('user_id_login', $info_user['user_id_login'], time() - 3600);
        setcookie('role', $info_user['role'], time() - 3600);
        unset($_SESSION['login']);
        redirect_to('?mod=users&action=login');
    }
}

function resetAction() {
    global $error, $success;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();
        //1. Kiểm tra mật khẩu cũ
        if (empty($_POST['old-pass'])) {
            $error['old-pass'] = "Cần điền thông tin mật khẩu cũ của bạn";
        } else {
            if (!check_pass(md5($_POST['old-pass']))) {
                $error['old-pass'] = "Mật khẩu cũ của bạn không chính xác";
            }
        }
        //2. Kiểm tra mật khẩu mới 
        if (empty($_POST['new-pass'])) {
            $error['new-pass'] = "Cần điền thông tin cho mật khẩu mới";
        } else {
            if (!is_password($_POST['new-pass'])) {
                $error['new-pass'] = "Mật khẩu mới chưa đúng định dạng";
            } else {
                $new_pass = md5($_POST['new-pass']);
            }
        }
        //3.Xác nhân mật khẩu
        if (empty($_POST['confirm-pass'])) {
            $error['confirm-pass'] = "Cần xác nhận lại mật khẩu mới";
        } else {
            if (md5($_POST['confirm-pass']) != md5($_POST['new-pass'])) {
                $error['confirm-pass'] = "Mật khẩu xác nhận chưa chính xác";
            }
        }
        //4. Nếu không có lỗi
        if (empty($error)) {
            $data = array(
                'password' => $new_pass,
            );
            $user_id = get_user_id_login();
            update_pass($data, $user_id);
            $success['accout'] = "Bạn đã thay đổi mật khẩu thành công!";
        }
    }
    load_view('reset');
}

function updateAction() {
    //show_array($_SESSION['login']);
    global $error, $success, $display_name, $tel, $address, $info_user;
    //Xử lý cập nhập 
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();
        //1. Kiểm tra tên hiển thị
        if (empty($_POST['display_name'])) {
            $error['display_name'] = "Tên hiển thị không để trống";
        } else {
            $display_name = $_POST['display_name'];
        }

        //2 Kiểm tra số điện thoại
        if (empty($_POST['tel'])) {
            $error['tel'] = "Số điện thoại không để trống";
        } else {
            $tel = $_POST['tel'];
        }
        //3. Kiểm tra địa chỉ
        if (empty($_POST['address'])) {
            $error['address'] = "Địa chỉ không để trống";
        } else {
            $address = $_POST['address'];
        }
        //Nếu không có lỗi
        if (empty($error)) {
            $email = $_POST['email'];
            $data = array(
                'display_name' => $display_name,
                'tel' => $tel,
                'address' => $address,
                'created_at_update' => time(),
            );
            update_user_login(get_user_login(), $data);
            $success['accout'] = "Cập nhập tài khoản thành công!";
        }
    }
    //Hiển thị thông tin trên value form
    $user_id = get_user_id_login();
    $info_user = get_user_by_id($user_id);
    $data['info_user'] = $info_user;
    //show_array($info_user);
    load_view('update', $data);
}
