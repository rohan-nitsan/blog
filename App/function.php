<?php

require_once './Config/connection.php';

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
        $sql = "INSERT INTO posts (author,category,tags,title,description) VALUES ('$author_id','$data_array[category]','$data_array[tag]','$data_array[title]','$data_array[description]')";
        $result = $conn->query($sql);
    }
}
