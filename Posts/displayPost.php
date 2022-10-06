<?php
require_once 'Config/connection.php';
require_once 'App/function.php';
require_once 'author_nav.php';
$obj = new Users();
$tags = $obj->getTags();
$categories = $obj->getCategory();
if ($_SESSION['role'] == "2") {
?>
    <a href="Posts/addPost.php"><button class="btn btn-primary" style="margin: 10px;">New Post</button></a>
    <a href="Category/addCategory.php"><button class="btn btn-primary" style="margin: 10px;">Categories</button></a>
    <a href="Tags/addTag.php"><button class="btn btn-primary" style="margin: 10px;">Tags</button></a>
<?php

}

?>

<div>
    <div class="main" style="float:left; margin: 10px;margin-bottom: 10px;">

        <div id="status"></div>
        <div class="card" id="card">
            <?php
            while ($row = $postData->fetch_array()) {
            ?>
                <div id="<?php echo $row['id']; ?>"  class="card text-center search" style="border:2px solid black;   width: 1400px;   margin: 15 auto; float: none;margin-bottom: 10px;">
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
    <div class="right" style="float: right;">
        <form action="">
            <div class="card text-center" style="border:2px solid black; margin: 20px;">
                <input id="text" name="text" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </div>
            <select class="form-select" name="category" aria-label="Default select example" id="category">
                <option value="" selected>Search By Category</option>
                <?php
                while ($row = $categories->fetch_assoc()) {
                ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select>
            <br><br>
            <select class="form-select" name="tag" aria-label="Default select2 example" id="tag2">
                <option value="" selected>Search By Tag</option>
                <?php
                while ($row = $tags->fetch_assoc()) {
                ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php } ?>
            </select><br>
            <button type="button" onclick="search()" class="btn btn-success">Search</button>
        </form>
    </div>
</div>
<script>
    function search() {
        text = document.getElementById('text').value;
        tag = document.getElementById('tag2').value;
        category = document.getElementById('category').value;
        data = new FormData();
        data.append('text', text);
        data.append('tag', tag);
        data.append('category', category);
        console.log(text, category, tag);
        xhttp = new XMLHttpRequest()
        xhttp.open("POST", "Posts/filterPost.php", true)
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var remove_div = document.getElementById('card');
        if (remove_div) {
            remove_div.parentNode.removeChild(remove_div);
        }

        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var return_data = xhttp.responseText;
                document.getElementById('status').innerHTML = return_data;
            }
        }
        xhttp.send(data);
    }



    function deletePost(post_id) {
        console.log(post_id);
        var data = new FormData();
        data.append('post_id', post_id);
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "Posts/deletePost.php", true);
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var return_data = xhttp.responseText;
                document.getElementById('status').innerHTML = return_data;
            }
        }
        var remove_div = document.getElementById(post_id);
        remove_div.parentNode.removeChild(remove_div);
        xhttp.send(data);
    }
</script>