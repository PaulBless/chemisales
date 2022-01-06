<?php

require_once '../../db/db.php';

        ## clean form inputs
        $clean_input_product_name = rtrim(htmlspecialchars($_POST['product_name']));
        $get_product_id = rtrim(htmlspecialchars($_POST['product_id']));
        $product_name = ucwords($clean_input_product_name);
        $quantity_available_box = rtrim(htmlspecialchars($_POST['quantity_available_box']));
        $quantity_available_pcs = rtrim(htmlspecialchars($_POST['quantity_available_pcs']));
        $cost_price_box =rtrim(htmlspecialchars($_POST['cost_price_box'])) ;
        $cost_price_pcs =rtrim(htmlspecialchars($_POST['cost_price_pcs'])) ;
        $selling_price_box = rtrim(htmlspecialchars($_POST['selling_price_box']));
        $selling_price_pcs = rtrim(htmlspecialchars($_POST['selling_price_pcs']));
        $expiry = $_POST['expiry'];
        $product_category =rtrim(htmlspecialchars($_POST['product_category'])) ;

        $updateProduct = mysqli_query($connect_db,"UPDATE `tbl_products` SET  
        `product_name` = '$product_name', 
        `product_category` = '$product_category', 
        `selling_price_box` = '$selling_price_box', 
        `selling_price_pcs` = '$selling_price_pcs', 
        `cost_price_box` = '$cost_price_box',
        `cost_price_pcs` = '$cost_price_pcs',
        `quantity_available_box` = '$quantity_available_box', 
        `quantity_available_pcs` = '$quantity_available_pcs', 
        `expiry_date` = '$expiry' WHERE `tbl_products`.`tbl_products_id` = '$get_product_id'") or die(mysqli_error($connect_db));
        if($updateProduct){
            echo "success";
        }

		
	