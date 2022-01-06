<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['reset']) {
		// default passcode
        $passcode = "changeme";
        $passcode_encrypted = password_hash($passcode, PASSWORD_DEFAULT);
		$request_id = intval($_POST['reset']);
		
        $query = mysqli_query($connect_db, "UPDATE `tbl_users` SET `user_passcode`='$passcode_encrypted' WHERE `tbl_users`.`uid` = '$request_id'") or die(mysqli_error($connect_db));

		if ($query) {
			$response['status']  = 'success';
			$response['message'] = 'Password Reset Successfully... <br>New Password is: <b class="text-danger">changeme</b>';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Ooops! Could not process password reset request...';
		}
		echo json_encode($response);
	}

?>