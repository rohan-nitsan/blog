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
        $categories = "";
        foreach ($data_array['category'] as $cat) {
            $categories .= $cat . ",";
        }
        $tags = "";
        foreach ($data_array['tag'] as $myTag) {
            $tags .= $myTag . ",";
        }
        $conn = parent::connect_db();
        $sql = "INSERT INTO posts (author,category,tags,title,description) VALUES ('$author_id','$categories','$tags','$data_array[title]','$data_array[description]')";
        $result = $conn->query($sql);
        return $result;
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
        print_r($data_array['category']);
        $categories = "";
        foreach ($data_array['category'] as $cat) {
            $categories .= $cat . ",";
        }
        $tags = "";
        foreach ($data_array['tag'] as $myTag) {
            $tags .= $myTag . ",";
        }
        $conn = parent::connect_db();
        $sql = "UPDATE posts SET  category='$categories', tags='$tags',title='$data_array[title]',description='$data_array[description]' WHERE id='$post_id'";
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
