<?php
    require_once 'db/db.php';

    // get printer option
    $sql_printer = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '11'")or die(mysqli_error($connect_db));
    $fetch = mysqli_fetch_assoc($sql_printer);
    $get_printer_value = $fetch['settings_ans'];
    
    // get barcode_scanner option
    $sql_barcode = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '12'")or die(mysqli_error($connect_db));
    $data = mysqli_fetch_assoc($sql_barcode);
    $get_barcode_value = $data['settings_ans'];


    if($get_barcode_value === '1' && $get_printer_value === '1'){
        // has pos printer and barcode_scanner is available
        header('location: pos.transaction.php');
    }elseif($get_barcode_value === '0' && $get_printer_value === '1'){
        // has pos printer but barcode_scanner unavailable
        header('location: pos.printer.php');
    }elseif($get_barcode_value === '1' && $get_printer_value === '0'){
        // has barcode_scanner but no printer unavailable
        header('location: pos.barcode.php');
    }else{
        // no printer and barcode_scanner available
        header('location: pos.php');
    }
?>