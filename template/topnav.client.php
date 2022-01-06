


<!-- Topbar Start -->
<div class="navbar-custom ">
    <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="d-none d-sm-block">
                <li class="dropdown notification-list d-none">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect font-weight-bold text-success mr-0" id="price-list-btn"> 
                        <i class="fe-tag noti-icon"></i> Price List
                    </a>
                </li>
        </li>

        <!-- Log User Info < meta data> -->
        <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect" data-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="assets/images/default.png" alt="" class="rounded-circle ml-0">
                        <span class="pro-user-name ml-0">
                            <?php echo $users_fullname; ?> <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h6 class="m-0 text-white">
                               Your Role: <span class="text-warning"> Attendant </span> 
                            </h6>
                        </div>

                        <!-- item-->
                        <a href="#" data-toggle="modal" id="my-sales" class="dropdown-item notify-item">
                            <i class="mdi mdi-finance"></i>
                            <span>My Sales Today</span>
                        </a>

                        <!-- item-->
                        <a href="#" data-toggle="modal" id="update-password" class="dropdown-item notify-item">
                            <i class="mdi mdi-key-change"></i>
                            <span>Change Password</span>
                        </a>
                      
                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="#" data-toggle="modal" id="logout" class="dropdown-item notify-item">
                            <i class="fe-log-out"></i>
                            <span>Logout</span>
                        </a>

                    </div>
        </li>
                

    </ul>

    <!-- LOGO -->
    <div class="logo-box">
                <a href="pos.billing.php" class="logo text-center">
                    <span class="logo-lg">
                        <img src="assets/images/pharmsolv-dark.jpg" alt="PharmSolv" height="60" >
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/pharmsolv-logo-sm-dark.jpg" alt="PharmSolv" height="60">
                    </span>
                </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                
                <li class="d-nonee">
                    <button class="button-menu-mobile waves-effect">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </li>

                <li class="dropdown d-none d-lg-block">
                    <a class="nav-link dropdown-toggle waves-effect text-dark font-weight-bold mr-5 ml-0" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Today's Date: 
                        <!-- Date: -->
                        <span class="text-secondary font-weight-lighter ml-1" id="date-value">
                            <script> 
                                var date = new Date();
                                document.getElementById("date-value").innerHTML = date.toDateString();
                            </script>
                        </span>
                    </a>
                </li>    
                
                <li class="dropdown d-none d-lg-block" style="left: 0; right: 0px;">
                    <a class="nav-link dropdown-toggle waves-effect font-weight-bold mr-3 ml-2" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <label class="text-dark text-uppercase text-center font-weight-bold" style="letter-spacing: 0.5px; ">
                            <?php 
                            
                            ## Query - Get Pharmacy Name
                            $sql_name_fetch = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '1'")or die(mysql_error($connect_db));
                            $system_settings = mysqli_fetch_assoc($sql_name_fetch);
                            $pharmacy_name = $system_settings['settings_ans'];
                            
                            ## Get Pharmacy Address
                            $sql = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '3'")or die(mysql_error($connect_db));
                            $system_location = mysqli_fetch_assoc($sql);
                            $pharmacy_location = $system_location['settings_ans'];
                            // -- Query Ends Here
                            echo $pharmacy_name .', '. $pharmacy_location;
                            ?>
                        </label> 
                    </a>
                </li>
                
                              

    </ul>
</div>
        <!-- end Topbar -->