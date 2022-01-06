<?php

    require_once '../../db/db.php';

    $get_category_id = $_POST['categoryid'];
    $cat_name = rtrim(htmlspecialchars($_POST['category_name']));
    $cat_desc = rtrim(htmlspecialchars($_POST['category_description']));
    $get_category_name = ucwords($cat_name);
    $get_category_description = ucfirst($cat_desc);
        
    if(isset($_POST['categoryid']))
    {
        $updateCategory = mysqli_query($connect_db,"UPDATE `tbl_medicine_categories` SET `med_cat_name` = '$get_category_name', `med_cat_comment`='$get_category_description' WHERE `tbl_medicine_categories`.`mcid` = '$get_category_id'") or die(mysqli_error($connect_db));
        if($updateCategory){
            echo "success";
        }
    }else{
        echo "error";
    }

    

?>	
	