<?php

    header('Content-type: application/json; charset=UTF-8');

    require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['supplierId']) {
		
		$pid = intval($_POST['supplierId']);
        $getSupplierInfo = mysqli_query($connect_db,"SELECT * FROM tbl_suppliers WHERE supplier_id ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $supplierInfo = mysqli_fetch_array($getSupplierInfo);  

        $response['supplier_id']  = $supplierInfo['supplier_id'];
        $response['supplier_name']  = $supplierInfo['supplier_name'];
        $response['supplier_phone']  = $supplierInfo['supplier_phone'];
        $response['supplier_email']  = $supplierInfo['supplier_email'];
        $response['supplier_address']  = $supplierInfo['supplier_address'];
        // $response['supplier_timestamp']  = $supplierInfo['supplier_timestamp'];

		echo json_encode($response);
	}

    ?>
