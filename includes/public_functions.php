<?php

function getNewPosts(){
    global $conn;
    $sql = "SELECT * FROM post ORDER BY created_at DESC LIMIT 5";
    $result = mysqli_query($conn, $sql);
    // fetch all posts as an associative array called $posts
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $posts;
}

function getPostBySlug($slug){
    global $conn;
    $escaped_slug = mysqli_real_escape_string($conn, $slug);
    $sql = "SELECT * FROM post WHERE slug='$escaped_slug'LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = mysqli_fetch_assoc($result);
        return $out;
    } else {
        return null;
}}

function getNewComments($id){
    global $conn;
    $sql = "SELECT * FROM comments WHERE post_id='$id' ORDER BY created_at DESC LIMIT 5";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);

}

function addNewComment($body, $username, $post_id){
    global $conn;
//    echo $post_id;
    $sql = "INSERT INTO comments (body, username, post_id) VALUES ('$body', '$username', '$post_id')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getNextCommentBySlug($slug){
    global $conn;
    $escaped_slug = mysqli_real_escape_string($conn, $slug);
    $sql = "SELECT * FROM post WHERE slug='$escaped_slug'LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = mysqli_fetch_assoc($result);
        $id = $out['id'];
        $sql = "SELECT * FROM post WHERE id>'$id' ORDER BY id ASC LIMIT 1";
        $resulto = mysqli_query($conn, $sql);
        if (mysqli_num_rows($resulto) > 0){
            $outo = mysqli_fetch_assoc($resulto);
            return $outo['slug'];
        }

    }  return $slug;
}

function getPrevCommentBySlug($slug){
    global $conn;
    $escaped_slug = mysqli_real_escape_string($conn, $slug);
    $sql = "SELECT * FROM post WHERE slug='$escaped_slug'LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = mysqli_fetch_assoc($result);
        $id = $out['id'];
        $sql = "SELECT * FROM post WHERE id<'$id' ORDER BY id DESC LIMIT 1";
        $resulto = mysqli_query($conn, $sql);
        if (mysqli_num_rows($resulto) > 0)
        {
            $outo = mysqli_fetch_assoc($resulto);
           // if ($outo['slug']=="")$outo['slug']="jestn";
           return $outo['slug'];

        }
    }
    return $slug;}

function getUserByUsername($username){
    global $conn;
    $sql = "SELECT * FROM users WHERE username='$username'LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $out = mysqli_fetch_assoc($result);
        return $out;
    } else {
        return null;
}
}

function changePasswordByUsername($username, $newPassword){
    global $conn;
    $pass = password_hash("$newPassword", PASSWORD_DEFAULT);
    $sql = "UPDATE users SET password='$pass' WHERE username='$username'";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        return "Password changed for - " . $username;
    } else {
        echo "Error";
    }
}

function makeSlug($string){
    $string = strtolower($string);
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return $slug;
}

function addPost($header, $body, $title, $image, $user_id){
    global $conn;
    $slug = makeSlug($title);
//    echo $post_id;
    $sql = "INSERT INTO post (header, body, slug, title, image, user_id) VALUES ('$header', '$body', '$slug', '$title', '$image', '$user_id')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    return "post added";
}

function getPostsByUserId($user_id){
    global $conn;
    $sql = "SELECT * FROM post WHERE user_id='$user_id' ORDER BY created_at DESC ";
    $result = mysqli_query($conn, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $posts;
}

function deletePostById($id){
    global $conn;
    $sql = "DELETE FROM post WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    return "post deleted";
}

function editBodyPostById($id, $body){
    global $conn;
    $sql = "UPDATE post SET body='$body' WHERE id='$id'";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute()) {
        return "Body edit for - " . $id;
    } else {
        echo "Error";
    }

}