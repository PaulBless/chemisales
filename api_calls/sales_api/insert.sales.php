<?php
    error_reporting(E_ALL ^ E_NOTICE);

    require_once '../../db/db.php';

    // get sales number
    $sales_number = $_POST['sales-number'];
    
    if(!isset($_POST['medicine_id'])){
        echo "empty";
        return;
    }else{
          $get_product_names = $_POST['medicine_id'];
    };

    $get_available_qty = $_POST['available'];
    $get_quantities = $_POST['quantity'];
    $get_quantity_type = '1';
    $get_prices = $_POST['price'];
    $get_totals = $_POST['total'];
    $get_subtotal = $_POST['subTotal'];
    $get_total_after_tax = $_POST['totalAftertax'];
    $get_amount_paid = $_POST['amountPaid'];
    $get_amount_due = $_POST['amountDue'];
    $get_user = $_POST['user-id'];
    $tax_amount = 0;

    //variables
    $cost_price = 0;
    $selling_price = 0;
    $each_profit = 0;

    // validate total amount
  $validate_amount = ($get_subtotal+$get_tax_amount) - $get_discount_amount;


if ($get_amount_paid === "" || $get_amount_due === "" || $get_subtotal === "" ||($get_amount_paid < $validate_amount) ){
      echo "error";
  }else{
        ## Check Quantity with Stock limit

        ## count medicine size
        $get_length_of_items = sizeof($_POST["medicine_id"]);

        ## Loop through medicines to run db checks and save data
        for ($i=0; $i < $get_length_of_items ; $i++) { 
          
            $product_name = $get_product_names[$i];     ## get medicine name

            // data parameters for saving into db
            $medicine_qty = $get_quantities[$i];
            $medicine_price = $get_prices[$i];
            $medicine_total = $get_totals[$i];
            $available = $get_available_qty[$i];
            
            ## Calculate profit of each medicine_qty & Save into Sales Table
            $sql = "SELECT * FROM `tbl_medicines` WHERE mid='$product_name'";
            $get_detail = $connect_db->query($sql);
            $result = $get_detail->fetch_assoc();
            $cost_price = $result['cost_price'];
            $selling_price = result['selling_price'];
            $each_profit = ($selling_price - $cost_price);

             
            // quantity sale is more than stock limit, return error
            if($available < $medicine_qty){
                echo "less";
                return;
            }

            // Insert POS Query
            $sale_query = "INSERT INTO `tbl_sales` (`sales_id`, `sales_id_number`, `medicineId`, `medicineQty`, `medicinePrice`, `medicineTotal`,`quantity_type`,`profit`) VALUES (NULL, '$sales_number', '$product_name', '$medicine_qty', '$medicine_price', '$medicine_total','$get_quantity_type','$each_profit')";
            
            // $sale_query = "INSERT INTO `tbl_sales` (`sales_id`, `sales_id_number`, `medicineId`, `medicineQty`, `medicinePrice`, `medicineTotal`,`quantity_type`) VALUES (NULL, '$sales_number', '$product_name', '$medicine_qty', '$medicine_price', '$medicine_total','$get_quantity_type')";

            $add_sales = $connect_db->query($sale_query);

            // Reset Stock Qty
            $newStock = $available - $medicine_qty;

            // Deduct Stock Query 
            $deduction_query = mysqli_query($connect_db,"UPDATE `tbl_temporary_stocks` SET `stock_level` = '$newStock' WHERE `tbl_temporary_stocks`.`medicine_id`='$product_name'") or die(mysqli_error($connect_db));  

        } 
    
    if($deduction_query){   
        $stmt = "INSERT INTO `tbl_special_sales`(`ssid`,`sales_number`,`sales_subtotal`,`sales_total`,`amount_paid`,`sales_seller_id`, `tax_amount`,`sales_datetime`) VALUES (NULL,'$sales_number','$get_subtotal','$get_total_after_tax','$get_amount_paid','$get_user', '$tax_amount', CURRENT_TIMESTAMP)";
        $run_query = $connect_db->query($stmt);
        echo "success";
    }else{
        echo "failed";
    }
}


?>