<?php

session_start();
require_once '../../db/db.php';

$users_id = $_SESSION['user'];

$get_current_password = mysqli_real_escape_string($connect_db, $_POST['current-password']); 
$get_new_password = mysqli_real_escape_string($connect_db, $_POST['new-password']); 
$get_confirm_password = mysqli_real_escape_string($connect_db, $_POST['confirm-password']);
$hashedPassword = password_hash($get_new_password,PASSWORD_DEFAULT); 


if($get_new_password !== $get_confirm_password){
    echo 'pass_error';
    return;
}
  

if(isset($_POST['current-password'])  && isset($_POST['new-password']) && isset($_POST['confirm-password'])){
            if($_COOKIE['c_r'] === 'p'){
                $selected_p_id = $users_id;
                $running_check = mysqli_query($connect_db,"SELECT * FROM `tbl_users` WHERE `uid`= '$selected_p_id' LIMIT 1")or die(mysqli_error($connect_db));
                if(mysqli_num_rows($running_check) > 0){
                    $get_users_info = mysqli_fetch_array($running_check);
                    $get_pass = $get_users_info['user_passcode'];

                  
                    if(password_verify($get_current_password,$get_pass)){
                        $run_update_query = mysqli_query($connect_db,"UPDATE `tbl_users` SET `user_passcode` = '$hashedPassword' WHERE `tbl_users`.`uid` = '$selected_p_id'")or die(mysqli_error($connect_db));
                        if($run_update_query){
                            echo "success";
                        }
                        
                    }else{
                        echo "incorrect";
                    }
                    
                }
            }else{
                echo "error";
            }

   
            
}

?>