<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['delete']) {
		
		$pid = intval($_POST['delete']);
		$query = mysqli_query($connect_db,"DELETE FROM `tbl_products` WHERE `tbl_products`.`tbl_products_id` = '$pid'") or die(mysqli_error($connect_db));

		if ($query) {
			$response['status']  = 'success';
			$response['message'] = 'Product Deleted Successfully ...';
		} else {
			$response['status']  = 'error';
			$response['message'] = 'Unable to delete Product ...';
		}
		echo json_encode($response);
	}