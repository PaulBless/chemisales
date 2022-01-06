<?php
session_start();
require_once '../../db/db.php';

$get_loggedin_user_id = $_POST['uid']; 
$get_current_password = $_POST['current_password']; 
$get_new_password = $_POST['new_password']; 
$get_confirm_password = $_POST['confirm_password'];  
$newHashPassword = password_hash($get_new_password,PASSWORD_DEFAULT);

// get logged session id
$userId = "";
if(isset($_SESSION['user']) && isset($_POST['uid']) ){ 
    $userId = $_SESSION['user'];

            // get users info
            $running_check = mysqli_query($connect_db,"SELECT * FROM `tbl_users` WHERE `uid`= '$get_loggedin_user_id' LIMIT 1")or die(mysqli_error($connect_db));
            if(mysqli_num_rows($running_check) > 0){
                $get_users_info = mysqli_fetch_array($running_check);
                $get_passcode = $get_users_info['user_passcode'];

                    // validate entered password with the stored password in database table
                    if(password_verify($get_current_password,$get_passcode) ){
                        // password valid, proceed to reset users requested new password  
                        $run_update_query = mysqli_query($connect_db, "UPDATE `tbl_users` SET 
                        `user_passcode` = '$newHashPassword' WHERE `tbl_users`.`uid` = '$userId'")or die(mysqli_error($connect_db));
                            
                            if($run_update_query){
                                echo "success";
                            }
                    }else{
                            echo "incorrect";
                        }
                }else{
                    echo "error";
                }
     
}

?>