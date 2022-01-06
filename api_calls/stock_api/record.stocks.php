<?php
    
    session_start();
    require_once '../../db/db.php';
    
    ## Get Logged In UserID
    $userId = "";
    if (isset($_SESSION['user']))
        $userId = $_SESSION['user'];


    // Check if Medicine Name Exists 
    if(!isset($_POST['product_id'])){
        echo "empty";
        return;
    }else{
        $get_medicine_ids = $_POST['product_id'];
    };


    ## get form inputs data
    $get_medicine_names = $_POST['name'];
    $get_suppliers = $_POST['supplier'];
    $get_prices = $_POST['price'];
    $get_quantities = $_POST['quantity'];
    $get_total_amounts =  $_POST['total'];
    $get_availables =  $_POST['available'];
    $get_payment_amount = $_POST['payment-amount'];
    $get_stock_total = $_POST['stock-amount'];
    $purchase_code = $_POST['purchaseid'];
    $stock_code = $_POST['stockid'];
    
 
## Check If Payment & Stock Total Value is Set
if($get_payment_amount === "" || $get_stock_total === "" || $get_medicine_ids === "")
{
    echo "error";
    return;
}else{


        // define array size for items
        $get_length_of_items = sizeof($_POST["name"]);
        
        // Insert Purchase Details
        $record_purchase = mysqli_query($connect_db, "INSERT INTO `tbl_purchases`(`pid`, `purchase_id`, `purchase_details`, `purchase_amount`, `purchase_created_by`, `purchase_date`) VALUES (NULL,'$purchase_code', 'Purchase of Medicines for Stocking', '$get_payment_amount', '$userId', CURRENT_TIMESTAMP())")OR DIE(mysqli_error($connect_db));    
            
        // This Code Triggers to Save Save Each Record 
        for ($i=0; $i < $get_length_of_items; $i++) { 
            // define and set values
            $each_medicine_id = $get_medicine_ids[$i];
            $each_supplier_id = $get_suppliers[$i];
            $each_price = $get_prices[$i];
            $each_quantity = $get_quantities[$i];
            $each_total = $get_total_amounts[$i];
            $each_available = $get_availables[$i];

             ## First Check & Update Temporary Available Stocks
            // query to insert stock records
            $sql = "SELECT * FROM `tbl_temporary_stocks` WHERE medicine_id=$each_medicine_id";
            $check_stock_level = $connect_db->query($sql);
            if($check_stock_level->num_rows == 0){
                $statement = "INSERT INTO `tbl_temporary_stocks`(`tsid`,`medicine_id`,`stock_level`) VALUES(NULL,'$each_medicine_id','$each_quantity')";
                $add_new_stock = $connect_db->query($statement);    // insert query
            }else{
                // SQL Statement
                $results = $check_stock_level->fetch_assoc();   // fetch db table results
                $qtyLeft = $results['stock_level'];
                $newQty = $qtyLeft+$each_quantity;
                $stmt = "UPDATE `tbl_temporary_stocks` SET stock_level='$newQty' WHERE medicine_id='{$each_medicine_id}'";
                $update_stock = $connect_db->query($stmt);      // update query
            }
            
                        
            // Insert Stock Inventory
            $insert_inventory_data = mysqli_query($connect_db,"INSERT INTO `tbl_stocks` 
            (`sid`, `stock_unique_id`, `stock_supplier_id`, `stock_medicine_id`, `item_quantity`, `item_total_amount`, `stock_total_amount`, `stock_date`,`stocked_by`)
            VALUES (NULL, '{$stock_code}', '{$each_supplier_id}', '{$each_medicine_id}', '{$each_quantity}', '{$each_total}', '{$get_stock_total}', CURRENT_TIMESTAMP(), '{$userId}')")OR DIE(mysqli_error($connect_db));        

           
        }

    
    // if($runQuery){
    if($insert_inventory_data){
            echo 'stock_added';  // echo success
    }else{
        echo 'failed';
    }
}
  ?>