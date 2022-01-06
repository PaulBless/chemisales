<?php
        session_start();
        require_once '../../db/db.php';

        // Get User ID
        $userId = "";
        if(isset($_SESSION['user']))
        $userId = ($_SESSION['user']);

        $expense_details = $_POST['expenseDetails'] ;
        $get_expense_date = $_POST['expenseDate'];
        $get_expenseAmount = $_POST['expenseAmount'];
        $get_expense_code = $_POST['expenseId'];
        $get_expense_details = ucwords($expense_details);

        
        $addExpenses = mysqli_query($connect_db,"INSERT INTO `tbl_expenses` (`eid`, 
        `expense_id`, `expense_details`, `expense_amount`, `expense_creator`, `expense_date`) VALUES (NULL, 
        '$get_expense_code',  '$get_expense_details', '$get_expenseAmount', '$userId', '$get_expense_date')") or die(mysqli_error($connect_db));

        if($addExpenses){
            echo "success";
        }
        
?>
        
       

       