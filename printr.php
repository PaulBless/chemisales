<?php
    
    // require_once 'session.php';   // Check if User is Authenticated
    require('db/config.php');

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

    $fetch_sales = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number` = '$selected_sales_id'")or die(mysqli_error($connect_db));
    while ($each_single_sale = mysqli_fetch_array($fetch_sales)) { 
        $get_product_name = $each_single_sale['mealId'];
        $get_product_price = $each_single_sale['mealPrice'];
        $get_product_total = $each_single_sale['mealTotal'];
        $get_product_quantity = $each_single_sale['mealQty'];

        $get_product_type = $each_single_sale['quantity_type'];
        
        $fetch_product_details = mysqli_query($connect_db,"SELECT * FROM `tbl_meals` WHERE `mealid` = '$get_product_name'")or die(mysqli_error($connect_db));
        $get_product_details = mysqli_fetch_array($fetch_product_details);
            if($get_product_type  == 1){
                // meaning item sold pcs
                $product_name = $get_product_details['meal_name'];
                $product_cost_price = $get_product_details['selling_price'];
            }
    }

?>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <style>
            * {
                font-size: 11px;
                font-family: Segoe UI;
            }

            td,
            th,
            tr,
            table {
                border-collapse: collapse;
            }

            td.description,
            th.description {
                width: 75px;
                max-width: 75px;
            }

            td.quantity,
            th.quantity {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            td.price,
            th.price {
                width: 40px;
                max-width: 40px;
                word-break: break-all;
            }

            .centered {
                text-align: center;
                align-content: center;
            }

            .ticket {
                width: 300px;
                max-width: 300px;
            }

            img {
                max-width: inherit;
                width: inherit;
            }

            @media print {
                .hidden-print,
                .hidden-print * {
                    display: none !important;
                }
            }
        </style>
    </head>
    
    
    <body style="color:#000;font-family:monospace;font-size:12px" onload="window.print()">

    <div class="ticket">
        <center>
            <img src="<?php echo (!empty($get_restaurant_logo)) ? 'assets/images/'.$get_restaurant_logo: 'assets/images/jecfood-dark.jpg'; ?>" style="height: 50px; margin: 0;"/> <br><small style="font-size:11px; color:#444">

            <?php echo $get_restaurant_name; ?> <br>
            <?php echo $get_restaurant_address; ?> <br>
            <?php echo "Tel: " .$contact; ?>
            </center></small><br>
            <small></small>
            Invoice #:  <?php echo $selected_sales_id; ?><br>
            Served By: <?php echo $sales_seller; ?> <br>
            Date:  <?php echo $sales_timestamp; ?> <br><br><br>
        
            <table width="100%" style="color:#000;font-family:monospace;font-size:13px; ">
            <thead>
            <tr width="100%" style="border-top:1px solid #000;border-right:0;border-left:0;border-bottom:1px solid #000;border-style:dashed;font-family:monospace;padding:3px;font-weight:normal">
            <th style="color:#000 font-family:monospace" class="description">Meal Name </th>
            <th style="color:#000;font-family:monospace" class="quantity"><center>Qty</center></th>
            <th style="color:#000;font-family:monospace"class="price">Price <?php echo $currency ?></th>
            <!-- <th style="color:#000;font-family:monospace"class="price">Total <?php echo $currency ?></th> -->
            </tr>
            </thead>
            
            <tr >
            <td style="color:#000;font-family:monospace;font-size:14px"class="description"><small> <?php echo $product_name; ?> </small></td>
            <td style="color:#000;font-family:monospace;font-size:14px"class="quantity"><center> <?php echo $get_product_quantity ?></center></td>

            <td style="color:#000;font-family:monospace;font-size:14px"class="price"><?php echo $get_product_price ?> </td>

            <!-- <td style="color:#000;font-family:monospace;font-size:14px"class="price"> <?php echo $get_product_total; ?></td> -->
                
            </tr>
            </table>

        <table width="100%" style="display:none;" >
        <tr width="100%" style="border-top:1px solid #000;border-right:0;border-left:0;border-bottom:1px solid #000;border-style:dashed;font-family:monospace;padding:3px;font-weight:normal">
        <td style="color:#000;font-family:monospace"class="description">['trans11']</td>
        <td style="color:#000;font-family:monospace"class="quantity" >:</td>
        <td style="color:#000;font-family:monospace"class="description">ghc 555 ,- </td>
        </tr>

        <tr width="100%" style="border-top:0px solid #000;border-right:0;border-left:0;border-bottom:1px solid #000;border-style:dashed;font-family:monospace;padding:3px;font-weight:normal">
        <td colspan='2' style="color:#000;font-family:monospace"class="description">Discount <?php echo $currency ?>: 0.00</td>
        <td style="color:#000;font-family:monospace"class="description">Tax <?php echo $currency ?>: <?php echo $tax_amount ?></td>
        </tr>

        <tr width="100%" style="border-top:1px solid #000;border-right:0;border-left:0;border-bottom:1px solid #000;border-style:dashed;font-family:monospace;padding:3px;font-weight:normal">
        <!-- <td style="color:#000;font-family:monospace"class="description"> </td> -->
        <!-- <td style="color:#000;font-family:monospace"class="quantity" > Total <?php echo $currency ?>:</td> -->
        <!-- <td style="color:#000;font-family:monospace"class="description">  <?php echo $sales_total ?></td> -->
        </tr>
        </table>

        <div style="border-top:1px solid #000; padding-top: 5px;margin-top: 5px; "> 
            <b>Grand Total:</b> <?php echo $currency.''.$sales_total ?> <br> 
            <b>Amount Paid:</b> <?php echo $currency.''.$amount_paid ?> <br>
            <b>Balance:</b> <?php $bal = $amount_paid - $sales_total; echo $currency.''.$bal;?>
        </div>

        <p class="centered" style="font-style: italic;">  Meals Sold are not returnable, Thanks for coming! <br><small> -- Powered by Jecmas --</small></p>

        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        <button id="btnCancel" class="hidden-print">Cancel</button>
        <script >
            const $btnPrint = document.querySelector("#btnPrint");
                $btnPrint.addEventListener("click", () => {
                    window.print();
                }); 
                const $btncancel = document.querySelector("#btnCancel");
                $btncancel.addEventListener("click", () => {
                    window.location.href = 'pos';
                });
        </script>
    </body>
</html>