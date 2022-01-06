<?php

require_once '../../db/db.php';

        $get_product_id = $_POST['product_id'];
        $new_quantity = $_POST['new_quantity'];
        $new_expiry = $_POST['new_expiry'];
        $old_quantity = $_POST['old_quantity'];

        $new_quantity_available = intval($new_quantity + $old_quantity);
       

        $updateProduct = mysqli_query($connect_db,"UPDATE `tbl_products` SET `quantity_available` = '$new_quantity_available', 
        `expiry_date` = '$new_expiry' WHERE `tbl_products`.`tbl_products_id` = '$get_product_id'") or die(mysqli_error($connect_db));
        if($updateProduct){
            echo "success";
        }

		
	