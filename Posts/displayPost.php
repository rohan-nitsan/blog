<?php
if ($_SESSION['role'] == "2") {
?>
    <a href="Posts/addPost.php"><button class="btn btn-primary" style="margin: 10px;">New Post</button></a>
    <a href="Category/addCategory.php"><button class="btn btn-primary" style="margin: 10px;">Categories</button></a>
    <a href="Tags/addTag.php"><button class="btn btn-primary" style="margin: 10px;">Tags</button></a>
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
            <p class="card-text" style=" text-align: justify;text-justify: inter-word;">Tags:
                <?php
                    $myTags = $obj->myTags($row['id']);
                    foreach($myTags as $tag){
                        foreach($obj->getTag($tag['tag_id']) as $tag){
                            echo '<span class="badge bg-info" style="margin:2px;">'.$tag['name'].'</span>';
                        }
                    }
                ?>
            </p>
            <p class="card-text" style=" text-align: justify;text-justify: inter-word;">Categories:
                <?php
                    $myCategory = $obj->myCategory($row['id']);
                   foreach($myCategory as $a){
                    // echo $a['category_id'];
                    foreach($obj->getCat($a['category_id']) as $cat){
                        echo '<span class="badge bg-success" style="margin:2px;">'.$cat['name'].'</span>';
                    }
                   }
                ?>
            </p>
            <div class="card-footer text-muted">
                <?php echo $row['created'];
                if ($row['author'] == $data['id']) {
                    echo "<a style='float:right; color:blue;' href='Posts/editPost.php?post_id=" . $row['id'] . "'><button class='btn btn-warning'>Edit</button></a>";
                ?>
                    <button style='float:left;' type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id']; ?>">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are ou sure you want to delete this post?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <a href="Posts/deletePost.php?post_id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php
    }

    ?>
</div>