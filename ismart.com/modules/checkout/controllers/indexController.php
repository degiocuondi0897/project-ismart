<?php

function construct() {
    load_model('index');
}

function indexAction() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        add_cart($id, 1);
        //chuyển hướng về checkout
        
    }
    $list_buy = get_list_buy_cart();
    $info_cart = get_info_cart();
    //show_array($list_buy);
    //Dữ liệu trả về
    $data['list_buy'] = $list_buy;
    $data['info_cart'] = $info_cart;
    
    //Xử lí thanh toán =====================>

    global $error, $fullname, $email, $address, $phone, $note, $payment_method;
    if (isset($_POST['order-now'])) {
        $error = array();
        //1. Kiểm tra hộ và tên
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Tên khách hàng không được trống";
        } else {
            $fullname = $_POST['fullname'];
        }
        //2. Kiểm tra địa chỉ email
        if (empty($_POST['email'])) {
            $error['email'] = "Email khách hàng không được trống";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Địa chỉ email chưa đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        //3. Kiểm tra address 
        if (empty($_POST['address'])) {
            $error['address'] = "Địa chỉ khách hàng không được trống";
        } else {
            $address = $_POST['address'];
        }
        //3. Kiểm tra phone 
        if (empty($_POST['phone'])) {
            $error['phone'] = "Số điện thoại khách hàng không được trống";
        } else {
            $phone = $_POST['phone'];
        }

        //4. Kiểm tra note
        if (empty($_POST['note'])) {
            $error['note'] = "Ghi chú không được trống";
        } else {
            $note = $_POST['note'];
        }
        //5.Hình thức thanh toán
        if (isset($_POST['payment_method'])) {
            $payment_method = $_POST['payment_method'];
        } else {
            $error['payment_method'] = "Bạn cần chọn phương thức thanh toán";
        }
        //Nếu không có lỗi =================>
        if (empty($error)) {
            //Tạo mã đơn hàng ngẫu nhiên
            $order_code = "ISMDH" . mt_rand();
            //Nôi dung gửi mail
            $body = "<div>";
            $body .= "
    <p>Cảm ơn Đào Hữu Nghĩa đã đặt hàng tại <strong>ISMART STORE</strong>, chúng tôi xin thông báo đơn hàng <strong>{$order_code}</strong> của quý khách đã được tiếp nhận</p>
    <p>Xin vui lòng kiểm tra các thông tin trong đơn hàng của quý khách</p>
    <h3>THÔNG TIN ĐƠN HÀNG: {$order_code}</h3>
    <p>Thời gian đặt hàng: ".date('d/m/Y', time())."</p>
    <h5>Thông tin giao hàng</h5>
    <p>Người nhận: {$fullname}</p>
    <p>Địa chỉ: {$address}</p>
    <p>Điện thoại: {$phone}</p>
    <p>Email: {$email}</p>
    <h2>Chi tiết đơn hàng</h2>";
            $body .= "<table>
        <tr style='background: red; color: #fff; font-weight: bold; border-bottom: none;'>
            <td>STT</td>
            <td>Sản phẩm</td>
            <td>Số lượng</td>
            <td>Đơn giá</td>
            <td>Thành tiền</td>
        </tr>";
            //Xử lý php
            $list_buy = get_list_buy_cart();
            if (!empty($list_buy)) {
                $i = 1;
                foreach ($list_buy as $item) {
                    $i++;
                    $body .= "
                    <tr>
                        <td>" . $i . "</td>
                        <td>{$item['product_title']}</td>
                        <td>{$item['qty']}</td>
                        <td>" . currency_format($item['product_price']) . "</td>
                        <td>" . currency_format($item['sub_total']) . "</td>
                    </tr>
                    ";
                }
            }
            //Xử lý info-cart
            $info_cart = get_info_cart();
            $body .= "
              </table>";
            $body .= "<div id='info-cart'>
        <p>Tổng số lượng hàng: {$info_cart['num_order']}</p>
        <p>Phí vận chuyển: miễn phí</p>
        <p style='background: red; color: #fff; font-weight: bold; padding: 5px'>Cần thanh toán: " . currency_format($info_cart['total']) . "</p>
    </div>
    <p>ISMART STORE xin cảm ơn quý khách!</p>
</div>";
            //Thêm thông tin đơn hàng
            $info_cart = get_info_cart();
            $data_order = array(
                'order_code' => $order_code,
                'total' => $info_cart['total'],
                'num_order' => $info_cart['num_order'],
                'fullname' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'note' => $note,
                'payment_method' => $payment_method,
                'created_at' => time(),
            );
            db_insert('tbl_orders', $data_order);

            //Lấy ra order_id của tbl_order theo $order_code
            $order = get_order_by_order_code($order_code);
            $order_id = $order['order_id'];
            //Dữ liệu sản phẩm đặt hàng
            foreach ($list_buy as $flug) {
                $data_product = array(
                    'order_id' => $order_id,
                    'product_id' => $flug['id'],
                    'qty' => $flug['qty'],
                );
                db_insert('tbl_order_product', $data_product);
                //Xử lí qty_order trong tbl_product, thực hiện cập nhập số lượng đặt hàng vào tbl_product
                $order_qty_old = get_qty_order_by_id($flug['id']);
                $order_qty_new = $order_qty_old + $flug['qty'];
                $data = array(
                    'order_qty' => $order_qty_new,
                );
                db_update('tbl_product', $data, "`product_id` = {$flug['id']}");
            }
            send_mail($email, $fullname, "ISMART STORY", $body);
            redirect_to("?mod=checkout&controller=index&action=order_success&order_id={$order_id}");
        } else {
            //show_array($error);
        }
    }
    load_view('checkout', $data);
}

function order_successAction() {
    $order_id = $_GET['order_id'];
    $order = get_order_by_id($order_id);
    //show_array($order);
    $data['order'] = $order;
    load_view('order_success', $data);
}
 
