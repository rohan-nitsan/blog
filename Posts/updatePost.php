<?php
session_start();
$post_id = $_POST['post_id'];
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $obj->updatePost($post_id, $_POST);
}
