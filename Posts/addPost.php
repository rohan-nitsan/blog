<?php
session_start();
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$categories = $obj->getCategory();
$tags = $obj->getTags();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $obj->addPost($_SESSION['id'], $_POST);

    echo "<script>window.location.href='../index.php'</script>";
}
?>
<!doctype html>
<html lang="en">

<head>


    <!-- Bootstrap CSS -->
    <link href="../Assets/CSS/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>New Post</title>
</head>

<body>
    <section class="">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-50">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p- p-md-3">
                            <h1 class="mb-4 pb-2 pb-md-0 mb-md-3">New Post</h1>
                            <form action="" method="POST" style="margin: 5px; padding:5px; width: 1000px;">
                                <div class="row">
                                    <div class="col col-md-10">
                                        <h5>Title:</h5>
                                        <input type="text" class="form-control" name="title" id="">
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
                                    <div class="col col-md-10">
                                        <h5>Description:</h5>
                                        <textarea type="text" class="form-control" rows="5" name="description" id=""></textarea>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 3px;">
                                    <div class="col col-md-2">
                                        <button class="btn btn-primary">Back</button>
                                    </div>
                                    <div class="col col-md-2">
                                        <input type="submit" name="post" value="POST" class="btn btn-success" id="">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Bootstrap Script -->
    <script src="../Assets/JS/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>