<?php

    require_once '../../db/db.php';
    ## clean incoming request data
    $get_users_id = rtrim(htmlspecialchars($_POST['users_idno']));
    $users_lastname = rtrim(htmlspecialchars($_POST['users_lname']));
    $users_firstname = rtrim(htmlspecialchars($_POST['users_fname']));
    $get_contact = rtrim(htmlspecialchars($_POST['users_mobile']));
    $get_priority = rtrim(htmlspecialchars($_POST['users_role']));
    $get_status = rtrim(htmlspecialchars($_POST['users_status']));
    $get_username = rtrim(htmlspecialchars($_POST['users_login']));
    $entered_pwd = 'changeme';  // new reset passcode 
    $action_status = rtrim(htmlspecialchars($_POST['action_status']));

    ## set db saving parameters for requested inputs
    $get_first_name = ucfirst($users_firstname);
    $get_last_name = ucwords($users_lastname);
    $get_password = $entered_pwd;

    if($action_status == 'reset'){
        ## hash the password
        ## before saving into db in query statement
        $encrypt_pwd = password_hash($entered_pwd, PASSWORD_DEFAULT);
        
        $reset_user_passcode = mysqli_query($connect_db,"UPDATE `tbl_users` SET `user_passcode` = '$encrypt_pwd' WHERE `tbl_users`.`uid` = '$get_users_id'") or die(mysqli_error($connect_db));
        
        if($reset_user_passcode){
            echo "success";
        }
    }

    if($action_status == 'update'){

        $update_user_info = mysqli_query($connect_db,"UPDATE `tbl_users` SET `user_firstname` = '$get_first_name', `user_lastname` = '$get_last_name', `user_mobileno` = '$get_contact', `user_loginid` = '$get_username',  `user_status` = '$get_status', `user_role` = '$get_priority' WHERE `tbl_users`.`uid` = '$get_users_id'") or die(mysqli_error($connect_db));
        
        if($update_user_info){
            echo "success";
        }
    }
?>
        
        
       

		
	