<?php

//Lấy ra data contact: tbl_contact
function get_data_about() {
    return db_fetch_row("SELECT * FROM `tbl_about`");
}

//Kiểm tra số bản ghi trong bảng tbl_contact
function exists_num_row_about() {
    $check = db_num_rows("SELECT * FROM `tbl_about`");
    if ($check > 0)
        return true;
    return false;
}
