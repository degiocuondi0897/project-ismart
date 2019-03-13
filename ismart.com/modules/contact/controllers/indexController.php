<?php
function construct() {
    load_model("index");
}

function indexAction() {
    $info_contact = get_info_contact();
    $data['info_contact'] = $info_contact;
    load_view('index', $data);
};
