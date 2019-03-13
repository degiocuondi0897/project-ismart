<?php

function construct() {
    load_model('index');
}

function indexAction() {
    //Xử lý phân trang danh sách bài viết
    $total_row = get_num_all_post();
    $num_per_page = 6;
    $num_page = ceil($total_row / $num_per_page);

    $page = (int) (isset($_GET['page'])) ? $_GET['page'] : 1;
    $start = ($page - 1) * $num_per_page;
    
    $list_post = get_list_post_pagging($start, $num_per_page, "`status` = 3");
    //Dữ liệu trả về 
    $data['list_post'] = $list_post;
    $data['num_page'] = $num_page;
    $data['page'] = $page;
    load_view('index', $data);
}
