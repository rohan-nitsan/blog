<?php

require_once '../Config/connection.php';
require_once '../App/function.php';
require_once '../author_nav.php';
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
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['id']; ?>">
                            Delete
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are ou sure you want to delete this tag?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <a href="deleteTag.php?id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>