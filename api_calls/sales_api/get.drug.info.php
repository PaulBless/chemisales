<?php

session_start();
require_once('../../db/db.php');

if(isset($_POST['addpos']) && !empty($_POST['id'])){
    
    // $drugid = $_POST['id'];
    $drugid = filter_input(INPUT_GET, 'id');

    $sql = "SELECT * FROM `product` WHERE `id` = '$drugid'";
    $query = $connect_db->query($sql);
    $row = $query->fetch_assoc();

    echo json_encode($row);	// pass results to json format
    var_dump($row);
}

?>