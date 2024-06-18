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
