<?php
require_once '../Config/connection.php';
require_once '../App/function.php';
$obj = new Users();
?>
<div class="row d-flex justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-0 border" style="background-color: #f0f2f5;">
            <div class="card-body" id="comment_data">
                <?php
                $comment_data = $obj->getComment($_POST['post_id']);
                while ($row = $comment_data->fetch_assoc()) {
                ?>
                    <div class="card mb-4">
                        <div class="card-body" style="margin-bottom: 0;">
                            <p><?php echo $row['description'];
                                ?></p>

                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <p class="small mb-0 ms-2"><?php echo $row['user'];
                                                                ?></p>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>