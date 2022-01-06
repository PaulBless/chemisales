<?php 
    require_once 'db/db.php';

    $expire_alert_medicine_name = [];
    $expire_alert_remaining = [];

    $expired_medicine_name = [];
    $expired_medicine_expiry = [];

    $stock_alert_remain = [];
    $stock_alert_name = [];

    $expired_counter = 0;
    $expire_alert_counter = 0;
    $stock_alert_counter = 0;


    $get_minimum_expire_alert = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE settings_id = 8") or die(mysqli_error($connect_db));
    $get_minimum_item = mysqli_fetch_array($get_minimum_expire_alert);
    $minimum = $get_minimum_item['settings_ans'];  

    $getProductInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` ORDER BY `tbl_medicines`.`mid` ASC")or die(mysqli_error($connect_db));
    while($product_info = mysqli_fetch_array($getProductInfo)){  

    $get_expiry= $product_info['medicine_expiry_date'];
    $get_product_name = $product_info['medicine_name'];
                                                
    $get_current_date = date_create(date("d-M-Y"));
    $check_expire = date_create(date('d-M-Y', strtotime($get_expiry))); 
    $interval = date_diff( $get_current_date, $check_expire);

    $remaining_days = intval($interval->format('%R%a'));
    $months_remaining = $interval->format('%m months remaining');
                                            
?>
<?php
    // if ($months_remaining <= $minimum && $remaining_days < 0) {
    if ($remaining_days <= $minimum || $remaining_days < 0) {
        $expired_counter++;
        array_push($expired_medicine_expiry,$get_expiry);
        array_push($expired_medicine_name,$get_product_name);
    // }else if($months_remaining <= $minimum && $remaining_days > 0){
    }else if($months_remaining = $minimum && $remaining_days > 0){
        $expire_alert_counter++;
        array_push($expire_alert_remaining,$remaining_days);
        array_push($expire_alert_medicine_name,$get_product_name);
    }else{
        
    }
};



    $get_minimum_stock_alert = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '6'") or die(mysqli_error($connect_db));
    $get_minimum_item = mysqli_fetch_array($get_minimum_stock_alert);
    $minimum = $get_minimum_item['settings_ans'];

    $getProductInfo = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` JOIN `tbl_temporary_stocks` on `tbl_medicines`.`mid` = `tbl_temporary_stocks`.`medicine_id` WHERE `tbl_temporary_stocks`.`stock_level` <= '$minimum' ORDER BY `tbl_medicines`.`mid` ASC")or die(mysqli_error($connect_db));
    while($product_info = mysqli_fetch_array($getProductInfo)){  
        $get_product_name = $product_info['medicine_name'];
        $get_product_quantity = $product_info['stock_level'];

    $stock_alert_counter++;
    array_push($stock_alert_name,$get_product_name);
    array_push($stock_alert_remain,$get_product_quantity);
        
    }

?>


