<?php
session_start();
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$data = $obj->select($_SESSION['email']);
if ($_POST['text'] == "" and $_POST['category'] == "" and $_POST['tag'] == "") {
    $postData = $obj->getPosts();
} else {
    $postData = $obj->filterPost($_POST);
}

?>

<div>
    <div class="main" style="float:left; margin: 10px;margin-bottom: 10px;">

        <div id="status"></div>
        <div class="card" id="card">
            <?php
            while ($row = $postData->fetch_assoc()) {
            ?>
                <div id="<?php echo $row['id']; ?>" class="card text-center search" style="border:2px solid black;   width: 1400px;   margin: 15 auto; float: none;margin-bottom: 10px;">
                    <div class="card-header">
                        <?php echo $row['author']; ?>
                    </div>
                    <div class="card-body">
                        <a href="Posts/readPost.php?post_id=<?php echo $row['id']; ?>" style="text-decoration:none; color: black;">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                        </a>
                        <p class="card-text" style=" text-align: justify;text-justify: inter-word;"><?php echo "<style>p {width: 700px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;}</style>";
                                                                                                    echo $row['description']; ?></p>
                    </div>
                    <div class="row">
                        <p class="card-text" style=" text-align: justify;text-justify: inter-word;">
                            <?php
                            $myTags = $obj->myTags($row['id']);
                            foreach ($myTags as $tag) {
                                foreach ($obj->getTag($tag['tag_id']) as $tag) {
                                    echo '<span class="badge bg-info" id="tag" style="margin:3px;">' . $tag['name'] . '</span>';
                                }
                            }
                            ?>
                        </p>
                    </div>
                    <a href="Posts/readPost.php?post_id=<?php echo $row['id']; ?>"><button class="btn btn-success" style="margin:5px;float:right;">Read Post</button></a>
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
                                            <!-- <a href="Posts/deletePost.php?post_id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a> -->
                                            <button class="btn btn-danger" data-bs-dismiss="modal" onclick="deletePost(<?php echo $row['id']; ?>)">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>