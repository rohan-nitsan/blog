<?php
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$obj->addComment($_POST);
