<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['delete']) {
		
		$pid = intval($_POST['delete']);
		$query = mysqli_query($connect_db, "DELETE FROM `tbl_medicines` WHERE `tbl_medicines`.`mid` = '$pid'") or die(mysqli_error($connect_db));

		if ($query) {
			$response['status']  = 'success';
			$response['message'] = 'Medicine record deleted successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Ooops... Unable to delete medicine, process error...';
		}
		echo json_encode($response);
	}

?>