<?php

session_start();    // start session
require_once 'db/db.php';   // include database config

## Check if User logged_in
if(!isset($_SESSION['user']) || trim($_SESSION['user']) == '' || !isset($_SESSION['isloggedin']) || !isset($_COOKIE['id'])){
    echo "<script>window.location.href='index.php'</script>";
}else{
    
    // Login Success: Get Credentials From Database
    $sql = "SELECT * FROM `tbl_users` WHERE `uid` = '".$_SESSION['user']."'";
    $query = $connect_db->query($sql);
    $user_details = $query->fetch_assoc();
    $firstname = $user_details['user_firstname']; // Get Users Firstname
    $lastname = $user_details['user_lastname']; // Get Users Lastname
    $phone = $user_details['user_mobileno'];    // Get Users Phone Number
    $userid = $user_details['user_code'];   // Get Users Code
    $loginid = $user_details['user_loginid'];   // Get Users Login-Name
    $id = $user_details['uid']; // Get Users ID
    $users_role = $user_details['user_type']; // Get Users Role
    $users_fullname = $firstname.' '. $lastname; // Set FullName of Login User

    
}


?>

