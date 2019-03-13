<?php

function construct() {
    load_model('detail');
}

function indexAction() {
    $id = $_GET['id'];
    $post = get_post_by_id($id);
//    show_array($post);
    $data['post'] = $post;
    load_view('detail', $data);
}