<?php

// define connection settings
$host = "localhost";
$user = "root";
$password = "";
$database = "chemisales_db";


// establish connection to server
$connect_db = mysqli_connect($host,$user,$password,$database);

// Check connection
if (!$connect_db) {
    echo "<script>alert('Server Connection Failed!!')</script>";
    die("ERROR:: " . mysqli_connect_error());
}


?>