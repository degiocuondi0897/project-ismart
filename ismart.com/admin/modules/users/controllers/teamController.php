<?php

function construct() {
    load_model('team');
}

function indexAction() {
    $total_row = count(get_list_user());
    $num_per_page = 4;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;

    $list_user = get_user_pagging($start, $num_per_page, $where = "");

    $data['list_user'] = $list_user;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;
    load_view('teamIndex', $data);
}

function adminAction() {
    $total_row = get_num_user_by_role(3);
    $num_per_page = 4;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;

    $list_user_admin = get_user_pagging($start, $num_per_page, $where = "`tbl_users`.`role` = 3");

    $data['list_user_admin'] = $list_user_admin;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;
    load_view('admin', $data);
}

function helperAction() {
    $total_row = get_num_user_by_role(2);
    $num_per_page = 4;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;

    $list_user_helper = get_user_pagging($start, $num_per_page, $where = "`role` = 2");

    $data['list_user_helper'] = $list_user_helper;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;
    load_view('helper', $data);
}

function trashAction() {
    $total_row = get_num_user_by_role(1);
    $num_per_page = 4;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;

    $list_user_trash = get_user_pagging($start, $num_per_page, $where = "`role` = 1");

    $data['list_user_trash'] = $list_user_trash;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;
    load_view('trash', $data);
}

function addAction() {
    global $error, $success, $display_name, $username, $email, $password, $tel, $address;
    if (isset($_POST['btn-submit'])) {
        //show_array($_POST);
        $error = array();
        //1. Kiểm tra tên hiển thị display_name
        if (empty($_POST['display_name'])) {
            $error['display_name'] = 'Tên hiển thị không được để trống';
        } else {
            $display_name = $_POST['display_name'];
        }
        //2. Kiểm tra tên đăng nhập: username
        if (empty($_POST['username'])) {
            $error['username'] = 'Username không được để trống';
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = 'Username chưa đúng định dạng';
            } else {
                $username = $_POST['username'];
            }
        }
        //3. Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = 'Email không được để trống';
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = 'Email chưa đúng định dạng';
            } else {
                $email = $_POST['email'];
            }
        }
        //4. Kiểm tra tên hiển thị role
        if (empty($_POST['role'])) {
            $error['role'] = 'Cần lựa chọn quyền cho tài khoản';
        } else {
            $role = $_POST['role'];
        }

        //5. Kiểm tra mật khẩu: password
        if (empty($_POST['password'])) {
            $error['password'] = 'Mật khẩu không được để trống';
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = 'Mật khẩu chưa đúng định dạng';
            } else {
                $password = md5($_POST['password']);
            }
        }

        #=========================================================
        #Nếu không tồn tại lỗi thì kiểm tra thêm 
        if (empty($error)) {
            if (!check_user_exists($username)) {
                $data = array(
                    'display_name' => $display_name,
                    'username' => $username,
                    'email' => $email,
                    'role' => $role,
                    'password' => $password,
                    'created_at' => time(),
                );
                db_insert('tbl_users', $data);
                $success['accout'] = "Thêm thành công tài khoản có tên đăng nhập là: {$username}";
            } else {
                $error['accout'] = "";
            }
        }
    }

    load_view('add');
}

function activeAction() {
    $active_token = $_GET['active_token'];
    if (check_active_token($active_token)) {
        $data = array(
            'is_active' => 1,
        );
        //cập nhập is_active kích hoạt tài khoản
        update_user_active($data, $active_token);
    }

    load_view('active_success');
}

function deleteAction() {
    $id = $_POST['id'];
    $role = $_POST['role'];
//    $item = get_product_by_id($id);
//    $role = $item['role'];

    if ($role != 1) {
        //Thực hiện đổi quyền cho role = 1(cho vào thùng rác)
        $data = array('role' => 1);
        change_role($data, $id);
    } else {
        delete_user_by_id($id);
    }
    $num_user_all = count(get_list_user());
    $num_user_admin = get_num_user_by_role(3);
    $num_user_helper = get_num_user_by_role(2);
    $num_user_trash = get_num_user_by_role(1);
    $data = array(
        'num_user_all' => $num_user_all,
        'num_user_admin' => $num_user_admin,
        'num_user_helper' => $num_user_helper,
        'num_user_trash' => $num_user_trash,
    );
    echo json_encode($data);
   
}

function editAction() {
//    $id = (int)$_POST['id'];
////    echo $id;
//    $user = get_user_by_id($id);
//    show_array($user);
    if (isset($_POST['sm_edit'])) {
        $display_name = $_POST['display_name'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $address = $_POST['address'];
        $data = array(
            'display_name' => $display_name,
            'email' => $email,
            'tel' => $tel,
            'address' => $address,
        );
        update_user($data, $email);
        redirect_to("?mod=users&controller=team&action=index");
    }
}
