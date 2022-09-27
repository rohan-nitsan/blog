<?php
$categories = $obj->getCategory();
$tags = $obj->getTags();
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin: 10px;">
    Launch demo modal
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="POST" style="margin: 5px; padding:5px;">
                <div class="row">
                    <div class="col col-md-12">
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
                    <div class="col col-md-12">
                        <h5>Description:</h5>
                        <textarea type="text" class="form-control" rows="5" name="description" id=""></textarea>
                    </div>
                </div>
                <div class="row" style="margin-top: 3px;">
                    <div class="col col-md-2">
                        <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col col-md-2">
                        <input type="submit" name="post" value="POST" class="btn btn-success" id="">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card-group" style="margin: 10px;">
    <?php
    while ($row = $postData->fetch_array()) {
    ?>
        <div class="card mb-3" style="width: 540px; margin: 10px; border: 2px solid black; padding: 5px; border-radius: 10px;">
            <table style="text-align: center;" cellpadding="3px">
                <tr>
                    <td colspan="2">
                        <h5 class="card-title"><?php echo $row['title']; ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style="height:200px; width: 200px;">
                        <img src="..." class="card-img" alt="...">
                    </td>
                    <td style="height:200px">
                        <p class="card-text" style=" text-align: justify;text-justify: inter-word;"><?php echo $row['description']; ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="card-text"><small class="text-muted"><?php echo $row['author']; ?></small></p>
                    </td>
                    <td>
                        <p class="card-text"><small class="text-muted"><?php echo $row['created']; ?></small></p>
                    </td>
                </tr>
            </table>
        </div>
    <?php
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['post'])) {
            $addPost = $obj->addPost($data['id'], $_POST);
        }
    }
    ?>
</div>