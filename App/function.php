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
        $conn = parent::connect_db();
        $total_tags = count($data_array['tag']);
        $total_category = count($data_array['category']);
        $sql = "INSERT INTO posts (author,category,tags,title,description) VALUES ('$author_id','$total_category','$total_tags','$data_array[title]','$data_array[description]')";
        $result = $conn->query($sql);
        $id = mysqli_insert_id($conn);
        foreach ($data_array['tag'] as $myTag) {
            $sql2 = "INSERT INTO post_tags (post_id,tag_id) VALUES ('$id','$myTag')";
            $result2 = $conn->query($sql2);
        }
        foreach ($data_array['category'] as $myCat) {
            $sql3 = "INSERT INTO post_category (post_id,category_id) VALUES ('$id','$myCat')";
            $result2 = $conn->query($sql3);
        }
        // return $result;
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

        $conn = parent::connect_db();
        $sql = "UPDATE posts SET  category='$data_array[category]', tags='$data_array[tags]',title='$data_array[title]',description='$data_array[description]' WHERE id='$post_id'";
        $result = $conn->query($sql);
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
}
