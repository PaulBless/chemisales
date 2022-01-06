<?php

        require_once '../../db/db.php';

        $get_sales_id = $_POST['sales_id'];
        $available_products = $_POST['available'];
        
        if(!isset($_POST['productName'])){
            echo "select";
        return;
            }else{
          $get_product_names = $_POST['productName'];
        };


        $get_quantities = $_POST['quantity'];
        $get_quantity_type = $_POST['quantity_type'];
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

         if($_COOKIE['c_r'] === 'a' && $_COOKIE['u_r']==='a'){
                $get_role = '0';
         }else{
              $get_role = $_COOKIE['u_i'];
         }


        if($get_amount_paid === "" || $get_amount_due === "" || $get_subtotal === "" ){
            echo "select";
            return;
        }

        $validate_amount = ($get_subtotal+$get_tax_amount) - $get_discount_amount;


        if($get_amount_paid < $validate_amount){
            echo "less";
            return;
        }

        $get_length_of_items = sizeof($_POST["productName"]);
        $error_array = [];
        for ($i=0; $i < $get_length_of_items ; $i++) { 
		
            $pid = $get_product_names[$i];
            $quantity_type = $get_quantity_type[$i];


            $getProductInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_products` JOIN `categories_tbl` on `tbl_products`.`product_category` = `categories_tbl`.`category_id` where `tbl_products`.`tbl_products_id` ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
            $productInfo = mysqli_fetch_array($getProductInfo);  
    
            $quantity_available_box  = $productInfo['quantity_available_box'];
            $quantity_available_pcs  = $productInfo['quantity_available_pcs'];

            if($quantity_type == '1'){

                if($quantity_available_pcs < $get_quantities[$i]){
                array_push($error_array,'false');
            }else{
                array_push($error_array,'true');
            } 


            }else{
                 if($quantity_available_box < $get_quantities[$i]){
                array_push($error_array,'false');
            }else{
                array_push($error_array,'true');
            } 
            }

           

        }

  if(in_array('false',$error_array)){
      echo 'less_product';
  }else{
   
      $get_length_of_items = sizeof($_POST["productName"]);

      $save_to_special_table = mysqli_query($connect_db,"INSERT INTO 
      `tbl_each_sales` (`each_sales_id`, `sales_id_number`, 
      `tax_rate`, `tax_amount`, `discount_rate`, 
      `discount_amount`, `sales_subtotal`, 
      `sales_total`, `sales_seller`, `amount_paid`,
      `sales_timestamp`) VALUES (NULL, 
      '$get_sales_id', '$get_tax_rates', '$get_tax_amount', 
      '$get_discount_rate', '$get_discount_amount', '$get_subtotal', 
      '$get_total_after_tax', '$get_role','$get_amount_paid', CURRENT_TIMESTAMP)")or die(mysqli_error($connect_db));

      for ($i=0; $i < $get_length_of_items ; $i++) { 
          $get_product_name = $get_product_names[$i];
          $get_quantity = $get_quantities[$i];
          $get_price = $get_prices[$i];
          $get_total = $get_prices[$i];
          $get_available = $available_products[$i]; 
          $get_each_quantity_type = $get_quantity_type[$i];

          $product_total = $get_quantity*$get_price;

          $insert_data = mysqli_query($connect_db,"INSERT INTO 
          `tbl_sales_table` (`sales_id`, 
          `product_name`, `sales_id_number`, 
          `product_quantity`, `product_price`, 
          `product_total`,`quantity_type`) VALUES (NULL, '$get_product_name', 
          '$get_sales_id', '$get_quantity', 
          '$get_price', '$product_total','$get_each_quantity_type')")or die(mysqli_error($connect_db));

          $new_quantity_available = $get_available - $get_quantity;

            if($get_each_quantity_type == '1'){
                  $run_deduction_query = mysqli_query($connect_db,"UPDATE `tbl_products` SET `quantity_available_pcs` = '$new_quantity_available' WHERE `tbl_products`.`tbl_products_id` = '$get_product_name'") or die(mysqli_error($connect_db));
            }else{
                $run_deduction_query = mysqli_query($connect_db,"UPDATE `tbl_products` SET `quantity_available_box` = '$new_quantity_available' WHERE `tbl_products`.`tbl_products_id` = '$get_product_name'") or die(mysqli_error($connect_db));
            }

        
      }

  if($run_deduction_query){
      echo 'success';
  }else{
      echo 'failed';
  }

  }