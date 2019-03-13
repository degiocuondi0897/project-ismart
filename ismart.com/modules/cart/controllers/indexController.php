<?php

function construct() {
    load_model('index');
}

function indexAction() {
    //Danh sách sản phẩm đã mua
    $list_buy = get_list_buy_cart();
    $info_cart = get_info_cart();
    //show_array($_SESSION['cart']['info']);
    //Dữ liệu trả về
    $data['list_buy'] = $list_buy;
    $data['info_cart'] = $info_cart;
    load_view('index', $data);
}

function deleteAction() {
    $id = $_GET['id'];
    delete_product($id);
}

function delete_allAction() {
    delete_all();
}

function checkoutAction() {
    load_view('checkout');
}

function change_qtyAction() {
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    
    $item =  get_product_buy_by_id($id);
    $sub_total = $item['product_price'] * $qty;
    //Cập nhập vào mảng SESSION cho sản phẩm vừa thay đổi số lượng
    $_SESSION['cart']['buy'][$id]['qty'] = $qty;
    $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;
   
    //Duyêt mảng SESSION
    $num_order = 0;
    $total = 0;
    foreach ($_SESSION['cart']['buy'] as $flug) {
        $num_order += $flug['qty'];
        $total += $flug['sub_total'];
    }
    //Ta cập nhập lại thông tin cho mảng S_SESSION['cart']['info']
    $_SESSION['cart']['info']['num_order'] = $num_order;
    $_SESSION['cart']['info']['total'] = $total;
    //Tạo mảng json lưu trữ để trả về ajax
    $result = array(
        'num_order' => $num_order,
        'sub_total' => currency_format($sub_total),
        'total' => currency_format($total),
        'qty' => $qty,
    );
    echo json_encode($result);
}