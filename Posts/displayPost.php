<?php
if ($_SESSION['role'] == "2") {
?>
    <a href="Posts/addPost.php"><button class="btn btn-primary" style="margin: 10px;">New Post</button></a>
    <a href="Category/addCategory.php"><button class="btn btn-primary" style="margin: 10px;">Add Category</button></a>
    <a href="Tags/addTag.php"><button class="btn btn-primary" style="margin: 10px;">Add Tag</button></a>
<?php

}
?>

<div class="card" style="margin: 10px; margin: 0 auto; float: none;margin-bottom: 10px;">
    <?php
    while ($row = $postData->fetch_array()) {
    ?>
        <div class="card text-center" style="border:2px solid black; width: 1000px;   margin: 15 auto; float: none;margin-bottom: 10px;">
            <div class="card-header">
                <?php echo $row['author']; ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $row['title']; ?></h5>
                <p class="card-text" style=" text-align: justify;text-justify: inter-word;"><?php echo $row['description']; ?></p>
            </div>
            <div class="card-footer text-muted">
                <?php echo $row['created'];
                if ($row['author'] == $data['id']) {
                    echo "<a style='float:right; color:blue;' href='Posts/editPost.php?post_id=" . $row['id'] . "'>Edit</a>";
                }
                ?>
            </div>
        </div>
    <?php
    }

    ?>
</div>