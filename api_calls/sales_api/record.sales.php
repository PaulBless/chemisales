<?php

    session_start();
    error_reporting(E_ALL ^ E_NOTICE);

    require_once '../../db/db.php';

    $user_id = "";
    if(isset($_SESSION['user']))
    $user_id = $_SESSION['user'];
    
    $sales_number = $_POST['sales_number'];
        
        
    if(!isset($_POST['medicine_id'])){
        echo "empty";
        return;
    }else{
          $get_product_names = $_POST['medicine_id'];
    };

    $get_availables = $_POST['available'];
    $get_quantities = $_POST['quantity'];
    $get_quantity_type = '1';
    $get_prices = $_POST['price'];
    $get_totals = $_POST['total'];
    $get_subtotal = $_POST['subTotal'];
    $get_tax_rates = $_POST['taxRate'];
    $get_tax_amount = $_POST['taxAmount'];
    $get_discount_rate = $_POST['discountRate'];
    $get_discount_amount = $_POST['discountAmount'];
    $get_total_after_tax = $_POST['totalAftertax'];
    $get_amount_paid = $_POST['amountPaid'];
    $get_amount_due = $_POST['amountDue'];
    $get_user = $_POST['user-id'];


    if($get_tax_amount == "" || $get_discount_amount == ""){
        $get_tax_amount = 0;
        $get_discount_amount = 0;
        $get_discount_rate = 0;
        $get_tax_rates = 0;
    }


    $validate_amount = ($get_subtotal+$get_tax_amount) - $get_discount_amount;


  if ($get_amount_paid === "" || $get_amount_due === "" || $get_subtotal === "" ||($get_amount_paid < $validate_amount) ){
      echo "error";
  }else{
     
        ## count medicine size
        $get_length_of_items = sizeof($_POST["medicine_id"]);

        ## Loop through medicines to run db checks and save data
        for ($i=0; $i < $get_length_of_items ; $i++) { 
          
            $product_name = $get_product_names[$i];     ## get medicine name

            // data parameters for saving into db
            $medicine_qty = $get_quantities[$i];
            $medicine_price = $get_prices[$i];
            $medicine_total = $get_totals[$i];
            $available = $get_availables[$i]; 

            // Insert POS Query
            $sale_query = "INSERT INTO `tbl_sales` (`sales_id`, `sales_id_number`, `medicineId`, `medicineQty`, `medicinePrice`, `medicineTotal`,`quantity_type`) VALUES (NULL, '$get_sales_number', '$product_name', '$medicine_qty', '$medicine_price', '$medicine_total','$get_quantity_type')";

            $add_sales = $connect_db->query($sale_query);

            // Reset Stock Qty
            $newStock = $available - $medicine_qty;

            // Deduct Stock Query 
            $deduction_query = mysqli_query($connect_db,"UPDATE `tbl_temporary_stocks` SET `stock_level` = '$newStock' WHERE `tbl_temporary_stocks`.`medicine_id`='$product_name'") or die(mysqli_error($connect_db));  

        }   // End foreach
      
        ## 3: Update Stocks 
        if($deduction_query){
            
            ## 1: Record Each Sale
            $insert_each_sales = mysqli_query($connect_db, "INSERT INTO `tbl_sales_test` (`each_sales_id`, `sales_id_number`, `tax_rate`, `tax_amount`, `discount_rate`, `discount_amount`, `sales_subtotal`, `sales_total`, `sales_seller`, `amount_paid`, `sales_timestamp`) VALUES (NULL, '$get_sales_number', '$get_tax_rates', '$get_tax_amount', '$get_discount_rate', '$get_discount_amount', '$get_subtotal', '$get_total_after_tax', '$get_user','$get_amount_paid', CURRENT_TIMESTAMP)")or die(mysqli_error($connect_db));


            echo 'success';

        }else{
            echo 'failed';
        }

  }