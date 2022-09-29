<?php

require_once '../Config/connection.php';
require_once '../App/function.php';
$tags = $obj->getTags();
?>
<div class="col col-md-10">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center" scope="col" colspan="3">Categories</th>
            </tr>
            <tr>
                <th scope="col" class="text-center">Name</th>
                <th scope="col" class="text-center" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                while ($row = $tags->fetch_assoc()) {
                ?>
                    <td><?php echo $row['name'] ?></td>
                    <td><a href="editTag.php?id=<?php echo $row['id']; ?>"><button class="btn btn-warning">Edit</button></a></td>
                    <td><a href="deleteTag.php?id=<?php echo $row['id']; ?>"><button class="btn btn-danger">Delete</button></a></td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>