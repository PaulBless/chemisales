<?php  require_once 'db/db.php'; ?>

<?php  require_once 'header/admin-header.php';  ?>
<?php  require_once 'sidebar/admin-sidebar.php';  ?>

<?php  if($_COOKIE['c_r'] === 'p' && $_COOKIE['u_r']==='p'){
    $selected_a_id = $_COOKIE['u_i'];
    $running_check = mysqli_query($connect_db,"SELECT * FROM `users_table` WHERE `users_table_role`= '$selected_a_id' LIMIT 1")or die(mysqli_error($connect_db));
    if(mysqli_num_rows($running_check) > 0){
    }else{
        echo "<script>window.location.href='index.php'</script>";
    }
    }

?>

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                       
                                    </div>
                                    <h4 class="page-title font-weight-bold">Users</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                 <div class="card-box" >
                                    <button type="button" class="btn btn-sm btn-info waves-effect waves-light float-right">
                                        <i class="fa fa-plus"></i> Manage Users
                                    </button>
                                    <h4 class="header-title mb-4 text-dark">View Users</h4>

                                    <table class="table table-hover  m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                        <thead class="bg-info text-dark">
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <th>Full Name</th>
                                            <th>Username</th>
                                            <th>Priority</th>
                                            <th>Status</th>
                                            <th>Created Date</th>
                                            
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php   
                                        
                                        $getUserInfo = mysqli_query($connect_db,"SELECT * FROM pharmacists_table join status_table on pharmacists_table.pharmacists_status = status_table.status_id join role_table on pharmacists_table.pharmacists_role = role_table.role_id")or die(mysqli_error($connect_db));
                                        while($userInfo = mysqli_fetch_array($getUserInfo)){  

                                            $get_users_userId = $userInfo['pharmacists_user_id'];
                                            $get_users_fullname = $userInfo['pharmacists_firstname']." ".$userInfo['pharmacists_lastname'];
                                            $get_users_username = $userInfo['pharmacists_username'];
                                            $get_users_priority = $userInfo['role_name'];
                                            $get_users_status = $userInfo['status_name'];
                                            $get_users_created = $userInfo['pharmacists_timestamp'];   ?>

                                            <tr>
                                            <td><b>#<?php echo $get_users_userId;   ?></b></td>
                                            <td>
                                            <span class="ml-2"><?php echo $get_users_fullname;   ?></span>
                                            </td>

                                            <td>
                                            <?php echo $get_users_username;   ?>
                                            </td>

                                            <td>
                                            <?php echo $get_users_priority;   ?>
                                            </td>

                                            <td>
                                                <span class="badge badge-light-secondary"><?php echo $get_users_status;   ?></span>
                                            </td>

                                            <td>
                                                <span class="badge badge-success"><?php echo $get_users_created ;  ?></span>
                                            </td>   
                                        </tr>


                                      <?php  }
                                        ?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- end col -->
                        </div>
                        <!-- end row -->    
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <?php require_once 'modals/user_record_modal.php';   ?>
                <?php require_once 'footer/admin-footer.php';   ?>