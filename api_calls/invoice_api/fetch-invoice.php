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
   $searchQuery = " and (related_invoice_id like '%".$searchValue."%' or 
   company_name like '%".$searchValue."%' or 
   total_amount like'%".$searchValue."%'  or 
   expiry_date like'%".$searchValue."%'  or 
   status like'%".$searchValue."%') ";
}

## Total number of records without filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_each_invoice ");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_each_invoice WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from tbl_each_invoice WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect_db, $empQuery);
$data = array();



    while ($row = mysqli_fetch_assoc($empRecords)) {
        $get_status = $row['status'];
        if($get_status === "pending"){
           $status =' <span class="badge badge-light-danger text-capitalize">'.$get_status.'</span>';
            }else{
            $status = '<span class="badge badge-light-secondary text-capitalize">'.$get_status.'</span>';
            }

        $data[] = array( 
           "related_invoice_id"=>$row['related_invoice_id'],
           "company_name"=>$row['company_name'],
           "total_amount"=>$row['total_amount'],
           "expiry_date"=>$row['expiry_date'],
           "status"=>$status,
           "action"=>'<div class="btn-group dropdown">
           <a href="javascript: void(0);" class="table-action-btn dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
           <div class="dropdown-menu dropdown-menu-right">
               <a class="dropdown-item" href="view_invoice.php?view='.$row['related_invoice_id'].'" data-id="'.$row['related_invoice_id'].'"><i class="mdi mdi-eye mr-2 text-muted font-18 vertical-middle" ></i>View Invoice</a>
               <a class="dropdown-item change-status-button" href="javascript:void(0)" data-id="'.$row['related_invoice_id'].'"><i class="mdi mdi-pencil mr-2 text-primary font-18 vertical-middle"></i>Edit Status</a>
               <a class="dropdown-item delete-invoice-button" href="javascript:void(0)" data-id="'.$row['related_invoice_id'].'"><i class="mdi mdi-delete mr-2 text-danger font-18 vertical-middle"></i>Delete Invoice</a>
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
                                      