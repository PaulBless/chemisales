<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['delete']) {
		
		$pid = intval($_POST['delete']);	// get post id value
		$query = mysqli_query($connect_db, "DELETE FROM `tbl_generic_names` WHERE `tbl_generic_names`.`genericid` = '$pid'") or die(mysqli_error($connect_db));
		if ($query) { // Query Executed
			$response['status']  = 'success';
			$response['message'] = 'Generic record deleted successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Ooops... Unable to delete generic, process error...';
		}		

		echo json_encode($response);
	}

?>