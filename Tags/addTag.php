<?php

require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj->addTags($_POST['tag']);
}
?>

<form method="POST">
    <input type="text" name="tag">
    <input type="submit" name="add" value="ADD">
</form>
<?php require_once 'displayTag.php' ?>
<a href="../index.php"><button>Home</button></a>