<!-- Topbar Start -->
 <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <li class="d-none d-sm-block">
                        
                        <!-- <form class="app-search">
                            <div class="app-search-box">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button class="btn" type="submit">
                                            <i class="fe-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form> -->
                        
                    </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-cart-off noti-icon"></i>
                        <span
                            class="badge badge-success rounded-circle noti-icon-badge"><?php echo $stock_alert_counter  ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                         <!-- item -->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0 text-white">
                                Stock Alert List
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">

                            <?php
                                     $get_length_of_stock_alert = sizeof($stock_alert_name);

                                     for ($i=0; $i < $get_length_of_stock_alert; $i++) { 
                                        $current_stock_name = $stock_alert_name[$i];
                                         $current_stock_remain = $stock_alert_remain[$i];

                                    ?>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item"> 
                                <div class="notify-icon">
                                    <img class="img-fluid rounded-circle" src="assets/images/pharmsolv-logo-sm-dark.jpg" height="28" alt="" /> 
                                </div>
                                <p class="notify-details"><?php echo $current_stock_name; ?> has</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small><?php echo $current_stock_remain; ?> items remaining</small>
                                </p>
                            </a> 


                            <?php } ?>

                            <!-- All-->
                            <a href="stocks.alerts.php"
                                class="dropdown-item text-center text-primary notify-item notify-all">
                                View List
                                <i class="mdi mdi-arrow-right"></i>
                            </a>

                        </div>
                </li> 

                <li class="dropdown notification-list"> 
                    <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i class="fas fa-bell noti-icon"></i>
                        <span
                            class="badge badge-primary rounded-circle noti-icon-badge"><?php echo $expire_alert_counter; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                         <!-- item -->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0 text-white font-weight-bold">
                                Expiry Alert
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">
                            <?php
                                    $get_length_of_expired = sizeof($expire_alert_medicine_name);

                                    for ($i=0; $i < $get_length_of_expired; $i++) { 
                                        $current_expire_name = $expire_alert_medicine_name[$i];
                                        $current_expire_remain = $expire_alert_remaining[$i];

                                    ?>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon"> 
                                    <img class="img-fluid rounded-circle" src="assets/images/pharmsolv-logo-sm-dark.jpg" height="28" alt="" /> </div>
                                <p class="notify-details"><?php echo $current_expire_name; ?> has</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small class="text-primary"><?php echo $current_expire_remain; ?> days to expire</small>
                                </p>
                            </a>


                            <?php  } ?>

                            <!-- All-->
                            <a href="expiry.alerts.php"
                                class="dropdown-item text-center text-primary notify-item notify-all">
                                View List
                                <i class="mdi mdi-arrow-right"></i>
                            </a>

                        </div>
                </li> 

                <li class="dropdown notification-list"> 
                     <a class="nav-link dropdown-toggle  waves-effect" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                        <i class="fas fa-exclamation-triangle noti-icon"></i>
                        <span
                            class="badge badge-danger rounded-circle noti-icon-badge"><?php echo $expired_counter; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0 text-white font-weight-bold">
                                Expired Medicines
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">
                            <?php
                                    $get_length_of_expired = sizeof($expired_medicine_name);

                                    for ($i=0; $i < $get_length_of_expired; $i++) { 
                                        $current_expire_name = $expired_medicine_name[$i];
                                        $current_expire_expiry = $expired_medicine_expiry[$i];

                                    ?>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon"> 
                                    <img src="assets/images/pharmsolv-logo-sm-light.png" height="28" class="mdi mdi-cart-off img-fluid rounded-circle" alt="" /> 
                                </div>
                                <p class="notify-details"><?php echo $current_expire_name; ?> expired on</p>
                                <p class="text-muted mb-0 user-msg">
                                    <small class="text-danger"><?php echo date('d-M-Y', strtotime($current_expire_expiry)); ?></small>
                                </p>
                            </a>


                            <?php  } ?> 



                            <!-- All-->
                            <a href="expired.medicines.php"
                                class="dropdown-item text-center text-primary notify-item notify-all">
                                View List
                                <i class="mdi mdi-arrow-right"></i>
                            </a>

                        </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/default.png" alt="" class="rounded-circle ml-4">
                        <span class="pro-user-name ml-0">
                            <?php echo $users_fullname; ?> <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h6 class="m-0 text-white">
                               Hi, <?php echo $users_fullname; ?>
                            </h6>
                        </div>

                        <!-- item-->
                        <a href="my.account.php" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>My Account</span>
                        </a>


                        <div class="dropdown-divider"></div>
                        
                        <!-- item-->
                        <a href="lock-out.php" class="dropdown-item notify-item d-none">
                            <i class="fe-lock"></i>
                            <span>Lock Screen</span>
                        </a>

                        <!-- <div class="dropdown-divider"></div> -->

                        <!-- item-->
                        <a href="logout.php" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
                </li>
                
                <!-- Setting Slide Option --> 
                <!-- <li class="dropdown notification-list">
                    <a href="settings.php" class="nav-link right-bar-toggle waves-effect">
                        <i class="fe-settings noti-icon"></i>
                    </a>
                </li> -->


            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="manager.dashboard.php" class="logo text-center">
                    <span class="logo-lg ">
                        <img src="assets/images/pharmsolv-dark.jpg" alt="PharmSolv" height="60">
                    </span> 
                    <!-- <p class="text-success font-weight-bold text-uppercase font-16">pharmsolv - manager</p> -->
                    <span class="logo-sm">
                        <img src="assets/images/pharmsolv-logo-sm-dark.jpg" alt="PharmSolv" height="28">
                    </span>
                </a>
            </div>

             <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                <li>
                    <button class="button-menu-mobile waves-effect">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </li>
                
                

                <li class="dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle waves-effect text-dark font-weight-normal"  href="pos-type.php"> POS 
                    </a>
                </li>
                
                
                <li class="dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle waves-effect font-weight-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> Alerts <i class="mdi mdi-chevron-down"></i> 
                    </a>
                    <div class="dropdown-menu">
                            <!-- item-->
                            <a href="stocks.alerts.php" class="dropdown-item" > Stock Alert </a>
                            <!-- item-->
                            <a href="expiry.alerts.php" class="dropdown-item"> Expiry Alert</a> 
                            <!-- item-->
                            <a href="expired.medicines.php" class="dropdown-item"> Expired Medicines</a>

                    </div>
                </li>

                <li class="dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                         Statistics
                        <i class="mdi mdi-chevron-down"></i> 
                    </a>
                    <div class="dropdown-menu">
                            <!-- item-->
                            <a href="stats.medicines.php" class="dropdown-item" id="statistics-sales">
                                Medicines
                            </a>
                            <!-- item-->
                            <a href="stats.profits.php" class="dropdown-item" id="statistics-medicines">
                                Profit
                            </a>
                            <!-- item-->
                            <a href="stats.stocks.php" class="dropdown-item" id="statistics-stocks">
                                Stock & Inventory
                            </a>

                    </div>
                </li>   
                
                <li class="dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Sales Analytics
                        <i class="mdi mdi-chevron-down"></i> 
                    </a>
                    <div class="dropdown-menu">
                            <!-- item-->
                            <a href="analytics.sales.yesterday.php" class="dropdown-item">
                                Sales Yesterday
                            </a>
                            <!-- item-->
                            <a href="analytics.sales.week.php" class="dropdown-item">
                                Sales This Week
                            </a>
                            <!-- item-->
                            <a href="analytics.sales.month.php" class="dropdown-item">
                                Sales This Month
                            </a>
                            <!-- item-->
                            <a href="analytics.sales.php" class="dropdown-item">
                                All Sales
                            </a>

                    </div>
                </li>  

                <li class="dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle waves-effect font-weight-light"  href="sales.receipts.php"> Receipts
                    </a>
                </li>
                
                <li class="dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle waves-effect font-weight-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"> Reports <i class="mdi mdi-chevron-down"></i> 
                    </a>
                    <div class="dropdown-menu">
                            <!-- item-->
                            <a href="report.medicines.php" class="dropdown-item" > Medicines</a>
                            <!-- item-->
                            <a href="report.sales.php" class="dropdown-item"> Sales </a> 
                            <!-- item-->
                            <a href="report.purchases.php" class="dropdown-item"> Purchases</a>
                            <a href="report.expenses.php" class="dropdown-item"> Expenses</a>

                    </div>
                </li>

            </ul>

        </div>
        <!-- end Topbar -->