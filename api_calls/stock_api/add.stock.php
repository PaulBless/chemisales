<?php
    
      session_start();
      require_once '../../db/db.php';

      ## get form inputs data
      $get_medicine_name = $_POST['medicine'];
      $get_medicine_id = $_POST['mid'];
      $get_supplier = $_POST['supplier'];
      $get_quantity = $_POST['quantity'];
      $get_total_amount =  $_POST['total-price'];
      $get_payment_amount = $_POST['pay-amount'];
      $purchase_code = $_POST['purchase-id'];
      $stock_code = $_POST['stock-id'];
      $purchase_details = "Purchase of Medicine: ".$get_medicine_name." for stocking";
    
      $userId = "";
      if (isset($_SESSION['user']))
        $userId = $_SESSION['user'];

      if($get_payment_amount === "" || $get_quantity === "" || $get_medicine_id === "")
      {
        echo "error";
        return;
      }else{

      // Insert Purchase Details
      $add_purchase_sql = "INSERT INTO `tbl_purchases`
      (`pid`, `purchase_id`, `purchase_details`, `purchase_amount`, `purchase_created_by`, `purchase_date`) 
      VALUES (NULL, '$purchase_code', '$purchase_details', '$get_payment_amount', '$userId', CURRENT_TIMESTAMP())";
      $record_purchase = $connect_db->query($add_purchase_sql);    
        
        // query to insert stock records
        $sql = "SELECT * FROM `tbl_temporary_stocks` WHERE `medicine_id`=$get_medicine_id";
        $check_stock_level = $connect_db->query($sql);
        if($check_stock_level->num_rows == 0){
            $statement = "INSERT INTO `tbl_temporary_stocks`(`tsid`,`medicine_id`,`stock_level`) VALUES(NULL,'$get_medicine_id','$get_quantity')";
            $add_new_stock = $connect_db->query($statement);    // insert query
        }else{
            // SQL Statement
            $results = $check_stock_level->fetch_assoc();   // fetch db table results
            $qtyLeft = $results['stock_level'];
            $newQty = $qtyLeft+$get_quantity;
            $stmt = "UPDATE `tbl_temporary_stocks` SET `stock_level`='$newQty' WHERE `medicine_id`='{$get_medicine_id}'";
            $update_stock = $connect_db->query($stmt);      // update query
        }
        
     ## Record Stock Inventory
     //SQL Statement
     $sql_add_stock_inventory = "INSERT INTO `tbl_stocks` (`sid`, `stock_unique_id`, `stock_supplier_id`, `stock_medicine_id`,`item_quantity`, `item_total_amount`, `stock_total_amount`, `stock_date`,`stocked_by`) VALUES (NULL, '{$stock_code}', '{$get_supplier}', '{$get_medicine_id}', '{$get_quantity}', '{$get_total_amount}', '{$get_total_amount}', CURRENT_TIMESTAMP(), '{$userId}')";
      // Run Query
      $record_stock_inventory = $connect_db->query($sql_add_stock_inventory);        

    

    if($record_stock_inventory){
        echo "success";
    }else{
        echo "failed";
    }
  
  }
  
  ?>