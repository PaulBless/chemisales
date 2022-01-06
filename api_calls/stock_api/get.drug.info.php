<?php

    header('Content-type: application/json; charset=UTF-8');

    require_once '../../db/db.php';

	$response = array();    // array varaible to hold query results
	
	if ($_POST['productId']) {
		
		$pid = intval($_POST['productId']);

        // Get Details Using Joined Tables < tbl_medicines & tbl_temporary_stocks >
        // $get_drug_query = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` m INNER JOIN `tbl_temporary_stocks` ts ON m.`mid`=ts.`medicine_id` WHERE `mid` ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $get_drug_query = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE `tbl_medicines`.`mid` ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        
        
            // Fetch Results
            $medicine_details = mysqli_fetch_array($get_drug_query);  
            // Pass Results to Json 
            $response['mid']  = $medicine_details['mid'];
            $response['medicine_name']  = $medicine_details['medicine_name'];
            $response['medicine_code']  = $medicine_details['medicine_code'];
            $response['cost_price']  = $medicine_details['cost_price'];
            $response['selling_price']  = $medicine_details['selling_price'];
            
            // $response['available']  = $medicine_details['stock_level'];  
        

		echo json_encode($response);    // json data format
	}

?>