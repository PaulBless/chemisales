<?php

require_once 'db/db.php';

## Fetch Yesterday's Sales Analytics
$profit_array = [];
$yes_sale_array = [];

$cost_price_counter = 0;
$selling_price_counter = 0;
$get_cp = 0;
$get_sp = 0;

$amount = 0;
$total_profit = 0;
$total_sale_yesterday = 0;
$today = date('Y-m-d');
$yesterday_date =  date('Y-m-d', strtotime($today."-1 days"));

$stmt_yesterday_sale = "SELECT * FROM `tbl_special_sales` WHERE `sales_datetime` > DATE_SUB(DATE(NOW()), INTERVAL 1 DAY) ";
$fetch_ys = mysqli_query($connect_db, $stmt_yesterday_sale)or die(mysqli_error($connect_db));
while( $sale_day = mysqli_fetch_array($fetch_ys) ) {
    // $amount += $sale_day['(sales_subtotal)'];
    // $total_sale_yesterday=$amount;
    $total_sale_yesterday+=$sale_day['sales_subtotal'];
    $yesterday_sale_number = $sale_day['sales_number'];

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='$yesterday_sale_number' ")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];

            // now get medicine details
            $get_products = mysqli_query($connect_db,"SELECT * FROM `tbl_medicines` WHERE `mid`='$each_medicine_id'")or die(mysqli_error($connect_db));
            $each_product = mysqli_fetch_array($get_products);
            $costPrice = $each_product['cost_price'];
            $sellingPrice = $each_product['selling_price'];
                
            // calculate cost & selling prices
            $get_cp = $costPrice*$each_medicine_qty;
            $get_sp = $sellingPrice*$each_medicine_qty;
            // get total selling prices 
            $cost_price_counter+= $get_cp;
            $selling_price_counter += $get_sp;

        }
        $total_profit = $selling_price_counter - $cost_price_counter;
}

// $total_profit = $selling_price_counter - $cost_price_counter;
array_push($profit_array, $total_profit);
array_push($yes_sale_array, $total_sale_yesterday);

?>