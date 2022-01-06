<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['productId']) {
		
		$pid = intval($_POST['productId']);
        $getProductInfo = mysqli_query($connect_db,"SELECT * FROM tbl_products JOIN categories_tbl on tbl_products.product_category = categories_tbl.category_id where tbl_products.tbl_products_id ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $productInfo = mysqli_fetch_array($getProductInfo);  

        $response['product_id']  = $productInfo['tbl_products_id'];
        $response['product_name']  = $productInfo['product_name'];
        $response['product_quantity_box']  = $productInfo['quantity_available_box'];
        $response['product_quantity_pcs']  = $productInfo['quantity_available_pcs'];
        $response['product_category_id']  = $productInfo['product_category'];
        $response['cost_price_box']  = $productInfo['cost_price_box'];
        $response['cost_price_pcs']  = $productInfo['cost_price_pcs'];
        $response['selling_price_box']  = $productInfo['selling_price_box'];
        $response['selling_price_pcs']  = $productInfo['selling_price_pcs'];
        $response['expiry_date']  = $productInfo['expiry_date'];
     

		echo json_encode($response);
	}
    
    ?>