<?php

//1. Thêm sản phẩm
function add_product($data) {
    return db_insert('tbl_product', $data);
}

//2. Kiểm tra sự tồn tại product_title
function product_title_exists($product_title) {
    $check = db_num_rows("SELECT * FROM `tbl_product` WHERE `product_title` = '{$product_title}'");
    if ($check > 0)
        return true;
    return false;
}

//3. Kiểm tra sự tồn tại product_code
function product_code_exists($product_code) {
    $check = db_num_rows("SELECT * FROM `tbl_product` WHERE `product_code` = '{$product_code}'");
    if ($check > 0)
        return true;
    return false;
}

//4. Hàm lấy ra danh sách sản phẩm
function get_list_product() {
    $result = array();
    $list_product = db_fetch_array("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id`");
    foreach ($list_product as $item) {
        $result[] = $item;
    }
    return $result;
}

//4. Hàm lấy ra số lượng sản phẩm đã đăng: status = 3 or chờ xét duyêt: status = 2
//----------Sản phẩm trong thùng rác: status = 1
function get_num_product_by_status($status) {
    $result = db_num_rows("SELECT * FROM `tbl_product` WHERE `status` = '{$status}'");
    if ($result > 0)
        return $result;
    return 0;
}

//5. Hàm thay đổi trang thái(status = 0): khi thực hiện xoá sản phẩm,sp sẽ được đưa vào thùng rác và status =0
function change_status($data, $product_id) {
    db_update('tbl_product', $data, "`product_id` = {$product_id}");
}


//8. Hàm lấy ra danh sách sản phẩm theo trang thái: status: 1,2 hoăc 3
function get_list_product_by_status($status) {
    return db_fetch_array("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` WHERE `tbl_product`.`status` = '{$status}'");
}

//10. Xoá sản phẩm theo id
function delete_product_by_id($product_id) {
    return db_delete('tbl_product', "`product_id` = '{$product_id}'");
}

//Hàm kiểm tra đã sm_search_product
function isset_sm_search_product() {
    if (isset($_POST['sm_search_product']))
        return true;
}

//11. Hàm lấy ra danh sách sản phẩm theo phân trang
function get_product_pagging($start = 1, $num_per_page = 4, $where) {
    if (!empty($where)) {
        $where = "WHERE {$where}";
    }
    if (isset_sm_search_product()) {
        if (!empty($_POST['search_product'])) {
            $search_product = $_POST['search_product'];
            $list_product = get_list_search_product($search_product);
        }
    } else {
        $list_product = db_fetch_array("SELECT `tbl_product`.*, `tbl_product_cat`.`cat_title` FROM `tbl_product` LEFT JOIN `tbl_product_cat` ON `tbl_product`.`cat_id` = `tbl_product_cat`.`cat_id` {$where} LIMIT {$start}, {$num_per_page}");
    }
    return $list_product;
}

//12. Hàm thực thi action
function db_update_act($data, $list_id) {
    return db_update('tbl_product', $data, "`product_id` IN ($list_id)");
}

function delete_product_act($list_id) {
    return db_delete('tbl_product', "`product_id` IN ($list_id)");
}
