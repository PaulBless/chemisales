<?php
    session_start();
    require_once '../../db/db.php';

    $get_sales_number = $_POST['sales_number'];
        
    if(!isset($_POST['medicine_id'])){
        echo "empty";
        return;
    }else{
          $get_medicine_names = $_POST['medicine_id'];
    };

    $get_quantities = $_POST['quantity'];
    $get_quantity_type = '0';
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
    
    $user_id = "";
    if(isset($_SESSION['user'])) 
        $user_id = $_SESSION['user'];
        
    // Set Default Values for Tax & Discount
    if($get_tax_amount == "" || $get_discount_amount == ""){
        $get_tax_amount = 0;
        $get_discount_amount = 0;
        $get_discount_rate = 0;
        $get_tax_rates = 0;
    }

    // Return If SubTotal OR AmountPaid OR AmountDue is Null/Empty
    if($get_amount_paid === "" || $get_amount_due === "" || $get_subtotal === "" ){
        echo "select";
        return;
    }

    // Validate Amount Input By User/Client 
    $validate_amount = ($get_subtotal+$get_tax_amount) - $get_discount_amount;

    // Return if Payment Amount is Less Than Total POS Amount
    if($get_amount_paid < $validate_amount){
        echo "less";
        return;
    }

        // Get Items List/Size 
        $error_array = [];
        $get_length_of_items = sizeof($_POST["medicine_id"]);
        
        for ($i=0; $i < $get_length_of_items ; $i++) { 
		
            $mid = $get_medicine_names[$i];  // Individual Medicine ID

            ## Check Medicine Available Quantity
            $stmt = "SELECT * FROM `tbl_temporary_stocks` WHERE `tbl_temporary_stocks`.`medicine_id` ='$mid' LIMIT 1";
            $query_check_available = mysqli_query($connect_db,$stmt) or die(mysqli_error($connect_db));
            $get_available = mysqli_fetch_array($query_check_available) ;
            $each_medicine_availableQty = $get_available['stock_level'];
           

            if($each_medicine_availableQty < $get_quantities[$i]){
                echo 'limit';
                return;
            } 

        }

    
    ## save sales code
      $get_length_of_items = sizeof($_POST["medicine_id"]);     // count medicine 

      ## Record Each Sale
      $save_each_sales_record = mysqli_query($connect_db,"INSERT INTO 
      `tbl_each_sales` (`each_sales_id`, `sales_id_number`, 
      `tax_rate`, `tax_amount`, `discount_rate`, 
      `discount_amount`, `sales_subtotal`, 
      `sales_total`, `sales_seller`, `amount_paid`,
      `sales_timestamp`) VALUES (NULL, 
      '$get_sales_number', '$get_tax_rates', '$get_tax_amount', 
      '$get_discount_rate', '$get_discount_amount', '$get_subtotal', 
      '$get_total_after_tax', '$user_id','$get_amount_paid', CURRENT_TIMESTAMP)")or die(mysqli_error($connect_db));

        ## Trigger Loop to Save Record
        for ($i=0; $i < $get_length_of_items ; $i++) { 
          
            $get_product_name = $get_medicine_names[$i];

            $sql = "SELECT * FROM `tbl_temporary_stocks` WHERE `tbl_temporary_stocks`.`medicine_id` ='$get_product_name' LIMIT 1";
            $query = mysqli_query($connect_db,$sql) or die(mysqli_error($connect_db));
            $get_qty_available = mysqli_fetch_array($query);
            $medicine_availableQty = $get_qty_available['stock_level'];
           
            // data parameters for saving into db
            $medicine_qty = $get_quantities[$i];
            $medicine_price = $get_prices[$i];
            $medicine_total = $get_totals[$i];
            // $get_available = $quantity_available; 

            $product_total = $medicine_qty*$medicine_price;

            // Insert POS Query
            $insert_pos_sales = mysqli_query($connect_db,"INSERT INTO 
            `tbl_sales` (`sales_id`, 
            `sales_id_number`, `medicineId`, 
            `medicineQty`, `medicinePrice`, 
            `medicineTotal`,`quantity_type`) VALUES (NULL, '$get_sales_number', 
            '$get_product_name', '$medicine_qty', 
            '$medicine_price', '$medicine_total','$get_quantity_type')")or die(mysqli_error($connect_db));

            // Deduct & Set Available Quantity
            $new_medicine_available_qty = $medicine_availableQty - $medicine_qty;

            if($get_quantity_type == '0'){
                  $run_deduction_query = mysqli_query($connect_db,"UPDATE `tbl_temporary_stocks` SET `stock_level` = '$new_medicine_available_qty' WHERE `tbl_temporary_stocks`.`medicine_id` = '$get_product_name'") or die(mysqli_error($connect_db));  
            }

        }
      
    if($run_deduction_query){
        echo 'success';
    }else{
        echo 'failed';
    }

  