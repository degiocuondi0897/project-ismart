<?php

function construct() {
    load_model('index');
}

function indexAction() {
    if (isset($_POST['sm_update_page'])) {
        global $error, $success, $title, $slug, $content;
        //1. Kiểm tra tiêu đề
        $title = $_POST['title'];
        
        //2. Kiểm tra link thân thiện
        $slug = $_POST['slug'];
        
        //3. Kiểm tra nội dung
        if (empty($_POST['content'])) {
            $error['content'] = "Nội dung trang không được trống";
        } else {
            $content = $_POST['content'];
        }
        //Nếu không có lỗi
        if (empty($error)) {
            $user_login = get_user_login();
            //Nếu chưa có bản ghi thì thêm vào, nếu có rồi thì cập nhập
            if (!exists_num_row_contact()) {
                $flug = array(
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'created_at' => time(),
                    'created_by' => $user_login,
                );
                db_insert('tbl_contact', $flug);
                $success['page'] = "Thêm thành công trang";
            } else {
                $flug = array(
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'created_update' => time(),
                    'created_by' => $user_login,
                );
                db_update('tbl_contact', $flug, "`title` = 'LIÊN HỆ'");
                $success['page'] = "Cập nhập thành công trang";
            }
        } else {
            $success['page'] = "Cập nhập thất bại";
        }
    }
    $data_contact = get_data_contact();
    $data['data_contact'] = $data_contact;
    load_view('update', $data);
}
