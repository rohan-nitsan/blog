<?php
session_start();
if (!$_SESSION['set']) {
    header('location:../login.php');
}
require_once '../Config/connection.php';
require_once '../App/function.php';
require_once '../author_nav.php';
$obj = new Users();
$categories = $obj->getCategory();
$tags = $obj->getTags();
?>
<!doctype html>
<html lang="en">

<head>
    <style>
        .error {
            color: red;
        }
    </style>

    <!-- Bootstrap CSS -->
    <link href="../Assets/CSS/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                        <p class="error" id="title_error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-12">
                                        <h5>Category:</h5>
                                        <select name="category[]" id="" class="multiple-select col col-md-10" multiple>
                                            <?php
                                            while ($row = $categories->fetch_array()) {
                                                echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                            }

                                            ?>
                                        </select>
                                        <p class="error" id="category_error"></p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col col-md-12">
                                        <h5>Tag:</h5>
                                        <select name="tag[]" id="" class="multiple-select col col-md-10" multiple>
                                            <?php
                                            while ($row = $tags->fetch_array()) {
                                                echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                            }

                                            ?>
                                        </select>
                                        <p class="error" id="tag_error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-10">
                                        <h5>Description:</h5>
                                        <textarea type="text" class="form-control" rows="5" name="description" id=""></textarea>
                                        <p class="error" id="description_error"></p>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 3px;">
                                    <div class="col col-md-2">
                                        <a href="../index.php"><button type="button" class="btn btn-primary">Back</button></a>
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
    <!-- JQuery CDN      -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Select2   -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".multiple-select").select2({
            // maximumSelectionLength: 2
        });
    </script>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $valid = true;
    if (empty($_POST['title'])) {
        $obj->validation_error('title_error', '* Please Enter Title');
        $valid = false;
    }
    if (!$_POST['category']) {
        $obj->validation_error('category_error', '* Please Select Category');
        $valid = false;
    }
    if (!$_POST['tag']) {
        $obj->validation_error('tag_error', '* Please Select Tag');
        $valid = false;
    }
    if (empty($_POST['description'])) {
        $obj->validation_error('description_error', '* Please Enter Content');
        $valid = false;
    }

    if ($valid) {
        $obj->addPost($_SESSION['id'], $_POST);
        echo "<script>window.location.href='../index.php'</script>";
    }
}
?>