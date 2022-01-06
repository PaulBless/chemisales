<?php

header('Content-type: application/json; charset=UTF-8');

require_once '../../db/db.php';

	$response = array();
	
	if ($_POST['expenseId']) {
		
		$pid = intval($_POST['expenseId']);
        $query_expense = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE `eid`='$pid' LIMIT 1")or die(mysqli_error($connect_db));
        $expenseInfo = mysqli_fetch_array($query_expense);  

        $response['expense_id']  = $expenseInfo['expense_id'];
        $response['expense_amount']  = $expenseInfo['expense_amount'];
        $response['expense_details']  = $expenseInfo['expense_details'];
        $response['expense_date']  = $expenseInfo['expense_date'];
        $response['eid']  = $expenseInfo['eid'];
        
		echo json_encode($response);
	}
?>