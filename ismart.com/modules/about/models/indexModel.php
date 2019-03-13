<?php
function get_info_about() {
    return db_fetch_row("SELECT * FROM `tbl_about`");
}