<?php  

    // Include Files
    require_once 'session.php';  
    // Role Based Access Management
    if($users_role === '1'){
        require_once 'db/db.php'; 
        require_once 'template/header.admin.php'; 
        require_once 'template/topnav.admin.php'; 
        require_once 'template/menu.admin.php'; 
        require_once 'profits/profit.january.php'; 
        require_once 'profits/profit.february.php'; 
        require_once 'profits/profit.march.php'; 
        require_once 'profits/profit.april.php'; 
        require_once 'profits/profit.may.php'; 
        require_once 'profits/profit.june.php'; 
        require_once 'profits/profit.july.php'; 
        require_once 'profits/profit.august.php'; 
        require_once 'profits/profit.september.php'; 
        require_once 'profits/profit.october.php'; 
        require_once 'profits/profit.november.php'; 
        require_once 'profits/profit.december.php'; 


     }else if ($users_role === '2'){
        require_once 'db/db.php'; 
        require_once 'template/header.manager.php'; 
        require_once 'template/topnav.manager.php'; 
        require_once 'template/menu.manager.php'; 
        require_once 'profits/profit.january.php'; 
        require_once 'profits/profit.february.php'; 
        require_once 'profits/profit.march.php'; 
        require_once 'profits/profit.april.php'; 
        require_once 'profits/profit.may.php'; 
        require_once 'profits/profit.june.php'; 
        require_once 'profits/profit.july.php'; 
        require_once 'profits/profit.august.php'; 
        require_once 'profits/profit.september.php'; 
        require_once 'profits/profit.october.php'; 
        require_once 'profits/profit.november.php'; 
        require_once 'profits/profit.december.php';  
    }else{
        echo "<script>window.location.href='index.php'</script>";
    }

?>

<?php 
    // Query Database For Settings Information
    $get_system_name = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 1") or die(mysqli_error($connect_db));
    $get_name = mysqli_fetch_array($get_system_name);
    $system_name = $get_name['settings_ans'];

    $get_system_title = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 2") or die(mysqli_error($connect_db));
    $get_title = mysqli_fetch_array($get_system_title);
    $system_title = $get_title['settings_ans'];

    $get_address = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 3") or die(mysqli_error($connect_db));
    $get_address_item = mysqli_fetch_array($get_address);
    $address = $get_address_item['settings_ans'];

    $get_contact = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 4") or die(mysqli_error($connect_db));
    $get_contact_item = mysqli_fetch_array($get_contact);
    $contact = $get_contact_item['settings_ans'];

    $get_email = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 5") or die(mysqli_error($connect_db));
    $get_email_item = mysqli_fetch_array($get_email);
    $email = $get_email_item['settings_ans'];

    $get_quantity_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 6") or die(mysqli_error($connect_db));
    $get_quantity_alert_item = mysqli_fetch_array($get_quantity_alert);
    $quantity_alert = $get_quantity_alert_item['settings_ans'];

    $get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];

    $get_expire_alert = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 8") or die(mysqli_error($connect_db));
    $get_expire_alert_item = mysqli_fetch_array($get_expire_alert);
    $expire_alert = $get_expire_alert_item['settings_ans'];

    $get_invoice_due = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 9") or die(mysqli_error($connect_db));
    $get_invoice_due_item = mysqli_fetch_array($get_invoice_due);
    $invoice_due = $get_invoice_due_item['settings_ans'];


    $get_profile_pic = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 10") or die(mysqli_error($connect_db));
    $get_profile_pic_item = mysqli_fetch_array($get_profile_pic);
    $profile = $get_profile_pic_item['settings_ans'];

?>


            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page bg-light">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid ">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0 d-nonee" style="font-size: 11px;">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                            <li class="breadcrumb-item" id="user-type"><a href="javascript: void(0);"></a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Statistics</a></li>
                                            <li class="breadcrumb-item active">Sales Profits</li>
                                        </ol> 
                                    </div>
                                    <h4 class="page-title font-weight-bold" style="color: #145388; letter-spacing: 1px;">Statistics : <span class="text-secondary"> Sales Profits </span> </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        
                      
                      
                    <!-- Sales / Profits -->
                        <div class="row col-12">
                            <!-- January Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0"> January, <?php echo date('Y'); ?></h4>

                                        <div id="cardCollpase1" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-january" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->
                            
                            <!-- February Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase2" role="button" aria-expanded="false" aria-controls="cardCollpase2"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0"> February, <?php echo date('Y'); ?>
                                        </h4>

                                        <div id="cardCollpase2" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-february" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col --> 
                            
                            <!-- March Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase3" role="button" aria-expanded="false" aria-controls="cardCollpase3"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">March, <?php echo date('Y'); ?></h4>

                                        <div id="cardCollpase3" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-march" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->  
                            
                            <!-- April Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase4" role="button" aria-expanded="false" aria-controls="cardCollpase4"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">April, <?php echo date('Y'); ?> </h4>

                                        <div id="cardCollpase4" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-april" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                        
                        <div class="row col-12">
                            <!-- May Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase5" role="button" aria-expanded="false" aria-controls="cardCollpase5"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0"> May, <?php echo date('Y'); ?></h4>

                                        <div id="cardCollpase5" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-may" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->
                            
                            <!-- June Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase6" role="button" aria-expanded="false" aria-controls="cardCollpase6"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0"> June, <?php echo date('Y'); ?></h4>

                                        <div id="cardCollpase6" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-june" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col --> 
                            
                            <!-- July Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase7" role="button" aria-expanded="false" aria-controls="cardCollpase7"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">July, <?php echo date('Y'); ?></h4>

                                        <div id="cardCollpase7" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-july" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->  
                            
                            <!-- August Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase8" role="button" aria-expanded="false" aria-controls="cardCollpase8"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">August, <?php echo date('Y'); ?> </h4>

                                        <div id="cardCollpase8" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-august" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->
                        </div> 
                        
                        <div class="row col-12">
                            <!-- September Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase9" role="button" aria-expanded="false" aria-controls="cardCollpase9"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0"> September, <?php echo date('Y'); ?></h4>

                                        <div id="cardCollpase9" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-september" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->
                            
                            <!-- October Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase10" role="button" aria-expanded="false" aria-controls="cardCollpase10"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0"> October, <?php echo date('Y'); ?></h4>

                                        <div id="cardCollpase10" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-october" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col --> 
                            
                            <!-- November Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase11" role="button" aria-expanded="false" aria-controls="cardCollpase11"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">November, <?php echo date('Y'); ?></h4>

                                        <div id="cardCollpase11" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-november" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->  
                            
                            <!-- December Month  -->
                            <div class="col-lg-3 col-md-3">
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase12" role="button" aria-expanded="false" aria-controls="cardCollpase12"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">December, <?php echo date('Y'); ?> </h4>

                                        <div id="cardCollpase12" class="collapse pt-3 show" dir="ltr">
                                            <div id="sales-december" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-box --> 
                                </div>
                                <!-- end card-box -->
                            </div> <!-- end col -->
                        </div>
                    <!-- End Sales / Profits  -->

                    </div> <!-- container -->

                </div> <!-- content -->
                


    




