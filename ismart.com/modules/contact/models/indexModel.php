<?php
function get_info_contact() {
    return db_fetch_row("SELECT * FROM `tbl_contact`");
}