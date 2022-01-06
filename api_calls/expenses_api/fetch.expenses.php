<?php require_once '../../db/db.php';


## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (expense_id like '%".$searchValue."%' or 
   expense_details like '%".$searchValue."%' or 
   expense_amount like'%".$searchValue."%' or 
   expense_date like'%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from `tbl_expenses` e inner join `tbl_users` u on e.expense_creator=u.uid ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from `tbl_expenses` e inner join `tbl_users` u on e.expense_creator=u.uid WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from `tbl_expenses` e inner join `tbl_users` u on e.expense_creator=u.uid WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect_db, $empQuery);
$data = array();

    while ($row = mysqli_fetch_assoc($empRecords)) {

        $data[] = array( 
           "expense_id"=>$row['expense_id'],
           "expense_details"=>$row['expense_name'],
           "expense_amount"=>$row['expense_amount'],
           "expense_creator"=>$row['user_firstname'].' '.$row['user_lastname'],
           "expense_date"=>date('d M, Y', strtotime($row['expense_date']))
          
        );
     }


## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);
                                      