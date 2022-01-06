
<?php 
   
error_reporting(1);
require_once 'session.php'; // triggers to check if user is logged in & authenticated
require_once 'db/db.php';
require_once 'template/header.admin.php'; 
require_once 'template/topnav.admin.php'; 
require_once 'template/menu.admin.php';   
require_once 'fetch-data/statistics.info.php';
require_once 'fetch-data/dashboard.info.php';


?>
   



            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content" >

                    <!-- Start Content-->
                    <div class="container-fluid" >
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <a href="pos.php" class="btn btn-info btn-xl  font-weight-bold float-right ml-4 waves-effect">POS</a>
                                        <ol class="breadcrumb m-0" style="font-size: 11px;">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                      <h4 class="page-title mb-1 font-weight-bold" style="color: #145388; letter-spacing: 1px;">System Admin  </h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 


                    <!-- Begin Row Summary of Records -->
                        <!-- Medicine History Row -->
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-2">Medicines</h4>

                                    <div class="mt-1">
                                        <div class="float-left" dir="ltr">
                                            <i class="la la-medkit la-5x btn-secondary-color" ></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_medicines) ? $total_medicines : '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;">Total Registered</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh "></i> Refresh</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3">Expired Medicines</h4>

                                    <div class="mt-1">
                                        <div class="float-left" dir="ltr">
                                            <i class="la la-exclamation-triangle la-5x btn-danger-color" ></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo (!empty($total_expired_medicines)) ? $total_expired_medicines : '0'; ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;"> Has Expired </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh </a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3">Medicines Near Expiry</h4>

                                    <div class="mt-1">
                                        <div class="float-left" dir="ltr">
                                                <i class="la la-bell la-5x text-warning" ></i>
                                           </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_medicines_near_expiry) ? $total_medicines_near_expiry : '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;"> Less Than A Month </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" id="refresh" class="dropdown-item"> <i class="la la-refresh"></i> Refresh </a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Stock Shortage</h4>

                                    <div class="mt-1">
                                        <div class="float-left" dir="ltr">
                                                <i class="la la-cart-plus la-5x text-purple" ></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_shortage) ? $total_shortage : '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;"> Out of Stock </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div>
                        <!-- end row --> 
                        
                        <!-- General History Row -->
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-2">Generic Names</h4>

                                    <div class="mt-1">
                                        <div class="float-left" dir="ltr">
                                            <i class="la la-tag la-5x btn-primary-color" ></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_generic_names) ? $total_generic_names : '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;">Total Recorded</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh "></i> Refresh</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Medicine Categories</h4>

                                    <div class="mt-1">
                                        <div class="float-left" dir="ltr">
                                            <i class="la la-tags la-5x" style="color: #56c2d6;"></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_medicine_categories) ? $total_medicine_categories : '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;">Total Recorded</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh </a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Staff & Users </h4>

                                    <div class="mt-1">
                                        <div class="float-left" dir="ltr">
                                                <i class="la la-users la-5x " style="color: #4a3ac7;" ></i>
                                           </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_staff_users) ? $total_staff_users : '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;"> Total Registered </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh </a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Suppliers </h4>

                                    <div class="mt-1">
                                        <div class="float-left" dir="ltr">
                                                <i class="la la-truck la-5x" style="color: #5089de;"></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_suppliers) ? $total_suppliers : '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;">Total Registered</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->

                        <!-- Sales History Row Data -->
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-2"> Sales </h4>

                                    <div class="mt-1 ">
                                        <div class="float-left d-none" dir="ltr">
                                            <i class="mdi mdi-coin la-3x " style="color: #23b397;" ></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1 text-center"> <?php echo !empty($total_sale_today) ? $currency. $total_sale_today : $currency. '0.00' ?> </h2>
                                            <p class="text-muted mb-0 " style="font-style: italicc;"> For Today </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh "></i> Refresh</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Sales</h4>

                                    <div class="mt-1">
                                        <div class="float-left d-none" dir="ltr">
                                            <i class="la la-money la-3x" style="color: #f8cc6b;"></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1 text-center"> <?php echo !empty($total_sale_yesterday) ? $currency. $total_sale_yesterday : $currency. '0' ?> </h2>
                                            <p class="text-muted mb-0 " style="font-style: italicc;"> For Yesterday </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh </a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Sales</h4>

                                    <div class="mt-1">
                                        <div class="float-left d-none" dir="ltr">
                                                <i class="la la-money la-3x " style="color: #02a8b5;" ></i>
                                           </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1 text-center"> <?php echo !empty($total_sale_week) ? $currency. $total_sale_week : $currency. '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;"> This Week </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh </a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Sales</h4>

                                    <div class="mt-1">
                                        <div class="float-left d-none" dir="ltr">
                                                <i class="la la-money la-5x" style="color: #f155c6;"></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1 text-center"> <?php echo !empty($total_sale_month) ? $currency. $total_sale_month : $currency. '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;">This Month</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div>
                        <!-- end row -->

                        <!-- Expenses History Row Data  -->
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-2">Expenses</h4>

                                    <div class="mt-1">
                                        <div class="float-left d-none" dir="ltr">
                                            <i class="la la-euro la-5x " style="color: #145388;" ></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_expense_today) ? $currency. $total_expense_today : $currency. '0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;"> For Today </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh "></i> Refresh</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Expenses</h4>

                                    <div class="mt-1">
                                        <div class="float-left d-none" dir="ltr">
                                            <i class="la la-euro la-5x" style="color: #56c2d6;"></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_expense_yesterday) ? $currency. $total_expense_yesterday : $currency.'0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;">For Yesterday </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh </a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Expenses </h4>

                                    <div class="mt-1">
                                        <div class="float-left d-none" dir="ltr">
                                                <i class="la la-euro la-5x " style="color: #4a3ac7;" ></i>
                                           </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_expense_week) ? $currency. $total_expense_week : $currency.'0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;"> This Week </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                            <div class="col-xl-3 col-md-6">
                                <div class="card-box">
                                    <div class="dropdown float-right">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-horizontal"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item" id="refresh"> <i class="la la-refresh"></i> Refresh </a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item"> <i class="fa fa-eye"></i> View List</a>
                                        </div>
                                    </div>

                                    <h4 class="header-title mt-0 mb-3"> Expenses </h4>

                                    <div class="mt-1">
                                        <div class="float-left d-none" dir="ltr">
                                                <i class="la la-euro la-5x" style="color: #98a6ad;"></i>
                                        </div>
                                        <div class="text-right">
                                            <h2 class="mt-3 pt-1 mb-1"> <?php echo !empty($total_expense_month) ? $currency. $total_expense_month : $currency.'0' ?> </h2>
                                            <p class="text-muted mb-0" style="font-style: italicc;">This Month</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div>
                        <!-- End Row -->
                    <!-- End Row Summary  -->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

    <?php 
    require_once 'template/footer.client.php';   
    ?>
                
<script>
$(document).ready(function(){
    $(document).on('click', '#refresh', function() {
        location.reload();
    });


}) ; 

</script>

<script type="text/javascript">
    var options = {
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
            columnWidth: "55%"
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
    colors: ["#1c8238", "#f0643b"],
    series: [{
        name: "Sales",
        data: [<?php echo implode( ", ", $sales_array ); ?>]
    }, {
        name: "Expenditure",
        data: [<?php echo implode( ", ", $expenditure_array ); ?>]
    }],
    xaxis: {
        categories: ["Jan","Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct","Nov","Dec"]
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
            colors: ["transparent", "transparent"],
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

var chart = new ApexCharts(document.querySelector("#apex-column-1"), options);

chart.render();

</script>