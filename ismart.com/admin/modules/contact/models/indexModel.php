<?php

//Lấy ra data contact: tbl_contact
function get_data_contact() {
    return db_fetch_row("SELECT * FROM `tbl_contact`");
}

//Kiểm tra số bản ghi trong bảng tbl_contact
function exists_num_row_contact() {
    $check = db_num_rows("SELECT * FROM `tbl_contact`");
    if ($check > 0)
        return true;
    return false;
}
