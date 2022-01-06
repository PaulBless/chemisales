<?php

    require_once '../../db/db.php';

    $get_generic_id = $_POST['genericid'];
    $name = rtrim(htmlspecialchars($_POST['generic_name']));
    $desc = rtrim(htmlspecialchars($_POST['generic_description']));
    $get_generic_name = ucwords($name);
    $get_generic_description = ucfirst($desc);
        
    if(isset($_POST['genericid']))
    {
        $updategeneric = mysqli_query($connect_db,"UPDATE `tbl_generic_names` SET `generic_name` = '$get_generic_name', `generic_description`='$get_generic_description' WHERE `tbl_generic_names`.`genericid` = '$get_generic_id'") or die(mysqli_error($connect_db));
        if($updategeneric){
            echo "success";
        }
    }else{
        echo "error";
    }

    

?>	
	