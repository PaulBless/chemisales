<?php

require_once '../../db/db.php';

## clean inputs data
$clean_name_input = rtrim(htmlspecialchars($_POST['name']));
$clean_address_input = rtrim(htmlspecialchars($_POST['address']));
$clean_email_input = rtrim(htmlspecialchars($_POST['email']));
$get_supplier_name = ucwords($clean_name_input);
$get_supplier_phone = rtrim(htmlspecialchars($_POST['phone']));
$get_supplier_email = strtolower($clean_email_input);
$get_supplier_address = ucwords($clean_address_input);
       

$addSupplier = mysqli_query($connect_db,"INSERT INTO `tbl_suppliers` (`supplier_id`, `supplier_name`, 
`supplier_phone`, `supplier_email`, 
`supplier_address`, 
`supplier_timestamp`) VALUES (NULL, 
'$get_supplier_name', '$get_supplier_phone', 
'$get_supplier_email', '$get_supplier_address', CURRENT_TIMESTAMP);") or die(mysqli_error($connect_db));
        if($addSupplier){
            echo "success";
        }
