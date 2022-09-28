<?php
require_once '../Config/connection.php';
include '../App/function.php';
$post_id = $_GET['post_id'];

$obj = new Users();
$categories = $obj->getCategory();
$tags = $obj->getTags();
$postData = $obj->getPostData($post_id);
$myData = $postData->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $obj->updatePost($post_id, $_POST);
    echo "<script>window.location.href='../index.php'</script>";
}

?>
<form method="POST" name="popForm" style="margin: 5px; padding:5px; width: 1000px;">
    <div class="row">
        <div class="col col-md-12">
            <h5>Title:</h5>
            <input type="text" class="form-control" name="title" id="" value="<?php echo $myData['title']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col col-md-6">
            <h5>Category:</h5>
            <select name="category" id="">
                <option value="" selected>Select</option>
                <?php
                while ($row = $categories->fetch_array()) {
                    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                }

                ?>
            </select>
        </div>
        <div class="col col-md-6">
            <h5>Tag:</h5>
            <select name="tag" id="">
                <option value="" selected>Select</option>
                <?php
                while ($row = $tags->fetch_array()) {
                    echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                }
                ?>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12">
            <h5>Description:</h5>
            <textarea type="text" class="form-control" rows="5" name="description" id=""><?php echo $myData['description']; ?></textarea>
        </div>
    </div>
    <div class="row" style="margin-top: 3px;">
        <div class="col col-md-2">
            <input type="submit" name="update" value="Update" class="btn btn-success" id="">
        </div>
    </div>
</form>