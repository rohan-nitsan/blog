<?php if ($_SESSION['role'] == "2") {
?>

    <form method="POST" style="margin: 5px; padding:5px; width: 1000px;"><input type="submit" name="newPost" class="btn btn-primary" style="margin: 10px;" value="New Post" /></form>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['newPost'])) {
            require_once 'addPost.php';
        }
    }

    if (isset($_POST['post'])) {
        $obj->addPost($data['id'], $_POST);
        echo "<script>window.location.href='./index.php'</script>";
    }
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
                    // header('location:Posts/editPost.php');
                    echo "<a style='float:right; color:blue;' href='Posts/editPost.php?post_id=" . $row['id'] . "'>Edit</a>";
                }
                ?>
            </div>
        </div>
    <?php
    }

    ?>
</div>