
<?php
    require_once 'db/db.php';

    if (isset($_GET['salesid'])) {
        $selected_sales_id = $_GET['salesid'];
        $sql_statement = "SELECT * FROM `tbl_special_sales` WHERE `sales_number`='$selected_sales_id'";
        $get_this_sale = $connect_db->query($sql_statement);
        if($get_this_sale){
            $sale_record = $get_this_sale->fetch_assoc();
            $sales_id = $sale_record['sales_number'];
            $sales_subtotal = $sale_record['sales_subtotal'];
            $sales_total = $sale_record['sales_total'];
            $tax_amount = $sale_record['tax_amount'];
            $amount_paid = $sale_record['amount_paid'];
            $sales_timestamp = date('d-M-Y H:i A', strtotime($sale_record['sales_datetime']));
        }
        
    } else {
        echo "<script>window.location.href='print.pos.php'</script>";
    }

?>

<?php
    // Currency
    $get_currency = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = 7") or die(mysqli_error($connect_db));
    $get_currency_item = mysqli_fetch_array($get_currency);
    $currency = $get_currency_item['settings_ans'];

    // Pharmacy Name
    $get_system_name = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = 1") or die(mysqli_error($connect_db));
    $get_name = mysqli_fetch_array($get_system_name);
    $name = $get_name['settings_ans'];

    // Pharmacy Contact
    $get_system_contact = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = 4") or die(mysqli_error($connect_db));
    $get_contact = mysqli_fetch_array($get_system_contact);
    $contact = $get_contact['settings_ans'];
    
    // Pharmacy Logo
    $sql_logo = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '10'") or die(mysqli_error($connect_db));
    $get_logo = mysqli_fetch_array($sql_logo);
    $logo = $get_logo['settings_ans'];

?>


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

        <section id="main-content">
            <section class="wrapper site-min-height">
                <!-- invoice start-->
                <section>
                    <div class="panel panel-primary">


                        <style>
                        @media print {
                            #printJS-form {
                                font-size: 8px;
                            }
                        }
                        </style>

                        <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                        <div class="card col-md-2 panel-moree" style="font-size: 8px;">
                            <div id="printJS-form">
                                <div class="row justify-content-center">
                                    <div class="text-center">
                                        <img src="<?php echo (!empty($logo)) ? 'assets/images/'.$logo: 'assets/images/pharmsolv-dark.jpg'; ?>" height="60px">

                                        <h5><?php echo $name;  ?></h5>
                                        <h6 style="font-size: 10px">
                                            Tel: <?php echo $contact; ?><br>
                                        </h6>


                                        <h6 style="font-size: 10px">Receipt #:
                                            <strong><?php echo $selected_sales_id; ?></strong></h6>
                                        <h6 style="font-size: 10px">Date : <?php echo $sales_timestamp;  ?></h6>

                                        </d>
                                    </div>
                                    <div class="row">
                                        <table class="table table-hover mb-0">
                                            <thead class="bg-info text-dark">
                                                <tr style="font-weight:bold;font-size:10px">
                                                    <td>Name </td>
                                                    <td>Price</td>
                                                    <td>Qty </td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                    $fetch_sales = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number` = '$selected_sales_id'")or die(mysqli_error($connect_db));
                    while ($each_single_sale = mysqli_fetch_array($fetch_sales)) { 
                    // read record
                    $get_medicine_name = $each_single_sale['medicineId'];
                    $get_medicine_price = $each_single_sale['medicinePrice'];
                    $get_medicine_total = $each_single_sale['medicineTotal'];
                    $get_medicine_quantity = $each_single_sale['medicineQty'];
                    $get_medicine_type = $each_single_sale['quantity_type'];

        
                    
                    // Get Medicine Details
                    $fetch_medicine_details = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE `mid` = '$get_medicine_name'")or die(mysqli_error($connect_db));
                    $get_medicine_details = mysqli_fetch_array($fetch_medicine_details);
        
                    $medicine_name = $get_medicine_details['medicine_name'];
                    $medicine_price = $get_medicine_details['selling_price'];
                                              
                            ?>
                            <tr style="font-size:9px">
                                <td><?php echo $medicine_name;  ?></td>
                                <td><?php echo $medicine_price;  ?></td>
                                <td><?php echo $get_medicine_quantity;  ?></td>
                                <td><?php echo $get_medicine_total;  ?></td>

                            </tr>

                            <?php  }  ?>

                                </tbody>
                                        </table>


                                    </div>

                                    <div class="row d-none">
                                        <div class="col-12 text-center">
                                            <div>
                                                <h6 style="font-size:10px"> Tax Allowed :
                                                    <?php echo $currency." ".$tax_amount; ?></h6>
                                                <h6 style="font-size:10px"> Discount Allowed :
                                                    <?php echo $currency." ".$discount_amount; ?></h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <div>
                                            <h6 style="font-size:10px"> Sub Total :
                                                <?php echo $currency." ".$sales_subtotal; ?></h6>
                                            <h6 style="font-size:10px"> Grand Total :
                                                <?php echo $currency." ".$sales_total; ?></h6>
                                            <h6 style="font-size:10px"> Amount Paid :
                                                <?php echo $currency." ".$amount_paid; ?></h6>
                                        </div>
                                    </div>


                                    <div class="row col-12 text-center">
                                        <div class="col-12 my-0">
                                            <h6 style="font-size:9px">*** Thank You ***</h6>
                                        </div>
                                        <div class="col-12 my-0">
                                            <h6 style="font-size:9px">Powered By Jecmas</h6>
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>
                </section>
                <!-- invoice end-->
                <a class="btn btn-success ml-2" target="_blank" href='printing.php?salesid=<?php echo $_GET['salesid']; ?>'><i
                        class="mdi mdi-printer"></i> Print </a>
                        <a href="pos.php" class="btn btn-danger"> Cancel</a>
            </section>
        </section>

    </div> <!-- content -->
    <?php require_once 'template/footer.client.php';   ?>

    <scrip
        $(document)
    </script>
