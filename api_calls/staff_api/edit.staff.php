<?php

    require_once '../../db/db.php';
  
    ## clean incoming request data
    $get_users_id = rtrim(htmlspecialchars($_POST['users_idno']));
    $users_lastname = rtrim(htmlspecialchars($_POST['lastname']));
    $users_firstname = rtrim(htmlspecialchars($_POST['firstname']));
    $get_contact = rtrim(htmlspecialchars($_POST['mobileno']));
    $get_priority = rtrim(htmlspecialchars($_POST['users_role']));
    $get_status = rtrim(htmlspecialchars($_POST['users_status']));
    $get_username = rtrim(htmlspecialchars($_POST['users_loginid']));
    $get_usercode = rtrim(htmlspecialchars($_POST['users_code']));
    $entered_pwd = 'changeme';  // new reset passcode 
    $action_status = rtrim(htmlspecialchars($_POST['action_status']));

    ## set db saving parameters for requested inputs
    $get_first_name = ucfirst($users_firstname);
    $get_last_name = ucwords($users_lastname);
    $get_password = $entered_pwd;



    $update_user_info = mysqli_query($connect_db,"UPDATE `tbl_users` SET `user_firstname` = '$get_first_name',
     `user_lastname` = '$get_last_name', `user_mobileno` = '$get_contact', `user_loginid` = '$get_username',  
     `user_type` = '$get_priority', `user_status` = '$get_status' WHERE `tbl_users`.`uid` = '$get_users_id'") 
     or die(mysqli_error($connect_db));
        
    if($update_user_info){
        echo "success";
    }
    

?>
        
        
       

		
	