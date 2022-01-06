<?php

        require_once '../../db/db.php';

        $get_expense_id = $_POST['expense_id'];
        $get_expense_date = $_POST['expense_date'];
        $get_expense_amount = $_POST['expense_amount'];
        $clean_input_data = rtrim(htmlspecialchars($_POST['expense_details']));
        $get_expense_details = ucwords($clean_input_data);
        
        $update_expense = mysqli_query($connect_db,"UPDATE `tbl_expenses` SET `expense_details` = '$get_expense_details',
        `expense_amount`='$get_expense_amount', `expense_date`= '$get_expense_date' WHERE `tbl_expenses`.`eid` = '$get_expense_id'") or die(mysqli_error($connect_db));
        
        if($update_expense){
            echo "success";
        }

?>