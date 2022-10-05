<?php
session_start();
if (!$_SESSION['email']) {
    header("location:login.php");
}
if ($_SESSION['email'] && $_SESSION['role']) {
    require_once 'Config/connection.php';
    require_once './App/function.php';
    require_once 'header.php';
    $obj = new Users();
    $data = $obj->select($_SESSION['email']);


    if ($_SESSION['role'] == 2) {
        require_once 'author_nav.php';
        $obj = new Users();
        $postData = $obj->getPosts();
        require_once 'Posts/displayPost.php';
    }
    if ($_SESSION['role'] == 3) {
        // require_once 'user_nav.php';
        $obj = new Users();
        $postData = $obj->getPosts();
        require_once 'Posts/displayPost.php';
    }
?>
    
<?php
    require_once 'footer.php';
}

?>