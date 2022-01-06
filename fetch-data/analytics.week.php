<?php

require_once 'db/db.php';

## Following Code Will Fetch Weekly Sales Analytics
$day_sales_array = [];
$profit_array = [];

$get_amount = 0;

$cost_price_counter = 0;
$selling_price_counter = 0;
$get_cp = 0;
$get_sp = 0;

$amount = 0;
$total_profit = 0;


// fetch monday sales 
$monday_counter = 0;
$get_monday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATe(sales_datetime) = DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)")or die(mysqli_error($connect_db));
while ($each_monday = mysqli_fetch_array($get_monday)) {
    $get_amount = $each_monday['sales_total'];
    $monday_counter+= $get_amount;

    // get profit for the date
    $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='".$each_monday['sales_number']."' ")or die(mysqli_error($connect_db));
        while($record = mysqli_fetch_array($query)) {
            $each_medicine_id = $record['medicineId'];
            $each_medicine_qty = $record['medicineQty'];
            $each_medicine_profit = $record['profit'];

            $total_profit+= $each_medicine_profit;

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
array_push($profit_array,$total_profit);
array_push($day_sales_array,$monday_counter);

// fetch tuesday sales 
$tuesday_counter = 0;
$get_tuesday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 1 DAY)")or die(mysqli_error($connect_db));
while ($each_tuesday = mysqli_fetch_array($get_tuesday)) {
    $get_amount = $each_tuesday['sales_total'];
    $tuesday_counter+= $get_amount;

    // get profit for the date
    $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='".$each_tuesday['sales_number']."' ")or die(mysqli_error($connect_db));
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
array_push($profit_array,$total_profit);
array_push($day_sales_array,$tuesday_counter);

// fetch wednesday sales 
$wednesday_counter = 0;
$get_wednesday = mysqli_query($connect_db,"SELECT * FROM tbl_special_sales WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 2 DAY)")or die(mysqli_error($connect_db));
while ($each_wednesday = mysqli_fetch_array($get_wednesday)) {
    $get_amount = $each_wednesday['sales_total'];
    $wednesday_counter+= $get_amount;

    // get profit for the date
    $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='".$each_wednesday['sales_number']."' ")or die(mysqli_error($connect_db));
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
array_push($profit_array,$total_profit);
array_push($day_sales_array,$wednesday_counter);


// fetch thursday sales 
$thursday_counter = 0;
$get_thursday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 3 DAY)")or die(mysqli_error($connect_db));
while ($each_thursday = mysqli_fetch_array($get_thursday)) {
    $get_amount = $each_thursday['sales_total'];
    $thursday_counter+= $get_amount;

    // get profit for the date
    $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='".$each_thursday['sales_number']."' ")or die(mysqli_error($connect_db));
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
array_push($profit_array,$total_profit);
array_push($day_sales_array,$thursday_counter);

// fetch friday sales 
$friday_counter = 0;
$get_friday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 4 DAY)")or die(mysqli_error($connect_db));
while ($each_friday = mysqli_fetch_array($get_friday)) {
    $get_amount = $each_friday['sales_total'];
    $friday_counter+= $get_amount;

    // get profit for the date
    $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='".$each_friday['sales_number']."' ")or die(mysqli_error($connect_db));
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
array_push($profit_array,$total_profit);
array_push($day_sales_array,$friday_counter);

// fetch saturday sales 
$saturday_counter = 0;
$get_saturday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 5 DAY)")or die(mysqli_error($connect_db));
while ($each_saturday = mysqli_fetch_array($get_saturday)) {
    $get_amount = $each_saturday['sales_total'];
    $saturday_counter+= $get_amount;

    // get profit for the date
    $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='".$each_saturday['sales_number']."' ")or die(mysqli_error($connect_db));
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
array_push($profit_array,$total_profit);
array_push($day_sales_array,$saturday_counter);


// fetch sunday sales 
$sunday_counter = 0;
$get_sunday = mysqli_query($connect_db,"SELECT * FROM `tbl_special_sales` WHERE DATE(sales_datetime) = DATE_ADD(( SELECT DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY)), INTERVAL 6 DAY)")or die(mysqli_error($connect_db));
while ($each_sunday = mysqli_fetch_array($get_sunday)) {
    $get_amount = $each_sunday['sales_total'];
    $sunday_counter+= $get_amount;

    // get profit for the date
    $query = mysqli_query($connect_db,"SELECT * FROM `tbl_sales` WHERE `sales_id_number`='".$each_sunday['sales_number']."' ")or die(mysqli_error($connect_db));
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
array_push($profit_array,$total_profit);
array_push($day_sales_array,$sunday_counter);

// ------------ End ------------------


?>