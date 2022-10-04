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

        #editor {
            height: 300px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="../Assets/CSS/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include stylesheet -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
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
                            <form action="" method="POST" style="margin: 5px; padding:5px; width: 1000px; height:auto;">
                                <div class="row">
                                    <div class="col col-md-10">
                                        <h5>Title:</h5>
                                        <input type="text" class="form-control" name="title" id="title">
                                        <p class="error" id="title_error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-md-12">
                                        <h5>Category:</h5>
                                        <select name="category[]" id="category" class="multiple-select col col-md-10" multiple>
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
                                        <select name="tag[]" id="tag" class="multiple-select col col-md-10" multiple>
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
                                        <input name="description" type="hidden" id="description">
                                        <div id="editor" name="description">

                                        </div>
                                        <p class="error" id="description_error"></p>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 3px;">
                                    <div class="col col-md-2">
                                        <a href="../index.php"><button type="button" class="btn btn-primary">Back</button></a>
                                    </div>
                                    <div class="col col-md-2">
                                        <input type="button" name="post" onclick="submit_data()" value="POST" class="btn btn-success">
                                    </div>
                                </div>
                            </form>
                            <div id="status"></div>
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
    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],
            [{
                'list': 'ordered'
            }, {
                'list': 'bullet'
            }],
            [{
                'script': 'sub'
            }, {
                'script': 'super'
            }], // superscript/subscript
            [{
                'indent': '-1'
            }, {
                'indent': '+1'
            }], // outdent/indent
            [{
                'size': ['small', false, 'large', 'huge']
            }], // custom dropdown
            ['image'], // add's image support
            [{
                'font': []
            }],
            [{
                'align': []
            }],

            ['clean'] // remove formatting button
        ];
        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions,
            },
            theme: 'snow'
        });
    </script>
</body>

</html>

<script>
    function submit_data() {
        var data = new FormData();
        data.append('title', document.getElementById('title').value);
        data.append('category', $("#category").val());
        data.append('tag', $("#tag").val());
        data.append('description', quill.root.innerHTML);
        if (document.getElementById('title').value == "") {
            document.getElementById('title_error').innerText = '* Please Enter Title';
        } else if (document.getElementById('category').value.length == 0) {
            document.getElementById('category_error').innerText = '* Please Select Category';
        } else if (document.getElementById('tag').value.length == 0) {
            document.getElementById('tag_error').innerText = '* Please Select Tag';
        } else if (quill.root.innerText == "") {
            document.getElementById('description_error').innerText = '* Please Enter Description';
        } else {
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST", "newPost.php", true);
            // xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.onreadystatechange = function() {
                if (xhttp.readyState == 4 && xhttp.status == 200) {
                    var return_data = xhttp.responseText;
                    document.getElementById('status').innerHTML = return_data;
                }
            }
            xhttp.send(data);
            window.location.href = '../index.php';
        }



    }
</script>