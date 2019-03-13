<?php

function construct() {
    load_model('index');
}

function indexAction() {
    //Danh sách slide
    $list_slider = get_list_slider(2);
    //Danh sách sản phẩm nôi bật: high_light = 2
    $list_product_high_light = get_list_product_by_high_light(2);

    //Đổ dữ liệu sản phẩm theo danh mục
    $list_cat = get_list_cat_by_level(0);
    //show_array($list_cat);
    //Dữ liệu trả về
    $data['list_slider'] = $list_slider;
    $data['list_product_high_light'] = $list_product_high_light;
    $data['list_cat'] = $list_cat;
    load_view('index', $data);
}

function searchAction() {
    global $error, $search;
    if (isset($_POST['sm_search'])) {
        $error = array();
        //Kiểm tra dữ liệu nhập trống
        if (empty($_POST['search'])) {
            $error['search'] = "Bạn chưa nhập từ khoá tìm kiếm";
        } else {
            if (!exists_search($_POST['search'])) {
                $error['search'] = "0 có kết quả nào cho từ khoá {$_POST['search']}";
            } else {
                $search = $_POST['search'];
            }
        }
        //Nếu không có lỗi
        if (empty($error)) {
            $total_row = num_row_search($search);
            $info = get_product_by_search($search);

            //Dữ liệu trả về
            $data['info'] = $info;
            $data['total_row'] = $total_row;
            $data['search'] = $search;
            load_view('search', $data);
        }
    }
    load_view('search');
}
