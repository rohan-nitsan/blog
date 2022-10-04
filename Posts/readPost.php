<?php

require_once '../Config/connection.php';
require_once '../App/function.php';
require_once '../author_nav.php';
$post_id = $_GET['post_id'];

$obj = new Users();
$categories = $obj->getCategory();
$tags = $obj->getTags();
$postData = $obj->getPostData($post_id);
$myData = $postData->fetch_assoc();
$myTags = $obj->myTags($post_id);
$myCategory = $obj->myCategory($post_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/CSS/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <section class="">
        <div class="container py-5 h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-12 col-lg-9 col-xl-50">
                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px; margin-bottom: 10px;">
                        <div class="card-body p- p-md-3">
                            <div class="row">
                                <div class="col col-md-10">
                                    <h2><?php echo $myData['title']; ?></h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-10">
                                    <div id="editor" name="description"><?php echo $myData['description']; ?></div>
                                    <p class="error" id="description_error"></p>
                                </div>
                            </div>
                            <div class="row">
                                <p class="card-text" style=" text-align: justify;text-justify: inter-word;">Tags:
                                    <?php
                                    $myTags = $obj->myTags($myData['id']);
                                    foreach ($myTags as $tag) {
                                        foreach ($obj->getTag($tag['tag_id']) as $tag) {
                                            echo '<span class="badge bg-info" style="margin:2px;">' . $tag['name'] . '</span>';
                                        }
                                    }
                                    ?>
                                </p>
                                <p class="card-text" style=" text-align: justify;text-justify: inter-word;">Categories:
                                    <?php
                                    $myCategory = $obj->myCategory($myData['id']);
                                    foreach ($myCategory as $a) {
                                        // echo $a['category_id'];
                                        foreach ($obj->getCat($a['category_id']) as $cat) {
                                            echo '<span class="badge bg-success" style="margin:2px;">' . $cat['name'] . '</span>';
                                        }
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="row" style="margin-top: 3px;">
                                <div class="col col-md-2">
                                    <a href="../index.php"><button type="button" class="btn btn-primary">Back</button></a>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../Assets/JS/bootstrap.bundle.min.js"></script>
</body>

</html>