<?php

        require_once '../../db/db.php';

        // set post variables 
        $pharmacy_name = rtrim(htmlspecialchars($_POST['txt_system_name']));
        $system_title = rtrim(htmlspecialchars($_POST['txt_system_title']));
        $address = rtrim(htmlspecialchars($_POST['txt_address']));
        $email = rtrim(htmlspecialchars($_POST['txt_pharmacy_email']));
        $get_min_quantity_alert = rtrim(htmlspecialchars($_POST['txt_min_quantity_alert']));
        $get_currency = rtrim(htmlspecialchars($_POST['sel_currency']));
        $get_expire_alert_limit = rtrim(htmlspecialchars($_POST['sel_expire_alert_limit']));
        $get_invoice_due = rtrim(htmlspecialchars($_POST['sel_invoice_due']));
        $get_printer = rtrim(htmlspecialchars($_POST['sel_printer']));
        $get_barcode = rtrim(htmlspecialchars($_POST['sel_barcode']));
        $get_contact = rtrim(htmlspecialchars($_POST['txt_contact']));
        
        $get_system_name = ucwords($pharmacy_name);
        $get_system_title = ucwords($system_title);
        $get_address = ucwords($address);
        $get_email =strtolower($email) ;

        if(isset($_FILES["profileImage"])){

            $output_dir = "../../assets/images/";
            $fileName = $_FILES["profileImage"]["name"];
            $file_size = $_FILES['profileImage']['size'];
            $file_tmp = $_FILES['profileImage']['tmp_name'];
            $file_type = $_FILES['profileImage']['type'];

            move_uploaded_file($_FILES["profileImage"]["tmp_name"],$output_dir.$fileName);

            $profile_pic_path = $fileName;

            $query = "UPDATE `tbl_settings` SET `settings_ans` = '$get_system_name' WHERE `tbl_settings`.`settings_id` = 1;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_system_title' WHERE `tbl_settings`.`settings_id` = 2;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_address' WHERE `tbl_settings`.`settings_id` = 3;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_contact' WHERE `tbl_settings`.`settings_id` = 4;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_email' WHERE `tbl_settings`.`settings_id` = 5;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_min_quantity_alert' WHERE `tbl_settings`.`settings_id` = 6;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_currency' WHERE `tbl_settings`.`settings_id` = 7;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_expire_alert_limit' WHERE `tbl_settings`.`settings_id` = 8;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_invoice_due' WHERE `tbl_settings`.`settings_id` = 9;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$profile_pic_path' WHERE `tbl_settings`.`settings_id` = 10;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_printer' WHERE `tbl_settings`.`settings_id` = 11;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_barcode' WHERE `tbl_settings`.`settings_id` = 12;";
            
        }else{
            $query = "UPDATE `tbl_settings` SET `settings_ans` = '$get_system_name' WHERE `tbl_settings`.`settings_id` = 1;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_system_title' WHERE `tbl_settings`.`settings_id` = 2;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_address' WHERE `tbl_settings`.`settings_id` = 3;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_contact' WHERE `tbl_settings`.`settings_id` = 4;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_email' WHERE `tbl_settings`.`settings_id` = 5;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_min_quantity_alert' WHERE `tbl_settings`.`settings_id` = 6;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_currency' WHERE `tbl_settings`.`settings_id` = 7;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_expire_alert_limit' WHERE `tbl_settings`.`settings_id` = 8;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_invoice_due' WHERE `tbl_settings`.`settings_id` = 9;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_printer' WHERE `tbl_settings`.`settings_id` = 11;";
            $query .= "UPDATE `tbl_settings` SET `settings_ans` = '$get_barcode' WHERE `tbl_settings`.`settings_id` = 12;";
        }
        
        $run_query = mysqli_multi_query($connect_db,$query);

  if($run_query){
      echo 'success';
  }else{
      echo 'failed';
  }
