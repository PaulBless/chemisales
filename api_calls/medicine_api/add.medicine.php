<?php

require_once '../../db/db.php';

## clean inputs data
$get_medicine_code = rtrim(htmlspecialchars($_POST['medicine-code']));
$clean_medicine_name = rtrim(htmlspecialchars($_POST['medicine-name']));
$clean_medicine_desc = rtrim(htmlspecialchars($_POST['description']));
$clean_medicine_dosage = rtrim(htmlspecialchars($_POST['dosage']));
$clean_medicine_genericname = rtrim(htmlspecialchars($_POST['generic-name']));
$clean_medicine_brandname = rtrim(htmlspecialchars($_POST['brand-name']));
$clean_medicine_category = rtrim(htmlspecialchars($_POST['medicine-category']));
$clean_medicine_supplier = rtrim(htmlspecialchars($_POST['supplier-name']));
$get_manufacture_date = rtrim(htmlspecialchars($_POST['mfg-date']));
$get_medicine_expiry = rtrim(htmlspecialchars($_POST['expiry-date']));
$clean_medicine_packagesize = rtrim(htmlspecialchars($_POST['package-size']));
$clean_medicine_costprice = rtrim(htmlspecialchars($_POST['cost-price']));
$clean_medicine_sellingprice = rtrim(htmlspecialchars($_POST['selling-price']));
$clean_medicine_batchno = rtrim(htmlspecialchars($_POST['batch-number']));


$get_medicine_name = strtoupper($clean_medicine_name);
$get_medicine_description = ucwords($clean_medicine_desc);
$get_medicine_brand = ucwords($clean_medicine_brandname);
$get_medicine_dosage = ucfirst($clean_medicine_dosage);
$get_medicine_package = ucfirst($clean_medicine_packagesize);
$get_costprice = $clean_medicine_costprice;
$get_sellingprice = $clean_medicine_sellingprice;
$get_supplier = $clean_medicine_supplier;
$get_generic = $clean_medicine_genericname;
$get_category = $clean_medicine_category;
$get_batch_number = strtoupper($clean_medicine_batchno);


## Check Medicine Existence
$check = "SELECT * FROM `tbl_medicines` WHERE `medicine_name`='$get_medicine_name' AND `cost_price`='$get_costprice' AND `selling_price`='$get_sellingprice'";
$run = $connect_db->query($check);
if($run->num_rows == 0){
     ## Run Database Query to Insert New Medicine
    $sql_stmt = "INSERT INTO `tbl_medicines` (`mid`, `medicine_code`, `medicine_name`, `medicine_description`, `brand_name`,
    `dosage`, `package_size`, `cost_price`, `selling_price`, `medicine_expiry_date`, `category_id`, `generic_id`, `manufacture_date`, `created_on`, `batch_no`) 
    VALUES (NULL, '$get_medicine_code', '$get_medicine_name', '$get_medicine_description', '$get_medicine_brand', '$get_medicine_dosage', '$get_medicine_package',
    '$get_costprice', '$get_sellingprice', '$get_medicine_expiry', '$get_category', '$get_generic', '$get_manufacture_date', CURRENT_TIMESTAMP, '$get_batch_number')";

    if($connect_db->query($sql_stmt) == TRUE)
    {
        //get last inserted record id
        $last_id = $connect_db->insert_id;
        // now save temporary stock level to Default Value 0 
        $sql = "INSERT INTO `tbl_temporary_stocks` (`tsid`, `medicine_id`, `stock_level`) VALUES (NULL, '$last_id', '0')";
        $stmt = $connect_db->prepare($sql);
        $stmt ->execute();
        
        echo "success";
    }

    
}else{
    ## medicine exists or already added
    echo "exist";
   
}



?>
