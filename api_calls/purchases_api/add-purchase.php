<?php

require_once '../../db/db.php';

        $get_purchase_id = ($_POST['purchase_id']);
        $get_names = ($_POST['name']);
        $get_quantities_box = ($_POST['quantity_box']);
        $get_quantities_pcs = ($_POST['quantity_pcs']);
        $get_expiries = ($_POST['expiry']);
        $get_cost_price_boxx = ($_POST['cost_box']);
        $get_cost_price_pcss = ($_POST['cost_pcs']);

        $get_length_of_items = sizeof($_POST["name"]);

        $get_total_quantity = 0;
        $get_total_amount = 0;

        $last_updated = date('d-M-Y H:i');

      for ($i=0; $i < $get_length_of_items ; $i++) { 
          $get_name = $get_names[$i];
          $get_quantity_box = $get_quantities_box[$i];
          $get_quantity_pcs = $get_quantities_pcs[$i];
          $get_cost_price_box = $get_cost_price_boxx[$i];
          $get_cost_price_pcs = $get_cost_price_pcss[$i];
          $get_expiry = $get_expiries[$i];

          $get_previous_quantity = mysqli_query($connect_db,"SELECT * FROM tbl_products WHERE tbl_products_id = '$get_name' LIMIT 1")or die(mysqli_error($connect_db));
          $fetch_previous = mysqli_fetch_array($get_previous_quantity);
          $get_quantity_avail_box = $fetch_previous['quantity_available_box'];
          $get_quantity_avail_pcs = $fetch_previous['quantity_available_pcs'];

          $new_quantity_avail_box = $get_quantity_box + $get_quantity_avail_box;
          $new_quantity_avail_pcs = $get_quantity_pcs + $get_quantity_avail_pcs;


          $update_product = mysqli_query($connect_db,"UPDATE `tbl_products` SET
           `expiry_date` = '$get_expiry', 
           `quantity_available_box` = '$new_quantity_avail_box', 
           `quantity_available_pcs` = '$new_quantity_avail_pcs', 
           `last_updated` = '$last_updated' 
           WHERE tbl_products_id = $get_name")or die(mysqli_error($connect_db));

            $run_insert_query = mysqli_query($connect_db,"INSERT INTO `tbl_purchase` (`purchase_id`, `product_id`, `quantity_box`, `quantity_pcs`, `expiry_date`, `cost_price_box`, `cost_price_pcs`, `purchase_timestmap`) VALUES (NULL, '$get_name', '$get_quantity_box', '$get_quantity_pcs', '$get_expiry', '$get_cost_price_box', '$get_cost_price_pcs', current_timestamp())")or die(mysqli_error($connect_db));

      }

    //   $update_items = mysqli_query($connect_db,"INSERT INTO `tbl_each_purchase` 
    //   (`each_purchase_id`, `purchase_id`, 
    //   `total_quantity`, `total_amount`, 
    //   `purchase_timestamp`) VALUES (NULL, 
    //   '$get_purchase_id', '$get_total_quantity', 
    //   '$get_total_amount', CURRENT_TIMESTAMP)")or die(mysqli_error($connect_db));

  if($run_insert_query){
      echo 'success';
  }else{
      echo 'failed';
  }
