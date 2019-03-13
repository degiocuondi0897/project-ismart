<?php

function construct() {
    load_model('index');
}

function indexAction() {
    $list_post = get_list_post();
    $total_row = count(get_list_post());
    $num_per_page = 6;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;

    $list_post = get_list_post_pagging($start, $num_per_page, $where = "");
    //show_array($list_post);
    $data['list_post'] = $list_post;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    $data['start'] = $start;
    load_view('index', $data);
}

;

//Upload ảnh
function uploadAction() {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $error = array();
        $upload_dir = 'public/uploads/post/';
        $fileUpload = $upload_dir . basename($_FILES['file']['name']);
        //Chuẩn hoá dữ liệu file
        //----1. Kiểm tra định dạng file
        $file_allow = array('png', 'jpeg', 'gif', 'jpg');
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($type), $file_allow)) {
            $error['file'] = "Chỉ upload file ảnh có định dạng: png, jpg, gif hoặc jpeg";
        } else {
            //----2: Kiểm tra 
            $file_size = $_FILES['file']['size'];
            if ($file_size > 29000000) {
                $error['file'] = "Kích thước ảnh vượt quá 20MB";
            } elseif (file_exists($fileUpload)) {
                $error['file'] = "File có tên và đường dẫn đã tồn tại trên hệ thống";
            }
        }
        //Nếu không có lỗi
        if (empty($error)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $fileUpload)) {
                $flug = true;
                echo json_encode(array('success' => 'add_ok', 'fileUpload' => $fileUpload,));
            }
        } else {
            echo json_encode(array('status' => $error['file']));
        }
    }
}

function addAction() {
    global $error, $success, $post_title, $slug, $post_desc, $post_content, $cat_id, $status, $thumbnail_url;
    if (isset($_POST['sm_add_post'])) {
        //show_array($_POST);
        $error = array();
        $success = array();
        //1.Kiểm tra tiêu đề
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Tiêu đề bài viết không được trống";
        } else {
            if (exists_post_title($_POST['post_title'])) {
                $error['post_title'] = "Tiêu đề đã bị trùng trên hệ thống";
            } else {
                $post_title = $_POST['post_title'];
            }
        }
        //2. Kiểm tra link thân thiện
        if (empty($_POST['slug'])) {
            $error['slug'] = "Link thân thiện không được trống";
        } else {
            $slug = $_POST['slug'];
        }
        //3. Kiểm tra post_desc
        if (empty($_POST['post_desc'])) {
            $error['post_desc'] = "Mô tả bài viết không được không được trống";
        } else {
            $post_desc = $_POST['post_desc'];
        }
        //3. Kiểm tra post_desc
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "Chi tiết bài viết không được trống";
        } else {
            $post_content = $_POST['post_content'];
        }

        //4. Kiểm tra ảnh 
        if (empty($_POST['thumbnail_url'])) {
            $error['thumbnail_url'] = "Cần lựa chọn ảnh để upload";
        } else {
            $thumbnail_url = $_POST['thumbnail_url'];
        }

        //5. Chonh danh mục cho bài viết
        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "Lựa chọn danh mục cho bài viết";
        } else {
            $cat_id = $_POST['cat_id'];
        }
        //6. Kiểm tra trạng thái
        if (empty($_POST['status'])) {
            $error['status'] = "Chọn trạng thái cho bài viết";
        } else {
            $status = $_POST['status'];
        }
        //Nếu không có lỗi
        if (empty($error)) {
            //---Thực hiện add post
            $data = array(
                'post_title' => $post_title,
                'slug' => $slug,
                'post_desc' => $post_desc,
                'post_content' => $post_content,
                'post_thumb' => $thumbnail_url,
                'cat_id' => $cat_id,
                'status' => $status,
                'created_at' => time(),
                'created_by' => get_user_login(),
            );
            //show_array($data);
            add_post($data);
            $success['add_post'] = "Thêm bài viết thành công";
        } else {
            if (isset($thumbnail_url)) {
                unlink($thumbnail_url);
            }
            $success['add_post'] = "Thêm bài viết thất bại";
        }
    }
    load_view('add');
}

//Xoá post
function deleteAction() {
    $id = $_POST['id'];
    $item = get_post_by_id($id);
    $status = $item['status'];
    $thumbnail_url = $item['post_thumb'];
    if ($status != 1) {
        //Thay đổi status để đưa vào thùng rác
        $data = array('status' => 1);
        change_status($data, $id);
    } else {
        //Xoá luôn post
        delete_post($id);
        unlink($thumbnail_url);
    }
    $result = array(
        'num_post_all' => get_num_post_all(),
        'num_post_public' => get_num_post_by_status(3),
        'num_post_pending' => get_num_post_by_status(2),
        'num_post_trash' => get_num_post_by_status(1),
    );
    echo json_encode($result);
}

function editAction() {

    global $error, $success;
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $error = array();
        $success = array();
        //1.Kiểm tra tiêu đề
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "Tiêu đề bài viết không được trống";
        } else {
            $post_title = $_POST['post_title'];
        }
        //2. Kiểm tra link thân thiện
        if (empty($_POST['slug'])) {
            $error['slug'] = "Link thân thiện không được trống";
        } else {
            $slug = $_POST['slug'];
        }
        //3. Kiểm tra post_desc
        if (empty($_POST['post_desc'])) {
            $error['post_desc'] = "Mô tả trang không được không được trống";
        } else {
            $post_desc = $_POST['post_desc'];
        }
        //4. Kiểm tra ảnh 
        if (empty($_POST['file'])) {
            $file = get_post_by_id($id)['post_thumb'];
        }
        if (!empty($_FILES['file'])) {
            $file = "public/uploads/post/{$_FILES['file']['name']}";
        }
        //5. Chonh danh mục cho bài viết
        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "Lựa chọn danh mục cho bài viết";
        } else {
            $cat_id = $_POST['cat_id'];
        }
        //6. Kiểm tra trạng thái
        if (empty($_POST['status'])) {
            $error['status'] = "Chọn trạng thái cho bài viết";
        } else {
            $status = $_POST['status'];
        }
        //Nếu không có lỗi
        if (empty($error)) {
            $data = array(
                'post_title' => $post_title,
                'slug' => $slug,
                'post_desc' => $post_desc,
                'post_thumb' => $file,
                'cat_id' => $cat_id,
                'status' => $status,
                'created_at' => time(),
                'created_by' => get_user_login(),
            );
            show_array($_FILES);
        }
    }
    $item = get_post_by_id($id);
    $data['item'] = $item;
    load_view('edit', $data);
}
