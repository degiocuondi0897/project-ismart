<?php

function construct() {
    load_model('index');

    //echo "Dùng chung, hiển thị đầu tiên";
}

function indexAction() {
    
}

//Xử lí form register
function regAction() {
    global $error, $fullname, $username, $email, $password;
    if (isset($_POST['sm_register'])) {
        $error = array();
        //1. Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Họ và tên không được để trống";
        } else {
            $fullname = $_POST['fullname'];
        }

        //2. Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Tên đăng nhập không được để trống";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập chưa đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }

        //3. Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Email không được để trống";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email chưa đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }

        //4. Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Password không được để trống";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Password chưa đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }

        //5. Nếu không có lỗi thì kiểm tra sự tồn tại tài khoản trong hệ thống
        if (empty($error)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password,
                    'active_token' => $active_token,
                );
                add_user($data);
                $link_active = base_url("?mod=users&controller=index&action=active&active_token={$active_token}");
                $content = "<p>Chào bạn: {$username}</p>"
                        . "<p>Bạn vừa đăng kí tài khoản trên hệ thống, vui lòng click vào đường dẫn để xác thực tài khoản <strong>Link: {$link_active}</strong></p>"
                        . "<p>Nếu bạn không phải người đăng kí tài khoản thì hãy bỏ qua email này.</p>";
                send_mail($email, $fullname, 'Kích hoạt tài khoản đăng kí thành viên', $content);
                redirect_to("?mod=users&controller=index&action=success_reg");
            } else {
                $error['accout'] = "Username hoặc Email của bạn đã tồn tại trong hệ thống";
            }
        }
    }
    load_view('reg');
}

function success_regAction() {
    load_view('success_reg');
}

function activeAction() {
    $active_token = $_GET['active_token'];
    if (check_active_token($active_token)) {
        active_user($active_token);
        $link_login = base_url("?mod=users&action=login");
        echo "<p>Bạn đã kích hoạt thành công tài khoản<p><p>Vui lòng click vào đây để đăng nhập: <a href='{$link_login}'>Đăng nhập</a></p>";
    } else {
        $link_login = base_url("?mod=users&action=login");
        echo "Yêu cầu kích hoạt tài khoản không hợp lệ hoặc tài khoản đã được kích hoạt trước đó!<p>Vui lòng click vào đây để đăng nhập: <a href='{$link_login}'>Đăng nhập</a></p>";
    }
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
            if (!is_username($_POST['username'])) {
                $error['username'] = "Username chưa đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
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
                $check_login = check_login($username, $password);
                $user_login = $username;
                $_SESSION['login'] = array(
                    'is_login' => true,
                    'user_login' => $user_login,
                    'user_id_login' => $check_login,
                );
                //Ghi nhớ mật khẩu 
                if (isset($_POST['remember_me'])) {
                    setcookie('is_login', true, time() + 3600);
                    setcookie('user_login', $username, time() + 3600);
                    setcookie('user_id_login', $check_login, time() + 3600);
                }
                echo "Đăng nhập thành công";
                redirect_to("?mod=home&controller=index&action=index");
                //show_array($_SESSION['login']);
            } else {
                $error['login'] = "Tài khoản không tồn tại trên hệ thống hoặc chưa được kích hoạt!";
            }
        }
    }
    load_view('login');
}

function logoutAction() {
    if (is_login) {
        setcookie('is_login', true, time() - 3600);
        setcookie('user_login', $username, time() - 3600);
        setcookie('user_id_login', $check_login, time() - 3600);
        unset($_SESSION['login']);
        //redirect('?mod=users&action=login');
    }
}

function lost_passAction() {
    global $error, $email, $success;
    if (isset($_POST['sm_reset'])) {
        $error = array();
        $success = array();
        //Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "Email không được để trống";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email chưa đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        //Nếu không có lỗi
        if (empty($error)) {
            if (check_email($email)) {
                $reset_pass_token = md5($email . time());
                $data = array('reset_pass_token' => $reset_pass_token,);
                //Thêm vào CSDL reset_pass_token
                db_update('tbl_users', $data, "`email` = '{$email}'");
                $link_change = base_url("?mod=users&action=change_pass&reset_pass_token={$reset_pass_token}");
                $content = "<h1 style='color: blue'>Đổi mật khẩu tài khoản</h1>
                <p>Chào bạn, chúng tôi vừa nhận được yêu cầu đổi mật khẩu từ bạn</p>
                <p>Vui lòng click vào đây để thực hiện đổi mật khẩu <strong>Link: </strong><a href='{$link_change}'>Đổi mật khẩu</a></p>
                <p>Nếu bạn không phải người gửi yêu cầu, xin vui lòng bỏ qua email này!</p>";
                send_mail($email, '', "Yêu cầu khôi phục mật khẩu", $content);
                $success['email'] = "Yêu cầu đổi mật khẩu đã được gửi đi, vui lòng vào email của bạn để kiểm tra và xác nhận!";
            } else {
                $error['accout'] = "Email của bạn không tồn tại trên hệ thống";
            }
        }
    }
    load_view('reset');
}

function change_passAction() {
    global $error, $password, $success;
    if (isset($_POST['sm_change'])) {
         $error = array();
        $success = array();
        // Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Password không được để trống";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Password chưa đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        //Nếu không có lỗi thực hiện đổi mật khẩu
        if (empty($error)) {
            $reset_pass_token = $_GET['reset_pass_token'];
            if (check_reset_pass_token($reset_pass_token)) {
                $data = array(
                    'password' => $password,
                );
                change_pass_new($data, $reset_pass_token);
                $success['password'] = "Mật khẩu đã được đổi thành công";
            } else {
                echo "Yêu cầu đổi mật khẩu không hợp lệ";
            }
        }
    }

    load_view('change');
}
