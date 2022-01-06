<?php  require_once 'session.php'; ?>

<?php 
 
 // Role Based Access Management
    if($users_role === '1'){
        require_once 'db/db.php'; 
        require_once 'template/header.admin.php'; 
        require_once 'template/topnav.admin.php'; 
        require_once 'template/menu.admin.php'; 

     }else if ($users_role === '2'){
        require_once 'db/db.php'; 
        require_once 'template/header.manager.php'; 
        require_once 'template/topnav.manager.php'; 
        require_once 'template/menu.manager.php'; 
    }else{
        require_once 'db/db.php';
        require_once 'template/header.client.php';
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
                              <h4 class="page-title font-weight-bold" style="letter-spacing: 1px;">Print Sales Receipts</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card-box" >

                        <h4 class="header-title mb-4 text-dark" style="letter-spacing: 1px;">All Sales Recorded</h4>

                        <table class="table table-hover  m-0 table-centered dt-responsive nowrap w-100"
                            id="tickets-table">
                            <thead class="bg-info text-dark">
                                <tr>
                                    <th> ID</th>
                                    <th>Sales ID</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th>Seller</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php  
                                        
                                        $get_all_sales = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` ORDER BY ssid DESC")or die(mysqli_error($connect_db));
                                        while ($each_sale = mysqli_fetch_array($get_all_sales)) {
                                            $sales_id = $each_sale['sales_number'];
                                            $eachsales_id = $each_sale['ssid'];
                                            $sales_subtotal = $each_sale['sales_subtotal'];
                                            $sales_total = $each_sale['sales_total'];
                                            $sales_seller = $each_sale['sales_seller_id'];
                                            $sales_timestamp = date('d-M-Y',strtotime($each_sale['sales_datetime']));

                                                $get_from_users_table = mysqli_query($connect_db,"SELECT * FROM `tbl_users` WHERE `uid` = $sales_seller LIMIT 1")or die(mysqli_error($connect_db));
                                                $get_name = mysqli_fetch_array($get_from_users_table);

                                                $name = $get_name['user_firstname'].' '.$get_name['user_lastname'];
                                                $get_by = $name;
                                            


                                            ?>

                                <tr>
                                    <td><?php echo $eachsales_id    ?></td>
                                    <td><?php echo $sales_id;    ?></td>
                                    <td><?php echo $sales_subtotal;   ?></td>
                                    <td><?php echo $sales_total;   ?></td>
                                    <td><?php echo $get_by;   ?></td>
                                    <td><?php echo $sales_timestamp;   ?></td>
                                    <td><a class="btn btn-info btn-md"
                                            href="print.sales.php?sid=<?php echo $sales_id; ?>"><i
                                                class="fa fa-print"></i>&nbsp; Print</a></td>

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

    

    <?php require_once 'template/footer.client.php';   ?>

    <script type='text/javascript'>
    $(document).ready(function() {


    });
    </script>