<?php


$categories = $obj->getCategory();
$tags = $obj->getTags();


?>
<form action="" method="POST" name="popForm" style="margin: 5px; padding:5px; width: 1000px;">
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