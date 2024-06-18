<?php


const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'teraz';
const DB_NAME = 'blog_lite';

// connect to database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$conn) {
    die("Error connecting to database: " . mysqli_connect_error());
}?>