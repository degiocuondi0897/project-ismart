<?php
//0. Lấy ra danh sách sản phẩm đang có trong giỏ hàng
function get_list_buy_cart() {
    if (isset($_SESSION['cart']['buy']))
        return $_SESSION['cart']['buy'];
    return false;
}
//. Lấy ra thông tin của giỏ hàng gồm: $num_order và $total
function get_info_cart() {
    if (isset($_SESSION['cart']['info']))
        return $_SESSION['cart']['info'];
}

//1. Thêm 1 hoặc nhiều sản phẩm vào giỏ hàng
function add_cart($id, $num_order) {
    $qty = $num_order;
    if (isset($_SESSION['cart']['buy'][$id])) {
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + $num_order;
    }
    $item = get_product_by_id($id);
    //show_array($item);
    $_SESSION['cart']['buy'][$id] = array(
        'id' => $id,
        'product_title' => $item['product_title'],
        'product_thumb' => $item['product_thumb'],
        'product_url' => $item['product_url'],
        'product_price' => $item['product_price'],
        'qty' => $qty,
        'sub_total' => $qty * $item['product_price'],
    );
    //Thêm 1 sản phẩm mới phải cập nhập thông tin giỏ hàng ngay
    update_info_cart();
}

//2. Hàm cập nhập thông tin giỏ hàng gồm: 
//----- tổng số lượng mua: $num_order
//----- Tổng giá: $total
function update_info_cart() {
    $num_order = 0;
    $total = 0;
    if (isset($_SESSION['cart']['buy'])) {
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_total'];
        }
        //Tảo mảng SESSION['cart']['info'] : lưu trữ thông tin cart
        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total,
        );
    }
}
//3.Hàm lấy ra tổng số lượng sản phẩm có trong giỏ hàng
function get_num_order_cart() {
    if (isset($_SESSION['cart']['info']))
        return $_SESSION['cart']['info']['num_order'];
    return 0;
}

