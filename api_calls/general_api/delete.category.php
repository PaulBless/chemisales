<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['delete']) {
		
		$pid = intval($_POST['delete']);
		$query = mysqli_query($connect_db, "DELETE FROM `tbl_medicine_categories` WHERE `tbl_medicine_categories`.`mcid` = '$pid'") or die(mysqli_error($connect_db));

		if ($query) {
			$response['status']  = 'success';
			$response['message'] = 'Medicine category deleted successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Ooops... Unable to delete category, process error...';
		}
		echo json_encode($response);
	}

?>