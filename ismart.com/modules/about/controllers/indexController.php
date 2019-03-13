<?php
function construct() {
    load_model("index");
}

function indexAction() {
    $info_about = get_info_about();
    $data['info_about'] = $info_about;
    load_view('index', $data);
};
