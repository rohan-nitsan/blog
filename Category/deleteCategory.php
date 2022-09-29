<?php
$id = $_GET['id'];
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$obj->deleteCat($id);
echo "<script>window.location.href='addCategory.php'</script>";
