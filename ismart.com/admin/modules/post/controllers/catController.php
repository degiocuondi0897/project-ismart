<?php

function construct() {
    load_model('cat');
}

function indexAction() {
    $total_row = count(get_list_post_cat());
    $num_per_page = 6;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    //$list_post_cat = multi_data_cat($item);
    $list_post_cat = get_post_cat_pagging($start, $num_per_page, $where = "");
    //show_array(multi_data_cat($list_post_cat));
    //Trả dữ liệu sang view
    $data['list_post_cat'] = $list_post_cat;
    $data['start'] = $start;
    $data['num_page'] = $num_page;
    $data['page'] = $page;

    //show_array($list_post_cat);

    load_view('cat', $data);
}

function addAction() {
    global $error, $success, $cat_title, $slug, $parent_id;
    if (isset($_POST['sm_add_cat_post'])) {
        $error = array();
        //1 Kiểm tra cat_title
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Tên danh mục không được trống";
        } else {
            if (exists_cat_title($_POST['cat_title'])) {
                $error['cat_title'] = "Tên danh mục đã có trong hệ thống";
            } else {
                $cat_title = $_POST['cat_title'];
            }
        }
        //2. Kiểm tra slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Link thân thiện không được trống";
        } else {
            $slug = $_POST['slug'];
        }
        //3. Kiểm tra danh mục cha
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        //Không có lỗi
        if (empty($error)) {
            $created_by = get_user_login();
            $level = get_level_cat($parent_id);
            $data = array(
                'cat_title' => $cat_title,
                'slug' => $slug,
                'parent_id' => $parent_id,
                'level' => $level,
                'created_by' => $created_by,
                'created_at' => time(),
            );
            $list_cat = get_list_post_cat();
            //show_array($list_cat);
            add_post_cat($data);
            $success['cat'] = "Thêm danh mục thành công";
        } else {
            $error['cat'] = "Thêm thất bại";
        }
    }

    $list_post_cat = multi_data_cat(get_list_post_cat());
    $data['list_post_cat'] = $list_post_cat;
    //show_array($list_cat);
    load_view('addCat', $data);
}

function deleteAction() {
    $id = $_POST['id'];
    delete_post_cat_by_id($id);
}

function editAction() {
    $id = $_GET['id'];
    global $error, $success, $cat_title, $slug, $parent_id;
    if (isset($_POST['sm_edit_cat_post'])) {
        $error = array();
        //1 Kiểm tra cat_title
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "Tên danh mục không được trống";
        } else {
            $cat_title = $_POST['cat_title'];
        }
        //2. Kiểm tra slug
        if (empty($_POST['slug'])) {
            $error['slug'] = "Link thân thiện không được trống";
        } else {
            $slug = $_POST['slug'];
        }
        //3. Kiểm tra danh mục cha
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        //Không có lỗi
        if (empty($error)) {
            $created_by = get_user_login();
            $level = get_level_cat($parent_id);
            $cat = array(
                'cat_title' => $cat_title,
                'slug' => $slug,
                'parent_id' => $parent_id,
                'level' => $level,
                'created_by' => $created_by,
                'created_at' => time(),
            );
            db_update('tbl_post_cat', $cat, "`cat_id` = {$id}");
        }
    }

    $post = get_post_by_id($id);
    $data['post'] = $post;
    load_view('editCat', $data);
}
