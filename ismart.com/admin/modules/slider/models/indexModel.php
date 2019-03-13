<?php
//danh sách slider
function get_list_slider() {
    return db_fetch_array("SELECT * FROM `tbl_slider`");
}