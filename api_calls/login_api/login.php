<?php
session_start();
error_reporting(1);
require_once '../../db/db.php';

$get_users_loginid = mysqli_real_escape_string($connect_db,$_POST['username']);
$get_users_password = mysqli_real_escape_string($connect_db,$_POST['password']);



$check_login_user = mysqli_query($connect_db, "SELECT * FROM `tbl_users` WHERE `user_loginid`='$get_users_loginid' LIMIT 1") or die(mysqli_error($connect_db));
    if(mysqli_num_rows($check_login_user) > 0){
        $get_details = mysqli_fetch_array($check_login_user);
        if($get_details['user_status'] === '1'){
            echo 'locked';  // error for access denied <Account Locked>
        }else{      
            $users_id = $get_details['uid'];       // get & set users id
            $users_role = $get_details['user_type'];    // get & set users role
            $users_fname = $get_details['user_firstname'];    // get & set users firstname
            $users_lname = $get_details['user_lastname'];     //get & set users lastname
            $users_full_name = $users_fname.' '.$users_lname;   // get & set fullname
            $db_harshed_password = $get_details['user_passcode'];   // get stored hashed passcode
            $users_login_name = $get_details['user_loginid'];   // get & set login name

            if(password_verify($get_users_password,$db_harshed_password)){
                // create and set cookies
                setcookie("role", $users_role, time() + (86400 * 30), '/');
                setcookie("fullname", $users_full_name, time() + (86400 * 30), '/');
                setcookie("id", $users_id, time() + (86400 * 30), '/');
                setcookie("username", $users_login_name, time() + (86400 * 30), '/');

                // creaate session
                session_regenerate_id();
                $_SESSION['isloggedin'] = TRUE;
                $_SESSION['user'] = $users_id;
                $_SESSION['last_login_timestamp'] = time(); // time login


                echo "success"; // for valid success message

                }else{
                    echo 'error';   // error for wrong password
                    return;
                }
           
        }
    }else{
        echo "invalid"; // error for invalid username
    }



?>