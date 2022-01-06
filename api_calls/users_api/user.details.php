<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['productId']) {
		
		$pid = intval($_POST['productId']);
        $getUserInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_users` JOIN `tbl_account_status` ON `tbl_users`.`user_status` = `tbl_account_status`.`asid` JOIN `tbl_roles` ON `tbl_users`.`user_type` = `tbl_roles`.`rid` WHERE `uid`='$pid' LIMIT 1")OR DIE(mysqli_error($connect_db));
        $userInfo = mysqli_fetch_array($getUserInfo);  

        $response['uid']  = $userInfo['uid'];
        $response['user_code']  = $userInfo['user_code'];
        $response['user_firstname']  = $userInfo['user_firstname'];
        $response['user_lastname']  = $userInfo['user_lastname'];
        $response['user_mobileno']  = $userInfo['user_mobileno'];
        $response['role_name']  = $userInfo['role_name'];
        $response['status_name']  = $userInfo['status_name'];
        $response['user_loginid']  = $userInfo['user_loginid'];
        $response['user_passcode']  = $userInfo['user_passcode'];
     

		echo json_encode($response);
	}

?>