<?php require_once 'template/footer.client.php';   ?>
<script src="assets/js/jquery-upload.js"></script>

<script type='text/javascript'>
    $(document).ready(function(){   
        
        // get login user
        var type_text = '<?php echo $users_role?>';
        if(type_text === '1'){
            $('#user-type').html('Admin') ;
        }else{
            $('#user-type').html('Manager');
        }

        // set datetime format
        $(".datepicker").datepicker({
            orientation: 'bottom',
            autoclose: true,
        });
      
    });

</script>

<script type="text/javascript">

// january profit data for chart 
var january = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#414d5f", "#5089de"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $january_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $january_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "January" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// february profit data for chart 
var february = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#414d5f", "#5089de"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $february_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $february_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "February" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// march profit data for chart 
var march = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#414d5f", "#5089de"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $march_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $march_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "March" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// april profit data for chart 
var april = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#414d5f", "#5089de"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $april_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $april_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "April" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// may profit data for chart 
var may = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#23b397", "#f8cc6b", "#56c2dc"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $may_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $may_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "May" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// june profit data for chart 
var june = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#23b397", "#f8cc6b", "#56c2dc"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $june_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $june_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "June" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// july profit data for chart 
var july = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#23b397", "#f8cc6b", "#56c2dc"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $july_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $july_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "July" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// august profit data for chart 
var august = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#23b397", "#f8cc6b", "#56c2dc"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $august_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $august_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "August" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// september profit data for chart 
var september = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#f0643b", "#56c2dc"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $september_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $september_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "September" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// october profit data for chart 
var october = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#f0643b", "#56c2dc"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $october_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $october_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "October" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// november profit data for chart 
var november = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#f0643b", "#56c2dc"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $november_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $november_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "November" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};

// december profit data for chart 
var december = {
    chart: {
        height: 380,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            horizontal: !1,
            endingShape: "rounded",
            columnWidth: "65%"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    colors: ["#f0643b", "#56c2dc"],
    series: [
        {
        name: "Sales",
        data: [<?php echo implode( ", ", $december_sales_array ); ?>]
        }, 
        
        {
        name: "Profit",
        data: [<?php echo implode( ", ", $december_profit_array ); ?>]
        }
    ],
    xaxis: {
        categories: [ "December" ]
    },
    legend: {
        offsetY: -10
    },
    yaxis: {
        title: {
            text: "<?php echo $currency; ?>"
        }
    },
    fill: {
        opacity: 1
    },
    grid: {
        row: {
            colors: ["transparent", "transparent", "transparent"],
            opacity: .2
        },
        borderColor: "#f1f3fa"
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "<?php echo $currency; ?>" + e + " "
            }
        }
    }

};


// draw chart for january
var chart_january = new ApexCharts(document.querySelector("#sales-january"), january);
chart_january.render();

// draw chart for february
var chart_february= new ApexCharts(document.querySelector("#sales-february"), february);
chart_february.render();

// draw chart for march
var chart_march= new ApexCharts(document.querySelector("#sales-march"), march);
chart_march.render();

// draw chart for april
var chart_april= new ApexCharts(document.querySelector("#sales-april"), april);
chart_april.render();

// draw chart for may 
var chart_may = new ApexCharts(document.querySelector("#sales-may"), may);
chart_may.render();

// draw chart for june 
var chart_june = new ApexCharts(document.querySelector("#sales-june"), june);
chart_june.render();

// draw chart for july
var chart_july = new ApexCharts(document.querySelector("#sales-july"), july);
chart_july.render();

// draw chart for august
var chart_august = new ApexCharts(document.querySelector("#sales-august"), august);
chart_august.render();

// draw chart for september
var chart_september = new ApexCharts(document.querySelector("#sales-september"), september);
chart_september.render();

// draw chart for october
var chart_october = new ApexCharts(document.querySelector("#sales-october"), october);
chart_october.render();

// draw chart for november
var chart_november = new ApexCharts(document.querySelector("#sales-november"), november);
chart_november.render();

// draw chart for december
var chart_december = new ApexCharts(document.querySelector("#sales-december"), december);
chart_december.render();



</script>