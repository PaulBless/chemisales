<?php

    header('Content-type: application/json; charset=UTF-8');

    require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['categoryId']) {
		
		$pid = intval($_POST['categoryId']);
        $query_category = mysqli_query($connect_db,"SELECT * FROM `tbl_generic_names` WHERE `genericid` ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $categoryInfo = mysqli_fetch_array($query_category);  

        $response['genericid']  = $categoryInfo['genericid'];
        $response['generic_name']  = $categoryInfo['generic_name'];
        $response['generic_description']  = $categoryInfo['generic_description'];
        $response['generic_date_created']  = $categoryInfo['generic_date_created'];

		echo json_encode($response);
	}

    ?>
