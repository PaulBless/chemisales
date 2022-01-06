<?php

require_once 'db/db.php';

## Fetch Month's Sales Analytics
$profit_array = [];
$month_sale_array = [];

$cost_price_counter = 0;
$selling_price_counter = 0;
$get_cp = 0;
$get_sp = 0;

$amount = 0;
$total_profit = 0;
$total_sale_month = 0;
$days_spent = 0;

$stmt_month_sale = "SELECT *, day(curdate()) AS 'days_spent' FROM `tbl_special_sales` WHERE date(sales_datetime) > DATE_SUB(NOW(), INTERVAL 1 MONTH) AND MONTH(sales_datetime) = MONTH(CURDATE()) AND YEAR(sales_datetime) = YEAR(CURDATE()) ";
$fetch = mysqli_query($connect_db, $stmt_month_sale)or die(mysqli_error($connect_db));
while( $sale_month = mysqli_fetch_array($fetch) ) {
    // $amount += $sale_month['sales_subtotal'];
    // $total_sale_month=$amount;
    $days_spent = $sale_month['days_spent'];
    $total_sale_month+=$sale_month['sales_subtotal'];
    $month_sale_number = $sale_month['sales_number'];

        // get profit for the date
        $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='$month_sale_number' ")or die(mysqli_error($connect_db));
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
            $selling_price_counter+= $get_sp;

        }
        $total_profit = $selling_price_counter - $cost_price_counter;
}

array_push($profit_array, $total_profit);
array_push($month_sale_array, $total_sale_month);

?>