<?php

class Users extends Database
{

    function login($email, $password)
    {
        $conn = parent::connect_db();
        $pwd = $password;
        $sql = "SELECT * FROM users WHERE email='$email' && password='$pwd'";
        $result = $conn->query($sql);
        return $result;
    }
    function select($email)
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        $data = $result->fetch_array();
        return $data;
    }
    function getCategory()
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);
        return $result;
    }
    function getTags()
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM tags";
        $result = $conn->query($sql);
        return $result;
    }
    function getPosts()
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $result = $conn->query($sql);
        return $result;
    }
    function addPost($author_id, $data_array)
    {
        $category_array = explode(",", $data_array['category']);
        $tag_array = explode(',', $data_array['tag']);
        $conn = parent::connect_db();
        $total_tags = count($tag_array);
        $total_category = count($category_array);
        $sql = "INSERT INTO posts (author,category,tags,title,description) VALUES ('$author_id','$total_category','$total_tags','$data_array[title]','$data_array[description]')";
        $result = $conn->query($sql);
        $id = mysqli_insert_id($conn);
        foreach ($tag_array as $myTag) {
            $sql2 = "INSERT INTO post_tags (post_id,tag_id) VALUES ('$id','$myTag')";
            $result2 = $conn->query($sql2);
        }
        foreach ($category_array as $myCat) {
            $sql3 = "INSERT INTO post_category (post_id,category_id) VALUES ('$id','$myCat')";
            $result2 = $conn->query($sql3);
        }
    }
    function getPostData($post_id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM `posts` WHERE `id`='$post_id'";
        $result = $conn->query($sql);
        return $result;
    }
    function updatePost($post_id, $data_array)
    {
        $category_array = explode(",", $data_array['category']);
        $tag_array = explode(',', $data_array['tag']);
        $conn = parent::connect_db();
        $sql2 = "DELETE FROM post_tags WHERE post_id='$post_id'";
        $conn->query($sql2);
        $sql2 = "DELETE FROM post_category WHERE post_id='$post_id'";
        $conn->query($sql2);
        $tag_count = $category_count = 0;
        foreach ($tag_array as $myTag) {
            $sql4 = "INSERT INTO post_tags (post_id,tag_id) VALUES ('$post_id','$myTag')";
            $conn->query($sql4);
            $tag_count += 1;
        }
        foreach ($category_array as $myCat) {
            $sql5 = "INSERT INTO post_category (post_id,category_id) VALUES ('$post_id','$myCat')";
            $conn->query($sql5);
            $category_count += 1;
        }
        $sql = "UPDATE posts SET  category='$category_count', tags='$tag_count',title='$data_array[title]',description='$data_array[description]' WHERE id='$post_id'";

        $conn->query($sql);
    }
    function addCategory($name)
    {
        $conn = parent::connect_db();
        $sql = "INSERT INTO categories (name) VALUES ('$name')";
        $result = $conn->query($sql);
        return $result;
    }
    function addTags($name)
    {
        $conn = parent::connect_db();
        $sql = "INSERT INTO tags (name) VALUES ('$name')";
        $result = $conn->query($sql);
        return $result;
    }
    function updateTag($id, $name)
    {
        $conn = parent::connect_db();
        $sql = "UPDATE tags SET name='$name' WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    function getTag($id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM tags WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    function updateCategory($id, $name)
    {
        $conn = parent::connect_db();
        $sql = "UPDATE categories SET name='$name' WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    function getCat($id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM categories WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }
    function deleteTag($id)
    {
        $conn = parent::connect_db();
        $sql = "DELETE FROM tags WHERE id='$id'";
        $result = $conn->query($sql);
    }
    function deleteCat($id)
    {
        $conn = parent::connect_db();
        $sql = "DELETE FROM categories WHERE id='$id'";
        $result = $conn->query($sql);
    }
    function deletePost($post_id)
    {
        $conn = parent::connect_db();
        $sql = "DELETE FROM posts WHERE id='$post_id'";
        $result = $conn->query($sql);
    }
    function myTags($post_id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT tag_id FROM post_tags WHERE post_id='$post_id'";
        $result = $conn->query($sql);
        return $result;
    }
    function myCategory($post_id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT category_id FROM post_category WHERE post_id='$post_id'";
        $result = $conn->query($sql);
        return $result;
    }
    function validation_error($id, $msg)
    {
        echo "
        <script>
            document.getElementById('$id').innerText='$msg';
        </script>
    ";
    }
}
