<?php

function construct() {
    load_model('index');
}

function indexAction() {
    $list_slider = get_list_slider();
    $data['list_slider'] = $list_slider;
    load_view('index', $data);
}

function uploadAction() {
    global $error;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $flug = "";
        $error = array();
        $upload_dir = "public/uploads/slider/";
        $fileUpload = $upload_dir . basename($_FILES['file']['name']);
        //Chuẩn hoá dữ liệu file======================================>
        //--1. Kiểm tra định dạng file
        $file_allow = array('jpg', 'png', 'jpeg', 'gif');
        $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($type), $file_allow)) {
            $error['file'] = "Chỉ upload file ảnh có định dạng jpg, png, jpeg, gif";
        } else {
            //--Kiểm tra kích thước < 20MB
            $file_size = $_FILES['file']['size'];
            if ($file_size > 29000000) {
                $error['file'] = "Kích thước file vượt quá 20MB";
            } elseif (file_exists($fileUpload)) {
                //--3. Kiểm tra file có tồn tại trên hệ thống không
                $error['file'] = "File đã tồn tại trên hệ thống, hãy chọn ảnh khác";
            }
        }

        //Nếu không có lỗi
        if (empty($error)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $fileUpload)) {
                $flug = true;
                echo json_encode(array('success' => 'ok', 'file_path' => $fileUpload,));
            }
        } else {
            echo json_encode(array('status' => $error['file']));
        }
    }
}

function addAction() {
    global $error, $thumbnail_url, $status, $success;
    if (isset($_POST['btn-submit'])) {
        $error = array();
        $success = array();
        //1. Kiểm tra upload ảnh
        if (empty($_POST['thumbnail_url'])) {
            $error['thumbnail_url'] = "Cần chọn ảnh slide để upload";
        } else {
            $thumbnail_url = $_POST['thumbnail_url'];
        }
        //2 Kiểm tra trang thái
        if (empty($_POST['status'])) {
            $error['status'] = "Cần chọn trạng thái";
        } else {
            $status = $_POST['status'];
        }
        // Nếu không có lỗi
        if (empty($error)) {
            $data = array(
                'slide_thumb' => $thumbnail_url,
                'status' => $status,
                'created_at' => time(),
                'created_by' => get_user_login(),
            );
            db_insert('tbl_slider', $data);
            $success['slider'] = "Thêm slider thành công";
        } else {
            $success['slider'] = "Thêm slide thất bại";
            if (isset($thumbnail_url)) {
                unlink($thumbnail_url);
            }
        }
    }
    load_view('add');
}
