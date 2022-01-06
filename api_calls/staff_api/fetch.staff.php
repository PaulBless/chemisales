<?php 

require_once '../../db/db.php';

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
   $searchQuery = " and (user_firstname like '%".$searchValue."%' or 
   user_lastname like'%".$searchValue."%' or 
   user_loginid like'%".$searchValue."%') ";
}

## Total number of records without filtering
// $sel = mysqli_query($connect_db,"select count(*) as allcount from `tbl_users` inner join tbl_account_status on tbl_users.user_status=tbl_account_status.asid join tbl_roles on tbl_users.user_type=tbl_roles.rid");
$sel = mysqli_query($connect_db,"select count(*) as allcount from `tbl_users`");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from `tbl_users` inner join tbl_account_status on tbl_users.user_status=tbl_account_status.asid join tbl_roles on tbl_users.user_type=tbl_roles.rid WHERE 1 ".$searchQuery);
// $sel = mysqli_query($connect_db,"select count(*) as allcount from `tbl_users` WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "SELECT * FROM `tbl_users` JOIN `tbl_account_status` ON `tbl_users`.`user_status` = `tbl_account_status`.`asid` JOIN `tbl_roles` ON `tbl_users`.`user_type` = `tbl_roles`.`rid` WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
// $empQuery = "SELECT * FROM `tbl_users` WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect_db, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
       "user_code"=>$row['user_code'],
      "user_firstname"=>$row['user_firstname'],
      "user_lastname"=>$row['user_lastname'],
      "user_mobileno"=>$row['user_mobileno'],
      "user_loginid"=>$row['user_loginid'],
      "role_name"=>$row['role_name'],
      "status_name"=>$row['status_name'],
      "action"=>'<div class="btn-group dropdown">
        <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-default btn-flat btn-sm border-info text-dark" data-toggle="dropdown" aria-expanded="false"> Action <i class="mdi mdi-chevron-down"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item edit-button" href="javascript:void(0)" data-id="'.$row['uid'].'"><i class="mdi mdi-pencil mr-1 text-primary font-16 vertical-middle" ></i>Edit Staff</a><div class="dropdown-divider"></div>
            <a class="dropdown-item reset-button" href="javascript:void(0)" data-id="'.$row['uid'].'"><i class="mdi mdi-lock-plus mr-1 text-dark font-12 vertical-middle" ></i>Reset Password</a><div class="dropdown-divider"></div>
            <a class="dropdown-item delete-button" href="javascript:void(0)"  data-id="'.$row['uid'].'"><i class="mdi mdi-delete mr-1 text-danger font-16 vertical-middle"></i>Delete Staff</a>
        </div>
        </div>'
     
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