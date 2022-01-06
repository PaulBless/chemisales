<?php

      require_once '../../db/db.php';

      ## get form inputs data
      $get_medicine_names = $_POST['name'];
      $get_medicines = $_POST['product_id'];
      $get_suppliers = $_POST['supplier'];
      $get_prices = $_POST['price'];
      $get_quantities = $_POST['quantity'];
      $get_total_amounts =  $_POST['total'];
      $get_payment_amount = $_POST['payment-amount'];
      $get_stock_total = $_POST['stock-amount'];
      $purchase_code = $_POST['purchaseid'];
      $stock_code = $_POST['stockid'];
    
      // define array size for items
      $get_length_of_items = sizeof($_POST["name"]);

    for ($i=0; $i < $get_length_of_items; $i++) { 
        $medicine_ids = $get_medicines[$i];
        $supplier_ids = $get_suppliers[$i];
        $price = $get_prices[$i];
        $quantity = $get_quantities[$i];
        $total = $get_total_amounts[$i];
        $payment_amount = $get_payment_amount[$i];
        $stock_total = $get_stock_total[$i];
       
        
        // query to insert stock records
        $insert_data = mysqli_query($connect_db," INSERT INTO `tbl_stocks` 
        (`sid`, `stock_unique_id`, `stock_supplier_id`, `stock_medicine_id`, `item_quantity`, `item_total_amount`, `stock_total_amount`, `stock_date`)
        VALUES (NULL, '{$stock_code}', '{$medicine_ids}', '{$supplier_ids}', '{$quantity}', '{$total}', '{$get_stock_total}', CURRENT_TIMESTAMP())")OR DIE(mysqli_error($connect_db));        

    }

  
  if($insert_data){
      
       //Insert Purchase Details
       $add_purchase = mysqli_query($connect_db, "INSERT INTO `tbl_purchases`(`pid`, `purchase_id`, `purchase_details`, `purchase_amount`, `purchase_created_by`, `purchase_date`) VALUES (NULL,'$purchase_code', 'Purchase of Medicines for Stocks', '$get_payment_amount', '', CURRENT_TIMESTAMP())")OR DIE(mysqli_error($connect_db));

        // Query - Insert & Update Temporary Stocks Details
        $medicine_length = sizeof($_POST['product_id']);
        for ($m=0; $m < $medicine_length; $m++){
            $drug_id = $get_medicines[$m];
            $qty = $get_quantities[$m];
            
            // query update temporary-stock
            $sql_check = mysqli_query($connect_db, "SELECT `medicine_id` FROM `tbl_temporary_stocks` WHERE `medicine_id`='$drug_id'");
            $result = mysqli_fetch_array($sql_check);
            if(mysqli_num_rows($result) > 0){
                // update stock_level
                $update_stock = mysqli_query($connect_db, "UPDATE `tbl_temporary_stocks` SET `stock_level`=`stock_level` + '$qty' WHERE `medicine_id`='$drug_id')")OR DIE(mysqli_error($connect_db));
            }else{
                // add new stock_level
                $add_stock = mysqli_query($connect_db, "INSERT INTO `tbl_temporary_stocks`(`medicine_id`, `stock_level`) VALUES ('$drug_id','$qty')")OR DIE(mysqli_error($connect_db));
            }
        }
        
    echo 'success';

  }else{
      echo 'failed';
  }
