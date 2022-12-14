<?php
session_start();
if (!$_SESSION['set']) {
    header('location:../login.php');
}
require_once '../Config/connection.php';
require_once '../App/function.php';
require_once '../author_nav.php';
$obj = new Users();
$cat = $obj->getCat($_GET['id']);
$catData = $cat->fetch_assoc();


?>
<html lang="en">

<head>
    <style>
        .error {
            color: red;
        }
    </style>

    <!-- Bootstrap CSS -->
    <link href="../Assets/CSS/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <title>Edit Category</title>
</head>

<body>
    <section class="">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-50">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                        <div class="card-body p- p-md-3">
                            <h1 class="mb-4 pb-2 pb-md-0 mb-md-3">Edit Category</h1>
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col col-md-7">
                                        <input type="text" class="form-control" name="category" id="" value="<?php echo $catData['name']; ?>" placeholder="Enter Tag">
                                        <p class="error" id="category_error"></p>
                                    </div>
                                    <div class="col col-md-3">
                                        <input type="submit" name="update" class="btn btn-success" value="Update">
                                    </div>
                                </div>
                                <br>

                            </form>
                            <div class="row">
                                <a href="addCategory.php"><button class="btn btn-primary">Home</button></a>
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
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['category'])) {
        $obj->validation_error('category_error', '* Please Enter Category');
    } else {
        $obj->updateCategory($_GET['id'], $_POST['category']);
        echo "<script>window.location.href='addCategory.php'</script>";
    }
}
?>