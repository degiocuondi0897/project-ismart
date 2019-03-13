<?php

function construct() {
    load_model('detail');
}


function indexAction() {
    $id = $_GET['id'];
    $item = get_product_by_id($id);
    //1.Lấy ra danh mục cha của sản phẩm
    $cat_id = $item['cat_id'];
    $cat = get_cat_by_id($cat_id);
    
    //2.Lấy ra danh sách sản phẩm cùng chuyên mục
    $list_product = get_list_product_by_cat_id($cat_id);
    //show_array($list_product);
    
    //Dữ liệu trả về
    $data['item'] = $item;
    $data['cat'] = $cat;
    $data['list_product'] = $list_product;
    load_view('detail', $data);
}
//Thêm sản phẩm vào giỏ hàng
function addAction() {
    $id = $_GET['id'];
    if (isset($_POST['btn_add_cart'])) {
        $num_order = $_POST['num-order'];
        add_cart($id, $num_order);
        //show_array($_SESSION['cart']);
        redirect_to("?mod=cart&controller=index&action=index&id={$id}");
    } else {
        add_cart($id, 1);
        redirect_to("?mod=cart&controller=index&action=index&id={$id}");
    }
    //show_array($_POST);
}

