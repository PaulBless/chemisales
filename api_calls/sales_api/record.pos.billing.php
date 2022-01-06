<?php

    require_once '../../db/db.php';

    $get_sales_number = $_POST['sales_number'];
        
    if(!isset($_POST['medicine_id'])){
        echo "select";
        return;
    }else{
          $get_medicine_names = $_POST['medicine_id'];
    };

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
    $get_role = $_COOKIE['u_i'];
        
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
        $get_length_of_items = sizeof($_POST["medicine_id"]);
        $error_array = [];
        for ($i=0; $i < $get_length_of_items ; $i++) { 
		
            $medicineid = $get_medicine_names[$i];  // Individual Medicine ID
            $quantity_type = '1';       // Quantity Type - Single


            ## Check Medicine Available Quantity
            $stmt = "SELECT * FROM `tbl_temporary_stocks` WHERE `tbl_temporary_stocks`.`medicine_id` ='$medicineid' LIMIT 1";
            $query_check_available = ($connect_db->query($stmt));
            $get_medicine_available = ($query_check_available>fetch_assoc());
            $each_medicine_avaiableQty = $get_medicine_available['stock_level'];
           

            if($quantity_type == '1'){

                if($each_medicine_avaiableQty < $get_quantities[$i]){
                array_push($error_array,'false');
            }else{
                array_push($error_array,'true');
            } 
         }

           

        }

  if(in_array('false',$error_array)){
      echo 'less_product';
    }else{
   
      $get_length_of_items = sizeof($_POST["medicine_id"]);

      ## Record Each Sale
      $save_each_sales_record = mysqli_query($connect_db,"INSERT INTO 
      `tbl_each_sales` (`each_sales_id`, `sales_id_number`, 
      `tax_rate`, `tax_amount`, `discount_rate`, 
      `discount_amount`, `sales_subtotal`, 
      `sales_total`, `sales_seller`, `amount_paid`,
      `sales_timestamp`) VALUES (NULL, 
      '$get_sales_number', '$get_tax_rates', '$get_tax_amount', 
      '$get_discount_rate', '$get_discount_amount', '$get_subtotal', 
      '$get_total_after_tax', '$get_role','$get_amount_paid', CURRENT_TIMESTAMP)")or die(mysqli_error($connect_db));

        
        for ($i=0; $i < $get_length_of_items ; $i++) { 
          
            $get_product_name = $get_medicine_names[$i];

            $get_product_quantity_avail = mysqli_query($connect_db,"SELECT * FROM tbl_medicines WHERE tbl_medicines_id = $get_product_name");

            $get_quantity_avail = mysqli_fetch_array($get_product_quantity_avail);

            $quantity_available = $get_quantity_avail['quantity_available_pcs'];

            $sql = "SELECT * FROM `tbl_temporary_stocks` WHERE `tbl_temporary_stocks`.`medicine_id` ='$get_product_name' LIMIT 1";
            $query = $connect_db->query($sql);
            $get_qty_available = $query->fetch_assoc();
            $medicine_avaiableQty = $get_qty_available['stock_level'];
           


            $get_quantity = $get_quantities[$i];
            $get_price = $get_prices[$i];
            $get_total = $get_prices[$i];
            $get_available = $quantity_available; 
            $get_each_quantity_type = $quantity_type;

            $product_total = $get_quantity*$get_price;

            $insert_pos_sales = mysqli_query($connect_db,"INSERT INTO 
            `tbl_sales` (`sales_id`, `sales_id_number`, `medicineId`, 
            `medicineQty`, `medicinePrice`, `medicineTotal`,`quantity_type`) VALUES (NULL, '$get_product_name', '$get_sales_number', '$get_quantity', '$get_price', '$product_total','$get_quantity_type')")or die(mysqli_error($connect_db));

            $new_quantity_available = $get_available - $get_quantity;

            if($get_each_quantity_type == '1'){
                  $run_deduction_query = mysqli_query($connect_db,"UPDATE `tbl_medicines` SET `quantity_available_pcs` = '$new_quantity_available' WHERE `tbl_medicines`.`tbl_medicines_id` = '$get_product_name'") or die(mysqli_error($connect_db));  
            }

        }
      
        if($run_deduction_query){
        echo 'success';
        }else{
        echo 'failed';
        }

  }