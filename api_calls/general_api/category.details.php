<?php

    header('Content-type: application/json; charset=UTF-8');

    require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['categoryId']) {
		
		$pid = intval($_POST['categoryId']);
        $query_category = mysqli_query($connect_db,"SELECT * FROM `tbl_medicine_categories` WHERE `mcid` ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $categoryInfo = mysqli_fetch_array($query_category);  

        $response['mcid']  = $categoryInfo['mcid'];
        $response['med_cat_name']  = $categoryInfo['med_cat_name'];
        $response['med_cat_comment']  = $categoryInfo['med_cat_comment'];

		echo json_encode($response);
	}

    ?>
