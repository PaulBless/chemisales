<?php

require_once '../../db/db.php';

## clean inputs data
$get_category_id = rtrim(htmlspecialchars($_POST['category_id']));
$clean_name = rtrim(htmlspecialchars($_POST['name']));
$clean_desc = rtrim(htmlspecialchars($_POST['description']));
$set_generic_name = ucwords($clean_name);
$set_generic_description = ucfirst($clean_desc);


## Run Database Query
$sql_stmt = "INSERT INTO `tbl_generic_names` (`genericid`, `generic_name`, `generic_description`, `generic_date_created`) 
VALUES (NULL, '$set_generic_name', '$set_generic_description', CURRENT_TIMESTAMP)";

$add_data = mysqli_query($connect_db, $sql_stmt) or die(mysqli_error($connect_db));
        
if($add_data){
    echo "success";
}

?>
