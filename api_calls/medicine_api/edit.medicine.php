<?php

    require_once '../../db/db.php';

    ## clean inputs data
    $medicine_idno = rtrim(htmlspecialchars($_POST['medicine-id']));
    $clean_medicine_name = rtrim(htmlspecialchars($_POST['medicine-name']));
    $clean_medicine_desc = rtrim(htmlspecialchars($_POST['description']));
    $clean_medicine_dosage = rtrim(htmlspecialchars($_POST['med-dosage']));
    $clean_medicine_genericname = rtrim(htmlspecialchars($_POST['generic-name']));
    $clean_medicine_brandname = rtrim(htmlspecialchars($_POST['brand-name']));
    $clean_medicine_category = rtrim(htmlspecialchars($_POST['medicine-category']));
    $clean_medicine_supplier = rtrim(htmlspecialchars($_POST['supplier-name']));
    $get_medicine_expiry = rtrim(htmlspecialchars($_POST['expiry-date']));
    $get_medicine_manufacture = rtrim(htmlspecialchars($_POST['mfg-date']));
    $clean_medicine_packagesize = rtrim(htmlspecialchars($_POST['package-size']));
    $clean_medicine_costprice = rtrim(htmlspecialchars($_POST['cost-price']));
    $clean_medicine_sellingprice = rtrim(htmlspecialchars($_POST['selling-price']));
    $clean_medicine_batchno = rtrim(htmlspecialchars($_POST['batch']));


    $get_medicine_name = strtoupper($clean_medicine_name);
    $get_medicine_description = ucwords($clean_medicine_desc);
    $get_medicine_brand = ucwords($clean_medicine_brandname);
    $get_dosage = ucfirst($clean_medicine_dosage);
    $get_medicine_package = ucfirst($clean_medicine_packagesize);
    $get_costprice = $clean_medicine_costprice;
    $get_sellingprice = $clean_medicine_sellingprice;
    $get_supplier = $clean_medicine_supplier;
    $get_generic = $clean_medicine_genericname;
    $get_category = $clean_medicine_category;
    $get_batch_number = strtoupper($clean_medicine_batchno);

        
    if(isset($_POST['medicine-id']))
    {
        ## update sql statement
        // $sql = "UPDATE `tbl_medicines` SET `medicine_name`='$get_medicine_name', `medicine_description`='$get_medicine_description', `brand_name`='$get_medicine_brand', `dosage`='$get_medicine_dosage', `package_size`='$get_medicine_package', `cost_price`='$get_costprice',  `selling_price`='$get_sellingprice', `medicine_expiry_date`='$get_medicine_expiry', `category_id`='$get_category', `generic_id`='$get_generic', `manufacture_date`='$get_medicine_manufacture' WHERE `tbl_medicines`.`mid` = '$medicine_idno'"; ## update sql statement
        

        $sql = "UPDATE `tbl_medicines` SET 
        `medicine_name`='$get_medicine_name', 
        `medicine_description`='$get_medicine_description', 
        `brand_name`='$get_medicine_brand',
        `dosage`='$get_dosage', 
        `package_size`='$get_medicine_package', 
        `cost_price`='$get_costprice', 
        `selling_price`='$get_sellingprice', 
        `medicine_expiry_date`='$get_medicine_expiry', 
        `manufacture_date`='$get_medicine_manufacture',
        `batch_no`='{$get_batch_number}' WHERE `tbl_medicines`.`mid` = '{$medicine_idno}'";
        
        ## execute the update query
        $update_query = mysqli_query($connect_db, $sql) or die(mysqli_error($connect_db));
     
        if($update_query){
            echo "success";
        }else{
            echo "error";
        }
    
    }

    

?>	
	