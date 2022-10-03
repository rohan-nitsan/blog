<?php
session_start();
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $obj->addPost($_SESSION['id'], $_POST, $description);
}
