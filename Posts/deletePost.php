<?php
$post_id = $_POST['post_id'];
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$obj->deletePost($post_id);
