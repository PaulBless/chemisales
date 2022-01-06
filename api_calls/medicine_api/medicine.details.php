<?php

    header('Content-type: application/json; charset=UTF-8');

    require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['medicineId']) {
		$pid = intval($_POST['medicineId']);
        // $query_medicine = mysqli_query($connect_db,"SELECT * from tbl_medicines m inner join tbl_medicine_categories mc on m.category_id=mc.mcid inner join tbl_generic_names gn on m.generic_id=gn.genericid WHERE `m`.`mid` ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $query_medicine = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` m inner join tbl_medicine_categories mc on m.category_id=mc.mcid inner join tbl_generic_names gn on m.generic_id=gn.genericid WHERE `m`.`mid` ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $medicineInfo = mysqli_fetch_array($query_medicine);  

        $response['mid']  = $medicineInfo['mid'];
        $response['medicine_name']  = $medicineInfo['medicine_name'];
        $response['medicine_code']  = $medicineInfo['medicine_code'];
        $response['medicine_description']  = $medicineInfo['medicine_description'];
        $response['brand_name']  = $medicineInfo['brand_name'];
        $response['package_size']  = $medicineInfo['package_size'];
        $response['cost_price']  = $medicineInfo['cost_price'];
        $response['selling_price']  = $medicineInfo['selling_price'];
        $response['med_cat_name']  = $medicineInfo['mcid'];
        $response['generic_name']  = $medicineInfo['genericid'];
        $response['dosage']  = $medicineInfo['dosage'];
        $response['batch']  = $medicineInfo['batch_no'];
        $response['medicine_expiry_date']  = $medicineInfo['medicine_expiry_date'];
        $response['manufacture_date']  = $medicineInfo['manufacture_date'];
        $response['created_on']  = $medicineInfo['created_on'];

		echo json_encode($response);
	}

    ?>
