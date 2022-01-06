<?php

// session_start();

// header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

$response = array();

    if(isset($_POST['id']) && !empty($_POST['id'])){
        $did = $_POST['id'];
        $sql = "SELECT * FROM `product` WHERE `id` = '$did'";
        $query = mysqli_query($connect_db, $sql) or die(mysqli_error());
        $row = mysqli_fetch_assoc($query);

        echo json_encode($row);	// pass results to json format
    }


	
    if ($_POST['productId']) {
		
		// $pid = intval($_POST['productId']);
        // // $getProductInfo = mysqli_query($connect_db,"SELECT * FROM product JOIN categories_tbl on tbl_products.product_category = categories_tbl.category_id where tbl_products.tbl_products_id ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        // $getProductInfo = mysqli_query($connect_db,"SELECT * FROM product WHERE id ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        // $productInfo = mysqli_fetch_array($getProductInfo);  

        // $response['id']  = $productInfo['id'];
        // $response['price']  = $productInfo['price'];
        // $response['name']  = $productInfo['name'];
        // $response['code']  = $productInfo['code'];

		// echo json_encode($response);
	}
?>