<?php

require_once 'db/db.php';

//Check if user is authenticated
// if(isset($_COOKIE['h_i'])){
//     $harsed_id = $_COOKIE['h_i'];
    
//   // ! Strip first 4 characters
//     $stripped = substr($harsed_id,2);
//     $get_selected_role = $stripped[0];
    
//     if($get_selected_role === 'a'){
//         // role is admin
    
//         echo "<script>window.location.href='index.php'</script>";
    
//     }else if($get_selected_role === 'o'){
//         // role is pharmacist
//          //! get user id
//          $get_id = substr($stripped,10);
    
//          $check_pharmacy_database = mysqli_query($connect_db,"SELECT * FROM `pharmacists_table` WHERE `pharmacists_id` = '$get_id' LIMIT 1") or die(mysqli_error($connect_db));
     
//          if(mysqli_num_rows($check_pharmacy_database) <= 0){
//              echo "<script>window.location.href='index.php'</script>";
//          }
//     }else{
//         echo "<script>window.location.href='index.php'</script>";
//     }
    
//     }else{
//         echo "<script>window.location.href='index.php'</script>";
//     }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>PharmSolv | Staff</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A powerful online pharmacy system for your shops" name="description" />
    <meta content="Pharmacy  Management System" name="Jecmas Technologies" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/bubbles_logo.jpg">

    <!-- third party css -->
    <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/jquery-nice-select/nice-select.css" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert-->
    <link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <!-- Jquery Toast css -->
    <link href="assets/libs/jquery-toast/jquery.toast.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Select -->
    <link href="assets/libs/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Datepicker -->
    <link href="assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/libs/switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />

    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/typeahead.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/pos-section.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/calc.css" rel="stylesheet" type="text/css" />

    <style type="text/css">
        /* ajax loading preloader */
     .preloader{
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      z-index: 99999;
      overflow: hidden;
      background: #ffffff;
      }

    .preloader:before {
      content: "";
      position: fixed;
      top: calc(50% - 30px);
      left: calc(50% - 30px);
      border: 6px solid #a41616;
      border-top-color: #464dee;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      -webkit-animation: animate-preloader 1s linear infinite;
      animation: animate-preloader 1s linear infinite;
      } 

    @-webkit-keyframes animate-preloader {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }

    @keyframes animate-preloader {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }
    </style>
</head>

<!-- <body > -->

    <!-- Begin page -->
    <!-- <div id="wrapper"> -->
    <!-- <div class="preloader"></div> -->


       