<?php

function construct() {
    load_model('index');
}

function indexAction() {
    //Nếu lấy sản phẩm từ ông nội
    if (isset($_GET['cat_id'])) {
        $cat_id = $_GET['cat_id'];
        $item = get_cat_by_cat_id($cat_id);
        $cat_title = $item['cat_title'];
        $level = $item['level'];
        $num_per_page = 12;
        if ($level == 0) {
            //Lấy danh sách sản phẩm là cháu của danh mục
            $total_row = num_row_by_parent_id($cat_id);
            $num_page = ceil($total_row / $num_per_page);
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            $start = ($page - 1) * $num_per_page;

            $list_product = get_list_product_by_parent_id_pagging($cat_id, $start, $num_per_page);
        } else {
            if ($level == 1) {
                //Lấy ra danh sách sản phẩm là con trực tiếp của danh mục $cat_id
                $total_row = num_row_by_cat_id($cat_id);
                $num_page = ceil($total_row / $num_per_page);
                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                $start = ($page - 1) * $num_per_page;

                $list_product = get_list_product_by_cat_id_pagging($cat_id, $start, $num_per_page);
            }
        }
        $data['list_product'] = $list_product;
        $data['total_row'] = $total_row;
        $data['num_page'] = $num_page;
        $data['page'] = $page;
        $data['cat_title'] = $cat_title;
        $data['level'] = $level;
        $data['cat_id'] = $cat_id;
    }

    //Trả về

    load_view('index', $data);
}

function showAction() {
    $list_cat = get_cat_by_level(1);
    //Danh sách sản phẩm nổi bật
    $list_product_high_light = get_list_product_by_high_light(2);
    //Sản phẩm bán chạy
    $list_selling = get_list_selling();

    //Dữ liệu trả về 
    $data['list_product_high_light'] = $list_product_high_light;
    $data['list_selling'] = $list_selling;
    $data['list_cat'] = $list_cat;
    var_dump($data['list_cat']); die;
    load_view('show', $data);
}

function filterAction() {
    //Xử lí lọc dữ liệu
    // Lọc giá sản phẩm
    //TH1:
    if (isset($_POST['price'])) {
        $price = $_POST['price'];
        if ($price == 1) {
            //Lấy các sản phẩm dưới 500.000đ
            $list_product = get_product_filter_price_round(500000);
        } elseif ($price == 2) {
            //Lấy ra các sp có giá trong khoảng: 500.000 - 1triêu
            $list_product = get_product_filter_price(500000, 1000000);
        } elseif ($price == 3) {
            $list_product = get_product_filter_price(1000000, 5000000);
        } elseif ($price == 4) {
            $list_product = get_product_filter_price(5000000, 10000000);
        } elseif ($price == 5) {
            $list_product = get_product_filter_price(10000000, 20000000);
        } elseif ($price == 6) {
            $list_product = get_product_filter_price_ceil(20000000);
        }

        if (!empty($list_product)) {
            $body = "";

            foreach ($list_product as $item) {
                $body .= "<li>
                            <a href='?page=detail_product' title=' class='thumb'>
                                <img src='admin/" . $item['product_thumb'] . "'>
                            </a>
                            <a href='?page=detail_product' title=' class='product-name'>" . $item['product_title'] . "</a>
                            <div class='price'>
                                <span class='new'>" . currency_format($item['product_price']) . "</span>
                                <span class='old'>20.900.000đ</span>
                            </div>
                            <div class='action clearfix'>
                                <a href='?page=cart' title='Thêm giỏ hàng' class='add-cart fl-left'>Thêm giỏ hàng</a>
                                <a href='?page=checkout' title='Mua ngay' class='buy-now fl-right'>Mua ngay</a>
                            </div>
                        </li>";
            }
        }
    } else {
        
    }
    echo $body;
}
