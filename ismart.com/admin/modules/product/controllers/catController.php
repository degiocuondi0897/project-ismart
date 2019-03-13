<?php

function construct() {
    load_model('cat');
}

function add_catAction() {
    global $error, $success, $cat_title, $slug;
    if (isset($_POST['sm_add_cat'])) {
        $error = array();
        //1. Kiểm tra cat_title
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Tên danh mục không được trống";
        } else {
            if (cat_title_exists($_POST['cat_title'])) {
                $error['cat_title'] = "Tên danh mục đã tồn tại trên hệ thống";
            } else {
                $cat_title = $_POST['cat_title'];
            }
        }
        //.2 slug
        $slug = $_POST['slug'];
        //3. Kiển parent_id
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        //4. Xử lý trạng thái
        $role = get_role_login();
        $user_login = get_user_login();
        if ($role == 1) {
            $status = 2;
        } else {
            $status = 1;
        }

        //Nếu ko có lỗi
        if (empty($error)) {
            $level = get_level($parent_id);
            $data = array(
                'cat_title' => $cat_title,
                'slug' => $slug,
                'status' => $status,
                'created_at' => time(),
                'created_by' => $user_login,
                'parent_id' => $parent_id,
                'level' => $level,
            );
            add_product_cat($data);
        }
    }
    load_view('add_cat');
}

function catAction() {
    //Danh sách: danh mục - theo cấp độ
    $item = multi_data_cat(get_list_cat_product());
    //Chuyển về danh sách theo phân trang
    $total_row = count($item);
    $num_per_page = 6;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;

    $list_cat = get_cat_pagging($start, $num_per_page, $where = "");
    
    $data['list_cat'] = $list_cat;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    load_view('cat', $data);
}

function deleteAction() {
    $id = $_GET['id'];
    //$item_cat = get_cat_by_id($id);
    delete_cat_by_id($id);
    redirect_to("?mod=product&controller=cat&action=cat");

}
