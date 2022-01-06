<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['delete']) {
		
		$request_id = intval($_POST['delete']);
		$query = mysqli_query($connect_db, "DELETE FROM `tbl_users` WHERE `tbl_users`.`uid` = '$request_id'") or die(mysqli_error($connect_db));

		if ($query) {
			$response['status']  = 'success';
			$response['message'] = 'User record deleted successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Ooops! Could not delete user record...';
		}
		echo json_encode($response);
	}