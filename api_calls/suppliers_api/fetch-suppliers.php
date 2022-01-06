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
   $searchQuery = " and (supplier_name like '%".$searchValue."%' or 
   supplier_phone like'%".$searchValue."%' or 
   supplier_email like'%".$searchValue."%' or 
   supplier_address like'%".$searchValue."%' or 
   supplier_timestamp like'%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_suppliers");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_suppliers WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from tbl_suppliers WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect_db, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "supplier_name"=>$row['supplier_name'],
      "supplier_phone"=>$row['supplier_phone'],
      "supplier_email"=>$row['supplier_email'],
      "supplier_address"=>$row['supplier_address'],
      "supplier_timestamp"=>$row['supplier_timestamp'],
      "action"=>'<div class="btn-group dropdown">
      <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-default btn-flat btn-sm border-info text-dark" data-toggle="dropdown" aria-expanded="false"> Action <i class="mdi mdi-chevron-down"></i></a>
      <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item edit-supplier-button" href="javascript:void(0)" data-id="'.$row['supplier_id'].'"><i class="mdi mdi-pencil mr-1 text-primary font-18 vertical-middle" ></i>Edit Supplier</a>
            <a class="dropdown-item delete-supplier-button" href="javascript:void(0)"  data-id="'.$row['supplier_id'].'"><i class="mdi mdi-delete mr-1 text-danger font-18 vertical-middle"></i>Remove Supplier</a>
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