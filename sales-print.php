<?php  require_once 'db/db.php'; ?>

<?php

if (isset($_GET['sid'])) {
    $selected_sales_id = $_GET['sid'];
    $get_all_sales = mysqli_query($connect_db,"SELECT * FROM `tbl_each_sales` WHERE `sales_id_number` = '$selected_sales_id' LIMIT 1")or die(mysqli_error($connect_db));
    $each_sale = mysqli_fetch_array($get_all_sales);
        $sales_id = $each_sale['sales_id_number'];
        $sales_subtotal = $each_sale['sales_subtotal'];
        $sales_total = $each_sale['sales_total'];
        $tax_amount = $each_sale['tax_amount'];
        $amount_paid = $each_sale['amount_paid'];
        $discount_amount = $each_sale['discount_amount'];
        $sales_timestamp = date('d-M-Y H:i A',strtotime($each_sale['sales_timestamp']));
} else {
    echo "<script>window.location.href='sales-point-orignal.php'</script>";
}

?>

<?php
// Currency
$get_currency = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 7") or die(mysqli_error($connect_db));
$get_currency_item = mysqli_fetch_array($get_currency);
$currency = $get_currency_item['settings_ans'];

// Name
$get_system_name = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 1") or die(mysqli_error($connect_db));
$get_name = mysqli_fetch_array($get_system_name);
$name = $get_name['settings_ans'];

// Contact
$get_system_contact = mysqli_query($connect_db,"SELECT * FROM tbl_settings WHERE settings_id = 4") or die(mysqli_error($connect_db));
$get_contact = mysqli_fetch_array($get_system_contact);
$contact = $get_contact['settings_ans'];

?>


<?php 

require_once 'header/client-header.php'; 

?>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->


<style>
.content-page {
    margin-left: 10px !important;
    margin-top: 10px !important;
}

.footer {
    left: 0% !important;
}

</style>

<div class="content-page">
    <div class="content">

        <section id="main-content">
            <section class="wrapper site-min-height">
                <!-- invoice start-->
                <section>
                    <div class="panel panel-primary d-flex align-items-center justify-content-center">


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
                                        <img src="assets/images/main-logo.svg" height="60px" class="mt-1">

                                        <h5><?php echo $name;  ?></h5>
                                        <h6 style="font-size: 10px">
                                           <b>Tel: </b><?php echo $contact; ?><br>
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
                                                    <td>Item Name </td>
                                                    <td>Price</td>
                                                    <td>Qty </td>
                                                    <td>Total</td>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                    $fetch_sales = mysqli_query($connect_db,"SELECT * FROM `tbl_sales_table` WHERE `sales_id_number` = '$selected_sales_id'")or die(mysqi_error($connect_db));
                    while ($each_single_sale = mysqli_fetch_array($fetch_sales)) { 
        
                    $get_product_name = $each_single_sale['product_name'];
                    $get_product_price = $each_single_sale['product_price'];
                    $get_product_total = $each_single_sale['product_total'];
                    $get_product_quantity = $each_single_sale['product_quantity'];

                    $get_product_type = $each_single_sale['quantity_type'];

                
        
                    
        
                    $fetch_product_details = mysqli_query($connect_db,"SELECT * FROM `tbl_products` WHERE `tbl_products_id` = '$get_product_name'")or die(mysqli_error($connect_db));
                        $get_product_details = mysqli_fetch_array($fetch_product_details);
        
                           if($get_product_type  == 1){
                    // meaning item sold pcs
                    $product_name = $get_product_details['product_name'];
                $product_cost_price = $get_product_details['cost_price_pcs'];
                $item_unit = 'PCS';
                }else{
                    // meaning item sold is box
                     $product_name = $get_product_details['product_name'];
                $product_cost_price = $get_product_details['cost_price_box'];
                $item_unit = "BOX";
                }
                            
                            
                            ?>
                                                <tr style="font-size:10px">
                                                    <td><?php echo $product_name;  ?></td>
                                                    <td><?php echo $get_product_price;  ?></td>
                                                    <td><?php echo $get_product_quantity;  ?></td>
                                                    <td><?php echo $get_product_total;  ?></td>

                                                </tr>

                                                <?php  }  ?>

                                            </tbody>
                                        </table>


                                    </div>
                                    <div class="row">
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
                    <div class="d-flex align-items-center justify-content-center">
                        <a class="btn btn-success mr-2" target="_blank" href='printing.php?sid=<?php echo $_GET['sid']; ?>'><i
                                class="fa fa-print"></i> Print Receipt</a>
                        <a class="btn btn-danger ml-0" href='sales-point-original.php'><i
                            class="fa fa-times"></i> Cancel</a>
                    </div>
            </section>
        </section>

    </div> <!-- content -->
    <?php require_once 'footer/admin-footer.php';   ?>