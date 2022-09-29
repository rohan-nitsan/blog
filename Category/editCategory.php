<?php

require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$tag = $obj->getCat($_GET['id']);
$tagData = $tag->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj->updateCategory($_GET['id'], $_POST['tag']);
    echo "<script>window.location.href='addCategory.php'</script>";
}
?>

<form method="POST">
    <input type="text" name="tag" value="<?php echo $tagData['name']; ?>">
    <input type="submit" name="update" value="Update">
</form>