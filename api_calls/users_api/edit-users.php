<?php

require_once '../../db/db.php';
    ## clean incoming request data
        $get_users_id = rtrim(htmlspecialchars($_POST['users_id']));
        $users_lastname = rtrim(htmlspecialchars($_POST['lname']));
        $users_firstname = rtrim(htmlspecialchars($_POST['fname']));
        $get_contact = rtrim(htmlspecialchars($_POST['contact']));
        $get_priority = rtrim(htmlspecialchars($_POST['user_role']));
        $get_status = rtrim(htmlspecialchars($_POST['user_status']));
        $get_username = rtrim(htmlspecialchars($_POST['username']));
        $entered_pwd = 'change me';
        $action_status = rtrim(htmlspecialchars($_POST['action_status']));

        ## set db saving parameters for requested inputs
        $get_first_name = ucfirst($users_firstname);
        $get_last_name = ucwords($users_lastname);
        $get_password = $entered_pwd;

        if($action_status == 'reset'){
 ## hash the password
        $encrypt_pwd = password_hash($entered_pwd, PASSWORD_BCRYPT);
        
        ## NB: Remember to set password format to encrypted format value 
        ## before saving into db in query statement

        $getUserInfo = mysqli_query($connect_db,"UPDATE `pharmacists_table` SET `pharmacists_password` = '$encrypt_pwd' WHERE `pharmacists_table`.`pharmacists_id` = '$get_users_id'") or die(mysqli_error($connect_db));
        if($getUserInfo){
            echo "success";
        }
        }


        if($action_status == 'update'){

        $getUserInfo = mysqli_query($connect_db,"UPDATE `pharmacists_table` SET `pharmacists_firstname` = '$get_first_name', `pharmacists_lastname` = '$get_last_name', `pharmacists_username` = '$get_username', `pharmacists_contact` = '$get_contact', `pharmacists_status` = '$get_status', `pharmacists_role` = '$get_priority' WHERE `pharmacists_table`.`pharmacists_id` = '$get_users_id'") or die(mysqli_error($connect_db));
        if($getUserInfo){
            echo "success";
        }
        }
        
        
       

		
	