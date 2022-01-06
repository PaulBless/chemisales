<?php 

require_once '../../db/db.php';


if(isset($_POST['save-all']) && isset($_POST['name'])){
    
    foreach($_POST['product_id'] as $row => $value){

        $product=$_POST['product_id'][$row];
        $quantity=$_POST['quantity'][$row];

        $update = "UPDATE `tbl_temporary_stocks` SET `stock_level`='stock_level + {$quantity}' WHERE medicine_id='{$product}'";

        if (mysqli_query($connect_db, $sql)) {
                echo "stocked";
        } else {
            echo "error";
        }
    } // end foreach loop

}

?>