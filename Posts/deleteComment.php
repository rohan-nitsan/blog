<?php
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$obj->deleteComment($_POST['comment_id']);
