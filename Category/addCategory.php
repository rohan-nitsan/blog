<?php
session_start();

require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
$categories = $obj->getCategory();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $obj->addCategory($_POST['category']);
}
?>



<!doctype html>
<html lang="en">

<head>


    <!-- Bootstrap CSS -->
    <link href="../Assets/CSS/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add Category</title>
</head>

<body>
    <section class="">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-50">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p- p-md-3">
                            <h1 class="mb-4 pb-2 pb-md-0 mb-md-3">Add Category</h1>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col col-md-7">
                                        <input type="text" class="form-control" name="category" id="" placeholder="Enter Category">
                                    </div>
                                    <div class="col col-md-3">
                                        <input type="submit" name="add" class="btn btn-success" value="Add">
                                    </div>
                                </div>
                                <br>

                            </form>
                            <div class="row">
                                <?php require_once 'displayCategory.php' ?>
                            </div>
                            <div class="row">
                            <a href="../index.php"><button class="btn btn-primary">Home</button></a>
                            </div>
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