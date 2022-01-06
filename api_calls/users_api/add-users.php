<?php

require_once '../../db/db.php';

## clean incoming post data
$get_users_id = rtrim(htmlspecialchars($_POST['users_id']));
$clean_firstname = rtrim(htmlspecialchars($_POST['fname']));
$clean_lastname = rtrim(htmlspecialchars($_POST['lname']));
$get_contact = rtrim(htmlspecialchars($_POST['contact']));
$get_priority = rtrim(htmlspecialchars($_POST['user_role']));
$get_status = rtrim(htmlspecialchars($_POST['user_status']));
$get_username = rtrim(htmlspecialchars($_POST['username']));
$password = rtrim(htmlspecialchars($_POST['password']));

## variables to set input parameters for saving into db
$get_first_name = ucfirst($clean_firstname);
$get_last_name = ucwords($clean_lastname);

## hash the password
$password_hash = password_hash($password, PASSWORD_BCRYPT);

## Remember to set & change password value to password encrypted format {$password_hash} 
## variable before for storing into db in the query statement
$get_password = $password;  

    if($get_priority === '1'){
        $addUser = mysqli_query($connect_db,"INSERT INTO `users_table` (`users_table_id`, 
        `users_table_role`, 
        `users_username`, 
        `users_password`, 
        `users_profile`, 
        `users_timestamp`) VALUES (NULL, 
        '$get_priority', '$get_username', 
        '$password_hash', 
        'default.png', CURRENT_TIMESTAMP)")or die(mysqli_error($connect_db));
    }else{
            $addUser = mysqli_query($connect_db,"INSERT INTO 
            `pharmacists_table` (`pharmacists_id`, 
            `pharmacists_firstname`, 
            `pharmacists_lastname`, 
            `pharmacists_username`, 
            `pharmacists_contact`, 
            `pharmacists_status`, 
            `pharmacists_user_id`, 
            `pharmacists_role`, `pharmacists_password`, 
            `pharmacists_timestamp`,`profile`) VALUES (NULL, '$get_first_name', 
            '$get_last_name', '$get_username', '$get_contact', '$get_status', 
            '$get_users_id', '$get_priority', '$password_hash', 
            CURRENT_TIMESTAMP,'default.png')") or die(mysqli_error($connect_db));
    }

       
    if($addUser){
        echo "success";
    }

?>