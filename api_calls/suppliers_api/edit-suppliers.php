<?php

    require_once '../../db/db.php';
    ## clean form input data
    $clean_suplier_name = rtrim(htmlspecialchars($_POST['name']));
    $clean_suplier_email = rtrim(htmlspecialchars($_POST['email']));
    $clean_suplier_address = rtrim(htmlspecialchars($_POST['address']));
    $get_supplier_id = rtrim(htmlspecialchars($_POST['supplier_id']));
    $get_supplier_phone = rtrim(htmlspecialchars($_POST['phone']));

    ## set conversion parameters for inputs
    $get_supplier_name = ucwords($clean_suplier_name);
    $get_supplier_email = strtolower($clean_suplier_email);
    $get_supplier_address = ucwords($clean_suplier_address);
        
    $updateSupplier = mysqli_query($connect_db,"UPDATE `tbl_suppliers` SET `supplier_name` = '$get_supplier_name', `supplier_phone` = '$get_supplier_phone', `supplier_email` = '$get_supplier_email', `supplier_address` = '$get_supplier_address' WHERE `tbl_suppliers`.`supplier_id` = '$get_supplier_id'") or die(mysqli_error($connect_db));
    if($updateSupplier){
        echo "success";
    }

?>









