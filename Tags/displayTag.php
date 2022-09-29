<?php

require_once '../Config/connection.php';
require_once '../App/function.php';
$tags = $obj->getTags();
?>
<table border="2px" cellspacing="2px" cellpadding="2px">
    <tr>
        <th>Name</th>
        <th colspan="2">Action</th>
    </tr>
    <tr>
        <?php
        while ($row = $tags->fetch_assoc()) {
        ?>
            <td><?php echo $row['name'] ?></td>
            <td><a href="editTag.php?id=<?php echo $row['id']; ?>"><button>Edit</button></a></td>
            <td><a href="deleteTag.php?id=<?php echo $row['id']; ?>"><button>Delete</button></a></td>
    </tr>
<?php } ?>
</table>