<?php

class Users extends Database
{
    /*
    * This function is used to authenticate user.
    * If they register then it can return row else return nothing.
    * It takes email and password for check user in validate or not.
    */
    function login($email, $password)
    {
        $conn = parent::connect_db();
        $pwd = $password;
        $sql = "SELECT * FROM users WHERE email='$email' && password='$pwd'";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to fetch user data based on email after login.
    */
    function select($email)
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);
        $data = $result->fetch_array();
        return $data;
    }

    /*
    * This function is used to fetch all categories.
    */
    function getCategory()
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to fetch all tags.
    */
    function getTags()
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM tags";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to fetch all posts.
    */
    function getPosts()
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM posts ORDER BY id DESC";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to create new post.
    */
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

    /*
    * This function is used to fetch particular post data.
    */
    function getPostData($post_id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM `posts` WHERE `id`='$post_id'";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to update post data.
    */
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

    /*
    * This function is used to add new category.
    */
    function addCategory($name)
    {
        $conn = parent::connect_db();
        $sql = "INSERT INTO categories (name) VALUES ('$name')";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to add new tag.
    */
    function addTags($name)
    {
        $conn = parent::connect_db();
        $sql = "INSERT INTO tags (name) VALUES ('$name')";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to update tag.
    */
    function updateTag($id, $name)
    {
        $conn = parent::connect_db();
        $sql = "UPDATE tags SET name='$name' WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to fetch all tags.
    */
    function getTag($id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM tags WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to update category.
    */
    function updateCategory($id, $name)
    {
        $conn = parent::connect_db();
        $sql = "UPDATE categories SET name='$name' WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to fetch all category.
    */
    function getCat($id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT * FROM categories WHERE id='$id'";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to delete tag.
    */
    function deleteTag($id)
    {
        $conn = parent::connect_db();
        $sql = "DELETE FROM tags WHERE id='$id'";
        $result = $conn->query($sql);
    }

    /*
    * This function is used to delete category.
    */
    function deleteCat($id)
    {
        $conn = parent::connect_db();
        $sql = "DELETE FROM categories WHERE id='$id'";
        $result = $conn->query($sql);
    }

    /*
    * This function is used to delete post.
    */
    function deletePost($post_id)
    {
        $conn = parent::connect_db();
        $sql = "DELETE FROM posts WHERE id='$post_id'";
        $result = $conn->query($sql);
    }

    /*
    * This function is used to fetch particular post tags.
    */
    function myTags($post_id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT tag_id FROM post_tags WHERE post_id='$post_id'";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to fetch particular posts category.
    */
    function myCategory($post_id)
    {
        $conn = parent::connect_db();
        $sql = "SELECT category_id FROM post_category WHERE post_id='$post_id'";
        $result = $conn->query($sql);
        return $result;
    }

    /*
    * This function is used to validate fields.
    */
    function validation_error($id, $msg)
    {
        echo "
        <script>
            document.getElementById('$id').innerText='$msg';
        </script>
    ";
    }

    function filterPost($data)
    {
        $conn = parent::connect_db();
        // if ($data['text'] and $data['category'] and $data['tag']) {
        // }
        if ($data['text'] and $data['category']) {
            $sql = "SELECT * FROM (`posts` INNER JOIN post_category ON post_category.post_id=posts.id) WHERE (post_category.category_id='$data[category]' and ((`description` LIKE '%$data[text]%') or (`title` LIKE '%$data[text]%'))) ORDER BY posts.id DESC";
            $result = $conn->query($sql);
            return $result;
        }
        if ($data['text'] and $data['tag']) {
            $sql = "SELECT * FROM (`posts` INNER JOIN post_tags ON post_tags.post_id=posts.id) WHERE (post_tags.tag_id='$data[tag]' and ((`description` LIKE '%$data[text]%') or (`title` LIKE '%$data[text]%'))) ORDER BY posts.id DESC";
            $result = $conn->query($sql);
            return $result;
        }
        // if ($data['category'] and $data['tag']) {
        // }
        if ($data['text']) {
            $sql = "SELECT * FROM posts WHERE ((`description` LIKE '%$data[text]%') or (`title` LIKE '%$data[text]%')) ORDER BY id DESC";
            $result = $conn->query($sql);
            return $result;
        }
        if ($data['category']) {
            $sql = "SELECT * FROM (`posts` INNER JOIN post_category ON post_category.post_id=posts.id) WHERE (post_category.category_id='$data[category]') ORDER BY posts.id DESC";
            $result = $conn->query($sql);
            return $result;
        }

        if ($data['tag']) {
            $sql = "SELECT * FROM (`posts` INNER JOIN post_tags ON post_tags.post_id=posts.id) WHERE (post_tags.tag_id='$data[tag]') ORDER BY posts.id DESC";
            $result = $conn->query($sql);
            return $result;
        }
    }
}
