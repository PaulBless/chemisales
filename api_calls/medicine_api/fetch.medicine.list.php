<?php 

require_once '../../db/db.php';

## Get Settings | Currency
$get_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '7'") or die(mysqli_error($connect_db));
$get_currency_item = mysqli_fetch_array($get_currency);
$currency = $get_currency_item['settings_ans'];


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
   $searchQuery = " and (medicine_name like '%".$searchValue."%' or 
   medicine_description like'%".$searchValue."%' or 
   generic_name like'%".$searchValue."%' or 
   med_cat_name like'%".$searchValue."%' or 
   selling_price like'%".$searchValue."%' or 
   cost_price like'%".$searchValue."%') ";
}

## Total number of records without filtering
// $sel = mysqli_query($connect_db,"select count(*) as allcount from `tbl_medicines` join `tbl_generic_names` on `tbl_medicines`.`generic_id` = `tbl_generic_names`.`genericid` join `tbl_medicine_categories` on `tbl_medicines`.`category_id` = `tbl_medicine_categories`.`mcid` join `tbl_suppliers` on `tbl_medicines`.`suppliers_id` = `tbl_suppliers`.`supplier_id` ");
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_medicines m inner join tbl_medicine_categories mc on m.category_id=mc.mcid inner join tbl_generic_names gn on m.generic_id=gn.genericid");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
## Total number of records without filtering
// $sel = mysqli_query($connect_db,"select count(*) as allcount from `tbl_medicines` join `tbl_generic_names` on `tbl_medicines`.`generic_id` = `tbl_generic_names`.`genericid` join `tbl_medicine_categories` on `tbl_medicines`.`category_id` = `tbl_medicine_categories`.`mcid` join `tbl_suppliers` on `tbl_medicines`.`suppliers_id` = `tbl_suppliers`.`supplier_id` WHERE 1 ".$searchQuery);
$sel = mysqli_query($connect_db,"select count(*) as allcount from tbl_medicines m inner join tbl_medicine_categories mc on m.category_id=mc.mcid inner join tbl_generic_names gn on m.generic_id=gn.genericid WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
// $empQuery = "select * from `tbl_medicines` join `tbl_generic_names` on `tbl_medicines`.`generic_id` = `tbl_generic_names`.`genericid` join `tbl_medicine_categories` on `tbl_medicines`.`category_id` = `tbl_medicine_categories`.`mcid` join `tbl_suppliers` on `tbl_medicines`.`suppliers_id` = `tbl_suppliers`.`supplier_id` WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empQuery = "select * from tbl_medicines m inner join tbl_medicine_categories mc on m.category_id=mc.mcid inner join tbl_generic_names gn on m.generic_id=gn.genericid WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($connect_db, $empQuery);
$data = array();
$counter = 1;


while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "medicine_code"=>$row['medicine_code'],
      "medicine_name"=>$row['medicine_name'],
      "medicine_description"=>$row['medicine_description'],
      "cost_price"=>$currency. ' '.$row['cost_price'],
      "selling_price"=>$currency.' '.$row['selling_price'],
      "med_cat_name"=>$row['med_cat_name'],
      "generic_name"=>$row['generic_name'],
      "dosage"=>$row['dosage'],
      "package_size"=>$row['package_size'],
      "brand_name"=>$row['brand_name'],
      "medicine_expiry_date"=>date('M d, Y', strtotime($row['medicine_expiry_date'])),
      "created_on"=>date('d M, Y', strtotime($row['created_on']))

   );
   // $counter ++;
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);