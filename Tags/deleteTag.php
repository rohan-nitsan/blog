<?php
$id = $_GET['id'];
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$obj->deleteTag($id);
echo "<script>window.location.href='addTag.php'</script>";
