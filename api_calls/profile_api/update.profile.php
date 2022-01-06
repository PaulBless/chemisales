<?php

require_once '../../db/db.php';

$id = $_POST['id']; 
$usercode = $_POST['userid']; 
$firstname = $_POST['firstname']; 
$lastname = $_POST['lastname']; 
$mobile = $_POST['phonenumber']; 
$username = $_POST['username']; 
$get_lastname = ucwords($lastname);
$get_firstname = ucwords($firstname);
  

$run_update_query = mysqli_query($connect_db,"UPDATE `tbl_users` SET `user_firstname` = '$get_firstname', `user_lastname` = '$get_lastname', `user_mobileno`='$mobile', `user_loginid`='$username'  WHERE `tbl_users`.`uid` = '$id'")or die(mysqli_error($connect_db));

if($run_update_query){
    echo "success";
}
            


?>