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
   $searchQuery = " and (generic_name like '%".$searchValue."%' or 
   generic_description like'%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_generic_names");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_generic_names WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from tbl_generic_names WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect_db, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
       "genericid"=>$row['genericid'],
      "generic_name"=>$row['generic_name'],
      "generic_description"=>$row['generic_description'],
      "generic_date_created"=>$row['generic_date_created'],
      "action"=>'<div class="btn-group dropdown">
      <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-default btn-flat btn-sm border-info text-dark" data-toggle="dropdown" aria-expanded="false"> Action <i class="mdi mdi-chevron-down"></i></a>
      <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item edit-button" href="javascript:void(0)" data-id="'.$row['genericid'].'"><i class="mdi mdi-pencil mr-1 text-primary font-18 vertical-middle" ></i>Edit </a>
            <a class="dropdown-item delete-button" href="javascript:void(0)"  data-id="'.$row['genericid'].'"><i class="mdi mdi-delete mr-1 text-danger font-18 vertical-middle"></i>Delete </a>
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