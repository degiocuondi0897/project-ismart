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
            if (!exists_num_row_about()) {
                $flug = array(
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'created_at' => time(),
                    'created_by' => $user_login,
                );
                db_insert('tbl_about', $flug);
                $success['page'] = "Thêm thành công trang";
            } else {
                $flug = array(
                    'title' => $title,
                    'slug' => $slug,
                    'content' => $content,
                    'created_update' => time(),
                    'created_by' => $user_login,
                );
                db_update('tbl_about', $flug, "`title` = 'GIỚI THIỆU'");
                $success['page'] = "Cập nhập thành công trang";
            }
        } else {
            $success['page'] = "Cập nhập thất bại";
        }
    }
    $data_about = get_data_about();
    $data['data_about'] = $data_about;
    load_view('update', $data);
}
