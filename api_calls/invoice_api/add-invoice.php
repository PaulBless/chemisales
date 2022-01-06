<?php

require_once '../../db/db.php';

// Invoice Due
$get_system_invoice = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 9") or die(mysqli_error($connect_db));
$get_invoice = mysqli_fetch_array($get_system_invoice);
$system_invoice = $get_invoice['settings_ans'];

switch ($system_invoice) {
    case '7':
        $new_date = Date('d/m/Y',strtotime("+7 days"));
        break;
    case '14':
    $new_date = Date('d/m/Y',strtotime("+14 days"));
        break;
    case '21':
    $new_date = Date('d/m/Y',strtotime("+21 days"));
        break;

    case '32':
    $new_date = Date('d/m/Y',strtotime("+32 days"));
        break;
    
    default:

        break;
    }
        ## clean inputs data
        $clean_company_name = rtrim(htmlspecialchars($_POST['companyName']));
        $clean_company_addreses = rtrim(htmlspecialchars($_POST['address']));
        $clean_product_name = rtrim(htmlspecialchars($_POST['productName']));
        $get_invoice_id = rtrim(htmlspecialchars($_POST['invoice_id']));
        $get_company_name = $clean_company_name;
        $get_company_address = $get_company_address;
        $get_product_names = $clean_product_name;


        $get_quantities = rtrim(htmlspecialchars($_POST['quantity']));
        $get_quantity_type = rtrim(htmlspecialchars($_POST['quantity_type']));
        $get_prices = rtrim(htmlspecialchars($_POST['price']));
        $get_totals = rtrim(htmlspecialchars($_POST['total']));
        $get_subtotal = rtrim(htmlspecialchars($_POST['subTotal']));
        $get_tax_rates = rtrim(htmlspecialchars($_POST['taxRate']));
        $get_tax_amount = rtrim(htmlspecialchars($_POST['taxAmount']));
        $get_discount_rate = rtrim(htmlspecialchars($_POST['discountRate']));
        $get_discount_amount = rtrim(htmlspecialchars($_POST['discountAmount']));
        $get_total_after_tax = rtrim(htmlspecialchars($_POST['totalAftertax'])) ;
        $get_amount_paid = rtrim(htmlspecialchars($_POST['amountPaid']));
        $get_amount_due = rtrim(htmlspecialchars($_POST['amountDue']));
        // $get_due_date = $_POST['due_date'];
        $get_due_date = '10/10/20219';


        if($get_amount_paid === "" || $get_amount_due === "" || $get_subtotal === "" ){
            echo "select";
            return;
        }


        $get_length_of_items = sizeof($_POST["productName"]);
        $error_array = [];
        for ($i=0; $i < $get_length_of_items ; $i++) { 
		
            $pid = $get_product_names[$i];
            $quantity_type = $get_quantity_type[$i];


            $getProductInfo = mysqli_query($connect_db,"SELECT * FROM tbl_products JOIN categories_tbl on tbl_products.product_category = categories_tbl.category_id where tbl_products.tbl_products_id ='$pid' LIMIT 1")or die(mysqli_error($connect_db));
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
    } else {
   
      $get_length_of_items = sizeof($_POST["productName"]);

      $save_to_special_table = mysqli_query($connect_db,"INSERT INTO 
      `tbl_each_invoice` (`each_invoice_id`, `related_invoice_id`, `company_name`,`company_address`, 
      `total_amount`, `expiry_date`, 
      `status`,`tax_rate`,`tax_amount`,`discount_rate`,`discount_amount`,`sub_total`,`invoice_timestamp`) VALUES (NULL, 
      '$get_invoice_id','$get_company_name','$get_company_address', '$get_total_after_tax',
        '$new_date', 'pending','$get_tax_rates','$get_tax_amount','$get_discount_rate',
        '$get_discount_amount','$get_subtotal',CURRENT_TIMESTAMP)")or die(mysqli_error($connect_db));

      for ($i=0; $i < $get_length_of_items ; $i++) { 
          $get_product_name = $get_product_names[$i];
          $get_quantity = $get_quantities[$i];
          $get_price = $get_prices[$i];
          $get_total = $get_prices[$i];
          $get_each_quantity_type = $get_quantity_type[$i];

          $product_total = $get_quantity*$get_price;

          $insert_data = mysqli_query($connect_db,"INSERT INTO `tbl_invoice` (`invoice_id`, 
          `product_name`,`invoice_number`, `company_name`, `company_address`, 
          `product_quantity`, `product_price`, `product_total`, 
          `product_subtotal`, `product_taxRates`, 
          `product_taxAmount`, `product_TotalAfterTax`, 
          `product_paid`, `product_amount_due`,`due_date`,`quantity_type`) VALUES (NULL, '$get_product_name','$get_invoice_id', '$get_company_name', 
          '$get_company_address', '$get_quantity', '$get_price', '$product_total', 
          '$get_subtotal', '$get_tax_rates', '$get_tax_amount', '$get_total_after_tax', 
          '$get_amount_paid', '$get_amount_due','$new_date',$get_each_quantity_type)")or die(mysqli_error($connect_db));
      }

  if($insert_data){
      echo 'success';
  }else{
      echo 'failed';
  }
    }
