<?php
session_start();
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
                                    <h2>
                                        <?php echo $myData['title']; ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col col-md-10">
                                    <div id="editor" name="description">
                                        <?php echo $myData['description']; ?>
                                    </div>
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

                                <div class="col col-md-8">
                                    <p>
                                        <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            Add Comment
                                        </button>
                                    </p>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card card-body">
                                            <textarea name="" id="comment" cols="500" rows="8"></textarea>
                                            <button class="btn btn-dark" onclick="addComment()" data-bs-toggle="collapse" data-bs-target="#collapseExample" style="margin: 5px;">Add</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div id="status"></div>
                        </div>
                    </div>
                </div>
                <div id="comment_data"></div>
            </div>
        </div>
        </div>
        </div>
    </section>

    <script src="../Assets/JS/bootstrap.bundle.min.js"></script>
    <script>
        xhttp = new XMLHttpRequest();
        xhttp.open("POST", "displayComment.php", true);
        data = new FormData();
        data.append('post_id', <?php echo $_GET['post_id']; ?>)
        data.append('user_id', <?php echo $_SESSION['id'] ?>)
        // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function() {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var return_data = xhttp.responseText;
                document.getElementById('comment_data').innerHTML = return_data;
            }
        }
        xhttp.send(data)

        function addComment() {
            // alert(document.getElementById('comment').value);
            var comment = document.getElementById('comment').value;
            data = new FormData();
            data.append('comment', comment)
            data.append('post_id', <?php echo $_GET['post_id']; ?>)
            data.append('user_id', <?php echo $_SESSION['id'] ?>)
            xhttp.open("POST", "addComment.php", true);
            // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var return_data = xhttp.responseText;
                    document.getElementById('comment_data').innerHTML = return_data;
                }
            }
            xhttp.send(data)
            xhttp.open("POST", "displayComment.php", true);
            xhttp.send(data)
        }

        function deleteComment(comment_id) {
            var data = new FormData();
            data.append('comment_id', comment_id);
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "deleteComment.php", true);
            // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var return_data = xhttp.responseText;
                    document.getElementById('status').innerHTML = return_data;
                }
            }
            // var remove_div = document.getElementById(comment_id);
            // console.log(remove_div)
            // remove_div.parentNode.removeChild(remove_div);
            xhttp.send(data);

        }
    </script>
</body>

</html>