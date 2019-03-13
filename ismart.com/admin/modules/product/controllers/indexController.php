<?php

function construct() {
    load_model('index');
}

function indexAction() {
//    echo 1; die;
    if (isset_sm_search_product()) {
        if (!empty($_POST['search_product'])) {
            $search_product = $_POST['search_product'];
            $list_product = get_list_search_product($search_product);
            $total_row = count($list_product);
        }
    } else {
        $total_row = count(get_list_product());
    }

    $num_per_page = 8;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;


    $list_product = get_product_pagging($start, $num_per_page, $where = "");
    //show_array($list_product);
    $data['list_product'] = $list_product;
    $data['start'] = $start;
    $data['num_page'] = $num_page;
    $data['page'] = $page;

    load_view('index', $data);
}

function uploadAction() {
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $error = array();
        $upload_dir = "public/uploads/product/";
        $upload_file = $upload_dir . basename($_FILES['file']['name']);
        //Chuẩn hoá dữ liệu upload==================================>
        //6.1.File upload chỉ có các định dạng: png, jpg, gift, jpeg.
        $type_allow = array('png', 'jpg', 'gif', 'jpeg');
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($type), $type_allow)) {
            $error['file'] = "Chỉ upload file có định dạng: png, jpg, gif và jpeg";
        } else {
            //6.2 Kiểm tra kích thước file
            $file_size = $_FILES['file']['size'];
            if ($file_size > 29000000) {
                $error['file'] = "Kích thước file ảnh không vượt quá 20MB";
            } elseif (file_exists($upload_file)) {
                $error['file'] = "File đã tồn tại trên hệ thống";
            }
        }
        //Nếu không có lỗi
        if (empty($error)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                echo json_encode(array('success' => 'ok', 'file_path' => $upload_file));
            }
        } else {
            echo json_encode(array('status' => $error['file']));
        }
    }
}

function addAction() {
    global $error, $success, $product_title, $product_code, $product_price, $product_desc, $product_content, $status, $thumbnail_url, $high_light;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $error = array();
        //1.Kiểm tra product_title
        if (empty($_POST['product_title'])) {
            $error['product_title'] = "Tên sản phẩm không được để trống";
        } else {
            if (product_title_exists($_POST['product_title'])) {
                $error['product_title'] = "Tên sản phẩm đã đã tồn tại trên hệ thống";
            } else {
                $product_title = $_POST['product_title'];
            }
        }

        //3. Kiểm tra giá sản phẩm
        if (empty($_POST['product_price'])) {
            $error['product_price'] = "Giá của sản phẩm không được để trống";
        } else {
            $product_price = $_POST['product_price'];
        }
        //4. kiểm tra product_desc
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Cần có một mô tả ngắn cho sản phẩm này";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        //5. Kiểm tra chi product_content
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "Chi tiết sản phẩm không được để trống";
        } else {
            $product_content = $_POST['product_content'];
        }
        //6 Kiểm tra upload ảnh
        if (empty($_POST['thumbnail_url'])) {
            $error['thumbnail_url'] = "Cần chọn ảnh upload cho sản phẩm";
        } else {
            $thumbnail_url = $_POST['thumbnail_url'];
        }
        //Kiểm tra chọn nổi bật sản phẩm hoặc bình thường
        if (empty($_POST['high_light'])) {
            $error['high_light'] = "Sản phẩm cần được chọn có nổi bật hoặc bình thường";
        } else {
            $high_light = $_POST['high_light'];
        }

        //7. Kiểm tra trạng thái
        if (empty($_POST['status'])) {
            $error['status'] = "Lựa chọn trạng thái cho sản phẩm";
        } else {
            $status = $_POST['status'];
        }
        //8. Lựa chọn danh mục cha
        if (empty($_POST['cat_id'])) {
            $error['cat_id'] = "Lựa chọn danh mục cho sản phẩm";
        } else {
            $cat_id = $_POST['cat_id'];
        }
        //Nếu ko có lỗi
        if (empty($error)) {
            //Tạo mã sản phẩm tự sinh
            $product_code = "MSP" . mt_rand();
            $info = array(
                'product_title' => $product_title,
                'product_code' => $product_code,
                'product_price' => $product_price,
                'product_desc' => $product_desc,
                'product_content' => $product_content,
                'product_thumb' => $_POST['thumbnail_url'],
                'high_light' => $high_light,
                'cat_id' => $cat_id,
                'status' => $status,
                'created_at' => time(),
                'created_by' => get_user_login(),
            );
            //show_array($info);
            add_product($info);
            $success['product'] = "Thêm thành công sản phẩm: {$product_title}";
        } else {
            if (isset($thumbnail_url)) {
                unlink($thumbnail_url);
            }
            //show_array($error);
        }
    } 
    load_view('add');
}

