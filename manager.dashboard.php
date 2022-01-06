
<?php 
   
require_once 'session.php'; // triggers to check if user is logged in & authenticated
require_once 'db/db.php';
require_once 'template/header.manager.php'; 
require_once 'template/topnav.manager.php'; 
require_once 'template/menu.manager.php';   
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
                                        <ol class="breadcrumb m-0" style="font-size: 11px;">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">PharmSolv</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Manager</a></li>
                                            <li class="breadcrumb-item active">Dashboard</li>
                                        </ol>
                                    </div>
                                      <h4 class="page-title font-weight-bold mb-2" style="letter-spacing: 1px; color: #145388;">Manager Dashboard </h4>
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
                        
                        
                       
                    <!-- Sales & Expenditure Chart  -->
                    <div class="row">
                            <div class="col-xl-12">
                                <!-- Portlet card -->
                                <div class="card" >
                                    <div class="card-body">
                                        <div class="card-widgets">
                                            <a href="javascript: void(0);" data-toggle="reload"><i class="mdi mdi-refresh"></i></a>
                                            <a data-toggle="collapse" href="#cardCollpase1" role="button" aria-expanded="false" aria-controls="cardCollpase1"><i class="mdi mdi-minus"></i></a>
                                            <a href="javascript: void(0);" data-toggle="remove"><i class="mdi mdi-close"></i></a>
                                        </div>
                                        <h4 class="header-title mb-0">Sales & Expenditure Analytics</h4>

                                        <div id="cardCollpase1" class="collapse pt-3 show" dir="ltr">
                                            <div id="apex-column-1" class="apex-charts"></div>
                                        </div> <!-- collapsed end -->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                        <!-- start page title -->
         
                     
                        <!-- Sales and Staff History   -->
                        <div class="row col-12">
                            <div class="col-lg-6 col-md-6">
                                 <div class="card-box" >
                                    <h4 class="header-title">Sales & Expense Statistics</h4>
                                    <p class="sub-header">
                                    Statistics For This Month - <span class="text-dark font-weight-bold"> <?php echo date('F')?></span>
                                    </p>
        
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead class="d-none">
                                                <th>No</th>
                                                <th> Statistics Title</th>
                                                <th> Statistics Value </th>
                                            </thead>

                                            <tbody>
                                           
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>Total Items Sold </td>
                                                <td><?php 
                                                   $total_counter = 0;
                                                   $this_month = date('Y-m');
                                                //    $get_number = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` LIKE '%$this_month%'")or die(mysqli_error($connect_db));
                                                   $get_number = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE YEAR(sales_datetime)=YEAR(CURDATE()) AND MONTH(sales_datetime)=MONTH(CURDATE())
                                                ")or die(mysqli_error($connect_db));
                                               
                                               while ($get_each_month = mysqli_fetch_array($get_number)){
                                                  $selected_sale = $get_each_month['sales_number'];
                                                  $sale_amount = $get_each_month['sales_total'];

                                                  $get_all_related = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number` = '$selected_sale'")or die($connect_db);
                                                   while ($each_sale = mysqli_fetch_array($get_all_related)) {
                                                       $total_counter+= $each_sale['medicineQty'];
                                                   }
                                               }
                                               echo $total_counter;
                                                   
                                                ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">2</th>
                                                <td>Total Sales Amount</td>
                                                <td><?php 
                                                  $my_current_month = intval(date('m'));
                                                  $calculated_month = $my_current_month-=1;

                                                echo "<span class='badge badge-success font-13'>".$currency." ".$sales_array[$calculated_month]."</span>";
                                                 
                                                ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>Number Of Expense</td>
                                                <td><?php
                                                 $expense_number_counter = 0;
                                                 $this_month = date('Y-m');
                                                $get_all_expenses = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE `expense_date` LIKE '%$this_month%'")or die(mysqli_error($connect_db));
                                                while ($each_expense = mysqli_fetch_array($get_all_expenses)) {
                                                    $expense_number_counter ++;
                                                }

                                                echo $expense_number_counter;
                                                ?></td>
                                                
                                            </tr>
                                            <tr>
                                                <th scope="row">4</th>
                                                <td>Total Expense Amount</td>
                                                <td><?php
                                                  $expense_counter = 0;
                                                  $this_month = date('Y-m');
                                                 $get_all_expenses = mysqli_query($connect_db,"SELECT * FROM `tbl_expenses` WHERE `expense_date` LIKE '%$this_month%'")or die(mysqli_error($connect_db));
                                                 while ($each_expense = mysqli_fetch_array($get_all_expenses)) {
                                                     $expense_counter += $each_expense['expense_amount'];
                                                 }
 
                                                 echo "<span class='badge badge-danger font-13'>".$currency." ".$expense_counter."</span>";
                                                
                                                
                                                ?></td>
                                                
                                            </tr>
                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->

                            <div class="col-lg-6 col-md-6">
                                 <div class="card-box" >
                                    <h4 class="header-title">Staff</h4>
                                    <p class="sub-header">
                                    List of your staff
                                    </p>
        
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                        <thead class="text-dark">
                                        <tr>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        </tr>
                                        
                                        </thead>
                                            <tbody>
                                            <?php  
                                            
                                            $getUserInfo = mysqli_query($connect_db,"SELECT * FROM tbl_users join tbl_account_status on tbl_users.user_status = tbl_account_status.asid join tbl_roles on tbl_users.user_type = tbl_roles.rid ORDER BY `user_date_created` DESC")or die(mysqli_error($connect_db));
                                            while($userInfo = mysqli_fetch_array($getUserInfo)){  
                                        
                                            $get_users_fullname = $userInfo['user_firstname']." ".$userInfo['user_lastname'];
                                            $get_users_contact = $userInfo['user_mobileno'];
                                            $get_users_priority = $userInfo['role_name'];
                                            $get_users_status = $userInfo['status_name'];
                                            $get_users_asid = $userInfo['user_status'];
                                            ?>

                                            <tr>
                                            <td>
                                            <span class="ml-0"><?php echo $get_users_fullname;   ?></span>
                                            </td>

                                            <td>
                                            <?php echo $get_users_contact;   ?>
                                            </td>

                                            <td>
                                            <?php echo $get_users_priority;  ?>
                                            </td>

                                            <td>
                                            <?php 
                                            if($get_users_asid === '1'){ ?>
                                                <span class="badge badge-light-danger"><?php echo $get_users_status;   ?></span>
                                            <?php }else{ ?>
                                                <span class="badge btn-info"><?php echo $get_users_status;   ?></span>
                                            <?php } ?>
                                            </td>
                                            
                                            
                                          <?php  }  ?>
                                           
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
        
                            
                        </div>
                        <!--- end row -->
                       

                    </div> <!-- container -->

                </div> <!-- content -->

    
    
    <?php 
    // require_once 'template/footer.main.php';   
    require_once 'template/footer.client.php';   
    ?>
                
               
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
            columnWidth: "60%"
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