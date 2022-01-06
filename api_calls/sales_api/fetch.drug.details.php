<?php

    header('Content-type: application/json; charset=UTF-8');

    require_once '../../db/db.php';

	$response = array();    // array varaible to hold query results
	
	if ($_POST['productId']) {
		
		$pid = intval($_POST['productId']);
        // $getDrugInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE `tbl_medicines`.`mid` ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $getDrugInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` m, `tbl_temporary_stocks` ts WHERE ts.`medicine_id`=m.`mid` AND m.`mid`='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $productInfo = mysqli_fetch_array($getDrugInfo);  

        $response['mid']  = $productInfo['mid'];
        $response['medicine_name']  = $productInfo['medicine_name'];
        $response['selling_price']  = $productInfo['selling_price'];
        $response['medicine_code']  = $productInfo['medicine_code'];
        $response['medicine_description']  = $productInfo['medicine_description'];
        $response['stock_level']  = $productInfo['stock_level'];

		echo json_encode($response);
	}

?>