<?php

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <title>PharmSolv | Attendant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A comprehensive retail pharmacy management software to automate pharmacy daily routines, for pharmacies and drug stores" name="description" />
    <meta content="Online Pharmacy Management System" name="Jecmas Technologies" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/pharmsolv-logo-sm-light.png">

    <!-- third party css -->
    <link href="assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- <link href="assets/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" /> -->
    <!-- <link href="assets/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" /> -->
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

    <link rel="stylesheet" href="assets/css/pace.min.css">
    <script src="assets/js/pace.min.js"></script>


    <script>
        paceOptions = {
        // Configuration goes here. Example:
        elements: false,
        restartOnPushState: false,
        restartOnRequestAfter: false
        }
    </script>

    <style>
    /* background styling  */
    body{
        /* background-image: linear-gradient(0deg, rgba(255, 0, 150, 0.3), rgba(255, 0, 150, 0.3)), url(assets/images/pharmacy.jpg) ;
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-blend-mode:  multiply; */
    }

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

<body >

    <!-- Begin page -->
    <div id="wrapper">
