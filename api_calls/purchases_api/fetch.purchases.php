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
   $searchQuery = " and (purchase_id like '%".$searchValue."%' or 
   purchase_details like'%".$searchValue."%' or 
   purchase_amount like'%".$searchValue."%' or 
   purchase_date like'%".$searchValue."%' 
   ) ";
}

// SELECT DISTINCT(purchase_id), purchase_details, purchase_amount, purchase_date, user_firstname, user_lastname from tbl_purchases join tbl_users on tbl_purchases.purchase_created_by = tbl_users.uid LIMIT 1


## Total number of records without filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_purchases");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_purchases WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select purchase_id, purchase_details, purchase_amount, purchase_date from tbl_purchases join tbl_users on tbl_purchases.purchase_created_by = tbl_users.uid  WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect_db, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "purchase_id"=>$row['purchase_id'],
      "purchase_details"=>$row['purchase_details'],
      "purchase_amount"=>$row['purchase_amount'],
      "purchase_date"=>$row['purchase_date'],
       "action"=>'<button class="btn btn-md btn-danger delete-purchase-button" id="'.$row['pid'].'">Delete</button>');
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);