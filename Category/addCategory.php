<?php
session_start();

require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$categories = $obj->getCategory();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj->addCategory($_POST['category']);
}
?>

<form method="POST">
    <input type="text" name="category">
    <input type="submit" name="add" value="ADD">
</form>
<?php require_once 'displayCategory.php' ?>
<a href="../index.php"><button>Home</button></a>