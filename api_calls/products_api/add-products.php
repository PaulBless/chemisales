<?php

require_once '../../db/db.php';

      ## clean inputs data
      $clean_name = $_POST['name'];
      $clean_category = $_POST['category'];
      // $get_batch_numbers = $_POST['batch_no'];
      $get_batch_number = "0";
      $get_names = $clean_name;
      $get_categories = $clean_category;
      $get_cost_prices_boxes = $_POST['cost_price_boxes'];
      $get_cost_prices_pcs =  $_POST['cost_price_pcs'];
      $get_selling_prices_boxes = $_POST['selling_price_boxes'];
      $get_selling_prices_pcs = $_POST['selling_price_pcs'];
      $get_quantities_available_box= $_POST['quantity_avail_box'];
      $get_quantities_available_pcs= $_POST['quantity_avail_pcs'];
      // $get_expires = $_POST['expiry'];
      $get_expires = "0";

      $get_length_of_items = sizeof($_POST["name"]);

      for ($i=0; $i < $get_length_of_items ; $i++) { 
          //$get_batch_number = $get_batch_numbers[$i];
          $get_name = ucwords($get_names[$i]);
          $get_category = $get_categories[$i];
          $get_cost_price_boxes = $get_cost_prices_boxes[$i];
          $get_cost_price_pcs = $get_cost_prices_pcs[$i];
          $get_selling_price_boxes = $get_selling_prices_boxes[$i];
          $get_selling_price_pcs = $get_selling_prices_pcs[$i];
          $get_quantity_available_box= $get_quantities_available_box[$i];
           $get_quantity_available_pcs= $get_quantities_available_pcs[$i];
        //   $get_expires = $get_expiries[$i];

       
        
        // query to insert records
        $insert_data = mysqli_query($connect_db," INSERT INTO `tbl_products` (`tbl_products_id`, `product_name`, `product_category`, `selling_price_box`, `selling_price_pcs`, `cost_price_box`, `cost_price_pcs`, `expiry_date`, `quantity_available_box`,`quantity_available_pcs`) VALUES (NULL,'{$get_name}', '{$get_category}', '{$get_selling_price_boxes}', '{$get_selling_price_pcs}', '{$get_cost_price_boxes}', '{$get_cost_price_pcs}', '{$get_expires}', '{$get_quantity_available_box}','{$get_quantity_available_pcs}')")or die(mysqli_error($connect_db));
      
    }

  
  if($insert_data){
      echo 'success';
  }else{
      echo 'failed';
  }
