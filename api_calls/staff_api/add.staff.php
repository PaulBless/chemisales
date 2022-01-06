<?php

    require_once '../../db/db.php';

    ## clean inputs data
    $get_users_id = rtrim(htmlspecialchars($_POST['users_id']));
    $clean_fname_input = rtrim(htmlspecialchars($_POST['fname']));
    $clean_lname_input = rtrim(htmlspecialchars($_POST['lname']));
    $clean_mobile_input = rtrim(htmlspecialchars($_POST['mobile']));
    $get_user_role = rtrim(htmlspecialchars($_POST['user_role']));
    $get_user_status = rtrim(htmlspecialchars($_POST['user_status']));
    $get_user_firstname = ucwords($clean_fname_input);
    $get_user_lastname = ucwords($clean_lname_input);
    $get_user_mobile = $clean_mobile_input;
        
    ## Generate Login ID &  Passcode for User
    $get_random_username = "@".$clean_fname_input;
    $default_passcode = "password";
    ## hash the password
    $password_hash = password_hash($default_passcode, PASSWORD_DEFAULT);

    ## Run Database Query
    $addUser = mysqli_query($connect_db, "INSERT INTO `tbl_users` 
    (`uid`, `user_code`, `user_firstname`, `user_lastname`, `user_mobileno`, `user_loginid`, 
    `user_passcode`, `user_type`, `user_status`, `user_date_created`) 
    VALUES (NULL, '$get_users_id', '$get_user_firstname', '$get_user_lastname', '$get_user_mobile', 
    '$get_random_username', '$password_hash', '$get_user_role', '$get_user_status', CURRENT_TIMESTAMP)") or die(mysqli_error($connect_db));
            
    if($addUser){
        echo "success";
    }

?>