function deleteAction() {
    $product_id = $_POST['id'];
    $status = $_POST['status'];
//Lấy ra thumb_url
    $item = get_product_by_id($product_id);
    $product_thumb = $item['product_thumb'];
    if ($status != 1) {
        $data = array('status' => 1);
        change_status($data, $product_id);
    } else {
//Xoá sản phẩm trong thùng rác
        delete_product_by_id($product_id);
//Xoá ảnh trong server: 
        unlink($product_thumb);
    }
    $num_status_1 = get_num_product_by_status(1);
    $num_status_2 = get_num_product_by_status(2);
    $num_status_3 = get_num_product_by_status(3);
    $num_total = get_num_product();
    $result = array(
        'num_status_1' => $num_status_1,
        'num_status_2' => $num_status_2,
        'num_status_3' => $num_status_3,
        'num_total' => $num_total,
    );
    echo json_encode($result);
}

function product_publicAction() {
    if (isset_sm_search_product()) {
        if (!empty($_POST['search_product'])) {
            $search_product = $_POST['search_product'];
            $list_product = get_list_search_product($search_product);
            $total_row = count($list_product);
        }
    } else {
        $total_row = count(get_list_product_by_status(3));
    }

    $num_per_page = 3;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    //Lấy ra danh sách sản phẩm theo phân trang
    $list_product_public = get_product_pagging($start, $num_per_page, $where = "`tbl_product`.`status` = 3");

    $data['list_product_public'] = $list_product_public;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    load_view('product_public', $data);
}

function product_pendingAction() {
    $total_row = count(get_list_product_by_status(2));
    $num_per_page = 3;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;

    $list_product_pending = get_product_pagging($start, $num_per_page, $where = "`tbl_product`.`status` = 2");
    $data['list_product_pending'] = $list_product_pending;
    $data['num_page'] = $num_page;
    $data['page'] = $page;

    load_view('product_pending', $data);
}

function product_bin_cleanAction() {
    $total_row = count(get_list_product_by_status(1));
    $num_per_page = 3;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    $list_product_bin_clean = get_product_pagging($start, $num_per_page, $where = "`tbl_product`.`status` = 1");

    $data['list_product_bin_clean'] = $list_product_bin_clean;
    $data['page'] = $page;
    $data['num_page'] = $num_page;
    load_view('product_bin_clean', $data);
}

function actionsAction() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $result = array();
        $list_check = $_POST['check'];
        foreach ($list_check as $item) {
            $result[] = $item['value'];
        }
        $list_id = implode(',', $result);
        $act = $_POST['act'];
        $data = array('status' => $act);
        db_update_act($data, $list_id);
        $list_return = array(
            'num_total' => get_num_product(),
            'num_status_3' => get_num_product_by_status(3),
            'num_status_2' => get_num_product_by_status(2),
            'num_status_1' => get_num_product_by_status(1),
        );
        echo json_encode($list_return);
    }
}

function editAction() {
    $id = $_GET['id'];
    $item = get_product_by_id($id);
    $data['item'] = $item;
    //show_array($item);
    load_view('edit', $data);
}
