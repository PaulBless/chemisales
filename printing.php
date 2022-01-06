<?php  require_once 'db/db.php'; ?>

<?php

    if (isset($_GET['salesid'])) {
        $selected_sales_id = $_GET['salesid'];
        $get_all_sales = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE `sales_number` = '$selected_sales_id' LIMIT 1")or die(mysqli_error($connect_db));
        $each_sale = mysqli_fetch_array($get_all_sales);
            $sales_id = $each_sale['sales_number'];
            $sales_subtotal = $each_sale['sales_subtotal'];
            $sales_total = $each_sale['sales_total'];
            $tax_amount = $each_sale['tax_amount'];
            $amount_paid = $each_sale['amount_paid'];
            $seller_id = $each_sale['sales_seller_id'];
            $sales_timestamp = date('d M, Y H:i A',strtotime($each_sale['sales_datetime']));

                // Get Saleperson Name
                $get_seller_name = mysqli_query($connect_db,"SELECT * FROM `tbl_users` WHERE `uid`='$seller_id' LIMIT 1")or die(mysqli_error($connect_db));
                $get_name = mysqli_fetch_array($get_seller_name);

                $sales_seller = $get_name['user_firstname'].' '.$get_name['user_lastname'];

    } else {
        echo "<script>window.location.href='print.pos.php'</script>";
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

    // Pharmacy Logo
    $sql_logo = mysqli_query($connect_db,"SELECT * FROM `tbl_settings` WHERE `settings_id` = '10'") or die(mysqli_error($connect_db));
    $get_logo = mysqli_fetch_array($sql_logo);
    $logo = $get_logo['settings_ans'];


?>

<style type="text/css">

    h3 {
        font-family: Merchant Copy;
        font-weight: bold;
        font-size: 13px;
    }

    span {
        font-family: Merchant Copy;
        font-weight: lighter;
        font-size: 12px;
    }

    date {
        font-family: Merchant Copy;
        font-weight: lighter;
        font-size: 12px;
    }


    thead {
        font-family: Merchant Copy;
        font-weight: bold;
        font-size: 13px;
    }

    tbody {
        font-family: Merchant Copy;
        font-weight: lighter;
        font-size: 12px;
    }

    table {
        width: 100%;
    }

</style>



<!-- ============================================================== -->
                    <!-- Start Page Content here -->
<!-- ============================================================== -->

<!-- Printable area end -->


<div class="content-page">
    <div class="content">

        <div class="content-wrapper">
            <section class="content">
                <!-- Alert Message -->
                <div id="printableArea">
                    <table border="0">
                        <tr>
                            <td>
                                <table border="0" width="100%">
                                
                                 <tr>
                                        <td align="center" style="border-bottom:none;">
                                            <img src="<?php echo (!empty($logo)) ? 'assets/images/'.$logo: 'assets/images/pharmsolv-dark.jpg'; ?>" height="50px">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                          <strong><?php echo $name; ?> </strong> <br> 
                                            Tel: <?php echo $contact; ?><br/>
                                            <!-- <span> Tel: <?php echo $contact; ?><br/></span> -->
                                        </td>
                                    </tr>

                                    <tr>
                                        <td align="center">
                                            <nobr>
                                                <date > <b>Date:</b> <?php echo $sales_timestamp;  ?><time>
                                            </nobr>
                                            <span style="margin-left: 15px;"><b>Receipt #:</b> <?php echo $selected_sales_id ?></span>
                                        </td>
                                    </tr>
                                </table>

                                <table width="70%" >
                                    <thead class="bg-info text-dark" >
                                        <tr>
                                            <td>Drug Name </td>
                                            <td>Price</td>
                                            <td align="right">Qty </td>
                                            <td align="right">Total</td>
                                        </tr>
                                    </thead>
                    <br/> <br/>
                                    <tbody>
                                        <?php
                                $fetch_sales = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number` = '$selected_sales_id'")or die(mysqli_error($connect_db));
                                while ($each_single_sale = mysqli_fetch_array($fetch_sales)) { 
                    
                                $get_product_name = $each_single_sale['medicineId'];
                                $get_product_price = $each_single_sale['medicinePrice'];
                                $get_product_total = $each_single_sale['medicineTotal'];
                                $get_product_quantity = $each_single_sale['medicineQty'];

                                $get_product_type = $each_single_sale['quantity_type'];
                    
                                
                    
                                $fetch_product_details = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE `mid` = '$get_product_name'")or die(mysqli_error($connect_db));
                                    $get_product_details = mysqli_fetch_array($fetch_product_details);
                    
                                    if($get_product_type  == 1){
                                        // meaning item sold pcs
                                        $product_name = $get_product_details['medicine_name'];
                                        $product_cost_price = $get_product_details['selling_price'];
                                    }
                                        
                                        
                                        ?>

                                        <tr>

                                            <td align="left" width="40%">
                                                <?php echo $product_name;  ?>
                                            </td>
                                            <td align="left" width="10%">
                                                <?php echo $currency.' '. $get_product_price;  ?>
                                            </td>
                                            <td align="right" width="10%">
                                                <?php echo $get_product_quantity;  ?>
                                            </td>
                                            <td align="right" width="10%">
                                                <?php echo $currency.' '. $get_product_total;  ?>
                                            </td>


                                        </tr>

                                        <?php  }  ?>

                                    </tbody>

                                    <tr>
                                        <td colspan="4" style="border-top:#333 1px solid;">
                                            <nobr></nobr>
                                        </td>
                                    </tr>

                                    <tr >
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="left" colspan="2">
                                            <nobr>Tax Allowed</nobr>
                                        </td>
                                        <td align="right">
                                            <nobr> <?php echo $currency." ".$tax_amount; ?></nobr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4" style="border-top:none">
                                            <nobr></nobr>
                                        </td>
                                    </tr>

                                    <tr >
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="left" colspan="2">
                                            <nobr><strong>Grand Total</strong></nobr>
                                        </td>
                                        <td align="right">
                                            <nobr><strong><?php echo $currency." ".$sales_total; ?></strong></nobr>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="4" style="border-top:none;">
                                            <nobr></nobr>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <nobr></nobr>
                                        </td>
                                        <td align="left" colspan="2">
                                            <nobr>Amount Paid</nobr>
                                        </td>
                                        <td align="right">
                                            <nobr> <?php echo $currency." ".$amount_paid; ?></nobr>
                                        </td>
                                    </tr>



                                </table>
                                <table width="100%" style="margin-top: 15px;">
                                    <tr style="text-align: center;">
                                        <td>You were served by: <?php echo $sales_seller; ?></td>
                                    </tr> 
                                    <tr style="text-align: center; font-style: italic; ">
                                        <td>Powered by Jecmas</td> 
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        
                    </table>

                    
                </div>


            </section> <!-- /.content -->
        </div> <!-- /.content-wrapper -->

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <script type="text/javascript">
        $(document).ready(function() {

            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            document.body.style.marginTop = "-10px";
            setTimeout(function() {
                window.print();
            }, 500);
            document.body.innerHTML = originalContents;

            setTimeout(function() {
                window.close();
            }, 500);
        })
        </script>

    </div> <!-- content -->