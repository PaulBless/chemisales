<?php

require_once '../../db/db.php';

## clean inputs data
$get_category_id = rtrim(htmlspecialchars($_POST['category_id']));
$clean_category_name = rtrim(htmlspecialchars($_POST['name']));
$clean_category_desc = rtrim(htmlspecialchars($_POST['description']));
$get_category_name = ucwords($clean_category_name);
$get_category_description = ucfirst($clean_category_desc);


## Run Database Query
$sql_stmt = "INSERT INTO `tbl_medicine_categories` (`mcid`, `med_cat_name`, `med_cat_comment`) 
VALUES (NULL, '$get_category_name', '$get_category_description')";

$addCategory = mysqli_query($connect_db, $sql_stmt) or die(mysqli_error($connect_db));
        
if($addCategory){
    echo "success";
}

?>
